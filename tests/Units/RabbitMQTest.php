<?php
// +----------------------------------------------------------------------
// | 基础测试类 [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests\Units;

use Tests\Units\Publisher\Test;
use App\Utils\Redis;
use Tests\UnitTestCase;

/**
 * Class UnitTest
 */
class RabbitMQTest extends UnitTestCase
{
    public function testPublishCase()
    {
        $publisher = Test::getInstance();
        $uniqid = uniqid();
        Redis::del('rabbit:consumer:incr');

        $publisher->basicPublish([
            'success' => true,
            'data' => [
                'version' => di('config')->version,
                'uniqid' => $uniqid
            ],
        ]);

        sleep(1);

        $this->assertEquals(true, Redis::get('rabbit:consumer:success'));
        $this->assertEquals(di('config')->version, Redis::get('rabbit:consumer:version'));
        $this->assertEquals($uniqid, Redis::get('rabbit:consumer:uniqid'));
        $this->assertEquals(2, Redis::get('rabbit:consumer:incr'));
    }
}
