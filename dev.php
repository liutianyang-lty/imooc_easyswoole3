<?php
return [
    'SERVER_NAME' => "EasySwoole",
    'MAIN_SERVER' => [
        'LISTEN_ADDRESS' => '0.0.0.0',
        'PORT' => 9501,
        'SERVER_TYPE' => EASYSWOOLE_WEB_SERVER, //可选为 EASYSWOOLE_SERVER  EASYSWOOLE_WEB_SERVER EASYSWOOLE_WEB_SOCKET_SERVER,EASYSWOOLE_REDIS_SERVER
        'SOCK_TYPE' => SWOOLE_TCP,
        'RUN_MODEL' => SWOOLE_PROCESS,
        'SETTING' => [
            'worker_num' => 8,
            'reload_async' => true,
            'max_wait_time'=>3
        ],
        'TASK'=>[
            'workerNum'=>4,
            'maxRunningNum'=>128,
            'timeout'=>15
        ]
    ],
    'TEMP_DIR' => null,
    'LOG_DIR' => null,
    'CONSOLE'=>[
        'ENABLE'=>true,
        'LISTEN_ADDRESS'=>'127.0.0.1',
        'HOST'=>'127.0.0.1',
        'PORT'=>8501,
        'EXPIRE'=>'120',
        'AUTH'=>null,
        'PUSH_LOG'=>true
    ],
    'mysql' => [
        'host' => '127.0.0.1',
        'port' => '3306',
        'user' => 'root',
        'password' => 'root',
        'database' => 'imooc_video',
        'timeout' => 15,
        'charset' => 'utf8',
    ],
    //fast-cache配置
    'FAST_CACHE' => [
        'PROCESS_NUM' => 1
    ],
];
