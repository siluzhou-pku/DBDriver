<?php
/**
 * Created by PhpStorm.
 * User: lulu
 * Date: 2016/5/24
 * Time: 15:27
 */

namespace Lulu\db;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class db implements Dbinterface{

    private $_config  = array();
    private $_pdo = null;
    private $log=null;
    public function __construct($config = array()){
        $this->_config = $config;
    }

    private function doSQL($sql = '')
    {
        if ($this->_pdo==null) {
            $this->connect();
        }
        $timestart=microtime(TRUE);
        $res = $this->_pdo->query($sql);
        $timeend=microtime(TRUE);
        //日志
        $this->querylog($timestart,$sql);
        return  $res;
    }
    private function querylog(
        $actiontime,$action
    )
    {

        if($this->log==null) {
            $log = new Logger('log');
            $log->pushHandler(new StreamHandler(dirname(dirname(__DIR__)).'/log/dblog.log', Logger::INFO));
        $log->info($action,array("timestart"=>$timestart,"timeend"=>$timeend,"actiontime"=>$timeend-$timestart));
        return true;
    }
    private function connect()
    {
        $dsn ='mysql:host='.$this->_config['hostname'].';dbname='.$this->_config['database'];
        //实例化PDO，建立数据库连接，当已经连接时不需要再次连接
        try{
            $this->_pdo = new \PDO($dsn,$this->_config['username'],$this->_config['password'],array(\PDO::ATTR_PERSISTENT => $this->_config['pconnect']));
        } catch(\Exception $e) {
            echo $e->getMessage();
        }
        return true;
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
        $col=array();//不需要
       $res->setFetchMode(\PDO::FETCH_ASSOC);

        $col=$res->fetchAll(\PDO::FETCH_COLUMN);
       /* while(1) {
            $row=$res->fetchColumn();
            if($row===FALSE) {//判断放在内部而不是while中，因为如果某一项为NULL时会跳出WHILE，而row到达末尾时返回值为FALSE
                break;
            }
            else {
                $col[]=$row;
            }
        }*/
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
        $res->setFetchMode(\PDO::FETCH_ASSOC);
        $key=$res->fetchAll(\PDO::FETCH_COLUMN);
        $res=$this->doSQL($sql);
        $value=$res->fetchAll(\PDO::FETCH_COLUMN,1);
        $map=array_combine($key, $value);
        //相同key的时候会出错，两次读取效率低
      // $map=$res->fetchAll(\PDO::FETCH_UNIQUE | \PDO::FETCH_ASSOC);
        //
       /*while(1) {
            $row=$res->fetch();
            if($row===FALSE) {//判断放在内部而不是while中，因为如果某一项为NULL时会跳出WHILE，而row到达末尾时返回值为FALSE
                break;
            }
            else {
                $map[$row[0]]=$row[1];
            }
        }*/

        return $map;

    }

    public function getOne($sql)
    {
        $res = $this->doSQL($sql);
        $one=$res->fetch();//fetchAll(\PDO::。。。;查询直接得到值
        return array_shift($one);

    }

    public function close()
    {
        $this->_pdo = null;
        return true;
    }
    public function __destruct()
    {

    }

}


