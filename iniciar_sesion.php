
<?php
session_start();

include('Conexiones/Conexion.php');
include("funciones.php");
include("validateInjectionString.php");

$usuario = cleanTextInjec($_POST['usuario']);
$password = cleanTextInjec($_POST['contrasena']);
$_SESSION['yainicieIE'] = "NO";
if (!empty($_SESSION['usuario']) && !empty($_SESSION['password'])) {
	$usuario = $_SESSION['usuario'];
	$password = $_SESSION['password'];
	$autenticado = $_SESSION['autenticado'];
}
$band = false;
$sp_getPassword = "EXEC SP_DECRYPTPASSWORD '" . $usuario . "'";
$stmtSP = sqlsrv_query($conn, $sp_getPassword);
while ($rowSP = sqlsrv_fetch_array($stmtSP, SQLSRV_FETCH_ASSOC)) {
	$passwordDecrypted	= $rowSP['password'];
}
if ($passwordDecrypted === $password) {
	$sql = "select * from  Usuario where Usuario='$usuario' and estatus = 'VI'";	
	$stmt = sqlsrv_query($conn, $sql);
	while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
		$_SESSION['nameIE'] = $row['nombre'] . ' ' . $row['paterno'] . ' ' . $row['materno'];
		$_SESSION['namecIE'] = $row['nombre'];
		$_SESSION['permisosIE'] = $row['idTipoUsuario'];
		$_SESSION['useridIE'] = $row['idUsuario'];
		$_SESSION['idArchivo'] = $row['idTipoArchivo'];
		$idUser = $row['idUsuario'];
		$nickName = $row['usuario'];
		$nombreCompleto = $row['nombre'] . ' ' . $row['paterno'] . ' ' . $row['materno'];
		$band = true;
	}
	if ($_SESSION['idArchivo'] == 14) {
		$nameFormat = "Forestales";
	}
	if ($_SESSION['idArchivo'] == 13) {
		$nameFormat = "estadoDeFuerza";
	}
	if ($_SESSION['idArchivo'] == 12) {
		$nameFormat = "PoliciaConsulta";
	}
	if ($_SESSION['idArchivo'] == 10) {
		$nameFormat = "PoliciaAdmin";
	}
	if ($_SESSION['idArchivo'] == 9) {
		$nameFormat = "Policia";
	}
	if ($_SESSION['idArchivo'] == 1) {
		$nameFormat = "CarpetasInvestigacion";
	}
	if ($_SESSION['idArchivo'] == 4) {
		$nameFormat = "Litigacion";
	}
	if ($_SESSION['idArchivo'] == 11) {
		$nameFormat = "Trimestral";
	}
	if ($_SESSION['idArchivo'] == 0) {
		$nameFormat = "Administrador";
	}
	if ($_SESSION['idArchivo'] == 15) {
		$nameFormat = "carpetasJudicializadas";
	}
	if ($_SESSION['idArchivo'] == 17) {
		$nameFormat = "ControlProcesos";
	}
	if ($_SESSION['idArchivo'] == 16) {
		$nameFormat = "medidasDeProteccion";
	}
	if ($_SESSION['idArchivo'] == 18) {
		$nameFormat = "mandamientosJudiciales";
	}
	if ($_SESSION['idArchivo'] == 21) {
		$nameFormat = "procesosPenales";
	}
	if ($_SESSION['idArchivo'] == 23) {
		$nameFormat = "Busquedas";
	}



	if ($band) {
		$_SESSION['yainicieIE'] = "SI";
		// Insert is created to ensure user enter to the system
		$ipReal = getIPreal();
		$actualDay = getDiaActual();
		$query = "  INSERT INTO controlAcceso (idUsuario, nombreCompleto, userNick,fechaIngreso, diaIngreso, ipAcceso) VALUES ($idUser,'$nombreCompleto', '$nickName',GETDATE(),'$actualDay','$ipReal')  ";
		$result = sqlsrv_query($conn, $query);
		$enlace = getInfoEnlaceUsuario($conn, $idUser);
		$idEnlace = $enlace[0][0];
		$idfisca = $enlace[0][1];
		$numOFforms = getFormsAccesosEnlace($conn, $idEnlace);
		///// VALIDAR QUE SEA UN USUARIO TIPO VISUALIZADOR DE BI PARA SUBINDEX /////
		if ($_SESSION['idArchivo'] == 22) {
			header("Location: subIndex.php");
			$_SESSION['accesSubIndex'] = 1;
			$_SESSION['visualizaBI'] = 1;
		} else {
			if ($numOFforms == 1) {
				header("Location: subIndex.php");
				$_SESSION['accesSubIndex'] = 1;
			} else {
				header("Location: " . $nameFormat);
				$_SESSION['accesSubIndex'] = 0;
			}
		}
	} else {
		$_SESSION['yainicieIE'] = "NO";
		header("Location: login.php?errorusuario=Usuario o Contraseña Incorrecta");
	}
	exit();
} else {
	$_SESSION['yainicieIE'] = "NO";
	header("Location: login.php?errorusuario=Usuario o Contraseña Incorrecta");
}

?>
