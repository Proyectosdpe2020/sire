<?php
header('Content-Type: text/html; charset=utf-8');
include ("../../../Conexiones/Conexion.php");
include("../../../funcionesEstadoDeFuerza.php");

if (isset($_GET['idMando'])){ $idMando = $_GET['idMando']; } 
if (isset($_GET['flag'])){ $flag = $_GET['flag']; }

if (isset($_GET['nombre'])){ $nombre = $_GET['nombre']; }
if (isset($_GET['ap_paterno'])){ $ap_paterno = $_GET['ap_paterno']; }
if (isset($_GET['ap_materno'])){ $ap_materno = $_GET['ap_materno']; }
if (isset($_GET['idCargo'])){ $idCargo = $_GET['idCargo']; }
if (isset($_GET['idFuncion'])){ $idFuncion = $_GET['idFuncion']; }
if (isset($_GET['idAreaAdscripcion'])){ $idAreaAdscripcion = $_GET['idAreaAdscripcion']; }
if (isset($_GET['estatusMando'])){ $estatusMando = $_GET['estatusMando']; } 

if($flag != 1){
 $queryTransaction = " 
                      BEGIN                     
                            BEGIN TRY 
                              BEGIN TRANSACTION
                                    SET NOCOUNT ON 

                                      INSERT INTO pueDisposi.mando (nombre, paterno, materno, idCargo, idFuncion, idAreaAdscripcion, estatus) 
                                              VALUES('$nombre', '$ap_paterno', '$ap_materno', $idCargo, $idFuncion, $idAreaAdscripcion, 'VI')
                                                
                                    COMMIT
                            END TRY
                            BEGIN CATCH 
                                  ROLLBACK TRANSACTION
                                  RAISERROR('No se realizo la transaccion',16,1)
                            END CATCH
                            END
                      ";

 $result = sqlsrv_query($conn,$queryTransaction, array(), array( "Scrollable" => 'static' ));

 $query = " SELECT @@IDENTITY AS ID ";

 $stmt = sqlsrv_query($conn, $query);
 while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC )){
  $getLastID = $row['ID'];
 }
}else{
 $getLastID = $idMando; 
 $queryTransaction = " 
                      BEGIN                     
                            BEGIN TRY 
                              BEGIN TRANSACTION
                                    SET NOCOUNT ON 

                                      UPDATE pueDisposi.mando SET 
                                             nombre = '$nombre',
                                             paterno = '$ap_paterno',
                                             materno = '$ap_materno',
                                             idCargo = $idCargo, 
                                             idFuncion = $idFuncion,
                                             idAreaAdscripcion = $idAreaAdscripcion, 
                                             estatus = '$estatusMando' 
                                             WHERE idMando = $idMando
                                                
                                  COMMIT
                            END TRY
                            BEGIN CATCH 
                                  ROLLBACK TRANSACTION
                                  RAISERROR('No se realizo la transaccion',16,1)
                            END CATCH
                            END
                     ";

$result = sqlsrv_query($conn,$queryTransaction, array(), array( "Scrollable" => 'static' ));
}


$mandos = getDataMandoTable($conn, $getLastID, 0);
$idMando = $mandos[0][0];
$nombreMando = $mandos[0][1];
$nombre = $mandos[0][2];
$paterno = $mandos[0][3];
$materno = $mandos[0][4];
$cargo  = $mandos[0][5];
$funcion  = $mandos[0][6];
$areadscri  = $mandos[0][7];
$estatus  = $mandos[0][11];

?>

<td class="textCent numMando"></td>
<td><? echo $nombreMando; ?></td>
<td class="textCent"><? echo $cargo; ?></td>
<td class="textCent"><? echo $funcion; ?></td>
<td class="textCent"><? echo $areadscri; ?></td>
<td class="textCent"><? echo $estatus; ?></td>
<td class="textCent"><center><label class="glyphicon glyphicon-edit" data-toggle="modal" href="#puestdispos" 
 onclick="showModalEditarMando(<? echo $idMando; ?>)" style="width: 95%; cursor: pointer; font-weight: bold; color: green;"> Editar </label></center></td>
