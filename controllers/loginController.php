<?php
/**
 * Created by PhpStorm.
 * User: nasko
 * Date: 19.06.18
 * Time: 22:37
 */

require_once "../libs/Init.php";
Init::_init(true);

use libs\Teacher;
use libs\Db;



//echo $_POST["username"];
//echo $_POST["password"];
//var_dump($_POST);

function createUser(string $username,string $password){
    $db = new Db();
    $conn = $db->getConn();

    $smth=$conn->prepare("SELECT * FROM `user` WHERE username = ? AND password = ?");
    $result = $smth->execute([$username, $password]);
    $user = $smth->fetch();

    if($user["user_type"] == "student"){
        createStudent($user["name"],$user["username"],$user["user_type"]);
    }
    if($user["user_type"] == "admin"){
        createTeacher($user["name"],$user["username"],$user["user_type"]);
    }
}

function createTeacher(string $names, string $username,string $userType){
    $loggedInUser = new Teacher($names,$username,$userType);
    $_SESSION["user"] = $loggedInUser->toString();
    header('Location: ../views/homePageTeacher.php');
}

function createStudent(string $username,string $password){

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