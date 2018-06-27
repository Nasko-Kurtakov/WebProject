<?php
/**
 * Created by PhpStorm.
 * User: nasko
 * Date: 19.06.18
 * Time: 23:34
 */

namespace libs;


class User
{
    //id,pass,username,name,usertype
    private $id;
    private $names;
    private $username;
    private $usertype;

    public function __construct(int $id,string $names,string $username,string $usertype)
    {
        $this->id = $id;
        $this->names = $names;
        $this->username = $username;
        $this->usertype = $usertype;
    }

    public function toString(){
        $arr=array();
        $arr["id"]=$this->id;
        $arr["username"]=$this->username;
        $arr["names"]=$this->names;
        $arr["usertype"]=$this->usertype;
        return $arr;
    }

    public function getNames(){
        return $this->names;
    }
}