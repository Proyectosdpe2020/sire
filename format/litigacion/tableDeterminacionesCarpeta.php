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

$dataDeterminaciones = getDeterminacionesXnuc($conn, $nuc);

?>

<table class="table table-striped">
	<thead>
		<tr>
			<th scope="col">#aqui</th>

			<th scope="col">Nuc</th>
			<th scope="col">Estatus</th>
			<th scope="col">Ministerio Público</th>
			<th scope="col">Mes</th>
			<th scope="col">Anio</th>
			<th scope="col">?</th>
			<th scope="col">Imputado al que aplica determincación</th>
		</tr>
	</thead>
	<tbody style="justify-content: center !important; align-items: center !important;">

		<?php
		for ($i = 0; $i < sizeof($dataDeterminaciones); $i++) {

			//// CHECAR SI YA HA SIDO REGISTRADO EL ESTATUS NUCS PARA CHEKEAR
			$guardado = getDataEstatusnucsDeterminacion($conn, $dataDeterminaciones[$i][6]);
			
			if (sizeof($guardado) > 0) {
				$bandG = 1;
			} else {
				$bandG = 0;
			}
		?>
			<tr>
				<th scope="row"><? echo $i + 1; ?></th>

				<td><? echo $dataDeterminaciones[$i][0]; ?></td>
				<td><? echo $dataDeterminaciones[$i][1]; ?></td>
				<td><? echo $dataDeterminaciones[$i][2]; ?></td>
				<td><? echo $dataDeterminaciones[$i][3]; ?></td>
				<td><? echo $dataDeterminaciones[$i][4]; ?></td>
				<td><? if ($bandG == 1) { ?><i class="fa fa-check-circle" style="color:green;" aria-hidden="true"></i><? } else {  ?> <i class="fa fa-exclamation-circle" style="color:red;" aria-hidden="true"></i> <? } ?></td>
				<td>

					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-8">
							<select id="imputadoSeleted<? echo $i; ?>" name="imputadoSeleted" tabindex="6" class="form-control redondear" style="font-size: 18px !important;" required>
								<option value="0">Selecciona</option>
								<?
								$dataImputadosNUc = getImputadosXnuc($conn, $nuc);
								for ($k = 0; $k < sizeof($dataImputadosNUc); $k++) {

									if ($dataImputadosNUc[$k][7] == $guardado[0][3]) {
									?>
										<option style="font-weight: bold !important;" selected value="<? echo $dataImputadosNUc[$k][7]; ?>"><? echo $dataImputadosNUc[$k][0] . " " . $dataImputadosNUc[$k][1] . " " . $dataImputadosNUc[$k][2]; ?></option>
									<?
									} else {
									?>
										<option style="font-weight: bold !important;" value="<? echo $dataImputadosNUc[$k][7]; ?>"><? echo $dataImputadosNUc[$k][0] . " " . $dataImputadosNUc[$k][1] . " " . $dataImputadosNUc[$k][2]; ?></option>
									<?
									}
								}
								?>

							</select>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-4">
							<button style="width: 95%;" type="button" class="btn btn-success redondear" onclick="guardarDeterminacionImputado(<? echo $nuc; ?>, <? echo $dataDeterminaciones[$i][5]; ?>, <? echo $i; ?>,<? echo $dataDeterminaciones[$i][6]; ?>)">Guardar</button>
						</div>
					</div>



				</td>
			</tr>
		<?php
		}
		?>

		</td>
		</tr>
	</tbody>
</table>