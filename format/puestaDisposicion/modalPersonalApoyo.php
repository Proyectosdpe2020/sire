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
    /// SE RECIBE LA INFORMACION DE LA PUESTA A DISPOSICION ///
				if (isset($_POST["jObject"])){ $data = json_decode($_POST['jObject'], true);
				$e = 1;
			}else{ $e = 0; }

						$tipoArchov = get_type_archive($conn, $idEnlace);
					$tiparchiv = $tipoArchov[0][0];


				/// SE RECIBE EL ID DE LA DEFUNCION PARA EDITAR ///
			if (isset($_POST["personalApoyo_id"]) ){ 

				$personalApoyo_id = $_POST["personalApoyo_id"]; 
		  //Si se envia $idDefuncion = 0 no es actualizacion, 
				if($personalApoyo_id != 0){
						$a = 1; // Si a = 1 es actualizacion y se mostraran los datos de la siguiente consulta en este mismo modal
		    $arreglo = get_data_personalApoyo_puesta($conn, $idPuestaDisposicion , $personalApoyo_id);
		    $mando_ID = $arreglo[0][2];
		    $areaad = $arreglo[0][5];
		    $cargo = $arreglo[0][7];
		    $funcion = $arreglo[0][9];
		 }else{ 
		 	//Si $idDefuncion viene con valor 0 no es actualizacion y entra aqui
		 	$a = 0;
		 	$personalApoyo_id = 0;
		 }
		}

	?>



 <div class="modal-header" style="background-color:#152F4A;">
 	<center><label style=" color: white; font-weight: bold; font-size: 2rem;">Personal de apoyo</label></center>
 </div>
 <div class="col-md-12 col-sm-12 col-xs-12 form-group panelPersonalApoyo" >	
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
							<h5 class="text-on-pannel"><strong> Personal de apoyo </strong></h5>
							<div class="row"><!-- ROOWWWWWW MANDOS  -->
								<div class="col-xs-12 col-sm-12  col-md-4">
									<label for="heard">Agente : <span class="aste">(Requerido)</span></label><br>
									<select class="dataAutocomplet form-control browser-default custom-select" onchange="getDataPersonalApoyo()" id="mando_ID" locked="locked" name="newBrwoser" type="text" <? if($b == 0){ echo "readonly"; } ?> >
										<option></option>
										<? $mandos = getDataMandos($conn, "VI");
										for ($h=0; $h < sizeof($mandos); $h++) { 
											$idMando = $mandos[$h][6];	$nom = $mandos[$h][0];	$pat = $mandos[$h][1];	$mat = $mandos[$h][2];
											$nombrecom = $nom." ".$pat." ".$mat; ?>
											<option style="color: black; font-weight: bold;" value="<? echo $idMando; ?>" <?if($a == 1 && $idMando == $mando_ID ){ ?> selected <? } ?>><? echo $nombrecom; ?></option>
											<? } ?>
										</select>
									</div>
									<div id="contDataPersonalApoyo">	
										<div class="col-xs-12 col-sm-12  col-md-4">
											<label for="heard">Cargo :</label>
											<input class="form-control mandda gehit" value="<? if($a == 1){ echo $cargo; } ?>"  id="cargoPersonalApoyo"  type="text" disabled>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-4">
											<label for="heard">Función :</label>
											<input class="form-control mandda gehit" value="<? if($a == 1){ echo $funcion; } ?>"  id="funcionPersonalApoyo"  type="text" disabled>
										</div>
										<div class="col-xs-12 col-sm-12  col-md-12">
											<label for="heard">Área de Adscripción :</label>
											<input class="form-control mandda gehit" value="<? if($a == 1){ echo $areaad; } ?>" id="adscPersonalApoyo"  type="text" disabled>
										</div>
									</div>
								</div><!-- ROOWWWWWW MANDOS  --> 
							</div>
						</div> 

					</form>
					</div><!-- ROOWWWWWW PRINCIPAL --> 

				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-6"><center><button style="width: 88%;" onclick="closemodalObjetoAsegurado()" type="button" class="btn btn-default redondear" data-dismiss="modal">Salir</button></center></div>
	<div class="col-xs-12 col-sm-12 col-md-6"><center><button style="width: 88%;" onclick="registroPersonalApoyo(<?php echo $idEnlace; ?>, <? echo $tiparchiv; ?>, <? echo $b; ?> , <?php echo $a; ?> , <?php echo $personalApoyo_id; ?>)" type="button" class="btn btn-primary redondear" >Guardar</button></center></div>	
</div>
<br>