<?php
namespace App\HttpController\Api;

use App\Lib\Pool\MysqlPool;
use EasySwoole\Component\Pool\PoolManager;

class Pool extends Base
{
    public function mysqlDemo()
    {
        $config = \Yaconf::get('database');
        $db = PoolManager::getInstance()->getPool(MysqlPool::class)->getObj($config);
        $result = ($db->get('video'));
        return $this->writeJson(200, 'Ok', $result);
    }
}