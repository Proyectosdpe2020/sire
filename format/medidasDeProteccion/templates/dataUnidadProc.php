<?php
include ("../../../Conexiones/conexionMedidas.php");
include("../../../funcionesMedidasProteccion.php");	

if (isset($_POST["idFiscaliaProc"])){ $idFiscaliaProc = $_POST["idFiscaliaProc"]; }	
$data = getDataUnidad($connMedidas, $idFiscaliaProc);
?>
<div class="col-xs-12 col-sm-12  col-md-3">
	<label for="idUnidadProc">Unidad de procedencia :</label>
	<select class="dataAutocomplet form-control browser-default custom-select" id="idUnidadProc">
	<?for ($h=0; $h < sizeof($data); $h++) { 
		$idUnidad = $data[$h][0];	$nombreUnidad = $data[$h][1]; ?>
		<option class="fontBold" value="<? echo $idUnidad; ?>" > <? echo $nombreUnidad; ?> </option>
	<? } ?>
	</select>
</div>	
						
					

