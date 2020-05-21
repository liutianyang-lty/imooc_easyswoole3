<?php
namespace App\Model\Pool\Mysql;

use App\Lib\Pool\MysqlObject;
use App\Lib\Pool\MysqlPool;
use EasySwoole\Component\Pool\PoolManager;

class Base
{
    public $db;

    public function __construct()
    {
        $timeout = \Yaconf::get('mysql.POOL_TIME_OUT');

        //获取连接池
        $mysqlObject = PoolManager::getInstance()->getPool(MysqlPool::class)->getObj($timeout);

        //判断类型
        if ($mysqlObject instanceof MysqlObject) {
            $this->db = $mysqlObject;
        } else {
            throw new \Exception("Mysql Pool is error");
        }
    }

    public function __destruct()
    {
        if ($this->db instanceof MysqlObject) {
            PoolManager::getInstance()->getPool(MysqlPool::class)->recycleObj($this->db);
            // 请注意 此处db是该链接对象的引用 即使操作了回收 仍然能访问
            // 安全起见 请一定记得设置为null 避免再次使用导致不可预知的问题
            $this->db = null;
        }
    }
}