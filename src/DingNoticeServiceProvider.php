<?php

namespace DingNotice;

use Illuminate\Support\ServiceProvider;

class DingNoticeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/ding.php' => config_path('ding.php'),
        ]);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {


    }

}
