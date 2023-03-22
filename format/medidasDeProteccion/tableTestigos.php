<?php
include("../../Conexiones/Conexion.php");
include("../../Conexiones/conexionMedidas.php");
include("../../Conexiones/conexionSicap.php");
//include("../../funcionesPueDispo.php");	
include("../../funcionesMedidasProteccion.php");

if (isset($_POST["idMedida"])) {	$idMedida = $_POST["idMedida"];}
$getDataTestigos = getDataTestigos($connMedidas, $idMedida);
?>



					<table class="table table-bordered">
							<thead>
								<tr class="cabeceraTablaVictimas">
									<th>#</th>
									<th>Nombre</th>
									<th>Paterno</th>
									<th>Materno</th>
									<th>Causa Penal</th>
									<th>Estado Actual Medida</th>
									<th>Observaciones</th>
									<th>Eliminar</th>
								</tr>
							</thead>
							<tbody id="contentTableDataTestigos">
								<? for ($h = 0; $h < sizeof($getDataTestigos); $h++) {?>
									<tr>
										<td><? echo $h + 1 ?></td>
										<td><? echo $getDataTestigos[$h][4]; ?></td>
										<td><? echo $getDataTestigos[$h][5]; ?></td>
										<td><? echo $getDataTestigos[$h][6]; ?></td>
										<td><? echo $getDataTestigos[$h][3]; ?></td>
										<td><label style="font-weight: bold !important;"><? echo $getDataTestigos[$h][7]; ?></label></td>
										<td><? echo $getDataTestigos[$h][8]; ?></td>
										<td>
											<center><span onclick="deleteTestigo(<?php echo  $getDataTestigos[$h][0]; ?>, <?php echo $idMedida; ?>)" title="Eliminar" style="cursor: pointer; color: red; font-size: 18px;" class="glyphicon glyphicon-trash"></span> </center>
										</td>
									</tr>
								<? } ?>
							</tbody>
						</table>
				