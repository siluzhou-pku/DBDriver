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
        //$this->querylog($timeend-$timestart,$sql);
        return  $res;
    }
    private function querylog(
        $actiontime='',
        $action=''
    )
    {
        if($this->log==null) {
            $log = new Logger('log');
            $log->pushHandler(new StreamHandler(dirname(dirname(__DIR__)) . '/log/dblog.log', Logger::INFO));
        }
        $log->info($action,array("actiontime"=>$actiontime));
        return true;
    }
    private function connect()
    {
        $dsn ='mysql:host='.$this->_config['hostname'].';dbname='.$this->_config['database'];
        try{
            $this->_pdo = new \PDO($dsn,$this->_config['username'],$this->_config['password'],array(\PDO::ATTR_PERSISTENT => $this->_config['pconnect']));
        } catch(\Exception $e) {
            echo $e->getMessage();
        }
        return true;
    }



    public function query($sql = '')
    {
        return $this->doSQL($sql);
    }
    public function getAll($sql = '')
    {
        $res = $this->doSQL($sql);
        if($res===false) {
            $all=array();
        } else {
            $res->setFetchMode(\PDO::FETCH_ASSOC);
            $all = $res->fetchAll();
        }
        return $all;
    }

    public function getRow($sql = '')
    {
        $res = $this->doSQL($sql);
        if($res===false) {
            $row=array();
        } else {
            $res->setFetchMode(\PDO::FETCH_ASSOC);
            $row = $res->fetch();
            if($row===false)
                $row=array();
        }
        return $row;
    }

    public function getCol($sql='')
    {
        $res=$this->doSQL($sql);
        if($res===false) {
            $col=array();
        } else {
            $res->setFetchMode(\PDO::FETCH_ASSOC);
            $col=$res->fetchAll(\PDO::FETCH_COLUMN);
        }
        return $col;
    }

    public function getMap($sql='')
    {
        $res=$this->doSQL($sql);
        if($res==false) {
            $map=array();
        } else {
            $map=array();
            $res->setFetchMode(\PDO::FETCH_NUM);
            $res=$res->fetchAll();
            if(count($res[0])>=2) {
                for($i=0;$i<count($res,0);$i++)
                    $map[$res[$i][0]]=$res[$i][1];
            }
        }

        return $map;

    }

    public function getOne($sql='')
    {
        $res = $this->doSQL($sql);
        if($res===false){
            $one=NULL;
        } else {
            $res->setFetchMode(\PDO::FETCH_ASSOC);
            $one=$res->fetchColumn();//fetchAll(\PDO::。。。;查询直接得到值
            if($one===false)
                $one=NULL;
        }

        return $one;

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


