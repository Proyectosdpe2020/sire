<?php

header('Content-Type: text/html; charset=utf-8');
include("../../funciones.php");
include("../../Conexiones/Conexion.php");


if (isset($_POST["nuc"])) {
	$nuc = $_POST["nuc"];
}
if (isset($_POST["idImputado"])) {
	$idImputado = $_POST["idImputado"];
}


$arreglo[0] = "NO";
$arreglo[1] = "SI";

	


		$queryTransaction = " 
																			BEGIN                     
																			BEGIN TRY 
																					BEGIN TRANSACTION
																									SET NOCOUNT ON    
																											DECLARE @id INT;
																											INSERT INTO [ESTADISTICAV2].[dbo].[imputadoLitigacionCarpeta] VALUES($idImputado, '$nuc')
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
	

