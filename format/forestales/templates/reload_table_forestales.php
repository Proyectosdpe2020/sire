<!--RECARGAR TABLA DESPUES DE INSERTAR INFORMACION EN LA BD-->
<?php
include ("../../../Conexiones/Conexion.php");
include("../../../funcionesForestales.php");	

if (isset($_GET["anioCapturando"])){ $anioCapturando = $_GET["anioCapturando"]; }	
$dataEnviado = getMesValidaEnviado($conn); //Verificar bandera ultimo mes
$anioCapturando = $dataEnviado[0][0];
$mesCapturando = $dataEnviado[0][1];
$enviadoArchivo_flagEditar = $dataEnviado[0][3];
$anioCaptura = date("Y");

?>

	<? $data = getHistoricoForestales($conn, $anioCapturando);
	for ($i=0; $i < sizeof($data); $i++) {  ?>
		<tr>
			<td class="textCent"><strong><? echo $data[$i][3]; ?></strong></td>
   <td class="textCent"><strong><? echo $data[$i][4]; ?></strong></td>
   <td class="textCent"><strong><? echo $data[$i][12]; ?></strong></td>
   <td class="textCent"><strong><? echo $data[$i][13]; ?></strong></td>
   <td class="textCent"><strong><? echo $data[$i][14]; ?></strong></td>
   <td class="textCent"><strong><? echo $data[$i][15]; ?></strong></td>
   <td class="textCent"><strong><? echo $data[$i][16]; ?></strong></td>
   <td class="textCent"><strong><? echo $data[$i][17]; ?></strong></td>
   <td class="textCent"><strong><? echo $data[$i][18]; ?></strong></td>
   <td class="textCent"><strong><center><?if($anioCaptura == $data[$i][19] && $mesCapturando == $data[$i][2] && $enviadoArchivo_flagEditar == 1){ ?>
   <label class="glyphicon glyphicon-edit" data-toggle="modal" href="" onclick="showModalVerInf(<? echo $data[$i][0]; ?>, 1, <? echo $anioCapturando; ?>, 
   <? echo $mesCapturando; ?>)" style="width: 95%; cursor: pointer; font-weight: bold; color: green;"> Editar </label><? }else{ ?>
   <label class="glyphicon glyphicon-eye-open" data-toggle="modal" href="" onclick="showModalVerInf(<? echo $data[$i][0]; ?>, 0, <? echo $anioCapturando; ?>, 
   <? echo $mesCapturando; ?>)" style="width: 95%; cursor: pointer; font-weight: bold; color: green;"> Ver </label></center></strong></td><? } ?>
 </tr> 
<? } ?>