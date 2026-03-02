<?php

namespace App\Providers;

use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\View;
use App\Models\Category;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */

  

public function boot()
{
    View::composer('home.homeLayout', function ($view) {

        $popularCategories = cache()->remember('popular_categories', 3600, function () {
            return Category::where('categories.is_active', 1)
                ->whereNull('parent_id')
                ->withCount(['listings' => function ($query) {
                    $query->where('product_listings.is_active', 1);
                }])
                ->orderByDesc('listings_count')
                ->take(10)
                ->get();
        });

        $view->with('popularCategories', $popularCategories);
    });
}
    

    protected function configureDefaults(): void
    {
        Date::use(CarbonImmutable::class);

        DB::prohibitDestructiveCommands(
            app()->isProduction(),
        );

        Password::defaults(fn (): ?Password => app()->isProduction()
            ? Password::min(12)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()
                ->uncompromised()
            : null
        );
    }
}
