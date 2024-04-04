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

if(isset($_FILES['archivo0'])) {
  $nombreArchivo = $_FILES['archivo0']['name'];
  $ubicacion = 'documentos/';
  $nombreReporte = "Mandamiento_".$ID_MANDAMIENTO_INTERNO."_".$idEnlace."_".$idUnidad.".pdf";
  $nuevoname = formatearNombreMandamiento($nombreReporte);
  $destino = $ubicacion.$nuevoname;

  $temporal = $_FILES['archivo0']['tmp_name'];
  $fileSize = $_FILES['archivo0']['size'];
} else {
  echo "No se recibió ningún archivo.";
}

$PRUEBAS = true; //VARIABLE PARA REALIZAR PRUEBAS EN EL SISTEMA SIN REPLICAR EN TIEMPO REAL AL SIMAJ, CAMBIAR A false PARA GUARDAR INTERNAMENTE

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


if(isset($_POST["dataInputadoArray"])){
  $data_inputado = json_decode($_POST['dataInputadoArray'], true); 
  $NOMBRE = $data_inputado[1];
  $APATERNO = $data_inputado[2];
  $AMATERNO = $data_inputado[3];
  $ID_NACIONALIDAD = $data_inputado[4];
  $ID_SEXO = $data_inputado[5];
  $ID_USO_ANTEOJOS = $data_inputado[6];
  $TATUAJES = $data_inputado[7];
  $EDAD = $data_inputado[8]; if($EDAD == ""){$EDAD = 0; }
  $ESTATURA = $data_inputado[9];if($ESTATURA == ""){$ESTATURA = 0; }
  $PESO = $data_inputado[10];if($PESO == ""){$PESO = 0; }
  $CURP = $data_inputado[11];
  $OBSERVACIONES_INPUTADO = $data_inputado[12];
  $FECHA_OBSERVACION = $data_inputado[13];
  $ID_DELITO_PRINCIPAL = $data_inputado[14];
}

//VARIABLE PARA OBTENER EL ID_MANDAMIENTO DE SIMAJ
if (isset($_POST['GET_ID_MANDAMIENTO_INTERNO'])){ $GET_ID_MANDAMIENTO_INTERNO = $_POST['GET_ID_MANDAMIENTO_INTERNO']; }

if($PRUEBAS == true){
   if($ID_MANDAMIENTO_INTERNO == 0 && $tipoActualizacion == "NO_EXISTE_DATA_INPUTADO"){
  //***********************************INSERSIONES EN BASE DE SIMAJ***********************/
      $queryTransaction = "
      BEGIN
      BEGIN TRY 
      BEGIN TRANSACTION
      SET NOCOUNT ON
      declare @insertado int
      declare @insertado_inculpado int

      INSERT INTO SIMAJ.dbo.A_DATOS_MANDAMIENTOS (ID_PAIS , ID_ESTADO_EMISOR , ID_MUNICIPIO , FISCALIA , ID_EMISOR , NO_MANDATO, ID_ESTADO_JUZGADO , ID_JUZGADO , NO_CAUSA , OFICIO_JUZGADO , FECHA_OFICIO , ID_TIPO_CUANTIA , FECHA_LIBRAMIENTO , ID_FUERO_PROCESO , ID_TIPO_MANDATO , NO_PROCESO , TIPO_INVESTIGACION , NO_AVERIGUACION , CARPETA_INV , FECHA_CAPTURA , FECHA_RECEPCION , OBSERVACIONES , ID_PROCESO_EXTRADI , ID_TIPO_PROCESO , ACUMULADO_PROCESO , ACUMULADO_AVERIGUACION , EDO_ORDEN , COLABORACION , JUZGADO_COLABORACION , OBSERVACIONES_INT ) VALUES( $ID_PAIS , $ID_ESTADO_EMISOR , $ID_MUNICIPIO , $FISCALIA , $ID_EMISOR , '$NO_MANDATO' , $ID_ESTADO_JUZGADO , $ID_JUZGADO , '$NO_CAUSA' , '$OFICIO_JUZGADO' , '$FECHA_OFICIO' , $ID_TIPO_CUANTIA , '$FECHA_LIBRAMIENTO' , $ID_FUERO_PROCESO , $ID_TIPO_MANDATO , '$NO_PROCESO' , $TIPO_INVESTIGACION , '$NO_AVERIGUACION' , '$nuc' , '$FECHA_CAPTURA' , '$FECHA_RECEPCION' , '$OBSERVACIONES' , $ID_PROCESO_EXTRADI , $ID_TIPO_PROCESO , '$ACUMULADO_PROCESO' , '$ACUMULADO_AVERIGUACION' , $EDO_ORDEN , $COLABORACION , '$JUZGADO_COLABORACION' , '$OBSERVACIONES_INT' )


      select @insertado = @@IDENTITY

      INSERT INTO SIMAJ.dbo.B_DATOS_INCULPADO (ID_MANDAMIENTO , NOMBRE , APATERNO , AMATERNO , EDAD , ESTATURA , PESO , TATUAJES , ID_SEXO , ID_USO_ANTEOJOS , ID_NACIONALIDAD , CURP , OBSERVACIONES , FECHA_OBSERVACION) 
      VALUES(@insertado, '$NOMBRE' , '$APATERNO' , '$AMATERNO' , $EDAD , $ESTATURA , $PESO , '$TATUAJES' , '$ID_SEXO' , '$ID_USO_ANTEOJOS' , $ID_NACIONALIDAD , '$CURP' , '$OBSERVACIONES_INPUTADO' , '$FECHA_OBSERVACION' )

      select @insertado_inculpado = @@IDENTITY

      INSERT INTO SIMAJ.dbo.E_DELITOS (ID_MANDAMIENTO , ID_DATOS_INCULPADO, ID_DELITO , ID_MODALIDAD , ES_PRINCIPAL )
      VALUES (@insertado,  @insertado_inculpado , $ID_DELITO_PRINCIPAL , 9999 , 1)



      (SELECT MAX(ID_MANDAMIENTO) AS ID_MANDAMIENTO FROM SIMAJ.dbo.A_DATOS_MANDAMIENTOS)
      UNION
      (SELECT MAX(ID_DATOS_INCULPADO) AS ID_DATOS_INCULPADO FROM SIMAJ.dbo.B_DATOS_INCULPADO)
      UNION
      (SELECT MAX(ID_DELITOS) AS ID_DELITOS FROM SIMAJ.dbo.E_DELITOS)

      UPDATE SIMAJ.dbo.A_DATOS_MANDAMIENTOS SET EstatusDocumentoSire = 0 WHERE ID_MANDAMIENTO = @insertado

      COMMIT
      END TRY
      BEGIN CATCH
      ROLLBACK TRANSACTION
      RAISERROR('No se realizo la transaccion',16,1)
      END CATCH
      END";

      $result = sqlsrv_query($connSIMAJ,$queryTransaction, array(), array( "Scrollable" => 'static' )); 
  //echo $queryTransaction;
      $indice = 0;
      while ($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC )){
        $arreglo[$indice][0]=$row['ID_MANDAMIENTO'];
        $indice++;
    }
   //OBTENEMOS EL ID_DATOS_INCULPADO Y ID_MANDAMIENTO PREVIAMENTE INGRESADOS PARA INSERTARLOS EN LAS BASES LOCALES
    $ID_DATOS_INCULPADO = $arreglo[0][0];
    $ID_MANDAMIENTO = $arreglo[1][0];
    $ID_DELITOS = $arreglo[2][0];

    //***********************************INSERSIONES EN BASE LOCAL***********************/
    $queryTransaction_local = "
    BEGIN
    BEGIN TRY 
    BEGIN TRANSACTION
    SET NOCOUNT ON
    declare @insertado int
    declare @insertado_datos_inculpado_local int

    declare @insertado_file int

     INSERT INTO mandamientos.dbo.M_FILES (NAME_FILE, PATH_FILE, UP_DATE, FILE_SIZE) VALUES ('$nuevoname', '$destino', GETDATE(), $fileSize)
     select @insertado_file = @@IDENTITY

    INSERT INTO mandamientos.dbo.A_MANDAMIENTOS (ID_MANDAMIENTO, ID_PAIS , ID_ESTADO_EMISOR , ID_MUNICIPIO , FISCALIA , ID_EMISOR , NO_MANDATO, ID_ESTADO_JUZGADO , ID_JUZGADO , NO_CAUSA , OFICIO_JUZGADO , FECHA_OFICIO , ID_TIPO_CUANTIA , FECHA_LIBRAMIENTO , ID_FUERO_PROCESO , ID_TIPO_MANDATO , NO_PROCESO , TIPO_INVESTIGACION , NO_AVERIGUACION , CARPETA_INV , FECHA_CAPTURA , FECHA_RECEPCION , OBSERVACIONES , ID_PROCESO_EXTRADI , ID_TIPO_PROCESO , ACUMULADO_PROCESO , ACUMULADO_AVERIGUACION , EDO_ORDEN , COLABORACION , JUZGADO_COLABORACION , OBSERVACIONES_INT , idEnlace , idUnidad , idFiscalia, idFile, EstatusDocumentoSire) VALUES($ID_MANDAMIENTO, $ID_PAIS , $ID_ESTADO_EMISOR , $ID_MUNICIPIO , $FISCALIA , $ID_EMISOR , '$NO_MANDATO' , $ID_ESTADO_JUZGADO , $ID_JUZGADO , '$NO_CAUSA' , '$OFICIO_JUZGADO' , '$FECHA_OFICIO' , $ID_TIPO_CUANTIA , '$FECHA_LIBRAMIENTO' , $ID_FUERO_PROCESO , $ID_TIPO_MANDATO , '$NO_PROCESO' , $TIPO_INVESTIGACION , '$NO_AVERIGUACION' , '$nuc' , '$FECHA_CAPTURA' , '$FECHA_RECEPCION' , '$OBSERVACIONES' , $ID_PROCESO_EXTRADI , $ID_TIPO_PROCESO , '$ACUMULADO_PROCESO' , '$ACUMULADO_AVERIGUACION' , $EDO_ORDEN , $COLABORACION , '$JUZGADO_COLABORACION' , '$OBSERVACIONES_INT' , $idEnlace ,  $idUnidad , $idfisca, @insertado_file, 0  )

    select @insertado = @@IDENTITY

    INSERT INTO mandamientos.dbo.B_DATOS_INCULPADO (ID_MANDAMIENTO_INTERNO , ID_DATOS_INCULPADO , ID_MANDAMIENTO ,  NOMBRE , APATERNO , AMATERNO , EDAD , ESTATURA , PESO , TATUAJES , ID_SEXO , ID_USO_ANTEOJOS , ID_NACIONALIDAD , CURP , OBSERVACIONES , FECHA_OBSERVACION) 
    VALUES(@insertado , $ID_DATOS_INCULPADO , $ID_MANDAMIENTO , '$NOMBRE' , '$APATERNO' , '$AMATERNO' , $EDAD , $ESTATURA , $PESO , '$TATUAJES' , '$ID_SEXO' , '$ID_USO_ANTEOJOS' , $ID_NACIONALIDAD , '$CURP' , '$OBSERVACIONES_INPUTADO' , '$FECHA_OBSERVACION' )

    select @insertado_datos_inculpado_local = @@IDENTITY

     UPDATE mandamientos.dbo.M_FILES SET NAME_FILE = CAST(@insertado AS VARCHAR) + '_' + '$nuevoname', PATH_FILE = '$ubicacion'+ CAST(@insertado AS VARCHAR) + '_' + '$nuevoname' WHERE ID_FILE = @insertado_file


    INSERT INTO mandamientos.dbo.E_DELITOS (ID_MANDAMIENTO_INTERNO , ID_INCULPADO_INTERNO , ID_DELITOS , ID_MANDAMIENTO , ID_DATOS_INCULPADO , ID_DELITO , ID_MODALIDAD , ES_PRINCIPAL )
    VALUES (@insertado, @insertado_datos_inculpado_local , $ID_DELITOS , $ID_MANDAMIENTO , $ID_DATOS_INCULPADO ,  $ID_DELITO_PRINCIPAL , 9999 , 1)

    SELECT MAX(ID_MANDAMIENTO_INTERNO) AS id_local FROM mandamientos.dbo.A_MANDAMIENTOS

    COMMIT
    END TRY
    BEGIN CATCH
    ROLLBACK TRANSACTION
    RAISERROR('No se realizo la transaccion',16,1)
    END CATCH
    END";

    $result_local = sqlsrv_query($conn,$queryTransaction_local, array(), array( "Scrollable" => 'static' )); 
    $arreglo_local[0] = "NO";
    $arreglo_local[1] = "SI";
  //echo $queryTransaction;
    if ($result_local) {
     while ($row_local = sqlsrv_fetch_array( $result_local, SQLSRV_FETCH_ASSOC )){  
        $id_local=$row_local['id_local'];  
    }
    $arreglo_local[2] = $id_local;
    $d = array('first' => $arreglo_local[1] , 'ID_MANDAMIENTO_INTERNO' => $arreglo_local[2] );
    move_uploaded_file($temporal, "../documentos/".$id_local."_".$nuevoname);
    echo json_encode($d);
}else{
   echo json_encode(array('first'=>$arreglo_local[0]));
}
}elseif($ID_MANDAMIENTO_INTERNO != 0 && $tipoActualizacion == "NO_EXISTE_DATA_INPUTADO"){

  $queryTransaction = "
  BEGIN
  BEGIN TRY 
  BEGIN TRANSACTION
  SET NOCOUNT ON
  declare @insertado int

  INSERT INTO SIMAJ.dbo.B_DATOS_INCULPADO (ID_MANDAMIENTO , NOMBRE , APATERNO , AMATERNO , EDAD , ESTATURA , PESO , TATUAJES , ID_SEXO , ID_USO_ANTEOJOS , ID_NACIONALIDAD , CURP , OBSERVACIONES , FECHA_OBSERVACION) 
  VALUES($GET_ID_MANDAMIENTO_INTERNO, '$NOMBRE' , '$APATERNO' , '$AMATERNO' , $EDAD , $ESTATURA , $PESO , '$TATUAJES' , '$ID_SEXO' , '$ID_USO_ANTEOJOS' , $ID_NACIONALIDAD , '$CURP' , '$OBSERVACIONES_INPUTADO' , '$FECHA_OBSERVACION' )

  SELECT MAX(ID_DATOS_INCULPADO) AS ID_DATOS_INCULPADO FROM SIMAJ.dbo.B_DATOS_INCULPADO

  INSERT INTO SIMAJ.dbo.E_DELITOS (ID_MANDAMIENTO , ID_DATOS_INCULPADO, ID_DELITO , ID_MODALIDAD , ES_PRINCIPAL )
  VALUES ($GET_ID_MANDAMIENTO_INTERNO,  ID_DATOS_INCULPADO , $ID_DELITO , 9999 , $ES_PRINCIPAL)

  COMMIT
  END TRY
  BEGIN CATCH
  ROLLBACK TRANSACTION
  RAISERROR('No se realizo la transaccion',16,1)
  END CATCH
  END";

  $result = sqlsrv_query($connSIMAJ,$queryTransaction, array(), array( "Scrollable" => 'static' )); 
  if ($result) {
     while ($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC )){  
        $ID_DATOS_INCULPADO = $row['ID_DATOS_INCULPADO'];   
    }
}

$queryTransaction = "
BEGIN
BEGIN TRY 
BEGIN TRANSACTION
SET NOCOUNT ON
declare @insertado int

INSERT INTO mandamientos.dbo.B_DATOS_INCULPADO (ID_MANDAMIENTO_INTERNO ,ID_DATOS_INCULPADO ,  ID_MANDAMIENTO, NOMBRE , APATERNO , AMATERNO , EDAD , ESTATURA , PESO , TATUAJES , ID_SEXO , ID_USO_ANTEOJOS , ID_NACIONALIDAD , CURP , OBSERVACIONES , FECHA_OBSERVACION) 
VALUES($ID_MANDAMIENTO_INTERNO, $ID_DATOS_INCULPADO, $GET_ID_MANDAMIENTO_INTERNO,  '$NOMBRE' , '$APATERNO' , '$AMATERNO' , $EDAD , $ESTATURA , $PESO , '$TATUAJES' , '$ID_SEXO' , '$ID_USO_ANTEOJOS' , $ID_NACIONALIDAD , '$CURP' , '$OBSERVACIONES_INPUTADO' , '$FECHA_OBSERVACION' )

SELECT MAX(ID_DATOS_INCULPADO) AS ID_DATOS_INCULPADO FROM mandamientos.dbo.B_DATOS_INCULPADO

INSERT INTO mandamientos.dbo.E_DELITOS (ID_MANDAMIENTO_INTERNO , ID_INCULPADO_INTERNO , ID_DELITOS , ID_MANDAMIENTO , ID_DATOS_INCULPADO , ID_DELITO , ID_MODALIDAD , ES_PRINCIPAL )
VALUES ($ID_MANDAMIENTO_INTERNO, ID_DATOS_INCULPADO , $ID_DELITOS , $GET_ID_MANDAMIENTO_INTERNO , $GET_ID_DATOS_INCULPADO ,  $ID_DELITO , 9999 , $ES_PRINCIPAL)

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

}else{

    if($ID_MANDAMIENTO_INTERNO == 0 && $tipoActualizacion == "NO_EXISTE_DATA_INPUTADO"){
     $queryTransaction = "
     BEGIN
     BEGIN TRY 
     BEGIN TRANSACTION
     SET NOCOUNT ON
     declare @insertado int     
     declare @insertado_inculpado_local int
     declare @insertado_file int

     INSERT INTO mandamientos.dbo.M_FILES (NAME_FILE, PATH_FILE, UP_DATE, FILE_SIZE) VALUES ('$nuevoname', '$destino', GETDATE(), $fileSize)
     select @insertado_file = @@IDENTITY

     INSERT INTO mandamientos.dbo.A_MANDAMIENTOS (ID_PAIS , ID_ESTADO_EMISOR , ID_MUNICIPIO , FISCALIA , ID_EMISOR , NO_MANDATO, ID_ESTADO_JUZGADO , ID_JUZGADO , NO_CAUSA , OFICIO_JUZGADO , FECHA_OFICIO , ID_TIPO_CUANTIA , FECHA_LIBRAMIENTO , ID_FUERO_PROCESO , ID_TIPO_MANDATO , NO_PROCESO , TIPO_INVESTIGACION , NO_AVERIGUACION , CARPETA_INV , FECHA_CAPTURA , FECHA_RECEPCION , OBSERVACIONES , ID_PROCESO_EXTRADI , ID_TIPO_PROCESO , ACUMULADO_PROCESO , ACUMULADO_AVERIGUACION , EDO_ORDEN , COLABORACION , JUZGADO_COLABORACION , OBSERVACIONES_INT , idEnlace , idUnidad , idFiscalia, idFile, EstatusDocumentoSire) VALUES( $ID_PAIS , $ID_ESTADO_EMISOR , $ID_MUNICIPIO , $FISCALIA , $ID_EMISOR , '$NO_MANDATO' , $ID_ESTADO_JUZGADO , $ID_JUZGADO , '$NO_CAUSA' , '$OFICIO_JUZGADO' , '$FECHA_OFICIO' , $ID_TIPO_CUANTIA , '$FECHA_LIBRAMIENTO' , $ID_FUERO_PROCESO , $ID_TIPO_MANDATO , '$NO_PROCESO' , $TIPO_INVESTIGACION , '$NO_AVERIGUACION' , '$nuc' , '$FECHA_CAPTURA' , '$FECHA_RECEPCION' , '$OBSERVACIONES' , $ID_PROCESO_EXTRADI , $ID_TIPO_PROCESO , '$ACUMULADO_PROCESO' , '$ACUMULADO_AVERIGUACION' , $EDO_ORDEN , $COLABORACION , '$JUZGADO_COLABORACION' , '$OBSERVACIONES_INT' , $idEnlace ,  $idUnidad , $idfisca, @insertado_file, 0 )

     select @insertado = @@IDENTITY

     UPDATE mandamientos.dbo.M_FILES SET NAME_FILE = CAST(@insertado AS VARCHAR) + '_' + '$nuevoname', PATH_FILE = '$ubicacion'+ CAST(@insertado AS VARCHAR) + '_' + '$nuevoname' WHERE ID_FILE = @insertado_file

     INSERT INTO mandamientos.dbo.B_DATOS_INCULPADO (ID_MANDAMIENTO_INTERNO , NOMBRE , APATERNO , AMATERNO , EDAD , ESTATURA , PESO , TATUAJES , ID_SEXO , ID_USO_ANTEOJOS , ID_NACIONALIDAD , CURP , OBSERVACIONES , FECHA_OBSERVACION) 
     VALUES(@insertado, '$NOMBRE' , '$APATERNO' , '$AMATERNO' , $EDAD , $ESTATURA , $PESO , '$TATUAJES' , '$ID_SEXO' , '$ID_USO_ANTEOJOS' , $ID_NACIONALIDAD , '$CURP' , '$OBSERVACIONES_INPUTADO' , '$FECHA_OBSERVACION' )

     SELECT MAX(ID_MANDAMIENTO_INTERNO) AS id FROM mandamientos.dbo.A_MANDAMIENTOS

     select @insertado_inculpado_local = @@IDENTITY

     INSERT INTO mandamientos.dbo.E_DELITOS (ID_MANDAMIENTO_INTERNO , ID_INCULPADO_INTERNO , ID_DELITO , ID_MODALIDAD , ES_PRINCIPAL )
     VALUES (@insertado, @insertado_inculpado_local ,  $ID_DELITO_PRINCIPAL , 9999 , 1)

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
     if ($result) {
        while ($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC )){  
           $id=$row['id'];  
       }
       $arreglo[2] = $id;
       $d = array('first' => $arreglo[1] , 'ID_MANDAMIENTO_INTERNO' => $arreglo[2] );
       echo json_encode($d);
       move_uploaded_file($temporal, "../documentos/".$id."_".$nuevoname);
   }else{
      echo json_encode(array('first'=>$arreglo[0]));
  }

}elseif($ID_MANDAMIENTO_INTERNO != 0 && $tipoActualizacion == "NO_EXISTE_DATA_INPUTADO"){
   $queryTransaction = "
   BEGIN
   BEGIN TRY 
   BEGIN TRANSACTION
   SET NOCOUNT ON
   declare @insertado int

   INSERT INTO mandamientos.dbo.B_DATOS_INCULPADO (ID_MANDAMIENTO_INTERNO , NOMBRE , APATERNO , AMATERNO , EDAD , ESTATURA , PESO , TATUAJES , ID_SEXO , ID_USO_ANTEOJOS , ID_NACIONALIDAD , CURP , OBSERVACIONES , FECHA_OBSERVACION) 
   VALUES($ID_MANDAMIENTO_INTERNO, '$NOMBRE' , '$APATERNO' , '$AMATERNO' , $EDAD , $ESTATURA , $PESO , '$TATUAJES' , '$ID_SEXO' , '$ID_USO_ANTEOJOS' , $ID_NACIONALIDAD , '$CURP' , '$OBSERVACIONES_INPUTADO' , '$FECHA_OBSERVACION' )

   select @insertado = @@IDENTITY

   INSERT INTO mandamientos.dbo.E_DELITOS (ID_MANDAMIENTO_INTERNO , ID_INCULPADO_INTERNO  , ID_DELITO , ID_MODALIDAD , ES_PRINCIPAL )
   VALUES ($ID_MANDAMIENTO_INTERNO, @insertado ,  $ID_DELITO_PRINCIPAL , 9999 , $ES_PRINCIPAL)

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
}


?>