<?php
session_start();

	if ($_SESSION['accesSubIndex'] == 0) {
		//si no existe, va a la página de autenticacion
		$format = $_SESSION['idArchivo'];

		header("Location:index.php?format=".$format);
		//salimos de este script
		exit();
	}

include("validar_sesion.php");
include("funciones.php");
include("Conexiones/Conexion.php");
?>

<?php

$mesactualnumero = date("m");
$idUsuario = $_SESSION['useridIE'];
$tipoUser  = $_SESSION['permisosIE'];
$idTipArch = $_SESSION['idArchivo'];

if (isset($_GET["idUnidadSelect"])){ $idUnidadSelect = $_GET["idUnidadSelect"]; }else{

	$idUnidadSelect = 0;
	

}


$enlace = getInfoEnlaceUsuario($conn, $idUsuario);
									$idEnlace = $enlace[0][0];
									$idfisca = $enlace[0][1];
?>


<!DOCTYPE html>
<html lang="en">
<head>
	
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<title>SIRE</title>

		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!-- Meta, title, CSS, favicons, etc. -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<link rel="icon" href="img/pgje.png" type="imag/ico" />	
		<link rel="stylesheet" type="text/css" href="css/estilosPrincipal.css">
		<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
		
		<link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="dist/sweetalert.css">
		<link rel="stylesheet" type="text/css" href="css/principal.css">
		<link rel="stylesheet" type="text/css" href="css/cmascTabs.css">

		<link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="css/formatoCarpetas.css">
		<link rel="stylesheet" type="text/css" href="css/estilosPrincipal.css">
		<link rel="stylesheet" type="text/css" href="css/litigacion.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

</head>
<body style="zoom: 83%; background-size: cover;
  background-attachment: fixed;
  background-image: url('img/Fondo SIRE4-0450.png'); 

  background-repeat: repeat;  
  background-position: center; 
  background-size: 90%; 
  background-position-y: 50%;  " 


<? if ($tipoUser == 1) { 

          ?> 	onload="loadSubIndex(<? echo $idEnlace; ?>);"  <? 
	}


 else {  

		?> onload="loadEnlacesFaltantes();"  <? } ?>

		
		<div id="opacity"></div>
		<header>
				
				<div class="menu">
					<div class="contenedor">
						<div class="logo">Sistema Integral de Registro Estadístico</div>
						<nav>
							<ul>

							<? if ($tipoUser == 1) { 	 ?>
								


								<li>
											
											<a href="javascript:;" data-toggle="dropdown" aria-expanded="false">
											<img class="imagenUserIcon" src="images/default.png" alt="">


											<?php

												echo	$_SESSION['nameIE'];

											?>

											<span class=" fa fa-angle-down"></span>
											</a>
													<ul class="dropdown-menu dropdown-usermenu pull-right">

																<li><a href="cerrar_sesion.php">Cerrar Sesion</a></li>
													</ul>

									</li>
									<? }else{ if($tipoUser == 2){
																?>

																<li><a onclick="loadEnlacesFaltantes()" href="#">Enlaces que Capturan</a></li>
																<li><a onclick="cargaContRepositorioAdmin(<? echo $idUsuario; ?>)" href="#">Mis Archivos</a></li>
																<li>
											
																	<a href="javascript:;" data-toggle="dropdown" aria-expanded="false">
																	<img class="imagenUserIcon" src="images/default.png" alt="">


																	<?php

																		echo	$_SESSION['nameIE'];

																	?>

																	<span class=" fa fa-angle-down"></span>
																	</a>
																<ul class="dropdown-menu dropdown-usermenu pull-right">

																			<li><a href="cerrar_sesion.php">Cerrar Sesion</a></li>
																</ul>

																</li>

																			<?

																}
												} ?>


							</ul>


						</nav>
					</div>
				</div>

		</header>

		<div class="principal contenido">
				
						<div class="" role="">
	<br />

	<div id ="contenido">

		<div style="margin: 0 auto; width: 100%; max-height: 780px; overflow-y: scroll;">
				
				<div class="right_col" role="main" style ="background-image: url('');  background-repeat: no-repeat;  background-position: center center; background-size: 100%; background-position-y: 50%;" >

				</div>

		</div>

	</div>

		<div class="modal fade bs-example-modal-sm" id="myModaFormato" role="dialog" data-backdrop="static" data-keyboard="false">

										<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 30%; margin-top: 1%;">

																	<div class="modal-content">

																					<div id="contMOdalFormato"></div>

																	</div>				
										</div>												

		</div>

		<div class="modal fade bs-example-modal-sm" id="modalNucs" role="dialog" data-backdrop="static" data-keyboard="false">

										<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 30%; margin-top: 1%;">

																	<div class="modal-content">

																					<div id="contmodalnucs"></div>

																	</div>				
										</div>												

					</div>

<div class="modal fade bs-example-modal-sm" id="modalNucsEdit" role="dialog" data-backdrop="static" data-keyboard="false">

										<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 30%; margin-top: 1%;">

																	<div class="modal-content">

																					<div id="contmodalnucsEdit"></div>

																	</div>				
										</div>												

					</div>


		<div class="modal fade bs-example-modal-sm" id="myModaFormatoVer" role="dialog" data-backdrop="static" data-keyboard="false">

										<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 30%; margin-top: 0.5%;">

																	<div class="modal-content" style="">

																					<div id="contMOdalFormatoVer"></div>

																	</div>				
										</div>												

		</div>

		<div class="modal fade bs-example-modal-sm" id="myModaFormatoEditar" role="dialog" data-backdrop="static" data-keyboard="false">

										<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 30%; margin-top: 1%;">

																	<div class="modal-content" style="">

																					<div id="contMOdalFormatoEditar"></div>

																	</div>				
										</div>												

		</div>

		<div class="modal fade bs-example-modal-sm" id="myModaSubirArchivoUser" role="dialog">

										<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 30%; margin-top: 8%;">

																	<div class="modal-content" style="">

																					<div id="contMOdalSubirArchivo"></div>

																	</div>				
										</div>												

		</div>

			<div class="modal fade bs-example-modal-sm" id="myModalUploadAgain" role="dialog">

										<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 30%; margin-top: 8%;">

																	<div class="modal-content" style="">

																					<div id="contMOdalSubirArchivoAgain"></div>

																	</div>				
										</div>												

		</div>
			
			
			<div class="modal fade bs-example-modal-sm" id="myModalVerFormato" role="dialog">

										<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 70%; margin-top: 3%;">

																	<div class="modal-content" style="">												
																						
																								<div class="modal-header" style="background-color:#3f5265;">
																		        <button type="button" class="close" data-dismiss="modal">&times;</button>
																		        <center><h4 class="modal-title" style="color:white; font-weight: bold;">( Ver ) Formato Mensual Estadistico</h4></center>
																		      	</div>

																		      	<div id="contMOdalVerFormato"></div>	

																	</div>				
										</div>												

		</div>

		<div class="modal fade bs-example-modal-sm" id="myModalEnlaceMps" role="dialog">
										<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 40%; margin-top: 3%;">
																	<div class="modal-content" style="">
																		      	<div id="contMOdalEnlaceMps"></div>	
																	</div>				
										</div>											

		</div>

			<div class="modal fade bs-example-modal-sm" id="myModaRevisarArchivo" role="dialog" data-backdrop="static" data-keyboard="false">

										<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 70%; margin-top: 2%;">

																	<div class="modal-content">

																					<div id="contenidoRevisarArchivo"></div>

																	</div>				
										</div>												

					</div>

					<div class="modal fade bs-example-modal-sm" id="myModalConcluirArchivo" data-dissmiss="modal" role="dialog" data-backdrop="static" data-keyboard="false">

										<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 25%; margin-top: 15%;">

																	<div class="modal-content">

																					<div id="concluirArchivo"></div>

																	</div>				
										</div>												

					</div>


				
					

</div>

		</div>

		<script>

</script>


	<script language="JavaScript" type="text/javascript" src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
		<script src="http://code.jquery.com/jquery-latest.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/script.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/cmasc.js"></script>
		<script language="JavaScript" type="text/javascript" src="js/litigacion.js"></script>
<!--<script src="vendors/jquery/dist/jquery.min.js"></script>-->
<script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Custom Theme Scripts -->
<script src="build/js/custom.min.js"></script>
<script language="JavaScript" type="text/javascript" src="dist/sweetalert.min.js"></script>
	    

</body>



