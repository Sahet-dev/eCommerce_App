<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProdController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $products = Product::query()->orderByDesc('id')->paginate(5);

        return view('product.index',
        [
            'products'=> $products
        ]);
    }


    public function view(Product $product){
        return view('product.view',
        [
            'product'=> $product
        ]);
    }


}


