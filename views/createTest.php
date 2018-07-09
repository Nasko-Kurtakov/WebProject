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
    <meta charset="utf-8"/>
    <title>Създаване на тест</title>
    <link href="../styles/createTest.css" rel="stylesheet"/>
</head>
<body>
<div class="test-holder" data-bind="css: { 'is-printing': $data.isPrinting}">
    <div class="hide-on-print">Създаване на тест</div>
    <div class="test-name-container">
        <!--ko template: {data:$data.name, name:'text-input'}--><!--/ko-->
    </div>
    <div class="text-creation-container">
        <!--ko foreach: $data.questions-->
        <!--ko template: { name: $data.questionType + '-question-template' }--><!--/ko-->
        <!--/ko-->
        <div class="new-question-container hide-on-print">
            <button class="new-closed-queston" data-bind="click:$data.addClosedQuestion">Добави въпрос с затворен
                отговор
            </button>
            <button class="new-closed-queston" data-bind="click:$data.addOpenedQuestion">Добави въпрос с отворен
                отговор
            </button>
        </div>
    </div>
    <div class="hide-on-print">
        <button data-bind="click:$data.print">Принтиране</button>
    </div>
</div>

<script id="closed-question-template" type="text/html">
    <div class="question-container">
        <span data-bind="text: $parent.questions().indexOf($data)+1+'. '"></span>
        <!--ko template: {data:$data.questionText, name:'text-input'}--><!--/ko-->
        <!--ko foreach: $data.answers -->
        <div>
            <span data-bind="text: (String.fromCharCode(97+$index()) + ': ')"></span>
            <!--ko template: {data:$data.text, name:'text-input'}--><!--/ko-->
            <span class="hide-on-print">
                <span>Верен отговор</span>
                <input type="checkbox" data-bind="checked:$data.isCorrect">
            </span>
        </div>
        <!--/ko-->
        <button class="hide-on-print" data-bind="click: $data.addAnswer">Добави нов отговор</button>
    </div>
</script>

<script id="open-question-template" type="text/html">
    <div class="question-container">
        <span data-bind="text: $parent.questions().indexOf($data)+1+'. '"></span>
        <!--ko template: {data:$data.questionText, name:'text-input'}--><!--/ko-->
        <!--ko foreach: Array($data.answerLines()) -->
        <div class="empty-line-answer">

        </div>
        <!--/ko-->
        <button class="hide-on-print" data-bind="click: $data.addAnswer">Добави нов ред за отговор</button>
    </div>
</script>

<script id="text-input" type="text/html">
    <span>
        <span data-bind="text:$data.text,visible:!$data.isEditing(),event:{
            dblclick: function(){
                this.isEditing(true);
        }}"></span>
        <input data-bind="value:$data.text,
        visible:$data.isEditing,
        hasFocus:$data.isEditing,
        enterKey:function(){
            this.isEditing(false);
        },
        event: {
            blur: function() {
                this.isEditing(false);
            },
            focus: function(){
                $element.select();
            }
        }" type="text" placeholder="Дайте име на новия тест">
    </span>
</script>

<script src="../scripts/external/knockout-3.4.2.debug.js" type="text/javascript"></script>
<script src="../scripts/general.js" type="text/javascript"></script>
<script src="../scripts/createTest.js" type="text/javascript"></script>
</body>
</html>
