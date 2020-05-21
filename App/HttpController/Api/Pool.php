<?php
namespace App\HttpController\Api;

use App\Lib\Pool\MysqlPool;
use EasySwoole\Pool\Manager;

class Pool extends Base
{
    public function mysqlDemo()
    {
        $config = \Yaconf::get('database');
        $db = Manager::getInstance()->getPool(MysqlPool::class)->getObj($config['POOL_MAX_NUM']);
        $result = ($db->get('video'));
        return $this->writeJson(200, 'Ok', $result);
    }
}