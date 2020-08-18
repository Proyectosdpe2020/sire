<?php
session_start();
include ("Conexiones/Conexion.php");
include("funciones.php");

$mes =3;
$anio = 2018;
$idProyecto = 60;
$idArea = 107;

$upp = "(13) PROCURADURIA GENERAL DE JUSTICIA DEL ESTADO";
?>


<style type="text/css">

</style>


<div class="" style=" width:100%; height:100%; margin: 0 auto;  background-image: url('Fondo poa-07.png'); background-repeat: repeat; " >


<table border=1; style="width:100%;" >

<tr>
<td width="20%"><img src="sello 636.png" ></img></td>
<td style="text-align:center; padding:10px;" width="60%">
<p style="font-size:14px; font-weight: BOLD;">PROCURADURÍA GENERAL DE JUSTICIA DEL ESTADO</p>

<div style="padding:100px;"><p style=" font-size:12px;">DIRECCIÓN GENERAL DE TECNOLOGÍAS DE LA INFORMACIÓN, PLANEACIÓN Y ESTADÍSTICA</p4></div>

<p style="font-size:10px; font-weight:bold;">Dirección de Planeación y Estadística</p>
</td>
<td width="20%" style="float:left; text-align:right;" width:10;><img src="mich 546.png" ></img></td>
</tr>
<tr>
<td style="text-align:center; font-weight:bold; font-size:10px;" colspan="3">Mes</td>
</tr>
<tr>
<td width:5%; style="text-align:right; font-weight:bold;  font-size:12px;" >Upp: </td>
<td style="text-align:left; font-size:10px;" colspan="3"><? echo $upp; ?></td>
</tr>
<tr>
<td style="text-align:right; font-weight:bold; font-size:12px;">UE:</td>
<td style="text-align:left; font-size:12px;" colspan="3">AQui va la ur de la area </td>
</tr>

</table>
<table border="1" class="table-bordered"  style="width:100%; background-color:rgba(255,255,255,0.0) !important;">
<thead>
<tr style="font-size:10px;">
<th class="column-title col-sm-1" style="font-size:11px; text-align: center; width: 10px; background-color:#3c6084; color: white;" class="">No</th>
<th class="column-title col-sm-4" style="background-color:#3c6084; color: white; font-weight:bold; font-size:11px;">Nombre</th>
<th style="font-size:11px; text-align: center; vertical-align: middle; background-color:#3c6084; color: white;" class="column-title col-sm-1">Medida</th>
<th style="font-size:11px; text-align: center; vertical-align: middle; background-color:#3c6084; color: white;" class="column-title col-sm-1">Tipo Dato</th>

<th style="font-size:11px; text-align: center; vertical-align: middle; background-color:#3c6084; color: white;" class="">'.$mesNombre.' </th>

<th style="font-size:11px; text-align: center; vertical-align: middle; background-color:#3c6084; color: white;" class="column-title col-sm-3">Justificación </th>
<th style="font-size:11px; text-align: center; vertical-align: middle; background-color:#3c6084; color: white;" class="column-title col-sm-3">Propuesta</th>

</tr>
</thead>

<tbody>

<?
$actividades = getActvsAreaAnio($conn, $idArea, $anio, $idProyecto);

for ($e=0; $e < sizeof($actividades); $e++) {	

	$idActividad = $actividades[$e][0];	
	$nombreActividad = $actividades[$e][1];
	$beneficiario = $actividades[$e][2];	
	$medida = $actividades[$e][3];

?>	

	<tr>	
	<td rowspan="2" style="font-size:9px; text-align: center; vertical-align: middle;"><?php echo ($e+1); ?></td>
	<td rowspan="2" style="font-size:9px; padding:8px;"><?php echo $nombreActividad; ?></td>
	<td rowspan="2" style="font-size:9px; vertical-align: middle; text-align:center;"><?php echo $medida; ?></td>

	<td style="text-align:center; font-size:9px; background-color: rgba(251, 228, 212, 0.4);">Programado</td>

<?
	$totalSeguimiento = 0;

	$seguimientoAnual = get_seguimientoMes($conn,$actividades[$e][0],$anio,$idArea,$mes);

	$justific = $seguimientoAnual[0][2];
	$propues = $seguimientoAnual[0][3];

	for($j=0; $j<sizeof($seguimientoAnual); $j++){
		$totalSeguimiento = $totalSeguimiento + $seguimientoAnual[$j][1];
	}

	$calendario=get_calendarizacionMes($conn,$actividades[$e][0],$anio,$mes);
	$anualProgramado = $calendario[12];

?>

	<td style=" text-align : center; font-size:9px; background-color: rgba(251, 228, 212, 0.4);"><?php echo $anualProgramado; ?></td>
	<td rowspan="2" style="font-weight:bold; font-size:9px; padding:8px; color:;  background-color:; text-align : justify; "><?php echo $justific; ?></td>
	<td rowspan="2" style="font-weight:bold; font-size:9px; padding:8px; color:; background-color:; text-align : justify; "><?php echo $propues; ?></td>

	</tr>

	<tr>
				<td style="text-align:center; font-size:9px; background-color: rgba(251, 228, 212, 0.2);">Seguimiento</td>
				<td  style=" text-align : center; font-size:9px; background-color:rgba(251, 228, 212, 0.2); "><? echo $totalSeguimiento; ?></td>
	</tr>



<?

}
?>





</tbody>

</table>


</div>



</div>
