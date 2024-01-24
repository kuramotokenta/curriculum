<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    private $models = [
        'User',
        'UserToken'
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // foreach ($this->models as $model) {
        //     $this->app->bind(
        //         "App\Repositories\Interfaces\{$model}RepositoryInterface",
        //         "App\Repositories\Eloquents\{$model}Repository"
        //     );
        // }
        $this->app->bind(
            "App\Repositories\Interfaces\UserRepositoryInterface",
            "App\Repositories\Eloquents\UserRepository"
        );
        $this->app->bind(
            "App\Repositories\Eloquents\UserTokenRepositoryInterface",
            "App\Repositories\Eloquents\UserTokenRepository"
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
