<?php
header('Content-Type: text/html; charset=utf-8');
include("../../../Conexiones/Conexion.php");
include("../../../Conexiones/conexionMedidas.php");
include("../../../funcionesMedidasProteccion.php");

//VARIABLES DEL FORMULARIO OBTENIDO
if (isset($_POST['ratificacion'])){ $ratificacion = $_POST['ratificacion']; }
if (isset($_POST['observacionRatifica'])){ $observacionRatifica = $_POST['observacionRatifica']; }
if (isset($_POST['modifica'])){ $modifica = $_POST['modifica']; }
if (isset($_POST['observacionModifica'])){ $observacionModifica = $_POST['observacionModifica']; }

if (isset($_POST['idResolucion'])){ $idResolucion = $_POST['idResolucion']; }
if (isset($_POST['idMedida'])){ $idMedida = $_POST['idMedida']; }


  $queryTransaction = "
    BEGIN
     BEGIN TRY
      BEGIN TRANSACTION
       SET NOCOUNT ON

        UPDATE medidas.resoluciones SET ratificacion = $ratificacion, modificada = $modifica, observacionRatifica = '$observacionRatifica', observacionModifica = '$observacionModifica' 
        WHERE idResolucion = $idResolucion

       COMMIT
      END TRY
     BEGIN CATCH
    ROLLBACK TRANSACTION
   RAISERROR('No se realizo la transaccion',16,1)
  END CATCH
  END";
  

 $result = sqlsrv_query($connMedidas,$queryTransaction, array(), array( "Scrollable" => 'static' ));
 while ($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC )){  
  $id=$row['id'];
 }
 $arreglo[0] = "NO";
 $arreglo[1] = "SI";
 $arreglo[2] = $idMedida;
 $d = array('first' => $arreglo[1] , 'idMedidaUltimo' => $arreglo[2]);
 if ($result) {
  echo json_encode($d);
 }else{
  echo json_encode(array('first'=>$arreglo[0]));
 }

?>