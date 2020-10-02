<?php
session_start();
include('../../../../Conexiones/Conexion.php');

$unity = $_POST['unity'];

$sql = "SELECT [nUnidad]
            FROM [ESTADISTICAV2].[dbo].[CatUnidad] 
            WHERE idUnidad = $unity";	

$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$result = sqlsrv_query( $conn, $sql , $params, $options );

$row_count = sqlsrv_num_rows( $result );

$unity_name = "";

if($row_count > 0){
    while( $row = sqlsrv_fetch_array( $result) ) {
        $unity_name = $row['nUnidad'];
    }
}

echo $unity_name;

sqlsrv_close($conn);

?>



