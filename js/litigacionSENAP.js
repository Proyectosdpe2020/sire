//Muestra modal para ingresar información adicional del NUC solicitado por SENAP
function showModalNucLitInfo(idEstatusNucs, estatus, nuc, idCarpeta){
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
	ajax.send('&idEstatusNucs='+idEstatusNucs+'&estatus='+estatus+'&nuc='+nuc+'&idCarpeta='+idCarpeta);
}

//Muestra modal para ingresar información adicional del NUC solicitado por SENAP
function showModalNucLitInfo2(estatus, nuc, idMp, mes, anio, deten, idUnidad){
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
	ajax.send('&estatus='+estatus+'&nuc='+nuc+'&idMp='+idMp+'&mes='+mes+'&anio='+anio+'&deten='+deten+'&idUnidad='+idUnidad);
}

function showModalNucLitSicaInfo(idResolMP, estatus, nuc){
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
	ajax.send('&idResolMP='+idResolMP+'&estatus='+estatus+'&nuc='+nuc);
}

function closeModalNucsLitigInfo(){
	$('#modalNucsLitigInfo').modal('hide');
	$('#modalNucsLitig').modal('show');
}

/****Ingresa a la bd la fecha de la formulación de la imputación****/
function insertFormImputacion_db(idEstatusNucs, estatus, nuc, opcInsert){
	var fechaFormulacionImpu = document.getElementById("fechaFormulacionImpu").value;

	if(fechaFormulacionImpu != ""){
		$.ajax({
			type: "POST",
		 dataType: "html",
			url:  "format/litigacion/insertSenap/insert_FormImputacion.php",
		 data: 'idEstatusNucs='+idEstatusNucs+'&nuc='+nuc+'&opcInsert='+opcInsert+'&fechaFormulacionImpu='+fechaFormulacionImpu,
		 success: function(respuesta){
		 	var json = respuesta;
		 	var obj = eval("(" + json + ")");
		 	if (obj.first == "NO") { 
		 		swal("", "No se registro verifique los datos.", "warning"); 
		 	}else{
		 		if (obj.first == "SI") {
		 			var obj = eval("(" + json + ")");
		 			swal("", "Registro exitosamente.", "success");
		 			//reloadOpcInsertButton(idEstatusNucs, estatus, nuc,  1);
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

/****Ingresa a la bd la fecha del auto de vinculación a proceso****/
function insertFormAutoVincuProc_db(idResolMP , estatus , nuc , opcInsert){
		var fechaAutoVinculacion = document.getElementById("fechaAutoVinculacion").value;

	if(fechaAutoVinculacion != ""){
		$.ajax({
			type: "POST",
		 dataType: "html",
			url:  "format/litigacion/insertSenap/insert_FormAutoVincuProc.php",
		 data: 'idResolMP='+idResolMP+'&nuc='+nuc+'&opcInsert='+opcInsert+'&fechaAutoVinculacion='+fechaAutoVinculacion,
		 success: function(respuesta){
		 	var json = respuesta;
		 	var obj = eval("(" + json + ")");
		 	if (obj.first == "NO") { 
		 		swal("", "No se registro verifique los datos.", "warning"); 
		 	}else{
		 		if (obj.first == "SI") {
		 			var obj = eval("(" + json + ")");
		 			swal("", "Registro exitosamente.", "success");
		 			//reloadOpcInsertButton(idEstatusNucs, estatus, nuc,  1);
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

/****Ingresa a la bd la informacion de SENAP de medidas cautelares****/
function insertMedCautelar_db(idEstatusNucs, estatus, nuc, opcInsert){
	var fechaCierreInvest = document.getElementById("fechaCierreInvest").value;
	var formulacionAcusacion = document.getElementById("formulacionAcusacion").value;
	var fechaEscritoAcusacion= document.getElementById("fechaEscritoAcusacion").value;

	if(fechaCierreInvest != ""){
		$.ajax({
			type: "POST",
		 dataType: "html",
			url:  "format/litigacion/insertSenap/insert_FormMedCautelar.php",
		 data: 'idEstatusNucs='+idEstatusNucs+'&nuc='+nuc+'&opcInsert='+opcInsert+'&fechaCierreInvest='+fechaCierreInvest+'&formulacionAcusacion='+formulacionAcusacion+'&fechaEscritoAcusacion='+fechaEscritoAcusacion,
		 success: function(respuesta){
		 	var json = respuesta;
		 	var obj = eval("(" + json + ")");
		 	if (obj.first == "NO") { 
		 		swal("", "No se registro verifique los datos.", "warning"); 
		 	}else{
		 		if (obj.first == "SI") {
		 			var obj = eval("(" + json + ")");
		 			swal("", "Registro exitosamente.", "success");
		 			//reloadOpcInsertButton(idEstatusNucs, estatus, nuc,  1);
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

/****Ingresa a la bd la informacion de SENAP de Audiencias Intermedias****/
function insertAudienciaIntermedia_db(idEstatusNucs, estatus, nuc, opcInsert){
	var fechaAudienciaIntermedia = document.getElementById("fechaAudienciaIntermedia").value;
	var mediosDePrueba = document.getElementById("mediosDePrueba").value;
	var tipoMedioPrueba = document.getElementById("tipoMedioPrueba").value;
	var acuerdoProbatorio = document.getElementById("acuerdoProbatorio").value;
	var apertJuiOral = document.getElementById("apertJuiOral").value;

	if(fechaAudienciaIntermedia != "" && mediosDePrueba != 0 ){
		$.ajax({
			type: "POST",
		 dataType: "html",
			url:  "format/litigacion/insertSenap/insert_FormAudienciaIntermedia.php",
		 data: 'idEstatusNucs='+idEstatusNucs+'&nuc='+nuc+'&opcInsert='+opcInsert+'&fechaAudienciaIntermedia='+fechaAudienciaIntermedia+'&mediosDePrueba='+mediosDePrueba+
		       '&tipoMedioPrueba='+tipoMedioPrueba+'&acuerdoProbatorio='+acuerdoProbatorio+'&apertJuiOral='+apertJuiOral,
		 success: function(respuesta){
		 	var json = respuesta;
		 	var obj = eval("(" + json + ")");
		 	if (obj.first == "NO") { 
		 		swal("", "No se registro verifique los datos.", "warning"); 
		 	}else{
		 		if (obj.first == "SI") {
		 			var obj = eval("(" + json + ")");
		 			swal("", "Registro exitosamente.", "success");
		 			//reloadOpcInsertButton(idEstatusNucs, estatus, nuc,  1);
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

/****Ingresa a la bd la informacion de SENAP de sobreseimientos****/
function insertSobreseimientos_db(idEstatusNucs, estatus, nuc, opcInsert){
	var fechaDictoSobresei = document.getElementById("fechaDictoSobresei").value;
	var tipoSobreseimiento = document.getElementById("tipoSobreseimiento").value;

	if(fechaDictoSobresei != "" &&tipoSobreseimiento != 0 ){
		$.ajax({
			type: "POST",
		 dataType: "html",
			url:  "format/litigacion/insertSenap/insert_FormSobreseimientos.php",
		 data: 'idEstatusNucs='+idEstatusNucs+'&nuc='+nuc+'&opcInsert='+opcInsert+'&fechaDictoSobresei='+fechaDictoSobresei+'&tipoSobreseimiento='+tipoSobreseimiento,
		 success: function(respuesta){
		 	var json = respuesta;
		 	var obj = eval("(" + json + ")");
		 	if (obj.first == "NO") { 
		 		swal("", "No se registro verifique los datos.", "warning"); 
		 	}else{
		 		if (obj.first == "SI") {
		 			var obj = eval("(" + json + ")");
		 			swal("", "Registro exitosamente.", "success");
		 			//reloadOpcInsertButton(idEstatusNucs, estatus, nuc,  1);
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

/****Ingresa a la bd la informacion de SENAP de suspencion condicional del proceso****/
function insertSuspCondProc_db(idEstatusNucs, estatus, nuc, opcInsert){
	var fechaDictoSuspConProc = document.getElementById("fechaDictoSuspConProc").value;
	var etapaSuspCondProc = document.getElementById("etapaSuspCondProc").value;
	var CondImpuSuspConProc = document.getElementById("CondImpuSuspConProc").value;
	var reaperturaProc = document.getElementById("reaperturaProc").value;
	var fechaReaperProc = document.getElementById("fechaReaperProc").value;
	var fechaCumpSuspCondPro = document.getElementById("fechaCumpSuspCondPro").value;

	if(fechaDictoSuspConProc != ""  ){
		$.ajax({
			type: "POST",
		 dataType: "html",
			url:  "format/litigacion/insertSenap/insert_FormSuspCondProc.php",
		 data: 'idEstatusNucs='+idEstatusNucs+'&nuc='+nuc+'&opcInsert='+opcInsert+'&fechaDictoSuspConProc='+fechaDictoSuspConProc+'&etapaSuspCondProc='+etapaSuspCondProc+
		 						'&CondImpuSuspConProc='+CondImpuSuspConProc+'&reaperturaProc='+reaperturaProc+'&fechaReaperProc='+fechaReaperProc+'&fechaCumpSuspCondPro='+fechaCumpSuspCondPro,
		 success: function(respuesta){
		 	var json = respuesta;
		 	var obj = eval("(" + json + ")");
		 	if (obj.first == "NO") { 
		 		swal("", "No se registro verifique los datos.", "warning"); 
		 	}else{
		 		if (obj.first == "SI") {
		 			var obj = eval("(" + json + ")");
		 			swal("", "Registro exitosamente.", "success");
		 			//reloadOpcInsertButton(idEstatusNucs, estatus, nuc,  1);
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

/****Ingresa a la bd la informacion de SENAP de Audiencias de Juicio****/
function insertAudienciasJuicio_db(idEstatusNucs, estatus, nuc, opcInsert){
	var fechaAudienciaJuicio = document.getElementById("fechaAudienciaJuicio").value;
	var pruebasAudienciaJuicio = document.getElementById("pruebasAudienciaJuicio").value;

	if(fechaAudienciaJuicio != "" && pruebasAudienciaJuicio != 0  ){
		$.ajax({
			type: "POST",
		 dataType: "html",
			url:  "format/litigacion/insertSenap/insert_FormAudienciaJuicio.php",
		 data: 'idEstatusNucs='+idEstatusNucs+'&nuc='+nuc+'&opcInsert='+opcInsert+'&fechaAudienciaJuicio='+fechaAudienciaJuicio+'&pruebasAudienciaJuicio='+pruebasAudienciaJuicio,
		 success: function(respuesta){
		 	var json = respuesta;
		 	var obj = eval("(" + json + ")");
		 	if (obj.first == "NO") { 
		 		swal("", "No se registro verifique los datos.", "warning"); 
		 	}else{
		 		if (obj.first == "SI") {
		 			var obj = eval("(" + json + ")");
		 			swal("", "Registro exitosamente.", "success");
		 			//reloadOpcInsertButton(idEstatusNucs, estatus, nuc,  1);
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


/****Ingresa a la bd la informacion de SENAP de Acuerdos reparatorios****/
function insertAcuerdoReparatorio_db(idEstatusNucs, estatus, nuc, opcInsert){
	var tipoAcuerdosRep = document.getElementById("tipoAcuerdosRep").value;

	if(tipoAcuerdosRep != 0  ){
		$.ajax({
			type: "POST",
		 dataType: "html",
			url:  "format/litigacion/insertSenap/insert_FormAcuerdosReparatorios.php",
		 data: 'idEstatusNucs='+idEstatusNucs+'&nuc='+nuc+'&opcInsert='+opcInsert+'&tipoAcuerdosRep='+tipoAcuerdosRep,
		 success: function(respuesta){
		 	var json = respuesta;
		 	var obj = eval("(" + json + ")");
		 	if (obj.first == "NO") { 
		 		swal("", "No se registro verifique los datos.", "warning"); 
		 	}else{
		 		if (obj.first == "SI") {
		 			var obj = eval("(" + json + ")");
		 			swal("", "Registro exitosamente.", "success");
		 			//reloadOpcInsertButton(idEstatusNucs, estatus, nuc,  1);
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

/****Ingresa a la bd la informacion de SENAP de Criterios de Oportunidad****/
function insertCriteriosOportunidad_db(idEstatusNucs, estatus, nuc, opcInsert){
	var tipoCriterioOportunidad = document.getElementById("tipoCriterioOportunidad").value;

	if(tipoCriterioOportunidad != 0  ){
		$.ajax({
			type: "POST",
		 dataType: "html",
			url:  "format/litigacion/insertSenap/insert_FormCriterioOportunidad.php",
		 data: 'idEstatusNucs='+idEstatusNucs+'&nuc='+nuc+'&opcInsert='+opcInsert+'&tipoCriterioOportunidad='+tipoCriterioOportunidad,
		 success: function(respuesta){
		 	var json = respuesta;
		 	var obj = eval("(" + json + ")");
		 	if (obj.first == "NO") { 
		 		swal("", "No se registro verifique los datos.", "warning"); 
		 	}else{
		 		if (obj.first == "SI") {
		 			var obj = eval("(" + json + ")");
		 			swal("", "Registro exitosamente.", "success");
		 			//reloadOpcInsertButton(idEstatusNucs, estatus, nuc,  1);
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

/****Ingresa a la bd la informacion de SENAP de Criterios de Oportunidad****/
function insertSentencias_db(idEstatusNucs, estatus, nuc, opcInsert){
	var fechaDictoSentencia = document.getElementById("fechaDictoSentencia").value;
	var tipoSentencia = document.getElementById("tipoSentencia").value;
	var aniosPrision = document.getElementById("aniosPrision").value;
	var sentenciaFirme = document.getElementById("sentenciaFirme").value;
	var sentDerivaProcAbrv = document.getElementById("sentDerivaProcAbrv").value;
	var fechaDictoProcAbrv = document.getElementById("fechaDictoProcAbrv").value;

	if(fechaDictoSentencia != "" && tipoSentencia > 0){
		$.ajax({
			type: "POST",
		 dataType: "html",
			url:  "format/litigacion/insertSenap/insert_FormSentencias.php",
		 data: 'idEstatusNucs='+idEstatusNucs+'&nuc='+nuc+'&opcInsert='+opcInsert+'&estatus='+estatus+'&fechaDictoSentencia='+fechaDictoSentencia+'&tipoSentencia='+tipoSentencia+
		       '&aniosPrision='+aniosPrision+'&sentenciaFirme='+sentenciaFirme+'&sentDerivaProcAbrv='+sentDerivaProcAbrv+'&fechaDictoProcAbrv='+fechaDictoProcAbrv,
		 success: function(respuesta){
		 	var json = respuesta;
		 	var obj = eval("(" + json + ")");
		 	if (obj.first == "NO") { 
		 		swal("", "No se registro verifique los datos.", "warning"); 
		 	}else{
		 		if (obj.first == "SI") {
		 			var obj = eval("(" + json + ")");
		 			swal("", "Registro exitosamente.", "success");
		 			//reloadOpcInsertButton(idEstatusNucs, estatus, nuc,  1);
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


/****Ingresa a la bd la informacion de SENAP de Criterios de Oportunidad****/
function insertReparacionDanios_db(idEstatusNucs, estatus, nuc, opcInsert){
	var montoRepDanio = document.getElementById("montoRepDanio").value;

	if(montoRepDanio != ""){
		$.ajax({
			type: "POST",
		 dataType: "html",
			url:  "format/litigacion/insertSenap/insert_FormRepDanios.php",
		 data: 'idEstatusNucs='+idEstatusNucs+'&nuc='+nuc+'&opcInsert='+opcInsert+'&montoRepDanio='+montoRepDanio,
		 success: function(respuesta){
		 	var json = respuesta;
		 	var obj = eval("(" + json + ")");
		 	if (obj.first == "NO") { 
		 		swal("", "No se registro verifique los datos.", "warning"); 
		 	}else{
		 		if (obj.first == "SI") {
		 			var obj = eval("(" + json + ")");
		 			swal("", "Registro exitosamente.", "success");
		 			//reloadOpcInsertButton(idEstatusNucs, estatus, nuc,  1);
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

/****Ingresa a la bd el delito por el cual se judicializo****/
function insertFormJudicializada_db(idEstatusNucs, estatus, nuc, opcInsert){
	if( $('.checkRecla').prop('checked') ) {
   var reclasificacion = 1;
   var newBrwosers_id = $("#newBrwoser").val();
			var idCatModalidadEst = $("#newBrwosers").find("option[value='" + newBrwosers_id + "']").attr('data-id');

}else{
	  var reclasificacion = 0;
	  $("input[type=radio]:checked").each(function(){ idCatModalidadEst = $(this).val() });
}
	if(typeof idCatModalidadEst !== 'undefined'){
		$.ajax({
			type: "POST",
		 dataType: "html",
			url:  "format/litigacion/insertSenap/insert_FormJudicializada.php",
		 data: 'idEstatusNucs='+idEstatusNucs+'&nuc='+nuc+'&opcInsert='+opcInsert+'&idCatModalidadEst='+idCatModalidadEst+'&reclasificacion='+reclasificacion,
		 success: function(respuesta){
		 	var json = respuesta;
		 	var obj = eval("(" + json + ")");
		 	if (obj.first == "NO") { 
		 		swal("", "No se registro verifique los datos.", "warning"); 
		 	}else{
		 		if (obj.first == "SI") {
		 			var obj = eval("(" + json + ")");
		 			swal("", "Registro exitosamente.", "success");
		 			//reloadOpcInsertButton(idEstatusNucs, estatus, nuc,  1);
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



function reclasificar(){
	var tableReclasificar = document.getElementById("tableReclasificar");
	$("input[name=checkDelito]").prop("disabled", true);
	if (tableReclasificar.style.display === "block") {
		tableReclasificar.style.display = "none";
			$("input[name=checkDelito]").prop("disabled", false);
	} else {
		tableReclasificar.style.display = "block";
		$("input:radio[name=checkDelito]:checked")[0].checked = false;
	}
}

function getDataDelitoSicap(){
	cont = document.getElementById('newBrwosers');
	ajax=objetoAjax();
	ajax.open("POST", "format/litigacion/insertSenap/getDelitosdataList.php");
	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send();
}

function sendDataJudicializada(nuc, estatus, idMp, mes, anio, deten, idUnidad, opcInsert){
	if( $('.checkRecla').prop('checked') ) {
   var reclasificacion = 1;
   var newBrwosers_id = $("#newBrwoser").val();
			var idCatModalidadEst = $("#newBrwosers").find("option[value='" + newBrwosers_id + "']").attr('data-id');

}else{
	  var reclasificacion = 0;
	  $("input[type=radio]:checked").each(function(){ idCatModalidadEst = $(this).val() });
}
	if(typeof idCatModalidadEst !== 'undefined'){
	 insertarNucLit(idMp,estatus,mes,anio,nuc,deten,idUnidad, opcInsert);
	 $('#modalNucsLitigInfo').modal('hide');
			$('#modalNucsLitig').modal('show');
	}else{
		swal("", "Faltan datos por registrar.", "warning");
	}
}

function sendDataFormImputacion(nuc, estatus, idMp, mes, anio, deten, idUnidad, opcInsert){
	var fechaFormulacionImpu = document.getElementById("fechaFormulacionImpu").value;

	if(fechaFormulacionImpu != ""){
		 insertarNucLit(idMp,estatus,mes,anio,nuc,deten,idUnidad, opcInsert);
	  $('#modalNucsLitigInfo').modal('hide');
			$('#modalNucsLitig').modal('show');
	}else{
		swal("", "Faltan datos por registrar.", "warning");
	}
}

function sendDataAutoVincuProc(nuc, estatus, idMp, mes, anio, deten, idUnidad, opcInsert){
		var fechaAutoVinculacion = document.getElementById("fechaAutoVinculacion").value;

	if(fechaAutoVinculacion != ""){
		insertarNucLit2(idMp,estatus,mes,anio,nuc,deten,idUnidad, opcInsert);
	  $('#modalNucsLitigInfo').modal('hide');
			$('#modalNucsLitig').modal('show');
	}else{
		swal("", "Faltan datos por registrar.", "warning");
	}
}

function sendDataMedCautelar(nuc, estatus, idMp, mes, anio, deten, idUnidad, opcInsert){
	var fechaCierreInvest = document.getElementById("fechaCierreInvest").value;
	var formulacionAcusacion = document.getElementById("formulacionAcusacion").value;
	var fechaEscritoAcusacion= document.getElementById("fechaEscritoAcusacion").value;

	if(fechaCierreInvest != ""){
		insertarNucLit(idMp,estatus,mes,anio,nuc,deten,idUnidad, opcInsert);
	  $('#modalNucsLitigInfo').modal('hide');
			$('#modalNucsLitig').modal('show');
	}else{
		swal("", "Faltan datos por registrar.", "warning");
	}
}

function sendDataAudienciaIntermedia(nuc, estatus, idMp, mes, anio, deten, idUnidad, opcInsert){
	var fechaAudienciaIntermedia = document.getElementById("fechaAudienciaIntermedia").value;
	var mediosDePrueba = document.getElementById("mediosDePrueba").value;
	var tipoMedioPrueba = document.getElementById("tipoMedioPrueba").value;
	var acuerdoProbatorio = document.getElementById("acuerdoProbatorio").value;
	var apertJuiOral = document.getElementById("apertJuiOral").value;

	if(fechaAudienciaIntermedia != "" && mediosDePrueba != 0 ){
		insertarNucLit(idMp,estatus,mes,anio,nuc,deten,idUnidad, opcInsert);
	  $('#modalNucsLitigInfo').modal('hide');
			$('#modalNucsLitig').modal('show');
	}else{
		swal("", "Faltan datos por registrar.", "warning");
	}
}

function sendDataSobreseimientos(nuc, estatus, idMp, mes, anio, deten, idUnidad, opcInsert){
	var fechaDictoSobresei = document.getElementById("fechaDictoSobresei").value;
	var tipoSobreseimiento = document.getElementById("tipoSobreseimiento").value;

	if(fechaDictoSobresei != "" &&tipoSobreseimiento != 0 ){
			insertarNucLit(idMp,estatus,mes,anio,nuc,deten,idUnidad, opcInsert);
	  $('#modalNucsLitigInfo').modal('hide');
			$('#modalNucsLitig').modal('show');
	}else{
		swal("", "Faltan datos por registrar.", "warning");
	}
}

function sendDataSuspCondProc(nuc, estatus, idMp, mes, anio, deten, idUnidad, opcInsert){
	var fechaDictoSuspConProc = document.getElementById("fechaDictoSuspConProc").value;
	var etapaSuspCondProc = document.getElementById("etapaSuspCondProc").value;
	var CondImpuSuspConProc = document.getElementById("CondImpuSuspConProc").value;
	var reaperturaProc = document.getElementById("reaperturaProc").value;
	var fechaReaperProc = document.getElementById("fechaReaperProc").value;
	var fechaCumpSuspCondPro = document.getElementById("fechaCumpSuspCondPro").value;

	if(fechaDictoSuspConProc != ""  ){
		 insertarNucLit(idMp,estatus,mes,anio,nuc,deten,idUnidad, opcInsert);
	  $('#modalNucsLitigInfo').modal('hide');
			$('#modalNucsLitig').modal('show');
	}else{
		swal("", "Faltan datos por registrar.", "warning");
	}
}

function sendDataAudienciasJuicio(nuc, estatus, idMp, mes, anio, deten, idUnidad, opcInsert){
	var fechaAudienciaJuicio = document.getElementById("fechaAudienciaJuicio").value;
	var pruebasAudienciaJuicio = document.getElementById("pruebasAudienciaJuicio").value;

	if(fechaAudienciaJuicio != "" && pruebasAudienciaJuicio != 0  ){
		 insertarNucLit(idMp,estatus,mes,anio,nuc,deten,idUnidad, opcInsert);
	  $('#modalNucsLitigInfo').modal('hide');
			$('#modalNucsLitig').modal('show');
	}else{
		swal("", "Faltan datos por registrar.", "warning");
	}
}

function sendDataCriteriosOportunidad(nuc, estatus, idMp, mes, anio, deten, idUnidad, opcInsert){
	var tipoCriterioOportunidad = document.getElementById("tipoCriterioOportunidad").value;

	if(tipoCriterioOportunidad != 0  ){
	insertarNucLit(idMp,estatus,mes,anio,nuc,deten,idUnidad, opcInsert);
	  $('#modalNucsLitigInfo').modal('hide');
			$('#modalNucsLitig').modal('show');
	}else{
		swal("", "Faltan datos por registrar.", "warning");
	}
}

function sendDataAcuerdoReparatorio(nuc, estatus, idMp, mes, anio, deten, idUnidad, opcInsert){
	var tipoAcuerdosRep = document.getElementById("tipoAcuerdosRep").value;

	if(tipoAcuerdosRep != 0  ){
		insertarNucLit(idMp,estatus,mes,anio,nuc,deten,idUnidad, opcInsert);
	  $('#modalNucsLitigInfo').modal('hide');
			$('#modalNucsLitig').modal('show');
	}else{
		swal("", "Faltan datos por registrar.", "warning");
	}
}

function sendDataSentencias(nuc, estatus, idMp, mes, anio, deten, idUnidad, opcInsert){
	var fechaDictoSentencia = document.getElementById("fechaDictoSentencia").value;
	var tipoSentencia = document.getElementById("tipoSentencia").value;
	var aniosPrision = document.getElementById("aniosPrision").value;
	var sentenciaFirme = document.getElementById("sentenciaFirme").value;
	var sentDerivaProcAbrv = document.getElementById("sentDerivaProcAbrv").value;
	var fechaDictoProcAbrv = document.getElementById("fechaDictoProcAbrv").value;

	if(fechaDictoSentencia != "" && tipoSentencia > 0){
		if(estatus == 14){
   insertarNucLit2(idMp,estatus,mes,anio,nuc,deten,idUnidad, opcInsert);
    $('#modalNucsLitigInfo').modal('hide');
			 $('#modalNucsLitig').modal('show');
		}else{
			insertarNucLit(idMp,estatus,mes,anio,nuc,deten,idUnidad, opcInsert);
	  $('#modalNucsLitigInfo').modal('hide');
			$('#modalNucsLitig').modal('show');
		}
	}else{
		swal("", "Faltan datos por registrar.", "warning");
	}
}

function sendDataReparacionDanios(nuc, estatus, idMp, mes, anio, deten, idUnidad, opcInsert){
	var montoRepDanio = document.getElementById("montoRepDanio").value;

	if(montoRepDanio != ""){
		insertarNucLit(idMp,estatus,mes,anio,nuc,deten,idUnidad, opcInsert);
	  $('#modalNucsLitigInfo').modal('hide');
			$('#modalNucsLitig').modal('show');
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