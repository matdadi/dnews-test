<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\Admin' => 'App\Policies\CMS\AdminPolicy',
        'App\Models\Category' => 'App\Policies\CMS\CategoryPolicy',
        'App\Models\Subcategory' => 'App\Policies\CMS\SubcategoryPolicy',
        'App\Models\Tag' => 'App\Policies\CMS\TagPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
