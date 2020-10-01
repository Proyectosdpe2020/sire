
	<?php
	session_start();
	include ("../Conexiones/Conexion.php");
	include("../funciones2.php");	
	include ("../Conexiones/conexionSicap.php");
	include("../funcioneSicap.php");

	if (isset($_POST["enlac"])){ $enlac = $_POST["enlac"]; }
	$forms = getFormatsFromEnlacs($conn, $enlac);

	?>

	<select class="form-control browser-default custom-select" onchange="loadTableMpsEnlaceFormato2()" id="selFormatoes"> 
		                         
			<? 
						for ($i=0; $i < sizeof($forms) ; $i++) { 
							if($forms[$i][1] == 1){ $formsName = "Carpetas de Investigación"; }
							if($forms[$i][1] == 4){ $formsName = "Litigación"; }
							?>
										<option style="color: black; font-weight: bold;" value="<? echo $forms[$i][1]; ?>" > <? echo $formsName; ?> </option>
							<?
						}
			?>
</select>