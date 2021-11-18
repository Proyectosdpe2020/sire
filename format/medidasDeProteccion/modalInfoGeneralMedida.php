<?php
include ("../../Conexiones/Conexion.php");
include ("../../Conexiones/conexionMedidas.php");
include("../../Conexiones/conexionSicap.php");	
include("../../funcionesPueDispo.php");	
include("../../funcionesMedidasProteccion.php");
$fecha_actual=date("d/m/Y");
$fecha=strftime( "%Y-%m-%d %H:%M:%S", time() );


?>


<div class="modal-header" style="background-color:#152F4A;">
	<center><label style="color: white; font-weight: bold; font-size: 2rem;">Registro de Medida de Protección</label></center>
</div>
<div class="modal-body">
	<input type="hidden" id="idMedidaProteccion" value="<? if($tipoModal == 0){}else if($tipoModal == 1){echo $puestaSaveId;} ?>" name="idMedidaProteccion">
	<!--DATOS GENERALES NUC Y CUADERNO DE ANTECEDENTES-->
	<div class="panel panel-default fd1">
		<div class="panel-body">
			<h5 class="text-on-pannel"><strong>Datos Genrales</strong></h5>
			<div class="row">
				<div class="col-xs-12 col-sm-12  col-md-4">
					<label for="nuc">NUC: </label>
					<input class="form-control mandda gehit" value="1003202145526"  id="nuc"  type="text" disabled>
				</div>
				<div class="col-xs-12 col-sm-12  col-md-4">
					<label for="numAntecedentes">CUADERNO DE ANTECEDENTES: <span class="aste">(*)</span></label>
					<input class="form-control mandda gehit" value=""  id="numAntecedentes"  type="text">
				</div>
				<div class="col-xs-12 col-sm-12  col-md-4">
				 <label for="ratificacion">TEMPORALIDAD: <span class="aste">(*)</span></label>
					<select class="form-control">
						 <option>Seleccione</option>
						 <?php for ($i=1; $i<=99; $i++){ ?>
						 	<option class="fontBold" value="<?php echo $i;?>"><?php echo $i;?> días</option>
						 <?php } ?>
					</select>
				</div>
			</div><br>
		</div>
	</div>
	<!--DATOS GENERALES NUC Y CUADERNO DE ANTECEDENTES-->
	<!--DATOS RESOLUCIÓN-->
	<div class="panel panel-default fd1">
		<div class="panel-body">
			<h5 class="text-on-pannel"><strong>Resolución</strong></h5>
			<div class="row">
				<div class="col-xs-12 col-sm-12  col-md-2">
					<label for="ratificacion">Ratificación: <span class="aste">(*)</span></label>
					<select class="form-control">
						 <option>Seleccione</option>
					  <option class="fontBold">Si</option>
					  <option class="fontBold">No</option>
					</select>
				</div>
				<div class="col-xs-12 col-sm-12  col-md-4">
					<label for="obsRatificacion">Observación: <span class="aste">(*)</span></label>
					<input class="form-control mandda gehit" value=""  id="obsRatificacion"  type="text">
				</div>
				<div class="col-xs-12 col-sm-12  col-md-2">
					<label for="modifica">Modificada: <span class="aste">(*)</span></label>
					<select class="form-control">
						 <option>Seleccione</option>
					  <option class="fontBold">Si</option>
					  <option class="fontBold">No</option>
					</select>
				</div>
				<div class="col-xs-12 col-sm-12  col-md-4">
					<label for="obsModifica">Observación: <span class="aste">(*)</span></label>
					<input class="form-control mandda gehit" value=""  id="obsModifica"  type="text">
				</div>
			</div><br>
		</div>
	</div>
	<!--DATOS RESOLUCIÓN-->
	<!--DATOS VICTIMA-->
	<div class="panel panel-default fd1">
		<div class="panel-body">
			<h5 class="text-on-pannel"><strong>Datos de la víctima</strong></h5>
			<div class="row">
				<div class="col-xs-12 col-sm-12  col-md-4">
					<label for="materno">Victima: <span class="aste">(*)</span></label>
					<select class="form-control" onChange="mostrarDatosVictima(this.value);" >
						 <option>Seleccione</option>
					  <option class="fontBold">Jose Daniel Garcia Sanchez</option>
					  <option class="fontBold">Luis Enrique Ruiz Martinez</option>
					</select>
				</div>
			</div><br>
			<!--INICIA DIV OCULTO DATOS VICTIMA-->
			<div id="datosVictima" style="display: none;">
				<div class="row">
					<div class="col-xs-12 col-sm-12  col-md-3">
						<label for="nombreVicti">Nombre: <span class="aste">(*)</span></label>
						<input class="form-control mandda gehit" value=""  id="nombreVicti"  type="text">
					</div>
					<div class="col-xs-12 col-sm-12  col-md-3">
						<label for="paternoVicti">Paterno: <span class="aste">(*)</span></label>
						<input class="form-control mandda gehit" value=""  id="paternoVicti"  type="text">
					</div>
					<div class="col-xs-12 col-sm-12  col-md-3">
						<label for="maternoVicti">Materno: <span class="aste">(*)</span></label>
						<input class="form-control mandda gehit" value=""  id="maternoVicti"  type="text">
					</div>
					<div class="col-xs-12 col-sm-12  col-md-2">
						<label for="generoVicti">Género: <span class="aste">(*)</span></label>
						<select class="form-control">
						  <option class="fontBold">Masculino</option>
						  <option class="fontBold">Femenino</option>
						</select>
					</div>
					<div class="col-xs-12 col-sm-12  col-md-1">
						<label for="edadVicti">Edad: <span class="aste">(*)</span></label>
						<select class="form-control">
							 <option class="fontBold" value="0">Desconocida</option>		
							<?php 
							$valor=-1;
							for ($i=1; $i<12; $i++){	?>
								<option class="fontBold" value="<? echo $valor ?>" ><? echo $i; ?> Meses</option>
							<? $valor--;}
							for ($i=1; $i<=100; $i++){	?>
								<option class="fontBold" value="<? echo $i; ?> "><?echo $i; ?> Años</option>
							<? } ?>
						</select>
					</div>
				</div><br>
				<div class="row">
					<div class="col-xs-12 col-sm-12  col-md-12">
					<h4>Datos de residencia y contacto: <h4>
					</div>
				</div><br>
				<div class="row">
					<div class="col-xs-12 col-sm-12  col-md-3">
						<label for="estado">Entidad federativa: <span class="aste">(*)</span></label>
						<input class="form-control mandda gehit" value=""  id="estado"  type="text">
					</div>
					<div class="col-xs-12 col-sm-12  col-md-3">
						<label for="municipio">Municipio: <span class="aste">(*)</span></label>
						<input class="form-control mandda gehit" value=""  id="municipio"  type="text">
					</div>
					<div class="col-xs-12 col-sm-12  col-md-3">
						<label for="localidad">Localidad: <span class="aste">(*)</span></label>
						<select class="form-control">
							<option>Seleccione</option>
						 <option class="fontBold">Masculino</option>
						 <option class="fontBold">Femenino</option>
						</select>
					</div>
					<div class="col-xs-12 col-sm-12  col-md-3">
						<label for="colonia">Colonia: <span class="aste">(*)</span></label>
						<input class="form-control mandda gehit" value=""  id="colonia"  type="text">
					</div>
				</div><br>
				<div class="row">
					<div class="col-xs-12 col-sm-12  col-md-3">
						<label for="telefono">Télefono: <span class="aste">(*)</span></label>
						<input class="form-control mandda gehit" value=""  id="telefono"  type="text">
					</div>
					<div class="col-xs-12 col-sm-12  col-md-3">
						<label for="codigoPostal">Codigo Postal: <span class="aste">(*)</span></label>
						<input class="form-control mandda gehit" value=""  id="codigoPostal"  type="text">
					</div>
				</div><br>
			</div>
			<!--TERMINA DIV OCULTO DATOS VICTIMA-->
		</div>
	</div>
	<!--DATOS VICTIMA-->
	<!--DATOS DEL IMPUTADO-->
	<div class="panel panel-default fd1">
		<div class="panel-body">
			<h5 class="text-on-pannel"><strong>Imputado(s)</strong></h5>
			<div class="row">
				<div class="col-xs-12 col-sm-12  col-md-3">
					<label for="nombreImpu">Nombre: <span class="aste">(*)</span></label>
					<input class="form-control mandda gehit" value=""  id="nombreImpu"  type="text">
				</div>
				<div class="col-xs-12 col-sm-12  col-md-3">
					<label for="paternoImpu">Paterno: <span class="aste">(*)</span></label>
					<input class="form-control mandda gehit" value=""  id="paternoImpu"  type="text">
				</div>
				<div class="col-xs-12 col-sm-12  col-md-3">
					<label for="maternoImpu">Materno: <span class="aste">(*)</span></label>
					<input class="form-control mandda gehit" value=""  id="maternoImpu"  type="text">
				</div>
				<div class="col-xs-12 col-sm-12  col-md-2">
					<label for="generoImpu">Género: <span class="aste">(*)</span></label>
					<select class="form-control" id="generoImpu" name="generoImpu">
						<option value="0" selected>Seleccione</option>
					 <option class="fontBold" value="1" >Masculino</option>
					 <option class="fontBold" value="1" >Femenino</option>
					 <option class="fontBold" value="3" >Desconocido</option>
					</select>
				</div>
				<div class="col-xs-12 col-sm-12  col-md-1">
					<label for="edadImpu">Edad: <span class="aste">(*)</span></label>
					<select class="form-control" id="edadImpu">
						<option value="0">Seleccione</option>
					 <option class="fontBold" value="1" >1 Años</option>
					 <option class="fontBold" value="2" >2 Años</option>
					 <option class="fontBold" value="3" >Desconocido</option>
					</select>
				</div>
			</div><br>
			<div class="row">
				<div class="col-xs-12 col-sm-12  col-md-12">
					<input type="checkbox" id="acepto" name="acepto" onclick="imputadoDesconocido()" >
					<label for="acepto"><span></span>Descoonocido</label>
				</div>
			</div><br>
			<div class="row">
				<div class="col-xs-12 col-sm-12  col-md-3">
					<button type="button" class="btn btn-primary">Agregar imputado</button>
				</div>
			</div><br>
			<label>Imputado(s)</label>
			<div class="row">
				<div class="col-xs-12 col-sm-12  col-md-12">
					<table class="table table-bordered">
						<thead>
							<tr class="cabeceraTablaVictimas">
							<th>#</th>
							<th>Nombre</th>
							<th>Paterno</th>
							<th>Materno</th>
							<th>Género</th>
							<th>Edad</th>
							<th>Acciones</th>
							<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>1</td>
								<td>Luis Enrique</td>
								<td>Ruiz</td>
								<td>Martinez</td>
								<td>Masculino</td>
								<td>27 Años</td>
								<td><center><span onclick="" title="Editar" style="cursor: pointer; color: orange; font-size: 18px;" class="glyphicon glyphicon-edit"></span></center></td>
								<td><center><span onclick="" title="Eliminar" style="cursor: pointer; color: red; font-size: 18px;" class="glyphicon glyphicon-trash"></span> </center></td>
							</tr>
						</tbody>
				 </table>
				</div>
			</div>
		</div>
	</div>
		<!--DATOS DEL IMPUTADO-->
		<!--CONSTANCIA DE LLAMADAS-->
	<div class="panel panel-default fd1">
		<div class="panel-body">
			<h5 class="text-on-pannel"><strong>Constancia de llamadas</strong></h5>
			<div class="row">
				<div class="col-xs-12 col-sm-12  col-md-2">
					<label for="heard">Fecha y hora: <span class="aste">(*)</span></label>
					<input id="dateConstanciaLlamada" type="datetime-local" value="" name="dateConstanciaLlamada" class="fechas form-control gehit" />
				</div>
				<div class="col-xs-12 col-sm-12  col-md-4">
					<label for="obsConstanciaLlamada">Observaciones: <span class="aste">(*)</span></label>
					<input class="form-control mandda gehit" value=""  id="obsConstanciaLlamada"  type="text">
				</div>
			</div><br>
		</div>
	</div>
	<!--CONSTANCIA DE LLAMADAS-->

<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	<button type="button" class="btn btn-primary">Guardar información</button>
</div>

