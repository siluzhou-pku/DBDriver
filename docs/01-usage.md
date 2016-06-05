# Using DBDriver

本文档将提供DBDriver的详细使用方法以及相应的使用结果。以lut数据库中的user为例
![](http://i.imgur.com/JMEJyPw.png)

## Before Usage
	include("../vendor/autoload.php");

configs信息：

```
$config = [
    'hostname'      => '127.0.0.1',         //服务器地址
    'port'          => '3306',              //端口
    'username'      => 'root',              //用户名
    'password'      => 'root',              //密码
    'database'      => 'lut',                //数据库名
    'charset'       => 'utf8',              //字符集设置
    'pconnect'      => 1,                   //1  长连接模式 0  短连接
    'quiet'         => 0,                   //安静模式 生产环境的
    'slowquery'     => 1,                   //对慢查询记录
];
```

## Basic Usage

### 实例化一个数据驱动：
	$db = new Lulu\db\db($config);

### getAll
```
$sql = "select cr from user WHERE userId<3";
$res = $db->getAll($sql);
```
getAll函数以二维数组的形式返回sql语句读取的所有值

![](http://i.imgur.com/PxilhES.png)

### getRow

```
$sql = "select * from user ";
$res = $db->getRow($sql);
```
getRow函数以一维数组的形式返回sql语句读取的所有值的第一行

![](http://i.imgur.com/rKepIbA.png)

### getCol
```
$sql = "select login from user ";
$res = $db->getCol($sql);
```
getCol函数以一维数组的形式返回sql语句读取的所有值的第一列

![](http://i.imgur.com/NlN2ljM.png)

### getMap
```
$sql = "select login,password from user ";
$res = $db->getMap($sql);
```
getMap函数以一维数组的形式返回sql语句读取所有值的前两列映射

![](http://i.imgur.com/6YCFKTc.png)

### getOne
```
$sql = "select truename from user where userId=1 ";
$res = $db->getOne($sql);
```
getOne函数以数值的形式返回sql语句读取值的第一个数

![](http://i.imgur.com/sSohJw9.png)