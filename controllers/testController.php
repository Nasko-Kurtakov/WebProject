<?php
/**
 * Created by PhpStorm.
 * User: Atanas Kurtakov
 * Date: 20.6.2018 г.
 * Time: 14:09
 */

require_once "../libs/Init.php";
Init::_init(true);
//require_once "../libs/Db.php";
use libs\Db;
use libs\MailSender;

$conn = (new Db())->getConn();
if($_SERVER["REQUEST_METHOD"]=="GET"){
    $params = array();
    parse_str($_SERVER['QUERY_STRING'], $params);
    $stmnt=$conn->prepare("SELECT * FROM `test` WHERE templateId = ?");
    $result = $stmnt->execute([$params["templateId"]]);
    $tests = $stmnt->fetchAll();
    echo json_encode($tests);
}

//function sendEmailForNewAssignedTest($user){
//    $to = $user["email"];
//    $subject = "[Tesify] Нов тест за оценка";
//    $content = "Здравейте, ".$user["name"]." имате назначен тест, който трябва да оцените.\n Моля влезте в системата Testify, за да го направите.\n Поздрави,\n Tesify";
//    $headers = "From: testify@fmi.com" . "\r\n";
//    mail($to,$subject,$content,$headers);
//}

if($_SERVER["REQUEST_METHOD"]=="POST") {
    $postData = json_decode(file_get_contents("php://input"), true);
    if(isset($postData["users"])){
        $usersIds = $postData["users"];
        $stmnt=$conn->prepare("SELECT * FROM `test` WHERE `templateId` = ?");
        $result = $stmnt->execute([$postData["templateId"]]);
        $tests = $stmnt->fetchAll();

        shuffle($usersIds);
        $mailer = new MailSender();
        foreach ($usersIds as $userId){
            $test = array_pop($tests);
            if($test !== NULL){
                $stmnt = $conn->prepare("UPDATE `test` SET `assigned_to` = ? WHERE `test_id` = ?");
                $stmnt->execute([$userId,$test["test_id"]]);
                //send e-mail
                $stmnt = $conn->prepare("SELECT `name`,`email` FROM `user` WHERE `user_id` = ?");
                $stmnt->execute([$userId]);
                $user = $stmnt->fetch();
                $mailer->sendEmailForNewAssignedTest($user["name"],$user["email"]);
            }
        }
    }
    if(isset($postData["mark"])){
        $stmnt = $conn->prepare("UPDATE `test` SET `mark` = ?,`correct_answers` = ?,`comments` = ? WHERE `test_id` = ?");
        $stmnt->execute([$postData["mark"], $postData["correct_answers"], serialize($postData["comments"]), $postData["test_id"]]);
    }
}
