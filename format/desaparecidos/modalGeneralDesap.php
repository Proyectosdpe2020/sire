
	<?php
	session_start();
	include ("../../Conexiones/Conexion.php");
	include("../../funciones.php");	
	include ("../../Conexiones/conexionSicap.php");
	include("../../funcioneSicap.php");

	 $idUsuario = $_SESSION['useridIE'];
	if (isset($_POST["validado"])){ $validado = $_POST["validado"]; }
	if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }
	if (isset($_POST["mesCapturar"])){ $mesCapturar = $_POST["mesCapturar"]; }
	if (isset($_POST["anioCaptura"])){ $anioCaptura = $_POST["anioCaptura"]; }



	$enlace = getInfoEnlaceUsuario($conn, $idUsuario);
 $idEnlace = $enlace[0][0];
 $idfisca = $enlace[0][1];


		if($idfisca == 4){ $mpsList = getMpsEnlace($conn, $idEnlace); }else{ $mpsList = getMpsEnlaceUnidad($conn, $idEnlace, 1); }
		
		$idUnidad = 0;
		$nomUnidad = "TODAS";
	
 	$mescap = getMesCapEnlaceArchivo($conn, $idEnlace, 1);	
		$mescapen = $mescap[0][0];

		$mesCapturar = $mescapen;
		$anioCaptura = 2019;	
 

 
 $mesNom = Mes_Nombre($mesCapturar);


 $enviado = getEnviadoEnlace($conn, $idEnlace);
	$env = $enviado[0][0];
	$envArch = $enviado[0][1];

	?>

					<div id="">

						<div class="row pad20" style="height: 87vh !important; margin-top: 5% !important;  overflow-y: scroll !important; background-color: white !important; border-radius: 10px 10px 0px 0px !important; box-shadow: 5px !important; ">	<br>						
					
																
														 <ul class="nav nav-tabs" id="myTab" role="tablist">
														  <li class="nav-item">
														    <a style="" class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Información General del Evento</a>
														  </li>
														  <li class="nav-item">
														    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Victima</a>
														  </li>
														  <li class="nav-item">
														    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Media Afiliación</a>
														  </li>
														  <li class="nav-item">
														    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Denunciante</a>
														  </li>
														  <li class="nav-item">
														    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Situación Jurídica</a>
														  </li>
														  <li class="nav-item">
														    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Datos Localizados</a>
														  </li>
														  <li class="nav-item">
														    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Datos del SEMEFO</a>
														  </li>
														</ul>

														<div class="tab-content" id="myTabContent">
														  


														  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
														  	
														  									<br>
														  									<form>
																								  <div class="form-row">
																								    <div class="col-md-4 mb-3">
																								      <label for="validationServer01">Nombre (S)</label>
																								      <input type="text" class="form-control form-control-xl" id="validationServer01" placeholder="First name" value="" required>
																								
																								    </div>
																								    <div class="col-md-4 mb-3">
																								      <label for="validationServer02">Paterno</label>
																								      <input type="text" class="form-control is-valid" id="validationServer02" placeholder="Last name" value="Otto" required>
																								     
																								    </div>
																								      <div class="col-md-4 mb-3">
																								      <label for="validationServer02">Materno</label>
																								      <input type="text" class="form-control is-valid" id="validationServer02" placeholder="Last name" value="Otto" required>
																								     
																								    </div>
																								  </div>
																								</form>


														  </div>



														  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">profile content</div>
														  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">contact content</div>
														  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">contact content</div>
														  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">contact content</div>
														  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">contact content</div>
														  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">contact content</div>
														</div>
																			
							
							</div>
											
								<div class="row" style="background-color: white !important; border-radius: 0px 0px 10px 10px !important; box-shadow: 5px !important;">
						
																					  <div class="col-xs-6 col-sm-6 col-md-6"><center><button style="width: 95%;" type="button" class="btn btn-default redondear" onclick="cancelarBotonValidate()">Salir</button></center><br></div>

																							<div class="col-xs-6 col-sm-6 col-md-6"><center><button style="width: 95%;"  type="button" class="btn btn-info redondear"  onclick="enviarDPEvalidates(<? echo $mpsIncorrectos; ?>,'<? echo $validado; ?>', <? echo $idEnlace; ?>, 1);">Guardar Información</button></center></div>
																		</div> 

						</div>