<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Option;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * List all questions with options
     */
    public function index()
    {
        $questions = Question::with(['options', 'authors'])->get();

        return $this->formatResponse('success', 'questions-list', $questions);
    }


    /**
     * Create Question + Options
     */
    public function store(Request $request)
    {
        $request->validate([
            'question_text' => 'required|string',
            'is_active' => 'boolean',
            'authors' => 'required|array|min:1',
            'authors.*' => 'exists:users,id',
            'options' => 'required|array|min:2',
            'options.*.name' => 'required|string',
            'options.*.text' => 'required|string',
            'options.*.is_correct' => 'boolean',
            'options.*.is_active' => 'boolean',
        ]);

        $question = Question::create([
            'question_text' => $request->question_text,
            'is_active' => $request->is_active ?? true,
        ]);

        foreach ($request->options as $opt) {
            Option::create([
                'question_id' => $question->id,
                'name' => $opt['name'],
                'text' => $opt['text'],
                'is_correct' => $opt['is_correct'] ?? false,
                'is_active' => $opt['is_active'] ?? true,
            ]);
        }

        // attach authors
        $question->authors()->sync($request->authors);

        return $this->formatResponse(
            'success',
            'question-created-successfully',
            $question->load(['options', 'authors']),
            201
        );
    }


    /**
     * Get Single Question
     */
    public function show(Question $question)
    {
        return $this->formatResponse(
            'success',
            'question-detail',
            $question->load(['options', 'authors'])
        );
    }


    /**
     * Update Question + Options (NO DELETE)
     */
    public function update(Request $request, Question $question)
    {
        $request->validate([
            'question_text' => 'required|string',
            'is_active' => 'boolean',
            'authors' => 'required|array|min:1',
            'authors.*' => 'exists:users,id',
            'options' => 'required|array|min:2',
            'options.*.id' => 'nullable|exists:options,id',
            'options.*.name' => 'required|string',
            'options.*.text' => 'required|string',
            'options.*.is_correct' => 'boolean',
            'options.*.is_active' => 'boolean',
        ]);

        // Update question
        $question->update([
            'question_text' => $request->question_text,
            'is_active' => $request->is_active ?? $question->is_active,
        ]);

        // update options
        $existingOptionIds = [];

        foreach ($request->options as $opt) {

            // --- UPDATE OLD OPTION ---
            if (!empty($opt['id'])) {

                $option = Option::where('id', $opt['id'])
                    ->where('question_id', $question->id)
                    ->first();

                if ($option) {
                    $option->update([
                        'name' => $opt['name'],
                        'text' => $opt['text'],
                        'is_correct' => $opt['is_correct'] ?? $option->is_correct,
                        'is_active' => $opt['is_active'] ?? $option->is_active,
                    ]);

                    $existingOptionIds[] = $option->id;
                    continue;
                }
            }

            // --- CREATE NEW OPTION ---
            $newOption = Option::create([
                'question_id' => $question->id,
                'name' => $opt['name'],
                'text' => $opt['text'],
                'is_correct' => $opt['is_correct'] ?? false,
                'is_active' => $opt['is_active'] ?? true,
            ]);

            $existingOptionIds[] = $newOption->id;
        }

        // --- DELETE ONLY THOSE OPTIONS NOT SENT IN UPDATE ---
        Option::where('question_id', $question->id)
            ->whereNotIn('id', $existingOptionIds)
            ->delete();

        // update authors
        $question->authors()->sync($request->authors);

        return $this->formatResponse(
            'success',
            'question-updated-successfully',
            $question->load(['options', 'authors'])
        );
    }



    /**
     * Delete Question
     */
    public function destroy(Question $question)
    {
        $question->delete();

        return $this->formatResponse(
            'success',
            'question-deleted-successfully',
            null
        );
    }
}
