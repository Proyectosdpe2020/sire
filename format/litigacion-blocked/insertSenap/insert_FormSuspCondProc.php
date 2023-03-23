<?php

header('Content-Type: text/html; charset=utf-8');
include ("../../../Conexiones/Conexion.php");



/*DATOS GENERALES*/
if (isset($_POST['idEstatusNucs'])){ $idEstatusNucs = $_POST['idEstatusNucs']; }
if (isset($_POST['nuc'])){ $nuc = $_POST['nuc']; }


/*DATOS FORMULARIO SENAP*/
if (isset($_POST['fechaDictoSuspConProc'])){ $fechaDictoSuspConProc = $_POST['fechaDictoSuspConProc']; } 
if (isset($_POST['etapaSuspCondProc'])){ $etapaSuspCondProc = $_POST['etapaSuspCondProc']; } 
if (isset($_POST['CondImpuSuspConProc'])){ $CondImpuSuspConProc = $_POST['CondImpuSuspConProc']; } 
if (isset($_POST['reaperturaProc'])){ $reaperturaProc = $_POST['reaperturaProc']; } 
if (isset($_POST['fechaReaperProc'])){ $fechaReaperProc = $_POST['fechaReaperProc']; } 
if (isset($_POST['fechaCumpSuspCondPro'])){ $fechaCumpSuspCondPro = $_POST['fechaCumpSuspCondPro']; } 

if (isset($_POST['opcInsert'])){ $opcInsert = $_POST['opcInsert']; } 

//Si opcInsert == 0 es un nuevo registro, si opcInsert == 1 es una edicion de registro
if($opcInsert == 0){

  $queryTransaction = " 
                        BEGIN                     
                              BEGIN TRY 
                                BEGIN TRANSACTION
                                      SET NOCOUNT ON 

                                        INSERT INTO senap.suspCondProc (idEstatusNucs, fechaDictoSuspCondProc, idEtapaSuspCondProc, idTipoCondImpuSuspConProc, reaperturaProc, fechaReaperProc, fechaCumplimentoSuspCondPro) 
                                        VALUES('$idEstatusNucs', '$fechaDictoSuspConProc', $etapaSuspCondProc, $CondImpuSuspConProc, $reaperturaProc, '$fechaReaperProc', '$fechaCumpSuspCondPro')
                                                  
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

                                        UPDATE senap.suspCondProc SET 
                                        fechaDictoSuspCondProc = '$fechaDictoSuspConProc',
                                        idEtapaSuspCondProc = $etapaSuspCondProc,
                                        idTipoCondImpuSuspConProc = $CondImpuSuspConProc,
                                        reaperturaProc = $reaperturaProc,
                                        fechaReaperProc = '$fechaReaperProc',
                                        fechaCumplimentoSuspCondPro = '$fechaCumpSuspCondPro'
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

 $result = sqlsrv_query($conn,$queryTransaction, array(), array( "Scrollable" => 'static' ));
 $arreglo[0] = "NO";
 $arreglo[1] = "SI";

 if($result){
  $d = array('first' => $arreglo[1]);
  echo json_encode($d);
 }else{
  echo json_encode(array('first'=>$arreglo[0])); //Si no se realizo la transacción devolver 0 para indicar mensaje de alerta
 }

