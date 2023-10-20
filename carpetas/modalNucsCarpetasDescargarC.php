<?
session_start();
include("../Conexiones/Conexion.php");
include("../Conexiones/conexionSicap.php");
include("../funciones.php");
include("../funcioneSicap.php");
include("../funcionesCarpetasV2.php");


if (isset($_POST["idUnidad"])) {
	$idUnidad = $_POST["idUnidad"];
}
if (isset($_POST["idEnlace"])) {
	$idEnlace = $_POST["idEnlace"];
}
$idUsuario = $_SESSION['useridIE'];
$hoy = date("Y-m-d"); //Fecha calendario

?>




<div class="col-md-12 col-sm-12 col-xs-12 ghost">
	<div class="panel panel-primary">
		<div class="panel-heading">Descarga de NUCS</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-xs-12 col-sm-6  col-md-6">
					<label for="heard">Año :</label>
					<div id="contenidoEnlacesSelect">
						<select id="añoNuc" class="form-control redondear selectTranparent">
							<option value="0" selected="">Todos</option>
							<?
							$arrayAños = array("2021", "2022", "2023", "2024", "2025", "2026", "2027", "2028", "2029", "2030", "2031", "2032");
							for ($k = 0; $k < sizeof($arrayAños); $k++) {
							?>
								<option value="<? echo $arrayAños[$k] ?>"><? echo $arrayAños[$k] ?></option>
							<?
							}
							?>
						</select>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6  col-md-6">
					<label for="heard">Mes :</label>
					<div id="contenidoEnlacesSelect">
						<select id="mesNuc" class="form-control redondear selectTranparent">
							<option value="0" selected="">Todos</option>
							<?
							$arrayMeses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
							for ($k = 1; $k <= 12; $k++) {
							?>
								<option value="<? echo $k ?>"><? echo $arrayMeses[$k - 1] ?></option>
							<?
							}
							?>
						</select>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6  col-md-6">
					<label for="heard">Unidad :</label>

					<?

					if ($idEnlace == 18 || $idEnlace == 22 || $idEnlace == 16 || $idEnlace == 23 || $idEnlace == 19 || $idEnlace == 15 || $idEnlace == 21 || $idEnlace == 17 || $idEnlace == 14) {


						if ($idEnlace == 18) {
							$unidadedes = "IN(116,117,118,119)";
						}
						if ($idEnlace == 22) {
							$unidadedes = "IN(120,121,122,123,124,125)";
						}
						if ($idEnlace == 16) {
							$unidadedes = "IN(108,109,110,111,112,113,114,115,1008,1009,1010)";
						}
						if ($idEnlace == 23) {
							$unidadedes = "IN(71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,91,94,95,96,97,98)";
						}

						if ($idEnlace == 19) {
							$unidadedes = "IN(62,63,64,65,66,67,68,69,70,152,1005,1006,1050)";
						}
						if ($idEnlace == 15) {
							$unidadedes = "IN(53,54,55,56,57,58,59,60,61,150,151)";
						}
						if ($idEnlace == 21) {
							$unidadedes = "IN(27,28,29,30,31,32,93,102,103)";
						}
						if ($idEnlace == 17) {
							$unidadedes = "IN(16,17,18,19,20,21,22,23,24,25,26,153,154)";
						}
						if ($idEnlace == 14) {
							$unidadedes = "IN(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,92,100,101)";
						}
					} else {
						$unidadEnlace = getUnidadEnlaceFormat($conn, $idEnlace, 1);
						$unidadedes = "IN(" . $unidadEnlace[0][0] . ")";
					}
				
					$uniddsFis = getUnidadesFiscalias22($conn, $unidadedes);

					?>

					<div id="contenidoEnlacesSelect">

						<select id="unidadNuc" class="form-control redondear selectTranparent">
							<?
							if ($idEnlace == 18 || $idEnlace == 22 || $idEnlace == 16 || $idEnlace == 23 || $idEnlace == 19 || $idEnlace == 15 || $idEnlace == 21 || $idEnlace == 17 || $idEnlace == 14) {

							?>
								<option value="0" selected="">Todos</option>
							<?
							}
							for ($k = 0; $k < sizeof($uniddsFis); $k++) {
							?>
								<option value="<? echo $uniddsFis[$k][0] ?>"><? echo $uniddsFis[$k][1]; ?></option>
							<?
							}


							?>
							<?


							?>
						</select>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6  col-md-6">
					<label for="estNuc">Estatus :</label>
					<div id="contenidoEnlacesSelect">
						<select id="estNuc" class="form-control redondear selectTranparent">
							<option value="0" selected="">Todos</option>
							<?

							$estatusArray = getEstatusCarpetas($conn);

							for ($k = 0; $k < sizeof($estatusArray); $k++) {
							?>
								<option value="<? echo $estatusArray[$k][0]; ?>"><? echo $estatusArray[$k][1] ?></option>
							<?
							}
							?>
						</select>
					</div>
				</div>
			</div>
			<div class="row" style="margin-top: 3% !important;">
				<!--<div class="col-xs-12 col-sm-12 col-md-6"><center><button style="width: 100%;" type="button" class="btn btn-primary redondear" onclick="listoNucs(<? echo $numResolJudi; ?>);">Listo</button></center></div>-->
				<div class="col-xs-12 col-sm-3 col-md-3">
					<center><button style="width: 100%; margin-top:25px !important;" type="button" class="btn btn-success redondear" onclick="downloadNucsCarpe(<? echo $idEnlace; ?>)"><i class="far fa-file-excel" style="font-size:1.5em"></i> Descargar</button></center>
				</div>
				<div class="col-xs-12 col-sm-3 co2-md-3">
					<center><button style="width: 100%; margin-top:25px !important;" type="button" class="btn btn-danger redondear" onclick="closeNucsModal()"><i class="fa fa-times-circle" style="font-size:1.5em"></i> Salir</button></center>
				</div>
				<div id="conDescargaNucs"></div>

			</div>
		</div>
	</div>
	<br>

</div>