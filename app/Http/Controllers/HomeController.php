<?php

namespace App\Http\Controllers;
use App\Modules\Product\ProductService;

class HomeController extends Controller
{
    public function __construct(private ProductService $productService)
    {
    }

    public function home()
    {
        $products = $this->productService->getList();

        return view('home.index', [
            'products' => $products,
        ]);
    }
}
