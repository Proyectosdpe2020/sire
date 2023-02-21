<?php
include ("../../Conexiones/Conexion.php");
include("../../funcionesEstadoDeFuerza.php");
//Flag 1: Editar y Flag 0 : Agregar nuevo mano
if(isset($_GET['idMando'])){
 $flag = 1; 
	$idMando = $_GET['idMando'];
	$mandos = getDataMandoTable($conn, $idMando, 0);
	$idMando = $mandos[0][0];
 $nombreMando = $mandos[0][1];
 $nombre = $mandos[0][2];
 $paterno = $mandos[0][3];
 $materno = $mandos[0][4];
	$cargo  = $mandos[0][5];
	$funcion  = $mandos[0][6];
	$areadscri  = $mandos[0][7];
	$getIdCargo  = $mandos[0][8];
	$getIdFuncion  = $mandos[0][9];
	$getIdAreadscri  = $mandos[0][10];
	$estatus = $mandos[0][11];
}else{
	$flag = 0;
	$idMando = 00;
}
?>

<div class="modal-header" style="background-color:#152F4A;">
	<center><label style=" color: white; font-weight: bold; font-size: 2rem;">ACTUALIZAR INFORMACIÓN</label></center>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 form-group panelunoDisposicdo" >
	<div class="row"  style="padding: 1px;">
		<div class="row" style="padding: 20px;"><!-- ROOWWWWWW PRINCIPAL --> 
			<form onsubmit="return false" action="return false">

					<!--******************* DATOS GENERALES**********************!-->
				<div class="panel panel-default">
					<div class="panel-body">
						<h5 class="text-on-pannel"><strong> DATOS GENERALES </strong></h5>

						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 centerUploadImg">
								<img id="imgMando" src="https://via.placeholder.com/150" alt="Tu imagen" />
							</div>
						</div><br><br>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 centerUploadImg">
								<span class="btn btn-default btn-file glyphicon glyphicon-upload"> CARGAR FOTOGRAFIA <input type="file" id="file"></span>						  
							</div>
						</div><br><br>
						<div class="row">
							<div class="col-xs-12 col-sm-3 col-md-3">
								<label for="nombre">Nombre:<span class="aste">(*)</span></label>
								<input value="<?if($flag == 1){ echo $nombre; } ?>" type="text" style="text-transform:uppercase;" class="form-control" id="nombre" name="nombre" onkeyup="javascript:this.value=this.value.toUpperCase();">
							</div>
							<div class="col-xs-12 col-sm-3 col-md-3">
								<label for="ap_paterno">Apellido Paterno:<span class="aste">(*)</span></label>
								<input value="<?if($flag == 1){ echo $paterno; } ?>" type="text" style="text-transform:uppercase;" class="form-control" id="ap_paterno" name="ap_paterno" onkeyup="javascript:this.value=this.value.toUpperCase();">
							</div>
							<div class="col-xs-12 col-sm-3 col-md-3">
								<label for="ap_materno">Apellido Materno:<span class="aste">(*)</span></label>
								<input value="<?if($flag == 1){ echo $materno; } ?>" type="text" style="text-transform:uppercase;" class="form-control" id="ap_materno" name="ap_materno" onkeyup="javascript:this.value=this.value.toUpperCase();">
							</div>
							<div class="col-xs-12 col-sm-3 col-md-3">
								<label for="funcion">Sexo:<span class="aste">(*)</span></label><br>
								<label class="radio-inline">
									<input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> Hombre
								</label>
								<label class="radio-inline">
									<input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> Mujer
								</label>
							</div>
						</div><br><br>
					</div>
				</div><br>

				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-2">
						<button type="button" class="btn btn-success btn-lg btn-block" onclick="showModalDireccion(<? echo $idMando; ?>)">DIRECCIÓN</button>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-2">
						<button type="button" class="btn btn-success btn-lg btn-block" onclick="showModalVehiculos(<? echo $idMando; ?>)">VEHICULOS</button>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-1">
						<button type="button" class="btn btn-success btn-lg btn-block" onclick="showModalArmas(<? echo $idMando; ?>)">ARMAS</button>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-3">
						<button type="button" class="btn btn-success btn-lg btn-block" onclick="showModalContactoEmergencia(<? echo $idMando; ?>)">CONTACTO EMERGENCIA</button>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-2">
						<button type="button" class="btn btn-success btn-lg btn-block" onclick="showModalAdscripciones(<? echo $idMando; ?>)">ADSCRIPCIÓN</button>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-2">
						<button type="button" class="btn btn-success btn-lg btn-block" onclick="showModalFolios(<? echo $idMando; ?>)">FOLIOS</button>
					</div>
				</div><br><br>

				<!--******************* OBSERVACIONES **********************!-->
				<div class="panel panel-default">
					<div class="panel-body">
						<h5 class="text-on-pannel"><strong>OBSERVACIONES</strong></h5>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12">
								<textarea class="form-control" rows="4"></textarea>
							</div>
						</div>
					</div>
				</div><br>


						

						</div><!-- ROOWWWWWW PRINCIPAL --> 
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-6"><center><button style="width: 88%;" onclick="closeModalEstadoDeFuerza()" type="button" class="btn btn-default redondear" data-dismiss="modal">Salir</button></center></div>
	<div class="col-xs-12 col-sm-12 col-md-6"><center><button style="width: 88%;" onclick="saveDbMando(<? echo $idMando; ?> , <? echo $flag; ?>)" type="button" class="btn btn-primary redondear" >Guardar</button></center></div>
</div>
<br>

<script type="text/javascript">
  $("#file").change(function () {
    readImage(this);
  });
</script>