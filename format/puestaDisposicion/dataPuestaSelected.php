	<?php
				session_start();
				include("../../funciones.php");	
				include ("../../Conexiones/Conexion.php");
				include("../../funcionesPueDispo.php");	
				$idUsuario = $_SESSION['useridIE'];
				if (isset($_POST["messelected"])){ $messelected = $_POST["messelected"]; }	
				if (isset($_POST["anio"])){ $anio = $_POST["anio"]; }
				if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }
				if (isset($_POST["diaselected"])){ $diaselected = $_POST["diaselected"]; }
							if (isset($_POST["camMes"])){ $camMes = $_POST["camMes"]; }

							if ($camMes == 1 ) { $dianum = date("w",strtotime("01-".$messelected."-".$anio));	 $diaselected = 1;}				
							if ($camMes == 0 ) { $dianum = date("w",strtotime($diaselected."-".$messelected."-".$anio));	}
							if ($dianum == 0 ) { $dianum = 7;} else{ $dianum = $dianum; }
				



					$tipoArchov = get_type_archive($conn, $idEnlace);
					$tiparchiv = $tipoArchov[0][0];

						$diames= date("d");
						$tyArc = get_type_archive($conn, $idEnlace);
						$arch = $tyArc[0][0];

						if($arch == 9){ if($diames != $diaselected){ $a = 0; }elseif ($diames == $diaselected) { $a = 1;	}
						}else{ 	if($arch == 10 ){ $a = 1; } }
						
							$enlace = getInfoEnlaceUsuario($conn, $idUsuario);
	      $idfisca = $enlace[0][1];	

	      $validateMonthCap = validateMonthCapture($messelected, $anio);

			?>

				
															<? 
																				$dataPuestasDia = get_data_puesta_dia($conn, $dianum, $diaselected, $anio, $idfisca, $idEnlace, $messelected);
																							for ($h=0; $h < sizeof($dataPuestasDia) ; $h++) { 
																									?>
																										<tr><td style="font-weight: bolder;"> <? echo $dataPuestasDia[$h][0]; ?> </td>
																										<td> <? echo $dataPuestasDia[$h][1]; ?> </td>
																										<?if($arch == 12 && ($idEnlace != 266 && $idEnlace != 233 && $idEnlace != 225) ){ ?> <td> <? echo $dataPuestasDia[$h][11]; ?> </td> <? } ?>	
																										<td> <? echo $dataPuestasDia[$h][2]; ?> </td>
																									<td> 	<center><? echo $dataPuestasDia[$h][3]->format('Y-m-d H:i'); ?></center> </td>
																										<td> <center><? echo $dataPuestasDia[$h][4]->format('Y-m-d H:i'); ?></center></td>
																										<td> <center><? echo $dataPuestasDia[$h][5]; ?></center> </td>
																										<td> <center><? echo $dataPuestasDia[$h][6]; ?></center> </td>
																										<td> <? echo $validateMonthCap; ?> </td>
																										<td> <? echo $dataPuestasDia[$h][8]; ?> </td>
																										<td> <center><? echo $dataPuestasDia[$h][9]; ?></center> </td>
																										<td> <center><? echo $dataPuestasDia[$h][10]; ?></center> </td>
																										<?if($tiparchiv == 12){ ?>
																											<td><center><label class="glyphicon glyphicon-search" data-toggle="modal" href="#puestdispos" onclick="showmodalPueDispo(1, <? echo $idEnlace; ?>, <? echo $dataPuestasDia[$h][0]; ?>, <? echo 	$tiparchiv; ?>, 1)" style="width: 95%; cursor: pointer; font-weight: bold; color: green;"> Ver <? /*if($a == 1){echo "Revisar";}else{ echo "Editar"; }*/ ?></label></center></td>
																										<? }else{ if($validateMonthCap == "SI"){ ?>
																										<td><center><label class="glyphicon glyphicon-edit" data-toggle="modal" href="#puestdispos" onclick="showmodalPueDispo(1, <? echo $idEnlace; ?>, <? echo $dataPuestasDia[$h][0]; ?>, <? echo 	$tiparchiv; ?>, 1)" style="width: 95%; cursor: pointer; font-weight: bold; color: green;">Editar<? /*if($a == 1){echo "Revisar";}else{ echo "Editar"; }*/ ?></label></center></td><? }elseif($validateMonthCap == "NO"){ ?>
																											<td><center><label class="glyphicon glyphicon-edit" data-toggle="modal" href="#puestdispos" onclick="showmodalPueDispo(1, <? echo $idEnlace; ?>, <? echo $dataPuestasDia[$h][0]; ?>, <? echo 	$tiparchiv; ?>, 0)" style="width: 95%; cursor: pointer; font-weight: bold; color: green;">Ver<? /*if($a == 1){echo "Revisar";}else{ echo "Editar"; }*/ ?></label></center></td>
																									<? } 
																								  }?>
																									</tr>
																									<?		/// METHOD SHOWMODALPUEDISPO TYPECHECK IS 1 BEACAUSE ALWAYS CAN BE CAPTURED EVERYDAY AND $a = 0 here and it´s changed to 1 Editar
																							}															

															 ?>
								


								