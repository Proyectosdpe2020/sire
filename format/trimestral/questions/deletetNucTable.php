<?
include("../../../Conexiones/Conexion.php");
include("../../../funcioneTrimes.php");
include("../../../funciones.php");

if (isset($_GET["id"])) {
	$id = $_GET["id"];
}

$arreglo[0] = "SI";
$arreglo[1] = "NO";

$queryTransaction = "  

BEGIN 

BEGIN TRY 
  BEGIN TRANSACTION

	  SET NOCOUNT ON
																					
			DELETE FROM trimestral.nucsTrimestral WHERE idNucsTrimestral = $id

	  COMMIT
END TRY

BEGIN CATCH 
	  ROLLBACK TRANSACTION
	  RAISERROR('No se realizo la transaccion',16,1)
END CATCH

END


";
$result = sqlsrv_query($conn,$queryTransaction, array(), array( "Scrollable" => 'static' ));         

if ($result) {
	echo json_encode(array('first'=>$arreglo[0])); 
}else{
	echo json_encode(array('first'=>$arreglo[1])); 
}
