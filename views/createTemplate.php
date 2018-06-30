<?php
/**
 * Created by PhpStorm.
 * User: nasko
 * Date: 20.06.18
 * Time: 22:48
 */

require_once "../libs/Init.php";
Init::_init();
use libs\User;

if (isset($_SESSION["user"]) && $_SESSION["user"]) {
    $user = new User($_SESSION["user"]["id"],$_SESSION["user"]["names"], $_SESSION["user"]["username"], $_SESSION["user"]["usertype"]);
    $mainPage = $user->getUserType() == "admin" ? "homePageTeacher.php" : "homePageStudent.php";
}else {
    session_destroy();
    header("../views/login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../styles/external/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="../styles/shared.css" rel="stylesheet"/>
    <link href="../styles/createTemplate.css" rel="stylesheet"/>
    <title>Създаване на шаблон</title>
</head>
<body data-bind="css: { 'is-printing': $data.isPrinting}">
<div class="w3-bar w3-dark-grey w3-large hide-on-print" >
    <a href="<?php echo $mainPage?>" class="w3-bar-item w3-button homeButton"><i class="fa fa-home"></i></a>
    <button class="w3-bar-item w3-button w3-mobile greenButton rightAlign " data-bind="click:$data.saveAreas">Запазване</button>
    <input type="text" class="w3-bar-item w3-input w3-white w3-mobile rightAlign" data-bind="value: $data.numOfQuestions" placeholder="Брой въпроси">
    <input type="text" class="w3-bar-item w3-input w3-white w3-mobile rightAlign" data-bind="value: $data.testName" placeholder="Име на теста">

    <button class="w3-bar-item w3-button w3-mobile greyButton" data-bind="visible:$data.isTestFileSelected(),click:$data.refreshFile">Избери нов файл</button>
    <button class="w3-bar-item w3-button w3-mobile greenButton" data-bind="visible:($data.isTestFileSelected()==true), click:$data.print">Принтирай</button>
</div>
<div class="w3-dark-gray err-success-bar text-center hide-on-print">
    <span class="w3-bar-item" data-bind="text:$data.error"></span>
    <span class="w3-bar-item success" data-bind="text:$data.success"></span>
</div>
<div class="hide-on-print" data-bind="visible:$data.isTestFileSelected()">
    <div class="notes">
        <span class="notes"><img src="../img/dragIcon48.png">Shift+drag - select to hide </span>
        <span class="notes"><img src="../img/dragIcon48.png">drag - select to show</span>
    </div>
</div>
<div class="main-content-holder">
<!--ko if:!$data.isTestFileSelected()-->
<div class="file-picker-container hide-on-print">
    <div class="caption-text">Преди да продължите изберете тестови файл. Той ще се използва само за създаването на шаблон и няма да бъде записван.</div>
    <form id="pickFile">
        <input type="file" name="file" id="file" class="inputfile" data-bind="value:$data.testFile" />
        <label for="file">Избери файл</label>
    </form>
<!--        <input type="file">-->
<!--        <input type="button" value="Продължи" data-bind="click:$data.toTemplateCreation">-->
    <div class="file-preview-container">
<!--        <div>Преглед на избраното изображение.</div>-->
<!--        <img class="file-preview" data-bind="attr:{src:$data.testFile}">-->
    </div>
</div>
<!--/ko-->
<!--ko if:$data.isTestFileSelected()-->
    <div class="view-container">
        <div class="test-holder">
            <img id="the-img" class="img-holder" data-bind="templateSelection:$data,attr:{'src':$data.fileImg}">
            <canvas class="selection-canvas" id="selection-canvas"></canvas>
            <canvas class="marking-canvas" id="marking-canvas"></canvas>
        </div>
    </div>
<!--/ko-->
</div>
<script src="../scripts/external/jquery-3.3.1.js" type="text/javascript"></script>
<script src="../scripts/external/knockout-3.4.2.debug.js" type="text/javascript"></script>
<script src="../scripts/general.js" type="text/javascript"></script>
<script src="../scripts/createTemplate.js" type="text/javascript"></script>
</body>
</html>

