<?php

function getAllTramitCurrent($conn){//// COUNT ALL TRAMITES 

	$query = "  SELECT COUNT(nuc) as total FROM CMASC.nucsRecib WHERE tramite = 1  ";


	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
	{
		$arreglo[$indice][0]=$row['total'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	

}


function nucAcuerUpdatRecib($conn, $nuc){ /////////// PARA BUSCAR EL NUC A ACTUALIZAR ESTATUS ACUERDOS EN LA TABLA DE RECIBIDAS

	$query = " SELECT TOP 1 idNucRecibida, [acue/termin], tramite FROM CMASC.nucsRecib WHERE nuc = $nuc AND [procedente/desechado] = 0 ORDER BY idNucRecibida DESC ";


	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
	{
		$arreglo[$indice][0]=$row['idNucRecibida'];
		$arreglo[$indice][1]=$row['acue/termin'];
		$arreglo[$indice][2]=$row['tramite'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	

}


function getStatusAcuerd($conn, $idEstatus){

	$query = "   SELECT nomCompl FROm CMASC.estatusCampos WHERE idEstatusCampos = $idEstatus  ";


	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
	{
		$arreglo[$indice][0]=$row['nomCompl'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	

}

function isAcuerd($conn, $nuc){

	$query = "   SELECT nuc, idEstatus, idTipo, fechaIngreso FROM CMASC.nucsEstatus WHERE nuc = '$nuc' ";


	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
	{
		$arreglo[$indice][0]=$row['nuc'];
		$arreglo[$indice][1]=$row['idEstatus'];
		$arreglo[$indice][2]=$row['idTipo'];
		$arreglo[$indice][3]=$row['fechaIngreso'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	

}

function getIngresadosNucAcuer($conn, $nuc){

	$query = " SELECT TOP 1 idNucRecibida, [ordinario/reproceso], [procedente/desechado], fechaIngreso FROM CMASC.nucsRecib WHERE nuc = $nuc ORDER BY idNucRecibida DESC ";


	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
	{
		$arreglo[$indice][0]=$row['idNucRecibida'];
		$arreglo[$indice][1]=$row['ordinario/reproceso'];
		$arreglo[$indice][2]=$row['procedente/desechado'];
		$arreglo[$indice][3]=$row['fechaIngreso'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	

}

function getDataAcuer($conn, $anio, $mes, $idEnlace, $estatus, $tipo){

	$query = "   SELECT idNucsEstatus, idEstatus,idTipo, nuc, fechaIngreso FROM CMASC.nucsEstatus WHERE anio = $anio AND mes = $mes AND idEnlace = $idEnlace AND idEstatus = $estatus AND idTipo = $tipo
	";

	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
	{
		$arreglo[$indice][0]=$row['idNucsEstatus'];
		$arreglo[$indice][1]=$row['idEstatus'];
		$arreglo[$indice][2]=$row['idTipo'];
		$arreglo[$indice][3]=$row['nuc'];
		$arreglo[$indice][4]=$row['fechaIngreso'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	

}

function getNameEstatus($conn, $estatus){

	$query = " SELECT nomCompl FROM CMASC.estatusCampos WHERE idEstatusCampos = $estatus ";


	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
	{
		$arreglo[$indice][0]=$row['nomCompl'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	

}


function sumEstatus($conn, $mes, $anio, $idEnlace, $estatus, $tipo){

	$query = "   SELECT COUNT(nuc) as 'total' FROM CMASC.nucsEstatus WHERE anio = $anio AND mes = $mes and idEnlace = $idEnlace AND idEstatus = $estatus AND idTipo = $tipo ";


	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
	{
		$arreglo[$indice][0]=$row['total'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	

}



function lastStatusNuc($conn, $nuc){

	$query = " SELECT TOP 1 idNucRecibida, nuc, [ordinario/reproceso], [procedente/desechado], mes, anio, idEnlace, idUnidad, fechaIngreso FROM CMASC.nucsRecib WHERE nuc = '$nuc' ORDER BY idNucRecibida DESC ";


	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
	{
		$arreglo[$indice][0]=$row['ordinario/reproceso'];
		$arreglo[$indice][1]=$row['procedente/desechado'];
		$arreglo[$indice][2]=$row['mes'];
		$arreglo[$indice][3]=$row['anio'];
		$arreglo[$indice][4]=$row['idEnlace'];
		$arreglo[$indice][5]=$row['idUnidad'];
		$arreglo[$indice][6]=$row['fechaIngreso'];
		$arreglo[$indice][7]=$row['nuc'];

		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	

}


function countNucsProcedents($conn, $mes, $anio, $idEnlace){

	$query = "  SELECT COUNT([procedente/desechado]) as 'total' FROM CMASC.nucsRecib WHERE idEnlace = $idEnlace AND anio = $anio and mes = $mes  AND [procedente/desechado] = 0 ";

	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
	{
		$arreglo[$indice][0]=$row['total'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	

}


function searchnucsUnidEnlc($conn, $mes, $anio, $idEnlace, $idUnidad){

	$query = "    SELECT nuc, case WHEN [ordinario/reproceso] = 0 THEN 'Ordinario' WHEN [ordinario/reproceso] = 1 THEN 'Reproceso' ELSE 'Ninguno' END as 'one', 
	case WHEN [procedente/desechado] = 0 THEN 'Procedente' WHEN [procedente/desechado] = 1 THEN 'Desechado' ELSE 'Ninguno' END as 'two', idNucRecibida, fechaIngreso FROM CMASC.nucsRecib WHERE idEnlace = $idEnlace AND anio = $anio and mes = $mes AND idUnidad = $idUnidad";


	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
	{
		$arreglo[$indice][0]=$row['nuc'];
		$arreglo[$indice][1]=$row['one'];
		$arreglo[$indice][2]=$row['two'];
		$arreglo[$indice][4]=$row['idNucRecibida'];
		$arreglo[$indice][5]=$row['fechaIngreso'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	

}

function countNucsProcDese($conn, $mes, $anio, $idEnlace, $staus, $idUnidad){

	$query = "  SELECT COUNT([procedente/desechado]) as 'total' FROM CMASC.nucsRecib WHERE idEnlace =  $idEnlace AND anio = $anio and mes = $mes AND idUnidad = $idUnidad AND [procedente/desechado] = $staus ";


	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
	{
		$arreglo[$indice][0]=$row['total'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	

}


function countNucsOrdRepr($conn, $mes, $anio, $idEnlace, $staus, $idUnidad){

	$query = "  SELECT COUNT([ordinario/reproceso]) as 'total' FROM CMASC.nucsRecib WHERE idEnlace = $idEnlace AND anio = $anio and mes = $mes AND idUnidad = $idUnidad AND [ordinario/reproceso] = $staus ";


	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
	{
		$arreglo[$indice][0]=$row['total'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	

}

function getRecbMesAnioEnlc($conn, $mes, $anio, $idEnlace){

	$query = " SELECT distinct(CMASC.nucsRecib.idUnidad), cu.nUnidad FROM CMASC.nucsRecib INNER JOIN dbo.CatUnidad cu ON cu.idUnidad = CMASC.nucsRecib.idUnidad WHERE idEnlace = $idEnlace AND anio = $anio and mes = $mes ";


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

function getDataMainRecib($conn, $idEnlace, $mes, $anio){

	$query = "   SELECT idRecibidas, extAnter, solVictimaHombre, solVictimaMujer, solImpuHombre, solImpuMujer, invitacionsGeneradas, totalRecibidas, tramite, fechaIngreso FROM CMASC.recibidas WHERE idEnlace = $idEnlace AND anio = $anio
	AND mes = $mes ";


	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
	{
		$arreglo[$indice][0]=$row['idRecibidas'];
		$arreglo[$indice][7]=$row['extAnter'];
		$arreglo[$indice][2]=$row['solVictimaHombre'];
		$arreglo[$indice][3]=$row['solVictimaMujer'];
		$arreglo[$indice][4]=$row['solImpuHombre'];
		$arreglo[$indice][5]=$row['solImpuMujer'];
		$arreglo[$indice][6]=$row['invitacionsGeneradas'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	

}


//// OBTENEMOS EL NUMERO DE NUCS QUE SE ENCUENTRAS EN TRAMITE DESDE MESES O AÑOS PASADOS
function currentNucsTramit($conn, $idEnlace){

	$query = " SELECT idUnidad, nuc, mes, anio, idEnlace, fechaIngreso, [acue/termin] FROM CMASC.nucsRecib WHERE tramite = 1 ";


	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
	{
		$arreglo[$indice][0]=$row['idUnidad'];
		$arreglo[$indice][1]=$row['nuc'];
		$arreglo[$indice][2]=$row['mes'];
		$arreglo[$indice][3]=$row['anio'];
		$arreglo[$indice][4]=$row['idEnlace'];
		$arreglo[$indice][5]=$row['fechaIngreso'];
		$arreglo[$indice][6]=$row['acue/termin'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	

}
/////// CONTAMOS EL NUMERO DE NUCS QUE SE ENCUENTRAN EN TRAMITE SE SUMAN TODOS MENOS LOS DEL MES ACTUAL
function currentNucsTramitCount($conn, $idEnlace ,$anio){

	$query = " SELECT COUNT(nuc) as total FROM CMASC.nucsRecib WHERE tramite = 1 AND anio <= $anio ";

	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
	{
		$arreglo[$indice][0]=$row['total'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	

}
function currentNucsTramitCount1($conn, $idEnlace ,$mes, $anioAnte){

	$query = " SELECT COUNT(nuc) as total FROM CMASC.nucsRecib WHERE tramite = 1 AND anio <= $anioAnte AND mes <> $mes  ";

	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
	{
		$arreglo[$indice][0]=$row['total'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	

}





function getUnidCmas($conn, $idUnidad){

	$query = " SELECT idUnidad, nombre FROM CMASC.unidad WHERE idUnidad = $idUnidad ORDER BY nombre ";


	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
	{
		$arreglo[$indice][0]=$row['idUnidad'];
		$arreglo[$indice][1]=$row['nombre'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	

}

function getAllUnidCmas($conn){

	$query = " SELECT idUnidad, nombre FROM CMASC.unidad ORDER BY nombre";	
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
	{
		$arreglo[$indice][0]=$row['idUnidad'];
		$arreglo[$indice][1]=$row['nombre'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	
	
}

function foundNuc($conn, $nuc, $ordRepro){

	$query = " SELECT nuc, [ordinario/reproceso], [procedente/desechado], idUnidad, mes, anio FROM CMASC.nucsRecib WHERE nuc = $nuc AND [ordinario/reproceso] = $ordRepro ";				

	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
	{
		$arreglo[$indice][0]=$row['nuc'];
		$arreglo[$indice][1]=$row['ordinario/reproceso'];
		$arreglo[$indice][2]=$row['procedente/desechado'];
		$arreglo[$indice][3]=$row['idUnidad'];
		$arreglo[$indice][4]=$row['mes'];
		$arreglo[$indice][5]=$row['anio'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	

}	

?>