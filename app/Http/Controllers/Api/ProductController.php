<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Get all products
     */
    public function index()
    {
        $products = Product::with(['variants', 'category', 'author'])
            ->orderBy('id', 'DESC')
            ->get();

        return $this->formatResponse(
            'success',
            'products-fetched-successfully',
            $products
        );
    }

    /**
     * Store product + variants
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'author_id' => 'nullable|exists:users,id',
            'price' => 'required|numeric',
            'discount_price' => 'nullable|numeric',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'variants' => 'nullable|array',
            'variants.*.name' => 'required|string',
            'variants.*.price' => 'required|numeric',
            'variants.*.is_active' => 'boolean',
        ]);

        if ($validate->fails()) {
            return $this->formatResponse(
                'error',
                $validate->errors()->first(),
                null,
                400
            );
        }

        $data = $request->all();

        // IMAGE UPLOAD
        if ($request->hasFile('image')) {
            $imageName = time() . '_product.' . $request->image->extension();
            $request->image->move(public_path('images/products'), $imageName);
            $data['image'] = 'images/products/' . $imageName;
        }

        $variants = $data['variants'] ?? [];
        unset($data['variants']);

        $product = Product::create($data);

        foreach ($variants as $variant) {
            $product->variants()->create([
                'name' => $variant['name'],
                'price' => $variant['price'],
                'is_active' => $variant['is_active'] ?? true,
            ]);
        }

        return $this->formatResponse(
            'success',
            'product-created-successfully',
            $product->load(['variants', 'category', 'author'])
        );
    }

    /**
     * Show product
     */
    public function show($id)
    {
        $product = Product::with(['variants', 'category', 'author'])->find($id);

        if (!$product) {
            return $this->formatResponse(
                'error',
                'product-not-found',
                null,
                404
            );
        }

        return $this->formatResponse(
            'success',
            'product-fetched-successfully',
            $product
        );
    }

    /**
     * Update product + variants
     */
    public function update(Request $request, $id)
    {
        $product = Product::with('variants')->find($id);

        if (!$product) {
            return $this->formatResponse(
                'error',
                'product-not-found',
                null,
                404
            );
        }

        $validate = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'author_id' => 'nullable|exists:users,id',
            'price' => 'nullable|numeric',
            'discount_price' => 'nullable|numeric',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'variants' => 'nullable|array',
            'variants.*.id' => 'nullable|exists:product_variants,id',
            'variants.*.name' => 'required|string',
            'variants.*.price' => 'required|numeric',
            'variants.*.is_active' => 'boolean',
        ]);

        if ($validate->fails()) {
            return $this->formatResponse(
                'error',
                $validate->errors()->first(),
                null,
                400
            );
        }

        $data = $request->all();

        // IMAGE UPDATE
        if ($request->hasFile('image')) {

            if ($product->image && File::exists(public_path($product->image))) {
                File::delete(public_path($product->image));
            }

            $imageName = time() . '_product.' . $request->image->extension();
            $request->image->move(public_path('images/products'), $imageName);
            $data['image'] = 'images/products/' . $imageName;
        }

        $variants = $data['variants'] ?? [];
        unset($data['variants']);

        $product->update($data);

        foreach ($variants as $variant) {
            if (isset($variant['id'])) {
                ProductVariant::where('id', $variant['id'])
                    ->where('product_id', $product->id)
                    ->update([
                        'name' => $variant['name'],
                        'price' => $variant['price'],
                        'is_active' => $variant['is_active'] ?? true,
                    ]);
            } else {
                $product->variants()->create([
                    'name' => $variant['name'],
                    'price' => $variant['price'],
                    'is_active' => $variant['is_active'] ?? true,
                ]);
            }
        }

        return $this->formatResponse(
            'success',
            'product-updated-successfully',
            $product->load(['variants', 'category', 'author'])
        );
    }

    /**
     * Delete product
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return $this->formatResponse(
                'error',
                'product-not-found',
                null,
                404
            );
        }

        if ($product->image && File::exists(public_path($product->image))) {
            File::delete(public_path($product->image));
        }

        $product->delete();

        return $this->formatResponse(
            'success',
            'product-deleted-successfully'
        );
    }
}
