
	<?php
	session_start();
	include ("../Conexiones/Conexion.php");
	include("../funciones.php");	

	 $idUsuario = $_SESSION['useridIE'];

	if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }
	if (isset($_POST["anio"])){ $anio = $_POST["anio"]; }
	if (isset($_POST["mes"])){ $mes = $_POST["mes"]; }
	if (isset($_POST["estatus"])){ $estatus = $_POST["estatus"]; }
	if (isset($_POST["format"])){ $format = $_POST["format"]; }

	?>

<br>
	<table class="table table-striped tblTransparente">
																												<thead>
																													<tr class="cabezeraTabla">
																														<th class="column-title col-sm-1 textCent">No</th>
																														<th class="column-title col-sm-2 textCent">Nombre Archivo</th>
																														<th class="column-title col-sm-3 textCent">Observaciónes</th>
																														<th class="column-title col-sm-1 textCent"">Fecha Subida</th>
																														<th class="textCent">Estado</th>
																														<th class="column-title col-sm-3 textCent">Observaciones Revisión</th>
																														<th class="column-title col-sm-3 textCent">Fecha Concluido</th>
																														<th class="column-title col-sm-1 textCent">Acción</th>
																														<th Class="column-title col-sm-1 textCent">Acción</th>
																														<th class="column-title col-sm-1 textCent">Acción</th>

																													</tr>
																												</thead>
																				
																										<tbody>

																												<? 
																														if($mes == 0 && $estatus == "0"){ 	$archivosTodosXEnlace = getArchivosEnlaceFilter3($conn, $idEnlace, $anio, $format); }	else{

																															if ($estatus == "0") { 	$archivosTodosXEnlace = getArchivosEnlaceFilter2($conn, $idEnlace, $anio, $mes, $format); 	} else {

																																	if ($mes == 0) { 																																		

																																	$archivosTodosXEnlace = getArchivosEnlaceFilter($conn, $idEnlace, $anio, $estatus, $format);	

																																}else{

																																		$archivosTodosXEnlace = getArchivosEnlaceFilter4($conn, $idEnlace, $anio, $mes, $estatus, $format);	

																																}

																															}

																														}

																														
																														
																														
																													

																														$turila = "http://201.116.252.158:8080/sire/repositorio/";
																														$unid = getUnidadEnlace($conn, $idEnlace);
																														$iduni = $unid[0][0];
																														
																														for( $i=0; $i<sizeof($archivosTodosXEnlace); $i++){

																																$idarchivo = $archivosTodosXEnlace[$i][0];
																																$idEnlace = $archivosTodosXEnlace[$i][1];
																																$nombreArchivo = $archivosTodosXEnlace[$i][2];
																																$observacionesUser = $archivosTodosXEnlace[$i][3];
																																$tamanio = $archivosTodosXEnlace[$i][4];
																																$fechaSubida = $archivosTodosXEnlace[$i][5];
																																$ubicacion = $archivosTodosXEnlace[$i][6];
																																$mes = $archivosTodosXEnlace[$i][7];
																																$anio = $archivosTodosXEnlace[$i][8];
																																$estatusarch = $archivosTodosXEnlace[$i][9];
																																$observacionesRevision = $archivosTodosXEnlace[$i][10];
																																$fechaConclu = $archivosTodosXEnlace[$i][11];


																																$mesNombre = Mes_Nombre($mes);
														$newfechaSubida = $fechaSubida->format('d/m/y H:i:s');
														


														if( $fechaConclu != null ){$fechaConclu2 = $fechaConclu->format('d/m/y H:i:s');}else { $fechaConclu = "---"; $fechaConclu2 = "---";}

														if($estatusarch == "env"){ $bloquear = 0; $estatusarc = "Enviado";}
														if($estatusarch == "rev"){ $bloquear = 0; $estatusarc = "Revisando";}
														if($estatusarch == "rec"){ $bloquear = 1; $estatusarc = "Recibido";}
														if($estatusarch == "rac"){ $bloquear = 2; $estatusarc = "Rechazado";}
														if($estatusarch == "ree"){ $bloquear = 3; $estatusarc = "Reenviado";}

														$color = getCOlorStatusArchivo($conn, $estatusarc);
														$rutota = $turila.$ubicacion;

														?>

																				<tr>
														
																								<td style="padding: 20px !important;" class="tdRowMain"><center><label><? echo ($i+1); ?></label></center></td>
																								<td class="tdRowMain"><? echo $nombreArchivo; ?></td>
																								<td class="tdRowMain"><center><? echo $observacionesUser; ?></center></td>
																								<td class="tdRowMain"><center><? echo $newfechaSubida; ?></center></td>
																								<td style="background-color: <? echo $color; ?> !important; padding: 10px; color: white !important; vertical-align: middle !important;"><center><? echo $estatusarc; ?></center></td>
																								<td class="tdRowMain"><center><? echo $observacionesRevision; ?></center></td>
																								<td class="tdRowMain"><center><? if($fechaConclu2 != null){ echo $fechaConclu2; } ?></center></td>
																								<iframe id="frame1" style="display:none"></iframe>
																							
																							<? 

																									if ($estatusarc == "Recibido") {
																										?>
																												<td class="tdRowMain"><center><button type="button"  onclick="descargarArchivo('<? echo $nombreArchivo; ?>');" class="btn btn-success btn-sm redondear btnCapturarTbl" ><span class="glyphicon glyphicon-cloud-download"></span> Descargar </button></center> </td>
																										<?
																									}else{

																										?>
																												<td class="tdRowMain"><center><span>---</span></center> </td>
																										<?

																									}

																							?>
                        
																						


						<td class="tdRowMain"><center> <button type="button" data-toggle="modal" href="#myModalVerFormato"  onclick="verFormato(<? echo $idarchivo ?>, '<?  echo $ubicacion; ?>')" class="btn btn-warning btn-sm redondear btnCapturarTbl" ><span class="glyphicon glyphicon-search"></span> Ver </button></center></td>
																							
																								<td class="tdRowMain">
																								<? if ($bloquear == 2) {
																									?>
															<center><button type="button" data-toggle="modal" href="#myModalUploadAgain" onclick="subirotravez(<? echo $iduni; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idEnlace ?>, <? echo $idarchivo ?>, '<? echo $nombreArchivo; ?>')" class="btn btn-danger btn-sm redondear btnCapturarTbl"><span class="glyphicon glyphicon-cloud-upload"></span> Subir Archivo </button></center> 
																									<?
																								}else{

																									if ($bloquear == 1) {
																									?>
																												<center><span style="font-size: 1.8em; color:#1ac57c;" class="glyphicon glyphicon-ok"></span></button></center> 
																									<?
																										}else{

																											?>
																												<center><span style=";">---</span></button></center> 
																											<?

																										}
																								} 

																								?>		
																								

																								</td>

																				</tr>

														<?


																														}

																												?>

																										</tbody>

																									</table>
