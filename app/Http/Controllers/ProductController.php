<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Product::class, 'product');
    }

    public function index(): Response
    {
        $products = auth()->user()->products
            ->load('shop')
            ->map(
                function ($product) {
                    $product->shopName = optional($product->shop)->name;

                    return $product;
                }
            );
        $products->map(function ($product) {
            $product->editUrl = route('products.edit', $product);

            return $product;
        });
        return Inertia::render('Products/Index', [
            'products' => $products
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Products/Form', [
            'product' => Product::make(),
            'shops' => auth()->user()->shops->toArray()
        ]);
    }

    public function edit(Product $product): Response
    {
        return Inertia::render('Products/Form', [
            'product' => $product
        ]);
    }

    public function store(ProductRequest $request): RedirectResponse
    {
        auth()->user()->products()->create($request->validated());

        return to_route('products.index');
    }

    public function update(ProductRequest $request, Product $product): RedirectResponse
    {
        $product->update($request->validated());

        return to_route('products.index');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return to_route('products.index');
    }
}
