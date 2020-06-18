<? 
	
	session_start();
	include ("../Conexiones/Conexion.php");
	include("../funciones.php");	

	if (isset($_POST["nombreEnlace"])){ $nombreEnlace = $_POST["nombreEnlace"]; }
	if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }
	//if (isset($_POST["mes"])){ $mes = $_POST["mes"]; }
	if (isset($_POST["anio"])){ $anio = $_POST["anio"]; }
	if (isset($_POST["idfisca"])){ $idfisca = $_POST["idfisca"]; }
	if (isset($_POST["idArchivo"])){ $idArchivo = $_POST["idArchivo"]; }


$mesCapturar  = getMesCapEnlaceArchivo($conn, $idEnlace, $idArchivo);
$mes = $mesCapturar[0][0];

?>

  <div class="modal-header" style="background-color:#3f5265;">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												
												<center><h4 class="modal-title" style="color:white; font-weight: bold;"> Formatos capturados por Enlace </h4></center><br>
												<center><h5 class="modal-title" style="color:white; font-weight: ;"> ( Revisar ) <? echo $nombreEnlace; ?> </h5></center>
											  </div>


													<div class="col-md-12 col-sm-12 col-xs-12 form-group principalPanel">								      				
														 
															<br>
														   <table class="table table-striped tblTransparente">
															<thead>
																<tr class="cabezeraTabla">
																			<th class="col-xs-12 col-sm-12 col-md-1 textCent">No</th>
																			<th class="col-xs-12 col-sm-12 col-md-3 ">Nombre Enlace</th>
																			<th class="col-xs-12 col-sm-12 col-md-4 ">Nombre Unidad</th>
																			<th class="col-xs-12 col-sm-12 col-md-2 ">Fiscalia</th>
																			<th class="col-xs-12 col-sm-12 col-md-1 textCent">Estado</th>

																</tr>
															</thead>
															<tbody>		

															  <? 	

															  if($idArchivo == 1){ if($idfisca == 4){ $mpsList = getMpsEnlace($conn, $idEnlace); }else{ $mpsList = getMpsEnlaceUnidad($conn, $idEnlace,1); } } 
                 if($idArchivo == 4){ if($idfisca == 4){ $mpsList = getMpsEnlaceUnidad($conn, $idEnlace,4); }else{ $mpsList = getMpsEnlaceUnidad($conn, $idEnlace,4); } } 	


														   //if($idfisca == 4){ $mpsList = getMpsEnlace($conn, $idEnlace); }else{ $mpsList = getMpsEnlaceUnidad($conn, $idEnlace,$idArchivo); }

														   for ($i=0; $i < sizeof($mpsList); $i++) { 

														   		$nombre = $mpsList[$i][0];
																			$apPatern = $mpsList[$i][1];
																			$apMetern = $mpsList[$i][2];
																			$idUnidad = $mpsList[$i][3];
																			$idMp = $mpsList[$i][4];


																			$fisna = getFiscaNameXunidad($conn, $idUnidad);	
																			$finame = $fisna[0][0];

																$capturado = getCapturadoMesAnioMP($conn, $mes, $anio, $idMp, $idUnidad);

																 if($idArchivo == 1){ $capturado = getCapturadoMesAnioMP($conn, $mes, $anio, $idMp, $idUnidad); } 
                 if($idArchivo == 4){ $capturado = getCapturadoMesAnioMPLitig($conn, $mes, $anio, $idMp, $idfisca); } 	

																$unInfo = getInfoUnidad($conn, $idUnidad);
																$nomUnidad = $unInfo[0][1];
																$nomCompleto = $nombre." ".$apPatern." ".$apMetern;														   

														   ?>	
																		
																		<tr>

																			<td class="tdRowMain negr"><? echo ($i+1); ?></td>
																			<td class="tdRowMain2"><? echo $nomCompleto; ?></td>
																			<td class="tdRowMain2"><? echo $nomUnidad; ?></td>
																			<td class="tdRowMain2"><? echo $finame; ?></td>

																			<? if( $capturado == 1 ){ ?>

																			<td class="tdRowMain"><div class="verdCol" id="circulo"></div></td>
																			<? 
																				}else{
																			?>
																					<td class="tdRowMain"><div class="redCol" id="circulo"></div></td>
																			<? } ?>
																			
																		</tr>	
															<? } ?>				

															 </tbody>
															</table>
																					
															
													</div>


										<div class="row">

									
												<div class="col-xs-12 col-sm-12 col-md-12"><center><button style="width: 95%;" type="button" class="btn btn-default redondear" data-dismiss="modal">Cancelar</button></center></div>
												  
										</div> 

										<br>