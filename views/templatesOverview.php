<?php
/**
 * Created by PhpStorm.
 * User: nasko
 * Date: 24.06.18
 * Time: 11:24
 */
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../styles/templatesOverview.css" rel="stylesheet"/>
    <title>Всички тестове</title>
</head>
<body>
<div class="container">
 <div class="text-center">
<!--ko if:($data.templatesCollection().length > 0 )-->
    <div class="temp-row">
<!--        ko foreach:$data.templatesCollection-->
        <div class="">
            <div data-bind="text:$data.name, click:function(){
                $parent.selectTemplate($data.id);
            }"></div>
        </div>
<!--        /ko-->
    </div>
<!--/ko-->
 </div>
</div>
<script src="../scripts/external/jquery-3.3.1.js" type="text/javascript"></script>
<script src="../scripts/external/knockout-3.4.2.debug.js" type="text/javascript"></script>
<script src="../scripts/general.js" type="text/javascript"></script>
<script src="../scripts/templatesOverview.js" type="text/javascript"></script>
</body>
</html>
