<?php
header('Content-Type: text/html; charset=utf-8');
include("../../../Conexiones/conexionMedidas.php");

//////////// ID DE LA MEDIDA DE PROTECCION/////
if (isset($_POST["idMedida"])){ $idMedida = $_POST["idMedida"]; }


//VARIABLES DEL FORMULARIO OBTENIDO
if (isset($_POST['dateConstanciaLlamada'])){ 
  $dateConstanciaLlamada = $_POST['dateConstanciaLlamada'];
  $dateConstanciaLlamada = str_ireplace("'",'',$dateConstanciaLlamada);

  $dateConstanciaLlamada=str_ireplace('T',' ',$dateConstanciaLlamada);
  $dateConstanciaLlamada2=":00";
  $dateConstanciaLlamada= $dateConstanciaLlamada.$dateConstanciaLlamada2;

  $array_fecha=  explode(' ', $dateConstanciaLlamada,2) ;
  $fechaConvertida = $array_fecha[0].''.$array_fecha[1].''; 

  $dateConstanciaLlamada= convierteFecha($array_fecha[0]);
  $dateConstanciaLlamada.=' '.$array_fecha[1]; 

  $dateConstanciaLlamada = "'".$dateConstanciaLlamada."'";
  }

if (isset($_POST['obsConstanciaLlamada'])){ $obsConstanciaLlamada = $_POST['obsConstanciaLlamada']; }

function convierteFecha($fecha){
 $array_fecha=  explode('-', $fecha,3) ;
 $fechaConvertida=$array_fecha[2].'-'.$array_fecha[1].'-'.$array_fecha[0];
 return $fechaConvertida;
}

 $queryTransaction = "
  BEGIN
   BEGIN TRY 
    BEGIN TRANSACTION
     SET NOCOUNT ON
     
       INSERT INTO medidas.constanciaLlamadas (idMedida, fecha, observaciones) VALUES($idMedida, $dateConstanciaLlamada, '$obsConstanciaLlamada')

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
 $arreglo[2] = $idMedida;
 $d = array('first' => $arreglo[1] , 'idMedidaUltimo' => $arreglo[2]);
 if ($result) {
  echo json_encode($d);
 }else{
  echo json_encode(array('first'=>$arreglo[0]));
 }

?>