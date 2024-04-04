<?php
header('Content-Type: text/html; charset=utf-8');
include("../../../Conexiones/Conexion.php");
include("../../../Conexiones/conexionSIMAJ.php");
include("../../../funcionesMandamientos.php");

//////////// ID DE LA MEDIDA DE PROTECCION/////
if (isset($_POST["ID_MANDAMIENTO_INTERNO"])){
 if($_POST["ID_MANDAMIENTO_INTERNO"] != 0) {
  $ID_MANDAMIENTO_INTERNO = $_POST["ID_MANDAMIENTO_INTERNO"];
  //$puestaData = get_data_puesta($conn, $idMedidaProteccion);

if (isset($_POST['idEnlace'])){ $idEnlace = $_POST['idEnlace']; }
if (isset($_POST['fraccion'])){ $fraccion = $_POST['fraccion']; }
if (isset($_POST['tipoActualizacion'])){ $tipoActualizacion = $_POST['tipoActualizacion']; }

if (isset($_POST['idUnidad'])){ $idUnidad = $_POST['idUnidad']; }
if (isset($_POST['idfisca'])){ $idfisca = $_POST['idfisca']; }

  $getFile = getFileFromMAndamiento($conn, $ID_MANDAMIENTO_INTERNO);


  $idArchivoAct = intval($getFile[0][2]);


  if(isset($_FILES['archivo0'])) {
    $nombreArchivo = $_FILES['archivo0']['name'];
    $ubicacion = 'documentos/';
    $nombreReporte = "Mandamiento_".$ID_MANDAMIENTO_INTERNO."_".$idEnlace."_".$idUnidad.".pdf";
    $nuevoname = formatearNombreMandamiento($nombreReporte);
    $destino = $ubicacion.$nuevoname;

    $temporal = $_FILES['archivo0']['tmp_name'];
    $fileSize = $_FILES['archivo0']['size'];
    $fl = 1; // BANDERA QUE INDICA SI EXISTE ARCHIVO EN EL INPUT, SI ES 1 SE ESTA INTENTANDO SUBIR UN NUEVO ARCHIVO
  } else {
    //echo "No se recibió ningún archivo.";
    $fl = 0; // BANDERA QUE INDICA SI EXISTE ARCHIVO EN EL INPUT, SI ES 0 NO EXISTE ARCHIVO
  }

}else{  
  $ID_MANDAMIENTO_INTERNO = 0;
}
}

$PRUEBAS = true; //VARIABLE PARA REALIZAR PRUEBAS EN EL SISTEMA SIN REPLICAR EN TIEMPO REAL AL SIMAJ, CAMBIAR A false PARA GUARDAR INTERNAMENTE


//SE RECIBE OBJETO ARRAY CON LOS DATOS PRINCIPALES
if (isset($_POST["dataPrincipalArray"]) && $ID_MANDAMIENTO_INTERNO != 0){ 
 $data = json_decode($_POST['dataPrincipalArray'], true); 
}
$FECHA_CAPTURA = $data[1];
$ID_PAIS = $data[2];
$ID_ESTADO_EMISOR = $data[3];
$ID_MUNICIPIO = $data[4];
$ID_EMISOR = $data[5];
$FISCALIA = $data[6];
$ID_TIPO_MANDATO = $data[7];
$NO_MANDATO = $data[8];
$ID_TIPO_PROCESO = $data[9];
$EDO_ORDEN = $data[10];
$FECHA_RECEPCION = $data[11]; 
$FECHA_OFICIO = $data[12];
$ID_TIPO_CUANTIA = $data[13];
$ID_FUERO_PROCESO = $data[14];
$ID_PROCESO_EXTRADI = $data[15];
$ID_ESTADO_JUZGADO = $data[16];
$JUZGADO_COLABORACION = $data[17];
$ID_JUZGADO = $data[18];
$OFICIO_JUZGADO = $data[19];
  //$FECHA_PRESCRIPCION = $data[20];
$NO_CAUSA = $data[21];
$NO_PROCESO = $data[22];
$FECHA_LIBRAMIENTO = $data[23];
$TIPO_INVESTIGACION = $data[24];
$NO_AVERIGUACION = $data[25];
$nuc = $data[26];
$ACUMULADO_PROCESO = $data[27];
$ACUMULADO_AVERIGUACION = $data[28];
$OBSERVACIONES = $data[29];
$OBSERVACIONES_INT = $data[30];
$COLABORACION = $data[31];



if (isset($_POST['idEnlace'])){ $idEnlace = $_POST['idEnlace']; }
if (isset($_POST['fraccion'])){ $fraccion = $_POST['fraccion']; }

//Se recibe el ID_MANDAMIENTO de SIMAJ
if (isset($_POST['ID_MANDAMIENTO'])){ $ID_MANDAMIENTO = $_POST['ID_MANDAMIENTO']; }

if($PRUEBAS == true){
 if($ID_MANDAMIENTO > 0){
  $queryTransaction = "
  BEGIN
  BEGIN TRY
  BEGIN TRANSACTION
  SET NOCOUNT ON

  UPDATE SIMAJ.dbo.A_DATOS_MANDAMIENTOS SET 
  ID_PAIS = $ID_PAIS , 
  ID_ESTADO_EMISOR = $ID_ESTADO_EMISOR , 
  ID_MUNICIPIO = $ID_MUNICIPIO ,
  ID_EMISOR = $ID_EMISOR ,
  FISCALIA = $FISCALIA ,
  ID_TIPO_MANDATO = $ID_TIPO_MANDATO ,
  NO_MANDATO = '$NO_MANDATO' ,
  ID_TIPO_PROCESO = $ID_TIPO_PROCESO ,
  EDO_ORDEN = $EDO_ORDEN ,
  FECHA_RECEPCION = '$FECHA_RECEPCION' ,
  FECHA_OFICIO = '$FECHA_OFICIO' ,
  ID_TIPO_CUANTIA = $ID_TIPO_CUANTIA ,
  ID_FUERO_PROCESO = $ID_FUERO_PROCESO ,
  ID_PROCESO_EXTRADI = $ID_PROCESO_EXTRADI ,
  ID_ESTADO_JUZGADO = $ID_ESTADO_JUZGADO ,
  JUZGADO_COLABORACION = '$JUZGADO_COLABORACION' ,
  ID_JUZGADO = $ID_JUZGADO ,
  OFICIO_JUZGADO = '$OFICIO_JUZGADO' ,
  NO_CAUSA = '$NO_CAUSA' ,
  NO_PROCESO = '$NO_PROCESO' ,
  FECHA_LIBRAMIENTO = '$FECHA_LIBRAMIENTO' ,
  TIPO_INVESTIGACION = $TIPO_INVESTIGACION ,
  NO_AVERIGUACION = '$NO_AVERIGUACION',
  CARPETA_INV = '$nuc' ,
  ACUMULADO_PROCESO = '$ACUMULADO_PROCESO' ,
  ACUMULADO_AVERIGUACION = '$ACUMULADO_AVERIGUACION' ,
  OBSERVACIONES = '$OBSERVACIONES' ,
  OBSERVACIONES_INT = '$OBSERVACIONES_INT' ,
  COLABORACION = $COLABORACION ,
  EstatusDocumentoSire = 0
  WHERE ID_MANDAMIENTO = $ID_MANDAMIENTO

  COMMIT
  END TRY
  BEGIN CATCH
  ROLLBACK TRANSACTION
  RAISERROR('No se realizo la transaccion',16,1)
  END CATCH
  END";
  //echo $queryTransaction;
  $result = sqlsrv_query($connSIMAJ,$queryTransaction, array(), array( "Scrollable" => 'static' )); 
}

// BANDERA QUE INDICA SI EXISTE ARCHIVO EN EL INPUT, SI ES 1 SE ESTA INTENTANDO SUBIR UN NUEVO ARCHIVO
if($fl == 1){
  $queryTransaction_local = "
 BEGIN
 BEGIN TRY
 BEGIN TRANSACTION
 SET NOCOUNT ON

 declare @insertado_file int

 INSERT INTO mandamientos.dbo.M_FILES (NAME_FILE, PATH_FILE, UP_DATE, FILE_SIZE) VALUES ('$nuevoname', '$destino', GETDATE(), $fileSize)
 select @insertado_file = @@IDENTITY

  UPDATE mandamientos.dbo.M_FILES SET NAME_FILE = CAST($ID_MANDAMIENTO_INTERNO AS VARCHAR) + '_' + '$nuevoname', PATH_FILE = '$ubicacion'+ CAST($ID_MANDAMIENTO_INTERNO AS VARCHAR) + '_' + '$nuevoname' WHERE ID_FILE = @insertado_file


 UPDATE mandamientos.dbo.A_MANDAMIENTOS SET 
 ID_PAIS = $ID_PAIS , 
 ID_ESTADO_EMISOR = $ID_ESTADO_EMISOR , 
 ID_MUNICIPIO = $ID_MUNICIPIO ,
 ID_EMISOR = $ID_EMISOR ,
 FISCALIA = $FISCALIA ,
 ID_TIPO_MANDATO = $ID_TIPO_MANDATO ,
 NO_MANDATO = '$NO_MANDATO' ,
 ID_TIPO_PROCESO = $ID_TIPO_PROCESO ,
 EDO_ORDEN = $EDO_ORDEN ,
 FECHA_RECEPCION = '$FECHA_RECEPCION' ,
 FECHA_OFICIO = '$FECHA_OFICIO' ,
 ID_TIPO_CUANTIA = $ID_TIPO_CUANTIA ,
 ID_FUERO_PROCESO = $ID_FUERO_PROCESO ,
 ID_PROCESO_EXTRADI = $ID_PROCESO_EXTRADI ,
 ID_ESTADO_JUZGADO = $ID_ESTADO_JUZGADO ,
 JUZGADO_COLABORACION = '$JUZGADO_COLABORACION' ,
 ID_JUZGADO = $ID_JUZGADO ,
 OFICIO_JUZGADO = '$OFICIO_JUZGADO' ,
 NO_CAUSA = '$NO_CAUSA' ,
 NO_PROCESO = '$NO_PROCESO' ,
 FECHA_LIBRAMIENTO = '$FECHA_LIBRAMIENTO' ,
 TIPO_INVESTIGACION = $TIPO_INVESTIGACION ,
 NO_AVERIGUACION = '$NO_AVERIGUACION',
 CARPETA_INV = '$nuc' ,
 ACUMULADO_PROCESO = '$ACUMULADO_PROCESO' ,
 ACUMULADO_AVERIGUACION = '$ACUMULADO_AVERIGUACION' ,
 OBSERVACIONES = '$OBSERVACIONES' ,
 OBSERVACIONES_INT = '$OBSERVACIONES_INT' ,
 COLABORACION = $COLABORACION ,
 idFile = @insertado_file,
 EstatusDocumentoSire = 0
 WHERE ID_MANDAMIENTO_INTERNO = $ID_MANDAMIENTO_INTERNO

 DELETE FROM mandamientos.dbo.M_FILES WHERE ID_FILE =  $idArchivoAct

 COMMIT
 END TRY
 BEGIN CATCH
 ROLLBACK TRANSACTION
 RAISERROR('No se realizo la transaccion',16,1)
 END CATCH
 END";


 $result_local = sqlsrv_query($conn, $queryTransaction_local, array(), array( "Scrollable" => 'static' ));
 while ($row = sqlsrv_fetch_array( $result_local, SQLSRV_FETCH_ASSOC )){  
   $id=$row['id'];
 }
 $arreglo[0] = "NO";
 $arreglo[1] = "SI";
 $arreglo[2] = $ID_MANDAMIENTO_INTERNO;
 $d = array('first' => $arreglo[1] , 'ID_MANDAMIENTO_INTERNO' => $arreglo[2]);
 if ($result_local) {
   echo json_encode($d);
   move_uploaded_file($temporal, "../documentos/".$ID_MANDAMIENTO_INTERNO."_".$nuevoname);
 }else{
  echo json_encode(array('first'=>$arreglo[0]));
 }
}else{
 // SI LA BANDERA ES 0 ENTONCES NO SE REQUIERE ACTUALIZAR EL ARCHIVO
 $queryTransaction_local = "
 BEGIN
 BEGIN TRY
 BEGIN TRANSACTION
 SET NOCOUNT ON

 UPDATE mandamientos.dbo.A_MANDAMIENTOS SET 
 ID_PAIS = $ID_PAIS , 
 ID_ESTADO_EMISOR = $ID_ESTADO_EMISOR , 
 ID_MUNICIPIO = $ID_MUNICIPIO ,
 ID_EMISOR = $ID_EMISOR ,
 FISCALIA = $FISCALIA ,
 ID_TIPO_MANDATO = $ID_TIPO_MANDATO ,
 NO_MANDATO = '$NO_MANDATO' ,
 ID_TIPO_PROCESO = $ID_TIPO_PROCESO ,
 EDO_ORDEN = $EDO_ORDEN ,
 FECHA_RECEPCION = '$FECHA_RECEPCION' ,
 FECHA_OFICIO = '$FECHA_OFICIO' ,
 ID_TIPO_CUANTIA = $ID_TIPO_CUANTIA ,
 ID_FUERO_PROCESO = $ID_FUERO_PROCESO ,
 ID_PROCESO_EXTRADI = $ID_PROCESO_EXTRADI ,
 ID_ESTADO_JUZGADO = $ID_ESTADO_JUZGADO ,
 JUZGADO_COLABORACION = '$JUZGADO_COLABORACION' ,
 ID_JUZGADO = $ID_JUZGADO ,
 OFICIO_JUZGADO = '$OFICIO_JUZGADO' ,
 NO_CAUSA = '$NO_CAUSA' ,
 NO_PROCESO = '$NO_PROCESO' ,
 FECHA_LIBRAMIENTO = '$FECHA_LIBRAMIENTO' ,
 TIPO_INVESTIGACION = $TIPO_INVESTIGACION ,
 NO_AVERIGUACION = '$NO_AVERIGUACION',
 CARPETA_INV = '$nuc' ,
 ACUMULADO_PROCESO = '$ACUMULADO_PROCESO' ,
 ACUMULADO_AVERIGUACION = '$ACUMULADO_AVERIGUACION' ,
 OBSERVACIONES = '$OBSERVACIONES' ,
 OBSERVACIONES_INT = '$OBSERVACIONES_INT' ,
 COLABORACION = $COLABORACION ,
 EstatusDocumentoSire = 0
 WHERE ID_MANDAMIENTO_INTERNO = $ID_MANDAMIENTO_INTERNO

 COMMIT
 END TRY
 BEGIN CATCH
 ROLLBACK TRANSACTION
 RAISERROR('No se realizo la transaccion',16,1)
 END CATCH
 END";


 $result_local = sqlsrv_query($conn, $queryTransaction_local, array(), array( "Scrollable" => 'static' ));
 while ($row = sqlsrv_fetch_array( $result_local, SQLSRV_FETCH_ASSOC )){  
   $id=$row['id'];
 }
 $arreglo[0] = "NO";
 $arreglo[1] = "SI";
 $arreglo[2] = $ID_MANDAMIENTO_INTERNO;
 $d = array('first' => $arreglo[1] , 'ID_MANDAMIENTO_INTERNO' => $arreglo[2]);
 if ($result_local) {
   echo json_encode($d);
   //move_uploaded_file($temporal, "../documentos/".$ID_MANDAMIENTO_INTERNO."_".$nuevoname); 
 }else{
  echo json_encode(array('first'=>$arreglo[0]));
 }
}

/*TERMINA ACTUALIZACION EN SIMAJ Y SIRE */ 

}else{
  $queryTransaction = "
  BEGIN
  BEGIN TRY
  BEGIN TRANSACTION
  SET NOCOUNT ON

  declare @insertado_file int

  INSERT INTO mandamientos.dbo.M_FILES (NAME_FILE, PATH_FILE, UP_DATE, FILE_SIZE) VALUES ('$nuevoname', '$destino', GETDATE(), $fileSize)
  select @insertado_file = @@IDENTITY

   UPDATE mandamientos.dbo.M_FILES SET NAME_FILE = CAST($ID_MANDAMIENTO_INTERNO AS VARCHAR) + '_' + '$nuevoname', PATH_FILE = '$ubicacion'+ CAST($ID_MANDAMIENTO_INTERNO AS VARCHAR) + '_' + '$nuevoname' WHERE ID_FILE = @insertado_file

  UPDATE mandamientos.dbo.A_MANDAMIENTOS SET 
  ID_PAIS = $ID_PAIS , 
  ID_ESTADO_EMISOR = $ID_ESTADO_EMISOR , 
  ID_MUNICIPIO = $ID_MUNICIPIO ,
  ID_EMISOR = $ID_EMISOR ,
  FISCALIA = $FISCALIA ,
  ID_TIPO_MANDATO = $ID_TIPO_MANDATO ,
  NO_MANDATO = '$NO_MANDATO' ,
  ID_TIPO_PROCESO = $ID_TIPO_PROCESO ,
  EDO_ORDEN = $EDO_ORDEN ,
  FECHA_RECEPCION = '$FECHA_RECEPCION' ,
  FECHA_OFICIO = '$FECHA_OFICIO' ,
  ID_TIPO_CUANTIA = $ID_TIPO_CUANTIA ,
  ID_FUERO_PROCESO = $ID_FUERO_PROCESO ,
  ID_PROCESO_EXTRADI = $ID_PROCESO_EXTRADI ,
  ID_ESTADO_JUZGADO = $ID_ESTADO_JUZGADO ,
  JUZGADO_COLABORACION = '$JUZGADO_COLABORACION' ,
  ID_JUZGADO = $ID_JUZGADO ,
  OFICIO_JUZGADO = '$OFICIO_JUZGADO' ,
  NO_CAUSA = '$NO_CAUSA' ,
  NO_PROCESO = '$NO_PROCESO' ,
  FECHA_LIBRAMIENTO = '$FECHA_LIBRAMIENTO' ,
  TIPO_INVESTIGACION = $TIPO_INVESTIGACION ,
  NO_AVERIGUACION = '$NO_AVERIGUACION',
  CARPETA_INV = '$nuc' ,
  ACUMULADO_PROCESO = '$ACUMULADO_PROCESO' ,
  ACUMULADO_AVERIGUACION = '$ACUMULADO_AVERIGUACION' ,
  OBSERVACIONES = '$OBSERVACIONES' ,
  OBSERVACIONES_INT = '$OBSERVACIONES_INT' ,
  COLABORACION = $COLABORACION,
  idFile = @insertado_file,
  EstatusDocumentoSire = 0
  WHERE ID_MANDAMIENTO_INTERNO = $ID_MANDAMIENTO_INTERNO

  DELETE FROM mandamientos.dbo.M_FILES WHERE ID_FILE = $idArchivoAct

  COMMIT
  END TRY
  BEGIN CATCH
  ROLLBACK TRANSACTION
  RAISERROR('No se realizo la transaccion',16,1)
  END CATCH
  END";
  
  

  $result = sqlsrv_query($conn, $queryTransaction, array(), array( "Scrollable" => 'static' ));
  while ($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC )){  
    $id=$row['id'];
  }
  $arreglo[0] = "NO";
  $arreglo[1] = "SI";
  $arreglo[2] = $ID_MANDAMIENTO_INTERNO;
  $d = array('first' => $arreglo[1] , 'ID_MANDAMIENTO_INTERNO' => $arreglo[2]);
  if ($result) {
    echo json_encode($d);
     move_uploaded_file($temporal, "../documentos/".$ID_MANDAMIENTO_INTERNO."_".$nuevoname);
  }else{
    echo json_encode(array('first'=>$arreglo[0]));
  }
}


?>