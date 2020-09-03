<?php
header('Content-Type: text/html; charset=utf-8');
include("../../funciones.php");
include ("../../Conexiones/Conexion.php");

     

if (isset($_POST['idPers'])){ $idPers = $_POST['idPers']; }
if (isset($_POST['arrDelitosAct'])){ $arrDelitosAct = $_POST['arrDelitosAct']; }

$query = "SELECT COUNT(*) AS TOTAL FROM pueDisposi.DelitosPorPersona WHERE idPersona = $idPers AND idCatDelito = $arrDelitosAct";
$indice = 0;
$stmt = sqlsrv_query($conn, $query);
while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
  {
    $arreglo[$indice][0]=$row['TOTAL'];
    $indice++;
  }  
  $delitoExiste = $arreglo[0][0];

if($delitoExiste == 0){
          
                   $queryTransaction = "  

                    BEGIN                     
                    BEGIN TRY 
                      BEGIN TRANSACTION
                          SET NOCOUNT ON

                                            INSERT INTO pueDisposi.DelitosPorPersona (idPersona , idCatDelito) 
                                              VALUES($idPers , $arrDelitosAct)


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
                  
                  $var = 5;

                  if ($result) {

                    echo json_encode(array('first'=>$arreglo[1]));

                  }else{
                    echo json_encode(array('first'=>$arreglo[0]));
                    
                  }                   
}else{
  echo json_encode(array('first'=>"NO"));
}


?>