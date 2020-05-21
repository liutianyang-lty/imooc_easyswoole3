<?php
namespace App\Model\Pool\Mysql;

use App\Lib\Pool\MysqlObject;
use App\Lib\Pool\MysqlPool;
use EasySwoole\Component\Pool\PoolManager;

class Base
{
    public $db;

    /**
     * 获取mysql连接池
     * Base constructor.
     * @throws \Exception
     */
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

    /**
     * 释放数据库连接
     */
    public function __destruct()
    {
        if ($this->db instanceof MysqlObject) {
            PoolManager::getInstance()->getPool(MysqlPool::class)->recycleObj($this->db);
            // 请注意 此处db是该链接对象的引用 即使操作了回收 仍然能访问
            // 安全起见 请一定记得设置为null 避免再次使用导致不可预知的问题
            $this->db = null;
        }
    }

    /**
     * 使用数据库连接池获取数据
     * @param $id
     * @return array|\EasySwoole\Mysqli\Mysqli|mixed|null
     * @throws \EasySwoole\Mysqli\Exceptions\ConnectFail
     * @throws \EasySwoole\Mysqli\Exceptions\PrepareQueryFail
     * @throws \Throwable
     */
    public function getById($id)
    {
        $id = intval($id);
        if (empty($id)) {
            return [];
        }
        $this->db->where('id', $id);
        $result = $this->db->getOne($this->tableName);
        return $result ?? [];
    }

    /**
     * 通用方法--add()
     * @param $data
     * @return bool|int
     * @throws \EasySwoole\Mysqli\Exceptions\ConnectFail
     * @throws \EasySwoole\Mysqli\Exceptions\PrepareQueryFail
     * @throws \Throwable
     */
    public function add($data)
    {
        if (empty($data) || !is_array($data)) {
            return false;
        }

        $result = $this->db->insert($this->tableName, $data);
        return $result;
    }
}