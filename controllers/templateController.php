<?php
/**
 * Created by PhpStorm.
 * User: nasko
 * Date: 21.06.18
 * Time: 1:07
 */

require_once "../libs/Init.php";
Init::_init(true);

use libs\Db;

$postData = json_decode(file_get_contents("php://input"), true);
$conn = (new Db())->getConn();



if($_SERVER["REQUEST_METHOD"]=="POST") {

    if (isset($_SESSION["templateId"]) && $_SESSION["templateId"]) {

//    $stmnt = $conn->prepare("INSERT INTO template (testId, hidden, visible, name) VALUES (?, ?, ?, ?)");
//    $stmnt->execute([$postData["testId"],$postData["hidden"],$postData["visible"],$postData["name"]]);
//
//    //prepare statement for uploading a new row in the database
////        $conn->prepare("");
//
//    //return templateId that is taken from the database;
//    $this->id = 420;
//    return $this->id;
    }

    $postData["testId"] = rand(1, 10000);

    $stmnt = $conn->prepare("INSERT INTO template (testId, hidden, visible, name) VALUES (?, ?, ?, ?)");
    $stmnt->execute([$postData["testId"], serialize($postData["hidden"]), serialize($postData["visible"]), $postData["name"]]);
}

if($_SERVER["REQUEST_METHOD"]=="GET"){
    $stmnt=$conn->prepare("SELECT * FROM `template` WHERE ");
}


//print_r($postData);

//$myJSON = json_encode($postData);

//echo $myJSON;