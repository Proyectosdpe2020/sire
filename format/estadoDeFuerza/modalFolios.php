<?php
include ("../../Conexiones/Conexion.php");
include("../../funcionesEstadoDeFuerza.php");
if (isset($_POST['idMando'])){ $idMando = $_POST['idMando']; }
if (isset($_POST['idFolio'])){ $idFolio = $_POST['idFolio']; }
if (isset($_POST["jObjectDataGeneralMando"])){ $data = json_decode($_POST['jObjectDataGeneralMando'], true); }

//Flag 1: Editar y Flag 0 : Agregar nuevo contacto de emergencia. Si recibimos el idMando es un editar del registro
if($idFolio != 0){
 $flag = 1; 
 $getFolio = getDataFolios($conn, $idMando, $idFolio);  
 $idFolio = $getFolio[0][0];
 $seguroSocial = $getFolio[0][2];
 $curp = $getFolio[0][3];
 $cuip = $getFolio[0][4];
 $folioCredencial = $getFolio[0][5];
 $cup = $getFolio[0][6];
}else{
	$flag = 0;
}
?>

<div class="modal-header" style="background-color:#152F4A;">
	<center><h4  style="font-weight: bold; color: white;" class="modal-title">ACTUALIZACIÓN DE FOLIOS</h4></center>
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

	<!--******************* FOLIO **********************!-->
	<div class="panel panel-default" >
		<div class="panel-body">
			<h5 class="text-on-pannel"><strong>FOLIO(S)</strong></h5>

			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12">
					<label for="seguroSocial">Seguro Social:<span class="aste">(*)</span></label>
					<input value="<?if($flag == 1){ echo $seguroSocial; } ?>" type="text" style="text-transform:uppercase;" class="form-control" id="seguroSocial" name="seguroSocial" onkeyup="javascript:this.value=this.value.toUpperCase();">
				</div>
			</div><br>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12">
					<label for="curp">CURP:<span class="aste">(*)</span></label>
					<input value="<?if($flag == 1){ echo $curp; } ?>" type="text" style="text-transform:uppercase;" class="form-control" id="curp" name="curp" onkeyup="javascript:this.value=this.value.toUpperCase();">
				</div>
			</div><br>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12">
					<label for="cuip">CUIP:<span class="aste">(*)</span></label>
					<input value="<?if($flag == 1){ echo $cuip; } ?>" type="text" style="text-transform:uppercase;" class="form-control" id="cuip" name="cuip" onkeyup="javascript:this.value=this.value.toUpperCase();">
				</div>
			</div><br>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12">
					<label for="folioCredencial">Folio de credencial:<span class="aste">(*)</span></label>
					<input value="<?if($flag == 1){ echo $folioCredencial; } ?>" type="text" style="text-transform:uppercase;" class="form-control" id="folioCredencial" name="folioCredencial" onkeyup="javascript:this.value=this.value.toUpperCase();">
				</div>
			</div><br>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12">
					<label for="cup">CUP:<span class="aste">(*)</span></label>
					<input value="<?if($flag == 1){ echo $cup; } ?>" type="text" style="text-transform:uppercase;" class="form-control" id="cup" name="cup" onkeyup="javascript:this.value=this.value.toUpperCase();">
				</div>
			</div><br>

		</div>
	</div>
</div><br><br>

<div class="modal-footer">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-6"><center><button style="width: 88%;" onclick="closeModalFolios()" type="button" class="btn btn-default redondear" data-dismiss="modal">Salir</button></center></div>
		<div class="col-xs-12 col-sm-12 col-md-6"><center><button style="width: 88%;" onclick="saveDbFolios(<? echo $idMando; ?> , <? echo $flag; ?> , <? echo $idFolio; ?>)" type="button" class="btn btn-primary redondear" >Guardar</button></center></div>
	</div>
</div>
