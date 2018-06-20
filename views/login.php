<?php

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Влизане</title>
    <script src="../scripts/main.js" type="text/javascript"></script>
    <link href="../styles/style.css" rel="stylesheet" />
    </head>
    <body>
    <div class="login-page">
        <div class="form">
            <form method="POST" action="../controllers/loginController.php" class="login-form">
                <input type="text" placeholder="username"/>
                <input type="password" placeholder="password"/>
                <button type="submit">влез</button>
            </form>
        </div>
    </div>
    </body>
</html>