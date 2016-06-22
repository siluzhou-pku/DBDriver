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

namespace Lulu\Db;

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
     * times of accessing database(only write)
     * @access private
     * @var int
     */
    private $querycount=0;

    /**
     * current version of class Db
     * @access private
     * @var string
     */
    private $version = "1.0";

    /**
     * the time threshold to how long the query must run in number of seconds to be considered a "slow query. "
     * defined in $_config
     * @access private
     * @var float
     */
    private $slowquery  = 0;

    /**
     * True to connect database while initialization; otherwise, false
     * defined in $_config
     * @access private
     * @var boolean
     */
    private $pconnect=0;

    /**
     * True to suppress all error or warning messages; otherwise, false
     * defined in $_config
     * @access private
     * @var boolean
     */
    private $quiet=0;


    /**
     * constructor  {@link $_config}
     * @param array $config
     */
    public function __construct($config = array()){
        $this->_config = $config;
        $this->slowquery=$config['slowquery'];
        $this->pconnect=$config['pconnect'];
        $this->quiet=$config['quiet'];
        //如果是长连接，则在初始化的时候就进行连接
        if($this->pconnect) {
            if ($this->_pdo==null) {
                $this->connect();
            }
        }
    }

    /**
     * lower-level function to manipulate database
     * @access private
     * @param string $sql
     * @return boolean
     */
    private function doSQL($sql = '')
    {
        $ST=microtime(true);
        try {
            if ($this->_pdo == null) {
                $this->connect();
            }
            $res = $this->_pdo->query($sql);
            $this->querycount++;
            if($res===false)
                throw new \PDOException($sql);
        }catch(\PDOException $e) {
            //如果不是安静模式的话，抛出异常
            if(!$this->quiet){
                echo "error! ".$e->getMessage()."<br />";
                echo "trace: "."<br />".$e->getTraceAsString()."<br />";
            }

        }
        $ET=microtime(true);
        //记录慢查询
        if($this->slowquery) {
            if($ET-$ST>0.5){
                $str = $sql.' : '.($ET - $ST).' : '.date('Y-m-d H:i:s')."\r\n----------------------------\r\n";
                echo $str."<br />";
            }
        }
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
            $ST=microtime(true);
            $this->_pdo = new \PDO($dsn,$this->_config['username'],$this->_config['password'],array(\PDO::ATTR_PERSISTENT => $this->_config['pconnect']));
            $ET=microtime(true);
        } catch( \PDOException $e) {
            if(!$this->quiet){
                echo $e->getMessage();
            }
        }
        //判断是否为慢查询
        if($this->slowquery) {
            if($ET-$ST>0.5){
                $str = 'CONNECT DATABASE : '.($ET - $ST).' : '.date('Y-m-d H:i:s')."\r\n----------------------------\r\n";
                echo $str."<br />";
            }
        }
        return true;
    }

    /**
     * begin transaction
     */
    public function beginTransaction()
    {
        if($this->_pdo==null)
            $this->connect();
        return $this->_pdo->beginTransaction();

    }
    /**
     * commit transaction
     */
    public function commit()
    {
        if($this->_pdo==null)
            $this->connect();
        return $this->_pdo->commit();

    }


    /**
     * rollback transaction
     */
    public function rollBack()
    {
        if($this->_pdo==null)
            $this->connect();
        return $this->_pdo->rollBack();
    }

    /**
     * return times of accessing database
     */
    public function queryCount()
    {
        return $this->querycount;

    }
    
    /**
     * return the last inserted ID
     */
    public function lastInsert()
    {
        if($this->_pdo===null)
            $res=null;
        else
            $res=$this->_pdo->lastInsertId();
        return   $res;
    }

    /**
     * operate database
     * @param string $sql
     * @return boolean/obj
     */
    public function query($sql)
    {
        $res=$this->doSQL($sql);
        return $res;
    }
    /**
     * execute SQL statements， update data
     * @access public
     * @param string $table
     * @param array $values
     * @param string $where
     * @return boolean/obj
     */
    public function update($table, $values,$where)
    {

        $table=$this->saddslashes($table);
        $values=$this->saddslashes($values);
        $where=$this->saddslashes($where);

        $sql= "show columns from ".$table;
        $tablename=$this->getCol($sql);
        $sql="";
        $num=0;
        foreach($values as $key=>$value) {
            if(in_array($key,$tablename)) {
                if($num==0) {
                    $sql.="`".$key."` = '".$value."'";
                }else {
                    $sql.=", `".$key."` = '".$value."'";
                }
                $num++;
            }
        }
        if($num>0){
            $sql="UPDATE `".$table."` SET "."$sql"." WHERE ".$where;
            $res=$this->doSQL($sql);
        }
        else
            $res=false;

        return $res;
    }

    /**
     * execute SQL statements， insert data
     * @access public
     * @param string $table
     * @param array $values
     * @return boolean/obj
     */
    public function insert($table, $values)
    {

        $table=$this->saddslashes($table);
        $values=$this->saddslashes($values);
        $sql= "show columns from ".$table;
        $tablename=$this->getCol($sql);
        $sql1="";
        $sql2="";
        $num=0;
        foreach($values as $key=>$value) {
            if (in_array($key, $tablename)) {
                if($num==0){
                    $sql1.="`".$key."`";
                    $sql2.="'".$value."'";
                }else{
                    $sql1.=",`".$key."`";
                    $sql2.=",'".$value."'";
                }
                $num++;
            }
        }
        if($num>0){
            $sql="INSERT INTO `".$table."` ( ".$sql1." ) VALUES (".$sql2.")";
            $res=$this->doSQL($sql);
        }
        else
            $res=false;
        return $res;

    }

    /**
     * execute SQL statements， delete data
     * @access public
     * @param string $table
     * @param string $where
     * @return boolean/obj
     */
    public function delete($table,$where)
    {
        $table=$this->saddslashes($table);
        $where=$this->saddslashes($where);
        $sql="DELETE from `".$table."` WHERE ".$where;
        $res=$this->doSQL($sql);
        return $res;

    }


    /**
     * execute SQL statements， get all data
     * @access public
     * @param string $sql
     * @param string $field
     * @return array
     */
    public function getAll($sql = '',$field='')
    {
        $res = $this->doSQL($sql);
        $shift=array();
        if($res===false) {
            $all=array();
        } else {
            $res->setFetchMode(\PDO::FETCH_ASSOC);
            $all = $res->fetchAll();
            if(!empty($field)){
                $count=count($all,0);
                if($count>0) {
                    if(array_key_exists($field, $all[0])) {
                        $keys=array();
                        for($i=0;$i<$count;$i++)
                            $keys[] = $all[$i][$field];
                        for($i=0;$i<$count;$i++)
                            $shift[$keys[$i]]=$all[$i];
                        $all=$shift;
                    } else
                    {
                        $all=array();
                    }
                }
            }
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
        $sql.=' LIMIT 1';//限制只取出一行
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
            //print_r($res);
            if(count($res[0])>=2) {
                $cou=count($res,0);
                for($i=0;$i<$cou;$i++)
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
        $sql.=' LIMIT 1';//限制只取出一个
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

    /**
     * escaping the field values by using addslashes();
     * @access public
     * @param string/array $string
     * @return string/array
     */
    public function saddslashes($string) {
        if(is_array($string)) {
            foreach($string as $key => $val) {
                $string[$key] = addslashes($val);
            }
        } else {
            $string = addslashes($string);
        }
        return $string;
    }

    /**
     * return the current version of class db;
     * @access public
     * @return string
     */
    public function version(){
        return $this->version;
    }



}


