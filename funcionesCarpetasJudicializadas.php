<?php
function getDataCarpetasJudi($conn, $anio, $mes){
		$query = "SELECT n.idEstatusNucs
											      ,e.nombre as Estatus
											      ,n.nuc
											      ,c.Expediente
											      ,n.idMp
												     ,mp.nombre+' '+mp.paterno+' '+mp.materno AS NombreMP
											      ,n.idUnidad
												     ,u.nUnidad AS NombreUnidad
											      ,n.anio
											      ,n.mes
															  ,CASE
															    WHEN n.[mes] = 1 THEN 'Enero'
															    WHEN n.[mes] = 2 THEN 'Febrero'
															    WHEN n.[mes] = 3 THEN 'Marzo'
																WHEN n.[mes] = 4 THEN 'Abril'
																WHEN n.[mes] = 5 THEN 'Mayo'
																WHEN n.[mes] = 6 THEN 'Junio'
																WHEN n.[mes] = 7 THEN 'Julio'
																WHEN n.[mes] = 8 THEN 'Agosto'
																WHEN n.[mes] = 9 THEN 'Septiembre'
																WHEN n.[mes] = 10 THEN 'Octubre'
																WHEN n.[mes] = 11 THEN 'Noviembre'
																WHEN n.[mes] = 12 THEN 'Diciembre'
																ELSE 'Desconocido' 
															   END as nombreMes
											      ,n.idCarpeta
												  ,j.idModalidadEstadistica
												  ,cme.nModalidadEstadistica
												  ,CASE
												    WHEN j.reclasificacion = 0 THEN 'Si'
												    WHEN j.reclasificacion = 1 THEN 'No'
												    ELSE 'Desconocido' 
												   END as reclasificacion
												    ,cmeS.CatModalidadesEstadisticasID as catDelitoSICAP
	          ,cmeS.Nombre AS delitoSicap
	          ,unS.Nombre AS unidadSicap
	           ,u.idFiscalia
												 ,f.nFiscalia AS NombreFiscalia
											  FROM ESTADISTICAV2.dbo.estatusNucs n
											  INNER JOIN dbo.estatus e ON e.idEstatus = n.idEstatus
											  INNER JOIN dbo.mp mp ON mp.idMp = n.idMp
											  INNER JOIN dbo.CatUnidad u ON u.idUnidad = n.idUnidad
											  LEFT JOIN senap.judicializadas j ON j.idEstatusNucs = n.idEstatusNucs
											  LEFT JOIN dbo.CatModalidadEstadistica cme ON cme.idModalidadEstadistica = j.idModalidadEstadistica
											  LEFT JOIN PRUEBA.dbo.Carpeta c on c.CarpetaID = n.idCarpeta
											  LEFT JOIN PRUEBA.dbo.Delito d on c.CarpetaID = d.CarpetaID
             LEFT JOIN PRUEBA.dbo.CatModalidadesEstadisticas cmeS ON cmeS.CatModalidadesEstadisticasID = d.CatModalidadesID
             LEFT JOIN PRUEBA.dbo.CatUIs unS ON unS.CatUIsID = c.CatUIsID
             LEFT JOIN dbo.CatFiscalia f ON f.idFiscalia = u.idFiscalia
											  WHERE n.idEstatus IN (1,2) AND n.anio = $anio AND n.mes IN ($mes) AND d.principal = 1 AND cmes.CatModalidadesEstadisticasID in (1,2,17)
											  ORDER BY n.mes ASC";

											  	$indice = 0;

	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idEstatusNucs'];
		$arreglo[$indice][1]=$row['Estatus'];
		$arreglo[$indice][2]=$row['nuc'];
		$arreglo[$indice][3]=$row['idMp'];
		$arreglo[$indice][4]=$row['NombreMP'];
		$arreglo[$indice][5]=$row['idUnidad'];
		$arreglo[$indice][6]=$row['NombreUnidad'];
		$arreglo[$indice][7]=$row['anio'];
		$arreglo[$indice][8]=$row['nombreMes'];
		$arreglo[$indice][9]=$row['idCarpeta'];
		$arreglo[$indice][10]=$row['idModalidadEstadistica'];
		$arreglo[$indice][11]=$row['reclasificacion'];
		$arreglo[$indice][12]=$row['nModalidadEstadistica'];
		$arreglo[$indice][13]=$row['reclasificacion'];
		$arreglo[$indice][14]=$row['Expediente'];
		$arreglo[$indice][15]=$row['catDelitoSICAP'];
		$arreglo[$indice][16]=$row['delitoSicap'];
  $arreglo[$indice][17]=$row['unidadSicap'];
  $arreglo[$indice][18]=$row['idFiscalia'];
  $arreglo[$indice][19]=$row['NombreFiscalia'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
	
}

function getDataVinculaciones($conSic, $anio, $mes){
		$query = "SELECT
												       c.NUC
													   		,c.Expediente
												      ,r.ResolucionID
												      ,r.CarpetaID
												      ,r.EstatusID
													  ,cer.Nombre AS nombreEstatus
													  ,r.mes
													  ,CASE
													   WHEN r.[mes] = 1 THEN 'Enero'
													   WHEN r.[mes] = 2 THEN 'Febrero'
													   WHEN r.[mes] = 3 THEN 'Marzo'
													   WHEN r.[mes] = 4 THEN 'Abril'
													   WHEN r.[mes] = 5 THEN 'Mayo'
													   WHEN r.[mes] = 6 THEN 'Junio'
													   WHEN r.[mes] = 7 THEN 'Julio'
													   WHEN r.[mes] = 8 THEN 'Agosto'
													   WHEN r.[mes] = 9 THEN 'Septiembre'
													   WHEN r.[mes] = 10 THEN 'Octubre'
													   WHEN r.[mes] = 11 THEN 'Noviembre'
													   WHEN r.[mes] = 12 THEN 'Diciembre'
													   ELSE 'Desconocido' 
													   END as nombreMes
												   ,r.anio
												   ,r.idUnidad
													  ,c.CatUIsID
													  ,cuis.Nombre AS nombreUnidad
													  ,d.CatDelitosID 
													  ,modest.Nombre AS nombreDelito
													  ,us.Nombre+' '+us.Materno+' '+us.Paterno AS nombreMP
												  FROM PRUEBA.dbo.Resoluciones r
												  INNER JOIN dbo.CatEstatusResoluciones cer on cer.EstatusID = R.EstatusID
												  INNER JOIN dbo.Carpeta c ON c.CarpetaID = r.CarpetaID
												  INNER JOIN dbo.CatUIs cuis ON cuis.CatUIsID = c.CatUIsID
												  INNER JOIN dbo.Delito d ON d.CarpetaID = c.CarpetaID
												  INNER JOIN dbo.CatModalidadesEstadisticas modest ON modest.CatModalidadesEstadisticasID = d.CatModalidadesID
												  INNER JOIN dbo.Usuario us ON us.UsuarioID = c.CapturistaID
												  where r.EstatusID = 19 AND r.anio = $anio AND r.mes in ($mes) AND d.principal = 1 AND d.CatModalidadesID in (1,2,17)
												   ORDER BY r.mes ASC ";

  					  					$indice = 0;

	$stmt = sqlsrv_query($conSic, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['NUC'];
		$arreglo[$indice][1]=$row['Expediente'];
		$arreglo[$indice][2]=$row['ResolucionID'];
		$arreglo[$indice][3]=$row['CarpetaID'];
		$arreglo[$indice][4]=$row['EstatusID'];
		$arreglo[$indice][5]=$row['nombreEstatus'];
		$arreglo[$indice][6]=$row['nombreMes'];
		$arreglo[$indice][7]=$row['anio'];
		$arreglo[$indice][8]=$row['nombreUnidad'];
		$arreglo[$indice][9]=$row['nombreDelito'];
		$arreglo[$indice][10]=$row['nombreMP'];
		$arreglo[$indice][11]=$row['idUnidad'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

function checkUnidadesLiti($idUnidad){
	if($idUnidad == 158 || $idUnidad == 161 || $idUnidad == 157 ||  $idUnidad == 166 || $idUnidad == 159 || $idUnidad == 164 || $idUnidad == 75 || $idUnidad == 163 || $idUnidad == 160 || $idUnidad == 162 ){
		return true;
	}
	else{
		return false;
	}
}

function getDataUnidad($conn , $idUnidad){
	$query = "SELECT cu.idUnidad as idUnidades
															  ,cu.idFiscalia as idFiscalias
																 ,f.nFiscalia as nombreFisca
															  ,cu.nUnidad as nombreUni
												FROM ESTADISTICAV2.dbo.CatUnidad cu
												INNER JOIN CatFiscalia f ON f.idFiscalia = cu.idFiscalia
												WHERE idUnidad = $idUnidad ";

  					  					$indice = 0;

	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idUnidades'];
		$arreglo[$indice][1]=$row['idFiscalias'];
		$arreglo[$indice][2]=$row['nombreFisca'];
		$arreglo[$indice][3]=$row['nombreUni'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

function getDataMonth($conn, $anioActual){
	$query = "SELECT DISTINCT idMes
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
																									 else 'No identificado'
																									END as Mes
																					  FROM ESTADISTICAV2.dbo.Litigacion WHERE idAnio = $anioActual ";

 $indice = 0;

	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idMes'];
		$arreglo[$indice][1]=$row['Mes'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

function getDataFechaInvComp($conn, $resolucionID){
		$query = "SELECT idTermCom
     												 ,resolucionID
      												,fechaTermCom
  									FROM ESTADISTICAV2.dbo.investigacionComplementaria
  									WHERE resolucionID = $resolucionID";

 	$indice = 0;

	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idTermCom'];
		$arreglo[$indice][1]=$row['resolucionID'];
		$arreglo[$indice][2]=$row['fechaTermCom'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

function fechaCastellano($fecha){
	 $fecha = substr($fecha, 0, 10);
	 $numeroDia = date('d', strtotime($fecha));
  $dia = date('l', strtotime($fecha));
  $mes = date('F', strtotime($fecha));
  $anio = date('Y', strtotime($fecha));
  $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
  $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
  $nombredia = str_replace($dias_EN, $dias_ES, $dia);
  $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
  $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
  $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
  return $numeroDia." de ".$nombreMes." de ".$anio;
}


?>