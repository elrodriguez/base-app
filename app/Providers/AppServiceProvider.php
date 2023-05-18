<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Rules\SizeExistence;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Validator::extend('size_existence', function ($attribute, $value, $parameters, $validator) {
            $rule = new SizeExistence($parameters);

            return $rule->passes($attribute, $value);
        });

        Blade::component('blog-web-nav-stories', \Modules\Blog\View\Components\BlogWebNavStories::class);
        Blade::component('blog-footer-stories', \Modules\Blog\View\Components\BlogWebFooterStories::class);

        Blade::component('blog-web-nav-dev', \Modules\Blog\View\Components\BlogWebNavDev::class);
        Blade::component('blog-footer-dev', \Modules\Blog\View\Components\BlogWebFooterDev::class);
    }
}
