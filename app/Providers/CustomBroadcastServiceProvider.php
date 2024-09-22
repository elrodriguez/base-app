<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Broadcasting\BroadcastManager;
use App\Broadcasting\SocketIoBroadcaster;
use Illuminate\Support\Facades\Broadcast;

class CustomBroadcastServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(BroadcastManager $broadcastManager): void
    {
        // Registrar el driver personalizado
        $broadcastManager->extend('socketio', function ($app, $config) {
            return new SocketIoBroadcaster();
        });
    }
}
