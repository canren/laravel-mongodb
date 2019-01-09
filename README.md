# 原生mongo扩展laravel，lumen组件


## 配置要求
```
PHP >= 7.0
mongodb extension >= 1.5.0
laravel|lumen >= 5.4
```

## 安装
```
composer require canren/laravel-mongodb
```
laravel 将服务提供者添加到`config/app.php`
```
Canren\Mongodb\MongoServiceProvider::class
```
lumen 将服务提供者添加到`bootstrap/app.php`
```
$app->register(Canren\Mongodb\MongoServiceProvider::class);
```

## 配置方法
在数据库配置`config/database.php`文件中增加配置
```
'mongodb' => [
    'default' => [
        'host' => env('MONGO_DEFAULT_CLIENT', '127.0.0.1'),
        'username' => env('MONGO_DEFAULT_USERNAME'),
        'password' => env('MONGO_DEFAULT_PASSWORD'),
        'port' => env('MONGO_DEFAULT_CLIENT_PORT', 27017),
        'database' => env('MONGO_DEFAULT_TABLE_NAME', 'test'),
    ],
    'xxxx' => ['...']
],
```

## 使用
```
class MyModel {

	// 实例化表
	public $collection;

    public function __construct()
    {
        $this->collection = app('mongo')->connection('default')->collection('myCollection');
    }

}
```

## API
```
app('mongo')->connection('default'); //使用defalut配置的database数据库

app('mongo')->collection('myCollection'); // 使用myCollection数据表

```

mongo api操作相关文档 [library documentation](%5Bdocument%5D%28https://docs.mongodb.com/php-library/current/tutorial/install-php-library/%29)

