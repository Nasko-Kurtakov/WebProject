(function () {

    function postJSONData(url, data) {
        // Default options are marked with *
        return fetch(url, {
            body: JSON.stringify(data), // must match 'Content-Type' header
            headers: {
                'Content-Type': 'application/json'
            },
            method: 'POST'
        })
            .then(function (res) {
                return res.json()
            })
            .catch(function (error) {
                console.error('Error:', error);
                return;
            })
            .then(function (response) {
                console.log('Success:', response);
                return;
            });
    }

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
        }

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
        
        self.saveNewTest=function () {

            var testData = {
              name:self.name.text(),
              questions:self.questions().map(function (question) {
                  if(question.questionType == "closed"){
                      return {
                          questionType:"closed",
                          questionText:question.questionText.text(),
                          answers:question.answers().map(function (answer,index) {
                              return answer.text.text();
                          }),
                          correctAnswers:function(){
                              var correctIndexes = [];
                              question.answers().forEach((a,i)=>{
                                  if(a.isCorrect()){
                                  correctIndexes.push(i);
                                }
                              });
                              return correctIndexes;
                          }()
                      }
                  }
                  else if(question.questionType == "open"){
                        return {
                            questionType:"open",
                            questionText:question.questionText.text()
                        }
                  }
              })
            };

            postData("../controllers/testController.php",testData);
                // .then(data => console.log(data)) // JSON from `response.json()` call
                // .catch(error => console.error(error));
        }
    };

    ko.applyBindings(new testVM());
})();