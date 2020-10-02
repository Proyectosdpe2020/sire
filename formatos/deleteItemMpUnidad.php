<?php

      header('Content-Type: text/html; charset=utf-8');
      include("../funciones.php");
      include ("../Conexiones/Conexion.php");

    
      if (isset($_POST["idEnMpUnid"])){ $idEnMpUnid = $_POST["idEnMpUnid"]; }
       

               $queryTransaction = "
                    BEGIN                     
                    BEGIN TRY 
                      BEGIN TRANSACTION
                          SET NOCOUNT ON                                    
                                    DELETE FROM [dbo].[mpUnidad] WHERE idMpUnidad = $idEnMpUnid 
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

                    echo json_encode(array('first'=>$arreglo[1]));

                  }else{
                    echo json_encode(array('first'=>$arreglo[0]));
                    
                  }                   

?>