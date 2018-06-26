<?php
/**
 * Created by PhpStorm.
 * User: nasko
 * Date: 25.06.18
 * Time: 0:41
 */

require_once "../libs/Init.php";
Init::_init(true);
require_once "../libs/Db.php";

use libs\Db;

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

$folderName = $templateId."_".$templateName;
$targetDir = "../uploads/".$folderName."/";
makeDirs($targetDir);

foreach ($_FILES  as $file){
    $targetFile = $targetDir . basename($file["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($file["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
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
            $stmnt = $conn->prepare("INSERT INTO test (name,dirpath,templateId) VALUES (?, ?, ?)");
            $stmnt->execute([$templateName,$targetFile,$templateId]);
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}