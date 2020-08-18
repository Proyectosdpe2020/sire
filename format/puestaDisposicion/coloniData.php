	<?php

				include ("../../Conexiones/Conexion.php");
				include("../../funcionesPueDispo.php");	

				if (isset($_POST["newBrwosers_id"])){ $newBrwosers_id = $_POST["newBrwosers_id"]; }	

				$coloni = getDataColoniMunicipio($conn, $newBrwosers_id);

	?>


	
				<datalist id="newBrwosersColo">
																				<? 
																					
																							for ($o=0; $o < sizeof($coloni); $o++) { 								
																										$idColoni = $coloni[$o][0];
																										$codipos = $coloni[$o][1];
																										$nombre = $coloni[$o][2];
																										?>
																												<option style="color: black; font-weight: bold;" value="<? echo $nombre; ?>" data-value="<? echo $idColoni; ?>" data-id="<? echo $idColoni; ?>"></option>
																										<?
																							}

																				 ?>
																</datalist>
												<input class="form-control mandda gehit" onchange="getPOstalCode()" list="newBrwosersColo" id="newBrwoserColo" name="newBrwoserColo" type="text">

