

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



			function modalsavecloseCmasc2(){ 


			}

			function mosalCloseCmasc(idEnlace){
				
				$('#modalReci').modal('hide');	
				setTimeout("location.href = 'http://201.116.252.158:8080/helo900803/SIRE/Cmasc';",600);

			}

			function openModalRecibUnid(idEnlace, anio, mes, uniRecib, tramANt){

				if(uniRecib != 0){

					$('#modalReci').modal('show');			
					cont = document.getElementById('contmodRecibidasCmasc');
					ajax=objetoAjax();
					ajax.open("POST", "format/cmasc/modalRecib.php");

					ajax.onreadystatechange = function(){
						if (ajax.readyState == 4 && ajax.status == 200) {
							cont.innerHTML = ajax.responseText;
							
						}
					}
					ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
					ajax.send("&idEnlace="+idEnlace+"&uniRecib="+uniRecib+"&anio="+anio+"&mes="+mes+"&tramANt="+tramANt);
				}else{
					swal("","Selecciona Unidad","warning");
				}

			}


			function openModalRecib(idEnlace, anio, mes, tramANt){

				var uniRecib = document.getElementById("unidRecib").value;	

				if(uniRecib != 0){

					$('#modalReci').modal('show');			
					cont = document.getElementById('contmodRecibidasCmasc');
					ajax=objetoAjax();
					ajax.open("POST", "format/cmasc/modalRecib.php");

					ajax.onreadystatechange = function(){
						if (ajax.readyState == 4 && ajax.status == 200) {
							cont.innerHTML = ajax.responseText;
						}
					}
					ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
					ajax.send("&idEnlace="+idEnlace+"&uniRecib="+uniRecib+"&anio="+anio+"&mes="+mes+"&tramANt="+tramANt);
				}else{
					swal("","Selecciona Unidad","warning");
				}

			}

			function nucFunctionsCmasc(nuc, mes, anio, idEnlace, idUnidad, tramANt){
				validartamanoCmasc(nuc, mes, anio, idEnlace, idUnidad, tramANt);
			}

			function validartamanoCmasc(idinput, mes, anio, idEnlace, idUnidad, tramANt){

				texto = document.getElementById(idinput).value;
				cantidadinicio = document.getElementById(idinput).value.length;

				if(cantidadinicio > 13){
					var slice2 = texto.slice(0,-1);
					document.getElementById(idinput).value = slice2;
				}else{

					if (cantidadinicio < 13) {}else{

						if (cantidadinicio == 13) { 

							nuc=document.getElementById('nuCmasc').value;									  			
							type = document.getElementById('typeNucCmasc').value;
							type2 = document.getElementById('type2').value;
						//	idUnidad = document.getElementById('unidRecib').value;

						acc = "existeNucSic";
						ajax=objetoAjax();
						ajax.open("POST", "format/cmasc/accionesNucsCmasc.php");
						document.getElementById("btnAddnuc").disabled=true;
						ajax.onreadystatechange = function(){
							if (ajax.readyState == 4 && ajax.status == 200) {							


								var cadCodificadaJSON = ajax.responseText;
								var objDatos = eval("(" + cadCodificadaJSON + ")");

								if (objDatos.first == "c") {  swal("", "El numero de caso no existe.", "warning"); document.getElementById("btnAddnuc").disabled=false; }
								if (objDatos.first == "a") { 
									document.getElementById('nuCmasc').value = "";
									document.getElementById("btnAddnuc").disabled=false;  
									swal("", "No se puede ingresar por que ya existe un Ordinario  de este NUC.", "warning"); }
									if (objDatos.first == "b"){ swal("", "El nuc se puede ingresar como ordinario.", "warning"); }
									if (objDatos.first == "m"){ swal("", "No se puede ingresar por que actualmente existe un reproceso procedente.", "warning"); document.getElementById("btnAddnuc").disabled=false; document.getElementById('nuCmasc').value = "";  }
									if (objDatos.first == "d"){ swal("", "Ya existe un ordinario para esta carpeta solo se puede como reproceso.", "warning"); }
									if (objDatos.first == "j"){ swal("", "No se puede ingresar como procedente por que ya existe un procedente para este NUC.", "warning"); document.getElementById('nuCmasc').value = ""; document.getElementById("btnAddnuc").disabled=false;}
									if (objDatos.first == "k"){ swal("", "No se puede ingresar como Desechado  por que ya existe un desechado para este NUC.", "warning"); document.getElementById('nuCmasc').value = ""; document.getElementById("btnAddnuc").disabled=false;}
									if (objDatos.first == "l"){ swal("", "No se puede ingresar por que ya existe un Ordinario Procedente de este NUC.", "warning"); document.getElementById('nuCmasc').value = ""; document.getElementById("btnAddnuc").disabled=false;}
									if (objDatos.first == "e"){ swal("", "No se puede capturar como reproceso por que no existe como ordinario en CMASC.", "warning"); document.getElementById("btnAddnuc").disabled=false; }								  
									if (objDatos.first == "h") {  
										swal("", "Ha sido registrado exitosamente.", "success"); 
										document.getElementById('nuCmasc').value = ""; 
										document.getElementById("btnAddnuc").disabled=false;
										updateTableNucs(idEnlace, idUnidad, anio, mes);
									}
									if (objDatos.first == "i") {  swal("", "No se capturo verifique los datos.", "warning"); }
								}
							}
							ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
							ajax.send("&mes="+mes+"&anio="+anio+"&nuc="+nuc+"&acc="+acc+"&type="+type+"&type2="+type2+"&idUnidad="+idUnidad+"&idEnlace="+idEnlace+"&tramANt="+tramANt);

						}
					}
				}  
			}

			function updateTableNucs(idEnlace, idUnidad, anio, mes){

				cont = document.getElementById('contTableNUcsUnids');		

				ajax=objetoAjax();
				ajax.open("POST", "format/cmasc/tableNucsRecib.php");
				ajax.onreadystatechange = function(){
					if (ajax.readyState == 4 && ajax.status == 200) {				
						cont.innerHTML = ajax.responseText;												
					}
				}
				ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
				ajax.send("&idUnidad="+idUnidad+"&idEnlace="+idEnlace+"&mes="+mes+"&anio="+anio);						

			}

			function deleteNucFromRecib(idDelete, idEnlace, idUnidad, anio, mes){


				swal({
					title: "",
					text: "¿Esta seguro de Eliminar el Número de caso?",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Si, Eliminar",
					cancelButtonText: "Cancelar",
					closeOnConfirm: true,
					closeOnCancel: true
				},
				function(isConfirm){
					if (isConfirm) {

						ajax=objetoAjax();
						ajax.open("POST", "format/cmasc/nucRecibDelete.php");
						ajax.onreadystatechange = function(){
							if (ajax.readyState == 4 && ajax.status == 200) {			


								var json = ajax.responseText;
								var obj = eval("(" + json + ")");
								if (obj.first == "NO") { swal("", "No se elimino verifique los datos.", "warning"); }else{
									if (obj.first == "SI") {                    
										swal("", "Eliminado Exitosamente.", "success");		
										updateTableNucs(idEnlace, idUnidad, anio, mes);

									}
								}

							}
						}
						ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
						ajax.send("&idDelete="+idDelete);			


					}
				});			

			}


			function saveDataRecib(idEnlace, anio, mes){

				cont = document.getElementById('contTableNUcsUnids');		

				svhom = document.getElementById('svhom').value;
				svmuj = document.getElementById('svmuj').value;
				sihom = document.getElementById('sihom').value;
				simuj = document.getElementById('simuj').value;
				numInvRec = document.getElementById('numInvRec').value;


				document.getElementById("btnSaveRecib").disabled=true;
				ajax=objetoAjax();
				ajax.open("POST", "format/cmasc/saveREcib.php");
				ajax.onreadystatechange = function(){
					if (ajax.readyState == 4 && ajax.status == 200) {				
						var cadCodificadaJSON = ajax.responseText;
						var objDatos = eval("(" + cadCodificadaJSON + ")");

						if (objDatos.first == "SI") {  swal("", "Se a guardado correctamente.", "success"); 
						setTimeout("location.href = 'http://201.116.252.158:8080/helo900803/SIRE/Cmasc';",600);
					}
					if (objDatos.first == "NO") {  swal("", "No se guardo verifique los datos.", "warning"); }												
				}
			}
			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			ajax.send("&idEnlace="+idEnlace+"&mes="+mes+"&anio="+anio+"&svhom="+svhom+"&svmuj="+svmuj+"&sihom="+sihom+"&simuj="+simuj+"&numInvRec="+numInvRec);						

		}


		function sendModalCmasc(estatus,tipo, idEnlace, mes, anio){


			cont = document.getElementById('contmodMEdiNUcs');		

			$('#nuc').focus();	
			ajax=objetoAjax();
			ajax.open("POST", "format/cmasc/modalNucsAcuer.php");
			ajax.onreadystatechange = function(){
				if (ajax.readyState == 4 && ajax.status == 200) {				
					cont.innerHTML = ajax.responseText;								
							//	$('#myModaFormato').modal('hide'); 
							$('#modalNucsMedConJun').modal('show');											
						}
					}
					ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
					ajax.send("&estatus="+estatus+"&tipo="+tipo+"&idEnlace="+idEnlace+"&mes="+mes+"&anio="+anio);



				}


			//// NUC FUNCTIONS ACUERDOS TIPOS

			function nucFunctionsAcuerd(nuc, mes, anio, idEnlace, estatus, tipo){
				validartamanoAcuerd(nuc, mes, anio, idEnlace, estatus, tipo);
			}

			function validartamanoAcuerd(idinput, mes, anio, idEnlace, estatus, tipo){

				texto = document.getElementById(idinput).value;
				cantidadinicio = document.getElementById(idinput).value.length;

				if(cantidadinicio > 13){
					var slice2 = texto.slice(0,-1);
					document.getElementById(idinput).value = slice2;
				}else{

					if (cantidadinicio < 13) {}else{

						if (cantidadinicio == 13) {

							nuc=document.getElementById('nuCmascAcuer').value;				

							acc = "checkNucAcuerds";
							ajax=objetoAjax();
							ajax.open("POST", "format/cmasc/accionesNucsCmasc.php");
							document.getElementById("btnAddnucAcuer").disabled=true;
							ajax.onreadystatechange = function(){
								if (ajax.readyState == 4 && ajax.status == 200) {							


									var cadCodificadaJSON = ajax.responseText;
									var objDatos = eval("(" + cadCodificadaJSON + ")");

									if (objDatos.first == "a") { document.getElementById('nuCmascAcuer').value = ""; document.getElementById("btnAddnucAcuer").disabled=false; swal("", "El nuc "+nuc+" ya fue ingresado, "+objDatos.first3+" en "+objDatos.firs2+"", "warning"); }
									if (objDatos.first == "h") {  swal("", "Se registro el acuerdo exitosamente.", "success"); 

									document.getElementById('nuCmascAcuer').value = ""; 
									document.getElementById("btnAddnucAcuer").disabled=false;
									updateTableNucsAcuerd(idEnlace, anio, mes, estatus, tipo);

									} /// FALTA ACTUALIZAR EL FORMULARIO DE REGISTRO DE NUC PARA QUE APARESCA EL INSERTADO
									if (objDatos.first == "1") {  swal("", "No se guardo, verifique los datos.", "warning"); }
									if (objDatos.first == "j") { document.getElementById('nuCmascAcuer').value = ""; document.getElementById("btnAddnucAcuer").disabled=false; swal("", "El número de caso no se puede insertar por que su ultimo estatus es DESECHADO.", "warning"); }
									if (objDatos.first == "k") {  swal("", "El numero de caso NUC no puede ser ingresado por que tiene el acuerdo finalizado.", "warning"); }
									if (objDatos.first == "c") {  swal("", "El numero de caso ingresado no se encuentra como tramite, favor de revisar.", "warning"); document.getElementById('nuCmascAcuer').value = ""; document.getElementById("btnAddnucAcuer").disabled=false;}
									if (objDatos.first == "b") {  swal("", "El numero de caso se puede ingresar.", "warning"); }
									if (objDatos.first == "d") { document.getElementById("btnAddnucAcuer").disabled=false; swal("", "El numero de caso ordinario no puede tener acuerdo por que fue desechado, favor de revisar.", "warning"); }
									if (objDatos.first == "e") { document.getElementById("btnAddnucAcuer").disabled=false;  swal("", "El numero de caso en reproceso no puede tener acuerdo por que fue desechado, favor de revisar.", "warning"); }
								}
							}
							ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
							ajax.send("&mes="+mes+"&anio="+anio+"&nuc="+nuc+"&acc="+acc+"&idEnlace="+idEnlace+"&estatus="+estatus+"&tipo="+tipo);

						}
					}
				}  
			} 


			function modAcuClose(t, idEnlace, anio, mes){ 

				if(t == 1){ position = 0; pagina = "mediacion.php"; }
				if(t == 2){ position = 1; pagina = "conciliacion.php";}
				if(t == 3){ position = 2; pagina = "junta.php";}

				openTabAcuer2(position, pagina, idEnlace, anio, mes);
				$('#modalNucsMedConJun').modal('hide');		

				document.getElementById("contenido").setAttribute("style","overflow-y:auto !important;height:auto;width:100%;");
				document.getElementById("contentTansAcuer").setAttribute("style","overflow-y:auto !important;height:auto;width:100%;");


			}

			function openTabAcuer(evt2, pagina, idEnlace, anio, mes){

				tablinks2 = document.getElementsByClassName("tablinksAcue");
				for (i = 0; i < tablinks2.length; i++) {
					tablinks2[i].className = tablinks2[i].className.replace(" active", "");
				}
				evt2.currentTarget.className += " active";
				anio = document.getElementById("anioCmasc").value;
				mes = document.getElementById("mesCmasc").value; 
	///// INGRESAR A LA PAGINA CORRESPONDIENTE MEDIANTE AJAX

	cont = document.getElementById('contentTansAcuer');

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

function openTabAcuer2(position, pagina, idEnlace, anio, mes){

	tablinks2 = document.getElementsByClassName("tablinksAcue");
	for (i = 0; i < tablinks2.length; i++) {
		tablinks2[i].className = tablinks2[i].className.replace(" active", "");
	}
	tablinks2[position].className += " active";
	anio = document.getElementById("anioCmasc").value;
	mes = document.getElementById("mesCmasc").value; 
	///// INGRESAR A LA PAGINA CORRESPONDIENTE MEDIANTE AJAX

	cont = document.getElementById('contentTansAcuer');

	ajax=objetoAjax();
	ajax.open("POST", "format/cmasc/"+pagina);

	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText;
			document.getElementById("contenido").setAttribute("style","overflow-y:auto !important;height:auto;width:100%;");
				document.getElementById("contentTansAcuer").setAttribute("style","overflow-y:auto !important;height:auto;width:100%;");
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("&idEnlace="+idEnlace+"&anio="+anio+"&mes="+mes);

}

function deleteNucFromAcuerd(idDelete, idEnlace, anio, mes, estatus, tipo, nuc){

	swal({
		title: "",
		text: "¿Esta seguro de Eliminar el Número de caso?",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Si, Eliminar",
		cancelButtonText: "Cancelar",
		closeOnConfirm: true,
		closeOnCancel: true
	},
	function(isConfirm){
		if (isConfirm) {

			ajax=objetoAjax();
			ajax.open("POST", "format/cmasc/nucAcuerdDelete.php");
			ajax.onreadystatechange = function(){
				if (ajax.readyState == 4 && ajax.status == 200) {			


					var json = ajax.responseText;
					var obj = eval("(" + json + ")");
					if (obj.first == "NO") { alert("No se eliminó correctamente"); }else{
						if (obj.first == "SI") {                    
							
							alert("Se eliminó correctamente");	
							updateTableNucsAcuerdDeleted(idEnlace, anio, mes, estatus, tipo);
							
						}
					}

				}
			}
			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			ajax.send("&idDelete="+idDelete+"&nuc="+nuc);			


		}
	});			

}


function updateTableNucsAcuerd(idEnlace, anio, mes, estatus, tipo){

	cont = document.getElementById('contTableNUcsUnids');		

	ajax=objetoAjax();
	ajax.open("POST", "format/cmasc/tableNucsAcuerds.php");
	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {				
			cont.innerHTML = ajax.responseText;												
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("&idEnlace="+idEnlace+"&mes="+mes+"&anio="+anio+"&estatus="+estatus+"&tipo="+tipo);						

}

function updateTableNucsAcuerdDeleted(idEnlace, anio, mes, estatus, tipo){


	cont = document.getElementById('contTableNUcsUnids');		

	ajax=objetoAjax();
	ajax.open("POST", "format/cmasc/tableNucsAcuerds.php");
	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {				
			cont.innerHTML = ajax.responseText;		

		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("&idEnlace="+idEnlace+"&mes="+mes+"&anio="+anio+"&estatus="+estatus+"&tipo="+tipo);						

}




