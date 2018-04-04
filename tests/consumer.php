<?php
// +----------------------------------------------------------------------
// | consumer.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
use Tests\Units\Consumer\Test;

require_once 'TestHelper.php';

$consumer = Test::getInstance();
$consumer->basicConsume();