<?php

header('Content-Type: text/html; charset=utf-8');
include("../../funciones.php");
include("../../Conexiones/Conexion.php");


if (isset($_POST["nuc"])) {
	$nuc = $_POST["nuc"];
}
if (isset($_POST["nom"])) {
	$nom = $_POST["nom"];
}
if (isset($_POST["paterno"])) {
	$paterno = $_POST["paterno"];
}
if (isset($_POST["materno"])) {
	$materno = $_POST["materno"];
}
if (isset($_POST["curp"])) {
	$curp = $_POST["curp"];
}
if (isset($_POST["sexo"])) {
	$sexo = $_POST["sexo"];
}
if (isset($_POST["edad"])) {
	$edad = $_POST["edad"];
}

$arreglo[0] = "NO";
$arreglo[1] = "SI";
$arreglo[2] = "EI"; ///// EXISTE EL IMPUTADO CON ESA CURP Y ESA CARPETA
$arreglo[3] = "EC"; ///// EXISTE EL IMPUTADO CON ESA CURP 

//// HACER CONSULTA PARA SABER SI YA EXISTE UN IMPUTADO CON ESE CURP Y SI SE PUEDE INGRESAR PARA OTRA CARPETA
$query = " SELECT imputadoLitigacionCarpeta.nuc, imputadoLitigacionCarpeta.idImputadoLitigacion
FROM imputadoLitigacionCarpeta 
INNER JOIN imputadoLitigacion il ON il.idImputadoLitigacion = imputadoLitigacionCarpeta.idImputadoLitigacion
WHERE imputadoLitigacionCarpeta.nuc = '$nuc' AND il.curp = '$curp'";
$stmt = sqlsrv_query($conn, $query, array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
$row_count = sqlsrv_num_rows($stmt);
$row_count = 0;
if ($row_count > 0) {
	// echo json_encode(array('first' => $arreglo[2]));
	echo json_encode(array('first' => $arreglo[1]));
} else {
	//// SI MAS BIEN EXISTE EL CURP PERO NO EN ESA CARPETA SE PUEDE AGREGAR PERO YA SE TIENE QUE SELECCIONAR EL IMPUTADO DE UNA LISTA 
	$query2 = "SELECT imputadoLitigacionCarpeta.nuc, imputadoLitigacionCarpeta.idImputadoLitigacion
	FROM imputadoLitigacionCarpeta 
	INNER JOIN imputadoLitigacion il ON il.idImputadoLitigacion = imputadoLitigacionCarpeta.idImputadoLitigacion
	WHERE  il.curp = '$curp'";

	$stmt2 = sqlsrv_query($conn, $query2, array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
	$row_count2 = sqlsrv_num_rows($stmt2);
	$row_count2 = 0;
	if ($row_count2 > 0) {
		// echo json_encode(array('first' => $arreglo[3]));
		echo json_encode(array('first' => $arreglo[1]));
	} else {

		$queryTransaction = " 
																			BEGIN                     
																			BEGIN TRY 
																					BEGIN TRANSACTION
																									SET NOCOUNT ON    
																											DECLARE @id INT;
																											INSERT INTO imputadoLitigacion VALUES('$nom', '$paterno', '$materno', $edad, '$sexo', '$curp', '$nuc') 
																											SET @id = SCOPE_IDENTITY();
																											INSERT INTO [ESTADISTICAV2].[dbo].[imputadoLitigacionCarpeta] VALUES(@id, '$nuc')
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
}
