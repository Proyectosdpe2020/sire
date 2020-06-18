

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

function guardarRecibidas(idEnlace){


		taRec = document.getElementById("taRec").value;
		atOrdi = document.getElementById("atOrdi").value;
		atRepro = document.getElementById("atRepro").value;
		uiOrdi = document.getElementById("uiOrdi").value;
		uiRepro = document.getElementById("uiRepro").value;
		feaaiOrdi = document.getElementById("feaaiOrdi").value;
		feaaiRepro = document.getElementById("feaaiRepro").value;
		feavfgOrdi = document.getElementById("feavfgOrdi").value;
		feavfgRepro = document.getElementById("feavfgRepro").value;
		aicOrdi = document.getElementById("aicOrdi").value;
		aicRepro = document.getElementById("aicRepro").value;
		procedentes = document.getElementById("procedentes").value;
		desechadas = document.getElementById("desechadas").value;
		svhom = document.getElementById("svhom").value;
		svmuj = document.getElementById("svmuj").value;
		sihom = document.getElementById("sihom").value;
		simuj = document.getElementById("simuj").value;
		numInvRec = document.getElementById("numInvRec").value;


		if( taRec == "" || atOrdi == "" || atRepro == "" || uiOrdi == "" || uiRepro == "" || feaaiOrdi == "" || feaaiRepro == "" || feavfgOrdi == "" || feavfgRepro == "" 
								|| aicOrdi == "" || aicRepro == "" || procedentes == "" || desechadas == "" || svhom == "" || svmuj == "" || sihom == "" || simuj == "" || numInvRec == ""){ sweetAlert("", "Faltan datos por completar.", "warning"); }
			else
			{ 

				totalRecibidas = parseInt(document.getElementById("totalRecibidas").value);

				prode = parseInt(procedentes) + parseInt(desechadas);

				if(prode != totalRecibidas){ sweetAlert("", "Los información no coincide favor de verificar.", "warning"); }else{

				
						cont = document.getElementById('contentTabs');

						////// VALORES A ENVIAR /////


						var anio = document.getElementById("anioCmasc").value;
						var mes = document.getElementById("mesCmasc").value;

						ajax=objetoAjax();
						ajax.open("POST", "format/cmasc/guardarRecibidas.php");

						ajax.onreadystatechange = function(){
							if (ajax.readyState == 4 && ajax.status == 200) {
								//cont.innerHTML = ajax.responseText;
								 var json = ajax.responseText;
									var obj = eval("(" + json + ")");
									if (obj.first == "NO") { swal("", "No se guardo verifique los datos.", "warning"); }else{
										 if (obj.first == "SI") {                    
												swal("", "Guardado Exitosamente.", "success");
												setTimeout("location.href = 'index.php';",800);
										 }
									}

							}
						}
						ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
						ajax.send("&idEnlace="+idEnlace+"&anio="+anio+"&mes="+mes+"&taRec="+taRec+"&atOrdi="+atOrdi+"&atRepro="+atRepro+"&uiOrdi="+uiOrdi+"&uiRepro="
							+uiRepro+"&feaaiOrdi="+feaaiOrdi+"&feaaiRepro="+feaaiRepro+"&feavfgOrdi="+feavfgOrdi+"&feavfgRepro="+feavfgRepro+"&aicOrdi="+aicOrdi+"&aicRepro="+aicRepro
							+"&procedentes="+procedentes+"&desechadas="+desechadas+"&svhom="+svhom+"&svmuj="+svmuj+"&sihom="+sihom+"&simuj="+simuj+"&numInvRec="+numInvRec);


				}

	}



}

function sumTotRecibidas(){

		atOrdi = document.getElementById("atOrdi").value;   	if( atOrdi == "" ){ atOrdi = 0; }else { atOrdi = parseInt(document.getElementById("atOrdi").value);  } 
		atRepro = document.getElementById("atRepro").value;     	if( atRepro == "" ){ atRepro = 0; } else { atRepro = parseInt(document.getElementById("atRepro").value);   }
		uiOrdi = document.getElementById("uiOrdi").value;    	if( uiOrdi == "" ){ uiOrdi = 0; }  else { uiOrdi = parseInt(document.getElementById("uiOrdi").value); }
		uiRepro = document.getElementById("uiRepro").value;  	if( uiRepro == "" ){ uiRepro = 0; } else { uiRepro = parseInt(document.getElementById("uiRepro").value); }
		feaaiOrdi = document.getElementById("feaaiOrdi").value;  	if( feaaiOrdi == "" ){ feaaiOrdi = 0; } else { feaaiOrdi = parseInt(document.getElementById("feaaiOrdi").value); }
		feaaiRepro = document.getElementById("feaaiRepro").value;  	if( feaaiRepro == "" ){ feaaiRepro = 0; } else { feaaiRepro = parseInt(document.getElementById("feaaiRepro").value); }
		feavfgOrdi = document.getElementById("feavfgOrdi").value;  	if( feavfgOrdi == "" ){ feavfgOrdi = 0; } else { feavfgOrdi = parseInt(document.getElementById("feavfgOrdi").value);  }
		feavfgRepro = document.getElementById("feavfgRepro").value;   	if( feavfgRepro == "" ){ feavfgRepro = 0; } else { feavfgRepro = parseInt(document.getElementById("feavfgRepro").value); }
		aicOrdi =document.getElementById("aicOrdi").value;  	if( aicOrdi == "" ){ aicOrdi = 0; } else { aicOrdi = parseInt(document.getElementById("aicOrdi").value); }
		aicRepro = document.getElementById("aicRepro").value;  	if( aicRepro == "" ){ aicRepro = 0; } else { aicRepro = parseInt(document.getElementById("aicRepro").value); }

		var final = atOrdi  + atRepro + uiOrdi + uiRepro + feaaiOrdi + feaaiRepro + feavfgOrdi + feavfgRepro + aicOrdi + aicRepro;
		document.getElementById("totalRecibidas").value = final;
		sumarTramiteFinal();
}

function sumarTramiteFinal(){


		taRec = document.getElementById("taRec").value;   	if( taRec == "" ){ taRec = 0; }else { taRec = parseInt(document.getElementById("taRec").value);  } 	
		atOrdi = document.getElementById("atOrdi").value;   	if( atOrdi == "" ){ atOrdi = 0; }else { atOrdi = parseInt(document.getElementById("atOrdi").value);  } 
		atRepro = document.getElementById("atRepro").value;     	if( atRepro == "" ){ atRepro = 0; } else { atRepro = parseInt(document.getElementById("atRepro").value);   }
		uiOrdi = document.getElementById("uiOrdi").value;    	if( uiOrdi == "" ){ uiOrdi = 0; }  else { uiOrdi = parseInt(document.getElementById("uiOrdi").value); }
		uiRepro = document.getElementById("uiRepro").value;  	if( uiRepro == "" ){ uiRepro = 0; } else { uiRepro = parseInt(document.getElementById("uiRepro").value); }
		feaaiOrdi = document.getElementById("feaaiOrdi").value;  	if( feaaiOrdi == "" ){ feaaiOrdi = 0; } else { feaaiOrdi = parseInt(document.getElementById("feaaiOrdi").value); }
		feaaiRepro = document.getElementById("feaaiRepro").value;  	if( feaaiRepro == "" ){ feaaiRepro = 0; } else { feaaiRepro = parseInt(document.getElementById("feaaiRepro").value); }
		feavfgOrdi = document.getElementById("feavfgOrdi").value;  	if( feavfgOrdi == "" ){ feavfgOrdi = 0; } else { feavfgOrdi = parseInt(document.getElementById("feavfgOrdi").value);  }
		feavfgRepro = document.getElementById("feavfgRepro").value;   	if( feavfgRepro == "" ){ feavfgRepro = 0; } else { feavfgRepro = parseInt(document.getElementById("feavfgRepro").value); }
		aicOrdi =document.getElementById("aicOrdi").value;  	if( aicOrdi == "" ){ aicOrdi = 0; } else { aicOrdi = parseInt(document.getElementById("aicOrdi").value); }
		aicRepro = document.getElementById("aicRepro").value;  	if( aicRepro == "" ){ aicRepro = 0; } else { aicRepro = parseInt(document.getElementById("aicRepro").value); }

		var tramiteFinalCmasc = atOrdi  + atRepro + uiOrdi + uiRepro + feaaiOrdi + feaaiRepro + feavfgOrdi + feavfgRepro + aicOrdi + aicRepro + taRec;
		document.getElementById("tramiteFinalCmasc").value = tramiteFinalCmasc;

}


//////// SCRIPTS PARA GUARDAR LOS ACUERDOS ( MEDIACION Y CONCILIACION )


function guardarAcuerdos(idEnlace){


		maiCumplido = document.getElementById("maiCumplido").value;
		maiNoCumplido = document.getElementById("maiNoCumplido").value;
		maiPconvenio = document.getElementById("maiPconvenio").value;
		madCumplido = document.getElementById("madCumplido").value;
		madNoCumplido = document.getElementById("madNoCumplido").value;
		madTramite = document.getElementById("madTramite").value;
		msaNoaConveVictima = document.getElementById("msaNoaConveVictima").value;
		msaNoaConceImputado = document.getElementById("msaNoaConceImputado").value;
		msaDecsiPartes = document.getElementById("msaDecsiPartes").value;
		msaInasInparVictima = document.getElementById("msaInasInparVictima").value;
		msaInasInparImputado = document.getElementById("msaInasInparImputado").value;
		msaNegparVictima = document.getElementById("msaNegparVictima").value;
		msaNegparImputado = document.getElementById("msaNegparImputado").value;
		totalMediacion = document.getElementById("totalMediacion").value;
		caiCumplido = document.getElementById("caiCumplido").value;
		caiNoCumplido = document.getElementById("caiNoCumplido").value;
		caiPconvenio = document.getElementById("caiPconvenio").value;
		cadCumplido = document.getElementById("cadCumplido").value;
		cadNoCumplido = document.getElementById("cadNoCumplido").value;		
		cadTramite = document.getElementById("cadTramite").value;
		csaDecsiPartes = document.getElementById("csaDecsiPartes").value;
		csaInasInparAmbas = document.getElementById("csaInasInparAmbas").value;
		csaDosInasIn1parVictima = document.getElementById("csaDosInasIn1parVictima").value;
		csaDosInasIn1parImputado = document.getElementById("csaDosInasIn1parImputado").value;
		csaNegparVictima = document.getElementById("csaNegparVictima").value;
		csaNegparImputado = document.getElementById("csaNegparImputado").value;
		totalConciliacion = document.getElementById("totalConciliacion").value;



		if( taRec == "" || atOrdi == "" || atRepro == "" || uiOrdi == "" || uiRepro == "" || feaaiOrdi == "" || feaaiRepro == "" || feavfgOrdi == "" || feavfgRepro == "" 
								|| aicOrdi == "" || aicRepro == "" || procedentes == "" || desechadas == "" || svhom == "" || svmuj == "" || sihom == "" || simuj == "" || numInvRec == ""){ sweetAlert("", "Faltan datos por completar.", "warning"); }
			else
			{ 

				totalRecibidas = parseInt(document.getElementById("totalRecibidas").value);

				prode = parseInt(procedentes) + parseInt(desechadas);

				if(prode != totalRecibidas){ sweetAlert("", "Los información no coincide favor de verificar.", "warning"); }else{

				
						cont = document.getElementById('contentTabs');

						////// VALORES A ENVIAR /////


						var anio = document.getElementById("anioCmasc").value;
						var mes = document.getElementById("mesCmasc").value;

						ajax=objetoAjax();
						ajax.open("POST", "format/cmasc/guardarRecibidas.php");

						ajax.onreadystatechange = function(){
							if (ajax.readyState == 4 && ajax.status == 200) {
								//cont.innerHTML = ajax.responseText;
								 var json = ajax.responseText;
									var obj = eval("(" + json + ")");
									if (obj.first == "NO") { swal("", "No se guardo verifique los datos.", "warning"); }else{
										 if (obj.first == "SI") {                    
												swal("", "Guardado Exitosamente.", "success");
												setTimeout("location.href = 'index.php';",800);
										 }
									}

							}
						}
						ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
						ajax.send("&idEnlace="+idEnlace+"&anio="+anio+"&mes="+mes+"&taRec="+taRec+"&atOrdi="+atOrdi+"&atRepro="+atRepro+"&uiOrdi="+uiOrdi+"&uiRepro="
							+uiRepro+"&feaaiOrdi="+feaaiOrdi+"&feaaiRepro="+feaaiRepro+"&feavfgOrdi="+feavfgOrdi+"&feavfgRepro="+feavfgRepro+"&aicOrdi="+aicOrdi+"&aicRepro="+aicRepro
							+"&procedentes="+procedentes+"&desechadas="+desechadas+"&svhom="+svhom+"&svmuj="+svmuj+"&sihom="+sihom+"&simuj="+simuj+"&numInvRec="+numInvRec);


				}

	}



}


