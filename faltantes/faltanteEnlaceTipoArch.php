		<?php

				session_start();
				include ("../Conexiones/Conexion.php");
				include("../funciones.php");		




				if (isset($_POST["mesCaptura"])){ $mesCaptura = $_POST["mesCaptura"]; }
				if (isset($_POST["anioCaptura"])){ $anioCaptura = $_POST["anioCaptura"]; }

				if (isset($_POST["tipoarchivo"])){ $tipoarchivo = $_POST["tipoarchivo"]; }

			

	?>



						<div class="row">		

		
					
								<table class="table table-striped tblTransparente">
									<thead>
										<tr class="cabezeraTabla">
													<th class="col-xs-12 col-sm-12 col-md-1 textCent">No</th>
													<th class="col-xs-12 col-sm-12 col-md-2 ">Nombre Enlace</th>
													<th class="col-xs-12 col-sm-12 col-md-3 textCent">Unidad</th>
													<th class="col-xs-12 col-sm-12 col-md-1 textCent">Fiscalía</th>												
													<th class="col-xs-12 col-sm-12 col-md-1 textCent">Telefono</th>
									

													<th class="col-xs-12 col-sm-12 col-md-1 textCent">Estado </th>
													<th class="col-xs-12 col-sm-12 col-md-1 textCent">Enviado </th>
													<th class="col-xs-12 col-sm-12 col-md-1 textCent">Archivo </th>
													<th class="col-xs-12 col-sm-12 col-md-1 textCent">Accion</th>

										</tr>
									</thead>
									<tbody>
												

								<? 

										$enlaces = getInfoEnlacesCarpetas($conn, $tipoarchivo);

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


											$mesCapturare  = getMesCapEnlaceArchivo($conn, $iden, $tipoarchivo);
											$mesCaptura = $mesCapturare[0][0];

											$arrayCapturadas = array();											

                                       	   

                                       	  if($tipoarchivo == 1){ if($idfisca == 4){ $mpsList = getMpsEnlace($conn, $iden); }else{ $mpsList = getMpsEnlaceUnidad($conn, $iden,1); } } 
                                       	  
                                       	  if($tipoarchivo == 4){ if($idfisca == 4){ $mpsList = getMpsEnlaceUnidad($conn, $iden,4); }else{ $mpsList = getMpsEnlaceUnidad($conn, $iden,4); } } 



                                       	    for ($j=0; $j < sizeof($mpsList); $j++) { 		


                                                            $idMp = $mpsList[$j][4];
                                                            $idUnidad = $mpsList[$j][3];


                                                 																	
                                                 																	if($tipoarchivo == 1){ $carpetaVal=validarCarpetaCapturada($conn, $anioCaptura, $mesCaptura, $idUnidad, $idMp); }
                                                 																	if($tipoarchivo == 4){ $carpetaVal=validarLitigacionCapturada($conn, $anioCaptura, $mesCaptura, $idMp, $idfisca);	}
                                                 																 

                                                            if($carpetaVal == 1){ 

                                                            	$arrayCapturadas[$j] = 0; 
                                                            }else{ 

                                                            	if($carpetaVal == 2){ 

                                                            		$arrayCapturadas[$j] = 1; }

                                                            }
                                                }

                                                $longitud = count($arrayCapturadas);


                                                //echo "La longitud es :".$longitud."<br>";
                                                $nocap = 0;
                                                $sicap = 0;
                                                  if($longitud == 0){ $varValidado = "si";    }else{ 

                                                 for($k=0; $k<$longitud; $k++){

														if($arrayCapturadas[$k] == 0){ $nocap++; }
														if($arrayCapturadas[$k] == 1){ $sicap++; }

												 }

            }

           // echo "<br>Nocap = ".$nocap."        longitud = ".$longitud." sicap = ".$sicap." idFiscalia = ".$idfisca."<br>";
         
								?>			

												<tr>

													<td class="tdRowMain negr"><? echo ($i+1); ?></td>
													<td class="tdRowMain2" style="padding: 5px !important;"><? echo $nomCompleto; ?></td>
													<td class="tdRowMain"><? echo $nunidad; ?></td>
													<td class="tdRowMain"><? echo $nfisc; ?></td>
													<td class="tdRowMain"><? echo $telefono; ?></td>

										

												



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
																	
																	if($tipoarchivo == 1){ $enlacesExInfo = getInfOCarpetasEnv($conn, $iden, 1);	 }
                 if($tipoarchivo == 4){ $enlacesExInfo = getInfOCarpetasEnv($conn, $iden, 4);		}																	

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

													

													<? if( $longitud == 0 ){   ?> 
																	
																	<td class="tdRowMain"><center><button type="button" data-toggle="modal" href="#myModalEnlaceMps"  onclick="verModalMpsEnlace(<? echo $iden; ?>, '<? echo $nomCompleto; ?>', <? echo $tipoarchivo; ?>);" class="btn btn-info btn-sm redondear btnCapturarTbl" disabled><span class="glyphicon glyphicon-search"></span> Ver MP´s Capturados </button></center></td>

													 <? }else { ?> 

													 				<td class="tdRowMain"><center><button type="button" data-toggle="modal" href="#myModalEnlaceMps"  onclick="verModalMpsEnlace(<? echo $iden; ?>, '<? echo $nomCompleto; ?>', <? echo $idfisca; ?>, <? echo $tipoarchivo; ?>);" class="btn btn-info btn-sm redondear btnCapturarTbl"><span class="glyphicon glyphicon-search"></span> Ver MP´s Capturados </button></center></td>

													   <? } ?>	

													
													
												</tr>		


										<? } ?>		

									 </tbody>
									</table>
							
							</div>




										