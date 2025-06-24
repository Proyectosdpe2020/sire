<?php
session_start();
include("../../../Conexiones/conexionSicap.php");
include("../../../funcioneSicap.php");
include("../../../Conexiones/Conexion.php");
include("../../../funciones.php");
include("../../../funcioneLit.php");

$nuc = $_POST['nuc'];
$idMp = $_POST['idMp'];

$query = "SELECT 
    n.idEstatusNucs,
    e.nombre as Estatus,
    n.nuc,
    c.Expediente,
    mp.nombre + ' ' + mp.paterno + ' ' + mp.materno as nombre,
    u.nUnidad AS NombreUnidadLitigacion,
    f.nFiscalia AS NombreFiscalia,
    CASE
        WHEN n.[mes] = 1 THEN 'Enero'
        WHEN n.[mes] = 2 THEN 'Febrero'
        WHEN n.[mes] = 3 THEN 'Marzo'
        WHEN n.[mes] = 4 THEN 'Abril'
        WHEN n.[mes] = 5 THEN 'Mayo'
        WHEN n.[mes] = 6 THEN 'Junio'
        WHEN n.[mes] = 7 THEN 'Julio'
        WHEN n.[mes] = 8 THEN 'Agosto'
        WHEN n.[mes] = 9 THEN 'Septiembre'
        WHEN n.[mes] = 10 THEN 'Octubre'
        WHEN n.[mes] = 11 THEN 'Noviembre'
        WHEN n.[mes] = 12 THEN 'Diciembre'
        ELSE 'Desconocido' 
    END as nombreMes,
    n.anio
FROM ESTADISTICAV2.dbo.estatusNucs n
INNER JOIN dbo.estatus e ON e.idEstatus = n.idEstatus
INNER JOIN dbo.mp mp ON mp.idMp = n.idMp
INNER JOIN dbo.CatUnidad u ON u.idUnidad = n.idUnidad
LEFT JOIN PRUEBA.dbo.Carpeta c on c.CarpetaID = n.idCarpeta
LEFT JOIN dbo.CatFiscalia f ON f.idFiscalia = u.idFiscalia
WHERE n.nuc = ? AND n.idEstatus = 181 AND n.idMp != ?";

$params = array($nuc, $idMp);
$stmt = sqlsrv_query($conn, $query, $params);

if ($stmt === false) {
    echo json_encode(['success' => false, 'error' => 'Error en la consulta: ' . print_r(sqlsrv_errors(), true)]);
    exit;
}

$row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

if ($row) {
    echo json_encode([
        'success' => true,
        'existeRegistro' => true,
        'datos' => [
            'estatus' => $row['Estatus'],
            'nuc' => $row['nuc'],
            'expediente' => $row['Expediente'],
            'nombreMp' => $row['nombre'],
            'unidad' => $row['NombreUnidadLitigacion'],
            'fiscalia' => $row['NombreFiscalia'],
            'mes' => $row['nombreMes'],
            'anio' => $row['anio']
        ]
    ]);
} else {
    echo json_encode(['success' => true, 'existeRegistro' => false]);
}
?>