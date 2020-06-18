
	<?php
	session_start();
	include ("../../../Conexiones/Conexion.php");
	include("../../../funciones.php");	
	include ("../../../Conexiones/conexionSicap.php");
		include("../../../funcioneLit.php");
	include("../../../funcioneSicap.php");

	if (isset($_POST["name"])){ $name = $_POST["name"]; }
	if (isset($_POST["age"])){ $age = $_POST["age"]; }

	?>

				  			<div class="card-body" id="ajaxContainerQUes">
				  				<h5 class="card-title tituloPregunta">Pregunta 2: Número de denuncias, querellas u otros requisitos</h5><br>
				  				<div class="textoPregunta" >
				  					<ul>
				  						<li style="list-style-type: circle !important">
				  							¿Cúal es el número de <strong>denuncias, querellas u otros requisitos</strong> equivalentes que se recibierón en la Procuraduria General de Justicia o Fiscalía General de la entidad federativa (incluyendo las recibidas en los Centros de Justicia para Mujeres) durante el 2020.
				  						</li>
				  					</ul>
				  				</div><br><hr><br><br>
				  				<table class="tableTrimes">
									  <thead>
									    <tr>
									      <th scope="col">No.</th>
									      <th scope="col">Denuncias / Querellas / Otros Requisitos Equivalentes</th>
									      <th scope="col">Enero</th>
									      <th scope="col">Febrero</th>
									      <th scope="col">Marzo</th>
									      <th scope="col" style="background-color: #C09F77;">Total</th>
									    </tr>
									  </thead>
									  <tbody>
									    <tr>
									     <th scope="row">2.1</th>
									     <td style="text-align: left;">Denuncias</td>
								              <td>415</td>
								              <td>142</td>
								              <td>120</td>
								              <td>120</td>
									    </tr>
									  </tbody>
									</table>
									<div class="float-right">
										<button type="button" class="btn btn-success" id="guardarPregunta">GUARDAR</button>
									</div>
								</div>
						