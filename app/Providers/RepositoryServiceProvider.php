<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind('App\Repositories\Contracts\UserInterface', 'App\Repositories\Eloquents\UserRepository');
        $this->app->bind('App\Repositories\Contracts\RoleInterface', 'App\Repositories\Eloquents\RoleRepository');
        $this->app->bind('App\Repositories\Contracts\PermissionInterface', 'App\Repositories\Eloquents\PermissionRepository');
        $this->app->bind('App\Repositories\Contracts\ArticleInterface', 'App\Repositories\Eloquents\ArticleRepository');
        $this->app->bind('App\Repositories\Contracts\ArticleCategoryInterface', 'App\Repositories\Eloquents\ArticleCategoryRepository');
        $this->app->bind('App\Repositories\Contracts\SettingInterface', 'App\Repositories\Eloquents\SettingRepository');
        $this->app->bind('App\Repositories\Contracts\MenuCategoryInterface', 'App\Repositories\Eloquents\MenuCategoryRepository');
        $this->app->bind('App\Repositories\Contracts\MenuInterface', 'App\Repositories\Eloquents\MenuRepository');
    }
}
