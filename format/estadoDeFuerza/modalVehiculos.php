<?php
include ("../../Conexiones/Conexion.php");
include("../../funcionesEstadoDeFuerza.php");

if (isset($_POST['idMando'])){ $idMando = $_POST['idMando']; }
if (isset($_POST['idVehiculo'])){ $idVehiculo = $_POST['idVehiculo']; }
if (isset($_POST["jObjectDataGeneralMando"])){ $data = json_decode($_POST['jObjectDataGeneralMando'], true); }

//Flag 1: Editar y Flag 0 : Agregar nuevo mano . Si recibimos el idMando es un editar del registro
if($idVehiculo != 0){
 $flag = 1; 
 $getDataVehiculos = getDataVehiculos($conn, $idMando, $idVehiculo);  
 $idVehiculo = $getDataVehiculos[0][0];
 $marca = $getDataVehiculos[0][2];
 $modelo = $getDataVehiculos[0][3];
 $placas = $getDataVehiculos[0][4];
 $vehiculoActual = $getDataVehiculos[0][5];
}else{
	$flag = 0;
}

?>

<div class="modal-header" style="background-color:#152F4A;">
	<center><h4  style="font-weight: bold; color: white;" class="modal-title"><? if($flag == 0){ echo 'REGISTRO DE VEHICULO'; }else{ echo 'ACTUALIZACIÓN DE VEHICULO'; } ?></h4></center>
</div>

<div class="modal-body">
	<!--****************** DATOS GENERALES ***************-->
	<input type="hidden" id="nombre" value="<?php echo $data[0]; ?>" >	          
	<input type="hidden" id="ap_paterno" value="<?php echo $data[1]; ?>" >		
	<input type="hidden" id="ap_materno" value="<?php echo $data[2]; ?>" >		
	<input type="hidden" id="sexo" value="<?php echo $data[3]; ?>" >	      
	<input type="hidden" id="cargo" value="<?php echo $data[4]; ?>" >	     
	<input type="hidden" id="funcion" value="<?php echo $data[5]; ?>" >	 
	<input type="hidden" id="fisUnid" value="<?php echo $data[6]; ?>" >
	<input type="hidden" id="areaAdscripcion" value="<?php echo $data[7]; ?>" >
	<input type="hidden" id="seccion" value="<?php echo $data[8]; ?>" >	
	<input type="hidden" id="comisionado" value="<?php echo $data[9]; ?>" >
	<input type="hidden" id="fechaAlta" value="<?php echo $data[10]; ?>" >																																																																						<input type="hidden" id="fechaActualAdsc" value="<?php echo $data[11]; ?>" >				
 <input type="hidden" id="observacionesMando" value="<?php echo $data[12]; ?>" >	

	<!--******************* VEHICULO **********************!-->
	<div class="panel panel-default">
		<div class="panel-body">
			<h5 class="text-on-pannel"><strong> VEHICULO </strong></h5>

			<div class="row">
				<div class="col-xs-12 col-sm-4 col-md-4">
					<label for="marcaVehi">Marca:<span class="aste">(*)</span></label>
					<input value="<?if($flag == 1){ echo $marca; } ?>" type="text" style="text-transform:uppercase;" class="form-control" id="marcaVehi" name="marcaVehi" onkeyup="javascript:this.value=this.value.toUpperCase();">
				</div>
				<div class="col-xs-12 col-sm-4 col-md-4">
					<label for="modeloVehi">Modelo:<span class="aste">(*)</span></label>
					<input value="<?if($flag == 1){ echo $modelo; } ?>" type="text" style="text-transform:uppercase;" class="form-control" id="modeloVehi" name="modeloVehi" onkeyup="javascript:this.value=this.value.toUpperCase();">
				</div>
				<div class="col-xs-12 col-sm-4 col-md-4">
					<label for="placasVehi">Placas:<span class="aste">(*)</span></label>
					<input value="<?if($flag == 1){ echo $placas; } ?>" type="text" style="text-transform:uppercase;" class="form-control" id="placasVehi" name="placasVehi" onkeyup="javascript:this.value=this.value.toUpperCase();">
				</div>
			</div>
		</div>
	</div>

</div><br><br>

<div class="modal-footer">
	<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-6"><center><button style="width: 88%;" onclick="closeModalVehiculos()" type="button" class="btn btn-default redondear" data-dismiss="modal">Salir</button></center></div>
			<div class="col-xs-12 col-sm-12 col-md-6"><center><button style="width: 88%;" onclick="saveDbVehiculo(<? echo $idMando; ?> , <? echo $flag; ?> , <? echo $idVehiculo; ?>)" type="button" class="btn btn-primary redondear" >Guardar</button></center></div>
	</div>
</div>


