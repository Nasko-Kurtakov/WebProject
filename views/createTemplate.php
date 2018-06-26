<?php
/**
 * Created by PhpStorm.
 * User: nasko
 * Date: 20.06.18
 * Time: 22:48
 */
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../styles/createTemplate.css" rel="stylesheet"/>
    <title>Създаване на шаблон</title>
</head>
<body>
<!--ko if:!$data.isTestFileSelected()-->
<div class="file-picker-container">
    <div>Преди да продължите изберете тестови файл. Той ще се използва само за създаването на шаблон и няма да бъде записван.</div>
    <form>
        <input type="file">
        <input type="button" value="Продължи" data-bind="click:$data.toTemplateCreation">
    </form>
    <div class="file-preview-container">
<!--        <div>Преглед на избраното изображение.</div>-->
<!--        <img class="file-preview" data-bind="attr:{src:$data.testFile}">-->
    </div>
</div>
<!--/ko-->
<!--ko if:$data.isTestFileSelected()-->
<div>
    <div>
        <span>Ctrl+drag - select to hide </span>
        <span>drag - select to show</span>
        <span><label>Брой въпроси:<input type="text" data-bind="value: $data.numOfQuestions"></label></span>
        <button class="save-areas" data-bind="click:$data.saveAreas">Запазване на селекцията</button>
    </div>
    <div class="controlls"></div>
    <div class="view-container">
        <div class="test-holder" data-bind="templateSelection:$data">
            <img class="img-holder" data-bind="attr:{'src':$data.testFile}">
            <canvas class="selection-canvas" id="selection-canvas"></canvas>
            <canvas class="marking-canvas" id="marking-canvas"></canvas>
        </div>
    </div>
</div>
<!--/ko-->
<script src="../scripts/external/jquery-3.3.1.js" type="text/javascript"></script>
<script src="../scripts/external/knockout-3.4.2.debug.js" type="text/javascript"></script>
<script src="../scripts/general.js" type="text/javascript"></script>
<script src="../scripts/createTemplate.js" type="text/javascript"></script>
</body>
</html>

