
	<?php
	session_start();
	include ("../../Conexiones/Conexion.php");
	include("../../funciones.php");	



if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }
if (isset($_POST["anio"])){ $anio = $_POST["anio"]; }
if (isset($_POST["mes"])){ $mes = $_POST["mes"]; }


 $query = "SELECT idCmascRecibidas, fechaCaptura, existenciaAnterior, atOrdinario, atReproceso, uiOrdinario, uiReproceso, daiOrdinario, daiReproceso, dvfgOrdinario, dvfgReproceso, aicOrdinario, aicReproceso, totalRecibidas, tsrProcedentes, tsrDesechadas, tsaVhombres, tsaVmujeres, tsaIhombres, tsaImujeres, invitacionesRecibidas, tramite  FROM cmascRecibidas WHERE idEnlace = $idEnlace AND mes = $mes AND anio = $anio";
    

      $stmt = sqlsrv_query(  $conn, $query,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
      $row_count = sqlsrv_num_rows( $stmt );

      if($row_count > 0){ $ex = 1; }else{	$ex = 0; }


	?>

									<div id="contentTabs" class="">

									  	<!-- AQUI INICIA EL CODIGO PARA AGREGAR LA PRIMER ESTAÑA ( RECIBIDAS POR OTRA UNIDAD ) -->	
									  		<div class="row">
									  				
									  				<div class="col-xs-12 col-sm-12  col-md-6">
									  					<br><div class="">	
									  					

									  											<div class="panel panel-default fd1" style="">
																							      										 <div class="panel-body">
																																					      <h4 class="text-on-pannel"><strong> Acuerdos Celebrados </strong></h4>

																				    																				 <div class="row">
																																								      	
																																								      					<div class="col-xs-12">
																																								      							 <div class="panel panel-default fd1" style="">
																													  		  <div class="panel-body">
																													      <h5 class="text-on-pannel"><strong> Reconocimiento de responsabilidad y disculpa a victima u ofendido </strong></h5>
												    																				<input class="form-control input-md redondear inputext" id="inputTramiteAnterior" type="number" value="" <? if($ex==0){ echo "readonly"; } ?>>
																													    </div>
																													</div>
																																								      					</div>

																																								      							<div class="col-xs-12">
																																								      							 <div class="panel panel-default fd1" style="">
																															  		  <div class="panel-body">
																															      <h5 class="text-on-pannel"><strong> Compromiso de no repetición de la conducta y sometimiento a programas </strong></h5>
														    																				<input class="form-control input-md redondear inputext" id="inputTramiteAnterior" type="number" value="" <? if($ex==0){ echo "readonly"; } ?>>
																															    </div>
																															</div>
																																								      					</div>

																																								      						<div class="col-xs-12">
																																								      							 <div class="panel panel-default fd1" style="">
																															  		  <div class="panel-body">
																															      <h5 class="text-on-pannel"><strong> Restitución economica o en especie a la victima u ofendido </strong></h5>
														    																										
																															      			<div class="col-xs-12">
																																								      							 <div class="panel panel-default fd1" style="">
																															  		  <div class="panel-body">
																															      <h5 class="text-on-pannel"><strong> Monto recuperado como parte de reparación del daño </strong></h5>
														    																						
																															      							<div class="row">
																																								      	
																																								      					<div class="col-xs-6">
																																								      							<label class="colorLetras" for="inputlg"> Economico :</label>
																							    																											<input class="form-control input-md redondear inputext" onblur="" id="inputCdeten" type="number" <? if($ex==0){ echo "readonly"; } ?>>
																																								      					</div>
																																								      					<div class="col-xs-6">
																																								      								<label class="colorLetras" for="inputlg"> Especie :</label>
																							    																											<input class="form-control input-md redondear inputext" onblur="" id="inputSdeten" type="number" <? if($ex==0){ echo "readonly"; } ?>>
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


																																					  		<div class="panel panel-default fd1" style="">
																							      										 <div class="panel-body">
																																					      <h4 class="text-on-pannel"><strong> Terminación anticipada </strong></h4>

																				    																				 <div class="row">
																																								      	
																																								      					<div class="col-xs-6">
																																								      							 <div class="panel panel-default fd1" style="">
																													  		  <div class="panel-body">
																													      <h5 class="text-on-pannel"><strong> Por voluntad de alguno de los intervinientes </strong></h5>
												    																				<input class="form-control input-md redondear inputext" id="inputTramiteAnterior" type="number" <? if($ex==0){ echo "readonly"; } ?> >
																													    </div>
																													</div>
																																								      					</div>

																																								      							<div class="col-xs-6">
																																								      							 <div class="panel panel-default fd1" style="">
																															  		  <div class="panel-body">
																															      <h5 class="text-on-pannel"><strong> Por inasistencia injustificada </strong></h5>
														    																				<input class="form-control input-md redondear inputext" id="inputTramiteAnterior" type="number"<? if($ex==0){ echo "readonly"; } ?> >
																															    </div>
																															</div>
																																								      					</div>

																																								      			

																																								      </div>
																																								      	 <div class="row">
																																								      	
																																								      					<div class="col-xs-6">
																																								      							 <div class="panel panel-default fd1" style="">
																													  		  <div class="panel-body">
																													      <h5 class="text-on-pannel"><strong> Cuando el Facilitador identifica la no solución </strong></h5>
												    																				<input class="form-control input-md redondear inputext" id="inputTramiteAnterior" type="number" <? if($ex==0){ echo "readonly"; } ?>>
																													    </div>
																													</div>
																																								      					</div>

																																								      							<div class="col-xs-6">
																																								      							 <div class="panel panel-default fd1" style="">
																															  		  <div class="panel-body">
																															      <h5 class="text-on-pannel"><strong> Comportamiento irrespetuoso de los intervenientes </strong></h5>
														    																				<input class="form-control input-md redondear inputext" id="inputTramiteAnterior" type="number" <? if($ex==0){ echo "readonly"; } ?>>
																															    </div>
																															</div>
																																								      					</div>

																																								      			

																																								      </div>
																																								      	 <div class="row">
																																								      	
																																								      					<div class="col-xs-12">
																																								      							 <div class="panel panel-default fd1" style="">
																													  		  <div class="panel-body">
																													      <h5 class="text-on-pannel"><strong> Por incumplimiento del Acuerdo entre intervinientes </strong></h5>
												    																				<input class="form-control input-md redondear inputext" id="inputTramiteAnterior" type="number" <? if($ex==0){ echo "readonly"; } ?> >
																													    </div>
																													</div>
																																								      					</div>


																																								      			

																																								      </div>
																																					    </div>
																																					  </div> 

																																					 

																																								      			

																																								      </div>


																																
									  					</div>		


									  									<div class="col-xs-12 col-sm-12  col-md-6">
									  					
									  							<br>


																							

									  																 <div class="panel panel-default fd1" style="">
																							      										 <div class="panel-body">
																																					      <h4 class="text-on-pannel"><strong> Determinadas </strong></h4>

																				    																				 <div class="row">
																																								      	
																																								      					<div class="col-xs-6">
																																								      							 <div class="panel panel-default fd1" style="">
																													  		  <div class="panel-body">
																													      <h5 class="text-on-pannel"><strong> No ejercicio de la acción penal </strong></h5>
												    																				<input class="form-control input-md redondear inputext" id="inputTramiteAnterior" type="number" <? if($ex==0){ echo "readonly"; } ?> >
																													    </div>
																													</div>
																																								      					</div>

																																								      							<div class="col-xs-6">
																																								      							 <div class="panel panel-default fd1" style="">
																															  		  <div class="panel-body">
																															      <h5 class="text-on-pannel"><strong> Abstención de la investigación </strong></h5>
														    																				<input class="form-control input-md redondear inputext" id="inputTramiteAnterior" type="number" <? if($ex==0){ echo "readonly"; } ?> >
																															    </div>
																															</div>
																																								      					</div>

																																								      			

																																								      </div>

																																								      	 <div class="row">
																																								      	
																																								      					<div class="col-xs-12">
																																								      							 <div class="panel panel-default fd1" style="">
																													  		  <div class="panel-body">
																													      <h5 class="text-on-pannel"><strong> Criterios de Oportunidad</strong></h5>
												    																				<input class="form-control input-md redondear inputext" id="inputTramiteAnterior" type="number" <? if($ex==0){ echo "readonly"; } ?> >
																													    </div>
																													</div>
																																								      					</div>


																																								      			

																																								      </div>
																																					    </div>
																																					  </div> 


																																					  <div class="panel panel-default fd1" style="">
																							      										 <div class="panel-body">
																																					      <h4 class="text-on-pannel"><strong> Impugnaciónes interpuestas sobre la validez del convenio </strong></h4>

																				    																				 <div class="row">
																																								      	
																																								      					<div class="col-xs-6">
																																								      							 <div class="panel panel-default fd1" style="">
																													  		  <div class="panel-body">
																													      <h5 class="text-on-pannel"><strong> Victima / Ofendido </strong></h5>
												    																				<input class="form-control input-md redondear inputext" id="inputTramiteAnterior" type="number" <? if($ex==0){ echo "readonly"; } ?> >
																													    </div>
																													</div>
																																								      					</div>

																																								      							<div class="col-xs-6">
																																								      							 <div class="panel panel-default fd1" style="">
																															  		  <div class="panel-body">
																															      <h5 class="text-on-pannel"><strong> Imputado </strong></h5>
														    																				<input class="form-control input-md redondear inputext" id="inputTramiteAnterior" type="number" <? if($ex==0){ echo "readonly"; } ?> >
																															    </div>
																															</div>
																																								      					</div>

																																								      			

																																								      </div>

																																								      	 <div class="row">
																																								      	
																																								      					<div class="col-xs-12">
																																								      							 <div class="panel panel-default fd1" style="">
																													  		  <div class="panel-body">
																													      <h5 class="text-on-pannel"><strong> Ministerio Público</strong></h5>
												    																				<input class="form-control input-md redondear inputext" id="inputTramiteAnterior" type="number" <? if($ex==0){ echo "readonly"; } ?> >
																													    </div>
																													</div>
																																								      					</div>


																																								      			

																																								      </div>
																																					    </div>
																																					  </div> 

																																					 <div class="row">
																																								      	
																																								      					<div class="col-xs-6">
																																								      							 <div class="panel panel-default fd1" style="">
																													  		  <div class="panel-body">
																													      <h5 class="text-on-pannel"><strong> Casos en los que solicitaron auxiliares </strong></h5>
												    																				<input class="form-control input-md redondear inputext" id="inputTramiteAnterior" type="number" <? if($ex==0){ echo "readonly"; } ?>>
																													    </div>
																													</div>
																																								      					</div>

																																								      							<div class="col-xs-6">
																																								      							 <div class="panel panel-default fd1" style="">
																															  		  <div class="panel-body">
																															      <h5 class="text-on-pannel"><strong> Casos en los que se solicito sustitución del facilitador  </strong></h5>
														    																				<input class="form-control input-md redondear inputext" id="inputTramiteAnterior" type="number" <? if($ex==0){ echo "readonly"; } ?> >
																															    </div>
																															</div>
																																								      					</div>
																					


									<div class="col-xs-12 col-sm-12 col-md-12"><center><button style="width: 100%; height: 44px;" type="button" class="btn btn-primary redondear" onclick="" <? if($ex==0){ echo "disabled"; } ?>>Guardar</button></center></div>
											   

											
												  
				
<br>

				

									 

									  				</div>


									  				</div>
									  		

									  		</div>	


									  	



									  		
									  	<!-- AQUI  ETERMINAL CODIGO PARA AGREGAR LA PRIMER ESTAÑA ( RECIBIDAS POR OTRA UNIDAD ) -->			

									</div>
							

</////// AQUIIIII

