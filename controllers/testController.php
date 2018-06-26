<?php
/**
 * Created by PhpStorm.
 * User: Atanas Kurtakov
 * Date: 20.6.2018 г.
 * Time: 14:09
 */

require_once "../libs/Init.php";
Init::_init(true);

use libs\Db;

//$postData = json_decode(file_get_contents("php://input"), true);

//print_r((serialize($postData["hidden"])));
$conn = (new Db())->getConn();
if($_SERVER["REQUEST_METHOD"]=="GET"){
    $params = array();
    parse_str($_SERVER['QUERY_STRING'], $params);
    $stmnt=$conn->prepare("SELECT * FROM `test` WHERE templateId = ?");
    $result = $stmnt->execute([$params["templateId"]]);
    $tests = $stmnt->fetchAll();
    echo json_encode($tests);
}

if($_SERVER["REQUEST_METHOD"]=="POST") {
    $postData = json_decode(file_get_contents("php://input"), true);
    $stmnt = $conn->prepare("UPDATE `test` SET `mark` = ? WHERE `test`.`test_id` = ?;");
    $stmnt->execute([$postData["mark"],$postData["test_id"]]);
}
