<?php
header('Content-Type: text/html; charset=utf-8');
include("../../../Conexiones/Conexion.php");
include("../../../Conexiones/conexionMedidas.php");
include("../../../funcionesMedidasProteccion.php");

if (isset($_POST["idtestigo"])) {
	$idtestigo = $_POST["idtestigo"];
}
if (isset($_POST["idMedida"])) {
	$idMedida = $_POST["idMedida"];
}



$queryTransaction = "
                     BEGIN                     
                     BEGIN TRY 
                       BEGIN TRANSACTION
                           SET NOCOUNT ON                                    
                                     DELETE FROM medidas.testigo WHERE idTestigo = $idtestigo 
                                     DECLARE @countTestigo INT
                                     SET @countTestigo = (SELECT COUNT(idTestigo) FROM SIRE.medidas.testigo WHERE idMedida = $idMedida)                                   
                                     IF @countTestigo = 0
                                      DELETE FROM [SIRE].[medidas].[medidasAplicadasTestigo] WHERE idMedida = $idMedida
                               COMMIT
                     END TRY
                     BEGIN CATCH 
                           ROLLBACK TRANSACTION
                           RAISERROR('No se realizo la transaccion',16,1)
                     END CATCH
                     END
                   ";


$result = sqlsrv_query($connMedidas, $queryTransaction, array(), array("Scrollable" => 'static'));
$arreglo[0] = "NO";
$arreglo[1] = "SI";
if ($result) {
	echo json_encode(array('first' => $arreglo[1], 'modulo' => $modulo));
} else {
	echo json_encode(array('first' => $arreglo[0]));
}
