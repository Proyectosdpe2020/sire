<?php



	$serverName = "172.16.1.134";
	//$connectionInfo = array( "Database"=>"michoacan-pg-prod", "CharacterSet" => "UTF-8");

	$connectionInfo = array( "Database"=>"SIMAJ", "UID"=>"Enrique.Martinez", "PWD"=>"MGeQp%b5ch%W^gU","CharacterSet" => "UTF-8");
	//$connectionInfo1 = array( "Database"=>"PRUEBA", "UID"=>"", "PWD"=>"","CharacterSet" => "UTF-8");
	$connSIMAJ = sqlsrv_connect( $serverName, $connectionInfo);

	if ($connSIMAJ) {
		//echo "Conexión establecida.<br />";
		} else {
		var_dump ( "No se Puede Conectar con la Base de SIMAJ.<br/>");
		die(print_r(sqlsrv_errors(), true));
	}

?>
