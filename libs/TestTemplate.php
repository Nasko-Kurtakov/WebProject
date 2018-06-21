<?php
/**
 * Created by PhpStorm.
 * User: nasko
 * Date: 21.06.18
 * Time: 1:08
 */

namespace libs;
use libs\Db;

class TestTemplate
{
    private $hiddenAreas=[];
    private $visibleAreas=[];
    private $id;

    public function __construct(array $hidden,array $visible)
    {
        $this->hiddenAreas = $hidden;
        $this->visibleAreas = $visible;
    }

    public function saveTemplate(){
        $conn = (new Db())->getConn();

        //prepare statement for uploading a new row in the database
//        $conn->prepare("");

        //return templateId that is taken from the database;
        $this->id = 420;
        return $this->id;
    }

    public function updateTemplate(array $hidden,array $visible){
        $conn = (new Db())->getConn();

        //update row with id -> $this->id;
    }
}