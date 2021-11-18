<?php
				session_start();
				include ("../../../Conexiones/Conexion.php");
				include("../../../funciones.php");	
				include ("../../../Conexiones/conexionMedidas.php");
				include("../../../funcionesMedidasProteccion.php");	

				if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }
			 $getRolUser = getRolUser($connMedidas, $idEnlace);
    $rolUser = $getRolUser[0][0];

    //Checar carpetas faltantes de asignar al mes
$checkCarpetas = getCarpetasFaltante($connMedidas);
$totalPendientes = $checkCarpetas[0][0];

?>
<a href="#" class="alert-link" onclick="modalCheckPendientes(<?echo $rolUser; ?>, <?echo $idEnlace; ?>)">Carpetas pendientes por asignar a Ministerio Publico: </a><label><br><?echo $totalPendientes; ?><br></label>