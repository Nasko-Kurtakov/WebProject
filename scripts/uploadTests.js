(function () {

    var postFiles = function (url,fileData) {
        fetch(url, {
            method:'POST',
            body:fileData
        }).then(function(res) {
            console.log('Status', res);
        }).catch(function(e) {
            console.log('Error',e);
        });
    };

    getJSONData("../controllers/templateController.php")
        .then(function (templates) {
            sendTestsVM.templatesList(templates);
        });

    var sendFiles = function() {
        var self = this;

        self.templatesList = ko.observableArray([]);
        self.testName = ko.observable(null);
        self.selectedTemplateId = ko.observable(null);

        self.selectTemplate = function(templateId){
          self.selectedTemplateId(templateId);
        };

        self.sendTests = function () {
            var input = document.querySelector('input[type="file"]');

            var formData = new FormData();
            if(input.files) {
                var fileList = input.files;
                for(var x=0;x<fileList.length;x++) {
                    formData.append(x+"", fileList.item(x));
                }
            }
            postFiles("../controllers/fileUploadController.php?tempName="+"testTemp"+"&tempId="+"20",formData);
        }
    };

    var sendTestsVM = new sendFiles();
    ko.applyBindings(sendTestsVM);
})();