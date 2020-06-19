<? 
					include ("../../../Conexiones/Conexion.php");
			  include("../../../funcioneTrimes.php");

					if (isset($_GET["per"])){ $per = $_GET["per"]; }
					if (isset($_GET["anio"])){ $anio = $_GET["anio"]; }
					if (isset($_GET["idUnidad"])){ $idUnidad = $_GET["idUnidad"]; }
					if (isset($_GET["idEnlace"])){ $idEnlace = $_GET["idEnlace"]; }
					if($per == 1){ $m1 = "Enero"; $m2 = "Febrero"; $m3 = "Marzo"; $nme = "Enero - Marzo";}
					if($per == 2){ $m1 = "Abril"; $m2 = "Mayo"; $m3 = "Junio"; $nme = "Abril - Junio";}
					if($per == 3){ $m1 = "Julio"; $m2 = "Agosto"; $m3 = "Septiembre"; $nme = "Julio - Septiembre";}
					if($per == 4){ $m1 = "Octubre"; $m2 = "Noviembre"; $m3 = "Diciembre"; $nme = "Octubre - Diciembre";}

					$data = getDAtaQuestion($conn, 48, $per, $anio, $idUnidad);
					$data2 = getDAtaQuestion($conn, 49, $per, $anio, $idUnidad);
					$data3 = getDAtaQuestion($conn, 50, $per, $anio, $idUnidad);
					$data4 = getDAtaQuestion($conn, 51, $per, $anio, $idUnidad);
				?>


				<h5 class="card-title tituloPregunta">Pregunta 9: Medidas Cautelares 2020</h5><br>
				<div class="textoPregunta" >
					<ul>
						<li style="list-style-type: circle !important">
							De los procedimientos derivados de las carpetas de investigación iniciadas en 2020, ¿a cúantos imputados de los que se les dictó auto de vinculación a proceso o que se encontraban en espera de la audiencia de vinculación se les impuso alguna medida caultelar?
						</li>
					</ul>
				</div><br><hr>
				<div class="botonAyuda">
					<button type="button" class="btn btn-primary" id="guardarPregunta" onclick="showModalAyuda(9)">Ayuda</button>
				</div><br>
				<table class="tableTrimes">
					<thead>
						<tr>
							<th scope="col">No.</th>
							<th scope="col">Imputados Vinculados a Proceso o en Espera</th>
							<th scope="col"><? echo $m1; ?></th>
							<th scope="col"><? echo $m2; ?></th>
							<th scope="col"><? echo $m3; ?></th>
							<th scope="col" style="background-color: #C09F77;">Total</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th scope="row">9.1</th>
							<td style="text-align: left;">Número de inputados a los que se les impuso prisión preventiva oficiosa</td>
							<td><input type="number" value="<? echo $data[0][0]; ?>" id="p48m1"></td>
							<td><input type="number" value="<? echo $data[0][1]; ?>" id="p48m2"></td>
							<td><input type="number" value="<? echo $data[0][2]; ?>" id="p48m3"></td>
							<td class="blockInp"><input type="number" value="<? echo $data[0][3]; ?>" id="p48tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">9.2</th>
							<td style="text-align: left;">Número de imputados a los que se les impuso a prisión preventiva no oficiosa</td>
							<td><input type="number" value="<? echo $data2[0][0]; ?>" id="p49m1"></td>
							<td><input type="number" value="<? echo $data2[0][1]; ?>" id="p49m2"></td>
							<td><input type="number" value="<? echo $data2[0][2]; ?>" id="p49m3"></td>
							<td class="blockInp"><input type="number" value="<? echo $data2[0][3]; ?>" id="p49tot" readonly></td>
						</tr>
						</tr>
						<tr>
							<th scope="row">9.3</th>
							<td style="text-align: left;">Número de imputados a los que se les impuso otra medida cautelar</td>
							<td><input type="number" value="<? echo $data3[0][0]; ?>" id="p50m1"></td>
							<td><input type="number" value="<? echo $data3[0][1]; ?>" id="p50m2"></td>
							<td><input type="number" value="<? echo $data3[0][2]; ?>" id="p50m3"></td>
							<td class="blockInp"><input type="number" value="<? echo $data3[0][3]; ?>" id="p50tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">9.4</th>
							<td style="text-align: left;">Número de imputados a los que se les impuso medida cautelar</td>
							<td><input type="number" value="<? echo $data4[0][0]; ?>" id="p51m1"></td>
							<td><input type="number" value="<? echo $data4[0][1]; ?>" id="p51m2"></td>
							<td><input type="number" value="<? echo $data4[0][2]; ?>" id="p51m3"></td>
							<td class="blockInp"><input type="number" value="<? echo $data4[0][3]; ?>" id="p51tot" readonly></td>
						</tr>
					</tbody>
				</table><br>
				<div class="botonGuardar">
					<button type="button" class="btn btn-success" id="guardarPregunta" onclick="saveQuest9(9, <? echo $per; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, <? echo $idEnlace; ?>)">GUARDAR</button>
				</div>
	