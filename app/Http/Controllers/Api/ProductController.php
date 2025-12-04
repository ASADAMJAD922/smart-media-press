<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category', 'author')->get();
        return $this->formatResponse('success', 'products-fetched-successfully', $products);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'author_id' => 'nullable|exists:users,id',
            'image' => 'nullable|string',
            'price' => 'nullable|numeric',
            'discount_price' => 'nullable|numeric',
            'description' => 'nullable|string',
        ]);

        if ($validate->fails()) return $this->formatResponse('error', $validate->errors()->first(), null, 400);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $imageName = time() . '_product.' . $request->image->extension();
            $request->image->move(public_path('images/products'), $imageName);
            $data['image'] = 'images/products/' . $imageName;
        }

        $product = Product::create($data);

        return $this->formatResponse('success', 'product-created-successfully', $product);
    }

    public function show($id)
    {
        $product = Product::with('category', 'author')->find($id);
        if (!$product) return $this->formatResponse('error', 'product-not-found', null, 404);

        return $this->formatResponse('success', 'product-fetched-successfully', $product);
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) return $this->formatResponse('error', 'product-not-found', null, 404);

        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'author_id' => 'nullable|exists:users,id',
            'image' => 'nullable|string',
            'price' => 'nullable|numeric',
            'discount_price' => 'nullable|numeric',
            'description' => 'nullable|string',
        ]);

        if ($validate->fails()) return $this->formatResponse('error', $validate->errors()->first(), null, 400);

        $data = $request->all();

        if ($request->hasFile('image')) {

            // delete old image
            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }

            $imageName = time() . '_product.' . $request->image->extension();
            $request->image->move(public_path('images/products'), $imageName);
            $data['image'] = 'images/products/' . $imageName;
        }

        $product->update($data);
        return $this->formatResponse('success', 'product-updated-successfully', $product);
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) return $this->formatResponse('error', 'product-not-found', null, 404);

        $product->delete();
        return $this->formatResponse('success', 'product-deleted-successfully');
    }
}
