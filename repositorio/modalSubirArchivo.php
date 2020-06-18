<? 
	
	include("../funciones.php");	

	session_start();

	if (isset($_POST["idUnidad"])){ $idUnidad = $_POST["idUnidad"]; }
	if (isset($_POST["mes"])){ $mes = $_POST["mes"]; }
	if (isset($_POST["anio"])){ $anio = $_POST["anio"]; }
	if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }
	if (isset($_POST["idarch"])){ $idarch = $_POST["idarch"]; }


	$mesnom = $mesNom = Mes_Nombre($mes);

?>

  														<div class="modal-header modlCabe">
										        <button type="button" class="close" data-dismiss="modal">&times;</button>
										        <center><h4 class="modal-title tituloMdl"> Subir Formato Estadístico ( <? echo $mesnom; ?> )</h4></center>
										      </div>

										      		<div class="col-md-12 col-sm-12 col-xs-12 form-group fondMdlSub">	
										      			<br>
																			      <form action="" method="POST" id="form_subir">				
																																
																			      						<div>
																																<label  for="message">Selecciona Archivo:</label>
																																<input type="file" name="archivo" id="archivos">
																															</div>			<br>																														
																																	
																															<div>
																																<label  for="message">Observaciónes:</label>
																																<textarea style="" rows="6" name="hechos" id="observaUpload"   class="form-control readonlydear textAreaSubir" name="message" placeholder=""></textarea>		<br>
																															</div>	

																																		<div class="barra">																																	
																																			<div class="" id="">																																				
																																					<div id="respuestaCargado"></div>
																																			</div>
																																  </div>
																										</form>
																							
										      		</div>
										      


										<div class="row">

												<div class="col-xs-6 col-sm-6 col-md-6"><center><button type="button" class="btn btn-success redondear btnSubCacelWidth"  onclick="subirArchENlace(<? echo $idUnidad; ?>, <? echo $idEnlace; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idarch; ?>)">Subir</button></center></div>
										       

										        <div class="col-xs-6 col-sm-6 col-md-6"><center><button type="button" class="btn btn-default redondear btnSubCacelWidth" data-dismiss="modal">Cancelar</button></center></div>
												  
										</div> <br>

										<div id="respuestaSubida"></div>