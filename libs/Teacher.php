<?php
/**
 * Created by PhpStorm.
 * User: nasko
 * Date: 19.06.18
 * Time: 23:34
 */

namespace libs;


class Teacher
{
    //id,pass,username,name,usertype
    private $names;
    private $username;
    private $usertype;

    public function __construct(string $names,string $username,string $usertype)
    {
        $this->names = $names;
        $this->username = $username;
        $this->usertype = $usertype;
    }

    public function toString(){
        $arr=array();
        $arr["username"]=$this->username;
        $arr["names"]=$this->names;
        $arr["usertype"]=$this->usertype;
        return $arr;
    }
}