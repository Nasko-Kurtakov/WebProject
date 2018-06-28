<?php
/**
 * Created by PhpStorm.
 * User: asxelag
 * Date: 20-Jun-18
 * Time: 1:24 AM
 */

require_once "../libs/Init.php";
Init::_init();

use libs\User;

if (isset($_SESSION["user"]) && $_SESSION["user"]) {
    $user = new User($_SESSION["user"]["id"],$_SESSION["user"]["names"], $_SESSION["user"]["username"], $_SESSION["user"]["usertype"]);
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
    <link href="../styles/shared.css" rel="stylesheet"/>
    <link href="../styles/homePageTeacher.css" rel="stylesheet"/>
    <title>Админ панел</title>
</head>
<body>

    <div class="header"> Добре дошъл <span style="color:white"> <?php echo $user->getNames() ?></span> </div>
    <div class="row">
        <div class="column firstColumn">
            <a href="createTemplate.php">
                <div class="columnName">Създай</div>
                <img class="resize" src="../img/create.png">
                <div class="description"> Създай шаблон за проверка на тестове </div>
            </a>
        </div>
        <div class="column secondColumn">
            <a href="uploadTests.php">
                <div class="columnName">Прикачи</div>
                <img class="resize" src="../img/import.png">
                <div class="description"> Прикачи попълнени тестове, които ще оценяваш по-късно</div>
            </a>
        </div>
        <div class="column thirdColumn">
            <a href="scoreTest.php">
                <div class="columnName">Оцени</div>
                <img class="resize" src="../img/evaluate.png">
                <div class="description"> Оцени прикачените тестове по създадения вече шаблон за оценка</div>
            </a>
        </div>
        <div class="column fourthColumn last">
            <a href="assignTestForScoring.php">
                <div class="columnName">Възложи</div>
                <img class="resize" src="../img/assign.png">
                <div class="description"> Възложи тестове за оценка на студенти</div>
            </a>
        </div>
    </div>

</body>
</html>

