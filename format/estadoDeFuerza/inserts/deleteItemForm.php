<?
header('Content-Type: text/html; charset=utf-8');
include ("../../../Conexiones/Conexion.php");
include("../../../funcionesEstadoDeFuerza.php");

if (isset($_POST["form"])){ $form = $_POST["form"]; }
if (isset($_POST["idItem"])){ $idItem = $_POST["idItem"]; }
if (isset($_POST["idMando"])){ $idMando = $_POST["idMando"]; }

/*************1: ELIMINA INFORMACIÓN DEL DOMICILIO************/
/*************2: ELIMINA INFORMACIÓN DEL VEHICULO************/
/*************3: ELIMINA INFORMACIÓN DE LA ARMA************/
/*************4: ELIMINA INFORMACIÓN DEL CONTACTO DE EMERGENCIA************/
/*************5: ELIMINA INFORMACIÓN DE LOS FOLIOS************/
/*************6: ELIMINA INFORMACIÓN DE LAS INCAPACIDADES************/
/*************6: ELIMINA HISTORIAL DE ADSCRIPCIONES************/
if($form == 1){
	$queryTransaction = "
                    BEGIN                     
                    BEGIN TRY 
                      BEGIN TRANSACTION
                          SET NOCOUNT ON                                    
                                    DELETE FROM estadoFuerza.domicilio WHERE idDomicilio = $idItem AND idMando = $idMando
                              COMMIT
                    END TRY
                    BEGIN CATCH 
                          ROLLBACK TRANSACTION
                          RAISERROR('No se realizo la transaccion',16,1)
                    END CATCH
                    END
                  ";                   
}else if($form == 2){
	$queryTransaction = "
                    BEGIN                     
                    BEGIN TRY 
                      BEGIN TRANSACTION
                          SET NOCOUNT ON                                    
                                    DELETE FROM estadoFuerza.vehiculos WHERE idVehiculo = $idItem AND idMando = $idMando
                              COMMIT
                    END TRY
                    BEGIN CATCH 
                          ROLLBACK TRANSACTION
                          RAISERROR('No se realizo la transaccion',16,1)
                    END CATCH
                    END
                  ";   
}else if($form == 3){
 $queryTransaction = "
                    BEGIN                     
                    BEGIN TRY 
                      BEGIN TRANSACTION
                          SET NOCOUNT ON                                    
                                    DELETE FROM estadoFuerza.armas WHERE idArma = $idItem AND idMando = $idMando
                              COMMIT
                    END TRY
                    BEGIN CATCH 
                          ROLLBACK TRANSACTION
                          RAISERROR('No se realizo la transaccion',16,1)
                    END CATCH
                    END
                  ";   
}else if($form == 4){
 $queryTransaction = "
                    BEGIN                     
                    BEGIN TRY 
                      BEGIN TRANSACTION
                          SET NOCOUNT ON                                    
                                    DELETE FROM estadoFuerza.contactosEmergencia WHERE idContEmerg = $idItem AND idMando = $idMando
                              COMMIT
                    END TRY
                    BEGIN CATCH 
                          ROLLBACK TRANSACTION
                          RAISERROR('No se realizo la transaccion',16,1)
                    END CATCH
                    END
                  ";   
}else if($form == 5){
 $queryTransaction = "
                    BEGIN                     
                    BEGIN TRY 
                      BEGIN TRANSACTION
                          SET NOCOUNT ON                                    
                                    DELETE FROM estadoFuerza.folios WHERE idFolio = $idItem AND idMando = $idMando
                              COMMIT
                    END TRY
                    BEGIN CATCH 
                          ROLLBACK TRANSACTION
                          RAISERROR('No se realizo la transaccion',16,1)
                    END CATCH
                    END
                  ";   
}else if($form == 6){
 $queryTransaction = "
                    BEGIN                     
                    BEGIN TRY 
                      BEGIN TRANSACTION
                          SET NOCOUNT ON                                    
                                    DELETE FROM estadoFuerza.incapacidades WHERE idIncapacidad = $idItem AND idMando = $idMando
                              COMMIT
                    END TRY
                    BEGIN CATCH 
                          ROLLBACK TRANSACTION
                          RAISERROR('No se realizo la transaccion',16,1)
                    END CATCH
                    END
                  ";   
}else if($form == 7){
 $queryTransaction = "
                    BEGIN                     
                    BEGIN TRY 
                      BEGIN TRANSACTION
                          SET NOCOUNT ON                                    
                                    DELETE FROM estadoFuerza.historialAdscripcion WHERE idAdscripcion = $idItem AND idMando = $idMando
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
if ($result){
	 $d = array('first' => $arreglo[1] , 'idLastMando' => $idMando);
  echo json_encode($d);
}else{
	echo json_encode(array('first'=>$arreglo[0]));
}

?>