<? 
			include ("../../../Conexiones/Conexion.php");
			include("../../../funcioneTrimes.php");

			if (isset($_GET["anio"])){ $anio = $_GET["anio"]; }
			if (isset($_GET["format"])){ $format = $_GET["format"]; }
			if (isset($_GET["idEnlace"])){ $idEnlace = $_GET["idEnlace"]; }
   if (isset($_GET["per"])){ $per = $_GET["per"]; }
   if (isset($_GET["idUnidad"])){ $idUnidad = $_GET["idUnidad"]; }



    $arrQue1 = array(1, 2); $validaQuest1 = validaQuest($conn, $arrQue1, $per, $anio, $idUnidad);
    $arrQue2 = array(3, 4); $validaQuest2 = validaQuest($conn, $arrQue2, $per, $anio, $idUnidad);
    $arrQue3 = array(5, 6, 7); $validaQuest3 = validaQuest($conn, $arrQue3, $per, $anio, $idUnidad);
    $arrQue4 = array(8, 9); $validaQuest4 = validaQuest($conn, $arrQue4, $per, $anio, $idUnidad);    
    $arrQue5 = array(10, 11, 12, 13, 14); $validaQuest5 = validaQuest($conn, $arrQue5, $per, $anio, $idUnidad);
    $arrQue6 = array(15,16,17); $validaQuest6 = validaQuest($conn, $arrQue6, $per, $anio, $idUnidad);
    $arrQue7 = array(18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33); $validaQuest7 = validaQuest($conn, $arrQue7, $per, $anio, $idUnidad);
    $arrQue8 = array(34,35,36,37,38,39,40,41,42,43,44,45,46,47); $validaQuest8 = validaQuest($conn, $arrQue8, $per, $anio, $idUnidad);
    $arrQue9 = array(48,49,50,51); $validaQuest9 = validaQuest($conn, $arrQue9, $per, $anio, $idUnidad);
    $arrQue10 = array(52,53,54,55); $validaQuest10 = validaQuest($conn, $arrQue10, $per, $anio, $idUnidad);

    $arreglo[0] = "NO";
    $arreglo[1] = "SI";

    if($validaQuest1 == 1 && $validaQuest2 == 1 && $validaQuest3 == 1 && $validaQuest4 == 1 && $validaQuest5 == 1 && $validaQuest6 == 1 && $validaQuest7 == 1 && $validaQuest8 == 1 && $validaQuest9 == 1 && $validaQuest10 == 1){


         $queryTransaction = "  

                    BEGIN 
                    
                    BEGIN TRY 
                      BEGIN TRANSACTION

                          SET NOCOUNT ON
                                      UPDATE enlaceMesValidaEnviado SET enviado = 1 WHERE idEnlace = $idEnlace AND idFormato = $format
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
                    echo json_encode(array('first'=>$arreglo[1]));
                  }else{
                    echo json_encode(array('first'=>$arreglo[0]));
                  }


    }else{


          echo json_encode(array('first'=>$arreglo[0]));

    }
         

         
     

                  

                  
	
?>