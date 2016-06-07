<?php
/**
 * DB Driver
 *
 * connect and manage database
 * @author Silu Zhou <siluzhou_pku@163.com>
 * @version 1.0
 * @Date: 2016/5/24
 * @Time: 15:27
 */

namespace Lulu\DbDriver;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

/**
 * Db
 *
 * connect and manage DbInterface by  inheriting interface of DbInterface
 *
 */
class Db implements DbInterface{
    /**
     * config array
     * @access private
     * @var array
     */
    private $_config  = array();    //入口参数

    /**
     * pdo interface
     * @access private
     * @var pdo
     */
    private $_pdo = null;

    /**
     * constructor  {@link $_config}
     */
    public function __construct($config = array()){
        $this->_config = $config;
    }

    /**
     * lower-level function to manipulate database
     * @access private
     * @param string $sql
     * @return boolean
     */
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
    /*private function querylog(
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
    }*/


    /**
     * connect database
     * @access private
     * @return boolean
     */
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


    /**
     * execute SQL statements
     * @access public
     * @param string $sql
     * @return object(PDOStatement)
     */
    public function query($sql = '')
    {
        echo "1";
        var_dump($this->doSQL($sql));
        return $this->doSQL($sql);
    }


    /**
     * execute SQL statements， get all data
     * @access public
     * @param string $sql
     * @return array
     */
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
    /**
     * execute SQL statements， get first row of all data
     * @access public
     * @param string $sql
     * @return array
     */
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

    /**
     * execute SQL statements， get first col of all data
     * @access public
     * @param string $sql
     * @return array
     */
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
    /**
     * execute SQL statements， get the map of first and second cols from all data
     * @access public
     * @param string $sql
     * @return array
     */
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
    /**
     * execute SQL statements， get first one of all data
     * @access public
     * @param string $sql
     * @return int/string
     */
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
    /**
     * close database
     * @access public
     * @return boolean
     */
    public function close()
    {
        $this->_pdo = null;
        return true;
    }
}


