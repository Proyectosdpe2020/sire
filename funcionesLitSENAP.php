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

//Funcion para obtener la informacion de SENAP sobre fecha de la formulación de la imputación
function getDataFechaFormImpu($conn, $idEstatusNucs){
	$query = "SELECT * FROM senap.formulacionesImputacion WHERE idEstatusNucs = '$idEstatusNucs' "; 
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idFechaFormuImpu'];
		$arreglo[$indice][1]=$row['idEstatusNucs'];
		$arreglo[$indice][2]=$row['fechaFormulacion'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

//Funcion para obtener la información de SENAP sobre fecha del auto de vinculacion a proceso
function getDataFechaAutoVincuProc($conn, $idResolMP){
	$query = "SELECT * FROM senap.autoVincuProc WHERE ResolucionID = '$idResolMP' "; 
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idAutoVincuProc'];
		$arreglo[$indice][1]=$row['ResolucionID'];
		$arreglo[$indice][2]=$row['fechaAutoVincuProc'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

//Funcion para obtener la información de SENAP sobre Medidas Cautelares
function getDataMedidaCautelar($conn, $idEstatusNucs){
 $query = "SELECT * FROM senap.medidaCautelar WHERE idEstatusNucs = '$idEstatusNucs' "; 
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idMedidaCautelar'];
		$arreglo[$indice][1]=$row['idEstatusNucs'];
		$arreglo[$indice][2]=$row['fechaCierreInvest'];
		$arreglo[$indice][3]=$row['formulacionAcusacion'];
		$arreglo[$indice][4]=$row['fechaEscritoAcusacion'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

//Función para obtener la información de SENAP sobre Audiencias Intermedias
function getDataAudienciaIntermedia($conn, $idEstatusNucs){
	 $query = "SELECT * FROM senap.audienciasIntermedias WHERE idEstatusNucs = '$idEstatusNucs' "; 
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idAudienciasIntermedias'];
		$arreglo[$indice][1]=$row['idEstatusNucs'];
		$arreglo[$indice][2]=$row['fechaAudienciaIntermedia'];
		$arreglo[$indice][3]=$row['mediosDePrueba'];
		$arreglo[$indice][4]=$row['idTipoMedioPrueba'];
		$arreglo[$indice][5]=$row['acuerdoProbatorio'];
		$arreglo[$indice][6]=$row['aperturaJuicioOral'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

//Función para obtener la información de SENAP sobre sobreseimientos
function getDataSobreseimientos($conn, $idEstatusNucs){
	 $query = "SELECT * FROM senap.sobreseimientos WHERE idEstatusNucs = '$idEstatusNucs' "; 
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idSobreseimientos'];
		$arreglo[$indice][1]=$row['idEstatusNucs'];
		$arreglo[$indice][2]=$row['fechaDictoSobreseimiento'];
		$arreglo[$indice][3]=$row['idTipoSobreseimiento'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

//Función para obtener la información de SENAP sobre suspención condicional del proceso
function getDataSuspCondProc($conn, $idEstatusNucs){
	 $query = "SELECT * FROM senap.suspCondProc WHERE idEstatusNucs = '$idEstatusNucs' "; 
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idSuspCondProc'];
		$arreglo[$indice][1]=$row['idEstatusNucs'];
		$arreglo[$indice][2]=$row['fechaDictoSuspCondProc'];
		$arreglo[$indice][3]=$row['idEtapaSuspCondProc'];
		$arreglo[$indice][4]=$row['idTipoCondImpuSuspConProc'];
		$arreglo[$indice][5]=$row['reaperturaProc'];
		$arreglo[$indice][6]=$row['fechaReaperProc'];
		$arreglo[$indice][7]=$row['fechaCumplimentoSuspCondPro'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

//Función para obtener la información de SENAP sobre Audiencias de Juicio
function getDataAudienciasDeJuicio($conn, $idEstatusNucs){
	 $query = "SELECT * FROM senap.audienciasJuicio WHERE idEstatusNucs = '$idEstatusNucs' "; 
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idAudienciaJuicio'];
		$arreglo[$indice][1]=$row['idEstatusNucs'];
		$arreglo[$indice][2]=$row['fechaAudienciaJuicio'];
		$arreglo[$indice][3]=$row['idTipoPruebasAudiencia'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

//Función para obtener la información de SENAP sobre acuerdos reparatorios
function getDataAcuerdosReparatorios($conn, $idEstatusNucs){
	 $query = "SELECT * FROM senap.acuerdosReparatorios WHERE idEstatusNucs = '$idEstatusNucs' "; 
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idAcuerdoReparatorio'];
		$arreglo[$indice][1]=$row['idEstatusNucs'];
		$arreglo[$indice][2]=$row['idTipoAcuerdoReparatorio'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

//Función para obtener la información de SENAP sobre criterios de oportunidad
function getDataCriteriosOportunidad($conn, $idEstatusNucs){
	 $query = "SELECT * FROM senap.criteriosOportunidad WHERE idEstatusNucs = '$idEstatusNucs' "; 
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idCriterioOportunidad'];
		$arreglo[$indice][1]=$row['idEstatusNucs'];
		$arreglo[$indice][2]=$row['idTipoCriterioOportunidad'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

//Función para obtener la información de SENAP sobre sentencias
function getDataSentencias($conn, $idEstatusNucs, $estatus){
	if($estatus == 14){
		$query = "SELECT * FROM senap.sentencias WHERE ResolucionID = '$idEstatusNucs' "; 
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idSentencia'];
		$arreglo[$indice][1]=$row['ResolucionID'];
		$arreglo[$indice][2]=$row['fechaDictoSentencia'];
		$arreglo[$indice][3]=$row['idTipoSentencia'];
		$arreglo[$indice][4]=$row['aniosPrision'];
		$arreglo[$indice][5]=$row['sentenciaEncuentraFirme'];
		$arreglo[$indice][6]=$row['sentDerivaProcAbrv'];
		$arreglo[$indice][7]=$row['fechaDictoProcAbrv'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
	}else{
		$query = "SELECT * FROM senap.sentencias WHERE idEstatusNucs = '$idEstatusNucs' "; 
		$indice = 0;
		$stmt = sqlsrv_query($conn, $query);
		while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
		{
			$arreglo[$indice][0]=$row['idSentencia'];
			$arreglo[$indice][1]=$row['idEstatusNucs'];
			$arreglo[$indice][2]=$row['fechaDictoSentencia'];
			$arreglo[$indice][3]=$row['idTipoSentencia'];
			$arreglo[$indice][4]=$row['aniosPrision'];
			$arreglo[$indice][5]=$row['sentenciaEncuentraFirme'];
			$arreglo[$indice][6]=$row['sentDerivaProcAbrv'];
			$arreglo[$indice][7]=$row['fechaDictoProcAbrv'];
			$indice++;
		}
		if(isset($arreglo)){return $arreglo;}
	}
}

//Función para obtener la información de SENAP sobre sentencias > se condena la reparación de daños
function getDataReparacionDanios($conn, $idEstatusNucs){
	 $query = "SELECT * FROM senap.reparacionDanios WHERE idEstatusNucs = '$idEstatusNucs' "; 
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idReparacionDanio'];
		$arreglo[$indice][1]=$row['idEstatusNucs'];
		$arreglo[$indice][2]=$row['montoReparacionDanio'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}
//Función para obtener la información de SENAP sobre sentencias > se condena la reparación de daños
function getDataDelitoJudicializado($conn, $idEstatusNucs){
	 $query = "SELECT * FROM senap.judicializadas WHERE idEstatusNucs = '$idEstatusNucs' "; 
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idJudicializadas'];
		$arreglo[$indice][1]=$row['idEstatusNucs'];
		$arreglo[$indice][2]=$row['idModalidadEstadistica'];
		$arreglo[$indice][3]=$row['reclasificacion'];
		$arreglo[$indice][4]=$row['causaPenal'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

function getDataDelitosSica($conSic){

		$query = "SELECT CatModalidadesEstadisticasID
      												,Nombre
												      ,INEGI
												      ,CIEISP
												      ,AgrupacionID
												      ,Estatus
												      ,Idhistorico
												      ,DelitoLeyPenal
												      ,SenalamientoNormativo
												      ,DelitoNormaTecnica
												  FROM dbo.CatModalidadesEstadisticas";


							$indice = 0;
								$stmt = sqlsrv_query($conSic, $query);
								while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
								{
									$arreglo[$indice][0]=$row['CatModalidadesEstadisticasID'];
									$arreglo[$indice][1]=$row['Nombre'];
									$arreglo[$indice][2]=$row['INEGI'];
									$arreglo[$indice][3]=$row['CIEISP'];
									$arreglo[$indice][4]=$row['AgrupacionID'];
									$arreglo[$indice][5]=$row['Estatus'];
									$arreglo[$indice][6]=$row['Idhistorico'];
									$arreglo[$indice][6]=$row['DelitoLeyPenal'];
									$arreglo[$indice][6]=$row['SenalamientoNormativo'];
									$arreglo[$indice][6]=$row['DelitoNormaTecnica'];
									$indice++;
								}
								if(isset($arreglo)){return $arreglo;}	

}

//Función para obtener el total de NUCS de medidas de proteccion
function getDataMedidasProteccion($conn, $idEstatusNucs){
	 $query = "SELECT * FROM medidasDeProteccion WHERE idEstatusNucs = '$idEstatusNucs' "; 
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idMedidaProteccion'];
		$arreglo[$indice][1]=$row['idEstatusNucs'];
		$arreglo[$indice][2]=$row['nuc'];
		$arreglo[$indice][3]=$row['masculino'];
		$arreglo[$indice][4]=$row['femenino'];
		$arreglo[$indice][5]=$row['moral'];
		$arreglo[$indice][6]=$row['desconocido'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

//Función para obtener la fecha de cumplimento
function getDataFechaCumplimento($conn, $idEstatusNucs){
	 $query = "SELECT * FROM senap.ordenesAprehension WHERE idEstatusNucs = '$idEstatusNucs' "; 
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idOrdenAprehension'];
		$arreglo[$indice][1]=$row['idEstatusNucs'];
		$arreglo[$indice][2]=$row['fechaCumplimento'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}


?>