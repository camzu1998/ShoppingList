<?php

namespace App\Http\Controllers;

use App\Http\Requests\ListInviteRequest;
use App\Http\Requests\ListProductsRequest;
use App\Http\Requests\ShoppingListRequest;
use App\Mail\ListInvite;
use App\Models\Product;
use App\Models\ShoppingList;
use App\Models\Token;
use App\Services\ListInviteService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class ListController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(ShoppingList::class, 'list');
    }

    public function index(): Response
    {
        $lists = auth()->user()->createdShoppingLists->concat(auth()->user()->shoppingLists);
        $lists->map(function ($list) {
            $list->editUrl = route('lists.edit', $list);
            $list->isOwner = $list->user_id == auth()->id();

            return $list;
        });
        return Inertia::render('Lists/Index', [
            'lists' => $lists
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Lists/Form', [
            'list' => ShoppingList::make()
        ]);
    }

    public function edit(ShoppingList $list): Response
    {
        return Inertia::render('Lists/Form', [
            'list' => $list
        ]);
    }

    public function show(ShoppingList $list): Response
    {
        $products = $list->load('products.shop')
                        ->products->map(function ($product) {
                            $product->shopName = optional($product->shop)->name;

                            return $product;
                        });
        return Inertia::render('Lists/Show', [
            'list' => $list,
            'products' => $products,
        ]);
    }
    public function manage(ShoppingList $list): Response
    {
        $emails = collect();
        $lists = auth()->user()->load('createdShoppingLists.users')->createdShoppingLists;
        foreach ($lists as $list) {
            $emails->push($list->users->pluck('email'));
        }
        $emails = $emails->flatten()->unique()->toArray();

        return Inertia::render('Lists/Invite', [
            'list' => $list->load('users'),
            'emails' => $emails,
        ]);
    }

    public function store(ShoppingListRequest $request): RedirectResponse
    {
        auth()->user()->createdShoppingLists()->create($request->validated());

        return to_route('lists.index');
    }

    public function update(ShoppingListRequest $request, ShoppingList $list): RedirectResponse
    {
        $list->update($request->validated());

        return to_route('lists.index');
    }

    public function products(ListProductsRequest $request, ShoppingList $list): RedirectResponse
    {
        $productIds = [];
        $validated = $request->validated();
        foreach ($validated['products'] as $product) {
            $productModel = Product::updateOrCreate(
                [
                    'user_id' => auth()->id(),
                    'name' => $product['name']
                ],
                [
                    'price' => $product['price']
                ]
            );
            $productIds[] = $productModel->id;
        }

        $list->products()->sync($productIds);

        return to_route('lists.index');
    }

    public function invite(ListInviteRequest $request, ShoppingList $list): RedirectResponse
    {
        $validated = $request->validated();

        $listInviteService = new ListInviteService();
        $listInviteService = $listInviteService->setList($list);
        $listInviteService->generateTokenAndSendMail($validated['email']);

        return to_route('lists.index');
    }

    public function inviteAccept(ShoppingList $list, Token $token): RedirectResponse
    {
        if (!auth()->check()) {
            session()->put('list', $list->id);
            session()->put('token', $token->id);

            return to_route('homepage');
        }
        $listInviteService = new ListInviteService();
        $listInviteService = $listInviteService->setList($list);
        $listInviteService = $listInviteService->setToken($token);
        $listInviteService->accept();

        return to_route('lists.index');
    }

    public function destroy(ShoppingList $list): RedirectResponse
    {
        $list->delete();

        return to_route('lists.index');
    }
}
