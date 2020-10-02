<?php
session_start();
include("../../../../Conexiones/Conexion.php");

$link = $_GET['link'];
$period = $_GET['period'];
$year = $_GET['year'];
$sendedReport = $_GET['sendedReport'];

$sql = "UPDATE [ESTADISTICAV2].[dbo].[enlaceMesValidaEnviado]
        SET [enviado] = $sendedReport
        WHERE idFormato = 11 and mesCap = $period and idAnio = $year and idEnlace = $link";

$stmt = sqlsrv_query( $conn, $sql);

sqlsrv_fetch($stmt); 
?>




