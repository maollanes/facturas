
var XmlHttpRequest;     // Peticion
var XmlResponse;        // Respuesta

function CreateXmlHttpRequest() {   // Creacion del objeto XMLHttpRequest (Cross-Browser)
    try {
        XmlHttpRequest = new XMLHttpRequest();
    }
    catch (e) {
        try {
            XmlHttpRequest = new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch (e) {
            try {
                XmlHttpRequest = new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch (e) {
                XmlHttpRequest = false;
            }
        }
    }
}

function Request(data) {    // Envio de la peticion
    CreateXmlHttpRequest(); // Inicializar objeto XMLHttpRequest

    if(XmlHttpRequest != false) {   // Validacion del objeto XMLHttpRequest
        XmlHttpRequest.open('POST', '../php-control/dispatcher.php', true);    // Se abre la peticion con el servidor (POST)
        XmlHttpRequest.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        XmlHttpRequest.onreadystatechange = function () {
            if (XmlHttpRequest.readyState == 4 && XmlHttpRequest.status == 200) {
                XmlResponse = XmlHttpRequest.responseXML;
                ResponseManager();  // La respuesta es tratada
            }
        }
        XmlHttpRequest.send('data=' + data);
    }
    else {
        XmlResponse = null;
        alert('Can\'t create XMLHttpRequest object on your browser!');
    }
}

function ResponseManager() {
    if (XmlResponse != null) {
        var TextFieldResponse = document.getElementById('response');
        var TagValue = XmlResponse.getElementsByTagName('Value');       // Obtiene el valor de la etiqueta 'Value' de XmlResponse
        TextFieldResponse.value = TagValue[0].firstChild.nodeValue;     // Asigna el valor al campo de texto 'response'
    }
}