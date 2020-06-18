<? 
	
	session_start();

	if (isset($_POST["mesCapturar"])){ $mesCapturar = $_POST["mesCapturar"]; }
	if (isset($_POST["idArea"])){ $idArea = $_POST["idArea"]; }
	if (isset($_POST["idProyecto"])){ $idProyecto = $_POST["idProyecto"]; }
	if (isset($_POST["aniocaptura"])){ $aniocaptura = $_POST["aniocaptura"]; }
 if (isset($_POST["nombrePro"])){ $nombrePro = $_POST["nombrePro"]; }
 if (isset($_POST["idArchivo"])){ $idArchivo = $_POST["idArchivo"]; }
  if (isset($_POST["nombreArch"])){ $nombreArch = $_POST["nombreArch"]; }

		$idUsuario = $_SESSION['useridPoa'];
?>

  <div class="modal-header" style="background-color:#3f5265;">
										        <button type="button" class="close" data-dismiss="modal">&times;</button>
										        <center><h4 class="modal-title" style="color:white; font-weight: bold;"> Subir Seguimiento POA</h4></center>
										      </div>


										      		<div class="col-md-12 col-sm-12 col-xs-12 form-group" style = "background-image: url('img/Fondo 5.png'); background-repeat: repeat;  background-position: center; background-size: 100%; background-position-y: 25%;  ">								      				

										     			
										      <form action="" method="POST" id="form_subir">				
																							
										      						<div>
																							<label  for="message">Selecciona Archivo:</label>
																							<input type="file" name="archivo" id="archivos">
																						</div>			
																					
																								
																						<div>
																							<label  for="message">Observaciónes:</label>
																							<textarea style="resize: none; background-color:rgba(255,255,255,0.7) !important; color: #686D72;" rows="6" name="hechos" id="observaUpload"   class="form-control readonlydear" name="message" placeholder=""></textarea>		<br>
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

												<div class="col-xs-6 col-sm-6 col-md-6"><center><button style="width: 95%;" type="button" class="btn btn-success redondear"  onclick="subirArchivoSeguimientoAgain(<? echo $idArea; ?>, <? echo $idProyecto; ?>, <? echo $mesCapturar; ?>, <? echo $aniocaptura; ?>, <? echo $idUsuario; ?>,'<? echo $nombrePro; ?>', <? echo $idArchivo; ?>, '<? echo $nombreArch; ?>')">Subir</button></center></div>
										       

										        <div class="col-xs-6 col-sm-6 col-md-6"><center><button style="width: 95%;" type="button" class="btn btn-default redondear" data-dismiss="modal">Cancelar</button></center></div>
												  
										</div> 

										<br>