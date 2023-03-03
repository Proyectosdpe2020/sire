function loadDataProcesosPenalesJuzgados() {

var idFiscalia = document.getElementById("fiscaliaJuzgado").value;
	$.ajax({
		url: 'format/procesosPenales/selectJuzgadosProcesos.php?idFiscalia=' + idFiscalia,
		type: 'POST',
		contentType: false,
		processData: false,
		cache: false
	}).done(function (respuesta) {
		$("#contentSelectJuzgadosProceso").html(respuesta);
		loadDataProcesosPenales();
	});

}

function enviarDPEprocesos(idEnlace, format) {

	var mes = document.getElementById("textMesCapturando").value;
	var anio = document.getElementById("textAnioCapturando").value;

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
				ajax.open("POST", "formatos/actualizarEnviado.php");
				ajax.onreadystatechange = function () {
					if (ajax.readyState == 4 && ajax.status == 200) {
						var json = ajax.responseText;
						var obj = eval("(" + json + ")");
						if (obj.first == "NO") { swal("", "No se envió verifique los datos.", "warning"); } else {
							if (obj.first == "SI") {
								saveDataProcesos(1, idEnlace, mes, anio)
								swal("", "Tu información ha sido enviada.", "success");
								setTimeout("location.href = 'procesosPenales';", 500);
							}
						}
					}
				}
				ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				ajax.send('&idEnlace=' + idEnlace + '&format=' + format);
			}
		});

}

function descargarDocProcesoPenales() {

	var mesIni = document.getElementById("mesIni").value;
	var anioIni = document.getElementById("anioIni").value;
	var mesFin = document.getElementById("mesFin").value;
	var anioFin = document.getElementById("anioFin").value;
	var idFiscalia = document.getElementById("fiscaliaJuzgado").value;
	var juzgado = document.getElementById("juzgado").value;

	document.getElementById('laodimgmain').style.display = "block";

	$.ajax({
		url: 'format/procesosPenales/descargar.php?idFiscalia=' + idFiscalia + '&juzgado=' + juzgado + '&mesIni=' + mesIni + '&anioIni=' + anioIni + '&mesFin=' + mesFin + '&anioFin=' + anioFin,
		type: 'POST',
		contentType: false,
		processData: false,
		cache: false
	}).done(function (respuesta) {
		$("#rsp").html(respuesta);
		document.getElementById('laodimgmain').style.display = "none";
		var nombrereporte = "ProcesosPenalesAcumulado-" + idFiscalia + juzgado + "-" + mesIni + anioIni + "-" + mesFin + anioFin;
		document.location.href = "format/procesosPenales/downloadReportProcesosPenales/" + nombrereporte + ".xlsx";
	});

}

function loadDataProcesosPenales() {

	var mAc = document.getElementById("mesActCaptu").value;
	var aAc = document.getElementById("anioActCaptu").value;
	var capt = 0;
	var idFiscalia = document.getElementById("fiscaliaJuzgado").value;
	var juzgado = document.getElementById("juzgado").value;

	var mesIni = document.getElementById("mesIni").value;
	var anioIni = document.getElementById("anioIni").value;

	var mesFin = document.getElementById("mesFin").value;
	var anioFin = document.getElementById("anioFin").value;
	var idEnlace = document.getElementById("idEnlacin").value;

	if (mAc == mesIni && mAc == mesFin && aAc == anioFin && aAc == anioIni) {
		capt = 1;
	} else { capt = 0; }

	document.getElementById('laodimgmain').style.display = "block";

	$.ajax({
		url: 'format/procesosPenales/procesosPenalesLoad.php?idFiscalia=' + idFiscalia + '&juzgado=' + juzgado + '&mesIni=' + mesIni
			+ '&anioIni=' + anioIni + '&mesFin=' + mesFin + '&anioFin=' + anioFin + '&capt=' + capt + '&idEnlace=' + idEnlace + '&mAc=' + mAc + '&aAc=' + aAc,
		type: 'POST',
		contentType: false,
		processData: false,
		cache: false
	}).done(function (respuesta) {
		$("#mainContentForm").html(respuesta);
		document.getElementById('laodimgmain').style.display = "none";
	});

}


function saveDataProcesos(form, idEnlace, mes, anio) {

	var idFiscalia = document.getElementById("fiscaliaJuzgado").value;
	var idJuzgado = document.getElementById("juzgado").value;

	if (form == 1) {
		var p1 = document.getElementById("p1").value;
		var p3 = document.getElementById("p3").value;
		var p4 = document.getElementById("p4").value;
		var p5 = document.getElementById("p5").value;
		if (p1 == "") { p1 = 0; }
		if (p3 == "") { p3 = 0; }
		if (p4 == "") { p4 = 0; }
		if (p5 == "") { p5 = 0; }

		$.ajax({
			url: 'format/procesosPenales/save.php?idFiscalia=' + idFiscalia + '&form=' + form + '&idJuzgado=' + idJuzgado + '&mes='
				+ mes + '&anio=' + anio + '&idEnlace=' + idEnlace + '&p3=' + p3 + '&p4=' + p4 + '&p5=' + p5 + '&p1=' + p1,
			type: 'POST',
			contentType: false,
			processData: false,
			cache: false
		}).done(function (respuesta) {
			//$("#respuestine").html(respuesta);
			var json = respuesta;
			var obj = eval("(" + json + ")");
			if (obj.first == "NO") {
				swal("", "No se registro verifique los datos.", "warning");
			} else {
				if (obj.first == "SI") {
					var obj = eval("(" + json + ")");
					swal("", "Información guardada exitosamente.", "success");
					//loadDataSalasPenales();
					loadDataProcesosPenales();
				}
			}
		});
	}

	if (form == 2) {
		var p6 = document.getElementById("p6").value;
		var p7 = document.getElementById("p7").value;
		var p8 = document.getElementById("p8").value;
		var p9 = document.getElementById("p9").value;
		var p10 = document.getElementById("p10").value;
		var p11 = document.getElementById("p11").value;
		var p12 = document.getElementById("p12").value;
		if (p6 == "") { p6 = 0; }
		if (p7 == "") { p7 = 0; }
		if (p8 == "") { p8 = 0; }
		if (p9 == "") { p9 = 0; }
		if (p10 == "") { p10 = 0; }
		if (p11 == "") { p11 = 0; }
		if (p12 == "") { p12 = 0; }


		$.ajax({
			url: 'format/procesosPenales/save.php?idFiscalia=' + idFiscalia + '&form=' + form + '&idJuzgado=' + idJuzgado + '&mes=' + mes + '&anio=' + anio + '&idEnlace=' + idEnlace
				+ '&p6=' + p6 + '&p7=' + p7 + '&p8=' + p8 + '&p9=' + p9 + '&p10=' + p10 + '&p11=' + p11 + '&p12=' + p12,
			type: 'POST',
			contentType: false,
			processData: false,
			cache: false
		}).done(function (respuesta) {
			//$("#respuestine").html(respuesta);
			var json = respuesta;
			var obj = eval("(" + json + ")");
			if (obj.first == "NO") {
				swal("", "No se registro verifique los datos.", "warning");
			} else {
				if (obj.first == "SI") {
					var obj = eval("(" + json + ")");
					swal("", "Información guardada exitosamente.", "success");
					//loadDataSalasPenales();
					loadDataProcesosPenales();
				}
			}

		});
	}

	if (form == 3) {
		var p13 = document.getElementById("p13").value;
		var p14 = document.getElementById("p14").value;
		var p15 = document.getElementById("p15").value;
		var p16 = document.getElementById("p16").value;
		var p17 = document.getElementById("p17").value;
		var p18 = document.getElementById("p18").value;
		var p19 = document.getElementById("p19").value;
		var p20 = document.getElementById("p20").value;
		if (p13 == "") { p13 = 0; }
		if (p14 == "") { p14 = 0; }
		if (p15 == "") { p15 = 0; }
		if (p16 == "") { p16 = 0; }
		if (p17 == "") { p17 = 0; }
		if (p18 == "") { p18 = 0; }
		if (p19 == "") { p19 = 0; }
		if (p20 == "") { p20 = 0; }

		$.ajax({
			url: 'format/procesosPenales/save.php?idFiscalia=' + idFiscalia + '&form=' + form + '&idJuzgado=' + idJuzgado + '&mes=' + mes + '&anio=' + anio + '&idEnlace=' + idEnlace
				+ '&p13=' + p13 + '&p14=' + p14 + '&p15=' + p15 + '&p16=' + p16 + '&p17=' + p17 + '&p18=' + p18 + '&p19=' + p19 + '&p20=' + p20,
			type: 'POST',
			contentType: false,
			processData: false,
			cache: false
		}).done(function (respuesta) {
			//$("#respuestine").html(respuesta);
			var json = respuesta;
			var obj = eval("(" + json + ")");
			if (obj.first == "NO") {
				swal("", "No se registro verifique los datos.", "warning");
			} else {
				if (obj.first == "SI") {
					var obj = eval("(" + json + ")");
					swal("", "Información guardada exitosamente.", "success");
					//loadDataSalasPenales();
					loadDataProcesosPenales();
				}
			}
		});
	}

	if (form == 4) {
		var p21 = document.getElementById("p21").value;
		var p22 = document.getElementById("p22").value;
		var p23 = document.getElementById("p23").value;
		var p24 = document.getElementById("p24").value;
		var p25 = document.getElementById("p25").value;
		var p26 = document.getElementById("p26").value;
		if (p21 == "") { p21 = 0; }
		if (p22 == "") { p22 = 0; }
		if (p23 == "") { p23 = 0; }
		if (p24 == "") { p24 = 0; }
		if (p25 == "") { p25 = 0; }
		if (p26 == "") { p26 = 0; }

		$.ajax({
			url: 'format/procesosPenales/save.php?idFiscalia=' + idFiscalia + '&form=' + form + '&idJuzgado=' + idJuzgado + '&mes=' + mes + '&anio=' + anio + '&idEnlace=' + idEnlace
				+ '&p21=' + p21 + '&p22=' + p22 + '&p23=' + p23 + '&p24=' + p24 + '&p25=' + p25 + '&p26=' + p26,
			type: 'POST',
			contentType: false,
			processData: false,
			cache: false
		}).done(function (respuesta) {
			//$("#respuestine").html(respuesta);
			var json = respuesta;
			var obj = eval("(" + json + ")");
			if (obj.first == "NO") {
				swal("", "No se registro verifique los datos.", "warning");
			} else {
				if (obj.first == "SI") {
					var obj = eval("(" + json + ")");
					swal("", "Información guardada exitosamente.", "success");
					//loadDataSalasPenales();
					loadDataProcesosPenales();
				}
			}
		});
	}

	if (form == 5) {
		var p27 = document.getElementById("p27").value;
		var p28 = document.getElementById("p28").value;
		var p29 = document.getElementById("p29").value;
		var p30 = document.getElementById("p30").value;
		var p31 = document.getElementById("p31").value;
		var p32 = document.getElementById("p32").value;
		var p33 = document.getElementById("p33").value;
		var p34 = document.getElementById("p34").value;
		var p35 = document.getElementById("p35").value;
		var p36 = document.getElementById("p36").value;
		var p37 = document.getElementById("p37").value;
		var p38 = document.getElementById("p38").value;
		if (p27 == "") { p27 = 0; }
		if (p28 == "") { p28 = 0; }
		if (p29 == "") { p29 = 0; }
		if (p30 == "") { p30 = 0; }
		if (p31 == "") { p31 = 0; }
		if (p32 == "") { p32 = 0; }
		if (p33 == "") { p33 = 0; }
		if (p34 == "") { p34 = 0; }
		if (p35 == "") { p35 = 0; }
		if (p36 == "") { p36 = 0; }
		if (p37 == "") { p37 = 0; }
		if (p38 == "") { p38 = 0; }

		$.ajax({
			url: 'format/procesosPenales/save.php?idFiscalia=' + idFiscalia + '&form=' + form + '&idJuzgado=' + idJuzgado + '&mes=' + mes + '&anio=' + anio + '&idEnlace=' + idEnlace
				+ '&p27=' + p27 + '&p28=' + p28 + '&p29=' + p29 + '&p30=' + p30 + '&p31=' + p31 + '&p32=' + p32 + '&p33='
				+ p33 + '&p34=' + p34 + '&p35=' + p35 + '&p36=' + p36 + '&p37=' + p37 + '&p38=' + p38,
			type: 'POST',
			contentType: false,
			processData: false,
			cache: false
		}).done(function (respuesta) {
			//$("#respuestine").html(respuesta);
			var json = respuesta;
			var obj = eval("(" + json + ")");
			if (obj.first == "NO") {
				swal("", "No se registro verifique los datos.", "warning");
			} else {
				if (obj.first == "SI") {
					var obj = eval("(" + json + ")");
					swal("", "Información guardada exitosamente.", "success");
					//loadDataSalasPenales();
					loadDataProcesosPenales();
				}
			}
		});
	}

	if (form == 6) {
		var p39 = document.getElementById("p39").value;
		var p40 = document.getElementById("p40").value;
		var p41 = document.getElementById("p41").value;
		var p42 = document.getElementById("p42").value;
		var p43 = document.getElementById("p43").value;
		var p44 = document.getElementById("p44").value;
		if (p39 == "") { p39 = 0; }
		if (p40 == "") { p40 = 0; }
		if (p41 == "") { p41 = 0; }
		if (p42 == "") { p42 = 0; }
		if (p43 == "") { p43 = 0; }
		if (p44 == "") { p44 = 0; }

		$.ajax({
			url: 'format/procesosPenales/save.php?idFiscalia=' + idFiscalia + '&form=' + form + '&idJuzgado=' + idJuzgado + '&mes=' + mes + '&anio=' + anio + '&idEnlace=' + idEnlace
				+ '&p39=' + p39 + '&p40=' + p40 + '&p41=' + p41 + '&p42=' + p42 + '&p43=' + p43 + '&p44=' + p44,
			type: 'POST',
			contentType: false,
			processData: false,
			cache: false
		}).done(function (respuesta) {
			//$("#respuestine").html(respuesta);
			var json = respuesta;
			var obj = eval("(" + json + ")");
			if (obj.first == "NO") {
				swal("", "No se registro verifique los datos.", "warning");
			} else {
				if (obj.first == "SI") {
					var obj = eval("(" + json + ")");
					swal("", "Información guardada exitosamente.", "success");
					//loadDataSalasPenales();
					loadDataProcesosPenales();
				}
			}
		});
	}

	if (form == 7) {
		var p45 = document.getElementById("p45").value;
		var p46 = document.getElementById("p46").value;
		if (p45 == "") { p45 = 0; }
		if (p46 == "") { p46 = 0; }

		$.ajax({
			url: 'format/procesosPenales/save.php?idFiscalia=' + idFiscalia + '&form=' + form + '&idJuzgado=' + idJuzgado + '&mes=' + mes + '&anio=' + anio + '&idEnlace=' + idEnlace + '&p45=' + p45 + '&p46=' + p46,
			type: 'POST',
			contentType: false,
			processData: false,
			cache: false
		}).done(function (respuesta) {
			//$("#respuestine").html(respuesta);
			var json = respuesta;
			var obj = eval("(" + json + ")");
			if (obj.first == "NO") {
				swal("", "No se registro verifique los datos.", "warning");
			} else {
				if (obj.first == "SI") {
					var obj = eval("(" + json + ")");
					swal("", "Información guardada exitosamente.", "success");
					//loadDataSalasPenales();
					loadDataProcesosPenales();
				}
			}
		});
	}

	if (form == 8) {
		var p47 = document.getElementById("p47").value;
		var p48 = document.getElementById("p48").value;
		var p49 = document.getElementById("p49").value;
		var p50 = document.getElementById("p50").value;
		var p51 = document.getElementById("p51").value;
		var p52 = document.getElementById("p52").value;
		var p53 = document.getElementById("p53").value;
		var p54 = document.getElementById("p54").value;
		if (p47 == "") { p47 = 0; }
		if (p48 == "") { p48 = 0; }
		if (p49 == "") { p49 = 0; }
		if (p50 == "") { p50 = 0; }
		if (p51 == "") { p51 = 0; }
		if (p52 == "") { p52 = 0; }
		if (p53 == "") { p53 = 0; }
		if (p54 == "") { p54 = 0; }

		$.ajax({
			url: 'format/procesosPenales/save.php?idFiscalia=' + idFiscalia + '&form=' + form + '&idJuzgado=' + idJuzgado + '&mes=' + mes + '&anio=' + anio + '&idEnlace=' + idEnlace
				+ '&p47=' + p47 + '&p48=' + p48 + '&p49=' + p49 + '&p50=' + p50 + '&p51=' + p51 + '&p52=' + p52 + '&p53=' + p53 + '&p54=' + p54,
			type: 'POST',
			contentType: false,
			processData: false,
			cache: false
		}).done(function (respuesta) {
			//$("#respuestine").html(respuesta);
			var json = respuesta;
			var obj = eval("(" + json + ")");
			if (obj.first == "NO") {
				swal("", "No se registro verifique los datos.", "warning");
			} else {
				if (obj.first == "SI") {
					var obj = eval("(" + json + ")");
					swal("", "Información guardada exitosamente.", "success");
					//loadDataSalasPenales();
					loadDataProcesosPenales();
				}
			}
		});
	}

	if (form == 9) {
		var p55 = document.getElementById("p55").value;
		var p56 = document.getElementById("p56").value;
		var p57 = document.getElementById("p57").value;
		var p58 = document.getElementById("p58").value;
		if (p55 == "") { p55 = 0; }
		if (p56 == "") { p56 = 0; }
		if (p57 == "") { p57 = 0; }
		if (p58 == "") { p58 = 0; }

		$.ajax({
			url: 'format/procesosPenales/save.php?idFiscalia=' + idFiscalia + '&form=' + form + '&idJuzgado=' + idJuzgado + '&mes=' + mes + '&anio=' + anio
				+ '&idEnlace=' + idEnlace + '&p55=' + p55 + '&p56=' + p56 + '&p57=' + p57 + '&p58=' + p58,
			type: 'POST',
			contentType: false,
			processData: false,
			cache: false
		}).done(function (respuesta) {
			//$("#respuestine").html(respuesta);
			var json = respuesta;
			var obj = eval("(" + json + ")");
			if (obj.first == "NO") {
				swal("", "No se registro verifique los datos.", "warning");
			} else {
				if (obj.first == "SI") {
					var obj = eval("(" + json + ")");
					swal("", "Información guardada exitosamente.", "success");
					//loadDataSalasPenales();
					loadDataProcesosPenales();
				}
			}
		});
	}

	if (form == 10) {
		var p59 = document.getElementById("p59").value;
		var p60 = document.getElementById("p60").value;
		if (p59 == "") { p59 = 0; }
		if (p60 == "") { p60 = 0; }

		$.ajax({
			url: 'format/procesosPenales/save.php?idFiscalia=' + idFiscalia + '&form=' + form + '&idJuzgado=' + idJuzgado + '&mes='
				+ mes + '&anio=' + anio + '&idEnlace=' + idEnlace + '&p59=' + p59 + '&p60=' + p60,
			type: 'POST',
			contentType: false,
			processData: false,
			cache: false
		}).done(function (respuesta) {
			//$("#respuestine").html(respuesta);
			var json = respuesta;
			var obj = eval("(" + json + ")");
			if (obj.first == "NO") {
				swal("", "No se registro verifique los datos.", "warning");
			} else {
				if (obj.first == "SI") {
					var obj = eval("(" + json + ")");
					swal("", "Información guardada exitosamente.", "success");
					//loadDataSalasPenales();
					loadDataProcesosPenales();
				}
			}
		});
	}

	if (form == 11) {
		var p62 = document.getElementById("p62").value;
		var p63 = document.getElementById("p63").value;
		var p64 = document.getElementById("p64").value;
		if (p62 == "") { p62 = 0; }
		if (p63 == "") { p63 = 0; }
		if (p64 == "") { p64 = 0; }

		$.ajax({
			url: 'format/procesosPenales/save.php?idFiscalia=' + idFiscalia + '&form=' + form + '&idJuzgado=' + idJuzgado + '&mes=' + mes + '&anio=' + anio
				+ '&idEnlace=' + idEnlace + '&p62=' + p62 + '&p63=' + p63 + '&p64=' + p64,
			type: 'POST',
			contentType: false,
			processData: false,
			cache: false
		}).done(function (respuesta) {
			//$("#respuestine").html(respuesta);
			var json = respuesta;
			var obj = eval("(" + json + ")");
			if (obj.first == "NO") {
				swal("", "No se registro verifique los datos.", "warning");
			} else {
				if (obj.first == "SI") {
					var obj = eval("(" + json + ")");
					swal("", "Información guardada exitosamente.", "success");
					//loadDataSalasPenales();
					loadDataProcesosPenales();
				}
			}
		});
	}

	if (form == 12) {
		var p66 = document.getElementById("p66").value;
		var p67 = document.getElementById("p67").value;
		var p68 = document.getElementById("p68").value;
		var p69 = document.getElementById("p69").value;
		var p70 = document.getElementById("p70").value;
		var p71 = document.getElementById("p71").value;
		var p72 = document.getElementById("p72").value;
		var p73 = document.getElementById("p73").value;
		var p74 = document.getElementById("p74").value;
		if (p66 == "") { p66 = 0; }
		if (p67 == "") { p67 = 0; }
		if (p68 == "") { p68 = 0; }
		if (p69 == "") { p69 = 0; }
		if (p70 == "") { p70 = 0; }
		if (p71 == "") { p71 = 0; }
		if (p72 == "") { p72 = 0; }
		if (p73 == "") { p73 = 0; }
		if (p74 == "") { p74 = 0; }

		$.ajax({
			url: 'format/procesosPenales/save.php?idFiscalia=' + idFiscalia + '&form=' + form + '&idJuzgado=' + idJuzgado + '&mes=' + mes + '&anio=' + anio + '&idEnlace=' + idEnlace
				+ '&p66=' + p66 + '&p67=' + p67 + '&p68=' + p68 + '&p69=' + p69 + '&p70=' + p70 + '&p71=' + p71 + '&p72=' + p72 + '&p73=' + p73 + '&p74=' + p74,
			type: 'POST',
			contentType: false,
			processData: false,
			cache: false
		}).done(function (respuesta) {
			//$("#respuestine").html(respuesta);
			var json = respuesta;
			var obj = eval("(" + json + ")");
			if (obj.first == "NO") {
				swal("", "No se registro verifique los datos.", "warning");
			} else {
				if (obj.first == "SI") {
					var obj = eval("(" + json + ")");
					swal("", "Información guardada exitosamente.", "success");
					//loadDataSalasPenales();
					loadDataProcesosPenales();
				}
			}
		});
	}

	if (form == 13) {
		var p76 = document.getElementById("p76").value;
		var p77 = document.getElementById("p77").value;
		var p78 = document.getElementById("p78").value;
		var p79 = document.getElementById("p79").value;
		var p80 = document.getElementById("p80").value;
		var p81 = document.getElementById("p81").value;
		if (p76 == "") { p76 = 0; }
		if (p77 == "") { p77 = 0; }
		if (p78 == "") { p78 = 0; }
		if (p79 == "") { p79 = 0; }
		if (p80 == "") { p80 = 0; }
		if (p81 == "") { p81 = 0; }

		$.ajax({
			url: 'format/procesosPenales/save.php?idFiscalia=' + idFiscalia + '&form=' + form + '&idJuzgado=' + idJuzgado + '&mes=' + mes + '&anio=' + anio + '&idEnlace=' + idEnlace
				+ '&p76=' + p76 + '&p77=' + p77 + '&p78=' + p78 + '&p79=' + p79 + '&p80=' + p80 + '&p81=' + p81,
			type: 'POST',
			contentType: false,
			processData: false,
			cache: false
		}).done(function (respuesta) {
			//$("#respuestine").html(respuesta);
			var json = respuesta;
			var obj = eval("(" + json + ")");
			if (obj.first == "NO") {
				swal("", "No se registro verifique los datos.", "warning");
			} else {
				if (obj.first == "SI") {
					var obj = eval("(" + json + ")");
					swal("", "Información guardada exitosamente.", "success");
					//loadDataSalasPenales();
					loadDataProcesosPenales();
				}
			}
		});
	}

}