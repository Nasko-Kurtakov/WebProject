<?php
require_once "../libs/Init.php";
Init::_init();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Влизане</title>
    <script src="../scripts/main.js" type="text/javascript"></script>
        <link href="../styles/shared.css" rel="stylesheet" />
        <link href="../styles/style.css" rel="stylesheet" />
    </head>
    <body>
    <div class="login-page">
        <div class="form">
            <form method="POST" action="../controllers/loginController.php" class="login-form">
                <input name="username" type="text" placeholder="Потребителско име"/>
                <input name="password" type="password" placeholder="Парола"/>
                <button type="submit">влез</button>
            </form>
        </div>
    </div>
    </body>
</html>