<?php

include("../../Conexiones/conexionSicap.php");
include("../../funcioneSicap.php");

include("../../Conexiones/Conexion.php");
include("../../funciones.php");
include("../../funcioneLit.php");

if(isset($_POST["idMp"])){ $idMp = $_POST["idMp"]; } 
if(isset($_POST["mes"])){ $mes = $_POST["mes"]; } 
if(isset($_POST["anio"])){ $anio = $_POST["anio"]; } 
if(isset($_POST["estatResolucion"])){ $estatResolucion = $_POST["estatResolucion"]; } 
if(isset($_POST["idUnidad"])){ $idUnidad = $_POST["idUnidad"]; } 

if (isset($_POST["acc"])) { $acc = $_POST["acc"]; }


switch ($acc) {

	case 'save_no_data_imp':

	if (isset($_POST["nuc"])) { $nuc = $_POST["nuc"]; }
	if (isset($_POST["imputado_idLitigacion"])) { $imputado_idLitigacion = $_POST["imputado_idLitigacion"]; }
	if (isset($_POST["etapa_id"])) { $etapa_id = $_POST["etapa_id"]; }

	//////// Ver la determinacion si ya existe en tabla estatusNucs ///////////////////
	$datossicap = get_datos_carpeta_capturadoLiti($conSic, $nuc);
	$carpid = $datossicap[0][0];

		$arreglo[0] = "SI";
		$arreglo[1] = "NO";

	$queryTransaction = "                              
				BEGIN                     
				BEGIN TRY 
				BEGIN TRANSACTION
				SET NOCOUNT ON    
				
				DECLARE @idEstatusNuc INT;
				INSERT INTO estatusNucs (nuc, idEstatus, idmp, idUnidad, fecha, anio, mes, idCarpeta) VALUES ('$nuc', $estatResolucion, $idMp, $idUnidad, GETDATE(), $anio, $mes, $carpid)   
				SET @idEstatusNuc = SCOPE_IDENTITY();

				INSERT INTO [ESTADISTICAV2].[dbo].[imputadoLitigacionDetermNuc] VALUES($imputado_idLitigacion,$estatResolucion, '$nuc',@idEstatusNuc)

				INSERT INTO [ESTADISTICAV2].[senap].[motivoCarpetasTramite] VALUES(@idEstatusNuc, $etapa_id, '$nuc')

				SELECT MAX(idEstatusNucs) AS idEstatusNucs FROM estatusNucs
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
					while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
						$idEstatusNucs = $row['idEstatusNucs']; //Obtenemos el idEstatusNucs para guardar datos de senap
					}
					$arreglo[2] = $idEstatusNucs;
					echo json_encode(array('first' => $arreglo[0], 'idEstatusNucs' => $arreglo[2]));
				} else {
					echo json_encode(array('first' => $arreglo[1]));
				}
	break;

	case 'save_data_imp':

	if (isset($_POST["nuc"])) { $nuc = $_POST["nuc"]; }
	if (isset($_POST["imputado_nombre"])) { $imputado_nombre = $_POST["imputado_nombre"]; }
	if (isset($_POST["imputado_ap_paterno"])) { $imputado_ap_paterno = $_POST["imputado_ap_paterno"]; }
	if (isset($_POST["imputado_ap_materno"])) { $imputado_ap_materno = $_POST["imputado_ap_materno"]; }
	if (isset($_POST["imputado_edad"])) { $imputado_edad = $_POST["imputado_edad"]; }
	if (isset($_POST["imputado_sexo"])) { $imputado_sexo = $_POST["imputado_sexo"]; }
	if (isset($_POST["imputado_curp"])) { $imputado_curp = $_POST["imputado_curp"]; }
	if (isset($_POST["etapa_id"])) { $etapa_id = $_POST["etapa_id"]; }
 


	//////// Ver la determinacion si ya existe en tabla estatusNucs ///////////////////
	$datossicap = get_datos_carpeta_capturadoLiti($conSic, $nuc);
	$carpid = $datossicap[0][0];

		$arreglo[0] = "SI";
		$arreglo[1] = "NO";

	$queryTransaction = "                              
				BEGIN                     
				BEGIN TRY 
				BEGIN TRANSACTION
				SET NOCOUNT ON    
				
				DECLARE @idEstatusNuc INT;
				DECLARE @idImputadoLitigacion INT;

				INSERT INTO estatusNucs (nuc, idEstatus, idmp, idUnidad, fecha, anio, mes, idCarpeta) VALUES ('$nuc', $estatResolucion, $idMp, $idUnidad, GETDATE(), $anio, $mes, $carpid)   
				SET @idEstatusNuc = SCOPE_IDENTITY();

				INSERT INTO [ESTADISTICAV2].[dbo].[imputadoLitigacion] (nombre , paterno , materno , edad , sexo , curp , nuc) VALUES('$imputado_nombre' , '$imputado_ap_paterno ' , '$imputado_ap_materno' , $imputado_edad , '$imputado_sexo' , '$imputado_curp' , '$nuc')
				SET @idImputadoLitigacion = SCOPE_IDENTITY();

				INSERT INTO [ESTADISTICAV2].[dbo].[imputadoLitigacionCarpeta] (idImputadoLitigacion , nuc) VALUES(@idImputadoLitigacion , '$nuc')

				INSERT INTO [ESTADISTICAV2].[dbo].[imputadoLitigacionDetermNuc] (idImputadoLitigacion , idEstatus , nuc , idEstatusNucs) VALUES(@idImputadoLitigacion,$estatResolucion, '$nuc',@idEstatusNuc)

				INSERT INTO [ESTADISTICAV2].[senap].[motivoCarpetasTramite] VALUES(@idEstatusNuc, $etapa_id, '$nuc')

				SELECT MAX(idEstatusNucs) AS idEstatusNucs FROM estatusNucs
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
					while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
						$idEstatusNucs = $row['idEstatusNucs']; //Obtenemos el idEstatusNucs para guardar datos de senap
					}
					$arreglo[2] = $idEstatusNucs;
					echo json_encode(array('first' => $arreglo[0], 'idEstatusNucs' => $arreglo[2]));
				} else {
					echo json_encode(array('first' => $arreglo[1]));
				}
	break;

}


	?>