<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShopRequest;
use App\Http\Requests\UpdateShopRequest;
use App\Models\Shop;
use Inertia\Inertia;
use Inertia\Response;

class ShopController extends Controller
{
//    public function __construct()
//    {
//        $this->authorizeResource(Shop::class, 'shop');
//    }

    public function index(): Response
    {
        $shops = auth()->user()->shops;
        $shops->map(function ($shop) {
            $shop->editUrl = route('shops.edit', $shop);

            return $shop;
        });

        return Inertia::render('Shops/Index', [
            'shops' => $shops
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Shops/Form', [
            'shop' => Shop::make()
        ]);
    }

    public function edit(Shop $shop): Response
    {
        return Inertia::render('Shops/Form', [
            'shop' => $shop
        ]);
    }

    public function store(ShopRequest $request)
    {
        auth()->user()->shops()->create($request->validated());

        return to_route('shops.index');
    }

    public function update(ShopRequest $request, Shop $shop)
    {
        $shop->update($request->validated());

        return to_route('shops.index');
    }

    public function destroy(Shop $shop)
    {
        $shop->delete();

        return to_route('shops.index');
    }
}
