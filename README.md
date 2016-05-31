# DBDriver



## Highlights

- Simple API
- Composer ready, [PSR-2][] and [PSR-4][] compliant
- Fully documented
- Demo


## System Requirements

You need:

- **PHP >= 5.4** , but the latest stable version of PHP is recommended
- monolig ~1.7

## Install

Install Lulu\db using Composer.

$ composer require Lulu/db

## Config
```
$config = [
    'hostname'      => '127.0.0.1',         //服务器地址
    'port'          => '3306',              //端口
    'username'      => 'root',              //用户名
    'password'      => 'root',              //密码
    'database'      => 'lut',                //数据库名
    'charset'       => 'utf8',              //字符集设置
    'pconnect'      => 1,                   //1  长连接模式 0  短连接
    'quiet'         => 0,                   //安静模式 生产环境的
    'slowquery'     => 1,                   //对慢查询记录
];
```

## Dbinterface

- public function query($sql);     
- public function getAll($sql);
- public function getRow($sql);      
- public function getCol($sql);
- public function getMap($sql);      
- public function getOne($sql);
- public function close();

## Before USE
    include("../vendor/autoload.php");

## USE
    $db = new Lulu\db\db($config);
    $sql = "select * from million WHERE userId= 999999";
    $res = $db->getRow($sql);
    $sql = "select login,truename from million where userId>10";
    $res = $db->getAll($sql);

## License

本系统采用 MIT 许可协议(MIT)
