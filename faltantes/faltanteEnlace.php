
	<?php
	session_start();
	include ("../Conexiones/Conexion.php");
	include("../funciones.php");		




	$anioCaptura = 2020;

	?>

	<div id="contenido">
		<div class="right_col" role="main">

			<div style="" class="x_panel principalPanel">

				<div class="x_panel panelCabezera">

					<table border="0" class="alwidth">						
							<tr>								
								<td id="nomostrar" class="imgSelloCabezera" width="5%" height="125"></td>								
								<td width="50%">
											<div class="tituloCentralSegu">
												<div class="titulosCabe1">
													<label class="titulo1">Listado Enlace MP Faltantes por Capturar</label>
													<h4> <label class="titulo2">Fiscalía General del Estado de Michoácan</label></h4>
												</div>
											</div>
								</td>
								<td id="nomostrar" class="imgdgtipeCabezera" width="10%" height="125"></td>
							</tr>
					</table>


				</div>

				<div class="row">

					<div class="col-xs-12 col-sm-2  col-md-1">
						<label for="heard">Año:</label><br>
						<select id="recipientAnioFaltan" name="selMes" tabindex="6" class="form-control redondear selectTranparent" disabled="">
							<option value="<? echo $anioCaptura; ?>" selected><? echo $anioCaptura; ?></option>
						</select>
					</div>

					<div class="col-xs-12 col-sm-2  col-md-2">
						<label for="heard">Mes:</label><br>
						<select id="recipientmesFaltante" name="selMes" tabindex="6"class="form-control redondear selectTranparent" disabled="">
							<option value="1" >Enero</option>
							<option value="2" >Febrero</option>
							<option value="3" >Marzo</option>
							<option value="4" >Abril</option>
							<option value="5" selected>Mayo</option>
							<option value="6" >Junio</option>
							<option value="7" >Julio</option>
							<option value="8" >Agosto</option>
							<option value="9" >Septiembre</option>
							<option value="10" >Octubre</option>
							<option value="11" >Noviembre</option>
							<option value="12" >Diciembre</option>
						</select>
					</div>

					<div class="col-xs-12 col-sm-10  col-md-6">
						<label for="heard">Unidad:</label>
						<div id="contenidoProyectosListAgru">							
							<select id="proyectoId2" class="form-control redondear selectTranparent" required disabled="">								
								<option value="<0" selected="">Todas</option>													
							</select>

						</div>
					</div>

					<div class="col-xs-12 col-sm-10  col-md-3">
						<label for="heard">Formato:</label>
						<div id="contenidoProyectosListAgru">							
							<select id="tipoarchivo" class="form-control redondear selectTranparent" onchange="cargarEnlacesTipoArchivo(0, <? echo $anioCaptura; ?>)" required>								
								<option value="1" selected="">Carpetas de Investigación</option>		
								<option value="4" ="">Litigación</option>											
							</select>

						</div>
					</div>

					<br>

				</div>

				<div id="respuestaDescargarCarpeta"></div>

							<div  class="contTblMPs" id="tablaEnlacesContenido">

						

						<div class="row">		

		
					
								<table class="table table-striped tblTransparente">
									<thead>
										<tr class="cabezeraTabla">
													<th class="col-xs-12 col-sm-12 col-md-1 textCent">No</th>
													<th class="col-xs-12 col-sm-12 col-md-2 ">Nombre Enlace</th>
													<th class="col-xs-12 col-sm-12 col-md-3 textCent">Unidad</th>
													<th class="col-xs-12 col-sm-12 col-md-1 textCent">Fiscalía</th>												
													<th class="col-xs-12 col-sm-12 col-md-1 textCent">Telefono</th>
													<th class="col-xs-12 col-sm-12 col-md-1 textCent">Mes Captura</th>
									

													<th class="col-xs-12 col-sm-12 col-md-1 textCent">Estado </th>
													<th class="col-xs-12 col-sm-12 col-md-1 textCent">Enviado </th>
													<th class="col-xs-12 col-sm-12 col-md-1 textCent">Archivo </th>
													<th class="col-xs-12 col-sm-12 col-md-1 textCent">Accion</th>

										</tr>
									</thead>
									<tbody>
												

								<? 

										$enlaces = getInfoEnlacesCarpetas($conn, 1);

										for ($i=0; $i < sizeof($enlaces) ; $i++) {


										  $iden = $enlaces[$i][0];
											$nombre = $enlaces[$i][1];
											$apatern = $enlaces[$i][2];
											$amatern = $enlaces[$i][3];
											$correo = $enlaces[$i][4];

											//$capturado = getCapturadoMesAnioMP($conn, $mesCapturar, $anioCaptura, $idMp, $idUnidad);
											$nomCompleto = $nombre." ".$apatern." ".$amatern;
											$estatus = $enlaces[$i][5];
											$telefono = $enlaces[$i][6];
											$idForm = $enlaces[$i][7];
											$idUnid = $enlaces[$i][8];
											$nunidad = $enlaces[$i][9];
											$nfisc = $enlaces[$i][10];
											$idfisca = $enlaces[$i][11];

											$arrayCapturadas = array();



												$mescap = getMesCapEnlaceArchivo($conn, $iden, 1);	
												$mescapen = $mescap[0][0];
												$mesCapturar = $mescapen;

												$mesNom = Mes_Nombre($mesCapturar);

                                       	    if($idfisca == 4){ $mpsList = getMpsEnlace($conn, $iden); }else{ $mpsList = getMpsEnlaceUnidad($conn, $iden,1); }


                                       	    for ($j=0; $j < sizeof($mpsList); $j++) { 		


                                                            $idMp = $mpsList[$j][4];
                                                            $idUnidad = $mpsList[$j][3];

                                                  $carpetaVal=validarCarpetaCapturada($conn, $anioCaptura, $mesCapturar, $idUnidad, $idMp);

                                                            if($carpetaVal == 1){ 

                                                            	$arrayCapturadas[$j] = 0; 
                                                            }else{ 

                                                            	if($carpetaVal == 2){ 

                                                            		$arrayCapturadas[$j] = 1; }

                                                            }
                                                }

                                                $longitud = count($arrayCapturadas);
                                                //echo $longitud."<br>";
                                                $nocap = 0;
                                                $sicap = 0;
                                                  if($longitud == 0){ $varValidado = "si";    }else{ 

                                                 for($k=0; $k<$longitud; $k++){

														if($arrayCapturadas[$k] == 0){ $nocap++; }
														if($arrayCapturadas[$k] == 1){ $sicap++; }

												 }
                                            }
								?>			

												<tr>

													<td class="tdRowMain negr"><? echo ($i+1); ?></td>
													<td class="tdRowMain2" style="padding: 5px !important;"><? echo $nomCompleto; ?></td>
													<td class="tdRowMain"><? echo $nunidad; ?></td>
													<td class="tdRowMain"><? echo $nfisc; ?></td>
													<td class="tdRowMain"><? echo $telefono; ?></td>
													<td class="tdRowMain"><? echo $mesNom; ?></td>


										

													<? if( $nocap == $longitud ){ ?>
													<td class="tdRowMain"><div class="redCol" id="circulo"></div></td>
													<? }else { if( $sicap == $longitud ){ 

																			?>
																					<td class="tdRowMain"><div class="verdCol" id="circulo"></div></td>
																			<?

															 } else {
															 			if ($nocap < $longitud && $nocap > 0) {
															 				# code...
															 			
															 	?>
															 				<td class="tdRowMain"><div class="yelloCol" id="circulo"></div></td>
															 	<?
															 	}
															 }

													} ?>


													<? 																
										
																	$enlacesExInfo = getInfOCarpetasEnv($conn, $iden, 1);	
																	$enviado = $enlacesExInfo[0][0];
																	$enviadoarch = $enlacesExInfo[0][1];
																	
																	if($enviado == 1){
																	?>
																			<td class="tdRowMain"><div class="verdCol" id="circulo"></div></td>
																			

																	<?
																	}else{  ?> <td class="tdRowMain"><div class="orangecol" id="circulo"></div></td> <?  }

																	if($enviadoarch == 1){ 
																		?>
																					<td class="tdRowMain"><div class="verdCol" id="circulo"></div></td>
																		<?

																	}else { ?> <td class="tdRowMain"><div class="orangecol" id="circulo"></div></td> <? }

															

													?>

													

													<? if( $longitud == 0 ){ ?> 
																	
																	<td class="tdRowMain"><center><button type="button" data-toggle="modal" href="#myModalEnlaceMps"  onclick="verModalMpsEnlace(<? echo $iden; ?>, '<? echo $nomCompleto; ?>');" class="btn btn-info btn-sm redondear btnCapturarTbl" disabled><span class="glyphicon glyphicon-search"></span> Ver MP´s Capturados </button></center></td>

													 <? }else { ?> 

													 				<td class="tdRowMain"><center><button type="button" data-toggle="modal" href="#myModalEnlaceMps"  onclick="verModalMpsEnlace(<? echo $iden; ?>, '<? echo $nomCompleto; ?>', <? echo $idfisca; ?>, 1);" class="btn btn-info btn-sm redondear btnCapturarTbl"><span class="glyphicon glyphicon-search"></span> Ver MP´s Capturados </button></center></td>

													   <? } ?>	

													
													
												</tr>		


										<? } ?>		

									 </tbody>
									</table>
							
							</div>

						</div><br>


										<div class="x_panel piepanel">
												<div class="piepanel2">
														<div class="piepanel3">
															<div class="piepanel4">
																							SISTEMA INTEGRAL DE REGISTRO ESTADISTICO Copyright © Todos los Derechos Reservados
															</div>
														</div>

													</div>				
											</div>


									</div>

		</body>
	</html>