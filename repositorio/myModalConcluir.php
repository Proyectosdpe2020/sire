<? 
 session_start();
	if (isset($_POST["idArchivo"])){ $idArchivo = $_POST["idArchivo"]; }

		if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }
	if (isset($_POST["mes"])){ $mes = $_POST["mes"]; }
	if (isset($_POST["anio"])){ $anio = $_POST["anio"]; }

		if (isset($_POST["tipo"])){ $tipo = $_POST["tipo"]; }

	$idUsuario = $_SESSION['useridIE'];
?>
   												
  
   												
   														  <div class="modal-header" style="background-color:#3f5265;">
												        <center><h4 class="modal-title" style="color:white; font-weight: bold;"> Concluir Formato Estadístico</h4></center>
												      	</div>


												      	<div class="col-md-12 col-sm-12 col-xs-12 form-group degEdit3">				

												      				<label  for="message">Observaciónes:</label>
																							<textarea style="resize: none; background-color:rgba(255,255,255,0.7) !important; color: #686D72;" rows="6" name="hechos" id="obserConcluirArchivoa"   class="form-control readonlydear" name="message" placeholder=""></textarea>	
																								
																								<label  for="message">Cambiar estado:</label>
																								<select id="selectEstadoArchivoa" name="selMes" onchange="" style="color:#78858B; font-weight:; background-color:rgba(255,255,255,0.6);" class="form-control redondear" required>
																								<option value="0" selected>Selecciona</option>
																								<option value="rec" >Recibido</option>
																								<option value="rac" >Rechazado</option>
																							</select>


												      	</div>

												      		<div class="row">

																					<div class="col-xs-6 col-sm-6 col-md-6"><center><button style="width: 95%;"  type="button" class="btn btn-info redondear"  onclick="guardarConcluirRevision(<? echo $idArchivo; ?>, <? echo $idUsuario; ?>, <? echo $idEnlace; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $tipo; ?>);">Guardar</button></center></div>
										       

										      			  <div class="col-xs-6 col-sm-6 col-md-6"><center><button style="width: 95%;" type="button" class="btn btn-default redondear" onclick="cancelarBoton()">Cancelar</button></center><br></div><

										      			  <div id="respueastaConcluir"></div>
												  
																		</div> 

