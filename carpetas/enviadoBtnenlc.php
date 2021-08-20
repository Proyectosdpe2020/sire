
	<?php
	session_start();
	include ("../Conexiones/Conexion.php");
	include("../funciones2.php");	
	include ("../Conexiones/conexionSicap.php");
	include("../funcioneSicap.php");

	if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }
	if (isset($_POST["f"])){ $f = $_POST["f"]; }

		$envi = getEnviadoEnlaceFromt($conn, $idEnlace, $f);
	?>

<label class="" for="inputlg" style="color: transparent !important;">.<span class="aste"></span></label>
																																		<button  href=""  style="width: 100%; font-weight: bolder; color: white;" onclick="updateEnviadoEnlceFor(<? echo $envi[0][0]; ?>, <? echo $idEnlace; ?>)" type="button" class="btn btn-<? if($envi[0][0] == 1){echo "success"; }else{ echo "warning"; } ?> redondear"> <? if ($envi[0][0] == 0){ ?> <i class="fa fa-unlock-alt" aria-hidden="true"></i> <? echo " No Enviado"; 	}else{ if($envi[0][0] == 1){ ?> <i class="fa fa-lock" aria-hidden="true"></i> <? echo " Enviado";  } } ?></button>