(function () {
    var test = {
        name:ko.observable(""),
        questions:ko.observableArray([]),
        addOpenedQuestion:function (questionText) {

        },
        addClosedQuestion:function () {
            var question = {
                questionText:ko.observable(""),
                answers:ko.observableArray([{
                    text:ko.observable(""),
                    isCorrect:ko.observable(false)
                }]),
                addAnswer:function () {
                    this.answers.push({
                        text:ko.observable(""),
                        isCorrect:ko.observable(false)
                    })
                },
                questionType:"closed"
            };

            this.questions.push(question);
        }
    };

    ko.applyBindings(test);
})();