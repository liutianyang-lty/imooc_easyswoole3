<?php
namespace App\HttpController\Api;

use App\Lib\Pool\MysqlPool;
use EasySwoole\Component\Pool\PoolManager;

class Pool extends Base
{
    public function mysqlDemo()
    {
        $config = \Yaconf::get('mysql');
        $db = PoolManager::getInstance()->getPool(MysqlPool::class)->getObj($config['POOL_MAX_NUM']);
        $result = ($db->get('video'));
        return $this->writeJson(200, 'Ok', $result);
    }
}