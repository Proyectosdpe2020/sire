
	<?php
	session_start();
	include ("../Conexiones/Conexion.php");
	include("../funciones2.php");	
	include ("../Conexiones/conexionSicap.php");
	include("../funcioneSicap.php");

	if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }
	if (isset($_POST["f"])){ $f = $_POST["f"]; }

		$envi = getEnviadoEnlaceFromt($conn, $idEnlace, $f);
		$menom = Mes_Nombre($envi[0][1]);
	?>

<select  style="color: black; font-weight: bold !important;" class="form-control browser-default custom-select"  id="selEnlacess">
																																											<option value="Septiembre" selected><? echo $menom; ?></option>
																																	</select>