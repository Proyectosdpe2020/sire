	<?php
				session_start();
				include ("../../../Conexiones/Conexion.php");
				include("../../../funciones.php");	
				include ("../../../Conexiones/conexionSIMAJ.php");
    include("../../../funcionesMandamientos.php");		
?>

<? 
if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }
if (isset($_POST["mes_mandamiento"])){ $mes_mandamiento = $_POST["mes_mandamiento"]; }
if (isset($_POST["anio_mandamiento"])){ $anio_mandamiento = $_POST["anio_mandamiento"]; }
if (isset($_POST["idUnidad"])){ $idUnidad = $_POST["idUnidad"]; }
if (isset($_POST["fiscalia_selecciconada"])){ $fiscalia_selecciconada = $_POST["fiscalia_selecciconada"]; }


$data = get_data_mandamientos_dia_administrador($conn, $idEnlace, $fiscalia_selecciconada, $mes_mandamiento , $anio_mandamiento );
for ($h=0; $h < sizeof($data) ; $h++) {
	$inculpado = get_data_inculpado($conn, $data[$h][1]); ?>
<tr>
							<td><? echo $h+1; ?></td>
							<td><? if($data[$h][11] == 2 ){ echo $data[$h][9]; }else{ echo $data[$h][10]; } ?></td>
							<td><? echo $data[$h][3]; ?></td>
							<td><? echo $data[$h][4]; ?></td>
							<td><? echo $data[$h][8]->format('Y-m-d'); ?></td>
							<td><? echo $data[$h][5]; ?></td>
						 <td><? echo $inculpado[0][5].' '.$inculpado[0][6].' '.$inculpado[0][7]; ?></td>
							<td><? echo $data[$h][6]; ?></td>
							<td><? echo $data[$h][7]; ?></td>
							<td><center><img src="img/editarMandamiento2.png" data-toggle="modal" href="#mandamientos"  onclick="modalMandamientos_registro(0, <? echo $idEnlace; ?>,<? echo $data[$h][1]; ?>,18, 1,0, 0);"><!--<img src="img/resumenMandamiento.png"></center>-->
							</td>
						</tr>
<? } ?>
					