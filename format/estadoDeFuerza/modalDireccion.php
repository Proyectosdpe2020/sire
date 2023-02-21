<?php
include ("../../Conexiones/Conexion.php");
include("../../funcionesEstadoDeFuerza.php");

if (isset($_POST['idMando'])){ $idMando = $_POST['idMando']; }
if (isset($_POST['idDomicilio'])){ $idDomicilio = $_POST['idDomicilio']; }
if (isset($_POST["jObjectDataGeneralMando"])){ $data = json_decode($_POST['jObjectDataGeneralMando'], true); }

//Flag 1: Editar y Flag 0 : Agregar nuevo mano . Si recibimos el idMando es un editar del registro
if($idDomicilio != 0){
 $flag = 1; 
 $getDataDireccion = getDataDireccion($conn, $idMando, $idDomicilio); 
 $idDomicilio = $getDataDireccion[0][0];
 $domicilio = $getDataDireccion[0][2];
 $lugarOrigen = $getDataDireccion[0][3];
 $ciudad = $getDataDireccion[0][4];
 $estadoProvincia = $getDataDireccion[0][5];
 $codigoPostal = $getDataDireccion[0][6];
 $telefono = $getDataDireccion[0][7];
}else{
	$flag = 0;
}

?>

<div class="modal-header" style="background-color:#152F4A;">
	<center><h4  style="font-weight: bold; color: white;" class="modal-title"><? if($flag == 0){ echo 'REGISTRO DE DOMICILIO'; }else{ echo 'ACTUALIZACIÓN DE DOMICILIO'; } ?></h4></center>
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
	<input type="hidden" id="fechaAlta" value="<?php echo $data[10]; ?>" >
	<input type="hidden" id="fechaActualAdsc" value="<?php echo $data[11]; ?>" >				
 <input type="hidden" id="observacionesMando" value="<?php echo $data[12]; ?>" >

	<!--******************* DIRECCION **********************!-->
	<div class="panel panel-default">
		<div class="panel-body">
			<h5 class="text-on-pannel"><strong> REGISTRO DE DOMICILIO </strong></h5>

			<div class="row">
				<div class="col-xs-12 col-sm-4 col-md-4">
					<label for="Domicilio">Domicilio:<span class="aste">(*)</span></label>
					<input value="<?if($flag == 1){ echo $domicilio; } ?>" type="text" style="text-transform:uppercase;" class="form-control" id="domicilio" name="domicilio" onkeyup="javascript:this.value=this.value.toUpperCase();">
				</div>
				<div class="col-xs-12 col-sm-4 col-md-4">
					<label for="lugarOrigen">Lugar de Origen:<span class="aste">(*)</span></label>
					<input value="<?if($flag == 1){ echo $lugarOrigen; } ?>" type="text" style="text-transform:uppercase;" class="form-control" id="lugarOrigen" name="lugarOrigen" onkeyup="javascript:this.value=this.value.toUpperCase();">
				</div>
				<div class="col-xs-12 col-sm-4 col-md-4">
					<label for="Ciudad">Ciudad:<span class="aste">(*)</span></label>
					<input value="<?if($flag == 1){ echo $ciudad; } ?>" type="text" style="text-transform:uppercase;" class="form-control" id="ciudad" name="ciudad" onkeyup="javascript:this.value=this.value.toUpperCase();">
				</div>
			</div><br><br>

			<div class="row">
				<div class="col-xs-12 col-sm-4 col-md-4">
					<label for="Estado / Provincia">Estado / Provincia:<span class="aste">(*)</span></label>
					<input value="<?if($flag == 1){ echo $estadoProvincia; } ?>" type="text" style="text-transform:uppercase;" class="form-control" id="estadoProvincia" name="estadoProvincia" onkeyup="javascript:this.value=this.value.toUpperCase();">
				</div>
				<div class="col-xs-12 col-sm-4 col-md-4">
					<label for="codigoPostal">Código Postal:<span class="aste">(*)</span></label>
					<input value="<?if($flag == 1){ echo $codigoPostal; } ?>" type="number" style="text-transform:uppercase;" class="form-control" id="codigoPostal" name="codigoPostal" onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="5" oninput="validateCodPostal(this)">
				</div>
				<div class="col-xs-12 col-sm-4 col-md-4">
					<label for="numTelefono">Número de teléfono:<span class="aste">(*)</span></label>
					<input value="<?if($flag == 1){ echo $telefono; } ?>" type="number" style="text-transform:uppercase;" class="form-control" id="numTelefono" name="numTelefono" onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="10" oninput="validateTelefono(this)" >
				</div>
			</div>
		</div>
	</div><br>

</div><br><br>

<div class="modal-footer">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-6"><center><button style="width: 88%;" onclick="closeModalDireccion()" type="button" class="btn btn-default redondear" data-dismiss="modal">Salir</button></center></div>
	 <div class="col-xs-12 col-sm-12 col-md-6"><center><button style="width: 88%;" onclick="saveDbDomicilio(<? echo $idMando; ?> , <? echo $flag; ?> , <? echo $idDomicilio; ?>)" type="button" class="btn btn-primary redondear" >Guardar</button></center></div>
	</div>
</div>

<!--SE QUEDO PENDIENTE AQUI FALTA LLEVAR LA VARIABLE idDomicilio-->