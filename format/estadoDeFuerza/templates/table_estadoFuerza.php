<?php
include ("../../../Conexiones/Conexion.php");
include("../../../funcionesEstadoDeFuerza.php");	

if (isset($_POST["idMando"])){ $idMando = $_POST["idMando"]; }
if (isset($_POST["areaAdsc"])){ $areaAdsc = $_POST["areaAdsc"]; }	

$mandos = getDataMandoTable($conn, $idMando, $areaAdsc);
$cont = 1;
for ($i = 0; $i < sizeof($mandos); $i++) { ?>
	<tr>
		<td class="textCent"><? echo $cont; ?></td>
		<td><? echo $mandos[$i][1]; ?></td>
		<td class="textCent"><? echo $mandos[$i][5]; ?></td>
		<td class="textCent"><? echo $mandos[$i][6]; ?></td>
		<td class="textCent"><? echo$mandos[$i][7]; ?></td>
		<td class="textCent"><? echo$mandos[$i][11]; ?></td>
		<td class="textCent">
     <label class="glyphicon glyphicon-edit" data-toggle="modal" onclick="showModalEditarMando(<? echo $mandos[$i][0]; ?>)" style="width: 95%; cursor: pointer; font-weight: bold; color: green;"> Editar </label>
  </td>
<td class="textCent">
     <label class="glyphicon glyphicon-download" data-toggle="modal" onclick="descargarReporteGeneral(<? echo $mandos[$i][0]; ?>)" style="width: 95%; cursor: pointer; font-weight: bold; color: green;"> Descargar </label>
  </td>
	</tr>
	<? $cont+=1; } 
?>





						
						
					

