(function () {

    var url = new URL(window.location.href);
    var templateId = url.searchParams.get("tempId");

    getJSONData("../controllers/testController.php",{templateId:templateId})
        .then(function(testArray){
            scoreTest.setTests(testArray);
        }).then(function () {
            getJSONData("../controllers/templateController.php",{id:templateId})
                .then(function(dataAsJSON){
                    scoreTest.createTemplate(dataAsJSON);
                });
        });

    ko.bindingHandlers.testScorer = {
        init: function (element, valueAccessor, allBindings, viewModel) {

            var scoreTestVM = valueAccessor();
            scoreTestVM.subscribeVisibleAreas(function (array) {
                array.forEach(function (selectionArea) {
                    createVisibleArea(selectionArea,"#f2ff0073");
                });
            });

            scoreTestVM.subscribeHiddenAreas(function (hiddenArray) {
                hiddenArray.forEach(function (element) {
                    createVisibleArea(element,"#000");
                });
            });


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

            var $selectionCanvas = $("#selection-canvas");

            scoreTestVM.testCreated.subscribe(function (test) {
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
            });

            ko.utils.domNodeDisposal.addDisposeCallback(element, function () {
            });
        }
    };

    var scoreTestVM = function () {
        var self = this;

        self.numOfQuestions = ko.observable(0);
        self.answers = ko.observableArray([]);
        self.testCreated = ko.observable(false);
        self.currentTest = ko.observable(null);
        self.mark = ko.observable("");
        var areasToShow = ko.observableArray([]);
        var areasToHide = ko.observableArray([]);
        var testsToScore = [];

        var nextTest = function () {
          var nextTestIndex = testsToScore.indexOf(self.currentTest())+1;
          if(nextTestIndex!=testsToScore.length){
              self.currentTest(testsToScore[nextTestIndex]);
              setAnswers();
          }else {
              self.currentTest(null);
          }
        };

        var setAnswers = function () {
            var answers = [];
            for(var i=0;i<self.numOfQuestions();i++){
                answers.push({
                    isCorrect:ko.observable(false),
                    comment:ko.observable("")
                });
            }
            self.answers(answers);
            self.mark("");
        };

        self.scoreTest = function () {
            postJSONData("../controllers/testController.php",{
                test_id:this.currentTest().test_id,
                mark:this.mark()
            }).then(function () {
                nextTest();
            });
        };


        self.createTemplate = function(JSONData){
            self.testCreated(true);
            areasToHide(JSONData.hidden);
            areasToShow(JSONData.visible);
            self.numOfQuestions(JSONData.question_num);
            setAnswers();
        };

        self.setTests = function(testArray){
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


    };

    var scoreTest = new scoreTestVM();

    ko.applyBindings(scoreTest);
})();