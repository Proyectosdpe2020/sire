<?php
header('Content-Type: text/html; charset=utf-8');
include("../../../Conexiones/Conexion.php");
include("../../../Conexiones/conexionSIMAJ.php");
include("../../../funcionesMandamientos.php");

//////////// ID DE LA MEDIDA DE PROTECCION/////
if (isset($_POST["ID_MANDAMIENTO_INTERNO"])){
 if($_POST["ID_MANDAMIENTO_INTERNO"] != 0) {
  $ID_MANDAMIENTO_INTERNO = $_POST["ID_MANDAMIENTO_INTERNO"];
 }else{  
  $ID_MANDAMIENTO_INTERNO = 0;
 }
}

if (isset($_POST['idEnlace'])){ $idEnlace = $_POST['idEnlace']; }
if (isset($_POST['fraccion'])){ $fraccion = $_POST['fraccion']; }
if (isset($_POST['tipoActualizacion'])){ $tipoActualizacion = $_POST['tipoActualizacion']; }

if (isset($_POST['idUnidad'])){ $idUnidad = $_POST['idUnidad']; }
if (isset($_POST['idfisca'])){ $idfisca = $_POST['idfisca']; }

//SE RECIBE OBJETO ARRAY CON LOS DATOS PRINCIPALES
if (isset($_POST["dataPrincipalArray"]) && $ID_MANDAMIENTO_INTERNO == 0){ 
  $data = json_decode($_POST['dataPrincipalArray'], true); 

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
}

if(isset($_POST["dataAgraviadoArray"])){
$data_inputado = json_decode($_POST['dataAgraviadoArray'], true); 
  $NOMBRE = $data_inputado[1];
  $PATERNO = $data_inputado[2];
  $MATERNO = $data_inputado[3];
  $ES_PRINCIPAL_AGRAVIADO = $data_inputado[4];
 }


if($ID_MANDAMIENTO_INTERNO == 0){
 $queryTransaction = "
  BEGIN
   BEGIN TRY 
    BEGIN TRANSACTION
     SET NOCOUNT ON
       declare @insertado int
     
       INSERT INTO mandamientos.dbo.A_MANDAMIENTOS (ID_PAIS , ID_ESTADO_EMISOR , ID_MUNICIPIO , FISCALIA , ID_EMISOR , NO_MANDATO, ID_ESTADO_JUZGADO , ID_JUZGADO , NO_CAUSA , OFICIO_JUZGADO , FECHA_OFICIO , ID_TIPO_CUANTIA , FECHA_LIBRAMIENTO , ID_FUERO_PROCESO , ID_TIPO_MANDATO , NO_PROCESO , TIPO_INVESTIGACION , NO_AVERIGUACION , CARPETA_INV , FECHA_CAPTURA , FECHA_RECEPCION , OBSERVACIONES , ID_PROCESO_EXTRADI , ID_TIPO_PROCESO , ACUMULADO_PROCESO , ACUMULADO_AVERIGUACION , EDO_ORDEN , COLABORACION , JUZGADO_COLABORACION , OBSERVACIONES_INT , idEnlace , idUnidad , idFiscalia) VALUES( $ID_PAIS , $ID_ESTADO_EMISOR , $ID_MUNICIPIO , $FISCALIA , $ID_EMISOR , '$NO_MANDATO' , $ID_ESTADO_JUZGADO , $ID_JUZGADO , '$NO_CAUSA' , '$OFICIO_JUZGADO' , '$FECHA_OFICIO' , $ID_TIPO_CUANTIA , '$FECHA_LIBRAMIENTO' , $ID_FUERO_PROCESO , $ID_TIPO_MANDATO , '$NO_PROCESO' , $TIPO_INVESTIGACION , '$NO_AVERIGUACION' , '$nuc' , '$FECHA_CAPTURA' , '$FECHA_RECEPCION' , '$OBSERVACIONES' , $ID_PROCESO_EXTRADI , $ID_TIPO_PROCESO , '$ACUMULADO_PROCESO' , '$ACUMULADO_AVERIGUACION' , $EDO_ORDEN , $COLABORACION , '$JUZGADO_COLABORACION' , '$OBSERVACIONES_INT' , $idEnlace ,  $idUnidad , $idfisca )

       select @insertado = @@IDENTITY

       INSERT INTO mandamientos.dbo.L_DATOS_AGRAVIADO (ID_MANDAMIENTO_INTERNO , NOMBRE , PATERNO , MATERNO , ES_PRINCIPAL) 
       VALUES(@insertado, '$NOMBRE' , '$PATERNO' , '$MATERNO' , $ES_PRINCIPAL_AGRAVIADO )

       SELECT MAX(ID_MANDAMIENTO_INTERNO) AS id FROM mandamientos.dbo.A_MANDAMIENTOS

       COMMIT
      END TRY
     BEGIN CATCH
    ROLLBACK TRANSACTION
   RAISERROR('No se realizo la transaccion',16,1)
  END CATCH
 END";

 $result = sqlsrv_query($conn,$queryTransaction, array(), array( "Scrollable" => 'static' )); 
 $arreglo[0] = "NO";
 $arreglo[1] = "SI";
 //echo $queryTransaction;
 if ($result) {
  while ($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC )){  
   $id=$row['id'];  
  }
  $arreglo[2] = $id;
  $d = array('first' => $arreglo[1] , 'ID_MANDAMIENTO_INTERNO' => $arreglo[2] );
  echo json_encode($d);
 }else{
  echo json_encode(array('first'=>$arreglo[0]));
 }

}elseif($ID_MANDAMIENTO_INTERNO != 0 && $tipoActualizacion == 0){
 $queryTransaction = "
  BEGIN
   BEGIN TRY 
    BEGIN TRANSACTION
     SET NOCOUNT ON
       declare @insertado int

        INSERT INTO mandamientos.dbo.L_DATOS_AGRAVIADO (ID_MANDAMIENTO_INTERNO , NOMBRE , PATERNO , MATERNO , ES_PRINCIPAL) 
       VALUES($ID_MANDAMIENTO_INTERNO, '$NOMBRE' , '$PATERNO' , '$MATERNO' , $ES_PRINCIPAL_AGRAVIADO )

       COMMIT
      END TRY
     BEGIN CATCH
    ROLLBACK TRANSACTION
   RAISERROR('No se realizo la transaccion',16,1)
  END CATCH
 END";

 $result = sqlsrv_query($conn,$queryTransaction, array(), array( "Scrollable" => 'static' )); 
 $arreglo[0] = "NO";
 $arreglo[1] = "SI";
 //echo $queryTransaction;
 if ($result) {
  $arreglo[2] = $ID_MANDAMIENTO_INTERNO;
  $d = array('first' => $arreglo[1] , 'ID_MANDAMIENTO_INTERNO' => $arreglo[2] );
  echo json_encode($d);
 }else{
  echo json_encode(array('first'=>$arreglo[0]));
 }
}


?>