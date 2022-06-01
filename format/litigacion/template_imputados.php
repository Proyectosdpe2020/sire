<?php
 include ("../../Conexiones/Conexion.php");
 include ("../../Conexiones/conexionSicap.php");
	include("../../funciones.php");
	include("../../funcioneSicap.php");
	include("../../funcioneLit.php");
	include("../../funcionesLitSENAP.php");

	if (isset($_POST["imputado_id"])){ $imputado_id = $_POST["imputado_id"]; }


$getData = getDataImputados_editar($conn, $imputado_id);
$idEstatusNucs = $getData[0][1];
$nombre = $getData[0][2]; 
$apellido_paterno = $getData[0][3]; 
$apellido_materno = $getData[0][4]; 
$edad = $getData[0][5]; 
$sexo = $getData[0][6];

?>

<div class="row">
	<div class="col-xs-12 col-sm-4  col-md-4 ">
		<button style="width: 88%;" onclick="actualizar_imputado(<? echo $imputado_id; ?> , <? echo $idEstatusNucs; ?>)" type="button" class="btn btn-primary redondear" >Actualizar</button>
	</div>
</div><br>


<div class="row">
		<div class="col-xs-12 col-sm-4  col-md-4">
			<label for="nombre_imputado">Nombre: </label>
			<input id="nombre_imputado" type="text" value="<?  echo $nombre;  ?>" name="nombre_imputado" placeholder="NOMBRE" class="fechas form-control gehit"  />
		</div>
		<div class="col-xs-12 col-sm-4  col-md-4">
			<label for="apellido_paterno">Apellido Paterno: </label>
			<input id="apellido_paterno" type="text" value="<?  echo $apellido_paterno;  ?>" name="apellido_paterno" placeholder="APELLIDO PATERNO" class="fechas form-control gehit"  />
		</div>
		<div class="col-xs-12 col-sm-4  col-md-4">
			<label for="apellido_materno">Apellido Materno: </label>
			<input id="apellido_materno" type="text" value="<?  echo $apellido_materno;  ?>" name="apellido_materno" placeholder="APELLIDO MATERNO" class="fechas form-control gehit"  />
		</div>
	</div><br>
	<div class="row">
		<div class="col-xs-12 col-sm-12  col-md-3">
			<label for="edad">Edad:</label>
			<input type="text" class="form-control" value="<?  echo $edad;  ?>" id="edad" placeholder="ESPECIFICA LA EDAD" >
		</div>
		<div class="col-xs-12 col-sm-12  col-md-3 input-group-lg">
			<label for="id_sexo">Sexo</label><br>
				<input type="radio" id="id_sexo" name="id_sexo" <? if($sexo == 'M'){ ?> checked <? } ?>  value="M"  >
				<label for="cv_sexo" >Masculino</label>&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="radio" id="id_sexo" name="id_sexo" <? if($sexo == 'F'){ ?> checked <? } ?> value="F"  >
				<label for="cv_sexo" >Femenino</label>
			</div>
	</div>