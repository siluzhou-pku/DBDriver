# DBDriver



## 要点

- Simple API
- Composer ready, [PSR-2][] and [PSR-4][] compliant
- Fully documented
- Demo


## 系统需求

You need:

- **PHP >= 5.4** , but the latest stable version of PHP is recommended

## Dbinterface接口

- public function query($sql);

> 执行sql
> 
> select语句返回对象，其余语句返回true / false,

- public function connect();    

> 实例化PDO，建立数据库连接

- public function create($sql);    
> 执行sql,建立表格
> 
> 返回true / false

- public function insert($sql);

> 执行sql,插入数据
> 
> 返回true / false
    
- public function getAll($sql);
> 执行sql
> 
> 以数组形式返回所有的结果

- public function getRow($sql);    
> 执行sql
> 以数组形式返回一行结果集
    
- public function getCol($sql);
> 执行sql，以数组形式返回一列结果

- public function getMap($sql);   
> 执行sql，以数组形式返回两列数据的映射

    
- public function getOne($sql);
> 执行sql，返回一个结果

- public function close();
> 关闭连接

## db类
使用Dbinterface接口，实现接口中指定的方法。

- public function __construct($config = array())

> 构造函数，初始化$config;

- public function_destruct()

> 析构函数

- public function insertRand($count,$tablename,    $colname,  $type, $len)

> 随机在表格中插入数据的函数，随机在表格中插入数据
> 输入：
> - $count：插入数据条数
> - $tablename:插入表名
> - $colname 每一项名字
> - $type数组记录每一列数据类型
> - $len数组记录每一列数据长度

-  public function createRand( $len,  $type)

> 产生随机数的函数，产生字符串/数字类型的，长度为len的随机数

## 许可协议

本系统采用 MIT 许可协议(MIT)
