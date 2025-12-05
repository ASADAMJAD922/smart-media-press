<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BlogController extends Controller
{
    /**
     * List All Blogs
     */
    public function index()
    {
        $blogs = Blog::orderBy('id', 'DESC')->get();

        return $this->formatResponse('success', 'blogs-fetched-successfully', $blogs);
    }

    /**
     * Create Blog
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'is_active'   => 'boolean',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // UPLOAD IMAGE
        if ($request->hasFile('image')) {

            $imageName = time() . '_blog.' . $request->image->extension();

            $request->image->move(public_path('images/blogs'), $imageName);

            $data['image'] = 'images/blogs/' . $imageName;
        }

        $blog = Blog::create($data);

        return $this->formatResponse('success', 'blog-created-successfully', $blog);
    }

    /**
     * Show Single Blog
     */
    public function show($id)
    {
        $blog = Blog::find($id);

        if (!$blog) {
            return $this->formatResponse('error', 'blog-not-found', null, 404);
        }

        return $this->formatResponse('success', 'blog-fetched-successfully', $blog);
    }

    /**
     * Update Blog
     */
    public function update(Request $request, $id)
    {
        $blog = Blog::find($id);

        if (!$blog) {
            return $this->formatResponse('error', 'blog-not-found', null, 404);
        }

        $data = $request->validate([
            'title'       => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_active'   => 'boolean',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // UPDATE IMAGE
        if ($request->hasFile('image')) {

            // delete old
            if ($blog->image && File::exists(public_path($blog->image))) {
                File::delete(public_path($blog->image));
            }

            $imageName = time() . '_blog.' . $request->image->extension();
            $request->image->move(public_path('images/blogs'), $imageName);

            $data['image'] = 'images/blogs/' . $imageName;
        }

        $blog->update($data);

        return $this->formatResponse('success', 'blog-updated-successfully', $blog);
    }

    /**
     * Delete Blog
     */
    public function destroy($id)
    {
        $blog = Blog::find($id);

        if (!$blog) {
            return $this->formatResponse('error', 'blog-not-found', null, 404);
        }

        // remove image
        if ($blog->image && File::exists(public_path($blog->image))) {
            File::delete(public_path($blog->image));
        }

        $blog->delete();

        return $this->formatResponse('success', 'blog-deleted-successfully');
    }
}
