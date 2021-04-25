<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        View::composer('conversations.*', function ($view) {
            $conversations = auth()->user()->conversations()->orderBy('last_message_at', 'desc')->get();

            $view->with([
                'conversations' => $conversations
            ]);
        });
    }
}
