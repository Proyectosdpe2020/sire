<?

function getDatosLitigacionMpUnidad2($conn, $mes, $anio, $idUnidad){


	$query = "  SELECT sum([existenciaAnterior]) as 'existenciaAnterior', sum([carpetasJudicializadas]) as 'carpetasJudicializadas', sum([judicializadasConDetenido]) as 'judicializadasConDetenido', sum([judicializadasSinDetenido]) as 'judicializadasSinDetenido', sum([autoDeVinculacion]) as 'autoDeVinculacion', sum([autoDeNoVinculacion]) as 'autoDeNoVinculacion', sum([Mixtos]) as 'Mixtos', sum([imposicionMedidasCautelares]) as 'imposicionMedidasCautelares',
  sum([prisionPreventivaOficiosa]) as 'prisionPreventivaOficiosa', sum([prisionPreventivaJustificada]) as 'prisionPreventivaJustificada', sum([presentacionPeriodicaAnteElJuez]) as 'presentacionPeriodicaAnteElJuez', sum([exhibicionGarantiaEconomica]) as 'exhibicionGarantiaEconomica', sum([embargoDeBienes]) as 'embargoDeBienes', sum([inmovilizacionDeCuentasValores]) as 'inmovilizacionDeCuentasValores',
  sum([prohibicionSalirSinAutorizacionDelJuez]) as 'prohibicionSalirSinAutorizacionDelJuez', sum([sometimientoCuidadoVigilanciaInstitucion]) as 'sometimientoCuidadoVigilanciaInstitucion', sum([prohibicionConcurrirDeterminadasReunionesLugares]) as 'prohibicionConcurrirDeterminadasReunionesLugares', sum([prohibicionConvivirComunicarseDeterminadasPersonas]) as 'prohibicionConvivirComunicarseDeterminadasPersonas',
  sum([separacionInmediataDelDomicilio]) as 'separacionInmediataDelDomicilio', sum([suspensionTemporalEjercicioDelCargo]) as 'suspensionTemporalEjercicioDelCargo', sum([suspensionTemporalActividadProfesionalLaboral]) as 'suspensionTemporalActividadProfesionalLaboral', sum([colocacionLocalizadoresElectronicos]) as 'colocacionLocalizadoresElectronicos', sum([resguardoPropioDomicilioModalidades]) as 'resguardoPropioDomicilioModalidades',
  sum([sobreseimientosDecretados]) as 'sobreseimientosDecretados', sum([sobreseimientosPrescripcionAccionPenal]) as 'sobreseimientosPrescripcionAccionPenal', sum([sobreseimientosMecanismosAlternativos]) as 'sobreseimientosMecanismosAlternativos', sum([sobreseimientosAcuerdoReparatorio]) as 'sobreseimientosAcuerdoReparatorio', sum([sobreseimientosSuspensionCondicionalProceso]) as 'sobreseimientosSuspensionCondicionalProceso',
  sum([sobreseimientosCriterioOportunidad]) as 'sobreseimientosCriterioOportunidad', sum([terminacionAnticipada]) as 'terminacionAnticipada', sum([procedimientosAbreviados]) as 'procedimientosAbreviados', sum([acumulacion]) as 'acumulacion', sum([citaciones]) as 'citaciones', sum([cateosSolilcitados]) as 'cateosSolilcitados', sum([cateosConcedidos]) as 'cateosConcedidos', sum([cateosNegados]) as 'cateosNegados', sum([ordenesNegadas]) as 'ordenesNegadas',
  sum([ordenesNegadasAprehension]) as 'ordenesNegadasAprehension', sum([ordenesNegadasComparecencia]) as 'ordenesNegadasComparecencia', sum([desistimientoDelRecurso]) as 'desistimientoDelRecurso', sum([desistimientoDelRecursoParterAcusado]) as 'desistimientoDelRecursoParterAcusado',sum([desistimientoDelRecursoParteDefensor]) as 'desistimientoDelRecursoParteDefensor', sum([desistimientoDelRecursoMP]) as 'desistimientoDelRecursoMP',
  sum([apelacionesNoAdmitidas]) as 'apelacionesNoAdmitidas', sum([sentenciasDictadas]) as 'sentenciasDictadas', sum([sentenciasDictadasRevoca]) as 'sentenciasDictadasRevoca', sum([sentenciasDictadasModifica]) as 'sentenciasDictadasModifica', sum([sentenciasDictadasConfirma]) as 'sentenciasDictadasConfirma', sum([reposicionProcedimiento]) as 'reposicionProcedimiento', sum([totalJudicializadasTramite]) as 'totalJudicializadasTramite',
  sum([mandamientosJudicialesGirados]) as 'mandamientosJudicialesGirados', sum([MandamientosJudicialesGiradosOrdenesAprehension]) as 'MandamientosJudicialesGiradosOrdenesAprehension', sum([MandamientosJudicialesGiradosOrdenesComparecencia]) as 'MandamientosJudicialesGiradosOrdenesComparecencia',sum([mandamientosJudicialesCumplidos]) as 'mandamientosJudicialesCumplidos',
  sum([MandamientosJudicialesCumplidosOrdenesAprehension]) as 'MandamientosJudicialesCumplidosOrdenesAprehension', sum([MandamientosJudicialesCumplidosOrdenesComparecencia]) as 'MandamientosJudicialesCumplidosOrdenesComparecencia', sum([totalAudiencias]) as 'totalAudiencias', sum([acusacionesPresentadas]) as 'acusacionesPresentadas', sum([audienciaIntermediaEscrita]) as 'audienciaIntermediaEscrita', sum([audienciaIntermediaOral]) as 'audienciaIntermediaOral',
  sum([solucionesAlternas]) as 'solucionesAlternas', sum([solucionesAlternasSuspensionCondicionalProceso]) as 'solucionesAlternasSuspensionCondicionalProceso', sum([solucionesAlternasAcuerdoReparatorio]) as 'solucionesAlternasAcuerdoReparatorio', sum([sentencias]) as 'sentencias', sum([sentenciasCondenatorias]) as 'sentenciasCondenatorias', sum([sentenciasAbsolutorias]) as 'sentenciasAbsolutorias', sum([sentenciasMixtas]) as 'sentenciasMixtas',
  sum([sentenciasCondenaReparacionDanos]) as 'sentenciasCondenaReparacionDanos', sum([sentenciasNoCondenaReparacionDanos]) as 'sentenciasNoCondenaReparacionDanos', sum([incompetencias]) as 'incompetencias', sum([incompetenciasDecretadas]) as 'incompetenciasDecretadas', sum([incompetenciasAdmitidas]) as 'incompetenciasAdmitidas', sum([apelacionesContraResolucionJuezControl]) as 'apelacionesContraResolucionJuezControl',
  sum([apelacionesNegarAnticipoPrueba]) as 'apelacionesNegarAnticipoPrueba', sum([apelacionesNegarAcuerdoReparatorio]) as 'apelacionesNegarAcuerdoReparatorio', sum([apelacionesNegarCancelarOrdenAprehension]) as 'apelacionesNegarCancelarOrdenAprehension', sum([apelacionesNegarOrdenCateo]) as 'apelacionesNegarOrdenCateo', sum([apelacionesProvidenciasPrecautoriasMedidaCautelar]) as 'apelacionesProvidenciasPrecautoriasMedidaCautelar',
  sum([apelacionesQuePonganTerminoAlProcedimiento]) as 'apelacionesQuePonganTerminoAlProcedimiento', sum([apelacionesAutoQueResuelveVinculacionAProceso]) as 'apelacionesAutoQueResuelveVinculacionAProceso', sum([apelacionesQueConcedanRevoquenNieguenSuspension]) as 'apelacionesQueConcedanRevoquenNieguenSuspension', sum([apelacionesNegativaAbrirProcedimientoAbreviado]) as 'apelacionesNegativaAbrirProcedimientoAbreviado',
  sum([apelacionesSetenciaDefinitivaProcedimientoAbreviado]) as 'apelacionesSetenciaDefinitivaProcedimientoAbreviado', sum([apelacionesExcluirMedioPrueba]) as 'apelacionesExcluirMedioPrueba', sum([apelacionesContraResolucionesTribunalEnjuiciamiento]) as 'apelacionesContraResolucionesTribunalEnjuiciamiento', sum([apelacionesDesistimientoAccionPenal]) as 'apelacionesDesistimientoAccionPenal', sum([apelacionesSentenciaDefinitiva]) as 'apelacionesSentenciaDefinitiva',
  sum([deLasSentenciasDictadas]) as 'deLasSentenciasDictadas', sum([revocacionesFavorablesAlMP]) as 'revocacionesFavorablesAlMP', sum([modificacionesFavorablesAlMP]) as 'modificacionesFavorablesAlMP', sum([confirmacionesFavorablesAlMP]) as 'confirmacionesFavorablesAlMP', sum([porCambioDeclaradosSituacionJuridicaDeclaradaSinMateria]) as 'porCambioDeclaradosSituacionJuridicaDeclaradaSinMateria', sum([FormulaImputacion_Soli]) as 'FormulaImputacion_Soli',
  sum([FormulaImputacion_Otorga]) as 'FormulaImputacion_Otorga', sum([FormulaImputacion_Negadas]) as 'FormulaImputacion_Negadas', sum([LegalDetencion]) as 'LegalDetencion', sum([IlegalDetencion]) as 'IlegalDetencion', sum([Med_CautelresSolicitadas]) as 'Med_CautelresSolicitadas',sum([Med_CautelaresNegadas]) as 'Med_CautelaresNegadas', sum([Med_CautelaresOtorgadas]) as 'Med_CautelaresOtorgadas', sum([recibiOtmp]) as 'recibiOtmp', sum([cesefunciones]) as 'cesefunciones', sum([recibiOtmp]) as 'recibiOtmp' , sum([ordenesSolicitadas]) as 'ordenesSolicitadas', sum([ordenesSolicitadasAprehension]) as 'ordenesSolicitadasAprehension', sum([ordenesSolicitadasComparecencia]) as 'ordenesSolicitadasComparecencia', sum([medidasProteccion]) as 'medidasProteccion', sum([totalVictProt]) as 'totalVictProt', sum([actosInvestigacionControlJudicial]) as 'actosInvestigacionControlJudicial', sum([controlJudicialIntervencionTR]) as 'controlJudicialIntervencionTR', sum([controlJudicialTomaMuestras]) as 'controlJudicialTomaMuestras' , sum([controlJudicialExhumacion]) as 'controlJudicialExhumacion', sum([controlJudicialObDatosReservados]) as 'controlJudicialObDatosReservados', sum([controlJudicialIntervencionCME]) as 'controlJudicialIntervencionCME', sum([controlJudicialProvPrecautoria]) as 'controlJudicialProvPrecautoria', sum([actosInvestigacionSinControlJudicial]) as 'actosInvestigacionSinControlJudicial', sum([sinControlJudicialCadCustodia]) as 'sinControlJudicialCadCustodia', sum([sinControlJudicialInspLugDis]) as 'sinControlJudicialInspLugDis', sum([sinControlJudicialInspInmuebles]) as 'sinControlJudicialInspInmuebles', sum([sinControlJudicialEntrevistasTestigos]) as 'sinControlJudicialEntrevistasTestigos', sum([sinControlJudicialReconocimientoPer]) as 'sinControlJudicialReconocimientoPer', sum([sinControlJudicialSolInfoPericiales]) as 'sinControlJudicialSolInfoPericiales', sum([sinControlJudicialInfInstiSeg]) as 'sinControlJudicialInfInstiSeg', sum([sinControlJudicialexamenFisPersona]) as 'sinControlJudicialexamenFisPersona', sum([resolucionesJuicioOral]) as 'resolucionesJuicioOral', sum([audienciaJuicioOral]) as 'audienciaJuicioOral', sum([audienciaFallo]) as 'audienciaFallo', sum([absolutorio]) as 'absolutorio', sum([audienciaIndiviSancion]) as 'audienciaIndiviSancion', sum([procedimientoEspecial]) as 'procedimientoEspecial', sum([audienciaCondenatorio]) as 'audienciaCondenatorio', sum([mecanismosAceleracion]) as 'mecanismosAceleracion', sum([apelacionesAmparo]) as 'apelacionesAmparo', sum([amparos]) as 'amparos', sum([amparoDirecto]) as 'amparoDirecto', sum([amparoIndirecto]) as 'amparoIndirecto'
   FROM Litigacion WHERE idMes = $mes AND idAnio = $anio AND idUnidad = $idUnidad";



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
		$arreglo[$indice][100]=$row['recibiOtmp'];
		$arreglo[$indice][101]=$row['cesefunciones'];

		$arreglo[$indice][105]=$row['recibiOtmp'];
		$arreglo[$indice][106]=$row['cesefunciones'];

		$arreglo[$indice][107]=$row['ordenesSolicitadas'];
  $arreglo[$indice][108]=$row['ordenesSolicitadasAprehension'];
  $arreglo[$indice][109]=$row['ordenesSolicitadasComparecencia'];
  $arreglo[$indice][110]=$row['medidasProteccion'];
  $arreglo[$indice][111]=$row['totalVictProt'];
  $arreglo[$indice][112]=$row['actosInvestigacionControlJudicial'];
  $arreglo[$indice][113]=$row['controlJudicialIntervencionTR'];
  $arreglo[$indice][114]=$row['controlJudicialTomaMuestras'];
  $arreglo[$indice][115]=$row['controlJudicialExhumacion'];
  $arreglo[$indice][116]=$row['controlJudicialObDatosReservados'];
  $arreglo[$indice][117]=$row['controlJudicialIntervencionCME'];
  $arreglo[$indice][118]=$row['controlJudicialProvPrecautoria'];
  $arreglo[$indice][119]=$row['actosInvestigacionSinControlJudicial'];
  $arreglo[$indice][120]=$row['sinControlJudicialCadCustodia'];
  $arreglo[$indice][121]=$row['sinControlJudicialInspLugDis'];
  $arreglo[$indice][122]=$row['sinControlJudicialInspInmuebles'];
  $arreglo[$indice][123]=$row['sinControlJudicialEntrevistasTestigos'];
  $arreglo[$indice][124]=$row['sinControlJudicialReconocimientoPer'];
  $arreglo[$indice][125]=$row['sinControlJudicialSolInfoPericiales'];
  $arreglo[$indice][126]=$row['sinControlJudicialInfInstiSeg'];
  $arreglo[$indice][127]=$row['sinControlJudicialexamenFisPersona'];
  $arreglo[$indice][128]=$row['resolucionesJuicioOral'];
  $arreglo[$indice][129]=$row['audienciaJuicioOral'];
  $arreglo[$indice][130]=$row['audienciaFallo'];
  $arreglo[$indice][131]=$row['absolutorio'];
  $arreglo[$indice][132]=$row['audienciaIndiviSancion'];
  $arreglo[$indice][133]=$row['procedimientoEspecial'];
  $arreglo[$indice][134]=$row['audienciaCondenatorio'];
  $arreglo[$indice][135]=$row['mecanismosAceleracion'];
  $arreglo[$indice][136]=$row['apelacionesAmparo'];
  $arreglo[$indice][137]=$row['amparos'];
  $arreglo[$indice][138]=$row['amparoDirecto'];
  $arreglo[$indice][139]=$row['amparoIndirecto'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}

}	

function getNameFiscaEnlace2($conn, $idEnlace){

		$query = "  SELECT f.nFiscalia FROM enlace e INNER JOIN CatFiscalia F ON f.idFiscalia = e.idFiscalia WHERE e.idEnlace = $idEnlace";

			$indice=0;
			$stmt = sqlsrv_query( $conn, $query);
			while(	$row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC )){
				
				$arreglo[$indice][0]=$row['nFiscalia'];	

				$indice++;				
			}			
			if(isset($arreglo)){return $arreglo;}


}
////// OBTIENE DATOS EXTRAS SI SE QUIERE 
function getLastDeterminacionCarpetaLitigacion($conn, $nuc, $estatResolucion){

	$query = " SELECT idEstatusNucs, nuc, idUnidad, fecha, idmp FROM estatusNucs 
	WHERE idEstatusNucs IN( SELECT MAX(idEstatusNucs) FROM estatusNucs WHERE nuc = $nuc ) AND idEstatus = $estatResolucion ";


	$indice = 0;

		$stmt = sqlsrv_query($conn, $query);
		while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
		{
			$arreglo[$indice][0]=$row['idEstatusNucs'];
			$arreglo[$indice][1]=$row['nuc'];
			$arreglo[$indice][2]=$row['idUnidad'];
			$arreglo[$indice][3]=$row['idmp'];
			$indice++;
		}
		if(isset($arreglo)){return $arreglo;}

}

////// OBTIENE LA ULTIMA DETERMINACION DE UNA CARPETA PARA SABER DONDE FUE DONDE SE DETERMINO POR ULTIMA VEZ

function getLastDeterminacionCarpetaLitig($conn, $nuc){

	$query = " SELECT idEstatusNucs, nuc, idUnidad, fecha, idEstatus, idCarpeta FROM estatusNucs 
	WHERE idEstatusNucs IN( SELECT MAX(idEstatusNucs) FROM estatusNucs WHERE nuc = '$nuc' ) ";



	$indice = 0;

		$stmt = sqlsrv_query($conn, $query);
		while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
		{
			$arreglo[$indice][0]=$row['idEstatusNucs'];
			$arreglo[$indice][1]=$row['nuc'];
			$arreglo[$indice][2]=$row['idUnidad'];
			$arreglo[$indice][3]=$row['idEstatus'];
			$arreglo[$indice][4]=$row['idCarpeta'];
			$indice++;
		}
		if(isset($arreglo)){return $arreglo;}

}

function getDistincCarpetasAgenteLitigacion($conn, $idMp, $estatus, $mes, $anio, $idUnidad){


		if($estatus == 60 || $estatus == 61 || $estatus == 63 ){

			$query = " SELECT nuc FROM estatusNucs WHERE idMp = $idMp AND idEstatus = $estatus AND mes = $mes AND anio = $anio AND idUnidad = $idUnidad";

		}else{
		$query = " SELECT DISTINCT nuc FROM estatusNucs WHERE idMp = $idMp AND idEstatus = $estatus AND mes = $mes AND anio = $anio AND idUnidad = $idUnidad Group BY nuc ";
		}
		//echo $query."<br>";

   		$indice = 0;

		$stmt = sqlsrv_query($conn, $query);

		while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
		{
			$arreglo[$indice][0]=$row['nuc'];
			$indice++;
		}
		if(isset($arreglo)){return $arreglo;}

}


function get_datos_carpeta_capturadoLiti($conn,$nuc)
		{
			$indice=0;
			$consulta="SELECT CarpetaID, NUC, Expediente, fechaCaptura, FechaInicio, FechaComision, Contar from Carpeta where NUC=".$nuc;

			$stmt = sqlsrv_query( $conn, $consulta);
			while(	$row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC )){
				
				$arreglo[$indice][0]=$row['CarpetaID'];	
				$arreglo[$indice][1]=$row['NUC'];	
				$arreglo[$indice][2]=$row['Expediente'];	
				$arreglo[$indice][3]=$row['fechaCaptura'];	
				$arreglo[$indice][4]=$row['FechaInicio'];	
				$arreglo[$indice][5]=$row['FechaComision'];	
				$arreglo[$indice][6]=$row['Contar'];	

				$indice++;				
			}			
			if(isset($arreglo)){return $arreglo;}
		}



function get_existeCarpetaNucsLiti($conn, $nuc, $anio, $mes, $idMp, $idUnidad, $idEstatus)
		{



			$indice=0;
			$consulta="SELECT DISTINCT idCarpeta from estatusNucs where nuc = $nuc AND anio = $anio AND mes = $mes AND idMp = $idMp AND idUnidad = $idUnidad AND idEstatus = $idEstatus";


			$stmt = sqlsrv_query( $conn, $consulta);
			while(	$row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC )){
				
				$arreglo[$indice][0]=$row['idCarpeta'];	

				$indice++;				
			}			
			if(isset($arreglo)){return $arreglo;}
		}




function getLastDeterminacionCarpetalit($conn, $idCarp){

	$query = " SELECT ResolucionID, CarpetaID, idUnidad, Fechaingreso, EstatusID FROM Resoluciones 
	WHERE ResolucionID IN( SELECT MAX(ResolucionID) FROM Resoluciones WHERE CarpetaID = $idCarp ) ";

	$indice = 0;

		$stmt = sqlsrv_query($conn, $query);
		while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
		{
			$arreglo[$indice][0]=$row['ResolucionID'];
			$arreglo[$indice][1]=$row['CarpetaID'];
			$arreglo[$indice][2]=$row['idUnidad'];
			$arreglo[$indice][3]=$row['EstatusID'];
			$indice++;
		}
		if(isset($arreglo)){return $arreglo;}

}

/////////////////////////////////////////////////////////



//////////////////////////////////////////////////////////

function getDistincCarpetasAgenteDetemrn20Lit($conn, $idMp, $mes, $anio,  $deten ,  $estatus, $idUnidad){
		

		if($estatus == 60 || $estatus == 61 || $estatus == 63 ){


				$query = "  SELECT nuc FROM estatusNucs 
			  WHERE idMp = $idMp AND mes = $mes AND anio = $anio AND  idEstatus = $estatus AND idUnidad = $idUnidad";


		}else{

					$query = "  SELECT DISTINCT nuc FROM estatusNucs 
			  WHERE idMp = $idMp AND mes = $mes AND anio = $anio AND  idEstatus = $estatus AND idUnidad = $idUnidad  Group BY nuc, idEstatus";

		}
			   $indice = 0;

					$stmt = sqlsrv_query($conn, $query);
					while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
					{
						$arreglo[$indice][0]=$row['nuc'];
						//$arreglo[$indice][1]=$row['EstatusID'];
						//$arreglo[$indice][2]=$row['deten'];
						$indice++;
					}
					if(isset($arreglo)){return $arreglo;}		

}

//////////////////////////// para saber donde se encuentra determninado con el ulitmo estatus del nuc

function getLAstResolucionesFromAdetermLit($conn, $idMp, $estatResolucion, $mes, $anio, $deten, $idUnidad){

	include ("Conexiones/conexionSicap.php");
 include ("Conexiones/Conexion.php");


 				$carpeAgente =  getDistincCarpetasAgenteDetemrn20Lit($conn, $idMp, $mes, $anio, 0, $estatResolucion, $idUnidad);

					$numResol = 0;

				          for ($i=0; $i < sizeof($carpeAgente); $i++) { 				      
				                          $numResol++; 
				                               }

				          	if($numResol > 0){
																return $numResol;
															}
															else{return 0;}
	

} 


///////////////////////////////////////////////////////////////


function validarCarpetaCapturadaLiti($conn, $anioCaptura, $mesCapturar, $idMp){

	$query = "  SELECT idLitigacion FROM Litigacion WHERE idMes = $mesCapturar AND idAnio = $anioCaptura AND idMp = $idMp";


	//echo $query;
	$stmt = sqlsrv_query(  $conn, $query,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
	$row_count = sqlsrv_num_rows( $stmt );


	if($row_count > 0){
		return 2;
	}
	else{return 1;}
}


function validarCarpetaCapturadaLitiUnidad($conn, $anioCaptura, $mesCapturar, $idMp, $idUnidad){

	$query = "  SELECT idLitigacion FROM Litigacion WHERE idMes = $mesCapturar AND idAnio = $anioCaptura AND idMp = $idMp AND idUnidad = $idUnidad";


	$stmt = sqlsrv_query(  $conn, $query,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
	$row_count = sqlsrv_num_rows( $stmt );


	if($row_count > 0){
		return 2;
	}
	else{return 1;}
}


function validarEstatusShowInfo($estatResolucion){

	if( $estatResolucion == 1 || $estatResolucion == 2 || $estatResolucion == 3 || $estatResolucion == 4 || $estatResolucion == 19 || $estatResolucion == 17 || $estatResolucion == 18 || $estatResolucion == 20  || $estatResolucion == 21 || $estatResolucion== 22 || $estatResolucion == 23  || $estatResolucion == 24 || $estatResolucion == 25 || $estatResolucion == 26 || $estatResolucion == 27 || $estatResolucion == 28 || $estatResolucion == 29  || $estatResolucion == 30 || $estatResolucion == 31 || $estatResolucion == 95 || $estatResolucion == 61 || $estatResolucion == 63 || $estatResolucion == 99 || $estatResolucion == 89 || $estatResolucion == 101 || $estatResolucion == 103 || $estatResolucion == 105 || $estatResolucion == 106 || $estatResolucion == 89 || $estatResolucion == 107 || $estatResolucion == 108 || $estatResolucion == 109 || $estatResolucion == 110 || $estatResolucion == 111 || $estatResolucion == 64 || $estatResolucion == 60 || $estatResolucion == 14 || $estatResolucion == 65 || $estatResolucion == 66 || $estatResolucion == 67 || $estatResolucion == 68 || $estatResolucion == 90 || $estatResolucion == 91 || $estatResolucion == 129 ||  $estatResolucion == 57){
		return True;
	}
	else{
		return False;
	}
}









?>