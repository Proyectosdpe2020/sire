<?php

header('Content-Type: text/html; charset=utf-8');
include ("../../../Conexiones/Conexion.php");



/*DATOS GENERALES*/
if (isset($_POST['idEstatusNucs'])){ $idEstatusNucs = $_POST['idEstatusNucs']; }
if (isset($_POST['nuc'])){ $nuc = $_POST['nuc']; }
if (isset($_POST['estatus'])){ $estatus = $_POST['estatus']; }


/*DATOS FORMULARIO SENAP*/
if (isset($_POST['idCatModalidadEst'])){ $idCatModalidadEst = $_POST['idCatModalidadEst']; }  
if (isset($_POST['reclasificacion'])){ $reclasificacion = $_POST['reclasificacion']; } 
if (isset($_POST['tipoSentencia'])){ $tipoSentencia = $_POST['tipoSentencia']; } 

 if (isset($_POST['fechaDictoSentencia'])){ $fechaDictoSentencia = $_POST['fechaDictoSentencia']; }    
 if (isset($_POST['aniosPrision'])){ $aniosPrision = $_POST['aniosPrision']; }  
 if (isset($_POST['sentenciaFirme'])){ $sentenciaFirme = $_POST['sentenciaFirme']; }  
 if (isset($_POST['sentDerivaProcAbrv'])){ $sentDerivaProcAbrv = $_POST['sentDerivaProcAbrv']; }  
 if (isset($_POST['fechaDictoProcAbrv'])){ $fechaDictoProcAbrv = $_POST['fechaDictoProcAbrv']; }  



if (isset($_POST['opcInsert'])){ $opcInsert = $_POST['opcInsert']; } 

if($estatus != 14){
 //Si opcInsert == 0 es un nuevo registro, si opcInsert == 1 es una edicion de registro
 if($opcInsert == 0){
  if($estatus == 66){
    $queryTransaction = " 
                         BEGIN                     
                               BEGIN TRY 
                                 BEGIN TRANSACTION
                                       SET NOCOUNT ON 

                                         INSERT INTO senap.sentencias (idEstatusNucs, ResolucionID, estatus, idTipoSentencia, idModalidadEstadistica, reclasificacion) 
                                         VALUES('$idEstatusNucs', '0', $estatus,  $tipoSentencia, $idCatModalidadEst, $reclasificacion)
                                                   
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

                                         INSERT INTO senap.sentencias (idEstatusNucs, ResolucionID, estatus, fechaDictoSentencia, idTipoSentencia, aniosPrision, sentenciaEncuentraFirme, sentDerivaProcAbrv, fechaDictoProcAbrv, idModalidadEstadistica, reclasificacion) 
                                         VALUES('$idEstatusNucs', '0', $estatus, '$fechaDictoSentencia',  $tipoSentencia, $aniosPrision, $sentenciaFirme, $sentDerivaProcAbrv, '$fechaDictoProcAbrv', $idCatModalidadEst, $reclasificacion)
                                                   
                                       COMMIT
                               END TRY
                               BEGIN CATCH 
                                     ROLLBACK TRANSACTION
                                     RAISERROR('No se realizo la transaccion',16,1)
                               END CATCH
                               END
                         ";
  }

 }else{

  if($estatus == 66){
    $queryTransaction = " 
                         BEGIN                     
                               BEGIN TRY 
                                 BEGIN TRANSACTION
                                       SET NOCOUNT ON 

                                         UPDATE senap.sentencias SET 
                                         idTipoSentencia = $tipoSentencia,
                                         idModalidadEstadistica = $idCatModalidadEst,
                                         reclasificacion = $reclasificacion
                                         WHERE idEstatusNucs = '$idEstatusNucs' ;
                                                   
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

                                         UPDATE senap.sentencias SET 
                                         fechaDictoSentencia = '$fechaDictoSentencia',
                                         idTipoSentencia = $tipoSentencia,
                                         aniosPrision = $aniosPrision,
                                         sentenciaEncuentraFirme = $sentenciaFirme,
                                         sentDerivaProcAbrv = $sentDerivaProcAbrv,
                                         fechaDictoProcAbrv = '$fechaDictoProcAbrv',
                                         idModalidadEstadistica = $idCatModalidadEst,
                                         reclasificacion = $reclasificacion
                                         WHERE idEstatusNucs = '$idEstatusNucs' ;
                                                   
                                       COMMIT
                               END TRY
                               BEGIN CATCH 
                                     ROLLBACK TRANSACTION
                                     RAISERROR('No se realizo la transaccion',16,1)
                               END CATCH
                               END
                         ";
    }
   }
}else{
 //Si opcInsert == 0 es un nuevo registro, si opcInsert == 1 es una edicion de registro
 if($opcInsert == 0){
  if($estatus == 66){
   $queryTransaction = " 
                         BEGIN                     
                               BEGIN TRY 
                                 BEGIN TRANSACTION
                                       SET NOCOUNT ON 

                                         INSERT INTO senap.sentencias (idEstatusNucs, ResolucionID, estatus, idTipoSentencia, idModalidadEstadistica , reclasificacion) 
                                         VALUES('0', '$idEstatusNucs', $estatus, $tipoSentencia, $idCatModalidadEst, $reclasificacion)
                                                   
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

                                         INSERT INTO senap.sentencias (idEstatusNucs, ResolucionID, estatus, fechaDictoSentencia, idTipoSentencia, aniosPrision, sentenciaEncuentraFirme, sentDerivaProcAbrv, fechaDictoProcAbrv, idModalidadEstadistica , reclasificacion) 
                                         VALUES('0', '$idEstatusNucs', $estatus, '$fechaDictoSentencia',  $tipoSentencia, $aniosPrision, $sentenciaFirme, $sentDerivaProcAbrv, '$fechaDictoProcAbrv', $idCatModalidadEst, $reclasificacion)
                                                   
                                       COMMIT
                               END TRY
                               BEGIN CATCH 
                                     ROLLBACK TRANSACTION
                                     RAISERROR('No se realizo la transaccion',16,1)
                               END CATCH
                               END
                         ";
  }
   
 }else{
   $queryTransaction = " 
                         BEGIN                     
                               BEGIN TRY 
                                 BEGIN TRANSACTION
                                       SET NOCOUNT ON 

                                         UPDATE senap.sentencias SET 
                                         fechaDictoSentencia = '$fechaDictoSentencia',
                                         idTipoSentencia = $tipoSentencia,
                                         aniosPrision = $aniosPrision,
                                         sentenciaEncuentraFirme = $sentenciaFirme,
                                         sentDerivaProcAbrv = $sentDerivaProcAbrv,
                                         fechaDictoProcAbrv = '$fechaDictoProcAbrv',
                                         idModalidadEstadistica = $idCatModalidadEst,
                                         reclasificacion = $reclasificacion
                                         WHERE ResolucionID = '$idEstatusNucs' ;
                                                   
                                       COMMIT
                               END TRY
                               BEGIN CATCH 
                                     ROLLBACK TRANSACTION
                                     RAISERROR('No se realizo la transaccion',16,1)
                               END CATCH
                               END
                         ";
 }
}

 $result = sqlsrv_query($conn,$queryTransaction, array(), array( "Scrollable" => 'static' ));
 $arreglo[0] = "NO";
 $arreglo[1] = "SI";

 if($result){
  $d = array('first' => $arreglo[1]);
  echo json_encode($d);
 }else{
  echo json_encode(array('first'=>$arreglo[0])); //Si no se realizo la transacción devolver 0 para indicar mensaje de alerta
 }

