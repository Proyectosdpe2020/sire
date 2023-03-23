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



	$cambios = getCambioLitiMpMesAnio($conn, $mes, $anio, $idMp);
 	$cambio = $cambios[0][0];


 		$totalTramites = getTramiteANteriore($conn, $idMp, $mesAnterior, $idFiscalia, $idUnidad, $anioAnte);	 

	
 	if($totalTramites){ 
			$tramiteAnte = $totalTramites[0][0];  
			$bandHabTramite = 0;
		}else{ 
			$tramiteAnte = 0; 
			$bandHabTramite = 1;
		}
		
	
		/*if($cambio == 1){ */

		
				$datalit = getDatosLitigacionMpUnidad($conn, $idMp, $mes, $anio, $idFiscalia, $idUnidad);	
				if($datalit){  $a = 1;  }else{ 	$a = 0;  }

		/*		
		}else{


				 $query = "SELECT idLitigacion  FROM Litigacion WHERE idMes = $mes AND idAnio = $anio AND idFiscalia = $idFiscalia AND idMp = $idMp";

		 //echo $query;
      $stmt = sqlsrv_query(  $conn, $query,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
      $row_count = sqlsrv_num_rows( $stmt );
        
         if($row_count > 0){
         							$datalit = getDatosLitigacionMp($conn, $idMp, $mes, $anio, $idFiscalia);
         							$a = 1;
         }else{ $a = 0; }

		}*/
		


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
    																				<input class="form-control input-md redondear fdesv" id="tramAnt" type="number" value="<? if($a == 1 ){ echo  $datalit[0][0]; } ?>"  readonly/>
																	    </div>
																	  </div>

																				
																				  <div class="panel panel-default fd1">
																				    <div class="panel-body">
																				      <h5 class="text-on-pannel"><strong> Recibidas   </strong></h5>
																				       <div class="row">
																				      	
																				      					<div class="col-md-12 col-sm-12 col-xs-12">
																				      								<label class="colorLetras" for="inputlg">Carpetas judicializadas :</label>
			    																											<div id="totalJudicializadas"><input class="form-control input-md redondear fdesv" id="totJudic" value="<? if($a == 1 ){ echo  $datalit[0][1]; }else {echo 0;} ?>" type="number" readonly=""></div>
																				      					</div>

																				      </div><br>
																				      <div class="row">
																				      					<div class="col-xs-6">

																				      						<label class="colorLetras" for="inputlg">Con Detenido :</label>
																											
																														  	<input type="number" placeholder="cantidad" value="<? if($a == 1 ){ echo  $datalit[0][2]; } ?>" class="first" readonly/>
																							

																				      					</div>
																				      					<div class="col-xs-6">
																				      								<label class="colorLetras" for="inputlg">Sin Detenido :</label>
																				    
																														  	<input type="number" placeholder="cantidad" value="<? if($a == 1 ){ echo  $datalit[0][3]; } ?>" class="first" readonly/>
																														 

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
																														 
																														  	<input type="number" placeholder="cantidad" class="first" id="FIsolic" value="<? if($a == 1 ){ echo  $datalit[0][91]; }else {echo 0;} ?>" readonly/>
																													

																				      					</div>
																				      					<div class="col-xs-4">
																				      								<label class="colorLetras" for="inputlg">Otorgadas :</label>
																				      						
																														  	<input type="number" placeholder="cantidad" class="first" id="FIotor" value="<? if($a == 1 ){ echo  $datalit[0][92]; } ?>" readonly/>
																													

																				      					</div>
																				      						<div class="col-xs-4">
																				      								<label class="colorLetras" for="inputlg">Negadas :</label>
																				    
																														  	<input type="number" placeholder="cantidad" class="first" id="FInega" value="<? if($a == 1 ){ echo  $datalit[0][93]; } ?>" readonly/>
																														 

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
																								
																														  	<input type="number" placeholder="cantidad" class="first"  id="legal" value="<? if($a == 1 ){ echo  $datalit[0][94]; } ?>" readonly/>
																													

																				      					</div>
																				      					<div class="col-xs-6">
																				      								<label class="colorLetras" for="inputlg">Ilegal :</label>
																				      						
																														  	<input type="number" placeholder="cantidad" class="first"  id="ilegal" value="<? if($a == 1 ){ echo  $datalit[0][95]; } ?>" readonly/>
																												

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
																														
																														  	<input type="number" placeholder="cantidad" class="first" id="auvinc" value="<? if($a == 1 ){ echo  $datalit[0][4]; } ?>" readonly/>
																														  

																				      					</div>
																				      					<div class="col-xs-4">
																				      								<label class="colorLetras" for="inputlg">Auto de no vinculación :</label>
																				      					
																														  	<input type="number" placeholder="cantidad" class="first" id="aunvinc" value="<? if($a == 1 ){ echo  $datalit[0][5]; } ?>" readonly/>
																												

																				      					</div>
																				      					<div class="col-xs-4">
																				      								<label class="colorLetras" for="inputlg">Mixtos :</label>
																
																														  	<input type="number" placeholder="cantidad" class="first" id="mix" value="<? if($a == 1 ){ echo  $datalit[0][6]; } ?>" readonly/>
																														 

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
																											
																														  	<input type="number" placeholder="cantidad" class="first" id="MCsol" value="<? if($a == 1 ){ echo  $datalit[0][96]; } ?>" readonly/>
																														

																				      					</div>
																				      					<div class="col-xs-4">
																				      								<label class="colorLetras" for="inputlg">Otorgadas :</label>
																			
																														  	<input type="number" placeholder="cantidad" class="first" id="MCotor" value="<? if($a == 1 ){ echo  $datalit[0][98]; } ?>" readonly/>
																													

																				      					</div>
																				      						<div class="col-xs-4">
																				      								<label class="colorLetras" for="inputlg">Negadas :</label>
																		
																														  	<input type="number" placeholder="cantidad" class="first" id="MCnega" value="<? if($a == 1 ){ echo  $datalit[0][97]; } ?>" readonly/>
																								

																				      					</div>

																				      					</div><hr>	

																				      						<div class="row"><div class="col-md-12 col-sm-12 col-xs-12">
																				      								<label class="colorLetras" for="inputlg">Imposición de medidas cautelares :</label>
			    																											<div id="totalJudicializadas"><input class="form-control input-md redondear fdesv" id="IMC" value="<? if($a == 1 ){ echo  $datalit[0][7]; }else {echo 0;} ?>" type="number" readonly=""></div>
																				      					</div></div><br>


																				      						<div class="row"><div class="col-xs-6">
																				      
																				      																								  
																				      							<label class="colorLetras" for="inputlg">Prisión preventiva oficiosa :</label>
																				      			
																														  	<input type="number" placeholder="cantidad" class="first"  id="ppofic" value="<? if($a == 1 ){ echo  $datalit[0][8]; } ?>" readonly/>
																														 
																				      					</div>
																				      						<div class="col-xs-6">
																				      								<label class="colorLetras" for="inputlg">Prisión preventiva justificada :</label>
																				 
																																  	<input type="number" placeholder="cantidad" class="first" id="ppjus" value="<? if($a == 1 ){ echo  $datalit[0][9]; } ?>" readonly/>
																															

																				      					</div></div>
																				      					<div class="row"><div class="col-xs-6">
																				      								<label class="colorLetras" for="inputlg">Presentación periódica ante el juez :</label>
																				      						
																														  	<input type="number" placeholder="cantidad" class="first"  id="ppanju" value="<? if($a == 1 ){ echo  $datalit[0][10]; } ?>" readonly/>
																												

																				      					</div>
																				      						<div class="col-xs-6">
																				      							<label class="colorLetras" for="inputlg">La exhibición de una garantía económica :</label>
																			
																														  	<input type="number" placeholder="cantidad" class="first"  id="exgaeco" value="<? if($a == 1 ){ echo  $datalit[0][11]; } ?>" readonly/>
																														

																				      					</div></div>
																				      					<div class="row"><div class="col-xs-6">
																				      								<label class="colorLetras" for="inputlg">El embargo de bienes :</label>
																				     
																														  	<input type="number" placeholder="cantidad" class="first"  id="emvien" value="<? if($a == 1 ){ echo  $datalit[0][12]; } ?>" readonly/>
																							
																														  <br>
																				      					</div>
																				      					<div class="col-xs-6">
																				      								<label class="colorLetras" for="inputlg">La inmovilización de cuentas y demás valores :</label>
																				      				
																														  	<input type="number" placeholder="cantidad" class="first"  id="incuval" value="<? if($a == 1 ){ echo  $datalit[0][13]; } ?>" readonly/>
																													
																														  <br>
																				      					</div></div>
																				      					<div class="col-xs-12">
																				      								<label class="colorLetras" for="inputlg">La prohibición de salir sin autorización que fije el juez :</label>																				      							
																														  	<input type="number" placeholder="cantidad" class="first"  id="pssafj" value="<? if($a == 1 ){ echo  $datalit[0][14]; } ?>" readonly/>																											
																														  <br>
																				      					</div>
																				      					<div class="col-xs-12">
																				      								<label class="colorLetras" for="inputlg">El sometimiento al cuidado o vigilancia o institución determinada :</label>																				      		
																														  	<input type="number" placeholder="cantidad" class="first"  id="scviind" value="<? if($a == 1 ){ echo  $datalit[0][15]; } ?>" readonly/>																													
																														  <br>
																				      					</div>
																				      					<div class="col-xs-12">
																				      								<label class="colorLetras" for="inputlg">La prohibición de concurrir a determinadas reuniones o ciertos lugares :</label>
																				      		
																														  	<input type="number" placeholder="cantidad" class="first"  id="pcdrclug" value="<? if($a == 1 ){ echo  $datalit[0][16]; } ?>" readonly/>
																											
																														  <br>
																				      					</div>
																				      					<div class="col-xs-12">
																				      								<label class="colorLetras" for="inputlg">La prohibición de convivir o comunicarse con determinadas personas :</label>
																				
																														  	<input type="number" placeholder="cantidad" class="first" id="pccdper" value="<? if($a == 1 ){ echo  $datalit[0][17]; } ?>" readonly/>
																														  
																														  <br>
																				      					</div>
																				      					<div class="col-xs-12">
																				      								<label class="colorLetras" for="inputlg">La separación inmediata del domicilio :</label>
																				  
																														  	<input type="number" placeholder="cantidad" class="first"  id="sindom" value="<? if($a == 1 ){ echo  $datalit[0][18]; } ?>" readonly/>
																														 
																														  <br>
																				      					</div>
																				      					<div class="col-xs-12">
																				      								<label class="colorLetras" for="inputlg">La suspensión temporal en el ejercicio del cargo :</label>
																				    
																														  	<input type="number" placeholder="cantidad" class="first"  id="steeca" value="<? if($a == 1 ){ echo  $datalit[0][19]; } ?>" readonly/>
																														  
																														  <br>
																				      					</div>
																				      					<div class="col-xs-12">
																				      								<label class="colorLetras" for="inputlg">La suspensión temporal en actividad profesional o laboral :</label>
																				      					
																														  	<input type="number" placeholder="cantidad" class="first"  id="steapl" value="<? if($a == 1 ){ echo  $datalit[0][20]; } ?>" readonly/>
																														 
																														  <br>
																				      					</div>
																				      					<div class="col-xs-12">
																				      								<label class="colorLetras" for="inputlg">La colocación de localizadores electrónicos :</label>
																				      					
																														  	<input type="number" placeholder="cantidad" class="first" id="coloele" value="<? if($a == 1 ){ echo  $datalit[0][21]; } ?>" readonly/>
																														
																														  <br>
																				      					</div>
																				      					<div class="col-xs-12">
																				      								<label class="colorLetras" for="inputlg">El resguardo en su propio domicilio con las modalidades que el juez disponga :</label>
																				     
																														  	<input type="number" placeholder="cantidad" class="first"  id="rpdmjd" value="<? if($a == 1 ){ echo  $datalit[0][22]; } ?>" readonly/>
																														  
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
																				      					<div class="col-xs-12">
																				      						<label class="colorLetras" for="inputlg">Prescripción de la acción penal :</label>
																														
																														  	<input type="number" placeholder="cantidad" class="first"  id="SDpapen"  value="<? if($a == 1 ){ echo  $datalit[0][24]; } ?>" readonly/>
																														 
																				      					</div>
																				      </div>
																						
										
																											         <div class="row">
																													      					<div class="col-xs-12">
																																										<label class="colorLetras" for="inputlg">Por mecanismos alternativos :</label>	
																																							  	<input type="number" placeholder="" disabled="" class="first" id="MA" value="<? if($a == 1 ){ echo  $datalit[0][25]; }else {echo 0;} ?>"/>
																																							  	
																																			
																													      					</div>
																													      </div><br>
																											      <div class="row">
																											      					<div class="col-xs-6">

																											      						<label class="colorLetras" for="inputlg">Acuerdo reparatorio : :</label>
																								
																																					  	<input type="number" placeholder="cantidad" class="first" id="acrep" value="<? if($a == 1 ){ echo  $datalit[0][26]; } ?>" readonly/>
																																					  

																											      					</div>
																											      					<div class="col-xs-6">
																											      								<label class="colorLetras" for="inputlg">Suspensión condicional del proceso :</label>
																											      		
																																					  	<input type="number" placeholder="cantidad" class="first"  id="scpro" value="<? if($a == 1 ){ echo  $datalit[0][27]; } ?>" readonly/>
																																					  	

																											      					</div>
																											      					

																											      </div>
																											      <div class="row"><div class="col-xs-12">
																											      								<label class="colorLetras" for="inputlg">Criterio de oportunidad :</label>
																											  
																																					  	<input type="number" placeholder="cantidad" class="first" id="criopor" value="<? if($a == 1 ){ echo  $datalit[0][28]; } ?>" readonly/>
																																					  

																											      					</div></div>
																											    	

																			





																				     
																				      <div class="row">
																				    
																				      					<div class="col-xs-6">
																				      						<label class="colorLetras" for="inputlg">Terminación anticipada :</label>
																														
																														  	<input type="number" placeholder="cantidad" class="first"  id="termant" value="<? if($a == 1 ){ echo  $datalit[0][29]; } ?>" readonly/>
																														 
																				      					</div>
																				      
																				      					<div class="col-xs-6">
																				      						<label class="colorLetras" for="inputlg">Procedimientos abreviados :</label>
													
																														  	<input type="number" placeholder="cantidad" class="first" id="proabre" value="<? if($a == 1 ){ echo  $datalit[0][30]; } ?>" readonly/>
																														  	
																				      					</div>
																				      </div>
																				      	 <div class="row">
																				      	<div class="col-xs-6">
																				      	<hr>
																				      							<label class="colorLetras" for="inputlg">Acumulación :</label>
																				      						
																														  	<input type="number" placeholder="cantidad" class="first" id="acu" value="<? if($a == 1 ){ echo  $datalit[0][31]; } ?>" readonly/>
																														  
																				      					</div>
																				      					<div class="col-xs-6">
																				      						<hr>
																				      							<label class="colorLetras" for="inputlg">Citaciones :</label>
																				      				
																														  	<input type="number" placeholder="cantidad" class="first" id="citac" value="<? if($a == 1 ){ echo  $datalit[0][32]; } ?>" readonly/>
																											
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
																											
																																					  	<input type="number" placeholder="cantidad" class="first" id="Cconc"  value="<? if($a == 1 ){ echo  $datalit[0][34]; } ?>" readonly/>
																																					  

																											      					</div>
																											      					<div class="col-xs-6">
																											      								<label class="colorLetras" for="inputlg">Cateos negados :</label>
																											
																																					  	<input type="number" placeholder="cantidad" class="first" id="Cnega"  value="<? if($a == 1 ){ echo  $datalit[0][35]; } ?>" readonly/>
																																					  

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
																											      							
																																					  	<input type="number" placeholder="cantidad" class="first" id="ONapre" value="<? if($a == 1 ){ echo  $datalit[0][37]; } ?>" readonly/>
																																		

																											      					</div>
																											      					<div class="col-xs-6">
																											      								<label class="colorLetras" for="inputlg">Comparecencia :</label>
																									
																																					  	<input type="number" placeholder="cantidad" class="first" id="ONcomp" value="<? if($a == 1 ){ echo  $datalit[0][38]; } ?>" readonly/>
																																					 

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
																											     
																																					  	<input type="number" placeholder="cantidad" class="first" id="DRppa"  value="<? if($a == 1 ){ echo  $datalit[0][40]; } ?>" readonly/>
																																					 

																											      					</div>
																											      					<div class="col-xs-4">
																											      								<label class="colorLetras" for="inputlg">Por parte del defensor :</label>
																											      				
																																					  	<input type="number" placeholder="cantidad" class="first" id="DRppd"  value="<? if($a == 1 ){ echo  $datalit[0][41]; } ?>" readonly/>
																																				

																											      					</div>
																											      					<div class="col-xs-4">
																											      								<label class="colorLetras" for="inputlg">Por parte del ministerio publico  :</label>
																											      				
																																					  	<input type="number" placeholder="cantidad" class="first" id="DRppmp"  value="<? if($a == 1 ){ echo  $datalit[0][42]; } ?>" readonly/>
																																				

																											      					</div>
																											      					

																											      </div>
																											    	

																											    </div>
																											  </div>

																											  	<div class="row"><div class="col-xs-12">
																				      							<label class="colorLetras" for="inputlg">Apelaciones no admitidas :</label>
																				     
																														  	<input type="number" placeholder="cantidad" class="first" id="apenoadmi" value="<? if($a == 1 ){ echo  $datalit[0][43]; } ?>" readonly/>
																												
																				      					</div></div><br>

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
																											
																																					  	<input type="number" placeholder="cantidad" class="first" id="SDIrev" value="<? if($a == 1 ){ echo  $datalit[0][45]; } ?>" readonly/>
																																				

																											      					</div>
																											      					<div class="col-xs-4">
																											      								<label class="colorLetras" for="inputlg">Modifica :</label>
																											      							
																																					  	<input type="number" placeholder="cantidad" class="first" id="SDImod" value="<? if($a == 1 ){ echo  $datalit[0][46]; } ?>" readonly/>
																																					
																											      					</div>
																											      					<div class="col-xs-4">
																											      								<label class="colorLetras" for="inputlg">Confirma  :</label>
																											      				
																																					  	<input type="number" placeholder="cantidad" class="first" id="SDIconf" value="<? if($a == 1 ){ echo  $datalit[0][47]; } ?>" readonly/>
																																				
																											      					</div>
																											      					

																											      </div>
																											    	

																											    </div>
																											  </div>
																				      					
																				      			
																				      					<div class="row"><div class="col-xs-12">
																				      							<label class="colorLetras" for="inputlg">Reposición del procedimiento :</label>
																				  
																														  	<input type="number" placeholder="cantidad" class="first" id="Reproc" value="<? if($a == 1 ){ echo  $datalit[0][48]; } ?>" readonly/>
																														 
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
																																		      						
																																												  	<input type="number" placeholder="cantidad" class="first" id="MJGorap"  value="<? if($a == 1 ){ echo  $datalit[0][51]; } ?>" readonly/>
																																												
																																		      					</div>
																																		      					<div class="col-xs-6">
																																		      								<label class="colorLetras" for="inputlg">Ordenes de comparecencia :</label>
																																		
																																												  	<input type="number" placeholder="cantidad" class="first" id="MJGorcomp"  value="<? if($a == 1 ){ echo  $datalit[0][52]; } ?>" readonly/>
																																												 

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
																													
																																												  	<input type="number" placeholder="cantidad" class="first" id="MJCorapre"  value="<? if($a == 1 ){ echo  $datalit[0][54]; } ?>" readonly/>
																																												

																																		      					</div>
																																		      					<div class="col-xs-6">
																																		      								<label class="colorLetras" for="inputlg">Ordenes de comparecencia :</label>
																																		      						
																																												  	<input type="number" placeholder="cantidad" class="first" id="MJCordcomp"  value="<? if($a == 1 ){ echo  $datalit[0][55]; } ?>" readonly/>
																																										

																																		      					</div>
																																		      					

																																		      </div>
																																		    	

																																		    </div>
																																		  </div>


																				      								

																				      					<div class="row"><div class="col-xs-12">
																				      							<label class="colorLetras" for="inputlg">Total de audiencias :</label>
																	 
																														  	<input type="number" placeholder="cantidad" class="first" id="totAudiencias" value="<? if($a == 1 ){ echo  $datalit[0][56]; } ?>" readonly/>
																														 
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
																																		      							
																																												  	<input type="number" placeholder="cantidad" class="first" id="ACPREaie"  value="<? if($a == 1 ){ echo  $datalit[0][57]; } ?>" readonly/>
																																											

																																		      					</div>
																																		      					<div class="col-xs-6">
																																		      								<label class="colorLetras" for="inputlg">Audiencia intermedia oral :</label>
																																		    
																																												  	<input type="number" placeholder="cantidad" class="first" id="ACPREaio"  value="<? if($a == 1 ){ echo  $datalit[0][58]; } ?>" readonly/>
																																												

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
																																		      				
																																												  	<input type="number" placeholder="cantidad" class="first" id="SOALscp" value="<? if($a == 1 ){ echo  $datalit[0][60]; } ?>" readonly/>
																																										

																																		      					</div>
																																		      					<div class="col-xs-6">
																																		      								<label class="colorLetras" for="inputlg">Acuerdo reparatorio :</label>
																						
																																												  	<input type="number" placeholder="cantidad" class="first" id="SOALarep" value="<? if($a == 1 ){ echo  $datalit[0][61]; } ?>" readonly/>
																																											

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
																																		      			
																																												  	<input type="number" placeholder="cantidad" class="first" id="SENcon"  value="<? if($a == 1 ){ echo  $datalit[0][63]; } ?>" readonly/>
																																												  

																																		      					</div>
																																		      					<div class="col-xs-4">
																																		      								<label class="colorLetras" for="inputlg">Absolutorias :</label>
																																		      					
																																												  	<input type="number" placeholder="cantidad" class="first"  id="SENabsol"  value="<? if($a == 1 ){ echo  $datalit[0][64]; } ?>" readonly/>
																																											

																																		      					</div>
																																		      					<div class="col-xs-4">
																																		      								<label class="colorLetras" for="inputlg">Mixtas :</label>
																																		      							
																																												  	<input type="number" placeholder="cantidad" class="first" id="SENmixc" 	value="<? if($a == 1 ){ echo  $datalit[0][65]; } ?>" readonly/>
																																												 
																																		      					</div>																																		      					

																																		      </div>
																																		    	 <div class="row">																																		      				
																																		      					
																																		      					<div class="col-xs-6">
																																		      								<label class="colorLetras" for="inputlg">Se condena reparación del daños :</label>
																																		      
																																												  	<input type="number" placeholder="cantidad" class="first" id="SENsreda"  value="<? if($a == 1 ){ echo  $datalit[0][66]; } ?>" readonly/>
																																											

																																		      					</div>
																																		      					<div class="col-xs-6">
																																		      								<label class="colorLetras" for="inputlg">No se condena reparación del daño :</label>
																																		      							
																																												  	<input type="number" placeholder="cantidad" class="first" id="SENnocreda" value="<? if($a == 1 ){ echo  $datalit[0][67]; } ?>" readonly/>
																																										

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
																																		      				
																																												  	<input type="number" placeholder="cantidad" class="first" id="INCOMdecre"  value="<? if($a == 1 ){ echo  $datalit[0][69]; } ?>" readonly/>
																																												 

																																		      					</div>
																																		      					<div class="col-xs-6">
																																		      								<label class="colorLetras" for="inputlg">Admitidas :</label>
																																		      			
																																												  	<input type="number" placeholder="cantidad" class="first" id="INCOMadmi"  value="<? if($a == 1 ){ echo  $datalit[0][70]; } ?>" readonly/>
																																												 

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
																																		    
																																												  	<input type="number" placeholder="cantidad" class="first" id="ARJnap"  value="<? if($a == 1 ){ echo  $datalit[0][72]; } ?>" readonly/>
																																										

																																		      					</div>
																																		      					<div class="col-xs-6">
																																		      								<label class="colorLetras" for="inputlg">Negar acuerdo reparatorio :</label>
																																		      							
																																												  	<input type="number" placeholder="cantidad" class="first" id="ARJnar"  value="<? if($a == 1 ){ echo  $datalit[0][73]; } ?>" readonly/>
																																												

																																		      					</div>
																																		      					

																																		      </div>
																																		       <div class="row">
																																		      				
																																		      					<div class="col-xs-6">
																																		      								<label class="colorLetras" for="inputlg">Negar o cancelar orden de aprehensión :</label>
																																		      			
																																												  	<input type="number" placeholder="cantidad" class="first" id="ARJncoap" value="<? if($a == 1 ){ echo  $datalit[0][74]; } ?>" readonly/>
																																												  
																																		      					</div>

																																		      					<div class="col-xs-6">
																																		      								<label class="colorLetras" for="inputlg">Negar orden de cateo :</label>
																																		 
																																												  	<input type="number" placeholder="cantidad" class="first" id="ARJnoc"  value="<? if($a == 1 ){ echo  $datalit[0][75]; } ?>" readonly/>
																																												
																																		      					</div>					
																																		      </div>
																																		      <div class="row">
																																		      				
																																		      					<div class="col-xs-6">
																																		      								<label class="colorLetras" for="inputlg">Providencias precautorias o medida cautelar :</label>
																																		      				
																																												  	<input type="number" placeholder="cantidad" class="first" id="ARJppmc"  value="<? if($a == 1 ){ echo  $datalit[0][76]; } ?>" readonly/>
																																												

																																		      					</div>
																																		      					<div class="col-xs-6">
																																		      								<label class="colorLetras" for="inputlg">Las que pongan termino al procedimiento o lo suspendan:</label>
																																		      							
																																												  	<input type="number" placeholder="cantidad" class="first" id="ARJtps" value="<? if($a == 1 ){ echo  $datalit[0][77]; } ?>" readonly/>
																																												 
																																		      					</div>					
																																		      </div>
																																		      <div class="row">
																																		      				
																																		      					<div class="col-xs-6">
																																		      								<label class="colorLetras" for="inputlg">auto que resuelve la vinculación a proceso :</label>
																																		      				
																																												  	<input type="number" placeholder="cantidad" class="first" id="ARJrvp"  value="<? if($a == 1 ){ echo  $datalit[0][78]; } ?>" readonly/>
																																												 

																																		      					</div>
																																		      					<div class="col-xs-6">
																																		      								<label class="colorLetras" for="inputlg">Las que concedan, revoquen o nieguen la suspensión condicional del proceso:</label>
																																		      					
																																												  	<input type="number" placeholder="cantidad" class="first" id="ARJrnscp" value="<? if($a == 1 ){ echo  $datalit[0][79]; } ?>" readonly/>
																																												 
																																		      					</div>					
																																		      </div>
																																		      <div class="row">
																																		      				
																																		      					<div class="col-xs-6">
																																		      								<label class="colorLetras" for="inputlg">Negativa de abrir el procedimiento abreviado :</label>
																																		      							
																																												  	<input type="number" placeholder="cantidad" class="first" id="ARJnapa"  value="<? if($a == 1 ){ echo  $datalit[0][80]; } ?>" readonly/>
																																									

																																		      					</div>
																																		      					<div class="col-xs-6">
																																		      								<label class="colorLetras" for="inputlg">Sentencia definitiva en el procedimiento abreviado:</label>
																																		      	
																																												  	<input type="number" placeholder="cantidad" class="first" id="ARJsdpa" value="<? if($a == 1 ){ echo  $datalit[0][81]; } ?>" readonly/>
																																												 
																																		      					</div>					
																																		      </div>
																																		      <div class="row">
																																		      				
																																		      					<div class="col-xs-12">
																																		      								<label class="colorLetras" for="inputlg">Excluir algún medio de prueba :</label>
																																		      						
																																												  	<input type="number" placeholder="cantidad" class="first" id="ARJemp"  value="<? if($a == 1 ){ echo  $datalit[0][82]; } ?>" readonly/>
																																												
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
																																		  
																																												  	<input type="number" placeholder="cantidad" class="first"  id="ARTEdap"  value="<? if($a == 1 ){ echo  $datalit[0][84]; } ?>" readonly/>
																																												

																																		      					</div>
																																		      					<div class="col-xs-6">
																																		      								<label class="colorLetras" for="inputlg">Sentencia definitiva :</label>
																																		      				
																																												  	<input type="number" placeholder="cantidad" class="first" id="ARTEsd"  value="<? if($a == 1 ){ echo  $datalit[0][85]; } ?>" readonly/>
																																											

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
																															
																																												  	<input type="number" placeholder="cantidad" class="first"  id="DSEDrfmp"  value="<? if($a == 1 ){ echo  $datalit[0][87]; } ?>" readonly/>
																																												

																																		      					</div>
																																		      					<div class="col-xs-4">
																																		      								<label class="colorLetras" for="inputlg">Modificaciones favorables al Ministerio Publico :</label>
																																		      		
																																												  	<input type="number" placeholder="cantidad" class="first"  id="DSEDmfmp"  value="<? if($a == 1 ){ echo  $datalit[0][88]; } ?>" readonly/>
																																												  

																																		      					</div>
																																		      					<div class="col-xs-4">
																																		      								<label class="colorLetras" for="inputlg">Confirmaciones favorables al Ministerio Publico :</label>
																																		      		
																																												  	<input type="number" placeholder="cantidad" class="first"  id="DSEDcfmp"  value="<? if($a == 1 ){ echo  $datalit[0][89]; } ?>" readonly/>
																																										

																																		      					</div>
																																		      					

																																		      </div>
																																		    	

																																		    </div>
																																		  </div>								

																				      					<div class="row"><div class="col-xs-12">
																				      							<label class="colorLetras" for="inputlg"> Por cambio de situación jurídica declarados sin materia :</label>
																				     
																														  	<input type="number" placeholder="cantidad" class="first"  id="csjdsm" value="<? if($a == 1 ){ echo  $datalit[0][90]; } ?>" readonly/>
																											
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

												<div class="col-xs-12 col-sm-12 col-md-12"><center><button style="width: 85%;" type="button" class="btn btn-default redondear" data-dismiss="modal">Salir</button></center></div>
												  
										</div> 

										<br>

										<div id="respuestaGuardado"></div>


