var ejercicio;
var uuidIntento;
var plataforma;
var empiezo = 0;

function displayMessage (evt) {
  console.log(evt.data);
  plataforma = evt.origin;
  if(empiezo === 0){
    uuidIntento = evt.data[2];
    ejercicio  = evt.data;
    ConversationPanel.init();
    empiezo++;
  }else{
    if(evt.data.indexOf("ErrorVialaravel") > -1){
      console.log("entre donde tengo que entrar");
      ConversationPanel.sendMessage(evt.data);
    }
    else{
      if(evt.data.indexOf("finalConversacionCorrectolaravel") > -1){
        ConversationPanel.sendMessage(evt.data);
      }else{
        var XHTTP  = new XMLHttpRequest();
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
        usandoPromesas("http://52.207.88.40/TFG/App/public/api/apiEjercicio/show/" + evt.data[3])
        .then( data =>{
          console.log(evt.data[2]);
          var enunciado = JSON.parse(data[0]['enunciado']);
          var ayuda = JSON.parse(data[0]['ayuda']);
          if(typeof(enunciado[evt.data[0]]) !== "undefined" && typeof(ayuda[evt.data[0]-1]) !== "undefined"){
            ConversationPanel.sendMessage(evt.data[1],enunciado[evt.data[0]]['texto'],ayuda[evt.data[0]-1]['texto'],evt.data[2]);
          }else{
            console.log("no existe");
          }
        })
        .catch(error => console.error(error));
      }
    }
  }
}

if (window.addEventListener) {
  window.addEventListener("message", displayMessage, false);
}
else {
  window.attachEvent("onmessage", displayMessage);
}




var ConversationPanel = (function () {
  var settings = {
    selectors: {
      chatBox: '#scrollingChat',
      fromUser: '.from-user',
      fromWatson: '.from-watson',
      latest: '.latest'
    },
    authorTypes: {
      user: 'user',
      watson: 'watson'
    }
  };

  // Publicly accessible methods defined
  return {
    init: init,
    inputKeyDown: inputKeyDown,
    sendMessage: sendMessage
  };

  // Initialize the module
  function init() {
    var XHTTP  = new XMLHttpRequest();
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
    usandoPromesas("http://52.207.88.40/TFG/App/public/api/apiEjercicio/show/" + ejercicio[1])
    .then( data =>{
      console.log(data)
      var enunciado = JSON.parse(data[0]['enunciado']);
      var ayuda = JSON.parse(data[0]['ayuda']);
      chatUpdateSetup();
      var context = {};
      context.enunciadoEjercicio = enunciado[0]['texto'];
      context.enunciadoClausula = enunciado[1]['texto'];
      context.ayudaClausula = ayuda[0]['texto'];
      console.log(context.ayudaClausula);
      Api.sendRequest(ejercicio[0], context);
      setupInputBox();
    })
    .catch(error => console.error(error));
  }
  // Set up callbacks on payload setters in Api module
  // This causes the displayMessage function to be called when messages are sent / received
  function chatUpdateSetup() {
    var currentRequestPayloadSetter = Api.setRequestPayload;
    console.log(currentRequestPayloadSetter);
    Api.setRequestPayload = function (newPayloadStr) {
      currentRequestPayloadSetter.call(Api, newPayloadStr);
      displayMessage(JSON.parse(newPayloadStr), settings.authorTypes.user);
    };

    var currentResponsePayloadSetter = Api.setResponsePayload;
    Api.setResponsePayload = function (newPayloadStr) {
      currentResponsePayloadSetter.call(Api, newPayloadStr);
      displayMessage(JSON.parse(newPayloadStr), settings.authorTypes.watson);
    };
  }

  // Set up the input box to underline text as it is typed
  // This is done by creating a hidden dummy version of the input box that
  // is used to determine what the width of the input text should be.
  // This value is then used to set the new width of the visible input box.
  function setupInputBox() {
    var input = document.getElementById('textInput');
    var dummy = document.getElementById('textInputDummy');
    var minFontSize = 14;
    var maxFontSize = 16;
    var minPadding = 4;
    var maxPadding = 6;

    // If no dummy input box exists, create one
    if (dummy === null) {
      var dummyJson = {
        'tagName': 'div',
        'attributes': [{
          'name': 'id',
          'value': 'textInputDummy'
        }]
      };

      dummy = Common.buildDomElement(dummyJson);
      document.body.appendChild(dummy);
    }

    function adjustInput() {
      if (input.value === '') {
        // If the input box is empty, remove the underline
        input.classList.remove('underline');
        input.setAttribute('style', 'width:' + '100%');
        input.style.width = '100%';
      } else {
        // otherwise, adjust the dummy text to match, and then set the width of
        // the visible input box to match it (thus extending the underline)
        input.classList.add('underline');
        var txtNode = document.createTextNode(input.value);
        ['font-size', 'font-style', 'font-weight', 'font-family', 'line-height',
        'text-transform', 'letter-spacing'
      ].forEach(function (index) {
        dummy.style[index] = window.getComputedStyle(input, null).getPropertyValue(index);
      });
      dummy.textContent = txtNode.textContent;

      var padding = 0;
      var htmlElem = document.getElementsByTagName('html')[0];
      var currentFontSize = parseInt(window.getComputedStyle(htmlElem, null).getPropertyValue('font-size'), 10);
      if (currentFontSize) {
        padding = Math.floor((currentFontSize - minFontSize) / (maxFontSize - minFontSize) *
        (maxPadding - minPadding) + minPadding);
      } else {
        padding = maxPadding;
      }

      var widthValue = (dummy.offsetWidth + padding) + 'px';
      input.setAttribute('style', 'width:' + widthValue);
      input.style.width = widthValue;
    }
  }

  // Any time the input changes, or the window resizes, adjust the size of the input box
  input.addEventListener('input', adjustInput);
  window.addEventListener('resize', adjustInput);

  // Trigger the input event once to set up the input box and dummy element
  Common.fireEvent(input, 'input');
}

// Display a user or Watson message that has just been sent/received
function displayMessage(newPayload, typeValue) {
  var isLaravel = true
  var isUser = isUserMessage(typeValue);
  var textExists = (newPayload.input && newPayload.input.text) ||
  (newPayload.output && newPayload.output.text);
  if (isUser !== null && textExists) {
    // Create new message generic elements
    if(newPayload.input.text.indexOf("laravel") > -1 && typeValue == settings.authorTypes.user) isLaravel = false;
    else var responses = buildMessageDomElements(newPayload, isUser,isLaravel);
    var chatBoxElement = document.querySelector(settings.selectors.chatBox);
    var previousLatest = chatBoxElement.querySelectorAll((isUser ? settings.selectors.fromUser : settings.selectors.fromWatson) +
    settings.selectors.latest);
    // Previous "latest" message is no longer the most recent
    if (previousLatest) {
      Common.listForEach(previousLatest, function (element) {
        element.classList.remove('latest');
      });
    }
    setResponse(responses, isUser, chatBoxElement, 0, true, isLaravel);
  }
}
// Recurisive function to add responses to the chat area
function setResponse(responses, isUser, chatBoxElement, index, isTop, isLaravel) {
  if(isLaravel){
    if (index < responses.length) {
      var res = responses[index];
      if (res.type !== 'pause') {
        var currentDiv = getDivObject(res, isUser, isTop);
        chatBoxElement.appendChild(currentDiv);
        // Class to start fade in animation
        currentDiv.classList.add('load');
        // Move chat to the most recent messages when new messages are added
        scrollToChatBottom();
        setResponse(responses, isUser, chatBoxElement, index + 1, false, isLaravel);
      } else {
        var userTypringField = document.getElementById('user-typing-field');
        if (res.typing) {
          userTypringField.innerHTML = 'Watson Assistant Typing...';
        }
        setTimeout(function () {
          userTypringField.innerHTML = '';
          setResponse(responses, isUser, chatBoxElement, index + 1, isTop, isLaravel);
        }, res.time);
      }
    }
    var respuestas = document.getElementsByClassName("mensajesConver");
    var conversacion = new Object();
    for (var i = 0; i < respuestas.length; i++) {
      var conver = new Object();
      if(respuestas[i].classList.contains("mensajeUsuario")){
        conver['mensajeUsuario']= respuestas[i].innerHTML;
      }
      if(respuestas[i].classList.contains("mensajeWatson")){
        conver['mensajeWatson']= respuestas[i].innerHTML;
      }
      conversacion[i] = conver;
    }
    console.log(conversacion);
    var xmlhttp = new XMLHttpRequest();
    var theUrl = "http://52.207.88.40/TFG/App/public/api/apiEjercicio/storeConversacion";
    xmlhttp.open("POST", theUrl, true);
    xmlhttp.setRequestHeader("Content-Type", "text/plain");
    xmlhttp.send(JSON.stringify({'conversacion': JSON.stringify(conversacion), 'mensajes': respuestas.length, 'uuidIntento': uuidIntento}));
  }
}

// Constructs new DOM element from a message
function getDivObject(res, isUser, isTop) {
  var classes = [(isUser ? 'from-user' : 'from-watson'), 'latest', (isTop ? 'top' : 'sub')];
  var messageJson = {
    // <div class='segments'>
    'tagName': 'div',
    'classNames': ['segments'],
    'children': [{
      // <div class='from-user/from-watson latest'>
      'tagName': 'div',
      'classNames': classes,
      'children': [{
        // <div class='message-inner'>
        'tagName': 'div',
        'classNames': ['message-inner'],
        'children': [{
          // <p>{messageText}</p>
          'tagName': 'p',
          'classNames': ['mensajesConver',(isUser ? 'mensajeUsuario' : 'mensajeWatson')],
          'text': res.innerhtml
        }]
      }]
    }]
  };
  return Common.buildDomElement(messageJson);
}

// Checks if the given typeValue matches with the user "name", the Watson "name", or neither
// Returns true if user, false if Watson, and null if neither
// Used to keep track of whether a message was from the user or Watson
function isUserMessage(typeValue) {
  if (typeValue === settings.authorTypes.user) {
    return true;
  } else if (typeValue === settings.authorTypes.watson) {
    return false;
  }
  return null;
}

function getOptions(optionsList, preference) {
  var list = '';
  var i = 0;
  if (optionsList !== null) {
    if (preference === 'text') {
      list = '<ul>';
      for (i = 0; i < optionsList.length; i++) {
        if (optionsList[i].value) {
          list += '<li><div class="options-list" onclick="ConversationPanel.sendMessage(\'' +
          optionsList[i].value.input.text + '\');" >' + optionsList[i].label + '</div></li>';
        }
      }
      list += '</ul>';
    } else if (preference === 'button') {
      list = '<br>';
      for (i = 0; i < optionsList.length; i++) {
        if (optionsList[i].value) {
          var item = '<div class="options-button" onclick="ConversationPanel.sendMessage(\'' +
          optionsList[i].value.input.text + '\');" >' + optionsList[i].label + '</div>';
          list += item;
        }
      }
    }
  }
  return list;
}

function getResponse(responses, gen) {
  var title = '';
  if (gen.hasOwnProperty('title')) {
    title = gen.title;
  }
  if (gen.response_type === 'image') {
    var img = '<div><img style="cursor:pointer;" onclick="agrandarFoto(this);" src="' + gen.source + '" width="300"></div>';
    responses.push({
      type: gen.response_type,
      innerhtml: title + img
    });
  } else if (gen.response_type === 'text') {
    responses.push({
      type: gen.response_type,
      innerhtml: gen.text
    });
  } else if (gen.response_type === 'pause') {
    responses.push({
      type: gen.response_type,
      time: gen.time,
      typing: gen.typing
    });
  } else if (gen.response_type === 'option') {
    var preference = 'text';
    if (gen.hasOwnProperty('preference')) {
      preference = gen.preference;
    }

    var list = getOptions(gen.options, preference);
    responses.push({
      type: gen.response_type,
      innerhtml: title + list
    });
  }
}

// Constructs new generic elements from a message payload
function buildMessageDomElements(newPayload, isUser, isLaravel) {
  if(isLaravel){
    var textArray = isUser ? newPayload.input.text : newPayload.output.text;
    if (Object.prototype.toString.call(textArray) !== '[object Array]') {
      textArray = [textArray];
    }

    var responses = [];

    if (newPayload.hasOwnProperty('output')) {
      if (newPayload.output.hasOwnProperty('generic')) {

        var generic = newPayload.output.generic;

        generic.forEach(function (gen) {
          getResponse(responses, gen);
        });
      }
    } else if (newPayload.hasOwnProperty('input')) {
      var input = '';
      textArray.forEach(function (msg) {
        input += msg + ' ';
      });
      input = input.trim()
      .replace(/&/g, '&amp;')
      .replace(/</g, '&lt;')
      .replace(/>/g, '&gt;');

      if (input.length !== 0) {
        responses.push({
          type: 'text',
          innerhtml: input
        });
      }
    }
    return responses;
  }

}

// Scroll to the bottom of the chat window
function scrollToChatBottom() {
  var scrollingChat = document.querySelector('#scrollingChat');
  scrollingChat.scrollTop = scrollingChat.scrollHeight;
}

function sendMessage(text, fromLaravelEnunciado = "", fromLaravelAyuda = "",fromLaravelComprobar = new Array()) {
  // Retrieve the context from the previous server response
  var context;
  var latestResponse = Api.getResponsePayload();
  if (latestResponse) {
    context = latestResponse.context;
  }
  if(fromLaravelEnunciado !== ""){
    context.enunciadoClausula = fromLaravelEnunciado;
    context.ayudaClausula = fromLaravelAyuda;
  }
  if(fromLaravelComprobar.length > 0){
    context.comprobarClausula = "";
    for (var i = 0; i < fromLaravelComprobar.length; i++) {
      if(i == 0){
        context.comprobarClausula = fromLaravelComprobar[i];
      }else{
        if(i+1 !== fromLaravelComprobar.length)  context.comprobarClausula = context.comprobarClausula + ", " + fromLaravelComprobar[i];
        else  context.comprobarClausula = context.comprobarClausula + " y " + fromLaravelComprobar[i];
      }
    }
  }
  // Send the user message
  Api.sendRequest(text, context);
}

// Handles the submission of input
function inputKeyDown(event, inputBox) {
  // Submit on enter key, dis-allowing blank messages
  if (event.keyCode === 13 && inputBox.value) {
    sendMessage(inputBox.value);
    // Clear input box for further messages
    inputBox.value = '';
    Common.fireEvent(inputBox, 'input');
  }
}
}());
