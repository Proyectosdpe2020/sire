<? 

 include ("../../Conexiones/Conexion.php");
 include ("../../Conexiones/conexionSicap.php");
	include("../../funciones.php");
	include("../../funcioneSicap.php");
	include("../../funcioneLit.php");
	include("../../funcionesLitSENAP.php");

	if (isset($_POST["idEstatusNucs"])){ $idEstatusNucs = $_POST["idEstatusNucs"]; }
	if (isset($_POST["idMp"])){ $idMp = $_POST["idMp"]; }
	if (isset($_POST["anio"])){ $anio = $_POST["anio"]; }
	if (isset($_POST["mes"])){ $mes = $_POST["mes"]; }
	if (isset($_POST["estatus"])){ $estatus = $_POST["estatus"]; }
	if (isset($_POST["nuc"])){ $nuc = $_POST["nuc"]; }
	if (isset($_POST["idUnidad"])){ $idUnidad = $_POST["idUnidad"]; }
	$getNucExpedienteSicap = getNucExpedienteSicap($conSic, $nuc);
	$expediente = $getNucExpedienteSicap[0][0];
	
?>

<div class="modal-header" style="background-color:#152F4A;">
	<center><h4  style="font-weight: bold; color: white;" class="modal-title">Estadística Básica del Sistema Estadistico de Procuración de Justicia (SENAP)</h4></center>
</div>

<div class="modal-body panelunoLitigacion1">
	<div class="row">
		<div class="col-xs-12 col-sm-3 col-md-3">
			<h4>Registro estadistico del NUC: <strong><? echo $nuc; ?></strong></h4>
		</div>
	</div><br>

	<div class="row">
		<!--LISTADO DE OPCIONES-->
		<div class="col-xs-12 col-sm-2 col-md-2">
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="openForm(event, 'showInfoCI')">Estado de la CI</button>
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="openForm(event, 'showAudienciaInicial')">Audiencia Inicial</button>
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="openForm(event, 'showEtapaIntermedia')">Etapa Intermedia</button>
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="openForm(event, 'showMASC')">MASC</button>
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="openForm(event, 'showSobreseimiento')">Sobreseimiento</button>
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="openForm(event, 'showSuspencionCondi')">Suspensión condicional</button>
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="openForm(event, 'showJuicioOral')">Juicio Oral</button>
			<button type="button" class="btn btn-primary btn-lg btn-block" onclick="openForm(event, 'showSentencia')">Sentencia</button>
		</div>
		<!--FORMULARIO ESTADO DE LA CARPETA DE INVESTIGACION-->
		<div class="col-xs-12 col-sm-10 col-md-10 tabcontentLi" id="showInfoCI">
				<div class="row">
					<div class="col-xs-12 col-sm-4 col-md-4">
						<label for="idSegCaso">Seguimiento del caso:</label>
						<input value="<? echo $expediente; ?>" type="text" style="text-transform:uppercase;" class="form-control" id="idSegCaso" name="idSegCaso" onkeyup="javascript:this.value=this.value.toUpperCase();" disabled>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-4">
						<label for="etapaProcesal">Etapa procesal en la que se encuentra la CI:</label>
						<select id="etapaProcesal" name="etapaProcesal" tabindex="6" class="form-control redondear ">
							<option value="0">Selecciona</option>
							<?$getEtapaProcesal = getEtapaProcesal($conSic);
							for ($i=0; $i < sizeof($getEtapaProcesal ); $i++) {
								$idEtapaProcesal = $getEtapaProcesal[$i][0];	$nombre = $getEtapaProcesal[$i][1];	?>
								<option style="color: black; font-weight: bold;" value="<? echo $idEtapaProcesal; ?>"><? echo $nombre; ?> </option>
							<? } ?>
						</select>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-4">
						<label for="tipoAcuerdosRep">En caso de acuerdos reparatorios, ¿tipo de acuerdos reparatorios?: </label>
						<select id="tipoAcuerdosRep" name="tipoAcuerdosRep" tabindex="6" class="form-control redondear ">
							<option value="0">Selecciona</option>
							<?$getTipoAcuerdoRep = getTipoAcuerdoRep($conSic);
							for ($i=0; $i < sizeof($getTipoAcuerdoRep); $i++) {
								$idTipoAcuerdoRep = $getTipoAcuerdoRep[$i][0];	$nombre = $getTipoAcuerdoRep[$i][1];	?>
								<option style="color: black; font-weight: bold;" value="<? echo $idTipoAcuerdoRep; ?>"><? echo $nombre; ?> </option>
							<? } ?>
						</select>
					</div>
				</div><br>
				<div class="row">
					<div class="col-xs-12 col-sm-4 col-md-4">
						<label for="reactivacionCI">En caso de archivo temporal, ¿hubo reactivación de la carpeta de investigación?: </label>
						<select id="reactivacionCI" name="reactivacionCI" tabindex="6" class="form-control redondear ">
							<option value="0">Selecciona</option>
							<?$getOptionDictonomica = getOptionDictonomica($conn);
							for ($i=0; $i < sizeof($getOptionDictonomica); $i++) {
								$idOpcion = $getOptionDictonomica[$i][0];	$opc = $getOptionDictonomica[$i][1];	?>
								<option style="color: black; font-weight: bold;" value="<? echo $idOpcion; ?>"><? echo $opc; ?> </option>
							<? } ?>
						</select>
					</div>
					<div class="col-xs-12 col-sm-4  col-md-4">
						<label for="fechaDeterminacion">Fecha de la determinación :</label>
						<input id="fechaDeterminacion" type="date" value="" name="fechaDeterminacion" class="fechas form-control gehit" />
					</div>
					<div class="col-xs-12 col-sm-4  col-md-4">
						<label for="tipoCriterioOportunidad">En caso de que se determinara por criterios de oportunidad, tipo de criterios de oportunidad :</label>
						<select id="tipoCriterioOportunidad" name="tipoCriterioOportunidad" tabindex="6" class="form-control redondear ">
							<option value="0">Selecciona</option>
							<?$getTipoCriterioOportunidad = getTipoCriterioOportunidad($conSic);
							for ($i=0; $i < sizeof($getTipoCriterioOportunidad); $i++) {
								$idTipoCriterio = $getTipoCriterioOportunidad[$i][0];	$nombre = $getTipoCriterioOportunidad[$i][1];	?>
								<option style="color: black; font-weight: bold;" value="<? echo $idTipoCriterio; ?>"><? echo $nombre; ?> </option>
							<? } ?>
						</select>
					</div>
				</div>
		</div>

  <!--FORMULARIO AUDIENCIA INICIAL-->
		<div class="col-xs-12 col-sm-10 col-md-10 tabcontentLi" id="showAudienciaInicial">
				<div class="row">
					<div class="col-xs-12 col-sm-4 col-md-4">
						<label for="numCausaPenal">Número de asunto asignado a la causa penal: </label>
						<input value="" type="number" class="form-control" id="numCausaPenal" name="numCausaPenal">
					</div>
					<div class="col-xs-12 col-sm-4  col-md-4">
						<label for="fechaCausaPenal">Fecha de ingreso de la causa penal :</label>
						<input id="fechaCausaPenal" type="date" value="" name="fechaCausaPenal" class="fechas form-control gehit" />
					</div>
				</div><br>
				<div class="row">
					<div class="col-xs-12 col-sm-4  col-md-4">
						<label for="audInicial">¿Hubo celebración de audiencia inicial?: </label>
						<select id="audInicial" name="audInicial" tabindex="6" class="form-control redondear"  onchange="validateAudienciaIni()">
							<option value="0">Selecciona</option>
							<?$getOptionDictonomica = getOptionDictonomica($conn);
							for ($i=0; $i < sizeof($getOptionDictonomica); $i++) {
								$idOpcion = $getOptionDictonomica[$i][0];	$opc = $getOptionDictonomica[$i][1];	?>
								<option style="color: black; font-weight: bold;" value="<? echo $idOpcion; ?>"><? echo $opc; ?> </option>
							<? } ?>
						</select>
					</div>
					<div class="col-xs-12 col-sm-4  col-md-4">
						<label for="fechaAudIni">Fecha de la audiencia inicial:</label>
						<input id="fechaAudIni" type="date" value="" name="fechaAudIni" class="fechas form-control gehit" />
					</div>
					<div class="col-xs-12 col-sm-4  col-md-4">
						<label for="MotivoNoAudienciaIni">Motivo por el que no se celebró la audiencia inicial: </label>
						<select id="MotivoNoAudienciaIni" name="MotivoNoAudienciaIni" tabindex="6" class="form-control redondear" >
							<option value="0">Selecciona</option>
							<?$getMotivoNoAudienciaInicial = getMotivoNoAudienciaInicial($conSic);
							for ($i=0; $i < sizeof($getMotivoNoAudienciaInicial); $i++) {
								$idMotivoNoCelebracionAudienciaIni = $getMotivoNoAudienciaInicial[$i][0];	$nombre = $getMotivoNoAudienciaInicial[$i][1];	?>
								<option style="color: black; font-weight: bold;" value="<? echo $idMotivoNoCelebracionAudienciaIni; ?>"><? echo $nombre; ?> </option>
							<? } ?>
						</select>
					</div>
				</div><br>
				<div class="row">
					<div class="col-xs-12 col-sm-4  col-md-4">
						<label for="formImputacion">¿Hubo formulación de la imputación?: </label>
						<select id="formImputacion" name="formImputacion" tabindex="6" class="form-control redondear"  onchange="validateFormulacionImpu()">
							<option value="0">Selecciona</option>
							<?$getOptionDictonomica = getOptionDictonomica($conn);
							for ($i=0; $i < sizeof($getOptionDictonomica); $i++) {
								$idOpcion = $getOptionDictonomica[$i][0];	$opc = $getOptionDictonomica[$i][1];	?>
								<option style="color: black; font-weight: bold;" value="<? echo $idOpcion; ?>"><? echo $opc; ?> </option>
							<? } ?>
						</select>
					</div>
					<div class="col-xs-12 col-sm-4  col-md-4">
						<label for="fechaFormulacionImpu">Fecha de formulación de la imputación:</label>
						<input id="fechaFormulacionImpu" type="date" value="" name="fechaFormulacionImpu" class="fechas form-control gehit"  />
					</div>
				</div><br>
				<div class="row">
					<div class="col-xs-12 col-sm-4  col-md-4">
						<label for="resolAutoVincu">Resolución del auto de vinculación a proceso: </label>
						<select id="resolAutoVincu" name="resolAutoVincu" tabindex="6" class="form-control redondear"  onchange="validateResolAutoVincu()">
							<option value="0">Selecciona</option>
							<?$getResolAutoVincu = getResolAutoVincu($conn);
							for ($i=0; $i < sizeof($getResolAutoVincu); $i++) {
								$idResolAutoVinculacion = $getResolAutoVincu[$i][0];	$nombre = $getResolAutoVincu[$i][1];	?>
								<option style="color: black; font-weight: bold;" value="<? echo $idResolAutoVinculacion; ?>"><? echo $nombre; ?> </option>
							<? } ?>
						</select>
					</div>
					<div class="col-xs-12 col-sm-4  col-md-4">
						<label for="fechaAutoVinculacion">Fecha en que se dictó el auto de vinculación a proceso: </label>
						<input id="fechaAutoVinculacion" type="date" value="" name="fechaAutoVinculacion" class="fechas form-control gehit"  />
					</div>
				</div><br>
				<div class="row">
					<div class="col-xs-12 col-sm-4  col-md-4">
						<label for="MedCautelar">¿Se impuso medida cautelar?: </label>
						<select id="MedCautelar" name="MedCautelar" tabindex="6" class="form-control redondear"  onchange="validateMedidaCautelar()">
							<option value="0">Selecciona</option>
							<?$getOptionDictonomica = getOptionDictonomica($conn);
							for ($i=0; $i < sizeof($getOptionDictonomica); $i++) {
								$idOpcion = $getOptionDictonomica[$i][0];	$opc = $getOptionDictonomica[$i][1];	?>
								<option style="color: black; font-weight: bold;" value="<? echo $idOpcion; ?>"><? echo $opc; ?> </option>
							<? } ?>
						</select>
					</div>
					<div class="col-xs-12 col-sm-4  col-md-4">
						<label for="tipoMedCautelar">Tipo de medidas cautelares impuestas: </label>
						<select id="tipoMedCautelar" name="tipoMedCautelar" tabindex="6" class="form-control redondear" >
							<option value="0">Selecciona</option>
							<?$getTipoMedCautelar = getTipoMedCautelar($conSic);
							for ($i=0; $i < sizeof($getTipoMedCautelar); $i++) {
								$idTipoMedidaCautelar = $getTipoMedCautelar[$i][0];	$nombre = $getTipoMedCautelar[$i][1];	?>
								<option style="color: black; font-weight: bold;" value="<? echo $idTipoMedidaCautelar; ?>"><? echo $nombre; ?> </option>
							<? } ?>
						</select>
					</div>
				</div><br>
				<div class="row">
					<div class="col-xs-12 col-sm-4  col-md-4">
						<label for="fechaCierreInvest">Fecha  del cierre de la investigación: </label>
						<input id="fechaCierreInvest" type="date" value="" name="fechaCierreInvest" class="fechas form-control gehit" />
					</div>
					<div class="col-xs-12 col-sm-4  col-md-4">
						<label for="formulacionAcusacion">¿Se formuló acusación?: </label>
						<select id="formulacionAcusacion" name="formulacionAcusacion" tabindex="6" class="form-control redondear"  onchange="validateFormuAcusa()">
							<option value="0">Selecciona</option>
							<?$getOptionDictonomica = getOptionDictonomica($conn);
							for ($i=0; $i < sizeof($getOptionDictonomica); $i++) {
								$idOpcion = $getOptionDictonomica[$i][0];	$opc = $getOptionDictonomica[$i][1];	?>
								<option style="color: black; font-weight: bold;" value="<? echo $idOpcion; ?>"><? echo $opc; ?> </option>
							<? } ?>
						</select>
					</div>
					<div class="col-xs-12 col-sm-4  col-md-4">
						<label for="fechaEscritoAcusacion">Fecha del escrito de acusación: </label>
						<input id="fechaEscritoAcusacion" type="date" value="" name="fechaEscritoAcusacion" class="fechas form-control gehit"  />
					</div>
				</div>
		</div>

			<!--FORMULARIO ETAPA INTERMEDIA-->
		<div class="col-xs-12 col-sm-10 col-md-10 tabcontentLi" id="showEtapaIntermedia">
				<div class="row">
					<div class="col-xs-12 col-sm-4  col-md-4">
						<label for="audienciaIntermedia">¿Hubo celebración de la audiencia intermedia?: </label>
						<select id="audienciaIntermedia" name="audienciaIntermedia" tabindex="6" class="form-control redondear"  onchange="validateAudIntermedia()">
							<option value="0">Selecciona</option>
							<?$getOptionDictonomica = getOptionDictonomica($conn);
							for ($i=0; $i < sizeof($getOptionDictonomica); $i++) {
								$idOpcion = $getOptionDictonomica[$i][0];	$opc = $getOptionDictonomica[$i][1];	?>
								<option style="color: black; font-weight: bold;" value="<? echo $idOpcion; ?>"><? echo $opc; ?> </option>
							<? } ?>
						</select>
					</div>
					<div class="col-xs-12 col-sm-4  col-md-4">
						<label for="fechaAudienciaIntermedia">Fecha de la celebración de la audiencia intermedia: </label>
						<input id="fechaAudienciaIntermedia" type="date" value="" name="fechaAudienciaIntermedia" class="fechas form-control gehit"  />
					</div>
					<div class="col-xs-12 col-sm-4  col-md-4">
						<label for="mediosDePrueba">¿Hubo presentación de medios de prueba?: </label>
						<select id="mediosDePrueba" name="mediosDePrueba" tabindex="6" class="form-control redondear"  onchange="validateMediosPruebaSI()">
							<option value="0">Selecciona</option>
							<?$getOptionDictonomica = getOptionDictonomica($conn);
							for ($i=0; $i < sizeof($getOptionDictonomica); $i++) {
								$idOpcion = $getOptionDictonomica[$i][0];	$opc = $getOptionDictonomica[$i][1];	?>
								<option style="color: black; font-weight: bold;" value="<? echo $idOpcion; ?>"><? echo $opc; ?> </option>
							<? } ?>
						</select>
					</div>
				</div><br>
				<div class="row">
					<div class="col-xs-12 col-sm-4  col-md-4">
						<label for="tipoMedioPrueba">Medios de prueba (presentados /excluidos): </label>
						<select id="tipoMedioPrueba" name="tipoMedioPrueba" tabindex="6" class="form-control redondear"  >
							<option value="0">Selecciona</option>
							<?$getTipoMedioPrueba = getTipoMedioPrueba($conSic);
							for ($i=0; $i < sizeof($getTipoMedioPrueba); $i++) {
								$idTipoMedioPrueba = $getTipoMedioPrueba[$i][0];	$nombre = $getTipoMedioPrueba[$i][1];	?>
								<option style="color: black; font-weight: bold;" value="<? echo $idTipoMedioPrueba; ?>"><? echo $nombre; ?> </option>
							<? } ?>
						</select>
					</div>
					<div class="col-xs-12 col-sm-4  col-md-4">
						<label for="acuerdoProbatorio">¿Contó con acuerdos probatorios?: </label>
						<select id="acuerdoProbatorio" name="acuerdoProbatorio" tabindex="6" class="form-control redondear" >
							<option value="0">Selecciona</option>
							<?$getOptionDictonomica = getOptionDictonomica($conn);
							for ($i=0; $i < sizeof($getOptionDictonomica); $i++) {
								$idOpcion = $getOptionDictonomica[$i][0];	$opc = $getOptionDictonomica[$i][1];	?>
								<option style="color: black; font-weight: bold;" value="<? echo $idOpcion; ?>"><? echo $opc; ?> </option>
							<? } ?>
						</select>
					</div>
					<div class="col-xs-12 col-sm-4  col-md-4">
						<label for="apertJuiOral">¿Se dictó auto de apertura a juicio oral?: </label>
						<select id="apertJuiOral" name="apertJuiOral" tabindex="6" class="form-control redondear" >
							<option value="0">Selecciona</option>
							<?$getOptionDictonomica = getOptionDictonomica($conn);
							for ($i=0; $i < sizeof($getOptionDictonomica); $i++) {
								$idOpcion = $getOptionDictonomica[$i][0];	$opc = $getOptionDictonomica[$i][1];	?>
								<option style="color: black; font-weight: bold;" value="<? echo $idOpcion; ?>"><? echo $opc; ?> </option>
							<? } ?>
						</select>
					</div>
				</div>
		</div>

			<!--FORMULARIO MASC-->
		<div class="col-xs-12 col-sm-10 col-md-10 tabcontentLi" id="showMASC">
				<div class="row">
					<div class="col-xs-12 col-sm-4  col-md-4">
						<label for="derivadoMASC">¿El asunto fue derivado a MASC?: </label>
						<select id="derivadoMASC" name="derivadoMASC" tabindex="6" class="form-control redondear"  onchange="validateMASC()">
							<option value="0">Selecciona</option>
							<?$getOptionDictonomica = getOptionDictonomica($conn);
							for ($i=0; $i < sizeof($getOptionDictonomica); $i++) {
								$idOpcion = $getOptionDictonomica[$i][0];	$opc = $getOptionDictonomica[$i][1];	?>
								<option style="color: black; font-weight: bold;" value="<? echo $idOpcion; ?>"><? echo $opc; ?> </option>
							<? } ?>
						</select>
					</div>
					<div class="col-xs-12 col-sm-4  col-md-4">
						<label for="autoridadMASC">Autoridad que deriva el MASC: </label>
						<select id="autoridadMASC" name="autoridadMASC" tabindex="6" class="form-control redondear" >
							<option value="0">Selecciona</option>
							<?$getAutoridadMASC = getAutoridadMASC($conn);
							for ($i=0; $i < sizeof($getAutoridadMASC); $i++) {
								$idAutoridadMASC = $getAutoridadMASC[$i][0];	$nombre = $getAutoridadMASC[$i][1];	?>
								<option style="color: black; font-weight: bold;" value="<? echo $idAutoridadMASC; ?>"><? echo $nombre; ?> </option>
							<? } ?>
						</select>
					</div>
					<div class="col-xs-12 col-sm-4  col-md-4">
						<label for="fechaDerivaMASC">Fecha en que se deriva a MASC: </label>
						<input id="fechaDerivaMASC" type="date" value="" name="fechaDerivaMASC" class="fechas form-control gehit"  />
					</div>
				</div><br>
				<div class="row">
					<div class="col-xs-12 col-sm-4  col-md-4">
						<label for="tipoMASC">Tipo de MASC: </label>
						<select id="tipoMASC" name="tipoMASC" tabindex="6" class="form-control redondear"  >
							<option value="0">Selecciona</option>
							<?$getTipoMASC = getTipoMASC($conSic);
							for ($i=0; $i < sizeof($getTipoMASC); $i++) {
								$idTipoMASC = $getTipoMASC[$i][0];	$nombre = $getTipoMASC[$i][1];	?>
								<option style="color: black; font-weight: bold;" value="<? echo $idTipoMASC; ?>"><? echo $nombre; ?> </option>
							<? } ?>
						</select>
					</div>
					<div class="col-xs-12 col-sm-4  col-md-4">
						<label for="tipoCumplimiento">Tipo de cumplimineto: </label>
						<select id="tipoCumplimiento" name="tipoCumplimiento" tabindex="6" class="form-control redondear" >
							<option value="0">Selecciona</option>
							<?$getTipoCumplimineto = getTipoCumplimiento($conn);
							for ($i=0; $i < sizeof($getTipoCumplimineto); $i++) {
								$idTipoCumplimineto = $getTipoCumplimineto[$i][0];	$nombre = $getTipoCumplimineto[$i][1];	?>
								<option style="color: black; font-weight: bold;" value="<? echo $idTipoCumplimineto; ?>"><? echo $nombre; ?> </option>
							<? } ?>
						</select>
					</div>
					<div class="col-xs-12 col-sm-4  col-md-4">
						<label for="fechaCumplimentoMASC">Fecha en que se cumplimentó el MASC: </label>
						<input id="fechaCumplimentoMASC" type="date" value="" name="fechaCumplimentoMASC" class="fechas form-control gehit" />
					</div>
				</div><br>
				<div class="row">
					<div class="col-xs-12 col-sm-4 col-md-4">
						<label for="montoRepDanio">Monto de la reparación del daño:</label>
						<input value="0" type="number" class="form-control" id="montoRepDanio" name="montoRepDanio" >
					</div>
				</div>
		</div>

		<!--FORMULARIO SOBRESEIMINETO-->
		<div class="col-xs-12 col-sm-10 col-md-10 tabcontentLi" id="showSobreseimiento">
				<div class="row">
					<div class="col-xs-12 col-sm-4  col-md-4">
						<label for="etapaSobreseimineto">En caso de sobreseimiento, etapa en la que se dictó el sobreseimiento: </label>
						<select id="etapaSobreseimineto" name="etapaSobreseimineto" tabindex="6" class="form-control redondear" onchange="validateSobreseimiento()">
							<option value="0">Selecciona</option>
							<?$getEtapaSobreseimiento = getEtapaSobreseimiento($conSic);
							for ($i=0; $i < sizeof($getEtapaSobreseimiento); $i++) {
								$idEtapaSobreseimiento = $getEtapaSobreseimiento[$i][0];	$nombre = $getEtapaSobreseimiento[$i][1];	?>
								<option style="color: black; font-weight: bold;" value="<? echo $idEtapaSobreseimiento; ?>"><? echo $nombre; ?> </option>
							<? } ?>
						</select>
					</div>
					<div class="col-xs-12 col-sm-4  col-md-4">
						<label for="causaSobreseimiento">Causas de sobreseimiento: </label>
						<select id="causaSobreseimiento" name="causaSobreseimiento" tabindex="6" class="form-control redondear" >
							<option value="0">Selecciona</option>
							<?$getCausasSobreseimiento = getCausasSobreseimiento($conSic);
							for ($i=0; $i < sizeof($getCausasSobreseimiento); $i++) {
								$idCausasSobreseimiento = $getCausasSobreseimiento[$i][0];	$nombre = $getCausasSobreseimiento[$i][1];	?>
								<option style="color: black; font-weight: bold;" value="<? echo $idCausasSobreseimiento; ?>"><? echo $nombre; ?> </option>
							<? } ?>
						</select>
					</div>
					<div class="col-xs-12 col-sm-4  col-md-4">
						<label for="fechaDictoSobresei">Fecha en que se dictó el sobreseimiento: </label>
						<input id="fechaDictoSobresei" type="date" value="" name="fechaDictoSobresei" class="fechas form-control gehit" />
					</div>
				</div><br>
				<div class="row">
					<div class="col-xs-12 col-sm-4  col-md-4">
						<label for="tipoSobreseimiento">Tipo de sobreseimiento: </label>
						<select id="tipoSobreseimiento" name="tipoSobreseimiento" tabindex="6" class="form-control redondear" >
							<option value="0">Selecciona</option>
							<?$getTipoSobreseimiento = getTipoSobreseimiento($conn);
							for ($i=0; $i < sizeof($getTipoSobreseimiento); $i++) {
								$idTipoSobreseimiento = $getTipoSobreseimiento[$i][0];	$nombre = $getTipoSobreseimiento[$i][1];	?>
								<option style="color: black; font-weight: bold;" value="<? echo $idTipoSobreseimiento; ?>"><? echo $nombre; ?> </option>
							<? } ?>
						</select>
					</div>
				</div>
		</div>

		<!--FORMULARIO SUSPENCION CONDICIONAL-->
		<div class="col-xs-12 col-sm-10 col-md-10 tabcontentLi" id="showSuspencionCondi">
				<div class="row">
					<div class="col-xs-12 col-sm-4  col-md-4">
						<label for="dictoSuspCondProc">¿Se dictó suspensión condicional del proceso?: </label>
						<select id="dictoSuspCondProc" name="dictoSuspCondProc" tabindex="6" class="form-control redondear" >
							<option value="0">Selecciona</option>
							<?$getOptionDictonomica = getOptionDictonomica($conn);
							for ($i=0; $i < sizeof($getOptionDictonomica); $i++) {
								$idOpcion = $getOptionDictonomica[$i][0];	$opc = $getOptionDictonomica[$i][1];	?>
								<option style="color: black; font-weight: bold;" value="<? echo $idOpcion; ?>"><? echo $opc; ?> </option>
							<? } ?>
						</select>
					</div>
					<div class="col-xs-12 col-sm-4  col-md-4">
						<label for="fechaDictoSuspConProc">Fecha en que se dictó la suspensión condicional del proceso: </label>
						<input id="fechaDictoSuspConProc" type="date" value="" name="fechaDictoSuspConProc" class="fechas form-control gehit" />
					</div>
					<div class="col-xs-12 col-sm-4  col-md-4">
						<label for="etapaSuspCondProc">Etapa en la que se dictó  la suspensión condicional del proceso: </label>
						<select id="etapaSuspCondProc" name="etapaSuspCondProc" tabindex="6" class="form-control redondear"  >
							<option value="0">Selecciona</option>
							<?$getEtapaSuspCondProc = getEtapaSuspCondProc($conSic);
							for ($i=0; $i < sizeof($getEtapaSuspCondProc); $i++) {
								$idEtapaSuspCondProc = $getEtapaSuspCondProc[$i][0];	$nombre = $getEtapaSuspCondProc[$i][1];	?>
								<option style="color: black; font-weight: bold;" value="<? echo $idEtapaSuspCondProc; ?>"><? echo $nombre; ?> </option>
							<? } ?>
						</select>
					</div>
				</div><br>
				<div class="row">
					<div class="col-xs-12 col-sm-4  col-md-4">
						<label for="CondImpuSuspConProc">Tipo de condiciones impuestas durante la suspensión condicional del proceso: </label>
						<select id="CondImpuSuspConProc" name="CondImpuSuspConProc" tabindex="6" class="form-control redondear"  >
							<option value="0">Selecciona</option>
							<?$getCondImpuSuspConProc = getCondImpuSuspConProc($conSic);
							for ($i=0; $i < sizeof($getCondImpuSuspConProc); $i++) {
								$idCondImpuSuspConProc = $getCondImpuSuspConProc[$i][0];	$nombre = $getCondImpuSuspConProc[$i][1];	?>
								<option style="color: black; font-weight: bold;" value="<? echo $idCondImpuSuspConProc; ?>"><? echo $nombre; ?> </option>
							<? } ?>
						</select>
					</div>
					<div class="col-xs-12 col-sm-4  col-md-4">
						<label for="reaperturaProc">¿Hubo reapertura del proceso?: </label>
						<select id="reaperturaProc" name="reaperturaProc" tabindex="6" class="form-control redondear" >
							<option value="0">Selecciona</option>
							<?$getOptionDictonomica = getOptionDictonomica($conn);
							for ($i=0; $i < sizeof($getOptionDictonomica); $i++) {
								$idOpcion = $getOptionDictonomica[$i][0];	$opc = $getOptionDictonomica[$i][1];	?>
								<option style="color: black; font-weight: bold;" value="<? echo $idOpcion; ?>"><? echo $opc; ?> </option>
							<? } ?>
						</select>
					</div>
					<div class="col-xs-12 col-sm-4  col-md-4">
						<label for="fechaReaperProc">Fecha de la reapertura del proceso: </label>
						<input id="fechaReaperProc" type="date" value="" name="fechaReaperProc" class="fechas form-control gehit"  />
					</div>
				</div><br>
				<div class="row">
					<div class="col-xs-12 col-sm-4  col-md-4">
						<label for="fechaCumpSuspCondPro">Fecha en que se cumplimentó la suspensión condicional del proceso: </label>
						<input id="fechaCumpSuspCondPro" type="date" value="" name="fechaCumpSuspCondPro" class="fechas form-control gehit"  />
					</div>
				</div>
		</div>

		<!--FORMULARIO JUICIO ORAL-->
		<div class="col-xs-12 col-sm-10 col-md-10 tabcontentLi" id="showJuicioOral">
				<div class="row">
					<div class="col-xs-12 col-sm-4  col-md-4">
						<label for="fechaJuicioOral">Fecha de la celebración de la audiencia de juicio: </label>
						<input id="fechaJuicioOral" type="date" value="" name="fechaJuicioOral" class="fechas form-control gehit"  />
					</div>
					<div class="col-xs-12 col-sm-4  col-md-4">
						<label for="pruebasAudienciaJuicio">Tipos de pruebas desahogadas durante la audiencia de juicio: </label>
						<select id="pruebasAudienciaJuicio" name="pruebasAudienciaJuicio" tabindex="6" class="form-control redondear"  >
							<option value="0">Selecciona</option>
							<?$getPruebasAudienciaJuicio = getPruebasAudienciaJuicio($conSic);
							for ($i=0; $i < sizeof($getPruebasAudienciaJuicio); $i++) {
								$idPruebasAudienciaJuicio = $getPruebasAudienciaJuicio[$i][0];	$nombre = $getPruebasAudienciaJuicio[$i][1];	?>
								<option style="color: black; font-weight: bold;" value="<? echo $idPruebasAudienciaJuicio; ?>"><? echo $nombre; ?> </option>
							<? } ?>
						</select>
					</div>
				</div>
		</div>

			<!--FORMULARIO SENTENCIA-->
		<div class="col-xs-12 col-sm-10 col-md-10 tabcontentLi" id="showSentencia">
				<div class="row">
					<div class="col-xs-12 col-sm-4  col-md-4">
						<label for="sentDerivaProcAbrv">¿La sentencia fue derivada de un procedimiento abreviado?:  </label>
						<select id="sentDerivaProcAbrv" name="sentDerivaProcAbrv" tabindex="6" class="form-control redondear"  >
							<option value="0">Selecciona</option>
							<?$getOptionDictonomica = getOptionDictonomica($conn);
							for ($i=0; $i < sizeof($getOptionDictonomica); $i++) {
								$idOpcion = $getOptionDictonomica[$i][0];	$opc = $getOptionDictonomica[$i][1];	?>
								<option style="color: black; font-weight: bold;" value="<? echo $idOpcion; ?>"><? echo $opc; ?> </option>
							<? } ?>
						</select>
					</div>
					<div class="col-xs-12 col-sm-4  col-md-4">
						<label for="fechaDictoProcAbrv">Fecha en que se dictó el procedimiento abreviado: </label>
						<input id="fechaDictoProcAbrv" type="date" value="" name="fechaDictoProcAbrv" class="fechas form-control gehit"  />
					</div>
					<div class="col-xs-12 col-sm-4  col-md-4">
						<label for="fechaDictoSentencia">Fecha en que se dictó la sentencia: </label>
						<input id="fechaDictoSentencia" type="date" value="" name="fechaDictoSentencia" class="fechas form-control gehit"  />
					</div>
				</div><br>
				<div class="row">
					<div class="col-xs-12 col-sm-4  col-md-4">
						<label for="tipoSentencia">Tipo de sentencia: </label>
						<select id="tipoSentencia" name="tipoSentencia" tabindex="6" class="form-control redondear"  >
							<option value="0">Selecciona</option>
							<?$getTipoSentencia = getTipoSentencia($conn);
							for ($i=0; $i < sizeof($getTipoSentencia); $i++) {
								$idTipoSentencia = $getTipoSentencia[$i][0];	$nombre = $getTipoSentencia[$i][1];	?>
								<option style="color: black; font-weight: bold;" value="<? echo $idTipoSentencia; ?>"><? echo $nombre; ?> </option>
							<? } ?>
						</select>
					</div>
					<div class="col-xs-12 col-sm-4  col-md-4">
						<label for="aniosPrision">Tiempo en prisión (años): </label>
						<input id="aniosPrision" type="number" value="" name="aniosPrision" class="fechas form-control gehit"  />
					</div>
					<div class="col-xs-12 col-sm-4  col-md-4">
						<label for="montoRepDanio">Monto de la reparación del daño impuesta: </label>
						<input id="montoRepDanio" type="number" value="" name="montoRepDanio" class="fechas form-control gehit"  />
					</div>
				</div><br>
				<div class="row">
					<div class="col-xs-12 col-sm-4  col-md-4">
						<label for="sentenciaFirme">¿La sentencia se encuentra firme?: </label>
						<select id="sentenciaFirme" name="sentenciaFirme" tabindex="6" class="form-control redondear"  >
								<option value="0">Selecciona</option>
								<?$getOptionDictonomica = getOptionDictonomica($conn);
								for ($i=0; $i < sizeof($getOptionDictonomica); $i++) {
									$idOpcion = $getOptionDictonomica[$i][0];	$opc = $getOptionDictonomica[$i][1];	?>
									<option style="color: black; font-weight: bold;" value="<? echo $idOpcion; ?>"><? echo $opc; ?> </option>
								<? } ?>
							</select>
					</div>
				</div>
		</div>

	</div><br><br>

</div>

<div class="modal-footer">
	<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-6"><center><button style="width: 88%;" onclick="closeModalNucsLitigInfo()" type="button" class="btn btn-default redondear" data-dismiss="modal">Salir</button></center></div>
			<div class="col-xs-12 col-sm-12 col-md-6"><center><button style="width: 88%;" onclick="" type="button" class="btn btn-primary redondear" >Guardar</button></center></div>
	</div>
</div>




																												
																													
																																																			
																					