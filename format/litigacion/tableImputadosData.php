<?php
session_start();
include("../../Conexiones/Conexion.php");
include("../../funciones.php");
include("../../Conexiones/conexionSicap.php");
include("../../funcioneSicap.php");

$idUsuario = $_SESSION['useridIE'];

if (isset($_POST["nuc"])) {
	$nuc = $_POST["nuc"];
}



?>

<table class="table table-striped tblTransparente">
	<thead>
		<tr class="cabezeraTabla">
			<th class="col-xs-1 col-sm-1 col-md-1 textCent">No</th>
			<th class="col-xs-4 col-sm-2 col-md-2 textCent">Nombre </th>
			<th class="col-xs-4 col-sm-2 col-md-2 textCent">Paterno </th>
			<th class="col-xs-4 col-sm-2 col-md-2 textCent">Materno </th>
			<th class="col-xs-6 col-sm-1 col-md-1 textCent">Edad</th>
			<th class="col-xs-4 col-sm-1 col-md-1 textCent">Sexo </th>
			<th class="col-xs-4 col-sm-2 col-md-2 textCent">Curp </th>
			<th class="col-xs-1 col-sm-1 col-md-1 textCent">Acción</th>
		</tr>
	</thead>
	<tbody>

		<?php
		$dataImputadosNUc = getImputadosXnuc($conn, $nuc);
		for ($i = 0; $i < sizeof($dataImputadosNUc); $i++) {
		?>
			<tr>
				<th scope="row"><? echo $i + 1; ?></th>
				<td><? echo $dataImputadosNUc[$i][0]; ?></td>
				<td><? echo $dataImputadosNUc[$i][1]; ?></td>
				<td><? echo $dataImputadosNUc[$i][2]; ?></td>
				<td><? echo $dataImputadosNUc[$i][3]; ?></td>
				<td><? echo $dataImputadosNUc[$i][4]; ?></td>
				<td><? echo $dataImputadosNUc[$i][5]; ?></td>
				<td>
				<center> <i onclick="deleteImputado(<? echo $dataImputadosNUc[$i][7]; ?>, <? echo $nuc; ?>)" style="color: #ff4040; font-size: 20px  !important;" class="fa fa-trash" aria-hidden="true"></i></center>
				</td>
			</tr>
		<?php
		}
		?>
	</tbody>
</table>