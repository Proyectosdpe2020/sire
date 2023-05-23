<?php

header('Content-Type: text/html; charset=utf-8');
include("../../funciones.php");
include("../../Conexiones/Conexion.php");


if (isset($_POST["nuc"])) {
	$nuc = $_POST["nuc"];
}
if (isset($_POST["imputado"])) {
	$imputado = $_POST["imputado"];
}
if (isset($_POST["idEstatus"])) {
	$idEstatus = $_POST["idEstatus"];
}
if (isset($_POST["idEstatusNucs"])) {
	$idEstatusNucs = $_POST["idEstatusNucs"];
}

$arreglo[0] = "NO";
$arreglo[1] = "SI";
///// VALIDAR QUE NO SE HAYA REGISTRADO ESE ESTATUS NUCS 
$registrado = getDataEstatusnucsDeterminacion($conn, $idEstatusNucs);

if (sizeof($registrado) > 0) {
	$queryTransaction = " 
		BEGIN                     
		BEGIN TRY 
				BEGIN TRANSACTION
								SET NOCOUNT ON    
										UPDATE [ESTADISTICAV2].[dbo].[imputadoLitigacionDetermNuc] SET idImputadoLitigacion = $imputado WHERE idEstatusNucs = $idEstatusNucs
								COMMIT
		END TRY
		BEGIN CATCH 
								ROLLBACK TRANSACTION
								RAISERROR('No se realizo la transaccion',16,1)
		END CATCH
		END
	";

	$result = sqlsrv_query($conn, $queryTransaction, array(), array("Scrollable" => 'static'));

	if ($result) {
		echo json_encode(array('first' => $arreglo[1]));
	} else {
		echo json_encode(array('first' => $arreglo[0]));
	}
} else {
	$queryTransaction = " 
				BEGIN                     
				BEGIN TRY 
						BEGIN TRANSACTION
										SET NOCOUNT ON    
												INSERT INTO [ESTADISTICAV2].[dbo].[imputadoLitigacionDetermNuc] VALUES($imputado, $idEstatus, '$nuc', $idEstatusNucs)
										COMMIT
				END TRY
				BEGIN CATCH 
										ROLLBACK TRANSACTION
										RAISERROR('No se realizo la transaccion',16,1)
				END CATCH
				END
			";

	$result = sqlsrv_query($conn, $queryTransaction, array(), array("Scrollable" => 'static'));

	if ($result) {
		echo json_encode(array('first' => $arreglo[1]));
	} else {
		echo json_encode(array('first' => $arreglo[0]));
	}
}
