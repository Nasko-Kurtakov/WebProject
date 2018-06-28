<?php
/**
 * Created by PhpStorm.
 * User: Atanas Kurtakov
 * Date: 26.6.2018 г.
 * Time: 15:13
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
    <link href="../styles/homePageStudent.css" rel="stylesheet"/>
    <title>Добре дошъл <?php echo $user->getNames(); ?></title>
</head>
<body>
<div class="view-container">
    <div class="header">Добре дошъл <span style="color:white"> <?php echo $user->getNames(); ?></span></div>
    <div class="row">
        <div class="columnStudent thirdColumn">
            <a href="scoreTest.php">
                <span class="columnName">Оцени</span>
                <img src="../img/evaluate.png">
                <span class="description">Оцени прикачените тестове по създадения вече шаблон за оценка</span>
            </a>
        </div>
    </div>
</div>
</body>
</html>
