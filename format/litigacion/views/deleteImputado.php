<?php
header('Content-Type: application/json');
include("../../../Conexiones/conexionSicap.php");
include("../../../funcioneSicap.php");

include("../../../Conexiones/Conexion.php");
include("../../../funciones.php");
include("../../../funcioneLit.php");

$idImputadoTramite = $_POST['idImputadoTramite'];
$idCarpetaTramite = $_POST['idCarpetaTramite'];

// Proceder con la eliminación
$queryEliminar = "DELETE FROM tramiteImputadoLitigacion
                     WHERE idImputadoTramite = ?";


$params = array($idImputadoTramite);
$stmt = sqlsrv_query($conn, $queryEliminar, $params);

if($stmt === false) {
    echo json_encode(['success' => false, 'message' => 'Error al eliminar']);
    exit;
}

$rowsAffected = sqlsrv_rows_affected($stmt);

if ($rowsAffected > 0) {

    // Segunda consulta - Obtener datos actualizados con número de fila
    $querySelect = "SELECT ROW_NUMBER() OVER(ORDER BY idImputadoTramite) as rowNum,
                       idImputadoTramite, 
                       nombre, 
                       apellidoPaterno, 
                       apellidoMaterno 
                FROM tramiteImputadoLitigacion 
                WHERE idCarpetaTramite = ?";

    $params = array($idCarpetaTramite);
    $stmtTable = sqlsrv_query($conn, $querySelect, $params);

    if($stmtTable === false) {
        echo json_encode(['success' => false, 'message' => 'Error al obtener datos actualizados']);
        exit;
    }


    $html = '';
    $hasRows = false;

    while($row = sqlsrv_fetch_array($stmtTable, SQLSRV_FETCH_ASSOC)) {
        $hasRows = true;
        $html .= '<tr>';
        $html .= '<td class="tdRowMainData negr">'.($row['rowNum']).'</td>';
        $html .= '<td class="tdRowMainData negr">'.htmlspecialchars($row['nombre']).' '.htmlspecialchars($row['apellidoPaterno']).' '.htmlspecialchars($row['apellidoMaterno']).'</td>';
        $html .= '<td class="tdRowMainData">';
        $html .= '<button style="width: 100%; height:34%; font-size: 1em; box-sizing: border-box;" type="button" onclick="editarTramiteImputado('.$row['idImputadoTramite'].')" class="btn-success btn-sm redondear"><span style="color: white !important;" class="glyphicon glyphicon-pencil"></span> Editar </button>';
        $html .= '</td>';
        $html .= '<td class="tdRowMainData">';
        $html .= '<button style="width: 100%; height:34%; font-size: 1em; box-sizing: border-box;" type="button" onclick="eliminarTramiteImputado('.$row['idImputadoTramite'].' ,  '.$idCarpetaTramite.' )" class="btn-danger btn-sm redondear"><span style="color: white !important;" class="glyphicon glyphicon-trash"></span> Eliminar </button>';
        $html .= '</td>';
        $html .= '</tr>';
    }

    if(!$hasRows) {
        $html = '<tr><td colspan="4" class="text-center">No hay imputados registrados</td></tr>';
    }


    echo json_encode([
        'success' => true,
        'message' => 'Imputado eliminado correctamente',
        'rowsAffected' => $rowsAffected,
        'html' => $html
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'No se pudo eliminar el imputado'
    ]);
}


?>