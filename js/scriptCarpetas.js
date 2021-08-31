
function objetoAjax() {
	var xmlhttp = false;
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		try {
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (E) {
			xmlhttp = false;
		}
	}
	if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}

function loadCarpetasFormat(idUnidad) {


	cont = document.getElementById('contenido');

	ajax = objetoAjax();
	ajax.open("POST", "carpetas/formatosAreas.php");

	ajax.onreadystatechange = function () {
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText;
			//cargar tabla sin nada
		}
	}
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("&idUnidad=" + idUnidad);

}


function descargarHisrtoricV2(format, idUnidad, idEnlace) {

	var anio = document.getElementById("anioHistorique").value;
	var mes = document.getElementById("mesHistorique").value;

	ajax = objetoAjax();
	ajax.open("POST", "carpetas/descargarHistorico.php");

	nombrereporte = "CarpetasInvestigacion-" + idUnidad + "-" + mes + "-" + anio;
	cont = document.getElementById('respuestaDescargarCarpeta32');
	ajax.onreadystatechange = function () {
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText;
			document.location.href = "carpetas/downloadReport/" + nombrereporte + ".xlsx";
		}
	}
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send('&idUnidad=' + idUnidad + '&mes=' + mes + '&anio=' + anio + '&idEnlace=' + idEnlace);

}



function cargarMOdalFormatoCarpetas(nombreCompletoMP, idMp, idUnidad, mes, anio) {

	cont = document.getElementById('contMOdalFormato');
	ajax = objetoAjax();
	ajax.open("POST", "carpetas/modalFormatoCarpetasV2.php");

	ajax.onreadystatechange = function () {
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText;
			//cargar tabla sin nada
			$('#myModaFormato').on('show.bs.modal', function () {

			});
		}
	}
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("&nombreCompletoMP=" + nombreCompletoMP + "&idMp=" + idMp + "&idUnidad=" + idUnidad + "&mes=" + mes + "&anio=" + anio);

}

function sendModalCarpetasNucs(estatus, idMp, mes, anio, idUnidad, deten) {


	cont = document.getElementById('contmodalnucs');

	$('#nuc').focus();
	ajax = objetoAjax();
	ajax.open("POST", "carpetas/modalNucsCarpetas.php");
	ajax.onreadystatechange = function () {
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText;
			$('#myModaFormato').modal('hide');
			$('#modalNucs').modal('show');
		}
	}
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("&idMp=" + idMp + "&mes=" + mes + "&anio=" + anio + "&estatus=" + estatus + "&idUnidad=" + idUnidad + "&deten=" + deten);

}


function validateCarpetJudicializade2(idMp, mes, anio, estatResolucion, idUnidad, deten) {


	acc = "validateJudicializte2";
	cont = document.getElementById("contentMotivo");
	ajax = objetoAjax();


	ajax.open("POST", "carpetas/accionesNucsCarpetas.php");
	nuc = document.getElementById("nuc").value;

	ajax.onreadystatechange = function () {
		if (ajax.readyState == 4 && ajax.status == 200) {

			//cont.innerHTML = ajax.responseText;			

			var cadCodificadaJSON = ajax.responseText;
			var objDatos = eval("(" + cadCodificadaJSON + ")");

			if (objDatos.first == "NO") {


				saveCarpetJudicidFirstTime(idMp, mes, anio, estatResolucion, idUnidad, deten);


			} else {

				if (objDatos.first == "SI") {


					validateCarpetJudicializade(idMp, mes, anio, estatResolucion, idUnidad, deten);
					document.getElementById("contentMotivo").style.display = "block";

				}

			}


		}
	}
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("&acc=" + acc + "&idMp=" + idMp + "&estatResolucion=" + estatResolucion + "&mes=" + mes
		+ "&anio=" + anio + "&nuc=" + nuc + "&idUnidad=" + idUnidad + "&deten=" + deten);


}




function validateCarpetJudicializade(idMp, mes, anio, estatResolucion, idUnidad, deten) {


	acc = "validateJudicializte";
	cont = document.getElementById("contentMotivo");
	ajax = objetoAjax();


	ajax.open("POST", "carpetas/accionesNucsCarpetas.php");
	nuc = document.getElementById("nuc").value;

	ajax.onreadystatechange = function () {
		if (ajax.readyState == 4 && ajax.status == 200) {

			cont.innerHTML = ajax.responseText;


		}
	}
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("&acc=" + acc + "&idMp=" + idMp + "&estatResolucion=" + estatResolucion + "&mes=" + mes
		+ "&anio=" + anio + "&nuc=" + nuc + "&idUnidad=" + idUnidad + "&deten=" + deten);


}

function saveCarpetJudicidFirstTime(idMp, mes, anio, estatResolucion, idUnidad, deten) {



	texto = document.getElementById("nuc").value;
	cantidadinicio = document.getElementById("nuc").value.length;
	envioselect = 0;


	if (cantidadinicio > 13) {
		var slice2 = texto.slice(0, -1);
		document.getElementById("nuc").value = slice2;
	} else {

		if (cantidadinicio < 13) { } else {

			if (cantidadinicio == 13) {


				nuc = document.getElementById('nuc').value;

				acc = "existeNuc";
				ajax = objetoAjax();
				ajax.open("POST", "carpetas/accionesNucsCarpetas.php");

				ajax.onreadystatechange = function () {
					if (ajax.readyState == 4 && ajax.status == 200) {


						var cadCodificadaJSON = ajax.responseText;
						var objDatos = eval("(" + cadCodificadaJSON + ")");

						if (objDatos.first == "NO") { swal("", "El numero de caso no existe.", "warning"); } else {

							if (objDatos.first == "SI") {

								document.getElementById('btnSaveNuc').disabled = true;

								////// VALIDAR TODO EL NUC QUE VA ENTRANDO CON LAS DIFERENTES REGLAS
								validarReglasNUC(nuc, estatResolucion, mes, anio, nuc, idUnidad, idMp, deten, envioselect);
								////// VALIDAR TODO EL NUC QUE VA ENTRANDO CON LAS DIFERENTES REGLAS										

							}
						}


					}
				}
				ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				ajax.send("&nuc=" + nuc + "&acc=" + acc + "&estatResolucion=" + estatResolucion);


			}
		}
	}



}



function saveCarpetJudicid(idMp, mes, anio, estatResolucion, idUnidad, deten) {



	texto = document.getElementById("nuc").value;
	cantidadinicio = document.getElementById("nuc").value.length;
	envioselect = document.getElementById("envioselect").value;


	if (cantidadinicio > 13) {
		var slice2 = texto.slice(0, -1);
		document.getElementById("nuc").value = slice2;
	} else {

		if (cantidadinicio < 13) { } else {

			if (cantidadinicio == 13) {


				if (envioselect == 0) { swal("", "Debe seleccionar un motivo.", "warning"); } else {



					nuc = document.getElementById('nuc').value;

					acc = "existeNuc";
					ajax = objetoAjax();
					ajax.open("POST", "carpetas/accionesNucsCarpetas.php");

					ajax.onreadystatechange = function () {
						if (ajax.readyState == 4 && ajax.status == 200) {


							var cadCodificadaJSON = ajax.responseText;
							var objDatos = eval("(" + cadCodificadaJSON + ")");

							if (objDatos.first == "NO") { swal("", "El numero de caso no existe.", "warning"); } else {

								if (objDatos.first == "SI") {

									document.getElementById('btnSaveNuc').disabled = true;

									////// VALIDAR TODO EL NUC QUE VA ENTRANDO CON LAS DIFERENTES REGLAS
									validarReglasNUC(nuc, estatResolucion, mes, anio, nuc, idUnidad, idMp, deten, envioselect);
									////// VALIDAR TODO EL NUC QUE VA ENTRANDO CON LAS DIFERENTES REGLAS										

								}
							}


						}
					}
					ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
					ajax.send("&nuc=" + nuc + "&acc=" + acc + "&estatResolucion=" + estatResolucion);



				}




			}
		}
	}



}




function saveCarpet(idMp, mes, anio, estatResolucion, idUnidad, deten) {



	texto = document.getElementById("nuc").value;
	cantidadinicio = document.getElementById("nuc").value.length;



	if (estatResolucion == 22) { envioselect = document.getElementById("envioselect").value; } else {
		envioselect = 0;
	}


	if (cantidadinicio > 13) {
		var slice2 = texto.slice(0, -1);
		document.getElementById("nuc").value = slice2;
	} else {

		if (cantidadinicio < 13) { } else {

			if (cantidadinicio == 13) {


				if (estatResolucion == 22 && envioselect == 0) { swal("", "Debe seleccionar un motivo.", "warning"); } else {

					if (estatResolucion == 22 && envioselect > 0) {

						nuc = document.getElementById('nuc').value;

						acc = "existeNuc";
						ajax = objetoAjax();
						ajax.open("POST", "carpetas/accionesNucsCarpetas.php");

						ajax.onreadystatechange = function () {
							if (ajax.readyState == 4 && ajax.status == 200) {


								var cadCodificadaJSON = ajax.responseText;
								var objDatos = eval("(" + cadCodificadaJSON + ")");

								if (objDatos.first == "NO") { swal("", "El numero de caso no existe.", "warning"); } else {

									if (objDatos.first == "SI") {

										document.getElementById('btnSaveNuc').disabled = true;

										////// VALIDAR TODO EL NUC QUE VA ENTRANDO CON LAS DIFERENTES REGLAS
										validarReglasNUC(nuc, estatResolucion, mes, anio, nuc, idUnidad, idMp, deten, envioselect);
										////// VALIDAR TODO EL NUC QUE VA ENTRANDO CON LAS DIFERENTES REGLAS										

									}
								}


							}
						}
						ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
						ajax.send("&nuc=" + nuc + "&acc=" + acc + "&estatResolucion=" + estatResolucion);

					} else {


						nuc = document.getElementById('nuc').value;

						acc = "existeNuc";
						ajax = objetoAjax();
						ajax.open("POST", "carpetas/accionesNucsCarpetas.php");

						ajax.onreadystatechange = function () {
							if (ajax.readyState == 4 && ajax.status == 200) {


								var cadCodificadaJSON = ajax.responseText;
								var objDatos = eval("(" + cadCodificadaJSON + ")");

								if (objDatos.first == "NO") { swal("", "El numero de caso no existe.", "warning"); } else {

									if (objDatos.first == "SI") {

										document.getElementById('btnSaveNuc').disabled = true;

										////// VALIDAR TODO EL NUC QUE VA ENTRANDO CON LAS DIFERENTES REGLAS
										validarReglasNUC(nuc, estatResolucion, mes, anio, nuc, idUnidad, idMp, deten, envioselect);
										////// VALIDAR TODO EL NUC QUE VA ENTRANDO CON LAS DIFERENTES REGLAS										

									}
								}


							}
						}
						ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
						ajax.send("&nuc=" + nuc + "&acc=" + acc + "&estatResolucion=" + estatResolucion);


					}

				}




			}
		}
	}






}


function validarReglasNUC(nuc, estatus, mes, anio, nuc, idUnidad, idMp, deten, envioselect) {


	acc = "reglasValidacionV2";
	cont = document.getElementById("contTableNucsV2");
	ajax = objetoAjax();
	ajax.open("POST", "carpetas/accionesNucsCarpetas.php");

	ajax.onreadystatechange = function () {
		if (ajax.readyState == 4 && ajax.status == 200) {



			var cadCodificadaJSON = ajax.responseText;
			var objDatos = eval("(" + cadCodificadaJSON + ")");

			if (objDatos.first == "NOR") {
				swal("", "No se puede ingresar como reiniciado en la primera vez que ingresa a sistema.", "warning");

				clearModalNUcsCarpe();

			} else {

				if (objDatos.first == "SI") {

					document.getElementById('btnSaveNuc').disabled = true;
					insertNucCarpetas(idMp, estatus, mes, anio, nuc, idUnidad, deten, envioselect);

				} else {

					if (objDatos.first == "NOIR") {

						/// OBTENER DATOS DEL NUC DONDE Y QUE ESTATUS TIENE Y QUIEN LO REALIZO Y LA FECHA

						

						swal("", "El NUC debe ser reiniciado para poder ser utilizado. \n\n ULTIMA DETERMINACIÓN \n Ministerio Público: "+objDatos.nombre+'\n Unidad: '+objDatos.unidad+' - '+objDatos.fiscalia+'\n Estatus: '+objDatos.estatus+'\n Fecha: '+objDatos.mes+' - '+objDatos.anio, "warning");
						clearModalNUcsCarpe();
					}

					if (objDatos.first == "NOCF") {

						/// OBTENER DATOS DEL NUC DONDE Y QUIEN LO FINALIZO Y LA FECHA

						swal("", "El NUC no puede ser insertado por que ha finalizado su proceso.\n\n ULTIMA DETERMINACIÓN \n Ministerio Público: "+objDatos.nombre+'\n Unidad: '+objDatos.unidad+' - '+objDatos.fiscalia+'\n Estatus: '+objDatos.estatus+'\n Fecha: '+objDatos.mes+' - '+objDatos.anio, "warning");
						clearModalNUcsCarpe();
					}

					if (objDatos.first == "NOIRN") {

						/// OBTENER DATOS DEL NUC DONDE Y QUIEN LO REINICIO Y LA FECHA

						swal("", "El ultimo Estatus del NUC es Reiniciado, no puede volver a entrar como reiniciado. \n\n ULTIMA DETERMINACIÓN \n Ministerio Público: "+objDatos.nombre+'\n Unidad: '+objDatos.unidad+' - '+objDatos.fiscalia+'\n Estatus: '+objDatos.estatus+'\n Fecha: '+objDatos.mes+' - '+objDatos.anio, "warning");
						clearModalNUcsCarpe();
					}

						if (objDatos.first == "NOIRN") {

						/// OBTENER DATOS DEL NUC DONDE Y QUIEN LO REINICIO Y LA FECHA

						swal("", "El ultimo Estatus del NUC es Reiniciado, no puede volver a entrar como reiniciado. \n\n ULTIMA DETERMINACIÓN \n Ministerio Público: "+objDatos.nombre+'\n Unidad: '+objDatos.unidad+' - '+objDatos.fiscalia+'\n Estatus: '+objDatos.estatus+'\n Fecha: '+objDatos.mes+' - '+objDatos.anio, "warning");
						clearModalNUcsCarpe();
					}

					if (objDatos.first == "NOCMASC") {

						/// OBTENER DATOS DEL NUC DONDE Y QUIEN LO REINICIO Y LA FECHA

						swal("", "El NUC no se ha recibido por el CMASC ", "warning");
						clearModalNUcsCarpe();
					}

					if (objDatos.first == "RECHAZOCMASC") {

						/// OBTENER DATOS DEL NUC DONDE Y QUIEN LO REINICIO Y LA FECHA
						swal("", "El NUC fue rechazado por el CMASC por el siguiente motivo:\n\n "+objDatos.motivoRechazo+'.'+'\n\n Favor de verificar.', "warning");
						clearModalNUcsCarpe();
					}


				}
			}

			//insertNucCarpetas(idMp, estatResolucion, mes, anio, nuc, idUnidad);


		}
	}
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("&acc=" + acc + "&nuc=" + nuc + "&estatus=" + estatus);


}

function clearModalNUcsCarpe() {
	document.getElementById('btnSaveNuc').disabled = false;
	document.getElementById('nuc').value = "";
}

function insertNucCarpetas(idMp, estatResolucion, mes, anio, nuc, idUnidad, deten, envioselect) {


	acc = "insertNucCarpetas";
	ajax = objetoAjax();
	ajax.open("POST", "carpetas/accionesNucsCarpetas.php");

	ajax.onreadystatechange = function () {
		if (ajax.readyState == 4 && ajax.status == 200) {
			//cont.innerHTML = ajax.responseText;

			var cadCodificadaJSON = ajax.responseText;
			var objDatos = eval("(" + cadCodificadaJSON + ")");

			if (objDatos.first == "NO") { swal("", "Hubo un problema al insertar favor de revisar.", "warning"); } else {

				if (objDatos.first == "SI") {

					swal("", "Se Registro Correctamente.", "success");
					updateTableNucsCarpetasV2(idMp, anio, mes, estatResolucion, nuc, idUnidad, deten);
					clearModalNUcsCarpe();

					document.getElementById("contentMotivo").style.display = "none";

				}
			}

		}
	}
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("&nuc=" + nuc + "&acc=" + acc + "&idMp=" + idMp + "&estatResolucion=" + estatResolucion + "&mes=" + mes + "&anio=" + anio + "&idUnidad=" + idUnidad + "&deten=" + deten + "&envioselect=" + envioselect);


}


function updateTableNucsCarpetasV2(idMp, anio, mes, estatResolucion, nuc, idUnidad, deten) {


	acc = "showtableCarpetasNucsV2";
	cont = document.getElementById("contTableNucsV2");
	ajax = objetoAjax();
	ajax.open("POST", "carpetas/accionesNucsCarpetas.php");

	ajax.onreadystatechange = function () {
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("&acc=" + acc + "&idMp=" + idMp + "&estatResolucion=" + estatResolucion + "&mes=" + mes
		+ "&anio=" + anio + "&nuc=" + nuc + "&idUnidad=" + idUnidad + "&deten=" + deten);

}


function deleteCarpetaResolV2(id, idMp, anio, mes, estatResolucion, idUnidad) {


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
		function (isConfirm) {
			if (isConfirm) {

				acc = "deleteResolCarpeV2";
				ajax = objetoAjax();
				ajax.open("POST", "carpetas/accionesNucsCarpetas.php");

				ajax.onreadystatechange = function () {
					if (ajax.readyState == 4 && ajax.status == 200) {

						var cadCodificadaJSON = ajax.responseText;
						var objDatos = eval("(" + cadCodificadaJSON + ")");

						if (objDatos.first == "NO") { swal("", "Hubo un problema al eliminar favor de revisar.", "warning"); } else {

							if (objDatos.first == "SI") {
								nuc = document.getElementById("nuc").value;
								updateTableNucsCarpetasV2(idMp, anio, mes, estatResolucion, nuc, idUnidad);
							}

						}

					}
				}
				ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				ajax.send("&acc=" + acc + "&id=" + id);

			}
		});


}

function saveDataCarpetasV2(mes, anio, idUnidad, idMp) {


	inputCdeten = document.getElementById("inputCdeten").value;
	inputSdeten = document.getElementById("inputSdeten").value;

	reCbreCbOtrUni = document.getElementById("reCbOtrUni").value;

	inputEnvUATP = document.getElementById("inputEnvUATP").value;
	inputEnvUI = document.getElementById("inputEnvUI").value;
	inputEnvImpDesc = document.getElementById("inputEnvImpDesc").value;

	if (inputCdeten != "" && inputSdeten != "" && reCbreCbOtrUni != "" && inputEnvUATP != "" && inputEnvUI != "" && inputEnvImpDesc != "") {

		acc = "insertDataCarpetas";
		ajax = objetoAjax();
		ajax.open("POST", "carpetas/accionesNucsCarpetas.php");
		document.getElementById("btnsavecarp").disabled = true;

		ajax.onreadystatechange = function () {
			if (ajax.readyState == 4 && ajax.status == 200) {
				//cont.innerHTML = ajax.responseText;

				var cadCodificadaJSON = ajax.responseText;
				var objDatos = eval("(" + cadCodificadaJSON + ")");

				if (objDatos.first == "NO") { swal("", "Hubo un problema al actualizar favor de revisar.", "warning"); } else {

					if (objDatos.first == "SI") {

						swal("", "Se actualizo Correctamente.", "success");
						document.getElementById("btnsavecarp").disabled = false;
						updateALLFormCarpe(idMp, anio, mes, idUnidad);
					}
				}

			}
		}
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send("&inputCdeten=" + inputCdeten + "&acc=" + acc + "&idMp=" + idMp + "&inputSdeten=" + inputSdeten + "&mes=" + mes + "&anio=" + anio + "&idUnidad=" + idUnidad + "&reCbreCbOtrUni=" + reCbreCbOtrUni
			+ "&inputEnvUATP=" + inputEnvUATP + "&inputEnvUI=" + inputEnvUI + "&inputEnvImpDesc=" + inputEnvImpDesc);

	} else {

		swal("", "Complete los datos para poder avanzar.", "warning");
	}


}


function updateTotalTrabajar(idMp, anio, mes, idUnidad) {


	acc = "updateTotalTrabajar";
	cont = document.getElementById("totTrabajarContent");
	ajax = objetoAjax();
	ajax.open("POST", "carpetas/accionesNucsCarpetas.php");

	ajax.onreadystatechange = function () {
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("&acc=" + acc + "&idMp=" + idMp + "&mes=" + mes
		+ "&anio=" + anio + "&idUnidad=" + idUnidad);

}

function updateALLFormCarpe(idMp, anio, mes, idUnidad) {


	acc = "updateAllFormCarpetsForm";
	cont = document.getElementById("contentAllCarpetsform");
	ajax = objetoAjax();
	ajax.open("POST", "carpetas/accionesNucsCarpetas.php");

	ajax.onreadystatechange = function () {
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("&acc=" + acc + "&idMp=" + idMp + "&mes=" + mes
		+ "&anio=" + anio + "&idUnidad=" + idUnidad);

}

function modalsavecloseV2(idMp, anio, mes, idUnidad) {


	$('#myModaFormato').modal('show');
	$('#modalNucs').modal('hide');

	updateALLFormCarpe(idMp, anio, mes, idUnidad);

}

function mostrarModalValidacionNUcsV2(validado, idEnlace, mesCapturar, anioCaptura) {


	cont = document.getElementById('contMOdalValidateNucs');

	ajax = objetoAjax();
	ajax.open("POST", "carpetas/modalValidateNucs.php");

	ajax.onreadystatechange = function () {
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("&validado=" + validado + "&idEnlace=" + idEnlace + "&mesCapturar=" + mesCapturar + "&anioCaptura=" + anioCaptura);

}


function enviarDPEvalidatesV2(anio, mes, incorrectReni, idEnlace, format) {



	if (incorrectReni > 0) {


		swal({
			title: "<h4>No se puede enviar por que existen NUCs Reiniciados/Abiertos, favor de revisar.</h4>",
			text: '',
			timer: 3000,
			type: "warning",
			showCancelButton: false,
			showConfirmButton: false,
			html: true
		});



		setTimeout("location.href = 'index.php?format=" + format + "';", 3000);


	} else {

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
			function (isConfirm) {
				if (isConfirm) {

					ajax = objetoAjax();
					ajax.open("POST", "carpetas/actualizarEnviado.php");
					ajax.onreadystatechange = function () {
						if (ajax.readyState == 4 && ajax.status == 200) {
							var json = ajax.responseText;
							var obj = eval("(" + json + ")");
							if (obj.first == "NO") { swal("", "No se envió verifique los datos.", "warning"); } else {
								if (obj.first == "SI") {
									swal("", "Tu información ha sido enviada.", "success");
									//descargar(format, idUnidad, mes, anio, idEnlace);
									setTimeout("location.href = 'index.php?format=" + format + "';", 400);
								}
							}
						}
					}
					ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
					ajax.send('&idEnlace=' + idEnlace + '&format=' + format);
				}
			});
	}

}


function cargaContHistoricoEnlaceDatosV2(idUsuario, idEnlace, format, idUnidad) {


	cont = document.getElementById('contenido');
	ajax = objetoAjax();
	ajax.open("POST", "repositorio/historicoEnlaceDatos.php");

	ajax.onreadystatechange = function () {
		if (ajax.readyState == 4 && ajax.status == 200) {

			cont.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send("&idUsuario=" + idUsuario + "&idEnlace=" + idEnlace + "&format=" + format + "&idUnidad=" + idUnidad);
}


