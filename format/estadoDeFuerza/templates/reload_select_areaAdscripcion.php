<?php
include ("../../../Conexiones/Conexion.php");
include("../../../funcionesEstadoDeFuerza.php");	

if (isset($_POST["idFiscalia"])){ $idFiscalia = $_POST["idFiscalia"]; }
?>
<option style="color: black; font-weight: bold;" value="NO" >Selecciona</option>
<?$getAreaAdscripcion = areaAdscripcion($conn, $idFiscalia);
for ($i=0; $i < sizeof($getAreaAdscripcion); $i++) {
	$idAreaAdscripcion = $getAreaAdscripcion[$i][2];	$nombre = $getAreaAdscripcion[$i][3]; ?>
	<option style="color: black; font-weight: bold;" value="<? echo $idAreaAdscripcion; ?>" ><? echo $nombre; ?></option>
<? } ?>