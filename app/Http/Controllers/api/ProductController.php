<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductListResource;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

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
        $data = $request->validated();
        $date['created_by'] = $request->user()->id;
        $date['updated_by'] = $request->user()->id;

        /*** @var UploadedFile $image */
        $image = $data['image'] ?? null;
        if ($image){
            $relativePath = $this->saveImage($image);
            $data['image'] = URL::to(Storage::url($relativePath));
            $data['image_mime'] = $image->getClientMimeType();
            $data['image_size'] = $image->getSize();
        }

        $product = Product::create($data);
        return new ProductResource($product);




    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->validated();
        $data['updated_by'] = $request->user()->id;
        /*** @var UploadedFile $image */
        $image = $data['image'] ?? null;
        if ($image) {
            $relativePath = $this->saveImage($image);
            $data['image'] = URL::to(Storage::url($relativePath));
            $data['image_mime'] = $image->getClientMimeType();
            if ($product->image) {
                Storage::deleteDirectory('public/' . dirname($product->image));
            }
        }
        Log::info('Loaded product:', ['id' => $product->id]);

        // Manually updating each field
        $product->title = $data['title'];
        $product->description = $data['description'];
        $product->price = $data['price'];
        $product->updated_by = $data['updated_by'];
        if (isset($data['image'])) {
            $product->image = $data['image'];
        }

        // Attempt to save and log the result
        if (!$product->save()) {
            Log::error('Manual save failed', ['id' => $product->id]);
            return response()->json(['message' => 'Update failed'], 500);
        } else {
            Log::info('Manual save succeeded', ['id' => $product->id]);
        }

        return new ProductResource($product);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): \Illuminate\Http\Response
    {

        if ($product->image) {
            Storage::delete($product->image);
        }
        $product->delete();
        return response()->noContent();
    }

    private function saveImage(UploadedFile $image)
    {
        $path = 'images/' . Str::random();
        if (!Storage::exists($path)){
            Storage::makeDirectory($path, 0755, true);
        }
        if (!Storage::putFileAS('public/' . $path, $image, $image->getClientOriginalName())){
            throw new \Exception("File upload failed \"{$image->getClientOriginalName()}\"");
        }

        return $path . '/' . $image->getClientOriginalName();
    }
}
