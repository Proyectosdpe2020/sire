<? 
			include ("../../../Conexiones/Conexion.php");
			include("../../../funcioneTrimes.php");

			if (isset($_GET["per"])){ $per = $_GET["per"]; }
			if (isset($_GET["anio"])){ $anio = $_GET["anio"]; }
			if (isset($_GET["idUnidad"])){ $idUnidad = $_GET["idUnidad"]; }
			if (isset($_GET["idEnlace"])){ $idEnlace = $_GET["idEnlace"]; }

			if (isset($_GET["p1m1"])){ $p1m1 = $_GET["p1m1"]; }
			if (isset($_GET["p1m2"])){ $p1m2 = $_GET["p1m2"]; }
			if (isset($_GET["p1m3"])){ $p1m3 = $_GET["p1m3"]; }

			if (isset($_GET["p2m1"])){ $p2m1 = $_GET["p2m1"]; }
			if (isset($_GET["p2m2"])){ $p2m2 = $_GET["p2m2"]; }
			if (isset($_GET["p2m3"])){ $p2m3 = $_GET["p2m3"]; }

			//$getDataQ3 = getDataQ($conn, 3, $per, $anio, $idUnidad);
			//$getDataQ4 = getDataQ($conn, 4, $per, $anio, $idUnidad);

			$query = " SELECT idSeguimiento FROM trimestral.seguimiento WHERE idPregunta = 1 AND idPeriodo = $per AND anio = $anio AND idUnidad = $idUnidad ";
	 	$stmt = sqlsrv_query(  $conn, $query,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
		 $row_count = sqlsrv_num_rows( $stmt );
		 $query2 = " SELECT idSeguimiento FROM trimestral.seguimiento WHERE idPregunta = 2 AND idPeriodo = $per AND anio = $anio AND idUnidad = $idUnidad ";
	 	$stmt2 = sqlsrv_query(  $conn, $query2,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
		 $row_count2 = sqlsrv_num_rows( $stmt2 );

			if($row_count > 0 && $row_count2 > 0){

					$queryTransaction = " 
                    BEGIN                     
                    BEGIN TRY 
                      BEGIN TRANSACTION
                          SET NOCOUNT ON    

                          			UPDATE trimestral.seguimiento SET m1 = $p1m1, m2 = $p1m2, m3 = $p1m3 WHERE idPregunta = 1 and idPeriodo = $per AND idUnidad = $idUnidad and anio = $anio
                          			UPDATE trimestral.seguimiento SET m1 = $p2m1, m2 = $p2m2, m3 = $p2m3 WHERE idPregunta = 2 and idPeriodo = $per AND idUnidad = $idUnidad and anio = $anio
                          
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

                          				INSERT INTO trimestral.seguimiento VALUES(1, $per, $idUnidad, $idEnlace, $anio, $p1m1, $p1m2, $p1m3, GETDATE() )
                          				INSERT INTO trimestral.seguimiento VALUES(2, $per, $idUnidad, $idEnlace, $anio, $p2m1, $p2m2, $p2m3, GETDATE() )
                          
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