<? 

 include ("../../Conexiones/Conexion.php");
 include ("../../Conexiones/conexionSicap.php");
	include("../../funciones.php");
	include("../../funcioneSicap.php");
	include("../../funcioneLit.php");
	include("../../funcionesLitSENAP.php");

	if (isset($_POST["idEstatusNucs"])){ $idEstatusNucs = $_POST["idEstatusNucs"]; }
	if (isset($_POST["estatus"])){ $estatus = $_POST["estatus"]; }
	if (isset($_POST["nuc"])){ $nuc = $_POST["nuc"]; }
	$getNucExpedienteSicap = getNucExpedienteSicap($conSic, $nuc);
	$expediente = $getNucExpedienteSicap[0][0];

	if($estatus == 19 || $estatus == 14){ if (isset($_POST["idResolMP"])){ $idResolMP = $_POST["idResolMP"]; } }
	
?>

<div class="modal-header" style="background-color:#152F4A;">
	<center><h4  style="font-weight: bold; color: white;" class="modal-title">Estadística Básica del Sistema Estadistico de Procuración de Justicia (SENAP)</h4></center>
</div>

<div class="modal-body ">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12">
			<h4>Registro estadistico del NUC: <strong><? echo $nuc; ?></strong></h4>
		</div>
	</div><br>

 <? if($estatus == 3 || $estatus == 4){
	 	$getData = getDataFechaFormImpu($conn, $idEstatusNucs);
	 	if(sizeof($getData) > 0){ 
	 		$opcInsert = 1; 
	 		$fecha = $getData[0][2] ->format('Y-m-d'); 
	 	}else{ 	$opcInsert = 0; }
	 ?>
	<div class="row">
		<div class="col-xs-12 col-sm-12  col-md-12">
			<label for="fechaFormulacionImpu">Fecha de formulación de la imputación: </label>
			<input id="fechaFormulacionImpu" type="date" value="<?if($opcInsert == 1){echo $fecha;}?>" name="fechaFormulacionImpu" class="fechas form-control gehit"  />
		</div>
	</div><br><br><br><br>
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-6">
			<button style="width: 88%;" onclick="closeModalNucsLitigInfo()" type="button" class="btn btn-default redondear" data-dismiss="modal">Salir</button>
		</div>
		<div class="col-xs-12 col-sm-6  col-md-6 ">
			<button style="width: 88%;" onclick="insertFormImputacion_db(<? echo $idEstatusNucs; ?> , <? echo $estatus; ?> , <? echo $nuc; ?> , <? echo $opcInsert; ?>)" type="button" class="btn btn-primary redondear" >Guardar</button>
		</div>
	</div>
 <? } ?>

 <? if($estatus == 19){ 
 	$getData = getDataFechaAutoVincuProc($conn, $idResolMP);
	 	if(sizeof($getData) > 0){ 
	 		$opcInsert = 1; 
	 		$fecha = $getData[0][2] ->format('Y-m-d'); 
	 	}else{ 	$opcInsert = 0; }
	 	?>
	<div class="row">
		<!--Resolución del auto de vinculación a proceso :-->
		<div class="col-xs-12 col-sm-12  col-md-12">
			<label for="fechaAutoVinculacion">Fecha en que se dictó el auto de vinculación a proceso: </label>
			<input id="fechaAutoVinculacion" type="date" value="<?if($opcInsert == 1){echo $fecha;}?>" name="fechaAutoVinculacion" class="fechas form-control gehit"  />
		</div>
	</div><br><br><br><br>
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-6">
			<button style="width: 88%;" onclick="closeModalNucsLitigInfo()" type="button" class="btn btn-default redondear" data-dismiss="modal">Salir</button>
		</div>
		<div class="col-xs-12 col-sm-6  col-md-6 ">
			<button style="width: 88%;" onclick="insertFormAutoVincuProc_db(<? echo $idResolMP; ?> , <? echo $estatus; ?> , <? echo $nuc; ?> , <? echo $opcInsert; ?>)" type="button" class="btn btn-primary redondear" >Guardar</button>
		</div>
	</div>
 <? } ?>
 	<!-- Termina ¿Hubo formulación de la imputación?:-->

 <? if($estatus == 17 || $estatus == 18 || $estatus == 20  || $estatus == 21 || $estatus == 22 || $estatus == 23  || $estatus == 24 || $estatus == 25 || $estatus == 26 || $estatus == 27 || $estatus == 28 || $estatus == 29  || $estatus == 30 || $estatus == 31 || $estatus == 95){ 
 		$getData = getDataMedidaCautelar($conn, $idEstatusNucs);
	 	if(sizeof($getData) > 0){ 
	 		$opcInsert = 1; 
	 		$fechaCierreInvest = $getData[0][2] ->format('Y-m-d'); 
	 		$formulacionAcusacion = $getData[0][3];
	 		$fechaEscritoAcusacion = $getData[0][4] ->format('Y-m-d'); 
	 	}else{ 	$opcInsert = 0; } 
	?>
	<div class="row">
		<div class="col-xs-12 col-sm-12  col-md-12">
			<!--¿Se impuso medida cautelar? :-->
			<div class="row">
				<div class="col-xs-12 col-sm-12  col-md-12">
					<label for="tipoMedCautelar">Tipo de medidas cautelares impuestas: </label>
					<select id="tipoMedCautelar" name="tipoMedCautelar" tabindex="6" class="form-control redondear" disabled >
						<?$getTipoMedCautelar = getTipoMedCautelar($conSic);
						for ($i=0; $i < sizeof($getTipoMedCautelar); $i++) {
							$idTipoMedidaCautelar = $getTipoMedCautelar[$i][0];	$nombre = $getTipoMedCautelar[$i][1];	
							if(($estatus == 17 || $estatus == 18)  && $idTipoMedidaCautelar == 14){?>
							<option style="color: black; font-weight: bold;" value="<? echo $idTipoMedidaCautelar; ?>" selected><? echo $nombre; ?> </option>
						 <?   } ?>
						 <?if($estatus == 95 && $idTipoMedidaCautelar == 1){?>
							<option style="color: black; font-weight: bold;" value="<? echo $idTipoMedidaCautelar; ?>" selected><? echo $nombre; ?> </option>
						 <?   } ?>
						 <?if($estatus == 21 && $idTipoMedidaCautelar == 3){?>
							<option style="color: black; font-weight: bold;" value="<? echo $idTipoMedidaCautelar; ?>" selected><? echo $nombre; ?> </option>
						 <?   } ?>
						 <?if($estatus == 20 && $idTipoMedidaCautelar == 2){?>
							<option style="color: black; font-weight: bold;" value="<? echo $idTipoMedidaCautelar; ?>" selected><? echo $nombre; ?> </option>
						 <?   } ?>
						 <?if($estatus == 22 && $idTipoMedidaCautelar == 4){?>
							<option style="color: black; font-weight: bold;" value="<? echo $idTipoMedidaCautelar; ?>" selected><? echo $nombre; ?> </option>
						 <?   } ?>
						 <?if($estatus == 23 && $idTipoMedidaCautelar == 5){?>
							<option style="color: black; font-weight: bold;" value="<? echo $idTipoMedidaCautelar; ?>" selected><? echo $nombre; ?> </option>
						 <?   } ?>
						 <?if($estatus == 24 && $idTipoMedidaCautelar == 6){?>
							<option style="color: black; font-weight: bold;" value="<? echo $idTipoMedidaCautelar; ?>" selected><? echo $nombre; ?> </option>
						 <?   } ?>
						 <?if($estatus == 25 && $idTipoMedidaCautelar == 7){?>
							<option style="color: black; font-weight: bold;" value="<? echo $idTipoMedidaCautelar; ?>" selected><? echo $nombre; ?> </option>
						 <?   } ?>
						 <?if($estatus == 26 && $idTipoMedidaCautelar == 8){?>
							<option style="color: black; font-weight: bold;" value="<? echo $idTipoMedidaCautelar; ?>" selected><? echo $nombre; ?> </option>
						 <?   } ?>
						  <?if($estatus == 27 && $idTipoMedidaCautelar == 9){?>
							<option style="color: black; font-weight: bold;" value="<? echo $idTipoMedidaCautelar; ?>" selected><? echo $nombre; ?> </option>
						 <?   } ?>
						 <?if($estatus == 28 && $idTipoMedidaCautelar == 10){?>
							<option style="color: black; font-weight: bold;" value="<? echo $idTipoMedidaCautelar; ?>" selected><? echo $nombre; ?> </option>
						 <?   } ?>
						 <?if($estatus == 29 && $idTipoMedidaCautelar == 11){?>
							<option style="color: black; font-weight: bold;" value="<? echo $idTipoMedidaCautelar; ?>" selected><? echo $nombre; ?> </option>
						 <?   } ?>
						 <?if($estatus == 30 && $idTipoMedidaCautelar == 12){?>
							<option style="color: black; font-weight: bold;" value="<? echo $idTipoMedidaCautelar; ?>" selected><? echo $nombre; ?> </option>
						 <?   } ?>
						 <?if($estatus == 31 && $idTipoMedidaCautelar == 13){?>
							<option style="color: black; font-weight: bold;" value="<? echo $idTipoMedidaCautelar; ?>" selected><? echo $nombre; ?> </option>
						 <?   } ?>
							<? } ?>
						</select>
					</div>
				</div><br>
				<div class="row">
					<div class="col-xs-12 col-sm-12  col-md-12">
						<label for="fechaCierreInvest">Fecha  del cierre de la investigación : </label>
						<input id="fechaCierreInvest" type="date" value="<?if($opcInsert == 1){echo $fechaCierreInvest;}?>" name="fechaCierreInvest" class="fechas form-control gehit"  />
				 </div>
				</div><br>
				<div class="row">
					<div class="col-xs-12 col-sm-12  col-md-12">
						<label for="formulacionAcusacion">¿Se formuló acusación?: </label>
						<select id="formulacionAcusacion" name="formulacionAcusacion" tabindex="6" class="form-control redondear"  onchange="">
							<option value="0">Selecciona</option>
							<?$getOptionDictonomica = getOptionDictonomica($conn);
							for ($i=0; $i < sizeof($getOptionDictonomica); $i++) {
								$idOpcion = $getOptionDictonomica[$i][0];	$opc = $getOptionDictonomica[$i][1];	?>
								<option style="color: black; font-weight: bold;" value="<? echo $idOpcion; ?>" <?if($opcInsert == 1 && $idOpcion == $formulacionAcusacion ){ ?> selected <? } ?>><? echo $opc; ?> </option>
							<? } ?>
						</select>
					</div>
				</div><br>
				<div class="row">
					<div class="col-xs-12 col-sm-12  col-md-12">
						<label for="fechaEscritoAcusacion">Fecha del escrito de acusación: </label>
						<input id="fechaEscritoAcusacion" type="date" value="<?if($opcInsert == 1){echo $fechaEscritoAcusacion;}?>" name="fechaEscritoAcusacion" class="fechas form-control gehit"  />
					</div>
				</div>	
		</div>	
	</div><br><br><br><br>
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-6">
			<button style="width: 88%;" onclick="closeModalNucsLitigInfo()" type="button" class="btn btn-default redondear" data-dismiss="modal">Salir</button>
		</div>
		<div class="col-xs-12 col-sm-6  col-md-6 ">
			<button style="width: 88%;" onclick="insertMedCautelar_db(<? echo $idEstatusNucs; ?> , <? echo $estatus; ?> , <? echo $nuc; ?> , <? echo $opcInsert; ?>)" type="button" class="btn btn-primary redondear" >Guardar</button>
		</div>
	</div>
 <? } ?>
 	<!--Termina ¿Se impuso medida cautelar? :-->

 	<? if($estatus == 61 || $estatus == 63){ 
 			$getData = getDataAudienciaIntermedia($conn, $idEstatusNucs);
	 	if(sizeof($getData) > 0){ 
	 		$opcInsert = 1; 
	 		$fechaAudienciaIntermedia = $getData[0][2] ->format('Y-m-d'); 
	 		$mediosDePrueba = $getData[0][3];
	 		$tipoMedioPrueba = $getData[0][4];
	 		$acuerdoProbatorio = $getData[0][5]; 
	 		$apertJuiOral = $getData[0][6];
	 	}else{ 	$opcInsert = 0; } 
	 ?>
	<div class="row">
		<div class="col-xs-12 col-sm-12  col-md-12">
		<!-- ¿Hubo celebración de la audiencia intermedia? :-->
			<div class="row">
				<div class="col-xs-12 col-sm-12  col-md-12">
					<label for="fechaAudienciaIntermedia">Fecha de la celebración de la audiencia intermedia: </label>
					<input id="fechaAudienciaIntermedia" type="date" value="<?if($opcInsert == 1){echo $fechaAudienciaIntermedia;}?>" name="fechaAudienciaIntermedia" class="fechas form-control gehit"  />
				</div>
			</div><br>
			<div class="row">
				<div class="col-xs-12 col-sm-12  col-md-12">
					<label for="mediosDePrueba">¿Hubo presentación de medios de prueba?: </label>
					<select id="mediosDePrueba" name="mediosDePrueba" tabindex="6" class="form-control redondear">
						<option value="0">Selecciona</option>
						<?$getOptionDictonomica = getOptionDictonomica($conn);
						for ($i=0; $i < sizeof($getOptionDictonomica); $i++) {
							$idOpcion = $getOptionDictonomica[$i][0];	$opc = $getOptionDictonomica[$i][1];	?>
							<option style="color: black; font-weight: bold;" value="<? echo $idOpcion; ?>" <?if($opcInsert == 1 && $idOpcion == $mediosDePrueba){ ?> selected <? } ?> ><? echo $opc; ?> </option>
						<? } ?>
					</select>
				</div>
			</div><br>
			<div class="row">
				<div class="col-xs-12 col-sm-12  col-md-12">
					<label for="tipoMedioPrueba">Medios de prueba (presentados /excluidos): </label>
					<select id="tipoMedioPrueba" name="tipoMedioPrueba" tabindex="6" class="form-control redondear"  >
						<option value="0">Selecciona</option>
						<?$getTipoMedioPrueba = getTipoMedioPrueba($conSic);
						for ($i=0; $i < sizeof($getTipoMedioPrueba); $i++) {
							$idTipoMedioPrueba = $getTipoMedioPrueba[$i][0];	$nombre = $getTipoMedioPrueba[$i][1];	?>
							<option style="color: black; font-weight: bold;" value="<? echo $idTipoMedioPrueba; ?>" <?if($opcInsert == 1 && $idTipoMedioPrueba == $tipoMedioPrueba){ ?> selected <? } ?> ><? echo $nombre; ?> </option>
						<? } ?>
					</select>
				</div>
			</div><br>
			<div class="row">
				<div class="col-xs-12 col-sm-12  col-md-12">
					<label for="acuerdoProbatorio">¿Contó con acuerdos probatorios?: </label>
					<select id="acuerdoProbatorio" name="acuerdoProbatorio" tabindex="6" class="form-control redondear" >
						<option value="0">Selecciona</option>
						<?$getOptionDictonomica = getOptionDictonomica($conn);
						for ($i=0; $i < sizeof($getOptionDictonomica); $i++) {
							$idOpcion = $getOptionDictonomica[$i][0];	$opc = $getOptionDictonomica[$i][1];	?>
							<option style="color: black; font-weight: bold;" value="<? echo $idOpcion; ?>" <?if($opcInsert == 1 && $idOpcion == $acuerdoProbatorio){ ?> selected <? } ?> ><? echo $opc; ?> </option>
							<? } ?>
						</select>
					</div>
				</div><br>
				<div class="row">
					<div class="col-xs-12 col-sm-12  col-md-12">
						<label for="apertJuiOral">¿Se dictó auto de apertura a juicio oral?: </label>
						<select id="apertJuiOral" name="apertJuiOral" tabindex="6" class="form-control redondear" >
							<option value="0">Selecciona</option>
							<?$getOptionDictonomica = getOptionDictonomica($conn);
							for ($i=0; $i < sizeof($getOptionDictonomica); $i++) {
								$idOpcion = $getOptionDictonomica[$i][0];	$opc = $getOptionDictonomica[$i][1];	?>
								<option style="color: black; font-weight: bold;" value="<? echo $idOpcion; ?>" <?if($opcInsert == 1 && $idOpcion == $apertJuiOral){ ?> selected <? } ?> ><? echo $opc; ?> </option>
							<? } ?>
						</select>
					</div>
				</div>
			</div>
		</div><br><br><br><br>
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-6">
			<button style="width: 88%;" onclick="closeModalNucsLitigInfo()" type="button" class="btn btn-default redondear" data-dismiss="modal">Salir</button>
		</div>
		<div class="col-xs-12 col-sm-6  col-md-6 ">
			<button style="width: 88%;" onclick="insertAudienciaIntermedia_db(<? echo $idEstatusNucs; ?> , <? echo $estatus; ?> , <? echo $nuc; ?> , <? echo $opcInsert; ?>)" type="button" class="btn btn-primary redondear" >Guardar</button>
		</div>
	</div>
 <? } ?>
 	<!-- ¿Hubo celebración de la audiencia intermedia? -->

 	<? if($estatus == 99 || $estatus == 89 || $estatus == 101 || $estatus == 103 || $estatus == 105 || $estatus == 106  || $estatus == 107 || $estatus == 108 || $estatus == 109 || $estatus == 110 || $estatus == 111){
 		$getData = getDataSobreseimientos($conn, $idEstatusNucs);
	 	if(sizeof($getData) > 0){ 
	 		$opcInsert = 1; 
	 		$fechaDictoSobreseimiento = $getData[0][2] ->format('Y-m-d'); 
	 		$tipoSobreseimiento = $getData[0][3];
	 	}else{ 	$opcInsert = 0; } 
	 ?>
	<div class="row">
		<div class="col-xs-12 col-sm-12  col-md-12">
		<!-- En caso de sobreseimiento, etapa en la que se dictó el sobreseimiento :-->
			<div class="row">
				<div class="col-xs-12 col-sm-12  col-md-12">
						<label for="fechaDictoSobresei">Fecha en que se dictó el sobreseimiento: </label>
						<input id="fechaDictoSobresei" type="date" value="<?if($opcInsert == 1){echo $fechaDictoSobreseimiento;}?>" name="fechaDictoSobresei" class="fechas form-control gehit" />
					</div>
			</div><br>
			<div class="row">
				<div class="col-xs-12 col-sm-12  col-md-12">
						<label for="tipoSobreseimiento">Tipo de sobreseimiento: </label>
						<select id="tipoSobreseimiento" name="tipoSobreseimiento" tabindex="6" class="form-control redondear" >
							<option value="0">Selecciona</option>
							<?$getTipoSobreseimiento = getTipoSobreseimiento($conn);
							for ($i=0; $i < sizeof($getTipoSobreseimiento); $i++) {
								$idTipoSobreseimiento = $getTipoSobreseimiento[$i][0];	$nombre = $getTipoSobreseimiento[$i][1];	?>
								<option style="color: black; font-weight: bold;" value="<? echo $idTipoSobreseimiento; ?>" <?if($opcInsert == 1 && $idTipoSobreseimiento == $tipoSobreseimiento){ ?> selected <? } ?> ><? echo $nombre; ?> </option>
							<? } ?>
						</select>
					</div>
			</div><br>
		</div>
	</div><br><br><br><br>
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-6">
			<button style="width: 88%;" onclick="closeModalNucsLitigInfo()" type="button" class="btn btn-default redondear" data-dismiss="modal">Salir</button>
		</div>
		<div class="col-xs-12 col-sm-6  col-md-6 ">
			<button style="width: 88%;" onclick="insertSobreseimientos_db(<? echo $idEstatusNucs; ?> , <? echo $estatus; ?> , <? echo $nuc; ?> , <? echo $opcInsert; ?>)" type="button" class="btn btn-primary redondear" >Guardar</button>
		</div>
	</div>
 <? } ?>
 	<!-- Termina En caso de sobreseimiento, etapa en la que se dictó el sobreseimiento -->



 <? if($estatus == 64){
   $getData = getDataSuspCondProc($conn, $idEstatusNucs);
	 	if(sizeof($getData) > 0){ 
	 		$opcInsert = 1; 
	 	 $fechaDictoSuspCondProc = $getData[0][2] ->format('Y-m-d'); 
	 		$etapaSuspCondProc = $getData[0][3];
	 		$idTipoCondImpuSuspConProc = $getData[0][4];
	 		$reaperturaProc = $getData[0][5];
	 		$fechaReaperProc = $getData[0][6] ->format('Y-m-d');
	 		$fechaCumplimentoSuspCondPro = $getData[0][7] ->format('Y-m-d');
	 	}else{ 	$opcInsert = 0; } 
	  ?>
	<div class="row">
		<div class="col-xs-12 col-sm-12  col-md-12">
		<!-- ¿Se dictó suspensión condicional del proceso? :-->
			<div class="row">
				<div class="col-xs-12 col-sm-12  col-md-12">
					<label for="fechaDictoSuspConProc">Fecha en que se dictó la suspensión condicional del proceso: </label>
					<input id="fechaDictoSuspConProc" type="date" value="<?if($opcInsert == 1){echo $fechaDictoSuspCondProc;}?>" name="fechaDictoSuspConProc" class="fechas form-control gehit" />
				</div>
			</div><br>
			<div class="row">
				<div class="col-xs-12 col-sm-12  col-md-12">
					<label for="etapaSuspCondProc">Etapa en la que se dictó  la suspensión condicional del proceso: </label>
					<select id="etapaSuspCondProc" name="etapaSuspCondProc" tabindex="6" class="form-control redondear"  >
						<option value="0">Selecciona</option>
						<?$getEtapaSuspCondProc = getEtapaSuspCondProc($conSic);
						for ($i=0; $i < sizeof($getEtapaSuspCondProc); $i++) {
							$idEtapaSuspCondProc = $getEtapaSuspCondProc[$i][0];	$nombre = $getEtapaSuspCondProc[$i][1];	?>
							<option style="color: black; font-weight: bold;" value="<? echo $idEtapaSuspCondProc; ?>" <?if($opcInsert == 1 && $idEtapaSuspCondProc == $etapaSuspCondProc){ ?> selected <? } ?> ><? echo $nombre; ?> </option>
						<? } ?>
					</select>
				</div>
			</div><br>
			<div class="row">
				<div class="col-xs-12 col-sm-12  col-md-12">
					<label for="CondImpuSuspConProc">Tipo de condiciones impuestas durante la suspensión condicional del proceso: </label>
					<select id="CondImpuSuspConProc" name="CondImpuSuspConProc" tabindex="6" class="form-control redondear"  >
						<option value="0">Selecciona</option>
						<?$getCondImpuSuspConProc = getCondImpuSuspConProc($conSic);
						for ($i=0; $i < sizeof($getCondImpuSuspConProc); $i++) {
							$idCondImpuSuspConProc = $getCondImpuSuspConProc[$i][0];	$nombre = $getCondImpuSuspConProc[$i][1];	?>
							<option style="color: black; font-weight: bold;" value="<? echo $idCondImpuSuspConProc; ?>" <?if($opcInsert == 1 && $idCondImpuSuspConProc == $idTipoCondImpuSuspConProc){ ?> selected <? } ?> ><? echo $nombre; ?> </option>
						<? } ?>
					</select>
				</div>
		 </div><br>
		 <div class="row">
		 	<div class="col-xs-12 col-sm-12  col-md-12">
		 		<label for="reaperturaProc">¿Hubo reapertura del proceso?: </label>
		 		<select id="reaperturaProc" name="reaperturaProc" tabindex="6" class="form-control redondear" >
		 			<option value="0">Selecciona</option>
		 			<?$getOptionDictonomica = getOptionDictonomica($conn);
		 			for ($i=0; $i < sizeof($getOptionDictonomica); $i++) {
		 				$idOpcion = $getOptionDictonomica[$i][0];	$opc = $getOptionDictonomica[$i][1];	?>
		 				<option style="color: black; font-weight: bold;" value="<? echo $idOpcion; ?>" <?if($opcInsert == 1 && $idOpcion == $reaperturaProc){ ?> selected <? } ?> ><? echo $opc; ?> </option>
		 			<? } ?>
		 		</select>
		 	</div>
		 </div><br>
		 <div class="row">
		 	<div class="col-xs-12 col-sm-12  col-md-12">
		 		<label for="fechaReaperProc">Fecha de la reapertura del proceso: </label>
		 		<input id="fechaReaperProc" type="date" value="<?if($opcInsert == 1){echo $fechaReaperProc;}?>" name="fechaReaperProc" class="fechas form-control gehit"  />
		 	</div>
		 </div><br>
		 <div class="row">
		 	<div class="col-xs-12 col-sm-12  col-md-12">
		 		<label for="fechaCumpSuspCondPro">Fecha en que se cumplimentó la suspensión condicional del proceso: </label>
		 		<input id="fechaCumpSuspCondPro" type="date" value="<?if($opcInsert == 1){echo $fechaCumplimentoSuspCondPro;}?>" name="fechaCumpSuspCondPro" class="fechas form-control gehit"  />
		 	</div>
		 </div>
		</div>
	</div><br><br><br><br>
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-6">
			<button style="width: 88%;" onclick="closeModalNucsLitigInfo()" type="button" class="btn btn-default redondear" data-dismiss="modal">Salir</button>
		</div>
		<div class="col-xs-12 col-sm-6  col-md-6 ">
			<button style="width: 88%;" onclick="insertSuspCondProc_db(<? echo $idEstatusNucs; ?> , <? echo $estatus; ?> , <? echo $nuc; ?> , <? echo $opcInsert; ?>)" type="button" class="btn btn-primary redondear" >Guardar</button>
		</div>
	</div>
 <? } ?>
 	<!-- Termina ¿Se dictó suspensión condicional del proceso? -->
 
 <? if($estatus == 60){ 
 	 $getData = getDataAudienciasDeJuicio($conn, $idEstatusNucs);
	 	if(sizeof($getData) > 0){ 
	 		$opcInsert = 1; 
	 	 $fechaAudienciaJuicio = $getData[0][2] ->format('Y-m-d'); 
	 		$pruebasAudienciaJuicio = $getData[0][3];
	 	}else{ 	$opcInsert = 0; }
	 ?>
	<div class="row">
		<div class="col-xs-12 col-sm-12  col-md-12">
		<!--celebración de la audiencia de juicio :-->
			<div class="row">
				<div class="col-xs-12 col-sm-12  col-md-12">
					<label for="fechaAudienciaJuicio">Fecha de la celebración de la audiencia de juicio: </label>
					<input id="fechaAudienciaJuicio" type="date" value="<?if($opcInsert == 1){echo $fechaAudienciaJuicio;}?>" name="fechaAudienciaJuicio" class="fechas form-control gehit"  />
				</div>
			</div><br>
			<div class="row">
				<div class="col-xs-12 col-sm-12  col-md-12">
					<label for="pruebasAudienciaJuicio">Tipos de pruebas desahogadas durante la audiencia de juicio: </label>
					<select id="pruebasAudienciaJuicio" name="pruebasAudienciaJuicio" tabindex="6" class="form-control redondear"  >
						<option value="0">Selecciona</option>
						<?$getPruebasAudienciaJuicio = getPruebasAudienciaJuicio($conSic);
						for ($i=0; $i < sizeof($getPruebasAudienciaJuicio); $i++) {
							$idPruebasAudienciaJuicio = $getPruebasAudienciaJuicio[$i][0];	$nombre = $getPruebasAudienciaJuicio[$i][1];	?>
							<option style="color: black; font-weight: bold;" value="<? echo $idPruebasAudienciaJuicio; ?>" <?if($opcInsert == 1 && $idPruebasAudienciaJuicio == $pruebasAudienciaJuicio){ ?> selected <? } ?> ><? echo $nombre; ?> </option>
						<? } ?>
					</select>
				</div>
			</div>
	 </div>
	</div><br><br><br><br>
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-6">
			<button style="width: 88%;" onclick="closeModalNucsLitigInfo()" type="button" class="btn btn-default redondear" data-dismiss="modal">Salir</button>
		</div>
		<div class="col-xs-12 col-sm-6  col-md-6 ">
			<button style="width: 88%;" onclick="insertAudienciasJuicio_db(<? echo $idEstatusNucs; ?> , <? echo $estatus; ?> , <? echo $nuc; ?> , <? echo $opcInsert; ?>)" type="button" class="btn btn-primary redondear" >Guardar</button>
		</div>
	</div>
 <? } ?>
 <!-- Termina celebración de la audiencia de juicio:-->

 
 <? if($estatus == 91){
  $getData = getDataCriteriosOportunidad($conn, $idEstatusNucs);
	 	if(sizeof($getData) > 0){ 
	 		$opcInsert = 1; 
	 	 $idTipoCriterioOportunidad = $getData[0][2];
	 	}else{ 	$opcInsert = 0; }
	 ?>
	<div class="row">
		<div class="col-xs-12 col-sm-12  col-md-12">
		<!--En caso de que se determinara por criterios de oportunidad, tipo de criterios de oportunidad  :-->
			<div class="row">
				<div class="col-xs-12 col-sm-12  col-md-12">
						<label for="tipoCriterioOportunidad">Tipo de criterios de oportunidad :</label>
						<select id="tipoCriterioOportunidad" name="tipoCriterioOportunidad" tabindex="6" class="form-control redondear ">
							<option value="0">Selecciona</option>
							<?$getTipoCriterioOportunidad = getTipoCriterioOportunidad($conSic);
							for ($i=0; $i < sizeof($getTipoCriterioOportunidad); $i++) {
								$idTipoCriterio = $getTipoCriterioOportunidad[$i][0];	$nombre = $getTipoCriterioOportunidad[$i][1];	?>
								<option style="color: black; font-weight: bold;" value="<? echo $idTipoCriterio; ?>" <?if($opcInsert == 1 && $idTipoCriterio == $idTipoCriterioOportunidad){ ?> selected <? } ?> ><? echo $nombre; ?> </option>
							<? } ?>
						</select>
					</div>
			</div>
	 </div>
	</div><br><br><br><br>
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-6">
			<button style="width: 88%;" onclick="closeModalNucsLitigInfo()" type="button" class="btn btn-default redondear" data-dismiss="modal">Salir</button>
		</div>
		<div class="col-xs-12 col-sm-6  col-md-6 ">
			<button style="width: 88%;" onclick="insertCriteriosOportunidad_db(<? echo $idEstatusNucs; ?> , <? echo $estatus; ?> , <? echo $nuc; ?> , <? echo $opcInsert; ?>)" type="button" class="btn btn-primary redondear" >Guardar</button>
		</div>
	</div>
 <? } ?>
 <!-- En caso de que se determinara por criterios de oportunidad, tipo de criterios de oportunidad :-->

  <? if($estatus == 65 || $estatus == 90){ 
  	$getData = getDataAcuerdosReparatorios($conn, $idEstatusNucs);
	 	if(sizeof($getData) > 0){ 
	 		$opcInsert = 1; 
	 		$tipoAcuerdosRep = $getData[0][2];
	 	}else{ 	$opcInsert = 0; }
	 	?>
	<div class="row">
		<div class="col-xs-12 col-sm-12  col-md-12">
		<!--En caso de acuerdos reparatorios, ¿tipo de acuerdos reparatorios?  :-->
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12">
						<label for="tipoAcuerdosRep">¿tipo de acuerdos reparatorios?: </label>
						<select id="tipoAcuerdosRep" name="tipoAcuerdosRep" tabindex="6" class="form-control redondear ">
							<option value="0">Selecciona</option>
							<?$getTipoAcuerdoRep = getTipoAcuerdoRep($conSic);
							for ($i=0; $i < sizeof($getTipoAcuerdoRep); $i++) {
								$idTipoAcuerdoRep = $getTipoAcuerdoRep[$i][0];	$nombre = $getTipoAcuerdoRep[$i][1];	?>
								<option style="color: black; font-weight: bold;" value="<? echo $idTipoAcuerdoRep; ?>" <?if($opcInsert == 1 && $idTipoAcuerdoRep == $tipoAcuerdosRep){ ?> selected <? } ?> ><? echo $nombre; ?> </option>
							<? } ?>
						</select>
					</div>
			</div>
	 </div>
	</div><br><br><br><br>
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-6">
			<button style="width: 88%;" onclick="closeModalNucsLitigInfo()" type="button" class="btn btn-default redondear" data-dismiss="modal">Salir</button>
		</div>
		<div class="col-xs-12 col-sm-6  col-md-6 ">
			<button style="width: 88%;" onclick="insertAcuerdoReparatorio_db(<? echo $idEstatusNucs; ?> , <? echo $estatus; ?> , <? echo $nuc; ?> , <? echo $opcInsert; ?>)" type="button" class="btn btn-primary redondear" >Guardar</button>
		</div>
	</div>
 <? } ?>
 <!-- En caso de acuerdos reparatorios, ¿tipo de acuerdos reparatorios? :-->

 <? if($estatus == 14 || $estatus == 66 ||$estatus == 67 ){ 
 	if($estatus == 14){ //Para poder hacer consulta en caso de que el estatus sea 14 ya que esta se recibe en la tabla de resoluciones de la BD Prueba
 	$getData = getDataSentencias($conn,  $idResolMP, $estatus);
 }else{
 	$getData = getDataSentencias($conn,  $idEstatusNucs, $estatus);
 }
	 	if(sizeof($getData) > 0){ 
	 		$opcInsert = 1; 
	 		$fechaDictoSentencia = $getData[0][2] ->format('Y-m-d');
	 		$tipoSentencia = $getData[0][3];
	 		$aniosPrision = $getData[0][4];
	 		$sentenciaFirme = $getData[0][5];
	 		$sentDerivaProcAbrv = $getData[0][6];
	 		$fechaDictoProcAbrv = $getData[0][7]->format('Y-m-d');
	 	}else{ 	$opcInsert = 0; }
	 	?>
	<div class="row">
		<div class="col-xs-12 col-sm-12  col-md-12">
		<!--¿La sentencia fue derivada de un procedimiento abreviado? :-->
			<div class="row">
				<div class="col-xs-12 col-sm-12  col-md-12">
					<label for="fechaDictoSentencia">Fecha en que se dictó la sentencia: </label>
					<input id="fechaDictoSentencia" type="date" value="<?if($opcInsert == 1){echo $fechaDictoSentencia;}?>" name="fechaDictoSentencia" class="fechas form-control gehit"  />
				</div>
			</div><br>
			<div class="row">
				<div class="col-xs-12 col-sm-12  col-md-12">
					<label for="tipoSentencia">Tipo de sentencia: </label>
					<select id="tipoSentencia" name="tipoSentencia" tabindex="6" class="form-control redondear"  >
						<option value="0">Selecciona</option>
						<?$getTipoSentencia = getTipoSentencia($conn);
						for ($i=0; $i < sizeof($getTipoSentencia); $i++) {
							$idTipoSentencia = $getTipoSentencia[$i][0];	$nombre = $getTipoSentencia[$i][1];	?>
						<option style="color: black; font-weight: bold;" value="<? echo $idTipoSentencia; ?>" <?if($opcInsert == 1 && $idTipoSentencia == $tipoSentencia){ ?> selected <? } ?> ><? echo $nombre; ?> </option>
						<? } ?>
					</select>
				</div>
			</div><br>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12">
					<label for="aniosPrision">Tiempo en prisión (años): </label>
					<input id="aniosPrision" type="number" value="<?if($opcInsert == 1){echo $aniosPrision;}?>" name="aniosPrision" class="fechas form-control gehit"  />
				</div>
			</div><br>
			<div class="row">
				<div class="col-xs-12 col-sm-12  col-md-12">
					<label for="sentenciaFirme">¿La sentencia se encuentra firme?: </label>
					<select id="sentenciaFirme" name="sentenciaFirme" tabindex="6" class="form-control redondear"  >
						<option value="0">Selecciona</option>
						<?$getOptionDictonomica = getOptionDictonomica($conn);
						for ($i=0; $i < sizeof($getOptionDictonomica); $i++) {
							$idOpcion = $getOptionDictonomica[$i][0];	$opc = $getOptionDictonomica[$i][1];	?>
							<option style="color: black; font-weight: bold;" value="<? echo $idOpcion; ?>" <?if($opcInsert == 1 && $idOpcion == $sentenciaFirme){ ?> selected <? } ?>  ><? echo $opc; ?> </option>
						<? } ?>
					</select>
				</div>
			</div><br>
			<div class="row">
		 	<div class="col-xs-12 col-sm-12  col-md-12">
						<label for="sentDerivaProcAbrv">¿La sentencia fue derivada de un procedimiento abreviado?:  </label>
						<select id="sentDerivaProcAbrv" name="sentDerivaProcAbrv" tabindex="6" class="form-control redondear"  >
							<option value="0">Selecciona</option>
							<?$getOptionDictonomica = getOptionDictonomica($conn);
							for ($i=0; $i < sizeof($getOptionDictonomica); $i++) {
								$idOpcion = $getOptionDictonomica[$i][0];	$opc = $getOptionDictonomica[$i][1];	?>
								<option style="color: black; font-weight: bold;" value="<? echo $idOpcion; ?>" <?if($opcInsert == 1 && $idOpcion == $sentDerivaProcAbrv){ ?> selected <? } ?> ><? echo $opc; ?> </option>
							<? } ?>
						</select>
					</div>
		 </div><br>
			<div class="row">
				<div class="col-xs-12 col-sm-12  col-md-12">
					<label for="fechaDictoProcAbrv">Fecha en que se dictó el procedimiento abreviado: </label>
					<input id="fechaDictoProcAbrv" type="date" value="<?if($opcInsert == 1){echo $fechaDictoProcAbrv;}?>" name="fechaDictoProcAbrv" class="fechas form-control gehit"  />
				</div>
			</div><br>
	 </div>
	</div><br><br><br><br>
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-6">
			<button style="width: 88%;" onclick="closeModalNucsLitigInfo()" type="button" class="btn btn-default redondear" data-dismiss="modal">Salir</button>
		</div>
		<div class="col-xs-12 col-sm-6  col-md-6 ">
			<button style="width: 88%;" onclick="insertSentencias_db(<?if($estatus == 14){ echo $idResolMP; }else{ echo $idEstatusNucs; } ?> , <? echo $estatus; ?> , <? echo $nuc; ?> , <? echo $opcInsert; ?>)" type="button" class="btn btn-primary redondear" >Guardar</button>
		</div>
	</div>
 <? } ?>
 <!-- Termina ¿La sentencia fue derivada de un procedimiento abreviado? :-->

  <? if($estatus == 68){ 
  	$getData = getDataReparacionDanios($conn, $idEstatusNucs);
	 	if(sizeof($getData) > 0){ 
	 		$opcInsert = 1; 
	 		$montoRepDanio = $getData[0][2];
	 	}else{ 	$opcInsert = 0; }
	 ?>
	<div class="row">
		<div class="col-xs-12 col-sm-12  col-md-12">
		<!--Monto de la reparación del daño impuesta :-->
			<div class="row">
				<div class="col-xs-12 col-sm-12  col-md-12">
						<label for="montoRepDanio">Monto de la reparación del daño impuesta: </label>
						<input id="montoRepDanio" type="number" value="<?if($opcInsert == 1){echo $montoRepDanio;}?>" name="montoRepDanio" class="fechas form-control gehit"  />
					</div>
			</div>
	 </div>
	</div><br><br><br><br>
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-6">
			<button style="width: 88%;" onclick="closeModalNucsLitigInfo()" type="button" class="btn btn-default redondear" data-dismiss="modal">Salir</button>
		</div>
		<div class="col-xs-12 col-sm-6  col-md-6 ">
			<button style="width: 88%;" onclick="insertReparacionDanios_db(<?echo $idEstatusNucs; ?> , <? echo $estatus; ?> , <? echo $nuc; ?> , <? echo $opcInsert; ?>)" type="button" class="btn btn-primary redondear" >Guardar</button>
		</div>
	</div>
 <? } ?>
 <!-- Termina Monto de la reparación del daño impuesta :-->

</div>

<div class="modal-footer">
	
</div>




																												
																													
																																																			
																					