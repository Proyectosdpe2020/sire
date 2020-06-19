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

					$data = getDAtaQuestion($conn, 52, $per, $anio, $idUnidad);
					$data2 = getDAtaQuestion($conn, 53, $per, $anio, $idUnidad);
					$data3 = getDAtaQuestion($conn, 54, $per, $anio, $idUnidad);
					$data4 = getDAtaQuestion($conn, 55, $per, $anio, $idUnidad);
				?>



				<h5 class="card-title tituloPregunta">Pregunta 10: Sentencias condenatorias o absolutorias 2020</h5><br>
				<div class="textoPregunta" >
					<ul>
						<li style="list-style-type: circle !important">
						De los procedimientos derivados de las carpetas de investigación iniciadas en 2020, ¿cuántos imputados tuvieron sentencias condenatorias o absolutorias poor tipo de procedimiento?
						</li>
					</ul>
				</div><br><br>
				<div class="textoNota" >
					<ul>
						<li style="list-style-type: circle !important" >
							<div class="imagenWarning">
							 	Un imputado con una o más sentencias absolutorias y ninguna condenatoria 4 se contabilizará como un imputado con sentencia absolutoria. 
							</div>
						</li>
					</ul>
				</div><br>
				<div class="textoNota" >
					<ul>
						<li style="list-style-type: circle !important" >
							<div class="imagenWarning">
							 Un imputado con una o más sentencias condenatorias se contabilizará como un imputado con sentencia condenatoria.
							</div>
						</li>
					</ul>
				</div><br>
				<div class="textoNota" >
					<ul>
						<li style="list-style-type: circle !important" >
							<div class="imagenWarning">
							 	Un imputado con una o más sentencias absolutorias y una o más sentencias condenatorias se contabilizará como un imputado con sentencia condenatoria.
							</div>
						</li>
					</ul>
				</div><br><hr>
				<div class="botonAyuda">
					<button type="button" class="btn btn-primary" id="guardarPregunta" onclick="showModalAyuda(10)">Ayuda</button>
				</div><br>
				<table class="tableTrimes">
					<thead>
						<tr>
							<th scope="col">No.</th>
							<th scope="col">Imputados con sentencia</th>
							<th scope="col"><? echo $m1; ?></th>
							<th scope="col"><? echo $m2; ?></th>
							<th scope="col"><? echo $m3; ?></th>
							<th scope="col" style="background-color: #C09F77;">Total</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th scope="row">10.1</th>
							<td style="text-align: left;">Número de imputados con sentencia condenatoria por procedimiento abreviado</td>
							<td><input type="number" value="<? echo $data[0][0]; ?>" id="p52m1"></td>
							<td><input type="number" value="<? echo $data[0][1]; ?>" id="p52m2"></td>
							<td><input type="number" value="<? echo $data[0][2]; ?>" id="p52m3"></td>
							<td class="blockInp"><input type="number" value="<? echo $data[0][3]; ?>" id="p52tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">10.2</th>
							<td style="text-align: left;">Número de imputados con sentencia absolutoria por procedimiento abreviado</td>
							<td><input type="number" value="<? echo $data2[0][0]; ?>" id="p53m1"></td>
							<td><input type="number" value="<? echo $data2[0][1]; ?>" id="p53m2"></td>
							<td><input type="number" value="<? echo $data2[0][2]; ?>" id="p53m3"></td>
							<td class="blockInp"><input type="number" value="<? echo $data2[0][3]; ?>" id="p53tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">10.3</th>
							<td style="text-align: left;">Número de imputados con sentencia condenatoria por juicio oral</td>
							<td><input type="number" value="<? echo $data3[0][0]; ?>" id="p54m1"></td>
							<td><input type="number" value="<? echo $data3[0][1]; ?>" id="p54m2"></td>
							<td><input type="number" value="<? echo $data3[0][2]; ?>" id="p54m3"></td>
							<td class="blockInp"><input type="number" value="<? echo $data3[0][3]; ?>" id="p54tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">10.4</th>
							<td style="text-align: left;">Número de imputados con sentencia absolutoria por juicio oral</td>
							<td><input type="number" value="<? echo $data4[0][0]; ?>" id="p55m1"></td>
							<td><input type="number" value="<? echo $data4[0][1]; ?>" id="p55m2"></td>
							<td><input type="number" value="<? echo $data4[0][2]; ?>" id="p55m3"></td>
							<td class="blockInp"><input type="number" value="<? echo $data4[0][3]; ?>" id="p55tot" readonly></td>
						</tr>
					</tbody>
				</table><br><br>
				<div class="botonGuardar">
					<button type="button" class="btn btn-success" id="guardarPregunta" onclick="saveQuest10(10, <? echo $per; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, <? echo $idEnlace; ?>)">GUARDAR</button>
				</div>
		