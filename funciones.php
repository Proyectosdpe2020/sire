<?php


function getDataUSER($conn, $idusername){

	$query = "  SELECT nombre, paterno, materno, areaNombre FROM usuario WHERE idUsuario = $idusername ";


	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
	{
		$arreglo[$indice][0]=$row['nombre'];
		$arreglo[$indice][1]=$row['paterno'];
		$arreglo[$indice][2]=$row['materno'];
		$arreglo[$indice][3]=$row['areaNombre'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	

}

function getArchvsEnla($conn, $idEnlace){

	$query = " SELECT idFormtato FROM enlaceFormato WHERE idEnlace = $idEnlace ";
		

$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
	{
		$arreglo[$indice][0]=$row['idFormtato'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	

}
	

function getEnlacesLitiArchivs($conn, $idEnlace){

	$query = "   SELECT [idEnlaceFormato]
      ,[idEnlace]
      ,[idFormtato]
      ,[idEnlaceLiti]
      ,[idEnlaceLiti2]
  FROM [ESTADISTICAV2].[dbo].[enlaceFormato] WHERE idEnlace = $idEnlace ";

$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idEnlaceLiti'];
		$arreglo[$indice][1]=$row['idEnlaceLiti2'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

function getIdUnidEnlaceFormat($conn, $idEnlace, $format){

	$query = "SELECT idEnlaceLiti FROm enlaceFormato WHERE idEnlace = $idEnlace AND idFormtato = $format ";

$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idEnlaceLiti'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}



function getDataMpsUniMesAnioUnids($conn, $idUnidad, $anio, $mes){


		$query = "SELECT [idCarpetas]
      ,[fecha]
      ,[idMes]
      ,[idAnio]
      ,Carpetas.idUnidad
      ,[modulo]
      ,[existenciaAnterior]
      ,[iniciadasConDetenido]
      ,[iniciadasSinDetenido]
      ,[totalIniciadas]
      ,[reiniciadas]
      ,[recibidasPorOtraUnidad]
      ,[totalTrabajar]
      ,[judicializadasConDetenido]
      ,[judicializadasSinDetenido]
      ,[totalJudicializadas]
      ,[abstencionInvestigacion]
      ,[archivoTemporal]
      ,[noEjercicioAccionPenal]
      ,[mediacion]
      ,[conciliacion]
      ,[criteriosOportunidad]
      ,[suspensionCondicional]
      ,[incompetencia]
      ,[acumulacion]
      ,[totalResoluciones]
      ,[enviadasUATP]
      ,[enviadasUI]
      ,[enviImpDes]
      ,[tramite]
      ,Carpetas.idMp
	  ,mp.nombre+' '+mp.paterno+' '+mp.materno as 'ministerio'
  FROM [ESTADISTICAV2].[dbo].[Carpetas] INNER JOIN mp ON mp.idMp = Carpetas.idMp WHERE idMes = $mes AND idAnio = $anio AND Carpetas.idUnidad ".$idUnidad;
 

  $indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
	{
		$arreglo[$indice][0]=$row['idCarpetas'];
		$arreglo[$indice][1]=$row['ministerio'];
		$arreglo[$indice][2]=$row['existenciaAnterior'];
		$arreglo[$indice][3]=$row['iniciadasConDetenido'];
		$arreglo[$indice][4]=$row['iniciadasSinDetenido'];
		$arreglo[$indice][5]=$row['totalIniciadas'];
		$arreglo[$indice][6]=$row['reiniciadas'];
		$arreglo[$indice][7]=$row['recibidasPorOtraUnidad'];
		$arreglo[$indice][8]=$row['totalTrabajar'];
		$arreglo[$indice][9]=$row['judicializadasConDetenido'];
		$arreglo[$indice][10]=$row['judicializadasSinDetenido'];
		$arreglo[$indice][11]=$row['totalJudicializadas'];
		$arreglo[$indice][12]=$row['abstencionInvestigacion'];
		$arreglo[$indice][13]=$row['archivoTemporal'];
		$arreglo[$indice][14]=$row['noEjercicioAccionPenal'];
		$arreglo[$indice][15]=$row['mediacion'];
		$arreglo[$indice][16]=$row['conciliacion'];
		$arreglo[$indice][17]=$row['criteriosOportunidad'];
		$arreglo[$indice][18]=$row['suspensionCondicional'];
		$arreglo[$indice][19]=$row['incompetencia'];
		$arreglo[$indice][20]=$row['acumulacion'];
		$arreglo[$indice][21]=$row['totalResoluciones'];
		$arreglo[$indice][22]=$row['enviadasUATP'];
		$arreglo[$indice][23]=$row['enviadasUI'];
		$arreglo[$indice][24]=$row['enviImpDes'];
		$arreglo[$indice][25]=$row['tramite'];
		$arreglo[$indice][26]=$row['idMp'];
		$arreglo[$indice][27]=$row['idUnidad'];

		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	



}


function getDataMpsUniMesAnio($conn, $idUnidad, $anio, $mes){


		$query = "SELECT [idCarpetas]
      ,[fecha]
      ,[idMes]
      ,[idAnio]
      ,Carpetas.idUnidad
      ,[modulo]
      ,[existenciaAnterior]
      ,[iniciadasConDetenido]
      ,[iniciadasSinDetenido]
      ,[totalIniciadas]
      ,[reiniciadas]
      ,[recibidasPorOtraUnidad]
      ,[totalTrabajar]
      ,[judicializadasConDetenido]
      ,[judicializadasSinDetenido]
      ,[totalJudicializadas]
      ,[abstencionInvestigacion]
      ,[archivoTemporal]
      ,[noEjercicioAccionPenal]
      ,[mediacion]
      ,[conciliacion]
      ,[criteriosOportunidad]
      ,[suspensionCondicional]
      ,[incompetencia]
      ,[acumulacion]
      ,[totalResoluciones]
      ,[enviadasUATP]
      ,[enviadasUI]
      ,[enviImpDes]
      ,[tramite]
      ,Carpetas.idMp
	  ,mp.nombre+' '+mp.paterno+' '+mp.materno as 'ministerio'
  FROM [ESTADISTICAV2].[dbo].[Carpetas] INNER JOIN mp ON mp.idMp = Carpetas.idMp WHERE Carpetas.idUnidad = $idUnidad AND idMes = $mes AND idAnio = $anio"; 

  $indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
	{
		$arreglo[$indice][0]=$row['idCarpetas'];
		$arreglo[$indice][1]=$row['ministerio'];
		$arreglo[$indice][2]=$row['existenciaAnterior'];
		$arreglo[$indice][3]=$row['iniciadasConDetenido'];
		$arreglo[$indice][4]=$row['iniciadasSinDetenido'];
		$arreglo[$indice][5]=$row['totalIniciadas'];
		$arreglo[$indice][6]=$row['reiniciadas'];
		$arreglo[$indice][7]=$row['recibidasPorOtraUnidad'];
		$arreglo[$indice][8]=$row['totalTrabajar'];
		$arreglo[$indice][9]=$row['judicializadasConDetenido'];
		$arreglo[$indice][10]=$row['judicializadasSinDetenido'];
		$arreglo[$indice][11]=$row['totalJudicializadas'];
		$arreglo[$indice][12]=$row['abstencionInvestigacion'];
		$arreglo[$indice][13]=$row['archivoTemporal'];
		$arreglo[$indice][14]=$row['noEjercicioAccionPenal'];
		$arreglo[$indice][15]=$row['mediacion'];
		$arreglo[$indice][16]=$row['conciliacion'];
		$arreglo[$indice][17]=$row['criteriosOportunidad'];
		$arreglo[$indice][18]=$row['suspensionCondicional'];
		$arreglo[$indice][19]=$row['incompetencia'];
		$arreglo[$indice][20]=$row['acumulacion'];
		$arreglo[$indice][21]=$row['totalResoluciones'];
		$arreglo[$indice][22]=$row['enviadasUATP'];
		$arreglo[$indice][23]=$row['enviadasUI'];
		$arreglo[$indice][24]=$row['enviImpDes'];
		$arreglo[$indice][25]=$row['tramite'];
		$arreglo[$indice][26]=$row['idMp'];
		$arreglo[$indice][27]=$row['idUnidad'];

		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	



}


function getIdUnidEnlace($conn, $idEnlace){

	$query = "    SELECT idUnidad FROm enlace WHERE idEnlace = $idEnlace ";

$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idUnidad'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

function getAnioCapEnlaceArchivo($conn, $idEnlace, $idFormato){

		$query = " SELECT idAnio FROM enlaceMesValidaEnviado WHERE idEnlace = $idEnlace AND idFormato = $idFormato ";
		//echo $query;

$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
	{
		$arreglo[$indice][0]=$row['idAnio'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	

}



function getDatosLitigacionMpUnidad($conn, $idMp, $mes, $anio, $idFiscalia, $idUnidad){


	$query = "  SELECT [existenciaAnterior],[carpetasJudicializadas],[judicializadasConDetenido],[judicializadasSinDetenido],[autoDeVinculacion],[autoDeNoVinculacion],[Mixtos],[imposicionMedidasCautelares],[prisionPreventivaOficiosa],[prisionPreventivaJustificada],[presentacionPeriodicaAnteElJuez],[exhibicionGarantiaEconomica],[embargoDeBienes],[inmovilizacionDeCuentasValores],[prohibicionSalirSinAutorizacionDelJuez],[sometimientoCuidadoVigilanciaInstitucion],[prohibicionConcurrirDeterminadasReunionesLugares],[prohibicionConvivirComunicarseDeterminadasPersonas],[separacionInmediataDelDomicilio],[suspensionTemporalEjercicioDelCargo],[suspensionTemporalActividadProfesionalLaboral],[colocacionLocalizadoresElectronicos],[resguardoPropioDomicilioModalidades],[sobreseimientosDecretados],[sobreseimientosPrescripcionAccionPenal],[sobreseimientosMecanismosAlternativos],[sobreseimientosAcuerdoReparatorio],[sobreseimientosSuspensionCondicionalProceso],[sobreseimientosCriterioOportunidad],[terminacionAnticipada],[procedimientosAbreviados],[acumulacion],[citaciones],[cateosSolilcitados],[cateosConcedidos],[cateosNegados],[ordenesNegadas],[ordenesNegadasAprehension],[ordenesNegadasComparecencia],[desistimientoDelRecurso],[desistimientoDelRecursoParterAcusado],[desistimientoDelRecursoParteDefensor],[desistimientoDelRecursoMP],[apelacionesNoAdmitidas],[sentenciasDictadas],[sentenciasDictadasRevoca],[sentenciasDictadasModifica],[sentenciasDictadasConfirma],[reposicionProcedimiento],[totalJudicializadasTramite],[mandamientosJudicialesGirados],[MandamientosJudicialesGiradosOrdenesAprehension],[MandamientosJudicialesGiradosOrdenesComparecencia],[mandamientosJudicialesCumplidos],[MandamientosJudicialesCumplidosOrdenesAprehension],[MandamientosJudicialesCumplidosOrdenesComparecencia],[totalAudiencias],[acusacionesPresentadas],[audienciaIntermediaEscrita],[audienciaIntermediaOral],[solucionesAlternas],[solucionesAlternasSuspensionCondicionalProceso],[solucionesAlternasAcuerdoReparatorio],[sentencias],[sentenciasCondenatorias],[sentenciasAbsolutorias],[sentenciasMixtas],[sentenciasCondenaReparacionDanos],[sentenciasNoCondenaReparacionDanos],[incompetencias],[incompetenciasDecretadas],[incompetenciasAdmitidas],[apelacionesContraResolucionJuezControl],[apelacionesNegarAnticipoPrueba],[apelacionesNegarAcuerdoReparatorio],[apelacionesNegarCancelarOrdenAprehension],[apelacionesNegarOrdenCateo],[apelacionesProvidenciasPrecautoriasMedidaCautelar],[apelacionesQuePonganTerminoAlProcedimiento],[apelacionesAutoQueResuelveVinculacionAProceso],[apelacionesQueConcedanRevoquenNieguenSuspension],[apelacionesNegativaAbrirProcedimientoAbreviado],[apelacionesSetenciaDefinitivaProcedimientoAbreviado],[apelacionesExcluirMedioPrueba],[apelacionesContraResolucionesTribunalEnjuiciamiento],[apelacionesDesistimientoAccionPenal],[apelacionesSentenciaDefinitiva],[deLasSentenciasDictadas],[revocacionesFavorablesAlMP],[modificacionesFavorablesAlMP],[confirmacionesFavorablesAlMP],[porCambioDeclaradosSituacionJuridicaDeclaradaSinMateria],[FormulaImputacion_Soli],[FormulaImputacion_Otorga],[FormulaImputacion_Negadas],[LegalDetencion],[IlegalDetencion],[Med_CautelresSolicitadas],[Med_CautelaresNegadas],[Med_CautelaresOtorgadas],[SobreseimientosMuerteImputado],[recibiOtmp],[cesefunciones] FROM Litigacion WHERE idMes = $mes AND idAnio = $anio AND idFiscalia = $idFiscalia AND idMp = $idMp AND idUnidad = $idUnidad";



  $indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['existenciaAnterior'];

		$arreglo[$indice][1]=$row['carpetasJudicializadas'];
		$arreglo[$indice][2]=$row['judicializadasConDetenido'];
		$arreglo[$indice][3]=$row['judicializadasSinDetenido'];

		$arreglo[$indice][4]=$row['autoDeVinculacion'];
		$arreglo[$indice][5]=$row['autoDeNoVinculacion'];
		$arreglo[$indice][6]=$row['Mixtos'];
		
		$arreglo[$indice][7]=$row['imposicionMedidasCautelares'];
		$arreglo[$indice][8]=$row['prisionPreventivaOficiosa'];
		$arreglo[$indice][9]=$row['prisionPreventivaJustificada'];
		$arreglo[$indice][10]=$row['presentacionPeriodicaAnteElJuez'];
		$arreglo[$indice][11]=$row['exhibicionGarantiaEconomica'];
		$arreglo[$indice][12]=$row['embargoDeBienes'];
		$arreglo[$indice][13]=$row['inmovilizacionDeCuentasValores'];
		$arreglo[$indice][14]=$row['prohibicionSalirSinAutorizacionDelJuez'];
		$arreglo[$indice][15]=$row['sometimientoCuidadoVigilanciaInstitucion'];
		$arreglo[$indice][16]=$row['prohibicionConcurrirDeterminadasReunionesLugares'];
		$arreglo[$indice][17]=$row['prohibicionConvivirComunicarseDeterminadasPersonas'];
		$arreglo[$indice][18]=$row['separacionInmediataDelDomicilio'];
		$arreglo[$indice][19]=$row['suspensionTemporalEjercicioDelCargo'];
		$arreglo[$indice][20]=$row['suspensionTemporalActividadProfesionalLaboral'];
		$arreglo[$indice][21]=$row['colocacionLocalizadoresElectronicos'];
		$arreglo[$indice][22]=$row['resguardoPropioDomicilioModalidades'];	

		$arreglo[$indice][23]=$row['sobreseimientosDecretados'];		
		$arreglo[$indice][24]=$row['sobreseimientosPrescripcionAccionPenal'];
		$arreglo[$indice][25]=$row['sobreseimientosMecanismosAlternativos'];		
		$arreglo[$indice][26]=$row['sobreseimientosAcuerdoReparatorio'];
		$arreglo[$indice][27]=$row['sobreseimientosSuspensionCondicionalProceso'];
		$arreglo[$indice][28]=$row['sobreseimientosCriterioOportunidad'];		
		$arreglo[$indice][29]=$row['terminacionAnticipada'];
		$arreglo[$indice][30]=$row['procedimientosAbreviados'];
		$arreglo[$indice][31]=$row['acumulacion'];
		$arreglo[$indice][32]=$row['citaciones'];	

		$arreglo[$indice][33]=$row['cateosSolilcitados'];
		$arreglo[$indice][34]=$row['cateosConcedidos'];
		$arreglo[$indice][35]=$row['cateosNegados'];

		$arreglo[$indice][36]=$row['ordenesNegadas'];		
		$arreglo[$indice][37]=$row['ordenesNegadasAprehension'];
		$arreglo[$indice][38]=$row['ordenesNegadasComparecencia'];

		$arreglo[$indice][39]=$row['desistimientoDelRecurso'];
		$arreglo[$indice][40]=$row['desistimientoDelRecursoParterAcusado'];
		$arreglo[$indice][41]=$row['desistimientoDelRecursoParteDefensor'];
		$arreglo[$indice][42]=$row['desistimientoDelRecursoMP'];

		$arreglo[$indice][43]=$row['apelacionesNoAdmitidas'];

		$arreglo[$indice][44]=$row['sentenciasDictadas'];
		$arreglo[$indice][45]=$row['sentenciasDictadasRevoca'];
		$arreglo[$indice][46]=$row['sentenciasDictadasModifica'];
		$arreglo[$indice][47]=$row['sentenciasDictadasConfirma'];

		$arreglo[$indice][48]=$row['reposicionProcedimiento'];

		$arreglo[$indice][49]=$row['totalJudicializadasTramite'];


		$arreglo[$indice][50]=$row['mandamientosJudicialesGirados'];
		$arreglo[$indice][51]=$row['MandamientosJudicialesGiradosOrdenesAprehension'];
		$arreglo[$indice][52]=$row['MandamientosJudicialesGiradosOrdenesComparecencia'];

		$arreglo[$indice][53]=$row['mandamientosJudicialesCumplidos'];
		$arreglo[$indice][54]=$row['MandamientosJudicialesCumplidosOrdenesAprehension'];
		$arreglo[$indice][55]=$row['MandamientosJudicialesCumplidosOrdenesComparecencia'];

		$arreglo[$indice][56]=$row['totalAudiencias'];

		$arreglo[$indice][99]=$row['acusacionesPresentadas'];
		$arreglo[$indice][57]=$row['audienciaIntermediaEscrita'];
		$arreglo[$indice][58]=$row['audienciaIntermediaOral'];

		$arreglo[$indice][59]=$row['solucionesAlternas'];
		$arreglo[$indice][60]=$row['solucionesAlternasSuspensionCondicionalProceso'];
		$arreglo[$indice][61]=$row['solucionesAlternasAcuerdoReparatorio'];

		$arreglo[$indice][62]=$row['sentencias'];
		$arreglo[$indice][63]=$row['sentenciasCondenatorias'];
		$arreglo[$indice][64]=$row['sentenciasAbsolutorias'];
		$arreglo[$indice][65]=$row['sentenciasMixtas'];
		$arreglo[$indice][66]=$row['sentenciasCondenaReparacionDanos'];
		$arreglo[$indice][67]=$row['sentenciasNoCondenaReparacionDanos'];

		$arreglo[$indice][68]=$row['incompetencias'];
		$arreglo[$indice][69]=$row['incompetenciasDecretadas'];
		$arreglo[$indice][70]=$row['incompetenciasAdmitidas'];

		$arreglo[$indice][71]=$row['apelacionesContraResolucionJuezControl'];
		$arreglo[$indice][72]=$row['apelacionesNegarAnticipoPrueba'];
		$arreglo[$indice][73]=$row['apelacionesNegarAcuerdoReparatorio'];
		$arreglo[$indice][74]=$row['apelacionesNegarCancelarOrdenAprehension'];
		$arreglo[$indice][75]=$row['apelacionesNegarOrdenCateo'];
		$arreglo[$indice][76]=$row['apelacionesProvidenciasPrecautoriasMedidaCautelar'];
		$arreglo[$indice][77]=$row['apelacionesQuePonganTerminoAlProcedimiento'];
		$arreglo[$indice][78]=$row['apelacionesAutoQueResuelveVinculacionAProceso'];
		$arreglo[$indice][79]=$row['apelacionesQueConcedanRevoquenNieguenSuspension'];
		$arreglo[$indice][80]=$row['apelacionesNegativaAbrirProcedimientoAbreviado'];
		$arreglo[$indice][81]=$row['apelacionesSetenciaDefinitivaProcedimientoAbreviado'];
		$arreglo[$indice][82]=$row['apelacionesExcluirMedioPrueba'];

		$arreglo[$indice][83]=$row['apelacionesContraResolucionesTribunalEnjuiciamiento'];
		$arreglo[$indice][84]=$row['apelacionesDesistimientoAccionPenal'];
		$arreglo[$indice][85]=$row['apelacionesSentenciaDefinitiva'];

		$arreglo[$indice][86]=$row['deLasSentenciasDictadas'];
		$arreglo[$indice][87]=$row['revocacionesFavorablesAlMP'];
		$arreglo[$indice][88]=$row['modificacionesFavorablesAlMP'];
		$arreglo[$indice][89]=$row['confirmacionesFavorablesAlMP'];		
		
		$arreglo[$indice][90]=$row['porCambioDeclaradosSituacionJuridicaDeclaradaSinMateria'];
		
		$arreglo[$indice][91]=$row['FormulaImputacion_Soli'];
		$arreglo[$indice][92]=$row['FormulaImputacion_Otorga'];
		$arreglo[$indice][93]=$row['FormulaImputacion_Negadas'];

		$arreglo[$indice][94]=$row['LegalDetencion'];
		$arreglo[$indice][95]=$row['IlegalDetencion'];

		$arreglo[$indice][96]=$row['Med_CautelresSolicitadas'];
		$arreglo[$indice][97]=$row['Med_CautelaresNegadas'];
		$arreglo[$indice][98]=$row['Med_CautelaresOtorgadas'];
		$arreglo[$indice][99]=$row['SobreseimientosMuerteImputado'];
		$arreglo[$indice][100]=$row['recibiOtmp'];
		$arreglo[$indice][101]=$row['cesefunciones'];

		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}

}	

function get_anio_enlace($conn, $idEnlace, $idFormato){

		$query = " SELECT idAnio FROM enlaceMesValidaEnviado WHERE idEnlace = $idEnlace AND idFormato = $idFormato ";
		//echo $query;

$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
	{
		$arreglo[$indice][0]=$row['idAnio'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	

}


function getUnidadEnlaceFormat($conn, $idEnlace, $idFormato){

		$query = " SELECT idUnidad FROM enlace WHERE idEnlace = $idEnlace AND idFormato = $idFormato ";
		//echo $query;

$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
	{
		$arreglo[$indice][0]=$row['idUnidad'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	

}

function getMesCapEnlaceArchivo($conn, $idEnlace, $idFormato){

		$query = " SELECT mesCap, idAnio FROM enlaceMesValidaEnviado WHERE idEnlace = $idEnlace AND idFormato = $idFormato ";
		//echo $query;

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


function  getFiscaNameXunidad($conn, $idUnidad){

				$query = " SELECT cf.nFiscalia FROM CatUnidad Cu INNER JOIN CatFiscalia cf ON cf.idFiscalia = Cu.idFiscalia  WHERE Cu.idUnidad = $idUnidad";

		

$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
	{
		$arreglo[$indice][0]=$row['nFiscalia'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	

}

function getFormsAccesosEnlace($conn, $idEnlace){

	$query = "  SELECT idEnlaceFormato FRom enlaceFormato WHERE idEnlace = $idEnlace ";


$stmt = sqlsrv_query(  $conn, $query,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
$row_count = sqlsrv_num_rows( $stmt );
	if($row_count > 1){	return 1; }else{return 0;}
}


function getDataEstatusLitigacion($conn, $idEstatus){

		$query = " SELECT        nombre, descripcion, estatus
					FROM            estatus
					WHERE        (idEstatus = $idEstatus) ";

$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
	{
		$arreglo[$indice][0]=$row['nombre'];
		$arreglo[$indice][1]=$row['descripcion'];
		$arreglo[$indice][2]=$row['estatus'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	

}

function getCapturadoMesAnioMPLitig($conn, $mesCapturar, $anioCaptura, $idMp, $idFiscalia, $idUnidad){

	$query = " SELECT idLitigacion FROM Litigacion WHERE idMes = $mesCapturar AND idAnio = $anioCaptura AND idMp = $idMp AND idFiscalia = $idFiscalia AND idUnidad = $idUnidad";

	//echo $query;


$stmt = sqlsrv_query(  $conn, $query,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
$row_count = sqlsrv_num_rows( $stmt );
	if($row_count > 0){	return 1; }else{return 0;}
}


function getinfoTitular($conn, $idEnlace){

	$query = "  SELECT t.nombre, t.paterno, t.materno, t.cargo FROM titular t 
  INNER JOIN titularEnlaceFormato tef ON tef.idTitular = t.idTitular  WHERE idEnlace = $idEnlace ";

	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['nombre'];
		$arreglo[$indice][1]=$row['paterno'];
		$arreglo[$indice][2]=$row['materno'];
		$arreglo[$indice][3]=$row['cargo'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}

}

function getDatosLitigacionMp($conn, $idMp, $mes, $anio, $idFiscalia){


	$query = "  SELECT [existenciaAnterior],[carpetasJudicializadas],[judicializadasConDetenido],[judicializadasSinDetenido],[autoDeVinculacion],[autoDeNoVinculacion],[Mixtos],[imposicionMedidasCautelares],[prisionPreventivaOficiosa],[prisionPreventivaJustificada],[presentacionPeriodicaAnteElJuez],[exhibicionGarantiaEconomica],[embargoDeBienes],[inmovilizacionDeCuentasValores],[prohibicionSalirSinAutorizacionDelJuez],[sometimientoCuidadoVigilanciaInstitucion],[prohibicionConcurrirDeterminadasReunionesLugares],[prohibicionConvivirComunicarseDeterminadasPersonas],[separacionInmediataDelDomicilio],[suspensionTemporalEjercicioDelCargo],[suspensionTemporalActividadProfesionalLaboral],[colocacionLocalizadoresElectronicos],[resguardoPropioDomicilioModalidades],[sobreseimientosDecretados],[sobreseimientosPrescripcionAccionPenal],[sobreseimientosMecanismosAlternativos],[sobreseimientosAcuerdoReparatorio],[sobreseimientosSuspensionCondicionalProceso],[sobreseimientosCriterioOportunidad],[terminacionAnticipada],[procedimientosAbreviados],[acumulacion],[citaciones],[cateosSolilcitados],[cateosConcedidos],[cateosNegados],[ordenesNegadas],[ordenesNegadasAprehension],[ordenesNegadasComparecencia],[desistimientoDelRecurso],[desistimientoDelRecursoParterAcusado],[desistimientoDelRecursoParteDefensor],[desistimientoDelRecursoMP],[apelacionesNoAdmitidas],[sentenciasDictadas],[sentenciasDictadasRevoca],[sentenciasDictadasModifica],[sentenciasDictadasConfirma],[reposicionProcedimiento],[totalJudicializadasTramite],[mandamientosJudicialesGirados],[MandamientosJudicialesGiradosOrdenesAprehension],[MandamientosJudicialesGiradosOrdenesComparecencia],[mandamientosJudicialesCumplidos],[MandamientosJudicialesCumplidosOrdenesAprehension],[MandamientosJudicialesCumplidosOrdenesComparecencia],[totalAudiencias],[acusacionesPresentadas],[audienciaIntermediaEscrita],[audienciaIntermediaOral],[solucionesAlternas],[solucionesAlternasSuspensionCondicionalProceso],[solucionesAlternasAcuerdoReparatorio],[sentencias],[sentenciasCondenatorias],[sentenciasAbsolutorias],[sentenciasMixtas],[sentenciasCondenaReparacionDanos],[sentenciasNoCondenaReparacionDanos],[incompetencias],[incompetenciasDecretadas],[incompetenciasAdmitidas],[apelacionesContraResolucionJuezControl],[apelacionesNegarAnticipoPrueba],[apelacionesNegarAcuerdoReparatorio],[apelacionesNegarCancelarOrdenAprehension],[apelacionesNegarOrdenCateo],[apelacionesProvidenciasPrecautoriasMedidaCautelar],[apelacionesQuePonganTerminoAlProcedimiento],[apelacionesAutoQueResuelveVinculacionAProceso],[apelacionesQueConcedanRevoquenNieguenSuspension],[apelacionesNegativaAbrirProcedimientoAbreviado],[apelacionesSetenciaDefinitivaProcedimientoAbreviado],[apelacionesExcluirMedioPrueba],[apelacionesContraResolucionesTribunalEnjuiciamiento],[apelacionesDesistimientoAccionPenal],[apelacionesSentenciaDefinitiva],[deLasSentenciasDictadas],[revocacionesFavorablesAlMP],[modificacionesFavorablesAlMP],[confirmacionesFavorablesAlMP],[porCambioDeclaradosSituacionJuridicaDeclaradaSinMateria],[FormulaImputacion_Soli],[FormulaImputacion_Otorga],[FormulaImputacion_Negadas],[LegalDetencion],[IlegalDetencion],[Med_CautelresSolicitadas],[Med_CautelaresNegadas],[Med_CautelaresOtorgadas],[SobreseimientosMuerteImputado],[recibiOtmp],[cesefunciones] FROM Litigacion WHERE idMes = $mes AND idAnio = $anio AND idFiscalia = $idFiscalia AND idMp = $idMp";



  $indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['existenciaAnterior'];

		$arreglo[$indice][1]=$row['carpetasJudicializadas'];
		$arreglo[$indice][2]=$row['judicializadasConDetenido'];
		$arreglo[$indice][3]=$row['judicializadasSinDetenido'];

		$arreglo[$indice][4]=$row['autoDeVinculacion'];
		$arreglo[$indice][5]=$row['autoDeNoVinculacion'];
		$arreglo[$indice][6]=$row['Mixtos'];
		
		$arreglo[$indice][7]=$row['imposicionMedidasCautelares'];
		$arreglo[$indice][8]=$row['prisionPreventivaOficiosa'];
		$arreglo[$indice][9]=$row['prisionPreventivaJustificada'];
		$arreglo[$indice][10]=$row['presentacionPeriodicaAnteElJuez'];
		$arreglo[$indice][11]=$row['exhibicionGarantiaEconomica'];
		$arreglo[$indice][12]=$row['embargoDeBienes'];
		$arreglo[$indice][13]=$row['inmovilizacionDeCuentasValores'];
		$arreglo[$indice][14]=$row['prohibicionSalirSinAutorizacionDelJuez'];
		$arreglo[$indice][15]=$row['sometimientoCuidadoVigilanciaInstitucion'];
		$arreglo[$indice][16]=$row['prohibicionConcurrirDeterminadasReunionesLugares'];
		$arreglo[$indice][17]=$row['prohibicionConvivirComunicarseDeterminadasPersonas'];
		$arreglo[$indice][18]=$row['separacionInmediataDelDomicilio'];
		$arreglo[$indice][19]=$row['suspensionTemporalEjercicioDelCargo'];
		$arreglo[$indice][20]=$row['suspensionTemporalActividadProfesionalLaboral'];
		$arreglo[$indice][21]=$row['colocacionLocalizadoresElectronicos'];
		$arreglo[$indice][22]=$row['resguardoPropioDomicilioModalidades'];	

		$arreglo[$indice][23]=$row['sobreseimientosDecretados'];		
		$arreglo[$indice][24]=$row['sobreseimientosPrescripcionAccionPenal'];
		$arreglo[$indice][25]=$row['sobreseimientosMecanismosAlternativos'];		
		$arreglo[$indice][26]=$row['sobreseimientosAcuerdoReparatorio'];
		$arreglo[$indice][27]=$row['sobreseimientosSuspensionCondicionalProceso'];
		$arreglo[$indice][28]=$row['sobreseimientosCriterioOportunidad'];		
		$arreglo[$indice][29]=$row['terminacionAnticipada'];
		$arreglo[$indice][30]=$row['procedimientosAbreviados'];
		$arreglo[$indice][31]=$row['acumulacion'];
		$arreglo[$indice][32]=$row['citaciones'];	

		$arreglo[$indice][33]=$row['cateosSolilcitados'];
		$arreglo[$indice][34]=$row['cateosConcedidos'];
		$arreglo[$indice][35]=$row['cateosNegados'];

		$arreglo[$indice][36]=$row['ordenesNegadas'];		
		$arreglo[$indice][37]=$row['ordenesNegadasAprehension'];
		$arreglo[$indice][38]=$row['ordenesNegadasComparecencia'];

		$arreglo[$indice][39]=$row['desistimientoDelRecurso'];
		$arreglo[$indice][40]=$row['desistimientoDelRecursoParterAcusado'];
		$arreglo[$indice][41]=$row['desistimientoDelRecursoParteDefensor'];
		$arreglo[$indice][42]=$row['desistimientoDelRecursoMP'];

		$arreglo[$indice][43]=$row['apelacionesNoAdmitidas'];

		$arreglo[$indice][44]=$row['sentenciasDictadas'];
		$arreglo[$indice][45]=$row['sentenciasDictadasRevoca'];
		$arreglo[$indice][46]=$row['sentenciasDictadasModifica'];
		$arreglo[$indice][47]=$row['sentenciasDictadasConfirma'];

		$arreglo[$indice][48]=$row['reposicionProcedimiento'];

		$arreglo[$indice][49]=$row['totalJudicializadasTramite'];


		$arreglo[$indice][50]=$row['mandamientosJudicialesGirados'];
		$arreglo[$indice][51]=$row['MandamientosJudicialesGiradosOrdenesAprehension'];
		$arreglo[$indice][52]=$row['MandamientosJudicialesGiradosOrdenesComparecencia'];

		$arreglo[$indice][53]=$row['mandamientosJudicialesCumplidos'];
		$arreglo[$indice][54]=$row['MandamientosJudicialesCumplidosOrdenesAprehension'];
		$arreglo[$indice][55]=$row['MandamientosJudicialesCumplidosOrdenesComparecencia'];

		$arreglo[$indice][56]=$row['totalAudiencias'];

		$arreglo[$indice][99]=$row['acusacionesPresentadas'];
		$arreglo[$indice][57]=$row['audienciaIntermediaEscrita'];
		$arreglo[$indice][58]=$row['audienciaIntermediaOral'];

		$arreglo[$indice][59]=$row['solucionesAlternas'];
		$arreglo[$indice][60]=$row['solucionesAlternasSuspensionCondicionalProceso'];
		$arreglo[$indice][61]=$row['solucionesAlternasAcuerdoReparatorio'];

		$arreglo[$indice][62]=$row['sentencias'];
		$arreglo[$indice][63]=$row['sentenciasCondenatorias'];
		$arreglo[$indice][64]=$row['sentenciasAbsolutorias'];
		$arreglo[$indice][65]=$row['sentenciasMixtas'];
		$arreglo[$indice][66]=$row['sentenciasCondenaReparacionDanos'];
		$arreglo[$indice][67]=$row['sentenciasNoCondenaReparacionDanos'];

		$arreglo[$indice][68]=$row['incompetencias'];
		$arreglo[$indice][69]=$row['incompetenciasDecretadas'];
		$arreglo[$indice][70]=$row['incompetenciasAdmitidas'];

		$arreglo[$indice][71]=$row['apelacionesContraResolucionJuezControl'];
		$arreglo[$indice][72]=$row['apelacionesNegarAnticipoPrueba'];
		$arreglo[$indice][73]=$row['apelacionesNegarAcuerdoReparatorio'];
		$arreglo[$indice][74]=$row['apelacionesNegarCancelarOrdenAprehension'];
		$arreglo[$indice][75]=$row['apelacionesNegarOrdenCateo'];
		$arreglo[$indice][76]=$row['apelacionesProvidenciasPrecautoriasMedidaCautelar'];
		$arreglo[$indice][77]=$row['apelacionesQuePonganTerminoAlProcedimiento'];
		$arreglo[$indice][78]=$row['apelacionesAutoQueResuelveVinculacionAProceso'];
		$arreglo[$indice][79]=$row['apelacionesQueConcedanRevoquenNieguenSuspension'];
		$arreglo[$indice][80]=$row['apelacionesNegativaAbrirProcedimientoAbreviado'];
		$arreglo[$indice][81]=$row['apelacionesSetenciaDefinitivaProcedimientoAbreviado'];
		$arreglo[$indice][82]=$row['apelacionesExcluirMedioPrueba'];

		$arreglo[$indice][83]=$row['apelacionesContraResolucionesTribunalEnjuiciamiento'];
		$arreglo[$indice][84]=$row['apelacionesDesistimientoAccionPenal'];
		$arreglo[$indice][85]=$row['apelacionesSentenciaDefinitiva'];

		$arreglo[$indice][86]=$row['deLasSentenciasDictadas'];
		$arreglo[$indice][87]=$row['revocacionesFavorablesAlMP'];
		$arreglo[$indice][88]=$row['modificacionesFavorablesAlMP'];
		$arreglo[$indice][89]=$row['confirmacionesFavorablesAlMP'];		
		
		$arreglo[$indice][90]=$row['porCambioDeclaradosSituacionJuridicaDeclaradaSinMateria'];
		
		$arreglo[$indice][91]=$row['FormulaImputacion_Soli'];
		$arreglo[$indice][92]=$row['FormulaImputacion_Otorga'];
		$arreglo[$indice][93]=$row['FormulaImputacion_Negadas'];

		$arreglo[$indice][94]=$row['LegalDetencion'];
		$arreglo[$indice][95]=$row['IlegalDetencion'];

		$arreglo[$indice][96]=$row['Med_CautelresSolicitadas'];
		$arreglo[$indice][97]=$row['Med_CautelaresNegadas'];
		$arreglo[$indice][98]=$row['Med_CautelaresOtorgadas'];
		$arreglo[$indice][99]=$row['SobreseimientosMuerteImputado'];
		$arreglo[$indice][100]=$row['recibiOtmp'];
		$arreglo[$indice][101]=$row['cesefunciones'];

		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}

}	



function getDatosCarpetaMP($conn, $idMp2, $mes, $anio, $idUnidad2){


	$query = "SELECT reiniciadas,judicializadasConDetenido, judicializadasSinDetenido, abstencionInvestigacion, archivoTemporal, noEjercicioAccionPenal, incompetencia, acumulacion, mediacion, conciliacion, criteriosOportunidad, suspensionCondicional  FROM Carpetas WHERE idMes = $mes AND idAnio = $anio AND idUnidad = $idUnidad2 AND idMp = $idMp2";

  $indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['judicializadasConDetenido'];
		$arreglo[$indice][1]=$row['judicializadasSinDetenido'];
		$arreglo[$indice][2]=$row['abstencionInvestigacion'];
		$arreglo[$indice][3]=$row['archivoTemporal'];
		$arreglo[$indice][4]=$row['noEjercicioAccionPenal'];
		$arreglo[$indice][5]=$row['incompetencia'];
		$arreglo[$indice][6]=$row['acumulacion'];
		$arreglo[$indice][7]=$row['mediacion'];
		$arreglo[$indice][8]=$row['conciliacion'];
		$arreglo[$indice][9]=$row['criteriosOportunidad'];
		$arreglo[$indice][10]=$row['suspensionCondicional'];
		$arreglo[$indice][11]=$row['reiniciadas'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}

}

function getNombreMP($conn, $idMp){

	$query = " SELECT nombre, paterno, materno FROM mp WHERE idMp = $idMp ";

	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['nombre'];
		$arreglo[$indice][1]=$row['paterno'];
		$arreglo[$indice][2]=$row['materno'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}

}
function getNunidad($conn, $idUnidad){


		$query = " SELECT nUnidad FROM CatUnidad WHERE idUnidad = $idUnidad ";
	//	echo $query;

	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['nUnidad'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}


} 

function getMpTramiteCount($conn, $idMp){

$query23 = "SELECT tramite FROM mpTramiteTemp WHERE idMp = $idMp ";	


 		$stmt = sqlsrv_query($conn, $query23,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
		$row_count = sqlsrv_num_rows( $stmt );
		
		if($row_count > 0){
		return $row_count;
	}
	else{return 0;}

}	

function getMpTramiteCount2($conn, $idMp, $mesAnterior){

$query23 = "SELECT totalJudicializadasTramite FROM Litigacion WHERE idMp = $idMp AND idMes = $mesAnterior ";	

$indice = 0;
	$stmt = sqlsrv_query($conn, $query23);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['totalJudicializadasTramite'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}

}	
function getMpTramiteCount23($conn, $idMp, $mesAnterior, $idFiscalia){

$query23 = "SELECT totalJudicializadasTramite FROM Litigacion WHERE idMp = $idMp AND idMes = $mesAnterior AND idFiscalia = $idFiscalia";	
//echo $query23;
$indice = 0;
	$stmt = sqlsrv_query($conn, $query23);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['totalJudicializadasTramite'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}

}

function getTramiteANteriore($conn, $idMp, $mesAnterior, $idFiscalia, $idUnidad, $anio){

$query23 = "  SELECT totalJudicializadasTramite FROM Litigacion WHERE idMp = $idMp AND idMes = $mesAnterior AND idFiscalia = $idFiscalia AND idUnidad = $idUnidad AND idAnio = $anio";	
//echo $query23;
$indice = 0;
	$stmt = sqlsrv_query($conn, $query23);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['totalJudicializadasTramite'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}

}	


function getCambioLitiMpMesAnio($conn, $mes, $anio, $idMp){

$query23 = "SELECT cambio FROM Litigacion WHERE idMp = $idMp AND idMes = $mes ";	

//echo $query23;

$indice = 0;
	$stmt = sqlsrv_query($conn, $query23);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['cambio'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}

}	



//////////////// ESTE METODO ES TEMPORAL PARA EL PRIMER MES QUE SE CAPTURO LOS DATOS ///////////
function getMpTramite($conn, $idMp){

	$query = " SELECT tramite FROM mpTramiteTemp WHERE idMp = $idMp ";

	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['tramite'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}

}

function getMpTramiteUnidad($conn, $idMp, $idUnidad){

	$query = " SELECT tramite FROM mpTramiteTemp WHERE idMp = $idMp AND idUnidad = $idUnidad ";

	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['tramite'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}

}

function get_infoEnlaceAnioMesCmasc($conn, $idEnlace, $anio, $mes){

	$query = "  SELECT e.idEnlace, e.nombre, cu.nUnidad, e.apellidoPaterno, e.apellidoMarterno FROM enlace e INNER JOIN CatUnidad cu ON cu.idUnidad = e.idUnidad";

	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idEnlace'];
		$arreglo[$indice][1]=$row['nombre'];
		$arreglo[$indice][2]=$row['nUnidad'];
		$arreglo[$indice][3]=$row['apellidoPaterno'];
		$arreglo[$indice][4]=$row['apellidoMarterno'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}

}	



function getAllEnlacesInfoUNidad($conn, $formatId){

	$query = "  SELECT e.idEnlace, e.nombre, cu.nUnidad, e.apellidoPaterno, e.apellidoMarterno FROM enlace e INNER JOIN CatUnidad cu ON cu.idUnidad = e.idUnidad WHERE e.idFormato = $formatId";

	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idEnlace'];
		$arreglo[$indice][1]=$row['nombre'];
		$arreglo[$indice][2]=$row['nUnidad'];
		$arreglo[$indice][3]=$row['apellidoPaterno'];
		$arreglo[$indice][4]=$row['apellidoMarterno'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}

}

function getMpunidadFormato($conn, $idEnlace, $format, $idMp, $idUnidad){

	$query = "  SELECT mpu.idUnidad, cu.nUnidad

FROM mp INNER JOIN mpUnidad mpu ON mpu.idMp = mp.idMp INNER JOIN CatUnidad cu ON cu.idUnidad = mpu.idUnidad WHERE mpu.idEnlace = $idEnlace AND mp.estatus = 'VI' AND  mpu.idFormato = $format AND mpu.idMp = $idMp AND mpu.idUnidad = $idUnidad";

//echo $query."<br>";



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


function getDistincUnidadesMPsFis($conn, $idEnlace, $idFormato){

	$query = "SELECT DISTINCT mpu.idUnidad, cu.nUnidad

FROM mp INNER JOIN mpUnidad mpu ON mpu.idMp = mp.idMp INNER JOIN CatUnidad cu ON cu.idUnidad = mpu.idUnidad WHERE mpu.idEnlace = $idEnlace AND mp.estatus = 'VI' AND mpu.idFormato = $idFormato";



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

function getDistincUnidadesMPs($conn, $idEnlace){

	$query = "SELECT DISTINCT mp.idUnidad, cu.nUnidad

	FROM mp INNER JOIN enlaceMP emp ON emp.idMp = mp.idMp 
	        INNER JOIN CatUnidad cu ON cu.idUnidad = mp.idUnidad WHERE emp.idEnlace = $idEnlace AND mp.estatus = 'VI' ";

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

function getEstatusNombre($conn, $idEstatus){

		$query = "  SELECT Nombre From CatEstatusResoluciones WHERE EstatusID = $idEstatus";
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['Nombre'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

function getExisteNuc($conn, $idCarpeta, $idUnidad){

	

$query = "SELECT CarpetaID FROM Resoluciones WHERE CarpetaID = $idCarpeta AND idUnidad = $idUnidad";


	$stmt = sqlsrv_query(  $conn, $query,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
	$row_count = sqlsrv_num_rows( $stmt );


	if($row_count > 0){
		return true;
	}
	else{return false;}
}

function getResolucionesMPtotal($conn, $idMp, $estatResolucion, $mes, $anio, $deten){

$query23 = "SELECT  ResolucionID, CarpetaID FROM Resoluciones WHERE AgenteID = $idMp AND EstatusID = $estatResolucion AND mes = $mes AND anio = $anio AND deten = $deten ORDER BY ResolucionID DESC";	


 		$stmt = sqlsrv_query($conn, $query23,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
		$row_count = sqlsrv_num_rows( $stmt );
		
		if($row_count > 0){
		return $row_count;
	}
	else{return 0;}

}




function getResolucionesMP($conn, $idMp, $estatResolucion, $mes, $anio, $deten){

$query = "SELECT  idResolucionMp, idMp, idEstatusResolucion, mes, anio, nuc, expediente FROM resolucionMP WHERE idMp = $idMp AND idEstatusResolucion = $estatResolucion AND mes = $mes AND anio = $anio AND deten = $deten ORDER BY idResolucionMp DESC";

 //"<br><br>".$query;

		$indice = 0;

		$stmt = sqlsrv_query($conn, $query);
		while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
		{

			$arreglo[$indice][0]=$row['idResolucionMp'];
			$arreglo[$indice][1]=$row['idMp'];
			$arreglo[$indice][2]=$row['idEstatusResolucion'];
			$arreglo[$indice][3]=$row['mes'];
			$arreglo[$indice][4]=$row['anio'];
			$arreglo[$indice][5]=$row['nuc'];
			$arreglo[$indice][6]=$row['expediente'];
			$indice++;
		}
		if(isset($arreglo)){return $arreglo;}

}


function getUnidadEnlace($conn, $idEnlace){

		$query = "SELECT idUnidad From enlace WHERE idEnlace = $idEnlace";
		
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idUnidad'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

function getInfoEnlacesCarpetas($conn, $formato){

		$query = "SELECT idEnlace,nombre, apellidoPaterno, apellidoMarterno, correo, estatus, telefono, idFormato, e.idUnidad, cu.nUnidad, cf.nFiscalia2, e.idFiscalia 
FROM enlace e INNER JOIN CatUnidad cu 
ON cu.idUnidad = e.idUnidad INNER JOIN CatFiscalia cf 
ON cf.idFiscalia = e.idFiscalia AND e.idFormato = $formato AND e.estatus = 'VI'
ORDER BY nFiscalia2 ASC";



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
			$arreglo[$indice][8]=$row['idUnidad'];
			$arreglo[$indice][9]=$row['nUnidad'];
			$arreglo[$indice][10]=$row['nFiscalia2'];
			$arreglo[$indice][11]=$row['idFiscalia'];
			$indice++;
		}
		if(isset($arreglo)){return $arreglo;}

}

function getInfOCarpetasEnv($conn, $idEnlace, $idFormato){

		$query = " SELECT enviado, enviadoArchivo FROM enlaceMesValidaEnviado WHERE idEnlace = $idEnlace AND idFormato = $idFormato";

		

		$indice = 0;

		$stmt = sqlsrv_query($conn, $query);
		while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
		{

			$arreglo[$indice][0]=$row['enviado'];
			$arreglo[$indice][1]=$row['enviadoArchivo'];
		}
		if(isset($arreglo)){return $arreglo;}

}

function getArchivosXAnio($conn, $anio){

		$query = "SELECT idArchivo, archivo.idEnlace, e.nombre+' '+e.apellidoPaterno+' '+apellidoMarterno as 'NombreEnlace', cu.nUnidad , nombreArchivo, observacionesUser, tamanio, fechaSubida, ubicacion, mes, anio, estatusArch, observacionesRevision, fechaConcluido 

FROM archivo INNER JOIN enlace e ON e.idEnlace = archivo.idEnlace INNER JOIN CatUnidad cu ON cu.idUnidad = e.idUnidad

WHERE anio = $anio";

		$indice = 0;

		$stmt = sqlsrv_query($conn, $query);
		while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
		{

			$arreglo[$indice][0]=$row['idArchivo'];
			$arreglo[$indice][1]=$row['idEnlace'];
			$arreglo[$indice][2]=$row['nombreArchivo'];
			$arreglo[$indice][3]=$row['observacionesUser'];
			$arreglo[$indice][4]=$row['tamanio'];
			$arreglo[$indice][5]=$row['fechaSubida'];
			$arreglo[$indice][6]=$row['ubicacion'];
			$arreglo[$indice][7]=$row['mes'];
			$arreglo[$indice][8]=$row['anio'];
			$arreglo[$indice][9]=$row['estatusArch'];
			$arreglo[$indice][10]=$row['observacionesRevision'];
			$arreglo[$indice][11]=$row['fechaConcluido'];
			$arreglo[$indice][12]=$row['NombreEnlace'];
			$arreglo[$indice][13]=$row['nUnidad'];

			$indice++;
		}
		if(isset($arreglo)){return $arreglo;}

}

function getArchivosXenlaceAnio($conn, $anio, $enlace, $idTipoArchivo){

		$query = "SELECT idArchivo, idEnlace, nombreArchivo, observacionesUser, tamanio, fechaSubida, ubicacion, mes, anio, estatusArch, observacionesRevision, fechaConcluido FROM archivo WHERE idEnlace = $enlace AND anio = $anio AND idTipoArchivo = $idTipoArchivo" ;




		$indice = 0;

		$stmt = sqlsrv_query($conn, $query);
		while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
		{

			$arreglo[$indice][0]=$row['idArchivo'];
			$arreglo[$indice][1]=$row['idEnlace'];
			$arreglo[$indice][2]=$row['nombreArchivo'];
			$arreglo[$indice][3]=$row['observacionesUser'];
			$arreglo[$indice][4]=$row['tamanio'];
			$arreglo[$indice][5]=$row['fechaSubida'];
			$arreglo[$indice][6]=$row['ubicacion'];
			$arreglo[$indice][7]=$row['mes'];
			$arreglo[$indice][8]=$row['anio'];
			$arreglo[$indice][9]=$row['estatusArch'];
			$arreglo[$indice][10]=$row['observacionesRevision'];
			$arreglo[$indice][11]=$row['fechaConcluido'];

			$indice++;
		}
		if(isset($arreglo)){return $arreglo;}

}

//////// ARCHIVOS QUE SE GENERARN CON FILTROS DE ANIO, MES, IDENLACE, ESTATUS ///////////////

function getArchivosEnlaceFilter($conn, $idEnlace, $anio, $estatus, $format){

		$query = "  SELECT idArchivo, idEnlace, nombreArchivo, observacionesUser, tamanio, fechaSubida, ubicacion, mes, anio, estatusArch, observacionesRevision, fechaConcluido 
  FROM archivo WHERE idEnlace = $idEnlace AND anio = $anio  AND estatusArch = '$estatus' AND idTipoArchivo = $format";

		$indice = 0;

		$stmt = sqlsrv_query($conn, $query);
		while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
		{

			$arreglo[$indice][0]=$row['idArchivo'];
			$arreglo[$indice][1]=$row['idEnlace'];
			$arreglo[$indice][2]=$row['nombreArchivo'];
			$arreglo[$indice][3]=$row['observacionesUser'];
			$arreglo[$indice][4]=$row['tamanio'];
			$arreglo[$indice][5]=$row['fechaSubida'];
			$arreglo[$indice][6]=$row['ubicacion'];
			$arreglo[$indice][7]=$row['mes'];
			$arreglo[$indice][8]=$row['anio'];
			$arreglo[$indice][9]=$row['estatusArch'];
			$arreglo[$indice][10]=$row['observacionesRevision'];
			$arreglo[$indice][11]=$row['fechaConcluido'];

			$indice++;
		}
		if(isset($arreglo)){return $arreglo;}

}

////////// POR SI EL ESTATUS ES TODOS LA VARIABLE ES 0 /////////////////////////////

function getArchivosEnlaceFilter2($conn, $idEnlace, $anio, $mes, $format){

		$query = "  SELECT idArchivo, idEnlace, nombreArchivo, observacionesUser, tamanio, fechaSubida, ubicacion, mes, anio, estatusArch, observacionesRevision, fechaConcluido 
  FROM archivo WHERE idEnlace = $idEnlace AND anio = $anio AND mes = $mes AND idTipoArchivo = $format";

		$indice = 0;

		$stmt = sqlsrv_query($conn, $query);
		while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
		{

			$arreglo[$indice][0]=$row['idArchivo'];
			$arreglo[$indice][1]=$row['idEnlace'];
			$arreglo[$indice][2]=$row['nombreArchivo'];
			$arreglo[$indice][3]=$row['observacionesUser'];
			$arreglo[$indice][4]=$row['tamanio'];
			$arreglo[$indice][5]=$row['fechaSubida'];
			$arreglo[$indice][6]=$row['ubicacion'];
			$arreglo[$indice][7]=$row['mes'];
			$arreglo[$indice][8]=$row['anio'];
			$arreglo[$indice][9]=$row['estatusArch'];
			$arreglo[$indice][10]=$row['observacionesRevision'];
			$arreglo[$indice][11]=$row['fechaConcluido'];

			$indice++;
		}
		if(isset($arreglo)){return $arreglo;}

}

////////// POR SI EL MES ES TODOS LA VARIABLE ES 0 /////////////////////////////

function getArchivosEnlaceFilter3($conn, $idEnlace, $anio, $format){

		$query = "  SELECT idArchivo, idEnlace, nombreArchivo, observacionesUser, tamanio, fechaSubida, ubicacion, mes, anio, estatusArch, observacionesRevision, fechaConcluido 
  FROM archivo WHERE idEnlace = $idEnlace AND anio = $anio AND idTipoArchivo = $format ";



		$indice = 0;

		$stmt = sqlsrv_query($conn, $query);
		while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
		{

			$arreglo[$indice][0]=$row['idArchivo'];
			$arreglo[$indice][1]=$row['idEnlace'];
			$arreglo[$indice][2]=$row['nombreArchivo'];
			$arreglo[$indice][3]=$row['observacionesUser'];
			$arreglo[$indice][4]=$row['tamanio'];
			$arreglo[$indice][5]=$row['fechaSubida'];
			$arreglo[$indice][6]=$row['ubicacion'];
			$arreglo[$indice][7]=$row['mes'];
			$arreglo[$indice][8]=$row['anio'];
			$arreglo[$indice][9]=$row['estatusArch'];
			$arreglo[$indice][10]=$row['observacionesRevision'];
			$arreglo[$indice][11]=$row['fechaConcluido'];

			$indice++;
		}
		if(isset($arreglo)){return $arreglo;}

}

////////// POR SI EL MES ES TODOS LA VARIABLE ES 0 /////////////////////////////

function getArchivosEnlaceFilter4($conn, $idEnlace, $anio, $mes, $estatus, $format){

		$query = "  SELECT idArchivo, idEnlace, nombreArchivo, observacionesUser, tamanio, fechaSubida, ubicacion, mes, anio, estatusArch, observacionesRevision, fechaConcluido 
  FROM archivo WHERE idEnlace = $idEnlace AND anio = $anio AND mes = $mes AND estatusArch = '$estatus' AND idTipoArchivo = $format";



		$indice = 0;

		$stmt = sqlsrv_query($conn, $query);
		while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
		{

			$arreglo[$indice][0]=$row['idArchivo'];
			$arreglo[$indice][1]=$row['idEnlace'];
			$arreglo[$indice][2]=$row['nombreArchivo'];
			$arreglo[$indice][3]=$row['observacionesUser'];
			$arreglo[$indice][4]=$row['tamanio'];
			$arreglo[$indice][5]=$row['fechaSubida'];
			$arreglo[$indice][6]=$row['ubicacion'];
			$arreglo[$indice][7]=$row['mes'];
			$arreglo[$indice][8]=$row['anio'];
			$arreglo[$indice][9]=$row['estatusArch'];
			$arreglo[$indice][10]=$row['observacionesRevision'];
			$arreglo[$indice][11]=$row['fechaConcluido'];

			$indice++;
		}
		if(isset($arreglo)){return $arreglo;}

}

////////////////// PARA LOS FILTROS DE EL ADMINISTRADOR ///////////////

function getArchivosEnlaceFilterAdmin($conn, $idEnlace, $anio, $mes, $idArchivo){

if($idEnlace == "0"){ 

	$query = "  SELECT a.idArchivo, a.idEnlace, a.nombreArchivo, a.observacionesUser, a.tamanio, a.fechaSubida, a.ubicacion, a.mes, a.anio, a.estatusArch, a.observacionesRevision, a.fechaConcluido, 
  e.nombre+'  '+e.apellidoPaterno+' '+e.apellidoMarterno as enlaceName, cu.nUnidad 
  FROM archivo a INNER JOIN enlace e ON e.idEnlace = a.idEnlace INNER JOIN CatUnidad cu ON cu.idUnidad = a.idUnidad WHERE a.anio = $anio AND a.mes = $mes AND a.idTipoArchivo = $idArchivo "; 


 }else{


		$query = "  SELECT a.idArchivo, a.idEnlace, a.nombreArchivo, a.observacionesUser, a.tamanio, a.fechaSubida, a.ubicacion, a.mes, a.anio, a.estatusArch, a.observacionesRevision, a.fechaConcluido, 
  e.nombre+'  '+e.apellidoPaterno+' '+e.apellidoMarterno as enlaceName, cu.nUnidad 
  FROM archivo a INNER JOIN enlace e ON e.idEnlace = a.idEnlace INNER JOIN CatUnidad cu ON cu.idUnidad = a.idUnidad WHERE a.anio = $anio AND a.mes = $mes AND a.idTipoArchivo = $idArchivo  AND a.idEnlace = $idEnlace ";


 }


		$indice = 0;

		$stmt = sqlsrv_query($conn, $query);
		while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
		{

			$arreglo[$indice][0]=$row['idArchivo'];
			$arreglo[$indice][1]=$row['idEnlace'];
			$arreglo[$indice][2]=$row['nombreArchivo'];
			$arreglo[$indice][3]=$row['observacionesUser'];
			$arreglo[$indice][4]=$row['tamanio'];
			$arreglo[$indice][5]=$row['fechaSubida'];
			$arreglo[$indice][6]=$row['ubicacion'];
			$arreglo[$indice][7]=$row['mes'];
			$arreglo[$indice][8]=$row['anio'];
			$arreglo[$indice][9]=$row['estatusArch'];
			$arreglo[$indice][10]=$row['observacionesRevision'];
			$arreglo[$indice][11]=$row['fechaConcluido'];
			$arreglo[$indice][12]=$row['enlaceName'];
			$arreglo[$indice][13]=$row['nUnidad'];

			$indice++;
		}
		if(isset($arreglo)){return $arreglo;}

}


////// FUNCION PARA CREAR O CONSULTAR LOS ARCHIVOS HISTORICOS DESCARGADOS VIA SIRE

function getHistoricosEnlaceFilterAdmin($conn, $idEnlace, $anio, $mes, $idArchivo, $idUsuario){

if($idEnlace == "0"){ 

	$query = "   SELECT        archivoHistorico.idArchivoHistorico, archivoHistorico.nombreArchivo, archivoHistorico.fechaDescarga,archivoHistorico.mes, archivoHistorico.anio, usuario.nombre, usuario.paterno, usuario.materno, CatUnidad.nUnidad, archivoHistorico.idTipoArchivo, usuario.idUsuario, 
                         CASE WHEN archivoHistorico.idTipoArchivo = 1 THEN 'Carpetas de Investigación' WHEN archivoHistorico.idArchivoHistorico = 4 THEN 'Litigación' ELSE 'Desconocido' END AS type_file, CatFiscalia.idFiscalia, 
                         CatFiscalia.nFiscalia
FROM            archivoHistorico INNER JOIN
                         enlace ON archivoHistorico.idEnlace = enlace.idEnlace INNER JOIN
                         usuario ON enlace.idEnlace = usuario.idEnlace INNER JOIN
                         CatUnidad ON archivoHistorico.idUnidad = CatUnidad.idUnidad INNER JOIN
                         CatFiscalia ON enlace.idFiscalia = CatFiscalia.idFiscalia
WHERE        (archivoHistorico.idTipoArchivo = 1) ORDER BY archivoHistorico.idArchivoHistorico DESC "; 


 }else{


		$query = "  SELECT        archivoHistorico.idArchivoHistorico, archivoHistorico.nombreArchivo, archivoHistorico.fechaDescarga,archivoHistorico.mes, archivoHistorico.anio, usuario.nombre, usuario.paterno, usuario.materno, CatUnidad.nUnidad, archivoHistorico.idTipoArchivo, usuario.idUsuario, 
                         CASE WHEN archivoHistorico.idTipoArchivo = 1 THEN 'Carpetas de Investigación' WHEN archivoHistorico.idArchivoHistorico = 4 THEN 'Litigación' ELSE 'Desconocido' END AS type_file, CatFiscalia.idFiscalia, 
                         CatFiscalia.nFiscalia
FROM            archivoHistorico INNER JOIN
                         enlace ON archivoHistorico.idEnlace = enlace.idEnlace INNER JOIN
                         usuario ON enlace.idEnlace = usuario.idEnlace INNER JOIN
                         CatUnidad ON archivoHistorico.idUnidad = CatUnidad.idUnidad INNER JOIN
                         CatFiscalia ON enlace.idFiscalia = CatFiscalia.idFiscalia
WHERE        (archivoHistorico.idTipoArchivo = $idArchivo) AND (usuario.idUsuario = $idUsuario) ORDER BY archivoHistorico.idArchivoHistorico DESC ";


 }


		$indice = 0;

		$stmt = sqlsrv_query($conn, $query);
		while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
		{

			$arreglo[$indice][0]=$row['idArchivoHistorico'];
			$arreglo[$indice][1]=$row['nombreArchivo'];
			$arreglo[$indice][2]=$row['fechaDescarga'];
			$arreglo[$indice][3]=$row['mes'];
			$arreglo[$indice][4]=$row['anio'];
			$arreglo[$indice][5]=$row['nombre'];
			$arreglo[$indice][6]=$row['paterno'];
			$arreglo[$indice][7]=$row['materno'];
			$arreglo[$indice][8]=$row['nUnidad'];
			$arreglo[$indice][9]=$row['idTipoArchivo'];
			$arreglo[$indice][10]=$row['type_file'];
			$arreglo[$indice][11]=$row['idFiscalia'];
			$arreglo[$indice][12]=$row['nFiscalia'];
			//$arreglo[$indice][13]=$row['nUnidad'];

			$indice++;
		}
		if(isset($arreglo)){return $arreglo;}

}

/////////////////////////////////////

function getInfoCarpeta($conn, $mes, $anio, $idUnidad, $idMp){

	$query = "SELECT * FROM Carpetas WHERE idMes = $mes AND idAnio = $anio AND idUnidad = $idUnidad AND idMp = $idMp";



	$indice = 0;

	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{

		$arreglo[$indice][0]=$row['existenciaAnterior'];
		$arreglo[$indice][1]=$row['iniciadasConDetenido'];
		$arreglo[$indice][2]=$row['iniciadasSinDetenido'];
		$arreglo[$indice][3]=$row['totalIniciadas'];
		$arreglo[$indice][4]=$row['recibidasPorOtraUnidad'];
		$arreglo[$indice][5]=$row['totalTrabajar'];
  		$arreglo[$indice][6]=$row['judicializadasConDetenido'];
		$arreglo[$indice][7]=$row['judicializadasSinDetenido'];
		$arreglo[$indice][8]=$row['totalJudicializadas'];
		$arreglo[$indice][9]=$row['abstencionInvestigacion'];
		$arreglo[$indice][10]=$row['archivoTemporal'];
		$arreglo[$indice][11]=$row['noEjercicioAccionPenal'];
		$arreglo[$indice][12]=$row['mediacion'];
		$arreglo[$indice][13]=$row['conciliacion'];
		$arreglo[$indice][14]=$row['criteriosOportunidad'];
		$arreglo[$indice][15]=$row['suspensionCondicional'];
		$arreglo[$indice][16]=$row['incompetencia'];
		$arreglo[$indice][17]=$row['acumulacion'];
		$arreglo[$indice][18]=$row['totalResoluciones'];
		$arreglo[$indice][19]=$row['enviadasUATP'];
		$arreglo[$indice][20]=$row['enviadasUI'];
		$arreglo[$indice][21]=$row['tramite'];

		$arreglo[$indice][22]=$row['idCarpetas'];

		
		$arreglo[$indice][24]=$row['enviImpDes'];
		$arreglo[$indice][25]=$row['reiniciadas'];


		$arreglo[$indice][26]=$row['reiniciadas'];


		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}

}

function validarCarpetaCapturada($conn, $anioCaptura, $mesCapturar, $idUnidad, $idMp){

	$query = "SELECT idCarpetas FROM Carpetas WHERE idMes = $mesCapturar AND idAnio = $anioCaptura AND idMp = $idMp AND idUnidad = $idUnidad";


	$stmt = sqlsrv_query(  $conn, $query,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
	$row_count = sqlsrv_num_rows( $stmt );


	if($row_count > 0){
		return 2;
	}
	else{return 1;}
}

function validarLitigacionCapturada($conn, $anioCaptura, $mesCapturar, $idMp, $idFiscalia){

	$query = "  SELECT idLitigacion FROM litigacion WHERE idMes = $mesCapturar AND idAnio = $anioCaptura AND idMp = $idMp AND idFiscalia = $idFiscalia ";


	$stmt = sqlsrv_query(  $conn, $query,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
	$row_count = sqlsrv_num_rows( $stmt );


	if($row_count > 0){
		return 2;
	}
	else{return 1;}
}


function getEnviadoEnlace($conn, $idEnlace){
	$query = "SELECT enviado, enviadoArchivo FROM enlaceMesValidaEnviado WHERE idEnlace = $idEnlace";
$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['enviado'];
		$arreglo[$indice][1]=$row['enviadoArchivo'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

function getEnviadoEnlaceFormato($conn, $idEnlace, $idFormato){
	$query = "SELECT enviado, enviadoArchivo FROM enlaceMesValidaEnviado WHERE idEnlace = $idEnlace AND idFormato = $idFormato ";
$indice = 0;



	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['enviado'];
		$arreglo[$indice][1]=$row['enviadoArchivo'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

function getEnlaceIDlitigacion($conn, $idEnlace, $idFormato){
	$query = "SELECT idEnlaceLiti FROM enlaceFormato WHERE idEnlace = $idEnlace AND idFormtato = $idFormato";

//echo $query;


$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idEnlaceLiti'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}




function getInfoEnlaceUsuario($conn, $idUsuario){
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
function getIdFiscaliaEnlace($conn, $idEnlace){

	$query = "    SELECT idFiscalia FROm enlace WHERE idEnlace = $idEnlace ";
	
$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idFiscalia'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

function getIdEnlaceUsuario($conn, $idUsuario){
	$query = "  SELECT idEnlace FROM usuario WHERE idUsuario = $idUsuario ";

$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idEnlace'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}


function getCapturadoMesAnioMP($conn, $mesCapturar, $anioCaptura, $idMp, $idUnidad){
	$query = "  SELECT idCarpetas FROM Carpetas WHERE idMes = $mesCapturar AND idAnio = $anioCaptura AND idMp = $idMp AND idUnidad = $idUnidad";

	//(echo $query;


$stmt = sqlsrv_query(  $conn, $query,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
$row_count = sqlsrv_num_rows( $stmt );
	if($row_count > 0){	return 1; }else{return 0;}
}


function getExistenciaAnterior($conn, $mesAnterior, $aniocaptura, $idUnidad, $idMp){

	$query = "SELECT tramite FROM Carpetas WHERE idMes = $mesAnterior AND idAnio = $aniocaptura AND idUnidad = $idUnidad AND idMp = $idMp ";


	
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['tramite'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}


function getInfoUnidad($conn, $idunidad){

		$query = "SELECT idUnidad, nUnidad FROM CatUnidad WHERE idUnidad = $idunidad ";
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

function getUnidadesUsuario($conn, $idUsuario){

	$query = "SELECT idUnidad FROM usuarioUnidad WHERE idUsuario = $idUsuario ";
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idUnidad'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

function getMpsUnidad($conn, $idunidad){

	$query = "SELECT nombre, apellidoPaterno, apellidoMaterno, idUnidad, idMp FROM mp WHERE idUnidad = $idunidad AND estatus = 'VI' ";

	$indice = 0;

	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{

		$arreglo[$indice][0]=$row['nombre'];
		$arreglo[$indice][1]=$row['apellidoPaterno'];
		$arreglo[$indice][2]=$row['apellidoMaterno'];
		$arreglo[$indice][3]=$row['idUnidad'];
		$arreglo[$indice][4]=$row['idMp'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}

}

function getMpsEnlace($conn, $idEnlace){

	$query = "  SELECT mp.idMp, mp.nombre, mp.paterno, mp.materno, mp.idUnidad, cu.nUnidad

	FROM mp INNER JOIN enlaceMP emp ON emp.idMp = mp.idMp 
	        INNER JOIN CatUnidad cu ON cu.idUnidad = mp.idUnidad WHERE emp.idEnlace = $idEnlace AND mp.estatus = 'VI' ORDER BY cu.nUnidad DESC ";


	$indice = 0;

	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{

		$arreglo[$indice][0]=$row['nombre'];
		$arreglo[$indice][1]=$row['paterno'];
		$arreglo[$indice][2]=$row['materno'];
		$arreglo[$indice][3]=$row['idUnidad'];
		$arreglo[$indice][4]=$row['idMp'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}

}

function getMpsEnlaceFormato($conn, $idEnlace, $idArchivo){

	$query = "  SELECT mp.idMp, mp.nombre, mp.paterno, mp.materno, mp.idUnidad, cu.nUnidad, empf.idEnlace, empf.idFormato

	FROM mp INNER JOIN enlaceMpFormato empf ON empf.idMp = mp.idMp
			INNER JOIN CatUnidad cu ON cu.idUnidad = mp.idUnidad WHERE empf.idEnlace = $idEnlace AND empf.idFormato = $idArchivo ";

//echo "<br><br>".$query;
	

	$indice = 0;

	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{

		$arreglo[$indice][0]=$row['nombre'];
		$arreglo[$indice][1]=$row['paterno'];
		$arreglo[$indice][2]=$row['materno'];
		$arreglo[$indice][3]=$row['idUnidad'];
		$arreglo[$indice][4]=$row['idMp'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}

}


function getEnlMpUnidad($conn, $idUnidad, $idEnlace){

		$query = "  SELECT mp.idMp, mp.nombre, mp.paterno, mp.materno, mp.idUnidad, cu.nUnidad

	FROM mp INNER JOIN enlaceMP emp ON emp.idMp = mp.idMp 
	        INNER JOIN CatUnidad cu ON cu.idUnidad = mp.idUnidad WHERE emp.idEnlace = $idEnlace AND mp.estatus = 'VI' AND cu.idUnidad = $idUnidad ORDER BY cu.nUnidad DESC";


	$indice = 0;

	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{

		$arreglo[$indice][0]=$row['nombre'];
		$arreglo[$indice][1]=$row['paterno'];
		$arreglo[$indice][2]=$row['materno'];
		$arreglo[$indice][3]=$row['idUnidad'];
		$arreglo[$indice][4]=$row['idMp'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}

}

function getEnlMpUnidad2($conn, $idUnidad, $idEnlace){

		$query = "  SELECT mp.idMp, mp.nombre, mp.paterno, mp.materno, mpu.idUnidad, cu.nUnidad

FROM mp INNER JOIN mpUnidad mpu ON mpu.idMp = mp.idMp INNER JOIN CatUnidad cu ON cu.idUnidad = mpu.idUnidad WHERE mpu.idEnlace = $idEnlace AND mp.estatus = 'VI' AND mpu.idUnidad = $idUnidad ORDER BY cu.nUnidad DESC";


	$indice = 0;

	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{

		$arreglo[$indice][0]=$row['nombre'];
		$arreglo[$indice][1]=$row['paterno'];
		$arreglo[$indice][2]=$row['materno'];
		$arreglo[$indice][3]=$row['idUnidad'];
		$arreglo[$indice][4]=$row['idMp'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}

}


function getMpsEnlaceUnidad($conn, $idEnlace, $idFormato){

	$query = "SELECT mp.idMp, mp.nombre, mp.paterno, mp.materno, mpu.idUnidad, cu.nUnidad

FROM mp INNER JOIN mpUnidad mpu ON mpu.idMp = mp.idMp INNER JOIN CatUnidad cu ON cu.idUnidad = mpu.idUnidad WHERE mpu.idEnlace = $idEnlace AND mp.estatus = 'VI' AND mpu.idFormato = $idFormato ORDER BY cu.nUnidad ASC";


	$indice = 0;

	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{

		$arreglo[$indice][0]=$row['nombre'];
		$arreglo[$indice][1]=$row['paterno'];
		$arreglo[$indice][2]=$row['materno'];
		$arreglo[$indice][3]=$row['idUnidad'];
		$arreglo[$indice][4]=$row['idMp'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}

}


function getMpsEnlaceUnidadFormato($conn, $idEnlace, $idFormato){

	$query = "SELECT mp.idMp, mp.nombre, mp.paterno, mp.materno, mpu.idUnidad, cu.nUnidad

FROM mp INNER JOIN mpUnidad mpu ON mpu.idMp = mp.idMp INNER JOIN CatUnidad cu ON cu.idUnidad = mpu.idUnidad WHERE mpu.idEnlace = $idEnlace AND mp.estatus = 'VI' AND idFormato = $idFormato  ORDER BY cu.nUnidad ASC";

//echo $query;
	$indice = 0;

	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{

		$arreglo[$indice][0]=$row['nombre'];
		$arreglo[$indice][1]=$row['paterno'];
		$arreglo[$indice][2]=$row['materno'];
		$arreglo[$indice][3]=$row['idUnidad'];
		$arreglo[$indice][4]=$row['idMp'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}

}

function getUnidadesTodasENlace($conn, $idEnlace){

	$query = "SELECT mp.idMp, mp.nombre, mp.paterno, mp.materno, mpu.idUnidad, cu.nUnidad

FROM mp INNER JOIN mpUnidad mpu ON mpu.idMp = mp.idMp INNER JOIN CatUnidad cu ON cu.idUnidad = mpu.idUnidad WHERE mpu.idEnlace = $idEnlace AND mp.estatus = 'VI'";



	$indice = 0;

	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{

		$arreglo[$indice][0]=$row['nombre'];
		$arreglo[$indice][1]=$row['paterno'];
		$arreglo[$indice][2]=$row['materno'];
		$arreglo[$indice][3]=$row['idUnidad'];
		$arreglo[$indice][4]=$row['idMp'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}

}


//// Esta Funcion formatea el nuevo nombre para el archivo que se guardara en el servidor y base de datos quitando acentos y dejando el nombre en solo minusculas

function formatearNombre($cadena){ 
    $tofind = "ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ· "; 
    $replac = "AAAAAAaaaaaaOOOOOOooooooEEEEeeeeCcIIIIiiiiUUUUuuuuyNn-_"; 
    $cadena = utf8_decode($cadena);      
    $cadena = strtr($cadena, utf8_decode($tofind), $replac);  
    $cadena = strtolower($cadena);  
    return utf8_encode($cadena); 
     
}  


////// FUNCION PARA ENCONTRAR EL NIVEL DE SIMILITUD ENTRE DOS CADENAS RECIBIDAS ////////

function similares($str1, $str2) {
    $len1 = strlen($str1);
    $len2 = strlen($str2);
    
    $max = max($len1, $len2);
    
    $similarity = $i = $j = 0;
    
    while (($i < $len1) && isset($str2[$j])) {
        if ($str1[$i] == $str2[$j]) {
            $similarity++;
            $i++;
            $j++;
        } elseif ($len1 < $len2) {
            $len1++;
            $j++;
        } elseif ($len1 > $len2) {
            $i++;
            $len1--;
        } else {
            $i++;
            $j++;
        }
    }

    return round($similarity / $max, 2);
}



function Meses($mes,$año){

	$mes=(int)$mes;

	$dias=0;

	if($mes==1 || $mes ==3 || $mes==5 || $mes==7 || $mes==8 || $mes==10 ||$mes==12){
		$dias=31;

	}
	else if( $mes==4 || $mes==6 || $mes==9 || $mes==11){
		$dias=30;

	}
	else 	{
		if(esBisiesto($año)==1){
			$dias=29;
		}
		else{
			$dias=28;
		}
	}

	return $dias;
}


function Mes_Nombre($mes)
{
	$mes=(int)$mes;
	$mes_nom="";
	switch ($mes)
	{
		case 1:
		$mes_nom="Enero";
		break;
		case 2:
		$mes_nom="Febrero";
		break;
		case 3:
		$mes_nom="Marzo";
		break;
		case 4:
		$mes_nom="Abril";
		break;
		case 5:
		$mes_nom="Mayo";
		break;
		case 6:
		$mes_nom="Junio";
		break;
		case 7:
		$mes_nom="Julio";
		break;
		case 8:
		$mes_nom="Agosto";
		break;
		case 9:
		$mes_nom="Septiembre";
		break;
		case 10:
		$mes_nom="Octubre";
		break;
		case 11:
		$mes_nom="Noviembre";
		break;
		case 12:
		$mes_nom="Diciembre";
		break;
	}
	return $mes_nom;
}

function esBisiesto($year) {
	$year = ($year==0)? date('Y'):$year;
	return ( ($year%4 == 0 && $year%100 != 0) || $year%400 == 0 );
}


function getIPreal(){

	if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"),"unknown"))
	$ip = getenv("HTTP_CLIENT_IP");
	else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
	$ip = getenv("HTTP_X_FORWARDED_FOR");
	else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
	$ip = getenv("REMOTE_ADDR");
	else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
	$ip = $_SERVER['REMOTE_ADDR'];
	else
	$ip = "IP desconocida";
	return($ip);
}

function getDiaActual(){

	$diaActual = date("N");

	switch ($diaActual) {
		case '1':
		return "lunes";
		break;
		case '2':
		return "Martes";
		break;
		case '3':
		return "Miercoles";
		break;
		case '4':
		return "Jueves";
		break;
		case '5':
		return "Viernes";
		break;
		case '6':
		return "Sabado";
		break;
		case '7':
		return "Domingo";
		break;
	}
}


function getCOlorStatusArchivo($conn, $estado){

		$color = "";

		if($estado == "Enviado"){ $color = "rgba(160,202,216,0.8)"; }
		if($estado == "Revisando"){ $color = "rgba(	240, 173, 78,0.8)"; }
		if($estado == "Recibido"){ $color = "rgba(92, 184, 92,0.8)"; }
		if($estado == "Rechazado"){ $color = "rgba(240,89,91,0.8)"; }
		if($estado == "Reenviado"){ $color = "rgba(202,216,160,0.8)"; }

		return $color;	

}

function getTrimestralPeriodsAvailable($conn){

	$query = "SELECT DISTINCT 
				[anio]
				,[idPeriodo]
				,CASE idPeriodo
					WHEN '1' THEN 'Enero - Marzo'
					WHEN '2' THEN 'Abril - Junio'
					WHEN '3' THEN 'Julio - Septiembre'
					WHEN '4' THEN 'Octubre - Diciembre'
					END AS 'nPeriodo'
				,e.estatus
				FROM [ESTADISTICAV2].[trimestral].[seguimiento] s
				FULL OUTER JOIN (
					SELECT TOP 1
					[idAnio]
					,[mesCap]
					,CASE [mesCap]
						WHEN 1 then 'Activo'
						ELSE 'Activo'
						END AS 'estatus'
					FROM [ESTADISTICAV2].[dbo].[enlaceMesValidaEnviado] 
					WHERE idFormato = 11 ORDER BY idAnio, mesCap desc
				) e
				ON s.idPeriodo = e.mesCap
				ORDER BY anio, idPeriodo";

	$indice = 0;

	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{

		$arreglo[$indice][0]=$row['anio'];
		$arreglo[$indice][1]=$row['nPeriodo'];
		$arreglo[$indice][2]=$row['idPeriodo'];
		$arreglo[$indice][3]=$row['estatus'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}

}

function getTrimestralUsersByPeriod($conn, $period, $anio){

	$query = "SELECT ROW_NUMBER() OVER(ORDER BY cf.nFiscalia, u.nombre ASC) AS 'n'
				,e.idEnlace
				,e.idUnidad
				,u.[nombre]
				,u.[paterno]
				,u.[materno]
				,u.[usuario]
				,u.[contrasena]
				,u.[estatus]
				,u.[areaNombre]
				,cf.nFiscalia
				,cu.[nUnidad]
				,CASE ev.[enviado]
					WHEN '0' THEN 'NO'
					WHEN '1' THEN 'SI'
					END AS 'enviado'
				,CASE ev.[enviadoArchivo]
					WHEN '0' THEN 'NO'
					WHEN '1' THEN 'SI'
					END AS 'enviadoArchivo'
				,ev.[mesCap]
				,CASE ev.mesCap
					WHEN '1' THEN 'Enero - Marzo'
					WHEN '2' THEN 'Abril - Junio'
					WHEN '3' THEN 'Julio - Septiembre'
					WHEN '4' THEN 'Octubre - Diciembre'
					END AS 'nPeriodo'
				,sub.idArchivo
				,sub.nombreArchivo
				,sub.ubicacion
				,sub.estatusArch
			FROM [ESTADISTICAV2].[dbo].[usuario] u
			INNER JOIN [ESTADISTICAV2].[dbo].[enlace] e
			ON u.idEnlace = e.idEnlace
			INNER JOIN [ESTADISTICAV2].[dbo].[CatUnidad] cu
			ON e.idUnidad = cu.idUnidad
			INNER JOIN [ESTADISTICAV2].[dbo].[CatFiscalia] cf
			ON cu.idFiscalia = cf.idFiscalia
			LEFT JOIN [ESTADISTICAV2].[dbo].[enlaceMesValidaEnviado] ev
			ON e.idEnlace = ev.idEnlace
			left JOIN (
				SELECT *
					FROM (SELECT *,
								row_number() OVER(PARTITION BY idEnlace ORDER BY fechaSubida DESC) AS date_order
						FROM [ESTADISTICAV2].[dbo].[archivo] WHERE anio = $anio and mes = $period and idTipoArchivo = 11) AS T
					WHERE date_order = 1
			) sub
			ON e.idEnlace = sub.idEnlace
			WHERE ev.idAnio = $anio and ev.mesCap = $period and ev.idFormato = 11 and u.idUsuario not in (156, 165, 170, 206)
			ORDER BY  cf.nFiscalia, u.nombre, u.paterno, u.materno";

	$indice = 0;

	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{

		$arreglo[$indice][0]=$row['nombre'];
		$arreglo[$indice][1]=$row['paterno'];
		$arreglo[$indice][2]=$row['materno'];
		$arreglo[$indice][3]=$row['usuario'];
		$arreglo[$indice][4]=$row['contrasena'];
		$arreglo[$indice][5]=$row['estatus'];
		$arreglo[$indice][6]=$row['areaNombre'];
		$arreglo[$indice][7]=$row['nFiscalia'];
		$arreglo[$indice][8]=$row['nUnidad'];
		$arreglo[$indice][9]=$row['enviado'];
		$arreglo[$indice][10]=$row['enviadoArchivo'];
		$arreglo[$indice][11]=$row['nPeriodo'];
		$arreglo[$indice][12]=$row['idEnlace'];
		$arreglo[$indice][13]=$row['idUnidad'];
		$arreglo[$indice][14]=$row['nombreArchivo'];
		$arreglo[$indice][15]=$row['ubicacion'];
		$arreglo[$indice][16]=$row['estatusArch'];
		$arreglo[$indice][17]=$row['idArchivo'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}

}

function getTrimestralUsersByPastPeriod($conn, $period, $anio){

	$query = "SELECT DISTINCT
				e.idEnlace
				,e.idUnidad
				,u.[nombre]
				,u.[paterno]
				,u.[materno]
				,u.[usuario]
				,u.[contrasena]
				,u.[estatus]
				,u.[areaNombre]
				,cf.nFiscalia
				,cu.[nUnidad]
				,s.idPeriodo
				,CASE s.idPeriodo
					WHEN '1' THEN 'Enero - Marzo'
					WHEN '2' THEN 'Abril - Junio'
					WHEN '3' THEN 'Julio - Septiembre'
					WHEN '4' THEN 'Octubre - Diciembre'
					END AS 'nPeriodo'
			FROM [ESTADISTICAV2].[trimestral].[seguimiento] s
			inner join [ESTADISTICAV2].[dbo].[usuario] u
			on u.idEnlace = s.idEnlace
					INNER JOIN [ESTADISTICAV2].[dbo].[enlace] e
					ON u.idEnlace = e.idEnlace
					INNER JOIN [ESTADISTICAV2].[dbo].[CatUnidad] cu
					ON e.idUnidad = cu.idUnidad
					INNER JOIN [ESTADISTICAV2].[dbo].[CatFiscalia] cf
					ON cu.idFiscalia = cf.idFiscalia
			WHERE anio = $anio and idPeriodo = $period and u.idUsuario not in (156, 165, 170, 206)
			ORDER BY  cf.nFiscalia, u.nombre, u.paterno, u.materno";

	$indice = 0;

	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{

		$arreglo[$indice][0]=$row['nombre'];
		$arreglo[$indice][1]=$row['paterno'];
		$arreglo[$indice][2]=$row['materno'];
		$arreglo[$indice][3]=$row['usuario'];
		$arreglo[$indice][4]=$row['contrasena'];
		$arreglo[$indice][5]=$row['estatus'];
		$arreglo[$indice][6]=$row['areaNombre'];
		$arreglo[$indice][7]=$row['nFiscalia'];
		$arreglo[$indice][8]=$row['nUnidad'];
		$arreglo[$indice][9]=$row['nPeriodo'];
		$arreglo[$indice][10]=$row['idEnlace'];
		$arreglo[$indice][11]=$row['idUnidad'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}

}

function reportByQuestTable($conn, $periodo , $getAnio){

	$query = " SELECT s.idPregunta , p.nombre , SUM(CASE WHEN (s.idPeriodo = $periodo AND s.anio = $getAnio) then s.total end) as 'trimestre'
		          FROM ESTADISTICAV2.trimestral.seguimiento s
		          INNER JOIN trimestral.pregunta p ON p.idPregunta = s.idPregunta
		          GROUP BY p.nombre , s.idPregunta
		          ORDER BY s.idPregunta ASC ";
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	{
		switch ($row['idPregunta']) {
			case 1 : $arreglo[$indice][0] = 1.1; break;
			case 2 : $arreglo[$indice][0] = 1.2; break;
			case 3 : $arreglo[$indice][0] = 2.1; break;
			case 4 : $arreglo[$indice][0] = 2.2; break;
			case 5 : $arreglo[$indice][0] = 3.1; break;
			case 6 : $arreglo[$indice][0] = 3.2; break;
			case 7 : $arreglo[$indice][0] = 3.3; break;
			case 8 : $arreglo[$indice][0] = 4.1; break;
			case 9 : $arreglo[$indice][0] = 4.2; break;
			case 10 : $arreglo[$indice][0] = 5.1; break;
			case 11 : $arreglo[$indice][0] = 5.2; break;
			case 12 : $arreglo[$indice][0] = 5.3; break;
			case 13 : $arreglo[$indice][0] = 5.4; break;
			case 14 : $arreglo[$indice][0] = 5.5; break;
			case 15 : $arreglo[$indice][0] = 6.1; break;
			case 16 : $arreglo[$indice][0] = 6.2; break;
			case 17 : $arreglo[$indice][0] = 6.3; break;
			case 18 : $arreglo[$indice][0] = 7.1; break;
			case 19 : $arreglo[$indice][0] = 7.2; break;
			case 20 : $arreglo[$indice][0] = 7.3; break;
			case 21 : $arreglo[$indice][0] = 7.4; break;
			case 22 : $arreglo[$indice][0] = 7.5; break;
			case 23 : $arreglo[$indice][0] = 7.6; break;
			case 24 : $arreglo[$indice][0] = 7.7; break;
			case 25 : $arreglo[$indice][0] = 7.8; break;
			case 26 : $arreglo[$indice][0] = 7.9; break;
			case 27 : $arreglo[$indice][0] = 7.10; break;
			case 28 : $arreglo[$indice][0] = 7.11; break;
			case 29 : $arreglo[$indice][0] = 7.12; break;
			case 30 : $arreglo[$indice][0] = 7.13; break;
			case 31 : $arreglo[$indice][0] = 7.14; break;
			case 32 : $arreglo[$indice][0] = 7.15; break;
			case 33 : $arreglo[$indice][0] = 7.16; break;
			case 34 : $arreglo[$indice][0] = 8.1; break;
			case 35 : $arreglo[$indice][0] = 8.2; break;
			case 36 : $arreglo[$indice][0] = 8.3; break;
			case 37 : $arreglo[$indice][0] = 8.4; break;
			case 38 : $arreglo[$indice][0] = 8.5; break;
			case 39 : $arreglo[$indice][0] = 8.6; break;
			case 40 : $arreglo[$indice][0] = 8.7; break;
			case 41 : $arreglo[$indice][0] = 8.8; break;
			case 42 : $arreglo[$indice][0] = 8.9; break;
			case 43 : $arreglo[$indice][0] = 8.10; break;
			case 44 : $arreglo[$indice][0] = 8.11; break;
			case 45 : $arreglo[$indice][0] = 8.12; break;
			case 46 : $arreglo[$indice][0] = 8.13; break;
			case 47 : $arreglo[$indice][0] = 8.14; break;
			case 48 : $arreglo[$indice][0] = 9.1; break;
			case 49 : $arreglo[$indice][0] = 9.2; break;
			case 50 : $arreglo[$indice][0] = 9.3; break;
			case 51 : $arreglo[$indice][0] = 9.4; break;
			case 52 : $arreglo[$indice][0] = 10.1; break;
			case 53 : $arreglo[$indice][0] = 10.2; break;
			case 54 : $arreglo[$indice][0] = 10.3; break;
			case 55 : $arreglo[$indice][0] = 10.4; break;
		}
		$arreglo[$indice][1]=$row['nombre'];
		$arreglo[$indice][2]=$row['trimestre'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	
}

function getYearsTrim($conn){
	$query = "SELECT DISTINCT anio FROM ESTADISTICAV2.trimestral.seguimiento ORDER BY anio DESC";
	$indice = 0;

	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['anio'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}

function getPeriodoActual($conn , $anio){
	$query = "SELECT DISTINCT MAX(idPeriodo) AS periodoActual FROM ESTADISTICAV2.trimestral.seguimiento WHERE anio = $anio ";
	$indice = 0;

	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['periodoActual'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}
}


?>
