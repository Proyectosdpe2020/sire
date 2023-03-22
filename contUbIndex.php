<?php
session_start();
include("Conexiones/Conexion.php");
include("funciones.php");
include("Conexiones/conexionSicap.php");
include("funcioneSicap.php");


if (isset($_POST["idEnlace"])) {
	$idEnlace = $_POST["idEnlace"];
}
$dataEnlaceArc = getArchvsEnla($conn, $idEnlace);
$tam = sizeof($dataEnlaceArc);
if ($tam == 2) {
	$colum = "6";
}
if ($tam == 3) {
	$colum = "4";
}
?>


<?php
// SON LOS ENLACES QUE SOLO ENTRAN A VER EL LINK DEL BI DE CARPETAS Y LITIGACION SI NO SON ELLOS ENVIA AL CORRESPONDIENTE
if ($idEnlace == 486 || $idEnlace == 489 || $idEnlace == 490) {
?>
	<div class="right_col" role="main">
		<div style="" class="x_panel principalPanel">
			<center><div class="row" style="height: 100vh !important; width:45% !important;">
				<div class="col-xs-12 col-sm-12 col-md-6 BILOGO carpetasLogo" onclick="">
				<div id="logoBIvi">
				<a target="_blank" href="https://app.powerbi.com/view?r=eyJrIjoiYjI2MWJhYTctNzFiYi00ZjliLTllMWQtM2U0ZmI4YWU3MDliIiwidCI6ImZjY2YwMTQ5LWYzNTQtNGU2My1hNzExLTA5YjkzYTE3NzVkMiIsImMiOjR9">
					<div class="imgBIVizual"></div>
				</a>
						</div>
				</div>
					<div class="col-xs-12 col-sm-12 col-md-6 BILOGO carpetasLogo" onclick="enviarAindex(19);">
				<div id="logoBIvi">
				<a href="">
					<div class="imgCentralMandamientos"></div>
				</a>
						</div>
				</div>
			</div></center>
		</div>
	</div>
<?php
} else {
?>
	<div class="right_col" role="main">
		<div style="" class="x_panel principalPanel">
			<div class="row" style="height: 100vh !important; overflow-y: scroll !important;">
				<?
				for ($i = 0; $i < sizeof($dataEnlaceArc); $i++) {

					if ($dataEnlaceArc[$i][0] == 1) {
				?>
						<div class="col-xs-12 col-sm-<? echo $colum; ?> col-md-<? echo $colum; ?> carpetasLogo " onclick="enviarAindex(1);">
							<div id="imgCarpeLogo">
								<div class="imgCentralCarpe <? if ($tam == 3) {
																																					echo "img80";
																																				} else {
																																					echo "img60";
																																				} ?>"></div>
							</div>
						</div>
					<? }
					if ($dataEnlaceArc[$i][0] == 4) {
					?>
						<div class="col-xs-12 col-sm-<? echo $colum; ?>  col-md-<? echo $colum; ?> litigacionLogo" onclick="enviarAindex(4);">
							<div id="imgLitiLogo">
								<div class="imgCentralLit <? if ($tam == 3) {
																																			echo "img70";
																																		} else {
																																			echo "img50";
																																		} ?>"></div>
							</div>
						</div>
					<? }
					if ($dataEnlaceArc[$i][0] == 11) {
					?>
						<div class="col-xs-12 col-sm-<? echo $colum; ?>  col-md-<? echo $colum; ?> litigacionLogo" onclick="enviarAindex(11);">
							<div id="imgLitiLogo">
								<div class="imgCentralTrimestral <? if ($tam == 3) {
																																										echo "img80";
																																									} else {
																																										echo "img50";
																																									} ?>"></div>
							</div>
						</div>
					<? }
					if ($dataEnlaceArc[$i][0] == 12) {
					?>
						<div class="col-xs-12 col-sm-<? echo $colum; ?>  col-md-<? echo $colum; ?> policiaLogo" onclick="enviarAindex(12);">
							<div id="imgPoliLogo">
								<div class="imgCentralPolicia <? if ($tam == 3) {
																																							echo "img80";
																																						} else {
																																							echo "img50";
																																						} ?>"></div>
							</div>
						</div>
					<? }
					if ($dataEnlaceArc[$i][0] == 15) {
					?>
						<div class="col-xs-12 col-sm-<? echo $colum; ?>  col-md-<? echo $colum; ?> carpJudLogo" onclick="enviarAindex(15);">
							<div id="imgCarpJud">
								<div class="imgCarpJud <? if ($tam == 3) {
																																echo "img80";
																															} else {
																																echo "img50";
																															} ?>"></div>
							</div>
						</div>
			<? }
				}
			}
			?>
			</div>
		</div>
	</div>