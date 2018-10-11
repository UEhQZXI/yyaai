<?php

namespace App\Providers;

use App\Http\Serializers\NoDataArraySerializer;
use Dingo\Api\Transformer\Adapter\Fractal;
use Illuminate\Support\ServiceProvider;
use League\Fractal\Manager;

class DingoSerializerProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('League\Fractal\Manager', function($app) {
            $fractal = new \League\Fractal\Manager;

            $serializer = new \App\Http\Serializers\NoDataArraySerializer;
            $fractal->setSerializer($serializer);
            return $fractal;
        });
        $this->app->bind('Dingo\Api\Transformer\Adapter\Fractal', function($app) {
            $fractal = $app->make('\League\Fractal\Manager');
            return new \Dingo\Api\Transformer\Adapter\Fractal($fractal);
        });
    }
}
