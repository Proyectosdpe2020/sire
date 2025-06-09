<?php
include ("../../../Conexiones/conexionMedidas.php");
include ("../../../Conexiones/conexionSicap.php");
include("../../../funcionesMedidasProteccion.php");	

if (isset($_POST["idResolucion"])){ $idResolucion = $_POST["idResolucion"]; }	
if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }	
if (isset($_POST["idMedida"])){ $idMedida = $_POST["idMedida"]; }
if (isset($_POST["tipoResolucion"])) { $tipoResolucion = $_POST["tipoResolucion"]; }	

$getDataResolucion = getDataResolucionesUnit($connMedidas, $idMedida, $idResolucion, $tipoResolucion); 

$resolucion = $getDataResolucion[2];
$tipoRes = $getDataResolucion[3];
$observacionRes = $getDataResolucion[4];


?>     

<div class="row">
	<div class="col-xs-12 col-sm-12  col-md-2">
		<button type="button" class="btn btn-primary btn-lg" onclick="updateResolucionUnit(<?php echo $idEnlace; ?> , <?echo $idResolucion; ?>, <?php echo $idMedida; ?>, '<?php echo addslashes($resolucion) ?>')">Actualizar información</button>
	</div>
</div><br>

<div class="row">
	<div class="col-xs-12 col-sm-12  col-md-2">
		<label for="resolucion"> <? echo ucfirst($resolucion) ?> <span class="aste">(*)</span></label>
		<select class="form-control" id="resolucionValue">
				<option value="">Seleccione</option>
			<option class="fontBold" value="1" <?if($tipoRes == 1 ){ ?> selected <? } ?> >Si</option>
			<option class="fontBold" value="0" <?if($tipoRes == 0 ){ ?> selected <? } ?> >No</option>
		</select>
	</div>
	<div class="col-xs-12 col-sm-12  col-md-4">
		<label for="observacionResolucion">Observación: <span class="aste">(*)</span></label>
		<input class="form-control mandda gehit" value="<?echo $observacionRes; ?>"  id="observacionResolucion"  type="text">
	</div>
</div>