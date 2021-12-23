<?php
include ("../../Conexiones/Conexion.php");
include ("../../Conexiones/conexionMedidas.php");
include ("../../Conexiones/conexionSicap.php");
include("../../funcionesMedidasProteccion.php");	
$fecha_actual=date("d/m/Y");
$fecha=strftime( "%Y-%m-%d %H:%M:%S", time() );

if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }
if (isset($_POST["fraccion"])){ $fraccion = $_POST["fraccion"]; }
if (isset($_POST["dataPrincipalArray"])){ $dataPrincipalArray = json_decode($_POST['dataPrincipalArray'], true); }
if (isset($_POST["nuc"])){ $nuc = $_POST["nuc"]; }

if (isset($_POST["tipoModal"])){ $tipoModal = $_POST["tipoModal"]; }

$getRolUser = getRolUser($connMedidas, $idEnlace);
$rolUser = $getRolUser[0][0];

if (isset($_POST["idMedida"])){
	$idMedida = $_POST["idMedida"]; 
	if ($idMedida != 0) {
  $idMedida = $_POST["idMedida"]; 
		$a = 1;
	}else{
		$a = 0;
		$idMedida = 0; 
	}
}


?>


<div class="modal-header" style="background-color:#152F4A;">
	<center><label style="color: white; font-weight: bold; font-size: 2rem;">Registro de Medida de Protección</label></center>
</div>
<div class="modal-body">
	
	<? $getDataGenerales = getDataGenerales($connMedidas, $idMedida,0,0);
	   $checkExistDataGeneral = $getDataGenerales[0][0];
	   if(sizeof($getDataGenerales) > 0){ $checkInfoPrevia = 1; }else{ $checkInfoPrevia = 0; } ?>
	<div class="row">
		<!--MENU DE OPCIONES ASIGNADO A ROLES-->
		<?if($rolUser == 1){
			//Menu Coordinador
			include('templates/template_menuCoordinador.php');
		}elseif($rolUser == 3){
			//Menu ministerio publico
			include('templates/template_menuMP.php');
		}elseif($rolUser == 2){
			//Menu capturista
			include('templates/template_menuCapturista.php');
		} ?><!--TERMINA MENU DE OPCIONES ASIGNADO A ROLES-->
		<div class="col-xs-12 col-sm-12 col-md-9">
			<!--DATOS GENERALES NUC Y CUADERNO DE ANTECEDENTES-->
			<div class="sectionData" id="datosGenerales">
				<div class="panel panel-default fd1">
					<div class="panel-body">
						<h5 class="text-on-pannel"><strong>Datos Generales</strong></h5>
						<div id="contDataCuadernoAntecedentes">
						<?if($checkInfoPrevia == 0){ ?>
						<div class="row">
								<div class="col-xs-12 col-sm-12  col-md-2">
								 <button type="button" class="btn btn-primary btn-lg" onclick="saveDatosGenerales(<?php echo $idEnlace; ?> , <?php echo $fraccion; ?>, <?echo $idMedida ?> , <?echo $nuc ?>)">Guardar información </button>
							 </div>
					 </div><br>
					<? } ?>
						<div class="row">
							<div class="col-xs-12 col-sm-12  col-md-3">
								<label for="nuc">NUC: </label>
								<input class="form-control mandda gehit" value="<? echo $nuc; ?>"  id="nuc"  type="text" disabled>
							</div>
								<div class="col-xs-12 col-sm-12  col-md-3">
									<label for="numAntecedentes">CUADERNO DE ANTECEDENTES: <span class="aste">(*)</span></label>
									<input class="form-control mandda gehit" <?if($fraccion == 1 || $fraccion == 2 || $fraccion == 3){?> disabled <? } ?> value=""  id="numAntecedentes"  type="text">
								</div>
								<div class="col-xs-12 col-sm-12  col-md-3">
								 <label for="temporalidad">TEMPORALIDAD: <span class="aste">(*)</span></label>
									<select class="form-control" id="temporalidad">
										 <option value="">Seleccione</option>
										 <?php for ($i=1; $i<=99; $i++){ ?>
										 	<option class="fontBold" value="<?php echo $i; ?>"><?php echo $i;?> días</option>
										 <?php } ?>
									</select>
								</div>
								<div class="col-xs-12 col-sm-12  col-md-3">
									<label for="fechaConclusion">Fecha de conclusión: <span class="aste">(*)</span></label>
									<input id="fechaConclusion" type="datetime-local" value="" name="fechaConclusion" class="fechas form-control gehit" />
								</div>
							</div>
						</div><br>
						<?if(sizeof($getDataGenerales) > 0) { 
							$totalCuaderno = sizeof($getDataGenerales); ?>
						<div class="row">
								<div class="col-xs-12 col-sm-12  col-md-12">
									<table class="table table-bordered">
										<thead>
											<tr class="cabeceraTablaVictimas">
											<th>#</th>
											<th>Cuaderno de antecedentes</th>
											<th>Temporalidad</th>
											<th>Fecha de conclusión</th>
											<th>Acciones</th>
											</tr>
										</thead>
										<tbody>
										<?for ($h=0; $h < sizeof($getDataGenerales) ; $h++) {
										$fechaConclusion = $getDataGenerales[$h][3]->format('Y-m-d H:i'); ?>
											<tr>
												<td><?echo $h + 1 ?></td>
												<td><?echo $getDataGenerales[$h][1] ?></td>
												<td><?echo $getDataGenerales[$h][2] ?> días</td>
												<td><? echo $fechaConclusion ?></td>
												<td><center><span onclick="editaDatosGenerales(<?php echo $idEnlace; ?> , <?php echo $getDataGenerales[$h][0]; ?>, <?echo $idMedida ?>)" title="Editar" style="cursor: pointer; color: orange; font-size: 18px;" class="glyphicon glyphicon-edit"></span></center></td>
											</tr>
										<? } ?>
										</tbody>
								 </table>
								</div>
							</div><? } ?></br>
						<div class="modal-footer">
						
						</div>
					</div>
			 </div>
			</div>
			<!--DATOS GENERALES NUC Y CUADERNO DE ANTECEDENTES-->
			<!--DATOS RESOLUCIÓN-->
			<div class="sectionData" id="resolucion">
				<div class="panel panel-default fd1">
					<div class="panel-body">
						<h5 class="text-on-pannel"><strong>Resolución</strong></h5>
						<div id="contDataResoluciones">
							<div class="row">
								<div class="col-xs-12 col-sm-12  col-md-2">
									<button type="button" <?if($rolUser == 1){ ?> disabled <? } ?> class="btn btn-primary btn-lg" onclick="saveDatosResoluciones(<?php echo $idEnlace; ?> , <?php echo $fraccion; ?>, <?echo $idMedida ?>, <?echo $a; ?>)">Guardar información</button>
								</div>
							</div><br>
							<div class="row">
								<div class="col-xs-12 col-sm-12  col-md-2">
									<label for="ratificacion">Ratificación: <span class="aste">(*)</span></label>
									<select class="form-control" id="ratificacion">
										 <option value="">Seleccione</option>
									  <option class="fontBold" value="1">Si</option>
									  <option class="fontBold" value="0">No</option>
									</select>
								</div>
								<div class="col-xs-12 col-sm-12  col-md-4">
									<label for="observacionRatifica">Observación: <span class="aste">(*)</span></label>
									<input class="form-control mandda gehit" value=""  id="observacionRatifica"  type="text">
								</div>
								<div class="col-xs-12 col-sm-12  col-md-2">
									<label for="modifica">Modificada: <span class="aste">(*)</span></label>
									<select class="form-control" id="modifica">
										 <option value="">Seleccione</option>
									  <option class="fontBold" value="1">Si</option>
									  <option class="fontBold" value="0">No</option>
									</select>
								</div>
								<div class="col-xs-12 col-sm-12  col-md-4">
									<label for="observacionModifica">Observación: <span class="aste">(*)</span></label>
									<input class="form-control mandda gehit" value=""  id="observacionModifica"  type="text">
								</div>
							</div>
						</div></br>
							<?$getDataResoluciones = getDataResoluciones($connMedidas, $idMedida,0,0); 
						  if(sizeof($getDataResoluciones ) > 0) { ?>
						<div class="row">
								<div class="col-xs-12 col-sm-12  col-md-12">
									<table class="table table-bordered">
										<thead>
											<tr class="cabeceraTablaVictimas">
											<th>#</th>
											<th>Ratificación</th>
											<th>Observación:</th>
											<th>Modificada</th>
											<th>Observación</th>
											<th>Acciones</th>
											<th>Acciones</th>
											</tr>
										</thead>
										<tbody>
										<?for ($h=0; $h < sizeof($getDataResoluciones) ; $h++) { ?>
											<tr>
												<td><?echo $h + 1 ?></td>
												<td><?echo $getDataResoluciones[$h][2] ?></td>
												<td><?echo $getDataResoluciones[$h][4] ?></td>
												<td><?echo $getDataResoluciones[$h][3] ?></td>
												<td><?echo $getDataResoluciones[$h][5] ?></td>
												<td><center><span onclick="editaResoluciones(<?php echo $idEnlace; ?> , <?php echo $getDataResoluciones[$h][0]; ?>, <?echo $idMedida ?>, 0)" title="Editar" style="cursor: pointer; color: orange; font-size: 18px;" class="glyphicon glyphicon-edit"></span></center></td>
												<td><center><span onclick="deleteItem(2, <?echo $getDataResoluciones[$h][0] ?>, <?php echo $idEnlace; ?>,<?echo $idMedida ?>,0)" title="Eliminar" style="cursor: pointer; color: red; font-size: 18px;" class="glyphicon glyphicon-trash"></span> </center></td>
											</tr>
										<? } ?>
										</tbody>
								 </table>
								</div>
							</div><? } ?>
					</div>
				</div>
			</div>
			<!--DATOS RESOLUCIÓN-->
			<!--DATOS VICTIMA-->
			<div class="sectionData" id="victima">
				<div class="panel panel-default fd1">
					<div class="panel-body">
						<h5 class="text-on-pannel"><strong>Datos de la víctima</strong></h5>
						
						<?$getDataVictimas = getDataVictimas($connMedidas, $idMedida); 
						if(sizeof($getDataVictimas) > 0 ) { ?>
						<label>Víctima(s)</label>
						<div class="row">
							<div class="col-xs-12 col-sm-12  col-md-12">
								<table class="table table-bordered">
									<thead>
										<tr class="cabeceraTablaVictimas">
										<th>#</th>
										<th>Nombre</th>
										<th>Paterno</th>
										<th>Materno</th>
										<th>Género</th>
										<th>Edad</th>
										<th>Datos de contacto</th>
										<th>Acciones</th>
										<th>Acciones</th>
										</tr>
									</thead>
									<tbody id="contentTableDataVictimas">
									<?for ($h=0; $h < sizeof($getDataVictimas) ; $h++) { 
										$totalV = sizeof($getDataVictimas);
										$dataCompleted = checkDataContactoCompleted($connMedidas, $getDataVictimas[$h][0]); 
										$checkEdad = checkEdad($getDataVictimas[$h][6]);?>
										<tr>
											<td><? echo $h + 1 ?></td>
											<td><?echo $getDataVictimas[$h][2]; ?></td>
											<td><?echo $getDataVictimas[$h][3]; ?></td>
											<td><?echo $getDataVictimas[$h][4]; ?></td>
											<td><?echo $getDataVictimas[$h][5]; ?></td>
											<td><?echo abs($getDataVictimas[$h][6]).' '.$checkEdad; ?></td>
											<?if($dataCompleted[0][0] > 0){?>
											<td style="background: green; color: white;"><center>Completado</center></td><? }else{ ?>
											<td style="background: #FF9A09; color: white;"><center>Incompleto</center></td><? } ?>
											<td><center><span onclick="agregarDatosContacto(<?php echo $getDataVictimas[$h][0]; ?> , <?php echo $fraccion; ?>, <?echo $idMedida ?>, <?echo $idEnlace; ?>)" title="Editar" style="cursor: pointer; color: orange; font-size: 18px;" class="glyphicon glyphicon-edit"></span></center></td>
											<td><center><span onclick="deleteItem(3, <?echo $getDataVictimas[$h][0] ?>, <?php echo $idEnlace; ?>,<?echo $idMedida ?>, <?echo $totalV ?>)" title="Eliminar" style="cursor: pointer; color: red; font-size: 18px;" class="glyphicon glyphicon-trash"></span> </center></td>
										</tr>
									<? } ?>
									</tbody>
							 </table>
							</div>
						</div>
					<? } ?>
						<!--INICIA DIV OCULTO DATOS VICTIMA-->
						<div id="contDatosVictima">
							
						</div>
						<!--TERMINA DIV OCULTO DATOS VICTIMA-->
					</div>
				</div>
			</div>
			<!--DATOS VICTIMA-->
			<!--DATOS DEL IMPUTADO-->
			<div class="sectionData" id="imputados">
				<div class="panel panel-default fd1">
					<div class="panel-body">
						<h5 class="text-on-pannel"><strong>Imputado(s)</strong></h5>
						<div id="contDataImputados">
							<div class="row">
								<div class="col-xs-12 col-sm-12  col-md-3">
									<button type="button" <?if($rolUser == 1){ ?> disabled <? } ?> class="btn btn-primary btn-lg"  onclick="saveDatosImputado(<?php echo $idEnlace; ?> , <?php echo $fraccion; ?>, <?echo $idMedida ?>, <?echo $a; ?>)">Agregar imputado</button>
								</div>
							</div><br>
							<div class="row">
								<div class="col-xs-12 col-sm-12  col-md-3">
									<label for="nombreImpu">Nombre: <span class="aste">(*)</span></label>
									<input class="form-control mandda gehit" value=""  id="nombreImpu"  type="text">
								</div>
								<div class="col-xs-12 col-sm-12  col-md-3">
									<label for="paternoImpu">Paterno: <span class="aste">(*)</span></label>
									<input class="form-control mandda gehit" value=""  id="paternoImpu"  type="text">
								</div>
								<div class="col-xs-12 col-sm-12  col-md-3">
									<label for="maternoImpu">Materno: <span class="aste">(*)</span></label>
									<input class="form-control mandda gehit" value=""  id="maternoImpu"  type="text">
								</div>
								<div class="col-xs-12 col-sm-12  col-md-2">
									<label for="generoImpu">Género: <span class="aste">(*)</span></label>
									<select class="form-control" id="generoImpu" name="generoImpu">
										<option value="0" selected>Seleccione</option>
									 <option class="fontBold" value="1" >Masculino</option>
									 <option class="fontBold" value="1" >Femenino</option>
									 <option class="fontBold" value="3" >Desconocido</option>
									</select>
								</div>
								<div class="col-xs-12 col-sm-12  col-md-1">
									<label for="edadImpu">Edad: <span class="aste">(*)</span></label>
									<select class="form-control" id="edadImpu">
										<option value="">Seleccione</option>
										<option class="fontBold" value="0">Desconocida</option>
										 <?php for ($i=18; $i<=100; $i++){ ?>
										 	<option class="fontBold" value="<?php echo $i;?>"><?php echo $i;?> Años</option>
										 <?php } ?>
									</select>
								</div>
							</div>
						</div><br>
						<div class="row">
							<div class="col-xs-12 col-sm-12  col-md-12">
								<input type="checkbox" id="acepto" name="acepto" onclick="imputadoDesconocido()" >
								<label for="acepto"><span></span>Desconocido</label>
							</div>
						</div><br>
							<!--INICIA DIV OCULTO DATOS IMPUTADOS-->
						<?$getDataImputados = getDataImputados($connMedidas, $idMedida,0,0); 
						  if(sizeof($getDataImputados) > 0) { 
						  	$totalImpu = sizeof($getDataImputados); ?>
						<div class="row">
								<div class="col-xs-12 col-sm-12  col-md-12">
									<table class="table table-bordered">
										<thead>
											<tr class="cabeceraTablaVictimas">
											<th>#</th>
											<th>Nombre</th>
											<th>Paterno</th>
											<th>Materno</th>
											<th>Genero</th>
											<th>Edad</th>
											<th>Acciones</th>
											<th>Acciones</th>
											</tr>
										</thead>
										<tbody>
										<?for ($h=0; $h < sizeof($getDataImputados) ; $h++) { 
											$checkEdad = checkEdad($getDataImputados[$h][6])?>
											<tr>
												<td><?echo $h + 1 ?></td>
												<td><?echo $getDataImputados[$h][2] ?></td>
												<td><?echo $getDataImputados[$h][3] ?></td>
												<td><?echo $getDataImputados[$h][4] ?></td>
												<td><?echo $getDataImputados[$h][7] ?></td>
												<td><?echo abs($getDataImputados[$h][6]).' '.$checkEdad; ?></td>
												<td><center><span onclick="editaImputado(<?php echo $idEnlace; ?> , <?php echo $getDataImputados[$h][0]; ?>, <?echo $idMedida ?>, 0)" title="Editar" onclick="" style="cursor: pointer; color: orange; font-size: 18px;" class="glyphicon glyphicon-edit"></span></center></td>
												<td><center><span onclick="deleteItem(4, <?echo $getDataImputados[$h][0] ?>, <?php echo $idEnlace; ?>,<?echo $idMedida ?>, <?echo $totalImpu ?>)" title="Eliminar" style="cursor: pointer; color: red; font-size: 18px;" class="glyphicon glyphicon-trash"></span> </center></td>
											</tr>
										<? } ?>
										</tbody>
								 </table>
								</div>
							</div><? } ?></br>
						<!--TERMINA DIV OCULTO DATOS IMPUTADOS-->
					</div>
				</div>
			</div>
			<!--DATOS DEL IMPUTADO-->
			<!--CONSTANCIA DE LLAMADAS-->
			<div class="sectionData" id="constanciaLlamadas">
				<div class="panel panel-default fd1">
					<div class="panel-body">
						<h5 class="text-on-pannel"><strong>Constancia de llamadas</strong></h5>
						<div id="contDataConstanciaLlamadas">
							<div class="row">
								<div class="col-xs-12 col-sm-12  col-md-2">
								<button type="button" class="btn btn-primary btn-lg" <?if($rolUser == 1){ ?> disabled <? } ?> onclick="saveDatosConstanciaLlamadas(<?php echo $idEnlace; ?> , <?php echo $fraccion; ?>, <?echo $idMedida ?>, <?echo $a; ?>)">Guardar información</button>
							 </div>
							</div><br>
							<div class="row">
								<div class="col-xs-12 col-sm-12  col-md-2">
									<label for="heard">Fecha y hora: <span class="aste">(*)</span></label>
									<input id="dateConstanciaLlamada" type="datetime-local" value="" name="dateConstanciaLlamada" class="fechas form-control gehit" />
								</div>
								<div class="col-xs-12 col-sm-12  col-md-4">
									<label for="obsConstanciaLlamada">Observaciones: <span class="aste">(*)</span></label>
									<input class="form-control mandda gehit" value=""  id="obsConstanciaLlamada"  type="text">
								</div>
							</div>
					 </div></br>
						<?$getDataConstanciaLlamadas = getDataConstanciaLlamadas($connMedidas, $idMedida,0,0); 
						  if(sizeof($getDataConstanciaLlamadas) > 0) { ?>
						<div class="row">
								<div class="col-xs-12 col-sm-12  col-md-12">
									<table class="table table-bordered">
										<thead>
											<tr class="cabeceraTablaVictimas">
											<th>#</th>
											<th>Fecha y hora de llamada</th>
											<th>Observaciones</th>
											<th><center>Descargar Constancia<center></th>
											<th>Acciones</th>
											<th>Acciones</th>
											</tr>
										</thead>
										<tbody>
										<?for ($h=0; $h < sizeof($getDataConstanciaLlamadas) ; $h++) { ?>
											<tr>
												<td><?echo $h + 1 ?></td>
												<td><?echo $getDataConstanciaLlamadas[$h][2]->format('Y-m-d H:i A'); ?></td>
												<td><?echo $getDataConstanciaLlamadas[$h][3] ?></td>
												<td><center><span onclick="descargarConstancia(<?php echo $getDataConstanciaLlamadas[$h][0]; ?>, <?echo $idMedida ?>)" title="Editar" style="cursor: pointer; color: green; font-size: 18px;" class="glyphicon glyphicon-download-alt"></span></center></td>
												<td><center><span onclick="editaConstanciaLlamadas(<?php echo $idEnlace; ?> , <?php echo $getDataConstanciaLlamadas[$h][0]; ?>, <?echo $idMedida ?>, 0)" title="Editar" style="cursor: pointer; color: orange; font-size: 18px;" class="glyphicon glyphicon-edit"></span></center></td>
												<td><center><span onclick="deleteItem(5, <?echo $getDataConstanciaLlamadas[$h][0] ?>, <?php echo $idEnlace; ?>,<?echo $idMedida ?>, <?echo $totalImpu ?>,0)" title="Eliminar" style="cursor: pointer; color: red; font-size: 18px;" class="glyphicon glyphicon-trash"></span> </center></td>
											</tr>
										<? } ?>
										</tbody>
								 </table>
								</div>
							</div><? } ?>
					</div>
				</div>
			</div>
			<!--CONSTANCIA DE LLAMADAS-->
			<!--DATOS FRACCIONES-->
			<div class="sectionData" id="fracciones">
				<div class="panel panel-default fd1">
					<div class="panel-body">
						<h5 class="text-on-pannel"><strong>Fracciones</strong></h5>
							<?$getDataFracciones = modificarMedidasAplicadas($connMedidas, $idMedida);
						  if(sizeof($getDataFracciones) > 0) { 
						  $totalFraccAplicadas = sizeof($getDataFracciones);?>
						<div class="row">
								<div class="col-xs-12 col-sm-12  col-md-12">
									<table class="table table-bordered">
										<thead>
											<tr class="cabeceraTablaVictimas">
											<th>#</th>
											<th>Fracción</th>
											<th>Acciones</th>
											</tr>
										</thead>
										<tbody>
										<?for ($h=0; $h < sizeof($getDataFracciones) ; $h++) { ?>
											<tr>
												<td><?echo $getDataFracciones[$h][5] ?></td>
												<td><?echo $getDataFracciones[$h][4] ?></td>
												<td><center><span onclick="deleteItem(6, <?echo $getDataFracciones[$h][0] ?>, <?php echo $idEnlace; ?>,<?echo $idMedida ?>, <?echo $totalFraccAplicadas ?>)" title="Eliminar" style="cursor: pointer; color: red; font-size: 18px;" class="glyphicon glyphicon-trash"></span> </center></td>
											</tr>
										<? } ?>
										</tbody>
								 </table>
								</div>
							</div><? } ?>
					</div>
				</div>
			</div>
			<!--DATOS FRACCIONES-->
		</div>
	</div>

<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal" onclick="reloadModalMDP(<?echo $tipoModal; ?>, <?echo $idEnlace; ?>, <?echo $idMedida; ?>, 0, 0)">Atras</button>
	<!--<button type="button" class="btn btn-primary">Guardar información</button>-->
</div>

