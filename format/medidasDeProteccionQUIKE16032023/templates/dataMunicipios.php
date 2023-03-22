<?php
include ("../../../Conexiones/conexionMedidas.php");
include ("../../../Conexiones/conexionSicap.php");
include("../../../funcionesMedidasProteccion.php");	

if (isset($_POST["entidad"])){ $entidad = $_POST["entidad"]; }	
$data = getDataMunicipios($conSic, $entidad);
$idMunicipio  = $data[0][0];
$nombre = $data[0][1];
?>
<div class="col-xs-12 col-sm-12  col-md-3">
	<label for="municipio">Municipio: <span class="aste">(*)</span></label>
	<select class="dataAutocomplet form-control browser-default custom-select" id="municipio">
	<?for ($h=0; $h < sizeof($data); $h++) { 
		$idMunicipio = $data[$h][0];	$nombre = $data[$h][1]; ?>
		<option class="fontBold" value="<? echo $idMunicipio; ?>" > <? echo $nombre; ?> </option>
	<? } ?>
	</select>
</div>	

