	<? 
					include ("../../../Conexiones/Conexion.php");
			include("../../../funcioneTrimes.php");
			include("../../../funciones.php");	

					if (isset($_GET["per"])){ $per = $_GET["per"]; }
					if (isset($_GET["anio"])){ $anio = $_GET["anio"]; }
					if (isset($_GET["idUnidad"])){ $idUnidad = $_GET["idUnidad"]; }
					if (isset($_GET["idEnlace"])){ $idEnlace = $_GET["idEnlace"]; }

					if($per == 1){ $m1 = "Enero"; $m2 = "Febrero"; $m3 = "Marzo"; $nme = "Enero - Marzo"; $arr = array(1,2,3); }
					if($per == 2){ $m1 = "Abril"; $m2 = "Mayo"; $m3 = "Junio"; $nme = "Abril - Junio"; $arr = array(4,5,6);}
					if($per == 3){ $m1 = "Julio"; $m2 = "Agosto"; $m3 = "Septiembre"; $nme = "Julio - Septiembre"; $arr = array(7,8,9);}
					if($per == 4){ $m1 = "Octubre"; $m2 = "Noviembre"; $m3 = "Diciembre"; $nme = "Octubre - Diciembre"; $arr = array(10,11,12);}
					$getEnv = getInfOCarpetasEnv($conn, $idEnlace, 11);
					$envt = $getEnv[0][0]; 
		?>
				
				<h5 class="card-title tituloPregunta">Pregunta 4: Número de Carpetas con detenido(s) en flagrancia 2020 </h5><br>
				<div class="textoPregunta" >
					<ul>
						<li style="list-style-type: circle !important">
							¿Cúantas carpetas de investigación se iniciaron en el año 2020 con al menos un detenido en flagrancia y cuántas se iniciaron sin detenido?
						</li>
					</ul>
				</div><br><hr><br>
				<table class="tableTrimes">
					<thead>
						<tr>
							<th scope="col">No.</th>
							<th scope="col">Número de Carpetas de Investigación Iniciadas</th>
							<th scope="col"><? echo $m1; ?></th>
							<th scope="col"><? echo $m2; ?></th>
							<th scope="col"><? echo $m3; ?></th>
							<th scope="col" style="background-color: #C09F77;">Total</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th scope="row">4.1</th>
							<td style="text-align: left;">Con detenido en flagrancia</td>
							<?
									$tota = 0; $tota1 = 0;
									for ($o=0; $o < sizeof($arr) ; $o++) { 
												$data = getDAtaSIREQuestion($conn,$arr[$o], $anio, $idUnidad);
												$tota = $tota + $data[0][0];
												if(is_null($data[0][1])){ $data[0][0] = 0; }
												?>
													<td class="blockInp"><input type="number" value="<? echo $data[0][0]; ?>" id="p8m<? echo $o+1; ?>" readonly></td>
												<?										
									}
							?>	
							<td class="blockInp"><input type="number" value="<? echo $tota; ?>" id="p8tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">4.2</th>
							<td style="text-align: left;">Sin detenido</td>
								<?
									for ($o=0; $o < sizeof($arr) ; $o++) { 
												$data = getDAtaSIREQuestion($conn,$arr[$o], $anio, $idUnidad);
												$tota1 = $tota1 + $data[0][1];
												if(is_null($data[0][1])){ $data[0][1] = 0; }
												?>
													<td class="blockInp"><input type="number" value="<? echo $data[0][1]; ?>" id="p9m<? echo $o+1; ?>" readonly></td>
												<?										
									}
							?>								
							<td class="blockInp"><input type="number" value="<? echo $tota1; ?>" id="p9tot" readonly></td>
						</tr>
					</tbody>
				</table><br><br>
				<div class="textoNotaSire" >
					<ul>
						<li style="list-style-type: circle !important" >
								Los reactivos 4.1 y 4.2 fueron precargados automáticamente correspondiente con la información que fue proporcionada por su unidad en el Sistema Integral de Registro Estadístico (SIRE)<br><br>
						</li>
					</ul>
				</div>
				<div class="textoNota" >
					<ul>
						<li style="list-style-type: circle !important" >
							<div class="imagenWarning">
							 <img src="images/warning.png"  class="imgWarning" alt="">
							 	Nota.- Si una carpeta de investigación iniciada cuenta con al menos un detenido en flagrancia se registrará en el reactivo 4.1, incluso cuando se presente una situación mixta en la que puedan identificarse personas que no pudieron ser detenidas, pero se cuenta con al menos un detenido en flagrancia. Si la carpeta de investigación iniciada no cuenta con algún detenido se registrará en el reactivo 4.2.
							</div>
						</li>
					</ul>
				</div>
				<div class="botonGuardar">
					<? if($envt == 0){ ?>
					<button type="button" class="btn btn-success" id="guardarPregunta" onclick="saveQuest4(4, <? echo $per; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, <? echo $idEnlace; ?>)">GUARDAR</button> <? } ?>
				</div>