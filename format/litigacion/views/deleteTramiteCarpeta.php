<?php
session_start();
include("../../../Conexiones/conexionSicap.php");
include("../../../funcioneSicap.php");
include("../../../Conexiones/Conexion.php");
include("../../../funciones.php");
include("../../../funcioneLit.php");

try {
    if (!isset($_POST['idEstatusNucs'])) {
        throw new Exception('Parámetros incompletos');
    }

    $idEstatusNucs = $_POST['idEstatusNucs'];

    // Iniciar transacción
    sqlsrv_begin_transaction($conn);

    try {
        // 1. Primero obtener el idCarpetaTramite de tramiteLitigacion
        $queryGetCarpetaTramite = "SELECT idCarpetaTramite FROM ESTADISTICAV2.dbo.tramiteLitigacion WHERE idEstatusNucs = ?";
        $params = array($idEstatusNucs);
        $stmt = sqlsrv_query($conn, $queryGetCarpetaTramite, $params);

        if ($stmt === false) {
            throw new Exception(print_r(sqlsrv_errors(), true));
        }

        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        $idCarpetaTramite = $row ? $row['idCarpetaTramite'] : null;

        if ($idCarpetaTramite) {
            // 2. Eliminar registros de imputados
            $queryDeleteImputados = "DELETE FROM ESTADISTICAV2.dbo.tramiteImputadoLitigacion WHERE idCarpetaTramite = ?";
            $params = array($idCarpetaTramite);
            $stmt = sqlsrv_query($conn, $queryDeleteImputados, $params);

            if ($stmt === false) {
                throw new Exception(print_r(sqlsrv_errors(), true));
            }

            // 3. Eliminar registro de tramiteLitigacion
            $queryDeleteTramite = "DELETE FROM ESTADISTICAV2.dbo.tramiteLitigacion WHERE idCarpetaTramite = ?";
            $params = array($idCarpetaTramite);
            $stmt = sqlsrv_query($conn, $queryDeleteTramite, $params);

            if ($stmt === false) {
                throw new Exception(print_r(sqlsrv_errors(), true));
            }
        }

        // 4. Finalmente eliminar el registro de estatusNucs
        $queryDeleteEstatus = "DELETE FROM ESTADISTICAV2.dbo.estatusNucs WHERE idEstatusNucs = ? AND idEstatus = 181";
        $params = array($idEstatusNucs);
        $stmt = sqlsrv_query($conn, $queryDeleteEstatus, $params);

        if ($stmt === false) {
            throw new Exception(print_r(sqlsrv_errors(), true));
        }

        // Si todo salió bien, confirmar la transacción
        sqlsrv_commit($conn);

        echo json_encode([
            'success' => true,
            'message' => 'Carpeta eliminada correctamente'
        ]);

    } catch (Exception $e) {
        // Si algo salió mal, revertir todos los cambios
        sqlsrv_rollback($conn);
        throw $e;
    }

} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error al eliminar la carpeta: ' . $e->getMessage()
    ]);
}


?>
