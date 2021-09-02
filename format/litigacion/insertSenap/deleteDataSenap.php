<?php

include ("../../../Conexiones/Conexion.php");
if (isset($_POST["idEstatusNucs"])){ $idEstatusNucs = $_POST["idEstatusNucs"]; }
if (isset($_POST["estatResolucion"])){ $estatResolucion = $_POST["estatResolucion"]; }


	switch ($estatResolucion) {
		case 1:
		case 2:
										$queryTransaction = "BEGIN                     
										                    BEGIN TRY 
										                      BEGIN TRANSACTION
										                          SET NOCOUNT ON
										                                   
										                             DELETE FROM senap.judicializadas WHERE idEstatusNucs = '$idEstatusNucs' 

										                          COMMIT
										                    END TRY
										                    BEGIN CATCH 
										                          ROLLBACK TRANSACTION
										                          RAISERROR('No se realizo la transaccion',16,1)
										                    END CATCH
										                    END
										                  ";   
		break;
		case 3:
		case 4:
									$queryTransaction = "BEGIN                     
										                    BEGIN TRY 
										                      BEGIN TRANSACTION
										                          SET NOCOUNT ON
										                                   
										                             DELETE FROM senap.formulacionesImputacion WHERE idEstatusNucs = '$idEstatusNucs' 

										                          COMMIT
										                    END TRY
										                    BEGIN CATCH 
										                          ROLLBACK TRANSACTION
										                          RAISERROR('No se realizo la transaccion',16,1)
										                    END CATCH
										                    END
										                  ";   
  break;
  case 19:
  	$queryTransaction = "BEGIN                     
										                    BEGIN TRY 
										                      BEGIN TRANSACTION
										                          SET NOCOUNT ON
										                                   
										                             DELETE FROM senap.autoVincuProc WHERE ResolucionID = '$idEstatusNucs' 

										                          COMMIT
										                    END TRY
										                    BEGIN CATCH 
										                          ROLLBACK TRANSACTION
										                          RAISERROR('No se realizo la transaccion',16,1)
										                    END CATCH
										                    END
										                  "; 
		break;
		case 17: case 18: case 20: case 21: case 22: case 23: case 24: case 25: case 26: case 27: case 28: case 29: case 30: case 31: case 95:
		$queryTransaction = "BEGIN                     
										                    BEGIN TRY 
										                      BEGIN TRANSACTION
										                          SET NOCOUNT ON
										                                   
										                             DELETE FROM senap.medidaCautelar WHERE idEstatusNucs = '$idEstatusNucs' 

										                          COMMIT
										                    END TRY
										                    BEGIN CATCH 
										                          ROLLBACK TRANSACTION
										                          RAISERROR('No se realizo la transaccion',16,1)
										                    END CATCH
										                    END
										                  "; 
		break;
		case 61:
		case 63:
  	$queryTransaction = "BEGIN                     
										                    BEGIN TRY 
										                      BEGIN TRANSACTION
										                          SET NOCOUNT ON
										                                   
										                             DELETE FROM senap.audienciasIntermedias WHERE idEstatusNucs = '$idEstatusNucs' 

										                          COMMIT
										                    END TRY
										                    BEGIN CATCH 
										                          ROLLBACK TRANSACTION
										                          RAISERROR('No se realizo la transaccion',16,1)
										                    END CATCH
										                    END
										                  "; 
		break;
		case 99: case 89: case 101: case 103: case 105: case 106: case 107: case 108: case 109: case 110: case 111:
  	$queryTransaction = "BEGIN                     
										                    BEGIN TRY 
										                      BEGIN TRANSACTION
										                          SET NOCOUNT ON
										                                   
										                             DELETE FROM senap.sobreseimientos WHERE idEstatusNucs = '$idEstatusNucs' 

										                          COMMIT
										                    END TRY
										                    BEGIN CATCH 
										                          ROLLBACK TRANSACTION
										                          RAISERROR('No se realizo la transaccion',16,1)
										                    END CATCH
										                    END
										                  "; 
		break;
		case 64:
  	$queryTransaction = "BEGIN                     
										                    BEGIN TRY 
										                      BEGIN TRANSACTION
										                          SET NOCOUNT ON
										                                   
										                             DELETE FROM senap.suspCondProc WHERE idEstatusNucs = '$idEstatusNucs' 

										                          COMMIT
										                    END TRY
										                    BEGIN CATCH 
										                          ROLLBACK TRANSACTION
										                          RAISERROR('No se realizo la transaccion',16,1)
										                    END CATCH
										                    END
										                  "; 
		break;
		case 60:
  	$queryTransaction = "BEGIN                     
										                    BEGIN TRY 
										                      BEGIN TRANSACTION
										                          SET NOCOUNT ON
										                                   
										                             DELETE FROM senap.audienciasJuicio WHERE idEstatusNucs = '$idEstatusNucs' 

										                          COMMIT
										                    END TRY
										                    BEGIN CATCH 
										                          ROLLBACK TRANSACTION
										                          RAISERROR('No se realizo la transaccion',16,1)
										                    END CATCH
										                    END
										                  "; 
		break;
			case 65:
			case 90:
  	$queryTransaction = "BEGIN                     
										                    BEGIN TRY 
										                      BEGIN TRANSACTION
										                          SET NOCOUNT ON
										                                   
										                             DELETE FROM senap.acuerdosReparatorios WHERE idEstatusNucs = '$idEstatusNucs' 

										                          COMMIT
										                    END TRY
										                    BEGIN CATCH 
										                          ROLLBACK TRANSACTION
										                          RAISERROR('No se realizo la transaccion',16,1)
										                    END CATCH
										                    END
										                  "; 
		break;
		case 91:
  	$queryTransaction = "BEGIN                     
										                    BEGIN TRY 
										                      BEGIN TRANSACTION
										                          SET NOCOUNT ON
										                                   
										                             DELETE FROM senap.criteriosOportunidad WHERE idEstatusNucs = '$idEstatusNucs' 

										                          COMMIT
										                    END TRY
										                    BEGIN CATCH 
										                          ROLLBACK TRANSACTION
										                          RAISERROR('No se realizo la transaccion',16,1)
										                    END CATCH
										                    END
										                  "; 
		break;
		case 14:
  	$queryTransaction = "BEGIN                     
										                    BEGIN TRY 
										                      BEGIN TRANSACTION
										                          SET NOCOUNT ON
										                                   
										                             DELETE FROM senap.sentencias WHERE ResolucionID = '$idEstatusNucs' 

										                          COMMIT
										                    END TRY
										                    BEGIN CATCH 
										                          ROLLBACK TRANSACTION
										                          RAISERROR('No se realizo la transaccion',16,1)
										                    END CATCH
										                    END
										                  "; 
		break;
		case 66:
		case 67:
  	$queryTransaction = "BEGIN                     
										                    BEGIN TRY 
										                      BEGIN TRANSACTION
										                          SET NOCOUNT ON
										                                   
										                             DELETE FROM senap.sentencias WHERE idEstatusNucs = '$idEstatusNucs' 

										                          COMMIT
										                    END TRY
										                    BEGIN CATCH 
										                          ROLLBACK TRANSACTION
										                          RAISERROR('No se realizo la transaccion',16,1)
										                    END CATCH
										                    END
										                  "; 
		break;
		case 68:
  	$queryTransaction = "BEGIN                     
										                    BEGIN TRY 
										                      BEGIN TRANSACTION
										                          SET NOCOUNT ON
										                                   
										                             DELETE FROM senap.reparacionDanios WHERE idEstatusNucs = '$idEstatusNucs' 

										                          COMMIT
										                    END TRY
										                    BEGIN CATCH 
										                          ROLLBACK TRANSACTION
										                          RAISERROR('No se realizo la transaccion',16,1)
										                    END CATCH
										                    END
										                  "; 
		break;
		case 129:
  	$queryTransaction = "BEGIN                     
										                    BEGIN TRY 
										                      BEGIN TRANSACTION
										                          SET NOCOUNT ON
										                                   
										                             DELETE FROM medidasDeProteccion WHERE idEstatusNucs = '$idEstatusNucs' 

										                          COMMIT
										                    END TRY
										                    BEGIN CATCH 
										                          ROLLBACK TRANSACTION
										                          RAISERROR('No se realizo la transaccion',16,1)
										                    END CATCH
										                    END
										                  "; 
		break;
		case 57:
  	$queryTransaction = "BEGIN                     
										                    BEGIN TRY 
										                      BEGIN TRANSACTION
										                          SET NOCOUNT ON
										                                   
										                             DELETE FROM senap.ordenesAprehension WHERE idEstatusNucs = '$idEstatusNucs' 

										                          COMMIT
										                    END TRY
										                    BEGIN CATCH 
										                          ROLLBACK TRANSACTION
										                          RAISERROR('No se realizo la transaccion',16,1)
										                    END CATCH
										                    END
										                  "; 
		break;
		case 151:
  	$queryTransaction = "BEGIN                     
										                    BEGIN TRY 
										                      BEGIN TRANSACTION
										                          SET NOCOUNT ON
										                                   
										                             DELETE FROM senap.autoVincuProc WHERE idEstatusNucs = '$idEstatusNucs' 

										                          COMMIT
										                    END TRY
										                    BEGIN CATCH 
										                          ROLLBACK TRANSACTION
										                          RAISERROR('No se realizo la transaccion',16,1)
										                    END CATCH
										                    END
										                  "; 
		break;
 }
	$result1 = sqlsrv_query($conn,$queryTransaction, array(), array( "Scrollable" => 'static' ));

   
?>