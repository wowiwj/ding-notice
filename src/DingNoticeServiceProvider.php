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
            __DIR__ . '/../config/ding.php' => base_path('config/ding.php'),
        ]);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerLaravelBindings();
    }


    /**
     * Register Laravel bindings.
     *
     * @return void
     */
    protected function registerLaravelBindings()
    {
        $this->app->singleton(DingTalk::class, function ($app) {
            return new DingTalk($app['config']['ding']);
        });
    }

}
