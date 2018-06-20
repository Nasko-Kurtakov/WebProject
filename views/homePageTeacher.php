<?php
/**
 * Created by PhpStorm.
 * User: nasko
 * Date: 20.06.18
 * Time: 0:37
 */

require_once "../libs/Init.php";
Init::_init();

use libs\Teacher;

if (isset($_SESSION["user"]) && $_SESSION["user"]){
    $user = $_SESSION["user"];
    $teacher = new Teacher($user["names"],$user["username"],$user["usertype"]);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Админ панел</title>
    <!--		<script src="scripts/main.js" type="text/javascript"></script>-->
    <!--		<link href="styles/style.css" rel="stylesheet" />-->
</head>
<body>
    <div>
        <div>Здравей, <?php echo $teacher->getNames()?></div>
        <div>
            <a href="createTest.php">Създаване на тест</a>
        </div>
        <div>
            <a href="createTest.php">Оценка на тест</a>
        </div>
        <div>
            <a href="createTest.php">Качване на тест за оценка</a>
        </div>
    </div>
</body>
</html>

