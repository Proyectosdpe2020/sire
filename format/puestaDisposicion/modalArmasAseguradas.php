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

					$tipoArchov = get_type_archive($conn, $idEnlace);
					$tiparchiv = $tipoArchov[0][0];
    /// SE RECIBE LA INFORMACION DE LA PUESTA A DISPOSICION ///
				if (isset($_POST["jObject"])){ $data = json_decode($_POST['jObject'], true); $e = 1;}else{ $e = 0; }

							/// SE RECIBE EL ID DEL ARMA PARA EDITAR ///
			if (isset($_POST["idArma"]) ){ 

				$idArma = $_POST["idArma"]; 
		  //Si se envia $idArma = 0 no es actualizacion, 
				if($idArma!= 0){
						$a = 1; // Si a = 1 es actualizacion y se mostraran los datos de la siguiente consulta en este mismo modal
		    $arreglo = get_data_armas_puesta($conn, $idPuestaDisposicion , $idArma);
		    $tipo = $arreglo[0][1];
		    $marca = $arreglo[0][2];
		    $calibre = $arreglo[0][3];
		    $accesorio = $arreglo[0][4];
		    $marcaCa = $arreglo[0][5];
		    $observaciones = $arreglo[0][6];
		    $getIDTipoArma = $arreglo[0][7];
		    $getIDMarcaArma = $arreglo[0][8];
		    $getIDCalibre = $arreglo[0][9];
		    $getIDAccesorios = $arreglo[0][10];
		    $getIDMarcaCartuchos = $arreglo[0][11];
		    $matricula = $arreglo[0][12];
		 }else{ 
		 	//Si $idArma viene con valor 0 no es actualizacion y entra aqui
		 	$a = 0;
		 	$idArma = 0;
		 }
		}

	?>



 <div class="modal-header" style="background-color:#152F4A;">
												<center><label style=" color: white; font-weight: bold; font-size: 2rem;">Relación de Armas aseguradas</label></center>
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
																				<h5 class="text-on-pannel"><strong> Datos del arma</strong></h5>
																				<div class="form-row">
																					<div class="form-group col-md-4">
																	      	<label for="textCatTipoArma">Tipo de arma:</label>	
																	      <select class="dataAutocomplet form-control mandda" onchange="getData()" locked="locked" id="textCatTipoArma"
																	      name="textCatTipoArma" type="text" >
																							<option></option>
																							<?php
																	       	  $catTipoArma = getDataTipoArma($conn);
																	       	  	for ($i = 0; $i < sizeof($catTipoArma); $i++){
																	       	  		$idCaTipoArma= $catTipoArma[$i][0];	$nombre = $catTipoArma[$i][1];	?>
																	       	  		<option value="<?php echo $idCaTipoArma; ?>" <?if($a == 1 && $idCaTipoArma == $getIDTipoArma){?>selected <? } ?> ><?echo $nombre; ?></option>	
																	       <?php } ?>
																						 </select>
																	    </div>
																	    <div class="form-group col-md-4">
																		    	<label for="textCatMarcaArma">Marca de arma:</label>	
																		    	<select class="dataAutocomplet form-control mandda" onchange="getData()" locked="locked" id="textCatMarcaArma" name="textCatMarcaArma" type="text">
																		    		<option></option>
																		    		<? $catMarcaArma = getDataMarcaArma($conn);
																		    		for ($i = 0; $i < sizeof($catMarcaArma); $i++){
																	       	  		$idCatMarcaArma = $catMarcaArma[$i][0];	$nombre = $catMarcaArma[$i][1];	?>
																	       	  		<option style="color: black; font-weight: bold;" value="<?php echo $idCatMarcaArma; ?>" <?if($a == 1 && $idCatMarcaArma == $getIDMarcaArma){?>selected <? } ?> ><?echo $nombre; ?></option>	
																	       <?php } ?>
																		    	</select>
																	    </div>
																	    <div class="form-group col-md-4">
																	    	<label for="textCatCalibre">Calibre:</label>	
																	    	<select class="dataAutocomplet form-control mandda" onchange="getData()" locked="locked" id="textCatCalibre" name="textCatCalibre" type="text">
																		    		<option></option>
																		    	 <?php
																	       	  $catCalibre = getDataCatCalibre($conn);
																	       	  	for ($i = 0; $i < sizeof($catCalibre); $i++){
																	       	  		$idCatCalibre= $catCalibre[$i][0];	$nombre = $catCalibre[$i][1];	?>
																	       	  		<option style="color: black; font-weight: bold;" value="<?php echo $idCatCalibre; ?>" <?if($a == 1 && $idCatCalibre == $getIDCalibre){?>selected <? } ?> ><? echo $nombre; ?></option>	
																	       	  <?php } ?>
																		    	</select>
																	    </div>
																	  </div>
																	  	<div class="form-row">
																	  		 <div class="form-group col-md-4">
																	      <label for="textMatricula">Matricula<span class="aste">(*)</span></label>
																	      <input value="<?php if($a == 1){ echo $matricula; } ?>" type="text" class="form-control" id="textMatricula" name="textMatricula">
																	    </div>
																	  		<div class="form-group col-md-4">
																	      	<label for="textCatAccesorioArma">Accesorios asegurados:</label>
																	      	<select class="dataAutocomplet form-control mandda" onchange="getData()" locked="locked" id="textCatAccesorioArma" name="textCatAccesorioArma" type="text">
																		    		<option></option>
																		    	 <?php
																	       	  $catAccesorioArma = getDataAccesorioArma($conn);
																	       	  	for ($i = 0; $i < sizeof($catAccesorioArma); $i++){
																	       	  		$idCatAccesorioArma= $catAccesorioArma[$i][0];	$nombre = $catAccesorioArma[$i][1];	?>
																	       	  		<option style="color: black; font-weight: bold;" value="<?php echo $idCatAccesorioArma; ?>" <?if($a == 1 && $idCatAccesorioArma == $getIDAccesorios){?>selected <? } ?> ><? echo $nombre; ?></option>	
																	       <?php } ?>
																		    	</select>	
																	    </div>
																	     <div class="form-group col-md-4">
																	      	<label for="textCatMarcaCartuchos">Marca de cartuchos:</label>
																	      	<select class="dataAutocomplet form-control mandda" onchange="getData()" locked="locked" id="textCatMarcaCartuchos" name="textCatMarcaCartuchos" type="text">
																		    		<option></option>
																		    	 <?php
																	       	  $catMarcaCartuchos = getDataMarcaCartuchos($conn);
																	       	  	for ($i = 0; $i < sizeof($catMarcaCartuchos); $i++){
																	       	  		$idCatMarcaCartuchos = $catMarcaCartuchos[$i][0];	$nombre = $catMarcaCartuchos[$i][1];	?>
																	       	  		<option style="color: black; font-weight: bold;" value="<?php echo $idCatMarcaCartuchos; ?>" <?if($a == 1 && $idCatMarcaCartuchos == $getIDMarcaCartuchos){?>selected <? } ?>><? echo $nombre; ?></option>	
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
																	       <label for="textObservacionesArmas">Observaciones:</label>	
																								<textarea id="textObservacionesArmas" style="resize: none; height: 20vh; " class="form-control rounded-0" rows="3"><?php if($a == 1){ echo  $observaciones; } ?></textarea>
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
										<div class="col-xs-12 col-sm-12 col-md-6"><center><button style="width: 88%;" onclick="closemodalArmasAseguradas()" type="button" class="btn btn-default redondear" data-dismiss="modal">Salir</button></center></div>
											<div class="col-xs-12 col-sm-12 col-md-6"><center><button style="width: 88%;" onclick="registroArmasAseguradas(<?php echo $idEnlace; ?>, <? echo $tiparchiv; ?>, <? echo $b; ?> , <?php echo $a; ?> , <?php echo $idArma; ?>)" type="button" class="btn btn-primary redondear" >Guardar</button></center></div>					  
									</div> 

										<br>