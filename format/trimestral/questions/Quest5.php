
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
				<div style="display: none;" id="laodimgmain" class="jm-loadingpage2 "></div>
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

<? 
										$d10 = getArrayCounts($conn, 10, $idEnlace, $idUnidad, $per, 0);
										$d11 = getArrayCounts($conn, 11, $idEnlace, $idUnidad, $per, 0);				
										$d12 = getArrayCounts($conn, 12, $idEnlace, $idUnidad, $per, 0);			
												
										
										$d101 = getCountNucsTrim($conn, $anio, 10, $idEnlace, $idUnidad, $per, $mes1);
										$d102 = getCountNucsTrim($conn, $anio, 10, $idEnlace, $idUnidad, $per, $mes2);
										$d103 = getCountNucsTrim($conn, $anio, 10, $idEnlace, $idUnidad, $per, $mes3);
										$totd10 = $d101[0][0] + $d102[0][0] + $d103[0][0];

										$d111 = getCountNucsTrim($conn, $anio, 11, $idEnlace, $idUnidad, $per, $mes1);
										$d112 = getCountNucsTrim($conn, $anio, 11, $idEnlace, $idUnidad, $per, $mes2);
										$d113 = getCountNucsTrim($conn, $anio, 11, $idEnlace, $idUnidad, $per, $mes3);
										$totd11 = $d111[0][0] + $d112[0][0] + $d113[0][0];

										$d121 = getCountNucsTrim($conn, $anio, 12, $idEnlace, $idUnidad, $per, $mes1);
										$d122 = getCountNucsTrim($conn, $anio, 12, $idEnlace, $idUnidad, $per, $mes2);
										$d123 = getCountNucsTrim($conn, $anio, 12, $idEnlace, $idUnidad, $per, $mes3);
										$totd12 = $d121[0][0] + $d122[0][0] + $d123[0][0];
							?>

						<tr class="">
							<th scope="row">5.1</th>
							<input style="display: none !important;" type="number" value="0" id="p10m1">
							<input style="display: none !important;" type="number" value="0" id="p10m2">
							<input style="display: none !important;" type="number" value="0" id="p10m3">
							<td style="text-align: left;">Número de órdenes de aprehensión solicitadas por imputado</td>

							<td class="cPo" onclick="loaNucTrimeShow(0,2017, <? echo $per; ?>, 10, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d10[0]; ?><input type="hidden" value="<? echo $d10[0]; ?>" id="1val2017"></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2018, <? echo $per; ?>, 10, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d10[1]; ?><input type="hidden" value="<? echo $d10[1]; ?>" id="1val2018"></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2019, <? echo $per; ?>, 10, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d10[2]; ?><input type="hidden" value="<? echo $d10[2]; ?>" id="1val2019"></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2020, <? echo $per; ?>, 10, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d10[3]; ?><input type="hidden" value="<? echo $d10[3]; ?>" id="1val2020"></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2021, <? echo $per; ?>, 10, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d10[4]; ?><input type="hidden" value="<? echo $d10[4]; ?>" id="1val2021"></td>

							<td class="cPo" onclick="loaNucTrimes(0,0, <? echo $per; ?>, 10, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)">Capturar</td>

							<td class="cPo" onclick="loaNucTrimes(<? echo $mes1; ?>,<? echo $anio; ?>, <? echo $per; ?>, 10, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d101[0][0]; ?></td>
							<td class="cPo" onclick="loaNucTrimes(<? echo $mes2; ?>,<? echo $anio; ?>, <? echo $per; ?>, 10, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d102[0][0]; ?></td>
							<td class="cPo" onclick="loaNucTrimes(<? echo $mes3; ?>,<? echo $anio; ?>, <? echo $per; ?>, 10, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d103[0][0]; ?></td>
							<td class="blockInp"><input type="number" value="<? echo $totd10; ?>" id="p10tot" readonly></td>

						</tr>
						<tr class="">
							<th scope="row">5.2</th>
							<input style="display: none !important;" type="number" value="0" id="p11m1">
							<input style="display: none !important;" type="number" value="0" id="p11m2">
							<input style="display: none !important;" type="number" value="0" id="p11m3">
							<td style="text-align: left;">Número de órdenes de aprehensión ordenadas por el Juez de Control por imputado</td>

							<td class="cPo" onclick="loaNucTrimeShow(0,2017, <? echo $per; ?>, 11, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d11[0]; ?><input type="hidden" value="<? echo $d11[0]; ?>" id="2val2017"></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2018, <? echo $per; ?>, 11, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d11[1]; ?><input type="hidden" value="<? echo $d11[1]; ?>" id="2val2018"></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2019, <? echo $per; ?>, 11, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d11[2]; ?><input type="hidden" value="<? echo $d11[2]; ?>" id="2val2019"></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2020, <? echo $per; ?>, 11, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d11[3]; ?><input type="hidden" value="<? echo $d11[3]; ?>" id="2val2020"></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2021, <? echo $per; ?>, 11, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d11[4]; ?><input type="hidden" value="<? echo $d11[4]; ?>" id="2val2021"></td>

							<td class="cPo" onclick="loaNucTrimes(0,0, <? echo $per; ?>, 11, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)">Capturar</td>

							<td class="cPo" onclick="loaNucTrimes(<? echo $mes1; ?>,<? echo $anio; ?>, <? echo $per; ?>, 11, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d111[0][0]; ?></td>
							<td class="cPo" onclick="loaNucTrimes(<? echo $mes2; ?>,<? echo $anio; ?>, <? echo $per; ?>, 11, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d112[0][0]; ?></td>
							<td class="cPo" onclick="loaNucTrimes(<? echo $mes3; ?>,<? echo $anio; ?>, <? echo $per; ?>, 11, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d113[0][0]; ?></td>
							<td class="blockInp"><input type="number" value="<? echo $totd11; ?>" id="p11tot" readonly></td>
						</tr>
						<tr class="">
							<th scope="row">5.3</th>
							<input style="display: none !important;" type="number" value="0" id="p12m1">
							<input style="display: none !important;" type="number" value="0" id="p12m2">
							<input style="display: none !important;" type="number" value="0" id="p12m3">
							<td style="text-align: left;">Número de órdenes de aprehensión cumplimentadas por la Policía por imputado</td>
					
							<td class="cPo" onclick="loaNucTrimeShow(0,2017, <? echo $per; ?>, 12, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d12[0]; ?><input type="hidden" value="<? echo $d12[0]; ?>" id="3val2017"></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2018, <? echo $per; ?>, 12, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d12[1]; ?><input type="hidden" value="<? echo $d12[1]; ?>" id="3val2018"></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2019, <? echo $per; ?>, 12, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d12[2]; ?><input type="hidden" value="<? echo $d12[2]; ?>" id="3val2019"></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2020, <? echo $per; ?>, 12, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d12[3]; ?><input type="hidden" value="<? echo $d12[3]; ?>" id="3val2020"></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2021, <? echo $per; ?>, 12, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d12[4]; ?><input type="hidden" value="<? echo $d12[4]; ?>" id="3val2021"></td>
							
							<td class="cPo" onclick="loaNucTrimes(0,0, <? echo $per; ?>, 12, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)">Capturar</td>

							<td class="cPo" onclick="loaNucTrimes(<? echo $mes1; ?>,<? echo $anio; ?>, <? echo $per; ?>, 12, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d121[0][0]; ?></td>
							<td class="cPo" onclick="loaNucTrimes(<? echo $mes2; ?>,<? echo $anio; ?>, <? echo $per; ?>, 12, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d122[0][0]; ?></td>
							<td class="cPo" onclick="loaNucTrimes(<? echo $mes3; ?>,<? echo $anio; ?>, <? echo $per; ?>, 12, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d123[0][0]; ?></td>
							<td class="blockInp"><input type="number" value="<? echo $totd12; ?>" id="p12tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">5.4</th>
							<input style="display: none !important;" type="number" value="0" id="p13m1">
							<input style="display: none !important;" type="number" value="0" id="p13m2">
							<input style="display: none !important;" type="number" value="0" id="p13m3">
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

										$totGene = $totd10+$totd11+$totd12+$totd13+$totd14;
							?>

							<td class="cPo" onclick="loaNucTrimeShow(0,2017, <? echo $per; ?>, 13, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d13[0]; ?><input type="hidden" value="<? echo $d13[0]; ?>" id="4val2017"></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2018, <? echo $per; ?>, 13, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d13[1];; ?><input type="hidden" value="<? echo $d13[1]; ?>" id="4val2018"></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2019, <? echo $per; ?>, 13, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d13[2]; ?><input type="hidden" value="<? echo $d13[2]; ?>" id="4val2019"></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2020, <? echo $per; ?>, 13, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d13[3]; ?><input type="hidden" value="<? echo $d13[3]; ?>" id="4val2020"></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2021, <? echo $per; ?>, 13, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d13[4]; ?><input type="hidden" value="<? echo $d13[4]; ?>" id="4val2021"></td>

							<td class="cPo" onclick="loaNucTrimes(0,0, <? echo $per; ?>, 13, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)">Capturar</td>

							<td class="cPo" onclick="loaNucTrimes(<? echo $mes1; ?>,<? echo $anio; ?>, <? echo $per; ?>, 13, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d131[0][0]; ?></td>
							<td class="cPo" onclick="loaNucTrimes(<? echo $mes2; ?>,<? echo $anio; ?>, <? echo $per; ?>, 13, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d132[0][0]; ?></td>
							<td class="cPo" onclick="loaNucTrimes(<? echo $mes3; ?>,<? echo $anio; ?>, <? echo $per; ?>, 13, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d133[0][0]; ?></td>
							<td class="blockInp"><input type="number" value="<? echo $totd13; ?>" id="p13tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">5.5</th>
							<input style="display: none !important;" type="number" value="0" id="p14m1">
							<input style="display: none !important;" type="number" value="0" id="p14m2">
							<input style="display: none !important;" type="number" value="0" id="p14m3">
							<td style="text-align: left;">Número de órdenes de detención por caso urgente cumplimentadas por la Policía por imputado</td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2017, <? echo $per; ?>, 14, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d14[0]; ?><input type="hidden" value="<? echo $d14[0]; ?>" id="5val2017"></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2018, <? echo $per; ?>, 14, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d14[1]; ?><input type="hidden" value="<? echo $d14[1]; ?>" id="5val2018"></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2019, <? echo $per; ?>, 14, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d14[2]; ?><input type="hidden" value="<? echo $d14[2]; ?>" id="5val2019"></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2020, <? echo $per; ?>, 14, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d14[3]; ?><input type="hidden" value="<? echo $d14[3]; ?>" id="5val2020"></td>
							<td class="cPo" onclick="loaNucTrimeShow(0,2021, <? echo $per; ?>, 14, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d14[4]; ?><input type="hidden" value="<? echo $d14[4]; ?>" id="5val2021"></td>

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
							<td class="blockInp"><strong><?php echo $totGene; ?></strong></td>
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
		