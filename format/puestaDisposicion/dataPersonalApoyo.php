
	<?php

				include ("../../Conexiones/Conexion.php");
				include("../../funcionesPueDispo.php");	

				if (isset($_POST["mando_ID"])){ $mando_ID = $_POST["mando_ID"]; }	

				$mandos = getDataMando($conn, $mando_ID);

				$cargo  = $mandos[0][0];
				$funcion  = $mandos[0][1];
				$areadscri  = $mandos[0][2];


	?>


								<div class="col-xs-12 col-sm-12  col-md-4">
									<label for="heard">Cargo :</label>
									<input class="form-control mandda gehit" value="<? echo $cargo; ?>" id="cargoPersonalApoyo"  type="text" disabled>
								</div>
								<div class="col-xs-12 col-sm-12  col-md-4">
									<label for="heard">Función :</label>
									<input class="form-control mandda gehit" value="<? echo $funcion; ?>"  id="funcionPersonalApoyo"  type="text" disabled>
								</div>
								<div class="col-xs-12 col-sm-12  col-md-12">
									<label for="heard">Area de Adscripción :</label>
									<input class="form-control mandda gehit" value="<? echo $areadscri; ?>" id="adscPersonalApoyo"  type="text" disabled>
								</div>
						
					

