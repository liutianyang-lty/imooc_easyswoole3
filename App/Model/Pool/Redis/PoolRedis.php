<?php
namespace App\Model\Pool\Redis;

use App\Lib\Pool\RedisObject;
use App\Lib\Pool\RedisPool;
use EasySwoole\Component\Pool\PoolManager;

/**
 * Redis连接池基础类库封装
 * Class PoolRedis
 * @package App\Model\Pool\Redis
 */
class PoolRedis{
    public $redis;

    /**
     * 创建redis连接池
     * PoolRedis constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $timeout = \Yaconf::get('redis.POOL_TIME_OUT');

        //创建redis连接池
        $redisObj = PoolManager::getInstance()->getPool(RedisPool::class)->getObj($timeout);
        if ($redisObj instanceof RedisObject) {
            $this->redis = $redisObj;
        } else {
            throw new \Exception("Redis Pool error");
        }
    }

    /**
     * 释放redis连接
     */
    public function __destruct()
    {
        if ($this->redis instanceof RedisObject) {
            PoolManager::getInstance()->getPool(RedisPool::class)->recycleObj($this->redis);
            // 请注意 此处redis是该链接对象的引用 即使操作了回收 仍然能访问
            // 安全起见 请一定记得设置为null 避免再次使用导致不可预知的问题
            $this->redis = null;
        }
    }

    /**
     * 自动调用redis方法
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        return $this->redis->$name(...$arguments);
    }
}