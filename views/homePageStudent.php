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
    $user = $_SESSION["user"];
    $teacher = new User($user["id"],$user["names"], $user["username"], $user["usertype"]);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../styles/styleAdmin.css" rel="stylesheet"/>
    <link href="../styles/styleAdmin.css" rel="stylesheet"/>
    <title>Добре дошъл <?php echo $teacher->getNames(); ?></title>
</head>
<body>
<div class="view-container">
    <div class="welcome">Добре дошъл <span style="color:white"> <?php echo $teacher->getNames(); ?></span></div>
    <div class="row">
        <div class="column thirdColumn">
            <a href="scoreTest.php">
                <span class="columnName">Оцени</span>
                <img src="../img/evaluate.png">
                <span class="description">Оцени прикачените тестове по създадения вече шаблон за оценка</span>
            </a>
        </div>
    </div>
</div>
</body>
<script type="text/javascript">
    debugger;
    var userId = <?php echo $_SESSION["user"]["id"]; ?>;
    sessionStorage.setItem('userId', userId);
</script>
</html>
