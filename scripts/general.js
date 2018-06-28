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
        // .then(function(res){
        //    return res.json()
        // })
        .catch(function(error){
            console.error('Error:', error);
            return;
        })
        // .then(function(response){
        //     console.log('Success:', response);
        //     return;
        // });
    }

    function encodeData(data) {
        var encoded = Object.keys(data).map(function(key) {
            return [key, data[key]].map(encodeURIComponent).join("=");
        }).join("&");

        return !!encoded ? "?"+encoded : encoded;
    }

    function getJSONData(url,paramsObs){
        var paramsAsString = encodeData(paramsObs||{});
        var urlWithParams = url + paramsAsString;
        return fetch(urlWithParams,{
            credentials: 'same-origin',
            method:"GET"
        }).then(function(response) {
                return response.json();
            })
            .then(function(myJson) {
                return myJson;
            });
    }

    function postFiles (url,fileData) {
        return fetch(url, {
            method:'POST',
            credentials: 'same-origin',
            body:fileData
        }).then(function(res) {
            return res.text();
        }).then(function(myJson) {
            return myJson;
        }).catch(function(e) {
            console.log('Error',e);
        });
    };

    window.postJSONData = postJSONData;
    window.getJSONData = getJSONData;
    window.postFiles = postFiles;
})();