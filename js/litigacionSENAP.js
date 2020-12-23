function showModalNucLitInfo(idEstatusNucs, idMp, anio, mes, estatus, nuc, idUnidad){
	ajax=objetoAjax();
	ajax.open("POST", "format/litigacion/modalNucsInfoLitig.php");

	cont = document.getElementById('contmodalnucsLitigInfo');
	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText; 
		 $('#modalNucsLitigInfo').modal('show');
		 $('#modalNucsLitig').modal('hide'); 
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send('&idEstatusNucs='+idEstatusNucs+'&idMp='+idMp+'&anio='+anio+'&mes='+mes+'&estatus='+estatus+'&nuc='+nuc+'&idUnidad='+idUnidad);
}

function showModalNucLitSicaInfo(idResolMP, idMp, anio, mes, estatus, nuc, idUnidad){
	ajax=objetoAjax();
	ajax.open("POST", "format/litigacion/modalNucsInfoLitig.php");

	cont = document.getElementById('contmodalnucsLitigInfo');
	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText; 
		 $('#modalNucsLitigInfo').modal('show');
		 $('#modalNucsLitig').modal('hide'); 
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send('&idResolMP='+idResolMP+'&idMp='+idMp+'&anio='+anio+'&mes='+mes+'&estatus='+estatus+'&nuc='+nuc+'&idUnidad='+idUnidad);
}

function closeModalNucsLitigInfo(){
	$('#modalNucsLitigInfo').modal('hide');
	$('#modalNucsLitig').modal('show');
}


function insertFormImputacion_db(idEstatusNucs, idMp, anio, mes, estatus, nuc, idUnidad){
	var formImputacion = document.getElementById("formImputacion").value;
	var fechaFormulacionImpu = document.getElementById("fechaFormulacionImpu").value;

	if(fechaFormulacionImpu != ""){
		$.ajax({
			type: "POST",
		 dataType: "html",
			url:  "format/litigacion/insertSenap/insert_FormImputacion.php",
		 data: "idEstatusNucs="+idEstatusNucs+"&idMp="+idMp+"&anio="+anio+"&mes="+mes+"&estatus="+estatus+"&nuc="+nuc+"&idUnidad="+idUnidad+"&formImputacion="+formImputacion+"&fechaFormulacionImpu="+fechaFormulacionImpu,
		 success: function(respuesta){
		 	var json = respuesta;
		 	var obj = eval("(" + json + ")");
		 	if (obj.first == "NO") { 
		 		swal("", "No se registro verifique los datos.", "warning"); 
		 	}else{
		 		if (obj.first == "SI") {
		 			var obj = eval("(" + json + ")");
		 			swal("", "Registro exitosamente.", "success");
		 			$('#modalNucsLitigInfo').modal('hide');
		 			$('#modalNucsLitig').modal('show');
		 		}
		 	}
		 }
		});
	}else{
		swal("", "Faltan datos por registrar.", "warning");
	}
}


function insertFormResoAutoVinc_db(idResolMP, idMp, anio, mes, estatus, nuc, idUnidad){
	var resolAutoVincu = document.getElementById("resolAutoVincu").value;
	var fechaAutoVinculacion = document.getElementById("fechaAutoVinculacion").value;

	if(fechaAutoVinculacion != ""){
		$.ajax({
			type: "POST",
		 dataType: "html",
			url:  "format/litigacion/insertSenap/insertFormResoAutoVinc.php",
		 data: "idResolMP="+idResolMP+"&idMp="+idMp+"&anio="+anio+"&mes="+mes+"&estatus="+estatus+"&nuc="+nuc+"&idUnidad="+idUnidad+"&resolAutoVincu="+resolAutoVincu+"&fechaAutoVinculacion="+fechaAutoVinculacion,
		 success: function(respuesta){
		 	var json = respuesta;
		 	var obj = eval("(" + json + ")");
		 	if (obj.first == "NO") { 
		 		swal("", "No se registro verifique los datos.", "warning"); 
		 	}else{
		 		if (obj.first == "SI") {
		 			var obj = eval("(" + json + ")");
		 			swal("", "Registro exitosamente.", "success");
		 			$('#modalNucsLitigInfo').modal('hide');
		 			$('#modalNucsLitig').modal('show');
		 		}
		 	}
		 }
		});
	}else{
		swal("", "Faltan datos por registrar.", "warning");
	}
}


/*
//Mecanismo para cambiar de formulario a otro
function openForm(evt, etapa) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontentLi");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(etapa).style.display = "block";
  evt.currentTarget.className += " active";
}

//Función para validar si hubo audiencia inicial, En caso de ser falso, habilitar los input de las variables con ID 6.2.4 y 6.2.5
function validateAudienciaIni(){
	var audInicial = document.getElementById("audInicial").value;

	//Se evalua el valor dictonomico, en caso de recibir 2 correspondiente al valor asignado en la tabla CatOpcDicto ->'NO' habilitar los input
	switch (audInicial){
		case '0':
			$('#fechaAudIni').prop('disabled', true).val('0'); //Desactiva Input
			$('#MotivoNoAudienciaIni').prop('disabled', true).val('0'); //Desactiva Input
			break;
		case '1':
			$('#fechaAudIni').prop('disabled', false); //Activa input
			$('#MotivoNoAudienciaIni').prop('disabled', true).val('0'); //Desactiva Input
			break;
		case '2':
			$('#MotivoNoAudienciaIni').prop('disabled', false); //Activa input
			$('#fechaAudIni').prop('disabled', true).val(''); //Desactiva Input
			break;
		case '3':
			$('#MotivoNoAudienciaIni').prop('disabled', true).val('0'); //Desactiva Input
			$('#fechaAudIni').prop('disabled', true).val(''); //Desactiva Input
			break;
	}

}

//Función para validar si hubo Formulacion de la imputacion, En caso de ser falso, habilitar los input de las variables con ID 6.2.7
function validateFormulacionImpu(){
	var formImputacion = document.getElementById("formImputacion").value;

	//Se evalua el valor dictonomico, en caso de recibir 2 correspondiente al valor asignado en la tabla CatOpcDicto ->'NO' habilitar los input
	switch (formImputacion){
		case '0':
			$('#fechaFormulacionImpu').prop('disabled', true).val('0'); //Desactiva Input
			break;
		case '1':
			$('#fechaFormulacionImpu').prop('disabled', false); //Activa input
			break;
		case '2':
			$('#fechaFormulacionImpu').prop('disabled', true).val(''); //Desactiva Input
			break;
		case '3':
			$('#fechaFormulacionImpu').prop('disabled', true).val(''); //Desactiva Input
			break;
	}
}

//Función para validar si hubo Resolución del auto de vinculación a proceso, En caso de ser falso, habilitar los input de las variables con ID 6.2.9
function validateResolAutoVincu(){
	var resolAutoVincu = document.getElementById("resolAutoVincu").value;

	//Se evalua el valor dictonomico, en caso de recibir 2 correspondiente al valor asignado en la tabla CatOpcDicto ->'NO' habilitar los input
	switch (resolAutoVincu){
		case '0':
			$('#fechaAutoVinculacion').prop('disabled', true).val('0'); //Desactiva Input
			break;
		case '1':
			$('#fechaAutoVinculacion').prop('disabled', false); //Activa input
			break;
		case '2':
			$('#fechaAutoVinculacion').prop('disabled', true).val(''); //Desactiva Input
			break;
		case '3':
			$('#fechaAutoVinculacion').prop('disabled', true).val(''); //Desactiva Input
			break;
	}
}

//Función para validar si hubo medica cautelar, En caso de ser falso, habilitar los input de las variables con ID 6.2.11
function validateMedidaCautelar(){
	var MedCautelar = document.getElementById("MedCautelar").value;

	//Se evalua el valor dictonomico, en caso de recibir 2 correspondiente al valor asignado en la tabla CatOpcDicto ->'NO' habilitar los input
	switch (MedCautelar){
		case '0':
			$('#tipoMedCautelar').prop('disabled', true).val('0'); //Desactiva Input
			break;
		case '1':
			$('#tipoMedCautelar').prop('disabled', false); //Activa input
			break;
		case '2':
			$('#tipoMedCautelar').prop('disabled', true).val('0'); //Desactiva Input
			break;
		case '3':
			$('#tipoMedCautelar').prop('disabled', true).val('0'); //Desactiva Input
			break;
	}
}

//Función para validar si hubo medica cautelar, En caso de ser falso, habilitar los input de las variables con ID 6.3.1
function validateFormuAcusa(){
	var formulacionAcusacion = document.getElementById("formulacionAcusacion").value;

	//Se evalua el valor dictonomico, en caso de recibir 2 correspondiente al valor asignado en la tabla CatOpcDicto ->'NO' habilitar los input
	switch (formulacionAcusacion){
		case '0':
			$('#fechaEscritoAcusacion').prop('disabled', true).val('0'); //Desactiva Input
			break;
		case '1':
			$('#fechaEscritoAcusacion').prop('disabled', false); //Activa input
			break;
		case '2':
			$('#fechaEscritoAcusacion').prop('disabled', true).val('0'); //Desactiva Input
			break;
		case '3':
			$('#fechaEscritoAcusacion').prop('disabled', true).val('0'); //Desactiva Input
			break;
	}
}

//Función para validar si hubo Audiencia Intermedia, En caso de ser falso, habilitar los input de las variables con ID 6.3.3
function validateAudIntermedia(){
	var audienciaIntermedia = document.getElementById("audienciaIntermedia").value;

	//Se evalua el valor dictonomico, en caso de recibir 2 correspondiente al valor asignado en la tabla CatOpcDicto ->'NO' habilitar los input
	switch (audienciaIntermedia){
		case '0':
			$('#fechaAudienciaIntermedia').prop('disabled', true).val('0'); //Desactiva Input
			$('#mediosDePrueba').prop('disabled', true).val('0'); //Desactiva Input
			$('#tipoMedioPrueba').prop('disabled', true).val('0'); //Desactiva Input
			break;
		case '1':
			$('#fechaAudienciaIntermedia').prop('disabled', false); //Activa input
			$('#mediosDePrueba').prop('disabled', false); //Activa input
			break;
		case '2':
			$('#fechaAudienciaIntermedia').prop('disabled', true).val('0'); //Desactiva Input
			$('#mediosDePrueba').prop('disabled', true).val('0'); //Desactiva Input
			$('#tipoMedioPrueba').prop('disabled', true).val('0'); //Desactiva Input
			break;
		case '3':
			$('#fechaAudienciaIntermedia').prop('disabled', true).val('0'); //Desactiva Input
			$('#mediosDePrueba').prop('disabled', true).val('0'); //Desactiva Input
			$('#tipoMedioPrueba').prop('disabled', true).val('0'); //Desactiva Input
			break;
	}
}

//Función para validar si hubo Audiencia Intermedia, En caso de ser falso, habilitar los input de las variables con ID 6.3.3
function validateMediosPruebaSI(){
	var mediosDePrueba = document.getElementById("mediosDePrueba").value;

	//Se evalua el valor dictonomico, en caso de recibir 2 correspondiente al valor asignado en la tabla CatOpcDicto ->'NO' habilitar los input
	switch (mediosDePrueba){
		case '0':
			$('#tipoMedioPrueba').prop('disabled', true).val('0'); //Desactiva Input
			break;
		case '1':
			$('#tipoMedioPrueba').prop('disabled', false); //Activa input
			break;
		case '2':
			$('#tipoMedioPrueba').prop('disabled', true).val('0'); //Desactiva Input
			break;
		case '3':
			$('#tipoMedioPrueba').prop('disabled', true).val('0'); //Desactiva Input
			break;
	}
}

//Función para validar si el asunto fue derivado a MASC, En caso de ser falso, habilitar los input de las variables
function validateMASC(){
	var derivadoMASC = document.getElementById("derivadoMASC").value;

	//Se evalua el valor dictonomico, en caso de recibir 2 correspondiente al valor asignado en la tabla CatOpcDicto ->'NO' habilitar los input
	switch (derivadoMASC){
		case '0':
			$('#autoridadMASC').prop('disabled', true).val('0'); //Desactiva Input
			$('#fechaDerivaMASC').prop('disabled', true).val('0'); //Desactiva Input
			$('#tipoMASC').prop('disabled', true).val('0'); //Desactiva Input
			$('#tipoCumplimiento').prop('disabled', true).val('0'); //Desactiva Input
			$('#fechaCumplimentoMASC').prop('disabled', true).val('0'); //Desactiva Input
			$('#montoRepDanio').prop('disabled', true).val(0); //Desactiva Input
			break;
		case '1':
			$('#autoridadMASC').prop('disabled', false); //Activa Input
			$('#fechaDerivaMASC').prop('disabled', false); //Activa Input
			$('#tipoMASC').prop('disabled', false); //Activa Input
			$('#tipoCumplimiento').prop('disabled', false); //Activa Input
			$('#fechaCumplimentoMASC').prop('disabled', false); //Activa Input
			$('#montoRepDanio').prop('disabled', false); //Activa Input
			break;
		case '2':
			$('#autoridadMASC').prop('disabled', true).val('0'); //Desactiva Input
			$('#fechaDerivaMASC').prop('disabled', true).val('0'); //Desactiva Input
			$('#tipoMASC').prop('disabled', true).val('0'); //Desactiva Input
			$('#tipoCumplimiento').prop('disabled', true).val('0'); //Desactiva Input
			$('#fechaCumplimentoMASC').prop('disabled', true).val('0'); //Desactiva Input
			$('#montoRepDanio').prop('disabled', true).val(0); //Desactiva Input
			break;
		case '3':
			$('#autoridadMASC').prop('disabled', true).val('0'); //Desactiva Input
			$('#fechaDerivaMASC').prop('disabled', true).val('0'); //Desactiva Input
			$('#tipoMASC').prop('disabled', true).val('0'); //Desactiva Input
			$('#tipoCumplimiento').prop('disabled', true).val('0'); //Desactiva Input
			$('#fechaCumplimentoMASC').prop('disabled', true).val('0'); //Desactiva Input
			$('#montoRepDanio').prop('disabled', true).val(0); //Desactiva Input
			break;
	}
}

//Función para validar si hubo Audiencia Intermedia, En caso de ser falso, habilitar los input de las variables con ID 6.5.1
function validateSobreseimiento(){
	var etapaSobreseimineto = document.getElementById("etapaSobreseimineto").value;

	if(etapaSobreseimineto != 0){
		$('#tipoMedioPrueba').prop('disabled', false); //Activa input
		$('#causaSobreseimiento').prop('disabled', false); //Activa input
		$('#fechaDictoSobresei').prop('disabled', false); //Activa input
		$('#tipoSobreseimiento').prop('disabled', false); //Activa input
	}else{
		$('#tipoMedioPrueba').prop('disabled', true).val('0'); //Desactiva input
		$('#causaSobreseimiento').prop('disabled', true).val('0'); //Desactiva input
		$('#fechaDictoSobresei').prop('disabled', true).val('0'); //Desactiva input
		$('#tipoSobreseimiento').prop('disabled', true).val('0'); //Desactiva input
	}
}
*/