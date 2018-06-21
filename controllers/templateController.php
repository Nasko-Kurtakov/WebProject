<?php
/**
 * Created by PhpStorm.
 * User: nasko
 * Date: 21.06.18
 * Time: 1:07
 */

require_once "../libs/Init.php";
Init::_init(true);

use libs\Test;

$postData = json_decode(file_get_contents("php://input"), true);

if(isset($_SESSION[templateId]) && $_SESSION["templateId"]){
    
}

//print_r($postData);

//$myJSON = json_encode($postData);

echo $myJSON;