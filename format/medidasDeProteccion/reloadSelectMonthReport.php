<?php
include("../../Conexiones/Conexion.php");
include("../../funciones.php");
include("../../Conexiones/conexionMedidas.php");
include("../../funcionesMedidasProteccion.php");

$month = isset($_POST['month']) ? $_POST['month'] : null;
$year = isset($_POST['year']) ? $_POST['year'] : null;
$idEnlace = isset($_POST['idEnlace']) ? $_POST['idEnlace'] : null;
$section = isset($_POST['section']) ? $_POST['section'] : null;

if ($section == 0 ) {
    $id = 'mesReporteInicio';
}
else if ($section == 1 ) {
    $id = 'mesReporteFinal';
}

$currentmonth = date("m");
$meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
$mesNom = Mes_Nombre($month);

?>

<select id="<?= $id ?>" name="selMes" tabindex="6" class="form-control redondear selectTranparent" 
    onchange="loadDaysMonthReport(<?= $idEnlace ?>, <?= $year ?>, <?= $section ?>)" required>
    <?php
    for ($g = 1; $g <= 12; $g++) {
        if ($g == $month) { ?>
            <option value="<? echo $month; ?>" selected><? echo $meses[$g - 1]; ?></option>
        <? } else { ?>
            <option value="<? echo $g; ?>"><? echo $meses[$g - 1]; ?></option>
    <? }
    } ?>
</select>