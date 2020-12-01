<?
function getYears($conn){
	$query = "SELECT DISTINCT idAnio FROM ESTADISTICAV2.dbo.Forestales ORDER BY idAnio DESC";
	$indice = 0;

	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idAnio'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

function getHistoricoForestales($conn, $anio){
	$query = "SELECT [idForestales]
      ,[fecha]
      ,[idMes]
					 ,CASE 
						WHEN idMes = 1 THEN 'Enero'
						WHEN idMes = 2 THEN 'Febrero'
						WHEN idMes = 3 THEN 'Marzo'
						WHEN idMes = 4 THEN 'Abril'
						WHEN idMes = 5 THEN 'Mayo'
						WHEN idMes = 6 THEN 'Junio'
						WHEN idMes = 7 THEN 'Julio'
						WHEN idMes = 8 THEN 'Agosto'
						WHEN idMes = 9 THEN 'Septiembre'
						WHEN idMes = 10 THEN 'Octubre'
						WHEN idMes = 11 THEN 'Noviembre'
						WHEN idMes = 12 THEN 'Diciembre'
					  ELSE 'DESCONOCIDO'
					  END as nombreMes
				      ,[idAnio]
				      ,[madera]
				      ,[vehiculos]
				      ,[gruasForestales]
				      ,[motosierras]
				      ,[radios]
				      ,[herramientas]
				      ,[armasFuego]
				      ,[celulares]
				      ,[detenidos]
				      ,[peritajesUnidadForestales]
				      ,[peritajesUnidadesForaneas]
				      ,[averiguacionesoCarpetas]
				      ,[localizacionesCumplidas]
				      ,[investigacionesCumplidas]
				      ,[recorridosVigilancia]
				      ,[operativos]
				  FROM [ESTADISTICAV2].[dbo].[Forestales]
				  WHERE idAnio = $anio ORDER BY idMes ASC";
	$indice = 0;

	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idForestales'];
		$arreglo[$indice][1]=$row['fecha'];
		$arreglo[$indice][2]=$row['idMes'];
		$arreglo[$indice][3]=$row['nombreMes'];
		$arreglo[$indice][4]=$row['madera'];
		$arreglo[$indice][5]=$row['vehiculos'];
		$arreglo[$indice][6]=$row['gruasForestales'];
		$arreglo[$indice][7]=$row['motosierras'];
		$arreglo[$indice][8]=$row['radios'];
		$arreglo[$indice][9]=$row['herramientas'];
		$arreglo[$indice][10]=$row['armasFuego'];
		$arreglo[$indice][11]=$row['celulares'];
		$arreglo[$indice][12]=$row['detenidos'];
		$arreglo[$indice][13]=$row['peritajesUnidadForestales'];
		$arreglo[$indice][14]=$row['peritajesUnidadesForaneas'];
		$arreglo[$indice][15]=$row['averiguacionesoCarpetas'];
		$arreglo[$indice][16]=$row['localizacionesCumplidas'];
		$arreglo[$indice][17]=$row['investigacionesCumplidas'];
		$arreglo[$indice][18]=$row['recorridosVigilancia'];
		$arreglo[$indice][19]=$row['idAnio'];
		$arreglo[$indice][20]=$row['operativos'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

function getInformeMensualByID($conn, $idForestales){
	$query = "SELECT * 
						     ,CASE 
											WHEN idMes = 1 THEN 'Enero'
											WHEN idMes = 2 THEN 'Febrero'
											WHEN idMes = 3 THEN 'Marzo'
											WHEN idMes = 4 THEN 'Abril'
											WHEN idMes = 5 THEN 'Mayo'
											WHEN idMes = 6 THEN 'Junio'
											WHEN idMes = 7 THEN 'Julio'
											WHEN idMes = 8 THEN 'Agosto'
											WHEN idMes = 9 THEN 'Septiembre'
											WHEN idMes = 10 THEN 'Octubre'
											WHEN idMes = 11 THEN 'Noviembre'
											WHEN idMes = 12 THEN 'Diciembre'
										 ELSE 'DESCONOCIDO'
										 END as nombreMes FROM ESTADISTICAV2.dbo.Forestales WHERE idForestales = $idForestales ";
	$indice = 0;

	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idForestales'];
		$arreglo[$indice][1]=$row['fecha'];
		$arreglo[$indice][2]=$row['idMes'];
		$arreglo[$indice][3]=$row['nombreMes'];
		$arreglo[$indice][4]=$row['idAnio'];
		$arreglo[$indice][5]=$row['madera'];
		$arreglo[$indice][6]=$row['vehiculos'];
		$arreglo[$indice][7]=$row['gruasForestales'];
		$arreglo[$indice][8]=$row['motosierras'];
		$arreglo[$indice][9]=$row['radios'];
		$arreglo[$indice][10]=$row['herramientas'];
		$arreglo[$indice][11]=$row['armasFuego'];
		$arreglo[$indice][12]=$row['celulares'];
		$arreglo[$indice][13]=$row['detenidos'];
		$arreglo[$indice][14]=$row['peritajesUnidadForestales'];
		$arreglo[$indice][15]=$row['peritajesUnidadesForaneas'];
		$arreglo[$indice][16]=$row['averiguacionesoCarpetas'];
		$arreglo[$indice][17]=$row['localizacionesCumplidas'];
		$arreglo[$indice][18]=$row['investigacionesCumplidas'];
		$arreglo[$indice][19]=$row['recorridosVigilancia'];
		$arreglo[$indice][20]=$row['operativos'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

function getMesValidaEnviado($conn){
	$query = "SELECT * FROM ESTADISTICAV2.dbo.enlaceMesValidaEnviado WHERE idEnlaceMesValidaEnviados = 195 AND idFormato = 14";
	$indice = 0;

	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idAnio'];
		$arreglo[$indice][1]=$row['mesCap'];
		$arreglo[$indice][2]=$row['enviado'];
		$arreglo[$indice][3]=$row['enviadoArchivo'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

function getDataMesText($mesCapturando){
	switch ($mesCapturando){ 
		case 1 : $mesCapturandoText = "ENERO";   break;   case 5 : $mesCapturandoText = "MAYO";  break;  case 9 : $mesCapturandoText = "SEPTIEMBRE";  break;
		case 2 : $mesCapturandoText = "FEBRERO"; break;   case 6 : $mesCapturandoText = "JUNIO"; break;  case 10 : $mesCapturandoText = "OCTUBRE";    break;
		case 3 : $mesCapturandoText = "MARZO";   break;   case 7 : $mesCapturandoText = "JULIO"; break;  case 11 : $mesCapturandoText = "NOVIEMBRE";  break;
		case 4 : $mesCapturandoText = "ABRIL";   break;   case 8 : $mesCapturandoText = "AGOSTO";break;  case 12 : $mesCapturandoText = "DICIEMBRE";  break;
	}
	return $mesCapturandoText;
}

?>