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
<div>
    <span>Ctrl+drag - select to hide </span>
    <span>drag - select to show</span>
    <button class="save-areas" data-bind="click:$data.saveAreas">Запазване на селекцията</button>
</div>
<div class="controlls"></div>
<div class="view-container">
    <div class="test-holder" data-bind="templateSelection:$data"">
        <img class="img-holder" src="../img/test1.jpg">
    <canvas class="selection-canvas" id="selection-canvas"></canvas>
    </div>
</div>

<script src="../scripts/external/jquery-3.3.1.js" type="text/javascript"></script>
<script src="../scripts/external/knockout-3.4.2.debug.js" type="text/javascript"></script>
<script src="../scripts/general.js" type="text/javascript"></script>
<script src="../scripts/createTemplate.js" type="text/javascript"></script>
</body>
</html>

