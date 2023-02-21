<?php
include ("../../Conexiones/Conexion.php");
include("../../funcionesEstadoDeFuerza.php");
if (isset($_POST['idMando'])){ $idMando = $_POST['idMando']; }
if (isset($_POST['idIncapacidad'])){ $idIncapacidad = $_POST['idIncapacidad']; }
if (isset($_POST["jObjectDataGeneralMando"])){ $data = json_decode($_POST['jObjectDataGeneralMando'], true); }

//Flag 1: Editar y Flag 0 : Agregar nuevo contacto de emergencia. Si recibimos el idMando es un editar del registro
if($idIncapacidad != 0){
 $flag = 1; 
 $getFecha = getDataIncapacidad($conn, $idMando, $idIncapacidad); 
 $idIncapacidad = $getFecha[0][0];
 $fechaInicio = $getFecha[0][2];
 $fechaFin = $getFecha[0][3];
 $motivo = $getFecha[0][4];
}else{
	$flag = 0;
}
?>

<div class="modal-header" style="background-color:#152F4A;">
	<center><h4  style="font-weight: bold; color: white;" class="modal-title">REGISTRO DE INCAPACIDADES</h4></center>
</div>

<div class="modal-body">

	<!--******************* INCAPACIDADES **********************!-->
	<div class="panel panel-default">
		<div class="panel-body">
			<h5 class="text-on-pannel"><strong>INCAPACIDADES</strong></h5>

			<div class="row">
				<div class="col-xs-12 col-sm-12  col-md-6">
					<label for="fechaInicio">Fecha de inicio :</label><span class="aste"> *¨</span>
					<input id="fechaInicio" type="date" value="<?if($flag == 1){ echo $fechaInicio; } ?>" name="fechaInicio" class="fechas form-control gehit"  />
				</div>
				<div class="col-xs-12 col-sm-12  col-md-6">
					<label for="fechaFin">Fecha de termino :</label><span class="aste"> *¨</span>
					<input id="fechaFin" type="date" value="<?if($flag == 1){ echo $fechaFin; } ?>" name="fechaFin" class="fechas form-control gehit"  />
				</div>
			</div><br><br>

			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12">
					<label for="motivo">Motivo :</label>
					<textarea id="motivo" name="motivo" class="form-control" rows="4"><?if($flag == 1){ echo $motivo; } ?></textarea>
				</div>
			</div>

		</div>
	</div>

</div><br><br>

<div class="modal-footer">
	<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-6"><center><button style="width: 88%;" onclick="closeModalIncapacidad()" type="button" class="btn btn-default redondear" data-dismiss="modal">Salir</button></center></div>
			<div class="col-xs-12 col-sm-12 col-md-6"><center><button style="width: 88%;" onclick="saveDbIncapacidad(<? echo $idMando; ?> , <? echo $flag; ?> , <? echo $idIncapacidad; ?>)" type="button" class="btn btn-primary redondear" >Guardar</button></center></div>
	</div>
</div>