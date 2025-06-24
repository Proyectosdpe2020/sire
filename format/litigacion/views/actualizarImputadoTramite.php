<?php
header('Content-Type: application/json');
include("../../../Conexiones/conexionSicap.php");
include("../../../funcioneSicap.php");

include("../../../Conexiones/Conexion.php");
include("../../../funciones.php");
include("../../../funcioneLit.php");

$idImputadoTramite = $_POST['idImputadoTramite'];
$nombre = $_POST['nombre'];
$paterno = $_POST['paterno'];
$materno = $_POST['materno'];
$idCarpetaTramite = $_POST['idCarpetaTramite'];


$query = "UPDATE tramiteImputadoLitigacion 
          SET nombre = ?, apellidoPaterno = ?, apellidoMaterno = ? 
          WHERE idImputadoTramite = ?";

$params = array($nombre, $paterno, $materno, $idImputadoTramite);
$stmt = sqlsrv_query($conn, $query, $params);

if($stmt === false) {
    echo json_encode(['success' => false, 'message' => 'Error al actualizar']);
    exit;
}

// Segunda consulta - Obtener datos actualizados con número de fila
$querySelect = "SELECT ROW_NUMBER() OVER(ORDER BY idImputadoTramite) as rowNum,
                       idImputadoTramite, 
                       nombre, 
                       apellidoPaterno, 
                       apellidoMaterno 
                FROM tramiteImputadoLitigacion 
                WHERE idCarpetaTramite = ?";

$params = array($idCarpetaTramite);
$stmt = sqlsrv_query($conn, $querySelect, $params);

if($stmt === false) {
    echo json_encode(['success' => false, 'message' => 'Error al obtener datos actualizados.']);
    exit;
}


$html = '';
$hasRows = false;

while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $hasRows = true;
    $html .= '<tr>';
    $html .= '<td class="tdRowMainData negr">'.($row['rowNum']).'</td>';
    $html .= '<td class="tdRowMainData negr">'.htmlspecialchars($row['nombre']).' '.htmlspecialchars($row['apellidoPaterno']).' '.htmlspecialchars($row['apellidoMaterno']).'</td>';
    $html .= '<td class="tdRowMainData">';
    $html .= '<button style="width: 100%; height:34%; font-size: 1em; box-sizing: border-box;" type="button" onclick="editarTramiteImputado('.$row['idImputadoTramite'].')" class="btn-success btn-sm redondear"><span style="color: white !important;" class="glyphicon glyphicon-pencil"></span> Editar </button>';
    $html .= '</td>';
    $html .= '<td class="tdRowMainData">';
    $html .= '<button style="width: 100%; height:34%; font-size: 1em; box-sizing: border-box;" type="button" onclick="eliminarTramiteImputado('.$row['idImputadoTramite'].' , '.$idCarpetaTramite.')" class="btn-danger btn-sm redondear"><span style="color: white !important;" class="glyphicon glyphicon-trash"></span> Eliminar </button>';
    $html .= '</td>';
    $html .= '</tr>';
}

if(!$hasRows) {
    $html = '<tr><td colspan="4" class="text-center">No hay imputados registrados</td></tr>';
}


echo json_encode([
    'success' => true,
    'html' => $html
]);
?>