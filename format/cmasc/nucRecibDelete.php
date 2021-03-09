<?php
	session_start();
	include("../../Conexiones/Conexion.php");
	include("../../funCmasc.php");	
if (isset($_POST["idDelete"])){ $idDelete = $_POST["idDelete"]; }

  $queryTransaction = "  
    BEGIN                     
    BEGIN TRY 
    BEGIN TRANSACTION
    SET NOCOUNT ON                               
         DELETE FROM Cmasc.nucsRecib WHERE idNucRecibida = $idDelete
    COMMIT
    END TRY
    BEGIN CATCH 
    ROLLBACK TRANSACTION
    RAISERROR('No se realizo la transaccion',16,1)
    END CATCH
    END
    "; 
    $result = sqlsrv_query($conn,$queryTransaction, array(), array( "Scrollable" => 'static' )); 
    $arreglo[0] = "SI";
    $arreglo[1] = "NO";

    if ($result) {
      echo json_encode(array('first'=>$arreglo[0]));
    }else{
      echo json_encode(array('first'=>$arreglo[1]));
    }

	?>