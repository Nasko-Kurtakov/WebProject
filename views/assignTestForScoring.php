<?php
/**
 * Created by PhpStorm.
 * User: Atanas Kurtakov
 * Date: 27.6.2018 г.
 * Time: 12:15
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
    <link href="../styles/assignTestForScoring.css" rel="stylesheet"/>
    <title>Назначи тестове за оценяване</title>
</head>
<body>
<div class="w3-bar w3-dark-grey w3-border w3-large" >
    <a href="<?php echo $mainPage?>" class="w3-bar-item w3-button homeButton"><i class="fa fa-home"></i></a>
    <button class="w3-bar-item w3-button w3-mobile assign-btn" data-bind="click:$data.assign">Назначи</button>
</div>
<div class="container">
    <div class="text-center choose-test">
        Изберете тест и група, която да оценява.
    </div>
    <div class="row">
        <div class="column left">
            <div class="left-container">
                <span class="table-header">Избери група студенти</span>
                <!--ko if:$data.groups.length == 0-->
                <div class="empty-template-table">Няма записани групи</div>
                <!--/ko-->
                <!--ko if:$data.groups.length != 0-->
                <div class="row text-center">
                    <!--ko foreach:$data.groups-->
                    <div class="group-name" data-bind="text:$data,css:{'selected':($parent.selectedGroup() && $parent.selectedGroup() == $data) } ,click:function(){
                            $parent.selectGroup($data);
                        }"></div>
                    <!--/ko-->
                </div>
                <!--/ko-->
            </div>
        </div>
        <div class="column right">
            <div class="right-container">
                <span class="table-header">Избери тест, който да бъде оценяван от студентите</span>
                <!--ko if:$data.templates.length == 0-->
                <div class="empty-template-table">Няма записани тестове</div>
                <!--/ko-->
                <!--ko if:$data.templates.length != 0-->
                <div class="row text-center">
                    <!--ko foreach:$data.templates-->
                    <div class="group-name" data-bind="text:$data.name,css:{'selected':($parent.selectedTemplate() && $parent.selectedTemplate() == $data) } ,click:function(){
                            $parent.selectTemplate($data);
                        }"></div>
                    <!--/ko-->
                </div>
                <!--/ko-->
            </div>
        </div>

    </div>

    <div class="text-center" data-bind="text:self.error">
    </div>
</div>
<script src="../scripts/external/jquery-3.3.1.js" type="text/javascript"></script>
<script src="../scripts/external/knockout-3.4.2.debug.js" type="text/javascript"></script>
<script src="../scripts/general.js" type="text/javascript"></script>
<script src="../scripts/assignTestForScoring.js" type="text/javascript"></script>
</body>
</html>

