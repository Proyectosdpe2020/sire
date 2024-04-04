<?php
header('Content-Type: text/html; charset=utf-8');
include("../../../Conexiones/Conexion.php");
include("../../../Conexiones/conexionSIMAJ.php");
include("../../../funcionesMandamientos.php");

//////////// ID DE LA MEDIDA DE PROTECCION/////
if (isset($_POST["ID_DATOS_AGRAVIADO_INTERNO"])){
 if($_POST["ID_DATOS_AGRAVIADO_INTERNO"] != 0) {
  $ID_DATOS_AGRAVIADO_INTERNO = $_POST["ID_DATOS_AGRAVIADO_INTERNO"];
  //$puestaData = get_data_puesta($conn, $idMedidaProteccion);
 }else{  
  $ID_DATOS_AGRAVIADO_INTERNO = 0;
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


if(isset($_POST["dataAgraviadoArray"])){
$data_agraviado = json_decode($_POST['dataAgraviadoArray'], true); 
  $NOMBRE = $data_agraviado[1];
  $PATERNO = $data_agraviado[2];
  $MATERNO = $data_agraviado[3];
  $ES_PRINCIPAL = $data_agraviado[4];
 }


if (isset($_POST['idEnlace'])){ $idEnlace = $_POST['idEnlace']; }
if (isset($_POST['fraccion'])){ $fraccion = $_POST['fraccion']; }


  $queryTransaction = "
    BEGIN
     BEGIN TRY
      BEGIN TRANSACTION
       SET NOCOUNT ON

        UPDATE mandamientos.dbo.L_DATOS_AGRAVIADO SET 
         NOMBRE = '$NOMBRE'
        ,PATERNO = '$PATERNO'
        ,MATERNO = '$MATERNO'
        ,ES_PRINCIPAL = $ES_PRINCIPAL
        WHERE ID_DATOS_AGRAVIADO_INTERNO = $ID_DATOS_AGRAVIADO_INTERNO

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