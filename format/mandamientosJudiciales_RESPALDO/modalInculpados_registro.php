<?php
include ("../../Conexiones/Conexion.php");
include("../../Conexiones/conexionSIMAJ.php");	
include("../../funcionesMandamientos.php");	

$fecha_actual=date("d/m/Y");
$fecha=strftime( "%Y-%m-%d %H:%M:%S", time() );
$anioActual = date("Y");
$hoy = date("Y-m-d");//Fecha calendario

if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }
if (isset($_POST["idUnidad"])){ $idUnidad = $_POST["idUnidad"]; }
if (isset($_POST["idfisca"])){ $idfisca = $_POST["idfisca"]; }


if (isset($_POST["tipoModal"])){ $tipoModal = $_POST["tipoModal"]; }
if (isset($_POST["typeArch"])){ $typeArch = $_POST["typeArch"]; }

//SE RECIBE OBJETO ARRAY CON LOS DATOS PRINCIPALES
if (isset($_POST["dataPrincipalArray"])){ 
 $data = json_decode($_POST['dataPrincipalArray'], true); 
}

if (isset($_POST["tipo_av_nuc"])){ $tipo_av_nuc = $_POST["tipo_av_nuc"]; }


if (isset($_POST["ID_MANDAMIENTO_INTERNO"])){
	$ID_MANDAMIENTO_INTERNO = $_POST["ID_MANDAMIENTO_INTERNO"]; 
 $get_data_Mandamiento = get_data_Mandamiento($conn, $ID_MANDAMIENTO_INTERNO);
 if(sizeof($get_data_Mandamiento) > 0 ){
			$GET_ID_MANDAMIENTO_INTERNO  = $get_data_Mandamiento[0][1];
		}else{
			$GET_ID_MANDAMIENTO_INTERNO = 0;
		}

	if ($ID_MANDAMIENTO_INTERNO != 0) {
		$inculpadoData = get_data_inculpado($conn, $ID_MANDAMIENTO_INTERNO);
		//Se comprueba si existen datos del inculpado en la tabla de inputados para extraer la informacion
		if(sizeof($inculpadoData) > 0 ){
			$ID_INPUTADO_INTERNO = $inculpadoData[0][1];
			$ID_DATOS_INCULPADO = $inculpadoData[0][3];
			$ID_MANDAMIENTO = $inculpadoData[0][4];
			$NOMBRE = $inculpadoData[0][5];
			$APATERNO = $inculpadoData[0][6];
			$AMATERNO = $inculpadoData[0][7];
			$EDAD = $inculpadoData[0][8];
			$ESTATURA = $inculpadoData[0][9];
			$PESO = $inculpadoData[0][10];
			$TATUAJES = $inculpadoData[0][11];
			$ID_SEXO = $inculpadoData[0][12];
			$ID_USO_ANTEOJOS = $inculpadoData[0][13];   
			$ID_NACIONALIDAD = $inculpadoData[0][14];  
			$nacionalidad = $inculpadoData[0][15];  
			$CURP = $inculpadoData[0][16];  
	  $OBSERVACIONES_inculpado = $inculpadoData[0][17];
	  $FECHA_OBSERVACION = $inculpadoData[0][18]->format('Y-m-d');
			$a = 1;
			$tipoActualizacion = "EXISTE_DATA_INPUTADO";
			$tipo_av_nuc = 2; 
		}else{
			$a = 0; //Si no hay datos del inculpado cambiamos bandera a cero para no mostrar las variables de actualizacion
			$tipoActualizacion = "NO_EXISTE_DATA_INPUTADO";
		}
	}else{  
		$a = 0;  
		$ID_MANDAMIENTO_INTERNO = 0;
		$COLABORACION = 0;
		$tipoActualizacion = "NO_EXISTE_DATA_INPUTADO";
	}
}	

?>


<div class="modal-header" style="background-color:#152F4A;">
	<center><label style="color: white; font-weight: bold; font-size: 2rem;">Datos del inculpado </label></center>
</div>

<div class="modal-body panel_registroMandamientos">
	<!--DATOS GENERALES-->
	<div class="panel panel-default fd1">
		<div class="panel-body">
			<h5 class="text-on-pannel"><strong>Datos del inculpado</strong></h5>
			<div class="row">
				<div class="col-xs-12 col-sm-12  col-md-12 input-group-lg">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 class="panel-title">Ingrese los datos del inculpado.</h3>
						</div>
						<div class="panel-body">	
							<div class="row">
								<div class="col-xs-12 col-sm-12  col-md-4 input-group-lg">
									<label for="NOMBRE"><span class="glyphicon glyphicon-user"></span> Nombre del inculpado:</label><br>
				     <input type="text" class="form-control" id="NOMBRE" placeholder="ESPECIFICA EL NOMBRE DEL INCULPADO" aria-describedby="sizing-addon1" maxlength="40" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); "  onkeypress="return validaInput(event, 'varchar_letras')" value="<?if($a == 1){ echo $NOMBRE; } ?>" >
								</div>
								<div class="col-xs-12 col-sm-12  col-md-4 input-group-lg">
									<label for="APATERNO">Apellido paterno :</label><br>
				 				<input type="text" class="form-control" id="APATERNO" placeholder="ESPECIFICA EL APELLIDO PATERNO" aria-describedby="sizing-addon1" maxlength="50" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); "  onkeypress="return validaInput(event, 'varchar_letras')" value="<?if($a == 1){ echo $APATERNO; } ?>" >
								</div>
								<div class="col-xs-12 col-sm-12  col-md-4 input-group-lg">
									<label for="AMATERNO">Apellido materno:</label><br>
				     <input type="text" class="form-control" id="AMATERNO" placeholder="ESPECIFICA EL APELLIDO MATERNO" aria-describedby="sizing-addon1" maxlength="50" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); "  onkeypress="return validaInput(event, 'varchar_letras')" value="<?if($a == 1){ echo $AMATERNO; } ?>" >
								</div>
							</div><br>
							<div class="row">
								<div class="col-xs-12 col-sm-12  col-md-3 input-group-lg">
									<label for="ID_NACIONALIDAD"><span class="glyphicon glyphicon-globe"></span> Pais de la información:</label><br>
									  <select class="form-control" id="ID_NACIONALIDAD">
											  <? $nacionalidades = getNacionalidades($connSIMAJ);
							 					for ($i=0; $i < sizeof($nacionalidades); $i++) { 
							 						$cv_nacionalidad = $nacionalidades[$i][0];	$pais = $nacionalidades[$i][2]; ?>
							 					<option class="fontBold" value="<? echo $cv_nacionalidad; ?>" <?if($a == 0 && $cv_nacionalidad == 82){ ?> selected <? }elseif($a == 1 && $cv_nacionalidad == $ID_NACIONALIDAD ){ ?> selected <? } ?> ><? echo $pais; ?></option>
							 					<? } ?>
							 			</select>
								</div>
								<div class="col-xs-12 col-sm-12  col-md-3 input-group-lg">
									<label for="ID_SEXO">Sexo</label><br>
									<input type="radio" id="ID_SEXO" name="ID_SEXO" value="M" <?if($a == 0){ ?> checked <? }elseif($a == 1 && $ID_SEXO == 'M'){ ?> checked <? } ?> style="height:25px; width:25px;">
									<label for="cv_sexo" style="font-size: 20px;">Masculino</label>&nbsp;&nbsp;&nbsp;&nbsp;
									<input type="radio" id="ID_SEXO" name="ID_SEXO" value="F" <?if($a == 1 && $ID_SEXO == 'F'){ ?> checked <? } ?> style="height:25px; width:25px;">
									<label for="cv_sexo" style="font-size: 20px;">Femenino</label>
								</div>
							 <div class="col-xs-12 col-sm-12  col-md-3 input-group-lg">
									<label for="ID_USO_ANTEOJOS">Usa anteojos</label><br>
									<input type="radio" id="ID_USO_ANTEOJOS" name="ID_USO_ANTEOJOS" value="S" <?if($a == 0){ ?> checked <? }elseif($a == 1 && $ID_USO_ANTEOJOS == 'S'){ ?> checked <? } ?> style="height:25px; width:25px;">
									<label for="id_uso_anteojos" style="font-size: 20px;">Si</label>&nbsp;&nbsp;&nbsp;&nbsp;
									<input type="radio" id="ID_USO_ANTEOJOS" name="ID_USO_ANTEOJOS" value="N" <?if($a == 1 && $ID_USO_ANTEOJOS == 'N'){ ?> checked <? } ?> style="height:25px; width:25px;">
									<label for="id_uso_anteojos" style="font-size: 20px;">No</label>
								</div>
								<div class="col-xs-12 col-sm-12  col-md-3 input-group-lg">
									<label for="TATUAJES">Tiene tatuajes</label><br>
									<input type="radio" id="TATUAJES" name="TATUAJES" value="Si" <?if($a == 0){ ?> checked <? }elseif($a == 1 && $TATUAJES == 'Si'){ ?> checked <? } ?> style="height:25px; width:25px;">
									<label for="tatuajes" style="font-size: 20px;">Si</label>&nbsp;&nbsp;&nbsp;&nbsp;
									<input type="radio" id="TATUAJES" name="TATUAJES" value="No" <?if($a == 1 && $TATUAJES == 'No'){ ?> checked <? } ?> style="height:25px; width:25px;">
									<label for="tatuajes" style="font-size: 20px;">No</label>
								</div>
							</div><br>
							<div class="row">
								<div class="col-xs-12 col-sm-12  col-md-3 input-group-lg">
									<label for="EDAD">Edad:</label><br>
				     <input type="text" class="form-control" id="EDAD" placeholder="ESPECIFICA LA EDAD" aria-describedby="sizing-addon1" maxlength="2" onkeypress="return validaInput(event, 'int')" value="<?if($a == 1){ echo $EDAD; } ?>" >
								</div>
								<div class="col-xs-12 col-sm-12  col-md-3 input-group-lg">
									<label for="ESTATURA"><span class="glyphicon glyphicon-align-justify"></span> Estatura (en cm) :</label><br>
				 				<input type="text" class="form-control" id="ESTATURA" placeholder="ESPECIFICA LA ESTATURA EN CM" aria-describedby="sizing-addon1"  onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" value="<?if($a == 1){ echo $ESTATURA; } ?>" >
								</div>
								<div class="col-xs-12 col-sm-12  col-md-3 input-group-lg">
									<label for="PESO"><span class="glyphicon glyphicon-scale"></span> Peso (en kg):</label><br>
				     <input type="number" class="form-control" id="PESO" placeholder="ESPECIFICA EL PESO (EN KG)" aria-describedby="sizing-addon1" onkeypress="return validaInput(event, 'int')" value="<?if($a == 1){ echo $PESO; } ?>" >
								</div>
								<div class="col-xs-12 col-sm-12  col-md-3 input-group-lg">
									<label for="CURP"><span class="glyphicon glyphicon-list-alt"></span> CURP:</label><br>
				     <input type="text" class="form-control" id="CURP" placeholder="ESPECIFICA EL CURP" aria-describedby="sizing-addon1" maxlength="18" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); " onkeypress="return validaInput(event, 'varchar')" value="<?if($a == 1){ echo $CURP; } ?>" >
								</div>
							</div><br>
							<?if($a == 0){ ?>
							<div class="row">
										<div class="col-xs-12 col-sm-12  col-md-4 input-group-lg">
											<label for="ID_DELITO_PRINCIPAL"><span class="glyphicon glyphicon-list-alt"></span> Delito principal</label><br>
											<select class="form-control" id="ID_DELITO_PRINCIPAL" onchange="validateCampo_OK(this.id)">
													<option class="fontBold" value="">Seleccione un delito</option>
														  <? $delitos = getCatDelitos($connSIMAJ);
										 					for ($i=0; $i < sizeof($delitos); $i++) { 
										 						$cv_delito = $delitos[$i][0];	$descrip_delito = $delitos[$i][2]; ?>
										 					<option class="fontBold" value="<? echo $cv_delito; ?>" ><? echo $descrip_delito; ?></option>
										 					<? } ?>
												</select>
										</div>
									</div><br>
								<? }else{ ?>
									<input type="hidden" name="ID_DELITO_PRINCIPAL" id="ID_DELITO_PRINCIPAL" value="NO_APLICA_DELITO_EN_EDICION">
								<? } ?>
							<div class="row">
								<div class="col-xs-12 col-sm-12  col-md-12 ">
									<label for="OBSERVACIONES_inculpado">Observaciones:</label>
									<textarea class="form-control" id="OBSERVACIONES_inculpado" rows="4" aria-describedby="sizing-addon1" placeholder="ESPECIFICA LA OBSERVACION MANDAMIENTOS" maxlength="3500" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); " ><?if($a == 1){ echo $OBSERVACIONES_inculpado; } ?></textarea>
								</div>	
							</div><br>
							<div class="row">
								<div class="col-xs-12 col-sm-12  col-md-3 input-group-lg">
									<label for="FECHA_OBSERVACION"><span class="glyphicon glyphicon-calendar"></span> Fecha de observacion:</label><br>
									<input type="date" class="form-control" id="FECHA_OBSERVACION"  aria-describedby="sizing-addon1" value="<?if($a == 1){ echo $FECHA_OBSERVACION; } ?>">
								</div>
							</div>
						</div>
						<div class="panel-footer">
						
					 </div>
					</div>	
				</div>	
			</div>
		</div>
	</div>
</div>
<!--DATOS GENERALES-->

	
<div class="modal-footer">
	<div class="row">
		<div class="col-xs-12 col-sm-12  col-md-6 col-md-offset-3">
			<?if($tipo_av_nuc == 1){ ?>
			<button type="button" class="btn btn-primary btn-lg" style="width: 100%;" onclick="guardar_mandamiento_inculpado_av(<? echo $tipoModal; ?>, <? echo $idEnlace; ?>, <?echo $idUnidad; ?> , <?echo $idfisca; ?> , <?echo $ID_MANDAMIENTO_INTERNO; ?> , '<?echo $tipoActualizacion; ?>' , <?echo $GET_ID_MANDAMIENTO_INTERNO; ?>)"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar información </button>
		<? }else {?>
			<button type="button" class="btn btn-primary btn-lg" style="width: 100%;" onclick="guardar_mandamiento_inculpado(<? echo $tipoModal; ?>, <? echo $idEnlace; ?>, <?echo $idUnidad; ?> , <?echo $idfisca; ?> , <?echo $ID_MANDAMIENTO_INTERNO; ?> , '<?echo $tipoActualizacion; ?>' , <?echo $GET_ID_MANDAMIENTO_INTERNO; ?>)"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar información</button>
		<? } ?>
		</div>
		<div class="col-xs-12 col-sm-12  col-md-3">
			<button type="button" class="btn btn-default btn-lg" data-dismiss="modal" onclick="closeModal_inculpados()" >Cerrar</button>
		</div>
	</div>
</div>

