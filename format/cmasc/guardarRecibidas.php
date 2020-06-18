<?php

      header('Content-Type: text/html; charset=utf-8');
      include("../../funciones.php");
      include ("../../Conexiones/Conexion.php");
        
      if (isset($_POST["mes"])){ $mes = $_POST["mes"]; }
      if (isset($_POST["anio"])){ $anio = $_POST["anio"]; }
      if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }
      

      ///// VARIABLES A ACTAULIZAR //////


      if (isset($_POST["taRec"])){ $taRec = $_POST["taRec"]; }   
      if (isset($_POST["atOrdi"])){ $atOrdi = $_POST["atOrdi"]; }
      if (isset($_POST["atRepro"])){ $atRepro = $_POST["atRepro"]; }
       if (isset($_POST["uiOrdi"])){ $uiOrdi = $_POST["uiOrdi"]; }       
       if (isset($_POST["uiRepro"])){ $uiRepro = $_POST["uiRepro"];        }       
       if (isset($_POST["feaaiOrdi"])){ $feaaiOrdi = $_POST["feaaiOrdi"]; }
       if (isset($_POST["feaaiRepro"])){ $feaaiRepro = $_POST["feaaiRepro"]; }
       if (isset($_POST["feavfgOrdi"])){ $feavfgOrdi = $_POST["feavfgOrdi"]; }
       if (isset($_POST["feavfgRepro"])){ $feavfgRepro = $_POST["feavfgRepro"]; }
       if (isset($_POST["aicOrdi"])){ $aicOrdi = $_POST["aicOrdi"]; }
       if (isset($_POST["aicRepro"])){ $aicRepro = $_POST["aicRepro"]; }





       if (isset($_POST["procedentes"])){ $procedentes = $_POST["procedentes"]; }
       if (isset($_POST["desechadas"])){ $desechadas = $_POST["desechadas"]; }
       if (isset($_POST["svhom"])){ $svhom = $_POST["svhom"]; }
       if (isset($_POST["svmuj"])){ $svmuj = $_POST["svmuj"]; }
       if (isset($_POST["sihom"])){ $sihom = $_POST["sihom"]; }
       if (isset($_POST["simuj"])){ $simuj = $_POST["simuj"]; }
       if (isset($_POST["numInvRec"])){ $numInvRec = $_POST["numInvRec"]; }


          ///// VARIABLES A ACTAULIZAR //////

      ////// HACER CONSULTA PARA SABER SI YA EXISTE ////////  

      $query = "SELECT idCmascRecibidas, mes, anio, fechaCaptura  FROM cmascRecibidas WHERE idEnlace = $idEnlace AND mes = $mes AND anio = $anio";
    

      $stmt = sqlsrv_query(  $conn, $query,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));

      $row_count = sqlsrv_num_rows( $stmt );

      if($row_count > 0){


                  $indice = 0;
                 
                  while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC )){
                    $arreglo[$indice][0]=$row['idCmascRecibidas'];
                    $indice++;
                  }

                  $idCmascRecibidas = $arreglo[0][0]; 

                   $queryTransaction = "  

                    BEGIN                     
                    BEGIN TRY 
                      BEGIN TRANSACTION
                          SET NOCOUNT ON

                            UPDATE cmascRecibidas SET fechaCaptura = GETDATE(), existenciaAnterior = $taRec, atOrdinario = $atOrdi, atReproceso = $atRepro, uiOrdinario = $uiOrdi, uiReproceso = $uiRepro, daiOrdinario = $feaaiOrdi,
                            daiReproceso = $feaaiRepro, dvfgOrdinario = $feavfgOrdi, dvfgReproceso = $feavfgRepro, aicOrdinario = $aicOrdi, aicReproceso = $aicRepro, tsrProcedentes = $procedentes, tsrDesechadas = $desechadas, 
                            tsaVhombres = $svhom, tsaVmujeres = $svmuj, tsaIhombres = $sihom, tsaImujeres = $simuj, invitacionesRecibidas = $numInvRec WHERE idCmascRecibidas = $idCmascRecibidas

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
      else{

                  $queryTransaction = "  

                    BEGIN                     
                    BEGIN TRY 
                      BEGIN TRANSACTION
                          SET NOCOUNT ON

                              
                               INSERT INTO cmascRecibidas VALUES($idEnlace, $mes, $anio, GETDATE(), $taRec,$atOrdi,$atRepro,$uiOrdi,$uiRepro,$feaaiOrdi,$feaaiRepro,$feavfgOrdi,$feavfgRepro,$aicOrdi,$aicRepro,$procedentes,$desechadas,$svhom,$svmuj, $sihom, $simuj, $numInvRec) 


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
