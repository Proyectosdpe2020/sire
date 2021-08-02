	<?php

				include ("../../Conexiones/Conexion.php");
				include("../../funcionesPueDispo.php");	

				if (isset($_POST["newBrwosers_id"])){ $newBrwosers_id = $_POST["newBrwosers_id"]; }	

				$lineas = getDataLineaVehicle($conn, $newBrwosers_id);

	?>
<option ></option>
<?
 
																					
																							for ($o=0; $o < sizeof($lineas); $o++) { 								
																										$idLinea = $lineas[$o][0];
																										$nombre = $lineas[$o][1];
																										?>
																												<option style="color: black; font-weight: bold;" value="<? echo $idLinea; ?>" ><?echo $nombre ?></option>
																										<?
																							}

																				 ?>

