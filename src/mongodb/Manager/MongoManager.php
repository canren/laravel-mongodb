<?php
/**
 * Created by PhpStorm.
 * User: fengzi
 * Date: 2018/12/28
 * Time: 5:28 PM
 */

namespace Canren\Mongodb;


use Exception;

class MongoManager
{

    public $driver;

    /**
     * Create a new Redis manager instance.
     *
     */
    public function __construct()
    {
    }

    /**
     * Get a Mongo connection by name.
     *
     * @param string $driver
     * @return \MongoDB\Database
     */
    public function connection($driver = null)
    {
        $this->driver = $driver ?: 'default';
        return $this;
    }

    public function collection($collection = null)
    {
        if (null == $collection) {
            throw new Exception("Redis collection [{$collection}] not selected.");
        }
        $params = config('database.mongodb.' . $this->driver);
        if (null == $params) {
            throw new Exception("Redis connection [{$this->driver}] not configured.");
        }
        $host = explode(',', $params['host']);
        $linkConfig = [];
        foreach ($host as $v) {
            $linkConfig[] = 'mongodb://' . ($params['username'] && $params['password'] ? $params['username'] . ':' . $params['password'] . '@' : '')
                . $v . ($params['port'] ? ':' . $params['port'] : '');
        }

        $link = implode(',', $linkConfig);

        $database = $params['database'];
        $model = (new \MongoDB\Client($link))->$database;

        return $model->$collection;

    }

    /**
     * Pass methods onto the default Redis connection.
     *
     * @param  string $method
     * @param  array $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return $this->collection()->{$method}(...$parameters);
    }
}