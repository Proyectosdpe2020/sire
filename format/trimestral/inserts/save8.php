<? 
			include ("../../../Conexiones/Conexion.php");
			include("../../../funcioneTrimes.php");

			if (isset($_GET["per"])){ $per = $_GET["per"]; }
			if (isset($_GET["anio"])){ $anio = $_GET["anio"]; }
			if (isset($_GET["idUnidad"])){ $idUnidad = $_GET["idUnidad"]; }
			if (isset($_GET["idEnlace"])){ $idEnlace = $_GET["idEnlace"]; }

			if (isset($_GET["p34m1"])){ $p34m1 = $_GET["p34m1"]; }
			if (isset($_GET["p34m2"])){ $p34m2 = $_GET["p34m2"]; }
			if (isset($_GET["p34m3"])){ $p34m3 = $_GET["p34m3"]; }

			if (isset($_GET["p35m1"])){ $p35m1 = $_GET["p35m1"]; }
   if (isset($_GET["p35m2"])){ $p35m2 = $_GET["p35m2"]; }
   if (isset($_GET["p35m3"])){ $p35m3 = $_GET["p35m3"]; }

   if (isset($_GET["p36m1"])){ $p36m1 = $_GET["p36m1"]; }
   if (isset($_GET["p36m2"])){ $p36m2 = $_GET["p36m2"]; }
   if (isset($_GET["p36m3"])){ $p36m3 = $_GET["p36m3"]; }

   if (isset($_GET["p37m1"])){ $p37m1 = $_GET["p37m1"]; }
   if (isset($_GET["p37m2"])){ $p37m2 = $_GET["p37m2"]; }
   if (isset($_GET["p37m3"])){ $p37m3 = $_GET["p37m3"]; }

   if (isset($_GET["p38m1"])){ $p38m1 = $_GET["p38m1"]; }
   if (isset($_GET["p38m2"])){ $p38m2 = $_GET["p38m2"]; }
   if (isset($_GET["p38m3"])){ $p38m3 = $_GET["p38m3"]; }

   if (isset($_GET["p39m1"])){ $p39m1 = $_GET["p39m1"]; }
   if (isset($_GET["p39m2"])){ $p39m2 = $_GET["p39m2"]; }
   if (isset($_GET["p39m3"])){ $p39m3 = $_GET["p39m3"]; }

   if (isset($_GET["p40m1"])){ $p40m1 = $_GET["p40m1"]; }
   if (isset($_GET["p40m2"])){ $p40m2 = $_GET["p40m2"]; }
   if (isset($_GET["p40m3"])){ $p40m3 = $_GET["p40m3"]; }

   if (isset($_GET["p41m1"])){ $p41m1 = $_GET["p41m1"]; }
   if (isset($_GET["p41m2"])){ $p41m2 = $_GET["p41m2"]; }
   if (isset($_GET["p41m3"])){ $p41m3 = $_GET["p41m3"]; }

   if (isset($_GET["p42m1"])){ $p42m1 = $_GET["p42m1"]; }
   if (isset($_GET["p42m2"])){ $p42m2 = $_GET["p42m2"]; }
   if (isset($_GET["p42m3"])){ $p42m3 = $_GET["p42m3"]; }

   if (isset($_GET["p43m1"])){ $p43m1 = $_GET["p43m1"]; }
   if (isset($_GET["p43m2"])){ $p43m2 = $_GET["p43m2"]; }
   if (isset($_GET["p43m3"])){ $p43m3 = $_GET["p43m3"]; }

   if (isset($_GET["p44m1"])){ $p44m1 = $_GET["p44m1"]; }
   if (isset($_GET["p44m2"])){ $p44m2 = $_GET["p44m2"]; }
   if (isset($_GET["p44m3"])){ $p44m3 = $_GET["p44m3"]; }

   if (isset($_GET["p45m1"])){ $p45m1 = $_GET["p45m1"]; }
   if (isset($_GET["p45m2"])){ $p45m2 = $_GET["p45m2"]; }
   if (isset($_GET["p45m3"])){ $p45m3 = $_GET["p45m3"]; }

   if (isset($_GET["p46m1"])){ $p46m1 = $_GET["p46m1"]; }
   if (isset($_GET["p46m2"])){ $p46m2 = $_GET["p46m2"]; }
   if (isset($_GET["p46m3"])){ $p46m3 = $_GET["p46m3"]; }

   if (isset($_GET["p47m1"])){ $p47m1 = $_GET["p47m1"]; }
   if (isset($_GET["p47m2"])){ $p47m2 = $_GET["p47m2"]; }
   if (isset($_GET["p47m3"])){ $p47m3 = $_GET["p47m3"]; }

			//$getDataQ3 = getDataQ($conn, 3, $per, $anio, $idUnidad);
			//$getDataQ4 = getDataQ($conn, 4, $per, $anio, $idUnidad);

			$query = " SELECT idSeguimiento FROM trimestral.seguimiento WHERE idPregunta = 34 AND idPeriodo = $per AND anio = $anio AND idUnidad = $idUnidad ";
	 	$stmt = sqlsrv_query(  $conn, $query,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
		 $row_count = sqlsrv_num_rows( $stmt );

		 $query2 = " SELECT idSeguimiento FROM trimestral.seguimiento WHERE idPregunta = 35 AND idPeriodo = $per AND anio = $anio AND idUnidad = $idUnidad ";
	 	$stmt2 = sqlsrv_query(  $conn, $query2,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
		 $row_count2 = sqlsrv_num_rows( $stmt2 );

   $query3 = " SELECT idSeguimiento FROM trimestral.seguimiento WHERE idPregunta = 36 AND idPeriodo = $per AND anio = $anio AND idUnidad = $idUnidad ";
   $stmt3 = sqlsrv_query(  $conn, $query3,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
   $row_count3 = sqlsrv_num_rows( $stmt3 );

   $query4 = " SELECT idSeguimiento FROM trimestral.seguimiento WHERE idPregunta = 37 AND idPeriodo = $per AND anio = $anio AND idUnidad = $idUnidad ";
   $stmt4 = sqlsrv_query(  $conn, $query4,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
   $row_count4 = sqlsrv_num_rows( $stmt4 );

   $query5 = " SELECT idSeguimiento FROM trimestral.seguimiento WHERE idPregunta = 38 AND idPeriodo = $per AND anio = $anio AND idUnidad = $idUnidad ";
   $stmt5 = sqlsrv_query(  $conn, $query5,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
   $row_count5 = sqlsrv_num_rows( $stmt5 );

   $query6 = " SELECT idSeguimiento FROM trimestral.seguimiento WHERE idPregunta = 39 AND idPeriodo = $per AND anio = $anio AND idUnidad = $idUnidad ";
   $stmt6 = sqlsrv_query(  $conn, $query6,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
   $row_count6 = sqlsrv_num_rows( $stmt6 );

   $query7 = " SELECT idSeguimiento FROM trimestral.seguimiento WHERE idPregunta = 40 AND idPeriodo = $per AND anio = $anio AND idUnidad = $idUnidad ";
   $stmt7 = sqlsrv_query(  $conn, $query7,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
   $row_count7 = sqlsrv_num_rows( $stmt7 );

   $query8 = " SELECT idSeguimiento FROM trimestral.seguimiento WHERE idPregunta = 41 AND idPeriodo = $per AND anio = $anio AND idUnidad = $idUnidad ";
   $stmt8 = sqlsrv_query(  $conn, $query8,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
   $row_count8 = sqlsrv_num_rows( $stmt8 );

   $query9 = " SELECT idSeguimiento FROM trimestral.seguimiento WHERE idPregunta = 42 AND idPeriodo = $per AND anio = $anio AND idUnidad = $idUnidad ";
   $stmt9 = sqlsrv_query(  $conn, $query9,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
   $row_count9 = sqlsrv_num_rows( $stmt9 );

   $query10 = " SELECT idSeguimiento FROM trimestral.seguimiento WHERE idPregunta = 43 AND idPeriodo = $per AND anio = $anio AND idUnidad = $idUnidad ";
   $stmt10 = sqlsrv_query(  $conn, $query10,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
   $row_count10 = sqlsrv_num_rows( $stmt10 );

   $query11 = " SELECT idSeguimiento FROM trimestral.seguimiento WHERE idPregunta = 44 AND idPeriodo = $per AND anio = $anio AND idUnidad = $idUnidad ";
   $stmt11 = sqlsrv_query(  $conn, $query11,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
   $row_count11 = sqlsrv_num_rows( $stmt11 );

   $query12 = " SELECT idSeguimiento FROM trimestral.seguimiento WHERE idPregunta = 45 AND idPeriodo = $per AND anio = $anio AND idUnidad = $idUnidad ";
   $stmt12 = sqlsrv_query(  $conn, $query12,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
   $row_count12 = sqlsrv_num_rows( $stmt12 );

   $query13 = " SELECT idSeguimiento FROM trimestral.seguimiento WHERE idPregunta = 46 AND idPeriodo = $per AND anio = $anio AND idUnidad = $idUnidad ";
   $stmt13 = sqlsrv_query(  $conn, $query13,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
   $row_count13 = sqlsrv_num_rows( $stmt13 );

   $query14 = " SELECT idSeguimiento FROM trimestral.seguimiento WHERE idPregunta = 47 AND idPeriodo = $per AND anio = $anio AND idUnidad = $idUnidad ";
   $stmt14 = sqlsrv_query(  $conn, $query14,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
   $row_count14 = sqlsrv_num_rows( $stmt14 );

			if($row_count > 0 && $row_count2 > 0 && $row_count3 > 0 && $row_count4 > 0 && $row_count5 > 0 && $row_count6 > 0 && $row_count7 > 0
   && $row_count8 > 0 && $row_count9 > 0 && $row_count10 > 0 && $row_count11 > 0 && $row_count12 > 0 && $row_count13 > 0 && $row_count14 > 0){

					$queryTransaction = " 
                    BEGIN                     
                    BEGIN TRY 
                      BEGIN TRANSACTION
                          SET NOCOUNT ON    

                          			UPDATE trimestral.seguimiento SET m1 = $p34m1, m2 = $p34m2, m3 = $p34m3 WHERE idPregunta = 34 and idPeriodo = $per AND idUnidad = $idUnidad and anio = $anio
                          			UPDATE trimestral.seguimiento SET m1 = $p35m1, m2 = $p35m2, m3 = $p35m3 WHERE idPregunta = 35 and idPeriodo = $per AND idUnidad = $idUnidad and anio = $anio
                             UPDATE trimestral.seguimiento SET m1 = $p36m1, m2 = $p36m2, m3 = $p36m3 WHERE idPregunta = 36 and idPeriodo = $per AND idUnidad = $idUnidad and anio = $anio
                             UPDATE trimestral.seguimiento SET m1 = $p37m1, m2 = $p37m2, m3 = $p37m3 WHERE idPregunta = 37 and idPeriodo = $per AND idUnidad = $idUnidad and anio = $anio
                             UPDATE trimestral.seguimiento SET m1 = $p38m1, m2 = $p38m2, m3 = $p38m3 WHERE idPregunta = 38 and idPeriodo = $per AND idUnidad = $idUnidad and anio = $anio
                             UPDATE trimestral.seguimiento SET m1 = $p39m1, m2 = $p39m2, m3 = $p39m3 WHERE idPregunta = 39 and idPeriodo = $per AND idUnidad = $idUnidad and anio = $anio
                             UPDATE trimestral.seguimiento SET m1 = $p40m1, m2 = $p40m2, m3 = $p40m3 WHERE idPregunta = 40 and idPeriodo = $per AND idUnidad = $idUnidad and anio = $anio
                             UPDATE trimestral.seguimiento SET m1 = $p41m1, m2 = $p41m2, m3 = $p41m3 WHERE idPregunta = 41 and idPeriodo = $per AND idUnidad = $idUnidad and anio = $anio
                             UPDATE trimestral.seguimiento SET m1 = $p42m1, m2 = $p42m2, m3 = $p42m3 WHERE idPregunta = 42 and idPeriodo = $per AND idUnidad = $idUnidad and anio = $anio
                             UPDATE trimestral.seguimiento SET m1 = $p43m1, m2 = $p43m2, m3 = $p43m3 WHERE idPregunta = 43 and idPeriodo = $per AND idUnidad = $idUnidad and anio = $anio
                             UPDATE trimestral.seguimiento SET m1 = $p44m1, m2 = $p44m2, m3 = $p44m3 WHERE idPregunta = 44 and idPeriodo = $per AND idUnidad = $idUnidad and anio = $anio
                             UPDATE trimestral.seguimiento SET m1 = $p45m1, m2 = $p45m2, m3 = $p45m3 WHERE idPregunta = 45 and idPeriodo = $per AND idUnidad = $idUnidad and anio = $anio
                             UPDATE trimestral.seguimiento SET m1 = $p46m1, m2 = $p46m2, m3 = $p46m3 WHERE idPregunta = 46 and idPeriodo = $per AND idUnidad = $idUnidad and anio = $anio
                             UPDATE trimestral.seguimiento SET m1 = $p47m1, m2 = $p47m2, m3 = $p47m3 WHERE idPregunta = 47 and idPeriodo = $per AND idUnidad = $idUnidad and anio = $anio
                          
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

                          				INSERT INTO trimestral.seguimiento VALUES(34, $per, $idUnidad, $idEnlace, $anio, $p34m1, $p34m2, $p34m3, GETDATE() )
                          				INSERT INTO trimestral.seguimiento VALUES(35, $per, $idUnidad, $idEnlace, $anio, $p35m1, $p35m2, $p35m3, GETDATE() )
                              INSERT INTO trimestral.seguimiento VALUES(36, $per, $idUnidad, $idEnlace, $anio, $p36m1, $p36m2, $p36m3, GETDATE() )
                              INSERT INTO trimestral.seguimiento VALUES(37, $per, $idUnidad, $idEnlace, $anio, $p37m1, $p37m2, $p37m3, GETDATE() )
                              INSERT INTO trimestral.seguimiento VALUES(38, $per, $idUnidad, $idEnlace, $anio, $p38m1, $p38m2, $p38m3, GETDATE() )
                              INSERT INTO trimestral.seguimiento VALUES(39, $per, $idUnidad, $idEnlace, $anio, $p39m1, $p39m2, $p39m3, GETDATE() )
                              INSERT INTO trimestral.seguimiento VALUES(40, $per, $idUnidad, $idEnlace, $anio, $p40m1, $p40m2, $p40m3, GETDATE() )
                              INSERT INTO trimestral.seguimiento VALUES(41, $per, $idUnidad, $idEnlace, $anio, $p41m1, $p41m2, $p41m3, GETDATE() )
                              INSERT INTO trimestral.seguimiento VALUES(42, $per, $idUnidad, $idEnlace, $anio, $p42m1, $p42m2, $p42m3, GETDATE() )
                              INSERT INTO trimestral.seguimiento VALUES(43, $per, $idUnidad, $idEnlace, $anio, $p43m1, $p43m2, $p43m3, GETDATE() )
                              INSERT INTO trimestral.seguimiento VALUES(44, $per, $idUnidad, $idEnlace, $anio, $p44m1, $p44m2, $p44m3, GETDATE() )
                              INSERT INTO trimestral.seguimiento VALUES(45, $per, $idUnidad, $idEnlace, $anio, $p45m1, $p45m2, $p45m3, GETDATE() )
                              INSERT INTO trimestral.seguimiento VALUES(46, $per, $idUnidad, $idEnlace, $anio, $p46m1, $p46m2, $p46m3, GETDATE() )
                              INSERT INTO trimestral.seguimiento VALUES(47, $per, $idUnidad, $idEnlace, $anio, $p47m1, $p47m2, $p47m3, GETDATE() )

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