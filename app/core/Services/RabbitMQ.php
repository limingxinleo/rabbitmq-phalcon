<?php
// +----------------------------------------------------------------------
// | RabbitMQ.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Core\Services;

use Phalcon\Config;
use Phalcon\DI\FactoryDefault;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class RabbitMQ implements ServiceProviderInterface
{
    public function register(FactoryDefault $di, Config $config)
    {
        $di->setShared('rabbitMQ', function () use ($di, $config) {
            $config = $di->getShared('configCenter')->get('rabbitmq');
            $connection = new AMQPStreamConnection(
                $config->host,
                $config->port,
                $config->user,
                $config->pass,
                $config->vhost
            );
            return $connection->channel();
        });
    }
}
