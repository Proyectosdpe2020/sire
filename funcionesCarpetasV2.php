<? 

///////////////////////////////// FUNCION GET EXISTENCIA ANTERIOR /////////////////////////////////
///////////////////////////////// FUNCION GET EXISTENCIA ANTERIOR /////////////////////////////////
///////////////////////////////// FUNCION GET EXISTENCIA ANTERIOR /////////////////////////////////

///// La modificacion se realiza por que a partir de julio se contabilizaran nucs en ves de registros ////

function getAnyExistenciaAnteriorV2($conn, $mes, $anio, $idUnidad, $idMp){


	if ($mes == 1) {
		$mesAnterior = 12;
		$anioAnterior = ($anio - 1);
		$mesAntAnt = ($mes - 2);
	  } else {
		$anioAnterior = $anio;
		$mesAnterior = ($mes - 1);
		$mesAntAnt = ($mes - 2);
	  }
	////// PRIMERO LLEGA EL MES Y EL AÑO Y SE ANALIZA PARA SABER DE DONDE TOMAR LOS DATOS //////////

	///// si el mes del que quieren el tramite anteior es julio de 2021 o menos a esa fecha entonces la existencia anterior sera tomada de la tabla de Carpetas 

	if($anioAnterior <= 2021 && $mesAnterior <= 6){
		
		$existenciaAnt = getExistenciaAnterior($conn, $mesAnterior, $anioAnterior, $idUnidad, $idMp);
		return $existenciaAnt[0][0];

	}else{

		//////// SI EL MES ANTERIOR ES 6 SE SACA EL TRAMITE DE CARPETAS Y SE SACAN LOS NUCS PARA SABER LAS DETERMINACIONES
		if($mesAnterior == 7 AND $anioAnterior = 2021){

			$d11 = getCountNucs($conn, 1, $mesAnterior, $anioAnterior, $idUnidad, $idMp, 0);
			$d22 = getCountNucs($conn, 22, $mesAnterior, $anioAnterior, $idUnidad, $idMp, 1);
			$d33 = getCountNucs($conn, 22, $mesAnterior, $anioAnterior, $idUnidad, $idMp, 0);			
			$d44 = getCountNucs($conn, 2, $mesAnterior, $anioAnterior, $idUnidad, $idMp, 0);
			$d55 = getCountNucs($conn, 5, $mesAnterior, $anioAnterior, $idUnidad, $idMp, 0);
			$d66 = getCountNucs($conn, 20, $mesAnterior, $anioAnterior, $idUnidad, $idMp, 0);
			$d77 = getCountNucs($conn, 21, $mesAnterior, $anioAnterior, $idUnidad, $idMp, 0);
			$d88 = getCountNucs($conn, 3, $mesAnterior, $anioAnterior, $idUnidad, $idMp, 0);
			$d99 = getCountNucs($conn, 23, $mesAnterior, $anioAnterior, $idUnidad, $idMp, 0);
			$d101 = getCountNucs($conn, 24, $mesAnterior, $anioAnterior, $idUnidad, $idMp, 0);
			$d111 = getCountNucs($conn, 25, $mesAnterior, $anioAnterior, $idUnidad, $idMp, 0);
			$d121 = getCountNucs($conn, 15, $mesAnterior, $anioAnterior, $idUnidad, $idMp, 0);

			$existAntAnt = getExistenciaAnterior($conn, $mesAntAnt, $anioAnterior, $idUnidad, $idMp);
			$existNew = getDataCarpetasDatosExistenciaAnteriorV2($conn, $mesAnterior, $anioAnterior, $idUnidad, $idMp);
			$totIniciads = $existNew[0][5] +  $existNew[0][6];
			$totaTrabvajar2 = $existAntAnt  + $existNew[0][0] + $d11[0][0] + $existNew[0][1] ;
			$totDeterminaciones10 = $d22[0][0] + $d33[0][0] + $d44[0][0] + $d55[0][0] + $d66[0][0] + $d77[0][0] + $d88[0][0] + $d99[0][0] + $d101[0][0] + $d111[0][0] + $d121[0][0];
			$enviads10 = $existNew[0][2] + $existNew[0][3] + $existNew[0][4];

			$tramitefinal = $totaTrabvajar2 - ($totDeterminaciones10 + $enviads10);
			return $tramitefinal;

		}else{



		}

	}

	$query = "  SELECT iniciadasConDetenido, iniciadasSinDetenido, totalIniciadas,recibidasPorOtraUnidad, enviadasUATP, enviadasUI, enviImpDes FROM carpetasDatos WHERE idAnio = $aniocaptura AND idMes = $mesAnterior AND idUnidad = $idUnidad AND idMp = $idMp ";

	
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['totalIniciadas'];
		$arreglo[$indice][1]=$row['recibidasPorOtraUnidad'];
		$arreglo[$indice][2]=$row['enviadasUATP'];
		$arreglo[$indice][3]=$row['enviadasUI'];
		$arreglo[$indice][4]=$row['enviImpDes'];
		$arreglo[$indice][5]=$row['iniciadasConDetenido'];
		$arreglo[$indice][6]=$row['iniciadasSinDetenido'];
		$indice++;
	}
	//if(isset($arreglo)){return $arreglo;}
}


///////////////////////////////// FUNCION GET EXISTENCIA ANTERIOR /////////////////////////////////
///////////////////////////////// FUNCION GET EXISTENCIA ANTERIOR /////////////////////////////////
///////////////////////////////// FUNCION GET EXISTENCIA ANTERIOR /////////////////////////////////



function getLastResolJudicializateCarpet($conn, $carpetaId){

	$query = "SELECT top 1  nuc, idEstatusNucsCarpetas, fecha, idCarpeta, idEstatus, ec.nombre as estatusCar, ec.EstatusID, estatusNucsCarpetas.mes, estatusNucsCarpetas.anio, estatusNucsCarpetas.idUnidad,
	u.nUnidad as unidad, f.nFiscalia as fiscalia, estatusNucsCarpetas.idMp, mp.nombre+' '+mp.paterno+' '+mp.materno as ministerio
	FROM estatusNucsCarpetas 
	INNER JOIN estatusCarpetasResoluciones ec ON ec.EstatusID = estatusNucsCarpetas.idEstatus
	INNER JOIN CatUnidad u ON u.idUnidad = estatusNucsCarpetas.idUnidad
	INNER JOIN CatFiscalia f ON f.idFiscalia = u.idFiscalia
	INNER JOIN mp ON mp.idMp = estatusNucsCarpetas.idMp
	WHERE idCarpeta = $carpetaId AND idEstatus = 22 ORDER BY fecha DESC ";



	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['EstatusID'];
		$arreglo[$indice][1]=$row['estatusCar'];
		$arreglo[$indice][2]=$row['mes'];
		$arreglo[$indice][3]=$row['anio'];
		$arreglo[$indice][4]=$row['unidad'];
		$arreglo[$indice][5]=$row['fiscalia'];
		$arreglo[$indice][6]=$row['ministerio'];
		$arreglo[$indice][7]=$row['nuc'];
		$arreglo[$indice][8]=$row['fecha'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}



function getAlldiferentsCarpetsMesAnioUnid($conn, $anio, $mes, $idUnidad){

	$query = " 
  SELECT distinct idCarpeta 
  FROM estatusNucsCarpetas 
  WHERE mes = $mes AND anio = $anio AND idUnidad $idUnidad";


	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idCarpeta'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}

}

function getLastResolucionCarpetaV2($conn, $carpetaId){

	$query ="   SELECT   nuc, idEstatusNucsCarpetas, fecha, idCarpeta, idEstatus, ec.nombre as estatusCar, ec.EstatusID, estatusNucsCarpetas.mes, estatusNucsCarpetas.anio, estatusNucsCarpetas.idUnidad,
	u.nUnidad as unidad, f.nFiscalia as fiscalia, estatusNucsCarpetas.idMp, mp.nombre+' '+mp.paterno+' '+mp.materno as ministerio
	FROM estatusNucsCarpetas 
	INNER JOIN estatusCarpetasResoluciones ec ON ec.EstatusID = estatusNucsCarpetas.idEstatus
	INNER JOIN CatUnidad u ON u.idUnidad = estatusNucsCarpetas.idUnidad
	INNER JOIN CatFiscalia f ON f.idFiscalia = u.idFiscalia
	INNER JOIN mp ON mp.idMp = estatusNucsCarpetas.idMp
	WHERE idCarpeta = $carpetaId ORDER BY fecha DESC 
";
	


	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['EstatusID'];
		$arreglo[$indice][1]=$row['estatusCar'];
		$arreglo[$indice][2]=$row['mes'];
		$arreglo[$indice][3]=$row['anio'];
		$arreglo[$indice][4]=$row['unidad'];
		$arreglo[$indice][5]=$row['fiscalia'];
		$arreglo[$indice][6]=$row['ministerio'];
		$arreglo[$indice][7]=$row['nuc'];
		$arreglo[$indice][8]=$row['fecha'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}

}

function getLastResolucionCarpetaV2termin($conn, $carpetaId){

	$query ="   SELECT   nuc, idEstatusNucsCarpetas, fecha, idCarpeta, idEstatus, ec.nombre as estatusCar, ec.EstatusID, estatusNucsCarpetas.mes, estatusNucsCarpetas.anio, estatusNucsCarpetas.idUnidad,
	u.nUnidad as unidad, f.nFiscalia as fiscalia, estatusNucsCarpetas.idMp, mp.nombre+' '+mp.paterno+' '+mp.materno as ministerio
	FROM estatusNucsCarpetas 
	INNER JOIN estatusCarpetasResoluciones ec ON ec.EstatusID = estatusNucsCarpetas.idEstatus
	INNER JOIN CatUnidad u ON u.idUnidad = estatusNucsCarpetas.idUnidad
	INNER JOIN CatFiscalia f ON f.idFiscalia = u.idFiscalia
	INNER JOIN mp ON mp.idMp = estatusNucsCarpetas.idMp
	WHERE idCarpeta = $carpetaId AND idEstatus IN(15,25,2) ORDER BY fecha DESC 
";
	


	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['EstatusID'];
		$arreglo[$indice][1]=$row['estatusCar'];
		$arreglo[$indice][2]=$row['mes'];
		$arreglo[$indice][3]=$row['anio'];
		$arreglo[$indice][4]=$row['unidad'];
		$arreglo[$indice][5]=$row['fiscalia'];
		$arreglo[$indice][6]=$row['ministerio'];
		$arreglo[$indice][7]=$row['nuc'];
		$arreglo[$indice][8]=$row['fecha'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}

}



function getLastResolucionHistoricoResoluciones($conn, $carpetaId){

	$query ="  SELECT TOP 1 ResolucionID, CarpetaID, Resoluciones.EstatusID, r.Nombre as nameEstatus, mes, anio, Resoluciones.idUnidad,cu.nUnidad as unidad, f.nFiscalia as fiscalia, AgenteID, mp.nombre+' '+mp.paterno+' '+mp.materno as ministerioPublico
FROM Resoluciones 
INNER JOIN ESTADISTICAV2.dbo.CatUnidad cu ON cu.idUnidad = Resoluciones.idUnidad
INNER JOIN ESTADISTICAV2.dbo.CatFiscalia f ON f.idFiscalia = cu.idFiscalia
INNER JOIN ESTADISTICAV2.dbo.mp ON mp.idMp = Resoluciones.AgenteID
INNER JOIN PRUEBA.dbo.CatEstatusResoluciones r ON r.EstatusID = Resoluciones.EstatusID
WHERE CarpetaID IN($carpetaId) AND Resoluciones.EstatusID <> 1 AND anio >= 2019 
ORDER BY ResolucionID DESc ";



	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['EstatusID'];
		$arreglo[$indice][1]=$row['nameEstatus'];
		$arreglo[$indice][2]=$row['mes'];
		$arreglo[$indice][3]=$row['anio'];
		$arreglo[$indice][4]=$row['unidad'];
		$arreglo[$indice][5]=$row['fiscalia'];
		$arreglo[$indice][6]=$row['ministerioPublico'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}

}


function getDataXtipoResolucion($conn, $tipo, $mes, $anio, $idUnidad, $idMp, $deten){

	$query = " SELECT enc.idEstatusNucsCarpetas, enc.NUC, c.Expediente
	FROM estatusNucsCarpetas enc
	INNER JOIN PRUEBA.dbo.Carpeta c ON c.CarpetaID = enc.idCarpeta
	WHERE enc.idEstatus = $tipo AND enc.idUnidad =  $idUnidad AND enc.mes = $mes AND enc.anio = $anio AND enc.idMp = $idMp AND deten = $deten ";

	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['NUC'];
		$arreglo[$indice][1]=$row['Expediente'];
		$arreglo[$indice][2]=$row['idEstatusNucsCarpetas'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}


function getCountNucs($conn, $tipo, $mes, $anio, $idUnidad, $idMp, $deten){

	$query ="SELECT COUNT(idEstatusNucsCarpetas) as total FROM estatusNucsCarpetas WHERE idEstatus = $tipo AND anio = $anio AND idMp = $idMp AND mes = $mes AND idUnidad = $idUnidad AND deten = $deten";


	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['total'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}

}


function getNameEstReisolicion($conn, $estatus){

	$query ="   SELECT nombre FROM estatusCarpetasResoluciones WHERE EstatusID = $estatus ";

	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['nombre'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}

}



///// CONTAR EL TOTAL DE REGISTROS EN CARPETAS DATOS PARA SABER SI YA FUE INSERTADO ESE REGISTRO 

function countDataCarpe($conn, $mes, $anio, $idUnidad, $idMp){

	$query ="  SELECT idCarpetasDatos ,COUNT(idCarpetasDatos) as total FROM carpetasDatos WHERE idAnio = $anio AND idMes = $mes AND idUnidad = $idUnidad AND idMp = $idMp GROUP BY idCarpetasDatos";

	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['total'];
		$arreglo[$indice][1]=$row['idCarpetasDatos'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}

}


function getDatosCarpetas($conn, $mes, $anio, $idUnidad, $idMp){

	$query =" SELECT totalIniciadas, iniciadasConDetenido, iniciadasSinDetenido, recibidasPorOtraUnidad, enviadasUATP, enviadasUI, enviImpDes FROM carpetasDatos WHERE idMes = $mes AND idAnio = $anio AND idMp = $idMp AND idUnidad = $idUnidad	";

	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['iniciadasConDetenido'];
		$arreglo[$indice][1]=$row['iniciadasSinDetenido'];
		$arreglo[$indice][2]=$row['recibidasPorOtraUnidad'];
		$arreglo[$indice][3]=$row['enviadasUATP'];
		$arreglo[$indice][4]=$row['enviadasUI'];
		$arreglo[$indice][5]=$row['enviImpDes'];
		$arreglo[$indice][6]=$row['totalIniciadas'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}

}

function getDatosCarpetasV2AllUnidad($conn, $mes, $anio, $idUnidad){

	$query =" SELECT [idCarpetasDatos]
      ,[idMes]
      ,[idAnio]
      ,carpetasDatos.idUnidad
      ,carpetasDatos.idMp
	  ,mp.nombre+' '+mp.paterno+' '+mp.materno as ministerio
      ,[fechaInsert]
      ,[iniciadasConDetenido]
      ,[iniciadasSinDetenido]
      ,[totalIniciadas]
      ,[recibidasPorOtraUnidad]
      ,[enviadasUATP]
      ,[enviadasUI]
      ,[enviImpDes]
  FROM [ESTADISTICAV2].[dbo].[carpetasDatos] INNER JOIN mp ON mp.idMp = carpetasDatos.idMp WHERE idAnio = $anio AND idMes = $mes AND carpetasDatos.idUnidad $idUnidad	";

	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['iniciadasConDetenido'];
		$arreglo[$indice][1]=$row['iniciadasSinDetenido'];
		$arreglo[$indice][2]=$row['recibidasPorOtraUnidad'];
		$arreglo[$indice][3]=$row['enviadasUATP'];
		$arreglo[$indice][4]=$row['enviadasUI'];
		$arreglo[$indice][5]=$row['enviImpDes'];
		$arreglo[$indice][6]=$row['totalIniciadas'];
		$arreglo[$indice][7]=$row['idUnidad'];
		$arreglo[$indice][8]=$row['idMp'];
		$arreglo[$indice][9]=$row['ministerio'];

		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}

}



function getCapturadoMesAnioMPv2($conn, $mesCapturar, $anioCaptura, $idMp, $idUnidad){

	$query = " SELECT idCarpetasDatos FROM carpetasDatos WHERE idMes = $mesCapturar AND idAnio = $anioCaptura AND idMp = $idMp AND idUnidad = $idUnidad ";

	//(echo $query;

$stmt = sqlsrv_query(  $conn, $query,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
$row_count = sqlsrv_num_rows( $stmt );
	if($row_count > 0){	return 1; }else{return 0;}

}

function getEstatusCMASC($conCMASC, $nuc){

	$query = " SELECT top 1
										       ci.CarpetaIngresadaID
										      ,ci.FechaInicioSigi
										      ,ci.FechaIngreso
										      ,ci.Delito
										      ,ci.NUC
										      ,ci.MPCanalizador
										      ,ci.Unidad
										      ,ci.CarpetaRecibida
										      ,ci.MotivoRechazo
											     ,mr.Nombre
										      ,ci.Canalizador
										      ,ci.Fiscalia
										      ,ci.Municipio
										      ,ci.Observaciones
										      ,ci.FechaCarpetas
										      ,ci.Facilitador
										      ,ci.FechaLibro
										      ,ci.UsuarioID
										      ,ci.Prioridad
											FROM dbo.CarpetasIngresadas ci 
											LEFT JOIN cat.MotivoRechazo mr ON mr.MotivoID = ci.MotivoRechazo
											WHERE ci.FechaIngreso IN (SELECT max(FechaIngreso) FROM dbo.CarpetasIngresadas where NUC = '$nuc') AND ci.NUC = '$nuc' order BY ci.CarpetaIngresadaID desc ";
	

	$indice = 0;
	$stmt = sqlsrv_query($conCMASC, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['CarpetaIngresadaID'];
		$arreglo[$indice][1]=$row['FechaInicioSigi'];
		$arreglo[$indice][2]=$row['FechaIngreso'];
		$arreglo[$indice][3]=$row['Delito'];
		$arreglo[$indice][4]=$row['NUC'];
		$arreglo[$indice][5]=$row['MPCanalizador'];
		$arreglo[$indice][6]=$row['Unidad'];
		$arreglo[$indice][7]=$row['CarpetaRecibida'];
		$arreglo[$indice][8]=$row['MotivoRechazo'];
		$arreglo[$indice][9]=$row['Nombre'];
		$arreglo[$indice][10]=$row['Canalizador'];
		$arreglo[$indice][11]=$row['Fiscalia'];
		$arreglo[$indice][12]=$row['Municipio'];
		$arreglo[$indice][13]=$row['Observaciones'];
		$arreglo[$indice][14]=$row['FechaCarpetas'];
		$arreglo[$indice][15]=$row['Facilitador'];
		$arreglo[$indice][16]=$row['FechaLibro'];
		$arreglo[$indice][17]=$row['UsuarioID'];
		$arreglo[$indice][18]=$row['Prioridad'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}

}

 /* Función */
 function check_in_range($fechaInicialCaptura, $fechaLimiteCaptura, $fechaIngreso){
 	$fecha_inicio = strtotime($fechaInicialCaptura);
 	$fecha_fin = strtotime($fechaLimiteCaptura);
 	$fecha = strtotime($fechaIngreso);
 	if(($fecha >= $fecha_inicio) && ($fecha <= $fecha_fin))
 		return true;
 	else
 		return false;
 }



?>