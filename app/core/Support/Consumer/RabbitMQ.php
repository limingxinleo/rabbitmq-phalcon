<?php
// +----------------------------------------------------------------------
// | RabbitMQ.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Core\Support\Consumer;

use App\Common\Enums\ErrorCode;
use App\Common\Exceptions\BizException;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

abstract class RabbitMQ
{
    public $exchange;

    public $queue;

    public $tag;

    public $channel;

    public $exchangeType = 'direct';

    protected static $_instances = [];

    public function __construct()
    {
        if (!isset($this->exchange)) {
            throw new BizException(ErrorCode::$ENUM_RABBIT_MQ_CONSUMER_EXCHANGE_NOT_EXIST);
        }

        if (!isset($this->queue)) {
            throw new BizException(ErrorCode::$ENUM_RABBIT_MQ_CONSUMER_QUEUE_NOT_EXIST);
        }

        if (!isset($this->tag)) {
            throw new BizException(ErrorCode::$ENUM_RABBIT_MQ_CONSUMER_TAG_NOT_EXIST);
        }

        /** @var AMQPStreamConnection $connect */
        $connect = di('rabbitMQ');
        $channel = $connect->channel();

        $channel->queue_declare($this->queue, false, true, false, false);

        $channel->exchange_declare($this->exchange, $this->exchangeType, false, true, false);
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

    public function basicConsume()
    {
        $this->channel->basic_consume($this->queue, $this->tag, false, false, false, false, function ($message) {
            try {
                $data = json_decode($message->body, true);
                $this->handle($data);
                $message->delivery_info['channel']->basic_ack($message->delivery_info['delivery_tag']);
            } catch (\Exception $ex) {
                $logger = di('logger')->getLogger('rabbit-consumer');
                $msg = $ex->getMessage() . ' code:' . $ex->getCode() . ' in ' . $ex->getFile() . ' line ' . $ex->getLine() . PHP_EOL . $ex->getTraceAsString();
                $logger->error($msg);
            }
        });

        // Loop as long as the channel has callbacks registered
        while (count($this->channel->callbacks)) {
            $this->channel->wait();
        }
    }

    abstract public function handle(array $data);

    public function close()
    {
        $this->channel->close();
    }
}