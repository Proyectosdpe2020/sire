<?php

function getEstatusNombre($conn, $idEstatus){

		$query = "  SELECT nombre From estatusResoluciones WHERE idEstatusResoluciones = $idEstatus";
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['nombre'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

function getExisteNuc($conn, $nuc){

$query = "SELECT nuc FROM resolucionMP WHERE nuc = $nuc";

	$stmt = sqlsrv_query(  $conn, $query,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
	$row_count = sqlsrv_num_rows( $stmt );


	if($row_count > 0){
		return true;
	}
	else{return false;}
}

function getResolucionesMPtotal($conn, $idMp, $estatResolucion, $mes, $anio, $deten){

$query23 = "SELECT  idResolucionMp, idMp, idEstatusResolucion, mes, anio, nuc, expediente FROM resolucionMP WHERE idMp = $idMp AND idEstatusResolucion = $estatResolucion AND mes = $mes AND anio = $anio AND deten = $deten ORDER BY idResolucionMp DESC";

 		$stmt = sqlsrv_query($conn, $query23,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
		$row_count = sqlsrv_num_rows( $stmt );
		
		if($row_count > 0){
		return $row_count;
	}
	else{return 0;}

}




function getResolucionesMP($conn, $idMp, $estatResolucion, $mes, $anio, $deten){

$query = "SELECT  idResolucionMp, idMp, idEstatusResolucion, mes, anio, nuc, expediente FROM resolucionMP WHERE idMp = $idMp AND idEstatusResolucion = $estatResolucion AND mes = $mes AND anio = $anio AND deten = $deten ORDER BY idResolucionMp DESC";

 //"<br><br>".$query;

		$indice = 0;

		$stmt = sqlsrv_query($conn, $query);
		while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
		{

			$arreglo[$indice][0]=$row['idResolucionMp'];
			$arreglo[$indice][1]=$row['idMp'];
			$arreglo[$indice][2]=$row['idEstatusResolucion'];
			$arreglo[$indice][3]=$row['mes'];
			$arreglo[$indice][4]=$row['anio'];
			$arreglo[$indice][5]=$row['nuc'];
			$arreglo[$indice][6]=$row['expediente'];
			$indice++;
		}
		if(isset($arreglo)){return $arreglo;}

}


function getUnidadEnlace($conn, $idEnlace){

		$query = "SELECT idUnidad From enlace WHERE idEnlace = $idEnlace";
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idUnidad'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

function getInfoEnlacesCarpetas($conn, $formato){

		$query = "SELECT   idEnlace,nombre, apellidoPaterno, apellidoMarterno, correo, estatus, telefono, idFormato, e.idUnidad, cu.nUnidad, cf.nFiscalia2, e.idFiscalia

FROM   enlace e INNER JOIN CatUnidad cu ON cu.idUnidad = e.idUnidad 
INNER JOIN CatFiscalia cf ON cf.idFiscalia = e.idFiscalia
AND e.idFormato = $formato ORDER BY nFiscalia2 ASC";

		$indice = 0;

		$stmt = sqlsrv_query($conn, $query);
		while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
		{

			$arreglo[$indice][0]=$row['idEnlace'];
			$arreglo[$indice][1]=$row['nombre'];
			$arreglo[$indice][2]=$row['apellidoPaterno'];
			$arreglo[$indice][3]=$row['apellidoMarterno'];
			$arreglo[$indice][4]=$row['correo'];
			$arreglo[$indice][5]=$row['estatus'];
			$arreglo[$indice][6]=$row['telefono'];
			$arreglo[$indice][7]=$row['idFormato'];
			$arreglo[$indice][8]=$row['idUnidad'];
			$arreglo[$indice][9]=$row['nUnidad'];
			$arreglo[$indice][10]=$row['nFiscalia2'];
			$arreglo[$indice][11]=$row['idFiscalia'];
			$indice++;
		}
		if(isset($arreglo)){return $arreglo;}

}

function getArchivosXAnio($conn, $anio){

		$query = "SELECT idArchivo, archivo.idEnlace, e.nombre+' '+e.apellidoPaterno+' '+apellidoMarterno as 'NombreEnlace', cu.nUnidad , nombreArchivo, observacionesUser, tamanio, fechaSubida, ubicacion, mes, anio, estatusArch, observacionesRevision, fechaConcluido 

FROM archivo INNER JOIN enlace e ON e.idEnlace = archivo.idEnlace INNER JOIN CatUnidad cu ON cu.idUnidad = e.idUnidad

WHERE anio = $anio";

		$indice = 0;

		$stmt = sqlsrv_query($conn, $query);
		while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
		{

			$arreglo[$indice][0]=$row['idArchivo'];
			$arreglo[$indice][1]=$row['idEnlace'];
			$arreglo[$indice][2]=$row['nombreArchivo'];
			$arreglo[$indice][3]=$row['observacionesUser'];
			$arreglo[$indice][4]=$row['tamanio'];
			$arreglo[$indice][5]=$row['fechaSubida'];
			$arreglo[$indice][6]=$row['ubicacion'];
			$arreglo[$indice][7]=$row['mes'];
			$arreglo[$indice][8]=$row['anio'];
			$arreglo[$indice][9]=$row['estatusArch'];
			$arreglo[$indice][10]=$row['observacionesRevision'];
			$arreglo[$indice][11]=$row['fechaConcluido'];
			$arreglo[$indice][12]=$row['NombreEnlace'];
			$arreglo[$indice][13]=$row['nUnidad'];

			$indice++;
		}
		if(isset($arreglo)){return $arreglo;}

}

function getArchivosXenlaceAnio($conn, $anio, $enlace){

		$query = "SELECT idArchivo, idEnlace, nombreArchivo, observacionesUser, tamanio, fechaSubida, ubicacion, mes, anio, estatusArch, observacionesRevision, fechaConcluido FROM archivo WHERE idEnlace = $enlace AND anio = $anio";

		$indice = 0;

		$stmt = sqlsrv_query($conn, $query);
		while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
		{

			$arreglo[$indice][0]=$row['idArchivo'];
			$arreglo[$indice][1]=$row['idEnlace'];
			$arreglo[$indice][2]=$row['nombreArchivo'];
			$arreglo[$indice][3]=$row['observacionesUser'];
			$arreglo[$indice][4]=$row['tamanio'];
			$arreglo[$indice][5]=$row['fechaSubida'];
			$arreglo[$indice][6]=$row['ubicacion'];
			$arreglo[$indice][7]=$row['mes'];
			$arreglo[$indice][8]=$row['anio'];
			$arreglo[$indice][9]=$row['estatusArch'];
			$arreglo[$indice][10]=$row['observacionesRevision'];
			$arreglo[$indice][11]=$row['fechaConcluido'];

			$indice++;
		}
		if(isset($arreglo)){return $arreglo;}

}

function getInfoCarpeta($conn, $mes, $anio, $idUnidad, $idMp){

	$query = "SELECT * FROM Carpetas2 WHERE idMes = $mes AND idAnio = $anio AND idUnidad = $idUnidad AND idMp = $idMp";

	$indice = 0;

	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{

		$arreglo[$indice][0]=$row['existenciaAnterior'];
		$arreglo[$indice][1]=$row['iniciadasConDetenido'];
		$arreglo[$indice][2]=$row['iniciadasSinDetenido'];
		$arreglo[$indice][3]=$row['totalIniciadas'];
		$arreglo[$indice][4]=$row['recibidasPorOtraUnidad'];
		$arreglo[$indice][5]=$row['totalTrabajar'];
  $arreglo[$indice][6]=$row['judicializadasConDetenido'];
		$arreglo[$indice][7]=$row['judicializadasSinDetenido'];
		$arreglo[$indice][8]=$row['totalJudicializadas'];
		$arreglo[$indice][9]=$row['abstencionInvestigacion'];
		$arreglo[$indice][10]=$row['archivoTemporal'];
		$arreglo[$indice][11]=$row['noEjercicioAccionPenal'];
		$arreglo[$indice][12]=$row['mediacion'];
		$arreglo[$indice][13]=$row['conciliacion'];
		$arreglo[$indice][14]=$row['criteriosOportunidad'];
		$arreglo[$indice][15]=$row['suspensionCondicional'];
		$arreglo[$indice][16]=$row['incompetencia'];
		$arreglo[$indice][17]=$row['acumulacion'];
		$arreglo[$indice][18]=$row['totalResoluciones'];
		$arreglo[$indice][19]=$row['enviadasUATP'];
		$arreglo[$indice][20]=$row['enviadasUI'];
		$arreglo[$indice][21]=$row['tramite'];

		$arreglo[$indice][22]=$row['idCarpetas'];

		$arreglo[$indice][23]=$row['envCMASC'];
		$arreglo[$indice][24]=$row['enviImpDes'];



		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}

}

function validarCarpetaCapturada($conn, $anioCaptura, $mesCapturar, $idUnidad, $idMp){

	$query = "SELECT idCarpetas FROM Carpetas2 WHERE idMes = $mesCapturar AND idAnio = $anioCaptura AND idMp = $idMp AND idUnidad = $idUnidad";

	$stmt = sqlsrv_query(  $conn, $query,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
	$row_count = sqlsrv_num_rows( $stmt );


	if($row_count > 0){
		return 2;
	}
	else{return 1;}
}

function getEnviadoEnlace($conn, $idEnlace){
	$query = "SELECT enviado, enviadoArchivo FROM enlaceMesValidaEnviado WHERE idEnlace = $idEnlace";
$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['enviado'];
		$arreglo[$indice][1]=$row['enviadoArchivo'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

function getInfoEnlaceUsuario($conn, $idUsuario){
	$query = "  SELECT u.idEnlace, e.idFiscalia FROM usuario u INNER JOIN enlace e ON e.idEnlace = u.idEnlace WHERE u.idUsuario = $idUsuario ";
$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idEnlace'];
		$arreglo[$indice][1]=$row['idFiscalia'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

function getIdEnlaceUsuario($conn, $idUsuario){
	$query = "  SELECT idEnlace FROM usuario WHERE idUsuario = $idUsuario ";
$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idEnlace'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}


function getCapturadoMesAnioMP($conn, $mesCapturar, $anioCaptura, $idMp, $idUnidad){
	$query = "  SELECT idCarpetas FROM Carpetas2 WHERE idMes = $mesCapturar AND idAnio = $anioCaptura AND idMp = $idMp AND idUnidad = $idUnidad";
$stmt = sqlsrv_query(  $conn, $query,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
$row_count = sqlsrv_num_rows( $stmt );
	if($row_count > 0){	return 1; }else{return 0;}
}


function getExistenciaAnterior($conn, $mesAnterior, $aniocaptura, $idUnidad){

	$query = "SELECT tramite FROM Carpetas WHERE idMes = $mesAnterior AND idAnio = $aniocaptura AND idUnidad = $idUnidad";
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['tramite'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}


function getInfoUnidad($conn, $idunidad){

		$query = "SELECT idUnidad, nUnidad FROM CatUnidad WHERE idUnidad = $idunidad ";
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idUnidad'];
		$arreglo[$indice][1]=$row['nUnidad'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

function getUnidadesUsuario($conn, $idUsuario){

	$query = "SELECT idUnidad FROM usuarioUnidad WHERE idUsuario = $idUsuario ";
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idUnidad'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

function getMpsUnidad($conn, $idunidad){

	$query = "SELECT nombre, apellidoPaterno, apellidoMaterno, idUnidad, idMp FROM mp WHERE idUnidad = $idunidad AND estatus = 'VI' ";

	$indice = 0;

	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{

		$arreglo[$indice][0]=$row['nombre'];
		$arreglo[$indice][1]=$row['apellidoPaterno'];
		$arreglo[$indice][2]=$row['apellidoMaterno'];
		$arreglo[$indice][3]=$row['idUnidad'];
		$arreglo[$indice][4]=$row['idMp'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}

}

function getMpsEnlace($conn, $idEnlace){

	$query = "  SELECT mp.idMp, mp.nombre, mp.paterno, mp.materno, mp.idUnidad, cu.nUnidad

	FROM mp INNER JOIN enlaceMP emp ON emp.idMp = mp.idMp 
	        INNER JOIN CatUnidad cu ON cu.idUnidad = mp.idUnidad WHERE emp.idEnlace = $idEnlace AND mp.estatus = 'VI' ";


	$indice = 0;

	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{

		$arreglo[$indice][0]=$row['nombre'];
		$arreglo[$indice][1]=$row['paterno'];
		$arreglo[$indice][2]=$row['materno'];
		$arreglo[$indice][3]=$row['idUnidad'];
		$arreglo[$indice][4]=$row['idMp'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}

}

function getMpsEnlaceUnidad($conn, $idEnlace){

	$query = "SELECT mp.idMp, mp.nombre, mp.paterno, mp.materno, mpu.idUnidad, cu.nUnidad

FROM mp INNER JOIN mpUnidad mpu ON mpu.idMp = mp.idMp INNER JOIN CatUnidad cu ON cu.idUnidad = mpu.idUnidad WHERE mpu.idEnlace = $idEnlace AND mp.estatus = 'VI'";


	$indice = 0;

	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{

		$arreglo[$indice][0]=$row['nombre'];
		$arreglo[$indice][1]=$row['paterno'];
		$arreglo[$indice][2]=$row['materno'];
		$arreglo[$indice][3]=$row['idUnidad'];
		$arreglo[$indice][4]=$row['idMp'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}

}


//// Esta Funcion formatea el nuevo nombre para el archivo que se guardara en el servidor y base de datos quitando acentos y dejando el nombre en solo minusculas

function formatearNombre($cadena){ 
    $tofind = "ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ· "; 
    $replac = "AAAAAAaaaaaaOOOOOOooooooEEEEeeeeCcIIIIiiiiUUUUuuuuyNn-_"; 
    $cadena = utf8_decode($cadena);      
    $cadena = strtr($cadena, utf8_decode($tofind), $replac);  
    $cadena = strtolower($cadena);  
    return utf8_encode($cadena); 
     
}  


////// FUNCION PARA ENCONTRAR EL NIVEL DE SIMILITUD ENTRE DOS CADENAS RECIBIDAS ////////

function similares($str1, $str2) {
    $len1 = strlen($str1);
    $len2 = strlen($str2);
    
    $max = max($len1, $len2);
    
    $similarity = $i = $j = 0;
    
    while (($i < $len1) && isset($str2[$j])) {
        if ($str1[$i] == $str2[$j]) {
            $similarity++;
            $i++;
            $j++;
        } elseif ($len1 < $len2) {
            $len1++;
            $j++;
        } elseif ($len1 > $len2) {
            $i++;
            $len1--;
        } else {
            $i++;
            $j++;
        }
    }

    return round($similarity / $max, 2);
}



function Meses($mes,$año){

	$mes=(int)$mes;

	$dias=0;

	if($mes==1 || $mes ==3 || $mes==5 || $mes==7 || $mes==8 || $mes==10 ||$mes==12){
		$dias=31;

	}
	else if( $mes==4 || $mes==6 || $mes==9 || $mes==11){
		$dias=30;

	}
	else 	{
		if(esBisiesto($año)==1){
			$dias=29;
		}
		else{
			$dias=28;
		}
	}

	return $dias;
}


function Mes_Nombre($mes)
{
	$mes=(int)$mes;
	$mes_nom="";
	switch ($mes)
	{
		case 1:
		$mes_nom="Enero";
		break;
		case 2:
		$mes_nom="Febrero";
		break;
		case 3:
		$mes_nom="Marzo";
		break;
		case 4:
		$mes_nom="Abril";
		break;
		case 5:
		$mes_nom="Mayo";
		break;
		case 6:
		$mes_nom="Junio";
		break;
		case 7:
		$mes_nom="Julio";
		break;
		case 8:
		$mes_nom="Agosto";
		break;
		case 9:
		$mes_nom="Septiembre";
		break;
		case 10:
		$mes_nom="Octubre";
		break;
		case 11:
		$mes_nom="Noviembre";
		break;
		case 12:
		$mes_nom="Diciembre";
		break;
	}
	return $mes_nom;
}

function esBisiesto($year) {
	$year = ($year==0)? date('Y'):$year;
	return ( ($year%4 == 0 && $year%100 != 0) || $year%400 == 0 );
}


function getIPreal(){

	if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"),"unknown"))
	$ip = getenv("HTTP_CLIENT_IP");
	else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
	$ip = getenv("HTTP_X_FORWARDED_FOR");
	else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
	$ip = getenv("REMOTE_ADDR");
	else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
	$ip = $_SERVER['REMOTE_ADDR'];
	else
	$ip = "IP desconocida";
	return($ip);
}

function getDiaActual(){

	$diaActual = date("N");

	switch ($diaActual) {
		case '1':
		return "lunes";
		break;
		case '2':
		return "Martes";
		break;
		case '3':
		return "Miercoles";
		break;
		case '4':
		return "Jueves";
		break;
		case '5':
		return "Viernes";
		break;
		case '6':
		return "Sabado";
		break;
		case '7':
		return "Domingo";
		break;
	}
}


function getCOlorStatusArchivo($conn, $estado){

		$color = "";

		if($estado == "Enviado"){ $color = "rgba(160,202,216,0.8)"; }
		if($estado == "Revisando"){ $color = "rgba(	240, 173, 78,0.8)"; }
		if($estado == "Recibido"){ $color = "rgba(92, 184, 92,0.8)"; }
		if($estado == "Rechazado"){ $color = "rgba(240,89,91,0.8)"; }
		if($estado == "Reenviado"){ $color = "rgba(202,216,160,0.8)"; }

		return $color;	

}


?>
