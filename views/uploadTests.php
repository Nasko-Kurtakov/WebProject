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
                <span>Избери тестови шаблон</span>
                <a href="createTemplate.php">Създай шаблон</a>
                <!--ko if:$data.templatesList().length == 0-->
                    <div class="empty-template-table">Няма направени шаблони</div>
                <!--/ko-->
                <!--ko if:$data.templatesList().length != 0-->
                <div class="row text-center">
                    <!--ko foreach:$data.templatesList-->
                    <div class="template-name" data-bind="text:$data.name,css:{'selected':($parent.selectedTemplate() && $parent.selectedTemplate().id == $data.id) } ,click:function(){
                            $parent.selectTemplate($data);
                        }"></div>
                    <!--/ko-->
                </div>
                <!--/ko-->
            </div>
        </div>
        <div class="column right">
            <div class="right-container">
                <form>
                    <div>Дай име на качвания пакет тестове - <input type="text" placeholder="Име на теста" data-bind="textInput: $data.testName"></div>
                    <input type="file" name="files[]" id="files" multiple="" directory="" webkitdirectory=""
                           mozdirectory="">
                </form>
            </div>
        </div>

    </div>
    <div class="text-center send-btn">
        <input class="button" value="Качи" type="button" data-bind="click:$data.sendTests"/>
    </div>
    <div class="error-msg" data-bind="text:$data.error"></div>
    <script src="../scripts/external/jquery-3.3.1.js" type="text/javascript"></script>
    <script src="../scripts/external/knockout-3.4.2.debug.js" type="text/javascript"></script>
    <script src="../scripts/general.js" type="text/javascript"></script>
    <script src="../scripts/uploadTests.js" type="text/javascript"></script>
</div>
</body>
</html>
