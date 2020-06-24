<? 
			include ("../../../Conexiones/Conexion.php");
			include("../../../funcioneTrimes.php");

			if (isset($_GET["per"])){ $per = $_GET["per"]; }
			if (isset($_GET["anio"])){ $anio = $_GET["anio"]; }
			if (isset($_GET["idUnidad"])){ $idUnidad = $_GET["idUnidad"]; }
			if (isset($_GET["idEnlace"])){ $idEnlace = $_GET["idEnlace"]; }

			if (isset($_GET["p18m1"])){ $p18m1 = $_GET["p18m1"]; }
			if (isset($_GET["p18m2"])){ $p18m2 = $_GET["p18m2"]; }
			if (isset($_GET["p18m3"])){ $p18m3 = $_GET["p18m3"]; }

			if (isset($_GET["p19m1"])){ $p19m1 = $_GET["p19m1"]; }
			if (isset($_GET["p19m2"])){ $p19m2 = $_GET["p19m2"]; }
			if (isset($_GET["p19m3"])){ $p19m3 = $_GET["p19m3"]; }

      if (isset($_GET["p20m1"])){ $p20m1 = $_GET["p20m1"]; }
      if (isset($_GET["p20m2"])){ $p20m2 = $_GET["p20m2"]; }
      if (isset($_GET["p20m3"])){ $p20m3 = $_GET["p20m3"]; }

      if (isset($_GET["p21m1"])){ $p21m1 = $_GET["p21m1"]; }
      if (isset($_GET["p21m2"])){ $p21m2 = $_GET["p21m2"]; }
      if (isset($_GET["p21m3"])){ $p21m3 = $_GET["p21m3"]; }

      if (isset($_GET["p22m1"])){ $p22m1 = $_GET["p22m1"]; }
      if (isset($_GET["p22m2"])){ $p22m2 = $_GET["p22m2"]; }
      if (isset($_GET["p22m3"])){ $p22m3 = $_GET["p22m3"]; }      

      if (isset($_GET["p23m1"])){ $p23m1 = $_GET["p23m1"]; }
      if (isset($_GET["p23m2"])){ $p23m2 = $_GET["p23m2"]; }
      if (isset($_GET["p23m3"])){ $p23m3 = $_GET["p23m3"]; }

      if (isset($_GET["p24m1"])){ $p24m1 = $_GET["p24m1"]; }
      if (isset($_GET["p24m2"])){ $p24m2 = $_GET["p24m2"]; }
      if (isset($_GET["p24m3"])){ $p24m3 = $_GET["p24m3"]; }

      if (isset($_GET["p25m1"])){ $p25m1 = $_GET["p25m1"]; }
      if (isset($_GET["p25m2"])){ $p25m2 = $_GET["p25m2"]; }
      if (isset($_GET["p25m3"])){ $p25m3 = $_GET["p25m3"]; }

      if (isset($_GET["p26m1"])){ $p26m1 = $_GET["p26m1"]; }
      if (isset($_GET["p26m2"])){ $p26m2 = $_GET["p26m2"]; }
      if (isset($_GET["p26m3"])){ $p26m3 = $_GET["p26m3"]; }

      if (isset($_GET["p27m1"])){ $p27m1 = $_GET["p27m1"]; }
      if (isset($_GET["p27m2"])){ $p27m2 = $_GET["p27m2"]; }
      if (isset($_GET["p27m3"])){ $p27m3 = $_GET["p27m3"]; }

      if (isset($_GET["p28m1"])){ $p28m1 = $_GET["p28m1"]; }
      if (isset($_GET["p28m2"])){ $p28m2 = $_GET["p28m2"]; }
      if (isset($_GET["p28m3"])){ $p28m3 = $_GET["p28m3"]; }

      if (isset($_GET["p29m1"])){ $p29m1 = $_GET["p29m1"]; }
      if (isset($_GET["p29m2"])){ $p29m2 = $_GET["p29m2"]; }
      if (isset($_GET["p29m3"])){ $p29m3 = $_GET["p29m3"]; }

      if (isset($_GET["p30m1"])){ $p30m1 = $_GET["p30m1"]; }
      if (isset($_GET["p30m2"])){ $p30m2 = $_GET["p30m2"]; }
      if (isset($_GET["p30m3"])){ $p30m3 = $_GET["p30m3"]; }

      if (isset($_GET["p31m1"])){ $p31m1 = $_GET["p31m1"]; }
      if (isset($_GET["p31m2"])){ $p31m2 = $_GET["p31m2"]; }
      if (isset($_GET["p31m3"])){ $p31m3 = $_GET["p31m3"]; }

      if (isset($_GET["p32m1"])){ $p32m1 = $_GET["p32m1"]; }
      if (isset($_GET["p32m2"])){ $p32m2 = $_GET["p32m2"]; }
      if (isset($_GET["p32m3"])){ $p32m3 = $_GET["p32m3"]; }

      if (isset($_GET["p33m1"])){ $p33m1 = $_GET["p33m1"]; }
      if (isset($_GET["p33m2"])){ $p33m2 = $_GET["p33m2"]; }
      if (isset($_GET["p33m3"])){ $p33m3 = $_GET["p33m3"]; }
			//$getDataQ3 = getDataQ($conn, 3, $per, $anio, $idUnidad);
			//$getDataQ4 = getDataQ($conn, 4, $per, $anio, $idUnidad);

			$query = " SELECT idSeguimiento FROM trimestral.seguimiento WHERE idPregunta = 18 AND idPeriodo = $per AND anio = $anio AND idUnidad = $idUnidad ";
	 	$stmt = sqlsrv_query(  $conn, $query,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
		 $row_count = sqlsrv_num_rows( $stmt );

		 $query2 = " SELECT idSeguimiento FROM trimestral.seguimiento WHERE idPregunta = 19 AND idPeriodo = $per AND anio = $anio AND idUnidad = $idUnidad ";
	 	$stmt2 = sqlsrv_query(  $conn, $query2,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
		 $row_count2 = sqlsrv_num_rows( $stmt2 );

   $query3 = " SELECT idSeguimiento FROM trimestral.seguimiento WHERE idPregunta = 20 AND idPeriodo = $per AND anio = $anio AND idUnidad = $idUnidad ";
   $stmt3 = sqlsrv_query(  $conn, $query3,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
   $row_count3 = sqlsrv_num_rows( $stmt3 );

   $query4 = " SELECT idSeguimiento FROM trimestral.seguimiento WHERE idPregunta = 21 AND idPeriodo = $per AND anio = $anio AND idUnidad = $idUnidad ";
   $stmt4 = sqlsrv_query(  $conn, $query4,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
   $row_count4 = sqlsrv_num_rows( $stmt4 );

   $query5 = " SELECT idSeguimiento FROM trimestral.seguimiento WHERE idPregunta = 22 AND idPeriodo = $per AND anio = $anio AND idUnidad = $idUnidad ";
   $stmt5 = sqlsrv_query(  $conn, $query5,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
   $row_count5= sqlsrv_num_rows( $stmt5);

   $query6 = " SELECT idSeguimiento FROM trimestral.seguimiento WHERE idPregunta = 23 AND idPeriodo = $per AND anio = $anio AND idUnidad = $idUnidad ";
   $stmt6 = sqlsrv_query(  $conn, $query6,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
   $row_count6 = sqlsrv_num_rows( $stmt6 );

   $query7 = " SELECT idSeguimiento FROM trimestral.seguimiento WHERE idPregunta = 24 AND idPeriodo = $per AND anio = $anio AND idUnidad = $idUnidad ";
   $stmt7 = sqlsrv_query(  $conn, $query7,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
   $row_count7 = sqlsrv_num_rows( $stmt7 );

   $query8 = " SELECT idSeguimiento FROM trimestral.seguimiento WHERE idPregunta = 25 AND idPeriodo = $per AND anio = $anio AND idUnidad = $idUnidad ";
   $stmt8 = sqlsrv_query(  $conn, $query8,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
   $row_count8 = sqlsrv_num_rows( $stmt8 );

   $query9 = " SELECT idSeguimiento FROM trimestral.seguimiento WHERE idPregunta = 26 AND idPeriodo = $per AND anio = $anio AND idUnidad = $idUnidad ";
   $stmt9 = sqlsrv_query(  $conn, $query9,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
   $row_count9 = sqlsrv_num_rows( $stmt9 );

   $query10 = " SELECT idSeguimiento FROM trimestral.seguimiento WHERE idPregunta = 27 AND idPeriodo = $per AND anio = $anio AND idUnidad = $idUnidad ";
   $stmt10 = sqlsrv_query(  $conn, $query10,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
   $row_count10 = sqlsrv_num_rows( $stmt10 );

   $query11 = " SELECT idSeguimiento FROM trimestral.seguimiento WHERE idPregunta = 28 AND idPeriodo = $per AND anio = $anio AND idUnidad = $idUnidad ";
   $stmt11 = sqlsrv_query(  $conn, $query11,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
   $row_count11= sqlsrv_num_rows( $stmt11 );

   $query12 = " SELECT idSeguimiento FROM trimestral.seguimiento WHERE idPregunta = 29 AND idPeriodo = $per AND anio = $anio AND idUnidad = $idUnidad ";
   $stmt12 = sqlsrv_query(  $conn, $query12,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
   $row_count12 = sqlsrv_num_rows( $stmt12 );

   $query13 = " SELECT idSeguimiento FROM trimestral.seguimiento WHERE idPregunta = 30 AND idPeriodo = $per AND anio = $anio AND idUnidad = $idUnidad ";
   $stmt13 = sqlsrv_query(  $conn, $query13,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
   $row_count13 = sqlsrv_num_rows( $stmt13 );

   $query14 = " SELECT idSeguimiento FROM trimestral.seguimiento WHERE idPregunta = 31 AND idPeriodo = $per AND anio = $anio AND idUnidad = $idUnidad ";
   $stmt14 = sqlsrv_query(  $conn, $query14,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
   $row_count14 = sqlsrv_num_rows( $stmt14 );

   $query15 = " SELECT idSeguimiento FROM trimestral.seguimiento WHERE idPregunta = 32 AND idPeriodo = $per AND anio = $anio AND idUnidad = $idUnidad ";
   $stmt15 = sqlsrv_query(  $conn, $query15,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
   $row_count15 = sqlsrv_num_rows( $stmt15 );

   $query16 = " SELECT idSeguimiento FROM trimestral.seguimiento WHERE idPregunta = 33 AND idPeriodo = $per AND anio = $anio AND idUnidad = $idUnidad ";
   $stmt16 = sqlsrv_query(  $conn, $query16,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
   $row_count16 = sqlsrv_num_rows( $stmt16 );

			if($row_count > 0 && $row_count2 > 0 && $row_count3 > 0 && $row_count4 > 0 && $row_count5 > 0 && $row_count6 > 0 && $row_count7 > 0 && $row_count8 > 0 && $row_count9 > 0
    && $row_count10 > 0 && $row_count11 > 0 && $row_count12 > 0 && $row_count13 > 0 && $row_count14 > 0 && $row_count15 > 0 && $row_count16 ){

					$queryTransaction = " 
                    BEGIN                     
                    BEGIN TRY 
                      BEGIN TRANSACTION
                          SET NOCOUNT ON    

                          			UPDATE trimestral.seguimiento SET m1 = $p18m1, m2 = $p18m2, m3 = $p18m3 WHERE idPregunta = 18 and idPeriodo = $per AND idUnidad = $idUnidad and anio = $anio
                          			UPDATE trimestral.seguimiento SET m1 = $p19m1, m2 = $p19m2, m3 = $p19m3 WHERE idPregunta = 19 and idPeriodo = $per AND idUnidad = $idUnidad and anio = $anio
                             UPDATE trimestral.seguimiento SET m1 = $p20m1, m2 = $p20m2, m3 = $p20m3 WHERE idPregunta = 20 and idPeriodo = $per AND idUnidad = $idUnidad and anio = $anio
                             UPDATE trimestral.seguimiento SET m1 = $p21m1, m2 = $p21m2, m3 = $p21m3 WHERE idPregunta = 21 and idPeriodo = $per AND idUnidad = $idUnidad and anio = $anio
                             UPDATE trimestral.seguimiento SET m1 = $p22m1, m2 = $p22m2, m3 = $p22m3 WHERE idPregunta = 22 and idPeriodo = $per AND idUnidad = $idUnidad and anio = $anio
                             UPDATE trimestral.seguimiento SET m1 = $p23m1, m2 = $p23m2, m3 = $p23m3 WHERE idPregunta = 23 and idPeriodo = $per AND idUnidad = $idUnidad and anio = $anio
                             UPDATE trimestral.seguimiento SET m1 = $p24m1, m2 = $p24m2, m3 = $p24m3 WHERE idPregunta = 24 and idPeriodo = $per AND idUnidad = $idUnidad and anio = $anio
                             UPDATE trimestral.seguimiento SET m1 = $p25m1, m2 = $p25m2, m3 = $p25m3 WHERE idPregunta = 25 and idPeriodo = $per AND idUnidad = $idUnidad and anio = $anio
                             UPDATE trimestral.seguimiento SET m1 = $p26m1, m2 = $p26m2, m3 = $p26m3 WHERE idPregunta = 26 and idPeriodo = $per AND idUnidad = $idUnidad and anio = $anio
                             UPDATE trimestral.seguimiento SET m1 = $p27m1, m2 = $p27m2, m3 = $p27m3 WHERE idPregunta = 27 and idPeriodo = $per AND idUnidad = $idUnidad and anio = $anio
                             UPDATE trimestral.seguimiento SET m1 = $p28m1, m2 = $p28m2, m3 = $p28m3 WHERE idPregunta = 28 and idPeriodo = $per AND idUnidad = $idUnidad and anio = $anio
                             UPDATE trimestral.seguimiento SET m1 = $p29m1, m2 = $p29m2, m3 = $p29m3 WHERE idPregunta = 29 and idPeriodo = $per AND idUnidad = $idUnidad and anio = $anio
                             UPDATE trimestral.seguimiento SET m1 = $p30m1, m2 = $p30m2, m3 = $p30m3 WHERE idPregunta = 30 and idPeriodo = $per AND idUnidad = $idUnidad and anio = $anio
                             UPDATE trimestral.seguimiento SET m1 = $p31m1, m2 = $p31m2, m3 = $p31m3 WHERE idPregunta = 31 and idPeriodo = $per AND idUnidad = $idUnidad and anio = $anio
                             UPDATE trimestral.seguimiento SET m1 = $p32m1, m2 = $p32m2, m3 = $p32m3 WHERE idPregunta = 32 and idPeriodo = $per AND idUnidad = $idUnidad and anio = $anio
                             UPDATE trimestral.seguimiento SET m1 = $p33m1, m2 = $p33m2, m3 = $p33m3 WHERE idPregunta = 33 and idPeriodo = $per AND idUnidad = $idUnidad and anio = $anio
                          
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

                          				INSERT INTO trimestral.seguimiento VALUES(18, $per, $idUnidad, $idEnlace, $anio, $p18m1, $p18m2, $p18m3, GETDATE() )
                          				INSERT INTO trimestral.seguimiento VALUES(19, $per, $idUnidad, $idEnlace, $anio, $p19m1, $p19m2, $p19m3, GETDATE() )
                              INSERT INTO trimestral.seguimiento VALUES(20, $per, $idUnidad, $idEnlace, $anio, $p20m1, $p20m2, $p20m3, GETDATE() )
                              INSERT INTO trimestral.seguimiento VALUES(21, $per, $idUnidad, $idEnlace, $anio, $p21m1, $p21m2, $p21m3, GETDATE() )
                              INSERT INTO trimestral.seguimiento VALUES(22, $per, $idUnidad, $idEnlace, $anio, $p22m1, $p22m2, $p22m3, GETDATE() )
                              INSERT INTO trimestral.seguimiento VALUES(23, $per, $idUnidad, $idEnlace, $anio, $p23m1, $p23m2, $p23m3, GETDATE() )
                              INSERT INTO trimestral.seguimiento VALUES(24, $per, $idUnidad, $idEnlace, $anio, $p24m1, $p24m2, $p24m3, GETDATE() )
                              INSERT INTO trimestral.seguimiento VALUES(25, $per, $idUnidad, $idEnlace, $anio, $p25m1, $p25m2, $p25m3, GETDATE() )
                              INSERT INTO trimestral.seguimiento VALUES(26, $per, $idUnidad, $idEnlace, $anio, $p26m1, $p26m2, $p26m3, GETDATE() )
                              INSERT INTO trimestral.seguimiento VALUES(27, $per, $idUnidad, $idEnlace, $anio, $p27m1, $p27m2, $p27m3, GETDATE() )
                              INSERT INTO trimestral.seguimiento VALUES(28, $per, $idUnidad, $idEnlace, $anio, $p28m1, $p28m2, $p28m3, GETDATE() )
                              INSERT INTO trimestral.seguimiento VALUES(29, $per, $idUnidad, $idEnlace, $anio, $p29m1, $p29m2, $p29m3, GETDATE() )
                              INSERT INTO trimestral.seguimiento VALUES(30, $per, $idUnidad, $idEnlace, $anio, $p30m1, $p30m2, $p30m3, GETDATE() )
                              INSERT INTO trimestral.seguimiento VALUES(31, $per, $idUnidad, $idEnlace, $anio, $p31m1, $p31m2, $p31m3, GETDATE() )
                              INSERT INTO trimestral.seguimiento VALUES(32, $per, $idUnidad, $idEnlace, $anio, $p32m1, $p32m2, $p32m3, GETDATE() )
                              INSERT INTO trimestral.seguimiento VALUES(33, $per, $idUnidad, $idEnlace, $anio, $p33m1, $p33m2, $p33m3, GETDATE() )
                          
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