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
$sql = "select login,password from user";
$res = $db->getMap($sql);
echo "<pre>";
print_r($res);
$sql2="CREATE TABLE IF NOT EXISTS million (
userId INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
login VARCHAR(32) NOT NULL,
password VARCHAR(32) NOT NULL,
email VARCHAR(64) DEFAULT NULL,
mobile VARCHAR(64) DEFAULT NULL,
accessToken VARCHAR(64) NOT NULL DEFAULT 'accessToken',
createAt TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
updateAt int(11) DEFAULT NULL,
trueName VARCHAR(128) DEFAULT NULL,
birthday VARCHAR(128) DEFAULT NULL,
gender VARCHAR(128) DEFAULT NULL,
signer VARCHAR(128) DEFAULT NULL,
zone VARCHAR(128) DEFAULT NULL,
addr VARCHAR(128) DEFAULT NULL,
gravatar VARCHAR(128) DEFAULT NULL,
height VARCHAR(16) DEFAULT NULL,
active int(11) NOT NULL DEFAULT 0,
sort int(11) NOT NULL DEFAULT 0,
des VARCHAR(128) DEFAULT NULL
)";
$db->create($sql2);
$len=[8,16,20,11,10,8,1,8,8,28,8,3,8];
$type=['c','c','c','i','c','i','i','c','c','c','c','i','c'];
$colname=['login','password','email','mobile','trueName','birthday','gender','signer','zone','addr','gravatar','height','des'];