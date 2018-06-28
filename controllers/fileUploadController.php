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
$assignTo = $params["assignedTo"];
$folderName = $templateId."_".$templateName;
$targetDir = "../uploads/".$folderName."/";
makeDirs($targetDir);

function imageCreateFromAny($filepath) {
    $type = exif_imagetype($filepath); // [] if you don't have exif you could use getImageSize()
    $allowedTypes = array(
        1,  // [] gif
        2,  // [] jpg
        3  // [] png
    );
    if (!in_array($type, $allowedTypes)) {
        return false;
    }
    switch ($type) {
        case 1 :
            $im = imageCreateFromGif($filepath);
            break;
        case 2 :
            $im = imageCreateFromJpeg($filepath);
            break;
        case 3 :
            $im = imageCreateFromPng($filepath);
            break;
    }
    return $im;
}

function getAreas($templateId) {
    $conn=(new Db())->getConn();
    $stmnt=$conn->prepare("SELECT `hidden`,`visible` FROM `template` WHERE id = ?");
    $result = $stmnt->execute([$templateId]);
    $areasToDraw = $stmnt->fetch();
    return $areasToDraw;
}

foreach ($_FILES as $file){
    $targetFile = $targetDir . basename($file["name"]);
    $uploadOk = 1;
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
            $conn = (new Db())->getConn();
            $stmnt = $conn->prepare("INSERT INTO `test`(`name`, `dirpath`, `templateId`, `assigned_to`) VALUES (?,?,?,?)");
            $stmnt->execute([$templateName,$targetFile,$templateId,$assignTo]);
            $im=imageCreateFromAny($targetFile);
            $areas=getAreas($templateId);
            $areas["hidden"] = unserialize($areas["hidden"]);
            $areas["visible"] = unserialize($areas["visible"]);
            foreach ($areas["hidden"] as $hiddenArea){
                $black = imagecolorallocate($im, 0, 0, 0);
                imagefilledrectangle($im, $hiddenArea["left"], $hiddenArea["top"], $hiddenArea["left"]+$hiddenArea["width"], $hiddenArea["top"]+$hiddenArea["height"], $black);
                imagejpeg($im,$targetFile);
            }
            foreach ($areas["visible"] as $visibleArea){
                $green = imagecolorallocate($im, 0, 255, 0);
                imagerectangle($im, $visibleArea["left"], $visibleArea["top"], $visibleArea["left"]+$visibleArea["width"], $visibleArea["top"]+$visibleArea["height"], $green);
                imagejpeg($im,$targetFile);
            }
            imagedestroy($im);
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}