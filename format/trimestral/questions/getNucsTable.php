<?
include("../../../Conexiones/Conexion.php");
include("../../../funcioneTrimes.php");
include("../../../funciones.php");

if (isset($_GET["quest"])) {
	$quest = $_GET["quest"];
}
if (isset($_GET["per"])) {
	$per = $_GET["per"];
}
if (isset($_GET["anio"])) {
	$anio = $_GET["anio"];
}
if (isset($_GET["anioActual"])) {
	$anioActual = $_GET["anioActual"];
}
if (isset($_GET["mes"])) {
	$mes = $_GET["mes"];
}
if (isset($_GET["idUnidad"])) {
	$idUnidad = $_GET["idUnidad"];
}
if (isset($_GET["idEnlace"])) {
	$idEnlace = $_GET["idEnlace"];
}

if ($per == 1) {
	$m1 = "Enero";
	$m2 = "Febrero";
	$m3 = "Marzo";
	$nme = "Enero - Marzo";
	$arr = array(1, 2, 3);
}
if ($per == 2) {
	$m1 = "Abril";
	$m2 = "Mayo";
	$m3 = "Junio";
	$nme = "Abril - Junio";
	$arr = array(4, 5, 6);
}
if ($per == 3) {
	$m1 = "Julio";
	$m2 = "Agosto";
	$m3 = "Septiembre";
	$nme = "Julio - Septiembre";
	$arr = array(7, 8, 9);
}
if ($per == 4) {
	$m1 = "Octubre";
	$m2 = "Noviembre";
	$m3 = "Diciembre";
	$nme = "Octubre - Diciembre";
	$arr = array(10, 11, 12);
}


$nameQuest = getNamePregunta($conn, $quest);
$nucs = getNucsTrim($conn, $anio, $quest, $idEnlace, $idUnidad, $per, $mes, $anioActual);
?>

<table class="table table-striped text-center">
	<thead>
		<tr>
			<th class="text-center" scope="col">#</th>
			<th class="text-center" scope="col">NUC</th>
			<th class="text-center" scope="col">ACCION</th>
		</tr>
	</thead>
	<tbody>
		<?

		for ($i = 0; $i < sizeof($nucs); $i++) {
		?>
			<tr>
				<th class="text-center" scope="row"><? echo ($i + 1); ?></th>
				<td><? echo $nucs[$i][0]; ?></td>
				<td> <i style="color:brown;" onclick="deleteNucTrimes(<? echo $nucs[$i][1]; ?>)" class="fa fa-trash" aria-hidden="true"> Eliminar</i></td>
			</tr>
		<?
		}

		?>

	</tbody>
</table>