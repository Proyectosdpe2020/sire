<?php

      header('Content-Type: text/html; charset=utf-8');
      include("../../funciones.php");
      include ("../../Conexiones/Conexion.php");

        $data = json_decode($_POST['jObject'], true);
        
    

      $fechaevento=$data[2];
      $fechaevento=str_ireplace("'",'',$fechaevento);
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
      
      
      if (isset($_POST["idPuestaDisposicion"])){ $idPuestaDisposicion = $_POST["idPuestaDisposicion"]; }else{
              $idPuestaDisposicion = "";
      } 
      
 
       //////////// DATOS DE PUESTA A DISPOSICION /////

       //////////// DATOS DE VEHICULO /////
       if (isset($_POST["observaVehi"])){ $observaVehi = $_POST["observaVehi"]; }
       if (isset($_POST["oficioVehi"])){ $oficioVehi = $_POST["oficioVehi"]; }
       if (isset($_POST["requeOtroCopro"])){ $requeOtroCopro = $_POST["requeOtroCopro"]; }
     

       if (isset($_POST["motorAlVehi"])){ $motorAlVehi = $_POST["motorAlVehi"]; }
       if (isset($_POST["motorVehi"])){ $motorVehi = $_POST["motorVehi"]; }
       if (isset($_POST["serieAlVehi"])){ $serieAlVehi = $_POST["serieAlVehi"]; }
       if (isset($_POST["serieVehi"])){ $serieVehi = $_POST["serieVehi"]; }      
       if (isset($_POST["placaVehi"])){ $placaVehi = $_POST["placaVehi"]; }
       if (isset($_POST["modeloVehi"])){ $modeloVehi = $_POST["modeloVehi"]; }
       if (isset($_POST["colorVehi"])){ $colorVehi = $_POST["colorVehi"]; }
       if (isset($_POST["newTipo_id"])){ $newTipo_id = $_POST["newTipo_id"]; }
       if (isset($_POST["newLineas_id"])){ $newLineas_id = $_POST["newLineas_id"]; }
       if (isset($_POST["newMarca_id"])){ $newMarca_id = $_POST["newMarca_id"]; }
       if (isset($_POST["selTipoDelito"])){ $selTipoDelito = $_POST["selTipoDelito"]; }
       if (isset($_POST["selDelito"])){ $selDelito = $_POST["selDelito"]; }
       if (isset($_POST["requeridoPorVehi"])){ $requeridoPorVehi = $_POST["requeridoPorVehi"]; }
       if (isset($_POST["selAdispo"])){ $selAdispo = $_POST["selAdispo"]; }
       if (isset($_POST["nucVehiculo"])){ $nucVehiculo = $_POST["nucVehiculo"]; }
       if (isset($_POST["selFormAsegur"])){ $selFormAsegur = $_POST["selFormAsegur"]; }
       if (isset($_POST["selClasific"])){ $selClasific = $_POST["selClasific"]; }

       if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }

////TIPO DE ACTUALIZACION Y ID VEHICULO////
if (isset($_POST['tipoActualizacion'])){ $tipoActualizacion = $_POST['tipoActualizacion']; }
if (isset($_POST['idVeicle'])){ $idVeicle = $_POST['idVeicle']; }
     
          if($modeloVehi == ""){ $modeloVehi = 0; }
      
      //////////// DATOS DE VEHICULO /////     
      if($data[10] == false){ $data[10] = 0; }else{ $data[10] = 1; }
      if($data[11] == false){ $data[11] = 0; }else{ $data[11] = 1; }
      if($data[12] == false){ $data[12] = 0; }else{ $data[12] = 1; }
      if($data[13] == false){ $data[13] = 0; }else{ $data[13] = 1; }
      if($data[14] == false){ $data[14] = 0; }else{ $data[14] = 1; }      
                  

      if($idPuestaDisposicion == ""){
          
                   $queryTransaction = "  

                    BEGIN                     
                    BEGIN TRY 
                      BEGIN TRANSACTION
                          SET NOCOUNT ON

                                          declare @insertado int

                                         INSERT INTO pueDisposi.puestaDisposicion VALUES($data[0],$data[1],$fechaevento,GETDATE(), $data[7], $data[5], $data[8], $data[4], $data[6], DATEPART(dw, $fechaevento), DATEPART(day, $fechaevento),DATEPART(month, $fechaevento), DATEPART(year, $fechaevento), $data[3], $idEnlace, $data[10], $data[11], $data[12], $data[13], $data[14], '$data[15]' )


                                          select @insertado = @@IDENTITY


                                            INSERT INTO pueDisposi.vehiculo VALUES(@insertado, $selClasific, $selFormAsegur , '$nucVehiculo', $selAdispo, '$requeridoPorVehi', $selDelito,$selTipoDelito,$newMarca_id,$newLineas_id,$newTipo_id,'$colorVehi',$modeloVehi,'$placaVehi','$serieVehi','$serieAlVehi', '$motorVehi','$motorAlVehi','$requeOtroCopro','$oficioVehi','$observaVehi' )


                                            SELECT MAX(idPuestaDisposicion) AS id FROM pueDisposi.puestaDisposicion

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
                if($tipoActualizacion == 0){
                  $queryTransaction = " 
                    BEGIN                     
                    BEGIN TRY 
                      BEGIN TRANSACTION
                          SET NOCOUNT ON    

                                          
                                           INSERT INTO pueDisposi.vehiculo VALUES($idPuestaDisposicion, $selClasific, $selFormAsegur , '$nucVehiculo', $selAdispo, '$requeridoPorVehi', $selDelito,$selTipoDelito,$newMarca_id,$newLineas_id,$newTipo_id,'$colorVehi',$modeloVehi,'$placaVehi','$serieVehi','$serieAlVehi', '$motorVehi','$motorAlVehi','$requeOtroCopro','$oficioVehi','$observaVehi' )

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

                                    UPDATE pueDisposi.vehiculo SET 
                                           idClasificacion = $selClasific,
                                           idFormaAseguramiento = $selFormAsegur,
                                           avppcarpeta = '$nucVehiculo',
                                           idDisposicion = $selAdispo,
                                           requeridoPor = '$requeridoPorVehi',
                                           idDelito = $selDelito,
                                           idTipoenDelito = $selTipoDelito,
                                           idMarca = $newMarca_id,
                                           idLinea = $newLineas_id,
                                           idTipo = $newTipo_id,
                                           color = '$colorVehi',
                                           modelo = $modeloVehi,
                                           placa = '$placaVehi',
                                           serie = '$serieVehi',
                                           serieAlterada = '$serieAlVehi',
                                           motor = '$motorVehi',
                                           motorAlterado = '$motorAlVehi',
                                           requeridoOtrasCorpor = '$requeOtroCopro',
                                           oficio = '$oficioVehi',
                                           observaciones = '$observaVehi'
                                           WHERE idVehiculo = $idVeicle
                                              
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
