<?php

namespace App\Providers;

use App\Queries\CategoriesQueryBuilder;
use App\Queries\NewsQueryBuilder;
use App\Queries\NewsSourcesQueryBuilder;
use App\Services\Contracts\Parser;
use App\Services\Contracts\Social;
use App\Services\ParserService;
use App\Services\SocialService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register():void
    {
        $this->app->bind(NewsQueryBuilder::class);
        $this->app->bind(NewsSourcesQueryBuilder::class);
        $this->app->bind(CategoriesQueryBuilder::class);

        $this->app->bind(Social::class, SocialService::class);

        $this->app->bind(Parser::class, ParserService::class);



    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrapFive();
    }
}
