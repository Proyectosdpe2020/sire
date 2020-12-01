function getDataTable(){
	var anio = document.getElementById("anioForest").value;
	$.ajax({
		url:'format/forestales/templates/table_forestales.php?anio='+anio,
		type:'POST',
		contentType:false,
		processData:false,
		cache:false
	}).done(function(respuesta){
		$( "#contentForestales" ).html( respuesta );
	});
}

function showModalForestales(anioCapturando , mesCapturando){
	$.ajax({
		url:'format/forestales/modalForestales.php?anioCapturando='+anioCapturando+'&mesCapturando='+mesCapturando,
		type:'POST',
		contentType:false,
		processData:false,
		cache:false,
	}).done(function(respuesta){
		$( "#contModalForestales" ).html( respuesta );
		$('#modalForestales').modal('show');
	});
}

function closeModalForestales(){
		$('#modalForestales').modal('hide');
}

function saveDbForestales(anioCapturando , mesCapturando , verOedita , idForestales){
	var maderaVol = document.getElementById("maderaVol").value;
	var vehiculos = document.getElementById("vehiculos").value;
	var gruas = document.getElementById("gruas").value;
	var motosierras = document.getElementById("motosierras").value;
	var radios = document.getElementById("radios").value;
	var herramientas = document.getElementById("herramientas").value;
	var armas = document.getElementById("armas").value;
	var celulares = document.getElementById("celulares").value;
	var detenidos = document.getElementById("detenidos").value;
	var perApoyFis = document.getElementById("perApoyFis").value;
	var perApoyAgFor = document.getElementById("perApoyAgFor").value;
	var averiOcarpe = document.getElementById("averiOcarpe").value;
	var locaCumplidas = document.getElementById("locaCumplidas").value;
	var invAtendidas = document.getElementById("invAtendidas").value;
	var recorridos = document.getElementById("recorridos").value;
	var operativos = document.getElementById("operativos").value;

	if(maderaVol == ''){ maderaVol = 0; }     if(armas == ''){ armas = 0;}          if(perApoyFis == ''){ perApoyFis = 0;}     if(locaCumplidas == ''){ locaCumplidas = 0; } if(operativos == ''){ operativos = 0; }
	if(vehiculos == ''){ vehiculos = 0; }	    if(celulares == ''){ celulares = 0;}  if(perApoyAgFor == ''){ perApoyAgFor = 0;} if(invAtendidas == ''){ invAtendidas = 0; }
	if(gruas == ''){ gruas = 0; }	            if(detenidos == ''){ detenidos = 0;}  if(averiOcarpe == ''){ averiOcarpe = 0;}   if(recorridos == ''){ recorridos = 0; }
	if(motosierras == ''){ motosierras = 0;}
 if(radios == ''){ radios = 0;}
 if(herramientas == ''){ herramientas = 0;}
	

	$.ajax({
		url:'format/forestales/inserts/insertForestal.php?maderaVol='+maderaVol+'&vehiculos='+vehiculos+'&gruas='+gruas+'&motosierras='+motosierras+'&radios='+radios+'&herramientas='+herramientas+
		      '&armas='+armas+'&celulares='+celulares+'&detenidos='+detenidos+'&perApoyFis='+perApoyFis+'&perApoyAgFor='+perApoyAgFor+'&averiOcarpe='+averiOcarpe+
		      '&locaCumplidas='+locaCumplidas+'&invAtendidas='+invAtendidas+'&recorridos='+recorridos+'&anioCapturando='+anioCapturando+'&mesCapturando='+mesCapturando+
		      '&verOedita='+verOedita+'&idForestales='+idForestales+'&operativos='+operativos,
		type:'POST',
		contentType:false,
		processData:false,
		cache:false,
	}).done(function(respuesta){
		var json = respuesta;
		var obj = eval("(" + json + ")");
		if (obj.first == "NO") { 
			swal("", "No se registro verifique los datos.", "warning"); 
		}else {
			if (obj.first == "SI") {
				var obj = eval("(" + json + ")");
				swal("", "Información capturada exitosamente.", "success");
				reload_table_forestales(anioCapturando, mesCapturando);
				closeModalForestales();
			}
		}
	});
}

function showModalVerInf(idForestales, verOedita, anioCapturando, mesCapturando){
		$.ajax({
		url:'format/forestales/modalForestales.php?idForestales='+idForestales+'&verOedita='+verOedita+'&anioCapturando='+anioCapturando+'&mesCapturando='+mesCapturando,
		type:'POST',
		contentType:false,
		processData:false,
		cache:false
	}).done(function(respuesta){
		$( "#contModalForestales" ).html( respuesta );
		$('#modalForestales').modal('show');
	});
}

function reload_table_forestales(anioCapturando, mesCapturando){
	$.ajax({
		url:'format/forestales/templates/reload_table_forestales.php?anioCapturando='+anioCapturando,
		type:'POST',
		contentType:false,
		processData:false,
		cache:false
	}).done(function(respuesta){
		$( "#contentForestales" ).html( respuesta );
		reload_button_send(mesCapturando);
	});
}

function reload_button_send(mesCapturando){
	$.ajax({
		url:'format/forestales/templates/reload_button_send.php?mesCapturando='+mesCapturando,
		type:'POST',
		contentType:false,
		processData:false,
		cache:false
	}).done(function(respuesta){
		$( "#buttonSend" ).html( respuesta );
	});
}
