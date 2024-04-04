<?
include("../../../Conexiones/Conexion.php");
include("../../../funcioneTrimes.php");
include("../../../funciones.php");

if (isset($_GET["per"])) {
	$per = $_GET["per"];
}
if (isset($_GET["anio"])) {
	$anio = $_GET["anio"];
}
if (isset($_GET["idUnidad"])) {
	$idUnidad = $_GET["idUnidad"];
}
if (isset($_GET["idEnlace"])) {
	$idEnlace = $_GET["idEnlace"];
}

if ($per == 1) {
	$m1 = "Enero";
	$mes1 = 1;
	$m2 = "Febrero";
	$mes2 = 2;
	$m3 = "Marzo";
	$mes3 = 3;
	$nme = "Enero - Marzo";
}
if ($per == 2) {
	$mes1 = 4;
	$m1 = "Abril";
	$mes2 = 5;
	$m2 = "Mayo";
	$mes3 = 6;
	$m3 = "Junio";
	$nme = "Abril - Junio";
}
if ($per == 3) {
	$mes1 = 7;
	$m1 = "Julio";
	$mes2 = 8;
	$m2 = "Agosto";
	$mes3 = 9;
	$m3 = "Septiembre";
	$nme = "Julio - Septiembre";
}
if ($per == 4) {
	$mes1 = 10;
	$m1 = "Octubre";
	$mes2 = 11;
	$m2 = "Noviembre";
	$mes3 = 12;
	$m3 = "Diciembre";
	$nme = "Octubre - Diciembre";
}

$data = getDAtaQuestion($conn, 52, $per, $anio, $idUnidad);
$data2 = getDAtaQuestion($conn, 53, $per, $anio, $idUnidad);
$data3 = getDAtaQuestion($conn, 54, $per, $anio, $idUnidad);
$data4 = getDAtaQuestion($conn, 55, $per, $anio, $idUnidad);
$getEnv = getInfOCarpetasEnv($conn, $idEnlace, 11);
$envt = $getEnv[0][0];
$sumTotal = $data[0][3] + $data2[0][3] + $data3[0][3] + $data4[0][3];
?>



<h5 class="card-title tituloPregunta">Pregunta 10: Sentencias condenatorias o absolutorias <?php echo "$anio"; ?></h5><br>
<div class="textoPregunta">
	<ul>
		<li style="list-style-type: circle !important">
			De los procedimientos derivados de las carpetas de investigación iniciadas en el año <?php echo "$anio"; ?>, ¿cuántos imputados tuvieron sentencias condenatorias o absolutorias por tipo de procedimiento?
		</li>
	</ul>
</div><br><br>
<div class="textoNota">
	<ul>
		<li style="list-style-type: circle !important">
			<div class="imagenWarning">
				Un imputado con una o más sentencias absolutorias y ninguna condenatoria se contabilizará como un imputado con sentencia absolutoria.
			</div>
		</li>
	</ul>
</div><br>
<div class="textoNota">
	<ul>
		<li style="list-style-type: circle !important">
			<div class="imagenWarning">
				Un imputado con una o más sentencias condenatorias se contabilizará como un imputado con sentencia condenatoria.
			</div>
		</li>
	</ul>
</div><br>
<div class="textoNota">
	<ul>
		<li style="list-style-type: circle !important">
			<div class="imagenWarning">
				Un imputado con una o más sentencias absolutorias y una o más sentencias condenatorias se contabilizará como un imputado con sentencia condenatoria.
			</div>
		</li>
	</ul>
</div><br>
<hr><br>
<table class="tableTrimes">
	<thead>
		<tr>
			<th scope="col">No.</th>
			<th scope="col">Imputados con sentencia</th>
			<th scope="col">2017</th>
			<th scope="col">2018</th>
			<th scope="col">2019</th>
			<th scope="col">2020</th>
			<th scope="col">2021</th>
			<th scope="col">2022</th>
			<th scope="col">2023</th>
			<th scope="col">Años Anteriores</th>
			<th scope="col"><? echo $m1; ?></th>
			<th scope="col"><? echo $m2; ?></th>
			<th scope="col"><? echo $m3; ?></th>
			<th scope="col" style="background-color: #C09F77;">Total</th>
		</tr>
	</thead>
	<tbody>
		<?

		$dataQuestAn52 = getDataAnteriores($conn, 52, $idEnlace, $idUnidad, $anio, $per);
		$dataQuestAn53 = getDataAnteriores($conn, 53, $idEnlace, $idUnidad, $anio, $per);
		$dataQuestAn54 = getDataAnteriores($conn, 54, $idEnlace, $idUnidad, $anio, $per);
		$dataQuestAn55 = getDataAnteriores($conn, 55, $idEnlace, $idUnidad, $anio, $per);

		$d10 = getArrayCounts($conn, 52, $idEnlace, $idUnidad, $per, 0);
		$d11 = getArrayCounts($conn, 53, $idEnlace, $idUnidad, $per, 0);
		$d12 = getArrayCounts($conn, 54, $idEnlace, $idUnidad, $per, 0);
		$d13 = getArrayCounts($conn, 55, $idEnlace, $idUnidad, $per, 0);


		$d101 = getCountNucsTrim($conn, $anio, 52, $idEnlace, $idUnidad, $per, $mes1);
		$d102 = getCountNucsTrim($conn, $anio, 52, $idEnlace, $idUnidad, $per, $mes2);
		$d103 = getCountNucsTrim($conn, $anio, 52, $idEnlace, $idUnidad, $per, $mes3);
		$totd10 = $d101[0][0] + $d102[0][0] + $d103[0][0];

		$d111 = getCountNucsTrim($conn, $anio, 53, $idEnlace, $idUnidad, $per, $mes1);
		$d112 = getCountNucsTrim($conn, $anio, 53, $idEnlace, $idUnidad, $per, $mes2);
		$d113 = getCountNucsTrim($conn, $anio, 53, $idEnlace, $idUnidad, $per, $mes3);
		$totd11 = $d111[0][0] + $d112[0][0] + $d113[0][0];

		$d121 = getCountNucsTrim($conn, $anio, 54, $idEnlace, $idUnidad, $per, $mes1);
		$d122 = getCountNucsTrim($conn, $anio, 54, $idEnlace, $idUnidad, $per, $mes2);
		$d123 = getCountNucsTrim($conn, $anio, 54, $idEnlace, $idUnidad, $per, $mes3);
		$totd12 = $d121[0][0] + $d122[0][0] + $d123[0][0];

		$d131 = getCountNucsTrim($conn, $anio, 55, $idEnlace, $idUnidad, $per, $mes1);
		$d132 = getCountNucsTrim($conn, $anio, 55, $idEnlace, $idUnidad, $per, $mes2);
		$d133 = getCountNucsTrim($conn, $anio, 55, $idEnlace, $idUnidad, $per, $mes3);
		$totd13 = $d131[0][0] + $d132[0][0] + $d133[0][0];

		$todgene = $totd10+$totd11+$totd12+$totd13;

		?>
		<tr>
			<th scope="row">10.1</th>
			<td style="text-align: left;">Número de imputados con sentencia condenatoria por procedimiento abreviado</td>
   	<input style="display: none !important;" type="number" value="0" id="p52m1">
				<input style="display: none !important;" type="number" value="0" id="p52m2">
				<input style="display: none !important;" type="number" value="0" id="p52m3">
			<td class="cPo" onclick="loaNucTrimeShow(0,2017, <? echo $per; ?>, 52, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d10[0]; ?><input type="hidden" value="<? echo $d10[0]; ?>" id="1val2017"></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2018, <? echo $per; ?>, 52, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d10[1]; ?><input type="hidden" value="<? echo $d10[1]; ?>" id="1val2018"></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2019, <? echo $per; ?>, 52, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d10[2]; ?><input type="hidden" value="<? echo $d10[2]; ?>" id="1val2019"></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2020, <? echo $per; ?>, 52, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d10[3]; ?><input type="hidden" value="<? echo $d10[3]; ?>" id="1val2020"></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2021, <? echo $per; ?>, 52, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d10[4]; ?><input type="hidden" value="<? echo $d10[4]; ?>" id="1val2021"></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2022, <? echo $per; ?>, 52, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d10[5]; ?><input type="hidden" value="<? echo $d10[5]; ?>" id="1val2022"></td>
								<td class="cPo" onclick="loaNucTrimeShow(0,2023, <? echo $per; ?>, 52, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d10[6]; ?><input type="hidden" value="<? echo $d10[6]; ?>" id="1val2023"></td>

							<td class="cPo" onclick="loaNucTrimes(0,0, <? echo $per; ?>, 52, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)">Capturar</td>

							<td class="cPo" onclick="loaNucTrimes(<? echo $mes1; ?>,<? echo $anio; ?>, <? echo $per; ?>, 52, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d101[0][0]; ?></td>
							<td class="cPo" onclick="loaNucTrimes(<? echo $mes2; ?>,<? echo $anio; ?>, <? echo $per; ?>, 52, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d102[0][0]; ?></td>
							<td class="cPo" onclick="loaNucTrimes(<? echo $mes3; ?>,<? echo $anio; ?>, <? echo $per; ?>, 52, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d103[0][0]; ?></td>
							<td class="blockInp"><input type="number" value="<? echo $totd10; ?>" id="p10tot" readonly></td>
		</tr>
		<tr>
			<th scope="row">10.2</th>
			<input style="display: none !important;" type="number" value="0" id="p53m1">
				<input style="display: none !important;" type="number" value="0" id="p53m2">
				<input style="display: none !important;" type="number" value="0" id="p53m3">
			<td style="text-align: left;">Número de imputados con sentencia absolutoria por procedimiento abreviado</td>
			<td class="cPo" onclick="loaNucTrimeShow(0,2017, <? echo $per; ?>, 53, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d11[0]; ?><input type="hidden" value="<? echo $d11[0]; ?>" id="2val2017"></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2018, <? echo $per; ?>, 53, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d11[1]; ?><input type="hidden" value="<? echo $d11[1]; ?>" id="2val2018"></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2019, <? echo $per; ?>, 53, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d11[2]; ?><input type="hidden" value="<? echo $d11[2]; ?>" id="2val2019"></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2020, <? echo $per; ?>, 53, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d11[3]; ?><input type="hidden" value="<? echo $d11[3]; ?>" id="2val2020"></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2021, <? echo $per; ?>, 53, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d11[4]; ?><input type="hidden" value="<? echo $d11[4]; ?>" id="2val2021"></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2022, <? echo $per; ?>, 53, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d11[5]; ?><input type="hidden" value="<? echo $d11[5]; ?>" id="2val2022"></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2023, <? echo $per; ?>, 53, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d11[6]; ?><input type="hidden" value="<? echo $d11[6]; ?>" id="2val2023"></td>

							<td class="cPo" onclick="loaNucTrimes(0,0, <? echo $per; ?>, 53, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)">Capturar</td>

							<td class="cPo" onclick="loaNucTrimes(<? echo $mes1; ?>,<? echo $anio; ?>, <? echo $per; ?>, 53, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d111[0][0]; ?></td>
							<td class="cPo" onclick="loaNucTrimes(<? echo $mes2; ?>,<? echo $anio; ?>, <? echo $per; ?>, 53, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d112[0][0]; ?></td>
							<td class="cPo" onclick="loaNucTrimes(<? echo $mes3; ?>,<? echo $anio; ?>, <? echo $per; ?>, 53, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d113[0][0]; ?></td>
							<td class="blockInp"><input type="number" value="<? echo $totd11; ?>" id="p10tot" readonly></td>
		</tr>
		<tr>
			<th scope="row">10.3</th>
			<input style="display: none !important;" type="number" value="0" id="p54m1">
				<input style="display: none !important;" type="number" value="0" id="p54m2">
				<input style="display: none !important;" type="number" value="0" id="p54m3">
			<td style="text-align: left;">Número de imputados con sentencia condenatoria por juicio oral</td>
			<td class="cPo" onclick="loaNucTrimeShow(0,2017, <? echo $per; ?>, 54, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d12[0]; ?><input type="hidden" value="<? echo $d12[0]; ?>" id="3val2017"></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2018, <? echo $per; ?>, 54, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d12[1]; ?><input type="hidden" value="<? echo $d12[1]; ?>" id="3val2018"></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2019, <? echo $per; ?>, 54, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d12[2]; ?><input type="hidden" value="<? echo $d12[2]; ?>" id="3val2019"></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2020, <? echo $per; ?>, 54, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d12[3]; ?><input type="hidden" value="<? echo $d12[3]; ?>" id="3val2020"></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2021, <? echo $per; ?>, 54, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d12[4]; ?><input type="hidden" value="<? echo $d12[4]; ?>" id="3val2021"></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2022, <? echo $per; ?>, 54, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d12[5]; ?><input type="hidden" value="<? echo $d12[5]; ?>" id="3val2022"></td>
								<td class="cPo" onclick="loaNucTrimeShow(0,2023, <? echo $per; ?>, 54, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d12[6]; ?><input type="hidden" value="<? echo $d12[6]; ?>" id="3val2023"></td>

							<td class="cPo" onclick="loaNucTrimes(0,0, <? echo $per; ?>, 54, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)">Capturar</td>

							<td class="cPo" onclick="loaNucTrimes(<? echo $mes1; ?>,<? echo $anio; ?>, <? echo $per; ?>, 54, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d121[0][0]; ?></td>
							<td class="cPo" onclick="loaNucTrimes(<? echo $mes2; ?>,<? echo $anio; ?>, <? echo $per; ?>, 54, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d122[0][0]; ?></td>
							<td class="cPo" onclick="loaNucTrimes(<? echo $mes3; ?>,<? echo $anio; ?>, <? echo $per; ?>, 54, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d123[0][0]; ?></td>
							<td class="blockInp"><input type="number" value="<? echo $totd12; ?>" id="p10tot" readonly></td>
		</tr>
		<tr>
			<th scope="row">10.4</th>
			<input style="display: none !important;" type="number" value="0" id="p55m1">
				<input style="display: none !important;" type="number" value="0" id="p55m2">
				<input style="display: none !important;" type="number" value="0" id="p55m3">
			<td style="text-align: left;">Número de imputados con sentencia absolutoria por juicio oral</td>
			<td class="cPo" onclick="loaNucTrimeShow(0,2017, <? echo $per; ?>, 55, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d13[0]; ?><input type="hidden" value="<? echo $d13[0]; ?>" id="4val2017"></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2018, <? echo $per; ?>, 55, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d13[1]; ?><input type="hidden" value="<? echo $d13[1]; ?>" id="4val2018"></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2019, <? echo $per; ?>, 55, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d13[2]; ?><input type="hidden" value="<? echo $d13[2]; ?>" id="4val2019"></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2020, <? echo $per; ?>, 55, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d13[3]; ?><input type="hidden" value="<? echo $d13[3]; ?>" id="4val2020"></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2021, <? echo $per; ?>, 55, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d13[4]; ?><input type="hidden" value="<? echo $d13[4]; ?>" id="4val2021"></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2022, <? echo $per; ?>, 55, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d13[5]; ?><input type="hidden" value="<? echo $d13[5]; ?>" id="4val2022"></td>
								<td class="cPo" onclick="loaNucTrimeShow(0,2023, <? echo $per; ?>, 55, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d13[6]; ?><input type="hidden" value="<? echo $d13[6]; ?>" id="4val2023"></td>

							<td class="cPo" onclick="loaNucTrimes(0,0, <? echo $per; ?>, 55, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)">Capturar</td>

							<td class="cPo" onclick="loaNucTrimes(<? echo $mes1; ?>,<? echo $anio; ?>, <? echo $per; ?>, 55, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d131[0][0]; ?></td>
							<td class="cPo" onclick="loaNucTrimes(<? echo $mes2; ?>,<? echo $anio; ?>, <? echo $per; ?>, 55, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d132[0][0]; ?></td>
							<td class="cPo" onclick="loaNucTrimes(<? echo $mes3; ?>,<? echo $anio; ?>, <? echo $per; ?>, 55, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d133[0][0]; ?></td>
							<td class="blockInp"><input type="number" value="<? echo $totd13; ?>" id="p10tot" readonly></td>
		</tr>
		<tr>
			<th style=" border: inset 0pt" scope="row"></th>
			<td style=" border: inset 0pt"></td>
			<td style=" border: inset 0pt"></td>
			<td style=" border: inset 0pt"></td>
			<td style=" border: inset 0pt"></td>
			<td style=" border: inset 0pt"></td>
			<td style=" border: inset 0pt"></td>
			<td style=" border: inset 0pt"></td>
			<td style=" border: inset 0pt"></td>
			<td style=" border: inset 0pt"></td>
			<td style=" border: inset 0pt"></td>
			<td style=" border: inset 0pt"></td>
			<td style=" border: inset 0pt"><strong>TOTAL:</strong></td>
			<td class="blockInp"><strong><?php echo $todgene; ?></strong></td>
		</tr>
	</tbody>
</table><br><br>
<div class="botonGuardar">
	<? if ($envt == 0) { ?>
		<button type="button" class="btn btn-success" id="guardarPregunta" onclick="saveQuest10(10, <? echo $per; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, <? echo $idEnlace; ?>)">GUARDAR</button> <? } ?>
</div>