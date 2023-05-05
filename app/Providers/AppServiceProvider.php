<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Rules\SizeExistence;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views', 'Blog');
        Blade::component('Blog::BlogWebNav', 'blogwebnav');
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
    }
}
