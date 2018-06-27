(function () {

    var userId = parseInt(sessionStorage.getItem("userId"));

    getJSONData("../controllers/templateController.php?userId="+userId)
        .then(function (templatesArray) {
            templatesOverviewVM.templatesCollection(templatesArray);
        });

    ko.bindingHandlers.testScorer = {
        init: function (element, valueAccessor, allBindings, viewModel) {
            var scoreTestVM = valueAccessor();
            setTimeout(function () {
                var $selectionCanvas = $("#selection-canvas");
                $selectionCanvas.attr({
                    width: $(element).width(),
                    height: $(element).height()
                });
                $selectionCanvas.css({
                    top: 0,
                    left: 0,
                    display: "block",
                    width: $(element).width(),
                    height: $(element).height()
                });

                scoreTestVM.areasToShow().forEach(function (selectionArea) {
                    createVisibleArea(selectionArea,"#f2ff0073");
                });

                scoreTestVM.areasToHide().forEach(function (element) {
                    createVisibleArea(element,"#000");
                });
            },100);

            var createVisibleArea = function (data,color) {
                var canvas = document.getElementById("selection-canvas");
                var ctx = canvas.getContext('2d');
                ctx.beginPath();
                ctx.lineWidth="6";
                ctx.fillStyle=color;
                // ctx.fillRect(data.left, data.top, data.width, data.height);
                ctx.fillRect(data.left*0.8, data.top*0.8, data.width*0.8, data.height*0.8);
                ctx.stroke();
            };

            ko.utils.domNodeDisposal.addDisposeCallback(element, function () {
            });
        }
    };

    var scoreTestVM = function (template) {
        var self = this;

        self.numOfQuestions = template.question_num;
        self.answers = ko.observableArray([]);
        self.testCreated = ko.observable(false);
        self.currentTest = ko.observable(null);
        self.mark = ko.observable("");
        self.areasToShow = ko.observableArray(template.visible);
        self.areasToHide = ko.observableArray(template.hidden);
        var testsToScore = [];

        var nextTest = function () {
          var nextTestIndex = testsToScore.indexOf(self.currentTest())+1;
          if(nextTestIndex!=testsToScore.length){
              self.currentTest(testsToScore[nextTestIndex]);
              resetTestScorer();
          }else {
              self.currentTest(null);
          }
        };

        var resetTestScorer = function () {
            var answers = [];
            for(var i=0;i<self.numOfQuestions;i++){
                answers.push({
                    isCorrect:ko.observable(false),
                    comment:ko.observable("")
                });
            }
            self.answers(answers);
            self.mark("");
        };

        var init = function(){
            getJSONData("../controllers/testController.php",{templateId:template.id})
            .then(function(testArray){
                resetTestScorer();
                setTests(testArray);
            })
        };

        self.scoreTest = function () {

            var correctAnswers = self.answers().reduce(function(prev,current){
                return current.isCorrect()==="true" ? prev+1:prev;
            },0);

            var comments = self.answers().map(function (answer) {
                return answer.comment();
            });

            postJSONData("../controllers/testController.php",{
                test_id:this.currentTest().test_id,
                correct_answers:(correctAnswers+"/"+self.numOfQuestions),
                comments:comments,
                mark:this.mark()
            }).then(function () {
                nextTest();
            });
        };

        var setTests = function(testArray){
            testsToScore = testArray;
            if(!!testsToScore.length){
                self.currentTest(testsToScore[0]);
            }
        };

        self.subscribeVisibleAreas = function (callback) {
            areasToShow.subscribe(callback);
        };

        self.subscribeHiddenAreas = function (callback) {
            areasToHide.subscribe(callback);
        };

        init();

    };

    var scoreTest = ko.observable(null);

    var templatesOverview = function () {
        var self=this;

        self.templatesCollection = ko.observableArray([]);
        self.selectedTemplate = ko.observable(null);
        self.selectTemplate = function (template) {
            self.selectedTemplate(template);
        }
    };
    var templatesOverviewVM = new templatesOverview();

    templatesOverviewVM.selectedTemplate.subscribe(function (selectedTemplate) {
        scoreTest(new scoreTestVM(selectedTemplate));
    });

    var scoreTestPageVM = {
        templatesOverview:templatesOverviewVM,
        scoreTestView: scoreTest
    };

    ko.applyBindings(scoreTestPageVM);
})();