
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

      if($row_count > 0){

      		$ex = 1;
      		$indice = 0;

                  while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC )){
                    $arreglo[$indice][0]=$row['idCmascRecibidas'];
                    $arreglo[$indice][1]=$row['fechaCaptura'];
                    $arreglo[$indice][2]=$row['existenciaAnterior'];
                    $arreglo[$indice][3]=$row['atOrdinario'];
                    $arreglo[$indice][4]=$row['atReproceso'];
                    $arreglo[$indice][5]=$row['uiOrdinario'];
                    $arreglo[$indice][6]=$row['uiReproceso'];
                    $arreglo[$indice][7]=$row['daiOrdinario'];
                    $arreglo[$indice][8]=$row['daiReproceso'];
                    $arreglo[$indice][9]=$row['dvfgOrdinario'];
                    $arreglo[$indice][10]=$row['dvfgReproceso'];
                    $arreglo[$indice][11]=$row['aicOrdinario'];
                    $arreglo[$indice][12]=$row['aicReproceso'];
                    $arreglo[$indice][13]=$row['totalRecibidas'];
                    $arreglo[$indice][14]=$row['tsrProcedentes'];
                    $arreglo[$indice][15]=$row['tsrDesechadas'];
                    $arreglo[$indice][16]=$row['tsaVhombres'];
                    $arreglo[$indice][17]=$row['tsaVmujeres'];
                    $arreglo[$indice][18]=$row['tsaIhombres'];
                    $arreglo[$indice][19]=$row['tsaImujeres'];
                    $arreglo[$indice][20]=$row['invitacionesRecibidas'];
                    $arreglo[$indice][21]=$row['tramite'];

                    $indice++;
                  }

                  $idCmascRecibidas = $arreglo[0][0];
                  $fechaCaptura = $arreglo[0][1];
                  $existenciaAnterior = $arreglo[0][2];
                  $atOrdinario = $arreglo[0][3];
                  $atReproceso = $arreglo[0][4];
                  $uiOrdinario = $arreglo[0][5];
                  $uiReproceso = $arreglo[0][6];
                  $daiOrdinario = $arreglo[0][7];
                  $daiReproceso = $arreglo[0][8];
                  $dvfgOrdinario = $arreglo[0][9];
                  $dvfgReproceso = $arreglo[0][10];
                  $aicOrdinario = $arreglo[0][11];
                  $aicReproceso = $arreglo[0][12];
                  $totalRecibidas = $arreglo[0][13];
                  $tsrProcedentes = $arreglo[0][14];
                  $tsrDesechadas = $arreglo[0][15];
                  $tsaVhombres = $arreglo[0][16];
                  $tsaVmujeres = $arreglo[0][17];
                  $tsaIhombres = $arreglo[0][18];
                  $tsaImujeres = $arreglo[0][19];
                  $invitacionesRecibidas = $arreglo[0][20];
                  $tramite = $arreglo[0][21];


      }else{


      	$ex = 0;


      }

	?>

									<div id="contentTabs" class="">

									  	<!-- AQUI INICIA EL CODIGO PARA AGREGAR LA PRIMER ESTAÑA ( RECIBIDAS POR OTRA UNIDAD ) -->	
									  		<div class="row">
									  				
									  				<div class="col-xs-12 col-sm-12  col-md-6">
									  					<br><div class="">	
									  						<div class=""> 

									  								<div class="panel panel-default fd1" style="">
																	    <div class="panel-body">
																	      <h5 class="text-on-pannel"><strong> Existencia Anterior </strong></h5>
    																				<input class="form-control input-md redondear inputext" id="taRec" type="number" pattern="[0-9]+" value="<? if($ex == 1){ echo $existenciaAnterior; } ?>"  onblur="sumTotRecibidas()">
																	    </div>
																	</div>

									  							</div>
									  								

									  											<div class="panel panel-default fd1" style="">
																							      										 <div class="panel-body">
																																					      <h5 class="text-on-pannel"><strong> Unidad de Atención Temprana </strong></h5>

																				    																				 <div class="row">
																																								      						

																				    																				 						<div class="col-xs-6">
																																								      								<label class="colorLetras" for="inputlg">Ordinario :</label>
																																								      								<div class="iconiput">
																																																		  	<input type="number" placeholder="cantidad" class="first" onblur="sumTotRecibidas()" id="atOrdi" value="<? if($ex == 1){ echo $atOrdinario; } ?>"/>
																																																		  	<span onclick="sendDataModalCmasc(1,'atOrdi',<? echo $idEnlace ?>, <? echo $mes; ?>, <? echo $anio; ?>)"><div id="checkSdetenju"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																																																		  </div>	

																																								      					</div>

																																								      	
																																								      					<div class="col-xs-6">
																																								      								<label class="colorLetras" for="inputlg">Reproceso :</label>
																							    																											<div class="iconiput">
																							    																											<input type="number" placeholder="cantidad" class="first" onblur="sumTotRecibidas()" id="atRepro" value="<? if($ex == 1){ echo $atReproceso; } ?>"/>

																							    																												<span onclick="sendDataModal('inputSdetenju',22,1,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkSdetenju"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>	
																							    																												</div>
																																								      					</div>



																																								      </div>
																																					    </div>
																																					  </div>  

																																				
																																			<div class="panel panel-default fd1" style="">
																							      										 <div class="panel-body">
																																					      <h5 class="text-on-pannel"><strong> Unidad de Investigación </strong></h5>

																				    																				 <div class="row">
																																								      			

																				    																				 						<div class="col-xs-6">
																																								      								<label class="colorLetras" for="inputlg">Ordinario :</label>
																																								      								<div class="iconiput">
																																																		  	<input type="number" placeholder="cantidad" class="first" onblur="sumTotRecibidas()" id="uiOrdi" value="<? if($ex == 1){ echo $uiOrdinario; } ?>"/>
																																																		  	<span onclick="sendDataModal('inputSdetenju',22,1,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkSdetenju"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																																																		  </div>	
																																								      					</div>

																																								      					<div class="col-xs-6">
																																								      								<label class="colorLetras" for="inputlg">Reproceso :</label>
																																								      								<div class="iconiput">
																																																		  	<input type="number" placeholder="cantidad" class="first" onblur="sumTotRecibidas()" id="uiRepro" value="<? if($ex == 1){ echo $uiReproceso; } ?>"/>
																																																		  	<span onclick="sendDataModal('inputSdetenju',22,1,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkSdetenju"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																																																		  </div>	
																																								      					</div>


																																								      </div>
																																					    </div>
																																					  </div>  		  
																																					  	<div class="panel panel-default fd1" style="">
																							      										 <div class="panel-body">
																																					      <h5 class="text-on-pannel"><strong> Fiscalía Especializada en Atención a Delitos de Alto Impacto </strong></h5>

																				    																				 <div class="row">
																																								      						<div class="col-xs-6">
																																								      								<label class="colorLetras" for="inputlg">Ordinario :</label>
																																								      								<div class="iconiput">
																																																		  	<input type="number" placeholder="cantidad" class="first" onblur="sumTotRecibidas()" id="feaaiOrdi" value="<? if($ex == 1){ echo $daiOrdinario; } ?>"/>
																																																		  	<span onclick="sendDataModal('inputSdetenju',22,1,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkSdetenju"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																																																		  </div>	
																																								      					</div>

																																								      									<div class="col-xs-6">
																																								      								<label class="colorLetras" for="inputlg">Reproceso :</label>
																																								      								<div class="iconiput">
																																																		  	<input type="number" placeholder="cantidad" class="first" onblur="sumTotRecibidas()" id="feaaiRepro" value="<? if($ex == 1){ echo $daiReproceso; } ?>"/>
																																																		  	<span onclick="sendDataModal('inputSdetenju',22,1,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkSdetenju"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																																																		  </div>	
																																								      					</div>

																																								      				

																																								      </div>
																																					    </div>
																																					  </div>  
																																					  	<div class="panel panel-default fd1" style="">
																							      										 <div class="panel-body">
																																					      <h5 class="text-on-pannel"><strong> Fiscalía Especializada en Atención a Delitos de Violencia Familiar y de Género </strong></h5>

																				    																				 <div class="row">
																																								      					
																																								      					<div class="col-xs-6">
																																								      								<label class="colorLetras" for="inputlg">Ordinario :</label>
																																								      								<div class="iconiput">
																																																		  	<input type="number" placeholder="cantidad" class="first" onblur="sumTotRecibidas()" id="feavfgOrdi" value="<? if($ex == 1){ echo $dvfgOrdinario; } ?>"/>
																																																		  	<span onclick="sendDataModal('inputSdetenju',22,1,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkSdetenju"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																																																		  </div>	
																																								      					</div>

																																								      					
																																								      							<div class="col-xs-6">
																																								      								<label class="colorLetras" for="inputlg">Reproceso :</label>
																																								      								<div class="iconiput">
																																																		  	<input type="number" placeholder="cantidad" class="first" onblur="sumTotRecibidas()" id="feavfgRepro" value="<? if($ex == 1){ echo $dvfgReproceso; } ?>"/>
																																																		  	<span onclick="sendDataModal('inputSdetenju',22,1,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkSdetenju"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																																																		  </div>	
																																								      					</div>

																																								      </div>
																																					    </div>
																																					  </div>  
																																					  	<div class="panel panel-default fd1" style="">
																							      										 <div class="panel-body">
																																					      <h5 class="text-on-pannel"><strong> Agencia de Inteligencia Criminal</strong></h5>

																				    																				 <div class="row">
																																								      						

																																								      						<div class="col-xs-6">
																																								      								<label class="colorLetras" for="inputlg">Ordinario :</label>
																																								      								<div class="iconiput">
																																																		  	<input type="number" placeholder="cantidad" class="first" onblur="sumTotRecibidas()" id="aicOrdi" value="<? if($ex == 1){ echo $aicOrdinario; } ?>"/>
																																																		  	<span onclick="sendDataModal('inputSdetenju',22,1,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkSdetenju"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																																																		  </div>	
																																								      					</div>
																																								      							
																																								      						<div class="col-xs-6">
																																								      								<label class="colorLetras" for="inputlg">Ordinario :</label>
																																								      								<div class="iconiput">
																																																		  	<input type="number" placeholder="cantidad" class="first" onblur="sumTotRecibidas()" id="aicRepro" value="<? if($ex == 1){ echo $aicReproceso; } ?>"/>
																																																		  	<span onclick="sendDataModal('inputSdetenju',22,1,<? echo $idMp ?>, <? echo $mes; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>)"><div id="checkSdetenju"><i class="fa fa-file-text fa-lg fa-fw" aria-hidden="true"></i></div></span>
																																																		  </div>	
																																								      					</div>
																																								      							

																																								      </div>
																																					    </div>
																																					  </div>  


									  					</div>		

									  				</div>
									  				<div class="col-xs-12 col-sm-12  col-md-6">
									  					
									  							<br><div class="">


									  			<div class="panel panel-default fd1" style="">
																	    <div class="panel-body">
																	      <h5 class="text-on-pannel"><strong> Del Total de Solicitudes Recibidas </strong></h5>

	<div class="panel panel-default fd1" style="">
																	    <div class="panel-body">
																	      <h5 class="text-on-pannel"><strong> Total Recibidas </strong></h5>
    																				<input class="form-control input-md redondear inputext" readonly id="totalRecibidas" type="number" value="<? if($ex == 1){ echo $totalRecibidas; } ?>" >
																	    </div>
																	</div>

																	      	

    																				 <div class="row">
																				      	
																				      					<div class="col-xs-6">
																				      							<label class="colorLetras" for="inputlg">Procedentes :</label>
			    																											<input class="form-control input-md redondear inputext" onblur="" id="procedentes" value="<? if($ex == 1){ echo $tsrProcedentes; } ?>" type="number">
																				      					</div>
																				      					<div class="col-xs-6">
																				      								<label class="colorLetras" for="inputlg">Desechadas :</label>
			    																											<input class="form-control input-md redondear inputext" onblur="" id="desechadas" value="<? if($ex == 1){ echo $tsrDesechadas; } ?>" type="number">
																				      					</div>

																				      </div>
																	    </div>
																	  </div>
																			
																	  	

																	  	<div class="panel panel-default" style="">
																	    <div class="panel-body">
																	      	
																	      		<center><h5><strong> Tipos de Solicitante del Acuerdo </strong></h5></center>

    																				 <div class="row">
																				      	
																				      					<div class="col-xs-12">
																				      												<div class="panel panel-default fd1" style="">
																							      										 <div class="panel-body">
																																					      <h5 class="text-on-pannel"><strong> Solicitante Victima </strong></h5>

																				    																				 <div class="row">
																																								      	
																																								      					<div class="col-xs-6">
																																								      							<label class="colorLetras" for="inputlg">Hombres :</label>
																							    																											<input class="form-control input-md redondear inputext" onblur="" id="svhom" value="<? if($ex == 1){ echo $tsaVhombres; } ?>" type="number">
																																								      					</div>
																																								      					<div class="col-xs-6">
																																								      								<label class="colorLetras" for="inputlg">Mujeres :</label>
																							    																											<input class="form-control input-md redondear inputext" onblur="" id="svmuj" value="<? if($ex == 1){ echo $tsaVmujeres; } ?>" type="number">
																																								      					</div>

																																								      </div>
																																					    </div>
																																					  </div>  
																				      					</div>
																				      					<div class="col-xs-12">
																				      								
																				      														<div class="panel panel-default fd1" style="">
																							      										 <div class="panel-body">
																																					      <h5 class="text-on-pannel"><strong> Solicitante Imputado </strong></h5>

																				    																				 <div class="row">
																																								      	
																																								      					<div class="col-xs-6">
																																								      							<label class="colorLetras" for="inputlg">Hombres :</label>
																							    																											<input class="form-control input-md redondear inputext" onblur="" id="sihom" value="<? if($ex == 1){ echo $tsaIhombres; } ?>" type="number">
																																								      					</div>
																																								      					<div class="col-xs-6">
																																								      								<label class="colorLetras" for="inputlg">Mujeres :</label>
																							    																											<input class="form-control input-md redondear inputext" onblur="" id="simuj" value="<? if($ex == 1){ echo $tsaImujeres; } ?>" type="number">
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
																	      <h5 class="text-on-pannel"><strong> Numero de Invitaciones Recibidas </strong></h5>
    																				<input class="form-control input-md redondear inputext" id="numInvRec" type="number" value="<? if($ex == 1){ echo $invitacionesRecibidas; } ?>" value="" >
																	    </div>
																	</div>

																	 <div class="panel panel-default fd1" style="">
																	    <div class="panel-body">
																	      <h5 class="text-on-pannel"><strong> Tramite : </strong></h5>
    																				<input class="form-control input-md redondear inputext" id="tramiteFinalCmasc" readonly type="number" value="<? if($ex == 1){ echo $tramite; } ?>" >
																	    </div>
																	</div>

																		 		<div class="row">

												<div class="col-xs-12 col-sm-12 col-md-12"><center><button style="width: 100%; height: 44px;" type="button" class="btn btn-primary redondear" onclick="guardarRecibidas( <? echo $idEnlace; ?> )">Guardar</button></center></div>
											   
												<div id="responseSave"></div>
											
												  
										</div> 
<br>

									  		</div>

									 

									  				</div>

									  		</div>	


									  	



									  		
									  	<!-- AQUI  ETERMINAL CODIGO PARA AGREGAR LA PRIMER ESTAÑA ( RECIBIDAS POR OTRA UNIDAD ) -->			

									</div>



										<div class="modal fade bs-example-modal-sm" id="modalNucsRecibi" role="dialog" data-backdrop="static" data-keyboard="false">

										<div id="modalVistaCss" class="modal-dialog modal-sm" style = "width: 30%; margin-top: 1%;">

																	<div class="modal-content">

																					<div id="contmodalnucsRecibidasCmasc"></div>

																	</div>				
										</div>												

					</div>
							