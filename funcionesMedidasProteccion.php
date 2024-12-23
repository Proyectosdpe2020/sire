<?

function getCausaPenalNuc($conn, $nuc){

	$query = " SELECT estatusNucs.[idEstatusNucs], sj.causaPenal
	FROM [ESTADISTICAV2].[dbo].[estatusNucs] 
	INNER JOIN senap.judicializadas sj ON sj.idEstatusNucs = dbo.estatusNucs.idEstatusNucs
	WHERE nuc IN('$nuc') ";

	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idEstatusNucs'];
		$arreglo[$indice][1]=$row['causaPenal'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

function getCoorporacion($connMedidas) {
    $query = "
        SELECT idCatCoorporacion, nombre
        FROM medidas.catCoorporacion";
    $stmt = sqlsrv_prepare($connMedidas, $query);
    if ($stmt) {
        $result = sqlsrv_execute($stmt);
        if ($result) {
            $array = [];
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $array[] = $row; // Agregar cada fila al array
            }
            return $array;
        } else {
            $errors = sqlsrv_errors();
            return $errors;
        }
    } else {
        $errors = sqlsrv_errors();
        return $errors;
    }
}

function getDataMP($connMedidas, $rolUser, $idEnlace){
	if($rolUser != 4){
		$query = " SELECT
	               	  mp.idMp
	                 ,mp.nombre+' '+mp.paterno+' '+mp.materno AS nombreMP
		                ,mp.idUnidad
		                ,mp.idFiscalia
										  FROM SIRE.medidas.mp 
										  WHERE mp.estatus = 'VI' and mp.idUnidad = 1 ";
	}else{
		$query = " SELECT
	               	  mp.idMp
	                 ,mp.nombre+' '+mp.paterno+' '+mp.materno AS nombreMP
		                ,mp.idUnidad
		                ,mp.idFiscalia
										  FROM SIRE.medidas.mp 
										  WHERE mp.idEnlace = $idEnlace AND mp.estatus = 'VI' ";
	}
	
	$indice = 0;
	$stmt = sqlsrv_query($connMedidas, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idMp'];
		$arreglo[$indice][1]=$row['nombreMP'];
		$arreglo[$indice][2]=$row['idUnidad'];
		$arreglo[$indice][3]=$row['idFiscalia'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}
/*
function getDataMP2($conn){
	$query = " SELECT DISTINCT
																			mpUni.idMp 
																  ,mp.nombre+' '+mp.paterno+' '+mp.materno as nombreMP														  
															  FROM ESTADISTICAV2.dbo.mpUnidad mpUni
															  INNER JOIN dbo.mp mp ON mp.idMp = mpUni.idMp
															  INNER JOIN dbo.CatUnidad u ON u.idUnidad = mpUni.idUnidad
															  INNER JOIN dbo.enlace e ON e.idEnlace = mpUni.idEnlace
															  INNER JOIN dbo.CatUnidad cUniEn ON cUniEn.idUnidad = e.idUnidad
															  where mpUni.idFormato = 1 AND e.estatus = 'VI' ";
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idMp'];
		$arreglo[$indice][1]=$row['nombreMP'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}*/

function getDataAdscripcion($connMedidas, $agentesMP_id){
	$query = " SELECT 
											        mp.idUnidad
													  			,u.nombre AS nombreUnidad
												      ,mp.idFiscalia
													  			,f.nombre AS nombreFiscalia
												  FROM medidas.mp mp
												  INNER JOIN medidas.catUnidad u ON u.idUnidad = mp.idUnidad
												  INNER JOIN medidas.catFiscalias f ON f.catFiscaliasID = mp.idFiscalia
												  WHERE mp.idMp = $agentesMP_id ";
	$indice = 0;
	$stmt = sqlsrv_query($connMedidas, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idUnidad'];
		$arreglo[$indice][1]=$row['nombreUnidad'];
		$arreglo[$indice][2]=$row['idFiscalia'];
		$arreglo[$indice][3]=$row['nombreFiscalia'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

function dataFiscalias($connMedidas){
	$query = " SELECT  catFiscaliasID
													      ,nombre
													  FROM medidas.catFiscalias ";
	$indice = 0;
	$stmt = sqlsrv_query($connMedidas, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['catFiscaliasID'];
		$arreglo[$indice][1]=$row['nombre'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

//Obtiene el catalogo de delitos de SICAP
function dataDelitosSicap($conSic){
	$query = " SELECT CatModalidadesEstadisticasID, Nombre FROM PRUEBA.dbo.CatModalidadesEstadisticas ";
	$indice = 0;
	$stmt = sqlsrv_query($conSic, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['CatModalidadesEstadisticasID'];
		$arreglo[$indice][1]=$row['Nombre'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

function getDataGenerales($connMedidas, $idMedida, $tipoConsulta, $idCuadernoAntecedentes){
	if($tipoConsulta == 0){
		$query = " SELECT idCuadernoAntecedentes
																		,idMedida
												      ,cuadernoAntecedentes
												      ,temporalidad
												      ,fechaConclusion
												 FROM medidas.cuadernoAntecedentes where idMedida = $idMedida ";
	}else{
		$query = " SELECT idCuadernoAntecedentes
																		,idMedida
												      ,cuadernoAntecedentes
												      ,temporalidad
												      ,fechaConclusion
												 FROM medidas.cuadernoAntecedentes where idCuadernoAntecedentes = $idCuadernoAntecedentes ";
	}
	$indice = 0;
	$stmt = sqlsrv_query($connMedidas, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idCuadernoAntecedentes'];
		$arreglo[$indice][1]=$row['cuadernoAntecedentes'];
		$arreglo[$indice][2]=$row['temporalidad'];
		$arreglo[$indice][3]=$row['fechaConclusion'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

function getDataUnidad($connMedidas, $idFiscaliaProc){
	$query = " SELECT  idUnidad
													      ,nombre
													      ,estatus
													      ,catFiscaliaID
								    FROM medidas.catUnidad WHERE catFiscaliaID = $idFiscaliaProc ";
	$indice = 0;
	$stmt = sqlsrv_query($connMedidas, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idUnidad'];
		$arreglo[$indice][1]=$row['nombre'];
		$arreglo[$indice][2]=$row['estatus'];
		$arreglo[$indice][3]=$row['catFiscaliaID'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

function get_data_medida($connMedidas, $idMedida){
	$query = " SELECT  [idMedida]
													      ,[nuc]
													      ,[idMP]
													      ,[idUnidad]
													      ,[idFiscalia]
													      ,[idDelito]
													      ,[fechaAcuerdo]
													      ,[fechaRegistro]
													      ,[diaSemana]
													      ,[diaMes]
													      ,[mes]
													      ,[anio]
													      ,[idEnlace]
													      ,[idFiscaliaProcedencia]
													      ,[estatus]
														  ,[idCatCoorporacion]
													  FROM [SIRE].[medidas].[medidasProteccion] WHERE idMedida = $idMedida ";
	$indice = 0;
	$stmt = sqlsrv_query($connMedidas, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idUnidad'];
		$arreglo[$indice][1]=$row['nuc'];
		$arreglo[$indice][2]=$row['idMP'];
		$arreglo[$indice][3]=$row['idUnidad'];
		$arreglo[$indice][4]=$row['idFiscalia'];
		$arreglo[$indice][5]=$row['idDelito'];
		$arreglo[$indice][6]=$row['fechaAcuerdo']->format('Y-m-d H:i');
		$arreglo[$indice][7]=$row['fechaRegistro']->format('Y-m-d H:i');
		$arreglo[$indice][8]=$row['idEnlace'];
		$arreglo[$indice][9]=$row['idFiscaliaProcedencia'];
		$arreglo[$indice][11]=$row['estatus'];
		$arreglo[$indice][12]=$row['fechaAcuerdo']->format('Y-m-d');
		$arreglo[$indice][13]=$row['idCatCoorporacion'];

		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

function getDataVictimas($connMedidas, $idMedida){
	$query = " SELECT idVictima
												      ,idMedida
												      ,nombre
												      ,paterno
												      ,materno 
																  ,CASE 
																    WHEN genero = 1 THEN 'Masculino'
																				WHEN genero = 2 THEN 'Femenino'
																   ELSE 'Desconocido'
																   END genero
												      ,edad
												      ,nombre+' '+paterno+' '+materno as nombreConcat
												  FROM medidas.victimas WHERE idMedida = $idMedida ";
	$indice = 0;
	$stmt = sqlsrv_query($connMedidas, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idVictima'];
		$arreglo[$indice][1]=$row['idMedida'];
		$arreglo[$indice][2]=$row['nombre'];
		$arreglo[$indice][3]=$row['paterno'];
		$arreglo[$indice][4]=$row['materno'];
		$arreglo[$indice][5]=$row['genero'];
		$arreglo[$indice][6]=$row['edad'];
		$arreglo[$indice][7]=$row['nombreConcat'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

function getDataTestigos($connMedidas, $idMedida){
	$query = " SELECT [idTestigo]
	,[idMedida]
	,[NUC]
	,[causa]
	,[nombre]
	,[paterno]
	,[materno]
	,case when estadoMedida = 1 THEN 'Vigente' WHEN estadoMedida = 2 THEN 'Concluido' ELSE 'Desconocido' END as estadoMedida
	,[observaciones]
FROM [SIRE].[medidas].[testigo] WHERE idMedida = $idMedida ";
	$indice = 0;
	$stmt = sqlsrv_query($connMedidas, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idTestigo'];
		$arreglo[$indice][1]=$row['idMedida'];
		$arreglo[$indice][2]=$row['NUC'];
		$arreglo[$indice][3]=$row['causa'];
		$arreglo[$indice][4]=$row['nombre'];
		$arreglo[$indice][5]=$row['paterno'];
		$arreglo[$indice][6]=$row['materno'];
		$arreglo[$indice][7]=$row['estadoMedida'];
		$arreglo[$indice][8]=$row['observaciones'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

//Funcio para crear una nueva resolucion
function createResolucion($connMedidas, $idMedida){
	$query = "	INSERT INTO medidas.resoluciones (idMedida)
				VALUES (?)";
	$params = array($idMedida);
	$stmt = sqlsrv_query($connMedidas, $query, $params);
	if($stmt === false){
		die(print_r(sqlsrv_errors(), true));
	}
}

//Function para obtener idResoluciones
function getIdResoluciones($connMedidas, $idMedida){
	$query = "	SELECT [idResolucion]
				FROM medidas.resoluciones
				WHERE idMedida = ?";
	$params = array($idMedida);
	$stmt = sqlsrv_query($connMedidas, $query, $params);

	if($stmt === false){
		die(print_r(sqlsrv_errors(), true));
	}
	$row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
	if($row === null) return null;
	$array = array();
	$array[0] = $row['idResolucion'];

	return $array;
}

// Función para obtener los datos de las medidas que han sido ratificadas
function getRatificada($connMedidas, $idResolucion) {
    $query = "
        SELECT idRatificada, ratificada, observacion
        FROM medidas.ratificada
        WHERE idResolucion = ?";
    
    return executeResolucion($connMedidas, $idResolucion, $query);
}

// Función para obtener los datos de las medidas que han sido ampliadas
function getAmpliada($connMedidas, $idResolucion) {
    $query = "
        SELECT idAmpliada, ampliacion, observacion, temporalidadActual, fechaPrevia, fechaConclusion, temporalidadPrevia
        FROM medidas.ampliada
        WHERE idResolucion = ?";
    
    return executeResolucion($connMedidas, $idResolucion, $query);
}

// Función para obtener los datos de las medidas que han sido modificadas
function getModificada($connMedidas, $idResolucion) {
    $query = "
        SELECT idModificada, modificada, observacion, fechaPrevia, fechaConclusion, fraccionesPrevias, fraccionesActuales
        FROM medidas.modificada
        WHERE idResolucion = ?";
    
    return executeResolucion($connMedidas, $idResolucion, $query);
}

// Función para obtener los datos de las medidas que han sido revocadas
function getRevocada($connMedidas, $idResolucion) {
    $query = "
        SELECT idRevocada, revocada, observacion, fechaRevocada
        FROM medidas.revocada
        WHERE idResolucion = ?";
    
    return executeResolucion($connMedidas, $idResolucion, $query);
}

// Función para ejecutar código con idResolucion en la base de datos
function executeResolucion($connMedidas, $idResolucion, $query) {
    $params = [ [&$idResolucion, SQLSRV_PARAM_IN] ];

    $stmt = sqlsrv_prepare($connMedidas, $query, $params);

    if ($stmt && sqlsrv_execute($stmt)) {
        $array = [];
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $array[] = $row;
        }
        return $array;
    } else {
        $errors = sqlsrv_errors();
        return $errors;
    }
}

//Función para obtener cada una de las resoluciones existentes
function getDataResolucion($connMedidas, $idResolucion){
	$query ="
		SELECT 
			res.idResolucion, 
        	res.idMedida, 
       		COALESCE(a.ampliacion, 0) AS ampliada, 
       		COALESCE(r.revocada, 0) AS revocada, 
			COALESCE(ra.ratificada, 0) AS ratificada, 
       		COALESCE(m.modificada, 0) AS modificada
		FROM SIRE.medidas.resoluciones res
		LEFT JOIN (
			SELECT idResolucion, MAX(CASE WHEN ampliacion IS NOT NULL THEN ampliacion ELSE 0 END) as ampliacion
			FROM SIRE.medidas.ampliada
			GROUP BY idResolucion
		) a ON a.idResolucion = res.idResolucion
		LEFT JOIN (
			SELECT idResolucion, MAX(CASE WHEN revocada IS NOT NULL THEN revocada ELSE 0 END) as revocada
			FROM SIRE.medidas.revocada
			GROUP BY idResolucion
		) r ON r.idResolucion = res.idResolucion
		LEFT JOIN (
			SELECT idResolucion, MAX(CASE WHEN modificada IS NOT NULL THEN modificada ELSE 0 END) as modificada
			FROM SIRE.medidas.modificada
			GROUP BY idResolucion
		) m ON m.idResolucion = res.idResolucion
		LEFT JOIN (
			SELECT idResolucion, MAX(CASE WHEN ratificada IS NOT NULL THEN ratificada ELSE 0 END) as ratificada
			FROM SIRE.medidas.ratificada
			GROUP BY idResolucion
		) ra ON ra.idResolucion = res.idResolucion
		WHERE res.idResolucion = ?; ";

	$params = [ [&$idResolucion, SQLSRV_PARAM_IN] ];

	$stmt = sqlsrv_prepare($connMedidas, $query, $params);
	if($stmt && sqlsrv_execute($stmt)){
		$array = [];
		while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
			$array [] = $row;
		}
		return $array;
	}
	else{
		$errors = sqlsrv_errors();
		return $errors;
	}
}

//Funcion para obtener idMedida, idResolucion, resolucion y su observacion
function getDataResolucionesUnit($connMedidas, $idMedida, $idResolucion, $tipoResolucion) {
    $observacion = "observacion" . ucfirst($tipoResolucion);

    $query = "SELECT [$tipoResolucion], [$observacion]
              FROM medidas.resoluciones 
              WHERE idMedida = ?";
    
    // Preparar y ejecutar la consulta
    $params = array($idMedida);
    $stmt = sqlsrv_query($connMedidas, $query, $params);

    // Verificar si la consulta fue exitosa
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true)); // Mostrar errores de SQL Server
    }

    // Obtener la fila
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    
    // Verificar si se obtuvieron resultados
    if ($row === null) {
        return null; // O manejar el caso en que no se encuentren resultados
    }

    $arreglo = array();
    $arreglo[0] = $idResolucion;
    $arreglo[1] = $idMedida;
    $arreglo[2] = $tipoResolucion;
    $arreglo[3] = $row[$tipoResolucion];
    $arreglo[4] = $row[$observacion];

    return $arreglo;
}

//Funcion para obtener los documentos subidos en los seguimientos
function getFileSeguimientos($connMedidas, $idMedida) {
    $query = "SELECT [idSeguimiento], [nombre_archivo], [ruta_archivo]
              FROM medidas.seguimientos
              WHERE idMedida = ?";
    $params = array($idMedida);
    $stmt = sqlsrv_query($connMedidas, $query, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $arreglo = []; 
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $arreglo[] = [
            0 => $row['idSeguimiento'],
            1 => $row['nombre_archivo'],
            2 => $row['ruta_archivo']
        ];
    }

    return count($arreglo) > 0 ? $arreglo : null; // Devuelve null si no hay registros
}


function getDataResoluciones($connMedidas, $idMedida, $tipoConsulta, $idResolucion){
	if($tipoConsulta == 0){
		$query = " SELECT idResolucion
													      ,idMedida
													      ,CASE 
													           WHEN ratificacion = 1 THEN 'Sí'
													           WHEN ratificacion = 0 THEN 'No'
													          ELSE 'Desconocido'
													       END as ratificacion
													      ,CASE 
													           WHEN modificada = 1 THEN 'Sí'
													           WHEN modificada = 0 THEN 'No'
													          ELSE 'Desconocido'
													       END as modificada
														   ,CASE
														   		WHEN ampliada = 1 THEN 'Sí'
																WHEN ampliada = 0 THEN 'No'
																ELSE 'Desconocido'
															END as ampliada
															,CASE
																WHEN revocada = 1 THEN 'Sí'
																WHEN revocada = 0 THEN 'No'
																ELSE 'Desconocido'
															END as revocada
													      ,observacionRatificacion
													      ,observacionModificada
														  ,observacionAmpliada
														  ,observacionRevocada
													  FROM medidas.resoluciones where idMedida = $idMedida ";
	}else{
			$query = " SELECT idResolucion
													      ,idMedida
													      ,CASE 
													           WHEN ratificacion = 1 THEN 'Si'
													           WHEN ratificacion = 0 THEN 'No'
													          ELSE 'Desconocido'
													       END as ratificacion
													      ,CASE 
													           WHEN modificada = 1 THEN 'Si'
													           WHEN modificada = 0 THEN 'No'
													          ELSE 'Desconocido'
													       END as modificada
													      ,observacionRatificacion
													      ,observacionModificada
													  FROM medidas.resoluciones where idResolucion = $idResolucion ";
	}
	$indice = 0;
	$stmt = sqlsrv_query($connMedidas, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idResolucion'];
		$arreglo[$indice][1]=$row['idMedida'];
		$arreglo[$indice][2]='ratificacion';
		$arreglo[$indice][3]=$row['ratificacion'];
		$arreglo[$indice][4]=$row['observacionRatificacion'];
		$arreglo[$indice][5]='modificada';
		$arreglo[$indice][6]=$row['modificada'];		
		$arreglo[$indice][7]=$row['observacionModificada'];
		$arreglo[$indice][8]='ampliada';
		$arreglo[$indice][9]=$row['ampliada'];		
		$arreglo[$indice][10]=$row['observacionAmpliada'];
		$arreglo[$indice][11]='revocada';
		$arreglo[$indice][12]=$row['revocada'];
		$arreglo[$indice][13]=$row['observacionRevocada'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

function getDataEntidades($conSic){
	$query = " SELECT EntidadID
												      ,Nombre
												      ,Clave
												  FROM dbo.CatEntidades ";
	$indice = 0;
	$stmt = sqlsrv_query($conSic, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['EntidadID'];
		$arreglo[$indice][1]=$row['Nombre'];
		$arreglo[$indice][2]=$row['Clave'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

function getDataMunicipios($conSic, $idEntidad){
	$query = " SELECT MunicipioID
												      ,Nombre
												      ,Clave
												      ,EntidadID
												  FROM dbo.CatMunicipiosPais WHERE EntidadID = $idEntidad ";
	$indice = 0;
	$stmt = sqlsrv_query($conSic, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['MunicipioID'];
		$arreglo[$indice][1]=$row['Nombre'];
		$arreglo[$indice][2]=$row['Clave'];
		$arreglo[$indice][3]=$row['EntidadID'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

function getDataVictimasEditar($connMedidas, $idVictima){
	$query = " SELECT v.idVictima
												      ,v.idMedida
												      ,v.nombre
												      ,v.paterno
												      ,v.materno
												      ,v.genero
																  ,CASE 
																    WHEN v.genero = 1 THEN 'Masculino'
																				WHEN v.genero = 2 THEN 'Femenino'
																   ELSE 'Desconocido'
																   END AS generoN
												      ,v.edad
												      ,v.idEntidad
																  ,e.Nombre as nombreEntidad
															   ,v.idMunicipio
																  ,m.Nombre AS nombreMunicipio
															   ,v.colonia
															   ,v.calle
															   ,v.numero
															   ,v.telefono1
															   ,v.telefono2
															   ,v.codigoPostal
															   ,v.correo
															  FROM SIRE.medidas.victimas v
															  LEFT JOIN PRUEBA.dbo.CatEntidades e ON e.EntidadID = v.idEntidad
															  LEFT JOIN PRUEBA.dbo.CatMunicipiosPais m ON m.MunicipioID = v.idMunicipio 
															  WHERE idVictima = $idVictima ";
	$indice = 0;
	$stmt = sqlsrv_query($connMedidas, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idVictima'];
		$arreglo[$indice][1]=$row['idMedida'];
		$arreglo[$indice][2]=$row['nombre'];
		$arreglo[$indice][3]=$row['paterno'];
		$arreglo[$indice][4]=$row['materno'];
		$arreglo[$indice][5]=$row['genero'];
		$arreglo[$indice][6]=$row['generoN'];
		$arreglo[$indice][7]=$row['edad'];
		$arreglo[$indice][8]=$row['idEntidad'];
		$arreglo[$indice][9]=$row['nombreEntidad'];
		$arreglo[$indice][10]=$row['idMunicipio'];
		$arreglo[$indice][11]=$row['nombreMunicipio'];
		$arreglo[$indice][12]=$row['colonia'];
		$arreglo[$indice][13]=$row['calle'];
		$arreglo[$indice][14]=$row['numero'];
		$arreglo[$indice][15]=$row['telefono1'];
		$arreglo[$indice][16]=$row['telefono2'];
		$arreglo[$indice][17]=$row['codigoPostal'];
		$arreglo[$indice][18]=$row['correo'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

function checkDataContactoCompleted($connMedidas, $idVictima){
	$query = " SELECT ISNULL(idEntidad,0) AS dataContacto FROM medidas.victimas WHERE idVictima = $idVictima ";
	$indice = 0;
	$stmt = sqlsrv_query($connMedidas, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['dataContacto'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

function getDataImputados($connMedidas, $idMedida, $tipoConsulta, $idImputado){
	if($tipoConsulta == 0){
		$query = " SELECT imputadoID
												      ,idMedida
												      ,nombre
												      ,paterno
												      ,materno
												      ,genero
												      ,CASE 
												           WHEN genero = 1 THEN 'Masculino'
												           WHEN genero = 2 THEN 'Femenino'
												           WHEN genero = 3 THEN 'Desconocido'
												       ELSE 'Desconocido'
												       END AS generoN
												      ,edad
												      ,nombre+' '+paterno+' '+materno as nombreConcat
												  FROM medidas.imputados where idMedida = $idMedida ";
	}else{
		$query = " SELECT imputadoID
												      ,idMedida
												      ,nombre
												      ,paterno
												      ,materno
												      ,genero
												      ,CASE 
												           WHEN genero = 1 THEN 'Masculino'
												           WHEN genero = 2 THEN 'Femenino'
												           WHEN genero = 3 THEN 'Desconocido'
												       ELSE 'Desconocido'
												       END AS generoN
												      ,edad
												      ,nombre+' '+paterno+' '+materno as nombreConcat
												  FROM medidas.imputados where imputadoID = $idImputado ";
	}
	
	$indice = 0;
	$stmt = sqlsrv_query($connMedidas, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['imputadoID'];
		$arreglo[$indice][1]=$row['idMedida'];
		$arreglo[$indice][2]=$row['nombre'];
		$arreglo[$indice][3]=$row['paterno'];
		$arreglo[$indice][4]=$row['materno'];
		$arreglo[$indice][5]=$row['genero'];
		$arreglo[$indice][6]=$row['edad'];
		$arreglo[$indice][7]=$row['generoN'];
		$arreglo[$indice][8]=$row['nombreConcat'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

function getDataConstanciaLlamadas($connMedidas, $idMedida, $tipoConsulta, $idConstaciaLlamada){
	if($tipoConsulta == 0){
		$query = " SELECT idConstancia
													      ,idMedida
													      ,fecha
													      ,observaciones
													  FROM medidas.constanciaLlamadas where idMedida = $idMedida ";
	}else{
		$query = " SELECT idConstancia
													      ,idMedida
													      ,fecha
													      ,observaciones
													  FROM medidas.constanciaLlamadas where idConstancia = $idConstaciaLlamada ";
	}
	$indice = 0;
	$stmt = sqlsrv_query($connMedidas, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idConstancia'];
		$arreglo[$indice][1]=$row['idMedida'];
		$arreglo[$indice][2]=$row['fecha'];
		$arreglo[$indice][3]=$row['observaciones'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

function getMedidasAplicadasTest($connMedidas, $idMedida){
	$query = " SELECT  [idMedidasAplicadasTestigo]
	,[nuc]
	,[idMedida]
	,[idCatFraccion]
FROM [SIRE].[medidas].[medidasAplicadasTestigo] WHERE idMedida = $idMedida ";
	$indice = 0;
	$stmt = sqlsrv_query($connMedidas, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idCatFraccion'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}


function getMedidasAplicadas($connMedidas, $idMedida){
	$query = " SELECT idMedidaAplicada
												      ,idMedida
												      ,nuc
												      ,idCatFraccion
												  FROM medidas.medidasAplicadas WHERE idMedida = $idMedida ";
	$indice = 0;
	$stmt = sqlsrv_query($connMedidas, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idCatFraccion'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

function getFracciones($connMedidas, $fraccion){
	$query = " SELECT idCatFraccion
												      ,nombre
												      ,estatus
												  FROM medidas.catFracciones WHERE idCatFraccion = $fraccion ";
	$indice = 0;
	$stmt = sqlsrv_query($connMedidas, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['nombre'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

function get_data_medidas_dia($connMedidas, $numeroDia, $diames, $anio, $fiscalia, $idenlace, $mes, $rolUser){
	//CONSULTA PARA COORDINADOR DE MEDIDAS DE PROTECCION
	if($rolUser == 1){
		if($diames != 0){
				$query = " SELECT m.idMedida
															      ,m.nuc
															      ,m.idMP
																  			,mp.nombre+' '+mp.paterno+' '+mp.materno AS nombreMP
															      ,m.idUnidad
															      ,m.idFiscalia
															      ,m.idDelito
																 			 ,d.Nombre AS nombreDelito
															      ,m.fechaAcuerdo
															      ,m.fechaRegistro
															      ,m.diaSemana
															      ,m.diaMes
															      ,m.mes
															      ,m.anio
															      ,m.idEnlace
															      ,m.idFiscaliaProcedencia
																 				,f.nombre as nombreFiscProc
															      ,m.estatus
															      ,e.nombre+' '+e.apellidoPaterno+' '+e.apellidoMarterno AS nombreEnlace
															      ,m.fechaConclusion
															  FROM SIRE.medidas.medidasProteccion m
															  LEFT JOIN medidas.mp ON mp.idMp = m.idMP
															  INNER JOIN PRUEBA.dbo.CatModalidadesEstadisticas d ON d.CatModalidadesEstadisticasID = m.idDelito
															  INNER JOIN medidas.catFiscalias f ON f.catFiscaliasID = m.idFiscaliaProcedencia 
															  INNER JOIN ESTADISTICAV2.dbo.enlace e ON e.idEnlace = m.idEnlace
															  WHERE m.diaSemana = $numeroDia AND m.anio = $anio AND m.diaMes = $diames AND m.mes = $mes
															  order by m.idMedida desc ";
		}else{
			       $query = " SELECT m.idMedida
															      ,m.nuc
															      ,m.idMP
																  			,mp.nombre+' '+mp.paterno+' '+mp.materno AS nombreMP
															      ,m.idUnidad
															      ,m.idFiscalia
															      ,m.idDelito
																 			 ,d.Nombre AS nombreDelito
															      ,m.fechaAcuerdo
															      ,m.fechaRegistro
															      ,m.diaSemana
															      ,m.diaMes
															      ,m.mes
															      ,m.anio
															      ,m.idEnlace
															      ,m.idFiscaliaProcedencia
																 				,f.nombre as nombreFiscProc
															      ,m.estatus
															      ,e.nombre+' '+e.apellidoPaterno+' '+e.apellidoMarterno AS nombreEnlace
															      ,m.fechaConclusion
															  FROM SIRE.medidas.medidasProteccion m
															  LEFT JOIN medidas.mp ON mp.idMp = m.idMP
															  INNER JOIN PRUEBA.dbo.CatModalidadesEstadisticas d ON d.CatModalidadesEstadisticasID = m.idDelito
															  INNER JOIN medidas.catFiscalias f ON f.catFiscaliasID = m.idFiscaliaProcedencia 
															  INNER JOIN ESTADISTICAV2.dbo.enlace e ON e.idEnlace = m.idEnlace
															  WHERE m.anio = $anio  AND m.mes = $mes order by m.idMedida desc ";
		}
	}elseif($rolUser == 2){
		if($diames != 0){
				$query = "SET DATEFIRST 1  
				              SELECT m.idMedida
															      ,m.nuc
															      ,m.idMP
																  			,mp.nombre+' '+mp.paterno+' '+mp.materno AS nombreMP
															      ,m.idUnidad
															      ,m.idFiscalia
															      ,m.idDelito
																 			 ,d.Nombre AS nombreDelito
															      ,m.fechaAcuerdo
															      ,m.fechaRegistro
															      ,m.diaSemana
															      ,m.diaMes
															      ,m.mes
															      ,m.anio
															      ,m.idEnlace
															      ,m.idFiscaliaProcedencia
																 				,f.nombre as nombreFiscProc
															      ,m.estatus
															      ,e.nombre+' '+e.apellidoPaterno+' '+e.apellidoMarterno AS nombreEnlace
															      ,m.fechaConclusion
															  FROM SIRE.medidas.medidasProteccion m
															  LEFT JOIN medidas.mp ON mp.idMp = m.idMP
															  INNER JOIN PRUEBA.dbo.CatModalidadesEstadisticas d ON d.CatModalidadesEstadisticasID = m.idDelito
															  INNER JOIN medidas.catFiscalias f ON f.catFiscaliasID = m.idFiscaliaProcedencia 
															  INNER JOIN ESTADISTICAV2.dbo.enlace e ON e.idEnlace = m.idEnlace
															  WHERE DATEPART(dw, fechaRegistro) = $numeroDia AND DATEPART(year, fechaRegistro) = $anio AND DATEPART(day, fechaRegistro) = $diames AND DATEPART(month, fechaRegistro) = $mes AND m.idEnlace = $idenlace order by m.idMedida desc ";
		}else{
			       $query = " SET DATEFIRST 1
			                  SELECT m.idMedida
															      ,m.nuc
															      ,m.idMP
																  			,mp.nombre+' '+mp.paterno+' '+mp.materno AS nombreMP
															      ,m.idUnidad
															      ,m.idFiscalia
															      ,m.idDelito
																 			 ,d.Nombre AS nombreDelito
															      ,m.fechaAcuerdo
															      ,m.fechaRegistro
															      ,m.diaSemana
															      ,m.diaMes
															      ,m.mes
															      ,m.anio
															      ,m.idEnlace
															      ,m.idFiscaliaProcedencia
																 				,f.nombre as nombreFiscProc
															      ,m.estatus
															      ,e.nombre+' '+e.apellidoPaterno+' '+e.apellidoMarterno AS nombreEnlace
															      ,m.fechaConclusion
															  FROM SIRE.medidas.medidasProteccion m
															  LEFT JOIN medidas.mp ON mp.idMp = m.idMP
															  INNER JOIN PRUEBA.dbo.CatModalidadesEstadisticas d ON d.CatModalidadesEstadisticasID = m.idDelito
															  INNER JOIN medidas.catFiscalias f ON f.catFiscaliasID = m.idFiscaliaProcedencia 
															  INNER JOIN ESTADISTICAV2.dbo.enlace e ON e.idEnlace = m.idEnlace
															  WHERE DATEPART(year, fechaRegistro) = $anio  AND DATEPART(month, fechaRegistro) = $mes AND m.idEnlace = $idenlace order by m.idMedida desc ";
		}
	}elseif($rolUser == 3){
		if($diames != 0){
				$query = " SELECT m.idMedida
															      ,m.nuc
															      ,m.idMP
																  			,mp.nombre+' '+mp.paterno+' '+mp.materno AS nombreMP
															      ,m.idUnidad
															      ,m.idFiscalia
															      ,m.idDelito
																 			 ,d.Nombre AS nombreDelito
															      ,m.fechaAcuerdo
															      ,m.fechaRegistro
															      ,m.diaSemana
															      ,m.diaMes
															      ,m.mes
															      ,m.anio
															      ,m.idEnlace
															      ,m.idFiscaliaProcedencia
																 				,f.nombre as nombreFiscProc
															      ,m.estatus
															      ,e.nombre+' '+e.apellidoPaterno+' '+e.apellidoMarterno AS nombreEnlace
															      ,m.fechaConclusion
															  FROM SIRE.medidas.medidasProteccion m
															  LEFT JOIN medidas.mp ON mp.idMp = m.idMP
															  INNER JOIN PRUEBA.dbo.CatModalidadesEstadisticas d ON d.CatModalidadesEstadisticasID = m.idDelito
															  INNER JOIN medidas.catFiscalias f ON f.catFiscaliasID = m.idFiscaliaProcedencia 
															  INNER JOIN ESTADISTICAV2.dbo.enlace e ON e.idEnlace = m.idEnlace
															  WHERE m.diaSemana = $numeroDia AND m.anio = $anio AND m.diaMes = $diames AND m.mes = $mes AND mp.idEnlace = $idenlace order by m.idMedida desc ";
		}else{
			       $query = " SELECT m.idMedida
															      ,m.nuc
															      ,m.idMP
																  			,mp.nombre+' '+mp.paterno+' '+mp.materno AS nombreMP
															      ,m.idUnidad
															      ,m.idFiscalia
															      ,m.idDelito
																 			 ,d.Nombre AS nombreDelito
															      ,m.fechaAcuerdo
															      ,m.fechaRegistro
															      ,m.diaSemana
															      ,m.diaMes
															      ,m.mes
															      ,m.anio
															      ,m.idEnlace
															      ,m.idFiscaliaProcedencia
																 				,f.nombre as nombreFiscProc
															      ,m.estatus
															      ,e.nombre+' '+e.apellidoPaterno+' '+e.apellidoMarterno AS nombreEnlace
															      ,m.fechaConclusion
															  FROM SIRE.medidas.medidasProteccion m
															  LEFT JOIN medidas.mp ON mp.idMp = m.idMP
															  INNER JOIN PRUEBA.dbo.CatModalidadesEstadisticas d ON d.CatModalidadesEstadisticasID = m.idDelito
															  INNER JOIN medidas.catFiscalias f ON f.catFiscaliasID = m.idFiscaliaProcedencia 
															  INNER JOIN ESTADISTICAV2.dbo.enlace e ON e.idEnlace = m.idEnlace
															  WHERE m.anio = $anio  AND m.mes = $mes AND mp.idEnlace = $idenlace order by m.idMedida desc ";
		}
	}elseif($rolUser == 4){
		if($diames != 0){
				$query = " SELECT m.idMedida
															      ,m.nuc
															      ,m.idMP
																  			,mp.nombre+' '+mp.paterno+' '+mp.materno AS nombreMP
															      ,m.idUnidad
															      ,m.idFiscalia
															      ,m.idDelito
																 			 ,d.Nombre AS nombreDelito
															      ,m.fechaAcuerdo
															      ,m.fechaRegistro
															      ,m.diaSemana
															      ,m.diaMes
															      ,m.mes
															      ,m.anio
															      ,m.idEnlace
															      ,m.idFiscaliaProcedencia
																 				,f.nombre as nombreFiscProc
															      ,m.estatus
															      ,e.nombre+' '+e.apellidoPaterno+' '+e.apellidoMarterno AS nombreEnlace
															      ,m.fechaConclusion
															  FROM SIRE.medidas.medidasProteccion m
															  LEFT JOIN medidas.mp ON mp.idMp = m.idMP
															  INNER JOIN PRUEBA.dbo.CatModalidadesEstadisticas d ON d.CatModalidadesEstadisticasID = m.idDelito
															  INNER JOIN medidas.catFiscalias f ON f.catFiscaliasID = m.idFiscaliaProcedencia 
															  INNER JOIN ESTADISTICAV2.dbo.enlace e ON e.idEnlace = m.idEnlace
															  WHERE m.diaSemana = $numeroDia AND m.anio = $anio AND m.diaMes = $diames AND m.mes = $mes AND mp.idEnlace = $idenlace order by m.idMedida desc ";
		}else{
			       $query = " SELECT m.idMedida
															      ,m.nuc
															      ,m.idMP
																  			,mp.nombre+' '+mp.paterno+' '+mp.materno AS nombreMP
															      ,m.idUnidad
															      ,m.idFiscalia
															      ,m.idDelito
																 			 ,d.Nombre AS nombreDelito
															      ,m.fechaAcuerdo
															      ,m.fechaRegistro
															      ,m.diaSemana
															      ,m.diaMes
															      ,m.mes
															      ,m.anio
															      ,m.idEnlace
															      ,m.idFiscaliaProcedencia
																 				,f.nombre as nombreFiscProc
															      ,m.estatus
															      ,e.nombre+' '+e.apellidoPaterno+' '+e.apellidoMarterno AS nombreEnlace
															      ,m.fechaConclusion
															  FROM SIRE.medidas.medidasProteccion m
															  LEFT JOIN medidas.mp ON mp.idMp = m.idMP
															  INNER JOIN PRUEBA.dbo.CatModalidadesEstadisticas d ON d.CatModalidadesEstadisticasID = m.idDelito
															  INNER JOIN medidas.catFiscalias f ON f.catFiscaliasID = m.idFiscaliaProcedencia 
															  INNER JOIN ESTADISTICAV2.dbo.enlace e ON e.idEnlace = m.idEnlace
															  WHERE m.anio = $anio  AND m.mes = $mes AND mp.idEnlace = $idenlace order by m.idMedida desc ";
		}
	}
	$indice = 0;
	$stmt = sqlsrv_query($connMedidas, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idMedida'];
		$arreglo[$indice][1]=$row['nuc'];
		$arreglo[$indice][2]=$row['idMP'];
		$arreglo[$indice][3]=$row['nombreMP'];
		$arreglo[$indice][4]=$row['idUnidad'];
		$arreglo[$indice][5]=$row['idFiscalia'];
		$arreglo[$indice][6]=$row['idDelito'];
		$arreglo[$indice][7]=$row['nombreDelito'];
		$arreglo[$indice][8]=$row['fechaAcuerdo']->format('Y-m-d H:i');
		$arreglo[$indice][9]=$row['fechaRegistro']->format('Y-m-d H:i');
		$arreglo[$indice][10]=$row['diaSemana'];
		$arreglo[$indice][11]=$row['diaMes'];
		$arreglo[$indice][12]=$row['mes'];
		$arreglo[$indice][13]=$row['anio'];
		$arreglo[$indice][14]=$row['idEnlace'];
		$arreglo[$indice][15]=$row['idFiscaliaProcedencia'];
		$arreglo[$indice][16]=$row['nombreFiscProc'];
		$arreglo[$indice][17]=$row['estatus'];
		$arreglo[$indice][18]=$row['nombreEnlace'];
		$arreglo[$indice][19]=$row['fechaConclusion']->format('Y-m-d H:i');
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

function getDataAnio(){
	$arreglo[0][0]=2021;
	$arreglo[1][0]=2022;
	$arreglo[2][0]=2023;
	$arreglo[3][0]=2024;
	return $arreglo;
}

function getDiaMesnombre($fecha){

	$fechats = strtotime($fecha); 

	switch (date('w', $fechats)){

    case 0: return "Domingo"; break;
    case 1: return "Lunes"; break;
    case 2: return "Martes"; break;
    case 3: return "Miercoles"; break;
    case 4: return "Jueves"; break;
    case 5: return "Viernes"; break;
    case 6: return "Sabado"; break;
 } 
}

function get_type_archive($conn, $idEnlace){

	$query = "SELECT idTipoArchivo FROM usuario WHERE idEnlace = $idEnlace;";

							 $indice = 0;

								$stmt = sqlsrv_query($conn, $query);
								while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
								{
							
									$arreglo[$indice][0]=$row['idTipoArchivo'];							
									$indice++;
								}
								if(isset($arreglo)){return $arreglo;}	
}

function getDataDelitoMedida($connMedidas, $idMedida){
				$query = " SELECT m.idMedida
															      ,m.nuc
															      ,m.idDelito
																 			 ,d.Nombre AS nombreDelito
															  FROM SIRE.medidas.medidasProteccion m
															  INNER JOIN PRUEBA.dbo.CatModalidadesEstadisticas d ON d.CatModalidadesEstadisticasID = m.idDelito
															  WHERE m.idMedida =  $idMedida ";

	$indice = 0;
	$stmt = sqlsrv_query($connMedidas, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idMedida'];
		$arreglo[$indice][1]=$row['nuc'];
		$arreglo[$indice][2]=$row['idDelito'];
		$arreglo[$indice][3]=$row['nombreDelito'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

function getDataFracciones($connMedidas, $idMedida){
		$query = " SELECT idMedidaAplicada
														      ,idMedida
														      ,nuc
														      ,idCatFraccion
																		  ,CASE 
																		     WHEN idCatFraccion = 1 THEN 'I'
																			 WHEN idCatFraccion = 2 THEN 'II'
																			 WHEN idCatFraccion = 3 THEN 'III'
																			 WHEN idCatFraccion = 4 THEN 'IV'
																			 WHEN idCatFraccion = 5 THEN 'V'
																			 WHEN idCatFraccion = 6 THEN 'VI'
																			 WHEN idCatFraccion = 7 THEN 'VII'
																			 WHEN idCatFraccion = 8 THEN 'VIII'
																			 WHEN idCatFraccion = 9 THEN 'XI'
																			 WHEN idCatFraccion = 10 THEN 'X'
																			ELSE 'Sin asignar medida'
																			END as fraccionAsignada
														  FROM medidas.medidasAplicadas WHERE idMedida = $idMedida order by idCatFraccion ASC "; 

	$indice = 0;
	$stmt = sqlsrv_query($connMedidas, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['fraccionAsignada'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

//Funcion para checar si existen constancias de llamadas y colorar el estatus
function checkConstancia($connMedidas, $idMedida){
	$query = " SELECT COUNT(idMedida) AS totalConstancias FROM medidas.constanciaLlamadas where idMedida = $idMedida ";

	$indice = 0;
	$stmt = sqlsrv_query($connMedidas, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['totalConstancias'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

//Funcion para checar si existen victimas y colorar el estatus
function checkVictimas($connMedidas, $idMedida){
	$query = " SELECT COUNT(idMedida) as totalVictimas FROM medidas.victimas where idMedida = $idMedida ";

	$indice = 0;
	$stmt = sqlsrv_query($connMedidas, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[0]=$row['totalVictimas'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

//Funcion para checar si existen resoluciones y colorar el estatus
function checkResoluciones($connMedidas, $idMedida){
	$query = " SELECT count(idMedida) as totalResoluciones FROM medidas.resoluciones  where idMedida = $idMedida ";

	$indice = 0;
	$stmt = sqlsrv_query($connMedidas, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['totalResoluciones'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

//Funcion para checar si existen resoluciones y colorar el estatus
function checkMedidasAplicadas($connMedidas, $idMedida){
	$query = " SELECT count(idMedida) as totalMedidasAplicadas FROM medidas.medidasAplicadas  where idMedida = $idMedida ";

	$indice = 0;
	$stmt = sqlsrv_query($connMedidas, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['totalMedidasAplicadas'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

//Funcion para checar si existen resoluciones y colorar el estatus
function checkCuadernoAntecedentes($connMedidas, $idMedida){
	$query = " SELECT count(idMedida) as totalCuadernoAnte FROM medidas.cuadernoAntecedentes  where idMedida = $idMedida ";

	$indice = 0;
	$stmt = sqlsrv_query($connMedidas, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['totalCuadernoAnte'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

function getInfoEnlaceUsuarioMedidas($conn, $idUsuario){
	$query = "  SELECT u.idEnlace, e.idFiscalia FROM usuario u INNER JOIN enlace e ON e.idEnlace = u.idEnlace WHERE u.idUsuario = $idUsuario ";
//echo $query;
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

function get_type_archiveMedidas($conn, $idEnlace){
	$query = "SELECT idTipoArchivo FROM usuario WHERE idEnlace = $idEnlace;";
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC )){
		$arreglo[$indice][0]=$row['idTipoArchivo'];							
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	
}

//Funcion para obtener el rol del usuario
function getRolUser($connMedidas , $idEnlace){
	$query = " SELECT idEnlaceRol
												      ,idEnlace
												      ,idCatRol
												  FROM medidas.enlaceRol WHERE idEnlace = $idEnlace ";
	$indice = 0;
	$stmt = sqlsrv_query($connMedidas, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idCatRol'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

//Funcion para checar el total de carpetas faltantes de asignar a Ministerio Publico
function getCarpetasFaltante($connMedidas){
	$query = " SELECT count(idMP) AS totalPendientes
            FROM SIRE.medidas.medidasProteccion WHERE idUnidad = 0 AND idFiscalia = 0 AND idMP = 0 ";
	$indice = 0;
	$stmt = sqlsrv_query($connMedidas, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['totalPendientes'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

//Funcion para checar las carpetas pendientes de asignar a MP
function get_data_medidas_pendientes($connMedidas){
				$query = " SELECT m.idMedida
															      ,m.nuc
															      ,m.idMP
																  			,mp.nombre+' '+mp.paterno+' '+mp.materno AS nombreMP
															      ,m.idUnidad
															      ,m.idFiscalia
															      ,m.idDelito
																 			 ,d.Nombre AS nombreDelito
															      ,m.fechaAcuerdo
															      ,m.fechaRegistro
															      ,m.diaSemana
															      ,m.diaMes
															      ,m.mes
															      ,m.anio
															      ,m.idEnlace
															      ,m.idFiscaliaProcedencia
																 				,f.nombre as nombreFiscProc
															      ,m.estatus
															      ,e.nombre+' '+e.apellidoPaterno+' '+e.apellidoMarterno AS nombreEnlace
															  FROM SIRE.medidas.medidasProteccion m
															  LEFT JOIN medidas.mp ON mp.idMp = m.idMP
															  INNER JOIN PRUEBA.dbo.CatModalidadesEstadisticas d ON d.CatModalidadesEstadisticasID = m.idDelito
															  INNER JOIN medidas.catFiscalias f ON f.catFiscaliasID = m.idFiscaliaProcedencia 
															  INNER JOIN ESTADISTICAV2.dbo.enlace e ON e.idEnlace = m.idEnlace
															  WHERE m.idUnidad = 0 AND m.idFiscalia = 0 AND m.idMP = 0 ";
		
	$indice = 0;
	$stmt = sqlsrv_query($connMedidas, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idMedida'];
		$arreglo[$indice][1]=$row['nuc'];
		$arreglo[$indice][2]=$row['idMP'];
		$arreglo[$indice][3]=$row['nombreMP'];
		$arreglo[$indice][4]=$row['idUnidad'];
		$arreglo[$indice][5]=$row['idFiscalia'];
		$arreglo[$indice][6]=$row['idDelito'];
		$arreglo[$indice][7]=$row['nombreDelito'];
		$arreglo[$indice][8]=$row['fechaAcuerdo']->format('Y-m-d H:i');
		$arreglo[$indice][9]=$row['fechaRegistro']->format('Y-m-d H:i');
		$arreglo[$indice][10]=$row['diaSemana'];
		$arreglo[$indice][11]=$row['diaMes'];
		$arreglo[$indice][12]=$row['mes'];
		$arreglo[$indice][13]=$row['anio'];
		$arreglo[$indice][14]=$row['idEnlace'];
		$arreglo[$indice][15]=$row['idFiscaliaProcedencia'];
		$arreglo[$indice][16]=$row['nombreFiscProc'];
		$arreglo[$indice][17]=$row['estatus'];
		$arreglo[$indice][18]=$row['nombreEnlace'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

function getDataConcluida($connMedidas, $idMedida){
	$query = " SELECT fechaConclusion
												FROM medidas.cuadernoAntecedentes where idMedida = $idMedida ";
	$indice = 0;
	$stmt = sqlsrv_query($connMedidas, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		if($row['fechaConclusion'] == null){
			$arreglo[$indice][0]=0;
		}else{
			$arreglo[$indice][0]=$row['fechaConclusion']->format('Y-m-d H:i');
		}
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

function checkFechaConclusion($fechaConclusion){
	$fechaActual = date('Y-m-d H:i');
	if($fechaConclusion == '1900-01-01 00:00'){
		return 'NOTRABAJADA';
	}else{
		if(	$fechaActual > $fechaConclusion){			
			return 'CONCLUIDA';
		}else{
			return 'ACTIVA';
		}
	}
}

function modificarMedidasAplicadas($connMedidas, $idMedida){
	$query = " SELECT ma.idMedidaAplicada
												      ,ma.idMedida
																  ,ma.nuc
																  ,ma.idCatFraccion
																  ,CASE 
																		  WHEN ma.idCatFraccion = 1 THEN 'I'
																			 WHEN ma.idCatFraccion = 2 THEN 'II'
																			 WHEN ma.idCatFraccion = 3 THEN 'III'
																			 WHEN ma.idCatFraccion = 4 THEN 'IV'
																			 WHEN ma.idCatFraccion = 5 THEN 'V'
																			 WHEN ma.idCatFraccion = 6 THEN 'VI'
																			 WHEN ma.idCatFraccion = 7 THEN 'VII'
																			 WHEN ma.idCatFraccion = 8 THEN 'VIII'
																			 WHEN ma.idCatFraccion = 9 THEN 'XI'
																			 WHEN ma.idCatFraccion = 10 THEN 'X'
																			ELSE 'Sin asignar medida'
																			END as fraccionAsignada
																  ,cf.nombre
															FROM medidas.medidasAplicadas ma
															INNER JOIN medidas.catFracciones cf ON cf.idCatFraccion = ma.idCatFraccion
															WHERE idMedida = $idMedida ";
	$indice = 0;
	$stmt = sqlsrv_query($connMedidas, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idMedidaAplicada'];
		$arreglo[$indice][1]=$row['idMedida'];
		$arreglo[$indice][2]=$row['nuc'];
		$arreglo[$indice][3]=$row['idCatFraccion'];
		$arreglo[$indice][4]=$row['nombre'];
		$arreglo[$indice][5]=$row['fraccionAsignada'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

function checkEdad($edad){
	if($edad > 0){
		return "Años";
	}elseif($edad == 0){
		return "Desconocida";
	}elseif($edad < 0){
		return "Meses";
	}
}

function convertirARomanos($numero) {
    $mapa = array(
        'M' => 1000,
        'CM' => 900,
        'D' => 500,
        'CD' => 400,
        'C' => 100,
        'XC' => 90,
        'L' => 50,
        'XL' => 40,
        'X' => 10,
        'IX' => 9,
        'V' => 5,
        'IV' => 4,
        'I' => 1
    );
    $resultado = '';
    foreach ($mapa as $romano => $valor) {
        $matches = intval($numero / $valor);
        $resultado .= str_repeat($romano, $matches);
        $numero = $numero % $valor;
    }
    return $resultado;
}