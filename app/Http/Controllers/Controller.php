<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Inertia\Inertia;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function dashborad()
    {
        $lists = auth()->user()->shoppingLists()->active()->with('products')->get();

        return Inertia::render('Dashboard', [
            'lists' => $lists,
        ]);
    }
}
