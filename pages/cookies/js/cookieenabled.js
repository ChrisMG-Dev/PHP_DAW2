/**
 * Script que detecta si el navegador cliente tiene los cookies
 * activados
 */

window.onload = function () {
    
    var cookieEnabled;
    
    if (navigator.cookieEnabled) {
       cookieEnabled = "Activado";
    }
    
    else {
        cookieEnabled = "Desactivado";
    }
    
    document.getElementById("cookie").innerHTML = cookieEnabled;
};


