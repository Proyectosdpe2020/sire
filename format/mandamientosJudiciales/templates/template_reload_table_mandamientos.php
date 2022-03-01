	<?php
				session_start();
				include ("../../../Conexiones/Conexion.php");
				include("../../../funciones.php");	
				include ("../../../Conexiones/conexionSIMAJ.php");
    include("../../../funcionesMandamientos.php");		
?>

<? 
if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }
if (isset($_POST["idfisca"])){ $idfisca = $_POST["idfisca"]; }
if (isset($_POST["idUnidad"])){ $idUnidad = $_POST["idUnidad"]; }


$data = get_data_mandamientos_dia($conn, $idEnlace);
for ($h=0; $h < sizeof($data) ; $h++) { ?>
<tr>
							<td><? echo $h+1; ?></td>
							<td><? echo $data[$h][3]; ?></td>
							<td><? echo $data[$h][4]; ?></td>
							<td><? echo $data[$h][5]; ?></td>
						<!--	<td>sin dato</td>-->
							<td><? echo $data[$h][6]; ?></td>
							<td><? echo $data[$h][7]; ?></td>
							<td><center><img src="img/editarMandamiento2.png" data-toggle="modal" href="#mandamientos"  onclick="modalMandamientos_registro(0, <? echo $idEnlace; ?>,<? echo $data[$h][1]; ?>,18, 1, <?echo $idfisca; ?>, <?echo $idUnidad; ?>);"><!--<img src="img/resumenMandamiento.png"></center>-->
							</td>
						</tr>
<? } ?>
								


								
