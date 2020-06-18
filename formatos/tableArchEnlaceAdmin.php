
	<?php
	session_start();
	include ("../Conexiones/Conexion.php");
	include("../funciones.php");	

	 $idUsuario = $_SESSION['useridIE'];

	if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }
	if (isset($_POST["anio"])){ $anio = $_POST["anio"]; }
	if (isset($_POST["mes"])){ $mes = $_POST["mes"]; }
	if (isset($_POST["tipoarchReposi"])){ $tipoarchReposi = $_POST["tipoarchReposi"]; }


	?>

	<BR>
																		    	 <table class="table table-striped tblTransparente "  style="padding: 50px !important;">
																												<thead>
																													<tr class="cabezeraTabla ">
																														<th class="col-xs-12 col-sm-12 col-md-1 textCent">No</th>
																														<th class="col-xs-12 col-sm-12 col-md-3 textCent">Nombre Archivo</th>
																														<th class="col-xs-12 col-sm-12 col-md-2 textCent">Enlace</th>
																														<th class="col-xs-12 col-sm-12 col-md-1 textCent">Fecha Subida</th>
																														<th class="col-xs-12 col-sm-12 col-md-1 textCent">Mes</th>
																														<th class=" textCent">Estado</th>
																														<th class="col-xs-12 col-sm-12 col-md-3 textCent">Observaciones Revisíon</th>
																														<th class="col-xs-12 col-sm-12 col-md-1 textCent">Fecha Revisíon</th>
																														<th class="textCent">Accion</th>
																														<th class="textCent">Accion</th>
																														<th class="textCent">Accion</th>
																													</tr>
																												</thead>
																				
																										<tbody>
																												<? 

																															$archivosTodos = getArchivosEnlaceFilterAdmin($conn, $idEnlace, $anio, $mes, $tipoarchReposi);	


																															$turila = "http://201.116.252.158:8080/sire/repositorio/";
																															for( $i=0; $i<sizeof($archivosTodos); $i++){

																															
																																$idarchivo = $archivosTodos[$i][0];
																																$idEnlace = $archivosTodos[$i][1];
																																$nombreArchivo = $archivosTodos[$i][2];
																																$observacionesUser = $archivosTodos[$i][3];
																																$tamanio = $archivosTodos[$i][4];
																																$fechaSubida = $archivosTodos[$i][5];
																																$ubicacion = $archivosTodos[$i][6];
																																$mes = $archivosTodos[$i][7];
																																$anio = $archivosTodos[$i][8];
																																$estatusarch = $archivosTodos[$i][9];
																																$observacionesRevision = $archivosTodos[$i][10];
																																$fechaConclu = $archivosTodos[$i][11];
																																$enlacename = $archivosTodos[$i][12];
																																$nunidad = $archivosTodos[$i][13];


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

 																															<tr >
																																<td class="tdRowMain"><center><label><? echo ($i+1); ?></label></center></td>
																																<td class="tdRowMain" style="padding: 23px !important;"><? echo $nombreArchivo; ?></td>
																																	<td class="tdRowMain"><? echo $enlacename." - ".$nunidad; ?></td>
																																<td class="tdRowMain"><center><? echo $newfechaSubida; ?></center></td>
																																<td class="tdRowMain"><center><? echo $mesNombre; ?></center></td>
																																<td style="background-color: <? echo $color; ?> !important; padding: 10px; color: white !important; vertical-align: middle !important;"><center><? echo $estatusarc; ?></center></td>
																																<td class="tdRowMain"><center><? echo $observacionesRevision; ?></center></td>
																																<td class="tdRowMain"><center><? if($fechaConclu2 != null){ echo $fechaConclu2; } ?></center></td>
																																
																																<td class="tdRowMain"><center><button type="button" data-toggle="modal" href="#myModaRevisarArchivo"  onclick="revisarArchivoMOdal(<? echo $idarchivo; ?>, '<? echo $ubicacion; ?>', '<? echo $nunidad; ?>', <? echo $idEnlace; ?>)" class="btn btn-warning btn-sm redondear btnCapturarTbl"><span class="glyphicon glyphicon-eye-open"></span> Revisar </button></center></td>

																																<td class="tdRowMain"><center><button type="button" data-toggle="modal" href="#myModalVerFormato"  onclick="verFormato(<? echo $idarchivo ?>, '<?  echo $ubicacion; ?>')" class="btn btn-info btn-sm redondear btnCapturarTbl"><span class="glyphicon glyphicon-search"></span> Ver Archivo </button></center></td>

																																<td class="tdRowMain"><center><button type="button" data-toggle="modal" href=""  onclick="descargarArchivo('<? echo $nombreArchivo; ?>');" class="btn btn-primary btn-sm redondear btnCapturarTbl"><span class="glyphicon glyphicon-cloud-download"></span> Descargar </button></center></td>
																																</tr>
																																			<?	} ?> 
																			


																										</tbody>

																									</table>
