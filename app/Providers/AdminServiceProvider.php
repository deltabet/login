<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\User;
use App\Http\Controllers\AdminController;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        /*$this->app->bind('AdminController', function($app){
			return new AdminController(new User);
		});*/
    }
}
