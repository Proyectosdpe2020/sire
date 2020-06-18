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
	$suspensionCondicional = $carpeta[0][15]; 	
	$incompetencia = $carpeta[0][16]; 	
	$acumulacion = $carpeta[0][17]; 	
	$totalResoluciones = $carpeta[0][18]; 	
	$enviadasUATP = $carpeta[0][19]; 	
	$enviadasUI = $carpeta[0][20];
	$tramite = $carpeta[0][21];

	$enviImpDes = $carpeta[0][24];
	$reiniciadas = $carpeta[0][25];

?>

  <div class="modal-header" style="background-color:#3f5265;">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												
												<center><h4 class="modal-title" style="color:white; font-weight: bold;"> <? echo $nomUnidad; ?> </h4></center><br>
												<center><h5 class="modal-title" style="color:white; font-weight: ;"> ( Revisar ) <? echo $nombreCompletoMP; ?> </h5></center>
											  </div>


													<div class="col-md-12 col-sm-12 col-xs-12 form-group panelunoLitigacion" >								      				

															
															<div class="row"  style="padding: 15px;">
																
																<div class="row">   															


																		<div class="col-md-12 col-sm-12 col-xs-12">
																			<br>
																			<div class="panel panel-default">
																	    <div class="panel-body">
																	      <h5 class="text-on-pannel"><strong> Existencia Anterior </strong></h5>
																	       <label class="colorLetras" for="inputlg">Trámite :</label>
    																				<input class="form-control input-md redondear fdesv" id="inputTramiteAnterior" type="number" value="<? echo $existenciaAnterior ?>" readonly>
																	    </div>
																	  </div>

																	</div>



																	
																		<div class="col-md-12 col-sm-12 col-xs-12">
																			
																						<div class="panel panel-default">
																				    <div class="panel-body">
																				      <h5 class="text-on-pannel"><strong> Iniciadas </strong></h5>
																				       
																				      <div class="row">
																				      	
																				      					<div class="col-xs-6">
																				      							<label class="colorLetras" for="inputlg">Con Detenido :</label>
			    																											<input class="first" id="inputCdeten" type="number" value="<? echo $iniciadasConDetenido ?>" readonly>
																				      					</div>
																				      					<div class="col-xs-6">
																				      								<label class="colorLetras" for="inputlg">Sin Detenido :</label>
			    																											<input class="first" id="inputSdeten" type="number" value="<? echo $iniciadasSinDetenido ?>" readonly>
																				      					</div>

																				      </div>
																				      <div class="row">
																				      	
																				      					<div class="col-md-12 col-sm-12 col-xs-12">
																				      								<label class="colorLetras" for="inputlg">Total Iniciadas :</label>
			    																											<div id="inicidadas"><input class="form-control input-md redondear fdesv" value="<? echo $totalIniciadas ?>" id="inpuTotIniciadas" type="number" readonly></div>
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
															    																				<input class="first" id="reiniciadas" type="number" value="<? echo $reiniciadas ?>" readonly>
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
															    																				<input class="first" id="reCbOtrUni" type="number" value="<? echo $recibidasPorOtraUnidad ?>" readonly>
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
															    																			<div id="totalTrabajar"><input class="form-control input-md redondear fdesv" id="inputTotalTrabajar" value="<? echo $totalTrabajar ?>" type="number" readonly></div>
																																    </div>
																																  </div>			    																											
																				      					</div>
																				  </div> 


																				  <div class="panel panel-default" style="background-color: rgba(255,255,255,0.8); margin-top: 5% !important;">
																				    <div class="panel-body">
																				      <h5 class="text-on-pannel"><strong> Resueltas o Determinadas    </strong></h5>
																				       
																				      <div class="row">
																				      	
																				      					<div class="col-xs-6">
																				      							<label class="colorLetras" for="inputlg">Con Detenido :</label>
			    																											<input class="first" id="inputCdetenju" type="number" value="<? echo $judicializadasConDetenido ?>" readonly>
																				      					</div>
																				      					<div class="col-xs-6">
																				      								<label class="colorLetras" for="inputlg">Sin Detenido :</label>
			    																											<input class="first" id="inputSdetenju" type="number" value="<? echo $judicializadasSinDetenido ?>" readonly>
																				      					</div>

																				      </div>
																				      <div class="row">
																				      	
																				      					<div class="col-md-12 col-sm-12 col-xs-12">
																				      								<label class="colorLetras" for="inputlg">Total judicializadas :</label>
			    																											<div id="totalJudicializadas"><input class="form-control input-md redondear fdesv" id="inputJudicializadas" value="<? echo $totalJudicializadas ?>" type="number" readonly></div>
																				      					</div>

																				      </div>
																				    	

																				    </div>
																				  </div>




																				  <div class="row">


																				  				<div class="col-xs-12">
																																		<div class="panel panel-default fd1" style="">
																																    <div class="panel-body">
															    																				

																														<div class="col-xs-12">
																				      							<label class="colorLetras" for="inputlg">Abstención de Investigación :</label>
			    																											<input class="first" id="inputAbsInves" type="number" value="<? echo $abstencionInvestigacion ?>" readonly> 
																				      					</div>
																				      					<div class="col-xs-12">
																				      								<label class="colorLetras" for="inputlg">Archivo Temporal :</label>
			    																											<input class="first" id="inputArcTem" type="number" value="<? echo $archivoTemporal ?>" readonly>
																				      					</div>
																				      					<div class="col-xs-12">
																				      								<label class="colorLetras" for="inputlg">No ejercicio de la acción penal :</label>
			    																											<input class="first" id="inputNEAP" type="number" value="<? echo $noEjercicioAccionPenal ?>" readonly>
																				      					</div>
																				      					<div class="col-xs-12">
																				      							<label class="colorLetras" for="inputlg">Incompetencia:</label>
			    																											<input class="first" id="inputIncompe" type="number" value="<? echo $incompetencia ?>" readonly>
																				      					</div>
																				      					<div class="col-xs-12">
																				      								<label class="colorLetras" for="inputlg">Acumulación :</label>
			    																											<input class="first" id="inputAcumulacion" type="number" value="<? echo $acumulacion ?>" readonly>
																				      					</div>


																																    </div>
																																  </div>
																				      					
																				      					</div>

																				      				


																				  </div>

																				   <div class="panel panel-default" style="background-color: rgba(255,255,255,0.8); margin-top: 5% !important;">
																				    <div class="panel-body">
																				      <h5 class="text-on-pannel"><strong> Salidas Alternas </strong></h5>
																				       
																				      <div class="row">
																				      	
																				      					<div class="col-xs-6">
																				      							<label class="colorLetras" for="inputlg">Mediación :</label>
			    																											<input class="first" id="inputMediacion" type="number" value="<? echo $mediacion ?>" readonly>
																				      					</div>
																				      					<div class="col-xs-6">
																				      								<label class="colorLetras" for="inputlg">Conciliación :</label>
			    																											<input class="first" id="inputConciliacion" type="number" value="<? echo $conciliacion ?>" readonly>
																				      					</div>

																				      </div>
																				      <div class="row">
																				      	
																				      					<div class="col-xs-6">
																				      							<label class="colorLetras" for="inputlg">Criterios de Oportunidad :</label>
			    																											<input class="first" id="inputCriteOpor" type="number" value="<? echo $criteriosOportunidad ?>" readonly>
																				      					</div>
																				      					<div class="col-xs-6">
																				      								<label class="colorLetras" for="inputlg">Suspensión Condicional del Proceso :</label>
			    																											<input class="first" id="inputSCP" type="number" value="<? echo $suspensionCondicional ?>" readonly>
																				      					</div>

																				      </div>
																				    	

																				    </div>
																				  </div>

																				  <div class="row">
																				      					
																				      								<div class="col-xs-12">
																				      						<br>
																																		<div class="panel panel-default fd1" style="">
																																    <div class="panel-body">
																																      <h5 class="text-on-pannel"><strong> Total de Resoluciones o Determinadas </strong></h5>
															    																				<div id="totalResoluciones"><input class="form-control input-md redondear fdesv" id="inputResoluciones" value="<? echo $totalResoluciones; ?>" type="number" readonly=""></div>
																																    </div>
																																  </div>
																				      					
																				      					</div>


																				      							<div class="col-xs-12">
																																		<div class="panel panel-default fd1" style="">
																																    <div class="panel-body">
															    																				

																																    					
																				      					<div class="col-xs-12">
																				      						<hr>
																				      								<label class="colorLetras" for="inputlg">Enviadas a Unidad de Atención Temprana :</label>
			    																											<input class="first" id="inputEnvUATP" type="number" value="<? echo $enviadasUATP ?>" readonly>
																				      					</div>
																				      					<div class="col-xs-12">
																				      								<label class="colorLetras" for="inputlg">Enviadas a Unidad de Investigación :</label>
			    																											<input class="first" id="inputEnvUI" type="number" value="<? echo $enviadasUI ?>" readonly>
																				      					</div>
																				      						
																				      					<div class="col-xs-12">
																				      								<label class="colorLetras" for="inputlg">Canalizadas a Imputado Desconocido :</label>
			    																											<input class="first"  id="inputEnvImpDesc" type="number" value="<? echo $enviImpDes ?>" readonly>
																				      					</div>


																				      					<div class="col-xs-12">
																				      								<label class="colorLetras" for="inputlg">Trámite :</label>
			    																											<div id="tramiteFinal"><input class="form-control input-md redondear fdesv colorBloqueado" id="inputTramiteFinal" value="<? echo $tramite ?>" type="number" readonly=""></div>
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
											  


										<div class="row">

									
												<div class="col-xs-12 col-sm-12 col-md-12"><center><button style="width: 95%;" type="button" class="btn btn-default redondear" data-dismiss="modal">Cancelar</button></center></div>
												  
										</div> 

										<br>