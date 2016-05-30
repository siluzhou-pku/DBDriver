<?php
/**
 * Created by PhpStorm.
 * User: lulu
 * Date: 2016/5/24
 * Time: 18:40
 */
header("Content-type: text/html; charset=utf-8");//解决中文显示乱码问题
include("../vendor/autoload.php");
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
$db = new Lulu\db\db($config);
/*$sql = "select * from million WHERE userId= 999999";
$res = $db->getRow($sql);
*/

/*$sql = "select login,truename from million where userId>10";
$res = $db->getAll($sql);

usleep(1000);
*/

$sql = "select password from million where userId<10";
$res = $db->getCol($sql);
echo "<pre>";
print_r($res);

usleep(1000);

/*
$sql = "select login from million WHERE userId>9930 && userId<779940 ";
$res = $db->getCol($sql);


usleep(1000);

$sql = "select truename from million where userId=799930 ";
$res = $db->getOne($sql);

$db->close();
*/

/*

//新建log表
$sql3="CREATE TABLE IF NOT EXISTS log(
actionId INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
action VARCHAR(128) DEFAULT NULL,
createAt TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
actionTime VARCHAR(128) DEFAULT NULL
)";
$db->create($sql3);*/
