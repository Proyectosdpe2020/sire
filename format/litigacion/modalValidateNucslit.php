
	<?php
	session_start();
	include ("../../Conexiones/Conexion.php");
	include("../../funciones.php");	
	include ("../../Conexiones/conexionSicap.php");
	include("../../funcioneSicap.php");
	include("../../funcioneLit.php");

	 $idUsuario = $_SESSION['useridIE'];
	if (isset($_POST["validado"])){ $validado = $_POST["validado"]; }
	if (isset($_POST["idlit"])){ $idlit = $_POST["idlit"]; }


	

	if (isset($_POST["mesCapturar"])){ $mesCapturar = $_POST["mesCapturar"]; }
	if (isset($_POST["anioCaptura"])){ $anioCaptura = $_POST["anioCaptura"]; }

	$enlace = getInfoEnlaceUsuario($conn, $idUsuario);
									$idEnlace = $enlace[0][0];
									$idfisca = $enlace[0][1];



		$numOFforms = getFormsAccesosEnlace($conn, $idEnlace); 

								if($numOFforms == 1 ){

										$mpsList = getMpsEnlaceUnidadFormato($conn, $idEnlace, 4);


									$enliti = getEnlaceIDlitigacion($conn, $idEnlace, 4);
									$idliti = $enliti[0][0];




									$enviado = getEnviadoEnlaceFormato($conn, $idliti, 4);
									$env = $enviado[0][0];
									$envArch = $enviado[0][1];




								}else{

									if($idfisca == 4){ $mpsList = getMpsEnlaceUnidad($conn, $idEnlace,4); }else{ $mpsList = getMpsEnlaceUnidad($conn, $idEnlace,4); }

									$enviado = getEnviadoEnlace($conn, $idEnlace);
								
									$env = $enviado[0][0];
									$envArch = $enviado[0][1];
									$idliti = $idEnlace;

								}	


		$idUnidad = 0;
		$nomUnidad = "TODAS";


 $mesNom = Mes_Nombre($mesCapturar);


/* $enviado = getEnviadoEnlace($conn, $idliti);
								$env = $enviado[0][0];
								$envArch = $enviado[0][1];
*/
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

								$arrayEstatus = array(1,2,3,4,5,6,7,10,12,98,97,96,17,18,95,20,21,22,23,24,25,26,27,28,29,30,31,89,90,91,93,32,33,34,35,36,38,40,41,43,44,45,46,48,49,50,53,57,58,60,61,63,64,65,66,67,68,69,70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88); 			     

						  $mpsIncorrectos = 0;      	

								for ($i=0; $i < sizeof($mpsList); $i++) { 

											$nombre = $mpsList[$i][0];
											$apPatern = $mpsList[$i][1];
											$apMetern = $mpsList[$i][2];
											$idUnidad = $mpsList[$i][3];

											$idMp = $mpsList[$i][4];

											//echo $idUnidad;

											$cambios = getCambioLitiMpMesAnio($conn, $mesCapturar, $anioCaptura, $idMp);
 											$cambio = $cambios[0][0];
 										
 											$capturado = 0;

 											///// ANTES CUANDO HABIA UN CAMBIO DE MP LITI SE TENIA QUE PONER UNA BANDERA PARA SABER QUE CAMBIO POR QUE NO SE SABIA DE QUE UNIDAD ERA PERO AHORA YA SABEMOS A QUE UNIDAD PERTENECE EL MP
 										/*	if($cambio == 1){ 
 												$capturado = validarCarpetaCapturadaLitiUnidad($conn, $anioCaptura, $mesCapturar, $idMp, $idUnidad); 	 												
 											}else{
 												$capturado = validarCarpetaCapturadaLiti($conn, $anioCaptura, $mesCapturar, $idMp); 												
 											}*/

 											$capturado = validarCarpetaCapturadaLitiUnidad($conn, $anioCaptura, $mesCapturar, $idMp, $idUnidad); 	
											

											$nomCompleto = $nombre." ".$apPatern." ".$apMetern;
											$unInfo = getInfoUnidad($conn, $idUnidad);
											$nomUnidad = $unInfo[0][1]; 

											/////////////////// CODIGO PARA SABER SI COINCIDE O NO INICIA AQUI ///////////////
											///// ANTES CUANDO HABIA UN CAMBIO DE MP LITI SE TENIA QUE PONER UNA BANDERA PARA SABER QUE CAMBIO POR QUE NO SE SABIA DE QUE UNIDAD ERA PERO AHORA YA SABEMOS A QUE UNIDAD PERTENECE EL MP
											 /*
												if($cambio  == 1){ 
														 $datosCarpeta = getDatosLitigacionMpUnidad($conn, $idMp, $mesCapturar, $anioCaptura, $idfisca, $idUnidad);  

												}else{ 
														 $datosCarpeta = getDatosLitigacionMp($conn, $idMp, $mesCapturar, $anioCaptura, $idfisca);  
												}*/

												 $datosCarpeta = getDatosLitigacionMpUnidad($conn, $idMp, $mesCapturar, $anioCaptura, $idfisca, $idUnidad); 
										          
     
             ////// Obtener un conteo de carpetass (NUCS) que tengan algun estaus 
             /////////podriamos guardar un arreglo para guardar la cantidad de nucs por cada estatus
             $arrayNucsCapturados = array();            	
             //// Ir obteniendo valores por tipo de estatus al momento que se iran comparando tambien              
             for ($q=0; $q <sizeof($arrayEstatus) ; $q++) { 
                   			
                   			$valorsumnucs = 0;                
                  			$carpeAgente = getDistincCarpetasAgenteLitigacion($conn, $idMp, $arrayEstatus[$q], $mesCapturar, $anioCaptura, $idUnidad);

                                  for ($n=0; $n < sizeof($carpeAgente) ; $n++) {                                       
                                       $nuc = $carpeAgente[$n][0];
                                       $lastDetermin = getLastDeterminacionCarpetaLitig($conn, $nuc);                                  
                                

                                           $valorsumnucs++;            	                                                            
                                       
                               }    
                               //////ir ingresando nucs por cada estatus
                               $arrayNucsCapturados[$q] = $valorsumnucs;	
                  }

                   $arrayDatosMpCapturados = array( $datosCarpeta[0][2], $datosCarpeta[0][3], $datosCarpeta[0][91], $datosCarpeta[0][92], $datosCarpeta[0][93], $datosCarpeta[0][94], $datosCarpeta[0][95], $datosCarpeta[0][5], $datosCarpeta[0][6], $datosCarpeta[0][96], $datosCarpeta[0][98], $datosCarpeta[0][97], $datosCarpeta[0][8], $datosCarpeta[0][9], $datosCarpeta[0][10], $datosCarpeta[0][11], $datosCarpeta[0][12], $datosCarpeta[0][13], $datosCarpeta[0][14], $datosCarpeta[0][15], $datosCarpeta[0][16], $datosCarpeta[0][17], $datosCarpeta[0][18], $datosCarpeta[0][19], $datosCarpeta[0][20], $datosCarpeta[0][21], $datosCarpeta[0][22], $datosCarpeta[0][24], $datosCarpeta[0][26], $datosCarpeta[0][28], $datosCarpeta[0][29], $datosCarpeta[0][31], $datosCarpeta[0][32], $datosCarpeta[0][34], $datosCarpeta[0][35], $datosCarpeta[0][37], $datosCarpeta[0][38], $datosCarpeta[0][40], $datosCarpeta[0][41], $datosCarpeta[0][42], $datosCarpeta[0][43], $datosCarpeta[0][45], $datosCarpeta[0][46], $datosCarpeta[0][47], $datosCarpeta[0][48], $datosCarpeta[0][51], $datosCarpeta[0][52], $datosCarpeta[0][54], $datosCarpeta[0][55], $datosCarpeta[0][56], $datosCarpeta[0][57], $datosCarpeta[0][58], $datosCarpeta[0][60], $datosCarpeta[0][61], $datosCarpeta[0][64], $datosCarpeta[0][65], $datosCarpeta[0][66], $datosCarpeta[0][67], $datosCarpeta[0][69], $datosCarpeta[0][70], $datosCarpeta[0][72], $datosCarpeta[0][73], $datosCarpeta[0][74], $datosCarpeta[0][75], $datosCarpeta[0][76], $datosCarpeta[0][77], $datosCarpeta[0][	78], $datosCarpeta[0][79], $datosCarpeta[0][80], $datosCarpeta[0][81], $datosCarpeta[0][82], $datosCarpeta[0][84], $datosCarpeta[0][85], $datosCarpeta[0][87], $datosCarpeta[0][88], $datosCarpeta[0][89], $datosCarpeta[0][90] ); 




             	////// METER UN ARREGLO QUE ALMACENA DATOS 0 o 1 DE SI COINCIDE O NO Y DESPUES RECORRER EL ARREGLO PARA SABER SI HAY ALGUNO QUE NO COINCIDA 
         				for ($m=0; $m < sizeof($arrayEstatus); $m++) {   



         						if($arrayNucsCapturados[$m] != $arrayDatosMpCapturados[$m]){
         									$mpsIncorrectos++;
         									$coincide = 0;
         										if($idMp == 123){

         								echo $arrayNucsCapturados[$m]." == ".$arrayDatosMpCapturados[$m]."-".$arrayEstatus[$m]."-".$m."<br>";

         						}
         								break;
         						}else{  $coincide = 1; 	}	 	
         				}
											?>
											<tr>
												<td class="tdRowMain negr"><? echo ($i+1); ?></td>
												<td class="tdRowMain2"><? echo $nomCompleto; ?></td>
												<td class="tdRowMain"><? echo $nomUnidad; ?></td>
													<td class="tdRowMain"><? if ($capturado == 2) { ?><div class="verdCol" id="circulo"></div><?	}else{ ?><div class="yelloCol" id="circulo"></div><? } ?></td>
													<td class="tdRowMain"><? if($capturado == 1){ ?><div class="yelloCol" id="circulo"></div><?  } else if ($coincide == 1) {  ?><div class="verdCol" id="circulo"></div><?	}else{  ?><div class="yelloCol" id="circulo"></div><? } ?></td>			
												</tr>			
											<?
								}


								?>
									 </tbody>
									</table>


					
							
							</div>
											
								<div class="row" style="background-color: white !important; border-radius: 0px 0px 10px 10px !important; box-shadow: 5px !important;">
						
																					  <div class="col-xs-6 col-sm-6 col-md-6"><center><button style="width: 95%;" type="button" class="btn btn-default redondear" onclick="cancelarBotonValidate()">Salir</button></center><br></div>

																							<div class="col-xs-6 col-sm-6 col-md-6"><center><button style="width: 95%;"  type="button" class="btn btn-info redondear"  onclick="enviarDPEvalidates(<? echo $idUnidad; ?>, <? echo $anioCaptura; ?>, <? echo $mesCapturar ?> ,  <? echo $mpsIncorrectos; ?>,'<? echo $validado; ?>', <? echo $idliti; ?>, 4);">Enviar Información</button></center></div>
																		</div> 

						</div>