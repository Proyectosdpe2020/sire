<?php
session_start();
include ("../../../Conexiones/Conexion.php");
include("../../../funciones.php");	
include ("../../../Conexiones/conexionMedidas.php");
include("../../../funcionesMedidasProteccion.php");	

$idUsuario = $_SESSION['useridIE'];
if (isset($_POST["messelected"])){ $messelected = $_POST["messelected"]; }	
if (isset($_POST["anio"])){ $anio = $_POST["anio"]; }
if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }
if (isset($_POST["diaselected"])){ $diaselected = $_POST["diaselected"]; }
if (isset($_POST["camMes"])){ $camMes = $_POST["camMes"]; }

if ($camMes == 1 ) { $dianum = date("w",strtotime("01-".$messelected."-".$anio));	 $diaselected = 0;}				
if ($camMes == 0 ) { $dianum = date("w",strtotime($diaselected."-".$messelected."-".$anio));	}
if ($dianum == 0 ) { $dianum = 7;} else{ $dianum = $dianum; }
						
$enlace = getInfoEnlaceUsuario($conn, $idUsuario);
$idfisca = $enlace[0][1];	

$getRolUser = getRolUser($connMedidas, $idEnlace);
$rolUser = $getRolUser[0][0];

?>

				
<? 
	$dataMedidasDia = get_data_medidas_dia($connMedidas, $dianum, $diaselected, $anio, $idfisca, $idEnlace, $messelected, $rolUser);
	for ($h=0; $h < sizeof($dataMedidasDia) ; $h++) {
		$getDataVictimas = getDataVictimas($connMedidas, $dataMedidasDia[$h][0]); 
		$checkEstatus = checkFechaConclusion($dataMedidasDia[$h][19]);
			?>
		<tr>
			<td><? echo $dataMedidasDia[$h][0]; ?></td>
			<td><?if($dataMedidasDia[$h][2] != 0){ echo $dataMedidasDia[$h][3];}else{ ?><p style="color: red;">SIN ASIGNAR <? } ?></p></td>
			<td><? echo $dataMedidasDia[$h][1]; ?></td>
			<td>
				<? 
					if(sizeof($getDataVictimas) > 0){ 
						for ($j=0; $j < sizeof($getDataVictimas) ; $j++) { ?>
							<? echo $getDataVictimas[$j][7] ?> <?
						}
					}
					else{
						echo 'SIN VICTIMA, VERIFIQUE';
					} 
				?>
			</td>
			<td> <? echo $dataMedidasDia[$h][7]; ?> </td>
			<td>
				<?
					$medidasAplicadas = getMedidasAplicadas($connMedidas, $dataMedidasDia[$h][0]);
					if($medidasAplicadas > 0){
						for($i = 0; $i < sizeof($medidasAplicadas); $i++){
							$medidas = getFracciones($connMedidas, $medidasAplicadas[$i][0]);
							echo convertirARomanos($medidasAplicadas[$i][0]).'. '.strval($medidas[0][0]).'<br>';
						}
					}	
					else{
						echo 'No se han registrado Medidas de Protección';
					}
				?>
			</td>					
			<?if($rolUser != 2 ){?> <td><center><? echo $dataMedidasDia[$h][8]; ?><center></td> <? }else{ ?> <td><center><?echo $dataMedidasDia[$h][9]; ?><center></td> <? } ?>
			<?if($rolUser == 1){?><td><center><? echo $dataMedidasDia[$h][18]; ?><center></td><? } ?>
			<?if($rolUser != 3 && $rolUser != 4){?><td><?if($dataMedidasDia[$h][2] != 0){ ?><div class="verdCol" id="circulo"><? }else{ ?> <div class="redCol" id="circulo"> <? } ?></div></td><? } ?>
			<td>
				<?php
					$idResolucion = getIdResoluciones($connMedidas, $dataMedidasDia[$h][0]);					
					$getDataResolucion = getDataResolucion($connMedidas, $idResolucion[0]);

					$resoluciones = ['ratificada', 'ampliada', 'modificada', 'revocada'];
					$resultado = 'No establecido';
					if($getDataResolucion != null){
						foreach($resoluciones as $resolucion){
							if($getDataResolucion[0][$resolucion] == 1){
								$resultado = ucfirst($resolucion);
								break;
							}						
						}
					}
					echo $resultado;
				?>
			</td>
				<?if($rolUser == 1 || $rolUser == 3 || $rolUser == 4){ ?>
				<td>
					<?if($checkEstatus == 'CONCLUIDA'){ ?>
						<div class="verdCol" id="circulo"></div><center> Concluida</center>
						<? }elseif($checkEstatus == 'ACTIVA'){ ?> 
						<div class="yelloCol" id="circulo"></div><center>Vigente</center>
					<? }elseif($checkEstatus == 'NOTRABAJADA'){ ?>
						<div class="redCol" id="circulo"></div><center>Sin medida aplicada</center>
					<? } ?>
				</td>
				<? } ?>
			<td><center><label class="glyphicon glyphicon-edit" data-toggle="modal" href="#puestdispos" onclick="reloadModalMDP(1, <?echo $idEnlace; ?>, <?echo $dataMedidasDia[$h][0]; ?>, 0, 0)" style="width: 95%; cursor: pointer; font-weight: bold; color: green;">  Editar</label></center>
			</td>
		</tr>
	<?	
	}															

?>