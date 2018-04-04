<?php
// +----------------------------------------------------------------------
// | Test.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests\Units\Publisher;

use App\Core\Support\Publisher\RabbitMQ;

class Test extends RabbitMQ
{
    public $exchange = 'phalcon-exchange';

    public $queue = 'phalcon-queue';
}