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
        $dsn ='mysql:host='.$this->_config['hostname'].';dbname='.$this->_config['database'];
        //实例化PDO，建立数据库连接
        try{
            $this->_pdo = new \PDO($dsn,$this->_config['username'],$this->_config['password']);
        } catch(\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function query($sql = '')
    {
        $res = $this->_pdo->query($sql);
        return $res;
    }
    public function getAll($sql = '')
    {
        $res = $this->query($sql);
        $all = $res->fetchAll();
        return $all;
    }

    public function getRow($sql = '')
    {
        $res = $this->query($sql);
        $row = $res->fetch();

        return $row;
    }

}


