
	<?php

				include ("../../Conexiones/Conexion.php");
				include("../../funcionesPueDispo.php");	

				if (isset($_POST["newBrwosers_id"])){ $newBrwosers_id = $_POST["newBrwosers_id"]; }	

				$mandos = getDataMando($conn, $newBrwosers_id);

				$cargo  = $mandos[0][0];
				$funcion  = $mandos[0][1];
				$areadscri  = $mandos[0][2];



	?>


								<div class="col-xs-6 col-sm-4  col-md-3">
									<label for="heard">Cargo :</label>
									<input class="form-control mandda gehit" value="<? echo $cargo; ?>"  type="text" disabled>
								</div>
								<div class="col-xs-6 col-sm-4  col-md-2">
									<label for="heard">Función :</label>
									<input class="form-control mandda gehit" value="<? echo $funcion; ?>"  id="newBrwoser"  type="text" disabled>
								</div>
								<div class="col-xs-6 col-sm-4  col-md-3">
									<label for="heard">Area de Adscripción :</label>
									<input class="form-control mandda gehit" value="<? echo $areadscri; ?>" id="newBrwoser"  type="text" disabled>
								</div>
						
					

