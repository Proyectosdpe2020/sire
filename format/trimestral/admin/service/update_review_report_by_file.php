<?php
session_start();
include("../../../../Conexiones/Conexion.php");

$link = $_GET['link'];
$period = $_GET['period'];
$year = $_GET['year'];

$file = $_GET['file'];
$status = $_GET['status'];

$sql = "UPDATE [ESTADISTICAV2].[dbo].[archivo]
        SET [estatusArch] = '$status'
        WHERE idArchivo = $file";

$stmt = sqlsrv_query( $conn, $sql);

sqlsrv_fetch($stmt); 

if($status == "rec"){
   
        $sql = "UPDATE [ESTADISTICAV2].[dbo].[enlaceMesValidaEnviado]
        SET [enviadoArchivo] = 0
        WHERE idFormato = 11 and mesCap = $period and idAnio = $year and idEnlace = $link";

        $stmt = sqlsrv_query( $conn, $sql);

        sqlsrv_fetch($stmt); 

}


?>




