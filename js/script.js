

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

function loadBiEstadistics(idEnlace){

		if(idEnlace == 14 ){ var win = window.open('https://app.powerbi.com/view?r=eyJrIjoiZDU4OTdkZjItOWE2MC00OTQwLTkxNzEtYWU0YTQ4MjhlYThjIiwidCI6ImZjY2YwMTQ5LWYzNTQtNGU2My1hNzExLTA5YjkzYTE3NzVkMiIsImMiOjR9', '_blank'); }
		if(idEnlace == 1 ){ var win = window.open('https://app.powerbi.com/view?r=eyJrIjoiNDczY2FmOWUtY2Q4Yi00ZTFhLWJhZGYtYTMwMGFkZDVhMThhIiwidCI6ImZjY2YwMTQ5LWYzNTQtNGU2My1hNzExLTA5YjkzYTE3NzVkMiIsImMiOjR9', '_blank'); }
		if(idEnlace == 16 ){ var win = window.open('https://app.powerbi.com/view?r=eyJrIjoiNWQ5Zjc2YjUtNDMxZC00OTJlLTg1MGItMjZlMTgxZWI0MTJkIiwidCI6ImZjY2YwMTQ5LWYzNTQtNGU2My1hNzExLTA5YjkzYTE3NzVkMiIsImMiOjR9', '_blank'); }
		if(idEnlace == 22 ){ var win = window.open('https://app.powerbi.com/view?r=eyJrIjoiNTkwOGIwN2MtMTI1MC00OWUwLWI1MTItNjI1NjA1MjkxNzk5IiwidCI6ImZjY2YwMTQ5LWYzNTQtNGU2My1hNzExLTA5YjkzYTE3NzVkMiIsImMiOjR9', '_blank'); }
		if(idEnlace == 18 ){ var win = window.open('https://app.powerbi.com/view?r=eyJrIjoiZjQ2MGZlMzktMmRiMy00YTI5LWJiZjQtNTc1MWE5NTRmYjlmIiwidCI6ImZjY2YwMTQ5LWYzNTQtNGU2My1hNzExLTA5YjkzYTE3NzVkMiIsImMiOjR9', '_blank'); }
		if(idEnlace == 17 ){ var win = window.open('https://app.powerbi.com/view?r=eyJrIjoiZmYzZjliYmUtYmM3Mi00NTBjLThmMWItNDYwZDRlZDc2MWJhIiwidCI6ImZjY2YwMTQ5LWYzNTQtNGU2My1hNzExLTA5YjkzYTE3NzVkMiIsImMiOjR9', '_blank'); }
		if(idEnlace == 21 ){ var win = window.open('https://app.powerbi.com/view?r=eyJrIjoiNmEyMDNlYzAtMGQ2My00ZjgyLWIxZmQtOTQ2NjRhN2I1NmNiIiwidCI6ImZjY2YwMTQ5LWYzNTQtNGU2My1hNzExLTA5YjkzYTE3NzVkMiIsImMiOjR9', '_blank'); }
		if(idEnlace == 15 ){ var win = window.open('https://app.powerbi.com/view?r=eyJrIjoiZTY4NzljNjItODVmNS00NTZlLWI5YjktNmJlOTI5NmE3NGY0IiwidCI6ImZjY2YwMTQ5LWYzNTQtNGU2My1hNzExLTA5YjkzYTE3NzVkMiIsImMiOjR9', '_blank'); }
		if(idEnlace == 19 ){ var win = window.open('https://app.powerbi.com/view?r=eyJrIjoiZmYzYThmOTUtNzg1OC00MmVlLWJlZjMtNjM1OThiZGYyZWFiIiwidCI6ImZjY2YwMTQ5LWYzNTQtNGU2My1hNzExLTA5YjkzYTE3NzVkMiIsImMiOjR9', '_blank'); }
		if(idEnlace == 23 ){ var win = window.open('https://app.powerbi.com/view?r=eyJrIjoiNmMxNGQ1MjYtNTIzNC00MjIyLWJmZjAtOGU5NGNhMGRmNWI0IiwidCI6ImZjY2YwMTQ5LWYzNTQtNGU2My1hNzExLTA5YjkzYTE3NzVkMiIsImMiOjR9', '_blank'); }
		if(idEnlace == 31 ){ var win = window.open('https://app.powerbi.com/view?r=eyJrIjoiMjA5ZjBmYjItNzZkZi00NjI1LTk4MmMtZmE5NjZiOWM4ZDE2IiwidCI6ImZjY2YwMTQ5LWYzNTQtNGU2My1hNzExLTA5YjkzYTE3NzVkMiIsImMiOjR9', '_blank'); }
		if(idEnlace == 29 ){ var win = window.open('https://app.powerbi.com/view?r=eyJrIjoiMjA5ZjBmYjItNzZkZi00NjI1LTk4MmMtZmE5NjZiOWM4ZDE2IiwidCI6ImZjY2YwMTQ5LWYzNTQtNGU2My1hNzExLTA5YjkzYTE3NzVkMiIsImMiOjR9', '_blank'); }
		if(idEnlace == 27 ){ var win = window.open('https://app.powerbi.com/view?r=eyJrIjoiMjA5ZjBmYjItNzZkZi00NjI1LTk4MmMtZmE5NjZiOWM4ZDE2IiwidCI6ImZjY2YwMTQ5LWYzNTQtNGU2My1hNzExLTA5YjkzYTE3NzVkMiIsImMiOjR9', '_blank'); }
		if(idEnlace == 3 ){ var win = window.open('https://app.powerbi.com/view?r=eyJrIjoiMjA5ZjBmYjItNzZkZi00NjI1LTk4MmMtZmE5NjZiOWM4ZDE2IiwidCI6ImZjY2YwMTQ5LWYzNTQtNGU2My1hNzExLTA5YjkzYTE3NzVkMiIsImMiOjR9', '_blank'); }
		if(idEnlace == 5 ){ var win = window.open('https://app.powerbi.com/view?r=eyJrIjoiN2U3ZTZjY2MtNzA2YS00NzA3LTgxNTUtZmMyZGQ3M2QxNWViIiwidCI6ImZjY2YwMTQ5LWYzNTQtNGU2My1hNzExLTA5YjkzYTE3NzVkMiIsImMiOjR9&pageName=ReportSectionb8b91ccc43aec5e1d655', '_blank'); }
		if(idEnlace == 26 ){ var win = window.open('https://app.powerbi.com/view?r=eyJrIjoiZGRlYTRhOGEtMTRhNC00M2YyLTlkMTktMGY1YmQxZDM1MTczIiwidCI6ImZjY2YwMTQ5LWYzNTQtNGU2My1hNzExLTA5YjkzYTE3NzVkMiIsImMiOjR9', '_blank'); }
		if(idEnlace == 2 ){ var win = window.open('https://app.powerbi.com/view?r=eyJrIjoiOWQ2NjFkNmItZTk0YS00NTA5LTk3YjYtYTFjNzRiZDBiYjgzIiwidCI6ImZjY2YwMTQ5LWYzNTQtNGU2My1hNzExLTA5YjkzYTE3NzVkMiIsImMiOjR9', '_blank'); }
		if(idEnlace == 6 ){ var win = window.open('https://app.powerbi.com/view?r=eyJrIjoiODI3OTA2ZWMtNjUyNS00ZDBjLTkzMWYtZjFhNmZhMzkzODUyIiwidCI6ImZjY2YwMTQ5LWYzNTQtNGU2My1hNzExLTA5YjkzYTE3NzVkMiIsImMiOjR9', '_blank'); }
		if(idEnlace == 37 ){ var win = window.open('https://app.powerbi.com/view?r=eyJrIjoiMTk3ZGFmYzQtZjFiMi00OGY5LWFkN2UtNGIxNjMyYmQ2MGNlIiwidCI6ImZjY2YwMTQ5LWYzNTQtNGU2My1hNzExLTA5YjkzYTE3NzVkMiIsImMiOjR9&pageName=ReportSectionb8b91ccc43aec5e1d655', '_blank'); }
		if(idEnlace == 66 ){ var win = window.open('https://app.powerbi.com/view?r=eyJrIjoiYmEyYTdiODAtYzlkYy00NzFkLWI5NjQtMmIxOWU1ZDYzNDk1IiwidCI6ImZjY2YwMTQ5LWYzNTQtNGU2My1hNzExLTA5YjkzYTE3NzVkMiIsImMiOjR9', '_blank'); }
		if(idEnlace == 10 ){ var win = window.open('https://app.powerbi.com/view?r=eyJrIjoiZmE2ZGY4MTEtM2RjNy00ODFkLTk2ZDAtODI2NmE5YTg4ZTFjIiwidCI6ImZjY2YwMTQ5LWYzNTQtNGU2My1hNzExLTA5YjkzYTE3NzVkMiIsImMiOjR9', '_blank'); }
		if(idEnlace == 28 ){ var win = window.open('https://app.powerbi.com/view?r=eyJrIjoiMzU5ZDFlZmYtNGIwYy00Yzk3LWFiNDctN2FjZTk1M2RiNzA1IiwidCI6ImZjY2YwMTQ5LWYzNTQtNGU2My1hNzExLTA5YjkzYTE3NzVkMiIsImMiOjR9', '_blank'); }
		if(idEnlace == 30 ){ var win = window.open('https://app.powerbi.com/view?r=eyJrIjoiMzU5ZDFlZmYtNGIwYy00Yzk3LWFiNDctN2FjZTk1M2RiNzA1IiwidCI6ImZjY2YwMTQ5LWYzNTQtNGU2My1hNzExLTA5YjkzYTE3NzVkMiIsImMiOjR9', '_blank'); }
		if(idEnlace == 9 ){ var win = window.open('https://app.powerbi.com/view?r=eyJrIjoiZDM2MThlZGMtN2M2NC00ZmY4LWFiOTgtYzA1NmIxOGNiOGZmIiwidCI6ImZjY2YwMTQ5LWYzNTQtNGU2My1hNzExLTA5YjkzYTE3NzVkMiIsImMiOjR9', '_blank'); }
		if(idEnlace == 12 ){ var win = window.open('https://app.powerbi.com/view?r=eyJrIjoiNDY3MWFmMTEtZDUzNi00M2JiLWEyYjctOWE2NjljZWM5MmFiIiwidCI6ImZjY2YwMTQ5LWYzNTQtNGU2My1hNzExLTA5YjkzYTE3NzVkMiIsImMiOjR9', '_blank'); }
		if(idEnlace == 38 ){ var win = window.open('https://app.powerbi.com/view?r=eyJrIjoiOTgxNGE4OWItNGI3NC00NGU1LThmYmMtYjRlZmU2M2Q5N2Y2IiwidCI6ImZjY2YwMTQ5LWYzNTQtNGU2My1hNzExLTA5YjkzYTE3NzVkMiIsImMiOjR9', '_blank'); }
		if(idEnlace == 34 ){ var win = window.open('https://app.powerbi.com/view?r=eyJrIjoiNTYwNjM0MGEtYzA2OS00MTVkLWE1ZDUtZDAwNTNmMWVlMjdmIiwidCI6ImZjY2YwMTQ5LWYzNTQtNGU2My1hNzExLTA5YjkzYTE3NzVkMiIsImMiOjR9&pageName=ReportSectionb8b91ccc43aec5e1d655', '_blank'); }
		if(idEnlace == 35 ){ var win = window.open('https://app.powerbi.com/view?r=eyJrIjoiNTYwNjM0MGEtYzA2OS00MTVkLWE1ZDUtZDAwNTNmMWVlMjdmIiwidCI6ImZjY2YwMTQ5LWYzNTQtNGU2My1hNzExLTA5YjkzYTE3NzVkMiIsImMiOjR9&pageName=ReportSectionb8b91ccc43aec5e1d655', '_blank'); }
		if(idEnlace == 33 ){ var win = window.open('https://app.powerbi.com/view?r=eyJrIjoiYmEyYTdiODAtYzlkYy00NzFkLWI5NjQtMmIxOWU1ZDYzNDk1IiwidCI6ImZjY2YwMTQ5LWYzNTQtNGU2My1hNzExLTA5YjkzYTE3NzVkMiIsImMiOjR9', '_blank'); }
		if(idEnlace == 36 ){ var win = window.open('https://app.powerbi.com/view?r=eyJrIjoiYmEyYTdiODAtYzlkYy00NzFkLWI5NjQtMmIxOWU1ZDYzNDk1IiwidCI6ImZjY2YwMTQ5LWYzNTQtNGU2My1hNzExLTA5YjkzYTE3NzVkMiIsImMiOjR9', '_blank'); }
}


function updateEnviadoEnlceFor(enviado, idEnlace){ 

 swal({
				title: "",
				text: "¿Esta seguro de Actualizar Enviado?",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Actualizar",
				cancelButtonText: "Cancelar",
				closeOnConfirm: true,
				closeOnCancel: true
			},
			function(isConfirm){
				if (isConfirm) {

							var f = document.getElementById("selFormatoes").value;	

						//cont = document.getElementById('contTablempsEnlacs');
						ajax=objetoAjax();
						ajax.open("POST", "formatos/updateEnviadoFormEnc.php");

						ajax.onreadystatechange = function(){
							if (ajax.readyState == 4 && ajax.status == 200) {			
									//cont.innerHTML = ajax.responseText;
									

									var json = ajax.responseText;
																			var obj = eval("(" + json + ")");
																			if (obj.first == "NO") { swal("", "No se actualizo verifique los datos.", "warning"); }else{
																				 if (obj.first == "SI") {  																					
																								loadEnviadoEnlcFormt(idEnlace);																			
																				 }
																			}
								

								}
						}
						ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
						ajax.send("&enviado="+enviado+"&idEnlace="+idEnlace+"&f="+f);
					
				}
			});
 
}


function saveMp(){

  var nameMpAdd = document.getElementById("nameMpAdd").value;
  var paternoMpAdd = document.getElementById("paternoMpAdd").value;
  var maternoMpAdd = document.getElementById("maternoMpAdd").value;

		cont = document.getElementById('contTablempsAdded');
		ajax=objetoAjax();
		ajax.open("POST", "formatos/AddtemToMps.php");

		ajax.onreadystatechange = function(){
			if (ajax.readyState == 4 && ajax.status == 200) {
				//cont.innerHTML = ajax.responseText;
				var json = ajax.responseText;
																			var obj = eval("(" + json + ")");
																			if (obj.first == "NO") { swal("", "No se agrego verifique los datos.", "warning"); }else{
																				 if (obj.first == "SI") {                    
																								
		       document.getElementById("nameMpAdd").value = "";
         document.getElementById("paternoMpAdd").value = "";
         document.getElementById("maternoMpAdd").value = "";
																								$('#addMpCatalo').modal('hide'); 
																								//loadTableMpsEnlaceFormato(idEnlace)
																								swal("", "Agregado Exitosamente.", "success");																				
																				 }
																			}
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("&nameMpAdd="+nameMpAdd+"&paternoMpAdd="+paternoMpAdd+"&maternoMpAdd="+maternoMpAdd);

}


function addMptoUnid(idMp, idEnlace, f){

  var idUnidad = document.getElementById("selUnidMp").value;

		cont = document.getElementById('contTablempsAdded');
		ajax=objetoAjax();
		ajax.open("POST", "formatos/AddtemMpUnidad.php");

		ajax.onreadystatechange = function(){
			if (ajax.readyState == 4 && ajax.status == 200) {
				//cont.innerHTML = ajax.responseText;
				var json = ajax.responseText;
																			var obj = eval("(" + json + ")");
																			if (obj.first == "NO") { swal("", "No se agrego verifique los datos.", "warning"); }else{
																				 if (obj.first == "SI") {                    
																								
																								$('#addMp').modal('hide'); 
																								loadTableMpsEnlaceFormato(idEnlace)
																								swal("", "Agregado Exitosamente.", "success");																				
																				 }
																			}
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("&idEnlace="+idEnlace+"&f="+f+"&idMp="+idMp+"&idUnidad="+idUnidad);

}



function getMpsSearching(idEnlace, f){

			var names = document.getElementById("nameMp").value;
			var patrn = document.getElementById("paternoMp").value;
			var matrn = document.getElementById("maternoMp").value;

			var sizen = names.length;
			var sizep = patrn.length;
			var sizem	= matrn.length;

				if(sizen > 2 ){}

				cont = document.getElementById('contTablempsAdded');
				ajax=objetoAjax();
				ajax.open("POST", "format/puestaDisposicion/mpsAdded.php");

				ajax.onreadystatechange = function(){
					if (ajax.readyState == 4 && ajax.status == 200) {
						cont.innerHTML = ajax.responseText;
					}
				}
				ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
				ajax.send("&names="+names+"&patrn="+patrn+"&matrn="+matrn+"&idEnlace="+idEnlace+"&f="+f);

}	


function loadAddMpsMod(){

		var f = document.getElementById("selFormatoes").value;	
  var idEnlace = document.getElementById("selEnlacess").value;

		cont = document.getElementById('contModAddMps');
		ajax=objetoAjax();
		ajax.open("POST", "format/puestaDisposicion/modAddMps.php");

		ajax.onreadystatechange = function(){
			if (ajax.readyState == 4 && ajax.status == 200) {
				cont.innerHTML = ajax.responseText;
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("&idEnlace="+idEnlace+"&f="+f);

}


function loadMpsMovs(){

		cont = document.getElementById('contenido');
		ajax=objetoAjax();
		ajax.open("POST", "format/puestaDisposicion/modalMovimMps.php");

		ajax.onreadystatechange = function(){
			if (ajax.readyState == 4 && ajax.status == 200) {
				cont.innerHTML = ajax.responseText;
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send(null);

}


function deleteMpEnlcUnid(idEnMpUnid){ 
 //var idEnlace = document.getElementById("selEnlacess").value;



 swal({
				title: "",
				text: "¿Esta seguro de Eliminar?",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Eliminar",
				cancelButtonText: "Cancelar",
				closeOnConfirm: true,
				closeOnCancel: true
			},
			function(isConfirm){
				if (isConfirm) {

						cont = document.getElementById('contTablempsEnlacs');
						ajax=objetoAjax();
						ajax.open("POST", "formatos/deleteItemMpUnidad.php");

						ajax.onreadystatechange = function(){
							if (ajax.readyState == 4 && ajax.status == 200) {			
									cont.innerHTML = ajax.responseText;
									

									var json = ajax.responseText;
																			var obj = eval("(" + json + ")");
																			if (obj.first == "NO") { swal("", "No se elimino verifique los datos.", "warning"); }else{
																				 if (obj.first == "SI") {                    
																						
																								loadTableMpsEnlaceFormato2();	
																								swal("", "Eliminado Exitosamente.", "success");																				
																				 }
																			}
								

								}
						}
						ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
						ajax.send("&idEnMpUnid="+idEnMpUnid);
					
				}
			});
 
}

function loadTableMpsEnlaceFormato2(){
 
 var f = document.getElementById("selFormatoes").value;	
 var idEnlace = document.getElementById("selEnlacess").value;

 cont = document.getElementById('contTablempsEnlacs');
	ajax=objetoAjax();
	ajax.open("POST", "formatos/tableSelectEnlacs.php");

	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {			
				cont.innerHTML = ajax.responseText;
				loadEnviadoEnlcFormt(idEnlace);
			}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("&idEnlace="+idEnlace+"&f="+f);
}

function loadTableMpsEnlaceFormato(idEnlace){
 
 var f = document.getElementById("selFormatoes").value;	
 cont = document.getElementById('contTablempsEnlacs');
	ajax=objetoAjax();
	ajax.open("POST", "formatos/tableSelectEnlacs.php");

	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {			
				cont.innerHTML = ajax.responseText;
				loadEnviadoEnlcFormt(idEnlace);
			}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("&idEnlace="+idEnlace+"&f="+f);
}

function loadMonthenlcenvi(idEnlace, f){
 
 cont = document.getElementById('contMontsel');
	ajax=objetoAjax();
	ajax.open("POST", "formatos/monthEnlceEnviad.php");

	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {			
				cont.innerHTML = ajax.responseText;
			}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("&idEnlace="+idEnlace+"&f="+f);
}

function loadEnviadoEnlcFormt(idEnlace){
 
 var f = document.getElementById("selFormatoes").value;	
 cont = document.getElementById('conBtnEnvid');
	ajax=objetoAjax();
	ajax.open("POST", "formatos/enviadoBtnenlc.php");

	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {			
				cont.innerHTML = ajax.responseText;
				loadMonthenlcenvi(idEnlace, f);
			}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("&idEnlace="+idEnlace+"&f="+f);
}

function loadInfoMpsFormat(){
 
 var enlac = document.getElementById("selEnlacess").value;	
 cont = document.getElementById('contFormatoMps');
	ajax=objetoAjax();
	ajax.open("POST", "formatos/selectFormatMpsEnlac.php");

	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {			
				cont.innerHTML = ajax.responseText;
				loadTableMpsEnlaceFormato(enlac);
				
			}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("&enlac="+enlac);
}

function cargaContHistoricoEnlaceDatos(idUsuario, idEnlace, format, idUnidad){

	
 cont = document.getElementById('contenido');
	ajax=objetoAjax();
	ajax.open("POST", "repositorio/historicoEnlaceDatos.php");

	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			
				cont.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("&idUsuario="+idUsuario+"&idEnlace="+idEnlace+"&format="+format+"&idUnidad="+idUnidad);
}

function cargaContHistoricoEnlaceDatosConsulta(idUsuario, idEnlace, format, idUnidad){

	
 cont = document.getElementById('contenido');
	ajax=objetoAjax();
	ajax.open("POST", "repositorio/historicoEnlaceDatosConsulta.php");

	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			
				cont.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("&idUsuario="+idUsuario+"&idEnlace="+idEnlace+"&format="+format+"&idUnidad="+idUnidad);
}

function descargarHistoricLitig(format, idUnidad, idEnlace){


	var anio = document.getElementById("anioHistoriqueLiti").value;			
	var mes = document.getElementById("mesHistoriqueLiti").value;

	ajax=objetoAjax();
	ajax.open("POST", "format/litigacion/descargarHistoricoLiti.php");

	nombrereporte = "Litigacion-"+idUnidad+"-"+mes+"-"+anio;
	cont = document.getElementById('respDesc');
	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText;
			document.location.href="format/litigacion/downloadReport/"+nombrereporte+".xlsx";
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send('&idUnidad='+idUnidad+'&mes='+mes+'&anio='+anio+'&idEnlace='+idEnlace);

}


function getDataHistoricaBDlitiga(idUnidad){


	mes = document.getElementById("mesHistoriqueLiti").value;
	anio = document.getElementById("anioHistoriqueLiti").value;

	cont = document.getElementById('contDataUpdLitigacionUnidad');
	ajax=objetoAjax();
	ajax.open("POST", "repositorio/historicoEnlaceDatosLitiTable.php");

	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			
				cont.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("&idUnidad="+idUnidad+"&anio="+anio+"&mes="+mes);

}

function vistaPreviaLitigacion(idUnidad){


	mes = document.getElementById("mesCmasc").value;
	anio = document.getElementById("anioCmasc").value;

	cont = document.getElementById('contMOdalVistaPrevialitigacion');
	ajax=objetoAjax();
	ajax.open("POST", "repositorio/historicoEnlaceDatosLitiTable.php");

	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			
				cont.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("&idUnidad="+idUnidad+"&anio="+anio+"&mes="+mes);

}

function descargarHisrtoric(format, idUnidad, idEnlace){

	var anio = document.getElementById("anioHistorique").value;			
	var mes = document.getElementById("mesHistorique").value;

	ajax=objetoAjax();
	ajax.open("POST", "formatos/descargarHistorico.php");

	nombrereporte = "CarpetasInvestigacion-"+idUnidad+"-"+mes+"-"+anio;
	cont = document.getElementById('respuestaDescargarCarpeta32');
	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText;
			  document.location.href="formatos/downloadReport/"+nombrereporte+".xlsx";
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send('&idUnidad='+idUnidad+'&mes='+mes+'&anio='+anio+'&idEnlace='+idEnlace);

}
function descargarHisrtoricConsul(format, idEnlace){

	var anio = document.getElementById("anioHistorique").value;			
	var mes = document.getElementById("mesHistorique").value;
	var idUnidad = document.getElementById("unidadEnlacHisto").value;

	ajax=objetoAjax();
	ajax.open("POST", "formatos/descargarHistorico.php");

	nombrereporte = "CarpetasInvestigacion-"+idUnidad+"-"+mes+"-"+anio;
	cont = document.getElementById('respuestaDescargarCarpeta32');
	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText;
			  document.location.href="formatos/downloadReport/"+nombrereporte+".xlsx";
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send('&idUnidad='+idUnidad+'&mes='+mes+'&anio='+anio+'&idEnlace='+idEnlace);

}

function descargarHisrtoricEnv(format, idUnidad, idEnlace, anio, mes){

	ajax=objetoAjax();
	ajax.open("POST", "formatos/descargarHistorico.php");

	nombrereporte = "CarpetasInvestigacion-"+idUnidad+"-"+mes+"-"+anio;
	cont = document.getElementById('respuestaDescargarCarpeta32');
	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText;
			//insertHistorial(idEnlace, idUnidad, 1, nombrereporte, mes, anio, format);
			//document.location.href="formatos/downloadReport/"+nombrereporte+".xlsx";
			  document.location.href="formatos/downloadReport/"+nombrereporte+".xlsx";
			//setTimeout("location.href = 'index.php?format="+format+"';",600);
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send('&idUnidad='+idUnidad+'&mes='+mes+'&anio='+anio+'&idEnlace='+idEnlace);

}

function cargaContHistoricoEnlaceDatosLiti(idUsuario, idEnlace, format, idUnidad){

	
 cont = document.getElementById('contenido');
	ajax=objetoAjax();
	ajax.open("POST", "repositorio/historicoEnlaceDatosLiti.php");

	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			
				cont.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("&idUsuario="+idUsuario+"&idEnlace="+idEnlace+"&format="+format+"&idUnidad="+idUnidad);
}

function getDataHistoricaBD(idUnidad, idEnlace){

	mes = document.getElementById("mesHistorique").value;
	anio = document.getElementById("anioHistorique").value;

	cont = document.getElementById('contTableDataHistorique');
	ajax=objetoAjax();
	ajax.open("POST", "repositorio/historicoEnlaceDatosTable.php");

	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			
				cont.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("&idUnidad="+idUnidad+"&anio="+anio+"&mes="+mes+"&idEnlace="+idEnlace);

}

function getDataHistoricaBDconsulta(idEnlace){

	mes = document.getElementById("mesHistorique").value;
	anio = document.getElementById("anioHistorique").value;
	idUnidad = document.getElementById("unidadEnlacHisto").value;

	cont = document.getElementById('contTableDataHistorique');
	ajax=objetoAjax();
	ajax.open("POST", "repositorio/historicoEnlaceDatosTableConsul.php");

	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			
				cont.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("&idUnidad="+idUnidad+"&anio="+anio+"&mes="+mes+"&idEnlace="+idEnlace);

}




function openTabCmasc(evt, pagina, idEnlace, anio, mes){

		tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
		evt.currentTarget.className += " active";
		 anio = document.getElementById("anioCmasc").value;
		 mes = document.getElementById("mesCmasc").value;	
		///// INGRESAR A LA PAGINA CORRESPONDIENTE MEDIANTE AJAX

	cont = document.getElementById('contentTabs');

	ajax=objetoAjax();
	ajax.open("POST", "format/cmasc/"+pagina);

	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("&idEnlace="+idEnlace+"&anio="+anio+"&mes="+mes);

}

function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

function updTableArchAdmin(idEnlace){

	 anio = document.getElementById("anioArchSelectedAdmin").value;
		mes = document.getElementById("mesAdminarch").value;
			tipoarchReposi = document.getElementById("tipoarchReposi").value;
		cont = document.getElementById('contenidoTablaRepositorioAdmin');

	ajax=objetoAjax();
	ajax.open("POST", "formatos/tableArchEnlaceAdmin.php");

	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("&idEnlace="+idEnlace+"&anio="+anio+"&mes="+mes+"&tipoarchReposi="+tipoarchReposi);

}

function updTableArchAdmin2(){

	 anio = document.getElementById("anioArchSelectedAdmin").value;
		mes = document.getElementById("mesAdminarch").value;
		idEnlace = document.getElementById("enlaceid").value;
		tipoarchReposi = document.getElementById("tipoarchReposi").value;



		cont = document.getElementById('contenidoTablaRepositorioAdmin');

	ajax=objetoAjax();
	ajax.open("POST", "formatos/tableArchEnlaceAdmin.php");

	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText;

			//// cargar listado enlaces para cada tipo de archivo 
		//	cargarEnlacesSelecTipoArch(tipoarchReposi);

		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("&idEnlace="+idEnlace+"&anio="+anio+"&mes="+mes+"&tipoarchReposi="+tipoarchReposi);

}

function cargarEnlacesSelecTipoArch(tipoArch){


		tipoarchReposi = document.getElementById("tipoarchReposi").value;
			cont = document.getElementById('contenidoEnlacesSelect');


	ajax=objetoAjax();
	ajax.open("POST", "repositorio/contSelectEnlacesXtipoArch.php");

	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText;
			updTableArchAdmin2();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("&tipoarchReposi="+tipoarchReposi);

}



function updTblArchivosEnlace(idEnlace, format){

		anio = document.getElementById("anioArchSelected").value;
		mes = document.getElementById("mesSelectArch").value;
		estatus = document.getElementById("estadoSelect").value;

		cont = document.getElementById('contenidoTablaRepositoriouser');

	ajax=objetoAjax();
	ajax.open("POST", "formatos/tableArchEnlace.php");

	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText;
			//cargar tabla sin nada
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("&idEnlace="+idEnlace+"&anio="+anio+"&mes="+mes+"&estatus="+estatus+"&format="+format);

}

function updTableMpUnidad(idEnlace){


	idUnidad = document.getElementById("unidadFormato").value;
	cont = document.getElementById('contTblMPs2');

	ajax=objetoAjax();
	ajax.open("POST", "formatos/tableUnidadMp.php");

	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText;
			//cargar tabla sin nada
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("&idUnidad="+idUnidad+"&idEnlace="+idEnlace);

}

function updTableMpUnidadLit(idEnlace){


	idUnidad = document.getElementById("unidadFormato").value;
	cont = document.getElementById('contTblMPs2');

	ajax=objetoAjax();
	ajax.open("POST", "format/litigacion/tableUnidadMp.php");

	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText;
			//cargar tabla sin nada
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("&idUnidad="+idUnidad+"&idEnlace="+idEnlace);

}

function cargarEnlacesTipoArchivo(mesCaptura, anioCaptura){


		cont = document.getElementById("tablaEnlacesContenido");

	tipoarchivo = document.getElementById("tipoarchivo").value;


	ajax=objetoAjax();
	ajax.open("POST", "faltantes/faltanteEnlaceTipoArch.php");

	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText;
			//cargar tabla sin nada
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("&tipoarchivo="+tipoarchivo+"&mesCaptura="+mesCaptura+"&anioCaptura="+anioCaptura);

}


function mostrarModalValidacionNUcs(validado, idEnlace, mesCapturar, anioCaptura){


	cont = document.getElementById('contMOdalValidateNucs');

	ajax=objetoAjax();
	ajax.open("POST", "formatos/modalValidateNucs.php");

	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("&validado="+validado+"&idEnlace="+idEnlace+"&mesCapturar="+mesCapturar+"&anioCaptura="+anioCaptura);

}

function getDataVistaPrevia(idUnidad, mes, anio, idEnlace){


	cont = document.getElementById('contMOdalVistaPrevia');
	ajax=objetoAjax();
	ajax.open("POST", "repositorio/historicoEnlaceDatosTable.php");

	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			
				cont.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("&idUnidad="+idUnidad+"&anio="+anio+"&mes="+mes+"&idEnlace="+idEnlace);

}



function loadSubIndex(idEnlace){


	cont = document.getElementById('contenido');

	ajax=objetoAjax();
	ajax.open("POST", "contUbIndex.php");

	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText;
			//cargar tabla sin nada
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("&idEnlace="+idEnlace);

}

function loadtablaFormatos(idUnidad){


	cont = document.getElementById('contenido');

	ajax=objetoAjax();
	ajax.open("POST", "formatos/formatosAreas.php");

	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText;
			//cargar tabla sin nada
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("&idUnidad="+idUnidad);

}

//// CARGA DE TODAS LOS FORMATOS QUE SON DIFERENTES AL DE CARPETAS

function loadtablaFormat(idUnidad, pagina, carpeta, idEnlace){


	cont = document.getElementById('contenido');

	ajax=objetoAjax();
	ajax.open("POST", "format/"+carpeta+"/"+pagina);

	///// obtener anio y mes para mandarlo a la pagina siguiente

	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText;
			//cargar tabla sin nada

			//var anio = document.getElementById("anioCmasc").value;
			var mes = document.getElementById("mesCmasc").value;	
			
			if(pagina == "formatCmasc.php"){ 

				openTabCmasc(event, 'recibidasOu.php', idEnlace, anio, mes);
				tablinks = document.getElementsByClassName("tablinks"); 
   				tablinks[0].className = tablinks[0].className += " active";
			}

				

		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("&idUnidad="+idUnidad+"&idEnlace="+idEnlace);

}

function cargarMOdalFormato(nombreCompletoMP, idMp, idUnidad, mes, anio){

	cont = document.getElementById('contMOdalFormato');
	ajax=objetoAjax();
	ajax.open("POST", "formatos/modalFormatoCarpetas.php");

	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText;
			//cargar tabla sin nada
			$('#myModaFormato').on('show.bs.modal', function () {

			});
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("&nombreCompletoMP="+nombreCompletoMP+"&idMp="+idMp+"&idUnidad="+idUnidad+"&mes="+mes+"&anio="+anio);
	
}

function cargarMOdalFormatoVer(nombreCompletoMP, idMp, idUnidad, mes, anio){

	cont = document.getElementById('contMOdalFormatoVer');
	ajax=objetoAjax();
	ajax.open("POST", "formatos/modalFormatoCarpetasVer.php");

	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText;
			//cargar tabla sin nada

		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("&nombreCompletoMP="+nombreCompletoMP+"&idMp="+idMp+"&idUnidad="+idUnidad+"&mes="+mes+"&anio="+anio);
	
}

function cargarMOdalFormatoEditar(nombreCompletoMP, idMp, idUnidad, mes, anio){

	cont = document.getElementById('contMOdalFormatoEditar');
	ajax=objetoAjax();
	ajax.open("POST", "formatos/modalFormatoCarpetasEditar.php");

	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText;      //cargar tabla sin nada
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("&nombreCompletoMP="+nombreCompletoMP+"&idMp="+idMp+"&idUnidad="+idUnidad+"&mes="+mes+"&anio="+anio);
	
}

function actualizarIniciadasA(){
	cont = document.getElementById('inicidadasA');
	var tipo = "iniciadasA";
	var cdeten = document.getElementById("inputCdetenA").value;
	var sdeten = document.getElementById("inputSdetenA").value;
	if(cdeten == "" || sdeten == ""){}else{

		ajax=objetoAjax();
		ajax.open("POST", "formatos/actualizarCampos.php");
		ajax.onreadystatechange = function(){
			if (ajax.readyState == 4 && ajax.status == 200) {
				cont.innerHTML = ajax.responseText;
				actualizarTotalTrabajarA();   
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("&tipo="+tipo+"&cdeten="+cdeten+"&sdeten="+sdeten);
	} 
}

function actualizarIniciadas(){
	cont = document.getElementById('inicidadas');
	var tipo = "iniciadas";
	var cdeten = document.getElementById("inputCdeten").value;
	var sdeten = document.getElementById("inputSdeten").value;
	if(cdeten == "" || sdeten == ""){}else{

		ajax=objetoAjax();
		ajax.open("POST", "formatos/actualizarCampos.php");
		ajax.onreadystatechange = function(){
			if (ajax.readyState == 4 && ajax.status == 200) {
				cont.innerHTML = ajax.responseText;
				actualizarTotalTrabajar();   
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("&tipo="+tipo+"&cdeten="+cdeten+"&sdeten="+sdeten);
	} 
}

function actualizarTotalTrabajar(){
		 
		cont = document.getElementById('totalTrabajar');
		var tramite = document.getElementById("inputTramiteAnterior").value;
		var totIniciadas = document.getElementById("inpuTotIniciadas").value;
		var reciUnid = document.getElementById("reCbOtrUni").value;
		var reiniciadas = document.getElementById("reiniciadasInser").value;

		if (reciUnid == "") { reciUnid = 0 }
		if (totIniciadas == "") { reciUnid = 0 }

		var tipo = "totalTrabajar";  
		ajax=objetoAjax();
		ajax.open("POST", "formatos/actualizarCampos.php");
		ajax.onreadystatechange = function(){
			if (ajax.readyState == 4 && ajax.status == 200) {
				cont.innerHTML = ajax.responseText;
				actualizarTramite();
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("&tipo="+tipo+"&tramite="+tramite+"&totIniciadas="+totIniciadas+"&reciUnid="+reciUnid+"&reiniciadas="+reiniciadas);
}

function actualizarTotalTrabajarA(){
		 
		cont = document.getElementById('totalTrabajarA');
		var tramite = document.getElementById("inputTramiteAnteriorA").value;
		var totIniciadas = document.getElementById("inpuTotIniciadasA").value;
		var reciUnid = document.getElementById("reCbOtrUniA").value;
		var reiniciadas = document.getElementById("reiniciadasUp").value;

		if (reciUnid == "") { reciUnid = 0 }
		if (totIniciadas == "") { reciUnid = 0 }

		var tipo = "totalTrabajarA";  
		ajax=objetoAjax();
		ajax.open("POST", "formatos/actualizarCampos.php");
		ajax.onreadystatechange = function(){
			if (ajax.readyState == 4 && ajax.status == 200) {
				cont.innerHTML = ajax.responseText;
				actualizarTramiteA();
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("&tipo="+tipo+"&tramite="+tramite+"&totIniciadas="+totIniciadas+"&reciUnid="+reciUnid+"&reiniciadas="+reiniciadas);
}


///// FUNCION QUE ABRE MODAL DE EDICION DE NUCS EDITAR//////



function checkJudicializaCdetenEdit(estatus, deten, idMp, mes, anio, idUnidad){

						
						var cant = document.getElementById("inputCdetenjuA").value;
						
						cont = document.getElementById('contmodalnucsEdit');		
						if(cant != 0){
						$('#nuc').focus();	
						ajax=objetoAjax();
						ajax.open("POST", "formatos/modalNucsEdit.php");

						ajax.onreadystatechange = function(){
							if (ajax.readyState == 4 && ajax.status == 200) {				
								cont.innerHTML = ajax.responseText;								
								
								$('#myModaFormatoEditar').modal('hide'); 
								$('#modalNucsEdit').modal('show');									
							}
						}

						ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
						ajax.send("&cant="+cant+"&idMp="+idMp+"&mes="+mes+"&anio="+anio+"&estatus="+estatus+"&deten="+deten+"&idUnidad="+idUnidad);

						}		
}

function modaleditclose(){ 


	$('#myModaFormatoEditar').modal('show'); 
	$('#modalNucsEdit').modal('hide');	


 }

 function modalsaveclose(){ 


	$('#myModaFormato').modal('show'); 
	$('#modalNucs').modal('hide');	

 }

 function sendDataModalEdit(inputCant, estatus, deten, idMp, mes, anio, idUnidad){

			
						var cant = document.getElementById(inputCant).value;
						cont = document.getElementById('contmodalnucsEdit');		
						if(cant != 0){
						$('#nuc').focus();	
						ajax=objetoAjax();
						ajax.open("POST", "formatos/modalNucsEdit.php");
						ajax.onreadystatechange = function(){
							if (ajax.readyState == 4 && ajax.status == 200) {				
								cont.innerHTML = ajax.responseText;								
								$('#myModaFormatoEditar').modal('hide'); 
								$('#modalNucsEdit').modal('show');										
							}
						}
						ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
						ajax.send("&cant="+cant+"&idMp="+idMp+"&mes="+mes+"&anio="+anio+"&estatus="+estatus+"&deten="+deten+"&idUnidad="+idUnidad);

						}	

}


/////////////////////////////////////////////////////////////////


function checkJudicializaCdeten(estatus, deten, idMp, mes, anio, idUnidad){
			
						var cant = document.getElementById("inputCdetenju").value;
						cont = document.getElementById('contmodalnucs');		
						if(cant != 0){
						$('#nuc').focus();	
						ajax=objetoAjax();
						ajax.open("POST", "formatos/modalNucs.php");
						ajax.onreadystatechange = function(){
							if (ajax.readyState == 4 && ajax.status == 200) {				
								cont.innerHTML = ajax.responseText;								
								$('#myModaFormato').modal('hide'); 
								$('#modalNucs').modal('show');								
							}
						}
						ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
						ajax.send("&cant="+cant+"&idMp="+idMp+"&mes="+mes+"&anio="+anio+"&estatus="+estatus+"&deten="+deten+"&idUnidad="+idUnidad);

						}		
}


function sendDataModal(inputCant, estatus, deten, idMp, mes, anio, idUnidad){
			
						var cant = document.getElementById(inputCant).value;
						cont = document.getElementById('contmodalnucs');		
						if(cant != 0){
						$('#nuc').focus();	
						ajax=objetoAjax();
						ajax.open("POST", "formatos/modalNucs.php");
						ajax.onreadystatechange = function(){
							if (ajax.readyState == 4 && ajax.status == 200) {				
								cont.innerHTML = ajax.responseText;								
								$('#myModaFormato').modal('hide'); 
								$('#modalNucs').modal('show');											
							}
						}
						ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
						ajax.send("&cant="+cant+"&idMp="+idMp+"&mes="+mes+"&anio="+anio+"&estatus="+estatus+"&deten="+deten+"&idUnidad="+idUnidad);

						}	

}


function actualizarJudicializadas(event){

	var codigo = event.which || event.keyCode;     
    if(codigo === 13){}else{

    	var cont = document.getElementById('totalJudicializadas');
		var tipo = "judicializadas";
		var cdeten = document.getElementById("inputCdetenju").value;
		var sdeten = document.getElementById("inputSdetenju").value;
		if(cdeten == "" || sdeten == ""){}else{

		ajax=objetoAjax();
		ajax.open("POST", "formatos/actualizarCampos.php");
		ajax.onreadystatechange = function(){
			if (ajax.readyState == 4 && ajax.status == 200) {
				cont.innerHTML = ajax.responseText;
				actualizarResoluciones();
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("&tipo="+tipo+"&cdeten="+cdeten+"&sdeten="+sdeten);

    	}

	
	} 
}

function actualizarJudicializadasA(){
	cont = document.getElementById('totalJudicializadasA');
	var tipo = "judicializadasA";
	var cdeten = document.getElementById("inputCdetenjuA").value;
	var sdeten = document.getElementById("inputSdetenjuA").value;
	if(cdeten == "" || sdeten == ""){}else{

		ajax=objetoAjax();
		ajax.open("POST", "formatos/actualizarCampos.php");
		ajax.onreadystatechange = function(){
			if (ajax.readyState == 4 && ajax.status == 200) {
				cont.innerHTML = ajax.responseText;
				actualizarResolucionesA();
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("&tipo="+tipo+"&cdeten="+cdeten+"&sdeten="+sdeten);
	} 
}

function actualizarResoluciones(){
	cont = document.getElementById('totalResoluciones');
	var tipo = "resoluciones";

	var judicializadas = document.getElementById("inputJudicializadas").value;
	var acum = document.getElementById("inputAcumulacion").value;
	var incompe = document.getElementById("inputIncompe").value;
	var SCP = document.getElementById("inputSCP").value;
	var CriteOpor = document.getElementById("inputCriteOpor").value;
	var Conciliacion = document.getElementById("inputConciliacion").value;  
	var mediacion = document.getElementById("inputMediacion").value;
	var neap = document.getElementById("inputNEAP").value;  
	var ArcTem = document.getElementById("inputArcTem").value;
	var AbsInves = document.getElementById("inputAbsInves").value;

	if (acum == "") { acum = 0;}
	if (incompe == "") { incompe = 0;}
	if (SCP == "") { SCP = 0;}
	if (CriteOpor == "") { CriteOpor = 0;}
	if (Conciliacion == "") { Conciliacion = 0;}
	if (mediacion == "") { mediacion = 0;}
	if (neap == "") { neap = 0;}
	if (ArcTem == "") { ArcTem = 0;}
	if (AbsInves == "") { AbsInves = 0;}

		ajax=objetoAjax();
		ajax.open("POST", "formatos/actualizarCampos.php");
		ajax.onreadystatechange = function(){
			if (ajax.readyState == 4 && ajax.status == 200) {
				cont.innerHTML = ajax.responseText;
				actualizarTramite();
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("&tipo="+tipo+"&judicializadas="+judicializadas+"&acum="+acum+"&incompe="+incompe+"&SCP="+SCP+"&CriteOpor="+CriteOpor+"&Conciliacion="+Conciliacion+"&mediacion="+mediacion+"&neap="+neap+"&ArcTem="+ArcTem+"&AbsInves="+AbsInves);
	
}

function actualizarResolucionesA(){
	cont = document.getElementById('totalResolucionesA');
	var tipo = "resolucionesA";

	var judicializadas = document.getElementById("inputJudicializadasA").value;
	var acum = document.getElementById("inputAcumulacionA").value;
	var incompe = document.getElementById("inputIncompeA").value;
	var SCP = document.getElementById("inputSCPA").value;
	var CriteOpor = document.getElementById("inputCriteOporA").value;
	var Conciliacion = document.getElementById("inputConciliacionA").value;  
	var mediacion = document.getElementById("inputMediacionA").value;
	var neap = document.getElementById("inputNEAPA").value;  
	var ArcTem = document.getElementById("inputArcTemA").value;
	var AbsInves = document.getElementById("inputAbsInvesA").value;

	if (acum == "") { acum = 0;}
	if (incompe == "") { incompe = 0;}
	if (SCP == "") { SCP = 0;}
	if (CriteOpor == "") { CriteOpor = 0;}
	if (Conciliacion == "") { Conciliacion = 0;}
	if (mediacion == "") { mediacion = 0;}
	if (neap == "") { neap = 0;}
	if (ArcTem == "") { ArcTem = 0;}
	if (AbsInves == "") { AbsInves = 0;}

		ajax=objetoAjax();
		ajax.open("POST", "formatos/actualizarCampos.php");
		ajax.onreadystatechange = function(){
			if (ajax.readyState == 4 && ajax.status == 200) {
				cont.innerHTML = ajax.responseText;
				actualizarTramiteA();
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("&tipo="+tipo+"&judicializadas="+judicializadas+"&acum="+acum+"&incompe="+incompe+"&SCP="+SCP+"&CriteOpor="+CriteOpor+"&Conciliacion="+Conciliacion+"&mediacion="+mediacion+"&neap="+neap+"&ArcTem="+ArcTem+"&AbsInves="+AbsInves);
	
}

function actualizarTramite(){

	cont = document.getElementById('tramiteFinal');
	var tipo = "tramite";

	var resoluciones = document.getElementById("inputResoluciones").value;
	var EnvUATP = document.getElementById("inputEnvUATP").value;
	var EnvUI = document.getElementById("inputEnvUI").value;	
	var inputEnvImpDesc = document.getElementById("inputEnvImpDesc").value;
	var tramiteAnt = document.getElementById("inputTramiteAnterior").value;

	var TotalTrabajar = document.getElementById("inputTotalTrabajar").value;

	if (EnvUATP == "") { EnvUATP = 0;}
	if (EnvUI == "") { EnvUI = 0;}
 
		ajax=objetoAjax();
		ajax.open("POST", "formatos/actualizarCampos.php");
		ajax.onreadystatechange = function(){
			if (ajax.readyState == 4 && ajax.status == 200) {
				cont.innerHTML = ajax.responseText;
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("&tipo="+tipo+"&resoluciones="+resoluciones+"&EnvUATP="+EnvUATP+"&EnvUI="+EnvUI+"&TotalTrabajar="+TotalTrabajar+"&inputEnvImpDesc="+inputEnvImpDesc+"&tramiteAnt="+tramiteAnt);
	
}

function actualizarTramiteA(){

	cont = document.getElementById('tramiteFinalA');
	var tipo = "tramiteA";

	var resoluciones = document.getElementById("inputResolucionesA").value;
	var EnvUATP = document.getElementById("inputEnvUATPA").value;
	var EnvUI = document.getElementById("inputEnvUIA").value;
 
	var inputEnvImpDesc = document.getElementById("inputEnvImpDescA").value;

	var TotalTrabajar = document.getElementById("inputTotalTrabajarA").value;

	if (EnvUATP == "") { EnvUATP = 0;}
	if (EnvUI == "") { EnvUI = 0;}
 
		ajax=objetoAjax();
		ajax.open("POST", "formatos/actualizarCampos.php");
		ajax.onreadystatechange = function(){
			if (ajax.readyState == 4 && ajax.status == 200) {
				cont.innerHTML = ajax.responseText;
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("&tipo="+tipo+"&resoluciones="+resoluciones+"&EnvUATP="+EnvUATP+"&EnvUI="+EnvUI+"&TotalTrabajar="+TotalTrabajar+"&inputEnvImpDesc="+inputEnvImpDesc);
	
}

/*function checkinputvalidatedAll(cant, idMp, estatus, mes, anio, deten){

	alert("La cantidad es: "+cant);
			acc = "validateCheck";
			var uno = 1;
			var cero = 0;
					ajax=objetoAjax();
					ajax.open("POST", "formatos/accionesNucs.php");

					ajax.onreadystatechange = function(){
						if (ajax.readyState == 4 && ajax.status == 200) {							
								
								var cadCodificadaJSON = ajax.responseText;
											var objDatos = eval("(" + cadCodificadaJSON + ")");

											if (objDatos.first == "NO") { alert("llego al false"); return cero; }else{

										 if (objDatos.first == "SI") {															
										 						alert("lelgo al true");
										 						return uno;
																													
										 }
									}
						}
					}
					ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
					ajax.send("&cant="+cant+"&idMp="+idMp+"&estatus="+estatus+"&mes="+mes+"&anio="+anio+"&deten="+deten+"&acc="+acc);

}*/
function validateItsok(mes, anio, idUnidad, idMp){


					cont = document.getElementById('continputdhidden');
			 	acc = "validateitok";			

						ajax=objetoAjax();
						ajax.open("POST", "formatos/accionesNucs.php");
						ajax.onreadystatechange = function(){
							if (ajax.readyState == 4 && ajax.status == 200) {
								cont.innerHTML = ajax.responseText;
								guardarCarpeta(mes, anio, idUnidad, idMp, 1);
							}
						}
						ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
						ajax.send("&acc="+acc+"&idMp="+idMp+"&mes="+mes+"&anio="+anio+"&idUnidad="+idUnidad);
					

}


function guardarCarpeta(mes, anio, idUnidad, idMp, format){

 	var condetenido = document.getElementById("condetenido").value;
 	var sindetenido = document.getElementById("sindetenido").value;
 	var absten = document.getElementById("absten").value;
 	var archte = document.getElementById("archte").value;
 	var neap = document.getElementById("neap").value;
 	var med = document.getElementById("med").value;
 	var conci = document.getElementById("conci").value;
 	var crieter = document.getElementById("crieter").value;
 	var scp = document.getElementById("scp").value;
 	var incompe = document.getElementById("incompe").value;
 	var acuml = document.getElementById("acuml").value;
 	var reini = document.getElementById("inpuReini").value;


	 var tramiteAnterior = document.getElementById("inputTramiteAnterior").value;
		var inputCdeten = document.getElementById("inputCdeten").value;
		var inputSdeten = document.getElementById("inputSdeten").value;

		var reCbOtrUni = document.getElementById("reCbOtrUni").value;

		var Cdetenju = document.getElementById("inputCdetenju").value;
		var Sdetenju = document.getElementById("inputSdetenju").value;

		var inputAbsInves = document.getElementById("inputAbsInves").value;   
		var inputArcTem = document.getElementById("inputArcTem").value;    
		var inputNEAP = document.getElementById("inputNEAP").value;
		var inputMediacion = document.getElementById("inputMediacion").value;
		var inputConciliacion = document.getElementById("inputConciliacion").value;
		var inputCriteOpor = document.getElementById("inputCriteOpor").value;    
		var inputSCP = document.getElementById("inputSCP").value;
		var inputIncompe = document.getElementById("inputIncompe").value;
		var inputAcumulacion = document.getElementById("inputAcumulacion").value;

		var inputEnvUATP = document.getElementById("inputEnvUATP").value;
		var inputEnvUI = document.getElementById("inputEnvUI").value;
		
		var inputEnvImpDesc = document.getElementById("inputEnvImpDesc").value;		
		var reiniciadasInse = document.getElementById("reiniciadasInser").value;	


								if(tramiteAnterior == "" || inputCdeten == "" || inputSdeten == "" || reCbOtrUni == "" || Cdetenju == "" || Sdetenju == "" || inputAbsInves == "" || inputArcTem == "" || inputNEAP == "" || inputMediacion == "" 
								|| inputConciliacion == "" || inputCriteOpor == "" || inputSCP == "" || inputIncompe == "" || inputAcumulacion == "" || inputEnvUATP == "" || inputEnvUI == "" || inputEnvImpDesc == "" || reiniciadasInse == ""){ sweetAlert("", "Faltan datos por completar.", "warning"); }else{


									if(reiniciadasInse  ==  reini && condetenido  ==  Cdetenju && sindetenido == Sdetenju &&  absten == inputAbsInves && archte == inputArcTem && neap == inputNEAP && med ==  inputMediacion &&  conci == inputConciliacion && crieter == inputCriteOpor && scp == inputSCP && incompe == inputIncompe && acuml == inputAcumulacion){

						 					idUnidadSelect = document.getElementById("unidadFormato").value;
						 					//cont = document.getElementById('respuestaGuardado');

						 					var totInici = parseInt(inputCdeten)+parseInt(inputSdeten);
												var TotalTrabajar = parseInt( tramiteAnterior ) + parseInt( totInici ) + parseInt(reCbOtrUni) + parseInt(reiniciadasInse);
												var Judicializadas = parseInt( Cdetenju ) +  parseInt(Sdetenju);
												var inputResoluciones = parseInt( Judicializadas)+parseInt( inputAbsInves  ) + parseInt( inputArcTem) +parseInt( inputNEAP ) + parseInt( inputIncompe)+parseInt( inputAcumulacion )+parseInt( inputMediacion )+ parseInt( inputConciliacion ) + parseInt( inputCriteOpor)+ parseInt(inputSCP);
												var inputTramiteFinal =  parseInt( TotalTrabajar) - (parseInt( inputResoluciones )+  parseInt(inputEnvUATP) + parseInt(inputEnvUI) + parseInt(inputEnvImpDesc));

								 
										ajax=objetoAjax();
										ajax.open("POST", "formatos/guardarCarpeta.php");
										ajax.onreadystatechange = function(){
											if (ajax.readyState == 4 && ajax.status == 200) {
												//cont.innerHTML = ajax.responseText;

												 var json = ajax.responseText;
														var obj = eval("(" + json + ")");
														if (obj.first == "NO") { swal("", "No se registro verifique los datos.", "warning"); }else{
															 if (obj.first == "SI") {                    
																	swal("", "Registrado Exitosamente.", "success");
																	setTimeout("location.href = 'index.php?format="+format+"';",600);

															 }
														}
											}
										}
										ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
										ajax.send("&mes="+mes+"&anio="+anio+"&idUnidad="+idUnidad+"&tramiteAnterior="+tramiteAnterior+"&inputCdeten="+inputCdeten+"&inputSdeten="+inputSdeten+"&totInici="+totInici+"&reCbOtrUni="+reCbOtrUni+"&TotalTrabajar="+TotalTrabajar+"&Cdetenju="+Cdetenju+"&Sdetenju="+Sdetenju+"&Judicializadas="+Judicializadas+"&inputAbsInves="+inputAbsInves+"&inputArcTem="+inputArcTem+"&inputNEAP="+inputNEAP+"&inputMediacion="+inputMediacion+"&inputConciliacion="+inputConciliacion+"&inputCriteOpor="+inputCriteOpor+"&inputSCP="+inputSCP+"&inputIncompe="+inputIncompe+"&inputAcumulacion="+inputAcumulacion+"&inputResoluciones="+inputResoluciones+"&inputEnvUATP="+inputEnvUATP+"&inputEnvUI="+inputEnvUI+"&inputTramiteFinal="+inputTramiteFinal+"&idMp="+idMp+"&inputEnvImpDesc="+inputEnvImpDesc+"&reiniciadasInse="+reiniciadasInse);

							}else{ 


			swal("", "Los datos no coinciden favor de verificar.", "warning"); 
			if(condetenido  !=  Cdetenju){ cont = document.getElementById("checkCdetenju");   cont.innerHTML = "<i style='color:orange; cursor:pointer; font-size:27px;' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>";    }else{  cont = document.getElementById("checkCdetenju");   cont.innerHTML = "<i style='color:green; cursor:pointer;' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>"; }
			if(sindetenido != Sdetenju){ cont1 = document.getElementById("checkSdetenju");   cont1.innerHTML = "<i style='color:orange; cursor:pointer;' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>";    }else{  cont1 = document.getElementById("checkSdetenju");   cont1.innerHTML = "<i style='color:green; cursor:pointer;' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>"; }

			if(absten != inputAbsInves){ cont2 = document.getElementById("checkAbsInves");   cont2.innerHTML = "<i style='color:orange; cursor:pointer;' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>";    }else{  cont2 = document.getElementById("checkAbsInves");   cont2.innerHTML = "<i style='color:green; cursor:pointer;' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>"; }
			if(archte != inputArcTem){ cont3 = document.getElementById("checkArcTem");   cont3.innerHTML = "<i style='color:orange; cursor:pointer;' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>";    }else{  cont3 = document.getElementById("checkArcTem");   cont3.innerHTML = "<i style='color:green; cursor:pointer;' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>"; }
			if(neap != inputNEAP){ cont4 = document.getElementById("checkNEAP");   cont4.innerHTML = "<i style='color:orange; cursor:pointer;' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>";    }else{  cont4 = document.getElementById("checkNEAP");   cont4.innerHTML = "<i style='color:green; cursor:pointer;' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>"; }
			if( med !=  inputMediacion){ cont5 = document.getElementById("checkMediacion");   cont5.innerHTML = "<i style='color:orange; cursor:pointer;' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>";    }else{  cont5 = document.getElementById("checkMediacion");   cont5.innerHTML = "<i style='color:green; cursor:pointer;' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>"; }
			if(conci != inputConciliacion){ cont6 = document.getElementById("checkConciliacion");   cont6.innerHTML = "<i style='color:orange; cursor:pointer;' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>";    }else{  cont6 = document.getElementById("checkConciliacion");   cont6.innerHTML = "<i style='color:green; cursor:pointer;' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>"; }
			if(crieter != inputCriteOpor){ cont7 = document.getElementById("checkCriteOpor");   cont7.innerHTML = "<i style='color:orange; cursor:pointer;' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>";    }else{  cont7 = document.getElementById("checkCriteOpor");   cont7.innerHTML = "<i style='color:green; cursor:pointer;' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>"; }
			if(scp != inputSCP){ cont8 = document.getElementById("checkSCP");   cont8.innerHTML = "<i style='color:orange; cursor:pointer;' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>";    }else{  cont8 = document.getElementById("checkSCP");   cont8.innerHTML = "<i style='color:green; cursor:pointer;' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>"; }
			if(incompe != inputIncompe){ cont9 = document.getElementById("checkIncompe");   cont9.innerHTML = "<i style='color:orange; cursor:pointer;' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>";    }else{  cont9 = document.getElementById("checkIncompe");   cont9.innerHTML = "<i style='color:green; cursor:pointer;' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>"; }
			if(acuml != inputAcumulacion){ cont10 = document.getElementById("checkAcumulacion");   cont10.innerHTML = "<i style='color:orange; cursor:pointer;' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>";    }else{  cont10 = document.getElementById("checkAcumulacion");   cont10.innerHTML = "<i style='color:green; cursor:pointer;' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>"; }
			if(reiniciadasInse != reini){ cont11 = document.getElementById("checkreiniciadas");   cont11.innerHTML = "<i style='color:orange; cursor:pointer;' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>";    }else{  cont11 = document.getElementById("checkreiniciadas");   cont11.innerHTML = "<i style='color:green; cursor:pointer;' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>"; }

		}
		}

}

function enviarAindex(idArchivo){

	if(idArchivo == 1){ var e = "CarpetasInvestigacion"; }
	if(idArchivo == 4){ var e = "Litigacion"; }
	if(idArchivo == 11){ var e = "Trimestral"; }
	if(idArchivo == 12){ var e = "PoliciaConsulta"; }
	if(idArchivo == 15){ var e = "carpetasJudicializadas"; }
	
	 setTimeout("location.href = '"+e+"';",10);


}

function validarEnviarDPE(validado, idEnlace, mesCapturar, anioCaptura){

						acc = "lastCheck";			
						ajax=objetoAjax();
						ajax.open("POST", "formatos/accionesNucs.php");
						ajax.onreadystatechange = function(){
							if (ajax.readyState == 4 && ajax.status == 200) {											

											var json = ajax.responseText;
											var obj = eval("(" + json + ")");
											if (obj.first == "NO") { 


												swal({
												  title: "<h4>Favor de revisar la información los datos no coinciden.</h4>",
												  text: '',
												  timer: 3000,
												  type: "warning",
												  showCancelButton: false,
												  showConfirmButton: false,
												  html: true
												});



												setTimeout("location.href = 'index.php';",3000);


										}else{
												 if (obj.first == "SI") {                
													
												 				enviarDPE(validado, idEnlace);
												 }
											}

							}
						}
						ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
						ajax.send("&acc="+acc+"&idEnlace="+idEnlace+"&mesCapturar="+mesCapturar+"&anioCaptura="+anioCaptura);



}

function enviarDPE(validado, idEnlace){

		if(validado == "no"){
		swal({
												  title: "<h4>No se puede enviar la información faltan por capturar.</h4>",
												  text: '',
												  timer: 3000,
												  type: "warning",
												  showCancelButton: false,
												  showConfirmButton: false,
												  html: true
												});



												setTimeout("location.href = 'index.php';",3000);


		}else{

		 swal({
				title: "",
				text: "¿Esta seguro de enviar la información? \n\n Nota:    Una vez enviados a la Dirección de Planeación y Estadística no podra ser modificado. ",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Enviar",
				cancelButtonText: "Cancelar",
				closeOnConfirm: false,
				closeOnCancel: true
			},
			function(isConfirm){
				if (isConfirm) {

					ajax=objetoAjax();
					ajax.open("POST", "formatos/actualizarEnviado.php");
					ajax.onreadystatechange = function(){
						if (ajax.readyState == 4 && ajax.status == 200) {
							 var json = ajax.responseText;
									var obj = eval("(" + json + ")");
									if (obj.first == "NO") { swal("", "No se envió verifique los datos.", "warning"); }else{
										 if (obj.first == "SI") {                    
												swal("", "Tu información ha sido enviada.", "success");
												setTimeout("location.href = 'index.php';",500);
										 }
									}              
						}
					}
					ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
					ajax.send('&idEnlace='+idEnlace);
				}
			});
		}
}


////// SI COINCIDEN LOS DATOS DE REGISTRO Y NUCS CAP SE VA A EJECUTAR EL SIGUIENTE METODO

function enviarDPEvalidates(idUnidad, anio, mes, incorrect , validado, idEnlace, format){


		
		if(incorrect == 0){
			
		if(validado == "no"){
		

		swal({
												  title: "<h4>No se puede enviar la información faltan por capturar.</h4>",
												  text: '',
												  timer: 3000,
												  type: "warning",
												  showCancelButton: false,
												  showConfirmButton: false,
												  html: true
												});



												setTimeout("location.href = 'index.php?format="+format+"';",3000);


		}else{

		 swal({
				title: "",
				text: "¿Esta seguro de enviar la información? \n\n Nota:    Una vez enviados a la Dirección de Planeación y Estadística no podra ser modificado. ",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Enviar",
				cancelButtonText: "Cancelar",
				closeOnConfirm: false,
				closeOnCancel: true
			},
			function(isConfirm){
				if (isConfirm) {

					ajax=objetoAjax();
					ajax.open("POST", "formatos/actualizarEnviado.php");
					ajax.onreadystatechange = function(){
						if (ajax.readyState == 4 && ajax.status == 200) {
							 var json = ajax.responseText;
									var obj = eval("(" + json + ")");
									if (obj.first == "NO") { swal("", "No se envió verifique los datos.", "warning"); }else{
										 if (obj.first == "SI") {                    
												swal("", "Tu información ha sido enviada.", "success");
												descargar(format, idUnidad, mes, anio, idEnlace);
										 }
									}              
						}
					}
					ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
					ajax.send('&idEnlace='+idEnlace+'&format='+format);
				}
			});
		}
	}else{  swal("", "Favor de revisar la información los datos no coinciden.", "warning");  }
}

////// SI COINCIDEN LOS DATOS DE REGISTRO Y NUCS CAP SE VA A EJECUTAR EL SIGUIENTE METODO

/// ACCIONES PARA EJECUTAR EN EL MODAL DE ACTUALIZACION DE LOS REGISTROS ////////


function validateItsokUpd(mes, anio, idUnidad, idMp, idCarpeta){


					cont = document.getElementById('continputdhiddenupd');
			 	acc = "validateitokUpd";			

						ajax=objetoAjax();
						ajax.open("POST", "formatos/accionesNucs.php");
						ajax.onreadystatechange = function(){
							if (ajax.readyState == 4 && ajax.status == 200) {
								cont.innerHTML = ajax.responseText;
								actualizarCarpeta(mes, anio, idUnidad, idMp, idCarpeta, 1);
							}
						}
						ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
						ajax.send("&acc="+acc+"&idMp="+idMp+"&mes="+mes+"&anio="+anio+"&idUnidad="+idUnidad);
					

}

function actualizarCarpeta(mes, anio, idUnidad, idMp, idCarpeta, format){ 


		var condetenidoup = document.getElementById("condetenidoUpd").value;
	 	var sindetenidoup = document.getElementById("sindetenidoUpd").value;
	 	var abstenup = document.getElementById("abstenUpd").value;
	 	var archteup = document.getElementById("archteUpd").value;
	 	var neapup = document.getElementById("neapUpd").value;
	 	var medup = document.getElementById("medUpd").value;
	 	var conciup = document.getElementById("conciUpd").value;
	 	var crieterup = document.getElementById("crieterUpd").value;
	 	var scpup = document.getElementById("scpUpd").value;
	 	var incompeup = document.getElementById("incompeUpd").value;
	 	var acumlup = document.getElementById("acumlUpd").value;
	 	




		var tramiteAnterior = document.getElementById("inputTramiteAnteriorA").value;
		var inputCdeten = document.getElementById("inputCdetenA").value;
		var inputSdeten = document.getElementById("inputSdetenA").value;		
		var reCbOtrUni = document.getElementById("reCbOtrUniA").value;
		var Cdetenju = document.getElementById("inputCdetenjuA").value;
		var Sdetenju = document.getElementById("inputSdetenjuA").value;
		var inputAbsInves = document.getElementById("inputAbsInvesA").value;   
		var inputArcTem = document.getElementById("inputArcTemA").value;    
		var inputNEAP = document.getElementById("inputNEAPA").value;
		var inputMediacion = document.getElementById("inputMediacionA").value;
		var inputConciliacion = document.getElementById("inputConciliacionA").value;
		var inputCriteOpor = document.getElementById("inputCriteOporA").value;    
		var inputSCP = document.getElementById("inputSCPA").value;
		var inputIncompe = document.getElementById("inputIncompeA").value;
		var inputAcumulacion = document.getElementById("inputAcumulacionA").value;
		var inputEnvUATP = document.getElementById("inputEnvUATPA").value;
		var inputEnvUI = document.getElementById("inputEnvUIA").value;
		
		var inputEnvImpDescA = document.getElementById("inputEnvImpDescA").value;
		var reiniciadas = document.getElementById("reiniciadasUp").value;
		var reini = document.getElementById("reiniUp").value;


			 	//alert(""+medup+" == "+inputMediacion);
		//alert("Uno es: "+reiniciadas);
			//alert(archteup+" = "+inputArcTem);
	
		if( tramiteAnterior == "" || inputCdeten == "" || inputSdeten == "" || reCbOtrUni == "" || Cdetenju == "" || Sdetenju == "" || inputAbsInves == "" || inputArcTem == "" || inputNEAP == "" || inputMediacion == "" 
			|| inputConciliacion == "" || inputCriteOpor == "" || inputSCP == "" || inputIncompe == "" || inputAcumulacion == "" || inputEnvUATP == "" || inputEnvUI == "" || inputEnvImpDescA == "" || reiniciadas == ""){ sweetAlert("", "Faltan datos por completar.", "warning"); }else{

			// VALIDAR QUE LOS CAMPOS QUE REQUIERAN DE CARPETAS ( NUCS ) SEAN IGUALES A EL NUMERO REGISTRADO EN EL CAMPO CORRESPONDIENTE	
			if ( reiniciadas  ==  reini && condetenidoup  ==  Cdetenju && sindetenidoup  ==  Sdetenju && abstenup == inputAbsInves && archteup == inputArcTem && neapup == inputNEAP && medup ==  inputMediacion &&  conciup == inputConciliacion && crieterup == inputCriteOpor && scpup == inputSCP && incompeup == inputIncompe && acumlup == inputAcumulacion ) {	

				cont = document.getElementById('');

				var totInici = parseInt(inputCdeten)+parseInt(inputSdeten);
				var TotalTrabajar = parseInt( tramiteAnterior ) + parseInt( totInici ) + parseInt(reCbOtrUni) + parseInt(reiniciadas);
				var Judicializadas = parseInt( Cdetenju ) +  parseInt(Sdetenju);
				var inputResoluciones = parseInt( Judicializadas)+parseInt( inputAbsInves  ) + parseInt( inputArcTem) +parseInt( inputNEAP ) + parseInt( inputIncompe)+parseInt( inputAcumulacion )+parseInt( inputMediacion )+ parseInt( inputConciliacion ) + parseInt( inputCriteOpor)+ parseInt(inputSCP);
				var inputTramiteFinal =  parseInt( TotalTrabajar) - (parseInt( inputResoluciones )+  parseInt(inputEnvUATP) + parseInt(inputEnvUI) + parseInt(inputEnvImpDescA));

			
			 
					ajax=objetoAjax();
					ajax.open("POST", "formatos/actualizarCarpeta.php");
					ajax.onreadystatechange = function(){
						if (ajax.readyState == 4 && ajax.status == 200) {
							//cont.innerHTML = ajax.responseText;

							 var json = ajax.responseText;
									var obj = eval("(" + json + ")");
									if (obj.first == "NO") { swal("", "No se actualizo verifique los datos.", "warning"); }else{
										 if (obj.first == "SI") {                    
												swal("", "Actualizado Exitosamente.", "success");
												setTimeout("location.href = 'index.php?format="+format+"';",600);
										 }
									}
						}
					}
					ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
					ajax.send("&idCarpeta="+idCarpeta+"&mes="+mes+"&anio="+anio+"&idUnidad="+idUnidad+"&tramiteAnterior="+tramiteAnterior+"&inputCdeten="+inputCdeten+"&inputSdeten="+inputSdeten+"&totInici="+totInici+"&reCbOtrUni="+reCbOtrUni+"&TotalTrabajar="+TotalTrabajar+"&Cdetenju="+Cdetenju+"&Sdetenju="+Sdetenju+"&Judicializadas="+Judicializadas+"&inputAbsInves="+inputAbsInves+"&inputArcTem="+inputArcTem+"&inputNEAP="+inputNEAP+"&inputMediacion="+inputMediacion+"&inputConciliacion="+inputConciliacion+"&inputCriteOpor="+inputCriteOpor+"&inputSCP="+inputSCP+"&inputIncompe="+inputIncompe+"&inputAcumulacion="+inputAcumulacion+"&inputResoluciones="+inputResoluciones+"&inputEnvUATP="+inputEnvUATP+"&inputEnvUI="+inputEnvUI+"&inputTramiteFinal="+inputTramiteFinal+"&idMp="+idMp+"&inputEnvImpDescA="+inputEnvImpDescA+"&reiniciadas="+reiniciadas);

		}else{ 


			swal("", "Los datos no coinciden favor de verificar.", "warning"); 

			////// Revisar los datos donde no coincidan las cantidades y mandar 
			if(condetenidoup  !=  Cdetenju){ cont = document.getElementById("checkCdetenjuA");   cont.innerHTML = "<i style='color:orange; cursor:pointer; font-size:27px;' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>";    }else{  cont = document.getElementById("checkCdetenjuA");   cont.innerHTML = "<i style='color:green; cursor:pointer;' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>"; }
			if(sindetenidoup  !=  Sdetenju){ cont1 = document.getElementById("checkSdetenjuA");   cont1.innerHTML = "<i style='color:orange; cursor:pointer;' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>";    }else{  cont1 = document.getElementById("checkSdetenjuA");   cont1.innerHTML = "<i style='color:green; cursor:pointer;' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>"; }

			if(abstenup != inputAbsInves){ cont2 = document.getElementById("checkAbsInvesA");   cont2.innerHTML = "<i style='color:orange; cursor:pointer;' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>";    }else{  cont2 = document.getElementById("checkAbsInvesA");   cont2.innerHTML = "<i style='color:green; cursor:pointer;' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>"; }
			if(archteup != inputArcTem){ cont3 = document.getElementById("checkArcTemA");   cont3.innerHTML = "<i style='color:orange; cursor:pointer;' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>";    }else{  cont3 = document.getElementById("checkArcTemA");   cont3.innerHTML = "<i style='color:green; cursor:pointer;' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>"; }
			if(neapup != inputNEAP){ cont4 = document.getElementById("checkNEAPA");   cont4.innerHTML = "<i style='color:orange; cursor:pointer;' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>";    }else{  cont4 = document.getElementById("checkNEAPA");   cont4.innerHTML = "<i style='color:green; cursor:pointer;' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>"; }
			if(medup !=  inputMediacion){ cont5 = document.getElementById("checkMediacionA");   cont5.innerHTML = "<i style='color:orange; cursor:pointer;' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>";    }else{  cont5 = document.getElementById("checkMediacionA");   cont5.innerHTML = "<i style='color:green; cursor:pointer;' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>"; }
			if(conciup != inputConciliacion){ cont6 = document.getElementById("checkConciliacionA");   cont6.innerHTML = "<i style='color:orange; cursor:pointer;' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>";    }else{  cont6 = document.getElementById("checkConciliacionA");   cont6.innerHTML = "<i style='color:green; cursor:pointer;' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>"; }
			if(crieterup != inputCriteOpor){ cont7 = document.getElementById("checkCriteOporA");   cont7.innerHTML = "<i style='color:orange; cursor:pointer;' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>";    }else{  cont7 = document.getElementById("checkCriteOporA");   cont7.innerHTML = "<i style='color:green; cursor:pointer;' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>"; }
			if(scpup != inputSCP){ cont8 = document.getElementById("checkSCPA");   cont8.innerHTML = "<i style='color:orange; cursor:pointer;' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>";    }else{  cont8 = document.getElementById("checkSCPA");   cont8.innerHTML = "<i style='color:green; cursor:pointer;' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>"; }
			if(incompeup != inputIncompe){ cont9 = document.getElementById("checkIncompeA");   cont9.innerHTML = "<i style='color:orange; cursor:pointer;' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>";    }else{  cont9 = document.getElementById("checkIncompeA");   cont9.innerHTML = "<i style='color:green; cursor:pointer;' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>"; }
			if(acumlup != inputAcumulacion){ cont10 = document.getElementById("checkAcumulacionA");   cont10.innerHTML = "<i style='color:orange; cursor:pointer;' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>";    }else{  cont10 = document.getElementById("checkAcumulacionA");   cont10.innerHTML = "<i style='color:green; cursor:pointer;' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>"; }

			if(reiniciadas != reini){ cont11 = document.getElementById("checkReiniUp");   cont11.innerHTML = "<i style='color:orange; cursor:pointer;' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>";    }else{  cont11 = document.getElementById("checkReiniUp");   cont11.innerHTML = "<i style='color:green; cursor:pointer;' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>"; }
	}
}
}



/// ACCIONES PARA EJECUTAR EN EL MODAL DE ACTUALIZACION DE LOS REGISTROS ////////


function descargar(format, idUnidad, mes, anio, idEnlace){


	if(format == 1){

						ajax=objetoAjax();
						ajax.open("POST", "formatos/descargar.php");
						nombrereporte = "CarpetasInvestigacion-"+idUnidad+"-"+mes+"-"+anio;
						cont = document.getElementById('respuestaDescargarCarpeta');
						ajax.onreadystatechange = function(){
							if (ajax.readyState == 4 && ajax.status == 200) {
							 //cont.innerHTML = ajax.responseText;
								insertHistorial(idEnlace, idUnidad, 1, nombrereporte, mes, anio, format);
							}
						}
						ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
						ajax.send('&idUnidad='+idUnidad+'&mes='+mes+'&anio='+anio+'&idEnlace='+idEnlace);
	}else if(format == 4){

	

						ajax=objetoAjax();
						ajax.open("POST", "format/litigacion/descargar.php");

						nombrereporte = "Litigacion-"+idUnidad+"-"+mes+"-"+anio;
						cont = document.getElementById('respuestaDescargarCarpeta');
						ajax.onreadystatechange = function(){
							if (ajax.readyState == 4 && ajax.status == 200) {
							 cont.innerHTML = ajax.responseText;
								//document.location.href="format/litigacion/downloadReport/"+nombrereporte+".xlsx";
							    insertHistorialLiti(idEnlace, idUnidad, 4, nombrereporte, mes, anio, format);
							}
						}
						ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
						ajax.send('&idUnidad='+idUnidad+'&mes='+mes+'&anio='+anio+'&idEnlace='+idEnlace);
	}


}

function insertHistorial(idEnlace, idUnidad, idTipoArch, nomreport, mes, anio, format){

	ajax=objetoAjax();
	ajax.open("POST", "formatos/insertHistorial.php");
	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {

			var json = ajax.responseText;
									var obj = eval("(" + json + ")");
									if (obj.first == "NO") { swal("", "Hubo un problema favor de revisar.", "warning"); }else{
										 if (obj.first == "SI") {     
															document.location.href="formatos/downloadReport/"+nomreport+".xlsx";
															setTimeout("location.href = 'index.php?format="+format+"';",400);
										 }
									}  
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send('&idEnlace='+idEnlace+'&idUnidad='+idUnidad+'&idTipoArch='+idTipoArch+'&nomreport='+nomreport+'&mes='+mes+'&anio='+anio+'&format='+format);

}


function insertHistorialLiti(idEnlace, idUnidad, idTipoArch, nomreport, mes, anio, format){

	ajax=objetoAjax();
	ajax.open("POST", "format/litigacion/insertHistorial.php");
	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {

			var json = ajax.responseText;
									var obj = eval("(" + json + ")");
									if (obj.first == "NO") { swal("", "Hubo un problema favor de revisar.", "warning"); }else{
										 if (obj.first == "SI") {     
															document.location.href="format/litigacion/downloadReport/"+nomreport+".xlsx";
															setTimeout("location.href = 'index.php?format="+format+"';",400);
										 }
									}  
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send('&idEnlace='+idEnlace+'&idUnidad='+idUnidad+'&idTipoArch='+idTipoArch+'&nomreport='+nomreport+'&mes='+mes+'&anio='+anio+'&format='+format);

}



function cargaContRepositorio(idUsuario, format){
	cont = document.getElementById('contenido');
	ajax=objetoAjax();
	ajax.open("POST", "repositorio/repositorioEnlace.php");

	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText;
					 $('.modal-backdrop').hide();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("&idUsuario="+idUsuario+"&format="+format);
}



function subirArchivoEnlace(idUnidad, mes, anio, idEnlace, idarch){


	cont = document.getElementById('contMOdalSubirArchivo');

	ajax=objetoAjax();
	ajax.open("POST", "repositorio/modalSubirArchivo.php");

	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send('&idUnidad='+idUnidad+'&mes='+mes+'&anio='+anio+'&idEnlace='+idEnlace+'&idarch='+idarch);


}

function subirotravez(idUnidad, mes, anio, enlace, idArch, nomArch){
	

	cont = document.getElementById('contMOdalSubirArchivoAgain');

	ajax=objetoAjax();
	ajax.open("POST", "repositorio/modalSubirArchivoAgain.php");

	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText;
			//cargar tabla sin nada
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("&idUnidad="+idUnidad+"&mes="+mes+"&anio="+anio+"&enlace="+enlace+"&idArch="+idArch+"&nomArch="+nomArch);

}




function subirArchENlace(idUnidad, idEnlace, mes, anio,idTipoArch){


		var con = document.getElementById("respuestaSubida").value;	
		var archivos = document.getElementById("archivos");

		if (archivos.value == "") { swal("", "No hay archivos seleccionados.", "warning");  }else{

		var archivo = archivos.files;

		var archivos = new FormData();
		var oberv = document.getElementById("observaUpload").value;

		for (var i = 0; i < archivo.length; i++) {
					archivos.append('archivo'+i, archivo[i]);
		}

		var size = archivo[0].size;
		var extension = (archivo[0].name.substring(archivo[0].name.lastIndexOf("."))).toLowerCase(); 

		if (extension != '.pdf' || extension != '.pdf' ) { swal("", "Archivo no compatible.", "warning");  }else{

		if (size >= 2200000) { swal("", "El archivo es demasiado grande.", "warning"); }else{

		$.ajax({

				url:'repositorio/subir.php?idUnidad='+idUnidad+'&idEnlace='+idEnlace+'&mes='+mes+'&anio='+anio+'&oberv='+oberv+'&idTipoArch='+idTipoArch,
				type:'POST',
				contentType:false,
				data: archivos,
				processData:false,
				cache:false

		}).done(function(respuesta){
				//cont.innerHTML = respuesta;
				var data = JSON.parse(respuesta);			

				if(data.first == "SI"){

					 swal("", "El archivo fue subido satisfactoriamente.", "success");
					 setTimeout("location.href = 'index.php?format="+idTipoArch+"';",200);
					 /// Cargar de nuevo la pantalla de administrarXproyect
					 agregacontenidoXproyecto(idAreas, idUsuario, idProyecto,nomPro);

				}else{   swal("", "Hubo un error favor de revisar.", "warning");  }

				});

			}
		}

	}

}

function verFormato(idArchivo, ubicacion){


	$('#contMOdalVerFormato').html('<div><img src="img/load.gif"/></div>');

	cont = document.getElementById('contMOdalVerFormato');
	ajax=objetoAjax();
	ajax.open("POST", "repositorio/myModalVerArchivo.php");

	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			
				cont.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("&idArchivo="+idArchivo+"&ubicacion="+ubicacion);


}

function descargarArchivo(nombreArch){

		nombreArch = nombreArch+".pdf";  
		var xhr = new XMLHttpRequest();
		xhr.open("GET", "repositorio/documentos/"+nombreArch, true);
		xhr.responseType = "blob";

		xhr.onload = function(e) {
			if (this.status == 200) {
				var blob = new Blob([this.response], {type: "application/pdf"});
				var link = document.createElement("a");

				link.href = window.URL.createObjectURL(blob);
				link.download = nombreArch;
				link.click();       
			}
		};

		xhr.send();
}


function descargarArchivoHistorico(nombreArch, idTipoArch){

			if(idTipoArch == 1){
					document.location.href="formatos/downloadReport/"+nombreArch+".xlsx";
			}	

				if(idTipoArch == 4){
					document.location.href="format/litigacion/downloadReport/"+nombreArch+".xlsx";
			}	
		 
}



function loadEnlacesFaltantes(){

	cont = document.getElementById('contenido');
	ajax=objetoAjax();
	ajax.open("POST", "faltantes/faltanteEnlace.php");

	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			
				cont.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send(null);

}

function verModalMpsEnlace(idEnlace, nombreEnlace, idfisca, idArchivo){


	mes = document.getElementById("recipientmesFaltante").value;
	anio = document.getElementById("recipientAnioFaltan").value;
	cont = document.getElementById('contMOdalEnlaceMps');
	ajax=objetoAjax();
	
	ajax.open("POST", "faltantes/modalMpsENlaces.php");

	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			
				cont.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("&idEnlace="+idEnlace+"&nombreEnlace="+nombreEnlace+"&mes="+mes+"&anio="+anio+"&idfisca="+idfisca+"&idArchivo="+idArchivo);

}


function cargaContRepositorioAdmin(idUsuario){

	
 cont = document.getElementById('contenido');
	ajax=objetoAjax();
	ajax.open("POST", "repositorio/repositorioAdmin.php");

	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			
				cont.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("&idUsuario="+idUsuario);
}

function cargaContHistoricoAdmin(idUsuario){

	
 cont = document.getElementById('contenido');
	ajax=objetoAjax();
	ajax.open("POST", "repositorio/historicoAdmin.php");

	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			
				cont.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("&idUsuario="+idUsuario);
}

function cargaContHistoricoEnlace(idUsuario, idEnlace, format){

	
 cont = document.getElementById('contenido');
	ajax=objetoAjax();
	ajax.open("POST", "repositorio/historicoEnlace.php");

	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			
				cont.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("&idUsuario="+idUsuario+"&idEnlace="+idEnlace+"&format="+format);
}



function cambiarEstadoRevisando(idArchivo){
// SOLO SE VA A CAMBIAR EL STATUS DEL ARCHIVO A REVISANDO
	 var accion = "rev"; 
	
	ajax=objetoAjax();
	ajax.open("POST", "repositorio/accionesArchivo.php");

	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			

				 var cadCodificadaJSON = ajax.responseText;
									var objDatos = eval("(" + cadCodificadaJSON + ")");


									if (objDatos.first == "NO") { swal("", "No se pudo actualizar el estado.", "error"); }else{

										 if (objDatos.first == "SI") {}
									}

		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("&accion="+accion+"&idArchivo="+idArchivo);
}

function revisarArchivoMOdal(idArc, ub, nUnid, idEnlace){


tipo = document.getElementById("tipoarchReposi").value;
mes = document.getElementById("mesAdminarch").value;
anio = document.getElementById("anioArchSelectedAdmin").value;

cont = document.getElementById('contenidoRevisarArchivo');
	ajax=objetoAjax();
	ajax.open("POST", "repositorio/myModaRevisarArchivo.php");

	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			
				cont.innerHTML = ajax.responseText;
				cambiarEstadoRevisando(idArc);
				//cambiarEstadoRevisando(idArchivo);

				$('#myModaRevisarSeguimiento').on('hidden.bs.modal', function () {
					
					//cargaContRepositorioAdmin(idUsuario);
					//$('.modal-backdrop').hide();
				});

		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("&idArc="+idArc+"&ub="+ub+"&nUnid="+nUnid+"&idEnlace="+idEnlace+"&mes="+mes+"&anio="+anio+"&tipo="+tipo);
}

function concluirArchivo(idArchivo, idEnlace, mes, anio, tipo){
// SOLO SE VA A CAMBIAR EL STATUS DEL ARCHIVO A REVISANDO
	cont = document.getElementById('concluirArchivo');
	ajax=objetoAjax();
	ajax.open("POST", "repositorio/myModalConcluir.php");

	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			
				cont.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("&idArchivo="+idArchivo+"&idEnlace="+idEnlace+"&mes="+mes+"&anio="+anio+"&tipo="+tipo);
}

function cancelarBoton(){ 
	$('#myModalConcluirArchivo').modal('hide'); 
}

function cancelarBotonValidate(){ 
	$('#validateNucs').modal('hide'); 
}

function cerrarModalRevisaraRCH(idUsuario){
	 $('#myModaRevisarArchivo').modal('hide'); 
	 cargaContRepositorioAdmin(idUsuario);  
}

function guardarConcluirRevision(idArchivo, idUsuario, idEnlace, mes, anio, tipo){	

	var observaciones = document.getElementById("obserConcluirArchivoa").value;
	var estadoSelect = document.getElementById("selectEstadoArchivoa").value;

	
	if(estadoSelect == 0){  swal("", "Debes de seleccionar un estado para el archivo.", "warning");  }else{

	if(estadoSelect == "rac"){

		if(observaciones == ""){ swal("", "Escribe un motivo de Rechazo.", "warning"); }else{
			 cont = document.getElementById('respueastaConcluir');
			ajax=objetoAjax();
			ajax.open("POST", "repositorio/guardarConcluirRevision.php");

			ajax.onreadystatechange = function(){
				if (ajax.readyState == 4 && ajax.status == 200) {
					cont.innerHTML = ajax.responseText;



						var cadCodificadaJSON = ajax.responseText;
									var objDatos = eval("(" + cadCodificadaJSON + ")");

						if (objDatos.first == "NO") { swal("", "No se pudo actualizar el estado.", "error"); }else{

										 if (objDatos.first == "SI") {

												swal("", "Se ha actualizado el estado del archivo correctamente.'.", "success");
												$('#myModaRevisarArchivo').modal('hide'); 
												$('#myModalConcluirArchivo').modal('hide'); 
												$('.modal-backdrop').hide();
												cargaContRepositorioAdmin(idUsuario);
										 }
									}

				}
			}

		 }
	}  else{


						 cont = document.getElementById('respueastaConcluir');
			ajax=objetoAjax();
			ajax.open("POST", "repositorio/guardarConcluirRevision.php");

			ajax.onreadystatechange = function(){
				if (ajax.readyState == 4 && ajax.status == 200) {
					cont.innerHTML = ajax.responseText;



						var cadCodificadaJSON = ajax.responseText;
									var objDatos = eval("(" + cadCodificadaJSON + ")");

						if (objDatos.first == "NO") { swal("", "No se pudo actualizar el estado.", "error"); }else{

										 if (objDatos.first == "SI") {

												swal("", "Se ha actualizado el estado del archivo correctamente.'.", "success");
												$('#myModaRevisarArchivo').modal('hide'); 
												$('#myModalConcluirArchivo').modal('hide'); 
												$('.modal-backdrop').hide();
												cargaContRepositorioAdmin(idUsuario);
												//cont.innerHTML = ajax.responseText;
										 }
									}

				}
			}

	}
		 
			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			ajax.send("&idArchivo="+idArchivo+"&observaciones="+observaciones+"&estadoSelect="+estadoSelect+"&idEnlace="+idEnlace+"&mes="+mes+"&anio="+anio+"&tipo="+tipo);

	}
	
}


function subirArchivoAgain(idUnidad, idEnlace, mes, anio, nomArchivo, idArchi){

		var archivosr = document.getElementById("archivosr");


		if (archivosr.value == "") { swal("", "No hay archivos seleccionados.", "warning");  }else{

		var archivo = archivosr.files;

		var archivosr = new FormData();
		var oberv = document.getElementById("observaUploadr").value;

		for (var i = 0; i < archivo.length; i++) {
					archivosr.append('archivo'+i, archivo[i]);
		}

		var size = archivo[0].size;
		var extension = (archivo[0].name.substring(archivo[0].name.lastIndexOf("."))).toLowerCase(); 

		if (extension != '.pdf' || extension != '.pdf' ) { swal("", "Archivo no compatible.", "warning");  }else{

		if (size >= 2200000) { swal("", "El archivo es demasiado grande.", "warning"); }else{

		$.ajax({

				url:'repositorio/resubir.php?idEnlace='+idEnlace+'&mes='+mes+'&anio='+anio+'&oberv='+oberv+'&nomArchivo='+nomArchivo+'&idArchi='+idArchi+'&idUnidad='+idUnidad,
				type:'POST',
				contentType:false,
				data: archivosr,
				processData:false,
				cache:false

		}).done(function(respuesta){


				var data = JSON.parse(respuesta);
				

				if(data.first == "SI"){

					 swal("", "El archivo fue subido satisfactoriamente.", "success");

					 /// Cargar de nuevo la pantalla de administrarXproyect
					 cargaContRepositorio(idUnidad, 130);
					 $('#myModalUploadAgain').modal('hide'); 
					 $('.modal-backdrop').hide();

				}else{   swal("", "Hubo un error favor de revisar.", "warning");  }


		});

	}
}

	}
}

function validartamano(idinput, idMp, mes, anio, estatResolucion, deten, idUnidad){

  texto = document.getElementById(idinput).value;
  cantidadinicio = document.getElementById(idinput).value.length;

  if(cantidadinicio > 13){
    var slice2 = texto.slice(0,-1);
    document.getElementById(idinput).value = slice2;
  }else{

  			if (cantidadinicio < 13) {}else{

  						 if (cantidadinicio == 13) {

					nuc=document.getElementById('nuc').value;									  			
					
					acc = "existeNuc";
					ajax=objetoAjax();
					ajax.open("POST", "formatos/accionesNucs.php");

							ajax.onreadystatechange = function(){
						if (ajax.readyState == 4 && ajax.status == 200) {							
													
													
							var cadCodificadaJSON = ajax.responseText;
											var objDatos = eval("(" + cadCodificadaJSON + ")");

											if (objDatos.first == "NO") { getExpediente("expedCont", nuc); swal("", "El numero de caso no existe.", "warning"); }else{

										 if (objDatos.first == "SI") {
										 				getDatosNucDetermEst(nuc, idMp, estatResolucion, mes, anio, deten, idUnidad);
										 }
									}					
								

						}
					}
					ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
					ajax.send("&nuc="+nuc+"&acc="+acc+"&estatResolucion="+estatResolucion);
											
				}
  			}
  }  
}
   

function getDatosNucDetermEst(nuc, idMp, estatResolucion, mes, anio, deten, idUnidad){


					cont = document.getElementById("contDataNucDeterm");
					acc = "getDataNuc";
					ajax=objetoAjax();
					ajax.open("POST", "formatos/accionesNucs.php");

							ajax.onreadystatechange = function(){
						if (ajax.readyState == 4 && ajax.status == 200) {							
													
														cont.innerHTML = ajax.responseText;
														checkInserted(nuc, idMp, estatResolucion, mes, anio, deten, idUnidad);

						}
					}
					ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
					ajax.send("&nuc="+nuc+"&acc="+acc+"&estatResolucion="+estatResolucion+"&idUnidad="+idUnidad);
}


function checkInserted(nuc, idMp, estatResolucion, mes, anio, deten, idUnidad){
			
			acc = "checkinsert";
					ajax=objetoAjax();
					ajax.open("POST", "formatos/accionesNucs.php");

					ajax.onreadystatechange = function(){
						if (ajax.readyState == 4 && ajax.status == 200) {							
									
											var cadCodificadaJSON = ajax.responseText;
											var objDatos = eval("(" + cadCodificadaJSON + ")");

											if (objDatos.first == "SI") { 

												getExpediente("expedCont", nuc); 
												//// obtener los datos del MP que determino el NUC 
												var mpnombre = document.getElementById("nombreMpinput").value;
												var nUnidad = document.getElementById("nombreUnidadinput").value;

												//swal("", "<b>El Número de caso se encuentra determinado</b> \n\n Unidad: "+nUnidad+"\n Mp: "+mpnombre, "warning"); 
												swal({
												  title: "<h4>El Número de caso se encuentra determinado.</h4>",
												  text: "<label style='color:black;'><b>Unidad :</b</label><label style='color:#3c6084;'>"+nUnidad+"</label> \n <label style='color:black;'><b>Mp :</b</label><label style='color:#3c6084;'>"+mpnombre+"</label>",
												  html: true
												});

											}else{

										 if (objDatos.first == "NO") {

										 			caninsert(nuc, idMp, estatResolucion, mes, anio, deten, idUnidad);

										 }
									}

						}
					}
					ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
					ajax.send("&nuc="+nuc+"&acc="+acc+"&idMp="+idMp+"&estatResolucion="+estatResolucion+"&mes="+mes+"&anio="+anio+"&idUnidad="+idUnidad);

}

function caninsert(nuc, idMp, estatResolucion, mes, anio, deten, idUnidad){

			acc = "caninsert";
			numcasos = document.getElementById("casos").value; 

			ajax=objetoAjax();
			ajax.open("POST", "formatos/accionesNucs.php");

					ajax.onreadystatechange = function(){
						if (ajax.readyState == 4 && ajax.status == 200) {							
									
											var cadCodificadaJSON = ajax.responseText;
											var objDatos = eval("(" + cadCodificadaJSON + ")");

											if (objDatos.first == "NO") { getExpediente("expedCont", nuc); swal("", "Excediste el numero maximo permitido.", "warning"); }else{

										 if (objDatos.first == "SI") {
										 				getExpediente("expedCont", nuc);
															setTimeout("insertarNuc("+idMp+","+estatResolucion+","+mes+","+anio+","+nuc+","+deten+","+idUnidad+");",100);
					
										 }
									}

						}
					}
					ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
					ajax.send("&nuc="+nuc+"&acc="+acc+"&idMp="+idMp+"&estatResolucion="+estatResolucion+"&mes="+mes+"&anio="+anio+"&numcasos="+numcasos+"&deten="+deten+"&idUnidad="+idUnidad);

}


function getExpediente(input, nuc){

			acc = "getExp";
			cont = document.getElementById(input);
					ajax=objetoAjax();
					ajax.open("POST", "formatos/accionesNucs.php");

					ajax.onreadystatechange = function(){
						if (ajax.readyState == 4 && ajax.status == 200) {							
								cont.innerHTML = ajax.responseText;
						}
					}
					ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
					ajax.send("&nuc="+nuc+"&acc="+acc);

}


////////////////////////////////////// FUNCTION LITIGACION PAA NUS ////////////////////////////////////
////////////////////////////////////// FUNCTION LITIGACION PAA NUS ////////////////////////////////////
////////////////////////////////////// FUNCTION LITIGACION PAA NUS ////////////////////////////////////



function nucFunctionsLit(nuc, idMp, mes, anio, estatResolucion, deten, idUnidad){

			
			validartamanoLit(nuc, idMp, mes, anio, estatResolucion, deten, idUnidad);

}

function validartamanoLit(idinput, idMp, mes, anio, estatResolucion, deten, idUnidad){



  texto = document.getElementById(idinput).value;
  cantidadinicio = document.getElementById(idinput).value.length;

  if(cantidadinicio > 13){
    var slice2 = texto.slice(0,-1);
    document.getElementById(idinput).value = slice2;
  }else{

  			if (cantidadinicio < 13) {}else{

  						 if (cantidadinicio == 13) {

					nuc=document.getElementById('nuc').value;									  			
					
					acc = "existeNuc";
					ajax=objetoAjax();
					ajax.open("POST", "formatos/accionesNucs.php");

							ajax.onreadystatechange = function(){
						if (ajax.readyState == 4 && ajax.status == 200) {							
													
													
							var cadCodificadaJSON = ajax.responseText;
											var objDatos = eval("(" + cadCodificadaJSON + ")");

											if (objDatos.first == "NO") { getExpediente("expedCont", nuc); swal("", "El numero de caso no existe.", "warning"); }else{

										 if (objDatos.first == "SI") {
										 				//getDatosNucDetermEstLit(nuc, idMp, estatResolucion, mes, anio, deten, idUnidad);
										 				//caninsertLit(nuc, idMp, estatResolucion, mes, anio, deten, idUnidad);
										 				getExpediente("expedCont", nuc);
															
															setTimeout("insertarNucLit2("+idMp+","+estatResolucion+","+mes+","+anio+","+nuc+","+deten+","+idUnidad+");",100);


										 }
									}					
								

						}
					}
					ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
					ajax.send("&nuc="+nuc+"&acc="+acc+"&estatResolucion="+estatResolucion);
											
				}
  			}
  }  
}



function insertarNucLit2(idMp, estatResolucion, mes, anio, nuc, deten, idUnidad){				


				acc = "insertNucLit";
					ajax=objetoAjax();
					ajax.open("POST", "formatos/accionesNucs.php");

			

					ajax.onreadystatechange = function(){
						if (ajax.readyState == 4 && ajax.status == 200) {							
								//cont.innerHTML = ajax.responseText;

									var cadCodificadaJSON = ajax.responseText;
											var objDatos = eval("(" + cadCodificadaJSON + ")");

											if (objDatos.first == "NO") { swal("", "El NUC ya se encuentra registrado favor de revisar.", "Warning"); }else{

										 if (objDatos.first == "SI") {



										 				swal("", "Se Registro Correctamente.", "success");																		
															updateTableNucsLit(idMp, anio, mes, estatResolucion, nuc, deten, idUnidad);			
										 }
									}

						}
					}
					ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
					ajax.send("&nuc="+nuc+"&acc="+acc+"&idMp="+idMp+"&estatResolucion="+estatResolucion+"&mes="+mes+"&anio="+anio+"&deten="+deten+"&idUnidad="+idUnidad);

}


function updateTableNucsLit(idMp, anio, mes, estatResolucion, nuc, deten, idUnidad){

		//alert("LLEga el contable nucs <br>"+idMp+"<br>"+anio+"<br>"+mes+"<br>"+estatResolucion+"<br>"+nuc+"<br>"+deten+"<br>"+idUnidad);

			acc = "showtablelit";
			cont = document.getElementById("contTableNucs");
				ajax=objetoAjax();
					ajax.open("POST", "formatos/accionesNucs.php");

					ajax.onreadystatechange = function(){
						if (ajax.readyState == 4 && ajax.status == 200) {							
								cont.innerHTML = ajax.responseText;								
								getExpediente("expedCont", nuc);	
						}
					}
					ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
					ajax.send("&acc="+acc+"&idMp="+idMp+"&estatResolucion="+estatResolucion+"&mes="+mes+"&anio="+anio+"&nuc="+nuc+"&deten="+deten+"&idUnidad="+idUnidad);

}




////////////////////////////////////// FUNCTION LITIGACION PAA NUS ////////////////////////////////////
////////////////////////////////////// FUNCTION LITIGACION PAA NUS ////////////////////////////////////
////////////////////////////////////// FUNCTION LITIGACION PAA NUS ////////////////////////////////////



function nucFunctions(nuc, idMp, mes, anio, estatResolucion, deten, idUnidad){

			validartamano(nuc, idMp, mes, anio, estatResolucion, deten, idUnidad);

}

function insertarNuc(idMp, estatResolucion, mes, anio, nuc, deten, idUnidad){


				acc = "insertNuc";
					ajax=objetoAjax();
					ajax.open("POST", "formatos/accionesNucs.php");

					ajax.onreadystatechange = function(){
						if (ajax.readyState == 4 && ajax.status == 200) {							
								//cont.innerHTML = ajax.responseText;

									var cadCodificadaJSON = ajax.responseText;
											var objDatos = eval("(" + cadCodificadaJSON + ")");

											if (objDatos.first == "NO") { swal("", "El NUC ya se encuentra registrado favor de revisar.", "Warning"); }else{

										 if (objDatos.first == "SI") {

										 				swal("", "Se Registro Correctamente.", "success");																		
															updateTableNucs(idMp, anio, mes, estatResolucion, nuc, deten, idUnidad);			
										 }
									}

						}
					}
					ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
					ajax.send("&nuc="+nuc+"&acc="+acc+"&idMp="+idMp+"&estatResolucion="+estatResolucion+"&mes="+mes+"&anio="+anio+"&deten="+deten+"&idUnidad="+idUnidad);

}

function updateTableNucs(idMp, anio, mes, estatResolucion, nuc, deten, idUnidad){

		//alert("LLEga el contable nucs <br>"+idMp+"<br>"+anio+"<br>"+mes+"<br>"+estatResolucion+"<br>"+nuc+"<br>"+deten+"<br>"+idUnidad);

			acc = "showtable";
			cont = document.getElementById("contTableNucs");
				ajax=objetoAjax();
					ajax.open("POST", "formatos/accionesNucs.php");

					ajax.onreadystatechange = function(){
						if (ajax.readyState == 4 && ajax.status == 200) {							
								cont.innerHTML = ajax.responseText;								
								getExpediente("expedCont", nuc);	
						}
					}
					ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
					ajax.send("&acc="+acc+"&idMp="+idMp+"&estatResolucion="+estatResolucion+"&mes="+mes+"&anio="+anio+"&nuc="+nuc+"&deten="+deten+"&idUnidad="+idUnidad);

}

function updateTableNucs2(idMp, anio, mes, estatResolucion, nuc, deten){

			acc = "showtable2";
			cont = document.getElementById("contTableNucs");
				ajax=objetoAjax();
					ajax.open("POST", "formatos/accionesNucs.php");

					ajax.onreadystatechange = function(){
						if (ajax.readyState == 4 && ajax.status == 200) {							
								cont.innerHTML = ajax.responseText;											
						}
					}
					ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
					ajax.send("&acc="+acc+"&idMp="+idMp+"&estatResolucion="+estatResolucion+"&mes="+mes+"&anio="+anio+"&deten="+deten+"&nuc="+nuc);

}

function listoNucs(numResolRecently){


			var canTcasos = document.getElementById("casos").value

			if (canTcasos > numResolRecently || canTcasos < numResolRecently) { swal("", "El numero de casos no coincide con los Registrados.", "warning"); }else{

						if(canTcasos == numResolRecently){

										swal("", "Listo puedes continuar.", "success");

						}else{ swal("", "Revisa el contenido.", "warning"); }

			}


}


function deleteResol(idResol, idMp, anio, mes, estatResolucion, nuc, deten, idUnidad){



	
		swal({
				title: "",
				text: "¿Esta seguro de Eliminar?",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Eliminar",
				cancelButtonText: "Cancelar",
				closeOnConfirm: true,
				closeOnCancel: true
			},
			function(isConfirm){
				if (isConfirm) {

								acc = "deleteResol";
								ajax=objetoAjax();
								ajax.open("POST", "formatos/accionesNucs.php");

								ajax.onreadystatechange = function(){
								if (ajax.readyState == 4 && ajax.status == 200) {

											var cadCodificadaJSON = ajax.responseText;
											var objDatos = eval("(" + cadCodificadaJSON + ")");

											if (objDatos.first == "NO") { swal("", "Hubo un problema favor de revisar.", "Warning"); }else{

										 if (objDatos.first == "SI") {															

															//updateTableNucs2(idMp, anio, mes, estatResolucion, nuc, deten);	
															updateTableNucsLit(idMp, anio, mes, estatResolucion, nuc, deten, idUnidad);		
															setTimeout("removeDataSenap("+idResol+","+estatResolucion+");",100);											
										 }
									}
								
						}
					}
					ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
					ajax.send("&acc="+acc+"&idResol="+idResol);
					
				}
			});				

}

//Funcion para eliminar informacion adicional de SENAP al eliminar el nuc
function removeDataSenap(idEstatusNucs,estatResolucion){
	validaDataSenap = validarEstatusShowInfoSica(estatResolucion); //Si el estatusResolucion es de SENAP pocedemos a efectuar la llamada
	if(validaDataSenap){
								ajax=objetoAjax();
								ajax.open("POST", "../format/litigacion/insertSenap/deleteDataSenap.php");

								ajax.onreadystatechange = function(){
								if (ajax.readyState == 4 && ajax.status == 200) {						
								
						}
					}
					ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
					ajax.send("&idEstatusNucs="+idEstatusNucs+"&estatResolucion="+estatResolucion);
			}	
}

//Funcion para validad si el estatus recibido requiere informacion adicional de SENAP
function validarEstatusShowInfoSica(estatResolucion){

	if(estatResolucion == 3 || estatResolucion == 4 || estatResolucion == 19 || estatResolucion == 17 || estatResolucion == 18 
		|| estatResolucion == 20  || estatResolucion == 21 || estatResolucion== 22 || estatResolucion == 23  || estatResolucion == 24 
		||estatResolucion == 25 || estatResolucion == 26 || estatResolucion == 27 || estatResolucion == 28 || estatResolucion == 29  
		|| estatResolucion == 30 || estatResolucion == 31 || estatResolucion == 95 || estatResolucion == 61 || estatResolucion == 63 
		|| estatResolucion == 99 || estatResolucion == 89 || estatResolucion == 101 || estatResolucion == 103 || estatResolucion == 105 
		|| estatResolucion == 106 || estatResolucion == 89 || estatResolucion == 107 || estatResolucion == 108 || estatResolucion == 109
		 || estatResolucion == 110 || estatResolucion == 111 || estatResolucion == 64 || estatResolucion == 60 || estatResolucion == 14 
		 || estatResolucion == 65 || estatResolucion == 66 || estatResolucion == 67 || estatResolucion == 68 || estatResolucion == 90 
		 || estatResolucion == 91){
		return true;
	}
	else{
		return false;
	}
}


///////////// RELIMINAR PARA REINICIADAS //////////////////////



function deleteResolReini(idCaperta, idMp, anio, mes, estatResolucion, nuc, deten, idUnidad){

		swal({
				title: "",
				text: "¿Esta seguro de Eliminar?",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Eliminar",
				cancelButtonText: "Cancelar",
				closeOnConfirm: true,
				closeOnCancel: true
			},
			function(isConfirm){
				if (isConfirm) {

								acc = "deleteResolReini";
								ajax=objetoAjax();
								ajax.open("POST", "formatos/accionesNucs.php");

								ajax.onreadystatechange = function(){
								if (ajax.readyState == 4 && ajax.status == 200) {

											var cadCodificadaJSON = ajax.responseText;
											var objDatos = eval("(" + cadCodificadaJSON + ")");

											if (objDatos.first == "NO") { swal("", "Hubo un problema favor de revisar.", "Warning"); }else{

										 if (objDatos.first == "SI") {															

															//updateTableNucs2(idMp, anio, mes, estatResolucion, nuc, deten);	
															updateTableNucs(idMp, anio, mes, estatResolucion, nuc, deten, idUnidad);													
										 }
									}
								
						}
					}
					ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
					ajax.send("&acc="+acc+"&idCaperta="+idCaperta+"&estatResolucion="+estatResolucion+"&idMp="+idMp+"&idUnidade="+idUnidad);
					
				}
			});				

}



//vALIDA SI EL INPUT QUE LLEGA TIENE REGISTRADOS EL MISMO NUMERO DE NUCS QUE SU VALOR
function checkinputvalidated(cant, inputCont, idMp, estatus, mes, anio, deten){

		
			acc = "validateCheck";
			cont = document.getElementById(inputCont);

					ajax=objetoAjax();
					ajax.open("POST", "formatos/accionesNucs.php");

					ajax.onreadystatechange = function(){
						if (ajax.readyState == 4 && ajax.status == 200) {							
								
								var cadCodificadaJSON = ajax.responseText;
											var objDatos = eval("(" + cadCodificadaJSON + ")");

											if (objDatos.first == "NO") { cont.innerHTML = "<i style='color:orange; cursor:pointer;' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>"; }else{

										 if (objDatos.first == "SI") {															
										 						
										 						cont.innerHTML = "<i style='color:green;' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>";
																													
										 }
									}
						}
					}
					ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
					ajax.send("&cant="+cant+"&idMp="+idMp+"&estatus="+estatus+"&mes="+mes+"&anio="+anio+"&deten="+deten+"&acc="+acc);

}




function closeModal(modal, idMp, estatus, mes, anio, deten, inputchek, cant){ 

	$('#'+modal).modal('hide');    

	checkinputvalidated(cant, inputchek, idMp, estatus, mes, anio, deten);

}

function checkCero(valorinput, continput, idMp, estatus, mes, anio, deten){

				var valor = document.getElementById(valorinput).value
				cont = document.getElementById(continput);

			if(valor != ""){

							checkinputvalidated(valor, continput, idMp, estatus, mes, anio, deten);
							actualizarJudicializadas(event);

			}	else{ cont.innerHTML = "<i id='ICdetenju' class='fa fa-file-text fa-lg fa-fw' aria-hidden='true'></i>"; }
			
				
				

}

function loadTrimestralAdmin(){

	$.ajax({
		url:'format/trimestral/admin/admin.php',
		type:'POST',
		contentType:false,
		processData:false,
		cache:false
	}).done(function(respuesta){
		$( "#contenido" ).html( respuesta );
		loadTrimestralPeriods();
	});

}

function loadReporteTrim(){

 $.ajax({
  url:'format/trimestral/admin/admin.php',
  type:'POST',
  contentType:false,
  processData:false,
  cache:false
 }).done(function(respuesta){
  $( "#contenido" ).html( respuesta );
  loadTrimestralReport();
 });

}

function loadTrimestralPeriods(){

	$.ajax({
		url:'format/trimestral/admin/templates/available_periods_table.php',
		type:'POST',
		contentType:false,
		processData:false,
		cache:false
	}).done(function(respuesta){
		$( "#admin_content" ).html( respuesta );
	});

}

function loadTrimestralReport(){

 $.ajax({
  url:'format/trimestral/admin/templates/report_by_quest_table.php',
  type:'POST',
  contentType:false,
  processData:false,
  cache:false
 }).done(function(respuesta){
  $( "#admin_content" ).html( respuesta );
 });

}