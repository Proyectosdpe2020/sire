<?php
session_start();
include('../../../../Conexiones/Conexion.php');

$link = $_POST['link'];
$unity_id = $_POST['unity_id'];

$sql = "SELECT [FirmaID]
                ,[Nombre]
                ,[ApellidoPaterno]  
                ,[ApellidoMaterno]
                ,[Titulo]
                ,[Cargo]
                ,[Funcion]
                ,[PosicionFirma]
            FROM [ESTADISTICAV2].[trimestral].[Firmas] WHERE idEnlace = $link AND idUnidad = $unity_id";

$params = array();
$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$result = sqlsrv_query( $conn, $sql , $params, $options );

$row_count = sqlsrv_num_rows( $result );

$records = array();

$signs = array(
    'elaborated_by' => array(
        'name' => '',
        'position' => '',
        'function' => ''
    ),
    'validated_by' => array(
        'name' => '',
        'position' => '',
        'function' => ''
    )
);

if($row_count > 0){
    while( $row = sqlsrv_fetch_array( $result) ) {


        $name = $row['Titulo'].' '.$row['Nombre'].' '.$row['ApellidoPaterno'].' '.$row['ApellidoMaterno'];
        $position = $row['Cargo'];
        $function = $row['Funcion'];
        

        switch($row['PosicionFirma']){
            case 1:
                $signs['elaborated_by']['name'] = $name;
                $signs['elaborated_by']['position'] = $position;
                $signs['elaborated_by']['function'] = $function;

                break;
            case 2:
                $signs['validated_by']['name'] = $name;
                $signs['validated_by']['position'] = $position;
                $signs['validated_by']['function'] = $function;

                break;
            case 3:
                $signs += ['third_person' => array(
                        'name' => $name,
                        'position' => $position,
                        'function' => $function
                    )];

                break;
            default:
        }
    }
}

$_SESSION['involved_people'] = $signs;

echo json_encode($signs, JSON_FORCE_OBJECT);

sqlsrv_close($conn);
?>
