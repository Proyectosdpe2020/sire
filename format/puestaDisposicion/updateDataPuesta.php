<?php
header('Content-Type: text/html; charset=utf-8');
include("../../funciones.php");
include ("../../Conexiones/Conexion.php");


     if (isset($_POST["jObject"])){ 
               $data = json_decode($_POST['jObject'], true);
               $fechaevento=$data[2];
               $fechaevento=str_ireplace("'",'',$fechaevento);               
          }
      $fechaevento=str_ireplace('T',' ',$fechaevento);
      $fechaevento2=":00";
      $fechaevento= $fechaevento.$fechaevento2;    

      $array_fecha=  explode(' ', $fechaevento,2) ;
      $fechaConvertida=$array_fecha[0].''.$array_fecha[1].''; 
      
      $fechaevento= convierteFecha($array_fecha[0]);
      $fechaevento.=' '.$array_fecha[1]; 
      $fechaevento = "'".$fechaevento."'";

function convierteFecha($fecha){
    $array_fecha=  explode('-', $fecha,3) ;
    $fechaConvertida=$array_fecha[2].'-'.$array_fecha[1].'-'.$array_fecha[0];
    return $fechaConvertida;
    } 
//////////// DATOS DE PUESTA A DISPOSICION /////
if (isset($_POST["idPuesta"])){ 
	$idPuesta = $_POST["idPuesta"]; 
}else{ $idPuesta = ""; }


  if($data[10] == false){ $data[10] = 0; }else{ $data[10] = 1; }
      if($data[11] == false){ $data[11] = 0; }else{ $data[11] = 1; }
      if($data[12] == false){ $data[12] = 0; }else{ $data[12] = 1; }
      if($data[13] == false){ $data[13] = 0; }else{ $data[13] = 1; }
      if($data[14] == false){ $data[14] = 0; }else{ $data[14] = 1; }    

                   
                   $queryTransaction = "  

                    BEGIN                     
                    BEGIN TRY 
                      BEGIN TRANSACTION
                          SET NOCOUNT ON


                          UPDATE pueDisposi.puestaDisposicion SET idMando = $data[0], nuc = $data[1], fechaEvento = $fechaevento, calle = $data[7], idColonia = $data[5], numero = $data[8], idMunicipio = $data[4], codigoPostal = $data[6], idFiscalia = $data[3], rel = $data[10], norel = $data[11], cate = $data[12], oper = $data[13], reco = $data[14], narracion = '$data[15]', diaSemana = DATEPART(dw, $fechaevento), diaMes = DATEPART(day, $fechaevento), mes = DATEPART(month, $fechaevento)  WHERE idPuestaDisposicion = $idPuesta 


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
                 
                  if ($result) {
                   echo json_encode(array('first'=>$arreglo[1]));
                  }else{
                   echo json_encode(array('first'=>$arreglo[0]));
                  }                               
     