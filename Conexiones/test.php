<?php



	$serverName = "localhost";
	//$connectionInfo = array( "Database"=>"michoacan-pg-prod", "CharacterSet" => "UTF-8");

	$connectionInfo = array( "Database"=>"test", "UID"=>"", "PWD"=>"","CharacterSet" => "UTF-8");
	//$connectionInfo1 = array( "Database"=>"PRUEBA", "UID"=>"", "PWD"=>"","CharacterSet" => "UTF-8");
	$conn = sqlsrv_connect( $serverName, $connectionInfo);

	if ($conn) {
		//echo "Conexión establecida.<br />";
		} else {
		var_dump ( "No se Puede Conectar con la Base de ESTADISTICAV2.<br/>");
		die(print_r(sqlsrv_errors(), true));
	}

?>
