<?php
include ("../../../Conexiones/conexionMedidas.php");
include ("../../../Conexiones/conexionSicap.php");
include("../../../funcionesMedidasProteccion.php");	

if (isset($_POST["idMedida"])){ $idMedida = $_POST["idMedida"]; }	
if (isset($_POST["idVictima"])){ $idVictima = $_POST["idVictima"]; }	
if (isset($_POST["fraccion"])){ $fraccion = $_POST["fraccion"]; }	
if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }	

$data = getDataVictimasEditar($connMedidas, $idVictima); 
$nombre  = $data[0][2];
$paterno  = $data[0][3];
$materno  = $data[0][4];
$genero  = $data[0][5];
$edad  = $data[0][7];
$getEntidadID = $data[0][8];
$getMunicipioID = $data[0][10];
$nombreMunicipio = $data[0][11];
$colonia = $data[0][12];
$calle = $data[0][13];
$numero = $data[0][14];
$telefono1 = $data[0][15];
$telefono2 = $data[0][16];
$codigoPostal = $data[0][17];
$correo = $data[0][18];
?>
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
						</div></br>
						<div class="modal-footer">
							<button type="button" class="btn btn-primary" onclick="saveDatosGenerales()">Guardar información</button>
						</div>