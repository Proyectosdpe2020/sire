<? 
					include ("../../../Conexiones/Conexion.php");
					include ("../../../Conexiones/conexionSicap.php");
			  include("../../../funcioneTrimes.php");

					if (isset($_GET["per"])){ $per = $_GET["per"]; }
					if (isset($_GET["anio"])){ $anio = $_GET["anio"]; }
					if (isset($_GET["idUnidad"])){ $idUnidad = $_GET["idUnidad"]; }
					if (isset($_GET["idEnlace"])){ $idEnlace = $_GET["idEnlace"]; }
					if($per == 1){ $m1 = "Enero"; $m2 = "Febrero"; $m3 = "Marzo"; $nme = "Enero - Marzo"; $arr = array(1,2,3); $per1 = "IN(1,2,3)";  }
					if($per == 2){ $m1 = "Abril"; $m2 = "Mayo"; $m3 = "Junio"; $nme = "Abril - Junio"; $arr = array(4,5,6); $per1 = "IN(4,5,6)"; }
					if($per == 3){ $m1 = "Julio"; $m2 = "Agosto"; $m3 = "Septiembre"; $nme = "Julio - Septiembre"; $arr = array(7,8,9); $per1 = "IN(7,8,9)"; }
					if($per == 4){ $m1 = "Octubre"; $m2 = "Noviembre"; $m3 = "Diciembre"; $nme = "Octubre - Diciembre"; $arr = array(10,11,12); $per1 = "IN(10,11,12)"; }

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
				</div><br><hr><br>
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
								<?
									$tota = 0; $tota1 = 0;
									for ($o=0; $o < sizeof($arr) ; $o++) { 

												$data = getDAtaSIREQuestionEstatusLiti($conSic , $arr[$o] , $anio, $idUnidad, 17, $per1);
												$tota = $tota + $data[0][0];
												if(is_null($data[0][0])){ $data[0][0] = 0; }
												?>
													<td class="blockInp"><input type="number" value="<? echo $data[0][0]; ?>" id="p48m<? echo $o+1; ?>" readonly></td>
												<?										
									}
							?>	
							<td class="blockInp"><input type="number" value="<? echo $tota; ?>" id="p48tot" readonly></td>
						</tr>
						<tr>
							<th scope="row">9.2</th>
							<td style="text-align: left;">Número de imputados a los que se les impuso a prisión preventiva no oficiosa</td>
							<?
									$tota = 0; $tota1 = 0;
									for ($o=0; $o < sizeof($arr) ; $o++) { 

												$data = getDAtaSIREQuestionEstatusLiti($conSic , $arr[$o] , $anio, $idUnidad, 18, $per1);
												$tota = $tota + $data[0][0];
												if(is_null($data[0][0])){ $data[0][0] = 0; }
												?>
													<td class="blockInp"><input type="number" value="<? echo $data[0][0]; ?>" id="p49m<? echo $o+1; ?>" readonly></td>
												<?										
									}
							?>	
							<td class="blockInp"><input type="number" value="<? echo $tota; ?>" id="p49tot" readonly></td>
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
	