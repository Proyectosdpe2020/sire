<? 

function getHasCapturaNucs($conn, $idEnlace){

	$query = "  SELECT distinct(capturaNucsTrimes) as 'captura' FROM enlaceFormato WHERE idEnlace IN($idEnlace)  ";
				  $indice = 0;
				  $stmt = sqlsrv_query($conn, $query);
				  while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
				  {
					  $arreglo[$indice][0]=$row['captura'];
					  $indice++;
				  }
				  if(isset($arreglo)){return $arreglo;}
}


function getArrayCounts($conn, $quest, $idEnlace, $idUnidad, $per, $mes){

	$anios = array( 2017, 2018, 2019, 2020, 2021, 2022 );
	$valores =  array();
	
	for ($i=0; $i < sizeof($anios) ; $i++) { 
				$datas = getCountNucsTrim($conn, $anios[$i], $quest, $idEnlace, $idUnidad, $per, $mes);
		  $valores[$i] =  $datas[0][0];
	}

	if(isset($valores)){return $valores;}

}

function getCountNucsTrim($conn, $anio, $quest, $idEn, $idUn, $per, $mes){

	$query = "  SELECT count(NUC) as 'total'
	FROM trimestral.nucsTrimestral 
	WHERE SUBSTRING(NUC, 5,4) = $anio 
				  AND idPregunta = $quest 
				  AND idEnlace = $idEn 
				  AND idUnidad = $idUn
				  AND periodo = $per
				  AND mes = $mes
				  AND anioCaptura = 2023
				  ";
				  $indice = 0;
				  $stmt = sqlsrv_query($conn, $query);
				  while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
				  {
					  $arreglo[$indice][0]=$row['total'];
					  $indice++;
				  }
				  if(isset($arreglo)){return $arreglo;}
}


function getNucsTrim($conn, $anio, $quest, $idEn, $idUn, $per, $mes, $anioactual){

if($anio == 0 AND $mes == 0){

	$query = "SELECT NUC, idNucsTrimestral FROM trimestral.nucsTrimestral 
	WHERE SUBSTRING(NUC, 5,4) < $anioactual  AND idEnlace = $idEn AND idUnidad = $idUn AND periodo = $per AND idPregunta = $quest AND anioCaptura = 2023";

}else{
	$query = "  SELECT NUC, idNucsTrimestral
	FROM trimestral.nucsTrimestral 
	WHERE SUBSTRING(NUC, 5,4) = $anio 
				  AND idPregunta = $quest 
				  AND idEnlace = $idEn 
				  AND idUnidad = $idUn
				  AND periodo = $per
				  AND mes = $mes
				  AND anioCaptura = 2023;
				  ";
}

				  $indice = 0;
				  $stmt = sqlsrv_query($conn, $query);
				  while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
				  {
					  $arreglo[$indice][0]=$row['NUC'];
							$arreglo[$indice][1]=$row['idNucsTrimestral'];
					  $indice++;
				  }
				  if(isset($arreglo)){return $arreglo;}
}

function getNamePregunta($conn, $quest){

	$query = "   SELECT  nombre FROM trimestral.pregunta WHERE idPregunta = $quest ";

	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['nombre'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
	
	}

function getDataAnteriores($conn, $quest, $idEnlace, $idUnidad, $anio, $periodo){

	$query = "   SELECT val2017, val2018, val2019, val2020, val2021, val2022 FROM trimestral.datosAnteriorTrimestral WHERE idPregunta = $quest AND idEnlace = $idEnlace AND idUnidad = $idUnidad AND anio = $anio AND periodo = $periodo ";

	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['val2017'];
		$arreglo[$indice][1]=$row['val2018'];
		$arreglo[$indice][2]=$row['val2019'];
		$arreglo[$indice][3]=$row['val2020'];
		$arreglo[$indice][4]=$row['val2021'];
		$arreglo[$indice][5]=$row['val2022'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
	
	}

function getDAtaSIREQuestionEstatusResto($conn, $anio, $idUnidad, $estatus, $per, $numPeriodo){

	if($numPeriodo == 1){ $periodo1 = "01-01-".$anio; $periodo2 = "31-03-".$anio; }
	if($numPeriodo == 2){ $periodo1 = "01-04-".$anio; $periodo2 = "30-06-".$anio; }
	if($numPeriodo == 3){ $periodo1 = "01-07-".$anio; $periodo2 = "30-09-".$anio; }
	if($numPeriodo == 4){ $periodo1 = "01-10-".$anio; $periodo2 = "31-12-".$anio; }

	$query = " SELECT COUNT(estNucCarpe.idEstatusNucsCarpetas) AS valor
	FROM ESTADISTICAV2.dbo.estatusNucsCarpetas estNucCarpe 
	INNER JOIN PRUEBA.dbo.Carpeta c ON c.CarpetaID = estNucCarpe.idCarpeta 
	WHERE estNucCarpe.idUnidad $idUnidad
	AND estNucCarpe.idEstatus = $estatus
	AND estNucCarpe.idEstatusNucsCarpetas NOT IN (SELECT estNucCarpe.idEstatusNucsCarpetas
	FROM ESTADISTICAV2.dbo.estatusNucsCarpetas estNucCarpe 
	INNER JOIN PRUEBA.dbo.Carpeta c ON c.CarpetaID = estNucCarpe.idCarpeta 
	WHERE estNucCarpe.idUnidad $idUnidad 
	AND estNucCarpe.idEstatus = $estatus
	AND FechaInicio  Between '$periodo1' AND '$periodo2'
	AND estNucCarpe.mes  $per)";
	
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['valor'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
	}

function getDataQ($conn, $quest, $per, $anio, $idUnidad){

	$query = " SELECT idSeguimiento FROM trimestral.seguimiento WHERE idPregunta = $quest AND idPeriodo = $per AND anio = $anio AND idUnidad = $idUnidad ";

		$stmt = sqlsrv_query(  $conn, $query,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
		$row_count = sqlsrv_num_rows( $stmt );

		return $row_count;
	
	}


	function getDAtaQuestion($conn, $quest, $per, $anio, $idUnidad){

	$query = " SELECT m1, m2, m3, total FROM trimestral.seguimiento WHERE idPregunta = $quest AND idPeriodo = $per AND anio = $anio AND idUnidad = $idUnidad ";
 //echo $query;
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
  WHERE estNucCarpe.idUnidad $idUnidad AND estNucCarpe.mes IN($mes) AND estNucCarpe.idEstatus = $estatus AND estNucCarpe.anio = $anio 
		AND YEAR(c.FechaInicio) = $anio AND MONTH(c.FechaInicio) $per ";
//echo $query.'<br>';
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
//echo $query.'<br>';



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
	//echo $query;
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idEnlaceCarp'];
		$arreglo[$indice][1]=$row['idEnlaceLiti'];
		$arreglo[$indice][2]=$row['idUniLiti'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

function getDAtaSIREQuestionValidateQuestion($conn, $mes, $anio, $idUnidad){

	$query = " SELECT
       ISNULL(sum([iniciadasConDetenido]) +
	      sum([iniciadasSinDetenido]),0) as 'total'
  FROM [ESTADISTICAV2].[dbo].[carpetasDatos] WHERE idUnidad $idUnidad AND idAnio = $anio AND idMes in $mes ";
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


//Funcion para validar la pregunta 4.1
function getDAtaSIREQuestionValidateQuestion_4_1($conn, $mes, $anio, $idUnidad){

	$query = " SELECT
       ISNULL( sum([iniciadasConDetenido]) , 0) as 'total'
  FROM [ESTADISTICAV2].[dbo].[carpetasDatos] WHERE idUnidad $idUnidad AND idAnio = $anio AND idMes in $mes ";
//echo $query."<br>";
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[0][0]=$row['total'];
	}
	if(isset($arreglo)){return $arreglo;}
	
	}

	function getDAtaSIREQuestionEstatusHitorico($conn, $anio, $idUnidad, $estatus, $per, $anioHistorico){

	$query = " SELECT COUNT(estNucCarpe.idCarpeta) as m
  FROM ESTADISTICAV2.dbo.estatusNucsCarpetas estNucCarpe INNER JOIN PRUEBA.dbo.Carpeta c ON c.CarpetaID = estNucCarpe.idCarpeta 
  WHERE estNucCarpe.idUnidad $idUnidad AND estNucCarpe.mes $per AND estNucCarpe.idEstatus = $estatus AND estNucCarpe.anio = $anio 
		AND SUBSTRING ( c.NUC ,5 , 4 ) = $anioHistorico ";
//echo $query.'<br>';
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['m'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
	}

	function getDAtaSIREQuestionEstatusLitiHistorico($conSic, $anio, $idUnidad, $estatus, $per,  $anioHistorico){

 $query = " SELECT COUNT(idEstatusNucs) as mes FROM [ESTADISTICAV2].[dbo].[estatusNucs] INNER JOIN PRUEBA.dbo.Carpeta c ON c.CarpetaID = estatusNucs.idCarpeta WHERE idUnidad $idUnidad AND mes $per  AND idEstatus = $estatus AND anio = $anio AND SUBSTRING ( c.NUC ,5 , 4 ) = $anioHistorico ";
//echo $query.'<br>';



	$indice = 0;
	$stmt = sqlsrv_query($conSic, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['mes'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
	
	}

	function getDAtaSIREQuestionEstatusLiti_Quest_9_3($conSic, $mes, $anio, $idUnidad, $per){
 $estatus = 'IN(95,20,21,22,23,24,25,26,27,28,29,30,31)';
 $query = " SELECT COUNT(idEstatusNucs) as mes FROM [ESTADISTICAV2].[dbo].[estatusNucs] INNER JOIN PRUEBA.dbo.Carpeta c ON c.CarpetaID = estatusNucs.idCarpeta
  WHERE idUnidad $idUnidad AND mes IN($mes) 
  AND idEstatus $estatus AND anio = $anio AND YEAR(c.FechaInicio) = $anio AND MONTH(c.FechaInicio) $per ";
//echo $query.'<br>';



	$indice = 0;
	$stmt = sqlsrv_query($conSic, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['mes'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
	
	}

		function getDAtaSIREQuestionEstatusLitiHistorico_Quest_9_3($conSic, $per, $anio, $idUnidad,  $anioHistorico){
 $estatus = 'IN(95,20,21,22,23,24,25,26,27,28,29,30,31)';
 $query = " SELECT COUNT(idEstatusNucs) as mes FROM [ESTADISTICAV2].[dbo].[estatusNucs] INNER JOIN PRUEBA.dbo.Carpeta c ON c.CarpetaID = estatusNucs.idCarpeta WHERE idUnidad $idUnidad AND mes $per  AND idEstatus $estatus AND anio = $anio AND SUBSTRING ( c.NUC ,5 , 4 ) = $anioHistorico ";
//echo $query.'<br>';



	$indice = 0;
	$stmt = sqlsrv_query($conSic, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['mes'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
	
	}


?>