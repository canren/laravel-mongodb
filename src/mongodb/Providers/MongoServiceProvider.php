<?php
/**
 * Created by PhpStorm.
 * User: fengzi
 * Date: 2018/12/28
 * Time: 11:53 AM
 */

namespace Canren\Mongodb;


use Exception;
use Illuminate\Support\ServiceProvider;
use Canren\Mongodb\MongoManager;

class MongoServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->singleton('mongo', function () {
            return new MongoManager();
        });

        $this->app->bind('mongo.connection', function ($app) {
            return $app['mongo']->connection();
        });

        $this->app->bind('mongo.collection', function ($app) {
            return $app['mongo']->collection();
        });
    }
}