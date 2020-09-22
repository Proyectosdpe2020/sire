<?php
    include("../../Conexiones/Conexion.php");
    include("../../funcionesPueDispo.php");
    include("../../sqlPersonas.php");
				$fecha_actual=date("Y-m-d");
				$fecha=strftime( "%Y-%m-%d %H:%M:%S", time() );

				if (isset($_POST["sendIDMando"])){ $idmando = $_POST["sendIDMando"]; }	

				if (isset($_POST["idPuestaDisposicion"])){ $idPuestaDisposicion = $_POST["idPuestaDisposicion"]; }
					if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }
  					if (isset($_POST["b"])){ $b = $_POST["b"]; }
				 if (isset($_POST["jObject"])){ 

							 $data = json_decode($_POST['jObject'], true);
							 $e = 1;
					}else{ $e = 0; }

/*

      if (isset($_POST["idPersona"])){ 

      	$idPersona = $_POST["idPersona"]; 
      	$a = 1;

      	$dataPersonas = get_data_persona_puesta($conn, $idPuestaDisposicion, $idPersona);

      }else{
              $idPersona = "";
              $a =0;
      } 
*/

      			$tipoArchov = get_type_archive($conn, $idEnlace);
					$tiparchiv = $tipoArchov[0][0];

							/// SE RECIBE EL ID DEL LA PERSONA DETENIDA PARA EDITAR ///
			if (isset($_POST["idPersona"]) ){ 

				$idPersona = $_POST["idPersona"]; 
		  //Si se envia $idDroga = 0 no es actualizacion, 
				if($idPersona!= 0){
						$a = 1; // Si a = 1 es actualizacion y se mostraran los datos de la siguiente consulta en este mismo modal
		    $arreglo = get_data_person_puesta($conn, $idPuestaDisposicion , $idPersona);
		    $orgCriminalPertenece = $arreglo[0][5];
		    $nombre = $arreglo[0][6];
		    $ap_paterno = $arreglo[0][7];
		    $ap_materno = $arreglo[0][8];
		    $alias = $arreglo[0][2];
		    $edad = $arreglo[0][3];
		    $sexo = $arreglo[0][4]; 
		    $delitoPrincipal = $arreglo[0][9];
		    $fechaDetencion = $arreglo[0][11];
		    $bandas = $arreglo[0][10]; 
		    $agraviado = $arreglo[0][12]; 
		    $invFlag = $arreglo[0][13]; 
		    $bandaSolit = $arreglo[0][14];
		    $avPP = $arreglo[0][15];
		    $numdBas = $arreglo[0][16];
		    $aDispoDe = $arreglo[0][17];
		    $reqOtrasCorpo = $arreglo[0][18];
		    $oficio = $arreglo[0][19];
		    $observaciones = $arreglo[0][20];
     
		 }else{ 
		 	//Si $idPersona viene con valor 0 no es actualizacion y entra aqui
		 	$a = 0;
		 	$idPersona = 0;
		 }
		}
      
      

	?>

<style>

.tbl-qa{width: 98%;font-size:0.9em;background-color: #f5f5f5;}
.tbl-qa th.table-header {padding: 5px;text-align: left;padding:10px;}
.tbl-qa .table-row td {padding:10px;background-color: #FDFDFD;}
.ajax-action-links {color: #09F; margin: 10px 0px;cursor:pointer;}
.ajax-action-button {border:#094 1px solid;color: #09F; margin: 10px 0px;cursor:pointer;display: inline-block;padding: 10px 20px;}
</style>

 <div class="modal-header" style="background-color:#152F4A;">
												<center><label style=" color: white; font-weight: bold; font-size: 2rem;">Persona detenida</label></center>
								
											  </div>
													<div class="col-md-12 col-sm-12 col-xs-12 form-group panelunoDisposicdo" >								      				

															<div class="row"  style="padding: 1px;">
																
																<div class="row" style="padding: 20px;"><!-- ROOWWWWWW PRINCIPAL --> 
																	<form onsubmit="return false" action="return false">
																		<div class="panel panel-default">
																			<div class="panel-body">

																										<input type="hidden" id="idPersona" value="<?php if($a == 1){ echo $idPersona; } ?>" >	
																					     <input type="hidden" id="tipoMOd" value="<?php if($e == 1){ echo $data[9]; } ?>" >	
																				    	 <input type="hidden" id="idPuestaDisposicion" value="<?php echo $idPuestaDisposicion ?>" >	
																				    	<!-- DATOS DE LA PUESTA A DISPOSICION EN CASO DE QUE SEA NUEVA -->  

																				    	 <input type="hidden" id="idMandoPuesta" value="<?php if($e == 1){ echo $data[0]; } ?>" >	
																				    		<input type="hidden" id="nucPuestaDisposi" value="<? if($e == 1){ echo $data[1]; }?>" >	
																				    		<input type="hidden" id="fechaevento" value="<? if($e == 1){ echo $data[2]; } ?>" >	
																				    		<input type="hidden" id="newBrwosers_id_fisca" value="<? if($e == 1){ echo $data[3]; } ?>" >	
																				    		<input type="hidden" id="newBrwosers_id_mun" value="<? if($e == 1){ echo $data[4]; } ?>" >	
																				    		<input type="hidden" id="newBrwosers_id_colo" value="<? if($e == 1){ echo $data[5]; } ?>" >	
																				    		<input type="hidden" id="codepostalidPeusta" value="<? if($e == 1){ echo $data[6]; } ?>" >	
																				    		<input type="hidden" id="calleInputPuesta" value="<? if($e == 1){ echo $data[7]; } ?>" >	
																				    		<input type="hidden" id="numberCallePuesta" value="<? if($e == 1){ echo $data[8]; } ?>" >	

																				    		<input type="hidden" id="uno" value="<? if($e == 1){ echo $data[10]; } ?>" >	
																				    		<input type="hidden" id="dos" value="<? if($e == 1){ echo $data[11]; } ?>" >	
																				    		<input type="hidden" id="tres" value="<? if($e == 1){ echo $data[12]; } ?>" >	
																				    		<input type="hidden" id="cuatro" value="<? if($e == 1){ echo $data[13]; } ?>" >	
																				    		<input type="hidden" id="cinco" value="<? if($e == 1){ echo $data[14]; } ?>" >	
																				    		<input type="hidden" id="narac" value="<? if($e == 1){ echo $data[15]; } ?>" >	

																				    	<!-- DATOS DE LA PUESTA A DISPOSICION EN CASO DE QUE SEA NUEVA -->  
																				<h5 class="text-on-pannel"><strong> Datos generales del detenido </strong></h5>
																				<div class="form-row">
																	    <div class="form-group col-md-4">
																	      <label for="textNombre">Nombre<span class="aste">(*)</span></label>
																	      <input value="<?php if($a == 1){ echo $nombre; } ?>" type="text" class="form-control" id="textNombre" name="txtNombre">
																	    </div>
																	    <div class="form-group col-md-4">
																	      <label for="textApPaterno">Apellido paterno<span class="aste">(*)</span></label>
																	      <input value="<?php if($a == 1){ echo $ap_paterno; } ?>" type="text" class="form-control" id="textApPaterno" name="textApPaterno">
																	    </div>
																	    <div class="form-group col-md-4">
																	      <label for="textApMaterno">Apellido materno<span class="aste">(*)</span></label>
																	      <input value="<?php if($a == 1){ echo $ap_materno; } ?>" type="text" class="form-control" id="textApMaterno" name="textApMaterno">
																	    </div>
																	  </div>
																	  <div class="form-row">
																	    <div class="form-group col-md-3">
																	      <label for="textAlias">Alias</label>
																	      <input value="<?php if($a == 1){ echo $alias; } ?>" type="text" class="form-control" id="textAlias" name="textAlias" >
																	    </div>
																	    <div class="form-group col-md-3">
																	      <label for="textEdad">Edad<span class="aste">(*)</span></label>
																	      <input value="<?php if($a == 1){ echo $edad; } ?>" type="number" class="form-control" id="textEdad" name="textEdad">
																	    </div>
																	     <div class="form-group col-md-3">
																	      <label for="textSexo">Sexo<span class="aste">(*)</span></label>
																	      <select id="textSexo" class="form-control" name="textSexo">
																	      	  <option value="N/E">Selecciona</option>
																	         <option value="M" <?php if($a == 1 && $sexo == "Masculino"){ ?> selected <? } ?> >Masculino</option>
																	         <option value="F" <?php if($a == 1 && $sexo == "Femenino"){ ?> selected <? } ?> >Femenino</option>
																	      </select>
																	    </div>
																	    <div class="form-group col-md-3">
																	    	<label for="heard">Fecha de detención:<span class="aste">(*)</span></label>
																									<div >
																               <input class="form-control gehit" type="date" id="fechaDetencion" name="trip-start" 
																               value="<? if($a == 1){ echo $fechaDetencion; }else{ echo $fecha_actual; } ?>" >
																            </div>
																						</div>
																	  </div>
																			</div>
																	</div>

																				<div class="panel panel-default">
																			<div class="panel-body">
																				<h5 class="text-on-pannel"><strong> Delitos cometidos </strong></h5>
																				<div class="form-row">
																				<div class="form-group col-md-12">
																					<label for="textRequerido">Delito principal<span class="aste">(*)</span></label>

																					<table class="tbl-qa table table-bordered">
																				  <thead>
																					<tr>
																					  <th class="table-header">#</th>
																					  <th class="table-header">Tipo de delíto</th>
																					  <!--<th class="table-header">Acciones</th>-->
																					</tr>
																				  </thead>
																				  <tbody id="table-body-DelitoPrincipal">
																				
																					  <tr class="table-row" id="table-row-<?php echo $posts[$k]["id"]; ?>">
																						<td contenteditable="false" onBlur="saveToDatabase(this,'id','<?php echo $posts[$k]["id"]; ?>')" onClick="editRow(this);">1</td>      
																						<td contenteditable="true" onBlur="saveToDatabase(this,'articulo_titulo','<?php echo $posts[$k]["id"]; ?>')" onClick="editRow(this);">
																						<input value="<?php if($a == 1){ echo $delitoPrincipal; } ?>" class="form-control" onchange="getData()" list="listaCatDelitos" id="textTipoDelito" name="textTipoDelito" type="text">										        
																	       <datalist id="listaCatDelitos">
																	       	  <?php
																	       	  $catDelitos = getDataDelitos($conn);
																	       	  	for ($i = 0; $i < sizeof($catDelitos); $i++){
																	       	  		$idCatTipoDelito =  $catDelitos[$i][0];	$nombreDeli = $catDelitos[$i][1];	?>
																	       	  		<option style="color: black; font-weight: bold;" value="<?php echo $nombreDeli; ?>" 
																	       	  			data-value="<? echo $idCatTipoDelito; ?>" data-id="<? echo $idCatTipoDelito; ?>" ></option>	
																	       	  <?php } ?>
																									 </datalist>
																						</td>
																						
																						<!--<td><a class="ajax-action-links" onclick="#">Cancelar</a></td>-->
																					  </tr>
																				  </tbody>
																				</table>

																				</div>

																	    <div class="form-group col-md-12">
																	      <label for="textOficio">Delito secundario</label>

																	      <table class="tbl-qa table table-bordered">
																				  <thead>
																					<tr>
																					  <th class="table-header">#</th>
																					  <th class="table-header">Tipo de delíto</th>
																					  <th class="table-header">Acciones</th>
																					</tr>
																				  </thead>
																				  <tbody id="table-body">
																					<?php if($a == 1){ ?>
																								<?php
																								  $delitos = getDataDelitosPorPersona($conn, $idPersona);
																											for ($i = 0; $i < sizeof($delitos); $i++){ 
																													$idDelitoPersona = $delitos[$i][0];	
																													$idCatDelito = $delitos[$i][1];
																													$nombreDelito = $delitos[$i][2];	?>
																							
																					  <tr class="table-row" id="campos">
																					  	<div class="padre"> <!--Clase padre y delOpc se utilizan para el counter CSS-->
																									<td contenteditable="false" onBlur="saveToDatabase(this,'id','5')" onClick="editRow(this);" class="delOpc"></td> 
																						  </div>
																						<td contenteditable="true" onBlur="saveToDatabase(this,'articulo_titulo','1')" onClick="editRow(this);">
																							<select id="textdelitoCometido" name="delitos[]" tabindex="6" class="form-control redondear selectTranparent" disabled="disabled">
																																				<? 
																																						$dataDelitos = getDataDelitos($conn);
																																						for ($d=0; $d < sizeof($dataDelitos); $d++) { 		
																																							$idDelitoCat = $dataDelitos[$d][0];	$nombreCat = $dataDelitos[$d][1];	?>
																												<option style="color: black; font-weight: bold;" value="<? echo $idDelitoCat; ?>" <? if($nombreDelito == $nombreCat){ ?> selected <? } ?> ><? echo $nombreCat; ?></option>
																																									<?
																																						}
																																			 ?>							
																	         </select>
																						</td>
																						
																						<td><a onclick="eliminarCampos(<? echo $idDelitoPersona; ?>);" class="remover_campo">Eliminar</a></td>
																					  </tr>
																					 
																					  <?php
																					}
																					}
																					?>
																				  </tbody>
																				</table>
																				<div class="ajax-action-button" id="add-more" onclick="createNew(<? echo $idPersona; ?> , <? echo $a; ?>);">Agregar</div>
																				</div>
																	   </div>
																	  </div>
																	   <div id="respuesta"></div>
																	  </div>


																	 

																			<div class="panel panel-default">
																			<div class="panel-body">
																				<h5 class="text-on-pannel"><strong> Datos del aseguramiento </strong></h5>
																				<div class="form-row">
																	   		
																	     <div class="form-group col-md-3">
																	      <label for="textBandas">No. de bandas</label>
																	      <input value="<?php if($a == 1){ echo $bandas; } ?>" type="text" class="form-control" id="textBandas" name="textBandas">
																	    </div>
																	    <div class="form-group col-md-3">
																	      <label for="textOrgCriminal">Org. criminal o banda delictiva</label>
																	      <input value="<?php if($a == 1){ echo $orgCriminalPertenece; } ?>" type="text" class="form-control" id="textOrgCriminal" name="textOrgCriminal">
																	    </div>
																	  </div>

																	  	<div class="form-row">
																	     <div class="form-group col-md-3">
																	      <label for="textAgraviado">Agraviado</label>
																	      <input value="<?php if($a == 1){ echo $agraviado; } ?>" type="text" class="form-control" id="textAgraviado" name="textAgraviado">
																	    </div>
																	    <div class="form-group col-md-3">
																	      <label for="textInvFlag">Flagrancia / Mandato Judicial<span class="aste">(*)</span></label>
																	      <select id="textInvFlag" name="textInvFlag" tabindex="6" class="form-control redondear selectTranparent" required>
																	       	<option value="0">Selecciona</option>
																	       	<option style="color: black; font-weight: bold;" value="1" <?php if($a == 1 && $invFlag == 1){ ?> selected <? }?> >Flagrancia</option>
																	       	<option style="color: black; font-weight: bold;" value="2" <?php if($a == 1 && $invFlag == 2){ ?> selected <? }?>>Mandato Judicial</option>
																								</select>
																	    </div>
																	     <div class="form-group col-md-3">
																	     	<label for="textBandaSolitario">Banda / Solitario</label>
																	      <select id="textBandaSolitario" name="textBandaSolitario" tabindex="6" class="form-control redondear selectTranparent">
																	       	<option value="0">Selecciona</option>
																	       	<option style="color: black; font-weight: bold;" value="B" <?php if($a == 1 && $bandaSolit == 'B'){ ?> selected <? } ?> >Banda</option>
																	       	<option style="color: black; font-weight: bold;" value="S" <?php if($a == 1 && $bandaSolit == 'S'){ ?> selected <? } ?> >Solitario</option>
																								</select>
																	    </div>
																	    <div class="form-group col-md-3">
																	      <label for="textAvPP">Av.P.P</label>
																	      <input value="<?php if($a == 1){ echo $avPP; } ?>" type="text" class="form-control" id="textAvPP" name="textAvPP">
																	    </div>
																	    </div>

																	    <div class="form-row">
																	    <div class="form-group col-md-3">
																	      <label for="textNumBas">Num d bas</label>
																	      <input value="<?php if($a == 1){ echo $numdBas; } ?>" type="number" class="form-control" id="textNumBas" name="textNumBas" >
																	    </div>
																	    <div class="form-group col-md-3">
																	      <label for="textDisposicion">A disposicion de <span class="aste">(*)</span></label>
																	      	<select class="form-control browser-default custom-select" id="textDisposicionDe" name="textDisposicionDe">																									  
																																	  	<option value="0">Selecciona</option>																										  
																																	  	<? 
																																						$dipos = getDisposicVehicle($conn);
																																						for ($d=0; $d < sizeof($dipos); $d++) { 					

																																									$iddispo = $dipos[$d][0];	$nombre = $dipos[$d][1];	?>
																																										<option <?php if($a == 1 && $aDispoDe == 	$iddispo){ ?> selected <? } ?> style="color: black; font-weight: bold;" value="<? echo $iddispo; ?>" ><? echo $nombre; ?></option>
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
																				<h5 class="text-on-pannel"><strong> Otros Datos </strong></h5>
																				<div class="form-row">
																				<div class="form-group col-md-6">
																					<label for="textRequerido">Requerido por otra corporación</label>
																					<input value="<?php if($a == 1){ echo $reqOtrasCorpo; } ?>" type="text" class="form-control" id="textRequerido" name="textRequerido">
																				</div>
																	    <div class="form-group col-md-6">
																	      <label for="textOficio">Oficio</label>
																	      <input value="<?php if($a == 1){ echo $oficio; } ?>" type="text" class="form-control" id="textOficio" name="textOficio">
																	    </div>
																	   </div>
																	   	<div class="form-row">
																	   		<div class="form-group col-md-12">
																	   		<label for="textOficio">Observaciones</label>
																	     <textarea id="textObservaciones" style="resize: none;" class="form-control rounded-0" id="exampleFormControlTextarea2" rows="3"><?php if($a == 1){ echo $observaciones; } ?></textarea>
																	     </div>
																	   	</div>
																	  </div>
																	   <div id="respuesta"></div>
																	  </div>
																	   
																	</div>
											
																</form>
               

																</div>										

																</div>
																</div>

															</div>
											  

													</div>
											  
									<div class="row">
										<div class="col-xs-12 col-sm-12 col-md-6"><center><button style="width: 88%;" onclick="closemodalPersonas()" type="button" class="btn btn-default redondear" data-dismiss="modal">Salir</button></center></div>
											<div class="col-xs-12 col-sm-12 col-md-6"><center><button style="width: 88%;" onclick="registrarPersona(<?php echo $idEnlace; ?>, <? echo $a; ?>, <? echo $tiparchiv; ?>, <? echo $b; ?>, <?php echo $idPersona; ?>)" type="button" class="btn btn-success redondear" >Guardar</button></center></div>					  
									</div> 

										<br>