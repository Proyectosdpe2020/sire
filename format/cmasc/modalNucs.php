<? 
 session_start();
 include ("../Conexiones/Conexion.php");
 include ("../Conexiones/conexionSicap.php");
	include("../funciones.php");
	include("../funcioneSicap.php");

	if (isset($_POST["cant"])){ $cant = $_POST["cant"]; }
	if (isset($_POST["idMp"])){ $idMp = $_POST["idMp"]; }
	if (isset($_POST["mes"])){ $mes = $_POST["mes"]; }
	if (isset($_POST["anio"])){ $anio = $_POST["anio"]; }
	if (isset($_POST["estatus"])){ $estatus = $_POST["estatus"]; }
	if (isset($_POST["deten"])){ $deten = $_POST["deten"]; }
	if (isset($_POST["idUnidad"])){ $idUnidad = $_POST["idUnidad"]; }

	$idUsuario = $_SESSION['useridIE'];

	/*$nucResol = getResolucionesMP($conn, $idMp, $estatus, $mes, $anio, $deten);
	$numResolJudi = sizeof($nucResol);*/

	$estatusArr = getEstatusNombre($conSic, $estatus);
	$estaNom = $estatusArr[0][0];



?>   												
																	

   														  <div class="modal-header" style="background-color:#3c6084;">
												        <center><h4 class="modal-title" style="color:white; font-weight: bold;"> Resolución de Carpeta </h4></center>
												      	</div>


												      	<div class="col-md-12 col-sm-12 col-xs-12 form-group ghostWhite2">																      				
												      	<br>
												      				<div class="panel panel-default">
																								<div class="panel-body panelin" style="height: auto; padding: 40px;">
																										<h5 class="text-on-pannel"><strong> VALIDACIÓN DE NUCS </strong></h5>
																										
																										<div class="row">
															    										<div class="col-xs-6">	
																										<label>Cantidad de Casos :</label>
																										<input id="casos"  type="text"  value="<? echo $cant; ?>"  name="casos" value="Expediente"  tabindex="0"  placeholder="" style="height:38px; font-weight: bold;"  class="fechas form-control redondear"  disabled/>
																													</div>
																													<div class="col-xs-6">	
																										<label>Estatus :</label>
																										<input id="expediente"  type="text"  value="<? echo $estaNom; ?>"  name="expediente"  tabindex="0"  placeholder="" style="height:38px; font-weight: bold;"  class="fechas form-control redondear"  disabled/>
																													</div>
																													</div>

																													<div id="contDataNucDeterm"></div>
																													
																																										    								
															    							<div class="row">
															    										<div class="col-xs-6">
															    												
															    												<label style="font-weight:bold">Número de Caso *</label>
																															<input id="nuc"  type="number"   name="nuc" value="" tabindex="0" onkeyup="nucFunctions('nuc', <? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $estatus; ?>, <? echo $deten; ?>, <? echo $idUnidad; ?>);"  placeholder="Ingresa Número de Caso" style="height:38px; font-weight: bold;"  class="fechas form-control redondear" autofocus/>	

															    										</div>
															    										<div class="col-xs-6">
															    												
															    												<label style="font-weight:bold">Expediente *</label>
																															<div id="expedCont"><input id="expediente"  type=""   name="expediente" value="Expediente"  tabindex="0"  placeholder="" style="height:38px;"  class="fechas form-control redondear"  disabled/></div>

															    										</div>
															    							</div>

															    							<div class="row">
															    									<br>


															    									<div id="contTableNucs" style="height: 580px; overflow: scroll; overflow-x: hidden;">															    													

															    														 <table class="table table-striped tblTransparente">
																                        <thead>
																                           <tr class="cabezeraTabla">
																                                      <th class="col-xs-12 col-sm-12 col-md-1 textCent">No</th>
																                                      <th class="col-xs-12 col-sm-12 col-md-5 textCent">Numero Caso </th>
																                                      <th class="col-xs-12 col-sm-12 col-md-5 textCent">Expediente</th>          
																                                      <th class="col-xs-12 col-sm-12 col-md-1 textCent">Acción</th>
																                           </tr>
																                    </thead>
																                    <tbody>

																                   <? 															                 

																                  //// Obtener las carpetas del Mp 
																                  $sumador = 0; 
																                  $carpeAgente = getDistincCarpetasAgente($conSic, $idMp, $estatus, $mes, $anio, $deten);

																                  for ($i=0; $i < sizeof($carpeAgente) ; $i++) { 

																                  		$CaepetaId = $carpeAgente[$i][0];
																                  		//// Por cada Carpeta Obtener la Ultima Determinacion que se realizo
																                  					$lastDetermin = getLastDeterminacionCarpeta($conSic, $CaepetaId);
																                  					for ($k=0; $k < sizeof($lastDetermin); $k++) { 

																																										$idResolMP = $lastDetermin[$k][0];
																                    						$carpid = $lastDetermin[$k][1];
																                    						$idUnidade = $lastDetermin[$k][2];
																                    						$EstatusID = $lastDetermin[$k][3];

																                    						if ( $idUnidad == $idUnidade && $estatus == $EstatusID ) {
																                    							
																                    						 $nucs = getNucExpSicap($conSic, $carpid);
																						                     $nuc = $nucs[0][0];
																						                     $exp = $nucs[0][1];						

																						                     ?>
																				                       <tr>
																				                        
																				                          <td class="tdRowMain negr"><? echo ($sumador+1); ?></td>
																				                          <td class="tdRowMain negr"><? echo $nuc; ?></td>
																				                          <td class="tdRowMain negr"><? echo $exp; ?></td>

																				                          <td class="tdRowMain"><center> <button type="button" onclick="deleteResol(<? echo $idResolMP; ?>, <? echo $idMp; ?>, <? echo $anio; ?>, <? echo $mes; ?>, <? echo $estatus ?>, <? echo $nuc; ?>, <? echo $deten; ?>, <? echo $idUnidad; ?>)" class="btn btn-warning btn-sm redondear btnCapturarTbl"><span style="color: white !important;" class="glyphicon glyphicon-trash"></span> Eliminar </button></center></td>

																				                       </tr>
																                    						 <?		
																                    						 $sumador++;
																                    						}	

																						                   								                					
																                  					}


																                  }


																                   ?>
																                    </tbody>
																                </table>


																														</div>
																														
																															<br>
																																<br>
															    							</div>

															    								<div class="row">
																<!--<div class="col-xs-12 col-sm-12 col-md-6"><center><button style="width: 100%;" type="button" class="btn btn-primary redondear" onclick="listoNucs(<? echo $numResolJudi; ?>);">Listo</button></center></div>-->
																			      			  <div class="col-xs-12 col-sm-12 col-md-12"><center><button style="width: 100%;" type="button" class="btn btn-primary redondear" onclick="modalsaveclose()">Salir</button></center></div>									  
																											</div> 

																								</div>
																					 </div>	

												      	</div>

												      	

