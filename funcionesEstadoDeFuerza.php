<?
/*Consulta que obtiene el estado de fuerza filtrando por mando o area de adscripcion*/
function getDataMandoTable($conn, $idMando, $areaAdsc){
	if($idMando != 0){
		$query = " SELECT m.idMando, m.nombre+' '+m.paterno+' '+m.materno as nombreMando, m.nombre, m.paterno, m.materno, pdc.nombre as cargo, f.nombre as funcion, ad.nombre as areaAdscripcion, m.idCargo, m.idFuncion, m.idAreaAdscripcion, m.sexo, m.idFiscalia, m.idSeccion, 
		    m.comisionado, m.fechaAlta, m.fechaActualAdscripcion, m.observaciones, cf.nombre as nombreFis, ads.nombre as nombreAdsc, CASE WHEN m.estatus = 'VI' THEN 'Activo' ELSE 'Inactivo' END as estatus 
		FROM pueDisposi.mando m 
  INNER JOIN pueDisposi.cargo pdc ON pdc.idCargo = m.idCargo 
  INNER JOIN pueDisposi.funcion f ON f.idFuncion = m.idFuncion
  LEFT JOIN estadoFuerza.catFiscalias cf ON cf.idFiscalia = m.idFiscalia
  LEFT JOIN estadoFuerza.catAreaAdscripcion ads ON ads.idAreaAdscripcion = m.idAreaAdscripcion
  INNER JOIN pueDisposi.areaAdscripcion ad ON ad.idAreaAdscripcion = m.idAreaAdscripcion WHERE m.idMando = $idMando ";
	}elseif ($areaAdsc == 'todos'){
		$query = " SELECT m.idMando, m.nombre+' '+m.paterno+' '+m.materno as nombreMando, m.nombre, m.paterno, m.materno, pdc.nombre as cargo, f.nombre as funcion, ad.nombre as areaAdscripcion, m.idCargo, m.idFuncion, m.idAreaAdscripcion,  m.sexo, m.idFiscalia, m.idSeccion, 
		    m.comisionado, m.fechaAlta, m.fechaActualAdscripcion, m.observaciones, cf.nombre as nombreFis, ads.nombre as nombreAdsc, CASE WHEN m.estatus = 'VI' THEN 'Activo' ELSE 'Inactivo' END as estatus 
		FROM pueDisposi.mando m 
  INNER JOIN pueDisposi.cargo pdc ON pdc.idCargo = m.idCargo 
  INNER JOIN pueDisposi.funcion f ON f.idFuncion = m.idFuncion
  LEFT JOIN estadoFuerza.catFiscalias cf ON cf.idFiscalia = m.idFiscalia
  LEFT JOIN estadoFuerza.catAreaAdscripcion ads ON ads.idAreaAdscripcion = m.idAreaAdscripcion
  INNER JOIN pueDisposi.areaAdscripcion ad ON ad.idAreaAdscripcion = m.idAreaAdscripcion
  ORDER BY m.idAreaAdscripcion ASC";
	}else{
			$query = " SELECT m.idMando, m.nombre+' '+m.paterno+' '+m.materno as nombreMando, m.nombre, m.paterno, m.materno, pdc.nombre as cargo, f.nombre as funcion, ad.nombre as areaAdscripcion, m.idCargo, m.idFuncion, m.idAreaAdscripcion,  m.sexo, m.idFiscalia, m.idSeccion, 
		        m.comisionado, m.fechaAlta, m.fechaActualAdscripcion, m.observaciones, cf.nombre as nombreFis, ads.nombre as nombreAdsc, CASE WHEN m.estatus = 'VI' THEN 'Activo' ELSE 'Inactivo' END as estatus
		FROM pueDisposi.mando m 
  INNER JOIN pueDisposi.cargo pdc ON pdc.idCargo = m.idCargo 
  INNER JOIN pueDisposi.funcion f ON f.idFuncion = m.idFuncion
  LEFT JOIN estadoFuerza.catFiscalias cf ON cf.idFiscalia = m.idFiscalia
  LEFT JOIN estadoFuerza.catAreaAdscripcion ads ON ads.idAreaAdscripcion = m.idAreaAdscripcion
  INNER JOIN pueDisposi.areaAdscripcion ad ON ad.idAreaAdscripcion = m.idAreaAdscripcion WHERE m.idAreaAdscripcion = $areaAdsc"; 
	}
	
  $indice = 0;
  $stmt = sqlsrv_query($conn, $query);
		while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC )){
			$arreglo[$indice][0]=$row['idMando'];
			$arreglo[$indice][1]=$row['nombreMando'];
			$arreglo[$indice][2]=$row['nombre'];
			$arreglo[$indice][3]=$row['paterno'];
			$arreglo[$indice][4]=$row['materno'];
			$arreglo[$indice][5]=$row['cargo'];
			$arreglo[$indice][6]=$row['funcion'];
			$arreglo[$indice][7]=$row['areaAdscripcion'];
			$arreglo[$indice][8]=$row['idCargo'];
			$arreglo[$indice][9]=$row['idFuncion'];
			$arreglo[$indice][10]=$row['idAreaAdscripcion'];
			$arreglo[$indice][11]=$row['estatus'];
			$arreglo[$indice][12]=$row['sexo'];
			$arreglo[$indice][13]=$row['idFiscalia'];
			$arreglo[$indice][14]=$row['idSeccion'];
			$arreglo[$indice][15]=$row['comisionado'];
			$arreglo[$indice][16]=$row['fechaAlta'];
			$arreglo[$indice][17]=$row['nombreFis'];
			$arreglo[$indice][18]=$row['nombreAdsc'];
			$arreglo[$indice][19]=$row['fechaActualAdscripcion'];
			$arreglo[$indice][20]=$row['observaciones'];
			$indice++;
		}
		if(isset($arreglo)){return $arreglo;}	

}

/*Consulta que obtiene las fiscalias*/
function getFiscalias($conn){
	$query = "SELECT * FROM estadoFuerza.catFiscalias";
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC )){
		$arreglo[$indice][0]=$row['idFiscalia'];
		$arreglo[$indice][1]=$row['nombre'];
		$arreglo[$indice][2]=$row['estatus'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	
}


/*Consulta que obtiene las adscripciones para el input de filtrado*/
function getareaAdscripcion($conn){
	$query = "SELECT * FROM pueDisposi.areaAdscripcion";
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC )){
		$arreglo[$indice][0]=$row['idAreaAdscripcion'];
		$arreglo[$indice][1]=$row['nombre'];
		$arreglo[$indice][2]=$row['estatus'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	
}

/*Consulta que obtiene el nombre de los mandos para el input de filtrado*/
function getDataMandos($conn){
	 $query = " SELECT m.idMando, m.nombre, m.paterno, m.materno, pdc.nombre as cargo, f.nombre as funcion, ad.nombre as areaAdscripcion FROM pueDisposi.mando m 
  INNER JOIN pueDisposi.cargo pdc ON pdc.idCargo = m.idCargo 
  INNER JOIN pueDisposi.funcion f ON f.idFuncion = m.idFuncion
  INNER JOIN pueDisposi.areaAdscripcion ad ON ad.idAreaAdscripcion = m.idAreaAdscripcion ";

  $indice = 0;
  $stmt = sqlsrv_query($conn, $query);
  while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	{
  	$arreglo[$indice][0]=$row['nombre'];
			$arreglo[$indice][1]=$row['paterno'];
			$arreglo[$indice][2]=$row['materno'];
			$arreglo[$indice][3]=$row['cargo'];
			$arreglo[$indice][4]=$row['funcion'];
			$arreglo[$indice][5]=$row['areaAdscripcion'];
			$arreglo[$indice][6]=$row['idMando'];
			$indice++;
		}
		if(isset($arreglo)){return $arreglo;}	
	}

/*Consulta que obtiene el cargo de los mandos*/
	function getCargo($conn){
	$query = "SELECT * FROM pueDisposi.cargo";
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC )){
		$arreglo[$indice][0]=$row['idCargo'];
		$arreglo[$indice][1]=$row['nombre'];
		$arreglo[$indice][2]=$row['estatus'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	
}

/*Consulta que obtiene la funcion de los mandos*/
function getFuncion($conn){
	$query = "SELECT * FROM pueDisposi.funcion";
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC )){
		$arreglo[$indice][0]=$row['idFuncion'];
		$arreglo[$indice][1]=$row['nombre'];
		$arreglo[$indice][2]=$row['estatus'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	
}

/*Consulta que obtiene la area de adscripcion asociadas a la fiscalia en base a el idFiscalia para el select*/
function areaAdscripcion($conn, $idFiscalia){
	$query = "SELECT fis.idFiscalia
	                ,fis.nombre AS 'nombreFiscalia'
	                ,ads.idAreaAdscripcion 
	                ,ads.nombre AS 'nombreAdscripcion'
									  FROM ESTADISTICAV2.estadoFuerza.fiscaliaAdscripcion fa
									  INNER JOIN estadoFuerza.catFiscalias fis ON fis.idFiscalia = fa.idFiscalia
									  LEFT JOIN estadoFuerza.catAreaAdscripcion ads ON ads.idAreaAdscripcion = fa.idAreaAdscripcion
									  WHERE fa.idFiscalia = $idFiscalia ";
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC )){
		$arreglo[$indice][0]=$row['idFiscalia'];
		$arreglo[$indice][1]=$row['nombreFiscalia'];
		$arreglo[$indice][2]=$row['idAreaAdscripcion'];
		$arreglo[$indice][3]=$row['nombreAdscripcion'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	
}

/*Consulta que obtiene el nombre de la foto guardada en el servidor, carpeta fotografias, relacionada con el mando*/
function getDataFoto($conn, $idMando){
	$query = "SELECT * FROM estadoFuerza.fotografias WHERE idMando = $idMando";
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC )){
		$arreglo[$indice][0]=$row['idFoto'];
		$arreglo[$indice][1]=$row['foto'];
		$indice++;
	}
	if(isset($arreglo)){
		return $arreglo;
	} else{
		//Si el usuario sube un registro sin fotografia hay que mandar el arreglo con la imagen por default.
		$arreglo[0][0]= 0;
		$arreglo[0][1]= 'upload_img.png';
		return $arreglo;
	}
}

//Consulta que obtiene los datos del domicilio del mando, si recibe $idDomicilio != 0 indica que se solicita una edicion de datos en ese id  
function getDataDireccion($conn, $idMando, $idDomicilio){
	if($idDomicilio == 0){
		$query = "SELECT * FROM estadoFuerza.Domicilio WHERE idMando = $idMando ORDER BY idDomicilio DESC";
	}else{
			$query = "SELECT * FROM estadoFuerza.Domicilio WHERE idDomicilio = $idDomicilio"; //Para consultar ese item en especifico
	}
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC )){
		$arreglo[$indice][0]=$row['idDomicilio'];
		$arreglo[$indice][2]=$row['domicilio'];
		$arreglo[$indice][3]=$row['lugarOrigen'];
		$arreglo[$indice][4]=$row['ciudad'];
		$arreglo[$indice][5]=$row['estadoProvincia'];
		$arreglo[$indice][6]=$row['codigoPostal'];
		$arreglo[$indice][7]=$row['telefono'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	
}

//Consulta que obtiene los datos del vehiculo del mando, si recibe $idVehiculo != 0 indica que se solicita una edicion de datos en ese id  
function getDataVehiculos($conn, $idMando, $idVehiculo){
	if($idVehiculo == 0){
		$query = "SELECT * FROM estadoFuerza.vehiculos WHERE idMando = $idMando ORDER BY idVehiculo DESC "; //Para consultar todos los items de ese mando
	}else{
		$query = "SELECT * FROM estadoFuerza.vehiculos WHERE idVehiculo = $idVehiculo"; //Para consultar ese item en especifico
	}
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC )){
		$arreglo[$indice][0]=$row['idVehiculo'];
		$arreglo[$indice][2]=$row['marca'];
		$arreglo[$indice][3]=$row['modelo'];
		$arreglo[$indice][4]=$row['placas'];
		$arreglo[$indice][5]=$row['vehiculoActual'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	
}

//Consulta que obtiene los datos de las armas del mando, si recibe $idArma != 0 indica que se solicita una edicion de datos en ese id  
function getDataArmas($conn, $idMando, $idArma){
	if($idArma == 0){
		$query = "SELECT *,CASE
																		    WHEN [catArma] = 1 THEN 'Arma Larga'
																		    WHEN [catArma] = 2 THEN 'Arma Corta'
																					ELSE 'Desconocido' 
	   																END as categoria
	   								FROM estadoFuerza.armas WHERE idMando = $idMando ORDER BY idArma DESC "; //Para consultar todos los items de ese mando
	}else{
		$query = "SELECT *,CASE
																			   WHEN [catArma] = 1 THEN 'Arma Larga'
																			   WHEN [catArma] = 2 THEN 'Arma Corta'
																					ELSE 'Desconocido' 
	   																END as categoria 
	   								FROM estadoFuerza.armas WHERE idArma = $idArma"; //Para consultar ese item en especifico
	}
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC )){
		$arreglo[$indice][0]=$row['idArma'];
		$arreglo[$indice][2]=$row['catArma'];
		$arreglo[$indice][3]=$row['marca'];
		$arreglo[$indice][4]=$row['modelo'];
		$arreglo[$indice][5]=$row['matricula'];
		$arreglo[$indice][6]=$row['calibre'];
		$arreglo[$indice][7]=$row['folio'];
		$arreglo[$indice][8]=$row['categoria'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	
}

//Consulta que obtiene los datos del vehiculo del mando, si recibe $idContEmerg != 0 indica que se solicita una edicion de datos en ese id  
function getDataContEmerg($conn, $idMando, $idContEmerg){
	if($idContEmerg == 0){
		$query = "SELECT * FROM estadoFuerza.contactosEmergencia WHERE idMando = $idMando ORDER BY idContEmerg DESC "; //Para consultar todos los items de ese mando
	}else{
		$query = "SELECT * FROM estadoFuerza.contactosEmergencia WHERE idContEmerg = $idContEmerg"; //Para consultar ese item en especifico
	}
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC )){
		$arreglo[$indice][0]=$row['idContEmerg'];
		$arreglo[$indice][2]=$row['nombre'];
		$arreglo[$indice][3]=$row['parentesco'];
		$arreglo[$indice][4]=$row['telefono'];
		$arreglo[$indice][5]=$row['direccion'];
		$arreglo[$indice][6]=$row['ciudad'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	
}

//Consulta que obtiene los datos de los folios del mando, si recibe $idVehiculo != 0 indica que se solicita una edicion de datos en ese id  
function getDataFolios($conn, $idMando, $idFolio){
	if($idFolio == 0){
		$query = "SELECT * FROM estadoFuerza.folios WHERE idMando = $idMando ORDER BY idFolio DESC "; //Para consultar todos los items de ese mando
	}else{
		$query = "SELECT * FROM estadoFuerza.folios WHERE idFolio = $idFolio"; //Para consultar ese item en especifico
	}
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC )){
		$arreglo[$indice][0]=$row['idFolio'];
		$arreglo[$indice][2]=$row['seguroSocial'];
		$arreglo[$indice][3]=$row['curp'];
		$arreglo[$indice][4]=$row['cuip'];
		$arreglo[$indice][5]=$row['folioCredencial'];
		$arreglo[$indice][6]=$row['cup'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	
}

//Consulta que obtiene los datos de las incapacidades de los mandos, si recibe $idIncapacidad != 0 indica que se solicita una edicion de datos en ese id  
function getDataIncapacidad($conn, $idMando, $idIncapacidad){
	if($idIncapacidad == 0){
		$query = "SELECT * FROM estadoFuerza.incapacidades WHERE idMando = $idMando ORDER BY idIncapacidad DESC "; //Para consultar todos los items de ese mando
	}else{
		$query = "SELECT * FROM estadoFuerza.incapacidades WHERE idIncapacidad = $idIncapacidad"; //Para consultar ese item en especifico
	}
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC )){
		$arreglo[$indice][0]=$row['idIncapacidad'];
		$arreglo[$indice][2]=$row['fechaInicio']->format('Y-m-d');
		$arreglo[$indice][3]=$row['fechaFin']->format('Y-m-d');
		$arreglo[$indice][4]=$row['motivo'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	
}

//Funcion que valida si el mando tiene ya registrada una dirección para evitar que muestre el boton de DIRECCION y agrege un segundo registro
function dataValidaDir($conn, $idMando){
	$query = "SELECT * FROM estadoFuerza.domicilio WHERE idMando = $idMando";
	$indice = 0;
	$val = 0;
	$stmt = sqlsrv_query($conn, $query,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
 $row_count = sqlsrv_num_rows( $stmt );
 if($row_count > 0){
 	$val = 1;
 }else{
 	$val = 2;
 }
	return $val;	
}

//Funcion que valida si el mando tiene ya registrada un contacto de emergencia para evitar que muestre el boton de CONTACTO DE EMERGENCIA y agrege un segundo registro
function dataValidaCtoEmer($conn, $idMando){
	$query = "SELECT * FROM estadoFuerza.contactosEmergencia WHERE idMando = $idMando";
	$indice = 0;
	$val = 0;
	$stmt = sqlsrv_query($conn, $query,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
 $row_count = sqlsrv_num_rows( $stmt );
 if($row_count > 0){
 	$val = 1;
 }else{
 	$val = 2;
 }
	return $val;	
}

//Funcion que valida si el mando tiene ya registrado folios para evitar que muestre el boton de FOLIOS y agrege un segundo registro
function dataValidaFolio($conn, $idMando){
	$query = "SELECT * FROM estadoFuerza.folios WHERE idMando = $idMando";
	$indice = 0;
	$val = 0;
	$stmt = sqlsrv_query($conn, $query,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
 $row_count = sqlsrv_num_rows( $stmt );
 if($row_count > 0){
 	$val = 1;
 }else{
 	$val = 2;
 }
	return $val;	
}

function getDataFotoTrue($conn, $idMando){
	$query = "SELECT * FROM estadoFuerza.fotografias WHERE idMando = $idMando";
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC )){
		$arreglo[$indice][0]=$row['idFoto'];
		$arreglo[$indice][1]=$row['foto'];
		$indice++;
	}
	if(isset($arreglo)){	
		return $arreglo;
	}else{
		return false;
	}
}

//Consulta que obtiene el historial de adscripciones de los mandos, si recibe $idIncapacidad != 0 indica que se solicita una edicion de datos en ese id  
function getDataHistorialAdscripcion($conn, $idMando){
	$query = "SELECT ads.idAdscripcion
											      ,ads.idMando
											      ,ads.idFiscalia
												     ,cf.nombre AS nombreFiscalia
											      ,ads.idSeccion
												     ,ca.nombre AS nombreSeccion
											      ,ads.idAreaAdscripcion
												     ,ca.nombre AS nombreAdscripcion
											      ,ads.fechaAdscripcion
											  FROM ESTADISTICAV2.estadoFuerza.historialAdscripcion ads
											  INNER JOIN estadoFuerza.catFiscalias cf ON cf.idFiscalia = ads.idFiscalia 
											  INNER JOIN estadoFuerza.catAreaAdscripcion ca ON ca.idAreaAdscripcion = ads.idAreaAdscripcion 
											  WHERE ads.idMando = $idMando ORDER BY ads.idAdscripcion DESC";  
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC )){
		$arreglo[$indice][0]=$row['idAdscripcion'];
		$arreglo[$indice][2]=$row['nombreFiscalia'];
		$arreglo[$indice][3]=$row['idSeccion'];
		$arreglo[$indice][4]=$row['nombreSeccion'];
		$arreglo[$indice][5]=$row['idAreaAdscripcion'];
		$arreglo[$indice][6]=$row['nombreAdscripcion'];
		$arreglo[$indice][7]=$row['fechaAdscripcion']->format('Y-m-d');
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	
}

//***********FUNCIONES PARA REPORTE EN WORD**************

//Funcion que obtiene la fecha actual
function getFechaActual(){
	$dia = date("d");
	$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	$mes = $meses[date('n')-1];
	$anio = date("Y");
	$arreglo[0][0] = $dia;
	$arreglo[0][1] = $mes;
	$arreglo[0][2] = $anio;
	if(isset($arreglo)){return $arreglo;}	
}

/*Consulta que obtiene el cargo del mando para sacar reporte en word*/
	function getNombreCargo($conn, $idCargo){
	$query = "SELECT * FROM pueDisposi.cargo WHERE idCargo = $idCargo";
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC )){
		$arreglo[$indice][0]=$row['idCargo'];
		$arreglo[$indice][1]=$row['nombre'];
		$arreglo[$indice][2]=$row['estatus'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	
}

/*Consulta que obtiene la penultima adscripción para sacar reporte en word*/
	function getPenultimaAds($conn, $idMando){
	$query = "SELECT TOP 1 ha.idAdscripcion
																	      ,ha.idMando
																	      ,ha.idFiscalia
																		     ,f.nombre AS nombreFiscalia
																	      ,ha.idSeccion
																	      ,ha.idAreaAdscripcion
																		     ,ads.nombre AS nombreAdscripcion
																	      ,ha.fechaAdscripcion
											FROM (SELECT TOP 2 * FROM ESTADISTICAV2.estadoFuerza.historialAdscripcion 
													WHERE idMando = $idMando 
											ORDER BY idAdscripcion DESC) ha
													INNER JOIN estadoFuerza.catFiscalias f ON F.idFiscalia = ha.idFiscalia
													INNER JOIN estadoFuerza.catAreaAdscripcion ads ON ads.idAreaAdscripcion = ha.idAreaAdscripcion
											ORDER BY ha.idAdscripcion ASC";
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC )){
		$arreglo[$indice][0]=$row['idAdscripcion'];
		$arreglo[$indice][1]=$row['idMando'];
		$arreglo[$indice][2]=$row['idFiscalia'];
		$arreglo[$indice][3]=$row['nombreFiscalia'];
		$arreglo[$indice][4]=$row['idSeccion'];
		$arreglo[$indice][5]=$row['idAreaAdscripcion'];
		$arreglo[$indice][6]=$row['nombreAdscripcion'];
		$arreglo[$indice][7]=$row['fechaAdscripcion'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	
}

/*Consulta que obtiene la adscripcion actual para sacar reporte en word*/
	function getActualAdscripcion($conn, $idMando){
	$query = "SELECT m.idMando
												     ,ads.nombre AS nombreAdscripcionActual
												     ,f.nombre AS nombreFiscaliaActual
											FROM ESTADISTICAV2.pueDisposi.mando m
											INNER JOIN estadoFuerza.catAreaAdscripcion ads ON ads.idAreaAdscripcion = m.idAreaAdscripcion
											INNER JOIN estadoFuerza.catFiscalias f ON f.idFiscalia = m.idFiscalia
											WHERE m.idMando = $idMando";
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC )){
		$arreglo[$indice][0]=$row['idMando'];
		$arreglo[$indice][1]=$row['nombreAdscripcionActual'];
		$arreglo[$indice][2]=$row['nombreFiscaliaActual'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	
}

function getPrefijo0($getPenultimaAds){
	if($getPenultimaAds == 1 || $getPenultimaAds == 2 || $getPenultimaAds == 3 || $getPenultimaAds == 4 || $getPenultimaAds == 7
				|| $getPenultimaAds == 8 || $getPenultimaAds == 9 || $getPenultimaAds == 10 || $getPenultimaAds == 11 || $getPenultimaAds == 12 
				|| $getPenultimaAds == 13 || $getPenultimaAds == 14 || $getPenultimaAds == 15 || $getPenultimaAds == 19){
		return $Prefijo0 = "de la";
	}
	else if($getPenultimaAds == 5 || $getPenultimaAds == 6 || $getPenultimaAds == 16 || $getPenultimaAds == 17 || $getPenultimaAds == 18){
		return $prefijo0 = "del";
	}
}

function getPrefijo1($getPenultimaFiscalia){
		if($getPenultimaFiscalia == 1 || $getPenultimaFiscalia == 2 || $getPenultimaFiscalia == 3 || $getPenultimaFiscalia == 4 || $getPenultimaFiscalia == 5 || $getPenultimaFiscalia == 6 || $getPenultimaFiscalia == 7	|| $getPenultimaFiscalia == 8 ||
		 $getPenultimaFiscalia == 9 || $getPenultimaFiscalia == 10 || $getPenultimaFiscalia == 11 || $getPenultimaFiscalia == 12 
				|| $getPenultimaFiscalia == 13 || $getPenultimaFiscalia == 14 || $getPenultimaFiscalia == 15 || $getPenultimaFiscalia == 16 || $getPenultimaFiscalia == 17 || $getPenultimaFiscalia == 18 || $getPenultimaFiscalia == 19 || $getPenultimaFiscalia == 20 || $getPenultimaFiscalia == 21 || $getPenultimaFiscalia == 22 || $getPenultimaFiscalia == 23){
		return $prefijo1 = "de la";
	}
	else if($getPenultimaFiscalia == 24 || $getPenultimaFiscalia == 25){
		return $prefijo1 = "del";
	}
}

function getPrefijo3($getActualFiscalia){
		if($getActualFiscalia == 1 || $getActualFiscalia == 2 || $getActualFiscalia == 3 || $getActualFiscalia == 4 || $getActualFiscalia == 5 || $getActualFiscalia == 6 || $getActualFiscalia == 7	|| $getActualFiscalia == 8 || $getActualFiscalia == 9 || $getActualFiscalia == 10 || $getActualFiscalia == 11 || $getActualFiscalia == 12 	|| $getActualFiscalia == 13 || $getActualFiscalia == 14 || $getActualFiscalia == 15 || $getActualFiscalia == 16 || $getActualFiscalia == 17 || $getActualFiscalia == 18 || $getActualFiscalia == 19 || $getActualFiscalia == 20 || $getActualFiscalia == 21 || $getActualFiscalia == 22 || $getActualFiscalia == 23){
		return $prefijo3 = "DE LA";
	}
	else if($getActualFiscalia == 24 || $getActualFiscalia == 25){
		return $prefijo3 = "AL";
	}
}

//***********TERMINA FUNCIONES PARA REPORTE EN WORD**************

/*Consulta que obtiene la informacion para la ficha1 de informacion del compañero*/
	function getDataFicha1($conn, $idMando){
	$query = "SELECT m.idMando
											      ,m.nombre+' '+m.paterno+' '+m.materno AS nombreMando
											      ,c.nombre as cargo
											      ,fun.nombre AS funcion
											      ,ads.nombre as adscripcion
											      ,m.estatus
											      ,CASE 
																    WHEN m.sexo = 1 THEN 'Masculino'
																	   WHEN m.sexo = 2 THEN 'Femenino'
																   ELSE 'No identificado'
												      END as sexo
											      ,F.nombre as fiscalia
											      ,m.fechaAlta
															  ,d.telefono
															  ,d.estadoProvincia as lugarOrigen
														  FROM ESTADISTICAV2.pueDisposi.mando m
														  INNER JOIN pueDisposi.cargo c ON c.idCargo = m.idCargo
														  INNER JOIN pueDisposi.funcion fun ON fun.idFuncion = m.idFuncion
														  LEFT JOIN estadoFuerza.catAreaAdscripcion ads ON ads.idAreaAdscripcion = m.idAreaAdscripcion
														  LEFT JOIN estadoFuerza.catFiscalias f ON f.idFiscalia = m.idFiscalia
														  LEFT JOIN estadoFuerza.domicilio d ON d.idMando = m.idMando
																WHERE m.idMando = $idMando";
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC )){
		$arreglo[$indice][0]=$row['idMando'];
		$arreglo[$indice][1]=$row['nombreMando'];
		$arreglo[$indice][2]=$row['cargo'];
		$arreglo[$indice][3]=$row['funcion'];
		$arreglo[$indice][4]=$row['adscripcion'];
		$arreglo[$indice][5]=$row['estatus'];
		$arreglo[$indice][6]=$row['sexo'];
		$arreglo[$indice][7]=$row['fiscalia'];
		$arreglo[$indice][8]=$row['fechaAlta'];
		$arreglo[$indice][9]=$row['telefono'];
		$arreglo[$indice][10]=$row['lugarOrigen'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	
}

?>
