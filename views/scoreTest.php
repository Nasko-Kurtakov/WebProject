<?php
/**
 * Created by PhpStorm.
 * User: Atanas Kurtakov
 * Date: 21.6.2018 г.
 * Time: 13:44
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
    <link href="../styles/scoreTest.css" rel="stylesheet"/>
    <title>Оценка на тест</title>
</head>
<body>
<div class="w3-bar w3-dark-grey w3-border w3-large" >
    <a href="<?php echo $mainPage?>" class="w3-bar-item w3-button homeButton"><i class="fa fa-home"></i></a>
    <button class="w3-bar-item w3-button w3-mobile send-btn" data-bind="click:function(){
                    $data.scoreTest();
            }">Оцени</button>
</div>
<div class="container">
    <!--ko if: $data.templatesOverview.selectedTemplate() == null-->
        <!--ko with:$data.templatesOverview-->
            <!--ko template: 'templates-overview'--><!--/ko-->
        <!--/ko-->
    <!--/ko-->
    <!--ko if: $data.templatesOverview.selectedTemplate() != null-->
        <!--ko with:$data.scoreTestView()-->
            <!--ko template: 'score-test-view'--><!--/ko-->
        <!--/ko-->
    <!--/ko-->
</div>
<script type="text/html" id="templates-overview">
    <div class="all-templates-container">
        <div class="temp-row">
            <!--ko foreach:$data.templatesCollection-->
            <div class="">
                <div data-bind="text:$data.name, click:function(){
                $parent.selectTemplate($data);
                }"></div>
            </div>
            <!-- /ko-->
        </div>
    </div>
</script>
<script type="text/html" id="score-test-view">
    <div class="controls"></div>
    <!--ko if:!!$data.currentTest()-->
    <div class="view-container row">
        <div class="left column">
            <div class="test-holder" data-bind="testScorer:$data">
                <img class="img-holder" data-bind="attr:{'src':$data.currentTest().dirpath }">
            </div>
        </div>
        <div class="right column text-center">
            <div class="column left-first">
                <div>№</div>
                <!--ko foreach:answers-->
                <div data-bind="text:$index()+1">

                </div>
                <!--/ko-->
            </div>
            <div class="column left-three">
                <div>Верен</div>
                <!--ko foreach:answers-->
                <div>
                    <input type="radio" value="true" data-bind="checked: $data.isCorrect,attr:{'name':$index()}" />
                </div>
                <!--/ko-->
            </div>
            <div class="column middle-three">
                <div>Грешен</div>
                <!--ko foreach:answers-->
                <div>
                    <input type="radio" value="false" data-bind="checked: $data.isCorrect,attr:{'name':$index()}" />
                </div>
                <!--/ko-->
            </div>
            <div class="column right-three">
                <div>Коментар</div>
                <!--ko foreach:answers-->
                <textarea data-bind="textInput:$data.comment"></textarea>
                <!--/ko-->
            </div>
            <div style="width: 50%" class="column">
                <input type="text" data-bind="value:$data.mark">
            </div>
            <div style="width: 50%" class="column">
                <button data-bind="click:$data.scoreTest">Оцени</button>
            </div>

        </div>
    </div>
    <!--/ko-->
    <!--ko if:(!!$data.currentTest()==false)-->
    <div>
        стига толкова
    </div>
    <!--ko-->
</script>

<script src="../scripts/external/jquery-3.3.1.js" type="text/javascript"></script>
<script src="../scripts/external/knockout-3.4.2.debug.js" type="text/javascript"></script>
<script src="../scripts/general.js" type="text/javascript"></script>
<script src="../scripts/scoreTest.js" type="text/javascript"></script>
</body>
</html>

