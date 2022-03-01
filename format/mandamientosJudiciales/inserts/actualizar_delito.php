<?php
header('Content-Type: text/html; charset=utf-8');
include("../../../Conexiones/Conexion.php");
include("../../../Conexiones/conexionSIMAJ.php");
include("../../../funcionesMandamientos.php");


if (isset($_POST["ID_DELITOS_INTERNO"])){
 if($_POST["ID_DELITOS_INTERNO"] != 0) {
  $ID_DELITOS_INTERNO = $_POST["ID_DELITOS_INTERNO"];
 }else{  
  $ID_DELITOS_INTERNO = 0;
 }
}
//////////// ID DE LA MEDIDA DE PROTECCION/////
if (isset($_POST["ID_MANDAMIENTO_INTERNO"])){
 if($_POST["ID_MANDAMIENTO_INTERNO"] != 0) {
  $ID_MANDAMIENTO_INTERNO = $_POST["ID_MANDAMIENTO_INTERNO"];
 }else{  
  $ID_MANDAMIENTO_INTERNO = 0;
 }
}


if(isset($_POST["dataDelitoArray"])){
$data_delito = json_decode($_POST['dataDelitoArray'], true); 
  $ID_DELITO = $data_delito[1];
  $ID_MODALIDAD = $data_delito[2];
  $ES_PRINCIPAL = $data_delito[3];
 }


if (isset($_POST['idEnlace'])){ $idEnlace = $_POST['idEnlace']; }
if (isset($_POST['fraccion'])){ $fraccion = $_POST['fraccion']; }


  $queryTransaction = "
    BEGIN
     BEGIN TRY
      BEGIN TRANSACTION
       SET NOCOUNT ON

        UPDATE mandamientos.dbo.E_DELITOS SET 
         ID_DELITO = $ID_DELITO, 
         ID_MODALIDAD = $ID_MODALIDAD, 
         ES_PRINCIPAL =$ES_PRINCIPAL
        WHERE ID_DELITOS_INTERNO = $ID_DELITOS_INTERNO

       COMMIT
      END TRY
     BEGIN CATCH
    ROLLBACK TRANSACTION
   RAISERROR('No se realizo la transaccion',16,1)
  END CATCH
  END";
  //echo $queryTransaction;

 $result = sqlsrv_query($conn, $queryTransaction, array(), array( "Scrollable" => 'static' ));

 $arreglo[0] = "NO";
 $arreglo[1] = "SI";
 $arreglo[2] = $ID_MANDAMIENTO_INTERNO;
 $d = array('first' => $arreglo[1] , 'ID_MANDAMIENTO_INTERNO' => $arreglo[2]);
 if ($result) {
  echo json_encode($d);
 }else{
  echo json_encode(array('first'=>$arreglo[0]));
 }

?>