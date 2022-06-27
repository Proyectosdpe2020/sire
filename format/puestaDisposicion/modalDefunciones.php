<?php
    include("../../Conexiones/Conexion.php");
    include("../../funcionesPueDispo.php");
    include("../../sqlPersonas.php");
				$fecha_actual=date("Y-m-d");
				$fecha=strftime( "%Y-%m-%d %H:%M:%S", time() );

				if (isset($_POST["sendIDMando"])){ $idmando = $_POST["sendIDMando"]; }	
				if (isset($_POST["b"])){ $b = $_POST["b"]; }
				if (isset($_POST["idPuestaDisposicion"])){ $idPuestaDisposicion = $_POST["idPuestaDisposicion"]; }
				if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }
				if (isset($_POST["idDefuncion"])){ $idDefuncion = $_POST["idDefuncion"]; }
    /// SE RECIBE LA INFORMACION DE LA PUESTA A DISPOSICION ///
				if (isset($_POST["jObject"])){ $data = json_decode($_POST['jObject'], true);
				$e = 1;
			}else{ $e = 0; }

			$tipoArchov = get_type_archive($conn, $idEnlace);
					$tiparchiv = $tipoArchov[0][0];

							/// SE RECIBE EL ID DE LA DEFUNCION PARA EDITAR ///
			if (isset($_POST["idDefuncion"]) ){ 

				$idDefuncion = $_POST["idDefuncion"]; 
		  //Si se envia $idDefuncion = 0 no es actualizacion, 
				if($idDefuncion != 0){
						$a = 1; // Si a = 1 es actualizacion y se mostraran los datos de la siguiente consulta en este mismo modal
		    $arreglo = get_data_defunciones_puesta($conn, $idPuestaDisposicion , $idDefuncion);
		    $nombre = $arreglo[0][1];
		    $ap_paterno = $arreglo[0][2];
		    $ap_materno = $arreglo[0][3];
		    $edad = $arreglo[0][4];
		    $sexo = $arreglo[0][5];
		    $causaMuerte = $arreglo[0][6];
		    //$movilMuerte = $arreglo[0][7];
		    $observaciones = $arreglo[0][8];
		    $getCausaMuerte = $arreglo[0][9];
		 }else{ 
		 	//Si $idDefuncion viene con valor 0 no es actualizacion y entra aqui
		 	$a = 0;
		 	$idDefuncion = 0;
		 }
		}
	?>



 <div class="modal-header" style="background-color:#152F4A;">
												<center><label style=" color: white; font-weight: bold; font-size: 2rem;">Relación de muertes por diferentes causas</label></center>
											</div>
													<div class="col-md-12 col-sm-12 col-xs-12 form-group panelunoDisposicdo3" >								      				

															<div class="row"  style="padding: 1px;">
																
																<div class="row" style="padding: 20px;"><!-- ROOWWWWWW PRINCIPAL --> 

																		<div class="panel panel-default">
																			<div class="panel-body">

																					     <input type="hidden" id="tipoMOd" value="<?php echo $data[8] ?>" >	
																				    	 <input type="hidden" id="idPuestaDisposicion" value="<?php echo $idPuestaDisposicion ?>" >	
																				    	<!-- DATOS DE LA PUESTA A DISPOSICION EN CASO DE QUE SEA NUEVA -->  

																				    	 <input type="hidden" id="idMandoPuesta" value="<?php echo $data[0]; ?>" >	
																				    		<input type="hidden" id="nucPuestaDisposi" value="<? echo $data[1]; ?>" >	
																				    		<input type="hidden" id="fechaevento" value="<? echo $data[2]; ?>" >	
																				    		<input type="hidden" id="newBrwosers_id_fisca" value="<? echo $data[3]; ?>" >	
																				    		<input type="hidden" id="newBrwosers_id_mun" value="<? echo $data[4]; ?>" >	
																				    		<input type="hidden" id="newBrwosers_id_colo" value="<? echo $data[5]; ?>" >	
																				    		<input type="hidden" id="codepostalidPeusta" value="<? echo $data[6]; ?>" >	
																				    		<input type="hidden" id="calleInputPuesta" value="<? echo $data[7]; ?>" >	
																				    		<input type="hidden" id="numberCallePuesta" value="<? echo $data[8]; ?>" >	


																				    			<input type="hidden" id="uno" value="<? if($e == 1){ echo $data[11]; } ?>" >	
																				    		<input type="hidden" id="dos" value="<? if($e == 1){ echo $data[12]; } ?>" >	
																				    		<input type="hidden" id="tres" value="<? if($e == 1){ echo $data[13]; } ?>" >	
																				    		<input type="hidden" id="cuatro" value="<? if($e == 1){ echo $data[14]; } ?>" >	
																				    		<input type="hidden" id="cinco" value="<? if($e == 1){ echo $data[15]; } ?>" >	
																				    		<input type="hidden" id="narac" value="<? if($e == 1){ echo $data[16]; } ?>" >	

																				    	<!-- DATOS DE LA PUESTA A DISPOSICION EN CASO DE QUE SEA NUEVA -->  
																											<h5 class="text-on-pannel"><strong> Datos del agraviado </strong></h5>
																				<div class="form-row">
																			  	  <div class="form-group col-md-4">
																	      	<label for="textNombreDef">Nombre:<span class="aste">(*)</span></label>	
																								<input value="<?php if($a == 1){ echo $nombre; } ?>" type="text" maxlength="150" onkeypress="return validaInput_puestaDispo(event, 'varchar_letras')" class="form-control" id="textNombreDef" name="textNombreDef">
																	    </div>
																	    <div class="form-group col-md-4">
																	    	<label for="textAp_paternoDef">Apellido paterno:<span class="aste">(*)</span></label>	
																	    	<input value="<?php if($a == 1){ echo $ap_paterno; } ?>" type="text" maxlength="150" onkeypress="return validaInput_puestaDispo(event, 'varchar_letras')" class="form-control" id="textAp_paternoDef" name="textAp_paternoDef">
																	    </div>
																	    <div class="form-group col-md-4">
																	      	<label for="textAp_maternoDef">Apellido materno:<span class="aste">(*)</span></label>	
																								<input value="<?php if($a == 1){ echo $ap_materno; } ?>" type="text" maxlength="150" onkeypress="return validaInput_puestaDispo(event, 'varchar_letras')" class="form-control" id="textAp_maternoDef" name="textAp_maternoDef">
																	    </div>
																	  </div>
																	  	<div class="form-row">
																	  		<div class="form-group col-md-6">
																	      	<label for="textSexoDef">Sexo:<span class="aste">(*)</span></label>	
																								 <select id="textSexoDef" class="form-control" name="textSexoDef">
																								  <option value="0" <?php if($a == 0){?> selected <?php } ?>>Selecciona</option>
																	        <option value="M" <?php if($a == 1 && $sexo == 'Masculino'){?> selected <?php } ?>>Masculino</option>
																	        <option value="F" <?php if($a == 1 && $sexo == 'Femenino'){?> selected <?php } ?>>Femenino</option>
																	        <option value="D" <?php if($a == 1 && $sexo == 'Desconocido'){?> selected <?php } ?>>Desconocido</option>
																	      </select>
																	    </div>
																	     <div class="form-group col-md-6">
																	      	<label for="textEdadDef">Edad:</label>	
																								<input value="<?php if($a == 1){ echo $edad; } ?>" type="number" class="form-control" id="textEdadDef" name="textEdadDef">
																	    </div>
																	  	</div>
																	  		<div class="form-row">
																	  		<div class="form-group col-md-6">
																	  		<div class="demo">
																					    <input type="checkbox" id="acepto" name="acepto" onclick="defuncionDesconocido()" >
																					    <label for="acepto"><span></span>Persona encontrada sin identificar</label>
																					</div>
																				 </div>
																	  	</div>







																			</div>
																	</div>



																															<div class="panel panel-default">
																			<div class="panel-body">

																					     <input type="hidden" id="tipoMOd" value="<?php echo $data[8] ?>" >	
																				    	 <input type="hidden" id="idPuestaDisposicion" value="<?php echo $idPuestaDisposicion ?>" >	
																				    	<!-- DATOS DE LA PUESTA A DISPOSICION EN CASO DE QUE SEA NUEVA -->  

																				    	 <input type="hidden" id="idMandoPuesta" value="<?php echo $data[0]; ?>" >	
																				    		<input type="hidden" id="nucPuestaDisposi" value="<? echo $data[1]; ?>" >	
																				    		<input type="hidden" id="fechaevento" value="<? echo $data[2]; ?>" >	
																				    		<input type="hidden" id="newBrwosers_id_fisca" value="<? echo $data[3]; ?>" >	
																				    		<input type="hidden" id="newBrwosers_id_mun" value="<? echo $data[4]; ?>" >	
																				    		<input type="hidden" id="newBrwosers_id_colo" value="<? echo $data[5]; ?>" >	
																				    		<input type="hidden" id="codepostalidPeusta" value="<? echo $data[6]; ?>" >	
																				    		<input type="hidden" id="calleInputPuesta" value="<? echo $data[7]; ?>" >	
																				    		<input type="hidden" id="numberCallePuesta" value="<? echo $data[8]; ?>" >	


																				    			<input type="hidden" id="uno" value="<? if($e == 1){ echo $data[11]; } ?>" >	
																				    		<input type="hidden" id="dos" value="<? if($e == 1){ echo $data[12]; } ?>" >	
																				    		<input type="hidden" id="tres" value="<? if($e == 1){ echo $data[13]; } ?>" >	
																				    		<input type="hidden" id="cuatro" value="<? if($e == 1){ echo $data[14]; } ?>" >	
																				    		<input type="hidden" id="cinco" value="<? if($e == 1){ echo $data[15]; } ?>" >	
																				    		<input type="hidden" id="narac" value="<? if($e == 1){ echo $data[16]; } ?>" >	

																				    	<!-- DATOS DE LA PUESTA A DISPOSICION EN CASO DE QUE SEA NUEVA -->  
																											<h5 class="text-on-pannel"><strong> Causa de la muerte </strong></h5>
																
																	  	<div class="form-row">
																	  			<div class="form-group col-md-12">
																	  		  	<label for="textCatCausaMuerte">Causa de la muerte:<span class="aste">(*)</span></label>	
																								 <select id="textCatCausaMuerte" class="form-control" name="textCatCausaMuerte">
																								 	<option value="0" >Seleccione</option>
																								   <?php
																	       	  $catCausaMuerte = getDataCausaMuerte($conn);
																	       	  	for ($i = 0; $i < sizeof($catCausaMuerte); $i++){
																	       	  		$idCatCausaMuerte = $catCausaMuerte[$i][0];	$nombre = $catCausaMuerte[$i][1];	?>
																	       	  		<option style="color: black; font-weight: bold;" value="<? echo $idCatCausaMuerte; ?>" <?if($a == 1 && $idCatCausaMuerte == $getCausaMuerte){ ?> selected <? } ?>  ><?echo $nombre ?></option>	
																	       	  <?php } ?>
																	      </select>
																	     </div>
																	    

																	  	</div>



																	  			


																			</div>





																	</div>






																			<div class="panel panel-default">
																			<div class="panel-body">  
																				<h5 class="text-on-pannel"><strong> Otros datos </strong></h5>
																				<div class="form-row">
																	    <div class="form-group col-md-12">
																	       <label for="textObservacionesDefun">Observaciones:</label>	
																								<textarea id="textObservacionesDefun" style="resize: none; height: 20vh; " maxlength="350" onkeypress="return validaInput_puestaDispo(event, 'varchar_letras_numeros')" class="form-control rounded-0" rows="3"><?php if($a == 1){echo $observaciones;} ?></textarea>
																	    </div>
																	   </div>
																	  </div>
																			</div>








																
																		


																			<div id="respuesta"></div>
																	</div><!-- ROOWWWWWW PRINCIPAL --> 
											
														
																</div>		







																</div>
																</div>

										  

									
											  
										<div class="row">
										<div class="col-xs-12 col-sm-12 col-md-6"><center><button style="width: 88%;" onclick="closemodalDefunciones()" type="button" class="btn btn-default redondear" data-dismiss="modal">Salir</button></center></div>
											<div class="col-xs-12 col-sm-12 col-md-6"><center><button style="width: 88%;" onclick="registroDefunciones(<?php echo $idEnlace; ?>, <? echo $tiparchiv; ?>, <? echo $b; ?> , <?php echo $a; ?> , <?php echo $idDefuncion; ?>)" type="button" class="btn btn-primary redondear" >Guardar</button></center></div>					  
									</div> 

										<br>