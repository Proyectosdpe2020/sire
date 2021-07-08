<? 
	
	session_start();
	include ("../../Conexiones/Conexion.php");
	include ("../../Conexiones/conexionSicap.php");
	include("../../funciones.php");	

	if (isset($_POST["nombreCompletoMP"])){ $nombreCompletoMP = $_POST["nombreCompletoMP"]; }
	if (isset($_POST["idMp"])){ $idMp = $_POST["idMp"]; }
	if (isset($_POST["idUnidad"])){ $idUnidad = $_POST["idUnidad"]; }
	if (isset($_POST["mes"])){ $mes = $_POST["mes"]; }
	if (isset($_POST["anio"])){ $anio = $_POST["anio"]; }
	if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }


  $datosenlace = getIdFiscaliaEnlace($conn, $idEnlace);
  $idFiscalia = $datosenlace[0][0];		
		$idUsuario = $_SESSION['useridIE'];
		$unInfo = getInfoUnidad($conn, $idUnidad);
 	$nomUnidad = $unInfo[0][1]; 

 	$anioAnte = 0;
 	
 	if($mes == 1){ $mesAnterior = 12; $anioAnte = ($anio-1); }else{$anioAnte = $anio;  $mesAnterior = ($mes - 1); 	}
 	//// VALIDAR SI LLEGO O SE FUE DE CAMBIO
 	$cambios = getCambioLitiMpMesAnio($conn, $mes, $anio, $idMp);
 	$cambio = $cambios[0][0];

 				/// SE DEJA EL MES ACTUAL POR QUE YA SE CUADRO AL MP EN EL MES QUE SE VA Y DEJA SUS NUMEROS	PRIMERO HAY QUE CUADRAR LOS DATOS EN LA UNIDAD ANTERIRO A LA CUAL PERTENECIO
 		 		$totalTramites = getTramiteANteriore($conn, $idMp, $mesAnterior, $idFiscalia, $idUnidad, $anioAnte);	 	

 	if($totalTramites){ 
			$tramiteAnte = $totalTramites[0][0];  

			$bandHabTramite = 0;
		}else{ 
			$tramiteAnte = 0; 
			$bandHabTramite = 1;
		}
				$datalit = getDatosLitigacionMpUnidad($conn, $idMp, $mes, $anio, $idFiscalia, $idUnidad);	
				if($datalit){  $a = 1;  }else{ 	$a = 0;  }



?>

  <div class="modal-header" style="background-color:#3c6084;">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												
												<center><h4 class="modal-title" style="color:white; font-weight: bold;"> <? echo $nomUnidad; ?> </h4></center><br>
												<center><h5 class="modal-title" style="color:white; font-weight: ;"> <? echo $nombreCompletoMP; ?> </h5></center>
											  </div>



													<div class="col-md-12 col-sm-12 col-xs-12 form-group panelunoLitigacion">								      				

															
															<div class="row"  style="padding: 25px;">

																<div class="row" >
																	
																		<div class="col-md-12 col-sm-12 col-xs-12">
																							<div class="panel panel-default fd1" style="">
																	    <div class="panel-body">
																	      <h5 class="text-on-pannel"><strong> Existencia Anterior </strong></h5>
    																				<input class="form-control input-md redondear fdesv" id="tramAnt" type="number" value="<? if( $bandHabTramite == 1 ){ echo $tramiteAnte;  } else { echo $tramiteAnte; } ?>"  readonly onblur="sumTotCarpJudTram(event)">
																	    </div>
																	  </div>

																				
																				  <div class="panel panel-default fd1">
																				    <div class="panel-body">
																				      <h5 class="text-on-pannel"><strong> Recibidas   </strong></h5>
																				       <div class="row">
																				      	
																				       					<div class="col-md-12 col-sm-12 col-xs-12">
																				      								<label class="colorLetras" for="inputlg">Recibidas por Otro Ministerio Público :</label>
			    																											<div id="recibOmp"><input class="form-control input-md redondear fdesv" id="recibiOtmp" value="<? if($a == 1 ){ echo $datalit[0][100]; }else {echo 0;} ?>" type="number"><br></div>
																				      					</div>	

																				      					<div class="col-md-12 col-sm-12 col-xs-12">
																				      								<label class="colorLetras" for="inputlg">Carpetas judicializadas :</label>
			    																											<div id="totalJudicializadas"><input class="form-control input-md redondear fdesv" id="totJudic" value="<? if($a == 1 ){ echo  $datalit[0][1]; }else {echo 0;} ?>" type="number" readonly=""></div>
																				      					</div>

																				      </div><br>
																				      <div class="row">
																				      					<div class="col-xs-6">

																				      						<label class="colorLetras" for="inputlg">Con Detenido :</label>
																														  <div class="iconiput">
																														  	<input type="number" placeholder="cantidad" value="<? if($a == 1 ){ echo  $datalit[0][2]; } ?>" class="first" onblur="sumJudicialized(event)" id="cdete"/>
																														  	<span onclick="sendDataModalLitigacion('cdete',1,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checCdeten"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																														  </div>	

																				      					</div>
																				      					<div class="col-xs-6">
																				      								<label class="colorLetras" for="inputlg">Sin Detenido :</label>
																				      								<div class="iconiput">
																														  	<input type="number" placeholder="cantidad" value="<? if($a == 1 ){ echo  $datalit[0][3]; } ?>" class="first" onblur="sumJudicialized(event)" id="sdete"/>
																														  	<span onclick="sendDataModalLitigacion('sdete',2,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checSdeten"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																														  </div>	

																				      					</div>

																				      </div>
																				      
																				    	

																				    </div>
																				  </div>

																				   <div class="panel panel-default fd1">
																				    <div class="panel-body">
																				      <h5 class="text-on-pannel"><strong> Formulaciones de Imputación   </strong></h5>
																				       
																				      <div class="row">
																				      					<div class="col-xs-4">
																				      						<label class="colorLetras" for="inputlg">Solicitadas :</label>
																														  <div class="iconiput">
																														  	<input type="number" placeholder="cantidad" class="first" id="FIsolic" value="<? if($a == 1 ){ echo  $datalit[0][91]; }else {echo 0;} ?>"/>
																														  	<span onclick="sendDataModalLitigacion('FIsolic',3,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkFIsolic"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																														  </div>	

																				      					</div>
																				      					<div class="col-xs-4">
																				      								<label class="colorLetras" for="inputlg">Otorgadas :</label>
																				      								<div class="iconiput">
																														  	<input type="number" placeholder="cantidad" class="first" id="FIotor" value="<? if($a == 1 ){ echo  $datalit[0][92]; } ?>"/>
																														  	<span onclick="sendDataModalLitigacion('FIotor',4,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkFIotor"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																														  </div>	

																				      					</div>
																				      						<div class="col-xs-4">
																				      								<label class="colorLetras" for="inputlg">Negadas :</label>
																				      								<div class="iconiput">
																														  	<input type="number" placeholder="cantidad" class="first" id="FInega" value="<? if($a == 1 ){ echo  $datalit[0][93]; } ?>"/>
																														  	<span onclick="sendDataModalLitigacion('FInega',5,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkFInega"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																														  </div>	

																				      					</div>

																				      </div>
																				    	

																				    </div>
																				  </div>

																				  <div class="panel panel-default fd1">
																				    <div class="panel-body">
																				      <h5 class="text-on-pannel"><strong> Control de la Detención  </strong></h5>
																				     
																				      <div class="row">
																				      					<div class="col-xs-6">

																				      						<label class="colorLetras" for="inputlg">Legal :</label>
																														  <div class="iconiput">
																														  	<input type="number" placeholder="cantidad" class="first" onblur="sumJudicialized(event)" id="legal" value="<? if($a == 1 ){ echo  $datalit[0][94]; } ?>"/>
																														  	<span onclick="sendDataModalLitigacion('legal',6,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checklegal"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																														  </div>	

																				      					</div>
																				      					<div class="col-xs-6">
																				      								<label class="colorLetras" for="inputlg">Ilegal :</label>
																				      								<div class="iconiput">
																														  	<input type="number" placeholder="cantidad" class="first" onblur="sumJudicialized(event)" id="ilegal" value="<? if($a == 1 ){ echo  $datalit[0][95]; } ?>"/>
																														  	<span onclick="sendDataModalLitigacion('ilegal',7,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkilegal"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																														  </div>	

																				      					</div>

																				      </div>
																				      
																				    	

																				    </div>
																				  </div>

																				  <div class="panel panel-default fd1">
																				    <div class="panel-body">
																				      <h5 class="text-on-pannel"><strong> Vinculación a Proceso   </strong></h5>
																				       
																				      <div class="row">
																				      					<div class="col-xs-4">

																				      						<label class="colorLetras" for="inputlg">Auto de vinculación :</label>
																														  <div class="iconiput">
																														  	<input type="number" placeholder="cantidad" class="first" id="auvinc" value="<? if($a == 1 ){ echo  $datalit[0][4]; } ?>"/>
				<!-- Enviar a sicap  -->		<span onclick="sendDataModalSicap('auvinc',19,0,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkauvinc"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																														  </div>	

																				      					</div>
																				      					<div class="col-xs-4">
																				      								<label class="colorLetras" for="inputlg">Auto de no vinculación :</label>
																				      								<div class="iconiput">
																														  	<input type="number" placeholder="cantidad" class="first" id="aunvinc" onblur="sumTotCarpJudTram(event);" value="<? if($a == 1 ){ echo  $datalit[0][5]; } ?>"/>
																														  	<span onclick="sendDataModalLitigacion('aunvinc',10,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkaunvinc"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																														  </div>	

																				      					</div>
																				      					<div class="col-xs-4">
																				      								<label class="colorLetras" for="inputlg">Mixtos :</label>
																				      								<div class="iconiput">
																														  	<input type="number" placeholder="cantidad" class="first" id="mix" value="<? if($a == 1 ){ echo  $datalit[0][6]; } ?>"/>
																														  	<span onclick="sendDataModalLitigacion('mix',12,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkmix"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																														  </div>	

																				      					</div>

																				      </div>
																				    	

																				    </div>
																				  </div>


																				  <div class="panel panel-default fd1">
																				    <div class="panel-body">
																				      <h5 class="text-on-pannel"><strong> Medidas Cautelares   </strong></h5>
																				       
																				      <div class="row">
																				      			<div class="col-xs-12">		
																				      					<div class="row">

																				      					<div class="col-xs-4">

																				      						<label class="colorLetras" for="inputlg">Solicitadas :</label>
																														  <div class="iconiput">
																														  	<input type="number" placeholder="cantidad" class="first" id="MCsol" value="<? if($a == 1 ){ echo  $datalit[0][96]; } ?>"/>
																														  	<span onclick="sendDataModalLitigacion('MCsol',98,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkMCsol"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																														  </div>	

																				      					</div>
																				      					<div class="col-xs-4">
																				      								<label class="colorLetras" for="inputlg">Otorgadas :</label>
																				      								<div class="iconiput">
																														  	<input type="number" placeholder="cantidad" class="first" id="MCotor" value="<? if($a == 1 ){ echo  $datalit[0][98]; } ?>"/>
																														  	<span onclick="sendDataModalLitigacion('MCotor',97,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkMCotor"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																														  </div>	

																				      					</div>
																				      						<div class="col-xs-4">
																				      								<label class="colorLetras" for="inputlg">Negadas :</label>
																				      								<div class="iconiput">
																														  	<input type="number" placeholder="cantidad" class="first" id="MCnega" value="<? if($a == 1 ){ echo  $datalit[0][97]; } ?>"/>
																														  	<span onclick="sendDataModalLitigacion('MCnega',96,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkMCnega"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																														  </div>	

																				      					</div>

																				      					</div><hr>	

																				      						<div class="row"><div class="col-md-12 col-sm-12 col-xs-12">
																				      								<label class="colorLetras" for="inputlg">Imposición de medidas cautelares :</label>
			    																											<div id="totalJudicializadas"><input class="form-control input-md redondear fdesv" id="IMC" value="<? if($a == 1 ){ echo  $datalit[0][7]; }else {echo 0;} ?>" type="number" readonly=""></div>
																				      					</div></div><br>


																				      						<div class="row"><div class="col-xs-6">																				      
																				      																								  
																				      							<label class="colorLetras" for="inputlg">Prisión preventiva oficiosa :</label>
																				      							<div class="iconiput">
																														  	<input type="number" placeholder="cantidad" class="first" onblur="sumImpoMedCaute()" id="ppofic" value="<? if($a == 1 ){ echo  $datalit[0][8]; } ?>"/>
																														  	<span onclick="sendDataModalLitigacion('ppofic',17,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkppofic"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																														  </div>	
																				      					</div>
																				      						<div class="col-xs-6">
																				      								<label class="colorLetras" for="inputlg">Prisión preventiva justificada :</label>
																				      								<div class="iconiput">
																																  	<input type="number" placeholder="cantidad" class="first" onblur="sumImpoMedCaute()" id="ppjus" value="<? if($a == 1 ){ echo  $datalit[0][9]; } ?>"/>
																																  	<span onclick="sendDataModalLitigacion('ppjus',18,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkppjus"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																																  </div>	

																				      					</div></div>
																				      					<div class="row"><div class="col-xs-6">
																				      								<label class="colorLetras" for="inputlg">Presentación periódica ante el juez :</label>
																				      									<div class="iconiput">
																														  	<input type="number" placeholder="cantidad" class="first" onblur="sumImpoMedCaute()"  id="ppanju" value="<? if($a == 1 ){ echo  $datalit[0][10]; } ?>"/>
																														  	<span onclick="sendDataModalLitigacion('ppanju',95,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkppanju"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																														  </div>	

																				      					</div>
																				      						<div class="col-xs-6">
																				      							<label class="colorLetras" for="inputlg">La exhibición de una garantía económica :</label>
																				      							<div class="iconiput">
																														  	<input type="number" placeholder="cantidad" class="first" onblur="sumImpoMedCaute()" id="exgaeco" value="<? if($a == 1 ){ echo  $datalit[0][11]; } ?>"/>
																														  	<span onclick="sendDataModalLitigacion('exgaeco',20,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkexgaeco"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																														  </div>	

																				      					</div></div>
																				      					<div class="row"><div class="col-xs-6">
																				      								<label class="colorLetras" for="inputlg">El embargo de bienes :</label>
																				      								<div class="iconiput">
																														  	<input type="number" placeholder="cantidad" class="first" onblur="sumImpoMedCaute()" id="emvien" value="<? if($a == 1 ){ echo  $datalit[0][12]; } ?>"/>
																														  	<span onclick="sendDataModalLitigacion('emvien',21,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkemvien"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																														  </div>	
																														  <br>
																				      					</div>
																				      					<div class="col-xs-6">
																				      								<label class="colorLetras" for="inputlg">La inmovilización de cuentas y demás valores :</label>
																				      								<div class="iconiput">
																														  	<input type="number" placeholder="cantidad" class="first" onblur="sumImpoMedCaute()" id="incuval" value="<? if($a == 1 ){ echo  $datalit[0][13]; } ?>"/>
																														  	<span onclick="sendDataModalLitigacion('incuval',22,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkincuval"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																														  </div>	
																														  <br>
																				      					</div></div>
																				      					<div class="col-xs-12">
																				      								<label class="colorLetras" for="inputlg">La prohibición de salir sin autorización que fije el juez :</label>
																				      								<div class="iconiput">
																														  	<input type="number" placeholder="cantidad" class="first" onblur="sumImpoMedCaute()" id="pssafj" value="<? if($a == 1 ){ echo  $datalit[0][14]; } ?>"/>
																														  	<span onclick="sendDataModalLitigacion('pssafj',23,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkpssafj"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																														  </div>	
																														  <br>
																				      					</div>
																				      					<div class="col-xs-12">
																				      								<label class="colorLetras" for="inputlg">El sometimiento al cuidado o vigilancia o institución determinada :</label>
																				      								<div class="iconiput">
																														  	<input type="number" placeholder="cantidad" class="first" onblur="sumImpoMedCaute()" id="scviind" value="<? if($a == 1 ){ echo  $datalit[0][15]; } ?>"/>
																														  	<span onclick="sendDataModalLitigacion('scviind',24,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkscviind"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																														  </div>	
																														  <br>
																				      					</div>
																				      					<div class="col-xs-12">
																				      								<label class="colorLetras" for="inputlg">La prohibición de concurrir a determinadas reuniones o ciertos lugares :</label>
																				      								<div class="iconiput">
																														  	<input type="number" placeholder="cantidad" class="first" onblur="sumImpoMedCaute()" id="pcdrclug" value="<? if($a == 1 ){ echo  $datalit[0][16]; } ?>"/>
																														  	<span onclick="sendDataModalLitigacion('pcdrclug',25,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkpcdrclug"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																														  </div>	
																														  <br>
																				      					</div>
																				      					<div class="col-xs-12">
																				      								<label class="colorLetras" for="inputlg">La prohibición de convivir o comunicarse con determinadas personas :</label>
																				      								<div class="iconiput">
																														  	<input type="number" placeholder="cantidad" class="first" onblur="sumImpoMedCaute()" id="pccdper" value="<? if($a == 1 ){ echo  $datalit[0][17]; } ?>"/>
																														  	<span onclick="sendDataModalLitigacion('pccdper',26,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkpccdper"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																														  </div>	
																														  <br>
																				      					</div>
																				      					<div class="col-xs-12">
																				      								<label class="colorLetras" for="inputlg">La separación inmediata del domicilio :</label>
																				      								<div class="iconiput">
																														  	<input type="number" placeholder="cantidad" class="first" onblur="sumImpoMedCaute()" id="sindom" value="<? if($a == 1 ){ echo  $datalit[0][18]; } ?>"/>
																														  	<span onclick="sendDataModalLitigacion('sindom',27,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checksindom"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																														  </div>	
																														  <br>
																				      					</div>
																				      					<div class="col-xs-12">
																				      								<label class="colorLetras" for="inputlg">La suspensión temporal en el ejercicio del cargo :</label>
																				      								<div class="iconiput">
																														  	<input type="number" placeholder="cantidad" class="first" onblur="sumImpoMedCaute()" id="steeca" value="<? if($a == 1 ){ echo  $datalit[0][19]; } ?>"/>
																														  	<span onclick="sendDataModalLitigacion('steeca',28,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checksteeca"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																														  </div>	
																														  <br>
																				      					</div>
																				      					<div class="col-xs-12">
																				      								<label class="colorLetras" for="inputlg">La suspensión temporal en actividad profesional o laboral :</label>
																				      								<div class="iconiput">
																														  	<input type="number" placeholder="cantidad" class="first" onblur="sumImpoMedCaute()" id="steapl" value="<? if($a == 1 ){ echo  $datalit[0][20]; } ?>"/>
																														  	<span onclick="sendDataModalLitigacion('steapl',29,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checksteapl"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																														  </div>	
																														  <br>
																				      					</div>
																				      					<div class="col-xs-12">
																				      								<label class="colorLetras" for="inputlg">La colocación de localizadores electrónicos :</label>
																				      								<div class="iconiput">
																														  	<input type="number" placeholder="cantidad" class="first" onblur="sumImpoMedCaute()" id="coloele" value="<? if($a == 1 ){ echo  $datalit[0][21]; } ?>"/>
																														  	<span onclick="sendDataModalLitigacion('coloele',30,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkcoloele"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																														  </div>	
																														  <br>
																				      					</div>
																				      					<div class="col-xs-12">
																				      								<label class="colorLetras" for="inputlg">El resguardo en su propio domicilio con las modalidades que el juez disponga :</label>
																				      								<div class="iconiput">
																														  	<input type="number" placeholder="cantidad" class="first" onblur="sumImpoMedCaute()" id="rpdmjd" value="<? if($a == 1 ){ echo  $datalit[0][22]; } ?>"/>
																														  	<span onclick="sendDataModalLitigacion('rpdmjd',31,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkrpdmjd"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																														  </div>	
																														  <br>
																				      					</div>
																				      					

																				      </div>
																				    	

																				    </div></div>
																				  </div>






																				   <div class="panel panel-default fd1">
																				    <div class="panel-body">
																				      <h5 class="text-on-pannel"><strong> Sobreseimientos Decretados </strong></h5>
																				       
																				      <div class="row">
																				      					<div class="col-xs-12">
																									
																														  	<input type="number" placeholder="" value="<? if($a == 1 ){ echo  $datalit[0][23]; }else {echo 0;} ?>" disabled="" class="first" id="SD"/>
																														  	
																										
																				      					</div>
																				      </div>
																				       <div class="row">
																				      					<div class="col-xs-6">
																				      						<label class="colorLetras" for="inputlg">Prescripción de la acción penal :</label>
																														  <div class="iconiput">
									<input type="number" placeholder="cantidad" class="first" onblur="sumsobredecret(event)" id="SDpapen"  value="<? if($a == 1 ){ echo  $datalit[0][24]; } ?>"/>
																														  	<span onclick="sendDataModalLitigacion('SDpapen',89,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkSDpapen"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																														  </div>	
																				      					</div>

																				      					<div class="col-xs-6">
																				      						<label class="colorLetras" for="inputlg">Por Muerte del Imputado :</label>
																														  <div class="iconiput">
									<input type="number" placeholder="cantidad" class="first" onblur="sumsobredecret(event)" id="SDpmuImpu"  value="<? if($a == 1 ){ echo  $datalit[0][99]; } ?>"/>
																														  	<span onclick="sendDataModalLitigacion('SDpmuImpu',99,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkSDpmuImpu"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																														  </div>	
																				      					</div>	

																				      </div>
<!--
																				      <div class="row">
																				      					<div class="col-xs-6">
																				      						<label class="colorLetras" for="inputlg">El hecho no se cometió :</label>
																														  <div class="iconiput">
									<input type="number" placeholder="cantidad" class="first" onblur="sumsobredecret(event)" id="SDhNoCom"  value="<? if($a == 1 ){ echo  $datalit[0][24]; } ?>"/>
																														  	<span onclick="sendDataModalLitigacion('SDhNoCom',101,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkSDhNoCom"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																														  </div>	
																				      					</div>

																				      					<div class="col-xs-6">
																				      						<label class="colorLetras" for="inputlg">El hecho no constituye delito :</label>
																														  <div class="iconiput">
									<input type="number" placeholder="cantidad" class="first" onblur="sumsobredecret(event)" id="SDnoConDel"  value="<? if($a == 1 ){ echo  $datalit[0][99]; } ?>"/>
																														  	<span onclick="sendDataModalLitigacion('SDnoConDel',103,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkSDnoConDel"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																														  </div>	
																				      					</div>	

																				      </div>

																				         <div class="row">
																				      					<div class="col-xs-6">
																				      						<label class="colorLetras" for="inputlg">El imputado está exento de responsabilidad penal :</label>
																														  <div class="iconiput">
									<input type="number" placeholder="cantidad" class="first" onblur="sumsobredecret(event)" id="SDimExRespPen"  value="<? if($a == 1 ){ echo  $datalit[0][24]; } ?>"/>
																														  	<span onclick="sendDataModalLitigacion('SDimExRespPen',105,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkSDimExRespPen"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																														  </div>	
																				      					</div>

																				      					<div class="col-xs-6">
																				      						<label class="colorLetras" for="inputlg">No hay elementos suficientes para fundar una acusación :</label>
																														  <div class="iconiput">
									<input type="number" placeholder="cantidad" class="first" onblur="sumsobredecret(event)" id="SDNoEleSufAcusa"  value="<? if($a == 1 ){ echo  $datalit[0][99]; } ?>"/>
																														  	<span onclick="sendDataModalLitigacion('SDNoEleSufAcusa',106,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkSDNoEleSufAcusa"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																														  </div>	
																				      					</div>	

																				      </div>

																				       <div class="row">
																				      					<div class="col-xs-6">
																				      						<label class="colorLetras" for="inputlg">Extinción de la acción penal  :</label>
																														  <div class="iconiput">
									<input type="number" placeholder="cantidad" class="first" onblur="sumsobredecret(event)" id="SDExtPenal"  value="<? if($a == 1 ){ echo  $datalit[0][24]; } ?>"/>
																														  	<span onclick="sendDataModalLitigacion('SDExtPenal',107,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkSDExtPenal"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																														  </div>	
																				      					</div>

																				      					<div class="col-xs-6">
																				      						<label class="colorLetras" for="inputlg">Una ley o reforma posterior derogó delito por el que se sigue el proceso :</label>
																														  <div class="iconiput">
									<input type="number" placeholder="cantidad" class="first" onblur="sumsobredecret(event)" id="SDderDeliSigProc"  value="<? if($a == 1 ){ echo  $datalit[0][99]; } ?>"/>
																														  	<span onclick="sendDataModalLitigacion('SDderDeliSigProc',108,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkSDderDeliSigProc"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																														  </div>	
																				      					</div>	

																				      </div>

																				      <div class="row">
																				      					<div class="col-xs-6">
																				      						<label class="colorLetras" for="inputlg"> El hecho fue materia de un proceso penal en el que se dictó sentencia firme  :</label>
																														  <div class="iconiput">
									<input type="number" placeholder="cantidad" class="first" onblur="sumsobredecret(event)" id="SDsentFirme"  value="<? if($a == 1 ){ echo  $datalit[0][24]; } ?>"/>
																														  	<span onclick="sendDataModalLitigacion('SDsentFirme',109,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkSDsentFirme"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																														  </div>	
																				      					</div>

																				      					<div class="col-xs-6">
																				      						<label class="colorLetras" for="inputlg">No se vinculó a proceso :</label>
																														  <div class="iconiput">
									<input type="number" placeholder="cantidad" class="first" onblur="sumsobredecret(event)" id="SDnoVincProc"  value="<? if($a == 1 ){ echo  $datalit[0][99]; } ?>"/>
																														  	<span onclick="sendDataModalLitigacion('SDnoVincProc',110,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkSDnoVincProc"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																														  </div>	
																				      					</div>	

																				      </div>

																				      <div class="row">
																				      					<div class="col-xs-12">
																				      						<label class="colorLetras" for="inputlg">  Por incumplimiento del plazo del cierre de la investigación complementaria  :</label>
																														  <div class="iconiput">
									<input type="number" placeholder="cantidad" class="first" onblur="sumsobredecret(event)" id="SDinCieInvCom"  value="<? if($a == 1 ){ echo  $datalit[0][24]; } ?>"/>
																														  	<span onclick="sendDataModalLitigacion('SDinCieInvCom',111,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkSDinCieInvCom"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																														  </div>	
																				      					</div>

																				      </div>
																						
		-->								
																											         <div class="row">
																													      					<div class="col-xs-12">
																																										<label class="colorLetras" for="inputlg">Por mecanismos alternativos :</label>	
																																							  	<input type="number" placeholder="" disabled="" class="first" id="MA" value="<? if($a == 1 ){ echo  $datalit[0][25]; }else {echo 0;} ?>"/>
																																							  	
																																			
																													      					</div>
																													      </div><br>
																											      <div class="row">
																											      					<div class="col-xs-6">

																											      						<label class="colorLetras" for="inputlg">Acuerdo reparatorio : :</label>
																																					  <div class="iconiput">
														<input type="number" placeholder="cantidad" class="first" onblur="summecanalternat(event)" id="acrep" value="<? if($a == 1 ){ echo  $datalit[0][26]; } ?>"/>
																																					  	<span onclick="sendDataModalLitigacion('acrep',90,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkCacrep"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																																					  </div>	

																											      					</div>
																											      					<div class="col-xs-6">
																											      								<label class="colorLetras" for="inputlg">Suspensión condicional del proceso :</label>
																											      								<div class="iconiput">
																																					  	<input type="number" placeholder="cantidad" class="first" onblur="summecanalternat(event)" id="scpro" value="<? if($a == 1 ){ echo  $datalit[0][27]; } ?>"/>
																				<!-- Enviar a sicap  -->		<span onclick="sendDataModalSicap('scpro',15,0,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkscpro"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																																					  </div>	

																											      					</div>
																											      					

																											      </div>
																											      <div class="row"><div class="col-xs-12">
																											      								<label class="colorLetras" for="inputlg">Criterio de oportunidad :</label>
																											      								<div class="iconiput">
			<input type="number" placeholder="cantidad" class="first" onblur="summecanalternat(event)" id="criopor" value="<? if($a == 1 ){ echo  $datalit[0][28]; } ?>"/>
																																					  	<span onclick="sendDataModalLitigacion('criopor',91,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkcriopor"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																																					  </div>	

																											      					</div></div>
																				     
																				      <div class="row">
																				    
																				      					<div class="col-xs-12">
																				      						<label class="colorLetras" for="inputlg">Terminación anticipada :</label>
																														  <div class="iconiput">
															<input type="number" placeholder="cantidad" class="first" onblur="sumsobredecret(event)" id="termant" value="<? if($a == 1 ){ echo  $datalit[0][29]; } ?>"/>
																														  	<span onclick="sendDataModalLitigacion('termant',93,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checktermant"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																														  </div>	
																				      					</div>
																				      
																				      					
																				      </div>
																				      	 <div class="row">
																				      	<div class="col-xs-6">
																				      	<hr>
																				      							<label class="colorLetras" for="inputlg">Acumulación :</label>
																				      							<div class="iconiput">
																														  	<input type="number" placeholder="cantidad" class="first" id="acu" onblur="sumTotCarpJudTram(event)" value="<? if($a == 1 ){ echo  $datalit[0][31]; } ?>"/>
																														  	<span onclick="sendDataModalLitigacion('acu',32,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkacu"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																														  </div>	
																				      					</div>
																				      					<div class="col-xs-6">
																				      						<hr>
																				      							<label class="colorLetras" for="inputlg">Citaciones :</label>
																				      							<div class="iconiput">
																														  	<input type="number" placeholder="cantidad" class="first" id="citac" value="<? if($a == 1 ){ echo  $datalit[0][32]; } ?>"/>
																														  	<span onclick="sendDataModalLitigacion('citac',33,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkcitac"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																														  </div>	
																				      					</div>

																				      					</div>



																				      					 <div class="panel panel-default fd1">
																											    <div class="panel-body">
																											      <h5 class="text-on-pannel"><strong> Cateos  </strong></h5>
																											         <label class="colorLetras" for="inputlg">Cateos solicitados :</label>	
																											         <div class="row">
																													      					<div class="col-xs-12">
																																							
																																							  	<input type="number" placeholder="" value="<? if($a == 1 ){ echo  $datalit[0][33]; }else {echo 0;} ?>" disabled="" class="first" id="CS"/>
																																							  	
																															
																													      					</div>
																													      </div>
																											      <div class="row">
																											      				
																											      					<div class="col-xs-6">
																											      								<label class="colorLetras" for="inputlg">Cateos concedidos :</label>
																											      								<div class="iconiput">
																																					  	<input type="number" placeholder="cantidad" class="first" id="Cconc" onblur="sumcateos(event)" value="<? if($a == 1 ){ echo  $datalit[0][34]; } ?>"/>
																																					  	<span onclick="sendDataModalLitigacion('Cconc',34,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkCconc"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																																					  </div>	

																											      					</div>
																											      					<div class="col-xs-6">
																											      								<label class="colorLetras" for="inputlg">Cateos negados :</label>
																											      								<div class="iconiput">
																																					  	<input type="number" placeholder="cantidad" class="first" id="Cnega" onblur="sumcateos(event)" value="<? if($a == 1 ){ echo  $datalit[0][35]; } ?>"/>
																																					  	<span onclick="sendDataModalLitigacion('Cnega',35,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkCnega"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																																					  </div>	

																											      					</div>
																											      					

																											      </div>
																											    	

																											    </div>
																											  </div>

																											  <div class="panel panel-default fd1">
																											    <div class="panel-body">
																											      <h5 class="text-on-pannel"><strong> Ordenes  </strong></h5>
																											         <label class="colorLetras" for="inputlg">Ordenes negadas :</label>	
																											         <div class="row">
																													      					<div class="col-xs-12">
																								
																																							  	<input type="number" value="<? if($a == 1 ){ echo  $datalit[0][36]; }else {echo 0;} ?>" placeholder="" disabled="" class="first" id="ON"/>
																																							  	
																													
																													      					</div>
																													      </div>
																											      <div class="row">
																											      				
																											      					<div class="col-xs-6">
																											      								<label class="colorLetras" for="inputlg">Aprehensión :</label>
																											      								<div class="iconiput">
																																					  	<input type="number" placeholder="cantidad" class="first" id="ONapre" onblur="sumcordnes(event)" value="<? if($a == 1 ){ echo  $datalit[0][37]; } ?>"/>
																																					  	<span onclick="sendDataModalLitigacion('ONapre',36,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkONapre"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																																					  </div>	

																											      					</div>
																											      					<div class="col-xs-6">
																											      								<label class="colorLetras" for="inputlg">Comparecencia :</label>
																											      								<div class="iconiput">
																																					  	<input type="number" placeholder="cantidad" class="first" id="ONcomp" onblur="sumcordnes(event)" value="<? if($a == 1 ){ echo  $datalit[0][38]; } ?>"/>
																																					  	<span onclick="sendDataModalLitigacion('ONcomp',38,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkONcomp"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																																					  </div>	

																											      					</div>
																											      					

																											      </div>
																											    	

																											    </div>
																											  </div>
																				      					
																				      					<div class="panel panel-default fd1">
																											    <div class="panel-body">
																											      <h5 class="text-on-pannel"><strong> Desistimiento del recurso  </strong></h5>
																											        
																											         <div class="row">
																													      					<div class="col-xs-12">
																																						
																																							  	<input type="number" placeholder="" value="<? if($a == 1 ){ echo  $datalit[0][39]; }else {echo 0;} ?>" disabled="" class="first" id="DR"/>
																																							  	
																																
																													      					</div>
																													      </div>
																											      <div class="row">
																											      					<div class="col-xs-4">
																											      								<label class="colorLetras" for="inputlg">Por parte del acusado  :</label>
																											      								<div class="iconiput">
																																					  	<input type="number" placeholder="cantidad" class="first" id="DRppa" onblur="sumds(event)" value="<? if($a == 1 ){ echo  $datalit[0][40]; } ?>"/>
																																					  	<span onclick="sendDataModalLitigacion('DRppa',40,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkDRppa"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																																					  </div>	

																											      					</div>
																											      					<div class="col-xs-4">
																											      								<label class="colorLetras" for="inputlg">Por parte del defensor :</label>
																											      								<div class="iconiput">
																																					  	<input type="number" placeholder="cantidad" class="first" id="DRppd" onblur="sumds(event)" value="<? if($a == 1 ){ echo  $datalit[0][41]; } ?>"/>
																																					  	<span onclick="sendDataModalLitigacion('DRppd',41,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkDRppd"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																																					  </div>	

																											      					</div>
																											      					<div class="col-xs-4">
																											      								<label class="colorLetras" for="inputlg">Por parte del ministerio publico  :</label>
																											      								<div class="iconiput">
																																					  	<input type="number" placeholder="cantidad" class="first" id="DRppmp" onblur="sumds(event)" value="<? if($a == 1 ){ echo  $datalit[0][42]; } ?>"/>
																																					  	<span onclick="sendDataModalLitigacion('DRppmp',43,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkDRppmp"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																																					  </div>	

																											      					</div>
																											      					

																											      </div>
																											    	

																											    </div>
																											  </div>

																											  	<div class="row"><div class="col-xs-12">
																				      							<label class="colorLetras" for="inputlg">Apelaciones no admitidas :</label>
																				      							<div class="iconiput">
																														  	<input type="number" placeholder="cantidad" class="first" id="apenoadmi" value="<? if($a == 1 ){ echo  $datalit[0][43]; } ?>"/>
																														  	<span onclick="sendDataModalLitigacion('apenoadmi',44,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkapenoadmi"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																														  </div>	
																				      					</div></div><br>


																				      					 					<div class="panel panel-default fd1">
																											    <div class="panel-body">
																											      <h5 class="text-on-pannel"><strong> Procedimientos Abreviados  </strong></h5>																											        
																											     
																											      <div class="row">																											      			

																											      							<div class="col-xs-12">
																														  <div class="iconiput">
																														  	<input type="number" placeholder="cantidad" class="first" id="proabre" onblur="sumTotCarpJudTram(event)" value="<? if($a == 1 ){ echo  $datalit[0][30]; } ?>"/>
										<!-- Enviar a sicap  -->		<span onclick="sendDataModalSicap('proabre',13,0,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkproabre"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																														  </div>	
																				      					</div>
																											      					

																											      </div>
																											    	

																											    </div>
																											  </div>


																											  <div class="panel panel-default fd1">
																											    <div class="panel-body">
																											      <h5 class="text-on-pannel"><strong> Sentencias dictadas  </strong></h5>
																											        
																											         <div class="row">
																													      					<div class="col-xs-12">
																																
																																							  	<input type="number" placeholder="" value="<? if($a == 1 ){ echo  $datalit[0][44]; }else {echo 0;} ?>" disabled="" class="first" id="SDI"/>
																																							  	
																																
																													      					</div>
																													      </div>
																											      <div class="row">
																											      					<div class="col-xs-4">
																											      								<label class="colorLetras" for="inputlg">Revoca  :</label>
																											      								<div class="iconiput">
																																					  	<input type="number" placeholder="cantidad" class="first" id="SDIrev" onblur="sumsentedict(event)" value="<? if($a == 1 ){ echo  $datalit[0][45]; } ?>"/>
																																					  	<span onclick="sendDataModalLitigacion('SDIrev',45,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkSDIrev"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																																					  </div>	

																											      					</div>
																											      					<div class="col-xs-4">
																											      								<label class="colorLetras" for="inputlg">Modifica :</label>
																											      								<div class="iconiput">
																																					  	<input type="number" placeholder="cantidad" class="first" id="SDImod" onblur="sumsentedict(event)" value="<? if($a == 1 ){ echo  $datalit[0][46]; } ?>"/>
																																					  	<span onclick="sendDataModalLitigacion('SDImod',46,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkSDImod"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																																					  </div>	

																											      					</div>
																											      					<div class="col-xs-4">
																											      								<label class="colorLetras" for="inputlg">Confirma  :</label>
																											      								<div class="iconiput">
																																					  	<input type="number" placeholder="cantidad" class="first" id="SDIconf" onblur="sumsentedict(event)" value="<? if($a == 1 ){ echo  $datalit[0][47]; } ?>"/>
																																					  	<span onclick="sendDataModalLitigacion('SDIconf',48,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkSDIconf"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																																					  </div>	

																											      					</div>
																											      					

																											      </div>
																											    	

																											    </div>
																											  </div>
																				      					
																				      			
																				      					<div class="row"><div class="col-xs-12">
																				      							<label class="colorLetras" for="inputlg">Reposición del procedimiento :</label>
																				      							<div class="iconiput">
																														  	<input type="number" placeholder="cantidad" class="first" id="Reproc" value="<? if($a == 1 ){ echo  $datalit[0][48]; } ?>"/>
																														  	<span onclick="sendDataModalLitigacion('Reproc',49,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkReproc"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																														  </div>	
																				      					</div></div>

																				      					<div class="row"><div class="col-xs-12">				
																				      							<label class="colorLetras" for="inputlg">Total de carpetas judicializadas en tramite:</label>																			      							
																														  	<input type="number" value="<? if($a == 1 ){ echo  $datalit[0][49]; }else {echo 0;} ?>" placeholder="" class="first" disabled="true" id="totCarjudTram"/>
																				      					</div></div>

																				      					 
																				      				
																				   </div>
																				  </div>

																				  <div class="row">				

																				      					<div class="col-xs-12">
																																		<div class="panel panel-default fd1" style="">
																																    <div class="panel-body">								

																																    	<div class="panel panel-default fd1">
																																		    <div class="panel-body">
																																		      <h5 class="text-on-pannel"><strong> Mandamientos judiciales girados  </strong></h5>
																																		         <div class="row">
																																				      					<div class="col-xs-12">
																																														 
																																														  	<input type="number" value="<? if($a == 1 ){ echo  $datalit[0][50]; }else {echo 0;} ?>" placeholder="" disabled="" class="first" id="MJG"/>
																																														  	
																																			
																																				      					</div>
																																				      </div>
																																		      <div class="row">
																																		      				
																																		      					<div class="col-xs-6">
																																		      								<label class="colorLetras" for="inputlg">Ordenes de aprehensión :</label>
																																		      								<div class="iconiput">
																																												  	<input type="number" placeholder="cantidad" class="first" id="MJGorap" onblur="sumManJudGir(event)" value="<? if($a == 1 ){ echo  $datalit[0][51]; } ?>"/>
																																												  	<span onclick="sendDataModalLitigacion('MJGorap',50,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkMJGorap"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																																												  </div>	

																																		      					</div>
																																		      					<div class="col-xs-6">
																																		      								<label class="colorLetras" for="inputlg">Ordenes de comparecencia :</label>
																																		      								<div class="iconiput">
																																												  	<input type="number" placeholder="cantidad" class="first" id="MJGorcomp" onblur="sumManJudGir(event)" value="<? if($a == 1 ){ echo  $datalit[0][52]; } ?>"/>
																																												  	<span onclick="sendDataModalLitigacion('MJGorcomp',53,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkMJGorcomp"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																																												  </div>	

																																		      					</div>
																																		      					

																																		      </div>
																																		    	

																																		    </div>
																																		  </div>


																																		  	<div class="panel panel-default fd1">
																																		    <div class="panel-body">
																																		      <h5 class="text-on-pannel"><strong> Mandamientos judiciales cumplidos </strong></h5>
																																		         <div class="row">
																																				      					<div class="col-xs-12">
																																										
																																														  	<input type="number" value="<? if($a == 1 ){ echo  $datalit[0][53]; }else {echo 0;} ?>" placeholder="" disabled="" class="first" id="MJC"/>
																														
																																				      					</div>
																																				      </div>
																																		      <div class="row">
																																		      				
																																		      					<div class="col-xs-6">
																																		      								<label class="colorLetras" for="inputlg">Ordenes de aprehensión :</label>
																																		      								<div class="iconiput">
																																												  	<input type="number" placeholder="cantidad" class="first" id="MJCorapre" onblur="sumManJudCump(event)" value="<? if($a == 1 ){ echo  $datalit[0][54]; } ?>"/>
																																												  	<span onclick="sendDataModalLitigacion('MJCorapre',57,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkMJCorapre"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																																												  </div>	

																																		      					</div>
																																		      					<div class="col-xs-6">
																																		      								<label class="colorLetras" for="inputlg">Ordenes de comparecencia :</label>
																																		      								<div class="iconiput">
																																												  	<input type="number" placeholder="cantidad" class="first" id="MJCordcomp" onblur="sumManJudCump(event)" value="<? if($a == 1 ){ echo  $datalit[0][55]; } ?>"/>
																																												  	<span onclick="sendDataModalLitigacion('MJCordcomp',58,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkMJCordcomp"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																																												  </div>	

																																		      					</div>
																																		      					

																																		      </div>
																																		    	

																																		    </div>
																																		  </div>


																				      								

																				      					<div class="row"><div class="col-xs-12">
																				      							<label class="colorLetras" for="inputlg">Total de audiencias :</label>
																				      							<div class="iconiput">
																														  	<input type="number" placeholder="cantidad" class="first" id="totAudiencias" value="<? if($a == 1 ){ echo  $datalit[0][56]; } ?>"/>
																														  	<span onclick="sendDataModalLitigacion('totAudiencias',60,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checktotAudiencias"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																														  </div>	
																				      					</div> </div><br>



																				      								<div class="panel panel-default fd1">
																																		    <div class="panel-body">
																																		      <h5 class="text-on-pannel"><strong> Acusaciones presentadas </strong></h5>
																																		         <div class="row">
																																				      					<div class="col-xs-12">
																																					
																																														  	<input type="number" value="<? if($a == 1 ){ echo  $datalit[0][99]; }else {echo 0;} ?>"  placeholder="" disabled="" class="first" id="ACPRE"/>
																																														  	
																																								
																																				      					</div>
																																				      </div>
																																		      <div class="row">
																																		      				
																																		      					<div class="col-xs-6">
																																		      								<label class="colorLetras" for="inputlg">Audiencia intermedia escrita :</label>
																																		      								<div class="iconiput">
																																												  	<input type="number" placeholder="cantidad" class="first" id="ACPREaie" onblur="sumAcusaPres(event)" value="<? if($a == 1 ){ echo  $datalit[0][57]; } ?>"/>
																																												  	<span onclick="sendDataModalLitigacion('ACPREaie',61,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkACPREaie"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																																												  </div>	

																																		      					</div>
																																		      					<div class="col-xs-6">
																																		      								<label class="colorLetras" for="inputlg">Audiencia intermedia oral :</label>
																																		      								<div class="iconiput">
																																												  	<input type="number" placeholder="cantidad" class="first" id="ACPREaio" onblur="sumAcusaPres(event)" value="<? if($a == 1 ){ echo  $datalit[0][58]; } ?>"/>
																																												  	<span onclick="sendDataModalLitigacion('ACPREaio',63,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkACPREaio"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																																												  </div>	

																																		      					</div>
																																		      					

																																		      </div>
																																		    	

																																		    </div>
																																		  </div>

																																		  <div class="panel panel-default fd1">
																																		    <div class="panel-body">
																																		      <h5 class="text-on-pannel"><strong> Soluciones alternas </strong></h5>
																																		         <div class="row">
																																				      					<div class="col-xs-12">
																																					
																																														  	<input type="number" value="<? if($a == 1 ){ echo  $datalit[0][59]; }else {echo 0;} ?>" placeholder="" disabled="" class="first" id="SOAL"/>
																																														  	
																																	
																																				      					</div>
																																				      </div>
																																		      <div class="row">
																																		      				
																																		      					<div class="col-xs-6">
																																		      								<label class="colorLetras" for="inputlg">Suspensión condicional del proceso :</label>
																																		      								<div class="iconiput">
																																												  	<input type="number" placeholder="cantidad" class="first" id="SOALscp" onblur="sumSolAltern(event)" value="<? if($a == 1 ){ echo  $datalit[0][60]; } ?>"/>
																																												  	<span onclick="sendDataModalLitigacion('SOALscp',64,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkSOALscp"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																																												  </div>	

																																		      					</div>
																																		      					<div class="col-xs-6">
																																		      								<label class="colorLetras" for="inputlg">Acuerdo reparatorio :</label>
																																		      								<div class="iconiput">
																																												  	<input type="number" placeholder="cantidad" class="first" id="SOALarep" onblur="sumSolAltern(event)" value="<? if($a == 1 ){ echo  $datalit[0][61]; } ?>"/>
																																												  	<span onclick="sendDataModalLitigacion('SOALarep',65,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkSOALarep"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																																												  </div>	

																																		      					</div>																																	      					

																																		      </div>
																																		    	

																																		    </div>
																																		  </div>

																																		   <div class="panel panel-default fd1">
																																		    <div class="panel-body">
																																		      <h5 class="text-on-pannel"><strong> Sentencias </strong></h5>
																																		         <div class="row">
																																				      					<div class="col-xs-12">
																																											
																																														  	<input type="number" value="<? if($a == 1 ){ echo  $datalit[0][62]; }else {echo 0;} ?>" placeholder="" disabled="" class="first" id="SEN"/>
																																														  	
																																						
																																				      					</div>
																																				      </div>
																																		      <div class="row">
																																		      				
																																		      					<div class="col-xs-4">
																																		      								<label class="colorLetras" for="inputlg">Condenatorias :</label>
																																		      								<div class="iconiput">
																									<!-- Enviar a sicap  -->	<input type="number" placeholder="cantidad" class="first" id="SENcon" onblur="sumsentencias(event)" value="<? if($a == 1 ){ echo  $datalit[0][63]; } ?>"/>
																																												  	<span onclick="sendDataModalSicap('SENcon',14,0,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkSENcon"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																																												  </div>	

																																		      					</div>
																																		      					<div class="col-xs-4">
																																		      								<label class="colorLetras" for="inputlg">Absolutorias :</label>
																																		      								<div class="iconiput">
																																												  	<input type="number" placeholder="cantidad" class="first"  id="SENabsol" onblur="sumsentencias(event)" value="<? if($a == 1 ){ echo  $datalit[0][64]; } ?>"/>
																																												  	<span onclick="sendDataModalLitigacion('SENabsol',66,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkSENabsol"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																																												  </div>	

																																		      					</div>
																																		      					<div class="col-xs-4">
																																		      								<label class="colorLetras" for="inputlg">Mixtas :</label>
																																		      								<div class="iconiput">
																																												  	<input type="number" placeholder="cantidad" class="first" id="SENmixc" onblur="sumsentencias(event)"	value="<? if($a == 1 ){ echo  $datalit[0][65]; } ?>"/>
																																												  	<span onclick="sendDataModalLitigacion('SENmixc',67,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkSENmixc"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																																												  </div>	
																																		      					</div>																																		      					

																																		      </div>
																																		    	 <div class="row">																																		      				
																																		      					
																																		      					<div class="col-xs-6">
																																		      								<label class="colorLetras" for="inputlg">Se condena reparación del daños :</label>
																																		      								<div class="iconiput">
																																												  	<input type="number" placeholder="cantidad" class="first" id="SENsreda" onblur="sumsentencias(event)" value="<? if($a == 1 ){ echo  $datalit[0][66]; } ?>"/>
																																												  	<span onclick="sendDataModalLitigacion('SENsreda',68,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkSENsreda"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																																												  </div>	

																																		      					</div>
																																		      					<div class="col-xs-6">
																																		      								<label class="colorLetras" for="inputlg">No se condena reparación del daño :</label>
																																		      								<div class="iconiput">
																																												  	<input type="number" placeholder="cantidad" class="first" id="SENnocreda" onblur="sumsentencias(event)" value="<? if($a == 1 ){ echo  $datalit[0][67]; } ?>"/>
																																												  	<span onclick="sendDataModalLitigacion('SENnocreda',69,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkSENnocreda"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																																												  </div>	

																																		      					</div>
																																		      					

																																		      </div>

																																		    </div>
																																		  </div>



																																		   <div class="panel panel-default fd1">
																																		    <div class="panel-body">
																																		      <h5 class="text-on-pannel"><strong> Incompetencia </strong></h5>
																																		         <div class="row">
																																				      					<div class="col-xs-12">
																																				
																																														  	<input type="number" value="<? if($a == 1 ){ echo  $datalit[0][68]; }else {echo 0;} ?>" placeholder="" disabled="" class="first" id="INCOM"/>
																																														  	
																																					
																																				      					</div>
																																				      </div>
																																		      <div class="row">
																																		      				
																																		      					<div class="col-xs-6">
																																		      								<label class="colorLetras" for="inputlg">Decretadas :</label>
																																		      								<div class="iconiput">
																																												  	<input type="number" placeholder="cantidad" class="first" id="INCOMdecre" onblur="sumImcompetenc(event)" value="<? if($a == 1 ){ echo  $datalit[0][69]; } ?>"/>
																																												  	<span onclick="sendDataModalLitigacion('INCOMdecre',70,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkINCOMdecre"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																																												  </div>	

																																		      					</div>
																																		      					<div class="col-xs-6">
																																		      								<label class="colorLetras" for="inputlg">Admitidas :</label>
																																		      								<div class="iconiput">
																																												  	<input type="number" placeholder="cantidad" class="first" id="INCOMadmi" onblur="sumImcompetenc(event)" value="<? if($a == 1 ){ echo  $datalit[0][70]; } ?>"/>
																																												  	<span onclick="sendDataModalLitigacion('INCOMadmi',71,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkINCOMadmi"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																																												  </div>	

																																		      					</div>
																																		      					

																																		      </div>
																																		    	

																																		    </div>
																																		  </div>

																																		   <div class="panel panel-default fd1">
																																		    <div class="panel-body">
																																		      <h5 class="text-on-pannel"><strong> Apelaciones contra resolución del juez de control </strong></h5>
																																		         <div class="row">
																																				      					<div class="col-xs-12">
																																									
																																														  	<input type="number" value="<? if($a == 1 ){ echo  $datalit[0][71]; }else {echo 0;} ?>" placeholder="" disabled="" class="first" id="ARJ"/>
																																														  	
																																							
																																				      					</div>
																																				      </div>
																																		      <div class="row">
																																		      				
																																		      					<div class="col-xs-6">
																																		      								<label class="colorLetras" for="inputlg">Negar anticipo de prueba :</label>
																																		      								<div class="iconiput">
																																												  	<input type="number" placeholder="cantidad" class="first" id="ARJnap" onblur="sumApelaJuControl(event)" value="<? if($a == 1 ){ echo  $datalit[0][72]; } ?>"/>
																																												  	<span onclick="sendDataModalLitigacion('ARJnap',72,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkARJnap"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																																												  </div>	

																																		      					</div>
																																		      					<div class="col-xs-6">
																																		      								<label class="colorLetras" for="inputlg">Negar acuerdo reparatorio :</label>
																																		      								<div class="iconiput">
																																												  	<input type="number" placeholder="cantidad" class="first" id="ARJnar" onblur="sumApelaJuControl(event)" value="<? if($a == 1 ){ echo  $datalit[0][73]; } ?>"/>
																																												  	<span onclick="sendDataModalLitigacion('ARJnar',73,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkARJnar"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																																												  </div>	

																																		      					</div>
																																		      					

																																		      </div>
																																		       <div class="row">
																																		      				
																																		      					<div class="col-xs-6">
																																		      								<label class="colorLetras" for="inputlg">Negar o cancelar orden de aprehensión :</label>
																																		      								<div class="iconiput">
																																												  	<input type="number" placeholder="cantidad" class="first" id="ARJncoap" onblur="sumApelaJuControl(event)" value="<? if($a == 1 ){ echo  $datalit[0][74]; } ?>"/>
																																												  	<span onclick="sendDataModalLitigacion('ARJncoap',74,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkARJncoap"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																																												  </div>	
																																		      					</div>

																																		      					<div class="col-xs-6">
																																		      								<label class="colorLetras" for="inputlg">Negar orden de cateo :</label>
																																		      								<div class="iconiput">
																																												  	<input type="number" placeholder="cantidad" class="first" id="ARJnoc" onblur="sumApelaJuControl(event)" value="<? if($a == 1 ){ echo  $datalit[0][75]; } ?>"/>
																																												  	<span onclick="sendDataModalLitigacion('ARJnoc',75,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkARJnoc"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																																												  </div>
																																		      					</div>					
																																		      </div>
																																		      <div class="row">
																																		      				
																																		      					<div class="col-xs-6">
																																		      								<label class="colorLetras" for="inputlg">Providencias precautorias o medida cautelar :</label>
																																		      								<div class="iconiput">
																																												  	<input type="number" placeholder="cantidad" class="first" id="ARJppmc" onblur="sumApelaJuControl(event)" value="<? if($a == 1 ){ echo  $datalit[0][76]; } ?>"/>
																																												  	<span onclick="sendDataModalLitigacion('ARJppmc',76,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkARJppmc"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																																												  </div>	

																																		      					</div>
																																		      					<div class="col-xs-6">
																																		      								<label class="colorLetras" for="inputlg">Las que pongan termino al procedimiento o lo suspendan:</label>
																																		      								<div class="iconiput">
																																												  	<input type="number" placeholder="cantidad" class="first" id="ARJtps" onblur="sumApelaJuControl(event)" value="<? if($a == 1 ){ echo  $datalit[0][77]; } ?>"/>
																																												  	<span onclick="sendDataModalLitigacion('ARJtps',77,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkARJtps"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																																												  </div>
																																		      					</div>					
																																		      </div>
																																		      <div class="row">
																																		      				
																																		      					<div class="col-xs-6">
																																		      								<label class="colorLetras" for="inputlg">auto que resuelve la vinculación a proceso :</label>
																																		      								<div class="iconiput">
																																												  	<input type="number" placeholder="cantidad" class="first" id="ARJrvp" onblur="sumApelaJuControl(event)" value="<? if($a == 1 ){ echo  $datalit[0][78]; } ?>"/>
																																												  	<span onclick="sendDataModalLitigacion('ARJrvp',78,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkARJrvp"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																																												  </div>	

																																		      					</div>
																																		      					<div class="col-xs-6">
																																		      								<label class="colorLetras" for="inputlg">Las que concedan, revoquen o nieguen la suspensión condicional del proceso:</label>
																																		      								<div class="iconiput">
																																												  	<input type="number" placeholder="cantidad" class="first" id="ARJrnscp" onblur="sumApelaJuControl(event)" value="<? if($a == 1 ){ echo  $datalit[0][79]; } ?>"/>
																																												  	<span onclick="sendDataModalLitigacion('ARJrnscp',79,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkARJrnscp"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																																												  </div>
																																		      					</div>					
																																		      </div>
																																		      <div class="row">
																																		      				
																																		      					<div class="col-xs-6">
																																		      								<label class="colorLetras" for="inputlg">Negativa de abrir el procedimiento abreviado :</label>
																																		      								<div class="iconiput">
																																												  	<input type="number" placeholder="cantidad" class="first" id="ARJnapa" onblur="sumApelaJuControl(event)" value="<? if($a == 1 ){ echo  $datalit[0][80]; } ?>"/>
																																												  	<span onclick="sendDataModalLitigacion('ARJnapa',80,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkSARJnapa"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																																												  </div>	

																																		      					</div>
																																		      					<div class="col-xs-6">
																																		      								<label class="colorLetras" for="inputlg">Sentencia definitiva en el procedimiento abreviado:</label>
																																		      								<div class="iconiput">
																																												  	<input type="number" placeholder="cantidad" class="first" id="ARJsdpa" onblur="sumApelaJuControl(event)" value="<? if($a == 1 ){ echo  $datalit[0][81]; } ?>"/>
																																												  	<span onclick="sendDataModalLitigacion('ARJsdpa',81,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkARJsdpa"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																																												  </div>
																																		      					</div>					
																																		      </div>
																																		      <div class="row">
																																		      				
																																		      					<div class="col-xs-12">
																																		      								<label class="colorLetras" for="inputlg">Excluir algún medio de prueba :</label>
																																		      								<div class="iconiput">
																																												  	<input type="number" placeholder="cantidad" class="first" id="ARJemp" onblur="sumApelaJuControl(event)" value="<? if($a == 1 ){ echo  $datalit[0][82]; } ?>"/>
																																												  	<span onclick="sendDataModalLitigacion('ARJemp',82,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkARJemp"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																																												  </div>	

																																		      					</div>			
																																		      </div>
																																		    	

																																		    </div>
																																		  </div>		

																																		  <div class="panel panel-default fd1">
																																		    <div class="panel-body">
																																		      <h5 class="text-on-pannel"><strong> Apelaciones contra resoluciones del tribunal de enjuiciamiento </strong></h5>
																																		         <div class="row">
																																				      					<div class="col-xs-12">
																																										
																																														  	<input type="number" value="<? if($a == 1 ){ echo  $datalit[0][83]; }else {echo 0;} ?>" placeholder="" disabled="" class="first" id="ARTE"/>
																																														  	
																																
																																				      					</div>
																																				      </div>
																																		      <div class="row">
																																		      				
																																		      					<div class="col-xs-6">
																																		      								<label class="colorLetras" for="inputlg">Desistimiento de la acción penal :</label>
																																		      								<div class="iconiput">
																																												  	<input type="number" placeholder="cantidad" class="first"  id="ARTEdap" onblur="sumApelacResolTribuEnj(event)" value="<? if($a == 1 ){ echo  $datalit[0][84]; } ?>"/>
																																												  	<span onclick="sendDataModalLitigacion('ARTEdap',83,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkARTEdap"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																																												  </div>	

																																		      					</div>
																																		      					<div class="col-xs-6">
																																		      								<label class="colorLetras" for="inputlg">Sentencia definitiva :</label>
																																		      								<div class="iconiput">
																																												  	<input type="number" placeholder="cantidad" class="first" id="ARTEsd" onblur="sumApelacResolTribuEnj(event)" value="<? if($a == 1 ){ echo  $datalit[0][85]; } ?>"/>
																																												  	<span onclick="sendDataModalLitigacion('ARTEsd',84,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkARTEsd"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																																												  </div>	

																																		      					</div>
																																		      					

																																		      </div>
																																		    	

																																		    </div>
																																		  </div>						


																																		  <div class="panel panel-default fd1">
																																		    <div class="panel-body">
																																		      <h5 class="text-on-pannel"><strong> De las sentencias dictadas </strong></h5>
																																		         <div class="row">
																																				      					<div class="col-xs-12">
																														
																																														  	<input type="number" value="<? if($a == 1 ){ echo  $datalit[0][86]; }else {echo 0;} ?>" placeholder="" disabled="" class="first" id="DSED"/>
																																														  	
																																						
																																				      					</div>
																																				      </div>
																																		      <div class="row">
																																		      					
																																		      					<div class="col-xs-4">
																																		      								<label class="colorLetras" for="inputlg">Revocaciones favorables al Ministerio Publico :</label>
																																		      								<div class="iconiput">
																																												  	<input type="number" placeholder="cantidad" class="first"  id="DSEDrfmp" onblur="sumSentencDictadas(event)" value="<? if($a == 1 ){ echo  $datalit[0][87]; } ?>"/>
																																												  	<span onclick="sendDataModalLitigacion('DSEDrfmp',85,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkDSEDrfmp"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																																												  </div>	

																																		      					</div>
																																		      					<div class="col-xs-4">
																																		      								<label class="colorLetras" for="inputlg">Modificaciones favorables al Ministerio Publico :</label>
																																		      								<div class="iconiput">
																																												  	<input type="number" placeholder="cantidad" class="first"  id="DSEDmfmp" onblur="sumSentencDictadas(event)" value="<? if($a == 1 ){ echo  $datalit[0][88]; } ?>"/>
																																												  	<span onclick="sendDataModalLitigacion('DSEDmfmp',86,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkDSEDmfmp"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																																												  </div>	

																																		      					</div>
																																		      					<div class="col-xs-4">
																																		      								<label class="colorLetras" for="inputlg">Confirmaciones favorables al Ministerio Publico :</label>
																																		      								<div class="iconiput">
																																												  	<input type="number" placeholder="cantidad" class="first"  id="DSEDcfmp" onblur="sumSentencDictadas(event)" value="<? if($a == 1 ){ echo  $datalit[0][89]; } ?>"/>
																																												  	<span onclick="sendDataModalLitigacion('DSEDcfmp',87,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkDSEDcfmp"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																																												  </div>	

																																		      					</div>
																																		      					

																																		      </div>
																																		    	

																																		    </div>
																																		  </div>								

																				      					<div class="row"><div class="col-xs-12">
																				      							<label class="colorLetras" for="inputlg"> Por cambio de situación jurídica declarados sin materia :</label>
																				      							<div class="iconiput">
																														  	<input type="number" placeholder="cantidad" class="first"  id="csjdsm" value="<? if($a == 1 ){ echo  $datalit[0][90]; } ?>"/>
																														  	<span onclick="sendDataModalLitigacion('csjdsm',88,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkcsjdsm"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																														  </div>	
																				      					</div> </div>


																				      								<div class="row"><div class="col-xs-12">
																				      							<label class="colorLetras" for="inputlg"> Canalizadas por cese de funciones del Ministerio Público  :</label>																				      						
																														  	<input type="number" placeholder="" class="first"  id="cesefunciones" value="<? if($a == 1 ){ echo  $datalit[0][101]; } ?>"/>																														  
																														  
																				      					</div> </div>
																				    	
																				    	

																																    </div>
																																  </div>																				      					
																				      					</div>
																
																

																				  </div>	


																				  			


																				  </div>	

																				  </div>	


																				


																		</div>	

																	</div>


																</div>										

																</div>
																</div>

															</div>
											  

													</div>


													<div id="continputdhidden">
														  
											  </div>


										<div class="row">

												<div class="col-xs-6 col-sm-6 col-md-6"><center><button style="width: 85%;" type="button" class="btn btn-primary redondear" onclick="validateItsokLiti(<? echo $idEnlace; ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idMp; ?>, <? echo $idUnidad; ?>)">Guardar</button></center></div>
											   

												<div class="col-xs-6 col-sm-6 col-md-6"><center><button style="width: 85%;" type="button" class="btn btn-default redondear" onclick="cerrarCapturaLit(<? echo $idEnlace; ?>)" data-dismiss="modal">Salir</button></center></div>
												  
										</div> 

										<br>

										<div id="respuestaGuardado"></div>


