<?php

/*Obtener lista de municipios*/
$query = "SELECT * FROM pueDisposi.CatMunicipios";
$res =  sqlsrv_query($conn, $query, array(), array("Scrollable" => SQLSRV_CURSOR_KEYSET ));

/*Obtener tipo de delitos*/
$query1 = "SELECT * FROM pueDisposi.tipoDelitos";
$res1 = sqlsrv_query($conn, $query1, array(), array("Scrollable" => SQLSRV_CURSOR_KEYSET ));

$query2 = "SELECT * FROM pueDisposi.tipoDelitos";
$res2 = sqlsrv_query($conn, $query2, array(), array("Scrollable" => SQLSRV_CURSOR_KEYSET ));


?>