<?php
//include("../../funcionesPueDispo.php");	
include("../../Conexiones/conexionMedidas.php");
include("../../funcionesMedidasProteccion.php");
	

$month = isset($_POST['month']) ? $_POST['month'] : null;
$year = isset($_POST['year']) ? $_POST['year'] : null;
$day = isset($_POST['day']) ? $_POST['day'] : null;
$idEnlace = isset($_POST['idEnlace']) ? $_POST['idEnlace'] : null;
$section = isset($_POST['section']) ? $_POST['section'] : null;

if ($section == 0 ) {
    $id = 'diaReporteInicio';
}
else if ($section == 1 ) {
    $id = 'diaReporteFinal';
}

if (date("l") === "Monday") {
    $numeroDia = 1;
    $diaLetra = "Lunes";
}
if (date("l") === "Tuesday") {
    $numeroDia = 2;
    $diaLetra = "Martes";
}
if (date("l") === "Wednesday") {
    $numeroDia = 3;
    $diaLetra = "Miercoles";
}
if (date("l") === "Thursday") {
    $numeroDia = 4;
    $diaLetra = "Jueves";
}
if (date("l") === "Friday") {
    $numeroDia = 5;
    $diaLetra = "Viernes";
}
if (date("l") === "Saturday") {
    $numeroDia = 6;
    $diaLetra = "Sabado";
}
if (date("l") === "Sunday") {
    $numeroDia = 7;
    $diaLetra = "Domingo";
}
$diames = date("d");

?>

<select id="<?= $id ?>" name="selDia" tabindex="6" class="form-control redondear selectTranparent" required>
    <? $diasNumero = cal_days_in_month(CAL_GREGORIAN, $month, $year); ?>
    
    <?php for ($t = 1; $t <= $diasNumero; $t++) {
        if ($t == $day) { 
            $fecha = $t . "-" . $month . "-" . $year;
            $nommesa =  getDiaMesnombre($fecha);
        ?>
            <option value="<? echo $t; ?>" selected> <? echo "" . $nommesa . "-" . $t; ?></option>
        <? } else {
            $fecha = $t . "-" . $month . "-" . $year;
            $nommesa =  getDiaMesnombre($fecha);
        ?>
            <option value="<? echo $t; ?>"> <? echo "" . $nommesa . "-" . $t; ?></option>
    <? }
    } ?>
</select>