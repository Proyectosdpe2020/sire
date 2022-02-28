 <?php
	include ("../../Conexiones/Conexion.php");
	include("../../funcionesCarpetasJudicializadas.php");	

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
									<label class="titulo1" style="color: #686D72;">Carpetas judicializadas en las direcciones de litigación</label>
									<h4> <label id="titfisc" class="titulo2">Fiscalía General del Estado de Michoácan</label></h4>
								</div>
							</div>
						</td>
						<td id="nomostrar" class="imgdgtipeCabezera" width="10%" height="125"></td>
					</tr>
				</table>
			</div>
			<div class="row pad20">
				<div class="col-xs-12 col-sm-3  col-md-3">
						<label for="anio">Año:</label><br>
						<select id="anio" name="anio" tabindex="6" class="form-control redondear selectTranparent" onchange="reloadTableConsulta()" >
							<option value="2021">2021</option>
							<option value="2022">2022</option>
						</select>
					</div>
					<div class="col-xs-12 col-sm-3  col-md-3">
						<label for="mes">Mes:</label><br>
						<select id="mes" name="mes" tabindex="6" class="form-control redondear selectTranparent" onchange="reloadTableConsulta()" >
							<option value="0">Seleccione</option>
							<option value="1">Enero</option>
							<option value="2">Febrero</option>
							<option value="3">Marzo</option>
							<option value="4">Abril</option>
							<option value="5">Mayo</option>
							<option value="6">Junio</option>
							<option value="7">Julio</option>
							<option value="8">Agosto</option>
							<option value="9">Septiembre</option>
							<option value="10">Octubre</option>
							<option value="11">Noviembre</option>
							<option value="12">Diciembre</option>
							 <option value="1,2,3,4,5,6,7,8,9,10,11,12">Todo</option>
						</select>
					</div>
						<div class="col-xs-12 col-sm-3  col-md-3">
						<label for="estatus">Estatus:</label><br>
						<select id="estatus" name="estatus" tabindex="6" class="form-control redondear selectTranparent" onchange="reloadTableConsulta()" >
							<option value="0">Seleccione</option>
							<option value="1">Judicializadas</option>
							<option value="2">Vinculaciones a proceso</option>
						</select>
					</div>
				</div><br>
					<div class="col-md-6 col-md-offset-3" id="preloaderIMG" hidden>
						<img src="images/cargando.gif"/>
					</div>
			<table id="grid" class="display" width="100%" >
				<thead>
					<tr class="cabeceraConsulta">
						<th>NUC</th>
						<th>Expediente</th>
						<th>Estatus</th>
						<th>Ministerio Público</th>
						<th>Unidad</th>
						<th>Delito</th>
						<th>Mes</th>		
					</tr>
				</thead> 
				<tbody id="contentConsulta">
					
   </tbody>
  </table><br>

						
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

<div class="modal fade bs-example-modal-sm" id="modalFechaTerminacion" role="dialog" data-backdrop="static" data-keyboard="false">
	<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 30%; margin-top: 2.5%;">
		<div class="modal-content" style="">
			<div id="contModalFechaTerminacion">
			
			</div>
		</div>
	</div>
</div>


