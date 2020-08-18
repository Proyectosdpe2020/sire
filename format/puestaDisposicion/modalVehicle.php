
	<?php

				include ("../../Conexiones/Conexion.php");
				include("../../funcionesPueDispo.php");	

						
				$t = 0;
				if (isset($_POST["idPuestaDisposicion"])){ $idPuestaDisposicion = $_POST["idPuestaDisposicion"]; }
				if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }
				if (isset($_POST["idVeicle"])){ $idVeicle = $_POST["idVeicle"]; }
				if (isset($_POST["b"])){ $b = $_POST["b"]; }
				if (isset($_POST["typeForm"])){ $typeForm = $_POST["typeForm"]; }
			
			
			if($typeForm == 1){

								$dataveiclearray = get_data_veicle($conn, $idVeicle, $idPuestaDisposicion);
								$t = 1;
				}
				 
					if (isset($_POST["jObject"])){ 

							 $data = json_decode($_POST['jObject'], true);
							 $e = 1;
					}else{ $e = 0; }

					$tipoArchov = get_type_archive($conn, $idEnlace);
					$tiparchiv = $tipoArchov[0][0];

										/// SE RECIBE EL ID DEL VEHICULO PARA EDITAR ///
			if (isset($_POST["idVeicle"]) ){ 

				$idVeicle = $_POST["idVeicle"]; 
		  //Si se envia $idVeicle = 0 no es actualizacion, 
				if($idVeicle!= 0){
						$a = 1; // Si a = 1 es actualizacion y se mostraran los datos de la siguiente consulta en este mismo modal
		    $arreglo = get_data_vehi_puesta($conn, $idPuestaDisposicion , $idVeicle);
		    $clasificacion = $arreglo[0][1];
		    $aseguramiento = $arreglo[0][2];
		    $delito = $arreglo[0][3];
		    $tipoDelito = $arreglo[0][4];
		    $marca = $arreglo[0][5];
		    $linea = $arreglo[0][6];
		    $tipo = $arreglo[0][7];
		    $color = $arreglo[0][8];
		    $modelo = $arreglo[0][9];
		    $placa = $arreglo[0][10];
		    $serie = $arreglo[0][11];
		    $motor = $arreglo[0][12];
		    $serieAlterada = $arreglo[0][13];
		    $motorAlterado = $arreglo[0][14];
		    $requeridoOtrasCorpor = $arreglo[0][15];
		    $oficio = $arreglo[0][16];
		    $observaciones = $arreglo[0][17];
		    $requeridoPor = $arreglo[0][18];
		    $avppcarpeta = $arreglo[0][19];
		    $disposicion = $arreglo[0][20];
		    $marcaVehiculoID = $arreglo[0][21];

		    // OBTENER ID DE MUNICIPIO Y COLONIA APARTIR DE LA PUESTA Y LA FISCALIA

						$lineas = getDataLineaVehicle($conn,  $marcaVehiculoID);

		 }else{ 
		 	//Si $idVeicle viene con valor 0 no es actualizacion y entra aqui
		 	$a = 0;
		 	$idVeicle = 0;
		 }
		}

		
   

	?>
 <div class="modal-header" style="background-color:#152F4A;">
												<center><label style=" color: white; font-weight: bold; font-size: 1.8rem;">Vehículo Asegurado</label></center>			
											  </div>
													<div class="col-md-12 col-sm-12 col-xs-12 form-group panelunoDisposic" >								   															
															<div class="row"  style="padding: 1px;">																
																<div class="row" style="padding: 30px;"><!-- ROOWWWWWW PRINCIPAL -->   	
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

																				    		<input type="hidden" id="uno" value="<? if($e == 1){ echo $data[10]; } ?>" >	
																				    		<input type="hidden" id="dos" value="<? if($e == 1){ echo $data[11]; } ?>" >	
																				    		<input type="hidden" id="tres" value="<? if($e == 1){ echo $data[12]; } ?>" >	
																				    		<input type="hidden" id="cuatro" value="<? if($e == 1){ echo $data[13]; } ?>" >	
																				    		<input type="hidden" id="cinco" value="<? if($e == 1){ echo $data[14]; } ?>" >	
																				    		<input type="hidden" id="narac" value="<? if($e == 1){ echo $data[15]; } ?>" >	


																				    	<!-- DATOS DE LA PUESTA A DISPOSICION EN CASO DE QUE SEA NUEVA -->  


																				      <h5 class="text-on-pannel"><strong> Datos Generales </strong></h5>																				       
																				      <div class="row">																				      	
																				      					<div class="col-xs-4">
																				      							<label class="" for="inputlg">Clasificación :<span class="aste">(*)</span></label>
			    																											<select class="form-control browser-default custom-select " id="selClasific">		
			    																												<option value="0">Selecciona</option>																								  
																																	  		<? 
																																						$clasif = getClasificacionVehicle($conn);
																																						for ($f=0; $f < sizeof($clasif); $f++) { 					

																																									$idClas = $clasif[$f][0];	$nombre = $clasif[$f][1];	?>
																																											<option style="color: black; font-weight: bold;" value="<? echo $idClas; ?>" <?php if($a == 1 && $clasificacion == $nombre ){?> selected <?php } ?> ><? echo $nombre; ?></option>
																																									<?
																																						}
																																			 ?>
																																	</select>
																				      					</div>
																				      					<div class="col-xs-4">
																				      								<label class="" for="inputlg">Forma de Aseguramiento :<span class="aste">(*)</span></label>
			    																											<select class="form-control browser-default custom-select" id="selFormAsegur">	
			    																												<option value="0">Selecciona</option>																										  
																																	  	<? 
																																						$formaseg = getFormAsegurVehicle($conn);
																																						for ($d=0; $d < sizeof($formaseg); $d++) { 					

																																									$idAegura = $formaseg[$d][0];	$nombre = $formaseg[$d][1];	?>
																																											<option style="color: black; font-weight: bold;" value="<? echo $idAegura; ?>" <?php if($a == 1 && $aseguramiento == $nombre ){?> selected <?php } ?> ><? echo $nombre; ?></option>
																																									<?
																																						}
																																			 ?>
																																	</select>
																				      					</div>
																				      							<div class="col-xs-4">
																				      								<label class="" for="inputlg">AVPP / NUC / Carpeta :</label>
			    																													<input value="<?php if($a == 1){ echo $avppcarpeta; } ?>" class="form-control input-md redondear " id="nucVehiculo" type="text"  >
																				      					</div>
																				      </div>
																				        <div class="row" style="margin-top: 10px;">																				      	
																				      					<div class="col-xs-6">
																				      							<label class="" for="inputlg">A Disposición de :<span class="aste">(*)</span></label>
			    																											<select class="form-control browser-default custom-select" id="selAdispo">																									  
																																	  	<option value="0">Selecciona</option>																										  
																																	  	<? 
																																						$dipos = getDisposicVehicle($conn);
																																						for ($d=0; $d < sizeof($dipos); $d++) { 					

																																									$iddispo = $dipos[$d][0];	$nombre = $dipos[$d][1];	?>
																																											<option style="color: black; font-weight: bold;" value="<? echo $iddispo; ?>" <?php if($a == 1 && $disposicion == $nombre ){?> selected <?php } ?> ><? echo $nombre; ?></option>
																																									<?
																																						}
																																			 ?>																													
																																	 </select>
																				      					</div>
																				      					<div class="col-xs-6">
																				      								<label class="" for="inputlg">Requerido por :</label>
			    																												<input value="<?php if($a == 1){ echo $requeridoPor; } ?>" class="form-control input-md redondear " id="requeridoPorVehi" type="text"  >
																				      					</div>
																				      </div>
																				         <div class="row" style="margin-top: 10px;">																				      	
																				      					<div class="col-xs-6">
																				      							<label class="" for="inputlg">Delito :<span class="aste">(*)</span></label>
			    																									<select class="form-control browser-default custom-select " id="selDelito">																											  
																																	  	<option value="0">Selecciona</option>																										  
																																	  	<? 
																																						$deli = getDelitoVehicle($conn);
																																						for ($d=0; $d < sizeof($deli); $d++) { 					

																																									$iddelit = $deli[$d][0];	$nombre = $deli[$d][1];	?>
																																											<option style="color: black; font-weight: bold;" value="<? echo $iddelit; ?>" <?php if($a == 1 && $delito == $nombre ){?> selected <?php } ?> ><? echo $nombre; ?></option>
																																									<?
																																						}
																																			 ?>		
																																	</select>
																				      					</div>
																				      					<div class="col-xs-6">
																				      								<label class="" for="inputlg">Tipo en Delito :<span class="aste">(*)</span></label>
			    																												<select class="form-control browser-default custom-select " id="selTipoDelito">																								  
																																	  

			    																																			<option value="0">Selecciona</option>																										  
																																	  	<? 
																																						$delitieoen = getTipoEnDelitoVehicle($conn);
																																						for ($d=0; $d < sizeof($delitieoen); $d++) { 					

																																									$iddeliten = $delitieoen[$d][0];	$nombre = $delitieoen[$d][1];	?>
																																											<option style="color: black; font-weight: bold;" value="<? echo $iddeliten; ?>" <?php if($a == 1 && $tipoDelito == $nombre ){?> selected <?php } ?> ><? echo $nombre; ?></option>
																																									<?
																																						}
																																			 ?>


																																	  </select>
																				      					</div>
																				      </div>		
																				    </div>
																				  </div>

																				    <div class="panel panel-default">
																				    <div class="panel-body">
																				      <h5 class="text-on-pannel"><strong> Vehículo </strong></h5>
																				       
																				      <div class="row">
																				      	
																				      					<div class="col-xs-4">
																				      								<datalist id="newMarcas">
																																			<? 
																																						$marcas = getDataMarcaVehicle($conn);
																																						for ($h=0; $h < sizeof($marcas); $h++) { 																																						
																																									$idMarc = $marcas[$h][0];	$nom = $marcas[$h][1];	?>
																																											<option style="color: black; font-weight: bold;" value="<? echo $nom; ?>" data-value="<? echo $idMarc; ?>" data-id="<? echo $idMarc; ?>"></option>
																																									<?
																																						}
																																			 ?>
																															</datalist>
																																		<label for="heard">Marca : <span class="aste">(*)</span></label>	
																															<input value="<?php if($a == 1){ echo $marca; } ?>" class="form-control mandda " onchange="getDataLinea()" list="newMarcas" id="newMarca" name="newMarca" type="text">
																				      					</div>
																				      					<div class="col-xs-4">
																				      						<label for="heard">Linea : <span class="aste">(*)</span></label>	
																				      								<div id="conteLinea">
			    																															
			    																															<datalist id="newLineas">
			    																																	<option style="color: black; font-weight: bold;" value="<? echo $linea; ?>" data-value="<? echo $lineas[0][0]; ?>" data-id="<? echo $lineas[0][0]; ?>"></option>
			    																																	</datalist>
			    																																	<input value="<? if($a == 1){ echo $linea;; } ?>" class="form-control mandda " onchange="" list="newLineas" id="newLinea" name="newLinea" type="text">

			    																												</div>
																				      					</div>
																				      						<div class="col-xs-4">
																				      									<datalist id="newTypeVehicles">
																																			<? 
																																						$types = getDataTypeVehicle($conn);
																																						for ($g=0; $g < sizeof($types); $g++) { 																																						
																																									$idType = $types[$g][0];	$nom = $types[$g][1];	?>
																																											<option style="color: black; font-weight: bold;" value="<? echo $nom; ?>" data-value="<? echo $idType; ?>" data-id="<? echo $idType; ?>"></option>
																																									<?
																																						}
																																			 ?>
																															</datalist>
																																		<label for="heard">Tipo : <span class="aste">(*)</span></label>	
																															<input value="<?php if($a == 1){ echo $tipo; } ?>" class="form-control mandda " onchange="" list="newTypeVehicles" id="newTypeMarca" name="newTypeMarca" type="text">
																				      					</div>
																				      </div>
																				        <div class="row" style="margin-top: 10px;">
																				      	
																				      					<div class="col-xs-4">
																				      							<label class="" for="inputlg">Color :</label>
			    																								<input value="<?php if($a == 1){ echo $color; } ?>" class="form-control input-md redondear " id="colorVehi" type="text"  >
																				      					</div>
																				      					<div class="col-xs-4">
																				      								<label class="" for="inputlg">Modelo :</label>
			    																												<input value="<?php if($a == 1){ echo $modelo; } ?>" class="form-control input-md redondear " id="modeloVehi" type="number"  >
																				      					</div>
																				      						<div class="col-xs-4">
																				      								<label class="" for="inputlg">Placa :</label>
			    																											<input value="<?php if($a == 1){ echo $placa; } ?>" class="form-control input-md redondear " id="placaVehi" type="text"  >
																				      					</div>
																				      </div>
																				       <div class="row" style="margin-top: 10px;">
																				      	
																				      					<div class="col-xs-6">
																				      							<label class="" for="inputlg">Serie :</label>
			    																								<input value="<?php if($a == 1){ echo $serie; } ?>" class="form-control input-md redondear " id="serieVehi" type="text"  >
																				      					</div>
																				      					<div class="col-xs-6">
																				      								<label class="" for="inputlg">Serie Alterada :</label>
			    																												<input value="<?php if($a == 1){ echo $serieAlterada; } ?>" class="form-control input-md redondear " id="serieAlVehi" type="text"  >
																				      					</div>
																				      </div>
																				       								
																				       								 <div class="row" style="margin-top: 10px;">
																				      	
																				      					<div class="col-xs-6">
																				      							<label class="" for="inputlg">Motor :</label>
			    																								<input value="<?php if($a == 1){ echo $motor; } ?>" class="form-control input-md redondear " id="motorVehi" type="text"  >
																				      					</div>
																				      					<div class="col-xs-6">
																				      								<label class="" for="inputlg">Motor Alterado :</label>
			    																												<input value="<?php if($a == 1){ echo $motorAlterado; } ?>" class="form-control input-md redondear " id="motorAlVehi" type="text"  >
																				      					</div>
																				      </div>
																				       								
																				       														    	

																				    </div>
																				  </div>



																				    <div class="panel panel-default">
																				    <div class="panel-body">
																				      <h5 class="text-on-pannel"><strong> Otros Datos </strong></h5>																				       
																				      <div class="row">																				      	
																				      					<div class="col-xs-6">
																				      							<label class="" for="inputlg">Requerido por Otras Corporaciones :</label>
			    																								<input value="<?php if($a == 1){ echo $requeridoOtrasCorpor; } ?>" class="form-control input-md redondear " id="requeOtroCopro" type="text"  >
																				      					</div>
																				      					<div class="col-xs-6">
																				      								<label class="" for="inputlg">Oficio :</label>
			    																											<input value="<?php if($a == 1){ echo $oficio; } ?>" class="form-control input-md redondear " id="oficioVehi" type="text"  >
																				      					</div>
																				      </div>
																				        <div class="row" style="margin-top: 10px;">
																				      	
																				      					<div class="col-xs-12">
																				      							<label class="" for="inputlg">Observaciones :</label>
			    																										<div class="form-group">
																																  <textarea class="form-control rounded-0" id="observaVehi" rows="3"><?php if($a == 1){ echo $observaciones; } ?></textarea>
																																</div>		
																				      					</div>

																				      </div>																	    	

																				    </div>
																				  </div>

																				  	<div id="respuestsGUdradoVEhiculo"></div>


																					

																	</div> <!-- ROOWWWWWW PRINCIPAL -->


																</div>										

																</div>
																</div>

															</div>
											  

													</div>
											  


										<div class="row">

									
												<div class="col-xs-12 col-sm-12 col-md-6"><center><button style="width: 88%;" onclick="salirVehicle()" type="button" class="btn btn-default redondear" data-dismiss="modal">Salir</button></center></div>
												<div class="col-xs-12 col-sm-12 col-md-6"><center><button style="width: 88%;" onclick="saveVehicle(<? echo $idEnlace; ?>, <? echo $tiparchiv; ?>, <? echo $b; ?>, <?php echo $a; ?> , <?php echo $idVeicle; ?>)" type="button" class="btn btn-success redondear" >Guardar</button></center></div>
												  
										</div> 

										<div id="respuestsGUdradoVEhiculo"></div>

										<br>