<?php

header('Content-Type: text/html; charset=utf-8');
include ("../../../Conexiones/Conexion.php");



/*DATOS GENERALES*/
if (isset($_POST['idEstatusNucs'])){ $idEstatusNucs = $_POST['idEstatusNucs']; }
if (isset($_POST['nuc'])){ $nuc = $_POST['nuc']; }


/*DATOS FORMULARIO SENAP*/
if (isset($_POST['fechaCierreInvest'])){ $fechaCierreInvest = $_POST['fechaCierreInvest']; } 
if (isset($_POST['formulacionAcusacion'])){ $formulacionAcusacion = $_POST['formulacionAcusacion']; } 
if (isset($_POST['fechaEscritoAcusacion'])){ $fechaEscritoAcusacion = $_POST['fechaEscritoAcusacion']; }
if (isset($_POST['opcInsert'])){ $opcInsert = $_POST['opcInsert']; }  

if (isset($_POST['edad_imputado_medida'])){ $edad_imputado_medida = $_POST['edad_imputado_medida']; } 
if (isset($_POST['temporalida_medida'])){ $temporalida_medida = $_POST['temporalida_medida']; } 
if (isset($_POST['parentesco_victima'])){ $parentesco_victima = $_POST['parentesco_victima']; } 
if (isset($_POST['id_sexo'])){ $id_sexo = $_POST['id_sexo']; }

//Si opcInsert == 0 es un nuevo registro, si opcInsert == 1 es una edicion de registro
if($opcInsert == 0){

  $queryTransaction = " 
                        BEGIN                     
                              BEGIN TRY 
                                BEGIN TRANSACTION
                                      SET NOCOUNT ON 

                                        INSERT INTO senap.medidaCautelar (idEstatusNucs, fechaCierreInvest, formulacionAcusacion, fechaEscritoAcusacion,edad_imputado ,temporalidad, parentesco_victima, id_sexo) 
                                        VALUES('$idEstatusNucs', '$fechaCierreInvest', $formulacionAcusacion , '$fechaEscritoAcusacion',$edad_imputado_medida , $temporalida_medida, $parentesco_victima, '$id_sexo' )
                                                  
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

                                        UPDATE senap.medidaCautelar SET 
                                        fechaCierreInvest = '$fechaCierreInvest',
                                        formulacionAcusacion = $formulacionAcusacion,
                                        fechaEscritoAcusacion = '$fechaEscritoAcusacion',
                                        edad_imputado = $edad_imputado_medida,
                                        temporalidad = $temporalida_medida,
                                        parentesco_victima = $parentesco_victima, 
                                        id_sexo = '$id_sexo'
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

