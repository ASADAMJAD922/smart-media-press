<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthorsController extends Controller
{
    public function index()
    {
        $authors = User::where('role', User::AUTHOR)->get();
        return $this->formatResponse('success', 'authors-fetched-successfully', $authors);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'country_id' => 'nullable|numeric',
            'password' => 'required|string|min:6',
        ]);

        if ($validate->fails()) return $this->formatResponse('error', $validate->errors()->first(), null, 400);

        $author = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'country_id' => $request->country_id,
            'role' => User::AUTHOR,
            'password' => Hash::make($request->password),
        ]);

        return $this->formatResponse('success', 'author-created-successfully', $author);
    }

    public function show($id)
    {
        $author = User::where('role', User::AUTHOR)->find($id);
        if (!$author) return $this->formatResponse('error', 'author-not-found', null, 404);

        return $this->formatResponse('success', 'author-fetched-successfully', $author);
    }

    public function update(Request $request, $id)
    {
        $author = User::where('role', User::AUTHOR)->find($id);
        if (!$author) return $this->formatResponse('error', 'author-not-found', null, 404);

        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'nullable|string|max:20',
            'country_id' => 'nullable|numeric',
            'password' => 'nullable|string|min:6',
        ]);

        if ($validate->fails()) return $this->formatResponse('error', $validate->errors()->first(), null, 400);

        $data = $request->only('name','email','phone','country_id');
        if ($request->password) $data['password'] = Hash::check($request->password);

        $author->update($data);
        return $this->formatResponse('success', 'author-updated-successfully', $author);
    }

    public function destroy($id)
    {
        $author = User::where('role', User::AUTHOR)->find($id);
        if (!$author) return $this->formatResponse('error', 'author-not-found', null, 404);

        $author->delete();
        return $this->formatResponse('success', 'author-deleted-successfully');
    }
}
