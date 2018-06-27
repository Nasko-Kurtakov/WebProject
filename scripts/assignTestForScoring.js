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

    getJSONData("../controllers/usersController.php?students=true")
        .then(function (users) {
          getJSONData("../controllers/templateController.php")
              .then(function (templates) {
                  var groups = [];
                  users.forEach(function (user) {
                      if (user["user_group"] && user["user_group"] !== "admin") {
                          groups.push(user["user_group"]);
                      }
                  });
                  groups = groups.filter(function (group,index,self) {
                      return self.indexOf(group) === index;
                  });

                  var templates = templates.map(function (template) {
                     return {id:template.id,name:template.name};
                  });

                  var assignTestVM = new assignTest(groups,users,templates);
                  ko.applyBindings(assignTestVM);
              })
        });

    var assignTest = function (groups,users,templates) {
        var self = this;

        self.groups = groups;
        self.templates = templates;
        var users = users;
        self.selectedGroup = ko.observable(null);
        self.selectedTemplate = ko.observable(null);
        self.error = ko.observable("");
        self.selectGroup = function (group) {
            self.selectedGroup(group);
        }

        self.selectTemplate = function (template) {
            self.selectedTemplate(template);
        };

        self.assign = function () {
            if(self.selectedTemplate() == null){
                self.error("Не е избран тест, който да се оценя.");
                return
            }
            if(self.selectedGroup() == null){
                self.error("Не е избрана група, която да оценя.");
                return;
            }
            var userIds = users.filter(function (user) {
                return user["user_group"] == self.selectedGroup();
            }).map(function (user) {
                return user["user_id"];
            });
            postJSONData("../controllers/testController.php",{users:userIds,templateId:self.selectedTemplate().id})
        }
    };

})();