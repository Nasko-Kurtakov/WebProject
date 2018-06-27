<?php
/**
 * Created by PhpStorm.
 * User: nasko
 * Date: 25.06.18
 * Time: 0:20
 */
require_once "../libs/Init.php";
Init::_init();

use libs\User;

if (isset($_SESSION["user"]) && $_SESSION["user"]) {
    $teacher = new User($_SESSION["user"]["id"],$_SESSION["user"]["names"], $_SESSION["user"]["username"], $_SESSION["user"]["usertype"]);
}
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
                    <input type="file" name="files[]" id="files" multiple="" directory="" webkitdirectory=""
                           mozdirectory="">
                </form>
            </div>
        </div>

    </div>
    <div class="text-center send-btn">
        <input class="button" value="Качи" type="button" data-bind="click:function(){
                    var userId = <?php echo $_SESSION["user"]["id"]; ?>;
                    $data.sendTests(userId);
            }"/>
    </div>
    <div class="error-msg" data-bind="text:$data.error"></div>
    <script src="../scripts/external/jquery-3.3.1.js" type="text/javascript"></script>
    <script src="../scripts/external/knockout-3.4.2.debug.js" type="text/javascript"></script>
    <script src="../scripts/general.js" type="text/javascript"></script>
    <script src="../scripts/uploadTests.js" type="text/javascript"></script>
</div>
</body>
</html>
