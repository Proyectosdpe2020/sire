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


if(isset($_POST["dataInputadoArray"])){
$data_inputado = json_decode($_POST['dataInputadoArray'], true); 
  $NOMBRE = $data_inputado[1];
  $APATERNO = $data_inputado[2];
  $AMATERNO = $data_inputado[3];
  $ID_NACIONALIDAD = $data_inputado[4];
  $ID_SEXO = $data_inputado[5];
  $ID_USO_ANTEOJOS = $data_inputado[6];
  $TATUAJES = $data_inputado[7];
  $EDAD = $data_inputado[8];
  $ESTATURA = $data_inputado[9];
  $PESO = $data_inputado[10];
  $CURP = $data_inputado[11];
  $OBSERVACIONES_INPUTADO = $data_inputado[12];
  $FECHA_OBSERVACION = $data_inputado[13];
 }


if (isset($_POST['idEnlace'])){ $idEnlace = $_POST['idEnlace']; }
if (isset($_POST['fraccion'])){ $fraccion = $_POST['fraccion']; }


  $queryTransaction = "
    BEGIN
     BEGIN TRY
      BEGIN TRANSACTION
       SET NOCOUNT ON

        UPDATE mandamientos.dbo.B_DATOS_INCULPADO SET 
         NOMBRE = '$NOMBRE'
        ,APATERNO = '$APATERNO'
        ,AMATERNO = '$AMATERNO'
        ,EDAD = $EDAD
        ,ESTATURA = $ESTATURA
        ,PESO = $PESO
        ,TATUAJES = '$TATUAJES'
        ,ID_SEXO = '$ID_SEXO'
        ,ID_USO_ANTEOJOS = '$ID_USO_ANTEOJOS'
        ,ID_NACIONALIDAD = $ID_NACIONALIDAD
        ,CURP = '$CURP'
        ,OBSERVACIONES = '$OBSERVACIONES_INPUTADO'
        ,FECHA_OBSERVACION = '$FECHA_OBSERVACION'
        WHERE ID_MANDAMIENTO_INTERNO = $ID_MANDAMIENTO_INTERNO

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