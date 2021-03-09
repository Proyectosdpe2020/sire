<?php
session_start();
include("../../Conexiones/Conexion.php");
include("../../funCmasc.php");	
if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }
if (isset($_POST["mes"])){ $mes = $_POST["mes"]; }
if (isset($_POST["anio"])){ $anio = $_POST["anio"]; }

if (isset($_POST["svhom"])){ $svhom = $_POST["svhom"]; }
if (isset($_POST["svmuj"])){ $svmuj = $_POST["svmuj"]; }
if (isset($_POST["sihom"])){ $sihom = $_POST["sihom"]; }
if (isset($_POST["simuj"])){ $simuj = $_POST["simuj"]; }
if (isset($_POST["numInvRec"])){ $numInvRec = $_POST["numInvRec"]; }




///// REVISAR SI YA SE ENCUENTRA ESE REGISTRO

$quey = "SELECT idRecibidas FROM CMASC.recibidas WHERE idEnlace = $idEnlace AND mes = $mes AND anio = $anio";
$stmt = sqlsrv_query(  $conn, $quey,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
$row_count = sqlsrv_num_rows( $stmt );

if($row_count > 0){


  $queryTransaction = "  
  BEGIN                     
  BEGIN TRY 
  BEGIN TRANSACTION
  SET NOCOUNT ON                               
  
        UPDATE CMASC.recibidas SET solVictimaHombre = $svhom, solVictimaMujer = $svmuj, solImpuHombre = $sihom, solImpuMujer = $simuj, invitacionsGeneradas = $numInvRec WHERE idEnlace = $idEnlace AND mes = $mes AND anio = $anio 

  COMMIT
  END TRY
  BEGIN CATCH 
  ROLLBACK TRANSACTION
  RAISERROR('No se realizo la transaccion',16,1)
  END CATCH
  END
  "; 
  $result = sqlsrv_query($conn,$queryTransaction, array(), array( "Scrollable" => 'static' )); 
  $arreglo[0] = "SI";
  $arreglo[1] = "NO";

  if ($result) {
      echo json_encode(array('first'=>$arreglo[0]));
  }else{
      echo json_encode(array('first'=>$arreglo[1]));
  }

}else{


      $queryTransaction = "  
    BEGIN                     
    BEGIN TRY 
    BEGIN TRANSACTION
    SET NOCOUNT ON                               
           INSERT INTO CMASC.recibidas (idEnlace, anio, mes, extAnter, solVictimaHombre, solVictimaMujer, solImpuHombre, solImpuMujer, invitacionsGeneradas, totalRecibidas, fechaIngreso) VALUES ($idEnlace,$anio,$mes,0,$svhom,$svmuj,$sihom,$simuj,$numInvRec, 0 ,GETDATE())
    COMMIT
    END TRY
    BEGIN CATCH 
    ROLLBACK TRANSACTION
    RAISERROR('No se realizo la transaccion',16,1)
    END CATCH
    END
    "; 
    $result = sqlsrv_query($conn,$queryTransaction, array(), array( "Scrollable" => 'static' )); 
    $arreglo[0] = "SI";
    $arreglo[1] = "NO";

    if ($result) {
      echo json_encode(array('first'=>$arreglo[0]));
    }else{
      echo json_encode(array('first'=>$arreglo[1]));
    }

}




?>