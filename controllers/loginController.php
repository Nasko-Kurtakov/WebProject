<?php
/**
 * Created by PhpStorm.
 * User: nasko
 * Date: 19.06.18
 * Time: 22:37
 */

require_once "../libs/Init.php";
Init::_init(true);

use libs\User;
use libs\Db;

function createUser(string $username,string $password){
    $db = new Db();
    $conn = $db->getConn();

    $smth=$conn->prepare("SELECT * FROM `user` WHERE username = ? AND password = ?");
    $result = $smth->execute([$username, $password]);
    $user = $smth->fetch();

    if($user["user_type"] == "student"){
        createStudent($user["user_id"],$user["name"],$user["username"],$user["user_type"]);
    }
    if($user["user_type"] == "admin"){
        createTeacher($user["user_id"],$user["name"],$user["username"],$user["user_type"]);
    }
}

function createTeacher(int $id,$names, string $username,string $userType){
    $loggedInUser = new User($id,$names,$username,$userType);
    $_SESSION["user"] = $loggedInUser->toString();
    header('Location: ../views/homePageTeacher.php');
}

function createStudent(int $id,$names, string $username,string $userType){
    $loggedInUser = new User($id,$names,$username,$userType);
    $_SESSION["user"] = $loggedInUser->toString();
    header('Location: ../views/homePageStudent.php');
}
createUser($_POST["username"],$_POST["password"]);


//try {
//    $dbHolder->addColumn();
//    echo "ops";
//} catch (Exception $ex) {
//     column is already added
//     попринцип предпочитам да си добавя колоната ръчно
//     не съм сигурен, че да се добавя така е много културно, но
//     щом трябва ей го дей го
//}

//try{
//    $dbHolder->insertDiscipline($_GET["title"], $_GET["lecturer"], $_GET["desc"]);
//    header("Location: ../index.php");
//}catch (Exception $exception){
//    echo "Something went wrong with new discipline creation.";
//}