(function () {
    getJSONData("../controllers/templateController.php")
        .then(function (templatesArray) {
            templatesVM.templatesCollection(templatesArray);
        });

    var templatesOverview = function () {
        var self=this;

        self.templatesCollection = ko.observableArray([]);

        self.selectTemplate = function (templateID) {
            var newURLParts = window.location.pathname.split("/");
            newURLParts.pop();
            newURLParts.push("scoreTest.php?tempId="+templateID);
            var newUrl = newURLParts.reduce(function(prevURL,newURL){
                return prevURL+"/"+newURL;
            });
            newUrl = location.origin + newUrl;
            window.location.href = newUrl;
        }
    };

    var templatesVM = new templatesOverview();

    ko.applyBindings(templatesVM)
})();