<?php
/**
 * Created by PhpStorm.
 * User: lulu
 * Date: 2016/5/24
 * Time: 18:40
 */
header("Content-type: text/html; charset=utf-8");//解决中文显示乱码问题
include("../vendor/autoload.php");

echo "<pre>";
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
$db = new Lulu\Db\Db($config);




$sql = "select * from user ";
$res = $db->getAll($sql,'userId');
print_r($res);
/**
 * escaping the field values by using addslashes();
 * @access public
 * @param string/array $string
 * @return string/array
 */
function saddslashes($string) {
    if(is_array($string)) {
        foreach($string as $key => $val) {
            $string[$key] = addslashes($val);
        }
    } else {
        $string = addslashes($string);
    }
    return $string;
}
/*$res = $db->insert('user',[
    'login'     => 'select',
    'nickName'  => 'x7x658',
    'password'  => '12345678',
    'email'     => 'shampeak@sina.com',
    'mobile'    => '13811069199',
]);*/

//print_r($res);
//$sql = "select login,password from million";
//$res = $db->getMap($sql,'userId');
/*$sql = "select truename from user where userId=1 ";
$res = $db->getOne($sql);


print_r($res);
$sql = "select * from user ";
$res = $db->getMap($sql);
print_r($res);
/*

/*print_r($res);
/*
$i=0;
echo "<pre>";
$cou=count($res);
$time1=microtime(TRUE);
for($i=0;$i<$cou;$i++)
{
    //$a1=$res[$i];
    //$res[$i]=$res[$i]." ";
}
$time2=microtime(TRUE);
while(list($key,$value)=each($res))
{
   // $a2=$res[$key];
 $res[$key]=$res[$key]." ";
}

$time3=microtime(TRUE);
foreach($res as $key=>$value)
{
//    $a3=$res[$key];
  $res[$key]=$value." ";
}
$time4=microtime(TRUE);

echo $time2-$time1."<br />";
echo $time3-$time2."<br />";
echo $time4-$time3."<br />";
*/
/*
$res = $db->update('user',[
    'login'     => '1234',
    'nickName'  => '1',
    'password'  => '2',
    'email'     => 'shampeak@sina.com',
    'mobile'    => '13811069199',
],'user = 3077');
print_r($res);
/*$res = $db->insert('user',[
    'login'     => 'select',
    'nickName'  => 'x7x\658',
    'password'  => '12345678',
    'email'     => 'sha"m"peak@sina.com',
    'mobile'    => '13811069199',
]);




echo $db->queryCount();
echo "   ".$db->lastInsert();
/*

echo "<pre>";

$table="user";
$where="userId=4";
$res=$db->delete($table,$where);
echo "<pre>";


$sql = "select login from user ";
$res = $db->getCol($sql);
//print_r($res);



//print_r($res);



//usleep(1000);




/*$sql = "select login from million WHERE userId>9930 && userId<779940 ";
$res = $db->getCol($sql);


usleep(1000);



$db->close();




*/