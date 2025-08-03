<?php

/**
 * Avatarfy - Service Provider
 * 
 * @package Avatarfy
 * @author Vraj Infocare <support@vrajinfocare.com>
 * @copyright 2025 Vraj Infocare
 * @license MIT License
 */

namespace Avatarfy;

use Illuminate\Support\ServiceProvider;
use Avatarfy\Services\SimpleSvgAvatarService;

class AvatarServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('avatar-service', function ($app) {
            $config = config('avatarfy', [
                'width' => 256,
                'height' => 256,
                'storage_path' => storage_path('app/avatars')
            ]);
            return new SimpleSvgAvatarService($config);
        });
    }

    public function boot()
    {
        // Publish config file
        $this->publishes([
            __DIR__.'/../config/avatarfy.php' => config_path('avatarfy.php'),
        ], 'config');

        // Load config
        $this->mergeConfigFrom(
            __DIR__.'/../config/avatarfy.php', 'avatarfy'
        );
    }
}
