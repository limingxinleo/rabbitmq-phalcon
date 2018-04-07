<?php
// +----------------------------------------------------------------------
// | Test.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests\Units\Consumer;

use App\Core\Support\Consumer\RabbitMQ;
use App\Utils\Log;
use App\Utils\Redis;

class Test extends RabbitMQ
{
    public $exchange = 'phalcon-exchange';

    public $queue = 'phalcon-queue';

    public $tag = 'phalcon-consumer';

    public function handle(array $data)
    {
        Redis::set('rabbit:consumer:success', $data['success']);
        Redis::set('rabbit:consumer:version', $data['data']['version']);
        Redis::set('rabbit:consumer:uniqid', $data['data']['uniqid']);

        Redis::incr('rabbit:consumer:incr');
    }
}