<?php

header('Content-Type: text/html; charset=utf-8');
include ("../../Conexiones/Conexion.php");




if (isset($_POST['idEstatusNucs'])){ $idEstatusNucs = $_POST['idEstatusNucsndo']; } 


//Si $flag == 1 -> indica el registro de un nuevo mando ya que el $idMando recibido fue 0
if($flag != 1){
 $queryTransaction = " 
                      BEGIN                     
                            BEGIN TRY 
                              BEGIN TRANSACTION
                                    SET NOCOUNT ON 

                                      declare @insertado int

                                      INSERT INTO pueDisposi.mando (nombre, paterno, materno, idCargo, idFuncion, idAreaAdscripcion, estatus, sexo, idFiscalia, idSeccion, comisionado, fechaAlta) 
                                      VALUES('$data[0]', '$data[1]', '$data[2]', $data[4], $data[5], $data[7], 'BA', $data[3], $data[6], $data[8], 
                                      $data[9], '$data[10]')

                                      select @insertado = @@IDENTITY

                                      INSERT INTO estadoFuerza.domicilio (idMando, domicilio, lugarOrigen, ciudad, estadoProvincia, codigoPostal, telefono) VALUES(@insertado, '$domicilio', '$lugarOrigen', '$ciudad', '$estadoProvincia', $codigoPostal, $numTelefono)

                                      SELECT MAX(idMando) AS idMando FROM pueDisposi.mando
                                                
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
  while ($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC )){
   $getLastIdMando = $row['idMando']; //Obtenemos el id del ultimo mando ingresado en la transaccion anterior
  }
  $arreglo[2] = $getLastIdMando;
  $d = array('first' => $arreglo[1] , 'idLastMando' => $arreglo[2]);
  echo json_encode($d);

  //GUARDAMOS LA IMAGEN EN LA BASE DE DATOS Y LA MOVEMOS DE LA CARPETA TMP A FOTOGRAFIAS
  session_start();
  if(isset($_SESSION['tmp_path'])){
   $_SESSION['tmp_path'];
   $_SESSION['nombre_imagen'];
   $extension = end(explode('.', $_SESSION['nombre_imagen']));
   $carpeta_destino = 'fotografias/';

   if( copy($_SESSION['tmp_path'], $carpeta_destino.$getLastIdMando.".".$extension) ){
    $insertFoto = "INSERT INTO estadoFuerza.fotografias (idMando, foto) VALUES($getLastIdMando, '$getLastIdMando.$extension')"; 
    $resultInsertF = sqlsrv_query($conn, $insertFoto, array(), array( "Scrollable" => 'static' ));
    unlink($_SESSION['tmp_path']);
    unset($_SESSION['tmp_path']);
    unset($_SESSION['nombre_imagen']);
   }
  }
 }else{
  echo json_encode(array('first'=>$arreglo[0])); //Si no se realizo la transacción devolver 0 para indicar mensaje de alerta
 }
}
 
