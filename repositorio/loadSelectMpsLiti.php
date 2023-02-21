<? 
	
	include("../Conexiones/Conexion.php");
include("../funciones.php");
include("../funcioneLit.php");
	session_start();

	if (isset($_POST["idUnidad"])){ $idUnidad = $_POST["idUnidad"]; }
	if (isset($_POST["anio"])){ $anio = $_POST["anio"]; }
	if (isset($_POST["mes"])){ $mes = $_POST["mes"]; }

$dataMinisterios = getMpsCapturedLitigacion($conn, $idUnidad, $anio, $mes);
?>

<select onchange="getDataHistoricaBDlitiga(<? echo $idUnidad; ?>)" id="mpsEnlaces" class="form-control redondear selectTranparent">
									<option value="0" selected="">Todos</option>

									<?php

									
									for ($p = 0; $p < sizeof($dataMinisterios); $p++) {
										$idMp = $dataMinisterios[$p][0];
										$idUnidad = $mpsList[$p][3];
										$nomMp = $dataMinisterios[$p][1];
									?> <option value="<? echo $idMp ?>"><?php echo $nomMp; ?></option> <?
																																																																																																															}
																																																																																																																?>

								</select>
