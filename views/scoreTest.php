<?php
/**
 * Created by PhpStorm.
 * User: Atanas Kurtakov
 * Date: 21.6.2018 г.
 * Time: 13:44
 */

require_once "../libs/Init.php";
Init::_init();

use libs\Teacher;

if (isset($_SESSION["user"]) && $_SESSION["user"]) {
    $user = $_SESSION["user"];
    $teacher = new Teacher($user["names"], $user["username"], $user["usertype"]);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../styles/scoreTest.css" rel="stylesheet"/>
    <title>Оценка на тест</title>
</head>
<body>
<div>
<!--    <button class="save-areas" data-bind="click:$data.saveAreas">Запазване на селекцията</button>-->
</div>
<div class="controlls"></div>
<div class="view-container">
    <div class="test-holder" data-bind="templateSelection:$data"">
    <img class="img-holder" src="../img/test1.jpg">
    <canvas class="selection-canvas" id="selection-canvas"></canvas>
    <canvas class="marking-canvas" id="marking-canvas"></canvas>
</div>
</div>

<script src="../scripts/external/jquery-3.3.1.js" type="text/javascript"></script>
<script src="../scripts/external/knockout-3.4.2.debug.js" type="text/javascript"></script>
<script src="../scripts/general.js" type="text/javascript"></script>
<script src="../scripts/scoreTest.js" type="text/javascript"></script>
</body>
</html>