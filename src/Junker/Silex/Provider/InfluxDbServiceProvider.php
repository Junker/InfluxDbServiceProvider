<?php

namespace Junker\Silex\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use InfluxDB;

class InfluxDbServiceProvider implements ServiceProviderInterface
{
    const HOST = 'localhost';
    const HTTP_PORT = 8086;
    const UDP_PORT = 4444;

    public function register(Container $app)
    {
        $app['influxdb'] = function ($app) {
            return $app['influxdb.client']->selectDB($app['influxdb.database']);
        };

        $app['influxdb.client'] = function ($app) {
            $client = new InfluxDB\Client(
                isset($app['influxdb.host']) ? $app['influxdb.host'] : self::HOST,
                isset($app['influxdb.port']) ? $app['influxdb.port'] : self::HTTP_PORT,
                isset($app['influxdb.username']) ? $app['influxdb.username'] : '',
                isset($app['influxdb.password']) ? $app['influxdb.password'] : '',
                isset($app['influxdb.ssl']) ? $app['influxdb.ssl'] : false,
                isset($app['influxdb.verifyssl']) ? $app['influxdb.verifyssl'] : false,
                isset($app['influxdb.timeout']) ? $app['influxdb.timeout'] : 0
            );

            if (isset($app['influxdb.driver']) && $app['influxdb.driver'] == 'udp') {
                $client->setDriver(new \InfluxDB\Driver\UDP($client->getHost(), isset($app['influxdb.port']) ? $app['influxdb.port'] : self::UDP_PORT));
            }

            return $client;
        };
    }
}
