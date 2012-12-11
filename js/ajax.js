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

function Request(){    // Envio de la peticion
    CreateXmlHttpRequest(); // Inicializar objeto XMLHttpRequest

    //Obtenemos los datos de los campos de texto y los asignamos a variables
    var nom = document.request.nombre.value;
    var pat = document.request.paterno.value;
    var mat = document.request.materno.value;
    var mes = document.request.mes.value;
    var dia = document.request.dia.value;
    var anio = document.request.anio.value;
    var pass = document.request.pass.value;
    var pass2 = document.request.pass2.value;
    var email = document.request.email.value;
    var pais = document.request.pais.value;
    var ciudad = document.request.ciudad.value;

    
    if(pass == pass2){
        if(XmlHttpRequest != false) {   // Validacion del objeto XMLHttpRequest
            XmlHttpRequest.open('POST', '../../php-control/dispatcher.php', true);    // Se abre la peticion con el servidor (POST)
            XmlHttpRequest.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            XmlHttpRequest.onreadystatechange = function () {
                if (XmlHttpRequest.readyState == 4 && XmlHttpRequest.status == 200) {
                    XmlResponse = XmlHttpRequest.responseXML;
                    ResponseManager();  // La respuesta es tratada
                }
            }
            XmlHttpRequest.send('nombre=' + nom + '&paterno=' + pat + '&materno=' + mat + '&mes=' + mes + '&dia=' + dia + '&anio=' + anio + '&pass=' + pass + '&email=' + email + '&pais=' + pais + '&ciudad=' + ciudad);
        }
        else {
            XmlResponse = null;
            alert('Can\'t create XMLHttpRequest object on your browser!');
        }
    }else{
        alert('La contraseña no coincide! Favor de revisar.');
    }
}

function ResponseManager() {
    if (XmlResponse != null) {
        var DivResponse = document.getElementById('response');
        var TagValue = XmlResponse.getElementsByTagName('Value');   // Obtiene el valor de la etiqueta 'Value' de XmlResponse
        var aux = '';
        aux = aux + TagValue[0].firstChild.nodeValue;    // Obtiene los resultados del query y los incorpora a etiquetas LI
        DivResponse.innerHTML = aux;     // Incorpora a la etiqueta UL el conjunto de etiquetas LI
        document.request.nombre.value = '';
        document.request.paterno.value = '';
        document.request.materno.value = '';
        document.request.mes.value = 'Mes';
        document.request.dia.value = 'Día';
        document.request.anio.value = 'Año';
        document.request.pass.value = '';
        document.request.pass2.value = '';
        document.request.email.value = '';
        document.request.pais.value = '';
        document.request.ciudad.value = '';
    }
}