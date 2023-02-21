<?php
session_start();

include("../../Conexiones/Conexion.php");
include("../../funcionesProcesosPenales.php");
$idUsuario = $_SESSION['useridIE'];


if (isset($_GET["idFiscalia"])) {
	$idFiscalia = $_GET["idFiscalia"];
}
$juzgado = getJuzgadosFiscaliasProcesosPenales($conn, $idFiscalia);

if ($idFiscalia == 0) {
?>
	<select style=" margin-right: 0%;" id="juzgado" name="juzgado" tabindex="6" onchange="loadDataProcesosPenales()" class="form-control redondear selectTranparent">

		<option value="0">TODOS</option>

	</select>

<?
} else {

?>
	<select style=" margin-right: 0%;" id="juzgado" onchange="loadDataProcesosPenales()" name="juzgado" tabindex="6" class="form-control redondear selectTranparent" required>
		<?

		for ($h = 0; $h < sizeof($juzgado); $h++) {
		?>
			<option value="<? echo $juzgado[$h][0] ?>">
				<? echo $juzgado[$h][1]; ?>
			</option>
		<?
		}
		?>
	</select>
<?
}

?>