<? 
			include ("../../../Conexiones/Conexion.php");
			include("../../../funcioneTrimes.php");

			if (isset($_GET["per"])){ $per = $_GET["per"]; }
			if (isset($_GET["anio"])){ $anio = $_GET["anio"]; }
			if (isset($_GET["idUnidad"])){ $idUnidad = $_GET["idUnidad"]; }
			if (isset($_GET["idEnlace"])){ $idEnlace = $_GET["idEnlace"]; }

			if (isset($_GET["p5m1"])){ $p5m1 = $_GET["p5m1"]; }
			if (isset($_GET["p5m2"])){ $p5m2 = $_GET["p5m2"]; }
			if (isset($_GET["p5m3"])){ $p5m3 = $_GET["p5m3"]; }

			if (isset($_GET["p6m1"])){ $p6m1 = $_GET["p6m1"]; }
			if (isset($_GET["p6m2"])){ $p6m2 = $_GET["p6m2"]; }
			if (isset($_GET["p6m3"])){ $p6m3 = $_GET["p6m3"]; }

      if (isset($_GET["p7m1"])){ $p7m1 = $_GET["p7m1"]; }
      if (isset($_GET["p7m2"])){ $p7m2 = $_GET["p7m2"]; }
      if (isset($_GET["p7m3"])){ $p7m3 = $_GET["p7m3"]; }

			//$getDataQ3 = getDataQ($conn, 3, $per, $anio, $idUnidad);
			//$getDataQ4 = getDataQ($conn, 4, $per, $anio, $idUnidad);

			$query = " SELECT idSeguimiento FROM trimestral.seguimiento WHERE idPregunta = 5 AND idPeriodo = $per AND anio = $anio AND idUnidad = $idUnidad ";
	 	$stmt = sqlsrv_query(  $conn, $query,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
		 $row_count = sqlsrv_num_rows( $stmt );

		 $query2 = " SELECT idSeguimiento FROM trimestral.seguimiento WHERE idPregunta = 6 AND idPeriodo = $per AND anio = $anio AND idUnidad = $idUnidad ";
	 	$stmt2 = sqlsrv_query(  $conn, $query2,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
		 $row_count2 = sqlsrv_num_rows( $stmt2 );

     $query3 = " SELECT idSeguimiento FROM trimestral.seguimiento WHERE idPregunta = 7 AND idPeriodo = $per AND anio = $anio AND idUnidad = $idUnidad ";
    $stmt3 = sqlsrv_query(  $conn, $query3,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
     $row_count3 = sqlsrv_num_rows( $stmt3 );

			if($row_count > 0 && $row_count2 > 0 && $row_count3 > 0){

					$queryTransaction = " 
                    BEGIN                     
                    BEGIN TRY 
                      BEGIN TRANSACTION
                          SET NOCOUNT ON    

                          			UPDATE trimestral.seguimiento SET m1 = $p5m1, m2 = $p5m2, m3 = $p5m3 WHERE idPregunta = 5 and idPeriodo = $per AND idUnidad = $idUnidad and anio = $anio
                          			UPDATE trimestral.seguimiento SET m1 = $p6m1, m2 = $p6m2, m3 = $p6m3 WHERE idPregunta = 6 and idPeriodo = $per AND idUnidad = $idUnidad and anio = $anio
                                UPDATE trimestral.seguimiento SET m1 = $p7m1, m2 = $p7m2, m3 = $p7m3 WHERE idPregunta = 7 and idPeriodo = $per AND idUnidad = $idUnidad and anio = $anio
                          
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

                          				INSERT INTO trimestral.seguimiento VALUES(5, $per, $idUnidad, $idEnlace, $anio, $p5m1, $p5m2, $p5m3, GETDATE() )
                          				INSERT INTO trimestral.seguimiento VALUES(6, $per, $idUnidad, $idEnlace, $anio, $p6m1, $p6m2, $p6m3, GETDATE() )
                                  INSERT INTO trimestral.seguimiento VALUES(7, $per, $idUnidad, $idEnlace, $anio, $p7m1, $p7m2, $p7m3, GETDATE() )
                          
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