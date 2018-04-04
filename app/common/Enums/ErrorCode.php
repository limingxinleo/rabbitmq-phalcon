<?php
// +----------------------------------------------------------------------
// | ErrorCode.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Common\Enums;

use Xin\Phalcon\Enum\Enum;

class ErrorCode extends Enum
{
    /**
     * @Message('系统错误')
     */
    public static $ENUM_SYSTEM_ERROR = 400;

    /**
     * @Message('RabbitMQ 配置有误')
     */
    public static $ENUM_RABBIT_MQ_CONFIG_ERROR = 500;

    /**
     * @Message('RabbitMQ 发布者queue必填')
     */
    public static $ENUM_RABBIT_MQ_PUBLISHER_QUEUE_NOT_EXIST = 501;

    /**
     * @Message('RabbitMQ 发布者exchange必填')
     */
    public static $ENUM_RABBIT_MQ_PUBLISHER_EXCHANGE_NOT_EXIST = 502;

    /**
     * @Message('RabbitMQ 消费者queue必填')
     */
    public static $ENUM_RABBIT_MQ_CONSUMER_QUEUE_NOT_EXIST = 503;

    /**
     * @Message('RabbitMQ 消费者exchange必填')
     */
    public static $ENUM_RABBIT_MQ_CONSUMER_EXCHANGE_NOT_EXIST = 504;

    /**
     * @Message('RabbitMQ 消费者tag必填')
     */
    public static $ENUM_RABBIT_MQ_CONSUMER_TAG_NOT_EXIST = 505;
}
