<?php

namespace App\Providers;

use App\Observers\PasswordGroupObserver;
use App\Observers\ProjectObserver;
use App\PasswordGroup;
use App\Project;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Project::observe(ProjectObserver::class);
        PasswordGroup::observe(PasswordGroupObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
