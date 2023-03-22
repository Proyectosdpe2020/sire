
	<?php
	session_start();
	include ("../../Conexiones/Conexion.php");
	include("../../funciones.php");	
	include ("../../Conexiones/conexionSicap.php");
	include("../../funcioneSicap.php");

	 $idUsuario = $_SESSION['useridIE'];

	if (isset($_POST["idUnidad"])){ $idUnidad = $_POST["idUnidad"]; }
	if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }

	$enlace = getInfoEnlaceUsuario($conn, $idUsuario);
									$idEnlace = $enlace[0][0];
									$idfisca = $enlace[0][1];

	if($idUnidad == 0){

		if($idfisca == 4){ $mpsList = getMpsEnlace($conn, $idEnlace); }else{ $mpsList = getMpsEnlaceUnidadFormato($conn, $idEnlace, 4); }
		$idUnidad = 0;
		$nomUnidad = "TODAS";

	}else{

		if($idfisca == 4){ $mpsList = getEnlMpUnidad($conn, $idUnidad, $idEnlace);; }else{ $mpsList = getEnlMpUnidad2($conn, $idUnidad, $idEnlace); }

		
		$unInfo = getInfoUnidad($conn, $idUnidad);
		$nomUnidad = $unInfo[0][1]; 
	}	

	$mesCapturar = 5;
	$anioCaptura = 2019;
	
 

 
 $mesNom = Mes_Nombre($mesCapturar);


	$numOFforms = getFormsAccesosEnlace($conn, $idEnlace); 

								if($numOFforms == 1 ){

									$enviado = getEnviadoEnlaceFormato($conn, $idEnlace, 4);
									$env = $enviado[0][0];
									$envArch = $enviado[0][1];

								}else{

								$enviado = getEnviadoEnlace($conn, $idEnlace);
								$env = $enviado[0][0];
								$envArch = $enviado[0][1];


								}


	?>


		<div id="tablempss" class="row pad20">							
					
								<table class="table table-striped tblTransparente">
									<thead>
										<tr class="cabezeraTabla">
											<th class="col-xs-1 col-sm-1 col-md-1 textCent">Capturado? </th>
													<th class="col-xs-1 col-sm-1 col-md-1 textCent">No</th>
													<th class="col-xs-4 col-sm-4 col-md-3 ">Nombre Ministerio Público</th>
													<th class="col-xs-4 col-sm-4 col-md-2 textCent">Unidad</th>
													<th class="col-xs-4 col-sm-4 col-md-2 textCent">Fiscalía</th>
													<th class="col-xs-1 col-sm-1 col-md-1 textCent">Mes</th>													
													<th class="col-xs-1 col-sm-1 col-md-1 textCent">Anio</th>

												

													<? if($env == 1){}else{ ?>
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

											$fisna = getFiscaNameXunidad($conn, $idUnidad);	
											$finame = $fisna[0][0];


											$capturado = getCapturadoMesAnioMPLitig($conn, $mesCapturar, $anioCaptura, $idMp, $idfisca);

											$nomCompleto = $nombre." ".$apPatern." ".$apMetern;
											

											
											if($numOFforms == 1 ){

													$unInfo = getMpunidadFormato($conn, $idEnlace, 4, $idMp);
													$nomUnidad = $unInfo[0][1]; 
											}else{

												$unfifo =  getNunidad($conn, $idUnidad);
												$nomUnidad = $unfifo[0][0];

											}
											




											?>
											<tr>
												<td class="tdRowMain"><? if ($capturado == 1) { ?><span class="glyphicon glyphicon-ok spanOK"></span><?	}else{ ?><span class="glyphicon glyphicon-remove spanRemove"></span><? } ?></td>

		

												<td class="tdRowMain negr"><? echo ($i+1); ?></td>
												<td class="tdRowMain2"><? echo $nomCompleto; ?></td>
												<td class="tdRowMain"><? echo $nomUnidad; ?></td>
												<td class="tdRowMain"><? echo $finame; ?></td>
												<td class="tdRowMain"><? echo $mesNom; ?></td>
												<td class="tdRowMain"><? echo $anioCaptura; ?></td>											


														<? if($env == 1){} else { ?>
														<td class="tdRowMain"><center> <button type="button" data-toggle="modal" href="#modalFormatoLitig"  onclick="cargarMOdalFormatoLit(<? echo $idEnlace; ?>,'<? echo $nomCompleto; ?>',<? echo $idMp; ?>, <? echo $idUnidad; ?>, <? echo $mesCapturar; ?>, <? echo $anioCaptura; ?>);" class="btn btn-primary btn-sm redondear btnCapturarTbl" ><span class="glyphicon glyphicon-pencil"></span> Capturar </button></center></td>
														
														<? } ?>

														<td class="tdRowMain"><center><button type="button" data-toggle="modal" href="#modalFormatoLitigVer"  onclick="cargarMOdalFormatoVerLit('<? echo $nomCompleto; ?>',<? echo $idMp; ?>, <? echo $idUnidad; ?>, <? echo $mesCapturar; ?>, <? echo $anioCaptura; ?>, <? echo $idEnlace; ?>);" class="btn btn-info btn-sm redondear btnCapturarTbl" <? if ($capturado == 1) {}else{ echo "disabled"; } ?>><span class="glyphicon glyphicon-search"></span> Ver Formato </button></center></td>													
												</tr>			
											<?

									# code...  
								}

								?>
									 </tbody>
									</table>
							
							</div>

					