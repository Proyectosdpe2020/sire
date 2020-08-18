	<?php

				include ("../../Conexiones/Conexion.php");
				include("../../funcionesPueDispo.php");	

				if (isset($_POST["newBrwosers_id"])){ $newBrwosers_id = $_POST["newBrwosers_id"]; }	

				$codePostal = getDataCodePostal($conn, $newBrwosers_id);
				$code = $codePostal[0][0];
	?>

<input class="form-control"  id="codepostalidPeusta" value="<? echo $code; ?>"  type="text" readonly="">