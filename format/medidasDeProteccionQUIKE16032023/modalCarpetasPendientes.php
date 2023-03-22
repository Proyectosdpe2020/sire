<?php
include ("../../Conexiones/Conexion.php");
include ("../../Conexiones/conexionMedidas.php");
include("../../Conexiones/conexionSicap.php");	
include("../../funcionesMedidasProteccion.php");	
$fecha_actual=date("d/m/Y");
$fecha=strftime( "%Y-%m-%d %H:%M:%S", time() );
if (isset($_POST["rolUser"])){ $rolUser = $_POST["rolUser"]; }	
if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }	

$diames= date("j");
$currentmonth = date("n");
$anioActual = date("Y");

?>


<div class="modal-header" style="background-color:#152F4A;">
	<center><label style="color: white; font-weight: bold; font-size: 2rem;">Carpetas pendientes por asignar</label></center>
</div>
<div class="modal-body">
<input class="form-control mandda gehit"  id="mesMedidaSelected" value="<?echo $currentmonth; ?>" type="hidden"  >
<input class="form-control mandda gehit"  id="diaSeleted" value="<?echo $diames; ?>" type="hidden"  >
	<!--DATOS RESOLUCIÓN-->
	<div class="panel panel-default fd1">
		<div class="panel-body">
			<h5 class="text-on-pannel"><strong>Carpetas</strong></h5>
			<div class="row">
				<div class="col-xs-12 col-sm-12  col-md-12">
					<table id="gridPolicia1" class="display table table-striped table-hover " width="100%" >
					<thead>
						<tr class="cabeceraConsultaPolicia">
							<th class="textCent">Folio</th>
							<th class="textCent10">Agente del Ministerio Publico</th>
							<th class="">Nuc</th>
							<th class=" textCent">Victima(s)</th>
							<th class=" textCent">Delito</th>
							<th class=" textCent">Fecha del acuerdo</th>
							<?if($rolUser == 1){?><th class=" textCent">Capturista</th><? } ?>
							<th class="textCent">Carpeta asignada?</th>
							<th class=" textCent">Acciones</th>
						</tr>
					</thead>
					<tbody id="contentConsulta1">
						<?$dataMedidasDia = get_data_medidas_pendientes($connMedidas);
						for ($h=0; $h < sizeof($dataMedidasDia) ; $h++) { 
							  $getDataVictimas = getDataVictimas($connMedidas, $dataMedidasDia[$h][0]); ?>
							<tr>
								<td><? echo $dataMedidasDia[$h][0]; ?></td>
								<td><?if($dataMedidasDia[$h][2] != 0){ echo $dataMedidasDia[$h][3];}else{ ?><p style="color: red;">SIN ASIGNAR <? } ?>
								<td><? echo $dataMedidasDia[$h][1]; ?></td>
								<td>
								<? if(sizeof($getDataVictimas) > 0){ 
									  for ($j=0; $j < sizeof($getDataVictimas) ; $j++) {
									  	if(sizeof($getDataVictimas) > 1){
									  		echo ' - '.$getDataVictimas[$j][7].'<br>';
									  		}else{
									  			echo $getDataVictimas[$j][7];
									  		}
									  }
							  }else{
							  	echo 'SIN VICTIMA, VERIFIQUE';
							  } ?>
							 </td>
								<td><? echo $dataMedidasDia[$h][7]; ?></td>
								<td><center><? echo $dataMedidasDia[$h][8]; ?><center></td>
								<?if($rolUser == 1){?><td><center><? echo $dataMedidasDia[$h][18]; ?><center></td><? } ?>
								<td><?if($dataMedidasDia[$h][2] != 0){ ?><div class="verdCol" id="circulo"><? }else{ ?> <div class="redCol" id="circulo"> <? } ?></div></td>
								<td><center><label <?if($rolUser == 1){?>class="glyphicon glyphicon-user"<? }else{ ?>class="glyphicon glyphicon-edit" <? } ?> data-toggle="modal" href="#puestdispos" onclick="reloadModalMDP(1, <?echo $idEnlace; ?>, <?echo $dataMedidasDia[$h][0]; ?>, 0, 0)" style="width: 95%; cursor: pointer; font-weight: bold; color: green;"><?if($rolUser == 1){?> Asignar MP <? }else{ ?> Editar <? } ?> </label></center>
								</td>
							</tr>
							<? } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!--DATOS RESOLUCIÓN-->

	
<div class="modal-footer">
	<button type="button" class="btn btn-default" onclick="closeModalCarpetasPendientes(<?echo $anioActual; ?>, <?echo $idEnlace; ?>, 0)">Cerrar</button>
	
</div>

