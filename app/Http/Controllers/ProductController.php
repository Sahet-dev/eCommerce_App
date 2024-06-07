<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductListResource;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request()->query('search', false);
        $perPage = request()->query('per_page', 10);
        $sortField = request()->query('sort_field', 'updated_at');
        $sortDirection = request()->query('sort_direction', 'desc');

        if (!in_array($sortDirection, ['asc', 'desc'])) {
            return response()->json(['error' => 'sort_direction parameter must be "asc" or "desc"'], 400);
        }

        if (!$perPage) {
            return response()->json(['error' => 'per_page parameter is required'], 400);
        }

        $query = Product::query();
        $query->orderBy( $sortField, $sortDirection);

        if ($search) {
            $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%');
        }

        $products = $query->paginate($perPage);

        return ProductListResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        return new ProductResource(Product::create($request->validate()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->validate());

        return new ProductResource($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->noContent();
    }
}
