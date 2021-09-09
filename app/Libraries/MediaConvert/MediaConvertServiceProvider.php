<?php

namespace Libraries\MediaConvert;

use Libraries\MediaConvert\Convertor;
use Illuminate\Support\ServiceProvider;

class MediaConvertServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(Convertor::class, function($app) {
            return new Convertor();
        });
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
