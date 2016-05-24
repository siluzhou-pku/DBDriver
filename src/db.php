<?php
/**
 * Created by PhpStorm.
 * User: lulu
 * Date: 2016/5/24
 * Time: 15:27
 */

namespace Lulu;
include 'Dbinterface.php';

class db implements Dbinterface{

    private $_config  = array();
    private $_pdo = null;
    public function __construct($config = array()){
        $this->_config = $config;

    }
    public function connect()
    {
        $dsn ='mysql:host='.$this->_config['hostname'].';dbname='.$this->_config['database'];
        //实例化PDO，建立数据库连接
        try{
            $this->_pdo = new \PDO($dsn,$this->_config['username'],$this->_config['password'],array(\PDO::ATTR_PERSISTENT => $this->_config['pconnect']));
        } catch(\Exception $e) {
            echo $e->getMessage();
        }
    }
    public function disConnect()
    {
        $this->_pdo = null;
    }
    public function query($sql = '')
    {
        $this->connect();
        $res = $this->_pdo->query($sql);
        //结束对象资源：
        $this->disConnect();
        //返回一个PDOstatement对象
        return $res;
    }
    public function getAll($sql = '')
    {
        $res = $this->query($sql);
        //fetchAll()从一个结果集中取得数据，然后放于关联数组中。
        $all = $res->fetchAll();
        return $all;
    }

    public function getRow($sql = '')
    {
        $res = $this->query($sql);
        //fetch()获取数据存取为一个对象
        $row = $res->fetch();
        return $row;
    }

}


