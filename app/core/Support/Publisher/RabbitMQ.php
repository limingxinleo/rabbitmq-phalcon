<?php
// +----------------------------------------------------------------------
// | RabbitMQ.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Core\Support\Publisher;

use App\Common\Enums\ErrorCode;
use App\Common\Exceptions\BizException;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

abstract class RabbitMQ
{
    public $exchange;

    public $queue;

    public $channel;

    protected static $_instances = [];

    public function __construct()
    {
        if (!isset($this->exchange)) {
            throw new BizException(ErrorCode::$ENUM_RABBIT_MQ_PUBLISHER_EXCHANGE_NOT_EXIST);
        }

        if (!isset($this->queue)) {
            throw new BizException(ErrorCode::$ENUM_RABBIT_MQ_PUBLISHER_QUEUE_NOT_EXIST);
        }

        /** @var AMQPStreamConnection $connect */
        $connect = di('rabbitMQ');
        $channel = $connect->channel();

        $channel->queue_declare($this->queue, false, true, false, false);

        $channel->exchange_declare($this->exchange, 'direct', false, true, false);
        $channel->queue_bind($this->queue, $this->exchange);

        $this->channel = $channel;
    }

    public static function getInstance()
    {
        $key = get_class();

        if (isset(static::$_instances[$key]) && static::$_instances[$key] instanceof static) {
            return static::$_instances[$key];
        }

        $client = new static();
        return static::$_instances[$key] = $client;
    }

    public function basicPublish(array $data)
    {
        $body = json_encode($data);
        $message = new AMQPMessage($body, [
            'content_type' => 'text/plain',
            'delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT
        ]);

        return $this->channel->basic_publish($message, $this->exchange);
    }

    public function close()
    {
        $this->channel->close();
    }
}