<?php
/**
 * Created by PhpStorm.
 * User: lulu
 * Date: 2016/5/24
 * Time: 15:27
 */

namespace Lulu\db;

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

    private function doSQL($sql = '')
    {
        $this->connect();
        //marktme
        $res = $this->_pdo->query($sql);
        return  $res;
    }
    public function query($sql = '')
    {
        //结束对象资源：
       // $this->disConnect();
        //返回一个PDOstatement对象
        return $this->doSQL($sql);
    }
    public function getAll($sql = '')
    {
        $res = $this->doSQL($sql);
        //fetchAll()从一个结果集中取得数据，然后放于关联数组中。
        $all = $res->fetchAll();
        return $all;
    }

    public function getRow($sql = '')
    {
        $res = $this->doSQL($sql);
        //fetch()获取数据存取为一个对象
        $row = $res->fetch();
        return $row;
    }

    public function getCol($sql)
    {
        $res=$this->doSQL($sql);
        $col=array();
        while(1)
        {
            $row=$res->fetchColumn();
            if($row===FALSE) {
                break;
            }
            else {
                echo "count";
                $col[]=$row;
            }
        }
        return $col;



    }
    public function getMap($sql)
    {
        $res=$this->doSQL($sql);
        $res->setFetchMode(\PDO::FETCH_ASSOC);
        $map = $res->fetchAll();
        return $map;

    }

    public function getOne($sql)
    {
        $res = $this->doSQL($sql);
        $one=$res->fetch();
        return array_shift($one);

    }

    public function close()
    {
        $this->_pdo = null;
    }

}


