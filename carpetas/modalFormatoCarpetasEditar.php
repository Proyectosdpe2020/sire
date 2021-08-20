<? 
	
	session_start();
	include ("../Conexiones/Conexion.php");
	include("../funciones.php");	
	if (isset($_POST["nombreCompletoMP"])){ $nombreCompletoMP = $_POST["nombreCompletoMP"]; }

	if (isset($_POST["idMp"])){ $idMp = $_POST["idMp"]; }
	if (isset($_POST["idUnidad"])){ $idUnidad = $_POST["idUnidad"]; }
	if (isset($_POST["mes"])){ $mes = $_POST["mes"]; }
	if (isset($_POST["anio"])){ $anio = $_POST["anio"]; }

 $idUsuario = $_SESSION['useridIE'];
	$unInfo = getInfoUnidad($conn, $idUnidad);
 $nomUnidad = $unInfo[0][1]; 
	
	if($mes == 1){ $mesAnterior = 12; $anioAnte = ($anio-1); }else{ $anioAnte = $anio; $mesAnterior = ($mes - 1); 	}

		$existenciaAnt = getExistenciaAnterior($conn, $mesAnterior, $anioAnte, $idUnidad, $idMp);

				if($existenciaAnt){ 
			$tramiteAnte = $existenciaAnt[0][0];  
			$bandHabTramite = 0;
		}else{ 
			$bandHabTramite = 0;
			$tramiteAnte = 0;
		}

	$carpeta = getInfoCarpeta($conn , $mes, $anio, $idUnidad, $idMp);

	$existenciaAnterior = $carpeta[0][0]; 	
	$iniciadasConDetenido = $carpeta[0][1]; 	
	$iniciadasSinDetenido = $carpeta[0][2]; 	
	$totalIniciadas = $carpeta[0][3]; 	
	$recibidasPorOtraUnidad = $carpeta[0][4]; 	
	$totalTrabajar = $carpeta[0][5]; 	
	$judicializadasConDetenido = $carpeta[0][6];
	$judicializadasSinDetenido = $carpeta[0][7]; 	
	$totalJudicializadas = $carpeta[0][8]; 	
	$abstencionInvestigacion = $carpeta[0][9]; 	
	$archivoTemporal = $carpeta[0][10]; 	
	$noEjercicioAccionPenal = $carpeta[0][11]; 	
	$mediacion = $carpeta[0][12]; 	
	$conciliacion = $carpeta[0][13];
	$criteriosOportunidad = $carpeta[0][14]; 	
	$suspensionCondicional = $carpeta[0][15]; 		$enviadasUI = $carpeta[0][20];

	$incompetencia = $carpeta[0][16]; 	
	$acumulacion = $carpeta[0][17]; 	
	$totalResoluciones = $carpeta[0][18]; 	
	$enviadasUATP = $carpeta[0][19]; 	
	$tramite = $carpeta[0][21];

	$idCarpeta = $carpeta[0][22];
	$enviImpDes = $carpeta[0][24];
	$reiniciadas = $carpeta[0][25];

		if($existenciaAnt){ 
			$existenciaAnterior = $carpeta[0][0];   
			$bandHabTramite = 0;
		}else{ 

			$bandHabTramite = 0;
			$tramiteAnte = 0;
		}


?>

  <div class="modal-header" style="background-color:#3c6084;">
												<!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
												
												<center><h4 class="modal-title" style="color:white; font-weight: bold;"> <? echo $nomUnidad; ?> </h4></center><br>
												<center><h5 class="modal-title" style="color:white; font-weight: ;"> ( Actualizar ) <? echo $nombreCompletoMP; ?> </h5></center>
											  </div>


													<div class="col-md-12 col-sm-12 col-xs-12 form-group panelunoLitigacion">								      				

															
															<div class="row" style="padding: 15px;">
																
																<div class="row">   

																	<div class="col-md-12 col-sm-12 col-xs-12">
																			<br>
																			<div class="panel panel-default">
																	    <div class="panel-body">
																	      <h5 class="text-on-pannel"><strong> Existencia Anterior </strong></h5>
																	       <label class="colorLetras" for="inputlg">Trámite :</label>
    				<input class="form-control input-md redondear fdesv colorBloqueado" id="inputTramiteAnteriorA" type="number"  onkeyup="actualizarTotalTrabajarA()" value="<? echo $tramiteAnte;  ?>"  <? if($bandHabTramite == 0){ echo "readonly";} ?>>
																	    </div>
																	  </div>

																	</div>

																</div>

																<div class="row">
																	
																		<div class="col-md-12 col-sm-12 col-xs-12">
																			
																						<div class="panel panel-default">
																				    <div class="panel-body">
																				      <h5 class="text-on-pannel"><strong> Iniciadas </strong></h5>
																				       
																				      <div class="row">
																				      	
																				      					<div class="col-xs-6">
																				      							<label class="colorLetras" for="inputlg">Con Detenido :</label>
			    																											<input class="form-control input-md redondear fdesv" id="inputCdetenA" type="number" onkeyup="actualizarIniciadasA()"  value="<? echo $iniciadasConDetenido ?>" >
																				      					</div>
																				      					<div class="col-xs-6">
																				      								<label class="colorLetras" for="inputlg">Sin Detenido :</label>
			    																											<input class="form-control input-md redondear fdesv" id="inputSdetenA" type="number" onkeyup="actualizarIniciadasA()"  value="<? echo $iniciadasSinDetenido ?>" >
																				      					</div>

																				      </div>
																				      <div class="row">
																				      	
																				      					<div class="col-md-12 col-sm-12 col-xs-12">
																				      								<label class="colorLetras" for="inputlg">Total Iniciadas :</label>
			    																											<div id="inicidadasA"><input class="form-control input-md redondear fdesv" value="<? echo $totalIniciadas ?>" id="inpuTotIniciadasA" type="number" readonly></div>
																				      					</div>

																				      </div>																				    	

																				    </div>
																				  </div>

																				   <div class="row">

																				  							  <div class="col-xs-12">
																				      							<br>
																																		<div class="panel panel-default fd1" style="">
																																    <div class="panel-body">
																																      <h5 class="text-on-pannel"><strong>Reiniciadas :</strong></h5>
															    																					<div class="iconiput">
																																						  	<input type="number" placeholder="cantidad" class="first" onkeyup="actualizarTotalTrabajarA()" id="reiniciadasUp" value="<? echo $reiniciadas ?>"/>
																																						  <span onclick="sendDataModalEdit('reiniciadasUp',1,0,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkReiniUp"><i class="fa fa-file-text fa-lg fa-fw curPo" aria-hidden="true"></i></div></span>
																																						  </div>			

																																    </div>
																																  </div>			    																											
																				      					</div>

																				  </div>

																				   <div class="row">

																				  							  <div class="col-xs-12">
																				      							<br>
																																		<div class="panel panel-default fd1" style="">
																																    <div class="panel-body">
																																      <h5 class="text-on-pannel"><strong>Recibidas por otra Unidad :</strong></h5>
															    																				<input class="form-control input-md redondear fdesv" id="reCbOtrUniA" type="number" onkeyup="actualizarTotalTrabajarA()"  value="<? echo $recibidasPorOtraUnidad ?>" >
																																    </div>
																																  </div>			    																											
																				      					</div>

																				  </div>

																				   <div class="row">
																				      					<div class="col-xs-12">
																				      							<br>
																																		<div class="panel panel-default fd1" style="">
																																    <div class="panel-body">
																																      <h5 class="text-on-pannel"><strong> Total a Trabajar</strong></h5>
															    																				<div id="totalTrabajarA"><input class="form-control input-md redondear fdesv" id="inputTotalTrabajarA" value="<? echo $totalTrabajar ?>" type="number" readonly></div>
																																    </div>
																																  </div>			    																											
																				      					</div>
																				  </div> 

																				  <div class="panel panel-default redondear" style="margin-top: 5% !important;">
																				    <div class="panel-body">
																				      <h5 class="text-on-pannel"><strong> Resueltas o Determinadas   </strong></h5>
																				       
																				      <div class="row">
																				      						

																				      					<div class="col-xs-6">
																				      							<label class="colorLetras" for="inputlg">Judicializadas Con Detenido :</label>
																				      							<div class="iconiput">
			    																											<input class="first" id="inputCdetenjuA" onkeyup="actualizarJudicializadasA()" type="number" value="<? echo $judicializadasConDetenido ?>" >
			    																											<span onclick="checkJudicializaCdetenEdit(22,2, <? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkCdetenjuA"><i class="fa fa-file-text fa-lg fa-fw curPo" aria-hidden="true"></i></div></span>
			    																											</div>
																				      					</div>

																				      						<div class="col-xs-6">
																				      								<label class="colorLetras" for="inputlg">Judicializadas Sin Detenido :</label>
																				      								<div class="iconiput">
																														  	<input class="first" id="inputSdetenjuA" onkeyup="actualizarJudicializadasA()" type="number" value="<? echo $judicializadasSinDetenido ?>" >
																														  	<span onclick="sendDataModalEdit('inputSdetenjuA',22,1,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkSdetenjuA"><i class="fa fa-file-text fa-lg fa-fw curPo" aria-hidden="true"></i></div></span>
																														  </div>	

																				      					</div>

																				      </div>
																				      <div class="row">
																				      	
																				      					<div class="col-md-12 col-sm-12 col-xs-12">
																				      								<label class="colorLetras" for="inputlg">Total judicializadas :</label>
			    																											<div id="totalJudicializadasA"><input class="form-control input-md redondear fdesv" id="inputJudicializadasA" value="<? echo $totalJudicializadas ?>" type="number" readonly></div>
																				      					</div>

																				      </div>
																				    	

																				    </div>
																				  </div>

																				  
																				    <div class="row">				

																				      					<div class="col-xs-12">
																																		<div class="panel panel-default fd1 redondear" style="">
																																    <div class="panel-body">
															    																				
																																    			<div class="col-xs-12">
																												      							<label class="colorLetras" for="inputlg">Abstención de Investigación :</label>
																												      							<div class="iconiput">
																																						  	<input class="first" id="inputAbsInvesA" type="number" onkeyup="actualizarResolucionesA()" value="<? echo $abstencionInvestigacion ?>" >
																																						  	<span onclick="sendDataModalEdit('inputAbsInvesA',2,0,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkAbsInvesA"><i class="fa fa-file-text fa-lg fa-fw curPo" aria-hidden="true"></i></div></span>
																																						  </div>	
																												      					</div>

																												      					<div class="col-xs-12">
																												      								<label class="colorLetras" for="inputlg">Archivo Temporal :</label>
																												      								<div class="iconiput">
																																								  	<input class="first" id="inputArcTemA" type="number" onkeyup="actualizarResolucionesA()" value="<? echo $archivoTemporal ?>" >
																																								  	<span onclick="sendDataModalEdit('inputArcTemA',5,0,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkArcTemA"><i class="fa fa-file-text fa-lg fa-fw curPo" aria-hidden="true"></i></div></span>
																																								  </div>	
																												      					</div>

																												      						<div class="col-xs-12">
																												      								<label class="colorLetras" for="inputlg">No ejercicio de la acción penal :</label>
																												      									<div class="iconiput">
																																						  			<input class="first" id="inputNEAPA" type="number" onkeyup="actualizarResolucionesA()" value="<? echo $noEjercicioAccionPenal ?>" >
																																						  	<span onclick="sendDataModalEdit('inputNEAPA',20,0,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkNEAPA"><i class="fa fa-file-text fa-lg fa-fw curPo" aria-hidden="true"></i></div></span>
																																						  </div>	
																												      					</div>

																												      					<div class="col-xs-12">
																												      							<label class="colorLetras" for="inputlg">Incompetencia:</label>
																												      							<div class="iconiput">
																																						  	<input class="first" id="inputIncompeA" type="number" onkeyup="actualizarResolucionesA()" value="<? echo $incompetencia ?>" >
																																						  	<span onclick="sendDataModalEdit('inputIncompeA',21,0,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkIncompeA"><i class="fa fa-file-text fa-lg fa-fw curPo" aria-hidden="true"></i></div></span>
																																						  </div>	

																												      					</div>

																												      					<div class="col-xs-12">
																											      								<label class="colorLetras" for="inputlg">Acumulación :</label>
																											      								<div class="iconiput">
																																					  		<input class="first" id="inputAcumulacionA" type="number" onkeyup="actualizarResolucionesA()" value="<? echo $acumulacion ?>" >
																																					  		<span onclick="sendDataModalEdit('inputAcumulacionA',3,0,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkAcumulacionA"><i class="fa fa-file-text fa-lg fa-fw curPo" aria-hidden="true"></i></div></span>
																																					  </div>	
																																					  <br>
																											      					</div>


																																    </div>
																																  </div>
																				      					
																				      					</div>
																				      				
																				      					

																				  </div>	

																				   <div class="panel panel-default redondear" style="margin-top: 5% !important;">
																				    <div class="panel-body">
																				      <h5 class="text-on-pannel"><strong> Salidas Alternas </strong></h5>
																				       
																				      <div class="row">
																				      					
																				      						<div class="col-xs-6">
																				      							<label class="colorLetras" for="inputlg">Mediación :</label>
																				      							<div class="iconiput">
																														  	<input class="first" id="inputMediacionA" type="number" onkeyup="actualizarResolucionesA()" value="<? echo $mediacion ?>" >
																														  	<span onclick="sendDataModalEdit('inputMediacionA',23,0,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkMediacionA"><i class="fa fa-file-text fa-lg fa-fw curPo" aria-hidden="true"></i></div></span>
																														  </div>	

																				      					</div>

																				      					<div class="col-xs-6">
																				      								<label class="colorLetras" for="inputlg">Conciliación :</label>
																				      								<div class="iconiput">
																															  	<input class="first" id="inputConciliacionA" type="number" onkeyup="actualizarResolucionesA()" value="<? echo $conciliacion ?>" >
																															  	<span onclick="sendDataModalEdit('inputConciliacionA',24,0,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkConciliacionA"><i class="fa fa-file-text fa-lg fa-fw curPo" aria-hidden="true"></i></div></span>
																															  	</div>	
																				      					</div>

																				      </div>
																				      <div class="row">
																				      	
																				      						<div class="col-xs-6">
																				      							<label class="colorLetras" for="inputlg">Criterios de Oportunidad :</label>
																				      							<div class="iconiput">
																															  	<input class="first" id="inputCriteOporA" type="number" onkeyup="actualizarResolucionesA()" value="<? echo $criteriosOportunidad ?>" >
																															  	<span onclick="sendDataModalEdit('inputCriteOporA',25,0,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkCriteOporA"><i class="fa fa-file-text fa-lg fa-fw curPo" aria-hidden="true"></i></div></span>
																															  	</div>	

																				      					</div>

																				      						<div class="col-xs-6">
																				      								<label class="colorLetras" for="inputlg">Suspensión Condicional del Proceso :</label>
																				      								<div class="iconiput">
																															  	<input class="first" id="inputSCPA" type="number" onkeyup="actualizarResolucionesA()" value="<? echo $suspensionCondicional ?>" >
																															  	<span onclick="sendDataModalEdit('inputSCPA',15,0,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkSCPA"><i class="fa fa-file-text fa-lg fa-fw curPo" aria-hidden="true"></i></div></span>
																															  	</div>	

																				      					</div>

																				      </div>
																				    	

																				    </div>
																				  </div>

																				  <div class="row">				

																				  									<div class="col-xs-12">
																				      						<br>
																																		<div class="panel panel-default fd1 redondear" style="">
																																    <div class="panel-body">
																																      <h5 class="text-on-pannel"><strong> Total de Resoluciones o Determinadas </strong></h5>
															    																				<div id="totalResolucionesA"><input class="form-control input-md redondear fdesv" id="inputResolucionesA" value="<? echo $totalResoluciones; ?>" type="number" readonly=""></div>
																																    </div>
																																  </div>
																				      					
																				      					</div>

																				      					<div class="col-xs-12">
																																		<div class="panel panel-default fd1 redondear" style="">
																																    <div class="panel-body">
															    																				

																																    					<div class="col-xs-12">
																											      								<label class="colorLetras" for="inputlg">Enviadas a Unidad de Atención Temprana :</label>
										    																											<input class="first" id="inputEnvUATPA" type="number" onkeyup="actualizarTramiteA()" value="<? echo $enviadasUATP ?>" >
																														      					</div>
																														      					<div class="col-xs-12">
																														      								<label class="colorLetras" for="inputlg">Enviadas a Unidad de Investigación :</label>
													    																											<input class="first" id="inputEnvUIA" type="number" onkeyup="actualizarTramiteA()" value="<? echo $enviadasUI ?>" >
																														      					</div>
																														      					
																														      					<div class="col-xs-12">
																														      								<label class="colorLetras" for="inputlg">Canalizadas a Imputado Desconocido :</label>
													    																											<input class="first" onkeyup="actualizarTramiteA()" id="inputEnvImpDescA" type="number" value="<? echo $enviImpDes ?>">
																														      					</div>
																														      					
																														      					<div class="col-xs-12">
																														      								<label class="colorLetras" for="inputlg">Trámite :</label>
													    																											<div id="tramiteFinalA"><input class="form-control input-md redondear fdesv" id="inputTramiteFinalA" value="<? echo $tramite; ?>" type="number" readonly=""></div>
																														      					</div>


																																    </div>
																																  </div>
																				      					
																				      					</div>
																				      				
																				      					

																				  </div>


																		</div>	

																	</div>


																</div>										

																</div>
																</div>

															</div>
											  

													</div>
											  
														<div id="continputdhiddenupd">
														  
											  </div>

										<div class="row">

									
												<div class="col-xs-12 col-sm-12 col-md-12"><center><button style="width: 95%;" type="button" class="btn btn-primary redondear"  onclick="validateItsokUpd( <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, <? echo $idMp; ?>, <? echo $idCarpeta; ?> )">Actualizar</button></center></div>
											   

												<!--<div class="col-xs-6 col-sm-6 col-md-6"><center><button style="width: 95%;" type="button" class="btn btn-default redondear" data-dismiss="modal">Cancelar</button></center></div>-->
												  
										</div> 

										<br>