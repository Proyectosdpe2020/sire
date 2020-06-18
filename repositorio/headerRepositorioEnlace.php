<? 

session_start();

include ("../Conexiones/Conexion.php");
include("../funciones.php");

//$calenda=get_calendarizacion($conn,1);

	if (isset($_POST["idUsuario"])){ $idUsuario = $_POST["idUsuario"]; }
	if (isset($_POST["format"])){ $format = $_POST["format"]; }



	$fecha_actual_system=date("d/m/Y");

	$anioactualdate = date("Y");




	


	$enlace = getIdEnlaceUsuario($conn, $idUsuario);
							$idEnlace = $enlace[0][0];


								$mescap = getMesCapEnlaceArchivo($conn, $idEnlace, 1);	
												$mescapen = $mescap[0][0];
												$mesCapturar = $mescapen;


	$anioCaptura = 2020;
	
	 $mesNom = Mes_Nombre($mesCapturar);





?>