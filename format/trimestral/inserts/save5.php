<? 
			include ("../../../Conexiones/Conexion.php");
			include("../../../funcioneTrimes.php");

			if (isset($_GET["per"])){ $per = $_GET["per"]; }
			if (isset($_GET["anio"])){ $anio = $_GET["anio"]; }
			if (isset($_GET["idUnidad"])){ $idUnidad = $_GET["idUnidad"]; }
			if (isset($_GET["idEnlace"])){ $idEnlace = $_GET["idEnlace"]; }

			if (isset($_GET["p10m1"])){ $p10m1 = $_GET["p10m1"]; }
			if (isset($_GET["p10m2"])){ $p10m2 = $_GET["p10m2"]; }
			if (isset($_GET["p10m3"])){ $p10m3 = $_GET["p10m3"]; }

			if (isset($_GET["p11m1"])){ $p11m1 = $_GET["p11m1"]; }
			if (isset($_GET["p11m2"])){ $p11m2 = $_GET["p11m2"]; }
			if (isset($_GET["p11m3"])){ $p11m3 = $_GET["p11m3"]; }

      if (isset($_GET["p12m1"])){ $p12m1 = $_GET["p12m1"]; }
      if (isset($_GET["p12m2"])){ $p12m2 = $_GET["p12m2"]; }
      if (isset($_GET["p12m3"])){ $p12m3 = $_GET["p12m3"]; }

      if (isset($_GET["p13m1"])){ $p13m1 = $_GET["p13m1"]; }
      if (isset($_GET["p13m2"])){ $p13m2 = $_GET["p13m2"]; }
      if (isset($_GET["p13m3"])){ $p13m3 = $_GET["p13m3"]; }

      if (isset($_GET["p14m1"])){ $p14m1 = $_GET["p14m1"]; }
      if (isset($_GET["p14m2"])){ $p14m2 = $_GET["p14m2"]; }
      if (isset($_GET["p14m3"])){ $p14m3 = $_GET["p14m3"]; }


			//$getDataQ3 = getDataQ($conn, 3, $per, $anio, $idUnidad);
			//$getDataQ4 = getDataQ($conn, 4, $per, $anio, $idUnidad);

		$query = " SELECT idSeguimiento FROM trimestral.seguimiento WHERE idPregunta = 10 AND idPeriodo = $per AND anio = $anio AND idUnidad = $idUnidad ";
	 	$stmt = sqlsrv_query(  $conn, $query,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
		 $row_count = sqlsrv_num_rows( $stmt );

		 $query2 = " SELECT idSeguimiento FROM trimestral.seguimiento WHERE idPregunta = 11 AND idPeriodo = $per AND anio = $anio AND idUnidad = $idUnidad ";
	 	$stmt2 = sqlsrv_query(  $conn, $query2,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
		 $row_count2 = sqlsrv_num_rows( $stmt2 );

     $query3 = " SELECT idSeguimiento FROM trimestral.seguimiento WHERE idPregunta = 12 AND idPeriodo = $per AND anio = $anio AND idUnidad = $idUnidad ";
    $stmt3 = sqlsrv_query(  $conn, $query3,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
     $row_count3 = sqlsrv_num_rows( $stmt3 );

     $query4 = " SELECT idSeguimiento FROM trimestral.seguimiento WHERE idPregunta = 13 AND idPeriodo = $per AND anio = $anio AND idUnidad = $idUnidad ";
    $stmt4 = sqlsrv_query(  $conn, $query4,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
     $row_count4 = sqlsrv_num_rows( $stmt4 );

     $query5 = " SELECT idSeguimiento FROM trimestral.seguimiento WHERE idPregunta = 14 AND idPeriodo = $per AND anio = $anio AND idUnidad = $idUnidad ";
    $stmt5 = sqlsrv_query(  $conn, $query5,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
     $row_count5 = sqlsrv_num_rows( $stmt5 );

			if($row_count > 0 && $row_count2 > 0 && $row_count3 > 0 && $row_count4 > 0 && $row_count5 > 0){

					$queryTransaction = " 
                    BEGIN                     
                    BEGIN TRY 
                      BEGIN TRANSACTION
                          SET NOCOUNT ON    

                          			UPDATE trimestral.seguimiento SET m1 = $p10m1, m2 = $p10m2, m3 = $p10m3 WHERE idPregunta = 10 and idPeriodo = $per AND idUnidad = $idUnidad and anio = $anio
                          			UPDATE trimestral.seguimiento SET m1 = $p11m1, m2 = $p11m2, m3 = $p11m3 WHERE idPregunta = 11 and idPeriodo = $per AND idUnidad = $idUnidad and anio = $anio
                                UPDATE trimestral.seguimiento SET m1 = $p12m1, m2 = $p12m2, m3 = $p12m3 WHERE idPregunta = 12 and idPeriodo = $per AND idUnidad = $idUnidad and anio = $anio
                                UPDATE trimestral.seguimiento SET m1 = $p13m1, m2 = $p13m2, m3 = $p13m3 WHERE idPregunta = 13 and idPeriodo = $per AND idUnidad = $idUnidad and anio = $anio
                                UPDATE trimestral.seguimiento SET m1 = $p14m1, m2 = $p14m2, m3 = $p14m3 WHERE idPregunta = 14 and idPeriodo = $per AND idUnidad = $idUnidad and anio = $anio
                          
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

                          				INSERT INTO trimestral.seguimiento VALUES(10, $per, $idUnidad, $idEnlace, $anio, $p10m1, $p10m2, $p10m3, GETDATE() )
                          				INSERT INTO trimestral.seguimiento VALUES(11, $per, $idUnidad, $idEnlace, $anio, $p11m1, $p11m2, $p11m3, GETDATE() )
                                  INSERT INTO trimestral.seguimiento VALUES(12, $per, $idUnidad, $idEnlace, $anio, $p12m1, $p12m2, $p12m3, GETDATE() )
                                  INSERT INTO trimestral.seguimiento VALUES(13, $per, $idUnidad, $idEnlace, $anio, $p13m1, $p13m2, $p13m3, GETDATE() )
                                  INSERT INTO trimestral.seguimiento VALUES(14, $per, $idUnidad, $idEnlace, $anio, $p14m1, $p14m2, $p14m3, GETDATE() )
                          
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