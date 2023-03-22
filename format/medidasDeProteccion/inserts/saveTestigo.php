<?php
header('Content-Type: text/html; charset=utf-8');
include("../../../Conexiones/conexionMedidas.php");

//////////// ID DE LA MEDIDA DE PROTECCION/////
if (isset($_POST["idMedida"])){ $idMedida = $_POST["idMedida"]; }


//VARIABLES DEL FORMULARIO OBTENIDO
if (isset($_POST['nombreTest'])){ $nombreTest = $_POST['nombreTest']; }
if (isset($_POST['paternoTest'])){ $paternoTest = $_POST['paternoTest']; }
if (isset($_POST['maternoTest'])){ $maternoTest = $_POST['maternoTest']; }
if (isset($_POST['estadoTest'])){ $estadoTest = $_POST['estadoTest']; }
if (isset($_POST['causaTest'])){ $causaTest = $_POST['causaTest']; }
if (isset($_POST['observacionesTest'])){ $observacionesTest = $_POST['observacionesTest']; }
if (isset($_POST['nuc'])){ $nuc = $_POST['nuc']; }

 $queryTransaction = "
  BEGIN
   BEGIN TRY 
    BEGIN TRANSACTION
     SET NOCOUNT ON
     
       INSERT INTO medidas.testigo (idMedida, NUC, causa, nombre, paterno, materno, estadoMedida, observaciones) 
       VALUES($idMedida, '$nuc', '$causaTest', '$nombreTest', '$paternoTest', '$maternoTest', $estadoTest, '$observacionesTest')

       COMMIT
      END TRY
     BEGIN CATCH
    ROLLBACK TRANSACTION
   RAISERROR('No se realizo la transaccion',16,1)
  END CATCH
 END";
 
 $result = sqlsrv_query($connMedidas,$queryTransaction, array(), array( "Scrollable" => 'static' )); 
 

?>