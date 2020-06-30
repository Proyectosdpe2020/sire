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

					$data = getDAtaQuestion($conn, 3, $per, $anio, $idUnidad);
					$data2 = getDAtaQuestion($conn, 4, $per, $anio, $idUnidad);
					$getEnv = getInfOCarpetasEnv($conn, $idEnlace, 11);
					$envt = $getEnv[0][0]; 
				?>

				<h5 class="card-title tituloPregunta">Pregunta 2: Número de carpetas de investigación iniciadas durante el año 2020.</h5><br>
				<div class="textoPregunta" >
					<ul>
						<li style="list-style-type: circle !important">
							¿Cuál es el número de carpetas de investigación iniciadas durante el año 2020 con motivo de las denuncias, querellas u otros requisitos equivalentes que se recibieron en la Fiscalía General de la entidad federativa (incluyendo las recibidas en los Centros de Justicia para Mujeres) en ese mismo año?
						</li>
					</ul>
				</div><br><br>
				<div class="textoPregunta" >
					<ul>
						<li style="list-style-type: circle !important">
							¿Cuántas carpetas de investigación se iniciaron en el año 2020 correspondientes a denuncias, querellas u otros requisitos equivalentes recibidos en 2019?
						</li>
					</ul>
				</div><br><br>
				<table class="tableTrimes">
					<thead>
						<tr>
							<th scope="col">No.</th>
							<th scope="col">Número de carpetas de investigación iniciadas</th>
							 <th scope="col"><? echo $m1; ?></th>
						     <th scope="col"><? echo $m2; ?></th>
							 <th scope="col"><? echo $m3; ?></th>
							<th scope="col" style="background-color: #C09F77;">Total</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th scope="row">2.1</th>
							<td style="text-align: left;">Carpetas de investigación iniciadas por denuncias, querellas u otros requisitos equivalentes recibidos en 2020</td>
							<td><input type="number" value="<? echo $data[0][0]; ?>" id="p3m1" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data[0][1]; ?>" id="p3m2" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data[0][2]; ?>" id="p3m3" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td class="blockInp"><input type="number" value="<? echo $data[0][3]; ?>" id="p3tot" value="0" readonly></td>
						</tr>
						<tr>
							<th scope="row">2.2</th>
							<td style="text-align: left;">Carpetas de investigación iniciadas por denuncias, querellas u otros requisitos equivalentes recibidos en 2019</td>
							<td><input type="number" value="<? echo $data2[0][0]; ?>" id="p4m1" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data2[0][1]; ?>" id="p4m2" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data2[0][2]; ?>" id="p4m3" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td class="blockInp"><input type="number" value="<? echo $data2[0][3]; ?>" id="p4tot" value="0" readonly></td>
						</tr>
					</tbody>
				</table><br><br>
				<div class="textoNota" >
					<ul>
						<li style="list-style-type: circle !important" >
							<div class="imagenWarning">
							 <img src="images/warning.png"  class="imgWarning" alt="">
							 	Nota.- Los datos proporcionados en el reactivo 2:1 (carpetas de investigación iniciadas por denuncias, querellas u otros requisitos equivalentes recibidos en el año 2020) no podrán ser superiores a la suma de los reactivos 1.1 al 1.2 de la pregunta número 1.
							</div>
						</li>
					</ul>
				</div>
				<div class="botonGuardar">
					<? if($envt == 0){ ?>
					<button type="button" onclick="saveQuest2(2, <? echo $per; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, <? echo $idEnlace; ?>)" class="btn btn-success" id="guardarPregunta">GUARDAR</button><? } ?>
				</div>
		