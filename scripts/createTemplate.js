(function () {
    ko.bindingHandlers.templateSelection = {
        init: function (element, valueAccessor, allBindings, viewModel) {

            var testTemplateVM = valueAccessor();
            var selectionMode=null;
            var isDragging = false;
            var groupRect = null;
            var $selectionCanvas = $("#selection-canvas");
            var $markingCanvas = $("#marking-canvas");

            var selectionEndHandler = function (e) {
                $selectionCanvas.off('mousemove', selectionDragHandler);
                $selectionCanvas.off('mouseup', selectionEndHandler);

                var canvas = $selectionCanvas[0];
                var ctx = canvas.getContext('2d');
                ctx.clearRect(0, 0, $selectionCanvas.width(), $selectionCanvas.height()); //clear canvas
                $selectionCanvas.css({
                    top: 0,
                    left: 0
                });

                //when moving is from right to left width is a negative value and group is buggy
                if (groupRect.width < 0) {
                    groupRect.left = groupRect.left + groupRect.width; //move on the left
                    groupRect.width *= -1; //make it positive
                }

                //when we move up height is a negative value
                if (groupRect.height < 0) {
                    groupRect.top = groupRect.top + groupRect.height; //move on the left
                    groupRect.height *= -1; //make it positive
                }
                groupRect = {
                    top:Math.round(groupRect.top),
                    left:Math.round(groupRect.left),
                    width:Math.round(groupRect.width),
                    height:Math.round(groupRect.height)
                };

                testTemplateVM.addArea(groupRect,selectionMode);

                e.stopPropagation();
                e.stopImmediatePropagation();
            };
            var selectionDragHandler = function (e) {
                var canvas = $selectionCanvas[0];
                var ctx = canvas.getContext('2d');
                ctx.clearRect(0, 0, $selectionCanvas.width(), $selectionCanvas.height()); //clear canvas
                ctx.beginPath();
                ctx.setLineDash([10, 10]);
                groupRect.width = e.offsetX - groupRect.left;
                groupRect.height = e.offsetY - groupRect.top;
                ctx.rect(groupRect.left, groupRect.top, groupRect.width, groupRect.height);
                ctx.strokeStyle = 'black';
                ctx.lineWidth = 1;
                ctx.stroke();
                e.stopPropagation();
                return false;
            };
            var selectionHandler = function (e) {
                $selectionCanvas.on('mousemove', selectionDragHandler);
                $selectionCanvas.on('mouseup', selectionEndHandler);

                if (e.shiftKey) {
                    selectionMode = "hide";
                }
                else{
                    selectionMode = "show";
                }
                groupRect = {
                    top: (e.pageY - $selectionCanvas.offset().top),
                    left: (e.pageX - $selectionCanvas.offset().left),
                    width: 0,
                    height: 0
                };
                e.stopPropagation();
                e.stopImmediatePropagation();
                return false;
            };

            setTimeout(function () {
                //this is not a good way to do this,sync is needed;

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

                $markingCanvas.attr({
                    width: $(element).width(),
                    height: $(element).height()
                });
                $markingCanvas.css({
                    top: 0,
                    left: 0,
                    display: "block",
                    width: $(element).width(),
                    height: $(element).height()
                });
            },100);

            $selectionCanvas.on("mousedown", selectionHandler);


            ko.utils.domNodeDisposal.addDisposeCallback(element, function () {
                $selectionCanvas.off("mousedown", selectionHandler);
            });
        }
    };

    var testTemplate = function () {
        var self = this;
        /*private*/
        var areasToShow=ko.observableArray([]);
        var areasToHide=ko.observableArray([]);

        /*public*/
        self.testFile = ko.observable("");
        self.fileImg = ko.observable(null);
        self.testName = ko.observable("");
        self.isTestFileSelected = ko.observable(false);
        self.numOfQuestions = ko.observable("");
        self.error = ko.observable("");
        self.success = ko.observable("");
        self.isPrinting = ko.observable(false);

        self.testFile.subscribe(function (newValue) {
            if(!!newValue){
                var input = document.querySelector('input[type="file"]');
                if(input.value) {
                    var formData = new FormData();
                    var fileList = input.files;
                    for (var x = 0; x < fileList.length; x++) {
                        formData.append(x + "", fileList.item(x));
                    }

                    postFiles("../controllers/testForTemplate.php",formData)
                        .then(function (pathToImgFromServer) {
                            self.fileImg(pathToImgFromServer);
                            self.isTestFileSelected(true);
                        });
                }
            }
        });

        self.print=function () {
            self.isPrinting(true);
            var oldTitle = document.title;
            document.title = "Тест";
            window.print();
            document.title = oldTitle;
            self.isPrinting(false);
        };

        self.error.subscribe(function (newVal) {
            if(newVal!=""){
                setTimeout(function () {
                    self.error("");
                },5000);
            }
        });

        self.success.subscribe(function (newVal) {
            if(newVal!=""){
                setTimeout(function () {
                    self.success("");
                },5000);
            }
        });

        self.addArea=function (newArea,mode) {
            if(mode == "hide"){
                areasToHide.push(newArea);
            }
            if(mode=="show"){
                areasToShow.push(newArea);
            }
        };

        self.refreshFile= function () {
            self.testFile("");
            self.isTestFileSelected(false);
            self.fileImg("");
        };

        self.saveAreas=function () {
            if(self.numOfQuestions()==""){
                self.error("Попълнете броят въпроси на страницата");
                return;
            }
            if(self.testName()==""){
                self.error("Попълнете име на теста");
                return;
            }
            if(!self.testFile()){
                self.error("Не сте избрали файл");
                return;
            }
            if(areasToHide().length ==0 && areasToShow().length == 0){
                self.error("Не е нарисуван шаблон");
                return;
            }

            var data = {
                name:self.testName(),
                hidden:areasToHide(),
                visible:areasToShow(),
                numOfQuestions:self.numOfQuestions()
            };
            postJSONData("../controllers/templateController.php",data)
                .then(function (resonse) {
                    self.success("Шаблона е записан.");
                })
        };

        self.subscribeToShowAreas = function (handler) {
            areasToShow.subscribe(handler,null,"arrayChange");
        };

        self.subscribeToHideAreas = function (handler) {
            areasToHide.subscribe(handler,null,"arrayChange");
        }


    };

    var testTemplateVM = new testTemplate();

    testTemplateVM.subscribeToShowAreas(function (changes) {
        changes.forEach(function(change){
            if(change.status=="added"){
                var rect = change.value;
                var canvas = document.getElementById("marking-canvas");
                var ctx = canvas.getContext('2d');
                ctx.beginPath();
                ctx.lineWidth="6";
                ctx.fillStyle="#f2ff0073";
                //ctx.clearRect(0, 0, $selectionCanvas.width, $selectionCanvas.height); //clear canvas
                // ctx.beginPath();
                //ctx.setLineDash([10, 10]);
                ctx.fillRect(rect.left, rect.top, rect.width, rect.height);
                // ctx.strokeStyle = 'black';
                // ctx.lineWidth = 1;
                ctx.stroke();
            }
        });
    });

    testTemplateVM.subscribeToHideAreas(function (changes) {
        changes.forEach(function(change){
            if(change.status=="added"){
                var rect = change.value;
                var canvas = document.getElementById("marking-canvas");
                var ctx = canvas.getContext('2d');
                ctx.beginPath();
                ctx.lineWidth="6";
                ctx.fillStyle="#000000";
                //ctx.clearRect(0, 0, $selectionCanvas.width, $selectionCanvas.height); //clear canvas
                // ctx.beginPath();
                //ctx.setLineDash([10, 10]);
                ctx.fillRect(rect.left, rect.top, rect.width, rect.height);
                // ctx.strokeStyle = 'black';
                // ctx.lineWidth = 1;
                ctx.stroke();
            }
        });
    });

    ko.applyBindings(testTemplateVM);
})();