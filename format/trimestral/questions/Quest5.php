
				<? 
					include ("../../../Conexiones/Conexion.php");
					include ("../../../Conexiones/conexionSicap.php");
			include("../../../funcioneTrimes.php");
			include("../../../funciones.php");	

					if (isset($_GET["per"])){ $per = $_GET["per"]; }
					if (isset($_GET["anio"])){ $anio = $_GET["anio"]; }
					if (isset($_GET["idUnidad"])){ $idUnidad = $_GET["idUnidad"]; }
					if (isset($_GET["idEnlace"])){ $idEnlace = $_GET["idEnlace"]; }
					if($per == 1){ 
										$m1 = "Enero"; $mes1 = 1; 
										$m2 = "Febrero"; $mes2 = 2;  
										$m3 = "Marzo"; $mes3 = 3; 
										$nme = "Enero - Marzo";}
					if($per == 2){ $mes1 = 4; $m1 = "Abril"; $mes2 = 5; $m2 = "Mayo"; $mes3 = 6; $m3 = "Junio"; $nme = "Abril - Junio";}
					if($per == 3){ $mes1 = 7; $m1 = "Julio"; $mes2 = 8; $m2 = "Agosto"; $mes3 = 9; $m3 = "Septiembre"; $nme = "Julio - Septiembre";}
					if($per == 4){ $mes1 = 10; $m1 = "Octubre"; $mes2 = 11; $m2 = "Noviembre"; $mes3 = 12; $m3 = "Diciembre";  $nme = "Octubre - Diciembre";}

					$data = getDAtaQuestion($conn, 10, $per, $anio, $idUnidad);
					$data2 = getDAtaQuestion($conn, 11, $per, $anio, $idUnidad);
					$data3 = getDAtaQuestion($conn, 12, $per, $anio, $idUnidad);
					$data4 = getDAtaQuestion($conn, 13, $per, $anio, $idUnidad);
					$data5 = getDAtaQuestion($conn, 14, $per, $anio, $idUnidad);
					
					$getEnv = getInfOCarpetasEnv($conn, $idEnlace, 11);
					$envt = $getEnv[0][0];

					$sumTotal = $data[0][3] + $data2[0][3] + $data3[0][3] + $data4[0][3] + $data5[0][3];
				?>


				<h5 class="card-title tituloPregunta">Pregunta 5: Ordenes de Aprehensión <?php echo "$anio";?>.</h5><br>
				<div class="textoPregunta" >
					<ul>
						<li style="list-style-type: circle !important">
							De las carpetas de investigación iniciadas (CII) en el año <?php echo "$anio";?>, ¿cuál es el número de órdenes de aprehensión solicitadas por el Ministerio Público; el número de órdenes de aprehensión ordenadas por el Juez de Control y el número de órdenes de aprehensión cumplimentadas por la Policía?
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
							<th scope="col">Órdenes de Aprehensión o Detención de CII en <?php echo "$anio";?></th>
							<th scope="col">2017</th>
							<th scope="col">2018</th>
							<th scope="col">2019</th>
							<th scope="col">2020</th>
							<th scope="col">2021</th>
							<th scope="col">Años Anteriores</th>
							<th scope="col"><? echo $m1; ?></th>
							<th scope="col"><? echo $m2; ?></th>
							<th scope="col"><? echo $m3; ?></th>
							<th scope="col" style="background-color: #C09F77;">Total</th>
						</tr>
					</thead>
					<tbody>
						<? 
						
							$dataQuestAn10 = getDataAnteriores($conn, 10, $idEnlace, $idUnidad, $anio, $per);
							$dataQuestAn11 = getDataAnteriores($conn, 11, $idEnlace, $idUnidad, $anio, $per);
							$dataQuestAn12 = getDataAnteriores($conn, 12, $idEnlace, $idUnidad, $anio, $per);
							$dataQuestAn13 = getDataAnteriores($conn, 13, $idEnlace, $idUnidad, $anio, $per);
							$dataQuestAn14 = getDataAnteriores($conn, 14, $idEnlace, $idUnidad, $anio, $per);

						?>
						<tr class="blockInp">
							<th scope="row">5.1</th>
							<td style="text-align: left;">Número de órdenes de aprehensión solicitadas por imputado</td>
							<td class="" data-toggle="modal"><? echo $dataQuestAn10[0][0]; ?></td>
							<td><input type="number" value="<? echo $dataQuestAn10[0][1]; ?>" id="1val2018"></td>
							<td><input type="number" value="<? echo $dataQuestAn10[0][2]; ?>" id="1val2019"></td>
							<td><input type="number" value="<? echo $dataQuestAn10[0][3]; ?>" id="1val2020"></td>
							<td><input type="number" value="<? echo $dataQuestAn10[0][4]; ?>" id="1val2021"></td>
							<td class="" data-toggle="modal"><? echo $dataQuestAn10[0][0]; ?></td>
							<td><input type="number" value="<? echo $data[0][0]; ?>" id="p10m1"></td>
							<td><input type="number" value="<? echo $data[0][1]; ?>" id="p10m2"></td>
							<td><input type="number" value="<? echo $data[0][2]; ?>" id="p10m3"></td>
							<td class="blockInp"><input type="number" value="<? echo $data[0][3]; ?>" id="p10tot" readonly></td>
						</tr>
						<tr class="blockInp">
							<th scope="row">5.2</th>
							<td style="text-align: left;">Número de órdenes de aprehensión ordenadas por el Juez de Control por imputado</td>
							<td class=""  data-toggle="modal"><? echo $dataQuestAn10[0][0]; ?></td>
							<td><input type="number" value="<? echo $dataQuestAn11[0][1]; ?>" id="2val2018"></td>
							<td><input type="number" value="<? echo $dataQuestAn11[0][2]; ?>" id="2val2019"></td>
							<td><input type="number" value="<? echo $dataQuestAn11[0][3]; ?>" id="2val2020"></td>
							<td><input type="number" value="<? echo $dataQuestAn11[0][4]; ?>" id="2val2021"></td>
							<td class="" data-toggle="modal"><? echo $dataQuestAn10[0][0]; ?></td>
							<td><input type="number" value="<? echo $data2[0][0]; ?>" id="p11m1"></td>
							<td><input type="number" value="<? echo $data2[0][1]; ?>" id="p11m2"></td>
							<td><input type="number" value="<? echo $data2[0][2]; ?>" id="p11m3"></td>
							<td class="blockInp"><input type="number" value="<? echo $data2[0][3]; ?>" id="p11tot" readonly></td>
						</tr>
						<tr class="blockInp">
							<th scope="row">5.3</th>
							<td style="text-align: left;">Número de órdenes de aprehensión cumplimentadas por la Policía por imputado</td>
							<td class=""  data-toggle="modal"><? echo $dataQuestAn10[0][0]; ?></td>
							<td><input type="number" value="<? echo $dataQuestAn12[0][1]; ?>" id="3val2018"></td>
							<td><input type="number" value="<? echo $dataQuestAn12[0][2]; ?>" id="3val2019"></td>
							<td><input type="number" value="<? echo $dataQuestAn12[0][3]; ?>" id="3val2020"></td>
							<td><input type="number" value="<? echo $dataQuestAn12[0][4]; ?>" id="3val2021"></td>
							<td class=""  data-toggle="modal"><? echo $dataQuestAn10[0][0]; ?></td>
							<td><input type="number" value="<? echo $data3[0][0]; ?>" id="p12m1"></td>
							<td><input type="number" value="<? echo $data3[0][1]; ?>" id="p12m2"></td>
							<td><input type="number" value="<? echo $data3[0][2]; ?>" id="p12m3"></td>
							<td class="blockInp"><input type="number" value="<? echo $data3[0][3]; ?>" id="p12tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">5.4</th>
							<td style="text-align: left;">Número de órdenes de detención por caso urgente emitidas por el 	Ministerio Público por imputado</td>

							<? 
										$d13 = getArrayCounts($conn, 13, $idEnlace, $idUnidad, $per, 0);
										$d14 = getArrayCounts($conn, 14, $idEnlace, $idUnidad, $per, 0);						
										
										$d131 = getCountNucsTrim($conn, $anio, 13, $idEnlace, $idUnidad, $per, $mes1);
										$d132 = getCountNucsTrim($conn, $anio, 13, $idEnlace, $idUnidad, $per, $mes2);
										$d133 = getCountNucsTrim($conn, $anio, 13, $idEnlace, $idUnidad, $per, $mes3);
										$totd13 = $d131[0][0] + $d132[0][0] + $d133[0][0];

										$d141 = getCountNucsTrim($conn, $anio, 14, $idEnlace, $idUnidad, $per, $mes1);
										$d142 = getCountNucsTrim($conn, $anio, 14, $idEnlace, $idUnidad, $per, $mes2);
										$d143 = getCountNucsTrim($conn, $anio, 14, $idEnlace, $idUnidad, $per, $mes3);
										$totd14 = $d141[0][0] + $d142[0][0] + $d143[0][0];


							?>
							<td class="cPo" onclick="loaNucTrimeShow(0,2017, <? echo $per; ?>, 13, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d13[0]; ?></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2018, <? echo $per; ?>, 13, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d13[1];; ?></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2019, <? echo $per; ?>, 13, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d13[2]; ?></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2020, <? echo $per; ?>, 13, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d13[3]; ?></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2021, <? echo $per; ?>, 13, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d13[4]; ?></td>

							<td class="cPo" onclick="loaNucTrimes(0,0, <? echo $per; ?>, 13, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)">Capturar</td>

							<td class="cPo" onclick="loaNucTrimes(<? echo $mes1; ?>,<? echo $anio; ?>, <? echo $per; ?>, 13, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d131[0][0]; ?></td>
							<td class="cPo" onclick="loaNucTrimes(<? echo $mes2; ?>,<? echo $anio; ?>, <? echo $per; ?>, 13, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d132[0][0]; ?></td>
							<td class="cPo" onclick="loaNucTrimes(<? echo $mes3; ?>,<? echo $anio; ?>, <? echo $per; ?>, 13, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d133[0][0]; ?></td>
							<td class="blockInp"><input type="number" value="<? echo $totd13; ?>" id="p13tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">5.5</th>
							<td style="text-align: left;">Número de órdenes de detención por caso urgente cumplimentadas por la Policía por imputado</td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2017, <? echo $per; ?>, 14, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d14[0]; ?></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2018, <? echo $per; ?>, 14, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d14[1]; ?></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2019, <? echo $per; ?>, 14, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d14[2]; ?></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2020, <? echo $per; ?>, 14, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d14[3]; ?></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2021, <? echo $per; ?>, 14, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d14[4]; ?></td>

							<td class="cPo" onclick="loaNucTrimes(0,0, <? echo $per; ?>, 14, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)">Capturar</td>
							
							<td class="cPo" onclick="loaNucTrimes(<? echo $mes1; ?>,<? echo $anio; ?>, <? echo $per; ?>, 14, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d141[0][0]; ?></td>
							<td class="cPo" onclick="loaNucTrimes(<? echo $mes2; ?>,<? echo $anio; ?>, <? echo $per; ?>, 14, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d142[0][0]; ?></td>
							<td class="cPo" onclick="loaNucTrimes(<? echo $mes3; ?>,<? echo $anio; ?>, <? echo $per; ?>, 14, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d143[0][0]; ?></td>
							<td class="blockInp"><input type="number" value="<? echo $totd14; ?>" id="p14tot" readonly></td>
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
							<td style=" border: inset 0pt"></td>
							<td style=" border: inset 0pt"><strong>TOTAL:</strong></td>
							<td class="blockInp"><strong><?php if($sumTotal != null){ echo $sumTotal; }else{echo "0";} ?></strong></td>
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

				<!--<div id="ajaxContainerQUes5">aqui respuesta</div>-->
				<div class="botonGuardar">
				<? if($envt == 0){ ?> 
					<button type="button" class="btn btn-success" onclick="saveQuest5(5, <? echo $per; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, <? echo $idEnlace; ?>)" id="guardarPregunta">GUARDAR</button>
					<? } ?>
				</div>
		