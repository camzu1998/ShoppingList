<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Shop;
use App\Models\ShoppingList;
use App\Policies\ListPolicy;
use App\Policies\ShopPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        ShoppingList::class => ListPolicy::class,
        Shop::class => ShopPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
