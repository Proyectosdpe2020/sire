<?php 
include ("../../Conexiones/Conexion.php");
include ("../../funcionesBusquedas.php");

if (isset($_POST["tipo_busqueda"])){ $tipo_busqueda = $_POST["tipo_busqueda"]; }
if (isset($_POST["imputado"])){ $imputado = $_POST["imputado"]; $imputado = implode(' ',array_filter(explode(' ',$imputado)));  /*Eliminamos espacios*/ }
if (isset($_POST["nuc"])){ $nuc = $_POST["nuc"]; }

$data_imputado = get_data_busqueda($conn, $tipo_busqueda, $imputado, $nuc);

if( sizeof($data_imputado)  > 0 ){
for ($i=0; $i < sizeof($data_imputado) ; $i++) { ?>
	<tr>
		<td><? echo $i+1; ?></td> 
		<td><? echo $data_imputado[$i][1]; ?></td> 
		<td><? echo $data_imputado[$i][9]; ?></td> 
		<td><? echo $data_imputado[$i][2]; ?></td> 
		<td><? echo $data_imputado[$i][3]; ?></td> 
		<td><? echo $data_imputado[$i][4]; ?></td>
		<td><? echo $data_imputado[$i][5]; ?></td>  
		<td><? echo $data_imputado[$i][10]; ?></td> 
		<td><center><span class="reporte btn btn-default glyphicon glyphicon-download" onclick="descargarAcuse('<?echo $data_imputado[$i][10]; ?>')"> ACUSE</span></center></td>
	</tr>
	<? }
}else{ ?>
	<tr>
		<td></td> 
		<td></td> 
		<td></td> 
		<td></td> 
		<td><center>No existe información alguna especto a la SUSPENSIÓN CONDICIONAL DEL PROCESO Y/O ACUERDO REPARATORIO y/o PROCEDIMIENTO ABREVIADO</center></td> 
		<td></td>
		<td></td>  
		<td></td> 
		<td><center><span class="reporte btn btn-default glyphicon glyphicon-download" onclick="descargarAcuse('<?echo $imputado; ?>')"> ACUSE</span></center></td>
	</tr>
	</tr>
<? } ?>
