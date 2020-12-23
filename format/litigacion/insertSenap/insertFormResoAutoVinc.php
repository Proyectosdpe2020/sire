<?php

header('Content-Type: text/html; charset=utf-8');
include ("../../../Conexiones/Conexion.php");



/*DATOS GENERALES*/
if (isset($_POST['idResolMP'])){ $idResolMP = $_POST['idResolMP']; }
if (isset($_POST['idMp'])){ $idMp = $_POST['idMp']; } 
if (isset($_POST['anio'])){ $anio = $_POST['anio']; } 
if (isset($_POST['mes'])){ $mes = $_POST['mes']; } 
if (isset($_POST['estatus'])){ $estatus = $_POST['estatus']; } 
if (isset($_POST['nuc'])){ $nuc = $_POST['nuc']; } 
if (isset($_POST['idUnidad'])){ $idUnidad = $_POST['idUnidad']; } 

/*DATOS FORMULARIO SENAP*/
if (isset($_POST['resolAutoVincu'])){ $resolAutoVincu = $_POST['resolAutoVincu']; } 
if (isset($_POST['fechaAutoVinculacion'])){ $fechaAutoVinculacion = $_POST['fechaAutoVinculacion']; } 

//Verificamos si ya hay registro del NUC en la tabla de litigacion senap para sacar el id
$query = "SELECT * FROM senap.litigacionSenap WHERE NUC = '$nuc' "; 
$stmt = sqlsrv_query($conn, $query,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
$row_count = sqlsrv_num_rows( $stmt );
while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC )){
  $idLitiSenap = $row['idLitiSenap'];
}

//Si no encuentra el nuc en la base de datos de Litigacion senap, se inserta nuevo registro en la tabla, de lo contrario se hace un update sobe la misma
if($row_count == 0){
 $queryTransaction = " 
                      BEGIN                     
                            BEGIN TRY 
                              BEGIN TRANSACTION
                                    SET NOCOUNT ON 

                                      INSERT INTO senap.litigacionSenap (resolucionID, NUC, anio, mes, estatus, idUnidad, idResolAutoVinculacion, fechaAutoVinculacion) 
                                      VALUES('$idResolMP', '$nuc', $anio, $mes, $estatus, $idUnidad, $resolAutoVincu, '$fechaAutoVinculacion')
                                                
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
 if($result){
  $d = array('first' => $arreglo[1]);
  echo json_encode($d);
 }else{
  echo json_encode(array('first'=>$arreglo[0])); //Si no se realizo la transacción devolver 0 para indicar mensaje de alerta
 }
}else{
 $queryTransaction = " 
                    BEGIN                     
                    BEGIN TRY 
                      BEGIN TRANSACTION
                          SET NOCOUNT ON    

                             UPDATE senap.litigacionSenap SET resolucionID = $idResolMP, idResolAutoVinculacion = $resolAutoVincu, fechaAutoVinculacion = '$fechaAutoVinculacion' WHERE idLitiSenap = $idLitiSenap
                                           
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
 if($result){
  $d = array('first' => $arreglo[1]);
  echo json_encode($d);
 }else{
  echo json_encode(array('first'=>$arreglo[0])); //Si no se realizo la transacción devolver 0 para indicar mensaje de alerta
 }
}
 
