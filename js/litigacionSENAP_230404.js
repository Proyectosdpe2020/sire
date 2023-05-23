//Muestra modal para ingresar información adicional del NUC solicitado por SENAP
function showModalNucLitInfo(idEstatusNucs, estatus, nuc, idCarpeta, idMp, mes, anio, tipo_investigacion) {

	if (estatus != 50 && estatus != 53 && estatus != 58 && estatus != 153) {
		ajax = objetoAjax();
		ajax.open("POST", "format/litigacion/modalNucsInfoLitig.php");

		cont = document.getElementById('contmodalnucsLitigInfo');
		ajax.onreadystatechange = function () {
			if (ajax.readyState == 4 && ajax.status == 200) {
				cont.innerHTML = ajax.responseText;
				$('#modalNucsLitigInfo').modal('show');
				$('#modalNucsLitig').modal('hide');
			}
		}
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send('&idEstatusNucs=' + idEstatusNucs + '&estatus=' + estatus + '&nuc=' + nuc + '&idCarpeta=' + idCarpeta + '&idMp=' + idMp + '&mes=' + mes + '&anio=' + anio + '&tipo_investigacion=' + tipo_investigacion);
	} else {
		ajax = objetoAjax();
		ajax.open("POST", "format/litigacion/modal_Imputados.php");

		cont = document.getElementById('contmodal_imputados');
		ajax.onreadystatechange = function () {
			if (ajax.readyState == 4 && ajax.status == 200) {
				cont.innerHTML = ajax.responseText;
				$('#modalNucs_imputados').modal('show');
				$('#modalNucsLitig').modal('hide');
			}
		}
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send('&idEstatusNucs=' + idEstatusNucs + '&estatus=' + estatus + '&nuc=' + nuc + '&idCarpeta=' + idCarpeta + '&idMp=' + idMp + '&mes=' + mes + '&anio=' + anio);
	}

}

//Muestra modal para ingresar información adicional del NUC solicitado por SENAP
function showModalNucLitInfo2(estatus, nuc, idMp, mes, anio, deten, idUnidad, tipo_investigacion, idImputado) {

	ajax = objetoAjax();
	ajax.open("POST", "format/litigacion/modalNucsInfoLitig.php");

	cont = document.getElementById('contmodalnucsLitigInfo');
	ajax.onreadystatechange = function () {
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText;
			$('#modalNucsLitigInfo').modal('show');
			$('#modalNucsLitig').modal('hide');
		}
	}
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); idImputado
	ajax.send('&estatus=' + estatus + '&nuc=' + nuc + '&idMp=' + idMp + '&mes=' + mes + '&anio=' + anio + '&deten=' + deten + '&idUnidad=' + idUnidad + '&tipo_investigacion=' + tipo_investigacion + '&idImputado=' + idImputado);
}

function showModalNucLitSicaInfo(idResolMP, estatus, nuc) {
	ajax = objetoAjax();
	ajax.open("POST", "format/litigacion/modalNucsInfoLitig.php");

	cont = document.getElementById('contmodalnucsLitigInfo');
	ajax.onreadystatechange = function () {
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText;
			$('#modalNucsLitigInfo').modal('show');
			$('#modalNucsLitig').modal('hide');
		}
	}
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send('&idResolMP=' + idResolMP + '&estatus=' + estatus + '&nuc=' + nuc);
}

function closeModalNucsLitigInfo() {
	$('#modalNucsLitigInfo').modal('hide');
	$('#modalNucsLitig').modal('show');
}

/****Ingresa a la bd la fecha de la formulación de la imputación****/
function insertFormImputacion_db(idEstatusNucs, estatus, nuc, opcInsert) {
	var fechaFormulacionImpu = document.getElementById("fechaFormulacionImpu").value;

	if (fechaFormulacionImpu != "") {
		$.ajax({
			type: "POST",
			dataType: "html",
			url: "format/litigacion/insertSenap/insert_FormImputacion.php",
			data: 'idEstatusNucs=' + idEstatusNucs + '&nuc=' + nuc + '&opcInsert=' + opcInsert + '&fechaFormulacionImpu=' + fechaFormulacionImpu,
			success: function (respuesta) {
				var json = respuesta;
				var obj = eval("(" + json + ")");
				if (obj.first == "NO") {
					swal("", "No se registro verifique los datos.", "warning");
				} else {
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
	} else {
		swal("", "Faltan datos por registrar.", "warning");
	}
}

/****Ingresa a la bd la fecha del auto de vinculación a proceso****/
function insertFormAutoVincuProc_db(idResolMP, estatus, nuc, opcInsert) {
	var fechaAutoVinculacion = document.getElementById("fechaAutoVinculacion").value;

	if (fechaAutoVinculacion != "") {
		$.ajax({
			type: "POST",
			dataType: "html",
			url: "format/litigacion/insertSenap/insert_FormAutoVincuProc.php",
			data: 'idResolMP=' + idResolMP + '&nuc=' + nuc + '&opcInsert=' + opcInsert + '&fechaAutoVinculacion=' + fechaAutoVinculacion,
			success: function (respuesta) {
				var json = respuesta;
				var obj = eval("(" + json + ")");
				if (obj.first == "NO") {
					swal("", "No se registro verifique los datos.", "warning");
				} else {
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
	} else {
		swal("", "Faltan datos por registrar.", "warning");
	}
}

/****Ingresa a la bd la informacion de SENAP de medidas cautelares****/
function insertMedCautelar_db(idEstatusNucs, estatus, nuc, opcInsert) {
	var fechaCierreInvest = document.getElementById("fechaCierreInvest").value;
	var formulacionAcusacion = document.getElementById("formulacionAcusacion").value;
	var fechaEscritoAcusacion = document.getElementById("fechaEscritoAcusacion").value;
	var edad_imputado_medida = document.getElementById("edad_imputado_medida").value;
	var temporalida_medida = document.getElementById("temporalida_medida").value;
	var parentesco_victima = document.getElementById("parentesco_victima").value;
	var id_sexo = $('input[name="id_sexo"]:checked').val();

	if (fechaCierreInvest != "" && edad_imputado_medida != "" && temporalida_medida != "" && parentesco_victima != "" && typeof id_sexo !== 'undefined') {
		$.ajax({
			type: "POST",
			dataType: "html",
			url: "format/litigacion/insertSenap/insert_FormMedCautelar.php",
			data: 'idEstatusNucs=' + idEstatusNucs + '&nuc=' + nuc + '&opcInsert=' + opcInsert + '&fechaCierreInvest=' + fechaCierreInvest + '&formulacionAcusacion=' + formulacionAcusacion + '&fechaEscritoAcusacion=' + fechaEscritoAcusacion +
				'&edad_imputado_medida=' + edad_imputado_medida + '&temporalida_medida=' + temporalida_medida + '&parentesco_victima=' + parentesco_victima + '&id_sexo=' + id_sexo,
			success: function (respuesta) {
				var json = respuesta;
				var obj = eval("(" + json + ")");
				if (obj.first == "NO") {
					swal("", "No se registro verifique los datos.", "warning");
				} else {
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
	} else {
		swal("", "Faltan datos por registrar.", "warning");
	}
}

/****Ingresa a la bd la informacion de SENAP de Audiencias Intermedias****/
function insertAudienciaIntermedia_db(idEstatusNucs, estatus, nuc, opcInsert) {
	var fechaAudienciaIntermedia = document.getElementById("fechaAudienciaIntermedia").value;
	var mediosDePrueba = document.getElementById("mediosDePrueba").value;
	var tipoMedioPrueba = document.getElementById("tipoMedioPrueba").value;
	var acuerdoProbatorio = document.getElementById("acuerdoProbatorio").value;
	var apertJuiOral = document.getElementById("apertJuiOral").value;

	if (fechaAudienciaIntermedia != "" && mediosDePrueba != 0) {
		$.ajax({
			type: "POST",
			dataType: "html",
			url: "format/litigacion/insertSenap/insert_FormAudienciaIntermedia.php",
			data: 'idEstatusNucs=' + idEstatusNucs + '&nuc=' + nuc + '&opcInsert=' + opcInsert + '&fechaAudienciaIntermedia=' + fechaAudienciaIntermedia + '&mediosDePrueba=' + mediosDePrueba +
				'&tipoMedioPrueba=' + tipoMedioPrueba + '&acuerdoProbatorio=' + acuerdoProbatorio + '&apertJuiOral=' + apertJuiOral,
			success: function (respuesta) {
				var json = respuesta;
				var obj = eval("(" + json + ")");
				if (obj.first == "NO") {
					swal("", "No se registro verifique los datos.", "warning");
				} else {
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
	} else {
		swal("", "Faltan datos por registrar.", "warning");
	}
}

/****Ingresa a la bd la informacion de SENAP de sobreseimientos****/
function insertSobreseimientos_db(idEstatusNucs, estatus, nuc, opcInsert) {
	var fechaDictoSobresei = document.getElementById("fechaDictoSobresei").value;
	var tipoSobreseimiento = document.getElementById("tipoSobreseimiento").value;

	if (fechaDictoSobresei != "" && tipoSobreseimiento != 0) {
		$.ajax({
			type: "POST",
			dataType: "html",
			url: "format/litigacion/insertSenap/insert_FormSobreseimientos.php",
			data: 'idEstatusNucs=' + idEstatusNucs + '&nuc=' + nuc + '&opcInsert=' + opcInsert + '&fechaDictoSobresei=' + fechaDictoSobresei + '&tipoSobreseimiento=' + tipoSobreseimiento,
			success: function (respuesta) {
				var json = respuesta;
				var obj = eval("(" + json + ")");
				if (obj.first == "NO") {
					swal("", "No se registro verifique los datos.", "warning");
				} else {
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
	} else {
		swal("", "Faltan datos por registrar.", "warning");
	}
}

/****Ingresa a la bd la informacion de SENAP de suspencion condicional del proceso****/
function insertSuspCondProc_db(idEstatusNucs, estatus, nuc, opcInsert) {
	var fechaDictoSuspConProc = document.getElementById("fechaDictoSuspConProc").value;
	var etapaSuspCondProc = document.getElementById("etapaSuspCondProc").value;
	var CondImpuSuspConProc = document.getElementById("CondImpuSuspConProc").value;
	var reaperturaProc = document.getElementById("reaperturaProc").value;
	var fechaReaperProc = document.getElementById("fechaReaperProc").value;
	var fechaCumpSuspCondPro = document.getElementById("fechaCumpSuspCondPro").value;

	if (fechaDictoSuspConProc != "") {
		$.ajax({
			type: "POST",
			dataType: "html",
			url: "format/litigacion/insertSenap/insert_FormSuspCondProc.php",
			data: 'idEstatusNucs=' + idEstatusNucs + '&nuc=' + nuc + '&opcInsert=' + opcInsert + '&fechaDictoSuspConProc=' + fechaDictoSuspConProc + '&etapaSuspCondProc=' + etapaSuspCondProc +
				'&CondImpuSuspConProc=' + CondImpuSuspConProc + '&reaperturaProc=' + reaperturaProc + '&fechaReaperProc=' + fechaReaperProc + '&fechaCumpSuspCondPro=' + fechaCumpSuspCondPro,
			success: function (respuesta) {
				var json = respuesta;
				var obj = eval("(" + json + ")");
				if (obj.first == "NO") {
					swal("", "No se registro verifique los datos.", "warning");
				} else {
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
	} else {
		swal("", "Faltan datos por registrar.", "warning");
	}
}

/****Ingresa a la bd la informacion de SENAP de Audiencias de Juicio****/
function insertAudienciasJuicio_db(idEstatusNucs, estatus, nuc, opcInsert) {
	var fechaAudienciaJuicio = document.getElementById("fechaAudienciaJuicio").value;
	var pruebasAudienciaJuicio = document.getElementById("pruebasAudienciaJuicio").value;


	$.ajax({
		type: "POST",
		dataType: "html",
		url: "format/litigacion/insertSenap/insert_FormAudienciaJuicio.php",
		data: 'idEstatusNucs=' + idEstatusNucs + '&nuc=' + nuc + '&opcInsert=' + opcInsert + '&fechaAudienciaJuicio=' + fechaAudienciaJuicio + '&pruebasAudienciaJuicio=' + pruebasAudienciaJuicio,
		success: function (respuesta) {
			var json = respuesta;
			var obj = eval("(" + json + ")");
			if (obj.first == "NO") {
				swal("", "No se registro verifique los datos.", "warning");
			} else {
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

}


/****Ingresa a la bd la informacion de SENAP de Acuerdos reparatorios****/
function insertAcuerdoReparatorio_db(idEstatusNucs, estatus, nuc, opcInsert) {
	var tipoAcuerdosRep = document.getElementById("tipoAcuerdosRep").value;

	if (tipoAcuerdosRep != 0) {
		$.ajax({
			type: "POST",
			dataType: "html",
			url: "format/litigacion/insertSenap/insert_FormAcuerdosReparatorios.php",
			data: 'idEstatusNucs=' + idEstatusNucs + '&nuc=' + nuc + '&opcInsert=' + opcInsert + '&tipoAcuerdosRep=' + tipoAcuerdosRep,
			success: function (respuesta) {
				var json = respuesta;
				var obj = eval("(" + json + ")");
				if (obj.first == "NO") {
					swal("", "No se registro verifique los datos.", "warning");
				} else {
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
	} else {
		swal("", "Faltan datos por registrar.", "warning");
	}
}

/****Ingresa a la bd la informacion de SENAP de Criterios de Oportunidad****/
function insertCriteriosOportunidad_db(idEstatusNucs, estatus, nuc, opcInsert) {
	var tipoCriterioOportunidad = document.getElementById("tipoCriterioOportunidad").value;

	if (tipoCriterioOportunidad != 0) {
		$.ajax({
			type: "POST",
			dataType: "html",
			url: "format/litigacion/insertSenap/insert_FormCriterioOportunidad.php",
			data: 'idEstatusNucs=' + idEstatusNucs + '&nuc=' + nuc + '&opcInsert=' + opcInsert + '&tipoCriterioOportunidad=' + tipoCriterioOportunidad,
			success: function (respuesta) {
				var json = respuesta;
				var obj = eval("(" + json + ")");
				if (obj.first == "NO") {
					swal("", "No se registro verifique los datos.", "warning");
				} else {
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
	} else {
		swal("", "Faltan datos por registrar.", "warning");
	}
}

/****Ingresa a la bd la informacion de SENAP de Criterios de Oportunidad****/
function insertSentencias_db(idEstatusNucs, estatus, nuc, opcInsert, idMp, mes, anio, tipo_investigacion) {
	if ($('.checkRecla').prop('checked')) {
		var reclasificacion = 1;
		var newBrwosers_id = $("#newBrwoser").val();
		var idCatModalidadEst = $("#newBrwosers").find("option[value='" + newBrwosers_id + "']").attr('data-id');
	} else {
		var reclasificacion = 0;
		$("input[type=radio]:checked").each(function () { idCatModalidadEst = $(this).val() });
	}

	if (tipo_investigacion == 2) {
		var newBrwosers_id = $("#newBrwoser").val();
		var idCatModalidadEst = $("#newBrwosers").find("option[value='" + newBrwosers_id + "']").attr('data-id');
	}

	console.log(nuc);

	if (estatus == 66) { var fechaDictoSentencia = "noData"; } else { var fechaDictoSentencia = document.getElementById("fechaDictoSentencia").value; }
	var tipoSentencia = document.getElementById("tipoSentencia").value;
	if (estatus == 66) { var aniosPrision = "noData"; } else { var aniosPrision = document.getElementById("aniosPrision").value; }
	if (estatus == 66) { var sentenciaFirme = "noData"; } else { var sentenciaFirme = document.getElementById("sentenciaFirme").value; }
	if (estatus == 66) { var sentDerivaProcAbrv = "noData"; } else { var sentDerivaProcAbrv = document.getElementById("sentDerivaProcAbrv").value; }
	if (estatus == 66) { var fechaDictoProcAbrv = "noData"; } else { var fechaDictoProcAbrv = document.getElementById("fechaDictoProcAbrv").value; }

	//DATA IMPUTADO
	var nombre_imputado = document.getElementById("nombre_imputado").value;
	var apellido_paterno = document.getElementById("apellido_paterno").value;
	var apellido_materno = document.getElementById("apellido_materno").value;
	var edad = document.getElementById("edad").value;
	var id_sexo = $('input[name="id_sexo"]:checked').val();

	if (opcInsert == 0) {
		if (typeof idCatModalidadEst !== 'undefined' && nombre_imputado != "" && apellido_paterno != "" && apellido_materno != "" && edad != "" && id_sexo != "") {
			$.ajax({
				type: "POST",
				dataType: "html",
				url: "format/litigacion/insertSenap/insert_FormSentencias.php",
				data: 'idEstatusNucs=' + idEstatusNucs + '&nuc=' + nuc + '&opcInsert=' + opcInsert + '&estatus=' + estatus + '&fechaDictoSentencia=' + fechaDictoSentencia + '&tipoSentencia=' + tipoSentencia +
					'&aniosPrision=' + aniosPrision + '&sentenciaFirme=' + sentenciaFirme + '&sentDerivaProcAbrv=' + sentDerivaProcAbrv + '&fechaDictoProcAbrv=' + fechaDictoProcAbrv + '&idCatModalidadEst=' + idCatModalidadEst + '&reclasificacion=' + reclasificacion
					+ '&tipo_investigacion=' + tipo_investigacion + '&nombre_imputado=' + nombre_imputado + '&apellido_paterno=' + apellido_paterno + '&apellido_materno=' + apellido_materno + '&edad=' + edad + '&id_sexo=' + id_sexo,
				success: function (respuesta) {
					var json = respuesta;
					var obj = eval("(" + json + ")");
					if (obj.first == "NO") {
						swal("", "No se registro verifique los datos.", "warning");
					} else {
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
		} else {
			swal("", "Faltan datos por registrar.", "warning");
		}
	} else {
		if (typeof idCatModalidadEst !== 'undefined') {
			$.ajax({
				type: "POST",
				dataType: "html",
				url: "format/litigacion/insertSenap/insert_FormSentencias.php",
				data: 'idEstatusNucs=' + idEstatusNucs + '&nuc=' + nuc + '&opcInsert=' + opcInsert + '&estatus=' + estatus + '&fechaDictoSentencia=' + fechaDictoSentencia + '&tipoSentencia=' + tipoSentencia +
					'&aniosPrision=' + aniosPrision + '&sentenciaFirme=' + sentenciaFirme + '&sentDerivaProcAbrv=' + sentDerivaProcAbrv + '&fechaDictoProcAbrv=' + fechaDictoProcAbrv + '&idCatModalidadEst=' + idCatModalidadEst + '&reclasificacion=' + reclasificacion + '&tipo_investigacion=' + tipo_investigacion +
					'&nombre_imputado=' + nombre_imputado + '&apellido_paterno=' + apellido_paterno + '&apellido_materno=' + apellido_materno + '&edad=' + edad + '&id_sexo=' + id_sexo,
				success: function (respuesta) {
					var json = respuesta;
					var obj = eval("(" + json + ")");
					if (obj.first == "NO") {
						swal("", "No se registro verifique los datos.", "warning");
					} else {
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
		} else {
			swal("", "Faltan datos por registrar.", "warning");
		}
	}

}


/****Ingresa a la bd la informacion de SENAP de Criterios de Oportunidad****/
function insertReparacionDanios_db(idEstatusNucs, estatus, nuc, opcInsert) {
	var montoRepDanio = document.getElementById("montoRepDanio").value;

	if (montoRepDanio != "") {
		$.ajax({
			type: "POST",
			dataType: "html",
			url: "format/litigacion/insertSenap/insert_FormRepDanios.php",
			data: 'idEstatusNucs=' + idEstatusNucs + '&nuc=' + nuc + '&opcInsert=' + opcInsert + '&montoRepDanio=' + montoRepDanio,
			success: function (respuesta) {
				var json = respuesta;
				var obj = eval("(" + json + ")");
				if (obj.first == "NO") {
					swal("", "No se registro verifique los datos.", "warning");
				} else {
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
	} else {
		swal("", "Faltan datos por registrar.", "warning");
	}
}

/****Ingresa a la bd el delito por el cual se judicializo****/
function insertFormJudicializada_db(idEstatusNucs, estatus, nuc, opcInsert) {
	if ($('.checkRecla').prop('checked')) {
		var reclasificacion = 1;
		var newBrwosers_id = $("#newBrwoser").val();
		var idCatModalidadEst = $("#newBrwosers").find("option[value='" + newBrwosers_id + "']").attr('data-id');
		var causaPenal = document.getElementById("causaPenal").value;
		var fechaCausaPenal = document.getElementById("fechaCausaPenal").value;
		var celebracionAudIniOk = document.getElementById("celebracionAudIniOk").value;
		var motivoNoAudienciaIni = document.getElementById("motivoNoAudienciaIni").value;
		var fechaAudienciaInicial = document.getElementById("fechaAudienciaInicial").value;
	} else {
		var reclasificacion = 0;
		$("input[type=radio]:checked").each(function () { idCatModalidadEst = $(this).val() });
		var causaPenal = document.getElementById("causaPenal").value;
		var fechaCausaPenal = document.getElementById("fechaCausaPenal").value;
		var celebracionAudIniOk = document.getElementById("celebracionAudIniOk").value;
		var motivoNoAudienciaIni = document.getElementById("motivoNoAudienciaIni").value;
		var fechaAudienciaInicial = document.getElementById("fechaAudienciaInicial").value;
	}
	if (celebracionAudIniOk == 1) {
		if (typeof idCatModalidadEst !== 'undefined' && causaPenal != "" && fechaCausaPenal != "" && fechaAudienciaInicial != "") {

			$.ajax({
				type: "POST",
				dataType: "html",
				url: "format/litigacion/insertSenap/insert_FormJudicializada.php",
				data: 'idEstatusNucs=' + idEstatusNucs + '&nuc=' + nuc + '&opcInsert=' + opcInsert + '&idCatModalidadEst=' + idCatModalidadEst + '&reclasificacion=' + reclasificacion + '&causaPenal=' + causaPenal +
					'&fechaCausaPenal=' + fechaCausaPenal + '&celebracionAudIniOk=' + celebracionAudIniOk + '&motivoNoAudienciaIni=' + motivoNoAudienciaIni + '&fechaAudienciaInicial=' + fechaAudienciaInicial,
				success: function (respuesta) {
					var json = respuesta;
					var obj = eval("(" + json + ")");
					if (obj.first == "NO") {
						swal("", "No se registro verifique los datos.", "warning");
					} else {
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
		} else {
			swal("", "Faltan datos por registrar.", "warning");
		}
	}
	else if (celebracionAudIniOk == 2) {
		if (typeof idCatModalidadEst !== 'undefined' && causaPenal != "" && fechaCausaPenal != "" && motivoNoAudienciaIni != 0) {

			$.ajax({
				type: "POST",
				dataType: "html",
				url: "format/litigacion/insertSenap/insert_FormJudicializada.php",
				data: 'idEstatusNucs=' + idEstatusNucs + '&nuc=' + nuc + '&opcInsert=' + opcInsert + '&idCatModalidadEst=' + idCatModalidadEst + '&reclasificacion=' + reclasificacion + '&causaPenal=' + causaPenal +
					'&fechaCausaPenal=' + fechaCausaPenal + '&celebracionAudIniOk=' + celebracionAudIniOk + '&motivoNoAudienciaIni=' + motivoNoAudienciaIni + '&fechaAudienciaInicial=' + fechaAudienciaInicial,
				success: function (respuesta) {
					var json = respuesta;
					var obj = eval("(" + json + ")");
					if (obj.first == "NO") {
						swal("", "No se registro verifique los datos.", "warning");
					} else {
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
		} else {
			swal("", "Faltan datos por registrar.", "warning");
		}
	}
	else if (celebracionAudIniOk == 3) {
		if (typeof idCatModalidadEst !== 'undefined' && causaPenal != "" && fechaCausaPenal != "") {

			$.ajax({
				type: "POST",
				dataType: "html",
				url: "format/litigacion/insertSenap/insert_FormJudicializada.php",
				data: 'idEstatusNucs=' + idEstatusNucs + '&nuc=' + nuc + '&opcInsert=' + opcInsert + '&idCatModalidadEst=' + idCatModalidadEst + '&reclasificacion=' + reclasificacion + '&causaPenal=' + causaPenal +
					'&fechaCausaPenal=' + fechaCausaPenal + '&celebracionAudIniOk=' + celebracionAudIniOk + '&motivoNoAudienciaIni=' + motivoNoAudienciaIni + '&fechaAudienciaInicial=' + fechaAudienciaInicial,
				success: function (respuesta) {
					var json = respuesta;
					var obj = eval("(" + json + ")");
					if (obj.first == "NO") {
						swal("", "No se registro verifique los datos.", "warning");
					} else {
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
		} else {
			swal("", "Faltan datos por registrar.", "warning");
		}
	} else {
		swal("", "Faltan datos por registrar.", "warning");
	}
}

/****Ingresa a la bd la informacion de medidas de proteccion****/
function insertMedidaProteccion_db(idEstatusNucs, estatus, nuc, opcInsert, idMp, mes, anio) {
	var masculino = document.getElementById("personaFisMasc").value;
	var femenino = document.getElementById("personaFisFem").value;
	var moral = document.getElementById("personaMoral").value;
	var desconocido = document.getElementById("desconocido").value;

	if (masculino > 0 || femenino > 0 || moral > 0 || desconocido > 0) {
		if (masculino == "") { masculino = 0; }
		if (femenino == "") { femenino = 0; }
		if (moral == "") { moral = 0; }
		if (desconocido == "") { desconocido = 0; }
		$.ajax({
			type: "POST",
			dataType: "html",
			url: "format/litigacion/insertSenap/insert_FormMedidaProteccion.php",
			data: 'idEstatusNucs=' + idEstatusNucs + '&nuc=' + nuc + '&opcInsert=' + opcInsert + '&masculino=' + masculino + '&femenino=' + femenino + '&moral=' + moral + '&desconocido=' + desconocido + '&idMp=' + idMp + '&mes=' + mes + '&anio=' + anio,
			success: function (respuesta) {
				var json = respuesta;
				var obj = eval("(" + json + ")");
				if (obj.first == "NO") {
					swal("", "No se registro verifique los datos.", "warning");
				} else {
					if (obj.first == "SI") {
						$('#MPV').val(obj.victimas); //actualizamos el numero de victimas
						var obj = eval("(" + json + ")");
						swal("", "Registro exitosamente. ", "success");
						$('#modalNucsLitigInfo').modal('hide');
						$('#modalNucsLitig').modal('show');
					}
				}
			}
		});
	} else {
		swal("", "Faltan datos por registrar.", "warning");
	}
}

/****Ingresa a la bd la informacion de fecha de cumplimento de mandamiento judicial orden de aprehension****/
function insertFechaCumplimento_db(idEstatusNucs, estatus, nuc, opcInsert, idMp, mes, anio) {
	var fechaCumplimiento = document.getElementById("fechaCumplimiento").value;

	if (fechaCumplimiento != "") {
		$.ajax({
			type: "POST",
			dataType: "html",
			url: "format/litigacion/insertSenap/insert_FormFechaCumplimento.php",
			data: 'idEstatusNucs=' + idEstatusNucs + '&nuc=' + nuc + '&opcInsert=' + opcInsert + '&fechaCumplimiento=' + fechaCumplimiento + '&idMp=' + idMp + '&mes=' + mes + '&anio=' + anio,
			success: function (respuesta) {
				var json = respuesta;
				var obj = eval("(" + json + ")");
				if (obj.first == "NO") {
					swal("", "No se registro verifique los datos.", "warning");
				} else {
					if (obj.first == "SI") {
						var obj = eval("(" + json + ")");
						swal("", "Registro exitosamente. ", "success");
						$('#modalNucsLitigInfo').modal('hide');
						$('#modalNucsLitig').modal('show');
					}
				}
			}
		});
	} else {
		swal("", "Faltan datos por registrar.", "warning");
	}
}



function reclasificar() {
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

function getDataDelitoSicap() {
	cont = document.getElementById('newBrwosers');
	ajax = objetoAjax();
	ajax.open("POST", "format/litigacion/insertSenap/getDelitosdataList.php");
	ajax.onreadystatechange = function () {
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send();
}

function sendDataJudicializada(nuc, estatus, idMp, mes, anio, deten, idUnidad, opcInsert, idImputado) {
	if ($('.checkRecla').prop('checked')) {
		var reclasificacion = 1;
		var newBrwosers_id = $("#newBrwoser").val();
		var idCatModalidadEst = $("#newBrwosers").find("option[value='" + newBrwosers_id + "']").attr('data-id');
		var causaPenal = document.getElementById("causaPenal").value;
		var fechaCausaPenal = document.getElementById("fechaCausaPenal").value;
		var celebracionAudIniOk = document.getElementById("celebracionAudIniOk").value;
		var motivoNoAudienciaIni = document.getElementById("motivoNoAudienciaIni").value;
		var fechaAudienciaInicial = document.getElementById("fechaAudienciaInicial").value;

	} else {
		var reclasificacion = 0;
		$("input[type=radio]:checked").each(function () { idCatModalidadEst = $(this).val() });
		var causaPenal = document.getElementById("causaPenal").value;
		var fechaCausaPenal = document.getElementById("fechaCausaPenal").value;
		var celebracionAudIniOk = document.getElementById("celebracionAudIniOk").value;
		var motivoNoAudienciaIni = document.getElementById("motivoNoAudienciaIni").value;
		var fechaAudienciaInicial = document.getElementById("fechaAudienciaInicial").value;
	}

	if (celebracionAudIniOk == 1) {
		if (typeof idCatModalidadEst !== 'undefined' && causaPenal != "" && fechaCausaPenal != "" && fechaAudienciaInicial != "") {
			insertarNucLit(idMp, estatus, mes, anio, nuc, deten, idUnidad, opcInsert,0, idImputado);
			$('#modalNucsLitigInfo').modal('hide');
			$('#modalNucsLitig').modal('show');
		} else {
			swal("", "Faltan datos por registrar.", "warning");
		}
	}
	else if (celebracionAudIniOk == 2) {
		if (typeof idCatModalidadEst !== 'undefined' && causaPenal != "" && fechaCausaPenal != "" && motivoNoAudienciaIni != 0) {
			insertarNucLit(idMp, estatus, mes, anio, nuc, deten, idUnidad, opcInsert,0, idImputado);
			$('#modalNucsLitigInfo').modal('hide');
			$('#modalNucsLitig').modal('show');
		} else {
			swal("", "Faltan datos por registrar.", "warning");
		}
	}
	else if (celebracionAudIniOk == 3) {
		if (typeof idCatModalidadEst !== 'undefined' && causaPenal != "" && fechaCausaPenal != "") {
			insertarNucLit(idMp, estatus, mes, anio, nuc, deten, idUnidad, opcInsert,0, idImputado);
			$('#modalNucsLitigInfo').modal('hide');
			$('#modalNucsLitig').modal('show');
		}
	} else {
		swal("", "Faltan datos por registrar.", "warning");
	}
}


function sendDataFormImputacion(nuc, estatus, idMp, mes, anio, deten, idUnidad, opcInsert, idImputado) {
	var fechaFormulacionImpu = document.getElementById("fechaFormulacionImpu").value;

	if (fechaFormulacionImpu != "") {
		insertarNucLit(idMp, estatus, mes, anio, nuc, deten, idUnidad, opcInsert,0, idImputado);
		$('#modalNucsLitigInfo').modal('hide');
		$('#modalNucsLitig').modal('show');
	} else {
		swal("", "Faltan datos por registrar.", "warning");
	}
}

function sendDataAutoVincuProc(nuc, estatus, idMp, mes, anio, deten, idUnidad, opcInsert) {
	var fechaAutoVinculacion = document.getElementById("fechaAutoVinculacion").value;

	if (fechaAutoVinculacion != "") {
		insertarNucLit2(idMp, estatus, mes, anio, nuc, deten, idUnidad, opcInsert);
		$('#modalNucsLitigInfo').modal('hide');
		$('#modalNucsLitig').modal('show');
	} else {
		swal("", "Faltan datos por registrar.", "warning");
	}
}

function sendDataMedCautelar(nuc, estatus, idMp, mes, anio, deten, idUnidad, opcInsert, idImputado) {
	var fechaCierreInvest = document.getElementById("fechaCierreInvest").value;
	var formulacionAcusacion = document.getElementById("formulacionAcusacion").value;
	var fechaEscritoAcusacion = document.getElementById("fechaEscritoAcusacion").value;
	var edad_imputado_medida = document.getElementById("edad_imputado_medida").value;
	var temporalida_medida = document.getElementById("temporalida_medida").value;
	var parentesco_victima = document.getElementById("parentesco_victima").value;
	var id_sexo = $('input[name="id_sexo"]:checked').val();

	if (fechaCierreInvest != "" && edad_imputado_medida != "" && temporalida_medida != "" && parentesco_victima != "" && typeof id_sexo !== 'undefined') {
		insertarNucLit(idMp, estatus, mes, anio, nuc, deten, idUnidad, opcInsert,0, idImputado);
		$('#modalNucsLitigInfo').modal('hide');
		$('#modalNucsLitig').modal('show');
	} else {
		swal("", "Faltan datos por registrar.", "warning");
	}

}

function sendDataAudienciaIntermedia(nuc, estatus, idMp, mes, anio, deten, idUnidad, opcInsert, idImputado) {
	var fechaAudienciaIntermedia = document.getElementById("fechaAudienciaIntermedia").value;
	var mediosDePrueba = document.getElementById("mediosDePrueba").value;
	var tipoMedioPrueba = document.getElementById("tipoMedioPrueba").value;
	var acuerdoProbatorio = document.getElementById("acuerdoProbatorio").value;
	var apertJuiOral = document.getElementById("apertJuiOral").value;

	if (fechaAudienciaIntermedia != "" && mediosDePrueba != 0) {
		insertarNucLit(idMp, estatus, mes, anio, nuc, deten, idUnidad, opcInsert,0, idImputado);
		$('#modalNucsLitigInfo').modal('hide');
		$('#modalNucsLitig').modal('show');
	} else {
		swal("", "Faltan datos por registrar.", "warning");
	}
}

function sendDataSobreseimientos(nuc, estatus, idMp, mes, anio, deten, idUnidad, opcInsert, idImputado) {
	var fechaDictoSobresei = document.getElementById("fechaDictoSobresei").value;
	var tipoSobreseimiento = document.getElementById("tipoSobreseimiento").value;

	if (fechaDictoSobresei != "" && tipoSobreseimiento != 0) {
		insertarNucLit(idMp, estatus, mes, anio, nuc, deten, idUnidad, opcInsert,0, idImputado);
		$('#modalNucsLitigInfo').modal('hide');
		$('#modalNucsLitig').modal('show');
	} else {
		swal("", "Faltan datos por registrar.", "warning");
	}
}

function sendDataSuspCondProc(nuc, estatus, idMp, mes, anio, deten, idUnidad, opcInsert, idImputado) {
	var fechaDictoSuspConProc = document.getElementById("fechaDictoSuspConProc").value;
	var etapaSuspCondProc = document.getElementById("etapaSuspCondProc").value;
	var CondImpuSuspConProc = document.getElementById("CondImpuSuspConProc").value;
	var reaperturaProc = document.getElementById("reaperturaProc").value;
	var fechaReaperProc = document.getElementById("fechaReaperProc").value;
	var fechaCumpSuspCondPro = document.getElementById("fechaCumpSuspCondPro").value;

	if (fechaDictoSuspConProc != "") {
		insertarNucLit(idMp, estatus, mes, anio, nuc, deten, idUnidad, opcInsert,0, idImputado);
		$('#modalNucsLitigInfo').modal('hide');
		$('#modalNucsLitig').modal('show');
	} else {
		swal("", "Faltan datos por registrar.", "warning");
	}
}

function sendDataAudienciasJuicio(nuc, estatus, idMp, mes, anio, deten, idUnidad, opcInsert, idImputado) {
	var fechaAudienciaJuicio = document.getElementById("fechaAudienciaJuicio").value;
	var pruebasAudienciaJuicio = document.getElementById("pruebasAudienciaJuicio").value;

	insertarNucLit(idMp, estatus, mes, anio, nuc, deten, idUnidad, opcInsert,0, idImputado);
	$('#modalNucsLitigInfo').modal('hide');
	$('#modalNucsLitig').modal('show');
	/*
		if(fechaAudienciaJuicio != "" && pruebasAudienciaJuicio != 0  ){
			 insertarNucLit(idMp,estatus,mes,anio,nuc,deten,idUnidad, opcInsert);
		  $('#modalNucsLitigInfo').modal('hide');
				$('#modalNucsLitig').modal('show');
		}else{
			swal("", "Faltan datos por registrar.", "warning");
		}*/
}

function sendDataCriteriosOportunidad(nuc, estatus, idMp, mes, anio, deten, idUnidad, opcInsert, idImputado) {
	var tipoCriterioOportunidad = document.getElementById("tipoCriterioOportunidad").value;

	if (tipoCriterioOportunidad != 0) {
		insertarNucLit(idMp, estatus, mes, anio, nuc, deten, idUnidad, opcInsert,0, idImputado);
		$('#modalNucsLitigInfo').modal('hide');
		$('#modalNucsLitig').modal('show');
	} else {
		swal("", "Faltan datos por registrar.", "warning");
	}
}

function sendDataAcuerdoReparatorio(nuc, estatus, idMp, mes, anio, deten, idUnidad, opcInsert, idImputado) {
	var tipoAcuerdosRep = document.getElementById("tipoAcuerdosRep").value;

	if (tipoAcuerdosRep != 0) {
		insertarNucLit(idMp, estatus, mes, anio, nuc, deten, idUnidad, opcInsert,0, idImputado);
		$('#modalNucsLitigInfo').modal('hide');
		$('#modalNucsLitig').modal('show');
	} else {
		swal("", "Faltan datos por registrar.", "warning");
	}
}

function sendDataSentencias(nuc, estatus, idMp, mes, anio, deten, idUnidad, opcInsert, tipo_investigacion, idImputado) {
	if ($('.checkRecla').prop('checked')) {
		var reclasificacion = 1;
		var newBrwosers_id = $("#newBrwoser").val();
		var idCatModalidadEst = $("#newBrwosers").find("option[value='" + newBrwosers_id + "']").attr('data-id');
	} else {
		var reclasificacion = 0;
		$("input[type=radio]:checked").each(function () { idCatModalidadEst = $(this).val() });
	}

	if (tipo_investigacion == 2) {
		var newBrwosers_id = $("#newBrwoser").val();
		var idCatModalidadEst = $("#newBrwosers").find("option[value='" + newBrwosers_id + "']").attr('data-id');
	}

	if (estatus == 66) { var fechaDictoSentencia = "noData"; } else { var fechaDictoSentencia = document.getElementById("fechaDictoSentencia").value; }
	var tipoSentencia = document.getElementById("tipoSentencia").value;
	if (estatus == 66) { var aniosPrision = "noData"; } else { var aniosPrision = document.getElementById("aniosPrision").value; }
	if (estatus == 66) { var sentenciaFirme = "noData"; } else { var sentenciaFirme = document.getElementById("sentenciaFirme").value; }
	if (estatus == 66) { var sentDerivaProcAbrv = "noData"; } else { var sentDerivaProcAbrv = document.getElementById("sentDerivaProcAbrv").value; }
	if (estatus == 66) { var fechaDictoProcAbrv = "noData"; } else { var fechaDictoProcAbrv = document.getElementById("fechaDictoProcAbrv").value; }

	//DATA IMPUTADO
	if (tipo_investigacion != 2) { var nombre_imputado = document.getElementById("nombre_imputado").value; } else { var nombre_imputado = 'null'; }
	if (tipo_investigacion != 2) { var apellido_paterno = document.getElementById("apellido_paterno").value; } else { var apellido_paterno = 'null'; }
	if (tipo_investigacion != 2) { var apellido_materno = document.getElementById("apellido_materno").value; } else { var apellido_materno = 'null'; }
	if (tipo_investigacion != 2) { var edad = document.getElementById("edad").value; } else { var edad = 'null'; }
	if (tipo_investigacion != 2) { var id_sexo = $('input[name="id_sexo"]:checked').val(); } else { var id_sexo = 'null'; }

	if (typeof idCatModalidadEst !== 'undefined' && nombre_imputado != "" && apellido_paterno != "" && apellido_materno != "" && edad != "" && id_sexo != "") {
		if (estatus == 14) {
			insertarNucLit2(idMp, estatus, mes, anio, nuc, deten, idUnidad, opcInsert);
			$('#modalNucsLitigInfo').modal('hide');
			$('#modalNucsLitig').modal('show');
		} else {
			insertarNucLit(idMp, estatus, mes, anio, nuc, deten, idUnidad, opcInsert, tipo_investigacion, idImputado);
			$('#modalNucsLitigInfo').modal('hide');
			$('#modalNucsLitig').modal('show');
		}
	} else {
		swal("", "Faltan datos por registrar.", "warning");
	}
}

function sendDataReparacionDanios(nuc, estatus, idMp, mes, anio, deten, idUnidad, opcInsert, idImputado) {
	var montoRepDanio = document.getElementById("montoRepDanio").value;

	if (montoRepDanio != "") {
		insertarNucLit(idMp, estatus, mes, anio, nuc, deten, idUnidad, opcInsert,0,idImputado);
		$('#modalNucsLitigInfo').modal('hide');
		$('#modalNucsLitig').modal('show');
	} else {
		swal("", "Faltan datos por registrar.", "warning");
	}
}

function sendDataMedidasProteccion(nuc, estatus, idMp, mes, anio, deten, idUnidad, opcInsert, idImputado) {
	var masculino = document.getElementById("personaFisMasc").value;
	var femenino = document.getElementById("personaFisFem").value;
	var moral = document.getElementById("personaMoral").value;
	var desconocido = document.getElementById("desconocido").value;

	if (masculino > 0 || femenino > 0 || moral > 0 || desconocido > 0) {
		insertarNucLit(idMp, estatus, mes, anio, nuc, deten, idUnidad, opcInsert, idImputado);
		$('#modalNucsLitigInfo').modal('hide');
		$('#modalNucsLitig').modal('show');
	} else {
		swal("", "Faltan datos por registrar.", "warning");
	}
}

function sendDataFechaCumplimento(nuc, estatus, idMp, mes, anio, deten, idUnidad, opcInsert, idImputado) {
	var fechaCumplimiento = document.getElementById("fechaCumplimiento").value;

	if (fechaCumplimiento != "") {
		insertarNucLit(idMp, estatus, mes, anio, nuc, deten, idUnidad, opcInsert,0, idImputado);
		$('#modalNucsLitigInfo').modal('hide');
		$('#modalNucsLitig').modal('show');
	} else {
		swal("", "Faltan datos por registrar.", "warning");
	}
}

function validateFormulacionJudicializada() {
	var celebracionAudIniOk = document.getElementById("celebracionAudIniOk").value;

	//Se evalua el valor dictonomico, en caso de recibir 2 correspondiente al valor asignado en la tabla CatOpcDicto ->'NO' habilitar los input
	switch (celebracionAudIniOk) {
		case '1':
			$('#motivoNoAudienciaIni').prop('disabled', true).val(0); //Desactiva Input
			$('#fechaAudienciaInicial').prop('disabled', false); //Desactiva Input
			break;
		case '2':
			$("#fechaAudienciaInicial").val("");
			$('#motivoNoAudienciaIni').prop('disabled', false); //Activa input
			$('#fechaAudienciaInicial').prop('disabled', true); //Desactiva Input
			break;
		case '3':
			$("#fechaAudienciaInicial").val("");
			$('#motivoNoAudienciaIni').prop('disabled', true).val(0); //Desactiva Input
			$('#fechaAudienciaInicial').prop('disabled', true); //Desactiva Input
			break;
	}
}

function validateMedidasCautelares() {
	var formulacionAcusacion = document.getElementById("formulacionAcusacion").value;

	//Se evalua el valor dictonomico, en caso de recibir 2 correspondiente al valor asignado en la tabla CatOpcDicto ->'NO' habilitar los input
	switch (formulacionAcusacion) {
		case '1':
			$('#fechaEscritoAcusacion').prop('disabled', false); //Activa Input
			break;
		case '2':
			$("#fechaEscritoAcusacion").val("");
			$('#fechaEscritoAcusacion').prop('disabled', true); //Desactiva Input
			break;
		case '3':
			$("#fechaEscritoAcusacion").val("");
			$('#fechaEscritoAcusacion').prop('disabled', true); //Desactiva Input
			break;
	}
}

function sendDataFormAutoVincuProc(nuc, estatus, idMp, mes, anio, deten, idUnidad, opcInsert, idImputado) {
	var fechaAutoVinculacion = document.getElementById("fechaAutoVinculacion").value;

	if (fechaAutoVinculacion != "") {
		insertarNucLit(idMp, estatus, mes, anio, nuc, deten, idUnidad, opcInsert,0, idImputado);
		$('#modalNucsLitigInfo').modal('hide');
		$('#modalNucsLitig').modal('show');
	} else {
		swal("", "Faltan datos por registrar.", "warning");
	}
}

//Muestra modal para ingresar información del imputado
function showModalAgregarImputados(estatus, nuc, idMp, mes, anio, deten, idUnidad, idImputado) {
	ajax = objetoAjax();
	ajax.open("POST", "format/litigacion/modal_Imputados.php");

	cont = document.getElementById('contmodal_imputados');
	ajax.onreadystatechange = function () {
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText;
			$('#modalNucs_imputados').modal('show');
			$('#modalNucsLitig').modal('hide');
		}
	}
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send('&estatus=' + estatus + '&nuc=' + nuc + '&idMp=' + idMp + '&mes=' + mes + '&anio=' + anio + '&deten=' + deten + '&idUnidad=' + idUnidad+ '&idImputado=' + idImputado);
}

function sendDataFormImputados(nuc, estatus, idMp, mes, anio, deten, idUnidad, opcInsert, idImputado) {
	
	var nombre_imputado = document.getElementById("nombre_imputado").value;
	var apellido_paterno = document.getElementById("apellido_paterno").value;
	var apellido_materno = document.getElementById("apellido_materno").value;
	var edad = document.getElementById("edad").value;
	var id_sexo = $('input[name="id_sexo"]:checked').val();

	if (nombre_imputado != "" && apellido_paterno != "" && apellido_materno != "" && edad != "" && id_sexo != "") {
		insertarNucLit(idMp, estatus, mes, anio, nuc, deten, idUnidad, opcInsert,0, idImputado);
		$('#modalNucsLitigInfo').modal('hide');
		$('#modalNucsLitig').modal('show');
	} else {
		swal("", "Faltan datos por registrar.", "warning");
	}
}

/****Ingresa a la bd la informacion de SENAP de Criterios de Oportunidad****/
function insertInputados_db(idEstatusNucs, estatus, nuc, opcInsert) {
	var nombre_imputado = document.getElementById("nombre_imputado").value;
	var apellido_paterno = document.getElementById("apellido_paterno").value;
	var apellido_materno = document.getElementById("apellido_materno").value;
	var edad = document.getElementById("edad").value;
	var id_sexo = $('input[name="id_sexo"]:checked').val();

	if (nombre_imputado != "" && apellido_paterno != "" && apellido_materno != "" && edad != "" && id_sexo != "") {
		$.ajax({
			type: "POST",
			dataType: "html",
			url: "format/litigacion/insertSenap/insert_FormInculpados.php",
			data: 'idEstatusNucs=' + idEstatusNucs + '&nuc=' + nuc + '&opcInsert=' + opcInsert + '&nombre_imputado=' + nombre_imputado + '&apellido_paterno=' + apellido_paterno
				+ '&apellido_materno=' + apellido_materno + '&edad=' + edad + '&id_sexo=' + id_sexo,
			success: function (respuesta) {
				var json = respuesta;
				var obj = eval("(" + json + ")");
				if (obj.first == "NO") {
					swal("", "No se registro verifique los datos.", "warning");
				} else {
					if (obj.first == "SI") {
						var obj = eval("(" + json + ")");
						swal("", "Registro exitosamente.", "success");
						//reloadOpcInsertButton(idEstatusNucs, estatus, nuc,  1);
						$('#modalNucs_imputados').modal('hide');
						$('#modalNucsLitig').modal('show');
					}
				}
			}
		});
	} else {
		swal("", "Faltan datos por registrar.", "warning");
	}
}

//Funcion para EDITAR informacion de la pestaña: IMPUTADOS
function edita_imputado(imputado_id, sentencias) {

	cont = document.getElementById('contDataImputados');
	ajax = objetoAjax();
	ajax.open("POST", "format/litigacion/template_imputados.php");

	ajax.onreadystatechange = function () {
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("&imputado_id=" + imputado_id + '&sentencias=' + sentencias);

}

function actualizar_imputado(imputado_id, idEstatusNucs, sentencias) {
	var nombre_imputado = document.getElementById("nombre_imputado").value;
	var apellido_paterno = document.getElementById("apellido_paterno").value;
	var apellido_materno = document.getElementById("apellido_materno").value;
	var edad = document.getElementById("edad").value;
	var id_sexo = $('input[name="id_sexo"]:checked').val();
	var opcInsert = 1;

	if (nombre_imputado != "" && apellido_paterno != "" && apellido_materno != "" && edad != "" && id_sexo != "") {
		$.ajax({
			type: "POST",
			dataType: "html",
			url: "format/litigacion/insertSenap/insert_FormInculpados.php",
			data: 'idEstatusNucs=' + idEstatusNucs + '&nuc=' + nuc + '&opcInsert=' + opcInsert + '&nombre_imputado=' + nombre_imputado + '&apellido_paterno=' + apellido_paterno
				+ '&apellido_materno=' + apellido_materno + '&edad=' + edad + '&id_sexo=' + id_sexo + '&imputado_id=' + imputado_id + '&opcInsert=' + opcInsert,
			success: function (respuesta) {
				var json = respuesta;
				var obj = eval("(" + json + ")");
				if (obj.first == "NO") {
					swal("", "No se actualizo verifique los datos.", "warning");
				} else {
					if (obj.first == "SI") {
						var obj = eval("(" + json + ")");
						swal("", "Registro actualizado.", "success");
						//reloadOpcInsertButton(idEstatusNucs, estatus, nuc,  1);
						if (sentencias == "SENTENCIAS") {
							$('#modalNucsLitigInfo').modal('hide');
							$('#modalNucsLitig').modal('show');
						} else {
							$('#modalNucs_imputados').modal('hide');
							$('#modalNucsLitig').modal('show');
						}
					}
				}
			}
		});
	} else {
		swal("", "Faltan datos por registrar.", "warning");
	}
}

function insertImputados_nuevo_db(idEstatusNucs, estatus, nuc, opcInsert) {
	var nombre_imputado = document.getElementById("nombre_imputado").value;
	var apellido_paterno = document.getElementById("apellido_paterno").value;
	var apellido_materno = document.getElementById("apellido_materno").value;
	var edad = document.getElementById("edad").value;
	var id_sexo = $('input[name="id_sexo"]:checked').val();

	if (nombre_imputado != "" && apellido_paterno != "" && apellido_materno != "" && edad != "" && id_sexo != "") {
		$.ajax({
			type: "POST",
			dataType: "html",
			url: "format/litigacion/insertSenap/insert_nuevo_imputado.php",
			data: 'idEstatusNucs=' + idEstatusNucs + '&nuc=' + nuc + '&opcInsert=' + opcInsert + '&nombre_imputado=' + nombre_imputado + '&apellido_paterno=' + apellido_paterno
				+ '&apellido_materno=' + apellido_materno + '&edad=' + edad + '&id_sexo=' + id_sexo,
			success: function (respuesta) {
				var json = respuesta;
				var obj = eval("(" + json + ")");
				if (obj.first == "NO") {
					swal("", "No se registro verifique los datos.", "warning");
				} else {
					if (obj.first == "SI") {
						var obj = eval("(" + json + ")");
						swal("", "Imputado agregado exitosamente.", "success");
						//reloadOpcInsertButton(idEstatusNucs, estatus, nuc,  1);
						$('#modalNucs_imputados').modal('hide');
						$('#modalNucsLitig').modal('show');
					}
				}
			}
		});
	} else {
		swal("", "Faltan datos por registrar.", "warning");
	}
}

function elimiar_imputado(idEstatusNucs, imputado_id, total_imputados) {
	if (total_imputados > 1) {
		$.ajax({
			type: "POST",
			dataType: "html",
			url: "format/litigacion/insertSenap/delete_imputado.php",
			data: 'idEstatusNucs=' + idEstatusNucs + '&imputado_id=' + imputado_id,
			success: function (respuesta) {
				var json = respuesta;
				var obj = eval("(" + json + ")");
				if (obj.first == "NO") {
					swal("", "No se elimino, intente nuevamente.", "warning");
				} else {
					if (obj.first == "SI") {
						var obj = eval("(" + json + ")");
						swal("", "Imputado eliminado exitosamente.", "success");
						//reloadOpcInsertButton(idEstatusNucs, estatus, nuc,  1);
						$('#modalNucs_imputados').modal('hide');
						$('#modalNucsLitig').modal('show');
					}
				}
			}
		});
	} else {
		swal("", "No se puede eliminar el imputado, debe de haber al menos un imputado por carpeta.", "warning");
	}
}

//FUNCION PARA VALIDAR LOS CAMPOS, varchar, int
function validaInput_litigacion(e, tipo) {
	var key = e.keyCode || e.which;
	var tecla = String.fromCharCode(key).toLowerCase();
	if (tipo == 'varchar') { var letras = "abcdefghijklmnopqrstuvwxyz"; }

	var especiales = [8, 37, 39, 46, 110, 32];
	var tecla_especial = false;

	for (var i in especiales) {
		if (key == especiales[i]) {
			tecla_especial = true;
			break;
		}
	}

	if (letras.indexOf(tecla) == -1 && !tecla_especial) {
		return false;
	}

	if (e.length > e.maxLength) {
		e.value = e.value.slice(0, e.maxLength)
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