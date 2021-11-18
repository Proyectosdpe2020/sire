<?php
header('Content-Type: text/html; charset=utf-8');
include("../../../Conexiones/Conexion.php");
include("../../../Conexiones/conexionMedidas.php");
include("../../../funcionesMedidasProteccion.php");

//VARIABLES DEL FORMULARIO OBTENIDO
if (isset($_POST['numAntecedentes'])){ $numAntecedentes = $_POST['numAntecedentes']; }
if (isset($_POST['temporalidad'])){ $temporalidad = $_POST['temporalidad']; }
if (isset($_POST['fechaConclusion'])){ $fechaConclusion = $_POST['fechaConclusion']; }


 $fechaAcuerdo = $fechaConclusion; 
 $fechaAcuerdo = str_ireplace("'",'',$fechaAcuerdo);


$fechaAcuerdo=str_ireplace('T',' ',$fechaAcuerdo);
$fechaAcuerdo2=":00";
$fechaAcuerdo= $fechaAcuerdo.$fechaAcuerdo2;

$array_fecha=  explode(' ', $fechaAcuerdo,2) ;
$fechaConvertida=$array_fecha[0].''.$array_fecha[1].''; 

$fechaAcuerdo= convierteFecha($array_fecha[0]);
$fechaAcuerdo.=' '.$array_fecha[1]; 

$fechaAcuerdo = "'".$fechaAcuerdo."'";

function convierteFecha($fecha){
 $array_fecha=  explode('-', $fecha,3) ;
 $fechaConvertida=$array_fecha[2].'-'.$array_fecha[1].'-'.$array_fecha[0];
 return $fechaConvertida;
} 

if (isset($_POST['idCuadernoAntecedentes'])){ $idCuadernoAntecedentes = $_POST['idCuadernoAntecedentes']; }
if (isset($_POST['idMedida'])){ $idMedida = $_POST['idMedida']; }


  $queryTransaction = "
    BEGIN
     BEGIN TRY
      BEGIN TRANSACTION
       SET NOCOUNT ON

        UPDATE medidas.cuadernoAntecedentes SET cuadernoAntecedentes = '$numAntecedentes', temporalidad = $temporalidad, fechaConclusion = $fechaAcuerdo
        WHERE idCuadernoAntecedentes = $idCuadernoAntecedentes

         UPDATE medidas.medidasProteccion SET fechaConclusion = $fechaAcuerdo WHERE idMedida = $idMedida

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