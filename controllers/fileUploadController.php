<?php
/**
 * Created by PhpStorm.
 * User: nasko
 * Date: 25.06.18
 * Time: 0:41
 */

require_once "../libs/Init.php";
Init::_init(true);
use libs\Db;
use libs\User;
use libs\ImageManipulator;

if (isset($_SESSION["user"]) && $_SESSION["user"]) {
    $user = new User($_SESSION["user"]["id"],$_SESSION["user"]["names"], $_SESSION["user"]["username"], $_SESSION["user"]["usertype"]);
}else {
    session_destroy();
    header("../views/login.php");
}

function makeDirs($dirpath, $mode=0700) {
    if(!is_dir($dirpath)){
        $oldUmask = umask(0);
        mkdir($dirpath,$mode,true);
        umask($oldUmask);
    }
}

$params = array();
parse_str($_SERVER['QUERY_STRING'], $params);

$templateId = $params["tempId"];
$templateName = $params["tempName"];
$assignTo = $user->getId();
$folderName = $templateId."_".$templateName;
$targetDir = "../uploads/".$folderName."/";
makeDirs($targetDir);

function getAreas($templateId) {
    $conn=(new Db())->getConn();
    $stmnt=$conn->prepare("SELECT `hidden`,`visible` FROM `template` WHERE id = ?");
    $result = $stmnt->execute([$templateId]);
    $areasToDraw = $stmnt->fetch();
    return $areasToDraw;
}

function saveImageInDb($templateName,$targetFile,$templateId,$assignTo){
    $conn = (new Db())->getConn();
    $stmnt = $conn->prepare("INSERT INTO `test`(`name`, `dirpath`, `templateId`, `assigned_to`) VALUES (?,?,?,?)");
    $stmnt->execute([$templateName,$targetFile,$templateId,$assignTo]);
}

$uploadOk = 1;
foreach ($_FILES as $file){
    $targetFile = $targetDir . basename($file["name"]);
    $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));
    // Check if file already exists
    if (file_exists($targetFile)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        continue;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($file["tmp_name"], $targetFile)) {
            saveImageInDb($templateName,$targetFile,$templateId,$assignTo);
            $areas=getAreas($templateId);
            $areas["hidden"] = unserialize($areas["hidden"]);
            $areas["visible"] = unserialize($areas["visible"]);
            ImageManipulator::drawHiddenAreas($targetFile,$areas["hidden"]);
            ImageManipulator::drawVisibleAreas( $targetFile,$areas["visible"]);
        } else {
            echo false;
        }
    }
}
echo $uploadOk;