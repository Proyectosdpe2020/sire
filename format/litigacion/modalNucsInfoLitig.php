<? 

 include ("../../Conexiones/Conexion.php");
 include ("../../Conexiones/conexionSicap.php");
	include("../../funciones.php");
	include("../../funcioneSicap.php");
	include("../../funcioneLit.php");
	include("../../funcionesLitSENAP.php");

	if (isset($_POST["idEstatusNucs"])){ $idEstatusNucs = $_POST["idEstatusNucs"]; } else{ $idEstatusNucs = 0; }
	if (isset($_POST["estatus"])){ $estatus = $_POST["estatus"]; }
	if (isset($_POST["nuc"])){ $nuc = $_POST["nuc"]; }
	if (isset($_POST["idCarpeta"])){ $idCarpeta = $_POST["idCarpeta"]; }

	if (isset($_POST["idMp"])){ $idMp = $_POST["idMp"]; }
	if (isset($_POST["mes"])){ $mes = $_POST["mes"]; }
	if (isset($_POST["anio"])){ $anio = $_POST["anio"]; }
	if (isset($_POST["deten"])){ $deten = $_POST["deten"]; }
	if (isset($_POST["idUnidad"])){ $idUnidad = $_POST["idUnidad"]; }
	if (isset($_POST["idImputado"])){ $idImputado = $_POST["idImputado"]; }

	
	//$dataImputado = getDataFromImputadoID($conn, $idImputado);
	//$bandImputado = 0;

	$arrayIDSllevanImputado = array(1,	2,	151,	10,	12,	13,	14,	15,	17,	18,	19,	20,	21,	22,	23,	24,	25,	26,	27,	28,	29,	30,	31,	36,	38
	,	50,	53,	57,	58,	64,	65,	66,	67,	81,	84,	89,	90,	91,	93,	97,	99,	152,	153,	154,	155,	156,	157,	158,	159,	160,	161,	162,	163,	164, 165);

	//// VALIDAMOS QUE SOLO SE GRABER EL IMPUTADO EN LOS ESTAUS PERMITIDOS 
	/// SI NO SE MANDA CERO PARA LA BASE DE DATOS
	
	if(in_array($estatus, $arrayIDSllevanImputado)){
		$bandImputado = 1;
		$dataImputado = getDataFromImputadoID($conn, $idImputado);
	}else{
		$bandImputado = 0;
		$dataImputado[0][7] = 0;
	}
	

		if (isset($_POST["tipo_investigacion"])){ $tipo_investigacion = $_POST["tipo_investigacion"]; }


//Sí tipo de investigación es un NUC se buscara su expediente en SICAP
if($tipo_investigacion == 1){
	$getNucExpedienteSicap = getNucExpedienteSicap($conSic, $nuc);
	$expediente = $getNucExpedienteSicap[0][0];
}else{ $nuc = "'".$nuc."'"; }
	

	if($estatus == 19 || $estatus == 14){ if (isset($_POST["idResolMP"])){ $idResolMP = $_POST["idResolMP"]; }else{ $idResolMP = 0; } }
	
?>

<div class="modal-header" style="background-color:#152F4A;">
	<center><h4  style="font-weight: bold; color: white;" class="modal-title">Estadística Básica del Sistema Estadistico de Procuración de Justicia (SENAP)</h4></center>
</div>

<div class="modal-body ">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12">
			<? if($tipo_investigacion == 0){ ?> <h4>Registro estadístico del NUC: <strong><? echo $nuc; ?></strong></h4> <? }else{ ?> <h4>Registro estadístico del NUC: <strong><? echo $nuc; ?></strong></h4> <? } ?>
		</div>
	</div><br>

	<? if($estatus == 1 || $estatus == 2){ 
		$getData = getDataDelitoJudicializado($conn, $idEstatusNucs);
	 	if(sizeof($getData) > 0){ 
	 		$opcInsert = 1; 
	 		$idModalidadEstadistica = $getData[0][2]; 
	 		$reclasificado = $getData[0][3];
	 		$causaPenal = $getData[0][4];
	 		$fechaCausaPenal = $getData[0][5] ->format('Y-m-d');
	 		$audienciaInicial = $getData[0][6];
	 		$motivoNoCelebracion = $getData[0][7];
	 		$fechaAudienciaInicial = $getData[0][8]  ->format('Y-m-d');
	 		$getName = getDataDelitoNombre($conSic , $idModalidadEstadistica );
	 		$nombreDelito = $getName[0][1];
	 }else{ 	$opcInsert = 0;  $reclasificado = 0; }?>
	<div class="row">
		<div class="col-xs-12 col-sm-12  col-md-12">
			<div class="row">
				<div class="col-xs-12 col-sm-6  col-md-6">
						<label for="causaPenal">Número asignado a la causa penal :</label>
						<input id="causaPenal" type="text" value="<? if($opcInsert == 1){ echo $causaPenal; } ?>"  class="fechas form-control gehit"  />
				</div>
				<div class="col-xs-12 col-sm-6  col-md-6">
						<label for="fechaCausaPenal">Fecha de ingreso de la causa penal: </label>
						<input id="fechaCausaPenal" type="date" value="<?if($opcInsert == 1){echo $fechaCausaPenal; }?>" name="fechaCausaPenal" class="fechas form-control gehit"  />
					</div>
			</div><br>
			 <div class="row">
					<div class="col-xs-12 col-sm-6  col-md-6">
						<label for="celebracionAudIniOk">¿Hubó celebración de audiencia inicial?: </label>
						<select id="celebracionAudIniOk" name="celebracionAudIniOk" tabindex="6" class="form-control redondear"  onchange="validateFormulacionJudicializada()">
							<option style="color: black; font-weight: bold;" value="0" > Seleccione </option>
							<?$getOptionDictonomica = getOptionDictonomica($conn);
							for ($i=0; $i < sizeof($getOptionDictonomica); $i++) {
								$idOpcion = $getOptionDictonomica[$i][0];	$opc = $getOptionDictonomica[$i][1];	?>
								<option style="color: black; font-weight: bold;" value="<? echo $idOpcion; ?>" <?if($opcInsert == 1 && $idOpcion == $audienciaInicial ){ ?> selected <? } ?> > <? echo $opc; ?> </option>
							<? } ?>
						</select>
					</div>
					<div class="col-xs-12 col-sm-6  col-md-6">
						<label for="motivoNoAudienciaIni">Motivo de no celebración de audiencia inicial: </label>
						<select id="motivoNoAudienciaIni" name="motivoNoAudienciaIni" tabindex="6" class="form-control redondear" disabled onchange="">
							<option style="color: black; font-weight: bold;" value="0" >Seleccione</option>
							<?$getMotivosAudienciaInicial = getMotivosAudienciaInicial($conSic);
							for ($i=0; $i < sizeof($getMotivosAudienciaInicial); $i++) {
								$idOpcion = $getMotivosAudienciaInicial[$i][0];	$opc = $getMotivosAudienciaInicial[$i][1];	?>
								<option style="color: black; font-weight: bold;" value="<? echo $idOpcion; ?>" <?if($opcInsert == 1 && $idOpcion == $motivoNoCelebracion ){ ?> selected <? } ?> ><? echo $opc; ?> </option>
							<? } ?>
						</select>
					</div>
				</div><br>
				<div class="row">
			 	<div class="col-xs-12 col-sm-6  col-md-6">
						<label for="fechaAudienciaInicial">Fecha de la audiencia inicial: </label>
						<input id="fechaAudienciaInicial" type="date" value="<?if($opcInsert == 1){echo $fechaAudienciaInicial; }?>" name="fechaAudienciaInicial" disabled class="fechas form-control gehit"  />
					</div>
			 </div><br>
			<!-- TABLA DELITOS POR LA CUAL SE JUDICIALIZO-->
			<div class="row">
				<div class="col-xs-12 col-sm-12  col-md-12">
					<label for="">Delito por el cual se judicializo la carpeta: </label>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12  col-md-12">
					<div id="tablePuestasDataMando" class="row pad20">	
									<table class="table table-striped  table-hover">
										<thead>
											<tr class="cabezeraTablaForest">
												<th class="textCent">#</th>
												<th class="textCent">Delito</th>
												<th class="textCent">¿Principal?</th>
											</tr>
										</thead>
										<tbody id="">
										<?
             $datossicap=get_datos_carpeta_capturado($conSic, $nuc);  
										   $getDataDelito = getDataDelito($conSic, $datossicap[0][0]);
										   $k=0;
										for ($i=0; $i < sizeof($getDataDelito); $i++) {  ?>
											<tr>
												<td class="textCent"><? echo $k+=1; ?></td>
												<td class="textCent"><strong><? echo $getDataDelito[$i][4]; ?></strong>&nbsp&nbsp<input type="radio" name="checkDelito" value="<? echo $getDataDelito[$i][3]; ?>" class="checkDelito" <?if($opcInsert == 1 && $idModalidadEstadistica == $getDataDelito[$i][3]){ ?> checked <? } ?> ><span class="checkmark"></span></td>
												<td class="textCent"><? echo $getDataDelito[$i][5]; ?></td>
			        </tr>
			       <? } ?>
										</tbody>
									</table>
					 </div>
				 </div>
			 </div><br>
			 <div class="row">
			 	<div class="col-xs-12 col-sm-12  col-md-12">
			 		<h4><strong>Nota: </strong>Información cargada de SICAP.</h4>
			 	</div>
			 </div><br>
			 <div class="row">
			 	<div class="col-xs-12 col-sm-12  col-md-12">
			 		<h4>Si el delito por el cual se está judicializando la carpeta no figura en la tabla anterior, reclasifique el delito en la siguiente opción: </h4>
			 	</div>
			 </div><br>
			 <div class="row">
			 	<div class="col-xs-12 col-sm-12  col-md-12">
			 	<label>Reclasificar delito: &nbsp&nbsp<input type="checkbox"class="checkRecla" id="cbox1" value="" onclick="reclasificar()"></label>
			 	</div>
			 </div><br>
			 <div class="row" id="tableReclasificar" <?if($opcInsert == 0 && $reclasificado == 0){ ?> hidden <? } ?> >
				<div class="col-xs-12 col-sm-12  col-md-12">
					<div id="tablePuestasDataMando" class="row pad20">	
									<table class="table table-striped  table-hover">
										<thead>
											<tr class="cabezeraTablaForest">
												<th class="textCent">#</th>
												<th class="textCent">Delito</th>
											</tr>
										</thead>
										<tbody id="">
											<tr>
												<td class="textCent">1</td>
												<td class="textCent">
													<datalist id="newBrwosers">
																<? 
																																					$delitos = getDataDelitosSica($conSic);
																																						for ($h=0; $h < sizeof($delitos); $h++) {
																																							 $idDelito = $delitos[$h][0];	
																																								$nom = $delitos[$h][1];
																																									?>
																																											<option style="color: black; font-weight: bold;" value="<? echo $nom; ?>" data-value="<? echo  $idDelito; ?>" data-id="<? echo $idDelito; ?>"></option>
																																									<?
																																						}
																																			 ?>
												</datalist>
												<input class="form-control mandda gehit" value="<? if($opcInsert == 1){ echo $nombreDelito; } ?>" onchange="" onfocus="" list="newBrwosers" id="newBrwoser" name="newBrwoser" type="text" ></td>
			        </tr>
										</tbody>
									</table>
					 </div>
				 </div>
			 </div><br>

			</div>
	</div><br><br><br><br>
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-6">
			<button style="width: 88%;" onclick="closeModalNucsLitigInfo()" type="button" class="btn btn-default redondear" data-dismiss="modal">Salir</button>
		</div>
		<div class="col-xs-12 col-sm-6  col-md-6 ">
			<?if(	$opcInsert == 0){ ?>
			<button style="width: 88%;" onclick="sendDataJudicializada(<? echo $nuc; ?>, <? echo $estatus; ?>, <? echo $idMp; ?> , <? echo $mes; ?> , <? echo $anio; ?> , <? echo $deten; ?> , <? echo $idUnidad; ?> ,  <? echo $opcInsert; ?>, <? echo $dataImputado[0][7]; ?>)" type="button" class="btn btn-primary redondear" >Aceptar</button>
			<?}elseif(	$opcInsert == 1 ){?>
			<button style="width: 88%;" onclick="insertFormJudicializada_db(<? echo $idEstatusNucs; ?> , <? echo $estatus; ?> , <? echo $nuc; ?> , <? echo $opcInsert; ?>)" type="button" class="btn btn-primary redondear" >Guardar</button>
		<? } ?>
		</div>
	</div>
 <? } ?>

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
			<?if(	$opcInsert == 0){ ?>
			<button style="width: 88%;" onclick="sendDataFormImputacion(<? echo $nuc; ?>, <? echo $estatus; ?>, <? echo $idMp; ?> , <? echo $mes; ?> , <? echo $anio; ?> , <? echo $deten; ?> , <? echo $idUnidad; ?> ,  <? echo $opcInsert; ?>, <? echo $dataImputado[0][7]; ?>)" type="button" class="btn btn-primary redondear" >Aceptar</button>
			<?}elseif(	$opcInsert == 1 ){?>
			<button style="width: 88%;" onclick="insertFormImputacion_db(<? echo $idEstatusNucs; ?> , <? echo $estatus; ?> , <? echo $nuc; ?> , <? echo $opcInsert; ?>)" type="button" class="btn btn-primary redondear" >Guardar</button>
			<? } ?>
		</div>
	</div>
 <? } ?>

 <? if($estatus == 151){ 
 	$getData = getDataFechaAutoVincuProc($conn, $idEstatusNucs);
	 	if(sizeof($getData) > 0){ 
	 		$opcInsert = 1; 
	 		$fecha = $getData[0][3] ->format('Y-m-d'); 
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
			<?if(	$opcInsert == 0){ ?>
			<button style="width: 88%;" onclick="sendDataFormAutoVincuProc(<? echo $nuc; ?>, <? echo $estatus; ?>, <? echo $idMp; ?> , <? echo $mes; ?> , <? echo $anio; ?> , <? echo $deten; ?> , <? echo $idUnidad; ?> ,  <? echo $opcInsert; ?>, <? echo $dataImputado[0][7]; ?>)" type="button" class="btn btn-primary redondear" >Aceptar</button>
			<?}elseif(	$opcInsert == 1 ){ ?>
			<button style="width: 88%;" onclick="insertFormAutoVincuProc_db(<? echo $idEstatusNucs; ?> , <? echo $estatus; ?> , <? echo $nuc; ?> , <? echo $opcInsert; ?>)" type="button" class="btn btn-primary redondear" >Guardar</button>
		 <? } ?>
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
	 		$edad_imputado_medida = $getData[0][5];
	 		$temporalida_medida =$getData[0][6];
	 		$parentesco_victima = $getData[0][7];
	 		$id_sexo = $getData[0][8];
	 	}else{ 	$opcInsert = 0; } 
	?>
	<div class="row">
		<div class="col-xs-12 col-sm-12  col-md-12">
				<div class="row">
				<div class="col-xs-12 col-sm-12  col-md-6 input-group-lg">
						<label for="id_sexo">Sexo del imputado</label><br>
							<input type="radio" id="id_sexo" name="id_sexo"  value="M"   >
							<label for="cv_sexo" >Masculino</label>&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="radio" id="id_sexo" name="id_sexo"  value="F"  >
							<label for="cv_sexo" >Femenino</label>
						</div>
					</div><BR>
				<div class="row">
					<div class="col-xs-12 col-sm-12  col-md-3">
						<label for="edad_imputado_medida">Edad del imputado:</label>
						<input type="number" class="form-control" value="<?if($opcInsert == 1){echo $edad_imputado_medida;}?>" id="edad_imputado_medida" placeholder="ESPECIFICA LA EDAD DEL IMPUTADO" >
					</div>
							<div class="col-xs-12 col-sm-12  col-md-4">
								<label for="temporalida_medida">Temporalidad (Meses):</label>
								<input type="number" class="form-control" value="<?if($opcInsert == 1){echo $temporalida_medida;}?>" id="temporalida_medida" placeholder="ESPECIFICA LA TEMPORALIDAD EN MESES" >
							</div>
					<div class="col-xs-12 col-sm-12  col-md-5">
						<label for="parentesco_victima">Parentesco con la víctima: </label>
						<select id="parentesco_victima" name="parentesco_victima" tabindex="6" class="form-control redondear" >
							<option style="color: black; font-weight: bold;" value="0"> Seleccione </option>
							<?$getCatParentescos = getCatParentescos($conn);
							for ($i=0; $i < sizeof($getCatParentescos); $i++) {
								$idOpcion = $getCatParentescos[$i][0];	$opc = $getCatParentescos[$i][1];	?>
								<option style="color: black; font-weight: bold;" value="<? echo $idOpcion; ?>" <?if($opcInsert == 1 && $idOpcion == $parentesco_victima ){ ?> selected <? } ?> ><? echo $opc; ?> </option>
							<? } ?>
						</select>
					</div>
			</div><BR><BR>
			<!--¿Se impuso medida cautelar? :-->
			<div class="row">
				<div class="col-xs-12 col-sm-12  col-md-12">
					<label for="tipoMedCautelar">Tipo de medidas cautelares impuestas: </label>
					<select id="tipoMedCautelar" name="tipoMedCautelar" tabindex="6" class="form-control redondear" disabled >
						<?$getTipoMedCautelar = getTipoMedCautelar($conSic);
						for ($i=0; $i < sizeof($getTipoMedCautelar); $i++) {
							$idTipoMedidaCautelar = $getTipoMedCautelar[$i][0];	$nombre = $getTipoMedCautelar[$i][1];	
							if($estatus == 17 && $idTipoMedidaCautelar == 1){?>
							<option style="color: black; font-weight: bold;" value="<? echo $idTipoMedidaCautelar; ?>" selected><? echo $nombre; ?> </option>
						 <?   } ?>
						 <?if($estatus == 18 && $idTipoMedidaCautelar == 2){?>
							<option style="color: black; font-weight: bold;" value="<? echo $idTipoMedidaCautelar; ?>" selected><? echo $nombre; ?> </option>
						 <?   } ?>
						 <?if($estatus == 95 && $idTipoMedidaCautelar == 15){?>
							<option style="color: black; font-weight: bold;" value="<? echo $idTipoMedidaCautelar; ?>" selected><? echo $nombre; ?> </option>
						 <?   } ?>
						 <?if($estatus == 21 && $idTipoMedidaCautelar == 4){?>
							<option style="color: black; font-weight: bold;" value="<? echo $idTipoMedidaCautelar; ?>" selected><? echo $nombre; ?> </option>
						 <?   } ?>
						 <?if($estatus == 20 && $idTipoMedidaCautelar == 3){?>
							<option style="color: black; font-weight: bold;" value="<? echo $idTipoMedidaCautelar; ?>" selected><? echo $nombre; ?> </option>
						 <?   } ?>
						 <?if($estatus == 22 && $idTipoMedidaCautelar == 5){?>
							<option style="color: black; font-weight: bold;" value="<? echo $idTipoMedidaCautelar; ?>" selected><? echo $nombre; ?> </option>
						 <?   } ?>
						 <?if($estatus == 23 && $idTipoMedidaCautelar == 6){?>
							<option style="color: black; font-weight: bold;" value="<? echo $idTipoMedidaCautelar; ?>" selected><? echo $nombre; ?> </option>
						 <?   } ?>
						 <?if($estatus == 24 && $idTipoMedidaCautelar == 7){?>
							<option style="color: black; font-weight: bold;" value="<? echo $idTipoMedidaCautelar; ?>" selected><? echo $nombre; ?> </option>
						 <?   } ?>
						 <?if($estatus == 25 && $idTipoMedidaCautelar == 8){?>
							<option style="color: black; font-weight: bold;" value="<? echo $idTipoMedidaCautelar; ?>" selected><? echo $nombre; ?> </option>
						 <?   } ?>
						 <?if($estatus == 26 && $idTipoMedidaCautelar == 9){?>
							<option style="color: black; font-weight: bold;" value="<? echo $idTipoMedidaCautelar; ?>" selected><? echo $nombre; ?> </option>
						 <?   } ?>
						  <?if($estatus == 27 && $idTipoMedidaCautelar == 10){?>
							<option style="color: black; font-weight: bold;" value="<? echo $idTipoMedidaCautelar; ?>" selected><? echo $nombre; ?> </option>
						 <?   } ?>
						 <?if($estatus == 28 && $idTipoMedidaCautelar == 11){?>
							<option style="color: black; font-weight: bold;" value="<? echo $idTipoMedidaCautelar; ?>" selected><? echo $nombre; ?> </option>
						 <?   } ?>
						 <?if($estatus == 29 && $idTipoMedidaCautelar == 12){?>
							<option style="color: black; font-weight: bold;" value="<? echo $idTipoMedidaCautelar; ?>" selected><? echo $nombre; ?> </option>
						 <?   } ?>
						 <?if($estatus == 30 && $idTipoMedidaCautelar == 13){?>
							<option style="color: black; font-weight: bold;" value="<? echo $idTipoMedidaCautelar; ?>" selected><? echo $nombre; ?> </option>
						 <?   } ?>
						 <?if($estatus == 31 && $idTipoMedidaCautelar == 14){?>
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
						<select id="formulacionAcusacion" name="formulacionAcusacion" tabindex="6" class="form-control redondear"  onchange="validateMedidasCautelares()">
							<option style="color: black; font-weight: bold;" value="0"> Seleccione </option>
							<?$getOptionDictonomica = getOptionDictonomica($conn);
							for ($i=0; $i < sizeof($getOptionDictonomica); $i++) {
								$idOpcion = $getOptionDictonomica[$i][0];	$opc = $getOptionDictonomica[$i][1];	?>
								<option style="color: black; font-weight: bold;" value="<? echo $idOpcion; ?>" <?if($opcInsert == 1 && $idOpcion == $formulacionAcusacion ){ ?> selected <? } ?> ><? echo $opc; ?> </option>
							<? } ?>
						</select>
					</div>
				</div><br>
				<div class="row">
					<div class="col-xs-12 col-sm-12  col-md-12">
						<label for="fechaEscritoAcusacion">Fecha del escrito de acusación: </label>
						<input id="fechaEscritoAcusacion" type="date" value="<?if($opcInsert == 1){echo $fechaEscritoAcusacion;}?>" name="fechaEscritoAcusacion" class="fechas form-control gehit" disabled />
					</div>
				</div>	
		</div>	
	</div><br><br><br><br>
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-6">
			<button style="width: 88%;" onclick="closeModalNucsLitigInfo()" type="button" class="btn btn-default redondear" data-dismiss="modal">Salir</button>
		</div>
		<div class="col-xs-12 col-sm-6  col-md-6 ">
			<?if(	$opcInsert == 0){ ?>
			<button style="width: 88%;" onclick="sendDataMedCautelar(<? echo $nuc; ?>, <? echo $estatus; ?>, <? echo $idMp; ?> , <? echo $mes; ?> , <? echo $anio; ?> , <? echo $deten; ?> , <? echo $idUnidad; ?> ,  <? echo $opcInsert; ?>, <? echo $dataImputado[0][7]; ?>)" type="button" class="btn btn-primary redondear" >Aceptar</button>
				<?}elseif(	$opcInsert == 1 ){?>
			<button style="width: 88%;" onclick="insertMedCautelar_db(<? echo $idEstatusNucs; ?> , <? echo $estatus; ?> , <? echo $nuc; ?> , <? echo $opcInsert; ?>)" type="button" class="btn btn-primary redondear" >Guardar</button>
		<? } ?>
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
			<?if(	$opcInsert == 0){ ?>
			<button style="width: 88%;" onclick="sendDataAudienciaIntermedia(<? echo $nuc; ?>, <? echo $estatus; ?>, <? echo $idMp; ?> , <? echo $mes; ?> , <? echo $anio; ?> , <? echo $deten; ?> , <? echo $idUnidad; ?> ,  <? echo $opcInsert; ?>, <? echo $dataImputado[0][7]; ?>)" type="button" class="btn btn-primary redondear" >Aceptar</button>
			<?}elseif(	$opcInsert == 1 ){?>
			<button style="width: 88%;" onclick="insertAudienciaIntermedia_db(<? echo $idEstatusNucs; ?> , <? echo $estatus; ?> , <? echo $nuc; ?> , <? echo $opcInsert; ?>)" type="button" class="btn btn-primary redondear" >Guardar</button>
		<? } ?>
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
			<?if(	$opcInsert == 0){ ?>
			<button style="width: 88%;" onclick="sendDataSobreseimientos(<? echo $nuc; ?>, <? echo $estatus; ?>, <? echo $idMp; ?> , <? echo $mes; ?> , <? echo $anio; ?> , <? echo $deten; ?> , <? echo $idUnidad; ?> ,  <? echo $opcInsert; ?>, <? echo $dataImputado[0][7]; ?>)" type="button" class="btn btn-primary redondear" >Aceptar</button>
			<?}elseif(	$opcInsert == 1 ){?>
			<button style="width: 88%;" onclick="insertSobreseimientos_db(<? echo $idEstatusNucs; ?> , <? echo $estatus; ?> , <? echo $nuc; ?> , <? echo $opcInsert; ?>)" type="button" class="btn btn-primary redondear" >Guardar</button>
		<? } ?>
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
			<?if(	$opcInsert == 0){ ?>
				<button style="width: 88%;" onclick="sendDataSuspCondProc(<? echo $nuc; ?>, <? echo $estatus; ?>, <? echo $idMp; ?> , <? echo $mes; ?> , <? echo $anio; ?> , <? echo $deten; ?> , <? echo $idUnidad; ?> ,  <? echo $opcInsert; ?>, <? echo $dataImputado[0][7]; ?>)" type="button" class="btn btn-primary redondear" >Aceptar</button>
				<?}elseif(	$opcInsert == 1 ){?>
			<button style="width: 88%;" onclick="insertSuspCondProc_db(<? echo $idEstatusNucs; ?> , <? echo $estatus; ?> , <? echo $nuc; ?> , <? echo $opcInsert; ?>)" type="button" class="btn btn-primary redondear" >Guardar</button>
		<? } ?>
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
			<?if(	$opcInsert == 0){ ?>
			<button style="width: 88%;" onclick="sendDataAudienciasJuicio(<? echo $nuc; ?>, <? echo $estatus; ?>, <? echo $idMp; ?> , <? echo $mes; ?> , <? echo $anio; ?> , <? echo $deten; ?> , <? echo $idUnidad; ?> ,  <? echo $opcInsert; ?>, <? echo $dataImputado[0][7]; ?>)" type="button" class="btn btn-primary redondear" >Aceptar</button>
			<?}elseif(	$opcInsert == 1 ){?>
			<button style="width: 88%;" onclick="insertAudienciasJuicio_db(<? echo $idEstatusNucs; ?> , <? echo $estatus; ?> , <? echo $nuc; ?> , <? echo $opcInsert; ?>)" type="button" class="btn btn-primary redondear" >Guardar</button>
		 <? } ?>
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
			<?if(	$opcInsert == 0){ ?>
			<button style="width: 88%;" onclick="sendDataCriteriosOportunidad(<? echo $nuc; ?>, <? echo $estatus; ?>, <? echo $idMp; ?> , <? echo $mes; ?> , <? echo $anio; ?> , <? echo $deten; ?> , <? echo $idUnidad; ?> ,  <? echo $opcInsert; ?>, <? echo $dataImputado[0][7]; ?>)" type="button" class="btn btn-primary redondear" >Aceptar</button>
			<?}elseif(	$opcInsert == 1 ){?>
			<button style="width: 88%;" onclick="insertCriteriosOportunidad_db(<? echo $idEstatusNucs; ?> , <? echo $estatus; ?> , <? echo $nuc; ?> , <? echo $opcInsert; ?>)" type="button" class="btn btn-primary redondear" >Guardar</button>
		<? } ?>
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
				<?if(	$opcInsert == 0){ ?>
				<button style="width: 88%;" onclick="sendDataAcuerdoReparatorio(<? echo $nuc; ?>, <? echo $estatus; ?>, <? echo $idMp; ?> , <? echo $mes; ?> , <? echo $anio; ?> , <? echo $deten; ?> , <? echo $idUnidad; ?> ,  <? echo $opcInsert; ?>, <? echo $dataImputado[0][7]; ?>)" type="button" class="btn btn-primary redondear" >Aceptar</button>
					<?}elseif(	$opcInsert == 1 ){?>
			<button style="width: 88%;" onclick="insertAcuerdoReparatorio_db(<? echo $idEstatusNucs; ?> , <? echo $estatus; ?> , <? echo $nuc; ?> , <? echo $opcInsert; ?>)" type="button" class="btn btn-primary redondear" >Guardar</button>
		<? } ?>
		</div>
	</div>
 <? } ?>
 <!-- En caso de acuerdos reparatorios, ¿tipo de acuerdos reparatorios? :-->

 <? if($estatus == 154 || $estatus == 66 || $estatus == 14){ 
 	if($estatus == 14){ //Para poder hacer consulta en caso de que el estatus sea 14 ya que esta se recibe en la tabla de resoluciones de la BD Prueba
 	if($idResolMP == 0){
 		$getData = getDataSentencias($conn,  'null', $estatus); 
 	}else{
 		$getData = getDataSentencias($conn,  $idResolMP, $estatus);
 	}
 }else{
 	if($idEstatusNucs == 0){
 		$getData = getDataSentencias($conn, 'null' , $estatus);
 	}else{
 		if($tipo_investigacion != 2){
 			$getData = getDataSentencias($conn,  $idEstatusNucs, $estatus);
 		}else{
 			$getData = getDataSentenciasAveriguaciones($conn,  $idEstatusNucs, $estatus);
 		}
 	}
 }
	 	if(sizeof($getData) > 0){ 
	 		$opcInsert = 1; 
	 		if($estatus != 66 && $tipo_investigacion != 2){$fechaDictoSentencia = $getData[0][2] ->format('Y-m-d');}
	 		$tipoSentencia = $getData[0][3];
	 		$aniosPrision = $getData[0][4];
	 		$sentenciaFirme = $getData[0][5];
	 		$sentDerivaProcAbrv = $getData[0][6];
	 		if($estatus != 66 && $tipo_investigacion != 2){$fechaDictoProcAbrv = $getData[0][7]->format('Y-m-d');}
	 		$idModalidadEstadistica = $getData[0][8];
	 		$reclasificado = $getData[0][9];
	 		$getName = getDataDelitoNombre($conSic , $idModalidadEstadistica );
	 		$nombreDelito = $getName[0][1];
	 	}else{ 	$opcInsert = 0; $reclasificado = 0; }
	 	?>
	<div class="row">
		<div class="col-xs-12 col-sm-12  col-md-12">
		<!-- TABLA DELITOS POR LA CUAL SE DIO SENTENCIA CONDENATORIA-->
		<?if($tipo_investigacion == 1){ ?>

			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12">
					<h4>Ingrese los datos generales del imputado</strong></h4>
				</div>
			</div><br>

		<?
		/*
		$getData = getDataImputados($conn, $idEstatusNucs);
			 	if(sizeof($getData) > 0){ 
			 		$opcInsert = 1; 
			 	}else{
			 		$opcInsert = 0; 
			 	}*/
		?>
		<div id="contDataImputados">
			<div class="row">
				<div class="col-xs-12 col-sm-4  col-md-4">
					<label for="nombre_imputado">Nombre: </label>
					<input id="nombre_imputado" type="text" disabled value="<? echo $dataImputado[0][0]; ?>" name="nombre_imputado" placeholder="NOMBRE" maxlength="40" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); "  onkeypress="return validaInput_litigacion(event, 'varchar')" class="fechas form-control gehit"  />
				</div>
				<div class="col-xs-12 col-sm-4  col-md-4">
					<label for="apellido_paterno">Apellido Paterno:  </label>
					<input id="apellido_paterno" type="text" disabled value="<? echo $dataImputado[0][1]; ?>" name="apellido_paterno" placeholder="APELLIDO PATERNO" maxlength="50" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); "  onkeypress="return validaInput_litigacion(event, 'varchar')" class="fechas form-control gehit"  />
				</div>
				<div class="col-xs-12 col-sm-4  col-md-4">
					<label for="apellido_materno">Apellido Materno: </label>
					<input id="apellido_materno" type="text" disabled value="<? echo $dataImputado[0][2]; ?>" name="apellido_materno" placeholder="APELLIDO MATERNO" maxlength="50" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); "  onkeypress="return validaInput_litigacion(event, 'varchar')" class="fechas form-control gehit"  />
				</div>
			</div><br>
			<div class="row">
				<div class="col-xs-12 col-sm-12  col-md-3">
					<label for="edad">Edad:</label>
					<input type="number" class="form-control"  disabled value="<? echo $dataImputado[0][3]; ?>" id="edad" placeholder="ESPECIFICA LA EDAD" >
				</div>
				<div class="col-xs-12 col-sm-12  col-md-3 input-group-lg">
					<label for="id_sexo">Sexo</label><br>

						<input disabled type="radio" id="id_sexo" name="id_sexo" <? if($dataImputado[0][4] == "M"){ ?>checked="checked"<? } ?> value="M"  >
						<label for="cv_sexo" >Masculino</label>&nbsp;&nbsp;&nbsp;&nbsp;

						<input disabled type="radio" id="id_sexo" name="id_sexo" <? if($dataImputado[0][4] == "F"){ ?>checked="checked"<? } ?> value="F"  >
						<label for="cv_sexo" >Femenino</label>
					</div>
			</div>
		</div>
			<hr>
			<div class="row">
				<div class="col-xs-12 col-sm-12  col-md-12">
					<table class="table table-bordered">
						<thead>
							<tr class="cabeceraTablaVictimas">
								<th>#</th>
								<th>Nombre</th>
								<th>Apellido Paterno</th>
								<th>Apellido Materno</th>
								<th>Edad</th>
								<th>Sexo</th>
								<!-- <th>Acciones</th> -->
							</tr>
						</thead>
				<?$getData = getDataImputados($conn, $idEstatusNucs);
				  $total_imputados = sizeof($getData);
			 	if(sizeof($getData) > 0){ ?>
						<tbody>
						<?for ($h=0; $h < sizeof($getData) ; $h++) { ?>
							<tr>
								<th><center><?echo $h+1; ?></center></th>
								<th><center><?echo $getData[$h][2]; ?></center></th>
								<th><center><?echo $getData[$h][3]; ?></center></th>
								<th><center><?echo $getData[$h][4]; ?></center></th>
								<th><center><?echo $getData[$h][5]; ?></center></th>
								<th><center><?echo $getData[$h][6]; ?></center></th>
								<!-- <td><center><center><img src="img/editarMandamiento2.png" data-toggle="modal" href="#mandamientos"  onclick="edita_imputado(<? echo $getData[$h][0]; ?> , 'SENTENCIAS' )"><img src="img/eliminar.png"  onclick="elimiar_imputado(<?echo $idEstatusNucs ?> , <? echo $getData[$h][0]; ?> , <? echo $total_imputados; ?>);"></center></td> -->
															</tr>
							</tr>
							<? } ?>
						</tbody>
						<? } ?>
					</table>
				</div>
			</div>
			<br><br><br><br>

			<div class="row">
				<div class="col-xs-12 col-sm-12  col-md-12">
					<label for="">Delito por el cual se dio la sentencia: </label>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12  col-md-12">
					<div id="tablePuestasDataMando" class="row pad20">	
									<table class="table table-striped  table-hover">
										<thead>
											<tr class="cabezeraTablaForest">
												<th class="textCent">#</th>
												<th class="textCent">Delito</th>
												<th class="textCent">¿Principal?</th>
											</tr>
										</thead>
										<tbody id="">
										<?
             $datossicap=get_datos_carpeta_capturado($conSic, $nuc);  
										   $getDataDelito = getDataDelito($conSic, $datossicap[0][0]);
										   $k=0;
										for ($i=0; $i < sizeof($getDataDelito); $i++) {  ?>
											<tr>
												<td class="textCent"><? echo $k+=1; ?></td>
												<td class="textCent"><strong><? echo $getDataDelito[$i][4]; ?></strong>&nbsp&nbsp<input type="radio" name="checkDelito" value="<? echo $getDataDelito[$i][3]; ?>" class="checkDelito" <?if($opcInsert == 1 && $idModalidadEstadistica == $getDataDelito[$i][3]){ ?> checked <? } ?> ><span class="checkmark"></span></td>
												<td class="textCent"><? echo $getDataDelito[$i][5]; ?></td>
			        </tr>
			       <? } ?>
										</tbody>
									</table>
					 </div>
				 </div>
			 </div><br>
			 <div class="row">
			 	<div class="col-xs-12 col-sm-12  col-md-12">
			 		<h4><strong>Nota: </strong>Información cargada de SICAP.</h4>
			 	</div>
			 </div><br>
			 <div class="row">
			 	<div class="col-xs-12 col-sm-12  col-md-12">
			 		<h4>Si el delito por el cual se dio la sentencia no figura en la tabla anterior, reclasifique el delito en la siguiente opción: </h4>
			 	</div>
			 </div><br>
			 <div class="row">
			 	<div class="col-xs-12 col-sm-12  col-md-12">
			 	<label>Reclasificar delito: &nbsp&nbsp<input type="checkbox"class="checkRecla" id="cbox1" value="" onclick="reclasificar()"></label>
			 	</div>
			 </div><br>
			 <div class="row" id="tableReclasificar" <?if($opcInsert == 0 && $reclasificado == 0){ ?> hidden <? } ?> >
				<div class="col-xs-12 col-sm-12  col-md-12">
					<div id="tablePuestasDataMando" class="row pad20">	
									<table class="table table-striped  table-hover">
										<thead>
											<tr class="cabezeraTablaForest">
												<th class="textCent">#</th>
												<th class="textCent">Delito</th>
											</tr>
										</thead>
										<tbody id="">
											<tr>
												<td class="textCent">1</td>
												<td class="textCent">
													<datalist id="newBrwosers">
																<? 
																																					$delitos = getDataDelitosSica($conSic);
																																						for ($h=0; $h < sizeof($delitos); $h++) {
																																							 $idDelito = $delitos[$h][0];	
																																								$nom = $delitos[$h][1];
																																									?>
																																											<option style="color: black; font-weight: bold;" value="<? echo $nom; ?>" data-value="<? echo  $idDelito; ?>" data-id="<? echo $idDelito; ?>"></option>
																																									<?
																																						}
																																			 ?>
												</datalist>
												<input class="form-control mandda gehit" value="<? if($opcInsert == 1){ echo $nombreDelito; } ?>" onchange="" onfocus="" list="newBrwosers" id="newBrwoser" name="newBrwoser" type="text" ></td>
			        </tr>
										</tbody>
									</table>
					 </div>
				 </div>
			 </div><? }else{ ?>
			 	<!--ENTRA AQUI SI ES UNA AVERIGUACION PREVIA-->
			 	<div class="row" id="tableReclasificar" >
				<div class="col-xs-12 col-sm-12  col-md-12">
					<div id="tablePuestasDataMando" class="row pad20">	
									<table class="table table-striped  table-hover">
										<thead>
											<tr class="cabezeraTablaForest">
												<th class="textCent">#</th>
												<th class="textCent">Delito</th>
											</tr>
										</thead>
										<tbody id="">
											<tr>
												<td class="textCent">1</td>
												<td class="textCent">
													<datalist id="newBrwosers">
													<?$delitos = getDataDelitosSica($conSic);
														for ($h=0; $h < sizeof($delitos); $h++) {
															$idDelito = $delitos[$h][0];	
															$nom = $delitos[$h][1];
														?>
														<option style="color: black; font-weight: bold;" value="<? echo $nom; ?>" data-value="<? echo  $idDelito; ?>" data-id="<? echo $idDelito; ?>"></option>
													<?	} ?>
												</datalist>
												<input class="form-control mandda gehit" value="<? if($opcInsert == 1){ echo $nombreDelito; } ?>" onchange="" onfocus="" list="newBrwosers" id="newBrwoser" name="newBrwoser" type="text" ></td>
			        </tr>
										</tbody>
									</table>
					 </div>
				 </div>
			 </div>
    <? } ?>
			<br>
			<input type="hidden" id="tipoSentencia" value="<?if($estatus == 154 || $estatus == 14){echo 2;}elseif($estatus == 66){echo 1; }else{echo 3;} ?>" >
			 <?if($estatus == 154 || $estatus == 14 || $estatus == 66 || $estatus == 67){ ?>
			 <!--¿La sentencia fue derivada de un procedimiento abreviado? :-->
			<div class="row">
				<div class="col-xs-12 col-sm-12  col-md-12">
					<label for="fechaDictoSentencia">Fecha en que se dictó la sentencia:</label>
					<input id="fechaDictoSentencia" type="date" value="<?if($opcInsert == 1){echo $fechaDictoSentencia;}?>" name="fechaDictoSentencia" class="fechas form-control gehit"  />
				</div>
			</div><br>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12">
					<label for="aniosPrision">Tiempo en prisión (años): </label>
					<input id="aniosPrision" type="number" value="<?if($opcInsert == 1){echo $aniosPrision;}?>" name="aniosPrision" class="fechas form-control gehit"  min="1" pattern="^[0-9]+" />
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
		<? } ?>
	 </div>
	</div><br><br><br><br>
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-6">
			<button style="width: 88%;" onclick="closeModalNucsLitigInfo()" type="button" class="btn btn-default redondear" data-dismiss="modal">Salir</button>
		</div>
		<div class="col-xs-12 col-sm-6  col-md-6 ">
			<?if(	$opcInsert == 0){ 
				if($estatus == 14){?>
			<button style="width: 88%;" onclick="insertSentencias_db(<?if($estatus == 14){ echo $idResolMP; }else{ echo $idEstatusNucs; } ?> , <? echo $estatus; ?> , <? echo $nuc; ?> , <? echo $opcInsert; ?>, <? echo $tipo_investigacion ?>)" type="button" class="btn btn-primary redondear" >Aceptar</button>
		<? } else{?>
			<button style="width: 88%;" onclick="sendDataSentencias(<? echo $nuc; ?>, <? echo $estatus; ?>, <? echo $idMp; ?> , <? echo $mes; ?> , <? echo $anio; ?> , <? echo $deten; ?> , <? echo $idUnidad; ?> ,  <? echo $opcInsert; ?> , <? echo $tipo_investigacion ?>, <? echo $dataImputado[0][7]; ?>)" type="button" class="btn btn-primary redondear" >Aceptar</button>
		<? } ?>
				<?}elseif(	$opcInsert == 1 ){?>
			<button style="width: 88%;" onclick="insertSentencias_db(<?if($estatus == 14){ echo $idResolMP; }else{ echo $idEstatusNucs; } ?> , <? echo $estatus; ?> , <? echo $nuc; ?> , <? echo $opcInsert; ?> , <? echo $idMp ?> , <? echo $mes ?> , <? echo $anio ?> , <? echo $tipo_investigacion ?>)" type="button" class="btn btn-primary redondear" >Guardar</button>
		 <? } ?>
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
			<?if(	$opcInsert == 0){ ?>
			<button style="width: 88%;" onclick="sendDataReparacionDanios(<? echo $nuc; ?>, <? echo $estatus; ?>, <? echo $idMp; ?> , <? echo $mes; ?> , <? echo $anio; ?> , <? echo $deten; ?> , <? echo $idUnidad; ?> ,  <? echo $opcInsert; ?>, <? echo $dataImputado[0][7]; ?>)" type="button" class="btn btn-primary redondear" >Aceptar</button>
			<?}elseif(	$opcInsert == 1 ){?>
			<button style="width: 88%;" onclick="insertReparacionDanios_db(<?echo $idEstatusNucs; ?> , <? echo $estatus; ?> , <? echo $nuc; ?> , <? echo $opcInsert; ?>)" type="button" class="btn btn-primary redondear" >Guardar</button>
			<? } ?>
		</div>
	</div>
 <? } ?>
 <!-- Termina Monto de la reparación del daño impuesta :-->

  <? if($estatus == 129){ 
  		$getData = getDataMedidasProteccion($conn, $idEstatusNucs);
	 	if(sizeof($getData) > 0){ 
	 		$opcInsert = 1; 
	 			$masculino = $getData[0][3];
		 		$femenino = $getData[0][4];
		 		$moral = $getData[0][5];
		 		$desconocido = $getData[0][6];
	 	}else{ 	$opcInsert = 0; }
	 ?>
	<div class="row">
		<div class="col-xs-12 col-sm-12  col-md-12">
		<!--Monto de la reparación del daño impuesta :-->
		<div class="row">
				<div class="col-xs-12 col-sm-12  col-md-12">
						<label for="personaFisMasc">Total de víctimas de medidas de protección : </label>
				</div>
			</div><br>
			<div class="row">
				<div class="col-xs-12 col-sm-12  col-md-12">
						<label for="personaFisMasc">Persona fisica sexo masculino : </label>
						<input id="personaFisMasc" type="number" value="<?if($opcInsert == 1){echo $masculino;}?>" name="personaFisMasc" class="fechas form-control gehit"  />
				</div>
			</div><br>
			<div class="row">
				<div class="col-xs-12 col-sm-12  col-md-12">
						<label for="personaFisFem">Persona fisica sexo femenino : </label>
						<input id="personaFisFem" type="number" value="<?if($opcInsert == 1){echo $femenino;}?>" name="personaFisFem" class="fechas form-control gehit"  />
				</div>
			</div><br>
			<div class="row">
					<div class="col-xs-12 col-sm-12  col-md-12">
						<label for="personaMoral">Persona moral : </label>
						<input id="personaMoral" type="number" value="<?if($opcInsert == 1){echo $moral;}?>" name="personaMoral" class="fechas form-control gehit"  />
				</div>
			</div><br>
			<div class="row">
				<div class="col-xs-12 col-sm-12  col-md-12">
						<label for="desconocido">Desconocido : </label>
						<input id="desconocido" type="number" value="<?if($opcInsert == 1){echo $desconocido;}?>" name="desconocido" class="fechas form-control gehit"  />
				</div>
			</div>
			</div>
	 </div><br><br><br><br>
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-6">
			<button style="width: 88%;" onclick="closeModalNucsLitigInfo()" type="button" class="btn btn-default redondear" data-dismiss="modal">Salir</button>
		</div>
		<div class="col-xs-12 col-sm-6  col-md-6 ">
			<?if(	$opcInsert == 0){ ?>
			<button style="width: 88%;" onclick="sendDataMedidasProteccion(<? echo $nuc; ?>, <? echo $estatus; ?>, <? echo $idMp; ?> , <? echo $mes; ?> , <? echo $anio; ?> , <? echo $deten; ?> , <? echo $idUnidad; ?> ,  <? echo $opcInsert; ?>, <? echo $dataImputado[0][7]; ?>)" type="button" class="btn btn-primary redondear" >Aceptar</button>
			<?}elseif(	$opcInsert == 1 ){?>
			<button style="width: 88%;" onclick="insertMedidaProteccion_db(<?echo $idEstatusNucs; ?> , <? echo $estatus; ?> , <? echo $nuc; ?> , <? echo $opcInsert; ?>, <? echo $idMp; ?> , <? echo $mes; ?>, <? echo $anio; ?>)" type="button" class="btn btn-primary redondear" >Guardar</button>
			<? } ?>
		</div>
	</div>
 <? } ?>

 <? if($estatus == 57){ 
 	$getData = getDataFechaCumplimento($conn, $idEstatusNucs);
	 	if(sizeof($getData) > 0){ 
	 		$opcInsert = 1; 
	 		$fecha = $getData[0][2] ->format('Y-m-d'); 
	 	}else{ 	$opcInsert = 0; }
	 	?>
	<div class="row">
		<!--fecha cumplimento mandamiento judicial :-->
		<div class="col-xs-12 col-sm-12  col-md-12">
			<label for="fechaCumplimiento">Fecha de cumplimiento : </label>
			<input id="fechaCumplimiento" type="date" value="<?if($opcInsert == 1){echo $fecha;}?>" name="fechaCumplimiento" class="fechas form-control gehit"  />
		</div>
	</div><br><br><br><br>
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-6">
			<button style="width: 88%;" onclick="closeModalNucsLitigInfo()" type="button" class="btn btn-default redondear" data-dismiss="modal">Salir</button>
		</div>
		<div class="col-xs-12 col-sm-6  col-md-6 ">
		<?if(	$opcInsert == 0){ ?>
			<button style="width: 88%;" onclick="sendDataFechaCumplimento(<? echo $nuc; ?>, <? echo $estatus; ?>, <? echo $idMp; ?> , <? echo $mes; ?> , <? echo $anio; ?> , <? echo $deten; ?> , <? echo $idUnidad; ?> ,  <? echo $opcInsert; ?>, <? echo $dataImputado[0][7]; ?>)" type="button" class="btn btn-primary redondear" >Aceptar</button>
			<?}elseif(	$opcInsert == 1 ){?>
			<button style="width: 88%;" onclick="insertFechaCumplimento_db(<? echo $idEstatusNucs; ?> , <? echo $estatus; ?> , <? echo $nuc; ?> , <? echo $opcInsert; ?>)" type="button" class="btn btn-primary redondear" >Guardar</button>
		<? } ?>
		</div>
	</div>
 <? } ?>

  <!-- CARPETAS EN TRAMITE MOTIVO :-->
  <? if($estatus == 165){ 
  	$getData = getMotivosCarpetaTramite($conn, $idEstatusNucs);
	 	if(sizeof($getData) > 0){ 
	 		$opcInsert = 1; 
	 		$getDataMotivo = $getData[0][2];
	 	}else{ 	$opcInsert = 0; }
	 	?>
	<div class="row">
		<div class="col-xs-12 col-sm-12  col-md-12">
		<!--En caso de acuerdos reparatorios, ¿tipo de acuerdos reparatorios?  :-->
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12">
						<label for="motivoCarpetaTramite">Seleccione la etapa en la que se encuentra la carpeta: </label>
						<select id="motivoCarpetaTramite" name="motivoCarpetaTramite" tabindex="6" class="form-control redondear ">
							<option value="0">Selecciona</option>
							<?$getMotivosCarpetaTramite = getDataMotivosCarpetaTramite($conn);
							for ($i=0; $i < sizeof($getMotivosCarpetaTramite); $i++) {
								$idCatMotivo = $getMotivosCarpetaTramite[$i][0];	$motivo = $getMotivosCarpetaTramite[$i][1];	?>
								<option style="color: black; font-weight: bold;" value="<? echo $idCatMotivo; ?>" <?if($opcInsert == 1 && $idCatMotivo == $getDataMotivo){ ?> selected <? } ?> ><? echo $motivo; ?> </option>
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
				<?if(	$opcInsert == 0){ ?>
				<button style="width: 88%;" onclick="sendDataMotivosCarpetaTramite(<? echo $nuc; ?>, <? echo $estatus; ?>, <? echo $idMp; ?> , <? echo $mes; ?> , <? echo $anio; ?> , <? echo $deten; ?> , <? echo $idUnidad; ?> ,  <? echo $opcInsert; ?>, <? echo $dataImputado[0][7]; ?>)" type="button" class="btn btn-primary redondear" >Aceptar</button>
					<?}elseif(	$opcInsert == 1 ){?>
			<button style="width: 88%;" onclick="insertMotivosCarpetaTramite_db(<? echo $idEstatusNucs; ?> , <? echo $estatus; ?> , <? echo $nuc; ?> , <? echo $opcInsert; ?>)" type="button" class="btn btn-primary redondear" >Guardar</button>
		<? } ?>
		</div>
	</div>
 <? } ?>
 <!-- CARPETAS EN TRAMITE MOTIVO :-->

</div>


<div class="modal-footer">
	
</div>




																												
																													
																																																			
																					