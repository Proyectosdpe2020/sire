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
  FROM [ESTADISTICAV2].[dbo].[Carpetas] WHERE idUnidad $idUnidad AND idAnio = $anio AND idMes = $mes GROUP BY idMes ORDER BY idMes ";
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

	function getDAtaSIREQuestionEstatus($conSic, $mes, $anio, $idUnidad, $estatus, $per){

	$query = " SELECT COUNT(resoluciones.CarpetaID) as m
  FROM [PRUEBA].[dbo].[Resoluciones] INNER JOIN Carpeta c ON c.CarpetaID = Resoluciones.CarpetaID 
  WHERE idUnidad $idUnidad AND mes IN($mes) AND EstatusID = $estatus AND anio = $anio AND YEAR(FechaInicio) = $anio AND MONTH(FechaInicio) $per ";

//echo $query;
	$indice = 0;
	$stmt = sqlsrv_query($conSic, $query);
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
	
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['enviado'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}


?>