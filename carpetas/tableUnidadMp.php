
	<?php
	session_start();
	include ("../Conexiones/Conexion.php");
	include("../funciones.php");	
	include ("../Conexiones/conexionSicap.php");
	include("../funcioneSicap.php");

	 $idUsuario = $_SESSION['useridIE'];
	if (isset($_POST["idUnidad"])){ $idUnidad = $_POST["idUnidad"]; }
	if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }
	$enlace = getInfoEnlaceUsuario($conn, $idUsuario);
									$idEnlace = $enlace[0][0];
									$idfisca = $enlace[0][1];

	if($idUnidad == 0){

		/*if($idfisca == 4){ $mpsList = getMpsEnlace($conn, $idEnlace); }else{ $mpsList = getMpsEnlaceUnidadFormato($conn, $idEnlace, 1); }*/

			$mpsList = getMpsEnlaceUnidadFormato($conn, $idEnlace, 1);

		$idUnidad = 0;
		$nomUnidad = "TODAS";

	}else{

	/*	if($idfisca == 4){ $mpsList = getEnlMpUnidad($conn, $idUnidad, $idEnlace);; }else{ $mpsList = getEnlMpUnidad2($conn, $idUnidad, $idEnlace); }*/

							$mpsList = getMpsEnlaceUnidadFormato($conn, $idEnlace, 1);
		
		$unInfo = getInfoUnidad($conn, $idUnidad);
		$nomUnidad = $unInfo[0][1]; 
	}	

	

	$mescap = getMesCapEnlaceArchivo($conn, $idEnlace, 1);	
	$mescapen = $mescap[0][0];

	$mesCapturar = $mescapen;
	$anioCaptura = 2020;	
 

 
 $mesNom = Mes_Nombre($mesCapturar);


 $enviado = getEnviadoEnlace($conn, $idEnlace);
								$env = $enviado[0][0];
								$envArch = $enviado[0][1];

	?>

					<div id="">

						<div class="row pad20">	<br>						
					
								<table class="table table-striped tblTransparente">
									<thead>
										<tr class="cabezeraTabla">
											<th class="col-xs-12 col-sm-12 col-md-1 textCent">Capturado? </th>
													<th class="col-xs-12 col-sm-12 col-md-1 textCent">No</th>													
													<th class="col-xs-12 col-sm-12 col-md-3 ">Nombre Ministerio Público</th>
													<th class="col-xs-12 col-sm-12 col-md-4 textCent">Unidad</th>
													<th class="col-xs-12 col-sm-12 col-md-1 textCent">Mes</th>													
													<th class="col-xs-12 col-sm-12 col-md-1 textCent">Anio</th>

												

													<? if($env == 1){}else{ ?>
													<th class="textCent">Accion </th>
													<th class="textCent">Accion </th>
													<? } ?>

													<th class="textCent">Accion </th>

										</tr>
									</thead>
									<tbody>
								<? 							

								$arrayEstatus = array(22,22,2,5,20,21,3,23,24,25,15); 
						        $arrayTipoEsts = array('judCd', 'judSd', 'abst', 'arch', 'neap', 'incom', 'acum', 'medi', 'conci', 'crite', 'sucond');  
						        $bandCHeckEnv = 0;		


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


											/////////////////// CODIGO PARA SABER SI COINCIDE O NO INICIA AQUI ///////////////

											 $datosCarpeta = getDatosCarpetaMP($conn, $idMp, $mesCapturar, $anioCaptura, $idUnidad);

             if($datosCarpeta){$capturado = 1;}else{ $capturado = 0;}/// si la bandera esta en 1 quiere decir que existe la carpeta registrada en mes y año mp en la tabla Carpetas
             $totJudCdeten = 0; $totJudSdeten = 0; $abste = 0; $arciv = 0; $neap = 0; $incompe = 0; $acumlu = 0; $media = 0; $conc = 0; 
               $criter = 0; $supecon = 0;  
             
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

             }
     
           
        

											?>
											<tr>
												<td class="tdRowMain"><? if ($capturado == 1) { ?><span class="glyphicon glyphicon-ok spanOK"></span><?	}else{ ?><span class="glyphicon glyphicon-remove spanRemove"></span><? } ?></td>


												<td class="tdRowMain negr"><? echo ($i+1); ?></td>
												<td class="tdRowMain2"><? echo $nomCompleto; ?></td>
												<td class="tdRowMain"><? echo $nomUnidad; ?></td>
												<td class="tdRowMain"><? echo $mesNom; ?></td>
												<td class="tdRowMain"><? echo $anioCaptura; ?></td>											


														<? if($env == 1){} else { ?>
														<td class="tdRowMain"><center> <button type="button" data-toggle="modal" href="#myModaFormato"  onclick="cargarMOdalFormato('<? echo $nomCompleto; ?>',<? echo $idMp; ?>, <? echo $idUnidad; ?>, <? echo $mesCapturar; ?>, <? echo $anioCaptura; ?>);" class="btn btn-primary btn-sm redondear btnCapturarTbl" <? if ($capturado == 1) { echo "disabled";	} ?> ><span class="glyphicon glyphicon-pencil"></span> Capturar </button></center></td>

														<td class="tdRowMain"><center> <button type="button" data-toggle="modal" href="#myModaFormatoEditar"  onclick="cargarMOdalFormatoEditar('<? echo $nomCompleto; ?>',<? echo $idMp; ?>, <? echo $idUnidad; ?>, <? echo $mesCapturar; ?>, <? echo $anioCaptura; ?>);" class="btn btn-warning btn-sm redondear btnCapturarTbl" <? if ($capturado == 1) {}else{ echo "disabled"; } ?>><span class="glyphicon glyphicon-edit"></span> Editar </button></center></td>
														<? } ?>

														<td class="tdRowMain"><center><button type="button" data-toggle="modal" href="#myModaFormatoVer"  onclick="cargarMOdalFormatoVer('<? echo $nomCompleto; ?>',<? echo $idMp; ?>, <? echo $idUnidad; ?>, <? echo $mesCapturar; ?>, <? echo $anioCaptura; ?>);" class="btn btn-info btn-sm redondear btnCapturarTbl" <? if ($capturado == 1) {}else{ echo "disabled"; } ?>><span class="glyphicon glyphicon-search"></span> Ver Formato </button></center></td>

													
												</tr>			
											<?

									# code...
								}

								?>
									 </tbody>
									</table>
							
							</div>

						</div><br>