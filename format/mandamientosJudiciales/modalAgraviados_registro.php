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
if (isset($_POST["tipoActualizacion"])){ $tipoActualizacion = $_POST["tipoActualizacion"]; }

if (isset($_POST["tipoModal"])){ $tipoModal = $_POST["tipoModal"]; }
if (isset($_POST["typeArch"])){ $typeArch = $_POST["typeArch"]; }

if (isset($_POST["ID_MANDAMIENTO_INTERNO"])){ $ID_MANDAMIENTO_INTERNO = $_POST["ID_MANDAMIENTO_INTERNO"]; }

/// SE RECIBE LA INFORMACION DE LA PUESTA A DISPOSICION ///
if (isset($_POST["dataPrincipalArray"])){
	$data = json_decode($_POST['dataPrincipalArray'], true);
	$e = 1;
}else{ $e = 0; }

			/// SE RECIBE EL ID DEL LA DROGA PARA EDITAR ///
			if (isset($_POST["ID_DATOS_AGRAVIADO_INTERNO"]) ){ 

				$ID_DATOS_AGRAVIADO_INTERNO = $_POST["ID_DATOS_AGRAVIADO_INTERNO"]; 
		  //Si se envia ID_DATOS_AGRAVIADO_INTERNO = 0 no es actualizacion, 
				if($ID_DATOS_AGRAVIADO_INTERNO != 0){
						$a = 1; // Si a = 1 es actualizacion y se mostraran los datos de la siguiente consulta en este mismo modal
		    $agraviadosData = get_data_agraviados($conn, $ID_MANDAMIENTO_INTERNO, $ID_DATOS_AGRAVIADO_INTERNO);
		   	$ID_DATOS_AGRAVIADO_INTERNO = $agraviadosData[0][1];
						$ID_MANDAMIENTO_INTERNO = $agraviadosData[0][2];
						$ID_DATOS_AGRAVIADO = $agraviadosData[0][3];
						$ID_MANDAMIENTO = $agraviadosData[0][4];
						$NOMBRE = $agraviadosData[0][5];
						$PATERNO = $agraviadosData[0][6];
						$MATERNO = $agraviadosData[0][7];
						$ES_PRINCIPAL = $agraviadosData[0][8];
		 }else{ 
		 	//Si $idTrabajoCampo viene con valor 0 no es actualizacion y entra aqui
		 	$a = 0;
		 	$ID_DATOS_AGRAVIADO_INTERNO = 0;
		 }
		}


/*
//SE RECIBE OBJETO ARRAY CON LOS DATOS PRINCIPALES
if (isset($_POST["dataPrincipalArray"])){ 
 $data = json_decode($_POST['dataPrincipalArray'], true); 
}


if (isset($_POST["ID_MANDAMIENTO_INTERNO"])){
	$ID_MANDAMIENTO_INTERNO = $_POST["ID_MANDAMIENTO_INTERNO"]; 
	if ($ID_MANDAMIENTO_INTERNO != 0) {
		$agraviadosData = get_data_agraviados($conn, $ID_MANDAMIENTO_INTERNO);
		//Se comprueba si existen datos del agraviado en la tabla de inputados para extraer la informacion
		if(sizeof(	$agraviadosData) > 0 ){
			$ID_DATOS_AGRAVIADO_INTERNO = $agraviadosData[0][1];
			$ID_MANDAMIENTO_INTERNO = $agraviadosData[0][2];
			$ID_DATOS_AGRAVIADO = $agraviadosData[0][3];
			$ID_MANDAMIENTO = $agraviadosData[0][4];
			$NOMBRE = $agraviadosData[0][5];
			$PATERNO = $agraviadosData[0][6];
			$MATERNO = $agraviadosData[0][7];
			$ES_PRINCIPAL = $agraviadosData[0][8];
			$a = 1;
			$tipoActualizacion = "EXISTE_DATA_AGRAVIADO";
		}else{
			$a = 0; //Si no hay datos del agraviado cambiamos bandera a cero para no mostrar las variables de actualizacion
			$tipoActualizacion = "NO_EXISTE_DATA_AGRAVIADO";
		}
	}else{  
		$a = 0;  
		$ID_MANDAMIENTO_INTERNO = 0;
		$COLABORACION = 0;
		$tipoActualizacion = "NO_EXISTE_DATA_AGRAVIADO";
	}
}	
*/
?>


<div class="modal-header" style="background-color:#152F4A;">
	<center><label style="color: white; font-weight: bold; font-size: 2rem;">Datos del Agraviado </label></center>
</div>
<div class="modal-body panel_registroMandamientos">
	<!--DATOS GENERALES-->
	<div class="panel panel-default fd1">
		<div class="panel-body">
			<h5 class="text-on-pannel"><strong>Datos del agraviado</strong></h5>
			<div class="row">
				<div class="col-xs-12 col-sm-12  col-md-12 input-group-lg">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 class="panel-title">Ingrese los datos del agraviado.</h3>
						</div>
						<div class="panel-body">	
							<div class="row">
								<div class="col-xs-12 col-sm-12  col-md-3 input-group-lg">
									<label for="NOMBRE_AGRAVIADO"><span class="glyphicon glyphicon-user"></span> Nombre del agraviado:</label><br>
				     <input type="text" id="NOMBRE_AGRAVIADO" class="form-control" placeholder="ESPECIFICA EL NOMBRE DEL AGRAVIADO" maxlength="40" aria-describedby="sizing-addon1" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); "  onkeypress="return validaInput(event, 'varchar_letras')" value="<?if($a == 1){ echo $NOMBRE; } ?>" >
								</div>
								<div class="col-xs-12 col-sm-12  col-md-3 input-group-lg">
									<label for="PATERNO">Apellido paterno :</label><br>
				 				<input type="text" id="PATERNO" class="form-control" placeholder="ESPECIFICA EL APELLIDO PATERNO" maxlength="50" aria-describedby="sizing-addon1" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); "  onkeypress="return validaInput(event, 'varchar_letras')" value="<?if($a == 1){ echo $PATERNO; } ?>" >
								</div>
								<div class="col-xs-12 col-sm-12  col-md-3 input-group-lg">
									<label for="MATERNO">Apellido materno:</label><br>
				     <input type="text" id="MATERNO" class="form-control" placeholder="ESPECIFICA EL APELLIDO MATERNO" maxlength="50" aria-describedby="sizing-addon1" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); "  onkeypress="return validaInput(event, 'varchar_letras')" value="<?if($a == 1){ echo $MATERNO; } ?>" >
								</div>
								<div class="col-xs-12 col-sm-12  col-md-3 input-group-lg">
											<label for="ES_PRINCIPAL_AGRAVIADO">Es principal</label><br>
											 <input type="radio" id="ES_PRINCIPAL_AGRAVIADO" name="ES_PRINCIPAL_AGRAVIADO" value="1" <?if($a == 0){ ?> checked <? }elseif($a == 1 && $ES_PRINCIPAL == 1){ ?> checked <? } ?> style="height:25px; width:25px;">
						      <label for="ES_PRINCIPAL_AGRAVIADO" style="font-size: 20px;">Si</label>&nbsp;&nbsp;&nbsp;&nbsp;
						      <input type="radio" id="ES_PRINCIPAL_AGRAVIADO" name="ES_PRINCIPAL_AGRAVIADO" value="0" style="height:25px; width:25px;" <?if($a == 1 && $ES_PRINCIPAL == 0){ ?> checked <? } ?> >
						      <label for="ES_PRINCIPAL_AGRAVIADO" style="font-size: 20px;">No</label>
								</div>
							</div><br>
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
			<button type="button" class="btn btn-primary btn-lg" style="width: 100%;" onclick="guardar_mandamiento_agraviado(<? echo $tipoModal; ?> , <? echo $idEnlace; ?>, <?echo $idUnidad; ?> , <?echo $idfisca; ?> , <? echo $ID_MANDAMIENTO_INTERNO; ?> , <? echo $tipoActualizacion; ?>, <?echo $ID_DATOS_AGRAVIADO_INTERNO; ?>) " ><span class="glyphicon glyphicon-floppy-disk"></span> Guardar información</button>
		</div>
		<div class="col-xs-12 col-sm-12  col-md-3">
			<button type="button" class="btn btn-default btn-lg" data-dismiss="modal" onclick="closeModal_agraviados()" >Cerrar</button>
		</div>
	</div>
</div>

