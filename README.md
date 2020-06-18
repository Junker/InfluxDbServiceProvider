# InfluxDbServiceProvider
InfluxDb Service Provider for Silex

## Requirements
- Silex 2.x
- InfluxDB client library for PHP

## Installation
The best way to install InfluxDbServiceProvider is to use a [Composer](https://getcomposer.org/download):

    composer require junker/influxdb-service-provider

## Examples

```php
use Junker\Silex\Provider\InfluxDbServiceProvider;

$app->register(new InfluxDbServiceProvider(), [
    'influxdb.host' => 'localhost', //optional. default: localhost
    'influxdb.port' => 8086, //optional. default: 8086 or 4444 for udp
    'influxdb.database' => 'stat',
    'influxdb.username' => 'username', //optional
    'influxdb.password' => 'password' //optional
    'influxdb.ssl' => true, //optional. default: false
    'influxdb.verifyssl' => true, //optional. default: false
    'influxdb.timeout' => 10, //optional. default: 0
    'influxdb.driver' => 'udp' //optional
]);

$app['influxdb']->query('select * from test_metric LIMIT 5');

$app['influxdb.client']->selectDB('influx_test_db');

```

## Documentation

[InfluxDB client library for PHP](https://github.com/influxdata/influxdb-php)
