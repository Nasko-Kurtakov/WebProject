(function () {

    /*var postFiles = function (url,fileData) {
        return fetch(url, {
            method:'POST',
            body:fileData
        }).then(function(res) {
            console.log('Status', res);
        }).catch(function(e) {
            console.log('Error',e);
        });
    };*/

    getJSONData("../controllers/templateController.php")
        .then(function (templates) {
            sendTestsVM.templatesList(templates);
        });

    var sendFiles = function() {
        var self = this;

        self.templatesList = ko.observableArray([]);
        self.testName = ko.observable("");
        self.selectedTemplate = ko.observable(null);
        self.testFiles = ko.observable(null);
        self.success = ko.observable("");
        self.error = ko.observable("");

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

        self.onFilesSelectedEvent = function(vm,e){
          self.testFiles(e.target.files);
        };

        self.selectTemplate = function(templateVM){
          self.selectedTemplate(templateVM);
        };

        self.sendTests = function () {
            if (!self.selectedTemplate()) {
                self.error("Изберете шаблон, към който да бъдат прикачени тестовете.");
                return;
            }
            var input = document.querySelector('input[type="file"]');
            if (self.testFiles() == null || self.testFiles().length == 0) {
                self.error("Няма избрани файлове.");
                return;
            }
            var formData = new FormData();
            for (var x = 0; x < self.testFiles().length; x++) {
                formData.append(x + "", self.testFiles().item(x));
            }
            postFiles("../controllers/fileUploadController.php?tempName=" + self.selectedTemplate().name + "&tempId=" + self.selectedTemplate().id, formData)
            .then(function (response) {
                if(response==1){
                    self.success("Файловете бяха качени.");
                }
            })
        };
    };

    var sendTestsVM = new sendFiles();
    ko.applyBindings(sendTestsVM);
})();