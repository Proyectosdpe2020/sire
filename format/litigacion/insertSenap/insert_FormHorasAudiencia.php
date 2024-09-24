<?php

header('Content-Type: text/html; charset=utf-8');
include ("../../../Conexiones/Conexion.php");



/*DATOS GENERALES*/
if (isset($_POST['idEstatusNucs'])){ $idEstatusNucs = $_POST['idEstatusNucs']; }
if (isset($_POST['nuc'])){ $nuc = $_POST['nuc']; }
if (isset($_POST['idMp'])){ $idMp = $_POST['idMp']; }
if (isset($_POST['mes'])){ $mes = $_POST['mes']; }
if (isset($_POST['anio'])){ $anio = $_POST['anio']; }
if (isset($_POST['idUnidad'])){ $idUnidad = $_POST['idUnidad']; }
if (isset($_POST['estatus'])){ $estatus = $_POST['estatus']; }


/*DATOS FORMULARIO SENAP*/
if (isset($_POST['horasAudiencia'])){ $horasAudiencia = $_POST['horasAudiencia']; } 

if (isset($_POST['opcInsert'])){ $opcInsert = $_POST['opcInsert']; } 




//Si opcInsert == 0 es un nuevo registro, si opcInsert == 1 es una edicion de registro
if($opcInsert == 0){

  $queryTransaction = " 
                        BEGIN                     
                              BEGIN TRY 
                                BEGIN TRANSACTION
                                      SET NOCOUNT ON 

                                        INSERT INTO senap.total_audiencias (idEstatusNucs, nuc, idEstatus, total_horas, idMp, mes, anio, idUnidad) 
                                        VALUES('$idEstatusNucs' , '$nuc' , $estatus , $horasAudiencia, $idMp, $mes, $anio, $idUnidad  )
                                                  
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

                                        UPDATE senap.total_audiencias SET 
                                        total_horas = $horasAudiencia
                                        WHERE idEstatusNucs = '$idEstatusNucs';
                                                  
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

