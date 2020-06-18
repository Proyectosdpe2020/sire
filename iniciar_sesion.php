
<?php
	session_start();

	include ('Conexiones/Conexion.php');
	include("funciones.php");

	$usuario=$_POST['usuario'];
	$password=$_POST['contrasena'];
	
	


	$_SESSION['yainicieIE']="NO";
	if(!empty($_SESSION['usuario']) && !empty($_SESSION['password']))
	{
	$usuario=$_SESSION['usuario'];
	$password=$_SESSION['password'];
	$autenticado=$_SESSION['autenticado'];
	}
	$band=false;


	$sql = "select * from  Usuario where Usuario='$usuario' and Contrasena='$password' and estatus =	'VI'";

	$stmt = sqlsrv_query( $conn, $sql );

	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) )
	{
		//echo $row['usuario'].", ".$row['contrasena']."<br />";
		$_SESSION['contrasenaIE']=$row['contrasena'];
		$_SESSION['nameIE']=$row['nombre'].' '.$row['paterno'].' '.$row['materno'];
		$_SESSION['namecIE']=$row['nombre'];
		$_SESSION['permisosIE']=$row['idTipoUsuario'];
		$_SESSION['useridIE']=$row['idUsuario'];
		$_SESSION['idArchivo']=$row['idTipoArchivo'];


		$idUser = $row['idUsuario'];
		$nickName = $row['usuario'];
		$nombreCompleto = $row['nombre'].' '.$row['paterno'].' '.$row['materno'];



		$band=true;
	}

	if($band)
	{
		$_SESSION['yainicieIE']="SI";

		// Insert is created to ensure user enter to the system

		$ipReal = getIPreal();
		$actualDay = getDiaActual();
		$query = "  INSERT INTO controlAcceso (idUsuario, nombreCompleto, userNick,fechaIngreso, diaIngreso, ipAcceso) VALUES ($idUser,'$nombreCompleto', '$nickName',GETDATE(),'$actualDay','$ipReal')  ";
		$result = sqlsrv_query($conn,$query);


		$enlace = getInfoEnlaceUsuario($conn, $idUser);
									$idEnlace = $enlace[0][0];
									$idfisca = $enlace[0][1];

		$numOFforms = getFormsAccesosEnlace($conn, $idEnlace);
		
		if($numOFforms == 1 ){  



			header("Location: subIndex.php");  
			$_SESSION['accesSubIndex']=1;


			}else{

					header("Location: index.php?format=".$_SESSION['idArchivo']);
					$_SESSION['accesSubIndex']=0;

		}							
		

		



	}
	else
	{

		$_SESSION['yainicieIE']="NO";
		header("Location: login.php?errorusuario=Usuario o Contraseña Incorrecta");
	}

	/*$idUsuario = $_SESSION['useridIE'];
	$usarioAreas = getAreasUsu($conn, $idUsuario);

	for( $i=0; $i<sizeof($usarioAreas); $i++)
									{

										$idArea = $usarioAreas[$i][0];
										$nombreArea = $usarioAreas[$i][1];
										$idFiscalia = $usarioAreas[$i][2];
										$idUsu = $usarioAreas[$i][3];
									}

		$idUrarray = getUrdeUsuario($conn, $idUsuario);
		$idUr = $idUrarray[0][0];


    $titularArea = getTitular($conn, $idArea);
		$titularUR = getTitularUrID($conn, $idUr);


    $nombre = $titularArea[0][0];
    $apellidoPaterno = $titularArea[0][1];
	$apellidoMaterno = $titularArea[0][2];

	$nombreUR = $titularUR[0][1];
	$apellidoPaternoUR = $titularUR[0][2];
$apellidoMaternoUR = $titularUR[0][3];




	$_SESSION['nombretitularIE'] = $nombre.' '.$apellidoPaterno.' '.$apellidoMaterno;
	$_SESSION['nombretitularURIEnombretitularURIE'] = $nombreUR.' '.$apellidoPaternoUR.' '.$apellidoMaternoUR;
	$_SESSION['apePaternotitularIE'] = $apellidoPaterno;
	$_SESSION['apeMaternotitularIE'] = $apellidoMaterno;*/

	exit();

?>
