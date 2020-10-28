<?php
header('Content-Type: text/html; charset=utf-8');
include ("../../../Conexiones/Conexion.php");

if (isset($_GET['verOedita'])){ $verOedita = $_GET['verOedita']; }
if (isset($_GET['idForestales'])){ $idForestales = $_GET['idForestales']; }

if (isset($_GET['anioCapturando'])){ $anioCapturando = $_GET['anioCapturando']; }
if (isset($_GET['mesCapturando'])){ $mesCapturando = $_GET['mesCapturando']; }
$diaActual = date("d");
$fecha = $diaActual.'/'.$mesCapturando.'/'.$anioCapturando;


if (isset($_GET['maderaVol'])){ $maderaVol = $_GET['maderaVol']; } 
if (isset($_GET['vehiculos'])){ $vehiculos = $_GET['vehiculos']; }
if (isset($_GET['gruas'])){ $gruas = $_GET['gruas']; }
if (isset($_GET['motosierras'])){ $motosierras = $_GET['motosierras']; }
if (isset($_GET['radios'])){ $radios = $_GET['radios']; }
if (isset($_GET['herramientas'])){ $herramientas = $_GET['herramientas']; }
if (isset($_GET['armas'])){ $armas = $_GET['armas']; }
if (isset($_GET['celulares'])){ $celulares = $_GET['celulares']; }
if (isset($_GET['detenidos'])){ $detenidos = $_GET['detenidos']; }
if (isset($_GET['perApoyFis'])){ $perApoyFis = $_GET['perApoyFis']; }
if (isset($_GET['perApoyAgFor'])){ $perApoyAgFor = $_GET['perApoyAgFor']; }
if (isset($_GET['averiOcarpe'])){ $averiOcarpe = $_GET['averiOcarpe']; }
if (isset($_GET['locaCumplidas'])){ $locaCumplidas = $_GET['locaCumplidas']; }
if (isset($_GET['invAtendidas'])){ $invAtendidas = $_GET['invAtendidas']; }
if (isset($_GET['recorridos'])){ $recorridos = $_GET['recorridos']; }
if (isset($_GET['operativos'])){ $operativos = $_GET['operativos']; }

//0: Registro Nuevo 1: Editar
if($verOedita == 0) {
 $queryTransaction = " 
                      BEGIN                     
                       BEGIN TRY 
                         BEGIN TRANSACTION
                             SET NOCOUNT ON

                                INSERT INTO dbo.Forestales VALUES('$fecha', $mesCapturando, $anioCapturando, $maderaVol, $vehiculos, $gruas, $motosierras,
                                 $radios, $herramientas, $armas, $celulares, $detenidos, $perApoyFis, $perApoyAgFor, $averiOcarpe, $locaCumplidas, 
                                 $invAtendidas, $recorridos, $operativos)

                                UPDATE dbo.enlaceMesValidaEnviado SET enviado = 1, enviadoArchivo = 1 WHERE idEnlaceMesValidaEnviados = 195 AND idFormato = 14;

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
                    $d = array('first' => $arreglo[1]);
                    echo json_encode($d);
                   }else{
                    echo json_encode(array('first'=>$arreglo[0]));
                   }
}else{
 $queryTransaction = " 
                      BEGIN                     
                       BEGIN TRY 
                         BEGIN TRANSACTION
                             SET NOCOUNT ON

                                UPDATE dbo.Forestales SET madera = $maderaVol, 
                                                          vehiculos = $vehiculos,
                                                          gruasForestales = $gruas,
                                                          motosierras = $motosierras,
                                                          radios = $radios,
                                                          herramientas = $herramientas,
                                                          armasFuego = $armas,
                                                          celulares = $celulares,
                                                          detenidos = $detenidos,
                                                          peritajesUnidadForestales = $perApoyFis,
                                                          peritajesUnidadesForaneas = $perApoyAgFor,
                                                          averiguacionesoCarpetas = $averiOcarpe,
                                                          localizacionesCumplidas = $locaCumplidas,
                                                          investigacionesCumplidas = $invAtendidas,
                                                          recorridosVigilancia = $recorridos,
                                                          operativos = $operativos
                                WHERE idForestales = $idForestales;

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
                    $d = array('first' => $arreglo[1]);
                    echo json_encode($d);
                   }else{
                    echo json_encode(array('first'=>$arreglo[0]));
                   }
}
?>