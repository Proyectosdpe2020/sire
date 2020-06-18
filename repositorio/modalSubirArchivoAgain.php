<? 
	
	session_start();

	if (isset($_POST["idUnidad"])){ $idUnidad = $_POST["idUnidad"]; }
	if (isset($_POST["mes"])){ $mes = $_POST["mes"]; }
	if (isset($_POST["anio"])){ $anio = $_POST["anio"]; }
	if (isset($_POST["enlace"])){ $enlace = $_POST["enlace"]; }
	if (isset($_POST["idArch"])){ $idArch = $_POST["idArch"]; }
	if (isset($_POST["nomArch"])){ $nomArch = $_POST["nomArch"]; }

		$idUsuario = $_SESSION['useridIE'];
?>

  <div class="modal-header" style="background-color:#3f5265;">
										        <button type="button" class="close" data-dismiss="modal">&times;</button>
										        <center><h4 class="modal-title" style="color:white; font-weight: bold;"> Subir Archivo</h4></center>
										      </div>


										      		<div class="col-md-12 col-sm-12 col-xs-12 form-group" style = "background-image: url('img/Fondo 5.png'); background-repeat: repeat;  background-position: center; background-size: 100%; background-position-y: 25%;  ">								      				

										     			
										      <form action="" method="POST" id="form_subir">				
																							
										      						<div>
																							<label  for="message">Selecciona Archivo:</label>
																							<input type="file" name="archivo" id="archivosr">
																						</div>			
																					
																								
																						<div>
																							<label  for="message">Observaciónes:</label>
																							<textarea style="resize: none; background-color:rgba(255,255,255,0.7) !important; color: #686D72;" rows="6" name="hechos" id="observaUploadr"   class="form-control readonlydear" name="message" placeholder=""></textarea>		<br>
																						</div>	

																									<div class="barra">
																								
																										<div class="" id="">
																											
																												<div id="respuestaCargado"></div>

																										</div>

																							</div>

																	</form>
														

															<br>

										      		</div>
										      


										<div class="row">

												<div class="col-xs-6 col-sm-6 col-md-6"><center><button style="width: 95%;" type="button" class="btn btn-success redondear"  onclick="subirArchivoAgain(<? echo $idUnidad; ?>, <? echo $enlace; ?>, <? echo $mes; ?>, <? echo $anio; ?>, '<? echo $nomArch; ?>', <? echo $idArch; ?>)">Subir</button></center></div>
										       

										        <div class="col-xs-6 col-sm-6 col-md-6"><center><button style="width: 95%;" type="button" class="btn btn-default redondear" data-dismiss="modal">Cancelar</button></center></div>
												  
										</div> 

										<br>