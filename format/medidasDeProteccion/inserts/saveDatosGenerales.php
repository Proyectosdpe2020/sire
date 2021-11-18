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
 }else{  
  $idMedida = 0;
 }
}


//SE RECIBE OBJETO ARRAY CON LOS DATOS PRINCIPALES
if (isset($_POST["dataPrincipalArray"]) && $idMedida == 0){ 
 $data = json_decode($_POST['dataPrincipalArray'], true); 
 $fechaAcuerdo = $data[3]; 
 $fechaAcuerdo = str_ireplace("'",'',$fechaAcuerdo);


$fechaAcuerdo=str_ireplace('T',' ',$fechaAcuerdo);
$fechaAcuerdo2=":00";
$fechaAcuerdo= $fechaAcuerdo.$fechaAcuerdo2;

$array_fecha=  explode(' ', $fechaAcuerdo,2) ;
$fechaConvertida=$array_fecha[0].''.$array_fecha[1].''; 

$fechaAcuerdo= convierteFecha($array_fecha[0]);
$fechaAcuerdo.=' '.$array_fecha[1]; 

$fechaAcuerdo = "'".$fechaAcuerdo."'";
}

function convierteFecha($fecha){
 $array_fecha=  explode('-', $fecha,3) ;
 $fechaConvertida=$array_fecha[2].'-'.$array_fecha[1].'-'.$array_fecha[0];
 return $fechaConvertida;
} 


if (isset($_POST['idEnlace'])){ $idEnlace = $_POST['idEnlace']; }
if (isset($_POST['fraccion'])){ $fraccion = $_POST['fraccion']; }


if($idMedida == 0){
 $queryTransaction = "
  BEGIN
   BEGIN TRY 
    BEGIN TRANSACTION
     SET NOCOUNT ON
       declare @insertado int
     
       INSERT INTO medidas.medidasProteccion VALUES($data[1],0,0,0,$data[2], $fechaAcuerdo,GETDATE(), DATEPART(dw, $fechaAcuerdo), DATEPART(day, $fechaAcuerdo), DATEPART(month, $fechaAcuerdo), DATEPART(year, $fechaAcuerdo), $idEnlace, $data[10], 1, '')

       select @insertado = @@IDENTITY

       INSERT INTO medidas.victimas(idMedida , nombre, paterno, materno, genero, edad) 
       VALUES(@insertado, '$data[5]', '$data[6]', '$data[7]', $data[8],  $data[9] )

       SELECT MAX(idMedida) AS id FROM medidas.medidasProteccion

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
  while ($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC )){  
   $id=$row['id'];  
  }
  $arreglo[2] = $id;
  $d = array('first' => $arreglo[1] , 'idMedidaUltimo' => $arreglo[2] );
  echo json_encode($d);
 }else{
  echo json_encode(array('first'=>$arreglo[0]));
 }
}
?>