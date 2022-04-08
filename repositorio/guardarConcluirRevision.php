		<?php

						header('Content-Type: text/html; charset=utf-8');
						include("../funciones.php");
						include ("../Conexiones/Conexion.php");
								
					if (isset($_POST["idArchivo"])){ $idArchivo = $_POST["idArchivo"]; }
					if (isset($_POST["observaciones"])){ $observaciones = $_POST["observaciones"]; }
					if (isset($_POST["estadoSelect"])){ $estadoSelect = $_POST["estadoSelect"]; }

		if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }
		if (isset($_POST["mes"])){ $mes = $_POST["mes"]; }
		if (isset($_POST["anio"])){ $anio = $_POST["anio"]; }


		if (isset($_POST["tipo"])){ $tipo = $_POST["tipo"]; }


					

		$nextMonth = 0;
		$nextYear = 0;

		if($estadoSelect  == "rec"){

												if($mes == 12 ){

																				$nextMonth = 1;
																				$nextYear = $anio + 1;
												}else{

														$nextMonth = $mes + 1;
														$nextYear = $anio;
												}

		}else if($estadoSelect == "rac"){

														$nextMonth = $mes;
														$nextYear = $anio;
		}
	


		if($tipo == 1){


										if($estadoSelect == "rac"){


																			$queryTransaction = "  

																			BEGIN 
																				
																				BEGIN TRY 
																						BEGIN TRANSACTION

																										SET NOCOUNT ON
																										
																											
																												UPDATE archivo SET observacionesRevision = '$observaciones', estatusArch = '$estadoSelect', fechaConcluido = GETDATE() WHERE idArchivo = $idArchivo

																												UPDATE enlaceMesValidaEnviado SET idAnio = $nextYear WHERE idEnlace = $idEnlace and idFormato = $tipo
																												UPDATE enlaceMesValidaEnviado SET mesCap = $nextMonth WHERE idEnlace = $idEnlace and idFormato = $tipo
																												UPDATE enlaceMesValidaEnviado SET enviado = 1 WHERE idEnlace = $idEnlace and idFormato = $tipo
																												UPDATE enlaceMesValidaEnviado SET enviadoArchivo = 1 WHERE idEnlace = $idEnlace and idFormato = $tipo


																										COMMIT
																				END TRY

																				BEGIN CATCH 
																										ROLLBACK TRANSACTION
																										RAISERROR('No se realizo la transaccion',16,1)
																				END CATCH

																				END

																		";



					}else if($estadoSelect = "rec"){


																			$queryTransaction = "  

																			BEGIN 
																				
																				BEGIN TRY 
																						BEGIN TRANSACTION

																										SET NOCOUNT ON
																										
																											
																												UPDATE archivo SET observacionesRevision = '$observaciones', estatusArch = '$estadoSelect', fechaConcluido = GETDATE() WHERE idArchivo = $idArchivo

																												UPDATE enlaceMesValidaEnviado SET idAnio = $nextYear WHERE idEnlace = $idEnlace and idFormato = $tipo
																												UPDATE enlaceMesValidaEnviado SET mesCap = $nextMonth WHERE idEnlace = $idEnlace and idFormato = $tipo
																												UPDATE enlaceMesValidaEnviado SET enviado = 0 WHERE idEnlace = $idEnlace and idFormato = $tipo
																												UPDATE enlaceMesValidaEnviado SET enviadoArchivo = 0 WHERE idEnlace = $idEnlace and idFormato = $tipo



																										COMMIT
																				END TRY

																				BEGIN CATCH 
																										ROLLBACK TRANSACTION
																										RAISERROR('No se realizo la transaccion',16,1)
																				END CATCH

																				END

																		";


					}


		}else if($tipo == 4){



								$myString  = "";

								$enlacese = getEnlacesLitiArchivs($conn, $idEnlace, 4);
								$uno = $enlacese[0][0];
								$dos = $enlacese[0][1];
					
								if($estadoSelect == "rac"){


																			$queryTransaction = "  

																			BEGIN 
																				
																				BEGIN TRY 
																						BEGIN TRANSACTION

																										SET NOCOUNT ON
																										
																											
																												UPDATE archivo SET observacionesRevision = '$observaciones', estatusArch = '$estadoSelect', fechaConcluido = GETDATE() WHERE idArchivo = $idArchivo

																												UPDATE enlaceMesValidaEnviado SET idAnio = $nextYear WHERE idFormato = $tipo AND idEnlace IN($uno, $dos)
																												UPDATE enlaceMesValidaEnviado SET mesCap = $nextMonth WHERE idFormato = $tipo AND idEnlace IN($uno, $dos)

																												UPDATE enlaceMesValidaEnviado SET enviado = 1 WHERE idFormato = $tipo AND idEnlace IN($uno, $dos)
																												UPDATE enlaceMesValidaEnviado SET enviadoArchivo = 1 WHERE idFormato = $tipo AND idEnlace IN($uno, $dos)


																										COMMIT
																				END TRY

																				BEGIN CATCH 
																										ROLLBACK TRANSACTION
																										RAISERROR('No se realizo la transaccion',16,1)
																				END CATCH

																				END

																		";



																					}else if($estadoSelect = "rec"){


																																			$queryTransaction = "  

																																			BEGIN 
																																				
																																				BEGIN TRY 
																																						BEGIN TRANSACTION

																																										SET NOCOUNT ON
																																										
																																											
																																												UPDATE archivo SET observacionesRevision = '$observaciones', estatusArch = '$estadoSelect', fechaConcluido = GETDATE() WHERE idArchivo = $idArchivo

																																												UPDATE enlaceMesValidaEnviado SET idAnio = $nextYear WHERE idFormato = $tipo AND idEnlace IN($uno, $dos)
																																												UPDATE enlaceMesValidaEnviado SET mesCap = $nextMonth WHERE idFormato = $tipo AND idEnlace IN($uno, $dos)

																																												UPDATE enlaceMesValidaEnviado SET enviado = 0 WHERE idFormato = $tipo AND idEnlace IN($uno, $dos)
																																												UPDATE enlaceMesValidaEnviado SET enviadoArchivo = 0 WHERE idFormato = $tipo AND idEnlace IN($uno, $dos)



																																										COMMIT
																																				END TRY

																																				BEGIN CATCH 
																																										ROLLBACK TRANSACTION
																																										RAISERROR('No se realizo la transaccion',16,1)
																																				END CATCH

																																				END

																																		";


																					}





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
