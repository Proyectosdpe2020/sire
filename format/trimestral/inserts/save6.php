<? 
			include ("../../../Conexiones/Conexion.php");
			include("../../../funcioneTrimes.php");

			if (isset($_GET["per"])){ $per = $_GET["per"]; }
			if (isset($_GET["anio"])){ $anio = $_GET["anio"]; }
			if (isset($_GET["idUnidad"])){ $idUnidad = $_GET["idUnidad"]; }
			if (isset($_GET["idEnlace"])){ $idEnlace = $_GET["idEnlace"]; }

			if (isset($_GET["p15m1"])){ $p15m1 = $_GET["p15m1"]; }
			if (isset($_GET["p15m2"])){ $p15m2 = $_GET["p15m2"]; }
			if (isset($_GET["p15m3"])){ $p15m3 = $_GET["p15m3"]; }

			if (isset($_GET["p16m1"])){ $p16m1 = $_GET["p16m1"]; }
			if (isset($_GET["p16m2"])){ $p16m2 = $_GET["p16m2"]; }
			if (isset($_GET["p16m3"])){ $p16m3 = $_GET["p16m3"]; }

      if (isset($_GET["p17m1"])){ $p17m1 = $_GET["p17m1"]; }
      if (isset($_GET["p17m2"])){ $p17m2 = $_GET["p17m2"]; }
      if (isset($_GET["p17m3"])){ $p17m3 = $_GET["p17m3"]; }

			//$getDataQ3 = getDataQ($conn, 3, $per, $anio, $idUnidad);
			//$getDataQ4 = getDataQ($conn, 4, $per, $anio, $idUnidad);

			$query = " SELECT idSeguimiento FROM trimestral.seguimiento WHERE idPregunta = 15 AND idPeriodo = $per AND anio = $anio AND idUnidad = $idUnidad ";
	 	$stmt = sqlsrv_query(  $conn, $query,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
		 $row_count = sqlsrv_num_rows( $stmt );

		 $query2 = " SELECT idSeguimiento FROM trimestral.seguimiento WHERE idPregunta = 16 AND idPeriodo = $per AND anio = $anio AND idUnidad = $idUnidad ";
	 	$stmt2 = sqlsrv_query(  $conn, $query2,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
		 $row_count2 = sqlsrv_num_rows( $stmt2 );

     $query3 = " SELECT idSeguimiento FROM trimestral.seguimiento WHERE idPregunta = 17 AND idPeriodo = $per AND anio = $anio AND idUnidad = $idUnidad ";
    $stmt3 = sqlsrv_query(  $conn, $query3,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
     $row_count3 = sqlsrv_num_rows( $stmt3 );

			if($row_count > 0 && $row_count2 > 0 && $row_count3 > 0){

					$queryTransaction = " 
                    BEGIN                     
                    BEGIN TRY 
                      BEGIN TRANSACTION
                          SET NOCOUNT ON    

                          			UPDATE trimestral.seguimiento SET m1 = $p15m1, m2 = $p15m2, m3 = $p15m3 WHERE idPregunta = 15 and idPeriodo = $per AND idUnidad = $idUnidad and anio = $anio
                          			UPDATE trimestral.seguimiento SET m1 = $p16m1, m2 = $p16m2, m3 = $p16m3 WHERE idPregunta = 16 and idPeriodo = $per AND idUnidad = $idUnidad and anio = $anio
                                UPDATE trimestral.seguimiento SET m1 = $p17m1, m2 = $p17m2, m3 = $p17m3 WHERE idPregunta = 17 and idPeriodo = $per AND idUnidad = $idUnidad and anio = $anio
                          
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

                          				INSERT INTO trimestral.seguimiento VALUES(15, $per, $idUnidad, $idEnlace, $anio, $p15m1, $p15m2, $p15m3, GETDATE() )
                          				INSERT INTO trimestral.seguimiento VALUES(16, $per, $idUnidad, $idEnlace, $anio, $p16m1, $p16m2, $p16m3, GETDATE() )
                                  INSERT INTO trimestral.seguimiento VALUES(17, $per, $idUnidad, $idEnlace, $anio, $p17m1, $p17m2, $p17m3, GETDATE() )
                          
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