<?
include ("../../../Conexiones/conexionSIMAJ.php");
include("../../../funcionesMandamientos.php");	

if (isset($_POST["ID_ESTADO_EMISOR"])){ $cv_entidad = $_POST["ID_ESTADO_EMISOR"]; }
?>

<option class="fontBold" value="0">Seleccione el municipio</option>
<? $municipios = getMunicipios($connSIMAJ, $cv_entidad);
for ($i=0; $i < sizeof($municipios); $i++) { 
	$cv_municipio = $municipios[$i][0];	$municipio = $municipios[$i][1]; ?>
	<option class="fontBold" value="<? echo $cv_municipio; ?>" ><? echo $municipio; ?></option>
<? } ?>