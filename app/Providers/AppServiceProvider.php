<?php

namespace App\Providers;

use App\Contracts\PrizeServiceFactoryContract;
use App\Factories\PrizeServiceFactory;
use App\Repositories\Eloquent\PrizeRepositoryEloquent;
use App\Repositories\Eloquent\PrizeTypeRepositoryEloquent;
use App\Repositories\Eloquent\UserPrizeRepositoryEloquent;
use App\Repositories\PrizeRepository;
use App\Repositories\PrizeTypeRepository;
use App\Repositories\UserPrizeRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            PrizeTypeRepository::class,
            PrizeTypeRepositoryEloquent::class
        );

        $this->app->bind(
            PrizeRepository::class,
            PrizeRepositoryEloquent::class
        );

        $this->app->bind(
            UserPrizeRepository::class,
            UserPrizeRepositoryEloquent::class
        );

        $this->app->bind(
            PrizeServiceFactoryContract::class,
            PrizeServiceFactory::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
