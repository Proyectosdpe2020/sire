<?php
header('Content-Type: text/html; charset=utf-8');
include("../../../Conexiones/Conexion.php");
include("../../../Conexiones/conexionSIMAJ.php");
include("../../../funcionesMandamientos.php");

//////////// ID DE LA MEDIDA DE PROTECCION/////
if (isset($_POST["ID_MANDAMIENTO_INTERNO"])){
 if($_POST["ID_MANDAMIENTO_INTERNO"] != 0) {
  $ID_MANDAMIENTO_INTERNO = $_POST["ID_MANDAMIENTO_INTERNO"];
 }else{  
  $ID_MANDAMIENTO_INTERNO = 0;
 }
}


//SE RECIBE OBJETO ARRAY CON LOS DATOS PRINCIPALES
if (isset($_POST["dataDelitoArray"])){ 
 $data = json_decode($_POST['dataDelitoArray'], true); 
 $ID_DELITO = $data[1];
 $ID_DATOS_INCULPADO_INTERNO = $data[2];
 $ID_MODALIDAD = $data[3];
 $ES_PRINCIPAL = $data[4];
}

$PRUEBAS = true;

if (isset($_POST['idEnlace'])){ $idEnlace = $_POST['idEnlace']; }
if (isset($_POST['fraccion'])){ $fraccion = $_POST['fraccion']; }

if (isset($_POST['GET_ID_MANDAMIENTO_INTERNO'])){ $GET_ID_MANDAMIENTO_INTERNO = $_POST['GET_ID_MANDAMIENTO_INTERNO']; }
if (isset($_POST['GET_ID_DATOS_INCULPADO'])){ $GET_ID_DATOS_INCULPADO = $_POST['GET_ID_DATOS_INCULPADO']; }

if($PRUEBAS == true){
 $queryTransaction = "
  BEGIN
   BEGIN TRY 
    BEGIN TRANSACTION
     SET NOCOUNT ON
     
       INSERT INTO SIMAJ.dbo.E_DELITOS (ID_MANDAMIENTO , ID_DATOS_INCULPADO, ID_DELITO , ID_MODALIDAD , ES_PRINCIPAL )
       VALUES ($GET_ID_MANDAMIENTO_INTERNO, $GET_ID_DATOS_INCULPADO , $ID_DELITO , 9999 , $ES_PRINCIPAL)

       SELECT MAX(ID_DELITOS) AS ID_DELITOS FROM SIMAJ.dbo.E_DELITOS

       COMMIT
      END TRY
     BEGIN CATCH
    ROLLBACK TRANSACTION
   RAISERROR('No se realizo la transaccion',16,1)
  END CATCH
 END";

 $result = sqlsrv_query($connSIMAJ,$queryTransaction, array(), array( "Scrollable" => 'static' )); 
  //echo $queryTransaction;
  if ($result) {
   while ($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC )){  
    $ID_DELITOS = $row['ID_DELITOS'];   
   }
  }


 $queryTransaction = "
  BEGIN
   BEGIN TRY 
    BEGIN TRANSACTION
     SET NOCOUNT ON
     
       INSERT INTO mandamientos.dbo.E_DELITOS (ID_MANDAMIENTO_INTERNO , ID_INCULPADO_INTERNO , ID_DELITOS , ID_MANDAMIENTO , ID_DATOS_INCULPADO , ID_DELITO , ID_MODALIDAD , ES_PRINCIPAL )
       VALUES ($ID_MANDAMIENTO_INTERNO, $ID_DATOS_INCULPADO_INTERNO , $ID_DELITOS , $GET_ID_MANDAMIENTO_INTERNO , $GET_ID_DATOS_INCULPADO ,  $ID_DELITO , 9999 , $ES_PRINCIPAL)

       COMMIT
      END TRY
     BEGIN CATCH
    ROLLBACK TRANSACTION
   RAISERROR('No se realizo la transaccion',16,1)
  END CATCH
 END";

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

}else{

 $queryTransaction = "
  BEGIN
   BEGIN TRY 
    BEGIN TRANSACTION
     SET NOCOUNT ON
     
       INSERT INTO mandamientos.dbo.E_DELITOS (ID_MANDAMIENTO_INTERNO , ID_INCULPADO_INTERNO , ID_DELITO , ID_MODALIDAD , ES_PRINCIPAL )
       VALUES ($ID_MANDAMIENTO_INTERNO, $ID_DATOS_INCULPADO_INTERNO ,  $ID_DELITO , 9999 , $ES_PRINCIPAL)

       COMMIT
      END TRY
     BEGIN CATCH
    ROLLBACK TRANSACTION
   RAISERROR('No se realizo la transaccion',16,1)
  END CATCH
 END";

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

}



?>