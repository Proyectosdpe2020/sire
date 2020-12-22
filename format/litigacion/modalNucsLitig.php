<? 
 session_start();

 include ("../../Conexiones/Conexion.php");
 include ("../../Conexiones/conexionSicap.php");
	include("../../funciones.php");
	include("../../funcioneSicap.php");
	include("../../funcioneLit.php");



	if (isset($_POST["cant"])){ $cant = $_POST["cant"]; }
	if (isset($_POST["idMp"])){ $idMp = $_POST["idMp"]; }
	if (isset($_POST["mes"])){ $mes = $_POST["mes"]; }
	if (isset($_POST["anio"])){ $anio = $_POST["anio"]; }
	if (isset($_POST["idUnidad"])){ $idUnidad = $_POST["idUnidad"]; }
	if (isset($_POST["estatus"])){ $estatus = $_POST["estatus"]; }



	$numestatus = intval($estatus);


	$sicaBand = 0;

	 if( $numestatus == 19 || $numestatus == 15 || $numestatus == 14 || $numestatus == 13){

				$dataestatusLitSic = getEstatusResoluicionName($conSic, $estatus);
				$tipoestatus = $dataestatusLitSic [0][0];
				$sicaBand = 1;
	 }else{	 	

			$dataestatusLit = getDataEstatusLitigacion($conn, $estatus);
				$tipoestatus = $dataestatusLit [0][0];

	 }



//echo $estatus."----".$tipoestatus;

	$idUsuario = $_SESSION['useridIE'];


?>   												
																	

														  <div class="modal-header" style="background-color:#3c6084;">
														<center><h4 class="modal-title" style="color:white; font-weight: bold;"> VALIDACIÓN DE NUCS </h4></center>
														</div>


																
														<div>
											
																								<div class="panel-body panelunoLitigacion">
																										<div class="row">
																										<div class="col-xs-6">	
																										<label>Cantidad de Casos :</label>
																										<input id="casos"  type="text"  value="<? echo $cant; ?>"  name="casos" value="Expediente"  tabindex="0"  placeholder="" style="height:38px; font-weight: bold;"  class="fechas form-control redondear"  disabled/>
																													</div>	
																													<div class="col-xs-6">	
																										<label>Estatus :</label>
																										<input id="expediente"  type="text"  value="<? echo $tipoestatus; ?>"  name="expediente"  tabindex="0"  placeholder="" style="height:38px; font-weight: bold;"  class="fechas form-control redondear"  disabled/>
																													</div>
																													</div>

																													<div id="contDataNucDeterm"></div>
																													
																																																			
																							<div class="row">
																										<div class="col-xs-6">
																												
																												<label style="font-weight:bold">Número de Caso *</label>
																															<input id="nuc"  type="number"   name="nuc" value="" tabindex="0" onkeyup="<? if($sicaBand == 1){ ?>  nucFunctionsLit('nuc', <? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $estatus; ?>, 0, <? echo $idUnidad; ?>); <?  }else{  ?>  nucInserts('nuc', <? echo $idMp; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $estatus; ?>, 0, <? echo $idUnidad; ?>); <? } ?>"  placeholder="Ingresa Número de Caso" style="height:38px; font-weight: bold;"  class="fechas form-control redondear" autofocus/>	

																										</div>
																										<div class="col-xs-6">
																												
																												<label style="font-weight:bold">Expediente *</label>
																															<div id="expedCont"><input id="expediente"  type=""   name="expediente" value="Expediente"  tabindex="0"  placeholder="" style="height:38px;"  class="fechas form-control redondear"  disabled/></div>		

																										</div>
																							</div>

																							<div class="row">	
																									<br>

																									<!-- PONER EL HEIGH DE LA TABLA EN AUTO -->                 
																										

																				   <? 											

																				   if($sicaBand == 1){


																					?>
																						  <div id="contTableNucs" style="overflow-y: hidden; overflow-x: hidden; padding: 15px;">															    													

																														 <table class="table table-striped tblTransparente">
																						<thead>
																						   <tr class="cabezeraTabla">
																									  <th class="col-xs-1 col-sm-1 col-md-1 textCent">No</th>
																									  <th class="col-xs-4 col-sm-4 col-md-4 textCent">Numero Caso </th>
																									  <th class="col-xs-6 col-sm-6 col-md-6 textCent">Expediente</th>          
																									  <th class="col-xs-1 col-sm-1 col-md-1 textCent">Acción</th>
																						   </tr>
																					</thead>
																					<tbody>
																					<?




																										//// Obtener las carpetas del Mp 
																				  $sumador = 0; 
																				  $carpeAgente = getDistincCarpetasAgenteLiti($conSic, $idMp, $estatus, $mes, $anio, 0);

																				  for ($i=0; $i < sizeof($carpeAgente) ; $i++) { 
																				
																																										$idResolMP = $carpeAgente[$i][0];
																											$carpid = $carpeAgente[$i][1];
																											$idUnidade = $carpeAgente[$i][2];
																											$EstatusID = $carpeAgente[$i][4];
																													$agenteid = $carpeAgente[$i][5];

																											if ( $idUnidad == $idUnidade && $estatus == $EstatusID AND $idMp == $agenteid) {
																												
																											 $nucs = getNucExpSicap($conSic, $carpid);
																											 $nuc = $nucs[0][0];
																											 $exp = $nucs[0][1];						

																											 ?>	
																									   <tr>
																										
																										  <td class="tdRowMain negr"><? echo ($sumador+1); ?></td>
																										  <td class="tdRowMain negr"><? echo $nuc; ?></td>
																										  <td class="tdRowMain negr"><? echo $exp; ?></td>

											

														<td class="tdRowMain"><center> <button type="button" onclick="deleteResol(<? echo $idResolMP; ?>, <? echo $idMp; ?>, <? echo $anio; ?>, <? echo $mes; ?>, <? echo $estatus ?>, <? echo $nuc; ?>, 0, <? echo $idUnidad; ?>)" class="btn btn-warning btn-sm redondear btnCapturarTbl"><span style="color: white !important;" class="glyphicon glyphicon-trash"></span> Eliminar </button></center></td>

																									   </tr>
																											 <?		
																											 $sumador++;
																											}																							                   								                					
																				  
																				  }

																						?>
		   </tbody>
																										  </table>
																										  </div>
																										  </div>
																										  </div>	<br>	

																																												<div class="row">
																<!--<div class="col-xs-12 col-sm-12 col-md-6"><center><button style="width: 100%;" type="button" class="btn btn-primary redondear" onclick="listoNucs(<? echo $numResolJudi; ?>);">Listo</button></center></div>-->
																							  <div class="col-xs-12 col-sm-12 col-md-12"><center><button style="width: 95%;" type="button" class="btn btn-primary redondear" onclick="modalsavecloseCmasc()">Salir</button></center></div>							  
																											</div><br>

																						<?

																				   }else{ 

																			 
																					?>	

																								<div id="contTableNucslitg" style="overflow-y: hidden; overflow-x: hidden; padding: 15px;">															    													

																														 <table class="table table-striped tblTransparente">
																						<thead>
																						   <tr class="cabezeraTabla">
																									  <th class="col-xs-1 col-sm-1 col-md-1 textCent">No</th>
																									  <th class="col-xs-4 col-sm-4 col-md-4 textCent">Numero Caso </th>
																									  <th class="col-xs-6 col-sm-6 col-md-6 textCent">Expediente</th>          
																									  <th class="col-xs-1 col-sm-1 col-md-1 textCent">Acción</th>
																						   </tr>
																					</thead>
																					<tbody>

																					<? 



																						  //// Obtener las carpetas del Mp 
																				  $sumador = 0; 
																				  $carpeAgente = getDistincCarpetasAgenteLitigacion($conn, $idMp, $estatus, $mes, $anio, $idUnidad);

																				  for ($i=0; $i < sizeof($carpeAgente) ; $i++) { 

																						$nuc = $carpeAgente[$i][0];
																						//// Por cada Carpeta Obtener la Ultima Determinacion que se realizo
																									$lastDetermin = getLastDeterminacionCarpetaLitig($conn, $nuc);

																									for ($k=0; $k < sizeof($lastDetermin); $k++) { 

																																										$idEstatusNucs = $lastDetermin[$k][0];
																											$nuc = $lastDetermin[$k][1];
																											$idUnidade = $lastDetermin[$k][2];
																											$EstatusID = $lastDetermin[$k][3];
																											$idCarpeta = $lastDetermin[$k][4];																                    	
																												

																											 $nucs = getNucExpSicap($conSic, $idCarpeta);
																											 $nuc = $nucs[0][0];
																											 $exp = $nucs[0][1];						

																											 ?>
																									   <tr>
																										
																										  <td class="tdRowMain negr"><? echo ($sumador+1); ?></td>
																										  <td class="tdRowMain negr"><? echo $nuc; ?></td>
																										  <td class="tdRowMain negr"><? echo $exp; ?></td>

                            <!--SE AGREGO EL BOTON PARA ABRIR EL NUEVO MODAL-->
                      

																										  <td class="tdRowMain"><center><button type="button" onclick="showModalNucLitInfo(<? echo $idEstatusNucs; ?>, <? echo $idMp; ?>, <? echo $anio; ?>, <? echo $mes; ?>, <? echo $estatus ?>, <? echo $nuc; ?>, <? echo $idUnidad; ?>)" class="btn btn-success btn-sm redondear btnCapturarTbl"><span style="color: white !important;" class="glyphicon glyphicon-pencil"></span> Agregar </button> <button type="button" onclick="deleteResolLit(<? echo $idEstatusNucs; ?>, <? echo $idMp; ?>, <? echo $anio; ?>, <? echo $mes; ?>, <? echo $estatus ?>, <? echo $nuc; ?>, <? echo $idUnidad; ?>)" class="btn btn-warning btn-sm redondear btnCapturarTbl"><span style="color: white !important;" class="glyphicon glyphicon-trash"></span> Eliminar </button></center></td>

																									   </tr>
																											 <?		
																											 $sumador++;
																											

																																											
																									}


																				  }

																				  ?>
																										   </tbody>
																				</table>
																				</div>
																				</div>
																				</div>


																																													<div class="row"><br>
																<!--<div class="col-xs-12 col-sm-12 col-md-6"><center><button style="width: 100%;" type="button" class="btn btn-primary redondear" onclick="listoNucs(<? echo $numResolJudi; ?>);">Listo</button></center></div>-->
																							  <div class="col-xs-12 col-sm-12 col-md-12"><center><button style="width: 97%;" type="button" class="btn btn-primary redondear" onclick="modalsavecloseCmasc()">Salir</button></center></div>	<br>								  
																											</div><br>
																				  <?


																				   }				                 

																				

																				   ?>
																	 

							


														

