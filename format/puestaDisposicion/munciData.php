	<?php

				include ("../../Conexiones/Conexion.php");
				include("../../funcionesPueDispo.php");	

				if (isset($_POST["newBrwosers_id"])){ $newBrwosers_id = $_POST["newBrwosers_id"]; }	

				$munis = getDataMunicipiosFiscalia($conn, $newBrwosers_id);

?>
<option ></option>
<?

																					
																							for ($o=0; $o < sizeof($munis); $o++) { 								
																										$idfis = $munis[$o][0];
																										$nombrefis = $munis[$o][1];
																										?>
																											<option value="<?echo $idfis; ?>" ><? echo $nombrefis;?></option>
																										<?
																							}

																				 ?>


	
				
