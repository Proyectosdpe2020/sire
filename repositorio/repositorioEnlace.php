<? include ("headerRepositorioEnlace.php"); ?>

<html>
<body>
<head>
</head>
		<div id="contenido">
							<div class="right_col" role="main" style ="height: auto;">

													<div style="" class="x_panel principalPanel">

															<div class="x_panel panelCabezera">
																		
																		<table border="0" class="alwidth">						
																					<tr>								
																						<td id="nomostrar" class="imgSelloCabezera" width="5%" height="125"></td>								
																						<td width="50%">
																									<div class="tituloCentralSegu">
																										<div class="titulosCabe1">
													<label class="titulo1" style="color: #686D72;">REPOSITORIO DE ARCHIVOS</label>
													<h4> <label class="titulo2">Fiscalía General del Estado de Michoácan</label></h4>
												</div>
																									</div>
																						</td>
																						<td id="nomostrar" class="imgdgtipeCabezera" width="10%" height="125"></td>
																					</tr>
																			</table>

															</div>

															<div class="row"> 

																			<div class="col-xs-12 col-sm-2  col-md-4">
																				<label for="heard">Año:</label><br>
																				<select id="anioArchSelected" name="selMes" tabindex="6" class="form-control redondear selectTranparent" onchange="updTblArchivosEnlace(<? echo $idEnlace; ?>, <? echo $format; ?>);" required>
																					

																									<?
																																	$arrayANios = array(2020,2021);

																																	for ($p=0; $p < sizeof($arrayANios) ; $p++) { 
																																					
																																					if($arrayANios[$p] == $anioCaptura){
																																						?>  <option value="<? echo $arrayANios[$p];  ?>" selected><? echo $arrayANios[$p] ?></option>  <?
																																					}else{
																																							?>  	<option value="<? echo $arrayANios[$p]; ?>" ><? echo $arrayANios[$p]  ?></option>  <?
																																					}
																																	}
																														 ?>
																				</select>
																			</div>

																			<div class="col-xs-12 col-sm-2  col-md-4">
																				<label for="heard">Mes:</label><br>
																				<select id="mesSelectArch" name="selMes" tabindex="6"class="form-control redondear selectTranparent" onchange="updTblArchivosEnlace(<? echo $idEnlace; ?>, <? echo $format; ?>);" required>

																					<option value="0" selected="">Todos</option>

																					<?

																								$arrayMes = array('Enero','Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');

																								for ($i=1; $i <= 12; $i++) { 
																						
																											if( $i == $mesCapturar ){ 

																												?>
																														<option value="<? echo $i; ?>"><? echo $arrayMes[$i-1]; ?></option>
																											 <?}else{?>
																											 		<option value="<? echo $i; ?>"><? echo $arrayMes[$i-1]; ?></option>
																											 <?
																											 }	

																								} 


																					?>
																					
																					
																				</select>
																			</div>

																			<div class="col-xs-12 col-sm-10  col-md-4">
																				<label for="heard">Estado:</label>
																				<div id="contenidoProyectosListAgru">							
																					<select id="estadoSelect" class="form-control redondear selectTranparent" onchange="updTblArchivosEnlace(<? echo $idEnlace; ?>, <? echo $format; ?>);" required>								
																						
																						<? if($idUnidad == 0){ ?>

																								<option value="0" selected="">Todos</option>
																								<? }else{ ?>
																								<option value="0" >Todos</option>
																								<? } ?>

																							
																									<option value="env">Enviado</option>
																									<option value="rev">Revisando</option>
																									<option value="rec">Recibido</option>
																									<option value="rac">Rechazado</option>
																									<option value="ree">Reenviado</option>
																			

																																		
																					</select>

																				</div>
																			</div>
																			<br>
															</div>

															<!-- Aqui comienza la tabla para el repositorio de archivos -->

															  <div id="contenidoTablaRepositoriouser">
							    													

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
																														$archivosTodosXEnlace = getArchivosXenlaceAnio($conn, $anioCaptura, $idEnlace, $format);

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
															<!--<center><button type="button" data-toggle="modal" href="#myModalUploadAgain" onclick="subirotravez(<? echo $iduni; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idEnlace ?>, <? echo $idarchivo ?>, '<? echo $nombreArchivo; ?>')" class="btn btn-danger btn-sm redondear btnCapturarTbl"><span class="glyphicon glyphicon-cloud-upload"></span> Subir Archivo </button></center> -->
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

																	
																	 </div>


													</div>			

   				</div>


   	</div>

 


