<?php

namespace App\Providers;

use App\Models\Company;
use Illuminate\Support\ServiceProvider;
use App\Rules\SizeExistence;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void {}

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Validator::extend('size_existence', function ($attribute, $value, $parameters, $validator) {
            $rule = new SizeExistence($parameters);

            return $rule->passes($attribute, $value);
        });

        Inertia::share('company', function () {
            return Company::first();
        });
    }
}
