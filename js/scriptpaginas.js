
function objetoAjax(){
    var xmlhttp=false;
    try {
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
        try {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (E) {
            xmlhttp = false;
		}
	}
	
    if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
        xmlhttp = new XMLHttpRequest();
	}
    return xmlhttp;
}
function MostrarPagina(pagina){

    cont = document.getElementById('container');
    ajax=objetoAjax();
    ajax.open("POST", pagina);
    ajax.onreadystatechange = function(){
        if (ajax.readyState == 4 && ajax.status == 200) {
            cont.innerHTML = ajax.responseText;
			
			
			
		}
	}
    ajax.send(null);
}
function valores_captura(sel) {
	
	var delito = document.getElementById("modalidad").value;
	var fechainicio = document.getElementById("fechainit").value;
	var fechafin = document.getElementById("fechaend").value;
	var fiscalia=document.getElementById("fiscalia").value;
	
alert (delit+" "+fechainicio+" "+fechafin+" "+fiscalia);
	
}













