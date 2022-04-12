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

					$data = getDAtaQuestion($conn, 52, $per, $anio, $idUnidad);
					$data2 = getDAtaQuestion($conn, 53, $per, $anio, $idUnidad);
					$data3 = getDAtaQuestion($conn, 54, $per, $anio, $idUnidad);
					$data4 = getDAtaQuestion($conn, 55, $per, $anio, $idUnidad);
					$getEnv = getInfOCarpetasEnv($conn, $idEnlace, 11);
					$envt = $getEnv[0][0]; 
					$sumTotal = $data[0][3] + $data2[0][3] + $data3[0][3] + $data4[0][3];
				?>



				<h5 class="card-title tituloPregunta">Pregunta 10: Sentencias condenatorias o absolutorias <?php echo "$anio";?></h5><br>
				<div class="textoPregunta" >
					<ul>
						<li style="list-style-type: circle !important">
						De los procedimientos derivados de las carpetas de investigación iniciadas en el año <?php echo "$anio";?>, ¿cuántos imputados tuvieron sentencias condenatorias o absolutorias por tipo de procedimiento?
						</li>
					</ul>
				</div><br><br>
				<div class="textoNota" >
					<ul>
						<li style="list-style-type: circle !important" >
							<div class="imagenWarning">
							 	Un imputado con una o más sentencias absolutorias y ninguna condenatoria se contabilizará como un imputado con sentencia absolutoria. 
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
				</div><br><hr><br>
				<table class="tableTrimes">
					<thead>
						<tr>
							<th scope="col">No.</th>
							<th scope="col">Imputados con sentencia</th>
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
						
						$dataQuestAn52 = getDataAnteriores($conn, 52, $idEnlace, $idUnidad, $anio, $per);
						$dataQuestAn53 = getDataAnteriores($conn, 53, $idEnlace, $idUnidad, $anio, $per);
						$dataQuestAn54 = getDataAnteriores($conn, 54, $idEnlace, $idUnidad, $anio, $per);
						$dataQuestAn55 = getDataAnteriores($conn, 55, $idEnlace, $idUnidad, $anio, $per);

					?>
						<tr>
							<th scope="row">10.1</th>
							<td style="text-align: left;">Número de imputados con sentencia condenatoria por procedimiento abreviado</td>
							<td><input type="number" value="<? echo $dataQuestAn52[0][0]; ?>" id="1val2017"></td>
							<td><input type="number" value="<? echo $dataQuestAn52[0][1]; ?>" id="1val2018"></td>
							<td><input type="number" value="<? echo $dataQuestAn52[0][2]; ?>" id="1val2019"></td>
							<td><input type="number" value="<? echo $dataQuestAn52[0][3]; ?>" id="1val2020"></td>
							<td><input type="number" value="<? echo $dataQuestAn52[0][4]; ?>" id="1val2021"></td>
							<td><input type="number" value="<? echo $data[0][0]; ?>" id="p52m1" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data[0][1]; ?>" id="p52m2" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data[0][2]; ?>" id="p52m3" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td class="blockInp"><input type="number" value="<? echo $data[0][3]; ?>" id="p52tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">10.2</th>
							<td style="text-align: left;">Número de imputados con sentencia absolutoria por procedimiento abreviado</td>
							<td><input type="number" value="<? echo $dataQuestAn53[0][0]; ?>" id="2val2017"></td>
							<td><input type="number" value="<? echo $dataQuestAn53[0][1]; ?>" id="2val2018"></td>
							<td><input type="number" value="<? echo $dataQuestAn53[0][2]; ?>" id="2val2019"></td>
							<td><input type="number" value="<? echo $dataQuestAn53[0][3]; ?>" id="2val2020"></td>
							<td><input type="number" value="<? echo $dataQuestAn53[0][4]; ?>" id="2val2021"></td>
							<td><input type="number" value="<? echo $data2[0][0]; ?>" id="p53m1" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data2[0][1]; ?>" id="p53m2" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data2[0][2]; ?>" id="p53m3" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td class="blockInp"><input type="number" value="<? echo $data2[0][3]; ?>" id="p53tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">10.3</th>
							<td style="text-align: left;">Número de imputados con sentencia condenatoria por juicio oral</td>
							<td><input type="number" value="<? echo $dataQuestAn54[0][0]; ?>" id="3val2017"></td>
							<td><input type="number" value="<? echo $dataQuestAn54[0][1]; ?>" id="3val2018"></td>
							<td><input type="number" value="<? echo $dataQuestAn54[0][2]; ?>" id="3val2019"></td>
							<td><input type="number" value="<? echo $dataQuestAn54[0][3]; ?>" id="3val2020"></td>
							<td><input type="number" value="<? echo $dataQuestAn54[0][4]; ?>" id="3val2021"></td>
							<td><input type="number" value="<? echo $data3[0][0]; ?>" id="p54m1" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data3[0][1]; ?>" id="p54m2" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data3[0][2]; ?>" id="p54m3" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td class="blockInp"><input type="number" value="<? echo $data3[0][3]; ?>" id="p54tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">10.4</th>
							<td style="text-align: left;">Número de imputados con sentencia absolutoria por juicio oral</td>
							<td><input type="number" value="<? echo $dataQuestAn55[0][0]; ?>" id="4val2017"></td>
							<td><input type="number" value="<? echo $dataQuestAn55[0][1]; ?>" id="4val2018"></td>
							<td><input type="number" value="<? echo $dataQuestAn55[0][2]; ?>" id="4val2019"></td>
							<td><input type="number" value="<? echo $dataQuestAn55[0][3]; ?>" id="4val2020"></td>
							<td><input type="number" value="<? echo $dataQuestAn55[0][4]; ?>" id="4val2021"></td>
							<td><input type="number" value="<? echo $data4[0][0]; ?>" id="p55m1" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data4[0][1]; ?>" id="p55m2" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td><input type="number" value="<? echo $data4[0][2]; ?>" id="p55m3" <? if($envt == 1){ echo "readonly"; } ?>></td>
							<td class="blockInp"><input type="number" value="<? echo $data4[0][3]; ?>" id="p55tot" readonly></td>
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
							<td class="blockInp"><strong><?php if($sumTotal != null){ echo $sumTotal; }else{echo "0";} ?></strong></td>
						</tr>
					</tbody>
				</table><br><br>
				<div class="botonGuardar">
					<? if($envt == 0){ ?>
					<button type="button" class="btn btn-success" id="guardarPregunta" onclick="saveQuest10(10, <? echo $per; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, <? echo $idEnlace; ?>)">GUARDAR</button> <? } ?>
				</div>
		