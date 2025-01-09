<?php
include("../../Conexiones/Conexion.php");
include("../../Conexiones/conexionMedidas.php");
include("../../Conexiones/conexionSicap.php");
include("../../funcionesMedidasProteccion.php");

$idEnlace = isset($_POST['idEnlace']) ? $_POST['idEnlace'] : null;
$rolUser = isset($_POST['rolUser']) ? $_POST['rolUser'] : null;
$tipo = isset($_POST['tipo']) ? $_POST['tipo'] : null;
$year = isset($_POST['year']) ? $_POST['year'] : null;
$month = isset($_POST['month']) ? $_POST['month'] : null;
$day = isset($_POST['day']) ? $_POST['day'] : null;

$meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
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
<div class="modal-header" style="background-color:#152F4A;">
    <h1>Generar Reporte</h1>
</div>
<div class="modal-body">
    <div id="contFechaReporteInicial" class="row">
        <div class="col mx-5" style="margin-right: 1em;">
            <h4 class="" style="color: black; margin-left: 1.5em;">Ingresar el rango de fechas para realizar el reporte correspondiente.</h4>
            <p style="color: black;" class="mb-0 pb-0">Fecha Incial:</p>
        </div>
        <div class="col-md-4 col">
            <label for="heard">Año:</label><br>
            <select id="anioReporteInicio" name="selAnio" tabindex="6" class="form-control redondear selectTranparent"
                onchange="reloadDaysMonthReport(<?= $idEnlace; ?>, 0)" required>
                <?php
                $dataAnio = getDataAnio();
                for ($i = 0; $i < sizeof($dataAnio); $i++) {
                    $anioCaptura = $dataAnio[$i][0];    ?>
                    <option
                        value="<? echo $anioCaptura; ?>"
                        <?php if (intval($anioCaptura) == $year) { ?> selected <?php } ?>>
                        <? echo $anioCaptura; ?>
                    </option>
                <? } ?>
            </select>
        </div>
        <div class="col-md-4 col">
            <label for="heard">Mes:</label><br>
            <div id="contMonthReportInicio">
                <select id="mesReporteInicio" name="selMes" tabindex="6" class="form-control redondear selectTranparent" 
                    onchange="loadDaysMonthReport(<?= $idEnlace ?>, <?= $year ?>, 0)" required>
                    <?php
                    for ($g = 1; $g <= 12; $g++) {
                        if ($g == $month) { ?>
                            <option value="<? echo $month; ?>" selected><? echo $meses[$g - 1]; ?></option>
                        <? } else { ?>
                            <option value="<? echo $g; ?>"><? echo $meses[$g - 1]; ?></option>
                    <? }
                    } ?>
                </select>
            </div>
        </div>
        <div class="col-md-4 col">
            <label for="heard">Día:</label><br>
            <div id="contDaysReportInicio">
                <select id="diaReporteInicio" name="selDia" tabindex="6" class="form-control redondear selectTranparent" required>
                    <? $diasNumero = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                    for ($t = 1; $t <= $diasNumero; $t++) {
                        if ($t == $diames) { ?>
                            <option value="<? echo $t; ?>" selected> <? echo "" . $diaLetra . "-" . $diames; ?></option>
                        <? } else {
                            $fecha = $t . "-" . $month . "-" . $year;
                            $nommesa =  getDiaMesnombre($fecha);
                        ?>
                            <option value="<? echo $t; ?>"> <? echo "" . $nommesa . "-" . $t; ?></option>
                    <? }
                    } ?>
                </select>
            </div>
        </div>
    </div>
    <div id="contFechaReporteFinal" class="row" style="margin-top: 2em;">
        <div class="col">           
            <p style="color: black;" class="mb-0 pb-0">Fecha Final:</p>
        </div>
        <div class="col col-md-4">
            <label for="heard">Año:</label><br>
            <select id="anioReporteFinal" name="selAnio" tabindex="6" class="form-control redondear selectTranparent"
                onchange="reloadDaysMonthReport(<?= $idEnlace; ?>, 1)" required>
                <?php
                $dataAnio = getDataAnio();
                for ($i = 0; $i < sizeof($dataAnio); $i++) {
                    $anioCaptura = $dataAnio[$i][0];    ?>
                    <option
                        value="<? echo $anioCaptura; ?>"
                        <?php if (intval($anioCaptura) == $year) { ?> selected <?php } ?>>
                        <? echo $anioCaptura; ?>
                    </option>
                <? } ?>
            </select>
        </div>
        <div class="col col-md-4">
            <label for="heard">Mes:</label><br>
            <div id="contMonthReportFinal">
                <select id="mesReporteFinal" name="selMes" tabindex="6" class="form-control redondear selectTranparent" 
                    onchange="loadDaysMonthReport(<?= $idEnlace ?>, <?= $year ?>, 1)" required>
                    <?php
                    for ($g = 1; $g <= 12; $g++) {
                        if ($g == $month) { ?>
                            <option value="<? echo $month; ?>" selected><? echo $meses[$g - 1]; ?></option>
                        <? } else { ?>
                            <option value="<? echo $g; ?>"><? echo $meses[$g - 1]; ?></option>
                    <? }
                    } ?>
                </select>
            </div>
        </div>
        <div class="col col-md-4">
            <label for="heard">Día:</label><br>
            <div id="contDaysReportFinal">
                <select id="diaReporteFinal" name="selDia" tabindex="6" class="form-control redondear selectTranparent" required>
                    <? $diasNumero = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                    for ($t = 1; $t <= $diasNumero; $t++) {
                        if ($t == $diames) { ?>
                            <option value="<? echo $t; ?>" selected> <? echo "" . $diaLetra . "-" . $diames; ?></option>
                        <? } else {
                            $fecha = $t . "-" . $month . "-" . $year;
                            $nommesa =  getDiaMesnombre($fecha);
                        ?>
                            <option value="<? echo $t; ?>"> <? echo "" . $nommesa . "-" . $t; ?></option>
                    <? }
                    } ?>
                </select>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer mt-5">
    <button
        type="button"
        class="btn btn-default"
        data-dismiss="modal"
        onclick="closeModalReporte(<? echo $year; ?>, <? echo $idEnlace; ?>, 0, <? echo $rolUser; ?>)"
        >Cerrar
    </button>
    <button
        type="button"
        class="btn btn-elegante redondear "
        <?php
        if ($tipo == 1) { ?>
        onclick="generarExcel(<?php echo $idEnlace; ?>, <?php echo $rolUser; ?>)"
        ><span class="glyphicon glyphicon-file"></span> Generar Excel
        <? } else { ?>
        onclick="generarPDF(<?php echo $idEnlace; ?>, <?php echo $rolUser; ?>)"
        ><span class="glyphicon glyphicon-file"></span> Generar PDF
        <? } ?>
    </button>
</div>