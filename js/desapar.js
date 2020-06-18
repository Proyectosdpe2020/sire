

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

function mostrarModalInfoDesapar(validado, idEnlace, mesCapturar, anioCaptura){


	cont = document.getElementById('contMOdalDesapaGen');

	ajax=objetoAjax();
	ajax.open("POST", "format/desaparecidos/modalGeneralDesap.php");

	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("&validado="+validado+"&idEnlace="+idEnlace+"&mesCapturar="+mesCapturar+"&anioCaptura="+anioCaptura);

}


/*function mostrarModalInfoDesapar(validado, idEnlace, mesCapturar, anioCaptura){


	cont = document.getElementById('contMOdalDesapaGen');

	ajax=objetoAjax();
	ajax.open("POST", "format/desaparecidos/modalGeneralDesap.php");

	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("&validado="+validado+"&idEnlace="+idEnlace+"&mesCapturar="+mesCapturar+"&anioCaptura="+anioCaptura);

}*/



