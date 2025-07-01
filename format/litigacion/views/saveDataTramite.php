<?php

include("../../../Conexiones/conexionSicap.php");
include("../../../funcioneSicap.php");

include("../../../Conexiones/Conexion.php");
include("../../../funciones.php");
include("../../../funcioneLit.php");

$arreglo[0] = "SI";
$arreglo[1] = "NO";

if (isset($_POST["nuc"])) { $nuc = $_POST["nuc"]; }
if (isset($_POST["idMp"])) { $idMp = $_POST["idMp"]; }
if (isset($_POST["mes"])) { $mes = $_POST["mes"]; }
if (isset($_POST["anio"])) { $anio = $_POST["anio"]; }
if (isset($_POST["estatResolucion"])) { $estatResolucion = $_POST["estatResolucion"]; }
if (isset($_POST["idUnidad"])) { $idUnidad = $_POST["idUnidad"]; }
if (isset($_POST["nomImpu_tramite"])) { $nomImpu_tramite = $_POST["nomImpu_tramite"]; }
if (isset($_POST["paternImpu_tramite"])) { $paternImpu_tramite = $_POST["paternImpu_tramite"]; }
if (isset($_POST["maternImpu_tramite"])) { $maternImpu_tramite = $_POST["maternImpu_tramite"]; }
if (isset($_POST["causaPenalImpu_tramite"])) { $causaPenalImpu_tramite = $_POST["causaPenalImpu_tramite"]; }
if (isset($_POST["cuadernoImpu_tramite"])) { $cuadernoImpu_tramite = $_POST["cuadernoImpu_tramite"]; }
if (isset($_POST["requerimientoImpu_tramite"])) { $requerimientoImpu_tramite = $_POST["requerimientoImpu_tramite"]; }
if (isset($_POST["sedeJudicialImpu_tramite"])) { $sedeJudicialImpu_tramite = $_POST["sedeJudicialImpu_tramite"]; }

//////// Ver la determinacion si ya existe en tabla estatusNucs ///////////////////
$datossicap = get_datos_carpeta_capturadoLiti($conSic, $nuc);
$nuc = $datossicap[0][1];
$carpid = $datossicap[0][0];


$queryTransaction = "                              
				BEGIN                     
				BEGIN TRY 
				BEGIN TRANSACTION
				SET NOCOUNT ON    
				
				DECLARE @idEstatusNuc INT;
				DECLARE @idCarpetaTramite INT;
				
				INSERT INTO estatusNucs (nuc, idEstatus, idmp, idUnidad, fecha, anio, mes, idCarpeta) VALUES ('$nuc', $estatResolucion, $idMp, $idUnidad, GETDATE(), $anio, $mes, $carpid)   
				SET @idEstatusNuc = SCOPE_IDENTITY();
				
				INSERT INTO tramiteLitigacion (idEstatusNucs , causaPenal , cuadernoAntecedentes , cuadernoConRequerimiento , archivoEnSedeJudicial) VALUES (@idEstatusNuc , '$causaPenalImpu_tramite'  , '$cuadernoImpu_tramite' , $requerimientoImpu_tramite , $sedeJudicialImpu_tramite)
			    SET @idCarpetaTramite = SCOPE_IDENTITY();
			    
			    INSERT INTO tramiteImputadoLitigacion (idCarpetaTramite , nombre , apellidoPaterno , apellidoMaterno) VALUES (@idCarpetaTramite , '$nomImpu_tramite' , '$paternImpu_tramite' , '$maternImpu_tramite')
			    
			    
				COMMIT
				END TRY
				BEGIN CATCH 
				ROLLBACK TRANSACTION
				RAISERROR('No se realizo la transaccion',16,1)
				END CATCH
				END

				";

$result = sqlsrv_query($conn, $queryTransaction, array(), array("Scrollable" => 'static'));

if ($result) {
    echo json_encode(array('first' => $arreglo[0]));
} else {
    echo json_encode(array('first' => $arreglo[1]));
}

?>