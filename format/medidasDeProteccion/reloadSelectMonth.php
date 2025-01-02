	<?php

	include("../../Conexiones/Conexion.php");
	include("../../funciones.php");
	include("../../Conexiones/conexionMedidas.php");


	include("../../funcionesMedidasProteccion.php");

	if (isset($_POST["messelected"])) {
		$messelected = $_POST["messelected"];
	}
	if (isset($_POST["anio"])) {
		$anioCaptura = $_POST["anio"];
	}
	if (isset($_POST["idEnlace"])) {
		$idEnlace = $_POST["idEnlace"];
	}

	$currentmonth = date("m");
	$meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
	$mesNom = Mes_Nombre($currentmonth);

	?>



	<select id="mesMedidaSelected" name="selMes" tabindex="6" class="form-control redondear selectTranparent" onchange="loadDaysMonth(<? echo $anioCaptura; ?>, <? echo $idEnlace; ?>, 0)" required>

		<?
		for ($g = 1; $g <= 12; $g++) {
			if ($g == intval($currentmonth)) {
		?>
				<option value="<? echo $currentmonth; ?>" selected><? echo $mesNom; ?></option>
			<?
			} else {
			?>
				<option value="<? echo $g; ?>"><? echo $meses[$g - 1]; ?></option>
		<?
			}
		}
		?>

	</select>