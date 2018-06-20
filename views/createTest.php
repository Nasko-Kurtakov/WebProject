<?php
/**
 * Created by PhpStorm.
 * User: nasko
 * Date: 20.06.18
 * Time: 1:09
 */

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Създаване на тест</title>

    <!--		<link href="styles/style.css" rel="stylesheet" />-->
</head>
<body>
<div>
    <div>Създаване на тест</div>
    <div class="test-name-container">
        <span>Име на теста</span>
        <span>
            <input type="text" placeholder="Дайте име на новия тест">
        </span>
    </div>
    <div class="text-creation-container">
        <!--ko foreach: $data.questions-->
            <!--ko template: { name: $data.questionType + '-question-template' }--><!--/ko-->
        <!--/ko-->
        <div class="new-question-container">
            <button class="new-closed-queston" data-bind="click:$data.addClosedQuestion">Добави въпрос с затворен отговор</button>
            <button class="new-closed-queston" data-bind="click:$data.addOpenedQuestion">Добави въпрос с отворен отговор</button>
        </div>
    </div>
</div>

<script id="closed-question-template" type="text/html">

    <div class="question-container">
        <span>Текст на въпроса</span>
        <input title="Question text" type="text" data-bind="value:questionText" class="question-text">
        <!--ko foreach: $data.answers -->
            <div>
                <span data-bind="text: (String.fromCharCode(97+$index()) + ' :')"></span>
                <input type="text" title="Answer" data-bind="value:$data.text">
                <input type="checkbox" data-bind="checked:$data.isCorrect">
            </div>
        <!--/ko-->
        <button data-bind="click: $data.addAnswer">Добави нов отговор</button>
    </div>
</script>

<script id="open-question-template" type="text/html">

</script>
<script src="../scripts/external/knockout-3.4.2.debug.js" type="text/javascript"></script>
<script src="../scripts/createTest.js" type="text/javascript"></script>
</body>
</html>
