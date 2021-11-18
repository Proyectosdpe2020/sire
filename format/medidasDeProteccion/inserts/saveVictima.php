<?php
header('Content-Type: text/html; charset=utf-8');
include("../../../Conexiones/conexionMedidas.php");

//////////// ID DE LA MEDIDA DE PROTECCION/////
if (isset($_POST["idMedida"])){ $idMedida = $_POST["idMedida"]; }


//VARIABLES DEL FORMULARIO OBTENIDO
if (isset($_POST['nombreVicti'])){ $nombreVicti = $_POST['nombreVicti']; }
if (isset($_POST['paternoVicti'])){ $paternoVicti = $_POST['paternoVicti']; }
if (isset($_POST['maternoVicti'])){ $maternoVicti = $_POST['maternoVicti']; }
if (isset($_POST['generoVicti'])){ $generoVicti = $_POST['generoVicti']; }
if (isset($_POST['edadVictima'])){ $edadVictima = $_POST['edadVictima']; }

 $queryTransaction = "
  BEGIN
   BEGIN TRY 
    BEGIN TRANSACTION
     SET NOCOUNT ON
     
       INSERT INTO medidas.victimas (idMedida, nombre, paterno, materno, genero, edad) VALUES($idMedida, '$nombreVicti', '$paternoVicti', '$maternoVicti', $generoVicti, $edadVictima)

       COMMIT
      END TRY
     BEGIN CATCH
    ROLLBACK TRANSACTION
   RAISERROR('No se realizo la transaccion',16,1)
  END CATCH
 END";
 
 $result = sqlsrv_query($connMedidas,$queryTransaction, array(), array( "Scrollable" => 'static' )); 
 

?>