<?php

header('Content-Type: text/html; charset=utf-8');
include("../../funciones.php");
include("../../Conexiones/Conexion.php");


if (isset($_POST["id"])) {
	$id = $_POST["id"];
}
if (isset($_POST["nuc"])) {
	$nuc = $_POST["nuc"];
}
$arreglo[0] = "NO";
$arreglo[1] = "SI";


	$queryTransaction = " 
	BEGIN                     
	BEGIN TRY 
			BEGIN TRANSACTION
							SET NOCOUNT ON    

							DELETE FROM [ESTADISTICAV2].[dbo].[imputadoLitigacionCarpeta] WHERE idImputadoLitigacion = $id AND nuc = '$nuc'
							DELETE FROM [ESTADISTICAV2].[dbo].[imputadoLitigacionDetermNuc] WHERE idImputadoLitigacion = $id

							DECLARE @countTestigo INT
							SET @countTestigo = (SELECT COUNT(idImputadoLitigacionCarpeta) FROM [ESTADISTICAV2].[dbo].[imputadoLitigacionCarpeta] WHERE idImputadoLitigacion = $id)                                   
							IF @countTestigo = 0
								DELETE FROM [ESTADISTICAV2].[dbo].[imputadoLitigacion] WHERE idImputadoLitigacion = $id									
									
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

