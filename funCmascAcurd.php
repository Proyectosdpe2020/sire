<? 

function getAcuerds($conn){

	$query = "SELECT nuc, ec.nomCompl, 
	case  
	when idTipo = 1 then 'Mediación' 
	when idTipo = 2 THEN 'Conciliación' 
	when idTipo = 3 then 'Junta Restaurativa'
	ELSE 'No tiene' 
	END as 'Mecanismo'
	,fechaIngreso, anio, mes
	FROM [ESTADISTICAV2].[CMASC].[nucsEstatus] INNER JOIN CMASC.estatusCampos ec ON ec.idEstatusCampos = CMASC.nucsEstatus.idEstatus WHERE idEstatus IN(1,2,14,15)";

	
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
	{
		$arreglo[$indice][0]=$row['nuc'];
		$arreglo[$indice][1]=$row['nomCompl'];
		$arreglo[$indice][2]=$row['Mecanismo'];
		$arreglo[$indice][3]=$row['fechaIngreso'];
		$arreglo[$indice][4]=$row['anio'];
		$arreglo[$indice][5]=$row['mes'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}		

}

function getAcuerdsNuc($conn, $nuc){

	$query = "SELECT nuc, ec.nomCompl, 
	case  
	when idTipo = 1 then 'Mediación' 
	when idTipo = 2 THEN 'Conciliación' 
	when idTipo = 3 then 'Junta Restaurativa'
	ELSE 'No tiene' 
	END as 'Mecanismo'
	,fechaIngreso, anio, mes
	FROM [ESTADISTICAV2].[CMASC].[nucsEstatus] INNER JOIN CMASC.estatusCampos ec ON ec.idEstatusCampos = CMASC.nucsEstatus.idEstatus WHERE idEstatus IN(1,2,14,15) AND nuc = '$nuc'";

	
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
	{
		$arreglo[$indice][0]=$row['nuc'];
		$arreglo[$indice][1]=$row['nomCompl'];
		$arreglo[$indice][2]=$row['Mecanismo'];
		$arreglo[$indice][3]=$row['fechaIngreso'];
		$arreglo[$indice][4]=$row['anio'];
		$arreglo[$indice][5]=$row['mes'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}		

}



?>