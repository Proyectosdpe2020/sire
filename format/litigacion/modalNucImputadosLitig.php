<?
session_start();

include("../../Conexiones/Conexion.php");
include("../../Conexiones/conexionSicap.php");
include("../../funciones.php");
include("../../funcioneSicap.php");
include("../../funcioneLit.php");



if (isset($_POST["nuc"])) {
	$nuc = $_POST["nuc"];
}

//echo $estatus."----".$tipoestatus;

$idUsuario = $_SESSION['useridIE'];


?>


<div class="modal-header" style="background-color:#3c6084;">
	<center>
		<h4 class="modal-title" style="color:white; font-weight: bold;"> Formulario de Ingreso de Imputados para Carpeta ( <?php echo "  " . $nuc . "  "; ?> )</h4>
	</center>
</div>



<div>

	<div class="panel-body panelunoLitigacion">

		<div class="card" style="zoom: 90% !important;">
			<div class="card-body">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-4">
						<label>Nombre (s) : <label style="color:red !important; font-size:20px !important;">*</label></label>
						<input id="nomImpu" type="text" value="" name="nomImpu" value="Expediente" tabindex="0" placeholder="" style=" font-weight: bold; font-size: 18px !important;" class=" form-control redondear" />
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4">
						<label>Paterno : <label style="color:red !important; font-size:20px !important;">*</label></label>
						<input id="paternImpu" type="text" value="" name="paternImpu" tabindex="0" placeholder="" style=" font-weight: bold; font-size: 18px !important;" class=" form-control redondear" />
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4">
						<label>Materno : <label style="color:red !important; font-size:20px !important;">*</label></label>
						<input id="maternImpu" type="text" value="" name="maternImpu" tabindex="0" placeholder="" style=" font-weight: bold; font-size: 18px !important;" class=" form-control redondear" />
					</div>
				</div>

				<div class="row mt-5">
					<div class="col-xs-12 col-sm-12 col-md-5">
						<label>CURP : <label style="color:red !important; font-size:20px !important;"></label></label>
						<input onkeyup="mayus(this);" maxlength="18" id="curpImputados" type="text" value="" name="curpImputados" value="Expediente" tabindex="0" placeholder="" style="font-weight: bold; font-size: 18px !important;" class=" form-control redondear" />
					</div>
					<div class="col-xs-12 col-sm-12 col-md-3">
						<label>SEXO : <label style="color:red !important; font-size:20px !important;">*</label></label>
						<select id="sexoImp" name="sexoImp" tabindex="6" class="form-control redondear" style="font-size: 18px !important;" required>
							<option value="O" selected>Selecciona</option>
							<option value="M">Masculino</option>
							<option value="F">Femenino</option>
						</select>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-2">
						<label>EDAD : <label style="color:red !important; font-size:20px !important;">*</label></label>
						<input id="edadImputado" type="number" value="" name="edadImputado" tabindex="0" placeholder="" style=" font-weight: bold; font-size: 18px !important;" class=" form-control redondear" />
					</div>
					<div class="col-xs-12 col-sm-12 col-md-2">
						<label></label><br><br>
						<button style="width: 95%; font-size: 18px !important;" type="button" class="btn btn-success redondear" onclick="addImputado(<?php echo $nuc; ?>)">Agregar Imputado</button>
					</div>
				</div>
			</div>
		</div>





		<div class="row" style="zoom: 93% !important;">

			<div id="contTableNucs" style="overflow-y: hidden; overflow-x: hidden; padding: 10px;">

				<div id="contTablaImputadosNuc">
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
				</div>
			</div>
		</div>
		<?php
		$dataDeterminaciones = getDeterminacionesXnuc($conn, $nuc);

		// PUREBA CON ESTE NUC 1007201917513
		/// PRUEBA NUC CON ACTUACIONES PERO NO ESTA JUDICIALIZADO  1003202238027
		//// ESTE NUC TIENE 26 DETERMINACIONES EN LA BASE DE DATOS 1003202204307
		?>
		<div class="card" style="zoom: 93% !important;">
			<div class="card-header">
				<h3>Listado de Determinaciones relacionadas a la Carpeta de Investigación</h3>
				<h5>Selecciona para cada determinación el imputado correspondiente</h5>
			</div>
			<div class="card-body">
				<div id="contentTableDeterminaciones">
					<table class="table table-striped">
						<thead>
							<tr>
								<th scope="col">#</th>
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
													<option value="0" >Selecciona</option>
													<?
													$dataImputadosNUc = getImputadosXnuc($conn, $nuc);
													for ($k = 0; $k < sizeof($dataImputadosNUc); $k++) {

														if ($guardado[0][3] == $dataImputadosNUc[$k][7]) {
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
				</div>
			</div>
		</div>



	</div> <br>

	<div class="row">
		<!--<div class="col-xs-12 col-sm-12 col-md-6"><center><button style="width: 100%;" type="button" class="btn btn-primary redondear" onclick="listoNucs(<? echo $numResolJudi; ?>);">Listo</button></center></div>-->
		<div class="col-xs-12 col-sm-12 col-md-12">
			<center><button style="width: 95%;" type="button" class="btn btn-warning redondear" onclick="salirIngresoImputados()">Salir</button></center>
		</div>
	</div><br>


</div>