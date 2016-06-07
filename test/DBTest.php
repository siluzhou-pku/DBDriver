<?php
/**
 * Created by PhpStorm.
 * User: Zhousilu
 * Date: 2016/6/5
 * Time: 22:20
 */


class DBTest extends PHPUnit_Framework_TestCase
{
    private $config = [
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
    public function testGetOne()
    {
        $db=new Db($this->config);
        $sql="select truename from user where userId=1 ";
        $this->assertEquals("4324", $db->getOne($sql));

    }
}

