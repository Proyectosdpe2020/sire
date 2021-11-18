<?php
	
	
	$serverName = "172.16.1.27"; 
	//$connectionInfo = array( "Database"=>"michoacan-pg-prod", "CharacterSet" => "UTF-8");

	$connectionInfo = array( "Database"=>"michoacan-pg-prod", "UID"=>"sicap", "PWD"=>"s1c4p.2020","CharacterSet" => "UTF-8");
	$connSIGI = sqlsrv_connect( $serverName, $connectionInfo);
	
	if( $connSIGI ) {
		//echo "Se Conecto Correctamente.<br />";
		}else{
		  var_dump (  "No se ha Podido Conectar con SIGI.<br />" . print_r( sqlsrv_errors(), true ));
		die( print_r( sqlsrv_errors(), true));
	}
	if ( sqlsrv_begin_transaction( $connSIGI ) === false ) {
		die( print_r( sqlsrv_errors(), true ));
	}
?>
