<?php

namespace Junker\Silex\Provider;

use Silex\Application;
use Silex\ServiceProviderInterface;
use InfluxDB;

class InfluxDbServiceProvider implements ServiceProviderInterface
{
    const PORT = 8086;
    const HOST = 'localhost';

    public function register(Application $app)
    {
        $app['influxdb'] = $app->share(function (Application $app) {
            return $app['influxdb.client']->selectDB($app['influxdb.database']);
        });

        $app['influxdb.client'] = $app->share(function (Application $app) {
            return new InfluxDB\Client(
                isset($app['influxdb.host']) ? $app['influxdb.host'] : self::HOST,
                isset($app['influxdb.port']) ? $app['influxdb.port'] : self::PORT,
                isset($app['influxdb.username']) ? $app['influxdb.username'] : '',
                isset($app['influxdb.password']) ? $app['influxdb.password'] : ''
            );
        });
    }

    public function boot(Application $app) {

    }
}