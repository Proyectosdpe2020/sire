function modalMandamientos_registro(tipoModal, idEnlace, ID_MANDAMIENTO_INTERNO, typeArch, typeCheck, idfisca, idUnidad){
cont = document.getElementById('contModalMandamientos_registro');
ajax=objetoAjax();
ajax.open("POST", "format/mandamientosJudiciales/modalMandamientos_registro.php");

ajax.onreadystatechange = function(){
	if (ajax.readyState == 4 && ajax.status == 200) {
		cont.innerHTML = ajax.responseText;
		$('.dataAutocomplet').select2({
			width: '100%',
			placeholder: "Seleccione",
			allowClear: false
		});	
	}
}
ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
ajax.send("&tipoModal="+tipoModal+"&idEnlace="+idEnlace+"&ID_MANDAMIENTO_INTERNO="+ID_MANDAMIENTO_INTERNO+"&typeArch="+typeArch+"&typeCheck="+typeCheck+"&idUnidad="+idUnidad+"&idfisca="+idfisca);
}
//MUESTRA MODAL REGISTRO DE INCULPADO
function showModal_inculpados(tipoModal, idEnlace, idUnidad, idfisca, ID_MANDAMIENTO_INTERNO){
	var dataValidate = validateDataMandamiento(); //Validamos que la información principal halla sido llenada previamente	 
		if(dataValidate[0] == 'true'){
			var contentArrayData = JSON.parse(dataValidate[1]); //Obtenemos la informacion del arreglo
			console.log("info: "+contentArrayData[1]); //NUC
			var nuc = contentArrayData[26];
			var existeNuc; 
			var dataPrincipalArray = {};  
			for(i in contentArrayData){  dataPrincipalArray[i] = contentArrayData[i];   }
			dataPrincipalArray = JSON.stringify(dataPrincipalArray);
		 console.log("aqui esta: "+dataPrincipalArray);
			cont = document.getElementById('contModalInculpados_registro');
			ajax=objetoAjax();
			ajax.open("POST", "format/mandamientosJudiciales/modalInculpados_registro.php");

			ajax.onreadystatechange = function(){
				if (ajax.readyState == 4 && ajax.status == 200) {
					cont.innerHTML = ajax.responseText;
					$('#mandamientos').modal('hide');
			  $('#inculpados').modal('show'); 
				}
			}
			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			ajax.send("&tipoModal="+tipoModal+"&idEnlace="+idEnlace+"&idUnidad="+idUnidad+"&idfisca="+idfisca+"&ID_MANDAMIENTO_INTERNO="+ID_MANDAMIENTO_INTERNO+"&dataPrincipalArray="+dataPrincipalArray);
		}else{
	 	swal("", "Faltan datos generales por ingresar antes de añadir un inculpado, verifique los campos en rojo.", "warning");
	 }
}
//MUESTRA MODAL REGISTRO DEAGRAVIADO
function showModal_agraviados(tipoModal, idEnlace, idUnidad, idfisca, ID_MANDAMIENTO_INTERNO){
	var dataValidate = validateDataMandamiento(); //Validamos que la información principal halla sido llenada previamente	 
	if(dataValidate[0] == 'true'){
		var contentArrayData = JSON.parse(dataValidate[1]); //Obtenemos la informacion del arreglo
		console.log("info: "+contentArrayData[1]); //NUC
		var nuc = contentArrayData[26];
		var existeNuc; 
		var dataPrincipalArray = {};  
		for(i in contentArrayData){  dataPrincipalArray[i] = contentArrayData[i];   }
		dataPrincipalArray = JSON.stringify(dataPrincipalArray);
		console.log("aqui esta: "+dataPrincipalArray);
		cont = document.getElementById('contModalAgraviados_registro');
		ajax=objetoAjax();
		ajax.open("POST", "format/mandamientosJudiciales/modalAgraviados_registro.php");

		ajax.onreadystatechange = function(){
			if (ajax.readyState == 4 && ajax.status == 200) {
				cont.innerHTML = ajax.responseText;
				$('.dataAutocomplet').select2({width: '100%',placeholder: "Seleccione",allowClear: false});	
				$('#mandamientos').modal('hide');
		  $('#agraviados').modal('show'); 
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("&tipoModal="+tipoModal+"&idEnlace="+idEnlace+"&idUnidad="+idUnidad+"&idfisca="+idfisca+"&ID_MANDAMIENTO_INTERNO="+ID_MANDAMIENTO_INTERNO+"&dataPrincipalArray="+dataPrincipalArray);
		}else{
	 	swal("", "Faltan datos generales por ingresar antes de añadir un agraviado, verifique los campos en rojo.", "warning");
	 }
}
//CIERRA MODAL REGISTRO DE INCULPADO
function closeModal_inculpados(){
	$('#inculpados').modal('hide'); 
	$('#mandamientos').modal('show');
}
//CIERRA MODAL REGISTRO DE AGRAVIADO
function closeModal_agraviados(){
	$('#agraviados').modal('hide'); 
	$('#mandamientos').modal('show');
}

//PRECARGAR INFORMACION DE MUNICIPIOS
function reloadMunicipios(){
	var ID_ESTADO_EMISOR = document.getElementById('ID_ESTADO_EMISOR').value;
	var cont = document.getElementById('ID_MUNICIPIO');
	$('.preloaderSelect_Municipios').show(); //GIF carga de información
	$('#ID_MUNICIPIO').hide();
	ajax=objetoAjax();
	ajax.open("POST", "format/mandamientosJudiciales/templates/template_reloadMunicipios.php");
	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			$('.preloaderSelect_Municipios').hide(); //GIF carga de información
  	$('#ID_MUNICIPIO').show();
			cont.innerHTML = ajax.responseText;
			reloadFiscaliaRegional();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("ID_ESTADO_EMISOR="+ID_ESTADO_EMISOR);
}
//PRECARGAR INFORMACION FISCALIA REGIONAL DE LA INFORMACION
function reloadFiscaliaRegional(){
	var ID_MUNICIPIO = document.getElementById('ID_MUNICIPIO').value;
	var cont = document.getElementById('FISCALIA');
	$('.preloaderSelect_FisRegional').show(); //GIF carga de información
	$('#FISCALIA').hide();
	ajax=objetoAjax();
	ajax.open("POST", "format/mandamientosJudiciales/templates/template_reloadFiscaliaRegional.php");
	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			$('.preloaderSelect_FisRegional').hide(); //GIF carga de información
  	$('#FISCALIA').show();
			cont.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("ID_MUNICIPIO="+ID_MUNICIPIO);
}
//FUNCION PARA VALIDAR LOS CAMPOS, varchar, int
function validaInput(e, tipo) {
    var key = e.keyCode || e.which;
    var tecla = String.fromCharCode(key).toLowerCase();
    if(tipo == 'varchar'){ var letras = "áéíóúabcdefghijklmnñopqrstuvwxyz1234567890"; }
    if(tipo == 'int'){ var letras = "1234567890"; }
    if(tipo == 'varchar_letras'){ var letras = "áéíóúabcdefghijklmnñopqrstuvwxyz"; }
    if(tipo == 'mandato' || tipo == 'proceso' || tipo == 'averiguacion' || tipo == 'no_causa'){ var letras = "1234567890/-"; }
    if(tipo == 'acumulados'){ var letras = "1234567890/"; }
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

    if (e.length > e.maxLength){
    	e.value = e.value.slice(0, e.maxLength)
    }
  }
//PRECARGAR INFORMACION DE JUZGADOS
function reload_juzgados(){
	var colaboracion = $('#colaboracion').prop('checked'); console.log(colaboracion);
	//Si esta marcada la casilla de colaboracion mostramos el input para que se ingrese manualmente el nombre del juzgado, si no el del catalogo
	if(colaboracion == true){
		 $('#div_juzgado').hide();
		 $('#div_juzgadoColab').show();
	}else{
		 $('#div_juzgadoColab').hide(); $('#juzgado_colab').val('');
		 $('#div_juzgado').show();
			var ID_ESTADO_JUZGADO = document.getElementById('ID_ESTADO_JUZGADO').value;
			var cont = document.getElementById('ID_JUZGADO');
			$('.preloaderSelect_Juzgados').show(); //GIF carga de información
			$('#ID_JUZGADO').hide();
			ajax=objetoAjax();
			ajax.open("POST", "format/mandamientosJudiciales/templates/template_reloadJuzgados.php");
			ajax.onreadystatechange = function(){
				if (ajax.readyState == 4 && ajax.status == 200) {
					if(colaboracion == true){
						 $('#juzgadoColab').show();
					}else{
						$('.preloaderSelect_Juzgados').hide(); //GIF carga de información
		  	 $('#ID_JUZGADO').show();
					}
					cont.innerHTML = ajax.responseText;
				}
			}
			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			ajax.send("ID_ESTADO_JUZGADO="+ID_ESTADO_JUZGADO);
 }
}

function validateNucs(object){
	var nuc = document.getElementById('nuc').value;
	if (object.value.length > object.maxLength){
		object.value = object.value.slice(0, object.maxLength)
	}
	if(object.value.length == 13){
	 //Invocamos a la funcion que valida si existe el NUC en sigi realizando un callback a la funcion succes de ajax para retornar el valor
			validaNucSIGI_Mandamientos(nuc, function(resp, arrayData){
				existeNuc = resp;
				getArrayData = arrayData;
				console.log("Respuesta funcion valida nuc: "+existeNuc);
				console.log("Información obtenida: "+getArrayData);	
				$('.preloaderSelect_NUC').hide(); //GIF carga de información
    $('#nuc').show();
				if(existeNuc == "NUC_OKSIGI"){
					swal({
				 title: "Se ha validado correctamente el NUC: "+nuc,
	    html: true,
	    text: "<hr><span>Agente del Ministerio Público: <b>"+getArrayData[0][5]+"</b><br>Expediente: <b>"+getArrayData[0][1]+"</b><br>Apertura: <b>"+getArrayData[0][2]+"</b><br>Unidad de investigación: <b>"+getArrayData[0][3]+"</b><br><br><b> * </b>Información del NUC validada en SIGI.<hr> </span>",  
	    type: "success",
	    showCancelButton: false,
	    confirmButtonColor: 'rgba(21,47,74,.9)',
	    confirmButtonText: 'Confirmar',
	    cancelButtonText: "No, Cancelar"
					
				 },
				 function(isConfirm){
				 	if (isConfirm) {
							//ACCION ALK CONFIRMAR 
							}
				 });
				}else if(existeNuc == "NUC_NOEXISTESIGI"){
					swal("", "El NUC no se encuentra iniciado en SIGI, favor de verificar con la unidad correspondiente", "warning");
					$('#nuc').val('');
				}else if(existeNuc == "NUC_INVALIDO"){
					swal("", "Longitud de NUC invalida, favor de verificar.", "warning");
					$('#nuc').val('');
				}
		 }); //Termina función callback a funcion ajac verificadora del nuc
	}
}

function validaNucSIGI_Mandamientos(nuc, my_callback){
	//Longitud de NUC ok, validar NUC en SIGI
	var resp = Array();
	//CONDICIONALES
	resp[0] = "NUC_INVALIDO";
	resp[1] = "NUC_NOEXISTESIGI";
	resp[2] = "NUC_OKSIGI";
 $('.preloaderSelect_NUC').show(); //GIF carga de información
 $('#nuc').hide();
	if(nuc.length == 13){
		$.ajax({
			type: "POST",
			dataType: 'html',
			contentType: "application/x-www-form-urlencoded",
			processData: true,
			url: "format/mandamientosJudiciales/validaNucSigi.php",
			data: "nuc="+nuc,
			success: function(getData){
				var json = getData;
				var obj = eval("(" + json + ")");
				if (obj.first == "NO"){ 
						$('#cargandoInfo').modal('hide');
					console.log("El nuc NO EXISTE en la base de datos de SIGI");
					my_callback(resp[1]); //AQUI
					return resp[1];
				}else{
				 if (obj.first == "SI"){
				 	$('#cargandoInfo').modal('hide');
				 	console.log("El nuc SI EXISTE en la base de datos de SIGI");
				 	my_callback(resp[2], obj.arrayData ); //AQUI
				 	return [ resp[2], obj.arrayData ];
				 }
				}
			}
		});
	}else{
		$('#cargandoInfo').modal('hide');
		console.log("Longitud invalida de NUC");
		my_callback(resp[0]); //AQUI
		return resp[0];
	}
}
//PRECARGAR TIPO INFORMACION
function reloadTipoInvestigacion(){
	var TIPO_INVESTIGACION = document.getElementById('TIPO_INVESTIGACION').value;
	if(TIPO_INVESTIGACION == 1){
		$('#div_nuc').hide();
		$('#div_nuc_averiguacion').show();
		$('#nuc').val('');
	}else{
		$('#div_nuc_averiguacion').hide();
		$('#div_nuc').show();
		$('#NO_AVERIGUACION').val('');
	}
}
//ELIMINA DATOS DEL INPUT AL QUITAR SELECCION
function exist_acum(actualizacion){
	if(actualizacion == 0){
		$('#ACUMULADO_PROCESO').val('');
	 $('#ACUMULADO_AVERIGUACION').val('');
	}
}
//PRECARGAR MODALIDAD DEL DELITO
function reload_modalidad(){
	var cv_delito = document.getElementById('ID_DELITO').value;
	var cont = document.getElementById('ID_MODALIDAD');
	ajax=objetoAjax();
	ajax.open("POST", "format/mandamientosJudiciales/templates/template_reload_modalidad.php");
	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("cv_delito="+cv_delito);
}
//INPUT JUZGADO COLABORACION
function reloadJuzgadoColaboracion(){
	var colaboracion = $('#colaboracion').prop('checked');
	var cont = document.getElementById('juzgadoColab');
	ajax=objetoAjax();
	ajax.open("POST", "format/mandamientosJudiciales/templates/template_reloadJuzgadosColaboracion.php");
	ajax.onreadystatechange = function(){
		if (ajax.readyState == 4 && ajax.status == 200) {
			cont.innerHTML = ajax.responseText;
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("colaboracion="+colaboracion);
}
//FUNCION MUESTRA MODAL REGISTRO DE INFORMACION GENERAL DE MEDIDA
function guardar_mandamiento(tipoModal, idEnlace, idUnidad, idfisca, ID_MANDAMIENTO_INTERNO){
		/////////////////////////// SI EL TIPO MODAL ES UNA NUEVA MEDIDA ENTONCES ES  0 ///////////////////////////////
		var dataValidate = validateDataMandamiento(); //Validamos que la información principal halla sido llenada previamente	 
		if(dataValidate[0] == 'true'){
	 	$('#cargandoInfo').modal('show');
	 	var contentArrayData = JSON.parse(dataValidate[1]); //Obtenemos la informacion del arreglo
			console.log("info: "+contentArrayData[1]); //NUC
			var nuc = contentArrayData[26];
			var existeNuc; 
			var dataPrincipalArray = {};  
			for(i in contentArrayData){  dataPrincipalArray[i] = contentArrayData[i];   }
			dataPrincipalArray = JSON.stringify(dataPrincipalArray);
		console.log("aqui esta: "+dataPrincipalArray);
	  //Invocamos a la funcion que valida si existe el NUC en sigi realizando un callback a la funcion succes de ajax para retornar el valor
			validaNucSIGI_Mandamientos(nuc, function(resp, arrayData){
				existeNuc = resp;
				getArrayData = arrayData;
				console.log("Respuesta funcion valida nuc: "+existeNuc);
				console.log("Información obtenida: "+getArrayData);	
				if(existeNuc == "NUC_OKSIGI"){
					swal({
				 title: "¿Guardar información de mandamiento del NUC: "+nuc+"?",
	    html: true,
	    text: "<hr><span>Agente del Ministerio Público: <b>"+getArrayData[0][5]+"</b><br>Expediente: <b>"+getArrayData[0][1]+"</b><br>Apertura: <b>"+getArrayData[0][2]+"</b><br>Unidad de investigación: <b>"+getArrayData[0][3]+"</b><br><br><b> * </b>Información del NUC validada en SIGI.<hr> </span>",  
	    type: "success",
	    showCancelButton: true,
	    confirmButtonColor: 'rgba(21,47,74,.9)',
	    confirmButtonText: 'Si. Enviar información',
	    cancelButtonText: "No, Cancelar"
					
				 },
				 function(isConfirm){
				 	if (isConfirm) {
				 		/********INSERCION*******/
				 		if(ID_MANDAMIENTO_INTERNO == 0){
				 			$.ajax({
						  	type: "POST",
						  	dataType: 'html',
						  	url: "format/mandamientosJudiciales/inserts/guardar_mandamiento.php",
						  	data: "&tipoModal="+tipoModal+"&idEnlace="+idEnlace+"&idUnidad="+idUnidad+"&idfisca="+idfisca+"&ID_MANDAMIENTO_INTERNO="+ID_MANDAMIENTO_INTERNO+"&dataPrincipalArray="+dataPrincipalArray,
						  	success: function(resp){
						  		var json = resp;
						  		var obj = eval("(" + json + ")");
						  		console.log(obj);
						  		if (obj.first == "NO") { 
						  			alert("No se registro verifique los datos.");
						  			swal("", "No se registro verifique los datos.", "warning"); 
						  		}else{
						  			if (obj.first == "SI") {
						  				var obj = eval("(" + json + ")");
						  				//alert("Agregado exitosmente");
						  				reload_modalMandamientos_registro(1, idEnlace, obj.ID_MANDAMIENTO_INTERNO, 0, 0, idfisca, idUnidad);
						  				swal("", "Registro agregado exitosamente.", "success");
						  			}
						  		}
						  	}
						  });/********INSERCION*******/
				 		}else if(ID_MANDAMIENTO_INTERNO != 0){
				 			/********ACTUALIZACION*******/
							$.ajax({
						  	type: "POST",
						  	dataType: 'html',
						  	url: "format/mandamientosJudiciales/inserts/actualizar_mandamiento.php",
						  	data: "&tipoModal="+tipoModal+"&idEnlace="+idEnlace+"&idUnidad="+idUnidad+"&idfisca="+idfisca+"&ID_MANDAMIENTO_INTERNO="+ID_MANDAMIENTO_INTERNO+"&dataPrincipalArray="+dataPrincipalArray,
						  	success: function(resp){
						  		var json = resp;
						  		var obj = eval("(" + json + ")");
						  		console.log(obj);
						  		if (obj.first == "NO") { 
						  			alert("No se pudo actualizar, verifique los datos.");
						  			swal("", "No se pudo actualizar, verifique los datos.", "warning"); 
						  		}else{
						  			if (obj.first == "SI") {
						  				var obj = eval("(" + json + ")");
						  				//alert("Agregado exitosmente");
						  				swal("", "Registro actualizado exitosamente.", "success");
						  				reload_modalMandamientos_registro(1, idEnlace, obj.ID_MANDAMIENTO_INTERNO, 0, 0, idfisca, idUnidad);
						  			}
						  		}
						  	}
						  });
							/********ACTUALIZACION*******/
				 		}		
						}
				 });
				}else if(existeNuc == "NUC_NOEXISTESIGI"){
					swal("", "El NUC no se encuentra iniciado en SIGI, favor de verificar con la unidad correspondiente", "warning");
				}else if(existeNuc == "NUC_INVALIDO"){
					swal("", "Longitud de NUC invalida, favor de verificar.", "warning");
				}
		 }); //Termina función callback a funcion ajac verificadora del nuc
	 }else{
	 	swal("", "Faltan datos por ingresar, verifique los campos en rojo.", "warning");
	 }
}

//FUNCION PARA VALIDAR LOS CAMPOS
function validateDataMandamiento(){
 var FECHA_CAPTURA = document.getElementById("FECHA_CAPTURA").value;
 var ID_PAIS = document.getElementById("ID_PAIS").value;
 var ID_ESTADO_EMISOR = document.getElementById("ID_ESTADO_EMISOR").value;
 var ID_MUNICIPIO = document.getElementById("ID_MUNICIPIO").value;
 var ID_EMISOR = document.getElementById("ID_EMISOR").value;
 var FISCALIA = document.getElementById("FISCALIA").value;
 var ID_TIPO_MANDATO = document.getElementById("ID_TIPO_MANDATO").value;
 var NO_MANDATO = document.getElementById("NO_MANDATO").value;
 var ID_TIPO_PROCESO = document.getElementById("ID_TIPO_PROCESO").value;
 var EDO_ORDEN = document.getElementById("EDO_ORDEN").value;
 var FECHA_RECEPCION = document.getElementById("FECHA_RECEPCION").value;
 var FECHA_OFICIO = document.getElementById("FECHA_OFICIO").value;
 var ID_TIPO_CUANTIA = document.getElementById("ID_TIPO_CUANTIA").value;
 var ID_FUERO_PROCESO = document.getElementById("ID_FUERO_PROCESO").value;
 var ID_PROCESO_EXTRADI = document.getElementById("ID_PROCESO_EXTRADI").value;
 var ID_ESTADO_JUZGADO = document.getElementById("ID_ESTADO_JUZGADO").value;
 var JUZGADO_COLABORACION = document.getElementById("JUZGADO_COLABORACION").value;
 var ID_JUZGADO = document.getElementById("ID_JUZGADO").value;
 var OFICIO_JUZGADO = document.getElementById("OFICIO_JUZGADO").value;
 var FECHA_PRESCRIPCION = document.getElementById("FECHA_PRESCRIPCION").value;
 var NO_CAUSA = document.getElementById("NO_CAUSA").value;
 var NO_PROCESO = document.getElementById("NO_PROCESO").value;
 var FECHA_LIBRAMIENTO = document.getElementById("FECHA_LIBRAMIENTO").value;
 var TIPO_INVESTIGACION = document.getElementById("TIPO_INVESTIGACION").value;
 var NO_AVERIGUACION = document.getElementById("NO_AVERIGUACION").value; 
	var nuc = document.getElementById("nuc").value; 
 var ACUMULADO_PROCESO = document.getElementById("ACUMULADO_PROCESO").value;
 var ACUMULADO_AVERIGUACION = document.getElementById("ACUMULADO_AVERIGUACION").value;
 var OBSERVACIONES = document.getElementById("OBSERVACIONES").value;
 var OBSERVACIONES_INT = document.getElementById("OBSERVACIONES_INT").value;
 var COLABORACION = $('#colaboracion').prop('checked');
 if(COLABORACION == true) { COLABORACION = 1; ID_JUZGADO = 'no'; }else{ COLABORACION = 0; JUZGADO_COLABORACION = 'no' }


 //Arreglo de campos para validar con color rojo, si se agrega un nuevo campo, agregar en el arreglo para incluir en la validacion de color
 var arrayCamposValida = [ "FECHA_CAPTURA" , "ID_PAIS" , "ID_ESTADO_EMISOR" , "ID_MUNICIPIO" , "ID_EMISOR" , "FISCALIA" , "ID_TIPO_MANDATO" , "NO_MANDATO" , "ID_TIPO_PROCESO" , "EDO_ORDEN" , "FECHA_RECEPCION" ,
                           "FECHA_OFICIO" , "ID_TIPO_CUANTIA" , "ID_FUERO_PROCESO" , "ID_PROCESO_EXTRADI" , "ID_ESTADO_JUZGADO" , "JUZGADO_COLABORACION" , "ID_JUZGADO" , "OFICIO_JUZGADO" , "FECHA_PRESCRIPCION" , "NO_CAUSA" , 
                           "NO_PROCESO" , "FECHA_LIBRAMIENTO" , "TIPO_INVESTIGACION" , "nuc"  ];
 //Arreglo de variables de informacion, donde se verifica si hay informacion en dicha variable
 var arrayCamposData = [ FECHA_CAPTURA , ID_PAIS , ID_ESTADO_EMISOR , ID_MUNICIPIO , ID_EMISOR , FISCALIA , ID_TIPO_MANDATO, NO_MANDATO , ID_TIPO_PROCESO , EDO_ORDEN , FECHA_RECEPCION , FECHA_OFICIO , 
                         ID_TIPO_CUANTIA , ID_FUERO_PROCESO , ID_PROCESO_EXTRADI , ID_ESTADO_JUZGADO , JUZGADO_COLABORACION , ID_JUZGADO , OFICIO_JUZGADO , FECHA_PRESCRIPCION , NO_CAUSA , NO_PROCESO , 
                         FECHA_LIBRAMIENTO , TIPO_INVESTIGACION , nuc  ];
 //Bucle del tamaño de los campos, se verifica si la variable tiene información, si esta no tiene coloreamos el input de color rojo
 for(x = 0; x < arrayCamposValida.length; x++){
 	if($.trim(arrayCamposData[x]) == ""){
 		cont = document.getElementById(arrayCamposValida[x]); 
 		cont.style.border = "1px solid red";
 	}
 }

	if( FECHA_CAPTURA != "" && ID_PAIS != "" && ID_ESTADO_EMISOR != "" && ID_MUNICIPIO != "" && ID_EMISOR != "" && FISCALIA != "" && ID_TIPO_MANDATO != "" &&
		   NO_MANDATO != "" && ID_TIPO_PROCESO != "" && EDO_ORDEN  != "" && FECHA_RECEPCION != "" && FECHA_OFICIO != "" && ID_TIPO_CUANTIA != "" && ID_FUERO_PROCESO != "" &&
		   ID_PROCESO_EXTRADI != "" && ID_ESTADO_JUZGADO != "" && JUZGADO_COLABORACION != "" && ID_JUZGADO != ""  && OFICIO_JUZGADO != "" && FECHA_PRESCRIPCION != "" &&
		   NO_CAUSA != "" && NO_PROCESO != "" && FECHA_LIBRAMIENTO != "" && TIPO_INVESTIGACION != "" &&  nuc != ""  ){

		if(ID_JUZGADO == 'no') ID_JUZGADO = 0;
	if(JUZGADO_COLABORACION == 'no') JUZGADO_COLABORACION = '';

		var dataGenerales = Array();
  dataGenerales[1] = FECHA_CAPTURA;
  dataGenerales[2] = ID_PAIS;
  dataGenerales[3] = ID_ESTADO_EMISOR;
  dataGenerales[4] = ID_MUNICIPIO;
  dataGenerales[5] = ID_EMISOR;
  dataGenerales[6] = FISCALIA;
  dataGenerales[7] = ID_TIPO_MANDATO;
  dataGenerales[8] = NO_MANDATO;
  dataGenerales[9] = ID_TIPO_PROCESO;
  dataGenerales[10] = EDO_ORDEN;
  dataGenerales[11] = FECHA_RECEPCION;
  dataGenerales[12] = FECHA_OFICIO;
  dataGenerales[13] = ID_TIPO_CUANTIA;
  dataGenerales[14] = ID_FUERO_PROCESO;
  dataGenerales[15] = ID_PROCESO_EXTRADI;
  dataGenerales[16] = ID_ESTADO_JUZGADO;
  dataGenerales[17] = JUZGADO_COLABORACION;
  dataGenerales[18] = ID_JUZGADO;
  dataGenerales[19] = OFICIO_JUZGADO;
  dataGenerales[20] = FECHA_PRESCRIPCION;
  dataGenerales[21] = NO_CAUSA;
  dataGenerales[22] = NO_PROCESO;
  dataGenerales[23] = FECHA_LIBRAMIENTO;
  dataGenerales[24] = TIPO_INVESTIGACION;
  dataGenerales[25] = NO_AVERIGUACION;
  dataGenerales[26] = nuc;
  dataGenerales[27] = ACUMULADO_PROCESO;
  dataGenerales[28] = ACUMULADO_AVERIGUACION;
  dataGenerales[29] = OBSERVACIONES;
  dataGenerales[30] = OBSERVACIONES_INT;
  dataGenerales[31] = COLABORACION;



  var dataGeneralArray = {};  
  for(i in dataGenerales){
  	dataGeneralArray[i] = dataGenerales[i];
  }
  dataGeneralArray = JSON.stringify(dataGeneralArray);
		return ['true' , dataGeneralArray];
	}else{
		return ['false', 0];
	}

}

//Validamos los input para quitar el bordeado rojo una vez que se detecte que contiene informacion
function validateCampo_OK(element){
	cont = document.getElementById(element);
	cont.style.border = "";
}

function reload_modalMandamientos_registro(tipoModal, idEnlace, ID_MANDAMIENTO_INTERNO, typeArch, typeCheck, idfisca, idUnidad){
$('#cargandoInfoModal').modal('show');	
cont = document.getElementById('contModalMandamientos_registro');
ajax=objetoAjax();
ajax.open("POST", "format/mandamientosJudiciales/modalMandamientos_registro.php");
ajax.onreadystatechange = function(){
	if (ajax.readyState == 4 && ajax.status == 200) {
	 $('#cargandoInfoModal').modal('hide');
		cont.innerHTML = ajax.responseText;
	}
}
ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
ajax.send("&tipoModal="+tipoModal+"&idEnlace="+idEnlace+"&ID_MANDAMIENTO_INTERNO="+ID_MANDAMIENTO_INTERNO+"&typeArch="+typeArch+"&typeCheck="+typeCheck+"&idfisca="+idfisca+"&idUnidad="+idUnidad);
}

function guardar_mandamiento_inculpado(tipoModal, idEnlace, idUnidad, idfisca, ID_MANDAMIENTO_INTERNO , tipoActualizacion){
	/////////////////////////// SI EL TIPO MODAL ES UN NUEVO MANDAMIENTO ENTONCES ES  0 ///////////////////////////////
	/*ENTRARA AQUI CUANDO SE AGREGEN LOS DATOS GENERALES Y DATOS DEL INCULPADO AL MISMO TIEMPO*/
	if(ID_MANDAMIENTO_INTERNO == 0){
		var dataValidate = validateDataMandamiento(); //Validamos que la información principal halla sido llenada previamente
		if(dataValidate[0] == 'true'){
			var dataValidate_inculpado = validateDataInputado(); //Validamos que la información del inculpado se halla llenado
			if(dataValidate_inculpado[0] == 'true'){
				$('#cargandoInfo').modal('show');
		 	var contentArrayData = JSON.parse(dataValidate[1]); //Obtenemos la informacion del arreglo
		 	var contentArrayData_inculpado = JSON.parse(dataValidate_inculpado[1]); //Obtenemos la informacion del arreglo del inculpado
				console.log("info: "+contentArrayData[1]); //NUC
				var nuc = contentArrayData[26];
				var existeNuc; 
				var dataPrincipalArray = {};  
				for(i in contentArrayData){  dataPrincipalArray[i] = contentArrayData[i];   }
				dataPrincipalArray = JSON.stringify(dataPrincipalArray);
			 var dataInputadoArray = {};
    for(j in contentArrayData_inculpado){  dataInputadoArray[j] = contentArrayData_inculpado[j];   }
				dataInputadoArray = JSON.stringify(dataInputadoArray);
			 console.log("INFORMACION GENERAL DEL MANDAMIENTO: "+ dataPrincipalArray);
				console.log("INFORMACION GENERAL DEL INPUTADO: "+ dataInputadoArray);
		  //Invocamos a la funcion que valida si existe el NUC en sigi realizando un callback a la funcion succes de ajax para retornar el valor
				validaNucSIGI_Mandamientos(nuc, function(resp, arrayData){
					existeNuc = resp;
					getArrayData = arrayData;
					console.log("Respuesta funcion valida nuc: "+existeNuc);
					console.log("Información obtenida: "+getArrayData);	
					if(existeNuc == "NUC_OKSIGI"){
						swal({
					 title: "¿Guardar información de mandamiento del NUC: "+nuc+"?",
		    html: true,
		    text: "<hr><span>Agente del Ministerio Público: <b>"+getArrayData[0][5]+"</b><br>Expediente: <b>"+getArrayData[0][1]+"</b><br>Apertura: <b>"+getArrayData[0][2]+"</b><br>Unidad de investigación: <b>"+getArrayData[0][3]+"</b><br><br><b> * </b>Información del NUC validada en SIGI.<hr> </span>",  
		    type: "success",
		    showCancelButton: true,
		    confirmButtonColor: 'rgba(21,47,74,.9)',
		    confirmButtonText: 'Si. Enviar información',
		    cancelButtonText: "No, Cancelar"
						
					 },
					 function(isConfirm){
					 	if (isConfirm) {
					 		/********INSERCION*******/
					 		if(ID_MANDAMIENTO_INTERNO == 0){
					 			$.ajax({
							  	type: "POST",
							  	dataType: 'html',
							  	url: "format/mandamientosJudiciales/inserts/guardar_mandamiento_inculpado.php",
							  	data: "&dataInputadoArray="+dataInputadoArray+"&tipoModal="+tipoModal+"&idEnlace="+idEnlace+"&idUnidad="+idUnidad+"&idfisca="+idfisca+"&ID_MANDAMIENTO_INTERNO="+ID_MANDAMIENTO_INTERNO+"&dataPrincipalArray="+dataPrincipalArray+
							  	      "&tipoActualizacion="+tipoActualizacion,
							  	success: function(resp){
							  		var json = resp;
							  		var obj = eval("(" + json + ")");
							  		console.log(obj);
							  		if (obj.first == "NO") { 
							  			alert("No se registro verifique los datos.");
							  			swal("", "No se registro verifique los datos.", "warning"); 
							  		}else{
							  			if (obj.first == "SI") {
							  				var obj = eval("(" + json + ")");
							  				//alert("Agregado exitosmente");
							  				swal("", "Registro agregado exitosamente.", "success");
							  				$('#inculpados').modal('hide');
							  				$('#mandamientos').modal('show'); 
							  				reload_modalMandamientos_registro(1, idEnlace, obj.ID_MANDAMIENTO_INTERNO, 0, 0, idfisca, idUnidad);
							  			}
							  		}
							  	}
							  });/********INSERCION*******/
					 		}		
							}
					 });
					}else if(existeNuc == "NUC_NOEXISTESIGI"){
						swal("", "El NUC no se encuentra iniciado en SIGI, favor de verificar con la unidad correspondiente", "warning");
					}else if(existeNuc == "NUC_INVALIDO"){
						swal("", "Longitud de NUC invalida, favor de verificar.", "warning");
					}
			 }); //Termina función callback a funcion ajac verificadora del nuc
			}else{
				//Validamos que la información del inculpado halla sido llenada previamente, si faltan datos se muestra este mensaje
		 	swal("", "Faltan datos por ingresar del inculpado, verifique los campos en rojo.", "warning");
			}
		}else{
			//Validamos que la información principal halla sido llenada previamente, si faltan datos se muestra este mensaje
			swal("", "Faltan datos por ingresar, verifique los campos en rojo en la pantalla anterior.", "warning");
		}
		/*TERMINA IF DE CUANDO SE AGREGEN LOS DATOS GENERALES Y DATOS DEL INCULPADO AL MISMO TIEMPO*/
	}	else{
		//SI EL ID_MANDAMIENTO_INTERNO EXISTE Y ES DIFERENTE DE CERO ENTRA EN ESTA CONDICIONAL, AQUI ENTRAMOS CUANDO SE GUARDA PRIMERO DATOS GENERALES Y ENSEGUIDA DATOS DEL INPUTADO
		var dataValidate_inculpado = validateDataInputado(); //Validamos que la información del inculpado se halla llenado
			if(dataValidate_inculpado[0] == 'true'){
				var contentArrayData_inculpado = JSON.parse(dataValidate_inculpado[1]); //Obtenemos la informacion del arreglo del inculpado
				var dataInputadoArray = {};
				for(j in contentArrayData_inculpado){  dataInputadoArray[j] = contentArrayData_inculpado[j];   }
				dataInputadoArray = JSON.stringify(dataInputadoArray);
				console.log("INFORMACION GENERAL DEL INPUTADO: "+ dataInputadoArray);
				if(tipoActualizacion == "NO_EXISTE_DATA_INPUTADO"){
						/********INSERTAR*******/
							$.ajax({
						  	type: "POST",
						  	dataType: 'html',
						  	url: "format/mandamientosJudiciales/inserts/guardar_mandamiento_inculpado.php",
						  	data: "&dataInputadoArray="+dataInputadoArray+"&tipoModal="+tipoModal+"&idEnlace="+idEnlace+"&idUnidad="+idUnidad+"&idfisca="+idfisca+"&ID_MANDAMIENTO_INTERNO="+ID_MANDAMIENTO_INTERNO+
						  	      "&tipoActualizacion="+tipoActualizacion,
						  	success: function(resp){
						  		var json = resp;
						  		var obj = eval("(" + json + ")");
						  		console.log(obj);
						  		if (obj.first == "NO") { 
						  			alert("No se pudo registrar los datos del inculpado, verifique los datos.");
						  			swal("", "No se pudo registrar los datos del inculpado, verifique los datos.", "warning"); 
						  		}else{
						  			if (obj.first == "SI") {
						  				var obj = eval("(" + json + ")");
						  				//alert("Agregado exitosmente");
						  				swal("", "Datos del inculpado agregados exitosamente.", "success");
						  				$('#inculpados').modal('hide');
							  				$('#mandamientos').modal('show'); 
						  				reload_modalMandamientos_registro(1, idEnlace, obj.ID_MANDAMIENTO_INTERNO, 0, 0, idfisca, idUnidad);
						  			}
						  		}
						  	}
						  });
					/********INSERTAR*******/
				}else if(tipoActualizacion == "EXISTE_DATA_INPUTADO"){
						/********ACTUALIZACION*******/
							$.ajax({
						  	type: "POST",
						  	dataType: 'html',
						  	url: "format/mandamientosJudiciales/inserts/actualizar_mandamiento_inculpado.php",
						  	data: "&dataInputadoArray="+dataInputadoArray+"&tipoModal="+tipoModal+"&idEnlace="+idEnlace+"&idUnidad="+idUnidad+"&idfisca="+idfisca+"&ID_MANDAMIENTO_INTERNO="+ID_MANDAMIENTO_INTERNO,
						  	success: function(resp){
						  		var json = resp;
						  		var obj = eval("(" + json + ")");
						  		console.log(obj);
						  		if (obj.first == "NO") { 
						  			alert("No se pudo actualizar, verifique los datos.");
						  			swal("", "No se pudo actualizar, verifique los datos.", "warning"); 
						  		}else{
						  			if (obj.first == "SI") {
						  				var obj = eval("(" + json + ")");
						  				//alert("Agregado exitosmente");
						  				swal("", "Registro actualizado exitosamente.", "success");
						  				$('#inculpados').modal('hide');
							  				$('#mandamientos').modal('show'); 
						  				reload_modalMandamientos_registro(1, idEnlace, obj.ID_MANDAMIENTO_INTERNO, 0, 0, idfisca, idUnidad);
						  			}
						  		}
						  	}
						  });
							/********ACTUALIZACION*******/
				}
			}else{
					swal("", "Faltan datos por ingresar del inculpado, verifique los campos en rojo.", "warning");
			}
	}
}

//FUNCION PARA VALIDAR LOS CAMPOS DEL INCULPADO
function validateDataInputado(){
	var NOMBRE = document.getElementById('NOMBRE').value;
	var APATERNO = document.getElementById('APATERNO').value;
	var AMATERNO = document.getElementById('AMATERNO').value;
	var ID_NACIONALIDAD = document.getElementById('ID_NACIONALIDAD').value;
	var ID_SEXO = document.getElementById('ID_SEXO').value;
	var ID_USO_ANTEOJOS = $('input[name="ID_USO_ANTEOJOS"]:checked').val();
	var TATUAJES = $('input[name="TATUAJES"]:checked').val();
	var EDAD = document.getElementById('EDAD').value;
	var ESTATURA = document.getElementById('ESTATURA').value;
	var PESO = document.getElementById('PESO').value;
	var CURP = document.getElementById('CURP').value;
	var OBSERVACIONES_inculpado = document.getElementById('OBSERVACIONES_inculpado').value;
	var FECHA_OBSERVACION = document.getElementById('FECHA_OBSERVACION').value;

	//Arreglo de campos para validar con color rojo, si se agrega un nuevo campo, agregar en el arreglo para incluir en la validacion de color
 var arrayCamposValida = [ "NOMBRE" , "APATERNO" , "AMATERNO" , "ID_NACIONALIDAD" , "ID_SEXO" , "ID_USO_ANTEOJOS" , "TATUAJES" ];
 //Arreglo de variables de informacion, donde se verifica si hay informacion en dicha variable
 var arrayCamposData = [ NOMBRE , APATERNO , AMATERNO , ID_NACIONALIDAD , ID_SEXO , ID_USO_ANTEOJOS , TATUAJES ];
 //Bucle del tamaño de los campos, se verifica si la variable tiene información, si esta no tiene coloreamos el input de color rojo
 for(x = 0; x < arrayCamposValida.length; x++){
 	if($.trim(arrayCamposData[x]) == ""){
 		cont = document.getElementById(arrayCamposValida[x]); 
 		cont.style.border = "1px solid red";
 	}
 }

	if( NOMBRE != "" &&  APATERNO != "" && AMATERNO != "" && ID_NACIONALIDAD != "" && ID_SEXO != "" && ID_USO_ANTEOJOS != "" && TATUAJES != ""  ){

		var dataInputado = Array();
  dataInputado[1] = NOMBRE;
  dataInputado[2] = APATERNO;
  dataInputado[3] = AMATERNO;
  dataInputado[4] = ID_NACIONALIDAD;
  dataInputado[5] = ID_SEXO;
  dataInputado[6] = ID_USO_ANTEOJOS;
  dataInputado[7] = TATUAJES;
  dataInputado[8] = EDAD;
  dataInputado[9] = ESTATURA;
  dataInputado[10] = PESO;
  dataInputado[11] = CURP;
  dataInputado[12] = OBSERVACIONES_inculpado;
  dataInputado[13] = FECHA_OBSERVACION;

  var dataInputadoArray = {};  
  for(i in dataInputado){
  	dataInputadoArray[i] = dataInputado[i];
  }
  dataInputadoArray = JSON.stringify(dataInputadoArray);
		return ['true' , dataInputadoArray];
	}else{
		return ['false', 0];
	}
}


//MUESTRA MODAL REGISTRO DE INCULPADO
function showEditar_mandamiento_inculpado(tipoModal, idEnlace, idUnidad, idfisca, ID_MANDAMIENTO_INTERNO){

	cont = document.getElementById('contModalInculpados_registro');
			ajax=objetoAjax();
			ajax.open("POST", "format/mandamientosJudiciales/modalInculpados_registro.php");
  
			ajax.onreadystatechange = function(){
				if (ajax.readyState == 4 && ajax.status == 200) {
					cont.innerHTML = ajax.responseText;
					$('.dataAutocomplet').select2({width: '100%',placeholder: "Seleccione",allowClear: false});	
					$('#mandamientos').modal('hide');
			  $('#inculpados').modal('show'); 
				}
			}
			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			ajax.send("&tipoModal="+tipoModal+"&idEnlace="+idEnlace+"&idUnidad="+idUnidad+"&idfisca="+idfisca+"&ID_MANDAMIENTO_INTERNO="+ID_MANDAMIENTO_INTERNO);

}

function agregar_delito(tipoModal, idEnlace, idUnidad, idfisca, ID_MANDAMIENTO_INTERNO){
	$('#btn_Agregar_Delito').prop('disabled', true);
 var dataValidate_delito = validateDataDelito(); //Validamos que la información del delito se halla llenado
 if(dataValidate_delito[0] == 'true'){
 	var contentArrayData_Delito = JSON.parse(dataValidate_delito[1]); //Obtenemos la informacion del arreglo del delito
		var dataDelitoArray = {};
		for(j in contentArrayData_Delito){  dataDelitoArray[j] = contentArrayData_Delito[j];   }
		dataDelitoArray = JSON.stringify(dataDelitoArray);
		console.log("INFORMACION DEL DELITO: "+ dataDelitoArray);
 	$.ajax({
 		type: "POST",
 		dataType: 'html',
 		url: "format/mandamientosJudiciales/inserts/guardar_delito.php",
			data: "&dataDelitoArray="+dataDelitoArray+"&tipoModal="+tipoModal+"&idEnlace="+idEnlace+"&idUnidad="+idUnidad+"&idfisca="+idfisca+"&ID_MANDAMIENTO_INTERNO="+ID_MANDAMIENTO_INTERNO,
			success: function(resp){
				var json = resp;
				var obj = eval("(" + json + ")");
				console.log(obj);
				if (obj.first == "NO") { 
					alert("No se pudo actualizar, verifique los datos.");
					swal("", "No se pudo actualizar, verifique los datos.", "warning"); 
				}else{
					if (obj.first == "SI") {
						var obj = eval("(" + json + ")");
						//alert("Agregado exitosmente");
						swal("", "Delito agregado exitosamente", "success");
						$('#btn_Agregar_Delito').prop('disabled', false);
						reload_modalMandamientos_registro(1, idEnlace, obj.ID_MANDAMIENTO_INTERNO, 0, 0, idfisca, idUnidad);
					}
				}
			}
		});
	}else{
		swal("", "Faltan datos del delito por ingresar, verifique los campos en rojo", "warning");
			$('#btn_Agregar_Delito').prop('disabled', false);
	}	
}

//FUNCION PARA VALIDAR LOS DELITOS
function validateDataDelito(){
	var ID_DELITO = document.getElementById('ID_DELITO').value;
	var ID_DATOS_INCULPADO = document.getElementById('ID_DATOS_INCULPADO').value;
	var ID_MODALIDAD = document.getElementById('ID_MODALIDAD').value;
	var ES_PRINCIPAL = $('input[name="ES_PRINCIPAL"]:checked').val();

	//Arreglo de campos para validar con color rojo, si se agrega un nuevo campo, agregar en el arreglo para incluir en la validacion de color
 var arrayCamposValida = [ "ID_DELITO" , "ID_DATOS_INCULPADO" , "ID_MODALIDAD" , "ES_PRINCIPAL" ];
 //Arreglo de variables de informacion, donde se verifica si hay informacion en dicha variable
 var arrayCamposData = [ ID_DELITO , ID_DATOS_INCULPADO , ID_MODALIDAD , ES_PRINCIPAL ];
 //Bucle del tamaño de los campos, se verifica si la variable tiene información, si esta no tiene coloreamos el input de color rojo
 for(x = 0; x < arrayCamposValida.length; x++){
 	if($.trim(arrayCamposData[x]) == ""){
 		cont = document.getElementById(arrayCamposValida[x]); 
 		cont.style.border = "1px solid red";
 	}
 }

	if( ID_DELITO != "" && ID_DATOS_INCULPADO != "" && ID_MODALIDAD != "" && ES_PRINCIPAL != ""  ){

		var dataDelitos = Array();
  dataDelitos[1] = ID_DELITO;
  dataDelitos[2] = ID_DATOS_INCULPADO;
  dataDelitos[3] = ID_MODALIDAD;
  dataDelitos[4] = ES_PRINCIPAL;

  var dataDelitosArray = {};  
  for(i in dataDelitos){
  	dataDelitosArray[i] = dataDelitos[i];
  }
  dataDelitosArray = JSON.stringify(dataDelitosArray);
		return ['true' , dataDelitosArray];
	}else{
		return ['false', 0];
	}
}

function elimiar_delito(tipoModal, idEnlace, idUnidad, idfisca, ID_DELITOS_INTERNO, ID_MANDAMIENTO_INTERNO){
		swal({
			title: "Estas seguro de Eliminar?",
    text: "Se eliminara el delito de la base de datos",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: '#DD6B55',
    confirmButtonText: 'Si. Eliminar',
    cancelButtonText: "No, Cancelar"
				
			},
			function(isConfirm){
				if (isConfirm) {
			 	$.ajax({
			 		type: "POST",
			 		dataType: 'html',
			 		url: "format/mandamientosJudiciales/inserts/eliminar_delito.php",
						data: "&tipoModal="+tipoModal+"&idEnlace="+idEnlace+"&idUnidad="+idUnidad+"&idfisca="+idfisca+"&ID_DELITOS_INTERNO="+ID_DELITOS_INTERNO+"&ID_MANDAMIENTO_INTERNO="+ID_MANDAMIENTO_INTERNO,
						success: function(resp){
							var json = resp;
							var obj = eval("(" + json + ")");
							console.log(obj);
							if (obj.first == "NO") { 
								swal("", "No se pudo eliminar, intente de nuevo.", "warning"); 
							}else{
								if (obj.first == "SI") {
									var obj = eval("(" + json + ")");
									//alert("Agregado exitosmente");
									swal("", "Delito eliminado", "success");
									reload_modalMandamientos_registro(1, idEnlace, obj.ID_MANDAMIENTO_INTERNO, 0, 0, idfisca, idUnidad);
								}
							}
						}
					});
				}
			});	
}

function elimiar_inculpado(tipoModal, idEnlace, idUnidad, idfisca, ID_INCULPADO_INTERNO, ID_MANDAMIENTO_INTERNO){
		swal({
			title: "Estas seguro de Eliminar?",
    text: "Se eliminaran los datos del inculpado y los delitos asociados de la base de datos",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: '#DD6B55',
    confirmButtonText: 'Si. Eliminar',
    cancelButtonText: "No, Cancelar"
				
			},
			function(isConfirm){
				if (isConfirm) {
			 	$.ajax({
			 		type: "POST",
			 		dataType: 'html',
			 		url: "format/mandamientosJudiciales/inserts/eliminar_inculpado.php",
						data: "&tipoModal="+tipoModal+"&idEnlace="+idEnlace+"&idUnidad="+idUnidad+"&idfisca="+idfisca+"&ID_INCULPADO_INTERNO="+ID_INCULPADO_INTERNO+"&ID_MANDAMIENTO_INTERNO="+ID_MANDAMIENTO_INTERNO,
						success: function(resp){
							var json = resp;
							var obj = eval("(" + json + ")");
							console.log(obj);
							if (obj.first == "NO") { 
								swal("", "No se pudo eliminar, intente de nuevo.", "warning"); 
							}else{
								if (obj.first == "SI") {
									var obj = eval("(" + json + ")");
									//alert("Agregado exitosmente");
									swal("", "Datos del inculpado eliminados", "success");
									reload_modalMandamientos_registro(1, idEnlace, obj.ID_MANDAMIENTO_INTERNO, 0, 0, idfisca, idUnidad);
								}
							}
						}
					});
				}
			});	
}

function guardar_mandamiento_agraviado(tipoModal, idEnlace, idUnidad, idfisca, ID_MANDAMIENTO_INTERNO , tipoActualizacion, ID_DATOS_AGRAVIADO_INTERNO){
	/////////////////////////// SI EL TIPO MODAL ES UN NUEVO MANDAMIENTO ENTONCES ES  0 ///////////////////////////////
	/*ENTRARA AQUI CUANDO SE AGREGEN LOS DATOS GENERALES Y DATOS DEL AGRAVIADO AL MISMO TIEMPO*/
	if(ID_MANDAMIENTO_INTERNO == 0){
		var dataValidate = validateDataMandamiento(); //Validamos que la información principal halla sido llenada previamente
		if(dataValidate[0] == 'true'){
			var dataValidate_agraviado = validateDataAgraviado(); //Validamos que la información del agraviado se halla llenado
			if(dataValidate_agraviado[0] == 'true'){
				$('#cargandoInfo').modal('show');
		 	var contentArrayData = JSON.parse(dataValidate[1]); //Obtenemos la informacion del arreglo
		 	var contentArrayData_agraviado = JSON.parse(dataValidate_agraviado[1]); //Obtenemos la informacion del arreglo del agraviado
				console.log("info: "+contentArrayData[1]); //NUC
				var nuc = contentArrayData[26];
				var existeNuc; 
				var dataPrincipalArray = {};  
				for(i in contentArrayData){  dataPrincipalArray[i] = contentArrayData[i];   }
				dataPrincipalArray = JSON.stringify(dataPrincipalArray);
			 var dataAgraviadoArray = {};
    for(j in contentArrayData_agraviado){  dataAgraviadoArray[j] = contentArrayData_agraviado[j];   }
				dataAgraviadoArray = JSON.stringify(dataAgraviadoArray);
			 console.log("INFORMACION GENERAL DEL MANDAMIENTO: "+ dataPrincipalArray);
				console.log("INFORMACION GENERAL DEL AGRAVIADO: "+ dataAgraviadoArray);
		  //Invocamos a la funcion que valida si existe el NUC en sigi realizando un callback a la funcion succes de ajax para retornar el valor
				validaNucSIGI_Mandamientos(nuc, function(resp, arrayData){
					existeNuc = resp;
					getArrayData = arrayData;
					console.log("Respuesta funcion valida nuc: "+existeNuc);
					console.log("Información obtenida: "+getArrayData);	
					if(existeNuc == "NUC_OKSIGI"){
						swal({
					 title: "¿Guardar información de mandamiento del NUC: "+nuc+"?",
		    html: true,
		    text: "<hr><span>Agente del Ministerio Público: <b>"+getArrayData[0][5]+"</b><br>Expediente: <b>"+getArrayData[0][1]+"</b><br>Apertura: <b>"+getArrayData[0][2]+"</b><br>Unidad de investigación: <b>"+getArrayData[0][3]+"</b><br><br><b> * </b>Información del NUC validada en SIGI.<hr> </span>",  
		    type: "success",
		    showCancelButton: true,
		    confirmButtonColor: 'rgba(21,47,74,.9)',
		    confirmButtonText: 'Si. Enviar información',
		    cancelButtonText: "No, Cancelar"
						
					 },
					 function(isConfirm){
					 	if (isConfirm) {
					 		/********INSERCION*******/
					 		if(ID_MANDAMIENTO_INTERNO == 0){
					 			$.ajax({
							  	type: "POST",
							  	dataType: 'html',
							  	url: "format/mandamientosJudiciales/inserts/guardar_mandamiento_agraviado.php",
							  	data: "&dataAgraviadoArray="+dataAgraviadoArray+"&tipoModal="+tipoModal+"&idEnlace="+idEnlace+"&idUnidad="+idUnidad+"&idfisca="+idfisca+"&ID_MANDAMIENTO_INTERNO="+ID_MANDAMIENTO_INTERNO+"&dataPrincipalArray="+dataPrincipalArray+
							  	      "&tipoActualizacion="+tipoActualizacion,
							  	success: function(resp){
							  		var json = resp;
							  		var obj = eval("(" + json + ")");
							  		console.log(obj);
							  		if (obj.first == "NO") { 
							  			alert("No se registro verifique los datos.");
							  			swal("", "No se registro verifique los datos.", "warning"); 
							  		}else{
							  			if (obj.first == "SI") {
							  				var obj = eval("(" + json + ")");
							  				//alert("Agregado exitosmente");
							  				swal("", "Registro agregado exitosamente.", "success");
							  				$('#agraviados').modal('hide');
							  				$('#mandamientos').modal('show'); 
							  				reload_modalMandamientos_registro(1, idEnlace, obj.ID_MANDAMIENTO_INTERNO, 0, 0, idfisca, idUnidad);
							  			}
							  		}
							  	}
							  });/********INSERCION*******/
					 		}		
							}
					 });
					}else if(existeNuc == "NUC_NOEXISTESIGI"){
						swal("", "El NUC no se encuentra iniciado en SIGI, favor de verificar con la unidad correspondiente", "warning");
					}else if(existeNuc == "NUC_INVALIDO"){
						swal("", "Longitud de NUC invalida, favor de verificar.", "warning");
					}
			 }); //Termina función callback a funcion ajac verificadora del nuc
			}else{
				//Validamos que la información del agraviado halla sido llenada previamente, si faltan datos se muestra este mensaje
		 	swal("", "Faltan datos por ingresar del agraviado, verifique los campos en rojo.", "warning");
			}
		}else{
			//Validamos que la información principal halla sido llenada previamente, si faltan datos se muestra este mensaje
			swal("", "Faltan datos por ingresar, verifique los campos en rojo en la pantalla anterior.", "warning");
		}
		/*TERMINA IF DE CUANDO SE AGREGEN LOS DATOS GENERALES Y DATOS DEL INCULPADO AL MISMO TIEMPO*/
	}	else{
		//SI EL ID_MANDAMIENTO_INTERNO EXISTE Y ES DIFERENTE DE CERO ENTRA EN ESTA CONDICIONAL, AQUI ENTRAMOS CUANDO SE GUARDA PRIMERO DATOS GENERALES Y ENSEGUIDA DATOS DEL INPUTADO
		var dataValidate_agraviado = validateDataAgraviado(); //Validamos que la información del inculpado se halla llenado
			if(dataValidate_agraviado[0] == 'true'){
				var contentArrayData_agraviado = JSON.parse(dataValidate_agraviado[1]); //Obtenemos la informacion del arreglo del agraviado
				var dataAgraviadoArray = {};
				for(j in contentArrayData_agraviado){  dataAgraviadoArray[j] = contentArrayData_agraviado[j];   }
				dataAgraviadoArray = JSON.stringify(dataAgraviadoArray);
				console.log("INFORMACION GENERAL DEL AGRAVIADO: "+ dataAgraviadoArray);
				if(tipoActualizacion == "NO_EXISTE_DATA_AGRAVIADO"){
						/********INSERTAR*******/
							$.ajax({
						  	type: "POST",
						  	dataType: 'html',
						  	url: "format/mandamientosJudiciales/inserts/guardar_mandamiento_agraviado.php",
						  	data: "&dataAgraviadoArray="+dataAgraviadoArray+"&tipoModal="+tipoModal+"&idEnlace="+idEnlace+"&idUnidad="+idUnidad+"&idfisca="+idfisca+"&ID_MANDAMIENTO_INTERNO="+ID_MANDAMIENTO_INTERNO+
						  	      "&tipoActualizacion="+tipoActualizacion,
						  	success: function(resp){
						  		var json = resp;
						  		var obj = eval("(" + json + ")");
						  		console.log(obj);
						  		if (obj.first == "NO") { 
						  			swal("", "No se pudo registrar los datos del inculpado, verifique los datos.", "warning"); 
						  		}else{
						  			if (obj.first == "SI") {
						  				var obj = eval("(" + json + ")");
						  				//alert("Agregado exitosmente");
						  				swal("", "Datos del agraviado agregados exitosamente.", "success");
						  				reload_modalMandamientos_registro(1, idEnlace, obj.ID_MANDAMIENTO_INTERNO, 0, 0, idfisca, idUnidad);
						  			}
						  		}
						  	}
						  });
					/********INSERTAR*******/
				}else if(tipoActualizacion == "EXISTE_DATA_AGRAVIADO"){
						/********ACTUALIZACION*******/
							$.ajax({
						  	type: "POST",
						  	dataType: 'html',
						  	url: "format/mandamientosJudiciales/inserts/actualizar_mandamiento_agraviado.php",
						  	data: "&dataAgraviadoArray="+dataAgraviadoArray+"&tipoModal="+tipoModal+"&idEnlace="+idEnlace+"&idUnidad="+idUnidad+"&idfisca="+idfisca+"&ID_DATOS_AGRAVIADO_INTERNO="+ID_DATOS_AGRAVIADO_INTERNO+"&ID_MANDAMIENTO_INTERNO="+ID_MANDAMIENTO_INTERNO,
						  	success: function(resp){
						  		var json = resp;
						  		var obj = eval("(" + json + ")");
						  		console.log(obj);
						  		if (obj.first == "NO") { 
						  			alert("No se pudo actualizar, verifique los datos.");
						  			swal("", "No se pudo actualizar, verifique los datos.", "warning"); 
						  		}else{
						  			if (obj.first == "SI") {
						  				var obj = eval("(" + json + ")");
						  				//alert("Agregado exitosmente");
						  				swal("", "Registro actualizado exitosamente.", "success");
						  				reload_modalMandamientos_registro(1, idEnlace, obj.ID_MANDAMIENTO_INTERNO, 0, 0, idfisca, idUnidad);
						  			}
						  		}
						  	}
						  });
							/********ACTUALIZACION*******/
				}
			}else{
					swal("", "Faltan datos por ingresar del agraviado, verifique los campos en rojo.", "warning");
			}
	}
}

//FUNCION PARA VALIDAR LOS AGRAVIADOS
function validateDataAgraviado(){
	var NOMBRE_AGRAVIADO = document.getElementById('NOMBRE_AGRAVIADO').value;
	var PATERNO = document.getElementById('PATERNO').value;
	var MATERNO = document.getElementById('MATERNO').value;
	var ES_PRINCIPAL_AGRAVIADO = $('input[name="ES_PRINCIPAL_AGRAVIADO"]:checked').val();

	//Arreglo de campos para validar con color rojo, si se agrega un nuevo campo, agregar en el arreglo para incluir en la validacion de color
 var arrayCamposValida = [ "NOMBRE" , "PATERNO" , "MATERNO" , "ES_PRINCIPAL_AGRAVIADO" ];
 //Arreglo de variables de informacion, donde se verifica si hay informacion en dicha variable
 var arrayCamposData = [ NOMBRE , PATERNO , MATERNO , ES_PRINCIPAL_AGRAVIADO ];
 //Bucle del tamaño de los campos, se verifica si la variable tiene información, si esta no tiene coloreamos el input de color rojo
 for(x = 0; x < arrayCamposValida.length; x++){
 	if($.trim(arrayCamposData[x]) == ""){
 		cont = document.getElementById(arrayCamposValida[x]); 
 		cont.style.border = "1px solid red";
 	}
 }

	if( NOMBRE_AGRAVIADO != "" && PATERNO != "" && MATERNO != "" && ES_PRINCIPAL_AGRAVIADO != ""  ){

		var dataAgraviados = Array();
  dataAgraviados[1] = NOMBRE_AGRAVIADO;
  dataAgraviados[2] = PATERNO;
  dataAgraviados[3] = MATERNO;
  dataAgraviados[4] = ES_PRINCIPAL_AGRAVIADO;

  var dataAgraviadosArray = {};  
  for(i in dataAgraviados){
  	dataAgraviadosArray [i] = dataAgraviados[i];
  }
  dataAgraviadosArray  = JSON.stringify(dataAgraviadosArray );
		return ['true' , dataAgraviadosArray ];
	}else{
		return ['false', 0];
	}
}

function showEditar_mandamiento_agraviado(tipoModal, idEnlace, idUnidad, idfisca,  ID_DATOS_AGRAVIADO_INTERNO){

	cont = document.getElementById('contModalInculpados_registro');
			ajax=objetoAjax();
			ajax.open("POST", "format/mandamientosJudiciales/modalAgraviados_registro.php");
  
			ajax.onreadystatechange = function(){
				if (ajax.readyState == 4 && ajax.status == 200) {
					cont.innerHTML = ajax.responseText;
					$('.dataAutocomplet').select2({width: '100%',placeholder: "Seleccione",allowClear: false});	
					$('#mandamientos').modal('hide');
			  $('#inculpados').modal('show'); 
				}
			}
			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			ajax.send("&tipoModal="+tipoModal+"&idEnlace="+idEnlace+"&idUnidad="+idUnidad+"&idfisca="+idfisca+"&ID_DATOS_AGRAVIADO_INTERNO="+ID_DATOS_AGRAVIADO_INTERNO);

}

function elimiar_agraviado(tipoModal, idEnlace, idUnidad, idfisca, ID_DATOS_AGRAVIADO_INTERNO, ID_MANDAMIENTO_INTERNO){
	console.log(ID_DATOS_AGRAVIADO_INTERNO);
		swal({
			title: "Estas seguro de Eliminar?",
    text: "Se eliminaran los datos del agraviado de la base de datos",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: '#DD6B55',
    confirmButtonText: 'Si. Eliminar',
    cancelButtonText: "No, Cancelar"
				
			},
			function(isConfirm){
				if (isConfirm) {
			 	$.ajax({
			 		type: "POST",
			 		dataType: 'html',
			 		url: "format/mandamientosJudiciales/inserts/eliminar_agraviado.php",
						data: "&tipoModal="+tipoModal+"&idEnlace="+idEnlace+"&idUnidad="+idUnidad+"&idfisca="+idfisca+"&ID_DATOS_AGRAVIADO_INTERNO="+ID_DATOS_AGRAVIADO_INTERNO+"&ID_MANDAMIENTO_INTERNO="+ID_MANDAMIENTO_INTERNO,
						success: function(resp){
							var json = resp;
							var obj = eval("(" + json + ")");
							console.log(obj);
							if (obj.first == "NO") { 
								swal("", "No se pudo eliminar, intente de nuevo.", "warning"); 
							}else{
								if (obj.first == "SI") {
									var obj = eval("(" + json + ")");
									//alert("Agregado exitosmente");
									swal("", "Datos del agraviado eliminados", "success");
									reload_modalMandamientos_registro(1, idEnlace, obj.ID_MANDAMIENTO_INTERNO, 0, 0, idfisca, idUnidad);
								}
							}
						}
					});
				}
			});	
}