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
    $teacher = new User($_SESSION["user"]["id"],$_SESSION["user"]["names"], $_SESSION["user"]["username"], $_SESSION["user"]["usertype"]);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../styles/styleAdmin.css" rel="stylesheet"/>
    <title>Админ панел</title>
</head>
<body>
<div class="view-container">
    <div class="welcome"> Добре дошъл <span style="color:white"> <?php echo $teacher->getNames() ?></span> </div>
    <div class="row">
        <div class="column firstColumn">
            <a href="createTemplate.php">
                <span class="columnName">Създай</span>
                <img src="../img/create.png">
                <span class="description"> Създай шаблон за проверка на тестове </span>
            </a>
        </div>
        <div class="column secondColumn">
            <a href="uploadTests.php">
                <span class="columnName">Прикачи</span>
                <img src="../img/import.png">
                <span class="description"> Прикачи попълнени тестове, които ще оценяваш по-късно</span>
            </a>
        </div>
        <div class="column thirdColumn">
            <a href="scoreTest.php">
                <span class="columnName">Оцени</span>
                <img src="../img/evaluate.png">
                <span class="description"> Оцени прикачените тестове по създадения вече шаблон за оценка</span>
            </a>
        </div>
        <!--TODO: add creation of tests using the system-->
    </div>
</div>
</body>
</html>

