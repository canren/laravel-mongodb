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
    }
}
