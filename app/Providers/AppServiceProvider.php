<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Client;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(['client.partials.header'], function ($view) {
            $email = session()->get('ClientEmail');
            $name = Client::where('client_email', $email)->get();
            $client_name = $name[0]->client_type;
            $view->with('client_name', $client_name);
        });
    }
}
