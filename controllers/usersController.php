<?php
/**
 * Created by PhpStorm.
 * User: Atanas Kurtakov
 * Date: 27.6.2018 г.
 * Time: 12:26
 */

require_once "../libs/Init.php";
Init::_init(true);
use libs\Db;
$conn = (new Db())->getConn();
if($_SERVER["REQUEST_METHOD"]=="GET"){
    $params = array();
    parse_str($_SERVER['QUERY_STRING'], $params);
    if(isset($params["students"]) && $params["students"] == true){
        $stmnt=$conn->prepare("SELECT `user_id`, `name`, `user_type`, `user_group` FROM `user` WHERE `user_type` = 'student'");
        $result = $stmnt->execute();
        $users = $stmnt->fetchAll();
        if($users){
            echo json_encode($users);
        }else{
            echo "No users";
        }
    }
}

//if($_SERVER["REQUEST_METHOD"]=="POST") {
//    $postData = json_decode(file_get_contents("php://input"), true);
//    $stmnt = $conn->prepare("UPDATE `test` SET `mark` = ?,`correct_answers` = ?,`comments` = ? WHERE `test_id` = ?");
//    $stmnt->execute([$postData["mark"],$postData["correct_answers"],serialize($postData["comments"]),$postData["test_id"]]);
//}
