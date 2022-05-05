<?php
session_start();

include ("../../Conexiones/Conexion.php");
include ("../../Conexiones/conexionMedidas.php");
include("../../funcionesMedidasProteccion.php");
include("../../funcionesMandamientos.php");
include("../../funciones.php");		

$idUsuario = $_SESSION['useridIE'];

$enlace = getInfoEnlaceUsuarioMandamientos($conn, $idUsuario);
$idEnlace = $enlace[0][0];
$idfisca = $enlace[0][1];	
$idUnidad = $enlace[0][2];	

$tipoArchov = get_type_archiveMandamientos($conn, $idEnlace);
$tiparchiv = $tipoArchov[0][0];

if(date("l") === "Monday"){ $numeroDia = 1; $diaLetra = "Lunes"; }
if(date("l") === "Tuesday"){ $numeroDia = 2; 	$diaLetra = "Martes";}
if(date("l") === "Wednesday"){ $numeroDia = 3; 	$diaLetra = "Miercoles";}
if(date("l") === "Thursday"){ $numeroDia = 4; 	$diaLetra = "Jueves";}
if(date("l") === "Friday"){ $numeroDia = 5; 	$diaLetra = "Viernes";}
if(date("l") === "Saturday"){ $numeroDia = 6; 	$diaLetra = "Sabado";}
if(date("l") === "Sunday"){ $numeroDia = 7; 	$diaLetra = "Domingo";}
$diames= date("d");
$currentmonth = date("n");
$meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
$mesNom = Mes_Nombre($currentmonth);

?>

<div id="contenido" style="">
	<div class="right_col" role="main" style="">
		<div style="" class="x_panel principalPanel" >
			<div class="x_panel panelCabezera">
				<table border="0" class="alwidth">
					<tr>
						<td id="nomostrar" class="imgSelloCabezera" width="5%" height="125"></td>								
						<td width="50%">
							<div class="tituloCentralSegu">
								<div class="titulosCabe1">
									<label class="titulo1" style="color: #686D72;">Registro de Mandamientos Judiciales</label>
									<h4><label id="titfisc" class="titulo2">Fiscalía General del Estado de Michoácan</label></h4>
							 </div>
							</div>
						</td>
							<td id="nomostrar" class="imgdgtipeCabezeraPolicia" width="13%" height="125"></td>
					</tr>
				</table>
			</div>
	
			<div class="row pad20">
				<div class="col-xs-6 col-sm-4  col-md-1">
					<label for="heard">Año:</label><br>
					<select id="anio" name="selAnio" tabindex="6" class="form-control redondear selectTranparent" onchange="reloadDaysMonth(<? echo $idEnlace; ?>)" required>

							<option value="<? echo $anioCaptura; ?>" selected>2022</option>

						</select>
				</div>
				<div class="col-xs-6 col-sm-4  col-md-1">
					<label for="heard">Mes:</label><br>

					<div id="contMonth">
						<select id="mesMedidaSelected" name="selMes" tabindex="6"class="form-control redondear selectTranparent" required>

									<option value="5" selected>Mayo</option>
					

					</select>
				</div>
					<!--
					<div id="contMonth">
						<select id="mesMedidaSelected" name="selMes" tabindex="6"class="form-control redondear selectTranparent" onchange="loadDaysMonth(<? echo $anioCaptura; ?>, <? echo $idEnlace; ?>, 0)" required>
							<?for ($g=1; $g <= 12 ; $g++) {
								if($g == intval($currentmonth)){ ?>
									<option value="<? echo $currentmonth; ?>" selected><? echo $mesNom; ?></option>
							<?}else{?>
								<option value="<? echo $g; ?>" ><? echo $meses[$g-1]; ?></option>
							<? } 
						}?>
					</select>
				</div>-->
			</div><!--
			<div class="col-xs-6 col-sm-4  col-md-1">
				<label for="heard">Día:</label><br>
				<div id="contDays">
					<select id="diaSeleted" name="selDia" tabindex="6"class="form-control redondear selectTranparent" onchange="loadDataPuestDay(<? echo $anioCaptura; ?>, <? echo $idEnlace; ?>, 0)" required>
						<option value="0">Todo</option>
						<?$diasNumero = cal_days_in_month(CAL_GREGORIAN, $currentmonth, $anioCaptura);
						for ($t=1; $t <= $diasNumero ; $t++) {
							if($t == $diames){?>
								<option value="<? echo $t; ?>" selected> <? echo "".$diaLetra."-".$diames; ?></option>
								<?}else{
									$fecha = $t."-".$currentmonth."-".$anioCaptura; 
									$nommesa =  getDiaMesnombre($fecha);
								?>
								<option value="<? echo $t; ?>"> <? echo "".$nommesa."-".$t; ?></option>
								<?}
							}?>
						</select>
					</div>
				</div>-->
				<!--<div class="col-xs-12 col-sm-12  col-md-3">
					<label class="transparente">.</label>
					<center><button type="button" data-toggle="modal" href="#medidaDeProteccion" style="white-space: normal;"  onclick="showModalMDP(0, <? echo $idEnlace; ?>,0,<? echo $tiparchiv; ?>, 1);" class="btn btn-warning btn-sm redondear btnCapturarTbl"><span class="glyphicon glyphicon-search"></span> Búsqueda de Mandamientos </button></center>
				</div>-->
				<div class="col-xs-12 col-sm-12  col-md-3">
					<label class="transparente">.</label>
					<center><button type="button" data-toggle="modal" href="#mandamientos" style="white-space: normal;"  onclick="modalMandamientos_registro(0, <? echo $idEnlace; ?>,0,<? echo $tiparchiv; ?>, 1, <?echo $idfisca; ?>, <?echo $idUnidad; ?>);" class="btn btn-success btn-sm redondeasr btnCapturarTbl"><span class="glyphicon glyphicon-plus-sign"></span> Registrar Mandamiento Judicial </button></center>
				</div>
			</div><br>
			<div class="col-md-6 col-md-offset-3" id="preloaderIMG" hidden>
				<img src="images/cargando.gif"/>
			</div>

			<table id="gridPolicia" class="display table table-striped  table-hover" width="100%" >
				<thead>
					<tr class="cabeceraConsultaPolicia">
						<th class="textCent">Folio</th>
						<th class="textCent10">Estado</th>
						<th class="">Tipo Mandamiento</th>
						<th class="">Proceso</th>
						<<th class="">Nombre del inculpado</th>
						<th class="">Fiscalía</th>
						<th class="">Municipio</th>
						<th class="">Acciones</th>
					</tr>
				</thead>
				<tbody id="contentConsulta">
					<?$data = get_data_mandamientos_dia($conn, $idEnlace);
					for ($h=0; $h < sizeof($data) ; $h++) { 
							$inculpado = get_data_inculpado($conn, $data[$h][1]);
					 ?>
						<tr>
							<td><? echo $h+1; ?></td>
							<td><? echo $data[$h][3]; ?></td>
							<td><? echo $data[$h][4]; ?></td>
							<td><? echo $data[$h][5]; ?></td>
						 <td><? echo $inculpado[0][5].' '.$inculpado[0][6].' '.$inculpado[0][7]; ?></td>
							<td><? echo $data[$h][6]; ?></td>
							<td><? echo $data[$h][7]; ?></td>
							<td><center><img src="img/editarMandamiento2.png" data-toggle="modal" href="#mandamientos"  onclick="modalMandamientos_registro(0, <? echo $idEnlace; ?>,<? echo $data[$h][1]; ?>,<? echo $tiparchiv; ?>, 1, <?echo $idfisca; ?>, <?echo $idUnidad; ?>);"><!--<img src="img/resumenMandamiento.png"></center>-->
							</td>
						</tr>
						<? } ?>
					</tbody>
				</table><br>

				<div class="x_panel piepanel">
					<div class="piepanel2">
						<div class="piepanel3">
							<div class="piepanel4">
								<label style="color: #686D72;">SISTEMA INTEGRAL DE REGISTRO ESTADISTICO Copyright © Todos los Derechos Reservados</label>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


<!-- MODAL REGISTRO DE MANDAMIENTOS JUDICIALES  -->
	<div class="modal fade bs-example-modal-sm" id="mandamientos" role="dialog" data-backdrop="static" data-keyboard="false" style="overflow-y: scroll;">
		<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 85%; margin-top: 0.5%;">
			<div class="modal-content" style="">
				<div id="contModalMandamientos_registro">

				</div>
			</div>
		</div>
	</div>
	<!-- MODAL REGISTRO DE MANDAMIENTOS JUDICIALES  -->

	<!-- MODAL REGISTRO DE INCULPADOS  -->
	<div class="modal fade bs-example-modal-sm" id="inculpados" role="dialog" data-backdrop="static" data-keyboard="false" style="overflow-y: scroll;">
		<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 65%; margin-top: 0.5%;">
			<div class="modal-content" style="">
				<div id="contModalInculpados_registro">

				</div>
			</div>
		</div>
	</div>
	<!-- MODAL REGISTRO DE INCULPADOS  -->

	<!-- MODAL REGISTRO DE AGRAVIADOS  -->
	<div class="modal fade bs-example-modal-sm" id="agraviados" role="dialog" data-backdrop="static" data-keyboard="false" style="overflow-y: scroll;">
		<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 65%; margin-top: 0.5%;">
			<div class="modal-content" style="">
				<div id="contModalAgraviados_registro">

				</div>
			</div>
		</div>
	</div>
	<!--  MODAL REGISTRO DE AGRAVIADOS   -->

		<!-- MODAL CARGANDO INFORMACION  -->
 <div class="modal fade bs-example-modal-sm" id="cargandoInfo" role="dialog" data-backdrop="static" data-keyboard="false">
		<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 20%; margin-top: 10%;">
			<div class="modal-content" style="">
				<div id="contModalCargandoInfo">
					<div class="modal-header">
				<h4 class="modal-title">Validando NUC...</h4>
			</div>
			<div class="modal-body">
				<div class="row">
									<div class="col-md-12 col-sm-12 col-md-offset-4">
										<img src="img/cargandoInfoMedidas.gif"  class="cursorp" >
									</div>
								</div><br>
								<div class="row">
									<div class="col-md-12 col-sm-12 col-md-offset-3">
										<label>Cargando información</label>
									</div>
								</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
			</div>
				</div>
			</div>
		</div>
	</div>
	<!-- MODAL CARGANDO INFORMACION -->

	<!-- MODAL CARGANDO INFORMACION SIGI -->
 <div class="modal fade bs-example-modal-sm" id="cargandoInfoModal" role="dialog" data-backdrop="static" data-keyboard="false">
		<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 20%; margin-top: 10%;">
			<div class="modal-content" style="">
				<div id="contModalCargandoInfoModal">
					<div class="modal-header">
				<h4 class="modal-title"></h4>
			</div>
			<div class="modal-body">
				<div class="row">
									<div class="col-md-12 col-sm-12 col-md-offset-4">
										<img src="img/cargandoInfoMedidas.gif"  class="cursorp" >
									</div>
								</div><br>
								<div class="row">
									<div class="col-md-12 col-sm-12 col-md-offset-3">
										<label>Cargando información...</label>
									</div>
								</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
			</div>
				</div>
			</div>
		</div>
	</div>
	<!-- MODAL CARGANDO INFORMACION SIGI -->

	<!-- MODAL EDITAR DELITOS  -->
	<div class="modal fade bs-example-modal-sm" id="delitos" role="dialog" data-backdrop="static" data-keyboard="false" style="overflow-y: scroll;">
		<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 50%; margin-top: 0.5%;">
			<div class="modal-content" style="">
				<div id="contModalMandamientos_delitos">

				</div>
			</div>
		</div>
	</div>
	<!-- MODAL EDITAR DELITOS  -->

	

</html>