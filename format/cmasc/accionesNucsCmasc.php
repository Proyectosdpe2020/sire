<?php

include("../../Conexiones/conexionSicap.php");
include("../../funcioneSicap.php");

include("../../Conexiones/Conexion.php");
include("../../funciones.php");
include("../../funCmasc.php");	

if (isset($_POST["acc"])){ $acc = $_POST["acc"]; }
if (isset($_POST["nuc"])){ $nuc = $_POST["nuc"]; }
if (isset($_POST["type"])){ $type = $_POST["type"]; }
if (isset($_POST["type2"])){ $type2 = $_POST["type2"]; }
if (isset($_POST["idUnidad"])){ $idUnidad = $_POST["idUnidad"]; }
if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }
if (isset($_POST["mes"])){ $mes = $_POST["mes"]; }
if (isset($_POST["anio"])){ $anio = $_POST["anio"]; }
if (isset($_POST["tramANt"])){ $tramANt = $_POST["tramANt"]; }
if (isset($_POST["tipo"])){ $tipo = $_POST["tipo"]; }
if (isset($_POST["estatus"])){ $estatus = $_POST["estatus"]; }


switch ($acc) {

 case 'existeNucSic':
              //// a = se encontro ya como ordinario en la bd
              //// b = no se encuentra y lo puedes capturar como ordinario
              //// c = no existe el nuc en sicap
              //// d = se puede capturar pero como reproceso solamente
             ///// e = NO SE PUEDE CAPTURAR COMO REPROCESO POR QUE NO EXISTE UN NUC COMO ORDINARIO EN CMASC

          //// SE OBTIENE EL NOMBRE DEL ULTIMO MP DE LA MISMA UNIDAD QUE HIZO LA DETERMINACION /////
 $arreglo[0] = "a";
 $arreglo[1] = "b";
 $arreglo[2] = "c";  
 $arreglo[3] = "d";    
 $arreglo[4] = "e";       
 $arreglo[5] = "f"; 
 $arreglo[6] = "g";
 $arreglo[7] = "h"; /// INSERTED
 $arreglo[8] = "i"; /// NO INSERTED
 $arreglo[9] = "j"; /// NO INSERT BECAUSE EXIST A REPROCESS      
 $arreglo[10] = "k"; /// NO INSERT BECAUSE EXIST A DESECHADO       
 $arreglo[11] = "l"; /// NO INSERT BECAUSE EXIST A ORDINARIO AND PROCEDENTE      
 $arreglo[12] = "m"; /// NO SE PUEDE INGRESAR COMO DESECHADO POR QUE ACTUALMENTE EXISTE UN REPROCESO PROCEDENTE   

 if (isset($_POST["nuc"])){ $nuc = $_POST["nuc"]; }

 if($aux=get_nuc_sicap ($nuc,$conSic)){  
  if($type == 0){  /// SI ES ORDINARIO
                          //VALIDATE IF NUC IS FOUNDED IN NUCS CAPTURED PREVIOUSLY
   $nucVal = foundNuc($conn, $nuc, 0);
   if(sizeof($nucVal) > 0){
    if($nucVal[0][1] == 0){ echo json_encode(array('first'=>$arreglo[0])); }else{
                             ////////AQUI SE PUEDE CAPTURAR PERO COMO REPROCESO
     echo json_encode(array('first'=>$arreglo[3]));
    }                             
   }else{ 
                           //// b = no se encuentra y lo puedes capturar como ordinario
                              /// process to insert into bd ordinario
    if($type == 0 AND $type2 == 0){ $acu = 0; }
    if($type == 0 AND $type2 == 1){ $acu = 0; }

    $queryTransaction = "  
    BEGIN                     
    BEGIN TRY 
    BEGIN TRANSACTION
    SET NOCOUNT ON                               
    INSERT INTO CMASC.nucsRecib VALUES($idUnidad, '$nuc', $type, $type2, $mes ,$anio, $idEnlace , GETDATE(), 0)
    COMMIT
    END TRY
    BEGIN CATCH 
    ROLLBACK TRANSACTION
    RAISERROR('No se realizo la transaccion',16,1)
    END CATCH
    END
    "; 
    $result = sqlsrv_query($conn,$queryTransaction, array(), array( "Scrollable" => 'static' )); 
    if ($result) {

        ////// OBTENER EL TOTAL DE RECIBIDAS HASTA EL MOMENTO SOLO PROCEDENTES
     $dataProced = countNucsProcedents($conn, $mes, $anio, $idEnlace);
     $valor = $dataProced[0][0];
        ///// HACER UN INSERT EN LA TABLA RECIBIDAS
     $quey = "SELECT idRecibidas FROM CMASC.recibidas WHERE idEnlace = $idEnlace AND mes = $mes AND anio = $anio";
     $stmt = sqlsrv_query(  $conn, $quey,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
     $row_count = sqlsrv_num_rows( $stmt );
     if($row_count > 0){
      $queyRecib = "UPDATE CMASC.recibidas SET totalRecibidas = $valor, extAnter = $tramANt WHERE idEnlace = $idEnlace AND mes = $mes AND anio = $anio ";
      $result1 = sqlsrv_query($conn,$queyRecib, array(), array( "Scrollable" => 'static' )); 
     }else{
      $queyRecib2 = "INSERT INTO CMASC.recibidas VALUES($idEnlace, $anio,$mes,$tramANt,0,0,0,0,0,0, GETDATE()) ";
      $result2 = sqlsrv_query($conn,$queyRecib2, array(), array( "Scrollable" => 'static' ));
    //echo $queyRecib2;
     }
     echo json_encode(array('first'=>$arreglo[7]));

    }else{
     echo json_encode(array('first'=>$arreglo[8]));
    }

   }
  }else{
 if($type == 1){ ///// SI ES REPROCESO
  $nucVal = foundNuc($conn, $nuc, 0);
  if(sizeof($nucVal) > 0){  

      ////// VALIDAR SI ES PROCEDENTWE QUE EL ULTIMO ESTATUS SEA DESECHADO DE ESE NUC SI NO SE RECHAZA POR QUE HAY UN REPROCESO PROCEDENTE

   if($nucVal[0][2] == 0){
        /////// NO SE PUEDE INGRESAR DE NINGUNA FORMA POR QUE YA SE TUVO UN ORDINARIO PROCEDENTE
    echo json_encode(array('first'=>$arreglo[11])); 

   }else{


      if($type2 == 0){ //// SI ES PROCEDENTE

       $ststnu = lastStatusNuc($conn, $nuc);
       if($ststnu[0][1] == 0){
          ////// NO SE PUEDE CAPTURAR DE NUEVO COMO PROCEDENTE POR QUE AUN ESTA COMO PROCEDENTE
        echo json_encode(array('first'=>$arreglo[9])); 
       }else{
          if($ststnu[0][1] == 1){ //// SI ES DESECHADO


           ///// SE TENDRIA QUE INSERTAR EL PROCEDENTE POR QUE EL ULTIMO ESTATUS ES DESECHADO

           $queryTransaction = "  
           BEGIN                     
           BEGIN TRY 
           BEGIN TRANSACTION
           SET NOCOUNT ON                               
           INSERT INTO CMASC.nucsRecib VALUES($idUnidad, '$nuc', $type, $type2, $mes ,$anio, $idEnlace , GETDATE(), 0 )
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
           if ($result) {

      ////// OBTENER EL TOTAL DE RECIBIDAS HASTA EL MOMENTO SOLO PROCEDENTES
            $dataProced = countNucsProcedents($conn, $mes, $anio, $idEnlace);
            $valor = $dataProced[0][0];

        ///// HACER UN INSERT EN LA TABLA RECIBIDAS
            $quey = "SELECT idRecibidas FROM CMASC.recibidas WHERE idEnlace = $idEnlace AND mes = $mes AND anio = $anio";

            $stmt = sqlsrv_query(  $conn, $quey,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
            $row_count = sqlsrv_num_rows( $stmt );
            if($row_count > 0){

             $queyRecib = " UPDATE CMASC.recibidas SET totalRecibidas = $valor, extAnter = $tramANt WHERE idEnlace = $idEnlace AND mes = $mes AND anio = $anio ";

             $result1 = sqlsrv_query($conn,$queyRecib, array(), array( "Scrollable" => 'static' )); 
            }else{
             $queyRecib2 = "INSERT INTO CMASC.recibidas VALUES($idEnlace, $anio,$mes,$tramANt,0,0,0,0,0,$dataProced[0][0], GETDATE()) ";
             $result2 = sqlsrv_query($conn,$queyRecib2, array(), array( "Scrollable" => 'static' ));
            }

            echo json_encode(array('first'=>$arreglo[7]));
           }else{
            echo json_encode(array('first'=>$arreglo[8]));
           }


          }
         }


        }else{

    if($type2 == 1){ //// SI ES DESECHADO


     $ststnu = lastStatusNuc($conn, $nuc);
     if($ststnu[0][1] == 1){


         /////// SE DEBERIA DE CAPTURAR POR QUE ES UN REPROCESO DESECHADO
         ////////  SE CAPTURA POR QUE TIENE SU ORDINARIO Y SERIA UN REPROCESO DESECHADO y no existe en reproceso
      $queryTransaction = "  
      BEGIN                     
      BEGIN TRY 
      BEGIN TRANSACTION
      SET NOCOUNT ON                               
      INSERT INTO CMASC.nucsRecib VALUES($idUnidad, '$nuc', $type, $type2, $mes ,$anio, $idEnlace , GETDATE(), 0 )
      COMMIT
      END TRY
      BEGIN CATCH 
      ROLLBACK TRANSACTION
      RAISERROR('No se realizo la transaccion',16,1)
      END CATCH
      END
      "; 
      $result = sqlsrv_query($conn,$queryTransaction, array(), array( "Scrollable" => 'static' )); 
      if ($result) {

      ////// OBTENER EL TOTAL DE RECIBIDAS HASTA EL MOMENTO SOLO PROCEDENTES
       $dataProced = countNucsProcedents($conn, $mes, $anio, $idEnlace);
       $valor = $dataProced[0][0];

        ///// HACER UN INSERT EN LA TABLA RECIBIDAS
       $quey = "SELECT idRecibidas FROM CMASC.recibidas WHERE idEnlace = $idEnlace AND mes = $mes AND anio = $anio";

       $stmt = sqlsrv_query(  $conn, $quey,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
       $row_count = sqlsrv_num_rows( $stmt );
       if($row_count > 0){

        $queyRecib = " UPDATE CMASC.recibidas SET totalRecibidas = $valor, extAnter = $tramANt WHERE idEnlace = $idEnlace AND mes = $mes AND anio = $anio ";

        $result1 = sqlsrv_query($conn,$queyRecib, array(), array( "Scrollable" => 'static' )); 
       }else{
        $queyRecib2 = "INSERT INTO CMASC.recibidas VALUES($idEnlace, $anio,$mes,$tramANt,0,0,0,0,0,$dataProced[0][0], GETDATE()) ";
        $result2 = sqlsrv_query($conn,$queyRecib2, array(), array( "Scrollable" => 'static' ));
       }

       echo json_encode(array('first'=>$arreglo[7]));
      }else{
       echo json_encode(array('first'=>$arreglo[8]));
      }


     }else{
      if($ststnu[0][1] == 0){

      echo json_encode(array('first'=>$arreglo[12])); /// NO SE PUEDE INGRESAR COMO DESECHADO POR QUE ACTUALMENTE EXISTE UN REPROCESO PROCEDENTE

     }
    }

   }

  }


 }





}else{
 echo json_encode(array('first'=>$arreglo[4]));
                        //////// NO SE PUEDE CAPTURAR COMO REPROCESO POR QUE NO EXISTE UN NUC COMO ORDINARIO EN CMASC
}


}

}



}else{
 echo json_encode(array('first'=>$arreglo[2]));
}
break;     




case 'checkNucAcuerds':

$arreglo[0] = "a";
$arreglo[1] = "b";
$arreglo[2] = "c";  
$arreglo[3] = "d";    
$arreglo[4] = "e";       
$arreglo[5] = "f"; 
$arreglo[6] = "g";
 $arreglo[7] = "h"; /// INSERTED
 $arreglo[8] = "i"; /// NO INSERTED
 $arreglo[9] = "j"; /// ACUERDO NO INSERTED BECAUSE IS DESECHADO STATUS
 $arreglo[10] = "k"; /// ACUERDO NO INSERTED BECAUSE ACUERDO IS CLOSED


 if (isset($_POST["nuc"])){ $nuc = $_POST["nuc"]; }

 /////// REVISAR QUE EL NUC SE ENCUENTRE EN LA TABLA DE LOS QUE FUERON RECIBIDOS PERO TAMBIEN QUE EL ULTIMO ESTATUS DEL NUC ESTE EN PROCEDNTE

 //$nucsRec = getNucRecibido($conn, $nuc);

 $nucsRec = lastStatusNuc($conn, $nuc); /// SE OBTIENE EL ULTIMO ESTATUS DE EL NUC QUE ESTAN INGRESANDO PARA ACUERDO 

 if(sizeof($nucsRec) > 0){  


  ///// SI EXISTE ESE NUC Y PARA PODER AGREGARLO DBBE SU ULTIMO ESTATUS ESTAR EN PROCEDENTE 

  if($nucsRec[0][1] == 0){


            //// REVISAR SI EL NUC YA TIENE UN ACUERDO

   $isacuerd = isAcuerd($conn, $nuc);
   if(sizeof($isacuerd) > 0){ 

    if($isacuerd[0][2] == 1 ){  $es = getStatusAcuerd($conn, $isacuerd[0][1]); $est = $es[0][0];  $varNtip = "Mediación"; }
    if($isacuerd[0][2] == 2 ){  $es = getStatusAcuerd($conn, $isacuerd[0][1]); $est = $es[0][0]; $varNtip = "Conciliación"; }
    if($isacuerd[0][2] == 3 ){  $es = getStatusAcuerd($conn, $isacuerd[0][1]); $est = $es[0][0]; $varNtip = "Junta Restaurativa"; }
    echo json_encode(array('first'=>$arreglo[0], 'firs2'=> $varNtip, 'first3'=> $est)); 

   }else{


         /// GET ESTATUS LAST NUC IN RECIBED NUCS
    $statusRecib = getIngresadosNucAcuer($conn, $nuc);
  /// ESTA BASADO EN EL ULTIMO ESTATUS DE LA CARPETAS 

   if($statusRecib[0][1] == 0){ ////// SI ES ORDINARIO 

     if($statusRecib[0][2] == 0){ //// SI ES PROCEDENTE

         /// SI ES ORDINARIO Y PROCEDENTE SE PUEDE CAPTURAR EL ACUERDO
      $queryTransaction = "  
      BEGIN                     
      BEGIN TRY 
      BEGIN TRANSACTION
      SET NOCOUNT ON                               
      INSERT INTO CMASC.nucsEstatus VALUES($estatus,$tipo,'$nuc', GETDATE(), $anio, $mes, $idEnlace)
      COMMIT
      END TRY
      BEGIN CATCH 
      ROLLBACK TRANSACTION
      RAISERROR('No se realizo la transaccion',16,1)
      END CATCH
      END
      ";  

      $result = sqlsrv_query($conn,$queryTransaction, array(), array( "Scrollable" => 'static' )); 
      if ($result){
       echo json_encode(array('first'=>$arreglo[7]));
       ////// SE HACE UN UPDATE A LA TABLA DE NUCS RECIB DONDE SE PONE ACUERDO 1 AL ULTIMO NUC PROCEDENTE
       $nurec = nucAcuerUpdatRecib($conn, $nuc);
       $valor = $nurec[0][0];
       $querUpd = "  
       BEGIN                     
       BEGIN TRY 
       BEGIN TRANSACTION
       SET NOCOUNT ON                               
       UPDATE CMASC.nucsRecib SET [acue/termin] = 1 WHERE idNucRecibida = $valor
       COMMIT
       END TRY
       BEGIN CATCH 
       ROLLBACK TRANSACTION
       RAISERROR('No se realizo la transaccion',16,1)
       END CATCH
       END
       "; 
       $result21 = sqlsrv_query($conn,$querUpd, array(), array( "Scrollable" => 'static' )); 
      }else{
       echo json_encode(array('first'=>$arreglo[8]));
      }


     }
     if($statusRecib[0][2] == 1){ //// SI ES DESECHADO
         /// SI ES ORDINARIO Y FUE RECHAZADO NO SE PUEDE CAPTURAR UN ACUERDO PARA EL NUC
      echo json_encode(array('first'=>$arreglo[3]));
     } 

    }else{
    if($statusRecib[0][1] == 1){ //////// SI ES REPROCESO


      if($statusRecib[0][2] == 0){ //// SI ES PROCEDENTE

         //// SI ES REPROCESO Y ES PROCEDENTE SE PUEDE CAPTURAR EL ACUERDO
       $queryTransaction = "  
       BEGIN                     
       BEGIN TRY 
       BEGIN TRANSACTION
       SET NOCOUNT ON                               
       INSERT INTO CMASC.nucsEstatus VALUES($estatus,$tipo,'$nuc', GETDATE(), $anio, $mes, $idEnlace)
       COMMIT
       END TRY
       BEGIN CATCH 
       ROLLBACK TRANSACTION
       RAISERROR('No se realizo la transaccion',16,1)
       END CATCH
       END
       ";  

       $result = sqlsrv_query($conn,$queryTransaction, array(), array( "Scrollable" => 'static' )); 
       if ($result){
        echo json_encode(array('first'=>$arreglo[7]));
        ////// SE HACE UN UPDATE A LA TABLA DE NUCS RECIB DONDE SE PONE ACUERDO 1 AL ULTIMO NUC PROCEDENTE
        $nurec = nucAcuerUpdatRecib($conn, $nuc);
        $valor = $nurec[0][0];
        $querUpd2 = "  
        BEGIN                     
        BEGIN TRY 
        BEGIN TRANSACTION
        SET NOCOUNT ON                               
        UPDATE CMASC.nucsRecib SET [acue/termin] = 1 WHERE idNucRecibida = $valor
        COMMIT
        END TRY
        BEGIN CATCH 
        ROLLBACK TRANSACTION
        RAISERROR('No se realizo la transaccion',16,1)
        END CATCH
        END
        "; 
        $result22 = sqlsrv_query($conn,$querUpd2, array(), array( "Scrollable" => 'static' )); 

       }else{
        echo json_encode(array('first'=>$arreglo[8]));
       }


      }
     if($statusRecib[0][2] == 1){ //// SI ES DESECHADO
       ///// SI ES REPROCESO Y ES DESECHADO NO SE¨PUEDE CAPTURAR EL ACUERDO
      echo json_encode(array('first'=>$arreglo[4]));
     }

    }
   }




  }
    //// REVISAR SI EL NUC YA TIENE UN ACUERDO


 }else{


  if($nucsRec[0][1] == 1){ echo json_encode(array('first'=>$arreglo[9])); }
        if($nucsRec[0][1] == 2){ echo json_encode(array('first'=>$arreglo[10])); }  ////// NUEVO ESTATUS ES EL DE UN ACUERDO QUE YA TERMINO SU PROCESO

       }

  ///// SI EXISTE ESE NUC Y PARA PODER AGREGARLO DBBE SU ULTIMO ESTATUS ESTAR EN PROCEDENTE 









      }else{
       echo json_encode(array('first'=>$arreglo[2]));
      }

      break;


     }    




     ?>