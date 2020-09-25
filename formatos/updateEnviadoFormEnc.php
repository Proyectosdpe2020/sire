
	<?php
	session_start();
	include ("../Conexiones/Conexion.php");
	include("../funciones2.php");	
	include ("../Conexiones/conexionSicap.php");
	include("../funcioneSicap.php");

	if (isset($_POST["enviado"])){ $enviado = $_POST["enviado"]; }
	if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }
	if (isset($_POST["f"])){ $f = $_POST["f"]; }

	if($enviado == 0){ $qury = " UPDATE enlaceMesValidaEnviado SET enviado = 1 WHERE idEnlace = $idEnlace AND idFormato = $f "; }
	if($enviado == 1){ $qury = " UPDATE enlaceMesValidaEnviado SET enviado = 0 WHERE idEnlace = $idEnlace AND idFormato = $f "; }

		   if (isset($_POST["idEnMpUnid"])){ $idEnMpUnid = $_POST["idEnMpUnid"]; }
       

               $queryTransaction = "
                    BEGIN                     
                    BEGIN TRY 
                      BEGIN TRANSACTION
                          SET NOCOUNT ON                                    
                                    $qury;
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

