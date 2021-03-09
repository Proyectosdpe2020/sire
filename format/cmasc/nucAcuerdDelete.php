<?php
session_start();
include("../../Conexiones/Conexion.php");
include("../../funCmasc.php");	
if (isset($_POST["idDelete"])){ $idDelete = $_POST["idDelete"]; }
if (isset($_POST["nuc"])){ $nuc = $_POST["nuc"]; }

$nurec = nucAcuerUpdatRecib($conn, $nuc);
$valor = $nurec[0][0];

$queryTransaction = "  
BEGIN                     
BEGIN TRY 
BEGIN TRANSACTION
SET NOCOUNT ON                               
DELETE FROM CMASC.nucsEstatus WHERE idNucsEstatus = $idDelete
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
  
      //// SE ACTUALIZA EL ESTATUS DE LA RECIBIDA PARA QUITARLE EL ACUERDO Y DEJARLA DE NUEVO EN TRAMITE
    $querUpd = "  
       BEGIN                     
       BEGIN TRY 
       BEGIN TRANSACTION
       SET NOCOUNT ON                               
       UPDATE CMASC.nucsRecib SET [acue/termin] = 0 WHERE idNucRecibida = $valor
       COMMIT
       END TRY
       BEGIN CATCH 
       ROLLBACK TRANSACTION
       RAISERROR('No se realizo la transaccion',16,1)
       END CATCH
       END
       "; 
       $resul = sqlsrv_query($conn,$querUpd, array(), array( "Scrollable" => 'static' )); 

       echo json_encode(array('first'=>$arreglo[0]));

}else{
  echo json_encode(array('first'=>$arreglo[1]));
}

?>