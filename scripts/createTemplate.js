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
                if(!isDragging) return;
                isDragging=false;
                // $selectionCanvas.off("mousedown");
                // $selectionCanvas.off("mousemove");
                // $selectionCanvas.off("mouseup");
                var canvas = $selectionCanvas[0];
                var ctx = canvas.getContext('2d');
                ctx.clearRect(0, 0, $selectionCanvas.width(), $selectionCanvas.height()); //clear canvas
                $selectionCanvas.css({
                    top: 0,
                    left: 0,
                    // display: "none"
                });
                //     .attr({
                //     width: 0,
                //     height: 0
                // });

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
                }

                testTemplateVM.addArea(groupRect,selectionMode);

                e.stopPropagation();
                e.stopImmediatePropagation();
            };
            var selectionDragHandler = function (e) {
                if(!isDragging) return;
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
            }
            var selectionHandler = function (e) {
                isDragging=true;
                if (e.shiftKey) {
                    selectionMode = "hide";
                }
                else{
                    selectionMode = "show";
                }
                // $selectionCanvas.attr({
                //     width: $(element).width(),
                //     height: $(element).height()
                // });
                // $selectionCanvas.css({
                //     top: 0,
                //     left: 0,
                //     display: "block",
                //     width: $(element).width(),
                //     height: $(element).height()
                // });
                groupRect = {
                    top: (e.pageY - $selectionCanvas.offset().top),
                    left: (e.pageX - $selectionCanvas.offset().left),
                    width: 0,
                    height: 0
                };
                e.stopPropagation();
                e.stopImmediatePropagation();
                return false;
                // }
            };

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

            $selectionCanvas.on("mousedown", selectionHandler);
            $selectionCanvas.on('mousemove', selectionDragHandler);
            $selectionCanvas.on('mouseup', selectionEndHandler);

            ko.utils.domNodeDisposal.addDisposeCallback(element, function () {
                $(document).off("mousedown", multipleSelectionHandler);
            });
        }
    };

    var testTemplate = function () {
        var self = this;

        var areasToShow=ko.observableArray([]);
        var areasToHide=ko.observableArray([]);
        //mode - selection for hiding and selection for showing
        self.addArea=function (newArea,mode) {
            if(mode == "hide"){
                areasToHide.push(newArea);
            }
            if(mode=="show"){
                areasToShow.push(newArea);
            }
        };

        self.saveAreas=function () {
            let data = {
                name:"testTemp",
                testId:420,
                hidden:areasToHide(),
                visible:areasToShow()
            };
            postJSONData("../controllers/templateController.php",data)
                // .then()
        }

        self.subscribeToShowAreas = function (handler) {
            areasToShow.subscribe(handler,null,"arrayChange");
        }

        self.subscribeToHideAreas = function (handler) {
            areasToHide.subscribe(handler,null,"arrayChange");
        }
    };

    var testTemplateVM = new testTemplate();

    testTemplateVM.subscribeToShowAreas(function (changes) {
        changes.forEach((change)=>{
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
        changes.forEach((change)=>{
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