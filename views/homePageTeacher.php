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
    <h1> Добре дошъл <?php echo $teacher->getNames() ?></h1>
    <div class="row">
        <div class="column">
<!--            <a href="createTest.php">-->
<!--                <div class="container">-->
<!--                    <h2>Създай jei</h2>-->
<!--                    <img src="../img/create.png"-->
<!--                    <p></p>-->
<!--                </div>-->
<!--            </a>-->
            <a href="createTemplate.php">
                <div class="container">
                    <h2>Създай шаблон</h2>
                    <img src="../img/create.png"
                    <p></p>
                </div>
            </a>
        </div>
        <div class="column">
            <div class="container">
                <h2>Оцени</h2>
                <img src="../img/evaluate.png"
                <p></p>
            </div>
        </div>
        <div class="column">
            <div class="container">
                <h2>Прикачи</h2>
                <img src="../img/import.png"
                <p></p>
            </div>
        </div>
    </div>
</div>
</body>
</html>

