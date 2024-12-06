<?php
header('Content-Type: application/json; charset=utf-8');
include("../../../Conexiones/Conexion.php");
include("../../../Conexiones/conexionMedidas.php");
include("../../../funcionesMedidasProteccion.php");

if (isset($_POST["moduloID"])){ $moduloID = $_POST["moduloID"]; } 
if (isset($_POST["item_ID"])){ $item_ID = $_POST["item_ID"]; } 
if (isset($_POST["idMedida"])){ $idMedida = $_POST["idMedida"]; } 
if (isset($_POST['path'])){ $path = $_POST['path']; }

$response = array(); // Array para acumular la respuesta

switch($moduloID){
    case 1:
        $modulo = 'seguimientoMedidas';
        $query = "
            BEGIN                     
            BEGIN TRY 
            BEGIN TRANSACTION
                SET NOCOUNT ON                                    
                DELETE FROM medidas.seguimientos WHERE idSeguimiento = $item_ID AND idMedida = $idMedida
            COMMIT
            END TRY
            BEGIN CATCH 
                ROLLBACK TRANSACTION
                RAISERROR('No se realizó la transacción', 16, 1)
            END CATCH
            END
        "; 
    break;
}

$result = sqlsrv_query($connMedidas, $query, array(), array("Scrollable" => 'static'));
$response['first'] = $result ? "SI" : "NO"; // Guardar resultado de la consulta
$response['modulo'] = $modulo;

if (file_exists($path)){
    if(unlink($path)){
        $response['deleteS'] = "SI";
    } else {
        $response['deleteS'] = "NO";
        $response['mensaje'] = 'Error al eliminar el archivo';
    }
} else {
    $response['deleteS'] = "NO";
    $response['mensaje'] = 'Error. El archivo no existe';    
}

// Devolver la respuesta como JSON
echo json_encode($response);
?>
