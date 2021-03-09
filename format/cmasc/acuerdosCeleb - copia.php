
	<?php
	session_start();
	include ("../../Conexiones/Conexion.php");
	include("../../funciones.php");	


 $idUsuario = $_SESSION['useridIE'];

if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }
if (isset($_POST["anio"])){ $anio = $_POST["anio"]; }
if (isset($_POST["mes"])){ $mes = $_POST["mes"]; }


 $query = "SELECT idCmascRecibidas, fechaCaptura, existenciaAnterior, atOrdinario, atReproceso, uiOrdinario, uiReproceso, daiOrdinario, daiReproceso, dvfgOrdinario, dvfgReproceso, aicOrdinario, aicReproceso, totalRecibidas, tsrProcedentes, tsrDesechadas, tsaVhombres, tsaVmujeres, tsaIhombres, tsaImujeres, invitacionesRecibidas, tramite  FROM cmascRecibidas WHERE idEnlace = $idEnlace AND mes = $mes AND anio = $anio";
    

      $stmt = sqlsrv_query(  $conn, $query,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
      $row_count = sqlsrv_num_rows( $stmt );

      if($row_count > 0){ $ex = 1; }else{	$ex = 0; }


	?>									
   <div class="tab">

<button class="tablinks" onclick=""><label class="titleMenuTop">Mediación</label></button>
<button class="tablinks" onclick=""><label class="titleMenuTop">Conciliación</label></button>
<button class="tablinks" onclick=""><label class="titleMenuTop">Junta Restaurativa</label></button>

</div>		
									<div id="contentTabs" class="">     


									  	<!-- AQUI INICIA EL CODIGO PARA AGREGAR LA PRIMER ESTAÑA ( RECIBIDAS POR OTRA UNIDAD ) -->	
									  		<div class="row">
									  				


									  				<div class="col-xs-12 col-sm-12  col-md-4">
									  					<div class="">	

									  					<div class="mediacion"><center><h3 class="tittleAcuerd">Mediación</center></h3></center></div>

									  									  								

									  											<div class="panel panel-default fd1" style="">
																							      										 <div class="panel-body">
																																					      <h5 class="text-on-pannel"><strong> Con Acuerdo Inmediato </strong></h5>

																				    																				 <div class="row">
																																								      	
																																								      					<div class="col-xs-4">
																																								      							<label class="colorLetras" for="inputlg">Cumplido :</label>
																							    										<input class="form-control input-md redondear inputext" onblur="sumMediac()" id="maiCumplido" type="number" <? if($ex==0){ echo "readonly"; } ?>>
																																								      					</div>
																																								      					<div class="col-xs-4">
																																								      								<label class="colorLetras" for="inputlg">No Cumplido :</label>
																							    																											<input class="form-control input-md redondear inputext" onblur="sumMediac()" id="maiNoCumplido" type="number" <? if($ex==0){ echo "readonly"; } ?>>
																																								      					</div>
																																								      					<div class="col-xs-4">
																																								      								<label class="colorLetras" for="inputlg">Preeliminar a Convenio :</label>
																							    																											<input class="form-control input-md redondear inputext" onblur="sumMediac()" id="maiPconvenio" type="number" <? if($ex==0){ echo "readonly"; } ?>>
																																								      					</div>

																																								      </div>
																																					    </div>
																																					  </div>  

																																					  	<div class="panel panel-default fd1" style="">
																							      										 <div class="panel-body">
																																					      <h5 class="text-on-pannel"><strong> Con Acuerdo Diferido </strong></h5>

																				    																				 <div class="row">
																																								      	
																																								      					<div class="col-xs-4">
																																								      							<label class="colorLetras" for="inputlg">Cumplido :</label>
																							    																											<input class="form-control input-md redondear inputext" onblur="sumMediac()" id="madCumplido" type="number" <? if($ex==0){ echo "readonly"; } ?>>
																																								      					</div>
																																								      					<div class="col-xs-4">
																																								      								<label class="colorLetras" for="inputlg">No Cumplido :</label>
																							    																											<input class="form-control input-md redondear inputext" onblur="sumMediac()" id="madNoCumplido" type="number" <? if($ex==0){ echo "readonly"; } ?>>
																																								      					</div>
																																								      					<div class="col-xs-4">
																																								      								<label class="colorLetras" for="inputlg">En Tramite :</label>
																							    																											<input class="form-control input-md redondear inputext" onblur="sumMediac()" id="madTramite" type="number" <? if($ex==0){ echo "readonly"; } ?>>
																																								      					</div>

																																								      </div>
																																					    </div>
																																					  </div>  

																																				
																														

																																					  	<div class="panel panel-default fd1" style="">
																							      										 <div class="panel-body">
																																					      <h5 class="text-on-pannel"><strong> Sin Acuerdo </strong></h5><br>

																																					      		 <div class="panel-body">
																																					      <h5 class="text-on-pannel"><strong> No aceptación del convenio </strong></h5>

																				    																				 <div class="row">
																																								      	
																																								      					<div class="col-xs-6">
																																								      							<label class="colorLetras" for="inputlg">Victima / Ofendido :</label>
																							    																											<input class="form-control input-md redondear inputext" onblur="sumMediac()" id="msaNoaConveVictima" type="number" <? if($ex==0){ echo "readonly"; } ?>>
																																								      					</div>
																																								      					<div class="col-xs-6">
																																								      								<label class="colorLetras" for="inputlg">Imputado :</label>
																							    																											<input class="form-control input-md redondear inputext" onblur="sumMediac()" id="msaNoaConceImputado" type="number" <? if($ex==0){ echo "readonly"; } ?>>
																																								      					</div>

																																								      </div>
																																					    </div>

																																					    <div class="panel panel-default fd1" style="">
																	    <div class="panel-body">
																	      <h5 class="text-on-pannel"><strong> Por decisión de las partes </strong></h5>
    																				<input class="form-control input-md redondear inputext" id="msaDecsiPartes" type="number"  <? if($ex==0){ echo "readonly"; } ?>>
																	    </div>
																	</div><br>

																	 <div class="panel-body">
																																					      <h5 class="text-on-pannel"><strong> Por inasistencia injustificada de las partes </strong></h5>

																				    																				 <div class="row">
																																								      	
																																								      					<div class="col-xs-6">
																																								      							<label class="colorLetras" for="inputlg">Victima / Ofendido :</label>
																							    																											<input class="form-control input-md redondear inputext" onblur="sumMediac()" id="msaInasInparVictima" type="number" <? if($ex==0){ echo "readonly"; } ?>>
																																								      					</div>
																																								      					<div class="col-xs-6">
																																								      								<label class="colorLetras" for="inputlg">Imputado :</label>
																							    																											<input class="form-control input-md redondear inputext" onblur="sumMediac()" id="msaInasInparImputado" type="number" <? if($ex==0){ echo "readonly"; } ?>>
																																								      					</div>

																																								      </div>
																																					    </div><br>

																																					    				 <div class="panel-body">
																																					      <h5 class="text-on-pannel"><strong> Por negativa de las partes a acordar </strong></h5>

																				    																				 <div class="row">
																																								      	
																																								      					<div class="col-xs-6">
																																								      							<label class="colorLetras" for="inputlg">Victima / Ofendido :</label>
																							    																											<input class="form-control input-md redondear inputext" onblur="sumMediac()" id="msaNegparVictima" type="number" <? if($ex==0){ echo "readonly"; } ?>>
																																								      					</div>
																																								      					<div class="col-xs-6">
																																								      								<label class="colorLetras" for="inputlg">Imputado :</label>
																							    																											<input class="form-control input-md redondear inputext" onblur="sumMediac()" id="msaNegparImputado" type="number" <? if($ex==0){ echo "readonly"; } ?>>
																																								      					</div>

																																								      </div>
																																					    </div>

																																					    			<div class="panel panel-default fd1" style="">
																	    <div class="panel-body">
																	      <h5 class="text-on-pannel"><strong> Total Mediación : </strong></h5>
    																				<input class="form-control input-md redondear inputext" id="totalMediacion" readonly type="number" value="0" >
																	    </div>
																	</div>

																																					    </div>

																																					    		 

																																					  </div>  


									  					</div>		

									  				</div>
									  				<div class="col-xs-12 col-sm-12  col-md-4">
									  					
									  							<div class="">
																		<div class="mediacion"><center><h3 class="tittleAcuerd">Conciliación</center></h3></center></div>

																			<div class="panel panel-default fd1" style="">
																							      										 <div class="panel-body">
																																					      <h5 class="text-on-pannel"><strong> Con Acuerdo Inmediato </strong></h5>

																				    																				 <div class="row">
																																								      	
																																								      					<div class="col-xs-4">
																																								      							<label class="colorLetras" for="inputlg">Cumplido :</label>
																							    																											<input class="form-control input-md redondear inputext" onblur="sumConcil()" id="caiCumplido" type="number" <? if($ex==0){ echo "readonly"; } ?>>
																																								      					</div>
																																								      					<div class="col-xs-4">
																																								      								<label class="colorLetras" for="inputlg">No Cumplido :</label>
																							    																											<input class="form-control input-md redondear inputext" onblur="sumConcil()" id="caiNoCumplido" type="number" <? if($ex==0){ echo "readonly"; } ?>>
																																								      					</div>
																																								      					<div class="col-xs-4">
																																								      								<label class="colorLetras" for="inputlg">Preeliminar a Convenio :</label>
																							    																											<input class="form-control input-md redondear inputext" onblur="sumConcil()" id="caiPconvenio" type="number" <? if($ex==0){ echo "readonly"; } ?>>
																																								      					</div>

																																								      </div>
																																					    </div>
																																					  </div>  

																																					 	<div class="panel panel-default fd1" style="">
																							      										 <div class="panel-body">
																																					      <h5 class="text-on-pannel"><strong> Con Acuerdo Diferido </strong></h5>

																				    																				 <div class="row">
																																								      	
																																								      					<div class="col-xs-4">
																																								      							<label class="colorLetras" for="inputlg">Cumplido :</label>
																							    																											<input class="form-control input-md redondear inputext" onblur="sumConcil()" id="cadCumplido" type="number" <? if($ex==0){ echo "readonly"; } ?>>
																																								      					</div>
																																								      					<div class="col-xs-4">
																																								      								<label class="colorLetras" for="inputlg">No Cumplido :</label>
																							    																											<input class="form-control input-md redondear inputext" onblur="sumConcil()" id="cadNoCumplido" type="number" <? if($ex==0){ echo "readonly"; } ?>>
																																								      					</div>
																																								      					<div class="col-xs-4">
																																								      								<label class="colorLetras" for="inputlg">En Tramite :</label>
																							    																											<input class="form-control input-md redondear inputext" onblur="sumConcil()" id="cadTramite" type="number" <? if($ex==0){ echo "readonly"; } ?>>
																																								      					</div>

																																								      </div>
																																					    </div>
																																					  </div>  
																																					  
																																					  				 					  	<div class="panel panel-default fd1" style="">
																							      										 <div class="panel-body">
																																					      <h5 class="text-on-pannel"><strong> Sin Acuerdo </strong></h5><br>

																																					      

																																					    <div class="panel panel-default fd1" style="">
																	    <div class="panel-body">
																	      <h5 class="text-on-pannel"><strong> Por decisión de las partes </strong></h5>
    																				<input class="form-control input-md redondear inputext" id="csaDecsiPartes" onblur="sumConcil()" type="number" value="<? echo $tramite; ?>" <? if($ex==0){ echo "readonly"; } ?>>
																	    </div>
																	</div>

																	   <div class="panel panel-default fd1" style="">
																	    <div class="panel-body">
																	      <h5 class="text-on-pannel"><strong> Por inasistencia injustificada de las partes </strong></h5>
																	      <label class="colorLetras" for="inputlg">Inasistencia de ambas partes por alguna sesión :</label>
    																				<input class="form-control input-md redondear inputext" id="csaInasInparAmbas" onblur="sumConcil()" type="number"  <? if($ex==0){ echo "readonly"; } ?>>
    																				<br>

    																					<div class="panel panel-default fd1" style="">
																							      										 <div class="panel-body">
																																					      <h5 class="text-on-pannel"><strong> Por dos inasistencias injustificadas de una de las partes </strong></h5>

																				    																				 <div class="row">
																																								      	
																																								      					<div class="col-xs-6">
																																								      							<label class="colorLetras" for="inputlg">Victima / Ofendido :</label>
																							    																											<input class="form-control input-md redondear inputext" onblur="sumConcil()" id="csaDosInasIn1parVictima" type="number" <? if($ex==0){ echo "readonly"; } ?>>
																																								      					</div>
																																								      					<div class="col-xs-6">
																																								      								<label class="colorLetras" for="inputlg">Imputado :</label>
																							    																											<input class="form-control input-md redondear inputext" onblur="sumConcil()" id="csaDosInasIn1parImputado" type="number" <? if($ex==0){ echo "readonly"; } ?>>
																																								      					</div>

																																								      </div>
																																					    </div>
																																					  </div>  


																	    </div>
																	</div>

																		<div class="panel panel-default fd1" style="">	
																							      										 <div class="panel-body">
																																					      <h5 class="text-on-pannel"><strong> Por negativa de las partes a acordar </strong></h5>

																				    																				 <div class="row">
																																								      	
																																								      					<div class="col-xs-6">
																																								      							<label class="colorLetras" for="inputlg">Victima / Ofendido :</label>
																							    																											<input class="form-control input-md redondear inputext" onblur="sumConcil()" id="csaNegparVictima" type="number" <? if($ex==0){ echo "readonly"; } ?>>
																																								      					</div>
																																								      					<div class="col-xs-6">
																																								      								<label class="colorLetras" for="inputlg">Imputado :</label>
																							    																											<input class="form-control input-md redondear inputext" onblur="sumConcil()" id="csaNegparImputado" type="number" <? if($ex==0){ echo "readonly"; } ?>>
																																								      					</div>

																																								      </div>
																																					    </div>
																																					  </div>  


																																					  	<div class="panel panel-default fd1" style="">
																	    <div class="panel-body">
																	      <h5 class="text-on-pannel"><strong> Total Conciliación : </strong></h5>
    																				<input class="form-control input-md redondear inputext" id="totalConciliacion" readonly type="number" value="0" <? if($ex==0){ echo "readonly"; } ?>>
																	    </div>
																	</div>      

																																					    			

																																					    </div>
																																					  </div>  


																		 
<br>

									  		</div>

									 

									  				</div>
               <div class="col-xs-12 col-sm-12  col-md-4">
									  					<div class="">	

									  					<div class="mediacion"><center><h3 class="tittleAcuerd">Junta Restaurativa</center></h3></center></div>

									  									  								

									  											<div class="panel panel-default fd1" style="">
																							      										 <div class="panel-body">
																																					      <h5 class="text-on-pannel"><strong> Con Acuerdo Inmediato </strong></h5>

																				    																				 <div class="row">
																																								      	
																																								      					<div class="col-xs-4">
																																								      							<label class="colorLetras" for="inputlg">Cumplido :</label>
																							    										<input class="form-control input-md redondear inputext" onblur="sumMediac()" id="maiCumplido" type="number" <? if($ex==0){ echo "readonly"; } ?>>
																																								      					</div>
																																								      					<div class="col-xs-4">
																																								      								<label class="colorLetras" for="inputlg">No Cumplido :</label>
																							    																											<input class="form-control input-md redondear inputext" onblur="sumMediac()" id="maiNoCumplido" type="number" <? if($ex==0){ echo "readonly"; } ?>>
																																								      					</div>
																																								      					<div class="col-xs-4">
																																								      								<label class="colorLetras" for="inputlg">Preeliminar a Convenio :</label>
																							    																											<input class="form-control input-md redondear inputext" onblur="sumMediac()" id="maiPconvenio" type="number" <? if($ex==0){ echo "readonly"; } ?>>
																																								      					</div>

																																								      </div>
																																					    </div>
																																					  </div>  

																																					  	<div class="panel panel-default fd1" style="">
																							      										 <div class="panel-body">
																																					      <h5 class="text-on-pannel"><strong> Con Acuerdo Diferido </strong></h5>

																				    																				 <div class="row">
																																								      	
																																								      					<div class="col-xs-4">
																																								      							<label class="colorLetras" for="inputlg">Cumplido :</label>
																							    																											<input class="form-control input-md redondear inputext" onblur="sumMediac()" id="madCumplido" type="number" <? if($ex==0){ echo "readonly"; } ?>>
																																								      					</div>
																																								      					<div class="col-xs-4">
																																								      								<label class="colorLetras" for="inputlg">No Cumplido :</label>
																							    																											<input class="form-control input-md redondear inputext" onblur="sumMediac()" id="madNoCumplido" type="number" <? if($ex==0){ echo "readonly"; } ?>>
																																								      					</div>
																																								      					<div class="col-xs-4">
																																								      								<label class="colorLetras" for="inputlg">En Tramite :</label>
																							    																											<input class="form-control input-md redondear inputext" onblur="sumMediac()" id="madTramite" type="number" <? if($ex==0){ echo "readonly"; } ?>>
																																								      					</div>

																																								      </div>
																																					    </div>
																																					  </div>  

																																				
																														

																																					  	<div class="panel panel-default fd1" style="">
																							      										 <div class="panel-body">
																																					      <h5 class="text-on-pannel"><strong> Sin Acuerdo </strong></h5><br>

																																					      		 <div class="panel-body">
																																					      <h5 class="text-on-pannel"><strong> No aceptación del convenio </strong></h5>

																				    																				 <div class="row">
																																								      	
																																								      					<div class="col-xs-6">
																																								      							<label class="colorLetras" for="inputlg">Victima / Ofendido :</label>
																							    																											<input class="form-control input-md redondear inputext" onblur="sumMediac()" id="msaNoaConveVictima" type="number" <? if($ex==0){ echo "readonly"; } ?>>
																																								      					</div>
																																								      					<div class="col-xs-6">
																																								      								<label class="colorLetras" for="inputlg">Imputado :</label>
																							    																											<input class="form-control input-md redondear inputext" onblur="sumMediac()" id="msaNoaConceImputado" type="number" <? if($ex==0){ echo "readonly"; } ?>>
																																								      					</div>

																																								      </div>
																																					    </div>

																																					    <div class="panel panel-default fd1" style="">
																	    <div class="panel-body">
																	      <h5 class="text-on-pannel"><strong> Por decisión de las partes </strong></h5>
    																				<input class="form-control input-md redondear inputext" id="msaDecsiPartes" type="number"  <? if($ex==0){ echo "readonly"; } ?>>
																	    </div>
																	</div><br>

																	 <div class="panel-body">
																																					      <h5 class="text-on-pannel"><strong> Por inasistencia injustificada de las partes </strong></h5>

																				    																				 <div class="row">
																																								      	
																																								      					<div class="col-xs-6">
																																								      							<label class="colorLetras" for="inputlg">Victima / Ofendido :</label>
																							    																											<input class="form-control input-md redondear inputext" onblur="sumMediac()" id="msaInasInparVictima" type="number" <? if($ex==0){ echo "readonly"; } ?>>
																																								      					</div>
																																								      					<div class="col-xs-6">
																																								      								<label class="colorLetras" for="inputlg">Imputado :</label>
																							    																											<input class="form-control input-md redondear inputext" onblur="sumMediac()" id="msaInasInparImputado" type="number" <? if($ex==0){ echo "readonly"; } ?>>
																																								      					</div>

																																								      </div>
																																					    </div><br>

																																					    				 <div class="panel-body">
																																					      <h5 class="text-on-pannel"><strong> Por negativa de las partes a acordar </strong></h5>

																				    																				 <div class="row">
																																								      	
																																								      					<div class="col-xs-6">
																																								      							<label class="colorLetras" for="inputlg">Victima / Ofendido :</label>
																							    																											<input class="form-control input-md redondear inputext" onblur="sumMediac()" id="msaNegparVictima" type="number" <? if($ex==0){ echo "readonly"; } ?>>
																																								      					</div>
																																								      					<div class="col-xs-6">
																																								      								<label class="colorLetras" for="inputlg">Imputado :</label>
																							    																											<input class="form-control input-md redondear inputext" onblur="sumMediac()" id="msaNegparImputado" type="number" <? if($ex==0){ echo "readonly"; } ?>>
																																								      					</div>

																																								      </div>
																																					    </div>

																																					    			<div class="panel panel-default fd1" style="">
																	    <div class="panel-body">
																	      <h5 class="text-on-pannel"><strong> Total Mediación : </strong></h5>
    																				<input class="form-control input-md redondear inputext" id="totalMediacion" readonly type="number" value="0" >
																	    </div>
																	</div>

																																					    </div>

																																					    		 

																																					  </div>  


									  					</div>		

									  				</div>
									  		</div>	


									  	
             <div class="row">

<div class="col-xs-12 col-sm-12 col-md-12"><center><button style="width: 100%; height: 44px;" type="button" class="btn btn-primary redondear" onclick="guardarAcuerdos(<? echo $idEnlace; ?>);" <? if($ex==0){ echo "disabled"; } ?>>Guardar</button></center></div>
  


  
</div> 


									  		
									  	<!-- AQUI  ETERMINAL CODIGO PARA AGREGAR LA PRIMER ESTAÑA ( RECIBIDAS POR OTRA UNIDAD ) -->			

									</div>
							