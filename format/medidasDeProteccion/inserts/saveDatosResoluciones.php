<?php
header('Content-Type: text/html; charset=utf-8');
include("../../../Conexiones/Conexion.php");
include("../../../Conexiones/conexionMedidas.php");
include("../../../funcionesMedidasProteccion.php");

//////////// ID DE LA MEDIDA DE PROTECCION/////
if (isset($_POST["idMedida"])){
 if($_POST["idMedida"] != 0) {
  $idMedida = $_POST["idMedida"];
  //$puestaData = get_data_puesta($conn, $idMedidaProteccion);
  $a = 1;
 }else{  
  $a = 0;  
  $idMedida = 0;
 }
}


//VARIABLES DEL FORMULARIO OBTENIDO
if (isset($_POST['ratificacion'])){ $ratificacion = $_POST['ratificacion']; }
if (isset($_POST['observacionRatificacion'])){ $observacionRatificacion = $_POST['observacionRatificacion']; }
if (isset($_POST['modifica'])){ $modifica = $_POST['modifica']; }
if (isset($_POST['observacionModificada'])){ $observacionModificada = $_POST['observacionModificada']; }
if (isset($_POST['ampliada'])){ $ampliada = $_POST['ampliada']; }
if (isset($_POST['observacionAmpliada'])){ $observacionAmpliada = $_POST['observacionAmpliada']; }
if (isset($_POST['revocada'])){ $revocada = $_POST['revocada']; }
if (isset($_POST['observacionRevocada'])){ $observacionRevocada = $_POST['observacionRevocada']; }

if (isset($_POST['idEnlace'])){ $idEnlace = $_POST['idEnlace']; }
if (isset($_POST['fraccion'])){ $fraccion = $_POST['fraccion']; }


////TIPO DE ACTUALIZACION Y ID FORESTALES////
if (isset($_POST['tipoActualizacion'])){ $tipoActualizacion = $_POST['tipoActualizacion']; }


 $queryTransaction = "
  BEGIN
   BEGIN TRY 
    BEGIN TRANSACTION
     SET NOCOUNT ON

       INSERT INTO medidas.resoluciones (idMedida , ratificacion , modificada , observacionRatificacion , observacionModificada, ampliada, revocada, observacionAmpliada, observacionRevocada) 
       VALUES($idMedida , $ratificacion, $modifica, '$observacionRatificacion', '$observacionModificada', $ampliada, $revocada, '$observacionAmpliada', '$observacionRevocada' )

       COMMIT
      END TRY
     BEGIN CATCH
    ROLLBACK TRANSACTION
   RAISERROR('No se realizo la transaccion',16,1)
  END CATCH
 END";

 $result = sqlsrv_query($connMedidas,$queryTransaction, array(), array( "Scrollable" => 'static' )); 
 $arreglo[0] = "NO";
 $arreglo[1] = "SI";

 if ($result) {
  $arreglo[2] = $idMedida;
  $d = array('first' => $arreglo[1] , 'idMedidaUltimo' => $arreglo[2] );
  echo json_encode($d);
 }else{
  echo json_encode(array('first'=>$arreglo[0]));
 }

?>