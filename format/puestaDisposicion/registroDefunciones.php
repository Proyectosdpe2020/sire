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
if (isset($_POST["idPuestaDisposicion"])){ 
	$idPuestaDisposicion = $_POST["idPuestaDisposicion"]; 
}else{ $idPuestaDisposicion = ""; }


if (isset($_POST['textNombre'])){ $getTextNombre = $_POST['textNombre']; }
if (isset($_POST['textAp_paterno'])){ $getTextAp_paterno = $_POST['textAp_paterno']; }
if (isset($_POST['textAp_materno'])){ $getTextAp_materno = $_POST['textAp_materno']; }
if (isset($_POST['textEdad'])){ $getTextEdad = $_POST['textEdad']; }
if (isset($_POST['textSexo'])){ $getTextSexo = $_POST['textSexo']; }
if (isset($_POST['textCatCausaMuerte_id'])){ $getTextCatCausaMuerte_id = $_POST['textCatCausaMuerte_id']; }
if (isset($_POST['textMovilMuerte'])){ $getTextMovilMuerte = $_POST['textMovilMuerte']; }
if (isset($_POST['textObservaciones'])){ $getTextObservaciones = $_POST['textObservaciones']; }
if (isset($_POST['idEnlace'])){ $idEnlace = $_POST['idEnlace']; }
/*
echo $getTextNombre." ".$getTextAp_paterno." ".$getTextAp_materno." ".$getTextEdad." ".$getTextSexo." ".$getTextCatCausaMuerte_id." ".$getTextMovilMuerte." ".$getTextObservaciones;*/
 ////TIPO DE ACTUALIZACION Y ID DEFUNCIONES////
if (isset($_POST['tipoActualizacion'])){ $tipoActualizacion = $_POST['tipoActualizacion']; }
if (isset($_POST['idDefuncion'])){ $idDefuncion = $_POST['idDefuncion']; }

    if($data[10] == false){ $data[10] = 0; }else{ $data[10] = 1; }
      if($data[11] == false){ $data[11] = 0; }else{ $data[11] = 1; }
      if($data[12] == false){ $data[12] = 0; }else{ $data[12] = 1; }
      if($data[13] == false){ $data[13] = 0; }else{ $data[13] = 1; }
      if($data[14] == false){ $data[14] = 0; }else{ $data[14] = 1; }    



 if (isset($_POST["idPuestaDisposicion"])){ $idPuestaDisposicion = $_POST["idPuestaDisposicion"]; }else{
              $idPuestaDisposicion = "";
      } 
       if($idPuestaDisposicion == ""){
          
                   $queryTransaction = "  

                    BEGIN                     
                    BEGIN TRY 
                      BEGIN TRANSACTION
                          SET NOCOUNT ON

                                          declare @insertado int

                                            INSERT INTO pueDisposi.puestaDisposicion VALUES($data[0],$data[1],$fechaevento,GETDATE(), $data[7], $data[5], $data[8], $data[4], $data[6], DATEPART(dw, $fechaevento), DATEPART(day, $fechaevento),DATEPART(month, $fechaevento), DATEPART(year, $fechaevento), $data[3], $idEnlace, $data[10], $data[11], $data[12], $data[13], $data[14], '$data[15]' )


                                          select @insertado = @@IDENTITY


                                            INSERT INTO pueDisposi.Defunciones (idPueDisposicion , nombre , ap_paterno , ap_materno , edad , sexo , idCausaMuerte , movilMuerte , observaciones) 
                                              VALUES(@insertado , '$getTextNombre' , '$getTextAp_paterno' , '$getTextAp_materno' , 
                                                    $getTextEdad , '$getTextSexo' , $getTextCatCausaMuerte_id , '$getTextMovilMuerte',
                                                     '$getTextObservaciones')


                                             SELECT MAX(idPuestaDisposicion) AS id FROM pueDisposi.puestaDisposicion   




                              COMMIT
                    END TRY
                    BEGIN CATCH 
                          ROLLBACK TRANSACTION
                          RAISERROR('No se realizo la transaccion',16,1)
                    END CATCH
                    END
                  ";

                
                   //echo $queryTransaction;

                  $result = sqlsrv_query($conn,$queryTransaction, array(), array( "Scrollable" => 'static' ));                   

                  

                  $arreglo[0] = "NO";
                  $arreglo[1] = "SI";
                 

                  if ($result) {

                    while ($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC ))
                    {  $id=$row['id'];   }
                    $arreglo[2] = $id;
                     $d = array('first' => $arreglo[1] , 'idpuestaultimo' => $arreglo[2]);                   

                    echo json_encode($d);

                  }else{
                    echo json_encode(array('first'=>$arreglo[0]));
                  }
      }
      else if($idPuestaDisposicion != ""){


                
                 if($tipoActualizacion == 0 ){ 

                  $queryTransaction = " 
                    BEGIN                     
                    BEGIN TRY 
                      BEGIN TRANSACTION
                            SET NOCOUNT ON    

                                           declare @insertado int 
                                              
                                           select @insertado = @@IDENTITY 
                                              
                                          INSERT INTO pueDisposi.Defunciones (idPueDisposicion , nombre , ap_paterno , ap_materno ,
                                             edad , sexo , idCausaMuerte , movilMuerte , observaciones) 
                                              VALUES($idPuestaDisposicion , '$getTextNombre' , '$getTextAp_paterno' , 
                                              '$getTextAp_materno' ,  $getTextEdad , '$getTextSexo' , $getTextCatCausaMuerte_id , 
                                              '$getTextMovilMuerte', '$getTextObservaciones')


                          COMMIT
                    END TRY
                    BEGIN CATCH 
                          ROLLBACK TRANSACTION
                          RAISERROR('No se realizo la transaccion',16,1)
                    END CATCH
                    END
                  "; 
                 }else{
                    $queryTransaction = " 
                    BEGIN                     
                          BEGIN TRY 
                            BEGIN TRANSACTION
                                  SET NOCOUNT ON 

                                    UPDATE pueDisposi.Defunciones SET nombre = '$getTextNombre' , ap_paterno = '$getTextAp_paterno' , 
                                           ap_materno = '$getTextAp_materno' , edad = $getTextEdad , sexo = '$getTextSexo' , 
                                           idCausaMuerte = $getTextCatCausaMuerte_id , movilMuerte = '$getTextMovilMuerte' , 
                                           observaciones = '$getTextObservaciones'
                                           WHERE IdDefuncion = $idDefuncion
                                              
                                COMMIT
                          END TRY
                          BEGIN CATCH 
                                ROLLBACK TRANSACTION
                                RAISERROR('No se realizo la transaccion',16,1)
                          END CATCH
                          END
                        ";
                  }                     



                    $result = sqlsrv_query($conn,$queryTransaction, array(), array( "Scrollable" => 'static' ));  

                      while ($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC ))
                    {  $id=$row['id'];   }

                    $arreglo[0] = "NO";
                    $arreglo[1] = "SI";
                    $arreglo[2] = $idPuestaDisposicion;

                    $d = array('first' => $arreglo[1] , 'idpuestaultimo' => $arreglo[2]);

                    if ($result) {
                      echo json_encode($d);

                    }else{
                      echo json_encode(array('first'=>$arreglo[0]));
                    }

      }
?>