<?php
/**
 * Created by PhpStorm.
 * User: nasko
 * Date: 25.06.18
 * Time: 0:20
 */

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../styles/uploadTests.css" rel="stylesheet"/>
    <title>Качи тестове</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="column left">
            <div class="left-container">
                <div>Избери тестови шаблон</div>
                <div class="row">
                    <!--                    ko foreach:$data.templatesList-->
                    <div data-bind="text:$data.name, click:function(){
                            $parent.selectTemplate($data.id);
                        }"></div>
                    <!--                    /ko-->
                </div>
            </div>
        </div>
        <div class="column right">
            <div class="right-container">
                <form>
                    <div><input type="text" placeholder="Име на теста"></div>
                    <input type="file" name="files[]" id="files" multiple="" directory="" webkitdirectory=""
                           mozdirectory="">
                </form>
            </div>
        </div>

    </div>
    <div class="text-center send-btn">
        <input class="button" value="Качи" type="button" data-bind="click:$data.sendTests"/>
    </div>
    <script src="../scripts/external/jquery-3.3.1.js" type="text/javascript"></script>
    <script src="../scripts/external/knockout-3.4.2.debug.js" type="text/javascript"></script>
    <script src="../scripts/general.js" type="text/javascript"></script>
    <script src="../scripts/uploadTests.js" type="text/javascript"></script>
</div>
</body>
</html>
