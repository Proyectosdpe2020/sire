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
    /// SE RECIBE LA INFORMACION DE LA PUESTA A DISPOSICION ///
				if (isset($_POST["jObject"])){ 
					$data = json_decode($_POST['jObject'], true);
					 $e = 1;
				}else{ $e = 0; }

					$tipoArchov = get_type_archive($conn, $idEnlace);
					$tiparchiv = $tipoArchov[0][0];

								/// SE RECIBE EL ID DEL LA DROGA PARA EDITAR ///
			if (isset($_POST["idDroga"]) ){ 

				$idDroga = $_POST["idDroga"]; 
		  //Si se envia $idDroga = 0 no es actualizacion, 
				if($idDroga!= 0){
						$a = 1; // Si a = 1 es actualizacion y se mostraran los datos de la siguiente consulta en este mismo modal
		    $arreglo = get_data_drog_puesta($conn, $idPuestaDisposicion , $idDroga);
		    $nombre = $arreglo[0][1];
		    $kilogramos = $arreglo[0][2];
		    $observaciones = $arreglo[0][3];
		 }else{ 
		 	//Si $idTrabajoCampo viene con valor 0 no es actualizacion y entra aqui
		 	$a = 0;
		 	$idDroga = 0;
		 }
		}

	?>



 <div class="modal-header" style="background-color:#152F4A;">
												<center><label style=" color: white; font-weight: bold; font-size: 2rem;">Droga</label></center>
											</div>
													<div class="col-md-12 col-sm-12 col-xs-12 form-group panelunoDisposicdo2" >								      				

															<div class="row"  style="padding: 1px;">
																
																<div class="row" style="padding: 20px;"><!-- ROOWWWWWW PRINCIPAL --> 

																	<form onsubmit="return false" action="return false">
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
																				<h5 class="text-on-pannel"><strong> Droga asegurada </strong></h5>
																				<div class="form-row">
																	    <div class="form-group col-md-6">
																	      <label for="textCatDroga">Tipo de droga<span class="aste">(*)</span></label>
																	       <input value="<?php if($a == 1){ echo $nombre; } ?>" class="form-control" onchange="getData()" list="listaCatDroga" id="textCatDroga" 
																									        name="textCatDroga" type="text">
																	       <datalist id="listaCatDroga">
																	       	  <?php
																	       	  $catDrogas = getDataDrogas($conn);
																	       	  	for ($i = 0; $i < sizeof($catDrogas); $i++){
																	       	  		$idCatDrogas = $catDrogas[$i][0];	$nombre = $catDrogas[$i][1];	?>
																	       	  		<option style="color: black; font-weight: bold;" value="<?php echo $nombre; ?>" 
																	       	  			data-value="<? echo $idCatDrogas; ?>" data-id="<? echo $idCatDrogas; ?>" ></option>	
																	       	  <?php } ?>
																									 </datalist>
																	    </div>
																	    <div class="form-group col-md-6">
																	      <label for="textKilogramos">Gramos<span class="aste">(*)</span></label>
																	      <input value="<?php if($a == 1){ echo $kilogramos; } ?>" type="text" class="form-control" id="textKilogramos" name="textKilogramos">
																	    </div>
																	  
																	  </div>
																			</div>
																	</div>

																			<div class="panel panel-default">
																			<div class="panel-body">  
																				<h5 class="text-on-pannel"><strong> Otros datos </strong></h5>
																				<div class="form-row">
																	    <div class="form-group col-md-12">
																	     <label for="textObservacionesDrog">Observaciones</label>
																	     <textarea id="textObservacionesDrog" class="form-control rounded-0" style="resize: none; height: 30vh;" id="textObservacionesDrog" rows="3"><?php if($a == 1){ echo $observaciones; } ?></textarea>
																				 </div>
																	   </div>
																	  </div>
																			</div>
																			<div id="respuesta"></div>
																	</div><!-- ROOWWWWWW PRINCIPAL --> 
											
																</form>
																</div>										
																</div>
																</div>

															</div>
										  

													</div>
											  
									<div class="row">
										<div class="col-xs-12 col-sm-12 col-md-6"><center><button style="width: 88%;" onclick="closemodalDrogas()" type="button" class="btn btn-default redondear" data-dismiss="modal">Salir</button></center></div>
											<div class="col-xs-12 col-sm-12 col-md-6"><center><button style="width: 88%;" onclick="registrarDrogas(<?php echo $idEnlace; ?>, <? echo $tiparchiv; ?>, <? echo $b; ?>, <?php echo $a; ?> , <?php echo $idDroga; ?>)" type="button" class="btn btn-primary redondear" >Guardar</button></center></div>					  
									</div> 

										<br>