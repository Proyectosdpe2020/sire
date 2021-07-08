<?php

header('Content-Type: text/html; charset=utf-8');
include ("../../../Conexiones/Conexion.php");



/*DATOS GENERALES*/
if (isset($_POST['idEstatusNucs'])){ $idEstatusNucs = $_POST['idEstatusNucs']; }
if (isset($_POST['nuc'])){ $nuc = $_POST['nuc']; }
if (isset($_POST['mes'])){ $mes = $_POST['mes']; }
if (isset($_POST['idMp'])){ $idMp = $_POST['idMp']; }
if (isset($_POST['anio'])){ $anio = $_POST['anio']; }


/*DATOS FORMULARIO SENAP*/
if (isset($_POST['masculino'])){ $masculino = $_POST['masculino']; } 
if (isset($_POST['femenino'])){ $femenino = $_POST['femenino']; }  
if (isset($_POST['moral'])){ $moral = $_POST['moral']; }  
if (isset($_POST['desconocido'])){ $desconocido = $_POST['desconocido']; } 

if (isset($_POST['opcInsert'])){ $opcInsert = $_POST['opcInsert']; } 

//Si opcInsert == 0 es un nuevo registro, si opcInsert == 1 es una edicion de registro
if($opcInsert == 0){

  $queryTransaction = " 
                        BEGIN                     
                              BEGIN TRY 
                                BEGIN TRANSACTION
                                      SET NOCOUNT ON 

                                        INSERT INTO medidasDeProteccion (idEstatusNucs, nuc, masculino, femenino, moral, desconocido) 
                                        VALUES('$idEstatusNucs', '$nuc', $masculino, $femenino, $moral, $desconocido)
                                                  
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

                                        UPDATE medidasDeProteccion SET 
                                        masculino = $masculino,
                                        femenino = $femenino,
                                        moral = $moral,
                                        desconocido = $desconocido
                                        WHERE idEstatusNucs = '$idEstatusNucs' ;
                                                  
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
//Obtenbemos el total de victimas con medidas de proteccion del MP para actualizar el campo.
 if($result){
   $query = "SELECT COALESCE(SUM(medPro.masculino),0) + COALESCE(SUM(medPro.femenino),0) + COALESCE(SUM(medPro.moral),0) + 
                   COALESCE(SUM(medPro.desconocido),0) AS totalVictimas
            FROM estatusNucs estNuc
            LEFT JOIN medidasDeProteccion medPro ON medPro.idEstatusNucs = estNuc.idEstatusNucs
            where estNuc.idEstatus = 129 and estNuc.mes = $mes and estNuc.idMp = $idMp and estNuc.anio = $anio"; 
 $indice = 0;
 $stmt = sqlsrv_query($conn, $query);
 while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
 {
   $total = $row['totalVictimas'];
 } 
 $arreglo[2] = $total;
  $d = array('first' => $arreglo[1] , 'victimas' => $arreglo[2]);
  echo json_encode($d);
 }else{
  echo json_encode(array('first'=>$arreglo[0])); //Si no se realizo la transacción devolver 0 para indicar mensaje de alerta
 }

