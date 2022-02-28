<?php
header('Content-Type: text/html; charset=utf-8');
include("../../../Conexiones/Conexion.php");
include("../../../Conexiones/conexionSIMAJ.php");
include("../../../funcionesMandamientos.php");

/////////// ID DE LA MEDIDA DE PROTECCION/////
if (isset($_POST["ID_MANDAMIENTO_INTERNO"])){
 if($_POST["ID_MANDAMIENTO_INTERNO"] != 0) {
  $ID_MANDAMIENTO_INTERNO = $_POST["ID_MANDAMIENTO_INTERNO"];
 }else{  
  $ID_MANDAMIENTO_INTERNO = 0;
 }
}

if (isset($_POST['idEnlace'])){ $idEnlace = $_POST['idEnlace']; }
if (isset($_POST['fraccion'])){ $fraccion = $_POST['fraccion']; } 
if (isset($_POST['ID_DELITOS_INTERNO'])){ $ID_DELITOS_INTERNO = $_POST['ID_DELITOS_INTERNO']; } 
if (isset($_POST['ID_MANDAMIENTO_INTERNO'])){ $ID_MANDAMIENTO_INTERNO = $_POST['ID_MANDAMIENTO_INTERNO']; } 


 $queryTransaction = "
                     BEGIN                     
                     BEGIN TRY 
                       BEGIN TRANSACTION
                           SET NOCOUNT ON                                    
                                     DELETE FROM mandamientos.dbo.E_DELITOS WHERE ID_DELITOS_INTERNO = $ID_DELITOS_INTERNO AND ID_MANDAMIENTO_INTERNO = $ID_MANDAMIENTO_INTERNO
                               COMMIT
                     END TRY
                     BEGIN CATCH 
                           ROLLBACK TRANSACTION
                           RAISERROR('No se realizo la transaccion',16,1)
                     END CATCH
                     END
                   "; 
$result = sqlsrv_query($conn,$queryTransaction, array(), array( "Scrollable" => 'static' )); 
 $arreglo[0] = "NO";
 $arreglo[1] = "SI";
 //echo $queryTransaction;
 if ($result) {
  $arreglo[2] = $ID_MANDAMIENTO_INTERNO ;
  $d = array('first' => $arreglo[1] , 'ID_MANDAMIENTO_INTERNO' => $arreglo[2] );
  echo json_encode($d);
 }else{
  echo json_encode(array('first'=>$arreglo[0]));
 }


?>