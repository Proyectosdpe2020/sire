<? 

function getUnidadesFiscalias($conn, $idFiscalia){
		$query = " SELECT idUnidad, idFiscalia,nUnidad FROM CatUnidad WHERE idFiscalia = $idFiscalia AND idUnidad NOT IN(158,161,157,166,159,164,75,163,160,162) ";
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

function getUnidadesFiscaliasLiti($conn, $idFiscalia){
		$query = " SELECT idUnidad, idFiscalia,nUnidad FROM CatUnidad WHERE idFiscalia = $idFiscalia AND idUnidad IN(158,161,157,166,159,164,75,163,160,162) ";

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
/// IGUAL QUE LA DE ABAJO PERO SIN IDTIPOARCHIVO
function dataUnidadEnlaceFormat2($conn, $idEnlace){

		$query = " SELECT distinct usuario.idEnlace,[areaNombre], e.idUnidad, cu.nUnidad ,f.idFiscalia, usuario.idTipoArchivo
FROM [ESTADISTICAV2].[dbo].[usuario] INNER JOIN enlace e ON e.idEnlace = usuario.idEnlace INNER JOIN CatFiscalia f ON f.idFiscalia = e.idFiscalia INNER JOIN CatUnidad cu ON cu.idUnidad = e.idUnidad 
WHERE usuario.idEnlace = $idEnlace AND usuario.estatus = 'VI' AND idUsuario NOT IN(206,215,230) ORDER BY  areaNombre,idFiscalia  ";

		$indice = 0;
		$stmt = sqlsrv_query($conn, $query);
		while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
		{
			$arreglo[$indice][0]=$row['idEnlace'];
			$arreglo[$indice][1]=$row['idUnidad'];
			$arreglo[$indice][2]=$row['idFiscalia'];
			$arreglo[$indice][3]=$row['idTipoArchivo'];
			$arreglo[$indice][4]=$row['nUnidad'];
			$indice++;
		}
		if(isset($arreglo)){return $arreglo;}
}


function dataUnidadEnlaceFormat($conn, $idEnlace, $idFormato){

		$query = " SELECT distinct usuario.idEnlace,[areaNombre], e.idUnidad, cu.nUnidad ,f.idFiscalia, usuario.idTipoArchivo
FROM [ESTADISTICAV2].[dbo].[usuario] INNER JOIN enlace e ON e.idEnlace = usuario.idEnlace INNER JOIN CatFiscalia f ON f.idFiscalia = e.idFiscalia INNER JOIN CatUnidad cu ON cu.idUnidad = e.idUnidad 
WHERE idTipoArchivo IN($idFormato) AND usuario.idEnlace = $idEnlace AND usuario.estatus = 'VI' AND idUsuario NOT IN(206,215,230) ORDER BY  areaNombre,idFiscalia  ";



		$indice = 0;
		$stmt = sqlsrv_query($conn, $query);
		while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
		{
			$arreglo[$indice][0]=$row['idEnlace'];
			$arreglo[$indice][1]=$row['idUnidad'];
			$arreglo[$indice][2]=$row['idFiscalia'];
			$arreglo[$indice][3]=$row['idTipoArchivo'];
			$arreglo[$indice][4]=$row['nUnidad'];
			$indice++;
		}
		if(isset($arreglo)){return $arreglo;}
}


function mpExperienciaLit($conn, $idMp){
		$query = " SELECT COUNT(idLitigacion) as total FROM Litigacion WHERE idMp = $idMp ";
		$indice = 0;
		$stmt = sqlsrv_query($conn, $query);
		while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
		{
			$arreglo[$indice][0]=$row['total'];
			$indice++;
		}
		if(isset($arreglo)){return $arreglo;}
}


function mpExperienciaCarp($conn, $idMp){
		$query = " SELECT COUNT(idCarpetas) as total FROM Carpetas WHERE idMp = $idMp ";
		$indice = 0;
		$stmt = sqlsrv_query($conn, $query);
		while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
		{
			$arreglo[$indice][0]=$row['total'];
			$indice++;
		}
		if(isset($arreglo)){return $arreglo;}
}

function getDataMpsSearch($conn, $names, $paterns, $materns){
		$query = "  SELECT TOP 30 idMp, nombre, paterno, materno FROM mp WHERE nombre LIKE '$names%' AND paterno LIKE '$paterns%' and materno LIKE '$materns%' ORDER BY nombre";
		$indice = 0;
		$stmt = sqlsrv_query($conn, $query);
		while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
		{
			$arreglo[$indice][0]=$row['idMp'];
			$arreglo[$indice][1]=$row['nombre'];
			$arreglo[$indice][2]=$row['paterno'];
			$arreglo[$indice][3]=$row['materno'];
			$indice++;
		}
		if(isset($arreglo)){return $arreglo;}
}


function getFormatsFromEnlacs($conn, $idEnlace){
		$query = "SELECT idEnlace, idFormtato FROM [ESTADISTICAV2].[dbo].[enlaceFormato] WHERE idEnlace IN($idEnlace) AND idFormtato IN(1,4) ORDER BY idEnlace";
		$indice = 0;
		$stmt = sqlsrv_query($conn, $query);
		while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
		{
			$arreglo[$indice][0]=$row['idEnlace'];
			$arreglo[$indice][1]=$row['idFormtato'];
			$indice++;
		}
		if(isset($arreglo)){return $arreglo;}
}


function getInfoEnlacesCarpetas($conn, $formato){

		$query = "SELECT   idEnlace,nombre, apellidoPaterno, apellidoMarterno, correo, estatus, telefono, idFormato, e.idUnidad as idunidad, cu.nUnidad as nomunidad, cf.nFiscalia2 as nomFis
FROM   enlace e INNER JOIN CatUnidad cu ON cu.idUnidad = e.idUnidad 
INNER JOIN CatFiscalia cf ON cf.idFiscalia = cu.idFiscalia
AND e.idFormato = $formato";

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
			$arreglo[$indice][8]=$row['idunidad'];
			$arreglo[$indice][9]=$row['nomunidad'];
			$arreglo[$indice][10]=$row['nomFis'];
			$indice++;
		}
		if(isset($arreglo)){return $arreglo;}

}


function getTEnlacesVICarpLiti($conn){

	$query = " SELECT distinct idEnlace,[areaNombre] FROM [ESTADISTICAV2].[dbo].[usuario] WHERE idTipoArchivo IN(1,4) AND estatus = 'VI' AND idUsuario NOT IN(206,215,230) ORDER BY  areaNombre "; // LOS ID QUE ESTAN EN EL NOT IN ES POR QUE SON USUARIOS DE CONSULTA

							 $indice = 0;

								$stmt = sqlsrv_query($conn, $query);
								while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
								{
							
									$arreglo[$indice][0]=$row['idEnlace'];				
									$arreglo[$indice][1]=$row['areaNombre'];	
									$indice++;
								}
								if(isset($arreglo)){return $arreglo;}	
}


function getTramiteMp($conn, $idUnidad, $anio, $idMp){

	$query = " SELECT TOP 1 [idCarpetas],[fecha],[idMes],[idAnio],[idUnidad],[existenciaAnterior],[tramite],[idMp]
  FROM [ESTADISTICAV2].[dbo].[Carpetas] WHERE idUnidad = $idUnidad AND idAnio = $anio AND idMp = $idMp ORDER BY idCarpetas DESC ";

							 $indice = 0;

								$stmt = sqlsrv_query($conn, $query);
								while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
								{
							
									$arreglo[$indice][0]=$row['idCarpetas'];				
									$arreglo[$indice][1]=$row['existenciaAnterior'];	
									$arreglo[$indice][2]=$row['tramite'];	
									$indice++;
								}
								if(isset($arreglo)){return $arreglo;}	
}

function getTramiteMpLiti($conn, $idUnidad, $anio, $idMp){

	$query = " SELECT TOP 1 [idLitigacion],[idUnidad],[idMes],[idAnio],[idFiscalia]
      ,[existenciaAnterior]
      ,[totalJudicializadasTramite]   
      ,[idMp]
  FROM [ESTADISTICAV2].[dbo].[Litigacion] WHERE idUnidad = $idUnidad AND idAnio = $anio AND idMp = $idMp  ORDER BY idLitigacion DESC ";

							 $indice = 0;

								$stmt = sqlsrv_query($conn, $query);
								while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
								{
							
									$arreglo[$indice][0]=$row['idLitigacion'];				
									$arreglo[$indice][1]=$row['existenciaAnterior'];	
									$arreglo[$indice][2]=$row['totalJudicializadasTramite'];	
									$indice++;
								}
								if(isset($arreglo)){return $arreglo;}	
}



function getDataMPsMovCarp($conn, $idEnlace, $idFormato){

	$query = " SELECT idMpUnidad,mpUnidad.idMp,mp.nombre+' '+mp.paterno+' '+mp.materno as nomCompleto,mpUnidad.idUnidad,cu.nUnidad,idEnlace,idFormato
  FROM [ESTADISTICAV2].[dbo].[mpUnidad] INNER JOIN mp ON mp.idMp = mpUnidad.idMp INNER JOIN CatUnidad cu ON cu.idUnidad = mpUnidad.idUnidad
  WHERE mpUnidad.idEnlace = $idEnlace AND mpUnidad.idFormato = $idFormato  ORDER BY idMp ";

							 $indice = 0;

								$stmt = sqlsrv_query($conn, $query);
								while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
								{
							
									$arreglo[$indice][0]=$row['idMpUnidad'];							
									$arreglo[$indice][1]=$row['idMp'];	
									$arreglo[$indice][2]=$row['nomCompleto'];
									$arreglo[$indice][3]=$row['idUnidad'];	
									$arreglo[$indice][4]=$row['nUnidad'];
									$arreglo[$indice][5]=$row['idFormato'];		
									$indice++;
								}
								if(isset($arreglo)){return $arreglo;}	
}

function getDataMPsMovLit($conn, $idEnlace, $idFormato){

	$query = " SELECT idMpUnidad,mpUnidad.idMp,mp.nombre+' '+mp.paterno+' '+mp.materno as nomCompleto,mpUnidad.idUnidad,cu.nUnidad,idEnlace,idFormato
  FROM [ESTADISTICAV2].[dbo].[mpUnidad] INNER JOIN mp ON mp.idMp = mpUnidad.idMp INNER JOIN CatUnidad cu ON cu.idUnidad = mpUnidad.idUnidad
  WHERE mpUnidad.idEnlace = $idEnlace AND mpUnidad.idFormato = $idFormato  ORDER BY idMp ";

							 $indice = 0;

								$stmt = sqlsrv_query($conn, $query);
								while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
								{
							
									$arreglo[$indice][0]=$row['idMpUnidad'];							
									$arreglo[$indice][1]=$row['idMp'];	
									$arreglo[$indice][2]=$row['nomCompleto'];
									$arreglo[$indice][3]=$row['idUnidad'];	
									$arreglo[$indice][4]=$row['nUnidad'];
									$arreglo[$indice][5]=$row['idFormato'];		
									$indice++;
								}
								if(isset($arreglo)){return $arreglo;}	
}


?>