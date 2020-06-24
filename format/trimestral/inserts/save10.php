<? 
			include ("../../../Conexiones/Conexion.php");
			include("../../../funcioneTrimes.php");

			if (isset($_GET["per"])){ $per = $_GET["per"]; }
			if (isset($_GET["anio"])){ $anio = $_GET["anio"]; }
			if (isset($_GET["idUnidad"])){ $idUnidad = $_GET["idUnidad"]; }
			if (isset($_GET["idEnlace"])){ $idEnlace = $_GET["idEnlace"]; }

			if (isset($_GET["p52m1"])){ $p52m1 = $_GET["p52m1"]; }
			if (isset($_GET["p52m2"])){ $p52m2 = $_GET["p52m2"]; }
			if (isset($_GET["p52m3"])){ $p52m3 = $_GET["p52m3"]; }

			if (isset($_GET["p53m1"])){ $p53m1 = $_GET["p53m1"]; }
   if (isset($_GET["p53m2"])){ $p53m2 = $_GET["p53m2"]; }
   if (isset($_GET["p53m3"])){ $p53m3 = $_GET["p53m3"]; }

   if (isset($_GET["p54m1"])){ $p54m1 = $_GET["p54m1"]; }
   if (isset($_GET["p54m2"])){ $p54m2 = $_GET["p54m2"]; }
   if (isset($_GET["p54m3"])){ $p54m3 = $_GET["p54m3"]; }

   if (isset($_GET["p55m1"])){ $p55m1 = $_GET["p55m1"]; }
   if (isset($_GET["p55m2"])){ $p55m2 = $_GET["p55m2"]; }
   if (isset($_GET["p55m3"])){ $p55m3 = $_GET["p55m3"]; }

			//$getDataQ3 = getDataQ($conn, 3, $per, $anio, $idUnidad);
			//$getDataQ4 = getDataQ($conn, 4, $per, $anio, $idUnidad);

			$query = " SELECT idSeguimiento FROM trimestral.seguimiento WHERE idPregunta = 52 AND idPeriodo = $per AND anio = $anio AND idUnidad = $idUnidad ";
	 	$stmt = sqlsrv_query(  $conn, $query,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
		 $row_count = sqlsrv_num_rows( $stmt );

		 $query2 = " SELECT idSeguimiento FROM trimestral.seguimiento WHERE idPregunta = 53 AND idPeriodo = $per AND anio = $anio AND idUnidad = $idUnidad ";
	 	$stmt2 = sqlsrv_query(  $conn, $query2,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
		 $row_count2 = sqlsrv_num_rows( $stmt2 );

     $query3 = " SELECT idSeguimiento FROM trimestral.seguimiento WHERE idPregunta = 54 AND idPeriodo = $per AND anio = $anio AND idUnidad = $idUnidad ";
    $stmt3 = sqlsrv_query(  $conn, $query3,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
     $row_count3 = sqlsrv_num_rows( $stmt3 );

   $query4 = " SELECT idSeguimiento FROM trimestral.seguimiento WHERE idPregunta = 55 AND idPeriodo = $per AND anio = $anio AND idUnidad = $idUnidad ";
    $stmt4 = sqlsrv_query(  $conn, $query4,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
     $row_count4 = sqlsrv_num_rows( $stmt4 );

			if($row_count > 0 && $row_count2 > 0 && $row_count3 > 0 && $row_count4 > 0){

					$queryTransaction = " 
                    BEGIN                     
                    BEGIN TRY 
                      BEGIN TRANSACTION
                          SET NOCOUNT ON    

                          			UPDATE trimestral.seguimiento SET m1 = $p52m1, m2 = $p52m2, m3 = $p52m3 WHERE idPregunta = 52 and idPeriodo = $per AND idUnidad = $idUnidad and anio = $anio
                          			UPDATE trimestral.seguimiento SET m1 = $p53m1, m2 = $p53m2, m3 = $p53m3 WHERE idPregunta = 53 and idPeriodo = $per AND idUnidad = $idUnidad and anio = $anio
                             UPDATE trimestral.seguimiento SET m1 = $p54m1, m2 = $p54m2, m3 = $p54m3 WHERE idPregunta = 54 and idPeriodo = $per AND idUnidad = $idUnidad and anio = $anio
                             UPDATE trimestral.seguimiento SET m1 = $p55m1, m2 = $p55m2, m3 = $p55m3 WHERE idPregunta = 55 and idPeriodo = $per AND idUnidad = $idUnidad and anio = $anio
                          
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

                          				INSERT INTO trimestral.seguimiento VALUES(52, $per, $idUnidad, $idEnlace, $anio, $p52m1, $p52m2, $p52m3, GETDATE() )
                          				INSERT INTO trimestral.seguimiento VALUES(53, $per, $idUnidad, $idEnlace, $anio, $p53m1, $p53m2, $p53m3, GETDATE() )
                              INSERT INTO trimestral.seguimiento VALUES(54, $per, $idUnidad, $idEnlace, $anio, $p54m1, $p54m2, $p54m3, GETDATE() )
                              INSERT INTO trimestral.seguimiento VALUES(55, $per, $idUnidad, $idEnlace, $anio, $p55m1, $p55m2, $p55m3, GETDATE() )
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