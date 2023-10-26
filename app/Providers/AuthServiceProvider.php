<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\ProductSku;
use App\Policies\ProductSkuPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        ProductSku::class => ProductSkuPolicy::class,
    ];
    


    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
