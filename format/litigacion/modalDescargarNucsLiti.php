<?php

 include ("../../Conexiones/Conexion.php");
 include ("../../Conexiones/conexionSicap.php");
	include("../../funciones.php");
	include("../../funcioneSicap.php");
	include("../../funcioneLit.php");
	include("../../funcionesLitSENAP.php");


if(isset($_POST["idMp"])){ $idMp = $_POST["idMp"]; } 
if(isset($_POST["mes"])){ $mes = $_POST["mes"]; } 
if(isset($_POST["anio"])){ $anio = $_POST["anio"]; } 
if(isset($_POST["idUnidad"])){ $idUnidad = $_POST["idUnidad"]; } 


?>


<div class="modal-header" style="background-color:#152F4A;">
	<center><label style="color: white; font-weight: bold; font-size: 1rem;">RELACIÓN DE NUCS INFORMADOS EN EL PERIODO </label></center>
</div>


<div class="modal-body panel_modalCargaNucsExcel">
	<!--DATOS GENERALES-->
	<div class="panel panel-default fd1">
		<div class="panel-body">
  
  
		<!--	<h5 class="text-on-pannel"><strong>Vista previa de nucs</strong></h5>-->
			<div class="row">
				<div class="col-xs-12 col-sm-12  col-md-12 input-group-lg">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 class="panel-title">Vista previa de NUCS.</h3>
						</div>
						<div class="panel-body">	
							<div class="row">
								<div class="col-xs-12 col-sm-12  col-md-12 input-group-lg">
										<div class="col-md-6 col-md-offset-3" id="preloaderIMG" hidden>
											<img src="images/cargando.gif"/>
										</div>

								<table id="gridDescargarNucsLiti" class="display table table-striped  table-hover" width="100%" >
									<thead>
										<tr class="cabeceraConsultaPolicia" >
											<th >#</th>
											<th >ESTATUS</th>
											<th >NUC</th>
											<th >EXPEDIENTE</th>
											<th >MINISTERIO PUBLICO</th>
											<th >UNIDAD</th>
											<th >FISCALIA</th>
											<th >MES</th>
											<th >AÑO</th>
										</tr>
									</thead>
									<tbody id="contentConsulta">
										<? 	$dataNucs = get_data_nuc_descarga($conn, $mes, $anio, $idUnidad);	 
										    for ($i=0; $i < sizeof($dataNucs) ; $i++) { ?>
										    <tr>
										    	<td> <? echo ($i+1) ?> </td>
										    	<td><center><? echo $dataNucs[$i][1]; ?></center></td>
										    	<td><center><? echo $dataNucs[$i][2]; ?></center></td>
										    	<td><center><? echo $dataNucs[$i][3]; ?></center></td>
										    	<td><center><? echo $dataNucs[$i][4]; ?></center></td>
										    	<td><center><? echo $dataNucs[$i][5]; ?></center></td>
										    	<td><center><? echo $dataNucs[$i][6]; ?></center></td>
										    	<td><center><? echo $dataNucs[$i][7]; ?></center></td>
										    	<td><center><? echo $dataNucs[$i][8]; ?></center></td>
										   </tr>
										<?	}	?>
									</tbody>
									</table><br>

								</div>
							</div><br>
						</div>
						<div class="panel-footer">
						
					 </div>
					</div>	
				</div>	
			</div>

			<div class="row" id="div_nuc_invalidos" hidden="true">
				<div class="col-xs-12 col-sm-12  col-md-12 input-group-lg">
					<div class="panel panel-danger">
						<div class="panel-heading">
							<h3 class="panel-title">DATOS NO VALIDADOS.</h3>
						</div>
						<div class="panel-body" style="background-color: lightyellow;">	
							<div class="row">
								<div class="col-xs-12 col-sm-12  col-md-12 input-group-lg">
									<label>Los siguientes datos no han sido procesados debido a que es un dato invalido o el NUC no se ha podido validar en SIGI y SICAP. Verifique en su archivo Excel cada uno de los siguientes datos e ingreselos manualmente.</label>
								</div>
							</div><br>
							<div class="row">
								<div class="col-xs-12 col-sm-12  col-md-12 input-group-lg">
										<div class="col-md-6 col-md-offset-3" id="preloaderIMG" hidden>
											<img src="images/cargando.gif"/>
										</div>
         
										<table id="gridPolicia2" class="display table table-striped  table-hover" width="100%">
											<thead>
												<tr class="cabeceraConsultaPolicia" >
													<th class="textCent">#</th>
													<th class="textCent10">NUC</th>
												</tr>
											</thead>
											<tbody id="contentConsulta2">
											
											</tbody>
										</table><br>

								</div>
							</div><br>
						</div>
						<div class="panel-footer">
						
					 </div>
					</div>	
				</div>	
			</div>



		</div>
	</div>
</div>
<!--DATOS GENERALES-->


<div class="modal-footer">
	<div class="row">
		<div class="col-xs-12 col-sm-12  col-md-6 col-md-offset-6">
			<button type="button" class="btn btn-default btn-lg" data-dismiss="modal" onclick="closeModalCargarExcel()" >Cerrar ventana</button>
		</div>
	</div>
</div>


<!--MODAL PARA AGREGAR IMPUTADOS-->

<div class="modal fade bs-example-modal-sm" id="editar" role="dialog" data-backdrop="static" data-keyboard="false" style="overflow: auto">
	<div id="modalVistaCss" class="modal-dialog modal-sm" style="width: 80%; margin-top: 1%; ">
		<div class="modal-content">
			<div id="contmodal_editarImputado">
			 
			 <div class="modal-header" style="background-color:#152F4A;">
	<center><label style="color: white; font-weight: bold; font-size: 2rem;">Datos del imputado </label></center>
</div>

<div class="modal-body panel_registroMandamientos">

	<!--DATOS GENERALES-->
	<div class="panel panel-default fd1">
		<div class="panel-body">
			<h5 class="text-on-pannel"><strong>Datos del imputado</strong></h5>
			<div class="row">
				<div class="col-xs-12 col-sm-12  col-md-12 input-group-lg">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 class="panel-title">Ingrese los datos del imputado con el nuc: <label id="nuc_label"></label></h3>
						</div>
						<div class="panel-body">
							<form id="frmeditar">
									<div class="row">
										<div class="col-xs-12 col-sm-12  col-md-4 input-group-lg">
						     <input type="hidden" class="form-control" id="id_registro" placeholder="idRegistro" aria-describedby="sizing-addon1" maxlength="40" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); "  onkeypress="" value="" >
										</div>
									</div><br>
									<div class="row">
										<div class="col-xs-12 col-sm-12  col-md-4 input-group-lg">
											<label for="nombre"><span class="glyphicon glyphicon-user"></span> Nombre del inculpado:</label><br>
						     <input type="text" class="form-control" id="nombre" placeholder="ESPECIFICA EL NOMBRE DEL INCULPADO" aria-describedby="sizing-addon1" maxlength="40" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); "  onkeypress="" value="" >
										</div>
										<div class="col-xs-12 col-sm-12  col-md-4 input-group-lg">
											<label for="ap_paterno">Apellido paterno :</label><br>
						 				<input type="text" class="form-control" id="ap_paterno" placeholder="ESPECIFICA EL APELLIDO PATERNO" aria-describedby="sizing-addon1" maxlength="50" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); "  onkeypress="" value="" >
										</div>
										<div class="col-xs-12 col-sm-12  col-md-4 input-group-lg">
											<label for="ap_materno">Apellido materno:</label><br>
						     <input type="text" class="form-control" id="ap_materno" placeholder="ESPECIFICA EL APELLIDO MATERNO" aria-describedby="sizing-addon1" maxlength="50" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); "  onkeypress="" value="" >
										</div>
									</div><br>
										<div class="row">
											<div class="col-xs-12 col-sm-12  col-md-5 input-group-lg">
												<label for="id_sexo">Sexo</label><br>
												<input type="radio" id="id_sexo" name="id_sexo" value="M" style="height:25px; width:25px;" checked>
												<label for="cv_sexo" style="font-size: 20px;">Masculino</label>&nbsp;&nbsp;&nbsp;&nbsp;
												<input type="radio" id="id_sexo" name="id_sexo" value="F" style="height:25px; width:25px;">
												<label for="cv_sexo" style="font-size: 20px;">Femenino</label>
											</div>
											<div class="col-xs-12 col-sm-12  col-md-3 input-group-lg">
												<label for="edad">Edad:</label><br>
							     			<input type="number" class="form-control" id="edad" placeholder="EDAD" aria-describedby="sizing-addon1" maxlength="2" value="" >
											</div>
											<div class="col-xs-12 col-sm-12  col-md-4 input-group-lg">
											<label for="curp">CURP:</label><br>
									     <input type="text" class="form-control" id="curp" placeholder="ESPECIFICA EL CURP" aria-describedby="sizing-addon1" maxlength="50" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase(); "  onkeypress="" value="" >
											</div>
										</div>
						 </form>
						</div>

						<div class="panel-footer">
						
					 </div>
					</div>	
				</div>	
			</div>
		</div>
	</div>
</div>
<!--DATOS GENERALES-->

	
<div class="modal-footer">
	<div class="row">
		<div class="col-xs-12 col-sm-12  col-md-6 col-md-offset-3">
			<button type="button" class="btn btn-primary btn-lg" id="agregar_imputado" style="width: 100%;"><span class="glyphicon glyphicon-floppy-disk"></span> Aceptar </button>
		</div>
		<div class="col-xs-12 col-sm-12  col-md-3">
			<button type="button" class="btn btn-default btn-lg"  onclick="closeModalImputados()" >Cerrar ventana</button>
		</div>
	</div>
</div>


			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
  $("#file").change(function () {
  	console.log('hola');
    cargar_excel(this);
  });
</script>