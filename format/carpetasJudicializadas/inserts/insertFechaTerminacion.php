<?php
header('Content-Type: text/html; charset=utf-8');
include ("../../../Conexiones/Conexion.php");

if (isset($_GET['resolucionID'])){ $resolucionID= $_GET['resolucionID']; }
if (isset($_GET['bandera'])){ $bandera = $_GET['bandera']; }
if (isset($_GET['fechaTermino'])){ $fechaTermino = $_GET['fechaTermino']; }


//0: Registro Nuevo 1: Editar
if($bandera == 0) {
 $queryTransaction = " 
                      BEGIN                     
                       BEGIN TRY 
                         BEGIN TRANSACTION
                             SET NOCOUNT ON

                                INSERT INTO dbo.investigacionComplementaria VALUES($resolucionID, '$fechaTermino')

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
}else{
 $queryTransaction = " 
                      BEGIN                     
                       BEGIN TRY 
                         BEGIN TRANSACTION
                             SET NOCOUNT ON

                                UPDATE dbo.investigacionComplementaria SET fechaTermCom = '$fechaTermino'
                                                                       WHERE resolucionID = $resolucionID;

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
}
?>