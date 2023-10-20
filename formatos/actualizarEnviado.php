<?php

	include ("../Conexiones/Conexion.php");
	include("../funciones.php");

	if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }
  if (isset($_POST["format"])){ $format = $_POST["format"]; }
	

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

                  $arreglo[0] = "NO";
                  $arreglo[1] = "SI";

       

                  if ($result) {
                    echo json_encode(array('first'=>$arreglo[1]));
                  }else{
                    echo json_encode(array('first'=>$arreglo[0]));
                  }





?>