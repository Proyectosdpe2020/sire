<?php
session_start();
include("../../Conexiones/Conexion.php");
include("../../funciones.php");
include("../../funcionesProcesosPenales.php");

if (isset($_GET["mAc"])) {
	$mesCapturando = $_GET["mAc"];

}if (isset($_GET["aAc"])) {
	$anioCapturando = $_GET["aAc"];
}

if (isset($_GET["idEnlace"])) {
	$idEnlace = $_GET["idEnlace"];
}

if (isset($_GET["idFiscalia"])) {
	$idFiscalia = $_GET["idFiscalia"];
}
if (isset($_GET["juzgado"])) {
	$juzgado = $_GET["juzgado"];
}
if (isset($_GET["mesIni"])) {
	$mesIni = $_GET["mesIni"];
}
if (isset($_GET["anioIni"])) {
	$anioIni = $_GET["anioIni"];
}
if (isset($_GET["mesFin"])) {
	$mesFin = $_GET["mesFin"];
}
if (isset($_GET["anioFin"])) {
	$anioFin = $_GET["anioFin"];
}
if (isset($_GET["capt"])) {
	$capt = $_GET["capt"];
}

if($mesIni == $mesFin){

	$bandTram = 1;
	if ($mesIni == 1) {
		$mesAnterior = 12;
		$anioAnte = ($anioIni - 1);
	} else {
		$anioAnte = $anioIni;
		$mesAnterior = ($mesIni - 1);
	}
	
	$dataTramAnterior = getTramiteAnteriorProcesos($conn, $mesAnterior, $anioAnte, $idFiscalia, $juzgado);

}else{
	$bandTram = 0;
}

$enviado = getEnviadoEnlaceFormato($conn, $idEnlace, 21);
						$env = $enviado[0][0];
						$envArch = $enviado[0][1];

$anioIniSelected = $anioIni;
$anioFinSelected = $anioFin;

$anioIni = intVal($anioIni);
$anioFin = intVal($anioFin);

//// construir array de diferencia de años 
$arrayAnios = array();
$indic = 0;

for ($f = $anioIni; $f <= $anioFin; $f++) {
	$arrayAnios[$indic] = intVal($anioIni);
	$indic++;
	$anioIni++;
}


$arraySumas = array(
	0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,0
);

for ($j = 0; $j < sizeof($arrayAnios); $j++) {


	$lastAnio = $arrayAnios[sizeof($arrayAnios) - 1];

	///// DESARROLLAR EL METODO PARA QUE TOME TODOS LOS MESES DE LOS AÑOS ENTRE EL RANGO 

	for ($i = 0; $i < 12; $i++) {

		if ($arrayAnios[$j] == $anioIniSelected) {

			if ($mesIni == $mesFin && $anioIniSelected == $anioFinSelected) {

				if (($i + 1) == $mesIni) {

					if ($juzgado == 0) {
						$data = getRegistrosProcesosPenalesDataEstatal($conn, $mesIni, $anioIniSelected, $idFiscalia);
					} else {
						$data = getRegistrosProcesosPenalesData($conn, $mesIni, $anioIniSelected, $idFiscalia, $juzgado);
					}
					$a = sizeof($data);
					if ($a >= 1) {
						$b = 1;
					} else {
						$b = 0;
					}

					for ($k = 0; $k <= 81; $k++) {
						$arraySumas[$k] =  $arraySumas[$k] + $data[0][$k];
					}
				}
			} else {


				if ($mesIni == ($i + 1) or $mesIni <= ($i + 1)) {

					if ($juzgado == 0) {
						$data = getRegistrosProcesosPenalesDataEstatal($conn, $i + 1, $arrayAnios[0], $idFiscalia);
					} else {
						$data = getRegistrosProcesosPenalesData($conn, $i + 1, $arrayAnios[0], $idFiscalia, $juzgado);
					}
					$a = sizeof($data);
					if ($a >= 1) {
						$b = 1;
					} else {
						$b = 0;
					}
					for ($k = 0; $k <= 81; $k++) {
						$arraySumas[$k] =  $arraySumas[$k] + $data[0][$k];
					}

				}
			}
		} else {

			if ($arrayAnios[$j] == $lastAnio) {

				if ($mesFin >= ($i + 1)) {

					if ($juzgado == 0) {
						$data = getRegistrosProcesosPenalesDataEstatal($conn, $i + 1, $arrayAnios[sizeof($arrayAnios) - 1], $idFiscalia);
					} else {
						$data = getRegistrosProcesosPenalesData($conn, $i + 1, $arrayAnios[sizeof($arrayAnios) - 1], $idFiscalia, $juzgado);
					}
					$a = sizeof($data);
					if ($a >= 1) {
						$b = 1;
					} else {
						$b = 0;
					}
					for ($f = 0; $f <= 81; $f++) {
						$arraySumas[$f] =  $arraySumas[$f] + $data[0][$f];
					}
				}
			} else {

				if ($arrayAnios[$j] != $anioIniSelected or $arrayAnios[$j] != $lastAnio) {

					if ($juzgado == 0) {
						$data = getRegistrosProcesosPenalesDataEstatal($conn, $i + 1, $arrayAnios[$j], $idFiscalia);
					} else {
						$data = getRegistrosProcesosPenalesData($conn, $i + 1, $arrayAnios[$j], $idFiscalia, $juzgado);
					}
					$a = sizeof($data);
					if ($a >= 1) {
						$b = 1;
					} else {
						$b = 0;
					}
					for ($o = 0; $o <= 81; $o++) {
						$arraySumas[$o] =  $arraySumas[$o] + $data[0][$o];
					}
				}
			}
		}
	} /// FIN FOR

}



?>


<div class="row">
	<div class="col-sm-6">
		<div class="row">
			<div class="col-sm-12">
				<div class="w3-card-4" style="width:100%">
					<header class="w3-container w3-light-grey">
						<h3 style="font-weight: bold; ">Procesos Iniciados</h3>
						
					</header><br>
					<div class="w3-container">
						<div class="row">
							<div class="col-sm-12">
								<form>
									<div class="form-group">
										<label for="exampleInputEmail1">EXISTENCIA ANTERIOR</label>
										<input disabled value="<?php if($bandTram == 1){echo $dataTramAnterior[0][0]; }else{	echo $arraySumas[0]; }	 ?>" type="number" class="form-control form-control" id="p1" aria-describedby="emailHelp" placeholder="">
									</div>
								</form>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<form>
									<div class="form-group">
										<label for="exampleInputEmail1">PROCESOS PENALES INICIADOS EN EL PERIODO</label>
										<input value="<?php 	echo $arraySumas[1];	 ?>" type="number" class="form-control form-control-lg" id="p2" aria-describedby="emailHelp" placeholder="" disabled>
									</div>
									<div class="form-group">
										<label for="exampleInputPassword1">PROCESOS INICIADOS CON DETENIDO(+) : </label>
										<input value="<?php 	echo $arraySumas[2];	 ?>" type="number" class="form-control" id="p3" placeholder="número">
									</div>
								</form>
							</div>
							<div class="col-sm-6">
								<form>
									<div class="form-group">
										<label for="exampleInputEmail1">PROCESOS INICIADOS SIN DETENIDO :</label>
										<input value="<?php 	echo $arraySumas[3];	 ?>" type="number" class="form-control" id="p4" aria-describedby="emailHelp" placeholder="Ingresa número">
									</div>
									<div class="form-group">
										<label for="exampleInputPassword1">AVOCAMIENTO POR CESACIÓN DE FUNCIONES (+) </label>
										<input value="<?php 	echo $arraySumas[4];	 ?>" type="number" class="form-control" id="p5" placeholder="número">
									</div>
								</form>
							</div>
						</div>
					</div>
					<?php if ($capt == 1) {  ?>
						<?php if($env == 1){}else { ?><button onclick="saveDataProcesos(1, <?php echo $idEnlace; ?>, <?php echo $mesCapturando; ?>, <?php echo $anioCapturando; ?>)" style="background-color: #f0ead6; font-weight: bold;" class="w3-button w3-block w3-2021-ultimate-gray">GUARDAR DATOS</button><?php } ?>
					<?php } ?>
				</div>
			</div>
		</div><br>

		<div class="row">
			<div class="col-sm-12">

				<div class="row">
					<div class="col-sm-12">
						<div class="w3-card-4 " style="width:100%">
							<header class="w3-container w3-light-grey">
								<h3 style="font-weight: bold; ">Autos de Plazo Constitucional</h3>
							</header><br>
							<div class="w3-container">

								<div class="row">
									<div class="col-sm-12">
										<div class="row  ">
											<div class="col-sm-6"><label for="exampleInputEmail1">FORMAL PRISION: </label>
												<input value="<?php 	echo $arraySumas[5];	 ?>" type="number" class="form-control" id="p6" aria-describedby="emailHelp" placeholder="Ingresa número">
											</div>
											<div class="col-sm-6"><label for="exampleInputEmail1">AUTO DE SUJECION A PROCESO: </label>
												<input value="<?php 	echo $arraySumas[6];	 ?>" type="number" class="form-control" id="p7" aria-describedby="emailHelp" placeholder="Ingresa número">
											</div>
										</div><br>
										<label for="exampleInputEmail1" class=""><strong>AUTOS DE LIBERTAD POR FALTA DE PRUEBAS PARA PROCESAR:</strong></label><br>
										<div class="row">
											<div class="col-sm-6"><label for="exampleInputEmail1"> TOTAL(-): </label>
												<input value="<?php 	echo $arraySumas[7];	 ?>" type="number" class="form-control" id="p8" aria-describedby="emailHelp" placeholder="Ingresa número">
											</div>
											<div class="col-sm-6"><label for="exampleInputEmail1"> PARCIAL: </label>
												<input value="<?php 	echo $arraySumas[8];	 ?>" type="number" class="form-control" id="p9" aria-describedby="emailHelp" placeholder="Ingresa número">
											</div>
										</div>
										<br>
										<label for="exampleInputEmail1" class=""><strong>AUTOS DE LIBERTAD POR DESVANECIMIENTO DE DATOS:</strong></label>
										<div class="row">
											<div class="col-sm-6"><label for="exampleInputEmail1"> TOTAL(-): </label>
												<input value="<?php 	echo $arraySumas[9];	 ?>" type="number" class="form-control" id="p10" aria-describedby="emailHelp" placeholder="Ingresa número">
											</div>
											<div class="col-sm-6"><label for="exampleInputEmail1"> PARCIAL: </label>
												<input value="<?php 	echo $arraySumas[10];	 ?>" type="number" class="form-control" id="p11" aria-describedby="emailHelp" placeholder="Ingresa número">
											</div>
										</div>
										<div class="row">
											<div class="col-sm-12"><label for="exampleInputEmail1"> MIXTOS: </label>
												<input value="<?php 	echo $arraySumas[11];	 ?>" type="number" class="form-control" id="p12" aria-describedby="emailHelp" placeholder="Ingresa número">
											</div>
										</div><br>
									</div>
								</div>

							</div>
							<?php if ($capt == 1) {  ?>
								<?php if($env == 1){}else { ?><button onclick="saveDataProcesos(2, <?php echo $idEnlace; ?>, <?php echo $mesCapturando; ?>, <?php echo $anioCapturando; ?>)" style="background-color: #f0ead6; font-weight: bold;" class="w3-button w3-block">GUARDAR DATOS</button><?php } ?>
							<?php } ?>
						</div>
					</div>
				</div><br>


				<div class="w3-card-4" style="width:100%">
					<header class="w3-container w3-light-grey">
						<h3 style="font-weight: bold; ">Sobreseimientos Decretados</h3>
					</header><br>
					<div class="w3-container">

						<label for="exampleInputEmail1" class=""><strong>POR PRESCRIPCIÓN DE LA ACCIÓN PENAL: </strong></label>
						<div class="row">
							<div class="col-sm-12">
								<input value="<?php 	echo $arraySumas[12];	 ?>" type="number" class="form-control" id="p13" aria-describedby="emailHelp" placeholder="Ingresa número">
							</div>
						</div><br>
						<label for="exampleInputEmail1" class=""><strong>POR PERDON LEGAL:</strong></label>
						<div class="row">
							<div class="col-sm-6"><label for="exampleInputEmail1"> CON PROCESO EN TRAMITE (-): </label>
								<input value="<?php 	echo $arraySumas[13];	 ?>" type="number" class="form-control" id="p14" aria-describedby="emailHelp" placeholder="Ingresa número">
							</div>
							<div class="col-sm-6"><label for="exampleInputEmail1"> CON PROCESO EN NO TRAMITE: </label>
								<input value="<?php 	echo $arraySumas[14];	 ?>" type="number" class="form-control" id="p15" aria-describedby="emailHelp" placeholder="Ingresa número">
							</div>
						</div><br>
						<label for="exampleInputEmail1" class=""><strong> POR MUERTE DEL INCULPADO:</strong></label>
						<div class="row">
							<div class="col-sm-6"><label for="exampleInputEmail1"> CON PROCESO EN TRAMITE (-): </label>
								<input value="<?php 	echo $arraySumas[15];	 ?>" type="number" class="form-control" id="p16" aria-describedby="emailHelp" placeholder="Ingresa número">
							</div>
							<div class="col-sm-6"><label for="exampleInputEmail1"> CON PROCESO EN NO TRAMITE: </label>
								<input value="<?php 	echo $arraySumas[16];	 ?>" type="number" class="form-control" id="p17" aria-describedby="emailHelp" placeholder="Ingresa número">
							</div>
						</div><br>
						<label for="exampleInputEmail1" class=""><strong>POR MECANISMOS ALTERNATIVOS DE SOLUCIÓN DE CONTROVERSIAS PENALES</strong></label>
						<div class="row">
							<div class="col-sm-6"><label for="exampleInputEmail1"> CON PROCESO EN TRAMITE(-): </label>
								<input value="<?php 	echo $arraySumas[17];	 ?>" type="number" class="form-control" id="p18" aria-describedby="emailHelp" placeholder="Ingresa número">
							</div>
							<div class="col-sm-6"><label for="exampleInputEmail1"> CON PROCESO EN NO TRAMITE: </label>
								<input value="<?php 	echo $arraySumas[18];	 ?>" type="number" class="form-control" id="p19" aria-describedby="emailHelp" placeholder="Ingresa número">
							</div>
						</div><br>
						<label for="exampleInputEmail1" class=""><strong>ACUMULACION(-): </strong></label>
						<div class="row">
							<div class="col-sm-12">
								<input value="<?php 	echo $arraySumas[19];	 ?>" type="number" class="form-control" id="p20" aria-describedby="emailHelp" placeholder="Ingresa número">
							</div>
						</div><br>
					</div>
					<?php if ($capt == 1) {  ?>
						<?php if($env == 1){}else { ?><button onclick="saveDataProcesos(3, <?php echo $idEnlace; ?>, <?php echo $mesCapturando; ?>, <?php echo $anioCapturando; ?>)" style="background-color: #f0ead6; font-weight: bold;" class="w3-button w3-block">GUARDAR DATOS</button><?php } ?>
					<?php } ?>
				</div>

			</div>
		</div><br>

		<div class="row">
			<div class="col-sm-12">


				<div class="w3-card-4" style="width:100%">
					<header class="w3-container w3-light-grey">
						<h3 style="font-weight: bold; ">Mandamientos Judiciales</h3>
					</header><br>
					<div class="w3-container">

						<label for="exampleInputEmail1" class=""><strong> ORDENES DE APREHENSIÓN CUMPLIDAS:</strong></label>
						<div class="row">
							<div class="col-sm-6"><label for="exampleInputEmail1"> TOTAL: </label>
								<input value="<?php 	echo $arraySumas[20];	 ?>" type="number" class="form-control" id="p21" aria-describedby="emailHelp" placeholder="Ingresa número">
							</div>
							<div class="col-sm-6"><label for="exampleInputEmail1"> PARCIAL: </label>
								<input value="<?php 	echo $arraySumas[21];	 ?>" type="number" class="form-control" id="p22" aria-describedby="emailHelp" placeholder="Ingresa número">
							</div>
						</div><br>
						<label for="exampleInputEmail1" class=""><strong> ÓRDENES DE REAPREHENSIÓN CUMPLIDAS:</strong></label>
						<div class="row">
							<div class="col-sm-6"><label for="exampleInputEmail1"> TOTAL: </label>
								<input value="<?php 	echo $arraySumas[22];	 ?>" type="number" class="form-control" id="p23" aria-describedby="emailHelp" placeholder="Ingresa número">
							</div>
							<div class="col-sm-6"><label for="exampleInputEmail1"> PARCIAL: </label>
								<input value="<?php 	echo $arraySumas[23];	 ?>" type="number" class="form-control" id="p24" aria-describedby="emailHelp" placeholder="Ingresa número">
							</div>
						</div><br>
						<label for="exampleInputEmail1" class=""><strong> ÓRDENES DE COMPARECENCIA CUMPLIDAS:</strong></label>
						<div class="row">
							<div class="col-sm-6"><label for="exampleInputEmail1"> TOTAL: </label>
								<input value="<?php 	echo $arraySumas[24];	 ?>" type="number" class="form-control" id="p25" aria-describedby="emailHelp" placeholder="Ingresa número">
							</div>
							<div class="col-sm-6"><label for="exampleInputEmail1"> PARCIAL: </label>
								<input value="<?php 	echo $arraySumas[25];	 ?>" type="number" class="form-control" id="p26" aria-describedby="emailHelp" placeholder="Ingresa número">
							</div>
						</div><br>
					</div>
					<?php if ($capt == 1) {  ?>
						<?php if($env == 1){}else { ?><button onclick="saveDataProcesos(4, <?php echo $idEnlace; ?>, <?php echo $mesCapturando; ?>, <?php echo $anioCapturando; ?>)" style="background-color: #f0ead6; font-weight: bold;" class="w3-button w3-block">GUARDA DATOS</button><?php } ?>
					<?php } ?>
				</div>

			</div>
		</div><br>

		<div class="row">
			<div class="col-sm-12">

				<div class="w3-card-4" style="width:100%">
					<header class="w3-container w3-light-grey">
						<h3 style="font-weight: bold; ">Total de Presentaciones Voluntarias</h3>
					</header><br>
					<div class="w3-container">

						<label for="exampleInputEmail1" class=""><strong> ORDENES DE APREHENSIÓN :</strong></label>
						<div class="row">
							<div class="col-sm-6"><label for="exampleInputEmail1"> TOTAL: </label>
								<input value="<?php 	echo $arraySumas[26];	 ?>" type="number" class="form-control" id="p27" aria-describedby="emailHelp" placeholder="Ingresa número">
							</div>
							<div class="col-sm-6"><label for="exampleInputEmail1"> PARCIAL: </label>
								<input value="<?php 	echo $arraySumas[27];	 ?>" type="number" class="form-control" id="p28" aria-describedby="emailHelp" placeholder="Ingresa número">
							</div>
						</div><br>
						<label for="exampleInputEmail1" class=""><strong> ÓRDENES DE REAPREHENSIÓN :</strong></label>
						<div class="row">
							<div class="col-sm-6"><label for="exampleInputEmail1"> TOTAL: </label>
								<input value="<?php 	echo $arraySumas[28];	 ?>" type="number" class="form-control" id="p29" aria-describedby="emailHelp" placeholder="Ingresa número">
							</div>
							<div class="col-sm-6"><label for="exampleInputEmail1"> PARCIAL: </label>
								<input value="<?php 	echo $arraySumas[29];	 ?>" type="number" class="form-control" id="p30" aria-describedby="emailHelp" placeholder="Ingresa número">
							</div>
						</div><br>
						<label for="exampleInputEmail1" class=""><strong> ÓRDENES DE COMPARECENCIA:</strong></label>
						<div class="row">
							<div class="col-sm-6"><label for="exampleInputEmail1"> TOTAL: </label>
								<input value="<?php 	echo $arraySumas[30];	 ?>" type="number" class="form-control" id="p31" aria-describedby="emailHelp" placeholder="Ingresa número">
							</div>
							<div class="col-sm-6"><label for="exampleInputEmail1"> PARCIAL: </label>
								<input value="<?php 	echo $arraySumas[31];	 ?>" type="number" class="form-control" id="p32" aria-describedby="emailHelp" placeholder="Ingresa número">
							</div>
						</div><br>
						<label for="exampleInputEmail1" class=""><strong> SIN ORDEN:</strong></label>
						<div class="row">
							<div class="col-sm-6"><label for="exampleInputEmail1"> TOTAL: </label>
								<input value="<?php 	echo $arraySumas[32];	 ?>" type="number" class="form-control" id="p33" aria-describedby="emailHelp" placeholder="Ingresa número">
							</div>
							<div class="col-sm-6"><label for="exampleInputEmail1"> PARCIAL: </label>
								<input value="<?php 	echo $arraySumas[33];	 ?>" type="number" class="form-control" id="p34" aria-describedby="emailHelp" placeholder="Ingresa número">
							</div>
						</div><br>
						<label for="exampleInputEmail1" class=""><strong> PERSONAS PUESTAS A DISP. POR EL M.P. ADSCRITO:</strong></label>
						<div class="row">
							<div class="col-sm-6"><label for="exampleInputEmail1"> TOTAL: </label>
								<input value="<?php 	echo $arraySumas[34];	 ?>" type="number" class="form-control" id="p35" aria-describedby="emailHelp" placeholder="Ingresa número">
							</div>
							<div class="col-sm-6"><label for="exampleInputEmail1"> PARCIAL: </label>
								<input value="<?php 	echo $arraySumas[35];	 ?>" type="number" class="form-control" id="p36" aria-describedby="emailHelp" placeholder="Ingresa número">
							</div>
						</div><br>
						<label for="exampleInputEmail1" class=""><strong> REPOSICION DE PROCEDIMIENTO:</strong></label>
						<div class="row">
							<div class="col-sm-6"><label for="exampleInputEmail1"> TOTAL: </label>
								<input value="<?php 	echo $arraySumas[36];	 ?>" type="number" class="form-control" id="p37" aria-describedby="emailHelp" placeholder="Ingresa número">
							</div>
							<div class="col-sm-6"><label for="exampleInputEmail1"> PARCIAL: </label>
								<input value="<?php 	echo $arraySumas[37];	 ?>" type="number" class="form-control" id="p38" aria-describedby="emailHelp" placeholder="Ingresa número">
							</div>
						</div><br>

					</div>
					<?php if ($capt == 1) {  ?>
						<?php if($env == 1){}else { ?><button onclick="saveDataProcesos(5, <?php echo $idEnlace; ?>, <?php echo $mesCapturando; ?>, <?php echo $anioCapturando; ?>)" style="background-color: #f0ead6; font-weight: bold;" class="w3-button w3-block">GUARDA DATOS</button><?php } ?>
					<?php } ?>
				</div>

			</div>
		</div><br>

		<div class="row">
			<div class="col-sm-12">


				<div class="w3-card-4" style="width:100%">
					<header class="w3-container w3-light-grey">
						<h3 style="font-weight: bold; ">Total de Audiencias</h3>
					</header><br>
					<div class="w3-container">

						<div class="row">
							<div class="col-sm-6">
								<form>
									<div class="form-group">
										<label for="exampleInputEmail1">DE DECLARACIONES PREPARATORIAS A QUE ASISTIÓ:</label>
										<input value="<?php 	echo $arraySumas[38];	 ?>" type="number" class="form-control form-control-lg" id="p39" aria-describedby="emailHelp" placeholder="">
									</div>
									<div class="form-group">
										<label for="exampleInputPassword1">DE TESTIMONIALES A QUE ASISTIÓ: </label>
										<input value="<?php 	echo $arraySumas[39];	 ?>" type="number" class="form-control" id="p40" placeholder="número">
									</div>
								</form>
							</div>
							<div class="col-sm-6">
								<form>
									<div class="form-group">
										<label for="exampleInputEmail1">DE FINALES A QUE ASISTIÓ: </label>
										<input value="<?php 	echo $arraySumas[40];	 ?>" type="number" class="form-control" id="p41" aria-describedby="emailHelp" placeholder="Ingresa número">
									</div>
									<div class="form-group">
										<label for="exampleInputPassword1">AMPLIACIONES DEL EJERCICIO DE LA ACCION PENAL: </label>
										<input value="<?php 	echo $arraySumas[41];	 ?>" type="number" class="form-control" id="p42" placeholder="número">
									</div>
								</form>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<form>
									<div class="form-group">
										<label for="exampleInputEmail1">CASOS EN LOS QUE SE MODIFICÓ EL TIPO DE DELITO: </label>
										<input value="<?php 	echo $arraySumas[42];	 ?>" type="number" class="form-control form-control-lg" id="p43" aria-describedby="emailHelp" placeholder="">
									</div>
									<div class="form-group">
										<label for="exampleInputPassword1">VISTAS: </label>
										<input value="<?php 	echo $arraySumas[43];	 ?>" type="number" class="form-control" id="p44" placeholder="número">
									</div>
								</form>
							</div>
						</div>

					</div>
					<?php if ($capt == 1) {  ?>
						<?php if($env == 1){}else { ?><button onclick="saveDataProcesos(6, <?php echo $idEnlace; ?>, <?php echo $mesCapturando; ?>, <?php echo $anioCapturando; ?>)" style="background-color: #f0ead6; font-weight: bold;" class="w3-button w3-block">GUARDA DATOS</button><?php } ?>
					<?php } ?>
				</div>

			</div>
		</div><br>

	</div>
	<div class="col-sm-6">


		<div class="row">
			<div class="col-sm-12">

				<div class="w3-card-4" style="width:100%">
					<header class="w3-container w3-light-grey">
						<h3 style="font-weight: bold; ">Suspensión de Proceso</h3>
					</header><br>
					<div class="w3-container">
						<form>
							<div class="form-group">
								<label for="exampleInputEmail1">FALTA DE REQUISITO DE PROCEDIBILIDAD:</label>
								<input value="<?php 	echo $arraySumas[44];	 ?>" type="number" class="form-control" id="p45" aria-describedby="emailHelp" placeholder="Ingresa número">
							</div>
							<div class="form-group">
								<label for="exampleInputPassword1">AMPARO:</label>
								<input value="<?php 	echo $arraySumas[45];	 ?>" type="number" class="form-control" id="p46" placeholder="número">
							</div>
						</form>
					</div>
					<?php if ($capt == 1) {  ?>
						<?php if($env == 1){}else { ?><button onclick="saveDataProcesos(7, <?php echo $idEnlace; ?>, <?php echo $mesCapturando; ?>, <?php echo $anioCapturando; ?>)" style="background-color: #f0ead6; font-weight: bold;" class="w3-button w3-block">GUARDAR DATOS</button><?php } ?>
					<?php } ?>
				</div>

			</div>
		</div><br>




		<div class="row">
			<div class="col-sm-12">
				<div class="w3-card-4" style="width:100%">
					<header class="w3-container w3-light-grey">
						<h3 style="font-weight: bold; ">Total de Sentencias</h3>
					</header><br>
					<div class="w3-container">
						<label for="exampleInputEmail1" class=""><strong>CONDENATORIAS:</strong></label>
						<div class="row">
							<div class="col-sm-6"><label for="exampleInputEmail1"> TOTAL(-): </label>
								<input value="<?php 	echo $arraySumas[46];	 ?>" type="number" class="form-control" id="p47" aria-describedby="emailHelp" placeholder="Ingresa número">
							</div>
							<div class="col-sm-6"><label for="exampleInputEmail1"> PARCIAL: </label>
								<input value="<?php 	echo $arraySumas[47];	 ?>" type="number" class="form-control" id="p48" aria-describedby="emailHelp" placeholder="Ingresa número">
							</div>
						</div><br>
						<label for="exampleInputEmail1" class=""><strong>ABSOLUTORIAS:</strong></label>
						<div class="row">
							<div class="col-sm-6"><label for="exampleInputEmail1"> TOTAL(-): </label>
								<input value="<?php 	echo $arraySumas[48];	 ?>" type="number" class="form-control" id="p49" aria-describedby="emailHelp" placeholder="Ingresa número">
							</div>
							<div class="col-sm-6"><label for="exampleInputEmail1"> PARCIAL: </label>
								<input value="<?php 	echo $arraySumas[49];	 ?>" type="number" class="form-control" id="p50" aria-describedby="emailHelp" placeholder="Ingresa número">
							</div>
						</div><br>
						<label for="exampleInputEmail1" class=""><strong>MIXTAS:</strong></label>
						<div class="row">
							<div class="col-sm-6"><label for="exampleInputEmail1"> TOTAL(-): </label>
								<input value="<?php 	echo $arraySumas[50];	 ?>" type="number" class="form-control" id="p51" aria-describedby="emailHelp" placeholder="Ingresa número">
							</div>
							<div class="col-sm-6"><label for="exampleInputEmail1"> PARCIAL: </label>
								<input value="<?php 	echo $arraySumas[51];	 ?>" type="number" class="form-control" id="p52" aria-describedby="emailHelp" placeholder="Ingresa número">
							</div>
						</div><br>
						<label for="exampleInputEmail1" class=""><strong>SENTENCIAS EN LAS QUE SE CONDENA PAGO DE REPARACION DEL DAÑO: </strong></label>
						<div class="row">
							<div class="col-sm-12">
								<input value="<?php 	echo $arraySumas[52];	 ?>" type="number" class="form-control" id="p53" aria-describedby="emailHelp" placeholder="Ingresa número">
							</div>
						</div>
						<br>
						<label for="exampleInputEmail1" class=""><strong>SENTENCIAS EN LAS QUE NO SE CONDENA PAGO DE REPARACION DEL DAÑO: </strong></label>
						<div class="row">
							<div class="col-sm-12">
								<input value="<?php 	echo $arraySumas[53];	 ?>" type="number" class="form-control" id="p54" aria-describedby="emailHelp" placeholder="Ingresa número">
							</div>
						</div><br>
					</div>
					<?php if ($capt == 1) {  ?>
						<?php if($env == 1){}else { ?><button onclick="saveDataProcesos(8, <?php echo $idEnlace; ?>, <?php echo $mesCapturando; ?>, <?php echo $anioCapturando; ?>)" style="background-color: #f0ead6; font-weight: bold;" class="w3-button w3-block">GUARDAR DATOS</button><?php } ?>
					<?php } ?>
				</div>
			</div>
		</div> <br>


		<div class="row">
			<div class="col-sm-12">

				<div class="w3-card-4" style="width:100%">
					<header class="w3-container w3-light-grey">
						<h3 style="font-weight: bold; ">Incompetencias</h3>
					</header><br>
					<div class="w3-container">
						<label for="exampleInputEmail1" class=""><strong>DECRETADAS:</strong></label>
						<div class="row">
							<div class="col-sm-6"><label for="exampleInputEmail1"> CON PROCESO EN TRAMITE (-): </label>
								<input value="<?php 	echo $arraySumas[54];	 ?>" type="number" class="form-control" id="p55" aria-describedby="emailHelp" placeholder="Ingresa número">
							</div>
							<div class="col-sm-6"><label for="exampleInputEmail1"> CON PROCESO EN NO TRAMITE: </label>
								<input value="<?php 	echo $arraySumas[55];	 ?>" type="number" class="form-control" id="p56" aria-describedby="emailHelp" placeholder="Ingresa número">
							</div>
						</div><br>
						<label for="exampleInputEmail1" class=""><strong> ADMITIDAS:</strong></label>
						<div class="row">
							<div class="col-sm-6"><label for="exampleInputEmail1"> CON PROCESO EN TRAMITE (+): </label>
								<input value="<?php 	echo $arraySumas[56];	 ?>" type="number" class="form-control" id="p57" aria-describedby="emailHelp" placeholder="Ingresa número">
							</div>
							<div class="col-sm-6"><label for="exampleInputEmail1"> CON PROCESO EN NO TRAMITE: </label>
								<input value="<?php 	echo $arraySumas[57];	 ?>" type="number" class="form-control" id="p58" aria-describedby="emailHelp" placeholder="Ingresa número">
							</div>
						</div><br>
					</div>
					<?php if ($capt == 1) {  ?>
						<?php if($env == 1){}else { ?><button onclick="saveDataProcesos(9, <?php echo $idEnlace; ?>, <?php echo $mesCapturando; ?>, <?php echo $anioCapturando; ?>)" style="background-color: #f0ead6; font-weight: bold;" class="w3-button w3-block">GUARDAR DATOS</button><?php } ?>
					<?php } ?>
				</div>



			</div>
		</div><br>
		<div class="row">
			<div class="col-sm-12">

				<div class="w3-card-4" style="width:100%">
					<header class="w3-container w3-light-grey">
						<h3 style="font-weight: bold; ">Órdenes de Reaprehensión Cumplidas</h3>
					</header><br>
					<div class="w3-container">
						<div class="row">
							<div class="col-sm-6"><label for="exampleInputEmail1"> TOTAL: </label>
								<input value="<?php 	echo $arraySumas[58];	 ?>" type="number" class="form-control" id="p59" aria-describedby="emailHelp" placeholder="Ingresa número">
							</div>
							<div class="col-sm-6"><label for="exampleInputEmail1"> PARCIAL: </label>
								<input value="<?php 	echo $arraySumas[59];	 ?>" type="number" class="form-control" id="p60" aria-describedby="emailHelp" placeholder="Ingresa número">
							</div>
						</div><br>
					</div>
					<?php if ($capt == 1) {  ?>
						<?php if($env == 1){}else { ?><button onclick="saveDataProcesos(10, <?php echo $idEnlace; ?>, <?php echo $mesCapturando; ?>, <?php echo $anioCapturando; ?>)" style="background-color: #f0ead6; font-weight: bold;" class="w3-button w3-block">GUARDAR DATOS</button><?php } ?>
					<?php } ?>
				</div>



			</div>
		</div><br>
		<div class="row">
			<div class="col-sm-12">

				<div class="w3-card-4" style="width:100%">
					<header class="w3-container w3-light-grey">
						<h3 style="font-weight: bold; ">Ordenes Negadas</h3>
					</header><br>
					<div class="w3-container">
						<div class="row">
							<div class="col-sm-6"><label for="exampleInputEmail1"> TOTAL DE ORDENES NEGADAS: </label>
								<input value="<?php 	echo $arraySumas[60];	 ?>" type="number" class="form-control" id="p61" aria-describedby="emailHelp" placeholder="Ingresa número" disabled>
							</div>
							<div class="col-sm-6"><label for="exampleInputEmail1"> DE APREHENSIÓN: </label>
								<input value="<?php 	echo $arraySumas[61];	 ?>" type="number" class="form-control" id="p62" aria-describedby="emailHelp" placeholder="Ingresa número">
							</div>
						</div><br>
						<div class="row">
							<div class="col-sm-6"><label for="exampleInputEmail1"> DE REAPREHENSIÓN: </label>
								<input value="<?php 	echo $arraySumas[62];	 ?>" type="number" class="form-control" id="p63" aria-describedby="emailHelp" placeholder="Ingresa número">
							</div>
							<div class="col-sm-6"><label for="exampleInputEmail1"> DE COMPARECENCIA: </label>
								<input value="<?php 	echo $arraySumas[63];	 ?>" type="number" class="form-control" id="p64" aria-describedby="emailHelp" placeholder="Ingresa número">
							</div>
						</div><br>
					</div>
					<?php if ($capt == 1) {  ?>
						<?php if($env == 1){}else { ?><button onclick="saveDataProcesos(11, <?php echo $idEnlace; ?>, <?php echo $mesCapturando; ?>, <?php echo $anioCapturando; ?>)" style="background-color: #f0ead6; font-weight: bold;" class="w3-button w3-block">GUARDAR DATOS</button><?php } ?>
					<?php } ?>
				</div>



			</div>
		</div><br>

		<div class="row">
			<div class="col-sm-12">

				<div class="w3-card-4" style="width:100%">
					<header class="w3-container w3-light-grey">
						<h3 style="font-weight: bold; ">Apelaciones Interpuestas</h3>
					</header><br>
					<div class="w3-container">
						<div class="row">
							<div class="col-sm-6">
								<form>
									<div class="form-group">
										<label for="exampleInputEmail1">TOTAL:</label>
										<input value="<?php 	echo $arraySumas[64];	 ?>" type="number" class="form-control form-control-lg" id="p65" aria-describedby="emailHelp" placeholder="Ingresa número" disabled>
									</div>
								</form>
							</div>
							<div class="col-sm-6">
								<form>
									<div class="form-group">
										<label for="exampleInputEmail1">EN CONTRA DE NEGATIVAS DE ORDEN:</label>
										<input value="<?php 	echo $arraySumas[65];	 ?>" type="number" class="form-control" id="p66" aria-describedby="emailHelp" placeholder="Ingresa número">
									</div>
								</form>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<form>
									<div class="form-group">
										<label for="exampleInputEmail1">EN CONTRA DE AUTOS DE LIBERTAD: </label>
										<input value="<?php 	echo $arraySumas[66];	 ?>" type="number" class="form-control form-control-lg" id="p67" aria-describedby="emailHelp" placeholder="Ingresa número">
									</div>
								</form>
							</div>
							<div class="col-sm-6">
								<form>
									<div class="form-group">
										<label for="exampleInputEmail1"> EN CONTRA DE AUTOS DE FORMAL PRISIÓN: </label>
										<input value="<?php 	echo $arraySumas[67];	 ?>" type="number" class="form-control" id="p68" aria-describedby="emailHelp" placeholder="Ingresa número">
									</div>
								</form>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<form>
									<div class="form-group">
										<label for="exampleInputEmail1">EN CONTRA DE AUTOS DE SUJECIÓN A PROCESO: </label>
										<input value="<?php 	echo $arraySumas[68];	 ?>" type="number" class="form-control form-control-lg" id="p69" aria-describedby="emailHelp" placeholder="Ingresa número">
									</div>
								</form>
							</div>
							<div class="col-sm-6">
								<form>
									<div class="form-group">
										<label for="exampleInputEmail1">EN CONTRA DE SENTENCIAS ABSOLUTORIAS: </label>
										<input value="<?php 	echo $arraySumas[69];	 ?>" type="number" class="form-control" id="p70" aria-describedby="emailHelp" placeholder="Ingresa número">
									</div>
								</form>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<form>
									<div class="form-group">
										<label for="exampleInputEmail1">EN CONTRA DE SENTENCIAS CONDENATORIAS: </label>
										<input value="<?php 	echo $arraySumas[70];	 ?>" type="number" class="form-control form-control-lg" id="p71" aria-describedby="emailHelp" placeholder="Ingresa número">
									</div>
								</form>
							</div>
							<div class="col-sm-6">
								<form>
									<div class="form-group">
										<label for="exampleInputEmail1">EN CONTRA DE SENTENCIAS MIXTAS: </label>
										<input value="<?php 	echo $arraySumas[71];	 ?>" type="number" class="form-control" id="p72" aria-describedby="emailHelp" placeholder="Ingresa número">
									</div>
								</form>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<form>
									<div class="form-group">
										<label for="exampleInputEmail1"> EN CONTRA DE SOBRESEIMENTOS: </label>
										<input value="<?php 	echo $arraySumas[72];	 ?>" type="number" class="form-control form-control-lg" id="p73" aria-describedby="emailHelp" placeholder="Ingresa número">
									</div>
								</form>
							</div>
							<div class="col-sm-6">
								<form>
									<div class="form-group">
										<label for="exampleInputEmail1"> EN CONTRA DE OTRAS RESOLUCIONES JUDICIALES: </label>
										<input value="<?php 	echo $arraySumas[73];	 ?>" type="number" class="form-control" id="p74" aria-describedby="emailHelp" placeholder="Ingresa número">
									</div>
								</form>
							</div>
						</div>
					</div>
					<?php if ($capt == 1) {  ?>
						<?php if($env == 1){}else { ?><button onclick="saveDataProcesos(12, <?php echo $idEnlace; ?>, <?php echo $mesCapturando; ?>, <?php echo $anioCapturando; ?>)" style="background-color: #f0ead6; font-weight: bold;" class="w3-button w3-block">GUARDAR DATOS</button><?php } ?>
					<?php } ?>
				</div>



			</div>
		</div><br>

		<div class="row">
			<div class="col-sm-12">

				<div class="w3-card-4" style="width:100%">
					<header class="w3-container w3-light-grey">
						<h3 style="font-weight: bold; ">Conclusiones</h3>
					</header><br>
					<div class="w3-container">
						<div class="row">
							<div class="col-sm-6">
								<form>
									<div class="form-group">
										<label for="exampleInputEmail1">TOTAL:</label>
										<input value="<?php 	echo $arraySumas[74];	 ?>" type="number" class="form-control form-control-lg" id="p75" aria-describedby="emailHelp" placeholder="Ingresa número" disabled>
									</div>
								</form>
							</div>
							<div class="col-sm-6">
								<form>
									<div class="form-group">
										<label for="exampleInputEmail1">ACUSATORIAS:</label>
										<input value="<?php 	echo $arraySumas[75];	 ?>" type="number" class="form-control" id="p76" aria-describedby="emailHelp" placeholder="Ingresa número">
									</div>
								</form>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<form>
									<div class="form-group">
										<label for="exampleInputEmail1">ACUSATORIAS EN AUDIENCIA PRINCIPAL:</label>
										<input value="<?php 	echo $arraySumas[76];	 ?>" type="number" class="form-control form-control-lg" id="p77" aria-describedby="emailHelp" placeholder="Ingresa número">
									</div>
								</form>
							</div>
							<div class="col-sm-6">
								<form>
									<div class="form-group">
										<label for="exampleInputEmail1">NO ACUSATORIAS:</label>
										<input value="<?php 	echo $arraySumas[77];	 ?>" type="number" class="form-control" id="p78" aria-describedby="emailHelp" placeholder="Ingresa número">
									</div>
								</form>
							</div>
						</div>
					</div>
					<hr>
					<div class="w3-container">
						<div class="row">
							<div class="col-sm-6">
								<form>
									<div class="form-group"><br>
										<label for="exampleInputEmail1">CESACIÓN DE FUNCIONES (-) :</label>
										<input value="<?php 	echo $arraySumas[78];	 ?>" type="number" class="form-control form-control-lg" id="p79" aria-describedby="emailHelp" placeholder="Ingresa número">
									</div>
								</form>
							</div>
							<div class="col-sm-6">
								<form>
									<div class="form-group"><br>
										<label for="exampleInputEmail1">TOTAL DE PROCESOS EN TRAMITE: </label>
										<input disabled value="<?php 	echo $arraySumas[81];	 ?>" type="number" class="form-control" id="p80" aria-describedby="emailHelp" placeholder="Ingresa número">
									</div>
								</form>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<form>
									<div class="form-group">
										<label for="exampleInputEmail1">PEDIMENTOS EN GENERAL: </label>
										<input value="<?php 	echo $arraySumas[80];	 ?>" type="number" class="form-control form-control-lg" id="p81" aria-describedby="emailHelp" placeholder="Ingresa número">
									</div>
								</form>
							</div>
						</div>
					</div><br>
					<?php if ($capt == 1) {  ?>
						<?php if($env == 1){}else { ?><button onclick="saveDataProcesos(13, <?php echo $idEnlace; ?>, <?php echo $mesCapturando; ?>, <?php echo $anioCapturando; ?>)" style="background-color: #f0ead6; font-weight: bold;" class="w3-button w3-block">GUARDAR DATOS</button> <?php } ?>
					<?php } ?>
				</div>



			</div>
		</div>

	</div>
</div><br>