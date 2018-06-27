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

        self.error = ko.observable("");

        self.selectTemplate = function(templateVM){
          self.selectedTemplate(templateVM);
        };

        self.sendTests = function () {
            if (!self.testName()) {
                self.error("Попълнете има на групата тестове.");
                return;
            }
            if (!self.selectedTemplate()) {
                self.error("Изберете шаблон, към който да бъдат прикачени тестовете.");
                return;
            }
            var input = document.querySelector('input[type="file"]');
            if (input.files.length == 0) {
                self.error("Няма избрани файлове.");
                return;
            }
            var formData = new FormData();
            var fileList = input.files;
            for (var x = 0; x < fileList.length; x++) {
                formData.append(x + "", fileList.item(x));
            }
            postFiles("../controllers/fileUploadController.php?assignedTo=" +"tempName=" + self.testName() + "&tempId=" + self.selectedTemplate().id, formData);
        };
    };

    var sendTestsVM = new sendFiles();
    ko.applyBindings(sendTestsVM);
})();