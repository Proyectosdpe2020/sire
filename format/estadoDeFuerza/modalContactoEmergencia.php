<?php
include ("../../Conexiones/Conexion.php");
include("../../funcionesEstadoDeFuerza.php");
if (isset($_POST['idMando'])){ $idMando = $_POST['idMando']; }
if (isset($_POST['idContEmerg'])){ $idContEmerg = $_POST['idContEmerg']; }
if (isset($_POST["jObjectDataGeneralMando"])){ $data = json_decode($_POST['jObjectDataGeneralMando'], true); }

//Flag 1: Editar y Flag 0 : Agregar nuevo contacto de emergencia. Si recibimos el idMando es un editar del registro
if($idContEmerg != 0){
 $flag = 1; 
 $getContEmerg = getDataContEmerg($conn, $idMando, $idContEmerg);  
 $idContEmerg = $getContEmerg[0][0];
 $nombre = $getContEmerg[0][2];
 $parentesco = $getContEmerg[0][3];
 $telefono = $getContEmerg[0][4];
 $direccion = $getContEmerg[0][5];
 $ciudad = $getContEmerg[0][6];
}else{
	$flag = 0;
}

?>

<div class="modal-header" style="background-color:#152F4A;">
	<center><h4  style="font-weight: bold; color: white;" class="modal-title">ACTUALIZACIÓN CONTACTO DE EMERGENCIA</h4></center>
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
    
	<!--******************* CONTACTO DE EMERGENCIA **********************!-->
	<div class="panel panel-default">
		<div class="panel-body">
			<h5 class="text-on-pannel"><strong> CONTACTO DE EMERGENCIA </strong></h5>

			<div class="row">
				<div class="col-xs-12 col-sm-4 col-md-4">
					<label for="nombreCtoEmrg">Nombre:<span class="aste">(*)</span></label>
					<input value="<?if($flag == 1){ echo $nombre; } ?>" type="text" style="text-transform:uppercase;" class="form-control" id="nombreCtoEmrg" name="nombreCtoEmrg" onkeyup="javascript:this.value=this.value.toUpperCase();">
				</div>
				<div class="col-xs-12 col-sm-4 col-md-4">
					<label for="parentesco">Parentesco:<span class="aste">(*)</span></label>
					<input value="<?if($flag == 1){ echo $parentesco; } ?>" type="text" style="text-transform:uppercase;" class="form-control" id="parentesco" name="parentesco" onkeyup="javascript:this.value=this.value.toUpperCase();">
				</div>
				<div class="col-xs-12 col-sm-4 col-md-4">
					<label for="telefono">Teléfono:<span class="aste">(*)</span></label>
					<input value="<?if($flag == 1){ echo $telefono; } ?>" type="text" style="text-transform:uppercase;" class="form-control" id="telefono" name="telefono" onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="10">
				</div>
			</div><br><br>

			<div class="row">
				<div class="col-xs-12 col-sm-4 col-md-4">
					<label for="direccion">Dirección:<span class="aste">(*)</span></label>
					<input value="<?if($flag == 1){ echo $direccion; } ?>" type="text" style="text-transform:uppercase;" class="form-control" id="direccion" name="direccion" onkeyup="javascript:this.value=this.value.toUpperCase();">
				</div>
				<div class="col-xs-12 col-sm-4 col-md-4">
					<label for="ciudadEstado">Ciudad / Estado:<span class="aste">(*)</span></label>
					<input value="<?if($flag == 1){ echo $ciudad; } ?>" type="text" style="text-transform:uppercase;" class="form-control" id="ciudadEstado" name="ciudadEstado" onkeyup="javascript:this.value=this.value.toUpperCase();">
				</div>
			</div>

		</div>
	</div>
	
</div><br><br>

<div class="modal-footer">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-6"><center><button style="width: 88%;" onclick="closeModalContactoEmergencia()" type="button" class="btn btn-default redondear" data-dismiss="modal">Salir</button></center></div>
		<div class="col-xs-12 col-sm-12 col-md-6"><center><button style="width: 88%;" onclick="saveDbContactoEmergencia(<? echo $idMando; ?> , <? echo $flag; ?> , <? echo $idContEmerg; ?>)" type="button" class="btn btn-primary redondear" >Guardar</button></center></div>
	</div>
</div>
