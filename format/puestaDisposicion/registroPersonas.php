<?php
header('Content-Type: text/html; charset=utf-8');
include("../../funciones.php");
include ("../../Conexiones/Conexion.php");

   if (isset($_POST["jObject"])){ 

               $data = json_decode($_POST['jObject'], true);
               $fechaevento=$data[2];
               $fechaevento=str_ireplace("'",'',$fechaevento);
               
          }
    
      $fechaevento=str_ireplace('T',' ',$fechaevento);
      $fechaevento2=":00";
      $fechaevento= $fechaevento.$fechaevento2;

     

      $array_fecha=  explode(' ', $fechaevento,2) ;
      $fechaConvertida=$array_fecha[0].''.$array_fecha[1].''; 
      
      $fechaevento= convierteFecha($array_fecha[0]);
      $fechaevento.=' '.$array_fecha[1]; 

      $fechaevento = "'".$fechaevento."'";


function convierteFecha($fecha){
    $array_fecha=  explode('-', $fecha,3) ;
    $fechaConvertida=$array_fecha[2].'-'.$array_fecha[1].'-'.$array_fecha[0];
    return $fechaConvertida;
    }  
//////////// DATOS DE PUESTA A DISPOSICION /////
if (isset($_POST["idPuestaDisposicion"])){ 
 $idPuestaDisposicion = $_POST["idPuestaDisposicion"]; 
}else{ $idPuestaDisposicion = ""; }
  
  //ELIMINAMOS DELITOS REMETIDOS EN EL ARRAY DE DELITOS
  $getArrayDelitos = json_decode($_POST['arrayDelitos'] , TRUE);
  $getArrayDelitos = array_values( array_unique( $getArrayDelitos, SORT_REGULAR ) );





if (isset($_POST['nombre'])){ $getNombre = $_POST['nombre']; }
if (isset($_POST['ap_paterno'])){ $getAp_paterno = $_POST['ap_paterno']; }
if (isset($_POST['ap_materno'])){ $getAp_materno = $_POST['ap_materno']; }
if (isset($_POST['alias'])){ $getAlias = $_POST['alias']; }
if (isset($_POST['edad'])){ $getEdad = $_POST['edad']; }
if (isset($_POST['sexo'])){ $getSexo = $_POST['sexo']; }
//if (isset($_POST['dia'])){ $getDia = $_POST['dia']; }
//if (isset($_POST['mes'])){ $getMes = $_POST['mes']; }
//if (isset($_POST['anio'])){ $getAnio = $_POST['anio']; }
if (isset($_POST['tipoDelitoId'])){ $getTipoDelitoId= $_POST['tipoDelitoId']; }
if (isset($_POST['seccion'])){ $getSeccion = $_POST['seccion']; }
//if (isset($_POST['delitoCometido'])){ $getDelitoCometido = $_POST['delitoCometido']; }
//if (isset($_POST['bandas'])){ $getBandas = $_POST['bandas']; }
if (isset($_POST['DisposicionDe'])){ $getDisposicion = $_POST['DisposicionDe']; }
//if (isset($_POST['orgCriminal'])){ $getOrgCriminal = $_POST['orgCriminal']; }
//if (isset($_POST['agraviado'])){ $getAgraviado = $_POST['agraviado']; }
if (isset($_POST['inv_flag'])){ $getInv_flag = $_POST['inv_flag']; }
if (isset($_POST['banda_solitario'])){ $getBanda_solitario = $_POST['banda_solitario']; }
//if (isset($_POST['AvPP'])){ $getAvvPP = $_POST['AvPP']; }
//if (isset($_POST['numBas'])){ $getNumBas = $_POST['numBas']; }
if (isset($_POST['requerido'])){ $getRequerido = $_POST['requerido']; }
if (isset($_POST['oficio'])){ $getOficio = $_POST['oficio']; }
if (isset($_POST['observaciones'])){ $getObservaciones = $_POST['observaciones']; }
if (isset($_POST['idEnlace'])){ $idEnlace = $_POST['idEnlace']; }

if (isset($_POST["newColoni_id"])){ $newColoni_id = $_POST["newColoni_id"]; }
       if (isset($_POST["newMunic_id"])){ $newMunic_id = $_POST["newMunic_id"]; }
       if (isset($_POST["newFisca_id"])){ $newFisca_id = $_POST["newFisca_id"]; }


$getDelitosId = 3;
$getmExt = "Nacional";
$getObjAsegurados = "Armas";
$getMonedaNal = 500;

////TIPO DE ACTUALIZACION Y ID PERSONA////
if (isset($_POST['tipoActualizacion'])){ $tipoActualizacion = $_POST['tipoActualizacion']; }
if (isset($_POST['idPersona'])){ $idPersona = $_POST['idPersona']; }


if($data[10] == false){ $data[10] = 0; }else{ $data[10] = 1; }
if($data[11] == false){ $data[11] = 0; }else{ $data[11] = 1; }
if($data[12] == false){ $data[12] = 0; }else{ $data[12] = 1; }
if($data[13] == false){ $data[13] = 0; }else{ $data[13] = 1; }
if($data[14] == false){ $data[14] = 0; }else{ $data[14] = 1; }  



if($data[8] == ""){ $data[8]=0;}


/// DATA DE DELITOS ///

 if (isset($_POST["idPuestaDisposicion"])){ $idPuestaDisposicion = $_POST["idPuestaDisposicion"]; }else{
              $idPuestaDisposicion = "";
      } 
       if($idPuestaDisposicion == ""){
          
                   $queryTransaction = "  

                    BEGIN                     
                    BEGIN TRY 
                      BEGIN TRANSACTION
                          SET NOCOUNT ON

                                          declare @insertado int

                                         INSERT INTO pueDisposi.puestaDisposicion VALUES($data[0],$data[1],$fechaevento,GETDATE(), $data[7], $data[5], $data[8], $data[4], $data[6], DATEPART(dw, $fechaevento), DATEPART(day, $fechaevento),DATEPART(month, $fechaevento), DATEPART(year, $fechaevento), $data[3], $idEnlace, $data[10], $data[11], $data[12], $data[13], $data[14], '$data[15]' )


                                          select @insertado = @@IDENTITY


                                            INSERT INTO pueDisposi.personasDetenidas (idPuestaDisposicion, nombre , ap_paterno , ap_materno , alias , edad , sexo , idDelitos , idTipoDelito ,   mExt , monedaNal , objAsegurados ,  invFlag , bandaSolit ,  aDispoDe ,  reqOtrasCorpo , oficio , observaciones) 
                                            
                                            VALUES(@insertado, '$getNombre' , '$getAp_paterno' , '$getAp_materno' , '$getAlias' , $getEdad , '$getSexo' , $getDelitosId , $getTipoDelitoId , '$getmExt' , $getMonedaNal , 
                                            '$getObjAsegurados' , $getInv_flag , '$getBanda_solitario'  , 
                                            $getDisposicion , '$getRequerido' , '$getOficio' , 
                                                   '$getObservaciones')


                                             SELECT MAX(idPersonaDetenida) AS id FROM pueDisposi.personasDetenidas
                                             




                              COMMIT
                    END TRY
                    BEGIN CATCH 
                          ROLLBACK TRANSACTION
                          RAISERROR('No se realizo la transaccion',16,1)
                    END CATCH
                    END
                  ";


                
              
                  $result = sqlsrv_query($conn,$queryTransaction, array(), array( "Scrollable" => 'static' )); 

                  $queryPuesta = "SELECT MAX(idPuestaDisposicion) AS idPuesta FROM pueDisposi.puestaDisposicion ";
                  $result2 = sqlsrv_query($conn, $queryPuesta, array(), array( "Scrollable" => 'static' )); 
                


                  

                  $arreglo[0] = "NO";
                  $arreglo[1] = "SI";
                 

                  if ($result) {

                    while ($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC ))
                    {  $id=$row['id'];   }

                    while ($row1 = sqlsrv_fetch_array( $result2, SQLSRV_FETCH_ASSOC ))
                    {  $idP=$row1['idPuesta'];   }

                    $arreglo[2] = $idP;
                     $d = array('first' => $arreglo[1] , 'idpuestaultimo' => $arreglo[2]);                   

                    echo json_encode($d);

                  }else{
                    echo json_encode(array('first'=>$arreglo[0]));
                  }

                   if($getArrayDelitos != 0){
                     if ($id != "") {                  

                      foreach ($getArrayDelitos as $delitos){
                                                        $insertarDelitos = "INSERT INTO pueDisposi.DelitosPorPersona (idPersona , idCatDelito) VALUES($id  ,  $delitos)";
                                                        $res2 = sqlsrv_query($conn, $insertarDelitos, array(), array("Scrollable" => SQLSRV_CURSOR_KEYSET ));
                                                      }  
                       }  
                       }   
   
      }
      else if($idPuestaDisposicion != ""){

              if($tipoActualizacion == 0){
                
                  $queryTransaction = " 
                    BEGIN                     
                    BEGIN TRY 
                      BEGIN TRANSACTION
                            SET NOCOUNT ON    

                                           declare @insertado int 
                                              
                                           INSERT INTO pueDisposi.personasDetenidas (idPuestaDisposicion, nombre , ap_paterno , ap_materno , alias , edad , sexo , idDelitos , idTipoDelito , mExt , monedaNal , objAsegurados , invFlag , bandaSolit , aDispoDe ,  reqOtrasCorpo , oficio , observaciones) 
                                            
                                            VALUES($idPuestaDisposicion, '$getNombre' , '$getAp_paterno' , 
                                                  '$getAp_materno' , '$getAlias' , $getEdad , '$getSexo' , $getDelitosId , $getTipoDelitoId , '$getmExt' , $getMonedaNal , '$getObjAsegurados' ,  $getInv_flag , '$getBanda_solitario' , $getDisposicion , '$getRequerido' , '$getOficio' , 
                                                   '$getObservaciones')

                                              select @insertado = @@IDENTITY 

                                              SELECT MAX(idPersonaDetenida) AS id FROM pueDisposi.personasDetenidas



                          COMMIT
                    END TRY
                    BEGIN CATCH 
                          ROLLBACK TRANSACTION
                          RAISERROR('No se realizo la transaccion',16,1)
                    END CATCH
                    END
                  ";

                    $result = sqlsrv_query($conn,$queryTransaction, array(), array( "Scrollable" => 'static' ));  

                      while ($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC ))
                    {  $id=$row['id'];   }

                    $arreglo[0] = "NO";
                    $arreglo[1] = "SI";
                    $arreglo[2] = $idPuestaDisposicion;

                    $d = array('first' => $arreglo[1] , 'idpuestaultimo' => $arreglo[2]);

                    if ($result) {
                      echo json_encode($d);

                    }else{
                      echo json_encode(array('first'=>$arreglo[0]));
                    }

                    if($getArrayDelitos != 0){
                       if ($id != "") {                  

                      foreach ($getArrayDelitos as $delitos){
                                                        $insertarDelitos = "INSERT INTO pueDisposi.DelitosPorPersona (idPersona , idCatDelito) VALUES($id  ,  $delitos)";
                                                        $res2 = sqlsrv_query($conn, $insertarDelitos, array(), array("Scrollable" => SQLSRV_CURSOR_KEYSET ));
                                                      }  
                       }  
                     }                             

                 }else{
                   $queryTransaction = " 
                    BEGIN                     
                          BEGIN TRY 
                            BEGIN TRANSACTION
                                  SET NOCOUNT ON 

                                    UPDATE pueDisposi.personasDetenidas SET nombre = '$getNombre',
                                          ap_paterno = '$getAp_paterno',
                                          ap_materno = '$getAp_materno',
                                          alias = '$getAlias',
                                          edad = $getEdad,
                                          sexo = '$getSexo',
                                          idDelitos = $getDelitosId,
                                          idTipoDelito = $getTipoDelitoId,
                                          mExt = '$getmExt',
                                          monedaNal = $getMonedaNal,
                                          objAsegurados = '$getObjAsegurados',
                                          invFlag = $getInv_flag,
                                          bandaSolit = '$getBanda_solitario',
                                          aDispoDe = $getDisposicion,
                                          reqOtrasCorpo = '$getRequerido',
                                          oficio = '$getOficio',
                                          observaciones = '$getObservaciones'
                                          WHERE idPersonaDetenida = $idPersona

                                          SELECT MAX(idPersonaDetenida) AS id FROM pueDisposi.personasDetenidas
                                              
                                COMMIT
                          END TRY
                          BEGIN CATCH 
                                ROLLBACK TRANSACTION
                                RAISERROR('No se realizo la transaccion',16,1)
                          END CATCH
                          END
                        ";


                    $result = sqlsrv_query($conn,$queryTransaction, array(), array( "Scrollable" => 'static' ));  

                      while ($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC ))
                    {  $id=$row['id'];   }

                    $arreglo[0] = "NO";
                    $arreglo[1] = "SI";
                    $arreglo[2] = $idPuestaDisposicion;

                    $d = array('first' => $arreglo[1] , 'idpuestaultimo' => $arreglo[2]);

                    if ($result) {
                      echo json_encode($d);

                    }else{
                      echo json_encode(array('first'=>$arreglo[0]));
                    }
/*
                  $indiceARR1 = 0; 
                  foreach ($getArrayDelitos as $delitos){

                  } 


                    $insertarDelitos = "UPDATE pueDisposi.DelitosPorPersona  SET idCatDelito =  $delitos WHERE id = ";
                    $res2 = sqlsrv_query($conn, $insertarDelitos, array(), array("Scrollable" => SQLSRV_CURSOR_KEYSET ));
                    $consultaDelitos = "SELECT * FROM pueDisposi.DelitosPorPersona WHERE idPersona = $idPersona";
                    $indice = 0;
                    $stmt = sqlsrv_query($conn, $consultaDelitos);
                    while ($row1 = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC )) 
                    {
                     $arreglo1[$indice][0]=$row1['id'];
                     }  
                      $indice++;
                     }
 */      
                 }

                  

      }




      





?>