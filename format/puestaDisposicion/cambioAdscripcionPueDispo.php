 
	<?php
	session_start();
	include ("../../Conexiones/Conexion.php");
	include("../../funciones.php");	
	include ("../../Conexiones/conexionSicap.php");
		include("../../funcioneLit.php");
	include("../../funcioneSicap.php");
	include("../../funcionesPueDispo.php");	
	//include("../../funcionesPueDispoAdscripcion.php");	

 	$idUsuario = $_SESSION['useridIE'];
 	
	if (isset($_POST["idUnidad"])){ $idUnidad = $_POST["idUnidad"]; }

	$enlace = getInfoEnlaceUsuario($conn, $idUsuario);
	$idEnlace = $enlace[0][0];
	$idfisca = $enlace[0][1];	


	$tipoArchov = get_type_archive($conn, $idEnlace);
	$tiparchiv = $tipoArchov[0][0];

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
									<label class="titulo1" style="color: #686D72;">Registro de información de mandos </label>
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
					<select id="areaAdsc" name="areaAdsc" tabindex="6" class="form-control redondear selectTranparent" onchange="getDataMandosTableAdm('busqAreaAdscr')" required>
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
					<datalist id="newBrwosers">
					
					</datalist>
					<input class="form-control mandda gehit" value="" onchange="getDataMandosTableAdm('busqMando')" onfocus="getDataMandosdataList()" list="newBrwosers" id="newBrwoser" name="newBrwoser" type="text" >
					</div>
					<div class="col-xs-6 col-sm-4  col-md-3">
						<label class="transparente">.</label>
						<center><button type="button" data-toggle="modal" href="#puestdispos" style="white-space: normal;"  onclick="showModalNuevoMando();" class="btn btn-success btn-sm redondear btnCapturarTbl"><span class="glyphicon glyphicon-plus-sign"></span> REGISTRAR NUEVO MANDO </button></center>
					</div>
				</div>

				<div id="respuestaDescargarCarpeta"> 
								
				</div>

				<div class="contTblMPs" id="contTblMPs2">
					<div id="tablePuestasDataMando" class="row pad20">	
						<table class="table table-striped  table-hover">
							<thead>
								<tr class="cabezeraTabla10">
									<th class="textCent">#</th>
									<th class="textCent10">Nombre</th>
									<th class="textCent">Cargo</th>
									<th class="textCent">Función</th>
									<th class="textCent">Area de adscripción</th>
									<th class="textCent">Estatus</th>
									<th class="textCent">Acciones</th>
								</tr>
							</thead>
							<tbody id="tablePuestasDataMandoBody">
							
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

<div class="modal fade bs-example-modal-sm" id="modalModuloAdministracion" role="dialog" data-backdrop="static" data-keyboard="false">
	<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 50%; margin-top: 2.5%;">
		<div class="modal-content" style="">
			<div id="contModalModuloAdministracion">
			
			</div>
		</div>
	</div>
</div>

<div class="modal fade bs-example-modal-sm" id="modalModuloAdministracionADDMando" role="dialog" data-backdrop="static" data-keyboard="false">
	<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 50%; margin-top: 2.5%;">
		<div class="modal-content" style="">
			<div id="contModalModuloAdministracionADDMando">
			
			</div>
		</div>
	</div>
</div>
	
</html>