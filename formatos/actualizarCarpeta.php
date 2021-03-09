<?php

header('Content-Type: text/html; charset=utf-8');
include("../funciones.php");
include ("../Conexiones/Conexion.php");

if (isset($_POST["idCarpeta"])){ $idCarpeta = $_POST["idCarpeta"]; }  
if (isset($_POST["mes"])){ $mes = $_POST["mes"]; }
if (isset($_POST["anio"])){ $anio = $_POST["anio"]; }
if (isset($_POST["idUnidad"])){ $idUnidad = $_POST["idUnidad"]; }      

if (isset($_POST["tramiteAnterior"])){ $tramiteAnterior = $_POST["tramiteAnterior"]; }
if (isset($_POST["inputCdeten"])){ $inputCdeten = $_POST["inputCdeten"]; }
if (isset($_POST["inputSdeten"])){ $inputSdeten = $_POST["inputSdeten"]; }
if (isset($_POST["totInici"])){ $totInici = $_POST["totInici"]; }       
if (isset($_POST["reCbOtrUni"])){ $reCbOtrUni = $_POST["reCbOtrUni"]; }
if (isset($_POST["TotalTrabajar"])){ $TotalTrabajar = $_POST["TotalTrabajar"]; }
if (isset($_POST["Cdetenju"])){ $Cdetenju = $_POST["Cdetenju"]; }
if (isset($_POST["Sdetenju"])){ $Sdetenju = $_POST["Sdetenju"]; }
if (isset($_POST["Judicializadas"])){ $Judicializadas = $_POST["Judicializadas"]; }
if (isset($_POST["inputAbsInves"])){ $inputAbsInves = $_POST["inputAbsInves"]; }
if (isset($_POST["inputArcTem"])){ $inputArcTem = $_POST["inputArcTem"]; }
if (isset($_POST["inputNEAP"])){ $inputNEAP = $_POST["inputNEAP"]; }
if (isset($_POST["inputMediacion"])){ $inputMediacion = $_POST["inputMediacion"]; }
if (isset($_POST["inputConciliacion"])){ $inputConciliacion = $_POST["inputConciliacion"]; }
if (isset($_POST["inputCriteOpor"])){ $inputCriteOpor = $_POST["inputCriteOpor"]; }
if (isset($_POST["inputSCP"])){ $inputSCP = $_POST["inputSCP"]; }
if (isset($_POST["inputIncompe"])){ $inputIncompe = $_POST["inputIncompe"]; }
if (isset($_POST["inputAcumulacion"])){ $inputAcumulacion = $_POST["inputAcumulacion"]; }
if (isset($_POST["inputResoluciones"])){ $inputResoluciones = $_POST["inputResoluciones"]; }
if (isset($_POST["inputEnvUATP"])){ $inputEnvUATP = $_POST["inputEnvUATP"]; }
if (isset($_POST["inputEnvUI"])){ $inputEnvUI = $_POST["inputEnvUI"]; }

if (isset($_POST["inputEnvImpDescA"])){ $inputEnvImpDescA = $_POST["inputEnvImpDescA"]; }

if (isset($_POST["inputTramiteFinal"])){ $inputTramiteFinal = $_POST["inputTramiteFinal"]; }
if (isset($_POST["idMp"])){ $idMp = $_POST["idMp"]; } 
if (isset($_POST["reiniciadas"])){ $reiniciadas = $_POST["reiniciadas"]; }         


$queryTransaction = "  

BEGIN 

BEGIN TRY 
BEGIN TRANSACTION

SET NOCOUNT ON

UPDATE Carpetas 

SET existenciaAnterior = $tramiteAnterior, 
iniciadasConDetenido = $inputCdeten,
iniciadasSinDetenido = $inputSdeten,
totalIniciadas = $totInici,
recibidasPorOtraUnidad = $reCbOtrUni,
totalTrabajar = $TotalTrabajar,
judicializadasConDetenido = $Cdetenju,
judicializadasSinDetenido = $Sdetenju,
totalJudicializadas = $Judicializadas,
abstencionInvestigacion = $inputAbsInves,
archivoTemporal = $inputArcTem,
noEjercicioAccionPenal = $inputNEAP,
mediacion = $inputMediacion,
conciliacion = $inputConciliacion,
criteriosOportunidad = $inputCriteOpor,
suspensionCondicional = $inputSCP,
incompetencia = $inputIncompe,
acumulacion = $inputAcumulacion,
totalResoluciones = $inputResoluciones,
enviadasUATP = $inputEnvUATP,
enviadasUI = $inputEnvUI,
tramite = $inputTramiteFinal,                         
enviImpDes = $inputEnvImpDescA,
reiniciadas = $reiniciadas

WHERE idCarpetas = $idCarpeta

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

if ($result) {
	echo json_encode(array('first'=>$arreglo[1]));
}else{
	echo json_encode(array('first'=>$arreglo[0]));
}

?>
