<?php
header('Content-Type: text/html; charset=utf-8');
include ("../../Conexiones/Conexion.php");


if (isset($_POST['idEnlace'])){ $idEnlace = $_POST['idEnlace']; }



$queryTransaction = " 
                      BEGIN                     
                       BEGIN TRY 
                         BEGIN TRANSACTION
                             SET NOCOUNT ON

                                UPDATE pueDisposi.enlaceMesValidaEnviado SET enviado = 1 WHERE idEnlace = $idEnlace;

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
                    $d = array('first' => $arreglo[1]);
                    echo json_encode($d);
                   }else{
                    echo json_encode(array('first'=>$arreglo[0]));
                   }

?>