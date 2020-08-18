<?php
header('Content-Type: text/html; charset=utf-8');
include("../../funciones.php");
include ("../../Conexiones/Conexion.php");

     

if (isset($_POST['idPers'])){ $idPers = $_POST['idPers']; }
if (isset($_POST['arrDelitosAct'])){ $arrDelitosAct = $_POST['arrDelitosAct']; }


          
                   $queryTransaction = "  

                    BEGIN                     
                    BEGIN TRY 
                      BEGIN TRANSACTION
                          SET NOCOUNT ON

                                            INSERT INTO pueDisposi.DelitosPorPersona (idPersona , idCatDelito) 
                                              VALUES($idPers , $arrDelitosAct)


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
                  
                  $var = 5;

                  if ($result) {

                    echo json_encode(array('first'=>$arreglo[1]));

                  }else{
                    echo json_encode(array('first'=>$arreglo[0]));
                    
                  }                   



?>