<?php
/**
 * Created by PhpStorm.
 * User: nasko
 * Date: 25.06.18
 * Time: 0:20
 */

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../styles/uploadTests.css" rel="stylesheet"/>
    <title>Качи тест</title>
</head>
<body>
<div class="container">
    <form method="post" action="../controllers/fileUploadController.php" enctype="multipart/form-data">
        <input type="file" name="files[]" id="files" multiple="" directory="" webkitdirectory="" mozdirectory="">
        <input class="button" type="submit" value="Upload" />
    </form>
</div>
<script src="../scripts/external/jquery-3.3.1.js" type="text/javascript"></script>
<script src="../scripts/external/knockout-3.4.2.debug.js" type="text/javascript"></script>
<script src="../scripts/general.js" type="text/javascript"></script>
<script src="../scripts/uploadTests.js" type="text/javascript"></script>
</body>
</html>
