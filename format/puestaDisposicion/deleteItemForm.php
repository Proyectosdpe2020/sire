<?php

      header('Content-Type: text/html; charset=utf-8');
      include("../../funciones.php");
      include ("../../Conexiones/Conexion.php");

           //////////// DATOS DE PUESTA A DISPOSICION /////
      
      
      if (isset($_POST["idPuestaDisposicion"])){ $idPuestaDisposicion = $_POST["idPuestaDisposicion"]; }else{
              $idPuestaDisposicion = "";
      } 

       //////////// DATOS DE VEHICULO /////
       if (isset($_POST["form"])){ $form = $_POST["form"]; }
       if (isset($_POST["idItem"])){ $idItem = $_POST["idItem"]; }
       if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }
          
                   

          if($form == 1){

               $queryTransaction = "
                    BEGIN                     
                    BEGIN TRY 
                      BEGIN TRANSACTION
                          SET NOCOUNT ON                                    
                                    DELETE FROM pueDisposi.personasDetenidas WHERE idPersonaDetenida = $idItem AND idPuestaDisposicion = $idPuestaDisposicion
                              COMMIT
                    END TRY
                    BEGIN CATCH 
                          ROLLBACK TRANSACTION
                          RAISERROR('No se realizo la transaccion',16,1)
                    END CATCH
                    END
                  ";  
               }

          if($form == 2){

               $queryTransaction = "
                    BEGIN                     
                    BEGIN TRY 
                      BEGIN TRANSACTION
                          SET NOCOUNT ON                                    
                                    DELETE FROM pueDisposi.vehiculo WHERE idVehiculo = $idItem AND idPuestaDisposicion = $idPuestaDisposicion
                              COMMIT
                    END TRY
                    BEGIN CATCH 
                          ROLLBACK TRANSACTION
                          RAISERROR('No se realizo la transaccion',16,1)
                    END CATCH
                    END
                  ";  
               }


             if($form == 3){

               $queryTransaction = "
                    BEGIN                     
                    BEGIN TRY 
                      BEGIN TRANSACTION
                          SET NOCOUNT ON                                    
                                    DELETE FROM pueDisposi.aseguramientoArmas WHERE idArmaAsegurada = $idItem AND idPueDisposicion = $idPuestaDisposicion
                              COMMIT
                    END TRY
                    BEGIN CATCH 
                          ROLLBACK TRANSACTION
                          RAISERROR('No se realizo la transaccion',16,1)
                    END CATCH
                    END
                  ";  
               }

                 if($form == 4){

               $queryTransaction = "
                    BEGIN                     
                    BEGIN TRY 
                      BEGIN TRANSACTION
                          SET NOCOUNT ON                                    
                                    DELETE FROM pueDisposi.Defunciones WHERE IdDefuncion = $idItem AND idPueDisposicion = $idPuestaDisposicion
                              COMMIT
                    END TRY
                    BEGIN CATCH 
                          ROLLBACK TRANSACTION
                          RAISERROR('No se realizo la transaccion',16,1)
                    END CATCH
                    END
                  ";  
               }

                  if($form == 5){

               $queryTransaction = "
                    BEGIN                     
                    BEGIN TRY 
                      BEGIN TRANSACTION
                          SET NOCOUNT ON                                    
                                    DELETE FROM pueDisposi.Drogas WHERE idDrogas = $idItem AND idPueDisposicion = $idPuestaDisposicion
                              COMMIT
                    END TRY
                    BEGIN CATCH 
                          ROLLBACK TRANSACTION
                          RAISERROR('No se realizo la transaccion',16,1)
                    END CATCH
                    END
                  ";  
               }

                     if($form == 6){

               $queryTransaction = "
                    BEGIN                     
                    BEGIN TRY 
                      BEGIN TRANSACTION
                          SET NOCOUNT ON                                    
                                    DELETE FROM pueDisposi.Forestales WHERE idForestales = $idItem AND idPueDisposicion = $idPuestaDisposicion
                              COMMIT
                    END TRY
                    BEGIN CATCH 
                          ROLLBACK TRANSACTION
                          RAISERROR('No se realizo la transaccion',16,1)
                    END CATCH
                    END
                  ";  
               }

                      if($form == 7){

               $queryTransaction = "
                    BEGIN                     
                    BEGIN TRY 
                      BEGIN TRANSACTION
                          SET NOCOUNT ON                                    
                                    DELETE FROM pueDisposi.DineroAsegurado WHERE idDineroAsegurado = $idItem AND idPueDisposicion = $idPuestaDisposicion
                              COMMIT
                    END TRY
                    BEGIN CATCH 
                          ROLLBACK TRANSACTION
                          RAISERROR('No se realizo la transaccion',16,1)
                    END CATCH
                    END
                  ";  
               }

                       if($form == 8){

               $queryTransaction = "
                    BEGIN                     
                    BEGIN TRY 
                      BEGIN TRANSACTION
                          SET NOCOUNT ON                                    
                                    DELETE FROM pueDisposi.objetosAsegurados WHERE idObjetoAsegurado = $idItem AND idPueDisposicion = $idPuestaDisposicion
                              COMMIT
                    END TRY
                    BEGIN CATCH 
                          ROLLBACK TRANSACTION
                          RAISERROR('No se realizo la transaccion',16,1)
                    END CATCH
                    END
                  ";  
               }

                      if($form == 9){

               $queryTransaction = "
                    BEGIN                     
                    BEGIN TRY 
                      BEGIN TRANSACTION
                          SET NOCOUNT ON                                    
                                    DELETE FROM pueDisposi.TrabajoDeCampo WHERE idTrabajoCampo = $idItem AND idPueDisposicion = $idPuestaDisposicion
                              COMMIT
                    END TRY
                    BEGIN CATCH 
                          ROLLBACK TRANSACTION
                          RAISERROR('No se realizo la transaccion',16,1)
                    END CATCH
                    END
                  ";  
               }

               if($form == 10){

               $queryTransaction = "
                    BEGIN                     
                    BEGIN TRY 
                      BEGIN TRANSACTION
                          SET NOCOUNT ON                                    
                                    DELETE FROM pueDisposi.personalApoyo WHERE personalApoyo_id = $idItem AND idPueDisposicion = $idPuestaDisposicion
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
                  

                  if ($result) {

                    echo json_encode(array('first'=>$arreglo[1]));

                  }else{
                    echo json_encode(array('first'=>$arreglo[0]));
                    
                  }
   
    

?>
