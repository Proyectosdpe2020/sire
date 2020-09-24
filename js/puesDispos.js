var newBrwoser;
var fechaevento;
var newBrwoserFisca;
var newBrwoserMun;
var newBrwoserColo;
var calleInputvehi;

function saveVehicle(idEnlace, typearch, b, tipoActualizacion , idVeicle){

	 var tipoActualizacion = tipoActualizacion;
		var idVeicle = idVeicle;
		

		var selClasific= document.getElementById("selClasific").value; 
		var selFormAsegur= document.getElementById("selFormAsegur").value; 
		var selAdispo= document.getElementById("selAdispo").value; 
		var selDelito= document.getElementById("selDelito").value; 
		var selTipoDelito= document.getElementById("selTipoDelito").value; 

		var newMarca= document.getElementById("newMarca").value;
		var newLinea= document.getElementById("newLinea").value;
		var newTypeMarca= document.getElementById("newTypeMarca").value;

		if(selClasific != "" && selFormAsegur != "" && selAdispo != "" && selDelito != "" && selTipoDelito != "" && newMarca != "" 
			&& newLinea != "" && newTypeMarca != ""){			
			
			var newMarca_id= document.querySelector("#newMarcas"  + " option[value='" + newMarca+ "']").dataset.id;
			var newLineas_id= document.querySelector("#newLineas"  + " option[value='" + newLinea+ "']").dataset.id;
			var newTipo_id= document.querySelector("#newTypeVehicles"  + " option[value='" + newTypeMarca+ "']").dataset.id;

			var nucVehiculo= document.getElementById("nucVehiculo").value;
			var requeridoPorVehi= document.getElementById("requeridoPorVehi").value;
			var colorVehi= document.getElementById("colorVehi").value;
			var modeloVehi= document.getElementById("modeloVehi").value;
			var placaVehi= document.getElementById("placaVehi").value;
			var serieVehi= document.getElementById("serieVehi").value;
			var serieAlVehi= document.getElementById("serieAlVehi").value;
			var motorVehi= document.getElementById("motorVehi").value;
			var motorAlVehi= document.getElementById("motorAlVehi").value;

			var requeOtroCopro= document.getElementById("requeOtroCopro").value;
			var oficioVehi= document.getElementById("oficioVehi").value;
			var observaVehi= document.getElementById("observaVehi").value;


			//// DATA DE LA PUESTA A DISPOSICION /////
			var idPuestaDisposicion= document.getElementById("idPuestaDisposicion").value;
			var tipoMOd= document.getElementById("tipoMOd").value;

			var idMandoPuesta= document.getElementById("idMandoPuesta").value;
			var nucPuestaDisposi= document.getElementById("nucPuestaDisposi").value;
			var fechaevento= document.getElementById("fechaevento").value;
		
			var newBrwosers_id_fisca= document.getElementById("newBrwosers_id_fisca").value;
			var newBrwosers_id_mun= document.getElementById("newBrwosers_id_mun").value;
			var newBrwosers_id_colo= document.getElementById("newBrwosers_id_colo").value;
			var codepostalidPeusta= document.getElementById("codepostalidPeusta").value;
			var calleInputPuesta= document.getElementById("calleInputPuesta").value;
			var numberCallePuesta= document.getElementById("numberCallePuesta").value;
			if(numberCallePuesta == ""){ numberCallePuesta = 0; }
			var cont= document.getElementById("respuestsGUdradoVEhiculo");
			
				var uno= document.getElementById("uno").value;
				var dos= document.getElementById("dos").value;
					var tres= document.getElementById("tres").value;
						var cuatro= document.getElementById("cuatro").value;
							var cinco= document.getElementById("cinco").value;
								var narac= document.getElementById("narac").value;

			var puestaDataVehi = Array();
			    puestaDataVehi[0] = idMandoPuesta;   puestaDataVehi[1] = "'"+nucPuestaDisposi+"'"; puestaDataVehi[2] = "'"+fechaevento+"'"; puestaDataVehi[3] =  newBrwosers_id_fisca;
			    puestaDataVehi[4] = newBrwosers_id_mun; puestaDataVehi[5] = newBrwosers_id_colo; puestaDataVehi[6] = codepostalidPeusta; puestaDataVehi[7] = "'"+calleInputPuesta+"'";
			    puestaDataVehi[8] = numberCallePuesta; puestaDataVehi[9] = tipoMOd; puestaDataVehi[10] = uno; puestaDataVehi[11] = dos; puestaDataVehi[12] = tres;
			    puestaDataVehi[13] = cuatro; puestaDataVehi[14] = cinco; puestaDataVehi[15] = narac;

			     var jObject={};  for(i in puestaDataVehi){  jObject[i] = puestaDataVehi[i];   }
			     jObject= JSON.stringify(jObject);

			ajax=objetoAjax();
			ajax.open("POST", "format/puestaDisposicion/guardarVehicle.php");

			ajax.onreadystatechange = function(){
				if (ajax.readyState == 4 && ajax.status == 200) {				

						//cont.innerHTML = ajax.responseText;
						var json = ajax.responseText;
						var obj = eval("(" + json + ")");
						if (obj.first == "NO") { swal("", "No se registro verifique los datos.", "warning"); }else{
							 if (obj.first == "SI") {                    
								
							 	var obj = eval("(" + json + ")");
							 	swal("", "Vehículo Registrado Exitosamente.", "success");
								//// SE DEBE DE ACTUALIZAR LA INFO DE LA PUESTA A DISPOSICION
								salirVehicle();
								showmodalPueDispo(1, idEnlace, obj.idpuestaultimo, typearch, b);
							 }
						}

					}				
				}

			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			ajax.send("&idPuestaDisposicion="+idPuestaDisposicion+"&selClasific="+selClasific+"&selFormAsegur="+selFormAsegur+"&nucVehiculo="+nucVehiculo+"&selAdispo="+selAdispo+"&requeridoPorVehi="+requeridoPorVehi+"&selDelito="+selDelito+"&selTipoDelito="+selTipoDelito+"&newMarca_id="+newMarca_id
				+"&newLineas_id="+newLineas_id+"&newTipo_id="+newTipo_id+"&colorVehi="+colorVehi+"&modeloVehi="+modeloVehi+"&placaVehi="+placaVehi+"&serieVehi="+serieVehi+"&serieAlVehi="+serieAlVehi+"&motorVehi="+motorVehi+"&motorAlVehi="+motorAlVehi+"&requeOtroCopro="+requeOtroCopro+"&oficioVehi="+oficioVehi+"&observaVehi="+observaVehi
				+"&jObject="+jObject+"&idEnlace="+idEnlace+"&tipoActualizacion="+tipoActualizacion+"&idVeicle="+idVeicle);


		}else{

				swal("", "Faltan datos por registrar.", "warning");	
		}

}


function getDataLinea(){


		var newMarca= document.getElementById("newMarca").value; 		
		var newBrwosers_id= document.querySelector("#newMarcas"  + " option[value='" + newMarca+ "']").dataset.id;		

		cont = document.getElementById('conteLinea');
		ajax=objetoAjax();
		ajax.open("POST", "format/puestaDisposicion/dataLinea.php");

		ajax.onreadystatechange = function(){
			if (ajax.readyState == 4 && ajax.status == 200) {
				cont.innerHTML = ajax.responseText;
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("&newBrwosers_id="+newBrwosers_id);

}

function salirVehicle(){
		$('#puestdisposVehic').modal('hide');
		$('#puestdispos').modal('show'); 

		var link = document.getElementById("imgVeicle");
		link.removeAttribute("href");
	    link.removeAttribute("data-toggle");	
}

function showmodalPueDispo(tipoModal, idEnlace, idPuestaDisposicion, typeArch, typeCheck){

anio = document.getElementById("anioCmasc").value;
	var messelected= document.getElementById("mesPuestaSelected").value;
		var diaselected= document.getElementById("diaSeleted").value; 	

    cont = document.getElementById('contMOdalPuedispos');
	ajax=objetoAjax();
	ajax.open("POST", "format/puestaDisposicion/modalPuestaDisposicion.php");

	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText;	
			$('#busquepuestdispos').modal('hide');	
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("&tipoModal="+tipoModal+"&idEnlace="+idEnlace+"&idPuestaDisposicion="+idPuestaDisposicion+"&typeArch="+typeArch+"&anio="+anio+"&messelected="+messelected+"&diaselected="+diaselected+"&typeCheck="+typeCheck);
}

function saveDataPuesta(typearch, anio, idEnlace, camMes, messelected, diaselected, typeche){

 if(typeche == 1){

 					idPuesta = document.getElementById("idPuestaDisposicion").value;
			if(idPuesta != ""){


				var validar = validateDataPuesta();	

					if(validar){

											/////////// DATOS DE LOS DATALIST /////////////
											var newBrwosers_id = $("#newBrwoser").val();
											var obj = $("#newBrwosers").find("option[value='" + newBrwosers_id + "']").attr('data-id');

											var newBrwosers_id_fisca = $("#newBrwoserFisca").val();
											var obj2 = $("#newBrwosersFis").find("option[value='" + newBrwosers_id_fisca + "']").attr('data-id');

											var newBrwosers_id_mun = $("#newBrwoserMun").val();
											var obj3 = $("#newBrwosersMun").find("option[value='" + newBrwosers_id_mun + "']").attr('data-id');

											var newBrwosers_id_colo = $("#newBrwoserColo").val();
											var obj4 = $("#newBrwosersColo").find("option[value='" + newBrwosers_id_colo + "']").attr('data-id');
											/////////// DATOS DE LOS DATALIST /////////////

											/////// CONDICION DE QUE ESTE BIEN CAPTURADOS LOS DATALIST ////////
												if(obj != null && obj.length > 0){
													if(obj2  != null && obj2.length > 0){	
														if(obj3 != null && obj3.length > 0){
															if(obj4 != null && obj4.length > 0){
																				var nucPuestaDisposi= document.getElementById("nucPuestaDisposi").value;
																				var codepostalidPeusta= document.getElementById("codepostalidPeusta").value;
																				var numberCallePuesta= document.getElementById("numberCallePuesta").value;
																				if(numberCallePuesta == ""){ numberCallePuesta = 0; }
																				var uno = document.getElementById("acepto1").checked;
																			 var dos = document.getElementById("acepto2").checked;
																			 var tres = document.getElementById("acepto3").checked;
																			 var cuat = document.getElementById("acepto4").checked;
																			 var cinc = document.getElementById("acepto5").checked;
																			 var naracion= document.getElementById("textNarracion").value;

																			 var puestaData = Array();
															    puestaData[0] = obj;   puestaData[1] = "'"+nucPuestaDisposi+"'"; puestaData[2] = "'"+fechaevento+"'"; puestaData[3] =  obj2;
															    puestaData[4] = obj3; puestaData[5] = obj4; puestaData[6] = codepostalidPeusta; puestaData[7] = "'"+calleInputPuesta+"'";
															    puestaData[8] = numberCallePuesta; 

															    puestaData[10] = uno; puestaData[11] = dos; puestaData[12] = tres; puestaData[13] = cuat; puestaData[14] = cinc; puestaData[15] = naracion;

															     var jObject={};  for(i in puestaData){  jObject[i] = puestaData[i];   }
															     jObject= JSON.stringify(jObject);

																					ajax=objetoAjax();
																					ajax.open("POST", "format/puestaDisposicion/updateDataPuesta.php");

																					ajax.onreadystatechange = function(){
																						if (ajax.readyState == 4 && ajax.status == 200) {

																										var json = ajax.responseText;
																														var obj = eval("(" + json + ")");
																														if (obj.first == "NO") { swal("", "No se actualizo verifique los datos.", "warning"); }else{
																															 if (obj.first == "SI") {                    
																																
																															 		$('#puestdispos').modal('hide');
																																		swal("", "Datos actualizados correctamente.", "success");
																																		loadDataPuestDayCurrent(anio, idEnlace, camMes, messelected, diaselected);
																															 }
																														}																							
																						}
																					}
																					ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
																					ajax.send("&idPuesta="+idPuesta+"&jObject="+jObject);

																		}else{ swal("", "La Colonia ingresada es incorrecta.", "warning"); }

																		}else{ swal("", "El Municipio ingresado es incorrecto.", "warning"); }

																}else{ swal("", "La Fiscalía ingresada es incorrecta.", "warning"); }

												}else{
															swal("", "El Mando ingresado es incorrecto.", "warning");
												}				
												/////// CONDICION DE QUE ESTE BIEN CAPTURADOS LOS DATALIST ////////			

									}else{
											swal("", "Datos Incompletos.", "warning");
									}		

			}else{
					$('#puestdispos').modal('hide');
					loadDataPuestDayCurrent(anio, idEnlace, camMes, messelected, diaselected);
			}

	}else{
				if(typeche == 0){
								$('#puestdispos').modal('hide');
				}
	}

			
		}


function validateDataPuesta(){

		newBrwoser= document.getElementById("newBrwoser").value;
 		fechaevento= document.getElementById("fechaevento").value; 		
 		newBrwoserFisca= document.getElementById("newBrwoserFisca").value;
 		newBrwoserMun= document.getElementById("newBrwoserMun").value;
 		newBrwoserColo= document.getElementById("newBrwoserColo").value;
 		calleInputPuesta= document.getElementById("calleInputPuesta").value;


 		if(newBrwoser != "" && fechaevento != "" && newBrwoserFisca != "" && newBrwoserMun != "" && newBrwoserColo != "" && calleInputPuesta != ""){ 
			return true;
		}else{ 	return false;  }					

}



function modalVehicle(typeForm,tipoMOd, idEnlace, idVeicle, b){

	/////////////////////////// SI EL TIPO MODAL ES UNA NUEVA PUESTA ENTONCES ES  0 ///////////////////////////////
	var idPuestaDisposicion= document.getElementById("idPuestaDisposicion").value;
	
	if(idPuestaDisposicion == ""){

			var validar = validateDataPuesta();	
			//////////// VALIDAR CAMPOS QUE SEAN REQUERIDO PARA LA PUESTA A DIPOSICION //////////////////
			if(validar){

						//var newBrwosers_id_colo= document.querySelector("#newBrwosersColo"  + " option[value='" + newBrwoserColo+ "']").dataset.id;	

						var newBrwosers_id = $("#newBrwoser").val();
						var obj = $("#newBrwosers").find("option[value='" + newBrwosers_id + "']").attr('data-id');

						var newBrwosers_id_fisca = $("#newBrwoserFisca").val();
						var obj2 = $("#newBrwosersFis").find("option[value='" + newBrwosers_id_fisca + "']").attr('data-id');

						var newBrwosers_id_mun = $("#newBrwoserMun").val();
						var obj3 = $("#newBrwosersMun").find("option[value='" + newBrwosers_id_mun + "']").attr('data-id');

						var newBrwosers_id_colo = $("#newBrwoserColo").val();
						var obj4 = $("#newBrwosersColo").find("option[value='" + newBrwosers_id_colo + "']").attr('data-id');

						if(obj != null && obj.length > 0){

										if(obj2  != null && obj2.length > 0){

												if(obj3 != null && obj3.length > 0){

														if(obj4 != null && obj4.length > 0){


																	var nucPuestaDisposi= document.getElementById("nucPuestaDisposi").value;
																	var codepostalidPeusta= document.getElementById("codepostalidPeusta").value;
																	var numberCallePuesta= document.getElementById("numberCallePuesta").value;
																	if(numberCallePuesta == ""){ numberCallePuesta = 0; }

																var link = document.getElementById("imgVeicle");	
															    // Changing the href attribute value
															    link.setAttribute("href", "#puestdisposVehic");
															    link.setAttribute("data-toggle", "modal");		


															     var uno = document.getElementById("acepto1").checked;
																			 var dos = document.getElementById("acepto2").checked;
																			 var tres = document.getElementById("acepto3").checked;
																			 var cuat = document.getElementById("acepto4").checked;
																			 var cinc = document.getElementById("acepto5").checked;

																			 var naracion= document.getElementById("textNarracion").value;


															    var puestaData = Array();
															    puestaData[0] = obj;   puestaData[1] = "'"+nucPuestaDisposi+"'"; puestaData[2] = "'"+fechaevento+"'"; puestaData[3] =  obj2;
															    puestaData[4] = obj3; puestaData[5] = obj4; puestaData[6] = codepostalidPeusta; puestaData[7] = "'"+calleInputPuesta+"'";
															    puestaData[8] = numberCallePuesta; puestaData[9] = tipoMOd;

															    puestaData[10] = uno; puestaData[11] = dos; puestaData[12] = tres; puestaData[13] = cuat; puestaData[14] = cinc; puestaData[15] = naracion;

															     var jObject={};  for(i in puestaData){  jObject[i] = puestaData[i];   }
															     jObject= JSON.stringify(jObject);
																			
																				cont = document.getElementById('contMOdalPuedisposVehic');
																				ajax=objetoAjax();
																				ajax.open("POST", "format/puestaDisposicion/modalVehicle.php");
																				ajax.onreadystatechange = function(){
																					if (ajax.readyState == 4 && ajax.status == 200) {
																						cont.innerHTML = ajax.responseText;				
																						$('#puestdispos').modal('hide'); 
																						$('#puestdisposVehic').modal('show');
																					}
																				}
																				ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
																				ajax.send("&idVeicle="+idVeicle+"&jObject="+jObject+"&idEnlace="+idEnlace+"&b="+b+"&typeForm="+typeForm);


														}else{ swal("", "La Colonia ingresada es incorrecta.", "warning"); }

												}else{ swal("", "El Municipio ingresado es incorrecto.", "warning"); }

										}else{ swal("", "La Fiscalía ingresada es incorrecta.", "warning"); }

						}else{
									swal("", "El Mando ingresado es incorrecto.", "warning");
						}				

			}else{ 

				swal("", "Faltan datos por registrar.", "warning");
			}	
	 		
 		}else if(idPuestaDisposicion != ""){  ////////////////////// SI EL TIPO MODAL ES UNO QUIERE DECIR QUE YA HAY UNA PUESTA /////////////////////


 				var link = document.getElementById("imgVeicle");	
			    // Changing the href attribute value
			    link.setAttribute("href", "#puestdisposVehic");
			    link.setAttribute("data-toggle", "modal");				
			
				cont = document.getElementById('contMOdalPuedisposVehic');
				ajax=objetoAjax();
				ajax.open("POST", "format/puestaDisposicion/modalVehicle.php");
				ajax.onreadystatechange = function(){
					if (ajax.readyState == 4 && ajax.status == 200) {
						cont.innerHTML = ajax.responseText;				
						$('#puestdispos').modal('hide'); 
						$('#puestdisposVehic').modal('show');
					}
				}
				ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
				ajax.send("&idVeicle="+idVeicle+"&typeForm="+typeForm+"&idPuestaDisposicion="+idPuestaDisposicion+"&idEnlace="+idEnlace+"&b="+b);

 		}
   
}


function getData(){


		var newBrwoser= document.getElementById("newBrwoser").value;
 		var newBrwoser_val= document.querySelector("#newBrwosers"  + " option[value='" + newBrwoser+ "']").dataset.value;
		var newBrwosers_id= document.querySelector("#newBrwosers"  + " option[value='" + newBrwoser+ "']").dataset.id;		

		cont = document.getElementById('contDataMando');
		ajax=objetoAjax();
		ajax.open("POST", "format/puestaDisposicion/dataMando.php");

		ajax.onreadystatechange = function(){
			if (ajax.readyState == 4 && ajax.status == 200) {
				cont.innerHTML = ajax.responseText;
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("&newBrwosers_id="+newBrwosers_id);

}

function getDataMunicip(){


		 newBrwoserFisca= document.getElementById("newBrwoserFisca").value;
 		var newBrwoser_val= document.querySelector("#newBrwosersFis"  + " option[value='" + newBrwoserFisca+ "']").dataset.value;
		var newBrwosers_id= document.querySelector("#newBrwosersFis"  + " option[value='" + newBrwoserFisca+ "']").dataset.id;		

		cont = document.getElementById('munciData');
		ajax=objetoAjax();
		ajax.open("POST", "format/puestaDisposicion/munciData.php");

		ajax.onreadystatechange = function(){
			if (ajax.readyState == 4 && ajax.status == 200) {
				cont.innerHTML = ajax.responseText;
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("&newBrwosers_id="+newBrwosers_id);

}

function getDataMunicipVehi(){


		var newBrwoserFiscaVehi= document.getElementById("newBrwoserFiscaVehi").value;
 		var newBrwoser_val= document.querySelector("#newBrwosersFisVehi"  + " option[value='" + newBrwoserFiscaVehi+ "']").dataset.value;
		var newBrwosers_id= document.querySelector("#newBrwosersFisVehi"  + " option[value='" + newBrwoserFiscaVehi+ "']").dataset.id;		

		cont = document.getElementById('munciDataVehi');
		ajax=objetoAjax();
		ajax.open("POST", "format/puestaDisposicion/munciDataVehi.php");

		ajax.onreadystatechange = function(){
			if (ajax.readyState == 4 && ajax.status == 200) {
				cont.innerHTML = ajax.responseText;
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("&newBrwosers_id="+newBrwosers_id);

}

function getDataMuniciPerson(){


		var newBrwoserFiscaPerson= document.getElementById("newBrwoserFiscaPerson").value;
 		var newBrwoser_val= document.querySelector("#newBrwosersFisPerson"  + " option[value='" + newBrwoserFiscaPerson+ "']").dataset.value;
		var newBrwosers_id= document.querySelector("#newBrwosersFisPerson"  + " option[value='" + newBrwoserFiscaPerson+ "']").dataset.id;		

		cont = document.getElementById('munciDataPerson');
		ajax=objetoAjax();
		ajax.open("POST", "format/puestaDisposicion/munciDataPerson.php");

		ajax.onreadystatechange = function(){
			if (ajax.readyState == 4 && ajax.status == 200) {
				cont.innerHTML = ajax.responseText;
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("&newBrwosers_id="+newBrwosers_id);

}



function getDataColoni(){


		var newBrwoserMun= document.getElementById("newBrwoserMun").value;
 		var newBrwoser_val= document.querySelector("#newBrwosersMun"  + " option[value='" + newBrwoserMun+ "']").dataset.value;
		var newBrwosers_id= document.querySelector("#newBrwosersMun"  + " option[value='" + newBrwoserMun+ "']").dataset.id;		

		cont = document.getElementById('coloniData');
		ajax=objetoAjax();
		ajax.open("POST", "format/puestaDisposicion/coloniData.php");

		ajax.onreadystatechange = function(){
			if (ajax.readyState == 4 && ajax.status == 200) {
				cont.innerHTML = ajax.responseText;
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("&newBrwosers_id="+newBrwosers_id);

}
function getDataColoniVehi(){


		var newBrwoserMunVehi= document.getElementById("newBrwoserMunVehi").value; 		
		var newBrwosers_id= document.querySelector("#newBrwosersMunVehi"  + " option[value='" + newBrwoserMunVehi+ "']").dataset.id;		

		cont = document.getElementById('coloniDataVehi');
		ajax=objetoAjax();
		ajax.open("POST", "format/puestaDisposicion/coloniDataVehi.php");

		ajax.onreadystatechange = function(){
			if (ajax.readyState == 4 && ajax.status == 200) {
				cont.innerHTML = ajax.responseText;
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("&newBrwosers_id="+newBrwosers_id);

}

function getDataColoniPerson(){


		var newBrwoserMunPerson= document.getElementById("newBrwoserMunPerson").value; 		
		var newBrwosers_id= document.querySelector("#newBrwosersMunPerson"  + " option[value='" + newBrwoserMunPerson+ "']").dataset.id;		

		cont = document.getElementById('coloniDataPerson');
		ajax=objetoAjax();
		ajax.open("POST", "format/puestaDisposicion/coloniDataPerson.php");

		ajax.onreadystatechange = function(){
			if (ajax.readyState == 4 && ajax.status == 200) {
				cont.innerHTML = ajax.responseText;
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("&newBrwosers_id="+newBrwosers_id);

}

function getPOstalCode(){

		var newBrwoserColo= document.getElementById("newBrwoserColo").value;
		var newBrwosers_id= document.querySelector("#newBrwosersColo"  + " option[value='" + newBrwoserColo+ "']").dataset.id;
		cont = document.getElementById('codepostalid');
		ajax=objetoAjax();
		ajax.open("POST", "format/puestaDisposicion/codePOstalData.php");

		ajax.onreadystatechange = function(){
			if (ajax.readyState == 4 && ajax.status == 200) {
				cont.innerHTML = ajax.responseText;
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("&newBrwosers_id="+newBrwosers_id);

}


////////////////////////////////////// MODAL PERSONAS //////////////////////////////////////

function showmodalPersonas(tipoMOd, idEnlace, idPersona, b){
	/////////////////////////// SI EL TIPO MODAL ES UNA NUEVA PUESTA ENTONCES ES  0 ///////////////////////////////

					/////////////////////////// SI EL TIPO MODAL ES UNA NUEVA PUESTA ENTONCES ES  0 ///////////////////////////////
	var idPuestaDisposicion= document.getElementById("idPuestaDisposicion").value;
	
	if(idPuestaDisposicion == ""){

			var validar = validateDataPuesta();	
			//////////// VALIDAR CAMPOS QUE SEAN REQUERIDO PARA LA PUESTA A DIPOSICION //////////////////
			if(validar){

						var newBrwosers_id= document.querySelector("#newBrwosers"  + " option[value='" + newBrwoser+ "']").dataset.id;	
						var newBrwosers_id_fisca= document.querySelector("#newBrwosersFis"  + " option[value='" + newBrwoserFisca+ "']").dataset.id;
						var newBrwosers_id_mun= document.querySelector("#newBrwosersMun"  + " option[value='" + newBrwoserMun+ "']").dataset.id;
						var newBrwosers_id_colo= document.querySelector("#newBrwosersColo"  + " option[value='" + newBrwoserColo+ "']").dataset.id;
						
					var nucPuestaDisposi= document.getElementById("nucPuestaDisposi").value;
					var codepostalidPeusta= document.getElementById("codepostalidPeusta").value;
					var numberCallePuesta= document.getElementById("numberCallePuesta").value;
					 if(numberCallePuesta ==""){ numberCallePuesta = 0; }

					 var uno = document.getElementById("acepto1").checked;
					 var dos = document.getElementById("acepto2").checked;
					 var tres = document.getElementById("acepto3").checked;
					 var cuat = document.getElementById("acepto4").checked;
					 var cinc = document.getElementById("acepto5").checked;

					 var naracion= document.getElementById("textNarracion").value;
					


				var link = document.getElementById("imgPerson");	
			    // Changing the href attribute value
			    link.setAttribute("href", "#modalPersonas");
			    link.setAttribute("data-toggle", "modal");		

			    var puestaData = Array();
			    puestaData[0] = newBrwosers_id;   puestaData[1] = "'"+nucPuestaDisposi+"'"; puestaData[2] = "'"+fechaevento+"'"; puestaData[3] =  newBrwosers_id_fisca;
			    puestaData[4] = newBrwosers_id_mun; puestaData[5] = newBrwosers_id_colo; puestaData[6] = codepostalidPeusta; puestaData[7] = "'"+calleInputPuesta+"'";
			    puestaData[8] = numberCallePuesta; puestaData[9] = tipoMOd;

			    puestaData[10] = uno; puestaData[11] = dos; puestaData[12] = tres; puestaData[13] = cuat; puestaData[14] = cinc; puestaData[15] = naracion;

			     var jObject={};  for(i in puestaData){  jObject[i] = puestaData[i];   }
			     jObject= JSON.stringify(jObject);
			
				cont = document.getElementById('contModalPersonas');
				ajax=objetoAjax();
				ajax.open("POST", "format/puestaDisposicion/modalPersonas.php");
				ajax.onreadystatechange = function(){
					if (ajax.readyState == 4 && ajax.status == 200) {
						cont.innerHTML = ajax.responseText;				
						$('#puestdispos').modal('hide'); 
						$('#modalPersonas').modal('show');
					}
				}
				ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
				ajax.send("&idPersona="+idPersona+"&jObject="+jObject+"&idEnlace="+idEnlace+"&b="+b);

			}else{ 

				swal("", "Faltan datos por registrar.", "warning");
			}	
	 		
 		}else if(idPuestaDisposicion != ""){  ////////////////////// SI EL TIPO MODAL ES UNO QUIERE DECIR QUE YA HAY UNA PUESTA /////////////////////

 							
 				var link = document.getElementById("imgPerson");	
			    // Changing the href attribute value
			    link.setAttribute("href", "#modalPersonas");
			    link.setAttribute("data-toggle", "modal");				
			
				cont = document.getElementById('contModalPersonas');
				ajax=objetoAjax();
				ajax.open("POST", "format/puestaDisposicion/modalPersonas.php");
				ajax.onreadystatechange = function(){
					if (ajax.readyState == 4 && ajax.status == 200) {
						cont.innerHTML = ajax.responseText;				
						$('#puestdispos').modal('hide'); 
						$('#modalPersonas').modal('show');
					}
				}
				ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
				ajax.send("&idPuestaDisposicion="+idPuestaDisposicion+"&idEnlace="+idEnlace+"&idPersona="+idPersona+"&b="+b);

 		}


}

function closemodalPersonas(){
  x = 0;
	 $('#puestdispos').modal('show'); 
	 $('#modalPersonas').modal('hide');
}

function hoverv(element, t){


			if(t == "ve"){element.setAttribute('src', 'img/iconosPuestaDispo/Cuadrados/Color-13.png');} 
			if(t == "pe"){element.setAttribute('src', 'img/iconosPuestaDispo/Cuadrados/Color-14.png');} 
			if(t == "ar"){element.setAttribute('src', 'img/iconosPuestaDispo/Cuadrados/Color-15.png');} 
			if(t == "dr"){element.setAttribute('src', 'img/iconosPuestaDispo/Cuadrados/Color-16.png');} 
			if(t == "op"){element.setAttribute('src', 'img/iconosPuestaDispo/Cuadrados/Color-17.png');} 
			if(t == "fo"){element.setAttribute('src', 'img/iconosPuestaDispo/Cuadrados/Color-18.png');} 
			if(t == "he"){element.setAttribute('src', 'img/iconosPuestaDispo/Cuadrados/Color-19.png');} 
			if(t == "ma"){element.setAttribute('src', 'img/iconosPuestaDispo/Cuadrados/Color-20.png');} 
			if(t == "en"){element.setAttribute('src', 'img/iconosPuestaDispo/Cuadrados/Color-21.png');} 
			if(t == "in"){element.setAttribute('src', 'img/iconosPuestaDispo/Cuadrados/Color-22.png');} 
			if(t == "ind"){element.setAttribute('src','img/iconosPuestaDispo/Cuadrados/Color-23.png');} 
			if(t == "ap"){element.setAttribute('src', 'img/iconosPuestaDispo/Cuadrados/Color-24.png');} 

}

function unhoverv(element, t){


			 if(t == "ve"){element.setAttribute('src', 'img/iconosPuestaDispo/Cuadrados/Azul-01.png');}
			  if(t == "pe"){element.setAttribute('src', 'img/iconosPuestaDispo/Cuadrados/Azul-02.png');}
			   if(t == "ar"){element.setAttribute('src', 'img/iconosPuestaDispo/Cuadrados/Azul-03.png');}
			    if(t == "dr"){element.setAttribute('src', 'img/iconosPuestaDispo/Cuadrados/Azul-04.png');}
			     if(t == "op"){element.setAttribute('src', 'img/iconosPuestaDispo/Cuadrados/Azul-05.png');}
			      if(t == "fo"){element.setAttribute('src', 'img/iconosPuestaDispo/Cuadrados/Azul-06.png');}
			       if(t == "he"){element.setAttribute('src', 'img/iconosPuestaDispo/Cuadrados/Azul-07.png');}
			        if(t == "ma"){element.setAttribute('src', 'img/iconosPuestaDispo/Cuadrados/Azul-08.png');}
			         if(t == "en"){element.setAttribute('src', 'img/iconosPuestaDispo/Cuadrados/Azul-09.png');}
			          if(t == "in"){element.setAttribute('src', 'img/iconosPuestaDispo/Cuadrados/Azul-10.png');}
			           if(t == "ind"){element.setAttribute('src', 'img/iconosPuestaDispo/Cuadrados/Azul-11.png');}
			            if(t == "ap"){element.setAttribute('src', 'img/iconosPuestaDispo/Cuadrados/Azul-12.png');}

}






////////////////////////////////////// MODAL PERSONAS //////////////////////////////////////



function registrarPersona(idEnlace, tipoActualizacion, tipoArch, b, idPersona){
	
	var idEnlace = idEnlace;
	var tipoActualizacion = tipoActualizacion;
	var idPersona = idPersona;

 var textNombre = $("#textNombre").val();
	var textApPaterno = $("#textApPaterno").val();
	var textApMaterno = $("#textApMaterno").val();
	var textEdad = $("#textEdad").val();
	var textSexo = $("#textSexo").val();
	var fechaDetencion = moment($("#fechaDetencion").val(), 'YYYY/MM/DD'); 
 var textCatDelitos = $("#textTipoDelito").val(); 
 var textDisposicionDe = $("#textDisposicionDe").val();


    if(textNombre!= "" && textApPaterno != "" && textApMaterno != "" && fechaDetencion != "" && textEdad  != "" 
			&& textSexo != "" && textCatDelitos != "" && textInvFlag != 0 && textDisposicionDe != 0){

	/*Obtener datos del formulario*/

	var textAlias = $("#textAlias").val();

	var dia = fechaDetencion.format('D'); 
	var mes = fechaDetencion.format('M'); 
	var anio = fechaDetencion.format('YYYY'); 
	var arrDelitos = document.getElementsByName("delitos[]");
 
    
	var textBandas = $("#textBandas").val();
	var textOrgCriminal = $("#textOrgCriminal").val();
	var textAgraviado = $("#textAgraviado").val();
	var textInvFlag = $("#textInvFlag").val();
	var textBandaSolitario = $("#textBandaSolitario").val();
	var textAvPP = $("#textAvPP").val();
	var textNumBas = $("#textNumBas").val();
	var textRequerido = $("#textRequerido").val();
	var textOficio = $("#textOficio").val();
	var textTipoDelitoId = $("#listaCatDelitos").find("option[value='" + textCatDelitos + "']").attr('data-id');
	var textObservaciones = $("#textObservaciones").val();
	var jObjectDelitos = {};
 
 

	//// DATA DE LA PUESTA A DISPOSICION /////
	var idPuestaDisposicion= document.getElementById("idPuestaDisposicion").value;
			var tipoMOd= document.getElementById("tipoMOd").value;

			var idMandoPuesta= document.getElementById("idMandoPuesta").value;
			var nucPuestaDisposi= document.getElementById("nucPuestaDisposi").value;
			var fechaevento= document.getElementById("fechaevento").value;
		

			var newBrwosers_id_fisca= document.getElementById("newBrwosers_id_fisca").value;
			var newBrwosers_id_mun= document.getElementById("newBrwosers_id_mun").value;
			var newBrwosers_id_colo= document.getElementById("newBrwosers_id_colo").value;

			var codepostalidPeusta= document.getElementById("codepostalidPeusta").value;
			var calleInputPuesta= document.getElementById("calleInputPuesta").value;
			var numberCallePuesta= document.getElementById("numberCallePuesta").value;
			if(numberCallePuesta == ""){ numberCallePuesta = 0; }
			var uno= document.getElementById("uno").value;
				var dos= document.getElementById("dos").value;
					var tres= document.getElementById("tres").value;
						var cuatro= document.getElementById("cuatro").value;
							var cinco= document.getElementById("cinco").value;
								var narac= document.getElementById("narac").value;

			var cont= document.getElementById("");
			

			var puestaDataVehi = Array();
			    puestaDataVehi[0] = idMandoPuesta;   puestaDataVehi[1] = "'"+nucPuestaDisposi+"'"; puestaDataVehi[2] = "'"+fechaevento+"'"; puestaDataVehi[3] =  newBrwosers_id_fisca;
			    puestaDataVehi[4] = newBrwosers_id_mun; puestaDataVehi[5] = newBrwosers_id_colo; puestaDataVehi[6] = codepostalidPeusta; puestaDataVehi[7] = "'"+calleInputPuesta+"'";
			    puestaDataVehi[8] = numberCallePuesta; puestaDataVehi[9] = tipoMOd; puestaDataVehi[10] = uno; puestaDataVehi[11] = dos; puestaDataVehi[12] = tres;
			    puestaDataVehi[13] = cuatro; puestaDataVehi[14] = cinco; puestaDataVehi[15] = narac;

			     var jObject={};  for(i in puestaDataVehi){  jObject[i] = puestaDataVehi[i];   }
			     jObject= JSON.stringify(jObject);
    //// DATA DE LA PUESTA A DISPOSICION /////

    /// DATA DE DELITOS ///
if(arrDelitos.length > 0){
	for(i=0;i<arrDelitos.length;i++){ jObjectDelitos[i] = arrDelitos[i].value; }
	jObjectDelitos = JSON.stringify(jObjectDelitos);
}else{
	jObjectDelitos = JSON.stringify('2');
}
  	/// DATA DE DELITOS ///


	 $.ajax({
        type: "POST",
        dataType: 'html',
        url: "format/puestaDisposicion/registroPersonas.php",
        data: "nombre="+textNombre+"&ap_paterno="+textApPaterno+"&ap_materno="+textApMaterno+"&alias="+textAlias+"&edad="+textEdad+'&sexo='+textSexo+
              "&dia="+dia+"&mes="+mes+"&anio="+anio+"&bandas="+textBandas+"&orgCriminal="+textOrgCriminal+
              "&agraviado="+textAgraviado+"&inv_flag="+textInvFlag+"&banda_solitario="+textBandaSolitario+"&AvPP="+textAvPP+
              "&numBas="+textNumBas+"&DisposicionDe="+textDisposicionDe+"&requerido="+textRequerido+"&oficio="+textOficio+"&tipoDelitoId="+textTipoDelitoId+
         "&observaciones="+textObservaciones+"&arrayDelitos="+jObjectDelitos+"&jObject="+jObject+"&idEnlace="+idEnlace+"&idPuestaDisposicion="+idPuestaDisposicion+"&tipoActualizacion="+tipoActualizacion+"&idPersona="+idPersona,
        success: function(resp){
            
        					//$('#respuesta').html(resp);
            	var json = resp;
													var obj = eval("(" + json + ")");
													if (obj.first == "NO") { swal("", "No se registro verifique los datos.", "warning"); }else{
														 if (obj.first == "SI") {                    
															
														 	var obj = eval("(" + json + ")");
														 	swal("", "Persona Registrado Exitosamente.", "success");
															//// SE DEBE DE ACTUALIZAR LA INFO DE LA PUESTA A DISPOSICION
															closemodalPersonas();
															showmodalPueDispo(1, idEnlace, obj.idpuestaultimo, tipoArch, b);

														 }
													}


        }
    });
	}else{
		swal("", "Faltan datos por registrar.", "warning");
	}
}

/////////////////////////// ELIMINAR UN ITEM DE ALGUN FORMULARIO /////////////////////////////////


function deleteItemForm(form, idItem, idEnlace, idPuestaDisposicion){

				swal({
			title: "Estas seguro de Eliminar?",
    text: "Se eliminara por completo el registro de la Base de Datos!",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: '#DD6B55',
    confirmButtonText: 'Si. Eliminar',
    cancelButtonText: "No, Cancelar"
				
			},
			function(isConfirm){
				if (isConfirm) {

						ajax=objetoAjax();
						ajax.open("POST", "format/puestaDisposicion/deleteItemForm.php");

						ajax.onreadystatechange = function(){
							if (ajax.readyState == 4 && ajax.status == 200) {			
											var json = ajax.responseText;
													var obj = eval("(" + json + ")");
													if (obj.first == "NO") { swal("", "No se elimino verifique los datos.", "warning"); }else{
														 if (obj.first == "SI") {    															
														 	var obj = eval("(" + json + ")");
														 	swal("", "Registro eliminado exitosamente.", "success");															
															 showmodalPueDispo(1, idEnlace, idPuestaDisposicion, 0, 1);
														 }
													}
										}
						}
						ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
						ajax.send("&form="+form+"&idItem="+idItem+"&idEnlace="+idEnlace+"&idPuestaDisposicion="+idPuestaDisposicion);

					
				}
			});	
					

}


//// FORESTALES /////

function modalForestales(tipoMOd, idEnlace, idForestales, be){
	/////////////////////////// SI EL TIPO MODAL ES UNA NUEVA PUESTA ENTONCES ES  0 ///////////////////////////////
	var idPuestaDisposicion= document.getElementById("idPuestaDisposicion").value;
	var validar = validateDataPuesta();	
	//////////// VALIDAR CAMPOS QUE SEAN REQUERIDO PARA LA PUESTA A DIPOSICION //////////////////

	 if(idPuestaDisposicion == ""  ){

	 			if(validar){
		/*Obtener id mando*/
		var newBrwoser= document.getElementById("newBrwoser").value;
	 	var newBrwoser_val= document.querySelector("#newBrwosers"  + " option[value='" + newBrwoser+ "']").dataset.value;
		var newBrwosers_id = document.querySelector("#newBrwosers"  + " option[value='" + newBrwoser+ "']").dataset.id;

		var newBrwosers_id_fisca= document.querySelector("#newBrwosersFis"  + " option[value='" + newBrwoserFisca+ "']").dataset.id;
		var newBrwosers_id_mun= document.querySelector("#newBrwosersMun"  + " option[value='" + newBrwoserMun+ "']").dataset.id;
		var newBrwosers_id_colo= document.querySelector("#newBrwosersColo"  + " option[value='" + newBrwoserColo+ "']").dataset.id;
							
		var nucPuestaDisposi= document.getElementById("nucPuestaDisposi").value;
		var codepostalidPeusta= document.getElementById("codepostalidPeusta").value;
		var numberCallePuesta= document.getElementById("numberCallePuesta").value;
		 if(numberCallePuesta == ""){ numberCallePuesta = 0; }
		

		var uno = document.getElementById("acepto1").checked;
																			 var dos = document.getElementById("acepto2").checked;
																			 var tres = document.getElementById("acepto3").checked;
																			 var cuatro = document.getElementById("acepto4").checked;
																			 var cinco = document.getElementById("acepto5").checked;

																			 var naracion= document.getElementById("textNarracion").value;
																			


		var puestaData = Array();
			    puestaData[0] = newBrwosers_id;   puestaData[1] = "'"+nucPuestaDisposi+"'"; puestaData[2] = "'"+fechaevento+"'"; puestaData[3] =  newBrwosers_id_fisca;
			    puestaData[4] = newBrwosers_id_mun; puestaData[5] = newBrwosers_id_colo; puestaData[6] = codepostalidPeusta; puestaData[7] = "'"+calleInputPuesta+"'";
			    puestaData[8] = numberCallePuesta; puestaData[9] = tipoMOd; puestaData[10] = newBrwoser_val; 

			    puestaData[11] = uno; puestaData[12] = dos; puestaData[13] = tres;
			    puestaData[14] = cuatro; puestaData[15] = cinco; puestaData[16] = naracion;


			     var jObject={};  for(i in puestaData){  jObject[i] = puestaData[i];   }

			     jObject= JSON.stringify(jObject);

	
	    /*Validamos si ha llenado el formulario*/    
	    if(idPuestaDisposicion == ""  ){

			    	cont = document.getElementById('contModalForestales2');
								ajax=objetoAjax();
								ajax.open("POST", "format/puestaDisposicion/modalForestales.php");

								ajax.onreadystatechange = function(){
									if (ajax.readyState == 4 && ajax.status == 200) {
										cont.innerHTML = ajax.responseText;

										$('#puestdispos').modal('hide'); 
										$('#modalForestales').modal('show');
									}
								}
								ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
								ajax.send("&idForestales="+idForestales+"&jObject="+jObject+"&idEnlace="+idEnlace+"&be="+be);
							   
		    }else{

		    				if(idPuestaDisposicion  != "" ){

		    								cont = document.getElementById('contModalForestales2');
														ajax=objetoAjax();
														ajax.open("POST", "format/puestaDisposicion/modalForestales.php");

														ajax.onreadystatechange = function(){
															if (ajax.readyState == 4 && ajax.status == 200) {
																cont.innerHTML = ajax.responseText;

																$('#puestdispos').modal('hide'); 
																$('#modalForestales').modal('show');
															}
														}
														ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
														ajax.send("&idForestales="+idForestales+"&tipoMOd="+tipoMOd+"&idPuestaDisposicion="+idPuestaDisposicion+"&idEnlace="+idEnlace+"&be="+be);

		    				}

		    }

		}else{ 
			swal("", "Faltan datos por registrar.", "warning");
		}	

	 }else{

		    				if(idPuestaDisposicion  != "" ){

		    								cont = document.getElementById('contModalForestales2');
														ajax=objetoAjax();
														ajax.open("POST", "format/puestaDisposicion/modalForestales.php");

														ajax.onreadystatechange = function(){
															if (ajax.readyState == 4 && ajax.status == 200) {
																cont.innerHTML = ajax.responseText;

																$('#puestdispos').modal('hide'); 
																$('#modalForestales').modal('show');
															}
														}
														ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
														ajax.send("&idForestales="+idForestales+"&tipoMOd="+tipoMOd+"&idPuestaDisposicion="+idPuestaDisposicion+"&idEnlace="+idEnlace+"&be="+be);

		    				}

		    }


	
}

function closemodalForestales(){
	 $('#puestdispos').modal('show'); 
	 $('#modalForestales').modal('hide');
}


/// registrar forestales ///
	
		function registrarForestales(idEnlace, typearch, b, tipoActualizacion , idForestales){
				
				/// VALIDACIONES ///
				var idEnlace = idEnlace;				
				var tipoActualizacion = tipoActualizacion;
					var idForestales = idForestales;
		


				var textCatMadera = $("#textCatMadera").val();
				var objMadera = $("#listaCatMadera").find("option[value='" + textCatMadera + "']").attr('data-id');

				if(objMadera != null && objMadera.length > 0){

			 var textVolumen = $("#textVolumen").val();

				var semovientenumber = $("#semovientenumber").val();

				    /// VALIDACIONES ///
				if( textVolumen != "" && semovientenumber != "" ){

					var textObservaciones = $("#textObservacionesForest").val();
					//// DATA DE LA PUESTA A DISPOSICION /////
					var idPuestaDisposicion= document.getElementById("idPuestaDisposicion").value;
					var tipoMOd= document.getElementById("tipoMOd").value;

					var idMandoPuesta = document.getElementById("idMandoPuesta").value;
					var nucPuestaDisposi= document.getElementById("nucPuestaDisposi").value;
					var fechaevento= document.getElementById("fechaevento").value;
					var newBrwosers_id_fisca= document.getElementById("newBrwosers_id_fisca").value;
					var newBrwosers_id_mun= document.getElementById("newBrwosers_id_mun").value;
					var newBrwosers_id_colo= document.getElementById("newBrwosers_id_colo").value;
					var codepostalidPeusta= document.getElementById("codepostalidPeusta").value;
					var calleInputPuesta= document.getElementById("calleInputPuesta").value;
					var numberCallePuesta= document.getElementById("numberCallePuesta").value;
					if(numberCallePuesta == ""){ numberCallePuesta = 0; }


				var uno= document.getElementById("uno").value;
				var dos= document.getElementById("dos").value;
					var tres= document.getElementById("tres").value;
						var cuatro= document.getElementById("cuatro").value;
							var cinco= document.getElementById("cinco").value;
								var narac= document.getElementById("narac").value;



					var puestaDataPersona = Array();
							    puestaDataPersona[0] = idMandoPuesta;  puestaDataPersona[1] = "'"+nucPuestaDisposi+"'"; puestaDataPersona[2] = "'"+fechaevento+"'"; puestaDataPersona[3] =  newBrwosers_id_fisca;
							    puestaDataPersona[4] = newBrwosers_id_mun; puestaDataPersona[5] = newBrwosers_id_colo; puestaDataPersona[6] = codepostalidPeusta; puestaDataPersona[7] = "'"+calleInputPuesta+"'";
							    puestaDataPersona[8] = numberCallePuesta; puestaDataPersona[9] = tipoMOd; puestaDataPersona[10] = uno; puestaDataPersona[11] = dos; puestaDataPersona[12] = tres;
			    puestaDataPersona[13] = cuatro; puestaDataPersona[14] = cinco; puestaDataPersona[15] = narac;


							     var jObject={};  
							     for(i in puestaDataPersona){  
							     	jObject[i] = puestaDataPersona[i];   
							     }
							     jObject = JSON.stringify(jObject);
				    //// DATA DE LA PUESTA A DISPOSICION /////

					 $.ajax({
				        type: "POST",
				        dataType: 'html',
				        url: "format/puestaDisposicion/registroForestales.php",
				        data: "catMadera_id="+objMadera+"&volumen="+textVolumen+"&semoviente="+semovientenumber+"&observaciones="+textObservaciones+"&jObject="+jObject+"&idEnlace="+idEnlace+
				               "&idPuestaDisposicion="+idPuestaDisposicion+"&tipoActualizacion="+tipoActualizacion+"&idForestales="+idForestales,
				        success: function(resp){
				           
				        			var json = resp;
															var obj = eval("(" + json + ")");
															if (obj.first == "NO") { swal("", "No se registro verifique los datos.", "warning"); }else{
																 if (obj.first == "SI") {                    
																	
																 	var obj = eval("(" + json + ")");
																 	swal("", "Producto Forestal Registrado Exitosamente.", "success");
																	//// SE DEBE DE ACTUALIZAR LA INFO DE LA PUESTA A DISPOSICION
																	closemodalForestales();
																	
																	showmodalPueDispo(1, idEnlace, obj.idpuestaultimo, typearch, b);

																 }
															}
				        }
				    });
					}else{
						swal("", "Faltan datos por registrar.", "warning");
					}


				}else{		swal("", "El genero seleccionado es incorrecto.", "warning"); }		

}

/// registrar forestales ///



////////////////////////////////////// MODAL DROGAS //////////////////////////////////////


function modalDrogas(tipoMOd, idEnlace, idDroga, b){
	/////////////////////////// SI EL TIPO MODAL ES UNA NUEVA PUESTA ENTONCES ES  0 ///////////////////////////////
	var idPuestaDisposicion= document.getElementById("idPuestaDisposicion").value;

	var validar = validateDataPuesta();	
	//////////// VALIDAR CAMPOS QUE SEAN REQUERIDO PARA LA PUESTA A DIPOSICION //////////////////

	if(idPuestaDisposicion == ""){

					if(validar){
		/*Obtener id mando*/
		var newBrwoser= document.getElementById("newBrwoser").value;
	 	var newBrwoser_val= document.querySelector("#newBrwosers"  + " option[value='" + newBrwoser+ "']").dataset.value;
		var newBrwosers_id = document.querySelector("#newBrwosers"  + " option[value='" + newBrwoser+ "']").dataset.id;

		var newBrwosers_id_fisca= document.querySelector("#newBrwosersFis"  + " option[value='" + newBrwoserFisca+ "']").dataset.id;
		var newBrwosers_id_mun= document.querySelector("#newBrwosersMun"  + " option[value='" + newBrwoserMun+ "']").dataset.id;
		var newBrwosers_id_colo= document.querySelector("#newBrwosersColo"  + " option[value='" + newBrwoserColo+ "']").dataset.id;
							
		var nucPuestaDisposi= document.getElementById("nucPuestaDisposi").value;
		var codepostalidPeusta= document.getElementById("codepostalidPeusta").value;
		var numberCallePuesta= document.getElementById("numberCallePuesta").value;
		 if(numberCallePuesta == ""){ numberCallePuesta = 0; }

		  var uno = document.getElementById("acepto1").checked;
																			 var dos = document.getElementById("acepto2").checked;
																			 var tres = document.getElementById("acepto3").checked;
																			 var cuatro = document.getElementById("acepto4").checked;
																			 var cinco = document.getElementById("acepto5").checked;

																			 var naracion= document.getElementById("textNarracion").value;

		

		var puestaData = Array();
			    puestaData[0] = newBrwosers_id;   puestaData[1] = "'"+nucPuestaDisposi+"'"; puestaData[2] = "'"+fechaevento+"'"; puestaData[3] =  newBrwosers_id_fisca;
			    puestaData[4] = newBrwosers_id_mun; puestaData[5] = newBrwosers_id_colo; puestaData[6] = codepostalidPeusta; puestaData[7] = "'"+calleInputPuesta+"'";
			    puestaData[8] = numberCallePuesta; puestaData[9] = tipoMOd; puestaData[10] = newBrwoser_val; 


			    puestaData[11] = uno; puestaData[12] = dos; puestaData[13] = tres;
			    puestaData[14] = cuatro; puestaData[15] = cinco; puestaData[16] = naracion;


			     var jObject={};  for(i in puestaData){  jObject[i] = puestaData[i];   }
			     jObject= JSON.stringify(jObject);

	    	cont = document.getElementById('contModalDrogas');
			ajax=objetoAjax();
			ajax.open("POST", "format/puestaDisposicion/modalDrogas.php");

			ajax.onreadystatechange = function(){
				if (ajax.readyState == 4 && ajax.status == 200) {
					cont.innerHTML = ajax.responseText;

					$('#puestdispos').modal('hide'); 
					$('#modalDrogase').modal('show');
				}
			}
			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			ajax.send("&idDroga="+idDroga+"&jObject="+jObject+"&idEnlace="+idEnlace+"&b="+b);
		    
		}else{ 
			swal("", "Faltan datos por registrar.", "warning");
		}	

	}else if(idPuestaDisposicion != ""){ 


					  	cont = document.getElementById('contModalDrogas');
								ajax=objetoAjax();
								ajax.open("POST", "format/puestaDisposicion/modalDrogas.php");

								ajax.onreadystatechange = function(){
									if (ajax.readyState == 4 && ajax.status == 200) {
										cont.innerHTML = ajax.responseText;

										$('#puestdispos').modal('hide'); 
										$('#modalDrogase').modal('show');
									}
								}
								ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
								ajax.send("&idDroga="+idDroga+"&tipoMOd="+tipoMOd+"&idPuestaDisposicion="+idPuestaDisposicion+"&idEnlace="+idEnlace+"&b="+b);

	}


}

function closemodalDrogas(){
	 $('#puestdispos').modal('show'); 
	 $('#modalDrogase').modal('hide');
}

//// registrar drogas


function registrarDrogas(idEnlace, typearch, b,  tipoActualizacion , idDroga){
	/// VALIDACIONES ///
	var idEnlace = idEnlace;
	var tipoActualizacion = tipoActualizacion;
	var idDroga = idDroga;

    ///Obtener datos del formulario///

var textCatDroga = $("#textCatDroga").val();
var objDroga = $("#listaCatDroga").find("option[value='" + textCatDroga + "']").attr('data-id');

if(objDroga != null && objDroga.length > 0){

					var textKilogramos = $("#textKilogramos").val();
										    /// VALIDACIONES ///
						if(textKilogramos != ""){

						
						var textObservaciones = $("#textObservacionesDrog").val();

							//// DATA DE LA PUESTA A DISPOSICION /////
							var idPuestaDisposicion= document.getElementById("idPuestaDisposicion").value;
							var tipoMOd= document.getElementById("tipoMOd").value;

							var idMandoPuesta = document.getElementById("idMandoPuesta").value;
							var nucPuestaDisposi= document.getElementById("nucPuestaDisposi").value;
							var fechaevento= document.getElementById("fechaevento").value;
							var newBrwosers_id_fisca= document.getElementById("newBrwosers_id_fisca").value;
							var newBrwosers_id_mun= document.getElementById("newBrwosers_id_mun").value;
							var newBrwosers_id_colo= document.getElementById("newBrwosers_id_colo").value;
							var codepostalidPeusta= document.getElementById("codepostalidPeusta").value;
							var calleInputPuesta= document.getElementById("calleInputPuesta").value;
							var numberCallePuesta= document.getElementById("numberCallePuesta").value;
							if(numberCallePuesta == ""){ numberCallePuesta = 0; }
																				var uno = document.getElementById("acepto1").checked;
																			 var dos = document.getElementById("acepto2").checked;
																			 var tres = document.getElementById("acepto3").checked;
																			 var cuatro = document.getElementById("acepto4").checked;
																			 var cinco = document.getElementById("acepto5").checked;

																			 var naracion= document.getElementById("textNarracion").value;


							var puestaDataPersona = Array();
									    puestaDataPersona[0] = idMandoPuesta;  puestaDataPersona[1] = "'"+nucPuestaDisposi+"'"; puestaDataPersona[2] = "'"+fechaevento+"'"; puestaDataPersona[3] =  newBrwosers_id_fisca;
									    puestaDataPersona[4] = newBrwosers_id_mun; puestaDataPersona[5] = newBrwosers_id_colo; puestaDataPersona[6] = codepostalidPeusta; puestaDataPersona[7] = "'"+calleInputPuesta+"'";
									    puestaDataPersona[8] = numberCallePuesta; puestaDataPersona[9] = tipoMOd; puestaDataPersona[10] = uno; puestaDataPersona[11] = dos; puestaDataPersona[12] = tres;
			    puestaDataPersona[13] = cuatro; puestaDataPersona[14] = cinco; puestaDataPersona[15] = naracion;


									     var jObject={};  
									     for(i in puestaDataPersona){  
									     	jObject[i] = puestaDataPersona[i];   
									     }
									     jObject = JSON.stringify(jObject);
						    //// DATA DE LA PUESTA A DISPOSICION /////

							 $.ajax({
						        type: "POST",
						        dataType: 'html',
						        url: "format/puestaDisposicion/registroDrogas.php",
						        data: "catDroga_id="+objDroga+"&kilogramos="+textKilogramos+"&observaciones="+textObservaciones+"&jObject="+jObject+"&idEnlace="+idEnlace+
						               "&idPuestaDisposicion="+idPuestaDisposicion+"&tipoActualizacion="+tipoActualizacion+"&idDroga="+idDroga,
						        success: function(resp){
						            var json = resp;
															var obj = eval("(" + json + ")");
															if (obj.first == "NO") { swal("", "No se registro verifique los datos.", "warning"); }else{
																 if (obj.first == "SI") {                    
																	
																 	var obj = eval("(" + json + ")");
																 	swal("", "Droga Registrada Exitosamente.", "success");
																	//// SE DEBE DE ACTUALIZAR LA INFO DE LA PUESTA A DISPOSICION
																	closemodalDrogas();
																	
																	showmodalPueDispo(1, idEnlace, obj.idpuestaultimo, typearch, b);

																 }
															}
						        }
						    });
							}else{
								swal("", "Faltan datos por registrar.", "warning");
							}


}else{ swal("", "La droga seleccionada es incorrecta.", "warning"); }

var textKilogramos = $("#textKilogramos").val();




}

////////////////////////////////////// MODAL DROGAS //////////////////////////////////////


////////////////////////////////////// MODAL OBJETO ASEGURADO //////////////////////////////////////


function modalObjetoAsegurado(tipoMOd, idEnlace, idObjeto, b){
	/////////////////////////// SI EL TIPO MODAL ES UNA NUEVA PUESTA ENTONCES ES  0 ///////////////////////////////
	var idPuestaDisposicion= document.getElementById("idPuestaDisposicion").value;

	var validar = validateDataPuesta();	

	if(idPuestaDisposicion == ""  ){


	//////////// VALIDAR CAMPOS QUE SEAN REQUERIDO PARA LA PUESTA A DIPOSICION //////////////////
	if(validar){
		/*Obtener id mando*/
		var newBrwoser= document.getElementById("newBrwoser").value;
	 	var newBrwoser_val= document.querySelector("#newBrwosers"  + " option[value='" + newBrwoser+ "']").dataset.value;
		var newBrwosers_id = document.querySelector("#newBrwosers"  + " option[value='" + newBrwoser+ "']").dataset.id;

		var newBrwosers_id_fisca= document.querySelector("#newBrwosersFis"  + " option[value='" + newBrwoserFisca+ "']").dataset.id;
		var newBrwosers_id_mun= document.querySelector("#newBrwosersMun"  + " option[value='" + newBrwoserMun+ "']").dataset.id;
		var newBrwosers_id_colo= document.querySelector("#newBrwosersColo"  + " option[value='" + newBrwoserColo+ "']").dataset.id;
							
		var nucPuestaDisposi= document.getElementById("nucPuestaDisposi").value;
		var codepostalidPeusta= document.getElementById("codepostalidPeusta").value;
		var numberCallePuesta= document.getElementById("numberCallePuesta").value;
		 if(numberCallePuesta == ""){ numberCallePuesta = 0; }

			var uno = document.getElementById("acepto1").checked;
																			 var dos = document.getElementById("acepto2").checked;
																			 var tres = document.getElementById("acepto3").checked;
																			 var cuat = document.getElementById("acepto4").checked;
																			 var cinc = document.getElementById("acepto5").checked;

																			 var naracion= document.getElementById("textNarracion").value;

		var puestaData = Array();
			    puestaData[0] = newBrwosers_id;   puestaData[1] = "'"+nucPuestaDisposi+"'"; puestaData[2] = "'"+fechaevento+"'"; puestaData[3] =  newBrwosers_id_fisca;
			    puestaData[4] = newBrwosers_id_mun; puestaData[5] = newBrwosers_id_colo; puestaData[6] = codepostalidPeusta; puestaData[7] = "'"+calleInputPuesta+"'";
			    puestaData[8] = numberCallePuesta; puestaData[9] = tipoMOd; puestaData[10] = newBrwoser_val; 

			    puestaData[11] = uno; puestaData[12] = dos; puestaData[13] = tres;
			    puestaData[14] = cuat; puestaData[15] = cinc; puestaData[16] = naracion;

			     var jObject={};  for(i in puestaData){  jObject[i] = puestaData[i];   }
			     jObject= JSON.stringify(jObject);

	
	    /*Validamos si ha llenado el formulario*/    
	    if(idPuestaDisposicion == ""  ){
	    	cont = document.getElementById('contModalObjetoAsegurado');
			ajax=objetoAjax();
			ajax.open("POST", "format/puestaDisposicion/modalObjetoAsegurado.php");

			ajax.onreadystatechange = function(){
				if (ajax.readyState == 4 && ajax.status == 200) {
					cont.innerHTML = ajax.responseText;

					$('#puestdispos').modal('hide'); 
					$('#modalObjetoAsegurado').modal('show');
				}
			}
			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			ajax.send("&idObjeto="+idObjeto+"&jObject="+jObject+"&idEnlace="+idEnlace+"&b="+b);
		    }
		}else{ 
			swal("", "Faltan datos por registrar.", "warning");
		}	
}else{


					if(idPuestaDisposicion != ""){


	 														cont = document.getElementById('contModalObjetoAsegurado');
										ajax=objetoAjax();
										ajax.open("POST", "format/puestaDisposicion/modalObjetoAsegurado.php");

										ajax.onreadystatechange = function(){
											if (ajax.readyState == 4 && ajax.status == 200) {
												cont.innerHTML = ajax.responseText;

												$('#puestdispos').modal('hide'); 
												$('#modalObjetoAsegurado').modal('show');
											}
										}
										ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
										ajax.send("&idObjeto="+idObjeto+"&tipoMOd="+tipoMOd+"&idPuestaDisposicion="+idPuestaDisposicion+"&idEnlace="+idEnlace+"&b="+b);

	 						}


}




}


///////////////// REGISTRO OBJETO ASEGURADO //////////



function registroObjetoAsegurado(idEnlace, typearch, b, tipoActualizacion , idObjeto){

	
	/// VALIDACIONES ///
	var idEnlace = idEnlace;
var tipoActualizacion = tipoActualizacion;
	var idObjeto = idObjeto;
	

	var textObservaciones = $("#textObservacionesObjAsegurados").val();

	//// DATA DE LA PUESTA A DISPOSICION /////
	var idPuestaDisposicion= document.getElementById("idPuestaDisposicion").value;
	var tipoMOd= document.getElementById("tipoMOd").value;

	var idMandoPuesta = document.getElementById("idMandoPuesta").value;
	var nucPuestaDisposi= document.getElementById("nucPuestaDisposi").value;
	var fechaevento= document.getElementById("fechaevento").value;
	var newBrwosers_id_fisca= document.getElementById("newBrwosers_id_fisca").value;
	var newBrwosers_id_mun= document.getElementById("newBrwosers_id_mun").value;
	var newBrwosers_id_colo= document.getElementById("newBrwosers_id_colo").value;
	var codepostalidPeusta= document.getElementById("codepostalidPeusta").value;
	var calleInputPuesta= document.getElementById("calleInputPuesta").value;
	var numberCallePuesta= document.getElementById("numberCallePuesta").value;
	if(numberCallePuesta == ""){ numberCallePuesta = 0; }

var uno= document.getElementById("uno").value;
				var dos= document.getElementById("dos").value;
					var tres= document.getElementById("tres").value;
						var cuatro= document.getElementById("cuatro").value;
							var cinco= document.getElementById("cinco").value;
								var narac= document.getElementById("narac").value;



	var puestaDataPersona = Array();
			    puestaDataPersona[0] = idMandoPuesta;  puestaDataPersona[1] = "'"+nucPuestaDisposi+"'"; puestaDataPersona[2] = "'"+fechaevento+"'"; puestaDataPersona[3] =  newBrwosers_id_fisca;
			    puestaDataPersona[4] = newBrwosers_id_mun; puestaDataPersona[5] = newBrwosers_id_colo; puestaDataPersona[6] = codepostalidPeusta; puestaDataPersona[7] = "'"+calleInputPuesta+"'";
			    puestaDataPersona[8] = numberCallePuesta; puestaDataPersona[9] = tipoMOd; puestaDataPersona[10] = uno; puestaDataPersona[11] = dos; puestaDataPersona[12] = tres;
			    puestaDataPersona[13] = cuatro; puestaDataPersona[14] = cinco; puestaDataPersona[15] = narac;			   


			     var jObject={};  
			     for(i in puestaDataPersona){  
			     	jObject[i] = puestaDataPersona[i];   
			     }
			     jObject = JSON.stringify(jObject);
 //// DATA DE LA PUESTA A DISPOSICION /////


var herramienta = document.getElementById("herramientas").value;
var textCant = document.getElementById("textCantidad").value;
					
			$.ajax({
        type: "POST",
        dataType: 'html',
        url: "format/puestaDisposicion/registroObjetoAsegurado.php",
        data: "textObservaciones="+textObservaciones+"&herramienta="+herramienta+"&textCant="+textCant+"&jObject="+jObject+"&idEnlace="+idEnlace+"&idPuestaDisposicion="+idPuestaDisposicion+"&tipoActualizacion="+tipoActualizacion+"&idObjeto="+idObjeto,
        success: function(resp){
            var json = resp;
															var obj = eval("(" + json + ")");
															if (obj.first == "NO") { swal("", "No se registro verifique los datos.", "warning"); }else{
																 if (obj.first == "SI") {                    
																	
																 	var obj = eval("(" + json + ")");
																 	swal("", "Objeto Registrado Exitosamente.", "success");
																	//// SE DEBE DE ACTUALIZAR LA INFO DE LA PUESTA A DISPOSICION
																	closemodalObjetoAsegurado();

																		showmodalPueDispo(1, idEnlace, obj.idpuestaultimo, typearch, b);

																 }
															}
        }
    });
		}




function closemodalObjetoAsegurado(){
	 $('#puestdispos').modal('show'); 
	 $('#modalObjetoAsegurado').modal('hide');
}

//////////////////////// AGREGAR CAMPOS HERRAMIENTAS ASEGURADAS ////////////////////////////
var y = 0;
var campos_max2 = 9;   //max de 10 campos
function agregarHerramienta(){
	if (y < campos_max2) {
		$('#herramientas_aseguradas').append('<div class="uno">\<div class="form-group col-md-6"><label for="textHerramienta">Herramienta asegurada<span class="aste">(*)</span></label>\<input type="text" class="form-control" id="herramientas" name="herramientas[]"></div><div class="form-group col-md-6"> <label for="textCantidad">Cantidad<span class="aste">(*)</span></label>\<a onclick="eliminarHerramienta();" class="remover_herramienta">Remover</a>\<input type="number" class="form-control" id="textCantidadHerramienta" name="cantidad[]"></div>\</div>');
		y++;
	}
}

function eliminarHerramienta(){
	$('#herramientas_aseguradas').on("click",".remover_herramienta",function(e) {
    e.preventDefault();
    $(this).parent('div').parent().remove();
  }); y--;
}

////////////////////////////////////// MODAL OBJETO ASEGURADO //////////////////////////////////////




///////////////////// MODAL DINERO ASEGURADO /////////////////////





function modalDineroAsegurado(tipoMOd, idEnlace, idDinero, b){
	/////////////////////////// SI EL TIPO MODAL ES UNA NUEVA PUESTA ENTONCES ES  0 ///////////////////////////////
	var idPuestaDisposicion= document.getElementById("idPuestaDisposicion").value;

	var validar = validateDataPuesta();	
	//////////// VALIDAR CAMPOS QUE SEAN REQUERIDO PARA LA PUESTA A DIPOSICION //////////////////

	 if(idPuestaDisposicion == ""  ){


	 		if(validar){
									/*Obtener id mando*/
									var newBrwoser= document.getElementById("newBrwoser").value;
								 	var newBrwoser_val= document.querySelector("#newBrwosers"  + " option[value='" + newBrwoser+ "']").dataset.value;
									var newBrwosers_id = document.querySelector("#newBrwosers"  + " option[value='" + newBrwoser+ "']").dataset.id;

									var newBrwosers_id_fisca= document.querySelector("#newBrwosersFis"  + " option[value='" + newBrwoserFisca+ "']").dataset.id;
									var newBrwosers_id_mun= document.querySelector("#newBrwosersMun"  + " option[value='" + newBrwoserMun+ "']").dataset.id;
									var newBrwosers_id_colo= document.querySelector("#newBrwosersColo"  + " option[value='" + newBrwoserColo+ "']").dataset.id;
														
									var nucPuestaDisposi= document.getElementById("nucPuestaDisposi").value;
									var codepostalidPeusta= document.getElementById("codepostalidPeusta").value;
									var numberCallePuesta= document.getElementById("numberCallePuesta").value;
									 if(numberCallePuesta == ""){ numberCallePuesta = 0; }

									var uno = document.getElementById("acepto1").checked;
																			 var dos = document.getElementById("acepto2").checked;
																			 var tres = document.getElementById("acepto3").checked;
																			 var cuat = document.getElementById("acepto4").checked;
																			 var cinc = document.getElementById("acepto5").checked;

																			 var naracion= document.getElementById("textNarracion").value;


									var puestaData = Array();
										    puestaData[0] = newBrwosers_id;   puestaData[1] = "'"+nucPuestaDisposi+"'"; puestaData[2] = "'"+fechaevento+"'"; puestaData[3] =  newBrwosers_id_fisca;
										    puestaData[4] = newBrwosers_id_mun; puestaData[5] = newBrwosers_id_colo; puestaData[6] = codepostalidPeusta; puestaData[7] = "'"+calleInputPuesta+"'";
										    puestaData[8] = numberCallePuesta; puestaData[9] = tipoMOd; puestaData[10] = newBrwoser_val; 

										    puestaData[11] = uno; puestaData[12] = dos; puestaData[13] = tres;
			    							puestaData[14] = cuat; puestaData[15] = cinc; puestaData[16] = naracion;


										     var jObject={};  for(i in puestaData){  jObject[i] = puestaData[i];   }
										     jObject= JSON.stringify(jObject);

								
								    /*Validamos si ha llenado el formulario*/    
								    if(idPuestaDisposicion == ""  ){
								    	cont = document.getElementById('contModalDineroAsegurado');
										ajax=objetoAjax();
										ajax.open("POST", "format/puestaDisposicion/modalDineroAsegurado.php");

										ajax.onreadystatechange = function(){
											if (ajax.readyState == 4 && ajax.status == 200) {
												cont.innerHTML = ajax.responseText;

												$('#puestdispos').modal('hide'); 
												$('#modalDineroAsegurado').modal('show');
											}
										}
										ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
										ajax.send("&idDinero="+idDinero+"&jObject="+jObject+"&idEnlace="+idEnlace+"&b="+b);
									    }
									}else{ 
										swal("", "Faltan datos por registrar.", "warning");
									}	
	 }else{

	 						if(idPuestaDisposicion != ""){


	 								cont = document.getElementById('contModalDineroAsegurado');
										ajax=objetoAjax();
										ajax.open("POST", "format/puestaDisposicion/modalDineroAsegurado.php");

										ajax.onreadystatechange = function(){
											if (ajax.readyState == 4 && ajax.status == 200) {
												cont.innerHTML = ajax.responseText;

												$('#puestdispos').modal('hide'); 
												$('#modalDineroAsegurado').modal('show');
											}
										}
										ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
										ajax.send("&idDinero="+idDinero+"&tipoMOd="+tipoMOd+"&idPuestaDisposicion="+idPuestaDisposicion+"&idEnlace="+idEnlace+"&b="+b);

	 						}

	 }



}

function closemodalDineroAsegurado(){
	 $('#puestdispos').modal('show'); 
	 $('#modalDineroAsegurado').modal('hide');


}


//// REGISTRO DINERO ///


function registroDineroAsegurado(idEnlace, typearch, b, tipoActualizacion , idDineroAsegurado){
	/// VALIDACIONES ///
	var idEnlace = idEnlace;
var tipoActualizacion = tipoActualizacion;
	var idDineroAsegurado = idDineroAsegurado;
	

	/*Obtener datos del formulario*/
	var textMon_nal = $("#textMon_nal").val();
	var textMon_ext = $("#textMon_ext").val();
	var textDivisa = $("#textDivisa").val();
	var textObservaciones = $("#textObservacionesDinero").val();

//Si los campos de moneda van vacios ponerlos a cero//
			if(textMon_nal == ""){ textMon_nal = 0; }
			if(textMon_ext == ""){ textMon_ext = 0; }

///Validar campos vacios///
if(textMon_nal > 0 || textMon_ext > 0){
	
 //// DATA DE LA PUESTA A DISPOSICION /////
	var idPuestaDisposicion= document.getElementById("idPuestaDisposicion").value;
	var tipoMOd= document.getElementById("tipoMOd").value;
	var idMandoPuesta = document.getElementById("idMandoPuesta").value;
	var nucPuestaDisposi= document.getElementById("nucPuestaDisposi").value;
	var fechaevento= document.getElementById("fechaevento").value;
	var newBrwosers_id_fisca= document.getElementById("newBrwosers_id_fisca").value;
	var newBrwosers_id_mun= document.getElementById("newBrwosers_id_mun").value;
	var newBrwosers_id_colo= document.getElementById("newBrwosers_id_colo").value;
	var codepostalidPeusta= document.getElementById("codepostalidPeusta").value;
	var calleInputPuesta= document.getElementById("calleInputPuesta").value;
	var numberCallePuesta= document.getElementById("numberCallePuesta").value;
	if(numberCallePuesta == ""){ numberCallePuesta = 0; }
	var uno= document.getElementById("uno").value;
				var dos= document.getElementById("dos").value;
					var tres= document.getElementById("tres").value;
						var cuatro= document.getElementById("cuatro").value;
							var cinco= document.getElementById("cinco").value;
								var narac= document.getElementById("narac").value;


	var puestaDataPersona = Array();
			    puestaDataPersona[0] = idMandoPuesta;  puestaDataPersona[1] = "'"+nucPuestaDisposi+"'"; puestaDataPersona[2] = "'"+fechaevento+"'"; puestaDataPersona[3] =  newBrwosers_id_fisca;
			    puestaDataPersona[4] = newBrwosers_id_mun; puestaDataPersona[5] = newBrwosers_id_colo; puestaDataPersona[6] = codepostalidPeusta; puestaDataPersona[7] = "'"+calleInputPuesta+"'";
			    puestaDataPersona[8] = numberCallePuesta; puestaDataPersona[9] = tipoMOd; puestaDataPersona[10] = uno; puestaDataPersona[11] = dos; puestaDataPersona[12] = tres;
			    puestaDataPersona[13] = cuatro; puestaDataPersona[14] = cinco; puestaDataPersona[15] = narac;


			     var jObject={};  
			     for(i in puestaDataPersona){  
			     	jObject[i] = puestaDataPersona[i];   
			     }
			     jObject = JSON.stringify(jObject);
 //// DATA DE LA PUESTA A DISPOSICION /////

				
			$.ajax({
        type: "POST",
        dataType: 'html',
        url: "format/puestaDisposicion/registroDineroAsegurado.php",
        data: "textMon_nal="+textMon_nal+"&textMon_ext="+textMon_ext+"&textDivisa="+textDivisa+"&textObservaciones="+textObservaciones+
              "&jObject="+jObject+"&idEnlace="+idEnlace+"&idPuestaDisposicion="+idPuestaDisposicion+"&tipoActualizacion="+tipoActualizacion+
              "&idDineroAsegurado="+idDineroAsegurado,
        success: function(resp){
            
        					var json = resp;
															var obj = eval("(" + json + ")");
															if (obj.first == "NO") { swal("", "No se registro verifique los datos.", "warning"); }else{
																 if (obj.first == "SI") {                    
																	
																 	var obj = eval("(" + json + ")");
																 	swal("", "Dinero Registrado Exitosamente.", "success");
																	//// SE DEBE DE ACTUALIZAR LA INFO DE LA PUESTA A DISPOSICION
																	closemodalDineroAsegurado();

																	showmodalPueDispo(1, idEnlace, obj.idpuestaultimo, typearch, b);

																 }
															}

        }
    });
		}else{
			swal("", "Agregue al menos una cantidad.", "warning");
		}
}


/////////////////////////// VALIDA DIVISA EXTRANJERA //////////////////////////////////////
function validaDivisa() {
  var x = document.getElementById("textMon_ext").value;
  document.getElementById("textMon_ext").blur(); /*Elimina el foco del input*/
  if(x == ""){
  	 $("#textDivisa").prop("disabled", true);
     $("#textDivisa option[value='0']").attr("selected",true);
  }else{
  	if(x != 0){
  		var intervalo;
	  	clearInterval(intervalo);
	    intervalo = setInterval(function(){
	        $("#textDivisa").prop("disabled", false );
	        $("#textDivisa option[value='0']").attr("selected",false);
	        clearInterval(intervalo);
	    }, 100);
	}
  }
}
/////////////////////////// VALIDA DIVISA EXTRANJERA //////////////////////////////////////



///////////////////// MODAL DINERO ASEGURADO /////////////////////





////////////////////////////////////// MODAL DEFUNCIONES //////////////////////////////////////


function modalDefunciones(tipoMOd, idEnlace, idDefuncion, b){
	/////////////////////////// SI EL TIPO MODAL ES UNA NUEVA PUESTA ENTONCES ES  0 ///////////////////////////////
	var idPuestaDisposicion= document.getElementById("idPuestaDisposicion").value;

	var validar = validateDataPuesta();	

	if(idPuestaDisposicion == ""  ){
	//////////// VALIDAR CAMPOS QUE SEAN REQUERIDO PARA LA PUESTA A DIPOSICION //////////////////
	if(validar){
		/*Obtener id mando*/
		var newBrwoser= document.getElementById("newBrwoser").value;
	 	var newBrwoser_val= document.querySelector("#newBrwosers"  + " option[value='" + newBrwoser+ "']").dataset.value;
		var newBrwosers_id = document.querySelector("#newBrwosers"  + " option[value='" + newBrwoser+ "']").dataset.id;

		var newBrwosers_id_fisca= document.querySelector("#newBrwosersFis"  + " option[value='" + newBrwoserFisca+ "']").dataset.id;
		var newBrwosers_id_mun= document.querySelector("#newBrwosersMun"  + " option[value='" + newBrwoserMun+ "']").dataset.id;
		var newBrwosers_id_colo= document.querySelector("#newBrwosersColo"  + " option[value='" + newBrwoserColo+ "']").dataset.id;
							
		var nucPuestaDisposi= document.getElementById("nucPuestaDisposi").value;
		var codepostalidPeusta= document.getElementById("codepostalidPeusta").value;
		var numberCallePuesta= document.getElementById("numberCallePuesta").value;
		 if(numberCallePuesta == ""){ numberCallePuesta = 0; }

		

var uno = document.getElementById("acepto1").checked;
																			 var dos = document.getElementById("acepto2").checked;
																			 var tres = document.getElementById("acepto3").checked;
																			 var cuatro = document.getElementById("acepto4").checked;
																			 var cinco = document.getElementById("acepto5").checked;

																			 var narac= document.getElementById("textNarracion").value;




		var puestaData = Array();
			    puestaData[0] = newBrwosers_id;   puestaData[1] = "'"+nucPuestaDisposi+"'"; puestaData[2] = "'"+fechaevento+"'"; puestaData[3] =  newBrwosers_id_fisca;
			    puestaData[4] = newBrwosers_id_mun; puestaData[5] = newBrwosers_id_colo; puestaData[6] = codepostalidPeusta; puestaData[7] = "'"+calleInputPuesta+"'";
			    puestaData[8] = numberCallePuesta; puestaData[9] = tipoMOd; puestaData[10] = newBrwoser_val; 

			    puestaData[11] = uno; puestaData[12] = dos; puestaData[13] = tres;
			    puestaData[14] = cuatro; puestaData[15] = cinco; puestaData[16] = narac;


			     var jObject={};  for(i in puestaData){  jObject[i] = puestaData[i];   }
			     jObject= JSON.stringify(jObject);

	
	    /*Validamos si ha llenado el formulario*/    
	    if(idPuestaDisposicion == ""  ){
	    	cont = document.getElementById('contModalDefunciones');
			ajax=objetoAjax();
			ajax.open("POST", "format/puestaDisposicion/modalDefunciones.php");

			ajax.onreadystatechange = function(){
				if (ajax.readyState == 4 && ajax.status == 200) {
					cont.innerHTML = ajax.responseText;

					$('#puestdispos').modal('hide'); 
					$('#modalDefunciones').modal('show');
				}
			}
			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			ajax.send("&idDefuncion="+idDefuncion+"&jObject="+jObject+"&idEnlace="+idEnlace+"&b="+b);
		    }
		}else{ 
			swal("", "Faltan datos por registrar.", "warning");
		}	

	}else{



					if(idPuestaDisposicion != ""){


	 								cont = document.getElementById('contModalDefunciones');
										ajax=objetoAjax();
										ajax.open("POST", "format/puestaDisposicion/modalDefunciones.php");

										ajax.onreadystatechange = function(){
											if (ajax.readyState == 4 && ajax.status == 200) {
												cont.innerHTML = ajax.responseText;

												$('#puestdispos').modal('hide'); 
												$('#modalDefunciones').modal('show');
											}
										}
										ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
										ajax.send("&idDefuncion="+idDefuncion+"&tipoMOd="+tipoMOd+"&idPuestaDisposicion="+idPuestaDisposicion+"&idEnlace="+idEnlace+"&b="+b);

	 						}


	}
}

function closemodalDefunciones(){
	 $('#puestdispos').modal('show'); 
	 $('#modalDefunciones').modal('hide');
}



function registroDefunciones(idEnlace, typearch, b, tipoActualizacion , idDefuncion){
	/// VALIDACIONES ///
	var idEnlace = idEnlace;
var tipoActualizacion = tipoActualizacion;
	var idDefuncion = idDefuncion;
	

	/*Obtener datos del formulario*/
	var textNombre = $("#textNombreDef").val();
	var textAp_paterno = $("#textAp_paternoDef").val();
	var textAp_materno = $("#textAp_maternoDef").val();
	var textSexo = $("#textSexoDef").val();
 var textCatCausaMuerte = document.getElementById("textCatCausaMuerte").value;
 if(textCatCausaMuerte == ""){ 
  textCatCausaMuerte_id = 0;
 }else{
 	var textCatCausaMuerte_id = document.querySelector("#listaCatCausaMuerte"  + " option[value='" +textCatCausaMuerte+ "']").dataset.id;
 }


///Validar campos vacios///
if(textSexo != 0 && textCatCausaMuerte_id != 0 && textNombre != "" && textAp_paterno != "" && textAp_materno != ""){
 /*Obtener datos del formulario*/
	var textEdad = $("#textEdadDef").val(); 
	if(textEdad == ""){ textEdad = 0;}
    var textMovilMuerte = $("#textMovilMuerte").val();
	var textObservaciones = $("#textObservacionesDefun").val();
	
 //// DATA DE LA PUESTA A DISPOSICION /////
	var idPuestaDisposicion= document.getElementById("idPuestaDisposicion").value;
	var tipoMOd= document.getElementById("tipoMOd").value;
	var idMandoPuesta = document.getElementById("idMandoPuesta").value;
	var nucPuestaDisposi= document.getElementById("nucPuestaDisposi").value;
	var fechaevento= document.getElementById("fechaevento").value;
	var newBrwosers_id_fisca= document.getElementById("newBrwosers_id_fisca").value;
	var newBrwosers_id_mun= document.getElementById("newBrwosers_id_mun").value;
	var newBrwosers_id_colo= document.getElementById("newBrwosers_id_colo").value;
	var codepostalidPeusta= document.getElementById("codepostalidPeusta").value;
	var calleInputPuesta= document.getElementById("calleInputPuesta").value;
	var numberCallePuesta= document.getElementById("numberCallePuesta").value;
 if(numberCallePuesta == ""){ numberCallePuesta = 0; }

	var uno= document.getElementById("uno").value;
				var dos= document.getElementById("dos").value;
					var tres= document.getElementById("tres").value;
						var cuatro= document.getElementById("cuatro").value;
							var cinco= document.getElementById("cinco").value;
								var narac= document.getElementById("narac").value;



	var puestaDataPersona = Array();
			    puestaDataPersona[0] = idMandoPuesta;  puestaDataPersona[1] = "'"+nucPuestaDisposi+"'"; puestaDataPersona[2] = "'"+fechaevento+"'"; puestaDataPersona[3] =  newBrwosers_id_fisca;
			    puestaDataPersona[4] = newBrwosers_id_mun; puestaDataPersona[5] = newBrwosers_id_colo; puestaDataPersona[6] = codepostalidPeusta; puestaDataPersona[7] = "'"+calleInputPuesta+"'";
			    puestaDataPersona[8] = numberCallePuesta; puestaDataPersona[9] = tipoMOd;

			    puestaDataPersona[10] = uno; puestaDataPersona[11] = dos; puestaDataPersona[12] = tres;
			    puestaDataPersona[13] = cuatro; puestaDataPersona[14] = cinco; puestaDataPersona[15] = narac;


			     var jObject={};  
			     for(i in puestaDataPersona){  
			     	jObject[i] = puestaDataPersona[i];   
			     }
			     jObject = JSON.stringify(jObject);
 //// DATA DE LA PUESTA A DISPOSICION /////

				
			$.ajax({
        type: "POST",
        dataType: 'html',
        url: "format/puestaDisposicion/registroDefunciones.php",
        data: "textNombre="+textNombre+"&textAp_paterno="+textAp_paterno+"&textAp_materno="+textAp_materno+"&textSexo="+textSexo+"&textEdad="+textEdad+
              "&textCatCausaMuerte_id="+textCatCausaMuerte_id+"&textMovilMuerte="+textMovilMuerte+"&textObservaciones="+textObservaciones+"&jObject="+jObject+"&idEnlace="+idEnlace+"&idPuestaDisposicion="+idPuestaDisposicion+"&tipoActualizacion="+tipoActualizacion+"&idDefuncion="+idDefuncion,
        success: function(resp){
            			var json = resp;
															var obj = eval("(" + json + ")");
															if (obj.first == "NO") { swal("", "No se registro verifique los datos.", "warning"); }else{
																 if (obj.first == "SI") {                    
																	
																 	var obj = eval("(" + json + ")");
																 	swal("", "Defuncion Registrada Exitosamente.", "success");
																	//// SE DEBE DE ACTUALIZAR LA INFO DE LA PUESTA A DISPOSICION
																	closemodalDefunciones();

																	showmodalPueDispo(1, idEnlace, obj.idpuestaultimo, typearch, b);

																 }
															}
        }
    });
		}else{
			swal("", "Faltan datos por registrar..", "warning");
		}
}


function defuncionDesconocido(){
	if( $('#acepto').prop('checked') ) {
		document.getElementById("textNombreDef").disabled = true;
		document.getElementById("textAp_paternoDef").disabled = true;
		document.getElementById("textAp_maternoDef").disabled = true;
		document.getElementById("textEdadDef").disabled = true;
		$("#textNombreDef").val("Desconocido");
		$("#textAp_paternoDef").val("Desconocido");
		$("#textAp_maternoDef").val("Desconocido");
		document.getElementById("textSexoDef").options.item(3).selected = 'selected';
		$("#textEdadDef").val('');
	}else{
		document.getElementById("textNombreDef").disabled = false;
		document.getElementById("textAp_paternoDef").disabled = false;
		document.getElementById("textAp_maternoDef").disabled = false;
		document.getElementById("textEdadDef").disabled = false;
		$("#textNombreDef").val("");
		$("#textAp_paternoDef").val("");
		$("#textAp_maternoDef").val("");
		document.getElementById("textSexoDef").options.item(0).selected = 'selected';
		$("#textEdadDef").val("");
	}
}


////////////////////////////////////// MODAL DEFUNCIONES //////////////////////////////////////




////////////////////////////////////// MODAL TRABAJOS DE CAMPO //////////////////////////////////////


function modalTrabajosDeCampo(tipoMOd, idEnlace, idTrabajoCampo, b){
	/////////////////////////// SI EL TIPO MODAL ES UNA NUEVA PUESTA ENTONCES ES  0 ///////////////////////////////
	var idPuestaDisposicion= document.getElementById("idPuestaDisposicion").value;

	var validar = validateDataPuesta();	

	if(idPuestaDisposicion == ""  ){

	//////////// VALIDAR CAMPOS QUE SEAN REQUERIDO PARA LA PUESTA A DIPOSICION //////////////////
	if(validar){
		/*Obtener id mando*/
		var newBrwoser= document.getElementById("newBrwoser").value;
	 	var newBrwoser_val= document.querySelector("#newBrwosers"  + " option[value='" + newBrwoser+ "']").dataset.value;
		var newBrwosers_id = document.querySelector("#newBrwosers"  + " option[value='" + newBrwoser+ "']").dataset.id;

		var newBrwosers_id_fisca= document.querySelector("#newBrwosersFis"  + " option[value='" + newBrwoserFisca+ "']").dataset.id;
		var newBrwosers_id_mun= document.querySelector("#newBrwosersMun"  + " option[value='" + newBrwoserMun+ "']").dataset.id;
		var newBrwosers_id_colo= document.querySelector("#newBrwosersColo"  + " option[value='" + newBrwoserColo+ "']").dataset.id;
							
		var nucPuestaDisposi= document.getElementById("nucPuestaDisposi").value;
		var codepostalidPeusta= document.getElementById("codepostalidPeusta").value;
		var numberCallePuesta= document.getElementById("numberCallePuesta").value;
		 if(numberCallePuesta == ""){ numberCallePuesta = 0; }

																				var uno = document.getElementById("acepto1").checked;
																			 var dos = document.getElementById("acepto2").checked;
																			 var tres = document.getElementById("acepto3").checked;
																			 var cuatro = document.getElementById("acepto4").checked;
																			 var cinco = document.getElementById("acepto5").checked;

																			 var narac= document.getElementById("textNarracion").value;




		var puestaData = Array();
			    puestaData[0] = newBrwosers_id;   puestaData[1] = "'"+nucPuestaDisposi+"'"; puestaData[2] = "'"+fechaevento+"'"; puestaData[3] =  newBrwosers_id_fisca;
			    puestaData[4] = newBrwosers_id_mun; puestaData[5] = newBrwosers_id_colo; puestaData[6] = codepostalidPeusta; puestaData[7] = "'"+calleInputPuesta+"'";
			    puestaData[8] = numberCallePuesta; puestaData[9] = tipoMOd; puestaData[10] = newBrwoser_val; 

			    puestaData[11] = uno; puestaData[12] = dos; puestaData[13] = tres;
			    puestaData[14] = cuatro; puestaData[15] = cinco; puestaData[16] = narac;


			     var jObject={};  for(i in puestaData){  jObject[i] = puestaData[i];   }
			     jObject= JSON.stringify(jObject);

	
	    /*Validamos si ha llenado el formulario*/    
	    if(idPuestaDisposicion == ""  ){
	    	cont = document.getElementById('contModalTrabajosDeCampo');
			ajax=objetoAjax();
			ajax.open("POST", "format/puestaDisposicion/modalTrabajosDeCampo.php");

			ajax.onreadystatechange = function(){
				if (ajax.readyState == 4 && ajax.status == 200) {
					cont.innerHTML = ajax.responseText;

					$('#puestdispos').modal('hide'); 
					$('#modalTrabajosDeCampo').modal('show');
				}
			}
			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			ajax.send("&idTrabajoCampo="+idTrabajoCampo+"&jObject="+jObject+"&idEnlace="+idEnlace+"&b="+b);
		    }
		}else{ 
			swal("", "Faltan datos por registrar.", "warning");
		}	

	}else{



					if(idPuestaDisposicion != ""){


	 								cont = document.getElementById('contModalTrabajosDeCampo');
										ajax=objetoAjax();
										ajax.open("POST", "format/puestaDisposicion/modalTrabajosDeCampo.php");

										ajax.onreadystatechange = function(){
											if (ajax.readyState == 4 && ajax.status == 200) {
												cont.innerHTML = ajax.responseText;

												$('#puestdispos').modal('hide'); 
												$('#modalTrabajosDeCampo').modal('show');
											}
										}
										ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
										ajax.send("&idTrabajoCampo="+idTrabajoCampo+"&tipoMOd="+tipoMOd+"&idPuestaDisposicion="+idPuestaDisposicion+"&idEnlace="+idEnlace+"&b="+b);

	 						}


	}
}

function closemodalTrabajosDeCampo(){
	 $('#puestdispos').modal('show'); 
	 $('#modalTrabajosDeCampo').modal('hide');
}


function registroTrabajosDeCampo(idEnlace, typearch, b, tipoActualizacion , idTrabajoCampo){
	/// VALIDACIONES ///
	var idEnlace = idEnlace;

	var tipoActualizacion = tipoActualizacion;
	var idTrabajoCampo = idTrabajoCampo;
	

	/*Obtener datos del formulario*/
	var textEntrevistas = $("#textEntrevistas").val(); if(textEntrevistas == "") {textEntrevistas = 0; }
	var textVisitasDomiciliarias = $("#textVisitasDomiciliarias").val(); if(textVisitasDomiciliarias == "") {textVisitasDomiciliarias = 0; }
	var textInvestigacionesCumplidas = $("#textInvestigacionesCumplidas").val(); if(textInvestigacionesCumplidas == "") {textInvestigacionesCumplidas = 0; }
	var textIndividuaciones = $("#textIndividuaciones").val(); if(textIndividuaciones == "") {textIndividuaciones = 0; }
    var textObservaciones = $("#textObservacionesTrabCampo").val();

 //// DATA DE LA PUESTA A DISPOSICION /////
	var idPuestaDisposicion= document.getElementById("idPuestaDisposicion").value;
	var tipoMOd= document.getElementById("tipoMOd").value;
	var idMandoPuesta = document.getElementById("idMandoPuesta").value;
	var nucPuestaDisposi= document.getElementById("nucPuestaDisposi").value;
	var fechaevento= document.getElementById("fechaevento").value;
	var newBrwosers_id_fisca= document.getElementById("newBrwosers_id_fisca").value;
	var newBrwosers_id_mun= document.getElementById("newBrwosers_id_mun").value;
	var newBrwosers_id_colo= document.getElementById("newBrwosers_id_colo").value;
	var codepostalidPeusta= document.getElementById("codepostalidPeusta").value;
	var calleInputPuesta= document.getElementById("calleInputPuesta").value;
	var numberCallePuesta= document.getElementById("numberCallePuesta").value;
		if(numberCallePuesta == ""){ numberCallePuesta = 0; }
	var uno= document.getElementById("uno").value;
				var dos= document.getElementById("dos").value;
					var tres= document.getElementById("tres").value;
						var cuatro= document.getElementById("cuatro").value;
							var cinco= document.getElementById("cinco").value;
								var narac= document.getElementById("narac").value;



	var puestaDataPersona = Array();
			    puestaDataPersona[0] = idMandoPuesta;  puestaDataPersona[1] = "'"+nucPuestaDisposi+"'"; puestaDataPersona[2] = "'"+fechaevento+"'"; puestaDataPersona[3] =  newBrwosers_id_fisca;
			    puestaDataPersona[4] = newBrwosers_id_mun; puestaDataPersona[5] = newBrwosers_id_colo; puestaDataPersona[6] = codepostalidPeusta; puestaDataPersona[7] = "'"+calleInputPuesta+"'";
			    puestaDataPersona[8] = numberCallePuesta; puestaDataPersona[9] = tipoMOd; puestaDataPersona[10] = uno; puestaDataPersona[11] = dos; puestaDataPersona[12] = tres;
			    puestaDataPersona[13] = cuatro; puestaDataPersona[14] = cinco; puestaDataPersona[15] = narac;


			     var jObject={};  
			     for(i in puestaDataPersona){  
			     	jObject[i] = puestaDataPersona[i];   
			     }
			     jObject = JSON.stringify(jObject);
 //// DATA DE LA PUESTA A DISPOSICION /////

				
			$.ajax({
        type: "POST",
        dataType: 'html',
        url: "format/puestaDisposicion/registroTrabajosDeCampo.php",
        data: "textEntrevistas="+textEntrevistas+"&textVisitasDomiciliarias="+textVisitasDomiciliarias+"&textInvestigacionesCumplidas="+textInvestigacionesCumplidas+"&textIndividuaciones="+textIndividuaciones+"&textObservaciones="+textObservaciones+"&jObject="+jObject+"&idEnlace="+idEnlace+"&idPuestaDisposicion="+idPuestaDisposicion+"&tipoActualizacion="+tipoActualizacion+"&idTrabajoCampo="+idTrabajoCampo,
        success: function(resp){
            

        					var json = resp;
															var obj = eval("(" + json + ")");
															if (obj.first == "NO") { swal("", "No se registro verifique los datos.", "warning"); }else{
																 if (obj.first == "SI") {                    
																	
																 	var obj = eval("(" + json + ")");
																 	swal("", "Trabajo de Campo Registrado Exitosamente.", "success");
																	//// SE DEBE DE ACTUALIZAR LA INFO DE LA PUESTA A DISPOSICION
																	closemodalTrabajosDeCampo();

																	showmodalPueDispo(1, idEnlace, obj.idpuestaultimo, typearch, b);

																 }
															}

        }
    });
		
}

////////////////////////////////////// MODAL TRABAJOS DE CAMPO  //////////////////////////////////////
////////////////////////////////////// MODAL ARMAS ASEGURADAS //////////////////////////////////////


function modalArmasAseguradas(tipoMOd, idEnlace, idArma, b){
	/////////////////////////// SI EL TIPO MODAL ES UNA NUEVA PUESTA ENTONCES ES  0 ///////////////////////////////
	var idPuestaDisposicion= document.getElementById("idPuestaDisposicion").value;

	var validar = validateDataPuesta();	

	if(idPuestaDisposicion == ""  ){
	//////////// VALIDAR CAMPOS QUE SEAN REQUERIDO PARA LA PUESTA A DIPOSICION //////////////////
	if(validar){
		/*Obtener id mando*/
		var newBrwoser= document.getElementById("newBrwoser").value;
	 	var newBrwoser_val= document.querySelector("#newBrwosers"  + " option[value='" + newBrwoser+ "']").dataset.value;
		var newBrwosers_id = document.querySelector("#newBrwosers"  + " option[value='" + newBrwoser+ "']").dataset.id;

		var newBrwosers_id_fisca= document.querySelector("#newBrwosersFis"  + " option[value='" + newBrwoserFisca+ "']").dataset.id;
		var newBrwosers_id_mun= document.querySelector("#newBrwosersMun"  + " option[value='" + newBrwoserMun+ "']").dataset.id;
		var newBrwosers_id_colo= document.querySelector("#newBrwosersColo"  + " option[value='" + newBrwoserColo+ "']").dataset.id;
							
		var nucPuestaDisposi= document.getElementById("nucPuestaDisposi").value;
		var codepostalidPeusta= document.getElementById("codepostalidPeusta").value;
		var numberCallePuesta= document.getElementById("numberCallePuesta").value;
		 if(numberCallePuesta == ""){ numberCallePuesta = 0; }

		var uno = document.getElementById("acepto1").checked;
																			 var dos = document.getElementById("acepto2").checked;
																			 var tres = document.getElementById("acepto3").checked;
																			 var cuatro = document.getElementById("acepto4").checked;
																			 var cinco = document.getElementById("acepto5").checked;

																			 var narac= document.getElementById("textNarracion").value;

		var puestaData = Array();
			    puestaData[0] = newBrwosers_id;   puestaData[1] = "'"+nucPuestaDisposi+"'"; puestaData[2] = "'"+fechaevento+"'"; puestaData[3] =  newBrwosers_id_fisca;
			    puestaData[4] = newBrwosers_id_mun; puestaData[5] = newBrwosers_id_colo; puestaData[6] = codepostalidPeusta; puestaData[7] = "'"+calleInputPuesta+"'";
			    puestaData[8] = numberCallePuesta; puestaData[9] = tipoMOd; puestaData[10] = newBrwoser_val; 

			    puestaData[11] = uno; puestaData[12] = dos; puestaData[13] = tres;
			    puestaData[14] = cuatro; puestaData[15] = cinco; puestaData[16] = narac;

			     var jObject={};  for(i in puestaData){  jObject[i] = puestaData[i];   }
			     jObject= JSON.stringify(jObject);

	
	    /*Validamos si ha llenado el formulario*/    
	    if(idPuestaDisposicion == ""  ){
	    	cont = document.getElementById('contModalArmasAseguradas');
			ajax=objetoAjax();
			ajax.open("POST", "format/puestaDisposicion/modalArmasAseguradas.php");

			ajax.onreadystatechange = function(){
				if (ajax.readyState == 4 && ajax.status == 200) {
					cont.innerHTML = ajax.responseText;

					$('#puestdispos').modal('hide'); 
					$('#modalArmasAseguradas').modal('show');
				}
			}
			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			ajax.send("&idArma="+idArma+"&jObject="+jObject+"&idEnlace="+idEnlace+"&b="+b);
		    }
		}else{ 
			swal("", "Faltan datos por registrar.", "warning");
		}	

	}else{


								if(idPuestaDisposicion != ""){


	 								cont = document.getElementById('contModalArmasAseguradas');
										ajax=objetoAjax();
										ajax.open("POST", "format/puestaDisposicion/modalArmasAseguradas.php");

										ajax.onreadystatechange = function(){
											if (ajax.readyState == 4 && ajax.status == 200) {
												cont.innerHTML = ajax.responseText;

												$('#puestdispos').modal('hide'); 
												$('#modalArmasAseguradas').modal('show');
											}
										}
										ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
										ajax.send("&idArma="+idArma+"&tipoMOd="+tipoMOd+"&idPuestaDisposicion="+idPuestaDisposicion+"&idEnlace="+idEnlace+"&b="+b);

	 						}


	}

}

function closemodalArmasAseguradas(){
	 $('#puestdispos').modal('show'); 
	 $('#modalArmasAseguradas').modal('hide');
}


function registroArmasAseguradas(idEnlace, tipoArch, b, tipoActualizacion , idArma){
	/// VALIDACIONES ///
	var idEnlace = idEnlace;
	var tipoActualizacion = tipoActualizacion;
	var idArma = idArma;

 var textCatTipoArma = document.getElementById("textCatTipoArma").value;
 if(textCatTipoArma != ""){
 	
 var textCatTipoArma_id = document.querySelector("#listaCatTipoArma"  + " option[value='" +textCatTipoArma+ "']").dataset.id;
 
 /*MARCA ARMA*/
 var textCatMarcaArma = document.getElementById("textCatMarcaArma").value;
 if(textCatMarcaArma == ""){textCatMarcaArma = "NO ESPECIFICADO";}
 var textCatMarcaArma_id = document.querySelector("#listaCatMarcaArma"  + " option[value='" +textCatMarcaArma+ "']").dataset.id;
 /*CALIBRE*/
 var textCatCalibre = document.getElementById("textCatCalibre").value;
 if(textCatCalibre == ""){textCatCalibre = "NO ESPECIFICADO";}
 var textCatCalibre_id = document.querySelector("#listaCatCalibre"  + " option[value='" +textCatCalibre+ "']").dataset.id;
 /*ACCESORIO ARMA*/
 var textCatAccesorioArma = document.getElementById("textCatAccesorioArma").value;
 if(textCatAccesorioArma == ""){textCatAccesorioArma = "NO ESPECIFICADO";}
 var textCatAccesorioArma_id = document.querySelector("#listaCatAccesorioArma"  + " option[value='" +textCatAccesorioArma+ "']").dataset.id;
 /*MARCA CARTUCHOS*/
 var textCatMarcaCartuchos = document.getElementById("textCatMarcaCartuchos").value;
 if(textCatMarcaCartuchos == ""){textCatMarcaCartuchos = "NO ESPECIFICADO";} 
 var textCatMarcaCartuchos_id = document.querySelector("#listaCatMarcaCartuchos"  + " option[value='" +textCatMarcaCartuchos+ "']").dataset.id;

 var textObservaciones = $("#textObservacionesArmas").val();

 //// DATA DE LA PUESTA A DISPOSICION /////
	var idPuestaDisposicion= document.getElementById("idPuestaDisposicion").value;
	var tipoMOd= document.getElementById("tipoMOd").value;
	var idMandoPuesta = document.getElementById("idMandoPuesta").value;
	var nucPuestaDisposi= document.getElementById("nucPuestaDisposi").value;
	var fechaevento= document.getElementById("fechaevento").value;
	var newBrwosers_id_fisca= document.getElementById("newBrwosers_id_fisca").value;
	var newBrwosers_id_mun= document.getElementById("newBrwosers_id_mun").value;
	var newBrwosers_id_colo= document.getElementById("newBrwosers_id_colo").value;
	var codepostalidPeusta= document.getElementById("codepostalidPeusta").value;
	var calleInputPuesta= document.getElementById("calleInputPuesta").value;
	var numberCallePuesta= document.getElementById("numberCallePuesta").value;
		if(numberCallePuesta == ""){ numberCallePuesta = 0; }

	var uno= document.getElementById("uno").value;
				var dos= document.getElementById("dos").value;
					var tres= document.getElementById("tres").value;
						var cuatro= document.getElementById("cuatro").value;
							var cinco= document.getElementById("cinco").value;
								var narac= document.getElementById("narac").value;


	var puestaDataPersona = Array();
			    puestaDataPersona[0] = idMandoPuesta;  puestaDataPersona[1] = "'"+nucPuestaDisposi+"'"; puestaDataPersona[2] = "'"+fechaevento+"'"; puestaDataPersona[3] =  newBrwosers_id_fisca;
			    puestaDataPersona[4] = newBrwosers_id_mun; puestaDataPersona[5] = newBrwosers_id_colo; puestaDataPersona[6] = codepostalidPeusta; puestaDataPersona[7] = "'"+calleInputPuesta+"'";
			    puestaDataPersona[8] = numberCallePuesta; puestaDataPersona[9] = tipoMOd; puestaDataPersona[10] = uno; puestaDataPersona[11] = dos; puestaDataPersona[12] = tres;
			    puestaDataPersona[13] = cuatro; puestaDataPersona[14] = cinco; puestaDataPersona[15] = narac;


			     var jObject={};  
			     for(i in puestaDataPersona){  
			     	jObject[i] = puestaDataPersona[i];   
			     }
			     jObject = JSON.stringify(jObject);
 //// DATA DE LA PUESTA A DISPOSICION /////

				
			$.ajax({
        type: "POST",
        dataType: 'html',
        url: "format/puestaDisposicion/registroArmasAseguradas.php",
        data: "textCatTipoArma_id="+textCatTipoArma_id+"&textCatMarcaArma_id="+textCatMarcaArma_id+"&textCatCalibre_id="+textCatCalibre_id+
              "&textCatAccesorioArma_id="+textCatAccesorioArma_id+"&textCatMarcaCartuchos_id="+textCatMarcaCartuchos_id+"&textObservaciones="+textObservaciones+
              "&jObject="+jObject+"&idEnlace="+idEnlace+"&idPuestaDisposicion="+idPuestaDisposicion+"&tipoActualizacion="+tipoActualizacion+
              "&idArma="+idArma,
        success: function(resp){
            

        								var json = resp;
															var obj = eval("(" + json + ")");
															if (obj.first == "NO") { swal("", "No se registro verifique los datos.", "warning"); }else{
																 if (obj.first == "SI") {                    
																	
																 	var obj = eval("(" + json + ")");
																 	swal("", "Arma Registrada Exitosamente.", "success");
																	//// SE DEBE DE ACTUALIZAR LA INFO DE LA PUESTA A DISPOSICION
																	closemodalArmasAseguradas();

																	showmodalPueDispo(1, idEnlace, obj.idpuestaultimo, tipoArch, b);

																 }
															}


        }
    });
		}else{
			swal("", "Agregue al menos un tipo de arma.", "warning");
		}

}



////////////////////////////////////// MODAL ARMAS ASEGURADAS  //////////////////////////////////////




function loadDaysMonth(anio, idEnlace, camMes){


		var messelected= document.getElementById("mesPuestaSelected").value; 		

		cont = document.getElementById('contDays');
		ajax=objetoAjax();

		ajax.open("POST", "format/puestaDisposicion/daysContentSelect.php");

		ajax.onreadystatechange = function(){
			if (ajax.readyState == 4 && ajax.status == 200) {
				cont.innerHTML = ajax.responseText;

					//// RECARGAR CONSULTA DE PUESTAS EN EL MES SELECCIONADO Y PRIMER DIA DEL MES CORRESPONDIENTE
					loadDataPuestDay(anio, idEnlace, camMes);

			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("&messelected="+messelected+"&anio="+anio+"&idEnlace="+idEnlace);

}


function loadDataPuestaSelected(anio, idEnlace, messelected, camMes){

		cont = document.getElementById('tablePuestasData');
		ajax=objetoAjax();

		ajax.open("POST", "format/puestaDisposicion/dataPuestaSelected.php");

		ajax.onreadystatechange = function(){
			if (ajax.readyState == 4 && ajax.status == 200) {
				cont.innerHTML = ajax.responseText;

			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("&messelected="+messelected+"&anio="+anio+"&idEnlace="+idEnlace+"&camMes="+camMes);

}

function loadDataPuestDay(anio, idEnlace, camMes){


		var messelected= document.getElementById("mesPuestaSelected").value;
		var diaselected= document.getElementById("diaSeleted").value; 	

		
		cont = document.getElementById('tablePuestasData');
		ajax=objetoAjax();

		ajax.open("POST", "format/puestaDisposicion/dataPuestaSelected.php");

		ajax.onreadystatechange = function(){
			if (ajax.readyState == 4 && ajax.status == 200) {
				cont.innerHTML = ajax.responseText;

			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("&messelected="+messelected+"&anio="+anio+"&idEnlace="+idEnlace+"&diaselected="+diaselected+"&camMes="+camMes);

}

function loadDataPuestDayCurrent(anio, idEnlace, camMes, messelected, diaselected){

		cont = document.getElementById('tablePuestasData');
		ajax=objetoAjax();

		ajax.open("POST", "format/puestaDisposicion/dataPuestaSelected.php");

		ajax.onreadystatechange = function(){
			if (ajax.readyState == 4 && ajax.status == 200) {
				cont.innerHTML = ajax.responseText;

			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("&messelected="+messelected+"&anio="+anio+"&idEnlace="+idEnlace+"&diaselected="+diaselected+"&camMes="+camMes);

}

function buscarPuesta(idEnlace){

		cont = document.getElementById('contPuestaBusque');
		idPuesta = document.getElementById('idPuestaBusque').value;
		ajax=objetoAjax();

		ajax.open("POST", "format/puestaDisposicion/busquedaPuesta.php");

		ajax.onreadystatechange = function(){
			if (ajax.readyState == 4 && ajax.status == 200) {
				cont.innerHTML = ajax.responseText;

			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("&idPuesta="+idPuesta+"&idEnlace="+idEnlace);

}



function cancelAdd() {
	$("#add-more").show();
	$(document).on("click",".ajax-action-links",function(e) {
		e.preventDefault();
		$(this).closest('tr').remove();
		});
}
function editRow(editableObj) {
  $(editableObj).css("background","#FFF");
}

function saveToDatabase(editableObj,column,id) {
  $(editableObj).css("background","#FFF url(cargando.gif) no-repeat right");
  $.ajax({
    url: "editar.php",
    type: "POST",
    data:'column='+column+'&editval='+$(editableObj).text()+'&id='+id,
    success: function(data){
      $(editableObj).css("background","#FDFDFD");
    }
  });
}

function agregarDelito() {
	var jObjectDelitos = {};
	var idPersona = idPersona;
	var idPers = $("#idPers").val();
 var arrDelitos = document.getElementsByName("delitosAct[]");
 	for(i=0;i<arrDelitos.length;i++){ jObjectDelitos[i] = arrDelitos[i].value; }
	//jObjectDelitos = JSON.stringify(jObjectDelitos);
  alert("ID DE PERSONA: " +  idPers + "ID DELITO" +jObjectDelitos[arrDelitos.length-1]);


  	ajax=objetoAjax();
						ajax.open("POST", "format/puestaDisposicion/actualizarDelito.php");
 
						ajax.onreadystatechange = function(){
							if (ajax.readyState == 4 && ajax.status == 200) {		
								$("#table-body").append(data);
										 var json = ajax.responseText;
										 	 $("#add-more").show();	
													var obj = eval("(" + json + ")");
													if (obj.first == "NO") { swal("", "No se agrego el delito.", "warning"); }else{
														 if (obj.first == "SI") {    															
														 	var obj = eval("(" + json + ")");
														 	swal("", "Delito agregado exitosamente.", "success");															
														 }
													}
										}
						}
						ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
						ajax.send("idPers="+idPers+"&arrDelitosAct="+jObjectDelitos[arrDelitos.length-1]);



/*
	  $.ajax({
		url: "format/puestaDisposicion/actualizarDelito.php",
		type: "POST",
		data:'idPers='+idPers,
		success: function(data){
			 $("#add-more").show();	

			
		  $("#new_row_ajax").remove();
		  $("#add-more").show();		  
		  $("#table-body").append(data);
		}
	  });
*/
}

function addToHiddenField(addColumn,hiddenField) {

	var columnValue = $(addColumn).text();
	$("#"+hiddenField).val(columnValue);
}

function deleteRecord(id) {
	if(confirm("Esta seguro de eliminar el registro?")) {
		$.ajax({
			url: "borrar.php",
			type: "POST",
			data:'id='+id,
			success: function(data){
			  $("#table-row-"+id).remove();
			}
		});
	}
}





