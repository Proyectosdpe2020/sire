

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

		if( maiCumplido == "" || maiNoCumplido == "" || maiPconvenio == "" || madCumplido == "" || madNoCumplido == "" || madTramite == "" || msaNoaConveVictima == "" || msaNoaConceImputado == "" || msaDecsiPartes == "" 
	|| msaInasInparVictima == "" || msaInasInparImputado == "" || msaNegparVictima == "" || msaNegparImputado == "" || totalMediacion == "" || caiCumplido == "" || caiNoCumplido == "" 
	|| caiPconvenio == "" || cadCumplido == "" || cadNoCumplido == "" || cadTramite == "" || csaDecsiPartes == "" || csaInasInparAmbas == "" || csaDosInasIn1parVictima == "" || csaDosInasIn1parImputado == "" || csaNegparVictima == ""
	 || csaNegparImputado == "" || totalConciliacion == ""){ sweetAlert("", "Faltan datos por completar.", "warning"); }
			else
			{ 

	}

}

function sumMediac(){


		maiCumplido = document.getElementById("maiCumplido").value;   	if( maiCumplido == "" ){ maiCumplido = 0; }else { maiCumplido = parseInt(document.getElementById("maiCumplido").value);  } 
		maiNoCumplido = document.getElementById("maiNoCumplido").value;     	if( maiNoCumplido == "" ){ maiNoCumplido = 0; } else { maiNoCumplido = parseInt(document.getElementById("maiNoCumplido").value);   }
		maiPconvenio = document.getElementById("maiPconvenio").value;    	if( maiPconvenio == "" ){ maiPconvenio = 0; }  else { maiPconvenio = parseInt(document.getElementById("maiPconvenio").value); }
		madCumplido = document.getElementById("madCumplido").value;  	if( madCumplido == "" ){ madCumplido = 0; } else { madCumplido = parseInt(document.getElementById("madCumplido").value); }
		madNoCumplido = document.getElementById("madNoCumplido").value;  	if( madNoCumplido == "" ){ madNoCumplido = 0; } else { madNoCumplido = parseInt(document.getElementById("madNoCumplido").value); }
		madTramite = document.getElementById("madTramite").value;  	if( madTramite == "" ){ madTramite = 0; } else { madTramite = parseInt(document.getElementById("madTramite").value); }
		msaNoaConveVictima = document.getElementById("msaNoaConveVictima").value;  	if( msaNoaConveVictima == "" ){ msaNoaConveVictima = 0; } else { msaNoaConveVictima = parseInt(document.getElementById("msaNoaConveVictima").value);  }
		msaNoaConceImputado = document.getElementById("msaNoaConceImputado").value;   	if( msaNoaConceImputado == "" ){ msaNoaConceImputado = 0; } else { msaNoaConceImputado = parseInt(document.getElementById("msaNoaConceImputado").value); }
		msaDecsiPartes =document.getElementById("msaDecsiPartes").value;  	if( msaDecsiPartes == "" ){ msaDecsiPartes = 0; } else { msaDecsiPartes = parseInt(document.getElementById("msaDecsiPartes").value); }
		msaInasInparVictima = document.getElementById("msaInasInparVictima").value;  	if( msaInasInparVictima == "" ){ msaInasInparVictima = 0; } else { msaInasInparVictima = parseInt(document.getElementById("msaInasInparVictima").value); }
		msaInasInparImputado = document.getElementById("msaInasInparImputado").value;  	if( msaInasInparImputado == "" ){ msaInasInparImputado = 0; } else { msaInasInparImputado = parseInt(document.getElementById("msaInasInparImputado").value); }
		msaNegparVictima = document.getElementById("msaNegparVictima").value;  	if( msaNegparVictima == "" ){ msaNegparVictima = 0; } else { msaNegparVictima = parseInt(document.getElementById("msaNegparVictima").value); }
		msaNegparImputado = document.getElementById("msaNegparImputado").value;  	if( msaNegparImputado == "" ){ msaNegparImputado = 0; } else { msaNegparImputado = parseInt(document.getElementById("msaNegparImputado").value); }

		var final = maiCumplido  + maiNoCumplido + maiPconvenio + madCumplido + madNoCumplido + madTramite + msaNoaConveVictima + msaNoaConceImputado + msaDecsiPartes + msaInasInparVictima+ msaInasInparImputado+ msaNegparVictima + msaNegparImputado;
		document.getElementById("totalMediacion").value = final;

}

function sumConcil(){


		caiCumplido = document.getElementById("caiCumplido").value;   	if( caiCumplido == "" ){ caiCumplido = 0; }else { caiCumplido = parseInt(document.getElementById("caiCumplido").value);  } 
		caiNoCumplido = document.getElementById("caiNoCumplido").value;     	if( caiNoCumplido == "" ){ caiNoCumplido = 0; } else { caiNoCumplido = parseInt(document.getElementById("caiNoCumplido").value);   }
		caiPconvenio = document.getElementById("caiPconvenio").value;    	if( caiPconvenio == "" ){ caiPconvenio = 0; }  else { caiPconvenio = parseInt(document.getElementById("caiPconvenio").value); }
		cadCumplido = document.getElementById("cadCumplido").value;  	if( cadCumplido == "" ){ cadCumplido = 0; } else { cadCumplido = parseInt(document.getElementById("cadCumplido").value); }
		cadNoCumplido = document.getElementById("cadNoCumplido").value;  	if( cadNoCumplido == "" ){ cadNoCumplido = 0; } else { cadNoCumplido = parseInt(document.getElementById("cadNoCumplido").value); }
		cadTramite = document.getElementById("cadTramite").value;  	if( cadTramite == "" ){ cadTramite = 0; } else { cadTramite = parseInt(document.getElementById("cadTramite").value); }
		csaDecsiPartes = document.getElementById("csaDecsiPartes").value;  	if( csaDecsiPartes == "" ){ csaDecsiPartes = 0; } else { csaDecsiPartes = parseInt(document.getElementById("csaDecsiPartes").value);  }
		csaInasInparAmbas = document.getElementById("csaInasInparAmbas").value;   	if( csaInasInparAmbas == "" ){ csaInasInparAmbas = 0; } else { csaInasInparAmbas = parseInt(document.getElementById("csaInasInparAmbas").value); }
		csaDosInasIn1parVictima =document.getElementById("csaDosInasIn1parVictima").value;  	if( csaDosInasIn1parVictima == "" ){ csaDosInasIn1parVictima = 0; } else { csaDosInasIn1parVictima = parseInt(document.getElementById("csaDosInasIn1parVictima").value); }
		csaDosInasIn1parImputado = document.getElementById("csaDosInasIn1parImputado").value;  	if( csaDosInasIn1parImputado == "" ){ csaDosInasIn1parImputado = 0; } else { csaDosInasIn1parImputado = parseInt(document.getElementById("csaDosInasIn1parImputado").value); }
		csaNegparVictima = document.getElementById("csaNegparVictima").value;  	if( csaNegparVictima == "" ){ csaNegparVictima = 0; } else { csaNegparVictima = parseInt(document.getElementById("csaNegparVictima").value); }
		csaNegparImputado = document.getElementById("csaNegparImputado").value;  	if( csaNegparImputado == "" ){ csaNegparImputado = 0; } else { csaNegparImputado = parseInt(document.getElementById("csaNegparImputado").value); }

		var final2 = caiCumplido  + caiNoCumplido + caiPconvenio + cadCumplido + cadNoCumplido + cadTramite + csaDecsiPartes + csaInasInparAmbas + csaDosInasIn1parVictima + csaDosInasIn1parImputado + csaNegparVictima +csaNegparImputado;
		document.getElementById("totalConciliacion").value = final2;

}


////// FUNCION PARA MANDAR DATOS AL MODAL QUE RECIBIRA LOS NUCS //////////////////


function sendDataModalCmasc(tipo,inputCant, idEnlace, mes, anio){
			
						var cant = document.getElementById(inputCant).value;
						cont = document.getElementById('contmodalnucsRecibidasCmasc');		
						if(cant != 0){
						$('#nuc').focus();	
						ajax=objetoAjax();
						ajax.open("POST", "format/cmasc/modalNucsReci.php");
						ajax.onreadystatechange = function(){
							if (ajax.readyState == 4 && ajax.status == 200) {				
								cont.innerHTML = ajax.responseText;								
							//	$('#myModaFormato').modal('hide'); 
								$('#modalNucsRecibi').modal('show');											
							}
						}
						ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
						ajax.send("&tipo="+tipo+"&cant="+cant+"&idEnlace="+idEnlace+"&mes="+mes+"&anio="+anio);

						}	

}

function modalsavecloseCmasc(){ 


	//$('#myModaFormato').modal('show'); 
	$('#modalNucsRecibi').modal('hide');	

 }
