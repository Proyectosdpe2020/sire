<? 
			include ("../../../Conexiones/Conexion.php");
			include("../../../funcioneTrimes.php");

			if (isset($_GET["per"])){ $per = $_GET["per"]; }
			if (isset($_GET["anio"])){ $anio = $_GET["anio"]; }
			if (isset($_GET["idUnidad"])){ $idUnidad = $_GET["idUnidad"]; }
			if (isset($_GET["idEnlace"])){ $idEnlace = $_GET["idEnlace"]; }

			if (isset($_GET["p48m1"])){ $p48m1 = $_GET["p48m1"]; }
			if (isset($_GET["p48m2"])){ $p48m2 = $_GET["p48m2"]; }
			if (isset($_GET["p48m3"])){ $p48m3 = $_GET["p48m3"]; }

			if (isset($_GET["p49m1"])){ $p49m1 = $_GET["p49m1"]; }
   if (isset($_GET["p49m2"])){ $p49m2 = $_GET["p49m2"]; }
   if (isset($_GET["p49m3"])){ $p49m3 = $_GET["p49m3"]; }

   if (isset($_GET["p50m1"])){ $p50m1 = $_GET["p50m1"]; }
   if (isset($_GET["p50m2"])){ $p50m2 = $_GET["p50m2"]; }
   if (isset($_GET["p50m3"])){ $p50m3 = $_GET["p50m3"]; }

   if (isset($_GET["p51m1"])){ $p51m1 = $_GET["p51m1"]; }
   if (isset($_GET["p51m2"])){ $p51m2 = $_GET["p51m2"]; }
   if (isset($_GET["p51m3"])){ $p51m3 = $_GET["p51m3"]; }

			//$getDataQ3 = getDataQ($conn, 3, $per, $anio, $idUnidad);
			//$getDataQ4 = getDataQ($conn, 4, $per, $anio, $idUnidad);

			$query = " SELECT idSeguimiento FROM trimestral.seguimiento WHERE idPregunta = 48 AND idPeriodo = $per AND anio = $anio AND idUnidad = $idUnidad ";
	 	$stmt = sqlsrv_query(  $conn, $query,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
		 $row_count = sqlsrv_num_rows( $stmt );

		 $query2 = " SELECT idSeguimiento FROM trimestral.seguimiento WHERE idPregunta = 49 AND idPeriodo = $per AND anio = $anio AND idUnidad = $idUnidad ";
	 	$stmt2 = sqlsrv_query(  $conn, $query2,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
		 $row_count2 = sqlsrv_num_rows( $stmt2 );

     $query3 = " SELECT idSeguimiento FROM trimestral.seguimiento WHERE idPregunta = 50 AND idPeriodo = $per AND anio = $anio AND idUnidad = $idUnidad ";
    $stmt3 = sqlsrv_query(  $conn, $query3,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
     $row_count3 = sqlsrv_num_rows( $stmt3 );

   $query4 = " SELECT idSeguimiento FROM trimestral.seguimiento WHERE idPregunta = 51 AND idPeriodo = $per AND anio = $anio AND idUnidad = $idUnidad ";
    $stmt4 = sqlsrv_query(  $conn, $query4,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
     $row_count4 = sqlsrv_num_rows( $stmt4 );

			if($row_count > 0 && $row_count2 > 0 && $row_count3 > 0 && $row_count4 > 0){

					$queryTransaction = " 
                    BEGIN                     
                    BEGIN TRY 
                      BEGIN TRANSACTION
                          SET NOCOUNT ON    

                          			UPDATE trimestral.seguimiento SET m1 = $p48m1, m2 = $p48m2, m3 = $p48m3 WHERE idPregunta = 48 and idPeriodo = $per AND idUnidad = $idUnidad and anio = $anio
                          			UPDATE trimestral.seguimiento SET m1 = $p49m1, m2 = $p49m2, m3 = $p49m3 WHERE idPregunta = 49 and idPeriodo = $per AND idUnidad = $idUnidad and anio = $anio
                             UPDATE trimestral.seguimiento SET m1 = $p50m1, m2 = $p50m2, m3 = $p50m3 WHERE idPregunta = 50 and idPeriodo = $per AND idUnidad = $idUnidad and anio = $anio
                             UPDATE trimestral.seguimiento SET m1 = $p51m1, m2 = $p51m2, m3 = $p51m3 WHERE idPregunta = 51 and idPeriodo = $per AND idUnidad = $idUnidad and anio = $anio
                          
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

			}else{

							 $queryTransaction = " 
                    BEGIN                     
                    BEGIN TRY 
                      BEGIN TRANSACTION
                          SET NOCOUNT ON    

                          				INSERT INTO trimestral.seguimiento VALUES(48, $per, $idUnidad, $idEnlace, $anio, $p48m1, $p48m2, $p48m3, GETDATE() )
                          				INSERT INTO trimestral.seguimiento VALUES(49, $per, $idUnidad, $idEnlace, $anio, $p49m1, $p49m2, $p49m3, GETDATE() )
                              INSERT INTO trimestral.seguimiento VALUES(50, $per, $idUnidad, $idEnlace, $anio, $p50m1, $p50m2, $p50m3, GETDATE() )
                              INSERT INTO trimestral.seguimiento VALUES(51, $per, $idUnidad, $idEnlace, $anio, $p51m1, $p51m2, $p51m3, GETDATE() )
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


			}
					
?>