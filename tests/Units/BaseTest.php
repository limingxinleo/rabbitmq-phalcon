<?php
// +----------------------------------------------------------------------
// | 基础测试类 [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests\Units;

use Tests\UnitTestCase;

/**
 * Class UnitTest
 */
class BaseTest extends UnitTestCase
{
    public function testBaseCase()
    {
        $this->assertTrue(
            extension_loaded('phalcon')
        );
    }

    public function testRabbitMQConfig()
    {
        $config = di('configCenter')->get('rabbitmq');
        $this->assertEquals($config->host, env('RABBITMQ_HOST'));
        $this->assertEquals($config->port, env('RABBITMQ_PORT'));
        $this->assertEquals($config->pass, env('RABBITMQ_PASS'));
    }
}
