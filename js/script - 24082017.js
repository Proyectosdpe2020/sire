
var dataIdsActividades = new Array();
var tamañoActividadesNuevasTabla = 0; //Esta variable se ultiliza para desseleccionar los check seleccionados en un for para cuando se cancele el modal

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


function limpiarArreglo(array) {
  while (array.length) {
    array.pop();
  }
}


function cargarContenidoActividadesTablaUpdate(idProyecto){

	cont = document.getElementById('contenidoactividadestabla');

	ajax=objetoAjax();
	ajax.open("POST", "catalogo/actividadesTablaCargar.php");

	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText;		
		}
	}		
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("&idProyecto="+idProyecto); 

}


function cargarContenidoActividadesTabla(){

	var idProyecto = document.getElementById("proyectoId").value;
	if(idProyecto != 0){

		cont = document.getElementById('contenidoactividadestabla');

		ajax=objetoAjax();
		ajax.open("POST", "catalogo/actividadesTablaCargar.php");

		ajax.onreadystatechange = function(){
			if (ajax.readyState == 4 && ajax.status == 200) {
				cont.innerHTML = ajax.responseText;		
			}
		}		
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("&idProyecto="+idProyecto); 
	}else{

		swal("", "Debe seleccionar un proyecto.", "error");
	}

}

function eliminarNuevaActividad(idNuevaActividad, idProyecto){

	swal({
		  title: "",
		  text: "¿Esta seguro que quiere eliminar la nueva actividad con sus actividades?",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonColor: "#DD6B55",
		  confirmButtonText: "Si, eliminar",
		  cancelButtonText: "No, cancelar",
		  closeOnConfirm: false,
		  closeOnCancel: false
	},
	
	function(isConfirm){
	  
	  if (isConfirm) {

		ajax=objetoAjax();
		ajax.open("POST", "catalogo/eliminarNuevaActividad.php");

		ajax.onreadystatechange = function(){
			if (ajax.readyState == 4 && ajax.status == 200) {				
				//cont.innerHTML = ajax.responseText;

				///// cargar actividades de la nueva actividad
				//cargarContenidoActividadesTabla(idProyecto);
				cargarNuevasActividadesProyecto(idProyecto);
				
				//cargarActividadesNewAct(idNuevaActividad);
				swal("", "La actividad ha sido eliminada con sus actividades.", "success");	
				getTotalesActivids(idProyecto);	

			}
		}		
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("&idNuevaActividad="+idNuevaActividad); 
	    
	  } 
	  else {
	    swal("Cancelado", "", "error");
	  }
	});
}	

function eliminarActividadAgrupada(idActividadAgrupada, idActividad, idNuevaActividad, idProyecto, cantidadRestar){

	swal({
		  title: "",
		  text: "¿Esta seguro que quiere eliminar la actividad?",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonColor: "#DD6B55",
		  confirmButtonText: "Si, eliminar",
		  cancelButtonText: "No, cancelar",
		  closeOnConfirm: false,
		  closeOnCancel: false
	},
	
	function(isConfirm){
	  
	  if (isConfirm) {

	  	cont = document.getElementById('contenidoActAgrupadas');

		ajax=objetoAjax();
		ajax.open("POST", "catalogo/eliminarActividad.php");

		ajax.onreadystatechange = function(){
			if (ajax.readyState == 4 && ajax.status == 200) {				
				//cont.innerHTML = ajax.responseText;

				///// cargar actividades de la nueva actividad
				//cargarContenidoActividadesTabla(idProyecto);
				cargarNuevasActividadesProyecto(idProyecto);

				//cargarActividadesNewAct(idNuevaActividad);
				swal("", "La actividad ha sido eliminada.", "success");	
				getTotalesActivids(idProyecto);	

			}
		}		
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("&idActividadAgrupada="+idActividadAgrupada+"&idActividad="+idActividad+"&idNuevaActividad="+idNuevaActividad+"&cantidadRestar="+cantidadRestar); 
	    
	  } 
	  else {
	    swal("Cancelado", "", "error");
	  }
	});
}


function cargarActividadesNewAct(idNuevaActividad){

	cont = document.getElementById('contenidoActAgrupadas');

	ajax=objetoAjax();
	ajax.open("POST", "catalogo/actiAgrupadas.php");

	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText;		
		}
	}		
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("&idNuevaActividad="+idNuevaActividad); 
}

function cargarNuevasActividadesProyecto(idProyecto){

	cont = document.getElementById('contenidoActividadesTabla');

	ajax=objetoAjax();
	ajax.open("POST", "catalogo/nuevasActividadesTabla.php");

	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText;
			cargarActividadesNewAct(0);

			$('.modal-backdrop').hide();

			$(document).ready(function (e) {
  
				$('#modalEditarNuevaActividad').on('show.bs.modal', function(e) {
				

				var naid = $(e.relatedTarget).data('naid'); 
				var naname = $(e.relatedTarget).data('naname');
				var nacantbene = $(e.relatedTarget).data('nacantbene');
				var naacumulado = $(e.relatedTarget).data('naacumulado');
				var naidproye = $(e.relatedTarget).data('idproyena');

				$(e.currentTarget).find('input[name="idna"]').val(naid);
				$(e.currentTarget).find('input[name="naname"]').val(naname);
				$(e.currentTarget).find('input[name="nacantbene"]').val(nacantbene);	
				$(e.currentTarget).find('input[name="acumu"]').val(naacumulado);
				$(e.currentTarget).find('input[name="idproyecna"]').val(naidproye);

				var selectObjetoBeneficiario = document.getElementById("idBeneficiarioList");
				var nabeneficiario = $(e.relatedTarget).data('nabeneficiario');
				seleccionarValorSelect(selectObjetoBeneficiario, nabeneficiario);

				var selectObjetoMedida = document.getElementById("idMedidaList");
				var namedida = $(e.relatedTarget).data('namedida');
				seleccionarValorSelect(selectObjetoMedida, namedida);

				});
			});	

				$(document).ready(function (e) {

					$('#modalEditarNuevaActividad').on('hidden.bs.modal', function () {
		                cargarNuevasActividadesProyecto(idProyecto);
		                limpiarArreglo(dataIdsActividades);
		            });
		            

				});
		}
	}		
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("&idProyecto="+idProyecto); 
}

function seleccionarValorSelect(objetoSelect, valor){
	 for (var i = 0; i < objetoSelect.options.length; i++) {
        if (objetoSelect.options[i].text== valor) {
            objetoSelect.options[i].selected = true;
            return;
        }
    }
}

function getTotalesActivids(idProyecto){

	cont = document.getElementById('contenidoTotalesXproyecto');

	ajax=objetoAjax();
	//$('#contenidoTotalesXproyecto').html('<div>s<img src="../images/cargando.gif"/></div>');
	ajax.open("POST", "catalogo/getTotalesActi.php");

	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText;
			cargarNuevasActividadesProyecto(idProyecto);		
		}
	}		
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("&idProyecto="+idProyecto);
}



function obtenerIDproyecto(){

	var idSeleccionado = document.getElementById("proyectoId").value;
    cont = document.getElementById('modalNuevaActividadContenido');
	
	ajax=objetoAjax();
	//$('#contenidoActividades').html('<div>s<img src="../images/cargando.gif"/></div>');
	ajax.open("POST", "catalogo/modalNuevaActivity.php");

	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText;
			cargarNuevasActividadesProyecto(idSeleccionado);
			getTotalesActivids(idSeleccionado);	

			$('#modalNuevaActividad').on('hidden.bs.modal', function (e) {

						$(e.currentTarget).find('input[name="nomactivity"]').val("");

						document.getElementById("medidalist").options[0].selected = true;
						document.getElementById("beneficiarioList").options[0].selected = true;

						/*for(i = 0; i < tamañoActividadesNuevasTabla; i++){

							document.getElementById("checkActNew"+i).checked = false;
						}*/

						$(e.currentTarget).find('input[name="anbenecant"]').val(0);
						$(e.currentTarget).find('input[name="anaculato"]').val(0);

						limpiarArreglo(dataIdsActividades);
		            });
		}
	}		
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("&idSeleccionado="+idSeleccionado); 
	
}

function cargarModalYnuevasActividades(idProyecto){

	cont = document.getElementById('modalNuevaActividadContenido');
	
	ajax=objetoAjax();
	//$('#contenidoActividades').html('<div>s<img src="../images/cargando.gif"/></div>');
	ajax.open("POST", "catalogo/modalNuevaActivity.php");

	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText;
			cargarNuevasActividadesProyecto(idProyecto);
			getTotalesActivids(idProyecto);	
		}
	}		
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("&idSeleccionado="+idProyecto); 
}

function agregarSumarActividadUpdate(cantidadActual, idInputname, cantBeneficiarios, idDeActividad){

	var cantbenef = parseInt(document.getElementById("cantBenefi").value);
	var acumulado = parseInt(document.getElementById("acumuladon").value);

	var y = document.getElementById(idInputname).checked;


	if(y == true){

		cantbenef   =  cantbenef + cantBeneficiarios;			
		acumulado =  acumulado + cantidadActual; 	

		document.getElementById("acumuladon").value = acumulado;
		document.getElementById("cantBenefi").value = cantbenef;
		dataIdsActividades.push(idDeActividad);
		
	}else{

		cantbenef   =  cantbenef - cantBeneficiarios;
		acumulado = acumulado - cantidadActual;		

		document.getElementById("cantBenefi").value = cantbenef;
		document.getElementById("acumuladon").value = acumulado;

		var index = dataIdsActividades.indexOf(idDeActividad);
		dataIdsActividades.splice(index, 1);		
	}
}

function agregarSumarActividad(cantidadActual, idInputname, cantBeneficiarios, idDeActividad, tamañoNuevasActividades){	

	tamañoActividadesNuevasTabla = tamañoNuevasActividades;

	var canBene = parseInt(document.getElementById("benecant").value);
	var acumulado = parseInt(document.getElementById("aculato").value);
	

	var x = document.getElementById(idInputname).checked;

	if(x == true){
		
		canBene   =  canBene + cantBeneficiarios;			
		acumulado =  acumulado + cantidadActual; 	

		document.getElementById("aculato").value = acumulado;
		document.getElementById("benecant").value = canBene;

		dataIdsActividades.push(idDeActividad);

	}else{

		canBene   =  canBene - cantBeneficiarios;
		acumulado = acumulado - cantidadActual;		

		document.getElementById("benecant").value = canBene;
		document.getElementById("aculato").value = acumulado;

		var index = dataIdsActividades.indexOf(idDeActividad);
		dataIdsActividades.splice(index, 1);
	}
}

function verificarSeleccionados(tamañoDeInputs){
	
	var band = false;
	for (i = 0; i < tamañoDeInputs; i++)
     {
     	var x = document.getElementById("checkActNew"+i).checked;
     	if(x == true){
     		band = true;
     	}
     }
     return band;
}

function insertarActividadesAnuevaActividad(idNuevaActividad, idProyecto){
	
	
	cont = document.getElementById('respuestaNuevaActividad');
	ajax=objetoAjax();
	ajax.open("POST", "catalogo/insertarActividades.php");

	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			//mostrar mensaje de que se insertaron las actividades
			swal("", "Se creo la actividad correctamente.", "success")
			//Cargar la pagina de las nuevas actividades			
			limpiarArreglo(dataIdsActividades);
		}
	}		
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("&idNuevaActividad="+idNuevaActividad+"&dataIdsActividades="+dataIdsActividades); 
}

function crearActividad(idProyecto){

	var tamanodeactividades = document.getElementById("tamanoActi").value;

	var idNuevaActividad = document.getElementById("idNuevaActividad").value;
	if(idNuevaActividad != ""){  swal("", "No se puede capturar.", "error");	}
	else{

		var nombreactividad = document.getElementById("nombreActividad").value;		
		
		if(nombreactividad == ""){ swal("", "Debes ingresar un nombre para la actividad.", "error"); }else{

			var hayseleccionados = verificarSeleccionados(tamanodeactividades);

			if(hayseleccionados == false){ swal("", "No hay actividades seleccionadas.", "error"); }
			else{

				var idBeneficiario = document.getElementById("beneficiarioList").value;
				var idMedida = document.getElementById("medidalist").value;

				if( idBeneficiario == 0 ){ 
					swal("", "No ha seleccionado beneficiario.", "error");
				}else{

					if( idMedida == 0){
						swal("", "No ha seleccionado medida.", "error");
					}else{

						cont = document.getElementById('respuestaNuevaActividad');
						var idProyecto = document.getElementById("proyectoId").value;				
						
						var cantBeneficiarios = document.getElementById("benecant").value;
						var acumulado = document.getElementById("aculato").value;

						ajax=objetoAjax();
						//$('#contenidoActividades').html('<div>s<img src="images/cargando.gif"/></div>');
						ajax.open("POST", "catalogo/crearActividad.php");

						ajax.onreadystatechange = function(){
									if (ajax.readyState == 4 && ajax.status == 200) {
									
									swal("", "Se creo la actividad correctamente.", "success");
									var cadCodificadaJSON = ajax.responseText; 
					      			var objDatos = eval("(" + cadCodificadaJSON + ")"); 

									document.getElementById("idNuevaActividad").value = objDatos.first;
									document.getElementById("botonCrearNuevaAct").disabled = true;

									insertarActividadesAnuevaActividad(objDatos.first, idProyecto);								
									//cargarNuevasActividadesProyecto(idProyecto);
									$('#modalNuevaActividad').modal('hide');
									//cargarContenidoActividadesTabla(idProyecto);
									cargarModalYnuevasActividades(idProyecto);
									limpiarArreglo(dataIdsActividades);
							}
						}		
						ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
						ajax.send("&idProyecto="+idProyecto+"&nombreactividad="+nombreactividad+"&idBeneficiario="+idBeneficiario+"&idMedida="+idMedida+"&cantBeneficiarios="+cantBeneficiarios+"&acumulado="+acumulado); 
					}
				}
			}		

		}	
	}

}

function limpiarModalNuevaActividad(){
	var nom = document.getElementById("nombreactividad").value = "";

	var medida = document.getElementById("medidalist");
	var beneficiario = document.getElementById("beneficiarioList");

	medida.options[0].selected == true;
	beneficiario.options[0].selected == true;

	document.getElementById("benecant").value = "";
	document.getElementById("aculato").value = "";

}

function cargarActividadArea(idArea){

	cont = document.getElementById('contenidoActividades');
	ajax=objetoAjax();
	//$('#contenidoActividades').html('<div>s<img src="images/cargando.gif"/></div>');
	ajax.open("POST", "catalogo/cargarActividadesProyecto.php");

	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText;		
		}
	}		
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("&idArea="+idArea); 

}

function cargarAreasProyecto(idProyecto){

	cont = document.getElementById('contenidoAreas');
	ajax=objetoAjax();
	//$('#contenidoAreas').html('<div>s<img src="images/cargando.gif"/></div>');
	ajax.open("POST", "catalogo/cargarAreasPryecto.php");

	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText;		
		}
	}		
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("&idProyecto="+idProyecto); 

}

function cargarPagina(pagina){

	cont = document.getElementById('contenido');
	ajax=objetoAjax();
	//$('#contenido').html('<div>s<img src="images/cargando.gif"/></div>');
	ajax.open("POST", "catalogo/"+pagina);

	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText;	
		}
	}		
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send(null); 

	$('.modal-backdrop').hide();

}

function editarNuevaActividad(idProyecto){


	idna = document.getElementById('idNuevaActividadUpd').value;
	nombrena = document.getElementById('nomActivity').value;
	medidana = document.getElementById('idMedidaList').value;
	beneficiariona = document.getElementById('idBeneficiarioList').value;
	cantibenena = document.getElementById('cantBenefi').value;
	acumuladona = document.getElementById('acumuladon').value;
	naidproye = document.getElementById('idProyecto').value;

	cont = document.getElementById('respuestaNuevaActividadEditar');

	ajax=objetoAjax();		
	ajax.open("POST", "catalogo/actualizaNuevaActividad.php");

	if( medidana == 0 ){ swal("", "Debes de Seleccionar Medida.", "error");	}else{


		if( beneficiariona == 0 ){ swal("", "Debes de Seleccionar un Beneficiario.", "error"); }else{

			if(idna == "" || cantibenena == "" || acumuladona == ""){ swal("", "No se puede actualizar verifica los datos.", "error"); }
			else{

				if(nombrena == ""){ swal("", "Debes de ingresar un nombre para la actividad.", "error"); }
				else{

					ajax.onreadystatechange=function() {
						        if (ajax.readyState==4) { 
						        		
						        		swal("", "Se actualizo la actividad correctamente.", "success");
										//Insertar nuevas actividades si es que las hubo
										insertarActividadesAnuevaActividad(idna, naidproye);	
										//Cargar la pagina de las nuevas actividades
										cargarNuevasActividadesProyecto(naidproye);
										limpiarArreglo(dataIdsActividades);
										getTotalesActivids(naidproye);
						        	}
						        }

						    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
						    ajax.send("&idna="+idna+"&nombrena="+nombrena+"&medidana="+medidana+"&beneficiariona="+beneficiariona+"&cantibenena="+cantibenena+"&acumuladona="+acumuladona)
				}
			}
		}
	}
}

function actualizarDatos(){

	idSeguimiento = parseInt(document.getElementById('idSeg').value);
	cantidad = parseInt(document.getElementById('cantidadSegUpd').value);
	

	justificacion = document.getElementById('justifiUpd').value;
	propuesta = document.getElementById('propuestaUpd').value;
	cantidadCalendario = document.getElementById('cantisegui').value;
	idAreas = document.getElementById('idAreaupd').value;

	cont = document.getElementById('contenidoRespuesta2');

	ajax=objetoAjax();
	ajax.open("POST", "seguimiento/actualizaSeguimiento.php");

	if(cantidad === ""){ swal("", "Ingresa una cantidad.", "error"); }else{

		if( cantidad == cantidadCalendario ){

			if(justificacion != ""  ||  propuesta !=""){ swal("", "No debe contener justificaciòn y propuesta de mejora.", "error"); }
			else{
					ajax.onreadystatechange=function() {
			        if (ajax.readyState==4) { agregacontenido(idAreas); 
			        	swal("", "Se actualizo correctamente.", "success");
			        }
			    }

			    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			    ajax.send("&idSeguimiento="+idSeguimiento+"&cantidad="+cantidad+"&justificacion="+justificacion+"&propuesta="+propuesta)	
			}
		}
		else{

			if(cantidad > cantidadCalendario){

				if(propuesta != ""){ 
					swal("", "No debe contener propuesta de mejora.", "error"); 
				}else{

					if(justificacion == ""){ swal("", "Debes de ingresar justificaciòn.", "error"); }else{

						ajax.onreadystatechange=function() {
				        if (ajax.readyState==4) { 
				        	agregacontenido(idAreas);
				        	swal("", "Se actualizo correctamente.", "success");
				        	}
				        }

				    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
				    ajax.send("&idSeguimiento="+idSeguimiento+"&cantidad="+cantidad+"&justificacion="+justificacion+"&propuesta="+propuesta)	
					}
				}	

			}else{

				if(cantidad < cantidadCalendario){

					if(justificacion == ""  ||  propuesta == ""){ swal("", "Debes de ingresar justificaciòn y propuesta de mejora.", "error"); }
					else{
						ajax.onreadystatechange=function() {
			        	if (ajax.readyState==4) { agregacontenido(idAreas); 
			        		swal("", "Se actualizo correctamente.", "success");
			        	}
			        }

					    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
					    ajax.send("&idSeguimiento="+idSeguimiento+"&cantidad="+cantidad+"&justificacion="+justificacion+"&propuesta="+propuesta)
					}
				}
			}
		}
	}	
}

function guardarDatos(){

	cont = document.getElementById('contenidoRespuesta');
	 
	 idActividad = document.getElementById('idActividad').value;
	 idAre = document.getElementById('idArea').value;
	 mes = document.getElementById('mes').value;
	 anio = document.getElementById('anio').value;

     cantSegui = parseInt(document.getElementById('cantidadSeg').value);
	 cantCale = parseInt(document.getElementById('cantidad').value);
	 
	 justifi = document.getElementById('justifi').value;
	 propuesta = document.getElementById('propuesta').value;

	 ajax=objetoAjax();
	 ajax.open("POST", "seguimiento/insertarSeguimiento.php");

	 if(cantSegui === ""){ swal("", "Ingresa cantidad.", "error"); }else{

	 		 if(cantSegui == cantCale){	 		    
			    
	 		 	if(justifi != ""  ||  propuesta !=""){ swal("", "No debe contener justificaciòn y propuesta de mejora.", "error"); }
			else{
				    ajax.onreadystatechange=function() {
			        if (ajax.readyState==4) {		        	
			        	agregacontenido(idAre);
			        	swal("", "Se guardo correctamente.", "success");
			         }
				    }
				    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
				    ajax.send("&idActividad="+idActividad+"&idArea="+idAre+"&mes="+mes+"&anio="+anio+"&cantSeg="+cantSegui+"&justifi="+justifi+"&propu="+propuesta)		
				}
	 		}else{
	 			if(cantSegui > cantCale){
	 				
	 				if(propuesta != ""){ 
					swal("", "No debe contener propuesta de mejora.", "error"); 
					}else{	

	 				if(justifi == "" ){ swal("", "Debes de ingresar justificaciòn.", "error"); }
	 				else{
					     ajax.onreadystatechange=function() {
					        if (ajax.readyState==4) { 
					        	agregacontenido(idAre);
					        	swal("", "Se guardo correctamente.", "success");
					        }
					    }
					    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
					    ajax.send("&idActividad="+idActividad+"&idArea="+idAre+"&mes="+mes+"&anio="+anio+"&cantSeg="+cantSegui+"&justifi="+justifi+"&propu="+propuesta)	
	 				}

	 			}

	 			}else{

	 				if(cantSegui < cantCale){

	 					if(justifi == "" || propuesta == ""){ swal("", "Debes de ingresar justificaciòn y propuesta de mejora.", "error"); }
	 					else{
	 						ajax.onreadystatechange=function() {
					        if (ajax.readyState==4) { 
					        	agregacontenido(idAre); 
					        	swal("", "Se guardo correctamente.", "success");
					        }
					    }
					    ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
					    ajax.send("&idActividad="+idActividad+"&idArea="+idAre+"&mes="+mes+"&anio="+anio+"&cantSeg="+cantSegui+"&justifi="+justifi+"&propu="+propuesta)	
	 					}
	 				}
	 			}
	 		}	
    }
}

////////////////////////////////////////

function limpiarModalCapturar(){

	document.getElementById("cantidadSeg").value = "";
	document.getElementById("propuesta").value = "";
	document.getElementById("justifi").value = "";

}
//////////////// FUNCION PARA AGREGAR CONTENIDO INICIAL AL INDEX
function agregacontenido(idArea)
{	
	cont = document.getElementById('contenido');
	ajax=objetoAjax();
	//$('#contenido').html('<div>s<img src="images/cargando.gif"/></div>');
	ajax.open("POST", "seguimiento/administrar.php");
	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText;

			$(document).ready(function() {
				var handleDataTableButtons = function() {
					
				};
			});
			
			$(document).ready(function() {
				
				$(".select2_single").select2({
					placeholder: "Selecciona Unidad",
					allowClear: true
				});
				$('.modal-backdrop').hide();
			});
			
			$(document).ready(function (e) {
			$('#myModal').on('hidden.bs.modal', function () {
	                limpiarModalCapturar();
	                //agregacontenido(idArea);
	            });
			$('#myModalUpdate').on('hidden.bs.modal', function (e) {
	                limpiarModalCapturar();
	                //agregacontenido(idArea);
	            })

				});

			$(document).ready(function (e) {
  
				$('#myModal').on('show.bs.modal', function(e) {
				
					var nameActivity = $(e.relatedTarget).data('nombreactividad'); 
					var idActividad = $(e.relatedTarget).data('activity'); 
					var idArea = $(e.relatedTarget).data('area'); 
					var mes = $(e.relatedTarget).data('mes'); 
					var anio = $(e.relatedTarget).data('anio');
					var cantidad = $(e.relatedTarget).data('cantidad');
					$("#tituloso").text(nameActivity);
					
					$(e.currentTarget).find('input[name="idActividad"]').val(idActividad); 
					$(e.currentTarget).find('input[name="idArea"]').val(idArea); 
					$(e.currentTarget).find('input[name="mes"]').val(anio); 
					$(e.currentTarget).find('input[name="anio"]').val(mes);
					$(e.currentTarget).find('input[name="cantidad"]').val(cantidad);				
				});
			});

			$(document).ready(function (e) {
  
				$('#myModalUpdate').on('show.bs.modal', function(e) {
					
					var nameActivity = $(e.relatedTarget).data('nombreactividad'); 
					var idSeguiment = $(e.relatedTarget).data('seguimiento'); 
					var idActi = $(e.relatedTarget).data('actividad'); 
					var idAr = $(e.relatedTarget).data('area'); 

					var mesin = $(e.relatedTarget).data('mesin'); 
					var anin = $(e.relatedTarget).data('anin');

					var cant = $(e.relatedTarget).data('cant');
					var justi = $(e.relatedTarget).data('justi');
					var propu = $(e.relatedTarget).data('propu');
					var cantisegui = $(e.relatedTarget).data('cantidadseguimiento');

					$("#tituloso2").text(nameActivity);
					$(e.currentTarget).find('input[name="idSeg"]').val(idSeguiment);

					$(e.currentTarget).find('input[name="cantidadSegUpd"]').val(cant);
					$(e.currentTarget).find('input[name="idActividadupd"]').val(idActi);
					$(e.currentTarget).find('input[name="idAreaupd"]').val(idAr);
					$(e.currentTarget).find('input[name="mesupd"]').val(mesin);
					$(e.currentTarget).find('input[name="anioupd"]').val(anin);
					$(e.currentTarget).find('input[name="cantisegui"]').val(cantisegui);

					$("#justifiUpd").text(justi);
					$("#propuestaUpd").text(propu);				
				});	
			});				
		}
	}	
	//como hacemos uso del metodo POST		
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando el codigo del empleado
	ajax.send("&idArea="+idArea); 
}
function agregacontenido2()
{
	
	cont = document.getElementById('contenido');
	ajax=objetoAjax();
	//$('#contenido').html('<div><img src="images/cargando.gif"/></div>');
	ajax.open("POST", "valida/administrar.php");
	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText;
			
			$(document).ready(function() {
				var handleDataTableButtons = function() {
					
				};				
				$('#datatable-responsive').DataTable();			
			});
			
			$(document).ready(function() {				
				$(".select2_single").select2({
					placeholder: "Selecciona Unidad",
					allowClear: true
				});			
			});			
		}
	}	
	//como hacemos uso del metodo POST		
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando el codigo del empleado
	ajax.send(null); 	
	
	
}
////////////// FUNCION PARA AGREGAR LAS UNIDADES A PARTIR DE LA URL SELECCIONADA
function get_area()
{
	
	var seleccion=document.getElementById('ur').value;
	var fiscalia=document.getElementById('fiscalia').value;
	cont = document.getElementById('selectarea');
	ajax=objetoAjax();
		//$('#contenido').html('<div><img src="../images/cargando.gif"/></div>');
	ajax.open("POST", "valida/actualiza_select.php");
	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText;
			
			$(".select2_single").select2({
					placeholder: "Selecciona Unidad",
					allowClear: true
				});
		}
	}	
	//como hacemos uso del metodo POST		
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando el codigo del empleado
	ajax.send('&ur='+seleccion+'&fiscalia='+fiscalia); 	
	
}






























