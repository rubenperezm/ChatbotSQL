// The Api module is designed to handle all interactions with the server
var isPressed = false; // global var
var LastText = []; //array to implement backButton
var apiUrl;
var serverUrl;
function InsertLastText(Last){ // implement to insert news payloads like queue
  if(Object.entries(Last.input).length !== 0){ //condition to stop payloads with empty input
    if(LastText.length == 5){
      LastText.shift();
      LastText.push(Last);
    }else LastText.push(Last);
  }
}

var XHTTP  = new XMLHttpRequest();
function displayMessage (evt) {
    const usandoPromesas = (ruta) => {
        let promise = new Promise( (resolve, reject) => {
            XHTTP.onreadystatechange = (() => {
                if (XHTTP.readyState === 4)
                {
                    (XHTTP.status === 200)
                        ? resolve(JSON.parse(XHTTP.responseText))
                        : reject(`Error al consultar => ${ruta}`);
                }
            });
            XHTTP.open("GET", ruta);
            XHTTP.send();
        });

        return promise;
    }
    usandoPromesas("/env")
    .then( data =>{
      apiUrl = data.apiUrl;
      serverUrl = data.serverUrl;
      return usandoPromesas(data.apiUrl+"api/hosts")
    })
    .then( data => {
      var flag = false;
      for (var i = 0; i < data.length; i++) {
        if (evt.origin === data[i]) {
          flag = true;
        }
      }
      if (flag){
        if(getAbsolutePath() !== serverUrl+"/bot/"){
           include("js/conversation.js");
        }
        else{
          include("js/conversationComercial.js");
        }
      }
    })
    .catch(error => console.error(error));
  }

  function getAbsolutePath() {
      var loc = window.location;
      var pathName = loc.pathname.substring(0, loc.pathname.lastIndexOf('/') + 1);
      return loc.href.substring(0, loc.href.length - ((loc.pathname + loc.search + loc.hash).length - pathName.length));
  }

  function include(file_path){
  	var j = document.createElement("script");
  	j.type = "text/javascript";
  	j.src = file_path;
  	document.body.appendChild(j);
  }

   if (window.addEventListener) {
     window.addEventListener("message", displayMessage, false);
   }
   else {
     window.attachEvent("onmessage", displayssage);
   }


var Api = (function() {
  var requestPayload;
  var responsePayload;
  var messageEndpoint = '/api/message';

  // Publicly accessible methods defined
  return {
    sendRequest: sendRequest,

    // The request/response getters/setters are defined here to prevent internal methods
    // from calling the methods without any of the callbacks that are added elsewhere.
    getRequestPayload: function() {
      return requestPayload;
    },
    setRequestPayload: function(newPayloadStr) {
      requestPayload = JSON.parse(newPayloadStr);
    },
    getResponsePayload: function() {
      return responsePayload;
    },
    setResponsePayload: function(newPayloadStr) {
      responsePayload = JSON.parse(newPayloadStr);
    }
  };

  // Send a message request to the server
  function sendRequest(text, context) {
    // Build request payload
    var payloadToWatson = {};
    if (text) {
      payloadToWatson.input = {
        text: text
      };
    }

    if (context) {
      payloadToWatson.context = context;
    }

    // Built http request
    var http = new XMLHttpRequest();
    http.open('POST', messageEndpoint, true);
    http.setRequestHeader('Content-type', 'application/json');
    http.onreadystatechange = function() {
      if (http.readyState === 4 && http.status === 200 && http.responseText) {
        Api.setResponsePayload(http.responseText);
      }
    };

    var params = JSON.stringify(payloadToWatson);

    // Stored in variable (publicly visible through Api.getRequestPayload)
    // to be used throughout the application
    if (Object.getOwnPropertyNames(payloadToWatson).length !== 0) {
      Api.setRequestPayload(params);
    }

    // Send request
    http.send(params);
  }
}());
