<?php
/**
 * Created by PhpStorm.
 * User: asxelag
 * Date: 20-Jun-18
 * Time: 1:24 AM
 */

require_once "../libs/Init.php";
Init::_init();

use libs\Teacher;

if (isset($_SESSION["user"]) && $_SESSION["user"]) {
    $user = $_SESSION["user"];
    $teacher = new Teacher($user["names"], $user["username"], $user["usertype"]);
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
<!--            <a href="createTest.php">-->
<!--                <div class="container">-->
<!--                    <h2>Създай jei</h2>-->
<!--                    <img src="../img/create.png"-->
<!--                    <p></p>-->
<!--                </div>-->
<!--            </a>-->
            <a href="createTemplate.php">
                <span class="columnName">Създай</span>
                <img src="../img/create.png">
                <span class="description"> Създай и разпечатай нов тест с отворени и затворени въпроси </span>
            </a>
        </div>
        <div class="column secondColumn">
            <a href="#">
                <span class="columnName">Прикачи</span>
                <img src="../img/import.png">
                <span class="description"> Прикачи сканиран тест, по който да направиш шаблон за оценка</span>
            </a>
        </div>
        <div class="column thirdColumn">
            <a href="#">
                <span class="columnName">Оцени</span>
                <img src="../img/evaluate.png">
                <span class="description"> Оцени прикачените тестове по създадения вече шаблон за оценка</span>
            </a>
        </div>
    </div>
</div>
</body>
</html>

