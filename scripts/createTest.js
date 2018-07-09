(function () {
    var testVM = function () {
        var self = this;

        self.isPrinting=ko.observable(false);

        function getEditableText(defaultText,defaultIsEditing){
            return {
                text:ko.observable(defaultText || "текст"),
                isEditing:ko.observable(defaultIsEditing || false)
            }
        }

        self.name = getEditableText("Дайте име на новия тест");

        self.questions = ko.observableArray([]);

        self.addClosedQuestion=function () {
            var question = {
                questionText:getEditableText("Текст на въпроса"),
                answers:ko.observableArray([{
                    text:getEditableText(),
                    isCorrect:ko.observable(false)
                }]),
                addAnswer:function () {
                    this.answers.push({
                        text:getEditableText(),
                        isCorrect:ko.observable(false)
                    })
                },
                questionType:"closed"
            };
            this.questions.push(question);
        };

        self.addOpenedQuestion = function () {
            var question = {
                questionText:getEditableText("Текст на въпроса"),
                answerLines:ko.observable(1),
                addAnswer:function () {
                    this.answerLines(this.answerLines()+1);
                },
                questionType:"open"
            };
            this.questions.push(question);
        };
        
        self.print=function () {
            self.isPrinting(true);
            var oldTitle = document.title;
            document.title = "Тест";
            window.print();
            document.title = oldTitle;
            self.isPrinting(false);
        };
    };

    ko.applyBindings(new testVM());
})();