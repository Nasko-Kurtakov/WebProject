(function () {
    ko.bindingHandlers.enterKey = {
        init: function (element, valueAccessor, allBindings, viewModel) {
            var callback = valueAccessor();
            element.addEventListener("keypress",function (event) {
                var keyCode = (event.which ? event.which : event.keyCode);
                if (keyCode === 13) {
                    callback.call(viewModel);
                    return false;
                }
                return true;
            });
        }
    };

    function postJSONData(url, data) {
        // Default options are marked with *
        return fetch(url, {
            body: JSON.stringify(data), // must match 'Content-Type' header
            headers:{
                'Content-Type': 'application/json'
            },
            method: 'POST'
        })
        .then(function(res){
           return res.json()
        })
        .catch(function(error){
            console.error('Error:', error);
            return;
        })
        .then(function(response){
            console.log('Success:', response);
            return;
        });
    }

    window.postJSONData = postJSONData;

})();