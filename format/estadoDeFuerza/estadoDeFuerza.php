<?php
 include ("../../Conexiones/Conexion.php");
	include("../../funcionesEstadoDeFuerza.php");	
	?>

<div id="contenido" style="">
	<div class="right_col" role="main" style="">
		<div style="" class="x_panel principalPanel" >
			<div class="x_panel panelCabezera">
				<table border="0" class="alwidth">
					<tr>
						<td id="nomostrar" class="imgSelloCabezera" width="5%" height="125"></td>
						<td width="50%">
							<div class="tituloCentralSegu">
								<div class="titulosCabe1">
									<label class="titulo1" style="color: #686D72;">Estado de Fuerza </label>
									<h4> <label id="titfisc" class="titulo2">Fiscalía General del Estado de Michoácan</label></h4>
								</div>
							</div>
						</td>
						<td id="nomostrar" class="imgdgtipeCabezera" width="10%" height="125"></td>
					</tr>
				</table>
			</div>

			<div class="row pad20">
				<div class="col-xs-6 col-sm-4  col-md-4">
					<label for="heard">Area de adscripción</label><br>
					<select id="areaAdsc" name="areaAdsc" tabindex="6" class="form-control redondear selectTranparent" onchange="getDataEstadoFuerzaTable('busqAreaAdscr')" required>
						<option value="0">Selecciona</option>
						<option value="todos">Todos</option>
						<? $getAreaAdscripcion = getareaAdscripcion($conn);
						for ($i=0; $i < sizeof($getAreaAdscripcion); $i++) {
							$idAreaAdscripcion = $getAreaAdscripcion[$i][0];	$nombre = $getAreaAdscripcion[$i][1];	?>
							<option style="color: black; font-weight: bold;" value="<? echo $idAreaAdscripcion; ?>"><? echo $nombre; ?></option>
						<? } ?>
					</select>
				</div>
				<div class="col-xs-6 col-sm-4  col-md-5">
					<label for="heard">Mando:</label><br>
					<datalist id="listaMandos">
						<?
						$mandos = getDataMandos($conn);
						for ($h=0; $h < sizeof($mandos); $h++) {
							$idMando = $mandos[$h][6];	$nom = $mandos[$h][0];	$pat = $mandos[$h][1];	$mat = $mandos[$h][2];
							$nombrecom = $nom." ".$pat." ".$mat;
						?>
						<option style="color: black; font-weight: bold;" value="<? echo $nombrecom; ?>" data-value="<? echo $idMando; ?>" data-id="<? echo $idMando; ?>"></option>
						<?}?>
					</datalist>
					<input class="form-control mandda gehit" value="" onchange="getDataEstadoFuerzaTable('busqMando')" onfocus="" list="listaMandos" id="mando" name="mando" type="text" >
				</div>
				<div class="col-xs-6 col-sm-4  col-md-3">
					<label class="transparente">.</label>
					<center><button type="button" data-toggle="modal" href="#puestdispos" style="white-space: normal;"  onclick="showModalEstadoDeFuerza();" class="btn btn-success btn-sm redondear btnCapturarTbl"><span class="glyphicon glyphicon-plus-sign"></span> REGISTRAR NUEVO MANDO </button></center>
				</div>
			</div><br><br>
   <div class="col-md-6 col-md-offset-3" id="preloaderIMG" hidden>
						<img src="images/cargando.gif"/>
			</div>
			<div class="contTblMPs" id="contTblMPs2">
				<div id="tablePuestasDataMando" class="row pad20">	
					<table id="grid" class="display" width="100%" >
						<thead>
							<tr class="cabeceraConsulta">
								<th class="textCent">#</th>
								<th class="textCent10">Nombre</th>
								<th class="textCent">Cargo</th>
								<th class="textCent">Función</th>
								<th class="textCent">Area de adscripción</th>
								<th class="textCent">Estatus</th>
								<th class="textCent">Acciones</th>
								<th class="textCent">Reporte</th>
							</tr>
						</thead>
						<tbody id="tableEstadoFuerza">
							
						</tbody>
					</table>
				</div>
			</div><br>

			<div class="x_panel piepanel">
				<div class="piepanel2">
					<div class="piepanel3">
						<div class="piepanel4">
							<label style="color: #686D72;">SISTEMA INTEGRAL DE REGISTRO ESTADISTICO Copyright © Todos los Derechos Reservados</label>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>


<!-- ESTE ES EL MODAL QUE VA A CARGAR LA PANTALLA FINAL PARA LA VALIDACION NUCS CORRESPONDAN AL NUMERO PUESTO EL EL CAMPO NUMERICO  -->


<div class="modal fade bs-example-modal-sm" id="modalEstadoDeFuerza" role="dialog" data-backdrop="static" data-keyboard="false">
	<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 70%; margin-top: 2.5%;">
		<div class="modal-content" style="">
			<div id="contModalEstadoDeFuerza">
			
			</div>
		</div>
	</div>
</div>

<div class="modal fade bs-example-modal-sm" id="modalDireccion" role="dialog" data-backdrop="static" data-keyboard="false">
	<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 50%; margin-top: 2.5%;">
		<div class="modal-content" style="">
			<div id="contModalDireccion">
			
			</div>
		</div>
	</div>
</div>

<div class="modal fade bs-example-modal-sm" id="modalVehiculos" role="dialog" data-backdrop="static" data-keyboard="false">
	<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 50%; margin-top: 2.5%;">
		<div class="modal-content" style="">
			<div id="contModalVehiculos">
			
			</div>
		</div>
	</div>
</div>

<div class="modal fade bs-example-modal-sm" id="modalArmas" role="dialog" data-backdrop="static" data-keyboard="false">
	<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 50%; margin-top: 2.5%;">
		<div class="modal-content" style="">
			<div id="contModalArmas">
			
			</div>
		</div>
	</div>
</div>

<div class="modal fade bs-example-modal-sm" id="modalContactoEmergencia" role="dialog" data-backdrop="static" data-keyboard="false">
	<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 50%; margin-top: 2.5%;">
		<div class="modal-content" style="">
			<div id="contModalContactoEmergencia">
			
			</div>
		</div>
	</div>
</div>

<div class="modal fade bs-example-modal-sm" id="modalAdscripciones" role="dialog" data-backdrop="static" data-keyboard="false">
	<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 50%; margin-top: 2.5%;">
		<div class="modal-content" style="">
			<div id="contModalAdscripciones">
			
			</div>
		</div>
	</div>
</div>

<div class="modal fade bs-example-modal-sm" id="modalFolios" role="dialog" data-backdrop="static" data-keyboard="false">
	<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 30%; margin-top: 2.5%;">
		<div class="modal-content" style="">
			<div id="contModalFolios">
			
			</div>
		</div>
	</div>
</div>

<div class="modal fade bs-example-modal-sm" id="modalIncapacidad" role="dialog" data-backdrop="static" data-keyboard="false">
	<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 30%;  margin-top: 2.5%;">
		<div class="modal-content">
			<div id="contModalIncapacidad">
			
			</div>
		</div>
	</div>
</div>
	
</html>