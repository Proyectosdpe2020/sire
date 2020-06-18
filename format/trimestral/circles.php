
	<?php
	session_start();
	include ("../../Conexiones/Conexion.php");
	include("../../funciones.php");	
	include ("../../Conexiones/conexionSicap.php");
		include("../../funcioneLit.php");
	include("../../funcioneTrimes.php");

	if (isset($_GET["per"])){ $per = $_GET["per"]; }
					if (isset($_GET["anio"])){ $anio = $_GET["anio"]; }
					if (isset($_GET["idUnidad"])){ $idUnidad = $_GET["idUnidad"]; }
					if (isset($_GET["idEnlace"])){ $idEnlace = $_GET["idEnlace"]; }

	?>
								  					<?  
								  							$arrQue2 = array(3, 4); $validaQuest2 = validaQuest($conn, $arrQue2, $per, $anio, $idUnidad);
								  							$arrQue4 = array(8, 9); $validaQuest4 = validaQuest($conn, $arrQue4, $per, $anio, $idUnidad);
								  							$arrQue1 = array(1, 2); $validaQuest1 = validaQuest($conn, $arrQue1, $per, $anio, $idUnidad);
								  							$arrQue3 = array(5, 6, 7); $validaQuest3 = validaQuest($conn, $arrQue3, $per, $anio, $idUnidad);
								  							$arrQue5 = array(10, 11, 12, 13, 14); $validaQuest5 = validaQuest($conn, $arrQue5, $per, $anio, $idUnidad);
								  								$arrQue6 = array(15,16,17); $validaQuest6 = validaQuest($conn, $arrQue6, $per, $anio, $idUnidad);

								  					 ?>
								    				<table class="tablecircles">
								    						<tr>
								    								<td><button onclick="getQUestionAjax(1,<? echo $per; ?>,<? echo $anio; ?>, <? echo $idUnidad; ?>, <? echo $idEnlace; ?>)" class="circle <? if($validaQuest1 == 1){ echo "circleOk"; }else{ echo "circleNone"; } ?>"><h4>1</h4></button></td>
								    								<td><button onclick="getQUestionAjax(2,<? echo $per; ?>,<? echo $anio; ?>, <? echo $idUnidad; ?>, <? echo $idEnlace; ?>)" class="circle <? if($validaQuest2 == 1){ echo "circleOk"; }else{ echo "circleNone"; } ?>"><h4>2</h4></button></td>
								    								<td><button onclick="getQUestionAjax(3,<? echo $per; ?>,<? echo $anio; ?>, <? echo $idUnidad; ?>, <? echo $idEnlace; ?>)" class="circle <? if($validaQuest3 == 1){ echo "circleOk"; }else{ echo "circleNone"; } ?>"><h4>3</h4></button></td>
								    								<td><button onclick="getQUestionAjax(4,<? echo $per; ?>,<? echo $anio; ?>, <? echo $idUnidad; ?>, <? echo $idEnlace; ?>)" class="circle <? if($validaQuest4 == 1){ echo "circleOk"; }else{ echo "circleNone"; } ?>"><h4>4</h4></button></td>
								    								<td><button onclick="getQUestionAjax(5,<? echo $per; ?>,<? echo $anio; ?>, <? echo $idUnidad; ?>, <? echo $idEnlace; ?>)" class="circle <? if($validaQuest5 == 1){ echo "circleOk"; }else{ echo "circleNone"; } ?>"><h4>5</h4></button></td>
								    								<td><button onclick="getQUestionAjax(6,<? echo $per; ?>,<? echo $anio; ?>, <? echo $idUnidad; ?>, <? echo $idEnlace; ?>)" class="circle <? if($validaQuest6 == 1){ echo "circleOk"; }else{ echo "circleNone"; } ?>"><h4>6</h4></button></td>
								    								<td><button onclick="getQUestionAjax(7,<? echo $per; ?>,<? echo $anio; ?>, <? echo $idUnidad; ?>, <? echo $idEnlace; ?>)" class="circle circleNone"><h4>7</h4></button></td>
								    								<td><button onclick="getQUestionAjax(8,<? echo $per; ?>,<? echo $anio; ?>, <? echo $idUnidad; ?>, <? echo $idEnlace; ?>)" class="circle circleNone"><h4>8</h4></button></td>
								    								<td><button onclick="getQUestionAjax(9,<? echo $per; ?>,<? echo $anio; ?>, <? echo $idUnidad; ?>, <? echo $idEnlace; ?>)"class="circle circleNone"><h4>9</h4></button></td>
								    								<td><button onclick="getQUestionAjax(10,<? echo $per; ?>,<? echo $anio; ?>, <? echo $idUnidad; ?>, <? echo $idEnlace; ?>)" class="circle circleNone"><h4>10</h4></button></td>
								    						</tr>
								    				</table>	