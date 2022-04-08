
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

					$data = getDAtaQuestion($conn, 15, $per, $anio, $idUnidad);
					$data2 = getDAtaQuestion($conn, 16, $per, $anio, $idUnidad);
					$data3 = getDAtaQuestion($conn, 17, $per, $anio, $idUnidad);
					$getEnv = getInfOCarpetasEnv($conn, $idEnlace, 11);
					$envt = $getEnv[0][0]; 
					$sumTotal = $data[0][3] + $data2[0][3] + $data3[0][3];				

				?>


				<h5 class="card-title tituloPregunta">Pregunta 6: Número de detenidos en flagrancia <?php echo "$anio";?></h5><br>
				<div class="textoPregunta" >
					<ul>
						<li style="list-style-type: circle !important">
							Cuál es el número de detenidos en flagrancia, por orden de aprehensión o caso urgente derivados de las carpetas de investigación iniciadas en <?php echo "$anio";?>?
						</li>
					</ul>
				</div><br><hr><br>
				<table class="tableTrimes">
					<thead>
						<tr>
							<th scope="col">No.</th>
							<th scope="col">Detenidos de CII en <?php echo "$anio";?></th>
							<th scope="col">2017</th>
							<th scope="col">2018</th>
							<th scope="col">2019</th>
							<th scope="col">2020</th>
							<th scope="col">2021</th>
							<th scope="col"><? echo $m1; ?></th>
							<th scope="col"><? echo $m2; ?></th>
							<th scope="col"><? echo $m3; ?></th>
							<th scope="col" style="background-color: #C09F77;">Total</th>
						</tr>
					</thead>
					<tbody>
						<? 
						
							$dataQuestAn15 = getDataAnteriores($conn, 15, $idEnlace, $idUnidad, $anio, $per);
							$dataQuestAn16 = getDataAnteriores($conn, 16, $idEnlace, $idUnidad, $anio, $per);
							$dataQuestAn17 = getDataAnteriores($conn, 17, $idEnlace, $idUnidad, $anio, $per);
						
						?>
						<tr>
							<th scope="row">6.1</th>
							<td style="text-align: left;">Número de detenidos en flagrancia</td>
							<td><input type="number" value="<? echo $dataQuestAn15[0][0]; ?>" id="1val2017"></td>
							<td><input type="number" value="<? echo $dataQuestAn15[0][1]; ?>" id="1val2018"></td>
							<td><input type="number" value="<? echo $dataQuestAn15[0][2]; ?>" id="1val2019"></td>
							<td><input type="number" value="<? echo $dataQuestAn15[0][3]; ?>" id="1val2020"></td>
							<td><input type="number" value="<? echo $dataQuestAn15[0][4]; ?>" id="1val2021"></td>
							<td><input type="number" value="<? echo $data[0][0]; ?>" id="p15m1" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data[0][1]; ?>" id="p15m2" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data[0][2]; ?>" id="p15m3" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td class="blockInp"><input type="number" value="<? echo $data[0][3]; ?>" id="p15tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">6.2</th>
							<td style="text-align: left;">Número de detenidos por orden de aprehensión</td>
							<td><input type="number" value="<? echo $dataQuestAn16[0][0]; ?>" id="2val2017"></td>
							<td><input type="number" value="<? echo $dataQuestAn16[0][1]; ?>" id="2val2018"></td>
							<td><input type="number" value="<? echo $dataQuestAn16[0][2]; ?>" id="2val2019"></td>
							<td><input type="number" value="<? echo $dataQuestAn16[0][3]; ?>" id="2val2020"></td>
							<td><input type="number" value="<? echo $dataQuestAn16[0][4]; ?>" id="2val2021"></td>
							<td><input type="number" value="<? echo $data2[0][0]; ?>" id="p16m1" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data2[0][1]; ?>" id="p16m2" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data2[0][2]; ?>" id="p16m3" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td class="blockInp"><input type="number" value="<? echo $data2[0][3]; ?>" id="p16tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">6.3</th>
							<td style="text-align: left;">Número de detenidos por caso urgente</td>
							<td><input type="number" value="<? echo $dataQuestAn17[0][0]; ?>" id="3val2017"></td>
							<td><input type="number" value="<? echo $dataQuestAn17[0][1]; ?>" id="3val2018"></td>
							<td><input type="number" value="<? echo $dataQuestAn17[0][2]; ?>" id="3val2019"></td>
							<td><input type="number" value="<? echo $dataQuestAn17[0][3]; ?>" id="3val2020"></td>
							<td><input type="number" value="<? echo $dataQuestAn17[0][4]; ?>" id="3val2021"></td>
							<td><input type="number" value="<? echo $data3[0][0]; ?>" id="p17m1" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data3[0][1]; ?>" id="p17m2" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data3[0][2]; ?>" id="p17m3" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td class="blockInp"><input type="number" value="<? echo $data3[0][3]; ?>" id="p17tot" readonly></td>
						</tr>
						<tr>
						 <th style=" border: inset 0pt" scope="row"></th>
							<td style=" border: inset 0pt"></td>
							<td style=" border: inset 0pt"></td>
							<td style=" border: inset 0pt"></td>
							<td style=" border: inset 0pt"></td>
							<td style=" border: inset 0pt"></td>
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
						<li style="list-style-type: circle !important">
							<div class="imagenWarning">
							 <img src="images/warning.png"  class="imgWarning" alt="">
							 	Nota.- Los datos proporcionados en el reactivo 6.1 (número de detenidos en flagrancia) deberán ser cuando menos iguales o superiores al reactivo 4.1 (carpetas de investigación iniciadas con detendido en flagrancia) de la pregunta número 4
							</div>
						</li>
					</ul>
				</div><br><br>
				<div class="textoNota" >
					<ul>
						<li style="list-style-type: circle !important" >
							<div class="imagenWarning">
							 Por su parte, los datos proporcionados en el reactivo 6.2 (número de detenidos por orden de aprehensión) deberan ser iguales o mayores a los datos proporcionados en el reactivo 5.3 (número de órdenes de aprehensión cumplimentadas) de la pregunta número 5. Lo anterior no es aplicable si la persona o personas se encuentren privadas de la libertad, es decir, en el centro penitenciario en cumplimiento de su sentencia condenatoria o en cumplimiento de la medida cautelar de prisión preventiva.
							</div>
						</li>
					</ul>
				</div><br><br>
				<div class="textoNota" >
					<ul>
						<li style="list-style-type: circle !important" >
							<div class="imagenWarning">
							 	De la misma forma, los datos proporcionados en el reactivo 6.3(número de detenidos por caso urgente) deberán ser iguales o mayores a los datos proporcionados en el reactivo 5.5 (número de órdenes de detención por caso urgente cumplimentadas) de la pregunta número 5.
							</div>
						</li>
					</ul>
				</div>
				<div class="botonGuardar">
					<? if($envt == 0){ ?>
					<button type="button" class="btn btn-success" id="guardarPregunta" onclick="saveQuest6(6, <? echo $per; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, <? echo $idEnlace; ?>)">GUARDAR</button> <? } ?>
				</div>
			