<?php

header('Content-Type: text/html; charset=utf-8');
include ("../../../Conexiones/Conexion.php");
include("../../../funcionesEstadoDeFuerza.php");

if (isset($_POST['idMando'])){ $idMando = $_POST['idMando']; } //Se recibe idMando 
if (isset($_POST['flag'])){ $flag = $_POST['flag']; }

if (isset($_POST['cambio_fisUnid'])){ $cambio_fisUnid = $_POST['cambio_fisUnid']; } 
if (isset($_POST['cambio_areaAdscripcion'])){ $cambio_areaAdscripcion = $_POST['cambio_areaAdscripcion']; }
if (isset($_POST['cambio_seccion'])){ $cambio_seccion = $_POST['cambio_seccion']; } 
if (isset($_POST['fechaCambioAdscrip'])){ $fechaCambioAdscrip = $_POST['fechaCambioAdscrip']; } 
if (isset($_POST['cambio_estatusMando'])){ $cambio_estatusMando = $_POST['cambio_estatusMando']; } 

//*PENDIENTE DE TERMINAR
 $queryTransaction = " 
                      BEGIN                     
                            BEGIN TRY 
                              BEGIN TRANSACTION
                                    SET NOCOUNT ON 

                                       UPDATE pueDisposi.mando SET 
                                              idAreaAdscripcion = $cambio_areaAdscripcion,
                                              estatus = '$cambio_estatusMando',
                                              idFiscalia = $cambio_fisUnid,
                                              idSeccion = $cambio_seccion,
                                              fechaActualAdscripcion = '$fechaCambioAdscrip' 
                                              WHERE idMando = $idMando

                                        INSERT INTO estadoFuerza.historialAdscripcion (idMando, idFiscalia, idSeccion, idAreaAdscripcion, fechaAdscripcion) VALUES($idMando, $cambio_fisUnid, $cambio_seccion, $cambio_areaAdscripcion, '$fechaCambioAdscrip')
                                                
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
  $d = array('first' => $arreglo[1] , 'idLastMando' => $idMando);
  echo json_encode($d);
 }else{
  echo json_encode(array('first'=>$arreglo[0]));
 }

?>