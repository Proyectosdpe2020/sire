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

	for ($h=0; $h < sizeof($data) ; $h++) {
		$inculpado = get_data_inculpado($conn, $data[$h][1]); 
		$dataFileMandamiento = getFileFromMAndamiento($conn, $data[$h][1]);
		?>
		<tr>
			<td><? echo $h+1; ?></td>
			<td><? echo $data[$h][3]; ?></td>
			<td><? echo $data[$h][4]; ?></td>
			<td><? echo $data[$h][5]; ?></td>
			<td><? echo $inculpado[0][5].' '.$inculpado[0][6].' '.$inculpado[0][7]; ?></td>
			<td><? echo $data[$h][6]; ?></td>
			<td><? echo $data[$h][7]; ?></td>
			<td><center><img src="img/editarMandamiento2.png" data-toggle="modal" href="#mandamientos"  onclick="modalMandamientos_registro(0, <? echo $idEnlace; ?>,<? echo $data[$h][1]; ?>,18, 1, <?echo $idfisca; ?>, <?echo $idUnidad; ?>);"><!--<img src="img/resumenMandamiento.png"></center>-->
			</td>
				<td><center><img src="img/pdfMandamiento2.png" data-toggle="modal" href="#myModaVerPDFmandamiento"  onclick="modalMandamientos_PDF(<? echo $data[$h][1]; ?>);"><!--<img src="img/resumenMandamiento.png"></center>-->
							</td>
		</tr>
	<? } ?>




