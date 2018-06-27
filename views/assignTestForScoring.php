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
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../styles/assignTestForScoring.css" rel="stylesheet"/>
    <title>Назначи тестове за оценяване</title>
</head>
<body>
    <div>
        Изберете тест и групата ученици, които да го оценяват.
    </div>
    <div class="row">
        <div class="column left">
            <div class="left-container">
                <span>Избери група студенти</span>
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
                <span>Избери тест, който да бъде оценяван от студентите</span>
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
    <div class="text-center send-btn">
        <input class="button" value="Назначи за оценка" type="button" data-bind="click:$data.assign"/>
    </div>
    <div class="text-center" data-bind="text:self.error">
    </div>
    <script src="../scripts/external/jquery-3.3.1.js" type="text/javascript"></script>
    <script src="../scripts/external/knockout-3.4.2.debug.js" type="text/javascript"></script>
    <script src="../scripts/general.js" type="text/javascript"></script>
    <script src="../scripts/assignTestForScoring.js" type="text/javascript"></script>
</body>
</html>

