# InfluxDbServiceProvider
InfluxDb Service Provider for Silex

## Requirements
- Silex 1.x
- InfluxDB client library for PHP

##Installation
The best way to install InfluxDbServiceProvider is to use a [Composer](https://getcomposer.org/download):

    php composer.phar require junker/influxdb-service-provider

## Examples

```php
use Junker\Silex\Provider\InfluxDbServiceProvider;

$app->register(new InfluxDbServiceProvider(), [
    'influxdb.host' => 'localhost',
    'influxdb.port' => 8086,
    'influxdb.database' => 'stat',
    'influxdb.username' => 'username',
    'influxdb.password' => 'password'
]);

$app['influxdb']->query('select * from test_metric LIMIT 5');

$app['influxdb.client']->selectDB('influx_test_db');

```

## Documentation

[InfluxDB client library for PHP](https://github.com/influxdata/influxdb-php)
