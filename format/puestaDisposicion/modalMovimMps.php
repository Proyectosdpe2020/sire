<?php
include("../../Conexiones/Conexion.php");
include("../../funciones2.php");
include("../../sqlPersonas.php");

$envi = getEnviadoEnlaceFromt($conn, 1, 1); 
$menom = Mes_Nombre($envi[0][1]);

?>

<div class="cotentMpsAdminMain">

	<div class="cotentMpsAdminMain3">

		<table border="0" class="alwidth" id="tableencabemps">
			<tr>
				<td id="nomostrar" class="imgSelloCabezera" width="5%" height="125"></td>
				<td width="50%">
					<div class="tituloCentralSegu">
						<div class="titulosCabe1">

							<h3> <label class="titulo2">Movimiento de Ministerios Públicos por Enlace</label></h3>
							<h4> <label class="titulo2">Fiscalía General del Estado de Michoácan</label></h4>
						</div>
					</div>
				</td>
				<td id="nomostrar" class="imgdgtipeCabezera" width="10%" height="125"></td>
			</tr>
		</table>

		<div class="row">

			<div class="col-xs-12 col-md-3">

				<label class="" for="inputlg">Enlace Capturista :<span class="aste">(*)</span></label>
				<select class="form-control browser-default custom-select" onchange="loadInfoMpsFormat()" id="selEnlacess"><?
																																																																																																															$enlcs = getTEnlacesVICarpLiti($conn);
																																																																																																															for ($d = 0; $d < sizeof($enlcs); $d++) {      																																								 ?>
						<option style="color: black; font-weight: bold;" value="<? echo $enlcs[$d][0]; ?>" <? if ($enlcs[$d][0] == 1) {
																																																																																																																	echo "selected";
																																																																																																																} ?>> <? echo $enlcs[$d][1] ?> </option>
					<?
																																																																																																															}
					?>
				</select>
			</div>
			<div class="col-xs-12 col-md-2">
				<label class="" for="inputlg">Formato :<span class="aste">(*)</span></label>
				<div id="contFormatoMps"><select class="form-control browser-default custom-select" id="selFormatoes">
						<option value="1" selected>Carpetas de Investigación</option>
						<?
						?>
					</select></div>
			</div>
			<div class="col-xs-12 col-md-2">
				<label class="" for="inputlg">Mes Captura:</label>
				<div id="contMontsel"><select style="color: black; font-weight: bold !important;" class="form-control browser-default custom-select" id="selEnlacess">
						<option value="Septiembre" selected><? echo $menom; ?></option>
					</select></div>
			</div>
			<div class="col-xs-12 col-md-2">

				<div id="conBtnEnvid"><label class="" for="inputlg" style="color: transparent !important;">.<span class="aste"></span></label>
					<button href="" style="width: 100%; font-weight: bolder; color: white;" onclick="updateEnviadoEnlceFor(<? echo $envi[0][0]; ?>, 1)" type="button" class="btn btn-<? if ($envi[0][0] == 1) {
																																																																																																																																																																							echo "success";
																																																																																																																																																																						} else {
																																																																																																																																																																							echo "warning";
																																																																																																																																																																						} ?> redondear"> <? if ($envi[0][0] == 0) { ?> <i class="fa fa-unlock-alt" aria-hidden="true"></i> <? echo " No Enviado";
																																																																																																																																																																																																																																																																																																																																						} else {
																																																																																																																																																																																																																																																																																																																																							if ($envi[0][0] == 1) { ?> <i class="fa fa-lock" aria-hidden="true"></i> <? echo " Enviado";
																																																																																																																																																																																																																																																																																																																																																																																																																																												}
																																																																																																																																																																																																																																																																																																																																																																																																																																											} ?></button>
				</div>
			</div>
			<div class="col-xs-12 col-md-3">

				<label class="" for="inputlg" style="color: transparent !important;">.<span class="aste"></span></label>
				<button data-toggle="modal" href="#addMp" style="width: 100%; font-weight: bolder; color: white;" onclick="loadAddMpsMod()" type="button" class="btn btn-info redondear">Agregar MP</button>
			</div>


		</div>

	</div>

	<div class="cotentMpsAdminMain2">



		<div class="row" style="zoom:95%;">

			<div class="col-xs-12">
				<br>
				<div id="contTablempsEnlacs">
					<? $dataMps = getDataMPsMovCarp($conn, 1, 1); ?>
					<table class="table table-striped hovermps">
						<thead>
							<tr>
								<th style="text-align: center !important;" scope="col">#</th>
								<th scope="col">Ministerio Público</th>
								<th scope="col">Unidad</th>
								<th scope="col">Formato</th>
								<th style="text-align: center !important;" scope="col">Ext Ant</th>
								<th style="text-align: center !important;" scope="col">Tramite</th>
								<th scope="col">Acción</th>
							</tr>
						</thead>
						<tbody>

							<? for ($h = 0; $h < sizeof($dataMps); $h++) {
								if ($dataMps[$h][5] == 1) {
									$formt = "Carpetas de Investigación";
								}
								if ($dataMps[$h][5] == 4) {
									$formt = "Litigación";
								}

								$tramites = getTramiteMpV2($conn, $dataMps[$h][3], 2022, $dataMps[$h][1]);
							?>
								<tr style="background-color: <? if ($tramites[0][2] == 0) {
																																						echo "orange";
																																					} ?>;">
									<th style="text-align: center !important;" scope="row"><? echo $h + 1; ?></th>
									<td><? echo $dataMps[$h][2] ?></td>
									<td><? echo $dataMps[$h][4] ?></td>
									<td><? echo $formt; ?></td>
									<td style="font-weight: bold; text-align: center;"><? echo $tramites[0][1]; ?></td>
									<td style="font-weight: bold; text-align: center; "><? echo $tramites[0][2]; ?></td>
									<!--<td style="font-weight: bold; text-align: center; "><a onclick="deleteMpEnlcUnid(<? echo $dataMps[$h][0]; ?>)" style="font-weight: bold; color: black;" href="#">Eliminar</a></td>-->
									<td>
																		      		<? if ($tramites[0][2] > 0) { ?> <label style="color: #06DDA0; font-weight: bold;">Trabajando</label> <? } else {
																																																																																																																														if ($tramites[0][2] == 0) { ?> <a onclick="deleteMpEnlcUnid(<? echo $dataMps[$h][0]; ?>)" style="font-weight: bold; color: black;" href="#">Eliminar</a> <? } else {
																																																																																																																																																																																		if ($tramites[0][2] < 0) {
																																																																																																																																																																																			echo "Revisar";
																																																																																																																																																																																		}
																																																																																																																																																																																	}
																																																																																																																																																																																} ?>
																		      					
																		      </td>
								</tr>
							<?
							} ?>



						</tbody>
					</table>
				</div>

			</div>

		</div>
	</div>
</div>