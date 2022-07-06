<? 
			include("../../../Conexiones/Conexion.php");
			include("../../../funcioneTrimes.php");
			include("../../../Conexiones/conexionSicap.php");
	  include("../../../funcioneSicap.php");

			if (isset($_GET["anio"])){ $anio = $_GET["anio"]; }
			if (isset($_GET["mes"])){ $mes = $_GET["mes"]; }
			if (isset($_GET["quest"])){ $quest = $_GET["quest"]; }
			if (isset($_GET["idEnlace"])){ $idEnlace = $_GET["idEnlace"]; }
   if (isset($_GET["per"])){ $per = $_GET["per"]; }
   if (isset($_GET["idUnidad"])){ $idUnidad = $_GET["idUnidad"]; }
			if (isset($_GET["anio"])){ $anio = $_GET["anio"]; }
			if (isset($_GET["nuc"])){ $nuc = $_GET["nuc"]; }
			if (isset($_GET["anioGlobalMain"])){ $anioGlobalMain = $_GET["anioGlobalMain"]; }


			$arreglo[0] = "existe";
			$arreglo[1] = "noexiste";
			$arreglo[2] = "OK";
			$arreglo[3] = "NOK";

			if($aux=get_nuc_sicap ($nuc,$conSic)){  
							
				echo json_encode(array('first'=>$arreglo[0]));  

				$queryTransaction = "  

                    BEGIN 
                    
                    BEGIN TRY 
                      BEGIN TRANSACTION

                          SET NOCOUNT ON
																										INSERT INTO [trimestral].[nucsTrimestral]
																										([idPregunta]
																										,[idEnlace]
																										,[idUnidad]
																										,[mes]
																										,[anio]
																										,[periodo]
																										,[NUC]
																										,[anioCaptura])
																				VALUES
																										($quest
																										,$idEnlace
																										,$idUnidad
																										,$mes 
																										,$anio
																										,$per
																										,'$nuc'
																										,$anioGlobalMain)
                          COMMIT
                    END TRY

                    BEGIN CATCH 
                          ROLLBACK TRANSACTION
                          RAISERROR('No se realizo la transaccion',16,1)
                    END CATCH

                    END


                  ";
                  $result = sqlsrv_query($conn,$queryTransaction, array(), array( "Scrollable" => 'static' ));         

                  if ($result) {
                  }else{
                  }
   
			
			}else{

				echo json_encode(array('first'=>$arreglo[1]));

				}
                 
	
?>