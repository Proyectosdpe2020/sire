	<?php

				include ("../../Conexiones/Conexion.php");
				include("../../funcionesPueDispo.php");	

				if (isset($_POST["idPuesta"])){ $idPuesta = $_POST["idPuesta"]; }	
				if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }	
				$tipoArchov = get_type_archive($conn, $idEnlace);
				$tiparchiv = $tipoArchov[0][0];
				$puesta = getDataPuestaID($conn, $idPuesta);

				if($puesta > 0){
	?>
				<br>
			<table class="table table-striped  table-hover">
									<thead>
										<tr class="cabezeraTabla10">
											<th class="textCent">ID</th>
													<th class="textCent10">Mando</th>
													<th class=" textCent">Fecha Informe</th>
													<th class=" textCent">Fiscalía</th>
													
													<th class="textCent">Accion </th>

										</tr>
									</thead>
									<tbody>				
															<? 
																							for ($h=0; $h < sizeof($puesta) ; $h++) { 
																									?>
																										<tr>

																										<td style="font-weight: bold;"> <? echo $puesta[$h][0]; ?> </td>
																										<td> <? echo $puesta[$h][2]; ?> </td>
																										<td> <? echo $puesta[$h][1]->format('Y-m-d H:i'); ?> </td>
																										<td> <? echo $puesta[$h][3]; ?> </td>


																										<td><center><label onclick="showmodalPueDispo(1, <? echo $idEnlace; ?>, <? echo $puesta[$h][0]; ?>, <? echo 	$tiparchiv; ?>, 1)" data-toggle="modal" href="#puestdispos" style="width: 95%; cursor: pointer; font-weight: bold; color: green;">Editar</label></center></td></tr>
																									<?		

																							}																			

															 ?>


									</tbody>
									</table>

							<? } else { ?>		

									<br>
															<table class="table table-striped  table-hover">
									<thead>
										<tr class="cabezeraTabla10">
											<th class="textCent">ID</th>
													<th class="textCent10">Mando</th>
													<th class=" textCent">Fecha Informe</th>
													<th class=" textCent">Fiscalía</th>
													
													<th class="textCent">Accion </th>

										</tr>
									</thead>
									<tbody>				
																										<tr>

																										<td style="text-align: center !important;"> -- </td>
																										<td style="text-align: center !important;"> No se encontraron resultados </td>
																										<td style="text-align: center !important;"> -- </td>
																										<td style="text-align: center !important;"> -- </td>


																										<td><center><label data-toggle="modal" href="#">--</label></center></td></tr>
																						

									</tbody>
									</table>
								<? 
											}
								?>




