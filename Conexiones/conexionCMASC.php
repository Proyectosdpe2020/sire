<?php



	$serverName = "localhost";
	//$connectionInfo = array( "Database"=>"michoacan-pg-prod", "CharacterSet" => "UTF-8");

	$connectionInfo = array( "Database"=>"EJERCICIOS", "UID"=>"SIREADMIN", "PWD"=>"S1I2R3E4AD5MON","CharacterSet" => "UTF-8");
	//$connectionInfo1 = array( "Database"=>"PRUEBA", "UID"=>"", "PWD"=>"","CharacterSet" => "UTF-8");
	$conCMASC = sqlsrv_connect( $serverName, $connectionInfo);

	if ($conCMASC) {
		//echo "Conexión establecida.<br />";
		} else {
		var_dump ( "No se Puede Conectar con la Base de ESTADISTICAV2.<br/>");
		die(print_r(sqlsrv_errors(), true));
	}

?>
