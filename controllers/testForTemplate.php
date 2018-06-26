<?php
/**
 * Created by PhpStorm.
 * User: Atanas Kurtakov
 * Date: 26.6.2018 г.
 * Time: 16:27
 */

// this controller will be used to fake a upload to the server so the image can then be taken from there
// because chorme doest not allow loading local files
// FIgure out when to delete them

require_once "../libs/Init.php";
Init::_init(true);

function makeDirs($dirpath, $mode=0700) {
    if(!is_dir($dirpath)){
        $oldUmask = umask(0);
        mkdir($dirpath,$mode,true);
        umask($oldUmask);
    }
}

$params = array();
parse_str($_SERVER['QUERY_STRING'], $params);
$targetDir = "../temp/";
makeDirs($targetDir);

foreach ($_FILES  as $file){
    $targetFile = $targetDir . basename($file["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        continue;
    }
    if (move_uploaded_file($file["tmp_name"], $targetFile)) {
        echo $targetFile;
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}