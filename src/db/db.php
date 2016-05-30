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
    private function doSQL($sql = '')
    {
        $this->connect();
        $timestart=microtime(TRUE);
        $res = $this->_pdo->query($sql);
        //日志
        $this->querylog($timestart,$sql);

        return  $res;
    }
    private function querylog(
        $actiontime,$action
    )
    {
        $timestart=$actiontime;
        $timeend=microtime(TRUE);
        $sql2="INSERT INTO log (action,actionTime) VALUES ("."\"".$action."\" ,\"".(string)($timeend-$timestart)."\"".")";
        return $this->_pdo->query($sql2);
    }
    private function connect()
    {
        $dsn ='mysql:host='.$this->_config['hostname'].';dbname='.$this->_config['database'];
        //实例化PDO，建立数据库连接，当已经连接时不需要再次连接
        if($this->_pdo==null)
        {
            try{
                $this->_pdo = new \PDO($dsn,$this->_config['username'],$this->_config['password'],array(\PDO::ATTR_PERSISTENT => $this->_config['pconnect']));
            } catch(\Exception $e) {
                echo $e->getMessage();
            }
        }
    }



    public function query($sql = '')
    {
        //返回一个PDOstatement对象或者TRUE or False
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
       // $res->setFetchMode(\PDO::FETCH_ASSOC);

        //$col=$res->fetchAll();
        while(1) {
            $row=$res->fetchColumn();
            if($row===FALSE) {//判断放在内部而不是while中，因为如果某一项为NULL时会跳出WHILE，而row到达末尾时返回值为FALSE
                break;
            }
            else {
                $col[]=$row;
            }
        }
        //虽然代码短，但是括号太多容易出错
        /*while(!(($row=$res->fetchColumn())===FALSE)) {
            $col[]=$row;
        }*/
        return $col;
    }

    public function getMap($sql)
    {
        $res=$this->doSQL($sql);
        $map=array();
       // $res->setFetchMode(\PDO::FETCH_ASSOC);
        //$map=$res->fetchAll();
        //
        while(1) {
            $row=$res->fetch();
            if($row===FALSE) {//判断放在内部而不是while中，因为如果某一项为NULL时会跳出WHILE，而row到达末尾时返回值为FALSE
                break;
            }
            else {
                $map[$row[0]]=$row[1];
            }
        }

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
    public function _destruct()
    {

    }

}


