<?php
include ("../../../Conexiones/Conexion.php");
include("../../../funcionesEstadoDeFuerza.php");	

$mandos = getDataMandos($conn);
for ($h=0; $h < sizeof($mandos); $h++) {
	$idMando = $mandos[$h][6];	$nom = $mandos[$h][0];	$pat = $mandos[$h][1];	$mat = $mandos[$h][2];
	$nombrecom = $nom." ".$pat." ".$mat;
?>
<option style="color: black; font-weight: bold;" value="<? echo $nombrecom; ?>" data-value="<? echo $idMando; ?>" data-id="<? echo $idMando; ?>"></option>
<?}?>
?>