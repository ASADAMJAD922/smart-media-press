<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return $this->formatResponse('success', 'categories-fetched-successfully', $categories);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'image' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        if ($validate->fails()) {
            return $this->formatResponse('error', $validate->errors()->first(), null, 400);
        }

        $data = $request->all();

        if ($request->hasFile('image')) {
            $imageName = time() . '_category.' . $request->image->extension();
            $request->image->move(public_path('images/categories'), $imageName);
            $data['image'] = 'images/categories/' . $imageName;
        }

        $category = Category::create($data);

        return $this->formatResponse('success', 'category-created-successfully', $category);
    }

    public function show($id)
    {
        $category = Category::find($id);
        if (!$category) return $this->formatResponse('error', 'category-not-found', null, 404);

        return $this->formatResponse('success', 'category-fetched-successfully', $category);
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        if (!$category) return $this->formatResponse('error', 'category-not-found', null, 404);

        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'image' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        if ($validate->fails()) {
            return $this->formatResponse('error', $validate->errors()->first(), null, 400);
        }

        $data = $request->all();

        if ($request->hasFile('image')) {

            if ($category->image && file_exists(public_path($category->image))) {
                unlink(public_path($category->image));
            }

            $imageName = time() . '_category.' . $request->image->extension();
            $request->image->move(public_path('images/categories'), $imageName);
            $data['image'] = 'images/categories/' . $imageName;
        }

        $category->update($data);
        
        return $this->formatResponse('success', 'category-updated-successfully', $category);
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        if (!$category) return $this->formatResponse('error', 'category-not-found', null, 404);

        $category->delete();
        return $this->formatResponse('success', 'category-deleted-successfully');
    }
}
