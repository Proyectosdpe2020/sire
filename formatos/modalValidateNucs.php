
	<?php
	session_start();
	include ("../Conexiones/Conexion.php");
	include("../funciones.php");	
	include ("../Conexiones/conexionSicap.php");
	include("../funcioneSicap.php");

	 $idUsuario = $_SESSION['useridIE'];
	if (isset($_POST["validado"])){ $validado = $_POST["validado"]; }
	if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }
	if (isset($_POST["mesCapturar"])){ $mesCapturar = $_POST["mesCapturar"]; }
	if (isset($_POST["anioCaptura"])){ $anioCaptura = $_POST["anioCaptura"]; }



	$enlace = getInfoEnlaceUsuario($conn, $idUsuario);
									$idEnlace = $enlace[0][0];
									$idfisca = $enlace[0][1];


		//if($idfisca == 4){ $mpsList = getMpsEnlace($conn, $idEnlace); }else{ $mpsList = getMpsEnlaceUnidad($conn, $idEnlace, 1); }

									$mpsList = getMpsEnlaceUnidadFormato($conn, $idEnlace, 1);
		
		$idUnidad = 0;
		$nomUnidad = "TODAS";



	
 	$mescap = getMesCapEnlaceArchivo($conn, $idEnlace, 1);	
	$mescapen = $mescap[0][0];

	$mesCapturar = $mescapen;
	//$anioCaptura = 2020;	
 

 
 $mesNom = Mes_Nombre($mesCapturar);


 $enviado = getEnviadoEnlace($conn, $idEnlace);
								$env = $enviado[0][0];
								$envArch = $enviado[0][1];

	?>

					<div id="">

						<div class="row pad20" style="height: 80vh !important; margin-top: 1% !important;  overflow-y: scroll !important; background-color: white !important; border-radius: 10px 10px 0px 0px !important; box-shadow: 5px !important; ">	<br>						
					
								<table class="table table-striped tblTransparente">
									<thead>
										<tr class="cabezeraTabla">
										
													<th class="col-xs-1 col-sm-1 col-md-1 textCent">No</th>													
													<th class="col-xs-4 col-sm-4 col-md-4 ">Nombre Ministerio Público</th>
													<th class="col-xs-5 col-sm-5 col-md-5 textCent">Unidad</th>													

													<th class="col-xs-1 col-sm-1 col-md-1 textCent">Registro </th>
													<th class="col-xs-1 col-sm-1 col-md-1 textCent">NucsCap </th>												

										</tr>
									</thead>
									<tbody>
								<? 							

								$arrayEstatus = array(22,22,2,5,20,21,3,23,24,25,15,1); 
						        $arrayTipoEsts = array('judCd', 'judSd', 'abst', 'arch', 'neap', 'incom', 'acum', 'medi', 'conci', 'crite', 'sucond', 'reini');  
						        $bandCHeckEnv = 0;		

						  $mpsCorrectos = 0;
						  $mpsIncorrectos = 0;      


								for ($i=0; $i < sizeof($mpsList); $i++) { 

											$nombre = $mpsList[$i][0];
											$apPatern = $mpsList[$i][1];
											$apMetern = $mpsList[$i][2];
											$idUnidad = $mpsList[$i][3];
											$idMp = $mpsList[$i][4];

											$capturado = getCapturadoMesAnioMP($conn, $mesCapturar, $anioCaptura, $idMp, $idUnidad);
											$nomCompleto = $nombre." ".$apPatern." ".$apMetern;
											$unInfo = getInfoUnidad($conn, $idUnidad);
											$nomUnidad = $unInfo[0][1]; 

											///if($idMp == 1657){ echo $idUnidad."<br>";}


											/////////////////// CODIGO PARA SABER SI COINCIDE O NO INICIA AQUI ///////////////

											 $datosCarpeta = getDatosCarpetaMP($conn, $idMp, $mesCapturar, $anioCaptura, $idUnidad);

             if($datosCarpeta){$capturado = 1;}else{ $capturado = 0;}/// si la bandera esta en 1 quiere decir que existe la carpeta registrada en mes y año mp en la tabla Carpetas
             
             $totJudCdeten = 0; $totJudSdeten = 0; $abste = 0; $arciv = 0; $neap = 0; $incompe = 0; $acumlu = 0; $media = 0; $conc = 0; 
               $criter = 0; $supecon = 0; $reini = 0;  
             
             if($capturado == 0){ 

              $datosCarpeta[0][0] = 0; 
              $datosCarpeta[0][1] = 0;
              $datosCarpeta[0][2] = 0;
              $datosCarpeta[0][3] = 0;
              $datosCarpeta[0][4] = 0;
              $datosCarpeta[0][5] = 0;
              $datosCarpeta[0][6] = 0;
              $datosCarpeta[0][7] = 0;
              $datosCarpeta[0][8] = 0;
              $datosCarpeta[0][9] = 0;
              $datosCarpeta[0][10] = 0;
              $datosCarpeta[0][11] = 0;

             }
     
             ////// Obtener un conteo de carpetass (NUCS) que tengan algun estaus              
             //// Ir obteniendo valores por tipo de estatus al momento que se iran comparando tambien              
             for ($q=0; $q <sizeof($arrayTipoEsts) ; $q++) { 
                   
                   if($arrayTipoEsts[$q] == 'judCd'){ $deten = 2;}else{
                   if($arrayTipoEsts[$q] == 'judSd'){ $deten = 1;}else{
                    $deten = 0;
                   }
                  }

																		///// SE MODIFICO PAA QUE AGARRE LA UNIDAD A LA QUE PERTENECE
																		$carpeAgente3 = getDistincCarpetasAgente3($conSic, $idMp, $arrayEstatus[$q], $mesCapturar, $anioCaptura, $deten, $idUnidad); //// SE AGREGA EL ID DE UNIDAD PARA QUE SOLO SE BUSQUEN NUCS DE LA UNIDAD EN LA QUE SE ENCUENTRA ACTUALMENTE

                  			$carpeAgente = getDistincCarpetasAgente($conSic, $idMp, $arrayEstatus[$q], $mesCapturar, $anioCaptura, $deten);
                  			$carpeAgente2 = getDistincCarpetasDataUNidReso($conSic, $idMp, $arrayEstatus[$q], $mesCapturar, $anioCaptura, $deten);

         



         for ($n=0; $n < sizeof($carpeAgente3) ; $n++) { 
                                      
                                       $CaepetaId = $carpeAgente3[$n][0];
                                       
                                       $unds = $carpeAgente3[$n][1];

                                       ////////////// revisar si existe como reiniciada con el estatus de abierto 
									   $reinicidassi = knowisReinicida($conSic, $anioCaptura, $mesCapturar, $idUnidad, $CaepetaId);		

									   if( $reinicidassi ){ 


									   									   		$idCarpeta = getIDresolopen($conSic, $anioCaptura, $mesCapturar, $idUnidad, $CaepetaId);																                  							

																											$idcar = $idCarpeta[0][0];
																											$estaResol = $idCarpeta[0][1];
																											$unids = $idCarpeta[0][2];

																											//if($idMp == 1657){ echo "<br><br> unidad de carpeta aqui es: ".$unids."y la que esta revisandose es: ".$unds."<br>";}

																											/////////////////////// SI LA UNIDAD QUE SE ESTA REVISANDO ES IGUAL A LA UNIDAD DE LA CARPETA ENTONCES HACEMOS COMPARACIONES

																												if($unids == $unds){


																																if($arrayTipoEsts[$q] == 'judCd'){ $totJudCdeten++; }
																				               if($arrayTipoEsts[$q] == 'judSd'){ $totJudSdeten++; }
																				               if($arrayTipoEsts[$q] == 'abst'){ $abste++; }
																				               if($arrayTipoEsts[$q] == 'arch'){ $arciv++; }
																				               
																				               if($arrayTipoEsts[$q] == 'neap'){ $neap++; }
																				               
																				               if($arrayTipoEsts[$q] == 'incom'){ $incompe++; }
																				               if($arrayTipoEsts[$q] == 'acum'){ $acumlu++; }
																				               

																				               if($arrayTipoEsts[$q] == 'medi'){ $media++; }


																				               if($arrayTipoEsts[$q] == 'conci'){ $conc++; }
																				               if($arrayTipoEsts[$q] == 'crite'){ $criter++; }
																				               if($arrayTipoEsts[$q] == 'sucond'){ $supecon++; }
																																   if($arrayTipoEsts[$q] == 'reini'){ $reini++; }


																												}


									   }else{


                                       $lastDetermin = getLastDeterminacionCarpeta($conSic, $CaepetaId);
			                                       for ($k=0; $k < sizeof($lastDetermin); $k++) { 

			                                          $idUnidade = $lastDetermin[$k][2];
			                                          $EstatusID = $lastDetermin[$k][3];
			                                          	$agenteid = $lastDetermin[$k][4];

			                                          if ( $idUnidad == $idUnidade && $arrayEstatus[$q] == $EstatusID AND $idMp == $agenteid) {
			                                                  
			                                                   if($arrayTipoEsts[$q] == 'judCd'){ $totJudCdeten++; }
			                                                   if($arrayTipoEsts[$q] == 'judSd'){ $totJudSdeten++; }
			                                                   if($arrayTipoEsts[$q] == 'abst'){ $abste++; }
			                                                   if($arrayTipoEsts[$q] == 'arch'){ $arciv++; }
			                                                   if($arrayTipoEsts[$q] == 'neap'){ $neap++; }
			                                                   if($arrayTipoEsts[$q] == 'incom'){ $incompe++; }
			                                                   if($arrayTipoEsts[$q] == 'acum'){ $acumlu++; }
			                                                   if($arrayTipoEsts[$q] == 'medi'){ $media++; }
			                                                   if($arrayTipoEsts[$q] == 'conci'){ $conc++; }
			                                                   if($arrayTipoEsts[$q] == 'crite'){ $criter++; }
			                                                   if($arrayTipoEsts[$q] == 'sucond'){ $supecon++; }                                           
			                                          }                                                                       
			                                       }


									   }

                                      }     


                  }

             $arrayCapturados = array();   


             if($datosCarpeta[0][0] != $totJudCdeten){  $bandCHeckEnv1 = 0; $mpsIncorrectos++; }else{ $bandCHeckEnv1 = 1; $mpsCorrectos++; } $arrayCapturados[0] = $bandCHeckEnv1;
           
             if($datosCarpeta[0][1] != $totJudSdeten){  $bandCHeckEnv2 = 0; $mpsIncorrectos++;  }else{ $bandCHeckEnv2 = 1; $mpsCorrectos++;} $arrayCapturados[1] = $bandCHeckEnv2;
            
             if($datosCarpeta[0][2] != $abste){ $bandCHeckEnv3 = 0; $mpsIncorrectos++; }else{ $bandCHeckEnv3 = 1; $mpsCorrectos++;} $arrayCapturados[2] = $bandCHeckEnv3;
             
             if($datosCarpeta[0][3] != $arciv){        $bandCHeckEnv4 = 0; $mpsIncorrectos++; }else{ $bandCHeckEnv4 = 1; $mpsCorrectos++;} $arrayCapturados[3] = $bandCHeckEnv4;
      
             if($datosCarpeta[0][4] != $neap){   $bandCHeckEnv5 = 0; $mpsIncorrectos++;  }else{ $bandCHeckEnv5 = 1; $mpsCorrectos++;} $arrayCapturados[4] = $bandCHeckEnv5;
            
             if($datosCarpeta[0][5] != $incompe){ $bandCHeckEnv6 = 0; $mpsIncorrectos++;  }else{ $bandCHeckEnv6 = 1; $mpsCorrectos++;} $arrayCapturados[5] = $bandCHeckEnv6;
             
             if($datosCarpeta[0][6] != $acumlu){  $bandCHeckEnv7 = 0; $mpsIncorrectos++;  }else{ $bandCHeckEnv7 = 1; $mpsCorrectos++;} $arrayCapturados[6] = $bandCHeckEnv7;
            
             if($datosCarpeta[0][7] != $media){  $bandCHeckEnv8 = 0; $mpsIncorrectos++; }else{ $bandCHeckEnv8 = 1; $mpsCorrectos++;} $arrayCapturados[7] = $bandCHeckEnv8;
             
             if($datosCarpeta[0][8] != $conc){ $bandCHeckEnv9 = 0; $mpsIncorrectos++; }else{ $bandCHeckEnv9 = 1; $mpsCorrectos++;} $arrayCapturados[8] = $bandCHeckEnv9;
             
             if($datosCarpeta[0][9] != $criter){ $bandCHeckEnv10 = 0; $mpsIncorrectos++; }else{ $bandCHeckEnv10 = 1; $mpsCorrectos++;} $arrayCapturados[9] = $bandCHeckEnv10;
             
             if($datosCarpeta[0][10] != $supecon){   $bandCHeckEnv11 = 0; $mpsIncorrectos++; }else{ $bandCHeckEnv11 = 1; $mpsCorrectos++;} $arrayCapturados[10] = $bandCHeckEnv11;
           
             if($datosCarpeta[0][11] != $reini){ $bandCHeckEnv12 = 0; $mpsIncorrectos++; }else{ $bandCHeckEnv12 = 1; $mpsCorrectos++;} $arrayCapturados[11] = $bandCHeckEnv12;
             
            
       
											////////////////////  CODIGO PARA SABER SI COINDDEN LOS DATOS O NO TEMINA AQUI ////////////////////
             if($bandCHeckEnv1 == 0 || $bandCHeckEnv2 == 0 || $bandCHeckEnv3 == 0 || $bandCHeckEnv4 == 0 || $bandCHeckEnv5 == 0 || $bandCHeckEnv6 == 0 || $bandCHeckEnv7 == 0 || $bandCHeckEnv8 == 0 || $bandCHeckEnv9 == 0 || $bandCHeckEnv10 == 0 || $bandCHeckEnv11 == 0 || $bandCHeckEnv12 == 0 ){ $coincid = 0;  }else { $coincid = 1; }



             	////// METER UN ARREGLO QUE ALMACENA DATOS 0 o 1 DE SI COINCIDE O NO Y DESPUES RECORRER EL ARREGLO PARA SABER SI HAY ALGUNO QUE NO COINCIDA 
         				for ($m=0; $m < sizeof($arrayCapturados); $m++) {    	
         										if($arrayCapturados[$m] == 0){
         															$coincide = 0;
         															break;
         										}else{ $coincide = 1;	}
         				}
         			


											?>
											<tr>
											

												<td class="tdRowMain negr"><? echo ($i+1); ?></td>
												<td class="tdRowMain2"><? echo $nomCompleto; ?></td>
												<td class="tdRowMain"><? echo $nomUnidad; ?></td>



													<td class="tdRowMain"><? if ($capturado == 1) { ?><div class="verdCol" id="circulo"></div><?	}else{ ?><div class="yelloCol" id="circulo"></div><? } ?></td>

														<td class="tdRowMain"><? if ($coincide == 1) { ?><div class="verdCol" id="circulo"></div><?	}else{ ?><div class="yelloCol" id="circulo"></div><? } ?></td>
																					


														

													
												</tr>			
											<?

									# code...
								}


								?>
									 </tbody>
									</table>


				
							
							</div>
											
								<div class="row" style="background-color: white !important; border-radius: 0px 0px 10px 10px !important; box-shadow: 5px !important;">
						
																					  <div class="col-xs-6 col-sm-6 col-md-6"><center><button style="width: 95%;" type="button" class="btn btn-default redondear" onclick="cancelarBotonValidate()">Salir</button></center><br></div>

																							<div class="col-xs-6 col-sm-6 col-md-6"><center><button style="width: 95%;"  type="button" class="btn btn-info redondear"  onclick="enviarDPEvalidates(<? echo $idUnidad; ?>, <? echo $anioCaptura; ?>, <? echo $mesCapturar ?> ,  <? echo $mpsIncorrectos; ?>,'<? echo $validado; ?>', <? echo $idEnlace; ?>, 1);">Enviar Información</button></center></div>
																		</div> 

						</div>