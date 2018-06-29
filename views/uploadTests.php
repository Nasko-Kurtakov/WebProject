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
    <link href="../styles/uploadTests.css" rel="stylesheet"/>
    <title>Качи тестове</title>
</head>
<body>
<div class="w3-bar w3-dark-grey w3-border w3-large" >
    <a href="<?php echo $mainPage?>" class="w3-bar-item w3-button homeButton"><i class="fa fa-home"></i></a>
    <button class="w3-bar-item w3-button w3-mobile send-btn" data-bind="click:function(){
                    $data.sendTests();
            }">Качи файловете</button>
    <span class="w3-bar-item" data-bind=""></span>
    <span class="w3-bar-item success" data-bind=""></span>
</div>
<div class="container">
    ERROR AND SUCCESS
    <div class="row">
        <div class="column left">
            <div class="left-container text-center">

                <span>Избери шаблон, към който да прикачиш тестовете.</span>
                <a class="create-new-template" href="createTemplate.php">Създай шаблон</a>
                <div class="table text-center">
                    <!--ko if:$data.templatesList().length == 0-->
                        <div class="empty-template-table">Няма направени шаблони</div>
                    <!--/ko-->
                    <!--ko if:$data.templatesList().length != 0-->
                        <!--ko foreach:$data.templatesList-->
                        <div class="row template-row" data-bind="css:{'selected':($parent.selectedTemplate() && $parent.selectedTemplate().id == $data.id) },click:function(){
                                    $parent.selectTemplate($data);
                                }">
                            <div class="templates-column template-name" data-bind="text:$data.name"></div>
                            <div class="templates-column" data-bind="text:$data.date_created"></div>
                        </div>
                        <!--/ko-->
                <!--/ko-->
                </div>
            </div>
        </div>
        <div class="column right">
            <div class="right-container text-center">
                <form id="pickFiles">
                    <input type="file" name="files[]" id="files" class="inputfile" multiple="" directory="" webkitdirectory=""
                           mozdirectory="" data-bind="event:{ change: onFilesSelectedEvent }" />
                    <label for="files">Избери тестове</label>
                </form>
                <span data-bind="text:$data.testFiles() ? $data.testFiles().length + ' файла са избрани' : '*Не са избрани файлове'"></span>
                <div class="table text-center">
                    <!--ko if:$data.templatesList().length != 0-->
                    <!--ko foreach:$data.testFiles-->
                    <div class="row file-row">
                        <div data-bind="text:$data.name"></div>
                    </div>
                    <!--/ko-->
                    <!--/ko-->
                </div>
            </div>
        </div>

    </div>
    <div class="text-center send-btn">

    </div>
    <div class="error-msg" data-bind="text:$data.error"></div>
    <script src="../scripts/external/jquery-3.3.1.js" type="text/javascript"></script>
    <script src="../scripts/external/knockout-3.4.2.debug.js" type="text/javascript"></script>
    <script src="../scripts/general.js" type="text/javascript"></script>
    <script src="../scripts/uploadTests.js" type="text/javascript"></script>
</div>
</body>
</html>
