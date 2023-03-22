<?php

header('Content-Type: text/html; charset=utf-8');
include ("../../../Conexiones/Conexion.php");



/*DATOS GENERALES*/
if (isset($_POST['idEstatusNucs'])){ $idEstatusNucs = $_POST['idEstatusNucs']; }
if (isset($_POST['imputado_id'])){ $imputado_id = $_POST['imputado_id']; }



  $queryTransaction = "BEGIN                     
                                        BEGIN TRY 
                                          BEGIN TRANSACTION
                                              SET NOCOUNT ON
                                                       
                                                 DELETE FROM senap.imputados WHERE imputado_id = $imputado_id 

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

 if($result){
  $d = array('first' => $arreglo[1]);
  echo json_encode($d);
 }else{
  echo json_encode(array('first'=>$arreglo[0])); //Si no se realizo la transacción devolver 0 para indicar mensaje de alerta
 }

