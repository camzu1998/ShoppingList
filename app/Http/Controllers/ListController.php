<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ListController extends Controller
{

    public function index()
    {
        $lists = auth()->user()->createdShoppingLists->concat(auth()->user()->shoppingLists);
        return Inertia::render('Lists/Index', [
            'lists' => $lists
        ]);
    }
}
