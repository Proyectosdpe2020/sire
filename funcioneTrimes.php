<? 



function getDataQ($conn, $quest, $per, $anio, $idUnidad){

	$query = " SELECT idSeguimiento FROM trimestral.seguimiento WHERE idPregunta = $quest AND idPeriodo = $per AND anio = $anio AND idUnidad = $idUnidad ";

		$stmt = sqlsrv_query(  $conn, $query,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
		$row_count = sqlsrv_num_rows( $stmt );

		return $row_count;
	
	}


	function getDAtaQuestion($conn, $quest, $per, $anio, $idUnidad){

	$query = " SELECT m1, m2, m3, total FROM trimestral.seguimiento WHERE idPregunta = $quest AND idPeriodo = $per AND anio = $anio AND idUnidad = $idUnidad ";

	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['m1'];
		$arreglo[$indice][1]=$row['m2'];
		$arreglo[$indice][2]=$row['m3'];
		$arreglo[$indice][3]=$row['total'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
	
	}

	function getDAtaSIREQuestion($conn, $mes, $anio, $idUnidad){

	$query = " SELECT
       sum([iniciadasConDetenido]) as 'IniDetenido'
      ,sum([iniciadasSinDetenido]) as 'IniSinDetenido'
  FROM [ESTADISTICAV2].[dbo].[carpetasDatos] WHERE idUnidad $idUnidad AND idAnio = $anio AND idMes = $mes GROUP BY idMes ORDER BY idMes ";
//echo $query."<br>";
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['IniDetenido'];
		$arreglo[$indice][1]=$row['IniSinDetenido'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
	
	}

	function getDAtaSIREQuestionEstatus($conn, $mes, $anio, $idUnidad, $estatus, $per){

	$query = " SELECT COUNT(estNucCarpe.idCarpeta) as m
  FROM ESTADISTICAV2.dbo.estatusNucsCarpetas estNucCarpe INNER JOIN PRUEBA.dbo.Carpeta c ON c.CarpetaID = estNucCarpe.idCarpeta 
  WHERE estNucCarpe.idUnidad $idUnidad AND estNucCarpe.mes IN($mes) AND estNucCarpe.idEstatus = $estatus AND estNucCarpe.anio = $anio AND YEAR(c.FechaInicio) = $anio AND MONTH(c.FechaInicio) $per ";

	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['m'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
	}

	function getDAtaSIREQuestionEstatusLiti($conSic, $mes, $anio, $idUnidad, $estatus, $per){

 $query = " SELECT COUNT(idEstatusNucs) as mes FROM [ESTADISTICAV2].[dbo].[estatusNucs] INNER JOIN PRUEBA.dbo.Carpeta c ON c.CarpetaID = estatusNucs.idCarpeta
  WHERE idUnidad $idUnidad AND mes IN($mes) 
  AND idEstatus = $estatus AND anio = $anio AND YEAR(c.FechaInicio) = $anio AND MONTH(c.FechaInicio) $per ";
//echo $query;



	$indice = 0;
	$stmt = sqlsrv_query($conSic, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['mes'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
	
	}


function validaQuest($conn, $Arrquest, $per, $anio, $idUnidad){
				$val = 0;
				$arrFin = array();
				$tam = sizeof($Arrquest);
				for ($i=0; $i < sizeof($Arrquest) ; $i++) { 							
								$query = " SELECT idSeguimiento FROM trimestral.seguimiento WHERE idPregunta = $Arrquest[$i] AND idPeriodo = $per AND anio = $anio AND idUnidad = $idUnidad ";
								$stmt = sqlsrv_query(  $conn, $query,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
								$row_count = sqlsrv_num_rows( $stmt );
								if($row_count > 0 ){
										$arrFin[$i] = 1;
								}else{ $arrFin[$i] = 0; }							
				}
				for ($d=0; $d < sizeof($arrFin) ; $d++) { 
								if($arrFin[$d] == 0){ $val = 0; break; }else{ $val = 1; }
				}
				return $val;					
	}

	
function getDataEnlaceMesValidaEnviado($conn, $mes, $anio, $idEnlace, $idFormato){
	$query = " SELECT enviado FROM dbo.enlaceMesValidaEnviado WHERE idEnlace = $idEnlace AND idFormato = $idFormato AND mesCap = $mes ";
	//echo $query;
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['enviado'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}


function getDataEnlacesByIdUnidad($conn, $idUnidad, $idEnlace){	
	$query = " SELECT * FROM trimestral.enlaceUnidades where idUniCarp $idUnidad OR idUniLiti $idUnidad OR idEnlacTrimes = $idEnlace";
	
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idEnlaceCarp'];
		$arreglo[$indice][1]=$row['idEnlaceLiti'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

function getDAtaSIREQuestionValidateQuestion($conn, $mes, $anio, $idUnidad){

	$query = " SELECT
       ISNULL(sum([iniciadasConDetenido]) +
	      sum([iniciadasSinDetenido]),0) as 'total'
  FROM [ESTADISTICAV2].[dbo].[Carpetas] WHERE idUnidad $idUnidad AND idAnio = $anio AND idMes in $mes ";
//echo $query."<br>";
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[0][0]=$row['total'];
	}
	if(isset($arreglo)){return $arreglo;}
	
	}

	function getPeriodoTrim($conn,  $idEnlace){	
	$query = " SELECT mesCap, idAnio FROM enlaceMesValidaEnviado where idEnlace = $idEnlace AND idFormato = 11";
	
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['mesCap'];
		$arreglo[$indice][1]=$row['idAnio'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

?>