<?php
session_start();

include ("../../Conexiones/Conexion.php");
include("../../funciones.php");		

$idUsuario = $_SESSION['useridIE'];


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
									<label class="titulo1" style="color: #686D72;">Busqueda de imputados Sire Litigación</label>
									<h4><label id="titfisc" class="titulo2">Fiscalía General del Estado de Michoácan</label></h4>
							 </div>
							</div>
						</td>
							<td id="nomostrar" class="imgdgtipeCabezeraPolicia" width="13%" height="125"></td>
					</tr>
				</table>
			</div>

			<!--CONTENIDO-->
   
   <div class="center-block">
   	<div class="panel panel-default fd1">
   		<div class="panel-body">
   			<h5 class="text-on-pannel"><strong>Busqueda de imputados</strong></h5>
   		</div>

   		<div class="row pad20">
   			<div class="col-xs-12 col-sm-12  col-md-3 input-group-lg">
   				<label for="ID_PAIS"><span class="glyphicon glyphicon-search"></span> Tipo de busqueda:</label><br>
   				<select class="form-control" id="tipo_busqueda" onchange="actualizar_busqueda(this.id)" >
   					<option class="fontBold" value="0">Seleccione el tipo</option>
							 <option class="fontBold" value="1">Busqueda por imputado</option>
							 <option class="fontBold" value="2">Busqueda por carpeta</option>
							</select>
						</div>
						<div class="col-xs-12 col-sm-12  col-md-3 input-group-lg imput_imputado" hidden>
							<label for="imputado"> Busqueda por imputado * :</label><br>
							<input type="text" class="form-control" id="imputado" placeholder="NOMBRE PATERNO MATENRO" maxlength="50" aria-describedby="sizing-addon1" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); "  onkeypress="return validaInput(event, 'varchar_letras')" value="" >
						</div>
						<div class="col-xs-12 col-sm-12  col-md-3 input-group-lg imput_nuc" hidden>
							<label for="nuc"> Busqueda por NUC * :</label><br>
							<input type="text" class="form-control" id="nuc" placeholder="NUMERO DE CASO" maxlength="13" aria-describedby="sizing-addon1" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); "  onkeypress="return validaInput(event, 'int')"  value="" >
						</div>
						<div class="col-xs-12 col-sm-12  col-md-3 input-group-lg btn_buscar" hidden>
							<label for="boton_buscar" hidden="true">.</label><br>
							<button type="button" class="btn btn-default btn-lg btn-success" style="width: 100%;" onclick="realizar_busqueda()" ><span class="glyphicon glyphicon-search"> Buscar</button>
						</div>
					</div><br>

					<div class="row pad20 div_tabla" hidden>
						<div class="col-xs-12 col-sm-12  col-md-12 input-group-lg">
							<div class="col-md-6 col-md-offset-3" id="preloaderIMG" hidden>
								<img src="images/cargando.gif"/>
							</div>

								<table id="gridPolicia" class="display table table-striped  table-hover" width="100%" >
									<thead>
										<tr class="cabeceraConsultaPolicia" >
											<th >#</th>
											<th >NUC</th>
											<th>EXPEDIENTE</th>
											<th >ESTATUS</th>
											<th >MINISTERIO PUBLICO</th>
											<th >UNIDAD</th>
											<th >FISCALIA</th>
											<th >IMPUTADO</th>
											<th >DOCUMENTO</th>
										</tr>
									</thead>
									<tbody id="contentConsulta">
										
									</tbody>
								</table><br>
							</div>
						</div><br>
    
   	</div>  	
   </div>
  

			<!--CONTENIDO-->

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
		</div>
	</div>


<!-- MODAL REGISTRO DE MANDAMIENTOS JUDICIALES  -->
	<div class="modal fade bs-example-modal-sm" id="mandamientos" role="dialog" data-backdrop="static" data-keyboard="false" style="overflow-y: scroll;">
		<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 85%; margin-top: 0.5%;">
			<div class="modal-content" style="">
				<div id="contModalMandamientos_registro">

				</div>
			</div>
		</div>
	</div>
	<!-- MODAL REGISTRO DE MANDAMIENTOS JUDICIALES  -->

	

