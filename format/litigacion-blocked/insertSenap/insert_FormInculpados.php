<?php

header('Content-Type: text/html; charset=utf-8');
include ("../../../Conexiones/Conexion.php");



/*DATOS GENERALES*/
if (isset($_POST['idEstatusNucs'])){ $idEstatusNucs = $_POST['idEstatusNucs']; }
if (isset($_POST['nuc'])){ $nuc = $_POST['nuc']; }


/*DATOS FORMULARIO SENAP*/
if (isset($_POST['nombre_imputado'])){ $nombre_imputado = $_POST['nombre_imputado']; }   
if (isset($_POST['apellido_paterno'])){ $apellido_paterno = $_POST['apellido_paterno']; } 
if (isset($_POST['apellido_materno'])){ $apellido_materno = $_POST['apellido_materno']; } 
if (isset($_POST['edad'])){ $edad = $_POST['edad']; }   
if (isset($_POST['id_sexo'])){ $id_sexo = $_POST['id_sexo']; } 
if (isset($_POST['imputado_id'])){ $imputado_id = $_POST['imputado_id']; } 


if (isset($_POST['opcInsert'])){ $opcInsert = $_POST['opcInsert']; } 

//Si opcInsert == 0 es un nuevo registro, si opcInsert == 1 es una edicion de registro
if($opcInsert == 0){

  $queryTransaction = " 
                        BEGIN                     
                              BEGIN TRY 
                                BEGIN TRANSACTION
                                      SET NOCOUNT ON 

                                        INSERT INTO senap.imputados (idEstatusNucs, nombre, apellido_paterno, apellido_materno, edad, sexo) 
                                        VALUES('$idEstatusNucs', '$nombre_imputado' , '$apellido_paterno' , '$apellido_materno' , $edad, '$id_sexo')
                                                  
                                      COMMIT
                              END TRY
                              BEGIN CATCH 
                                    ROLLBACK TRANSACTION
                                    RAISERROR('No se realizo la transaccion',16,1)
                              END CATCH
                              END
                        ";
}else{
  $queryTransaction = " 
                        BEGIN                     
                              BEGIN TRY 
                                BEGIN TRANSACTION
                                      SET NOCOUNT ON 

                                        UPDATE senap.imputados SET 
                                        nombre = '$nombre_imputado',
                                        apellido_paterno = '$apellido_paterno',
                                        apellido_materno = '$apellido_materno',
                                        edad = $edad,
                                        sexo = '$id_sexo'
                                        WHERE imputado_id = $imputado_id ;
                                                  
                                      COMMIT
                              END TRY
                              BEGIN CATCH 
                                    ROLLBACK TRANSACTION
                                    RAISERROR('No se realizo la transaccion',16,1)
                              END CATCH
                              END
                        ";
}

 $result = sqlsrv_query($conn,$queryTransaction, array(), array( "Scrollable" => 'static' ));
 $arreglo[0] = "NO";
 $arreglo[1] = "SI";

 if($result){
  $d = array('first' => $arreglo[1]);
  echo json_encode($d);
 }else{
  echo json_encode(array('first'=>$arreglo[0])); //Si no se realizo la transacción devolver 0 para indicar mensaje de alerta
 }

