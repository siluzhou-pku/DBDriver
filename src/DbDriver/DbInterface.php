<?php
/**
 * Dbdriver Interface
 * @author Silu Zhou <siluzhou_pku@163.com>
 * @version 1.0
 * @Date: 2016/5/24
 * @Time: 15:26
 */
namespace Lulu\DbDriver;

// 声明接口
interface DbInterface
{


    /**
    *execute SQL statements
    */
    public function query($sql);
    /**
    *execute SQL statements
    */
    public function getAll($sql);

    /**
     *execute SQL statements
     */
    public function getRow($sql);
    /**
     *execute SQL statements
     */
    public function getCol($sql);
    /**
     *execute SQL statements
     */
    public function getMap($sql);
    /**
     *execute SQL statements
     */
    public function getOne($sql);

    /**
     *close database
     */
    public function close();
}


