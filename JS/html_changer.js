var READY = 4;
var DONE = 200;
var id_cambiando = "";
var http_request = false;
var SYNCHRONOUS = false;

function cambiarInnerHTML(id_elemento, request){
    id_cambiando = id_elemento;
    makeRequest(request);
}

function makeRequest(url) {
    if (window.XMLHttpRequest) { // Mozilla, Safari,...
        http_request = new XMLHttpRequest();
    }
    if (!http_request) {
        alert('Falla :( No es posible crear una instancia XMLHTTP');
        return false;
    }
    http_request.onreadystatechange = requestDone;  
    http_request.open('GET', url, SYNCHRONOUS);
    http_request.send(null);
}
        
function requestDone() {
    if (http_request.readyState == READY) {
        if (http_request.status == DONE) {
            document.getElementById(id_cambiando).innerHTML = http_request.responseText;
        } else {
            alert('Hubo problemas con la petición.');
        }
    }
}
