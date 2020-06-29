
				<? 
					include ("../../../Conexiones/Conexion.php");
			include("../../../funcioneTrimes.php");
			include("../../../funciones.php");	

					if (isset($_GET["per"])){ $per = $_GET["per"]; }
					if (isset($_GET["anio"])){ $anio = $_GET["anio"]; }
					if (isset($_GET["idUnidad"])){ $idUnidad = $_GET["idUnidad"]; }
					if (isset($_GET["idEnlace"])){ $idEnlace = $_GET["idEnlace"]; }
					if($per == 1){ $m1 = "Enero"; $m2 = "Febrero"; $m3 = "Marzo"; $nme = "Enero - Marzo";}
					if($per == 2){ $m1 = "Abril"; $m2 = "Mayo"; $m3 = "Junio"; $nme = "Abril - Junio";}
					if($per == 3){ $m1 = "Julio"; $m2 = "Agosto"; $m3 = "Septiembre"; $nme = "Julio - Septiembre";}
					if($per == 4){ $m1 = "Octubre"; $m2 = "Noviembre"; $m3 = "Diciembre"; $nme = "Octubre - Diciembre";}

					$data = getDAtaQuestion($conn, 5, $per, $anio, $idUnidad);
					$data2 = getDAtaQuestion($conn, 6, $per, $anio, $idUnidad);
					$data3 = getDAtaQuestion($conn, 7, $per, $anio, $idUnidad);
					$getEnv = getInfOCarpetasEnv($conn, $idEnlace, 11);
					$envt = $getEnv[0][0]; 
				?>


				<h5 class="card-title tituloPregunta">Pregunta 3: Número de victimas u ofendidos 2020</h5><br>
				<div class="textoPregunta" >
					<ul>
						<li style="list-style-type: circle !important">
							¿Cúal es el número de víctimas u ofendidos que derivan de las carpetas de investigación iniciadas en 2020?.
						</li>
					</ul>
				</div><br><hr><br>
				<table class="tableTrimes">
					<thead>
						<tr>
							<th scope="col">No.</th>
							<th scope="col">Victimas u Ofendidos</th>
							<th scope="col"><? echo $m1; ?></th>
							<th scope="col"><? echo $m2; ?></th>
							<th scope="col"><? echo $m3; ?></th>
							<th scope="col" style="background-color: #C09F77;">Total</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th scope="row">3.1</th>
							<td style="text-align: left;">Número de victimas u ofendidos mujeres</td>
							<td><input type="number" value="<? echo $data[0][0]; ?>" id="p5m1" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data[0][1]; ?>" id="p5m2" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data[0][2]; ?>" id="p5m3" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td class="blockInp"><input type="number" value="<? echo $data[0][3]; ?>" id="p5tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">3.2</th>
							<td style="text-align: left;">Número de victimas u ofendidos hombres</td>
							<td><input type="number" value="<? echo $data2[0][0]; ?>" id="p6m1" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data2[0][1]; ?>" id="p6m2" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data2[0][2]; ?>" id="p6m3" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td class="blockInp"><input type="number" value="<? echo $data2[0][3]; ?>" id="p6tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">3.3</th>
							<td style="text-align: left;">Otros tipos de víctimas u ofendidos</td>
							<td><input type="number" value="<? echo $data3[0][0]; ?>" id="p7m1" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data3[0][1]; ?>" id="p7m2" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data3[0][2]; ?>" id="p7m3" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td class="blockInp"><input type="number" value="<? echo $data3[0][3]; ?>" id="p7tot" readonly></td>
						</tr>
					</tbody>
				</table><br>
				<div class="botonGuardar">
						<? if($envt == 0){ ?>
					<button type="button" class="btn btn-success" id="guardarPregunta" onclick="saveQuest3(3, <? echo $per; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, <? echo $idEnlace; ?>)">GUARDAR</button> <? } ?>
				</div>
	