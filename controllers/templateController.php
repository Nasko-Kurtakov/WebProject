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
//print_r($postData);

//print_r((serialize($postData["hidden"])));

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

    $stmnt = $conn->prepare("INSERT INTO template (hidden, visible, name, question_num) VALUES (?, ?, ?, ?)");
    $stmnt->execute([serialize($postData["hidden"]), serialize($postData["visible"]), $postData["name"],$postData["numOfQuestions"]]);
}

if($_SERVER["REQUEST_METHOD"]=="GET"){
    $params = array();
    parse_str($_SERVER['QUERY_STRING'], $params);
    if(isset($params["id"])) {
//        SELECT `id`,`hidden`,`visible`,`template`.`name`,`question_num` FROM `template` INNER JOIN test ON `template`.`id`=`test`.`templateId` WHERE `test`.`assigned_to` = 2
        $stmnt = $conn->prepare("SELECT * FROM `template` WHERE id = ?");
        $result = $stmnt->execute([$params["id"]]);
        $template = $stmnt->fetch();
        if(!!$template) {
            $template["hidden"] = unserialize($template["hidden"]);
            $template["visible"] = unserialize($template["visible"]);
            echo json_encode($template);
        }
        else{
            echo "Failed getting template with id:".$params["id"];
        }
    }else{
        $stmnt = $conn->prepare("SELECT * FROM `template`");
        $result = $stmnt->execute();
        $templates = $stmnt->fetchAll();
        foreach ($templates as &$template){
            $template["hidden"] = unserialize($template["hidden"]);
            $template["visible"] = unserialize($template["visible"]);
        }
        unset($template);
        echo json_encode($templates);
    }
}