<?php

      header('Content-Type: text/html; charset=utf-8');
      include("../funciones.php");
      include ("../Conexiones/Conexion.php");

    
      if (isset($_POST["nameMpAdd"])){ $nameMpAdd = $_POST["nameMpAdd"]; }
      if (isset($_POST["paternoMpAdd"])){ $paternoMpAdd = $_POST["paternoMpAdd"]; }
      if (isset($_POST["maternoMpAdd"])){ $maternoMpAdd = $_POST["maternoMpAdd"]; }
       

               $queryTransaction = "
                    BEGIN                     
                    BEGIN TRY 
                      BEGIN TRANSACTION
                          SET NOCOUNT ON                                    
                                    INSERT INTO mp VALUES('$nameMpAdd', '$paternoMpAdd', '$maternoMpAdd',0,0,'VI')
                              COMMIT
                    END TRY
                    BEGIN CATCH 
                          ROLLBACK TRANSACTION
                          RAISERROR('No se realizo la transaccion',16,1)
                    END CATCH
                    END
                  ";  

                  //echo $queryTransaction;
     
                  $result = sqlsrv_query($conn,$queryTransaction, array(), array( "Scrollable" => 'static' ));

                  $arreglo[0] = "NO";
                  $arreglo[1] = "SI";
                  

                  if ($result) {

                    echo json_encode(array('first'=>$arreglo[1]));

                  }else{
                    echo json_encode(array('first'=>$arreglo[0]));
                    
                  }                   

?>