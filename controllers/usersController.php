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
use libs\User;

if (isset($_SESSION["user"]) && $_SESSION["user"]) {
    $user = new User($_SESSION["user"]["id"],$_SESSION["user"]["names"], $_SESSION["user"]["username"], $_SESSION["user"]["usertype"]);
}else {
    session_destroy();
    header("../views/login.php");
}

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
