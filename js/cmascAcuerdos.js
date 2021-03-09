

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

function openTabAcuerd2(evt, pagina, idEnlace, anio, mes){
	
	tablinks = document.getElementsByClassName("tablinksAcerd");
	for (i = 0; i < tablinks.length; i++) {
		tablinks[i].className = tablinks[i].className.replace(" active", "");
	}
	
	evt.currentTarget.className += " active";
	//anio = document.getElementById("anioCmasc").value;
	//mes = document.getElementById("mesCmasc").value; 
		///// INGRESAR A LA PAGINA CORRESPONDIENTE MEDIANTE AJAX

		cont = document.getElementById('contentTabs');

		ajax=objetoAjax();
		ajax.open("POST", "format/cmasc-Acuerdos/"+pagina);

		ajax.onreadystatechange = function(){
			if (ajax.readyState == 4 && ajax.status == 200) {
				cont.innerHTML = ajax.responseText;

			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("&idEnlace="+idEnlace+"&anio="+anio+"&mes="+mes);

	}



function getCuadernAcuer(nuc, idEnlace){

	cont = document.getElementById('contAcuerdDiv');		

	ajax=objetoAjax();
	ajax.open("POST", "format/cmasc-Acuerdos/cuadernAcuerd.php");
	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {				
			cont.innerHTML = ajax.responseText;	

			openTabAcuerd2(event, 'cuadern.php', idEnlace, 2021, 1);
			tablinks = document.getElementsByClassName("tablinksAcerd"); 
			tablinks[0].className = tablinks[0].className += " active";
			

		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("&nuc="+nuc+"&idEnlace="+idEnlace);	

}



