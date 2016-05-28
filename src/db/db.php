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
    public function create($sql='')
    {
        $this->doSQL($sql);
    }

    public function insert($sql='')
    {
        $this->doSQL($sql);
    }
    public function createRand(
        $len,
        $type)
    {
        $rand='';
        if($type=='c')
            $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        else
            $chars = '0123456789';
        for($i=0;$i<$len;$i++) {
            $rand .= $chars[ mt_rand(0, strlen($chars) - 1) ];
        }
        return $rand;
    }
    /*
    |------------------------------------------
    |随机在表格中插入数据
    /输入： $count：插入数据条数，$tablename:插入表名，$colname 每一项名字，$type数组记录每一列数据类型，$len数组记录每一列数据长度
    |------------------------------------------
    */
    public function insertRand(
        $count,
        $tablename,
        $colname,
        $type,
        $len)
    {
        $t_cou=count($type);
        for($i=0; $i<$count; $i++) {
            if( $i%1000 == 0)
                echo $i." ";
            $sql='';
            $sql.="INSERT INTO ".$tablename." (";
            $sql.=$colname[0];
            for($j=1;$j<$t_cou;$j++)
                $sql.=", ".$colname[$j];
            $sql.=") VALUES (";
            $rand=$this->createRand($len[0],$type[0]);
            if($type[0]=='c')
                $sql.="\"".$rand."\"";
            else
                $sql.=$rand;
            for($j=1;$j<$t_cou;$j++) {
                $rand=$this->createRand($len[$j],$type[$j]);
                if($type[$j]=='c')
                    $sql.=", \"".$rand."\"";
                else
                    $sql.=", ".$rand;
            }
            $sql.=")";

            $this->insert($sql);
        }
    }

    private function doSQL($sql = '')
    {
        $this->connect();
        $timestart=microtime(TRUE);
        $res = $this->_pdo->query($sql);
        $timeend=microtime(TRUE);
        $sql2="INSERT INTO log (action,actionTime) VALUES ("."\"".$sql."\" ,\"".(string)($timeend-$timestart)."\"".")";
        $this->_pdo->query($sql2);
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

}


