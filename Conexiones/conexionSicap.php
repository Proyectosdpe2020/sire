<?php



	$serverName = "localhost";
	//$connectionInfo = array( "Database"=>"michoacan-pg-prod", "CharacterSet" => "UTF-8");

	$connectionInfo = array( "Database"=>"PRUEBA", "UID"=>"sicap_app", "PWD"=>"fiscalia_2023","CharacterSet" => "UTF-8");
	//$connectionInfo1 = array( "Database"=>"PRUEBA", "UID"=>"", "PWD"=>"","CharacterSet" => "UTF-8");
	$conSic = sqlsrv_connect( $serverName, $connectionInfo);

	if ($conSic) {
		//echo "Conexión establecida con sicap_cursos.<br />";
		} else {
		var_dump ( "No se Puede Conectar con la Base de sicap_cursos.<br/>");
		die(print_r(sqlsrv_errors(), true));
	}

?>
