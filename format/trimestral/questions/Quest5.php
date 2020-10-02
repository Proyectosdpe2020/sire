
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

					$data = getDAtaQuestion($conn, 10, $per, $anio, $idUnidad);
					$data2 = getDAtaQuestion($conn, 11, $per, $anio, $idUnidad);
					$data3 = getDAtaQuestion($conn, 12, $per, $anio, $idUnidad);
					$data4 = getDAtaQuestion($conn, 13, $per, $anio, $idUnidad);
					$data5 = getDAtaQuestion($conn, 14, $per, $anio, $idUnidad);

					$sumTotal = $data[0][3] + $data2[0][3] + $data3[0][3] + $data4[0][3] + $data5[0][3];
				?>


				<h5 class="card-title tituloPregunta">Pregunta 5: Ordenes de Aprehensión 2020.</h5><br>
				<div class="textoPregunta" >
					<ul>
						<li style="list-style-type: circle !important">
							De las carpetas de investigación iniciadas (CII) en el año 2020, ¿cuál es el número de órdenes de aprehensión solicitadas por el Ministerio Público; el número de órdenes de aprehensión ordenadas por el Juez de Control y el número de órdenes de aprehensión cumplimentadas por la Policía?
						</li>
					</ul>
				</div><br><br>
				<div class="textoPregunta" >
					<ul>
						<li style="list-style-type: circle !important">
							¿Cuántas órdenes de detención por caso urgente fueron emitidas por el Ministerio Público y cúantas de éstas fueron cumplimentadas por la Policía?
						</li>
					</ul>
				</div><br><hr><br>
				<table class="tableTrimes">
					<thead>
						<tr>
							<th scope="col">No.</th>
							<th scope="col">Órdenes de Aprehensión o Detención de CII en 2020</th>
							<th scope="col"><? echo $m1; ?></th>
							<th scope="col"><? echo $m2; ?></th>
							<th scope="col"><? echo $m3; ?></th>
							<th scope="col" style="background-color: #C09F77;">Total</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th scope="row">5.1</th>
							<td style="text-align: left;">Número de órdenes de aprehensión solicitadas por imputado</td>
							<td><input type="number" value="<? echo $data[0][0]; ?>" id="p10m1"></td>
							<td><input type="number" value="<? echo $data[0][1]; ?>" id="p10m2"></td>
							<td><input type="number" value="<? echo $data[0][2]; ?>" id="p10m3"></td>
							<td class="blockInp"><input type="number" value="<? echo $data[0][3]; ?>" id="p10tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">5.2</th>
							<td style="text-align: left;">Número de órdenes de aprehensión ordenadas por el Juez de Control por imputado</td>
							<td><input type="number" value="<? echo $data2[0][0]; ?>" id="p11m1"></td>
							<td><input type="number" value="<? echo $data2[0][1]; ?>" id="p11m2"></td>
							<td><input type="number" value="<? echo $data2[0][2]; ?>" id="p11m3"></td>
							<td class="blockInp"><input type="number" value="<? echo $data2[0][3]; ?>" id="p11tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">5.3</th>
							<td style="text-align: left;">Número de órdenes de aprehensión cumplimentadas por la Policía por imputado</td>
							<td><input type="number" value="<? echo $data3[0][0]; ?>" id="p12m1"></td>
							<td><input type="number" value="<? echo $data3[0][1]; ?>" id="p12m2"></td>
							<td><input type="number" value="<? echo $data3[0][2]; ?>" id="p12m3"></td>
							<td class="blockInp"><input type="number" value="<? echo $data3[0][3]; ?>" id="p12tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">5.4</th>
							<td style="text-align: left;">Número de órdenes de detención por caso urgente emitidas por el 	Ministerio Público por imputado</td>
							<td><input type="number" value="<? echo $data4[0][0]; ?>" id="p13m1"></td>
							<td><input type="number" value="<? echo $data4[0][1]; ?>" id="p13m2"></td>
							<td><input type="number" value="<? echo $data4[0][2]; ?>" id="p13m3"></td>
							<td class="blockInp"><input type="number" value="<? echo $data4[0][3]; ?>" id="p13tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">5.5</th>
							<td style="text-align: left;">Número de órdenes de detención por caso urgente cumplimentadas por la Policía por imputado</td>
							<td><input type="number" value="<? echo $data5[0][0]; ?>" id="p14m1"></td>
							<td><input type="number" value="<? echo $data5[0][1]; ?>" id="p14m2"></td>
							<td><input type="number" value="<? echo $data5[0][2]; ?>" id="p14m3"></td>
							<td class="blockInp"><input type="number" value="<? echo $data5[0][3]; ?>" id="p14tot" readonly></td>
						</tr>
						<tr>
						 <th style=" border: inset 0pt" scope="row"></th>
							<td style=" border: inset 0pt"></td>
							<td style=" border: inset 0pt"></td>
							<td style=" border: inset 0pt"></td>
							<td style=" border: inset 0pt"><strong>TOTAL:</strong></td>
							<td class="blockInp"><strong><?php if($sumTotal != null){ echo $sumTotal; } ?></strong></td>
						</tr>
					</tbody>
				</table><br><br>
				<div class="textoNota" >
					<ul>
						<li style="list-style-type: circle !important" >
							<div class="imagenWarning">
							 <img src="images/warning.png"  class="imgWarning" alt="">
							 Nota.- Los datos proporcionados en el reactivo 5.3 (números de órdenes de aprehensión cumplimentadas) no podrán ser superiores al reactivo 5.2 (número de órdenes de aprehensión ordenadas) y éstos a su vez no podrán ser superiores al reactivo 5.1 (número de órdenes de aprehensión solicitadas).<br><br>
							 De la misma forma, los datos proporcionados en el reactivo 5.5 (número de órdenes de detención por caso urgente cumplimentadas) no podrán ser superiores al reactivo 5.4 (número de órdenes de detención por caso urgente emitidas).
							</div>
						</li>
					</ul>
				</div>
				<div class="botonGuardar">
					<button type="button" class="btn btn-success" onclick="saveQuest5(5, <? echo $per; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, <? echo $idEnlace; ?>)" id="guardarPregunta">GUARDAR</button>
				</div>
		