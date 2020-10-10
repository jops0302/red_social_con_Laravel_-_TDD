<?php

namespace App\Providers;

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Broadcast::channel('App.User.{userId}', function ($user, $userId) { return (int) $user->id === (int) $userId; });
        Broadcast::routes(['middleware' => 'auth:api']);

        require base_path('routes/channels.php');
    }
}
