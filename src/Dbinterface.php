<?php
/**
 * Created by PhpStorm.
 * User: lulu
 * Date: 2016/5/24
 * Time: 15:26
 */
namespace Lulu;

// 声明接口
interface Dbinterface
{
    /*
    |------------------------------------------
    |执行sql
    |返回true / false
    |------------------------------------------
    */
    public function query($sql);

    /*
    |------------------------------------------
    |执行sql
    |返回结果集
    |------------------------------------------
    */
    public function getAll($sql);

    /*
    |------------------------------------------
    |执行sql
    |返回结果集
    |------------------------------------------
    */
    public function getRow($sql);
}


