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
    private $db;
    function setUp()
    {
        $this->db=new Lulu\Db\Db($this->config);
        //初始化时需要drop与source user数据库
        //drop掉数据库
        //$sql="Drop  Table user";
        //$this->db->query($sql);
        //$sql="source user.sql";
        //$this->db->query($sql);
    }





    public function testGetOne()
    {
        $sql="select truename from user where userId=1 ";
        $this->assertEquals("4324", $this->db->getOne($sql));
    }
    public function testGetMap()
    {
        $expectedres=[
            '1ew234' => '12345678',
            '13673764379' => '25F9E794323B453885F5181F1B624D0B',
            '13552099798' => 'E10ADC3949BA59ABBE56E057F20F883E',
            'irones' => '12345678'
        ];
        $sql = "select login,password from user WHERE userId<10";
        $res = $this->db->getMap($sql);
        $this->assertEquals($expectedres,$res);
    }
    public function testGetAll()
    {
        $sql = "select * from user ";
        $res = $this->db->getAll($sql,'login');
        $this->assertArrayHasKey('1ew234', $res);
    }

    public function testGetRow()
    {
        $sql = "select * from user ";
        $res = $this->db->getRow($sql);
        $this->assertContains('http://api.so/U/v/201603/11/0a05b10f77d53c0a6cd36068a19da630.txt', $res);
    }
    public function testGetCol()
    {
        $sql = "select login from user ";
        $res = $this->db->getCol($sql);
        $this->assertCount(53, $res);
    }

   public function testInsert()
    {
        $res = $this->db->insert('user',[
            'login'     => 'select',
            'nickName'  => 'x7x658',
            'password'  => '12345678',
            'email'     => 'shampeak@sina.com',
            'mobile'    => '13811069199',
        ]);
        $this->assertNotEquals(false,$res);
    }
    public function testUpdate()
    {
        $res = $this->db->update('user',[
            'login'     => '1234',
            'nickName'  => '1',
            'password'  => '2',
            'email'     => 'shampeak@sina.com',
            'mobile'    => '13811069199',
        ],'userId = 30');
        $this->assertNotEquals(false,$res);
    }
   public function testDelete()
   {
       $res=$this->db->delete('user','userId>60');
       $this->assertNotEquals(false,$res);
   }




}

