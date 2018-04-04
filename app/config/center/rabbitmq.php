<?php
// +----------------------------------------------------------------------
// | rabbitMQ.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
return [
    'host' => env('RABBITMQ_HOST', 'localhost'),
    'port' => env('RABBITMQ_PORT', 5672),
    'user' => env('RABBITMQ_USER', 'guest'),
    'pass' => env('RABBITMQ_PASS', 'guest'),
    'vhost' => env('RABBITMQ_VHOST', '/'),
    'amqpDebug' => env('RABBITMQ_AMQP_DEBUG', true),
];