<?php
namespace App\Lib\Pool;

use EasySwoole\Pool\ObjectInterface;
use Swoole\Coroutine\Redis;

class RedisObject extends Redis implements ObjectInterface
{
    function gc()
    {
        // TODO: Implement gc() method.
        $this->close();
    }

    function objectRestore()
    {
        // TODO: Implement objectRestore() method.
    }

    function beforeUse(): bool
    {
        // TODO: Implement beforeUse() method.
        return true;
    }
}