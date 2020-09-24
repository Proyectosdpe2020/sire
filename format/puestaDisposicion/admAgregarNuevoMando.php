<?php
header('Content-Type: text/html; charset=utf-8');
include("../../funciones.php");
include ("../../Conexiones/Conexion.php");
include("../../funcionesPueDispo.php");

if (isset($_POST['getNombreMando'])){ $getNombreMando = $_POST['getNombreMando']; }
if (isset($_POST['getApPaterno'])){ $getApPaterno = $_POST['getApPaterno']; }
if (isset($_POST['getApMaterno'])){ $getApMaterno = $_POST['getApMaterno']; }
if (isset($_POST['idCargo'])){ $idCargo = $_POST['idCargo']; }
if (isset($_POST['idFuncion'])){ $idFuncion = $_POST['idFuncion']; }
if (isset($_POST['idAreaAdscripcion'])){ $idAreaAdscripcion = $_POST['idAreaAdscripcion']; }

$queryTransaction = " 
                    BEGIN                     
                          BEGIN TRY 
                            BEGIN TRANSACTION
                                  SET NOCOUNT ON 

                                    INSERT INTO pueDisposi.mando (nombre, paterno, materno, idCargo, idFuncion, idAreaAdscripcion, estatus) 
                                              VALUES('$getNombreMando', '$getApPaterno', '$getApMaterno', $idCargo, $idFuncion, $idAreaAdscripcion, 'VI')
                                              
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

$mandos = getDataMandoTableAdm($conn, $getLastID, 0);
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
