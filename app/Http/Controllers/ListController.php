<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShoppingListRequest;
use App\Models\ShoppingList;
use Illuminate\Http\RedirectResponse;
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

    public function store(ShoppingListRequest $request): RedirectResponse
    {
        auth()->user()->createdShoppingLists()->create($request->validated());

        return to_route('lists');
    }

    public function update(ShoppingListRequest $request, ShoppingList $list): RedirectResponse
    {
        $list->update($request->validated());

        return to_route('lists');
    }

    public function destroy(ShoppingList $list): RedirectResponse
    {
        $list->delete();

        return to_route('lists');
    }
}
