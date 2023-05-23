<?php
	$serverName = "sii";
	
	$connSIGA = new mysqli(
		'172.16.1.19',
		'aplicaciones',
		'Pr0dappz2Q15_*',
		$serverName
	);

	if ($connSIGA->connect_error) {
		die("Connection to siga failed: " . $connSIGA->connect_error);
	}

?>
