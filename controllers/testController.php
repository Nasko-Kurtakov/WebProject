<?php
/**
 * Created by PhpStorm.
 * User: Atanas Kurtakov
 * Date: 20.6.2018 г.
 * Time: 14:09
 */

require_once "../libs/Init.php";
Init::_init(true);

use libs\Test;

$postData = json_decode(file_get_contents("php://input"), true);

$myJSON = json_encode($postData);




echo $myJSON;
