<?
//Funcion que obtiene el expediente del nuc para la variable ID_Seguimiento del casos
function getNucExpedienteSicap($conSics, $nuc){
	$query = "SELECT Expediente  From Carpeta WHERE NUC = $nuc"; 
	$indice = 0;
	$stmt = sqlsrv_query($conSics, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['Expediente'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	
}	

//Funcion que obtiene el catalogo de Etapa Procesal para la variable con ID: 6.1.2
function getEtapaProcesal($conSic){
	$query = "SELECT * FROM CatEtapasProcesales "; 
	$indice = 0;
	$stmt = sqlsrv_query($conSic, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['CatEtapaProcesalID'];
		$arreglo[$indice][1]=$row['Nombre'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	
}	

//Funcion que obtiene el catalogo de opciones Dictonomicas para variables en general.
function getOptionDictonomica($conn){
	$query = "SELECT * FROM senap.CatOpcDicto"; 
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idOpcion'];
		$arreglo[$indice][1]=$row['opcion'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	
}

//Funcion que obtiene el catalogo el catalogo de Tipos de Acuerdos Reparatorios para la variable con ID: 6.1.5
function getTipoAcuerdoRep($conSic){
	$query = "SELECT * FROM CatAcuerdosReparatorios "; 
	$indice = 0;
	$stmt = sqlsrv_query($conSic, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['CatAcuerdoReparatoriosID'];
		$arreglo[$indice][1]=$row['Nombre'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	
}

//Función que obtiene el catalogo de tipos de Criterios de Oportunidad para la variable con ID: 6.1.8
function getTipoCriterioOportunidad($conSic){
	$query = "SELECT * FROM CatCriteriosOportunidad "; 
	$indice = 0;
	$stmt = sqlsrv_query($conSic, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['CatCriterioOportunidadID'];
		$arreglo[$indice][1]=$row['Nombre'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	
}

//Función que obtiene el catalogo de tipos de Motivos de no celebracion de Audiencia Inicial para la variable con ID: 6.2.4
function getMotivoNoAudienciaInicial($conSic){
	$query = "SELECT * FROM CatMotivosAudienciaInicial "; 
	$indice = 0;
	$stmt = sqlsrv_query($conSic, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['CatMotivoAudienciaInicialID'];
		$arreglo[$indice][1]=$row['Nombre'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	
}

//Función que obtiene el catalogo de Resolución del auto de vinculación a proceso para la variable con ID: 6.2.8
function getResolAutoVincu($conn){
	$query = "SELECT * FROM senap.CatResolAutoVincu WHERE estatus = 'VI' "; 
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idResolAutoVinculacion'];
		$arreglo[$indice][1]=$row['nombre'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	
}

//Función que obtiene el catalogo de Tipos de Medidas Cautelares Impuestas para la variable con ID: 6.2.11
function getTipoMedCautelar($conSic){
	$query = "SELECT * FROM CatTipoMedidasCautelares  "; 
	$indice = 0;
	$stmt = sqlsrv_query($conSic, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['CatTipoMedidaCautelarID'];
		$arreglo[$indice][1]=$row['Nombre'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	
}

//Función que obtiene el catalogo de Tipos de pruebas para la variable con ID: 6.3.5
function getTipoMedioPrueba($conSic){
	$query = "SELECT * FROM CatMediosPrueba "; 
	$indice = 0;
	$stmt = sqlsrv_query($conSic, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['CatMedioPruebaID'];
		$arreglo[$indice][1]=$row['Nombre'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	
}

//Función que obtiene el catalogo de Autoridad que deriva al MASC para la variable con ID: 6.4.2
function getAutoridadMASC($conn){
	$query = "SELECT * FROM senap.catAutoridadMASC WHERE estatus = 'VI' "; 
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idAutoridadMASC'];
		$arreglo[$indice][1]=$row['nombre'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	
}

//Función que obtiene el catalogo de Tipo MASC para la variable con ID: 6.4.4
function getTipoMASC($conSic){
	$query = "SELECT * FROM CatTipoMASC  "; 
	$indice = 0;
	$stmt = sqlsrv_query($conSic, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['CatTipoMASCID'];
		$arreglo[$indice][1]=$row['Nombre'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	
}

//Función que obtiene el catalogo de Tipo Cumplimineto para la variable con ID: 6.4.6
function getTipoCumplimiento($conn){
	$query = "SELECT * FROM senap.CatTipoCumplimiento WHERE estatus = 'VI' "; 
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idTipoCumplimiento'];
		$arreglo[$indice][1]=$row['nombre'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	
}

//Función que obtiene el catalogo de etapa en la que se dictó el sobreseimiento para la variable con ID: 6.5.1
function getEtapaSobreseimiento($conSic){
	$query = "SELECT * FROM CatEtapasProcesales "; 
	$indice = 0;
	$stmt = sqlsrv_query($conSic, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['CatEtapaProcesalID'];
		$arreglo[$indice][1]=$row['Nombre'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	
}

//Función que obtiene el catalogo de Cusas de sobreseimiento para la variable con ID: 6.5.2
function getCausasSobreseimiento($conSic){
	$query = "SELECT * FROM CatCausasSobresedimiento "; 
	$indice = 0;
	$stmt = sqlsrv_query($conSic, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['CatCausaSobresedimientoID'];
		$arreglo[$indice][1]=$row['Nombre'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	
}

//Función que obtiene el catalogo de Cusas de sobreseimiento para la variable con ID: 6.5.2
function getTipoSobreseimiento($conn){
	$query = "SELECT * FROM senap.CatTipoSobreseimiento WHERE estatus = 'VI' "; 
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idTipoSobreseimiento'];
		$arreglo[$indice][1]=$row['nombre'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	
}

//Función que obtiene el catalogo de Etapa en la que se dictó  la suspensión condicional del proceso para la variable con ID: 6.6.3
function getEtapaSuspCondProc($conSic){
	$query = "SELECT * FROM CatEtapasProcesales "; 
	$indice = 0;
	$stmt = sqlsrv_query($conSic, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['CatEtapaProcesalID'];
		$arreglo[$indice][1]=$row['Nombre'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	
}

//Función que obtiene el catalogo de Tipo de condiciones impuestas durante la suspensión condicional del proceso para la variable con ID: 6.6.4
function getCondImpuSuspConProc($conSic){
	$query = "SELECT * FROM CatTipoCondicionesImpuestas "; 
	$indice = 0;
	$stmt = sqlsrv_query($conSic, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['CatTipoCondicionImpuestaID'];
		$arreglo[$indice][1]=$row['Nombre'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	
}

//Función que obtiene el catalogo de Tipos de pruebas desahogadas durante la audiencia de juicio para la variable con ID: 6.7.2
function getPruebasAudienciaJuicio($conSic){
	$query = "SELECT * FROM CatTipoPruebasDesahogadas "; 
	$indice = 0;
	$stmt = sqlsrv_query($conSic, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['CatTipoPruebaDesahogadaID'];
		$arreglo[$indice][1]=$row['Nombre'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	
}

//Función que obtiene el catalogo de Tipos desentencia para la variable con ID: 6.8.4
function getTipoSentencia($conSic){
	$query = "SELECT * FROM senap.CatTipoSentencia WHERE estatus = 'VI' "; 
	$indice = 0;
	$stmt = sqlsrv_query($conSic, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idTipoSentencia'];
		$arreglo[$indice][1]=$row['nombre'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	
}


?>