<?php session_start();
	
	include("../validar_sesion.php");
	if(empty($_SESSION)) 
	{ 
		header("location:/SICAP/login.php");    
	}  
	include("../validar_sesion.php");

	header("Cache-Control: no-cache, must-revalidate");
 	header("Expires: Sat, 1 Jul 2000 05:00:00 GMT");
	
?> 
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Expires" content="0">
		<meta http-equiv="Last-Modified" content="0">
		<meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
		<meta http-equiv="Pragma" content="no-cache">

		<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!-- Meta, title, CSS, favicons, etc. -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="../img/sello.png">
		<title>Modificación</title>	
		
		
		<!-- Bootstrap -->
		<link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
		<!-- Font Awesome -->
		<link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<!-- NProgress -->
		<link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
		<link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
		<link href="../vendors/select2/dist/css/select2.min.css" rel="stylesheet">
		<!-- Custom Theme Style -->
		<link href="../build/css/custom.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="../dist/sweetalert.css">
		<link href="victims/css/styles.css" rel="stylesheet">
		<link href="imputeds/css/styles.css" rel="stylesheet">

		

		<script language="JavaScript" type="text/javascript" src="script9.js"></script>

		<!--<script src="Libs/maskedinput/jquery.maskedinput.js" type="text/javascript"></script>-->

		<script language="JavaScript" type="text/javascript" src="victims/js/victim_script_2108091840.js"></script>
		<script language="JavaScript" type="text/javascript" src="imputeds/js/imputed_script_2109011145.js"></script>
		
		<style>
			body {font-family: "Lato", sans-serif;}
			
			ul.tab {
			list-style-type: none;
			margin: 0;
			padding: 0;
			overflow: hidden;
			border: 1px solid #ccc;
			background-color: #f1f1f1;
			}
			
			/* Float the list items side by side */
			ul.tab li {float: left;}
			
			/* Style the links inside the list items */
			ul.tab li a {
			display: inline-block;
			color: black;
			text-align: center;
			padding: 14px 16px;
			text-decoration: none;
			transition: 0.7s;
			font-size: 17px;
			}
			
			/* Change background color of links on hover */
			ul.tab li a:hover {
			background-color: #ddd;
			}
			
			/* Create an active/current tablink class */
			ul.tab li a:focus, .active {
			
			}
			
			/* Style the tab content */
			.tabcontent {
			
			padding: 6px 12px;
			-webkit-animation: fadeEffect 1s;
			animation: fadeEffect 1s;
			}
			
			@-webkit-keyframes fadeEffect {
			from {opacity: 0;}
			to {opacity: 1;}
			}
			
			@keyframes fadeEffect {
			from {opacity: 0;}
			to {opacity: 1;}
			}
			
		</style>
		
		<script>
			function validafecha()
			{
			var fechaevento=document.getElementById('fechaevento').value;
			
			var fechainicio=document.getElementsByName('fechaini')[0].value;
			
			if(fechainicio<fechaevento){
			//sweetAlert("Ok!..", "", "success");
			sweetAlert("Ups!..", "la Fecha del Evento  no Puede Ser Mayor que la Fecha de Inicio", "error");
			document.getElementById("fechaevento").focus();
			return false;
			} 
			}
		</script>
		<script>	
			function openCity(evt, cityName) {
				
				var i, tabcontent, tablinks;
				tabcontent = document.getElementsByClassName("tabcontent");
				for (i = 0; i < tabcontent.length; i++) {
					tabcontent[i].style.display = "none";
				}
				tablinks = document.getElementsByClassName("tablinks");
				for (i = 0; i < tablinks.length; i++) {
					tablinks[i].className = tablinks[i].className.replace(" active", "");
				}
				document.getElementById(cityName).style.display = "block";
				evt.currentTarget.className += " active";
				activa();
			}
			
			function 	bloquea()			
			{
				
				activa();
				document.getElementById("victima").style.display = "block";
				document.getElementById("imputado").style.display = "block";
				tabcontent = document.getElementsByClassName("tabcontent");
				tabcontent[0].style.display = "none";
				tabcontent[1].style.display = "none";		
				tabcontent[2].style.display = "none";	
			}
			function desbloqueaCampos()
			{						
				if(document.getElementById("tipo").value==1)
				{					
					document.getElementById("nombre").disabled = false;
					document.getElementById("calidad").disabled = false;
					document.getElementById("paterno").disabled = false;
					document.getElementById("materno").disabled = false;
					document.getElementById("sexo").disabled = false;
					document.getElementById("edad").disabled = false;
					document.getElementById("profesion").disabled = false;
					document.getElementById("nacionalidad").disabled = false;
					document.getElementById("escolaridad").disabled = false;
					document.getElementById("delito").disabled = false;

					/*document.getElementById('calidad').selectedIndex='2';
					document.getElementById('nombre').value="";
					document.getElementById('paterno').value="";
					document.getElementById('materno').value="";
					document.getElementById('sexo').selectedIndex='3';
					document.getElementById('edad').selectedIndex='1';
					document.getElementById('escolaridad').selectedIndex='29';						
					document.getElementById('profesion').selectedIndex='276';						
					document.getElementById('nacionalidad').selectedIndex='113';	
					$(".select12_single").select2({
						placeholder: "Selecciona Nacionalidad",
						allowClear: true
					});
					$(".select11_single").select2({
						placeholder: "Selecciona profesión",
						allowClear: true
					});
					$(".select10_single").select2({
						placeholder: "Selecciona Escolaridad",
						allowClear: true
					});*/

				}
				else if(document.getElementById("tipo").value==0)
				{					
					
					document.getElementById("nombre").disabled = false;
					document.getElementById("calidad").disabled = false;
					document.getElementById("paterno").disabled = true;
					document.getElementById("materno").disabled = true;
					document.getElementById("sexo").disabled = true;
					document.getElementById("edad").disabled = true;
					document.getElementById("profesion").disabled = true;
					document.getElementById("nacionalidad").disabled=true;
					document.getElementById("escolaridad").disabled = true;	
					document.getElementById("delito").disabled = false;

					document.getElementById('paterno').value="";
					document.getElementById('materno').value="";
					document.getElementById('sexo').selectedIndex='3';
					document.getElementById('edad').selectedIndex='1';
					document.getElementById('escolaridad').selectedIndex='29';						
					document.getElementById('profesion').selectedIndex='276';						
					document.getElementById('nacionalidad').selectedIndex='113';	
					$(".select12_single").select2({
						placeholder: "Selecciona Nacionalidad",
						allowClear: true
					});
					$(".select11_single").select2({
						placeholder: "Selecciona profesión",
						allowClear: true
					});
					$(".select10_single").select2({
						placeholder: "Selecciona Escolaridad",
						allowClear: true
					});
				}
				else if(document.getElementById("tipo").value==2){					
					document.getElementById("profesion").disabled = false;
					document.getElementById("nacionalidad").disabled = false;
					document.getElementById("escolaridad").disabled = false;
					document.getElementById("nombre").disabled = false;
					document.getElementById("calidad").disabled = false;
					document.getElementById("paterno").disabled = false;
					document.getElementById("materno").disabled = false;
					document.getElementById("sexo").disabled = false;
					document.getElementById("edad").disabled = false;
					document.getElementById("delito").disabled = false;						
					document.getElementById('calidad').selectedIndex='2';
					document.getElementById('nombre').value="Quien";
					document.getElementById('paterno').value="Resulte";
					document.getElementById('materno').value="Ofendido";
					document.getElementById('sexo').selectedIndex='3';
					document.getElementById('edad').selectedIndex='1';
					document.getElementById('escolaridad').selectedIndex='29';						
					document.getElementById('profesion').selectedIndex='276';						
					document.getElementById('nacionalidad').selectedIndex='113';	
					$(".select12_single").select2({
						placeholder: "Selecciona Nacionalidad",
						allowClear: true
					});
					$(".select11_single").select2({
						placeholder: "Selecciona profesión",
						allowClear: true
					});
					$(".select10_single").select2({
						placeholder: "Selecciona Escolaridad",
						allowClear: true
					});

					
				}		
				else if(document.getElementById("tipo").value==3){					
					document.getElementById("profesion").disabled = true;
					document.getElementById("nacionalidad").disabled = true;
					document.getElementById("escolaridad").disabled = true;
					document.getElementById("nombre").disabled = false;
					document.getElementById("calidad").disabled = false;
					document.getElementById("paterno").disabled = true;
					document.getElementById("materno").disabled = true;
					document.getElementById("sexo").disabled = true;
					document.getElementById("edad").disabled = true;
					document.getElementById("delito").disabled = false;						
					document.getElementById('calidad').selectedIndex='2';
					document.getElementById('nombre').value="Sociedad";
					document.getElementById('paterno').value="";
					document.getElementById('materno').value="";
					document.getElementById('sexo').selectedIndex='3';
					document.getElementById('edad').selectedIndex='1';
					document.getElementById('escolaridad').selectedIndex='29';						
					document.getElementById('profesion').selectedIndex='276';						
					document.getElementById('nacionalidad').selectedIndex='113';	
					$(".select12_single").select2({
						placeholder: "Selecciona Nacionalidad",
						allowClear: true
					});
					$(".select11_single").select2({
						placeholder: "Selecciona profesión",
						allowClear: true
					});
					$(".select10_single").select2({
						placeholder: "Selecciona Escolaridad",
						allowClear: true
					});

					
				}
				else if(document.getElementById("tipo").value==4){					
					document.getElementById("profesion").disabled = true;
					document.getElementById("nacionalidad").disabled = true;
					document.getElementById("escolaridad").disabled = true;
					document.getElementById("nombre").disabled = false;
					document.getElementById("calidad").disabled = false;
					document.getElementById("paterno").disabled = true;
					document.getElementById("materno").disabled = true;
					document.getElementById("sexo").disabled = true;
					document.getElementById("edad").disabled = true;
					document.getElementById("delito").disabled = false;						
					document.getElementById('calidad').selectedIndex='2';
					document.getElementById('nombre').value="Estado";
					document.getElementById('paterno').value="";
					document.getElementById('materno').value="";
					document.getElementById('sexo').selectedIndex='3';
					document.getElementById('edad').selectedIndex='1';
					document.getElementById('escolaridad').selectedIndex='29';						
					document.getElementById('profesion').selectedIndex='276';						
					document.getElementById('nacionalidad').selectedIndex='113';	
					$(".select12_single").select2({
						placeholder: "Selecciona Nacionalidad",
						allowClear: true
					});
					$(".select11_single").select2({
						placeholder: "Selecciona profesión",
						allowClear: true
					});
					$(".select10_single").select2({
						placeholder: "Selecciona Escolaridad",
						allowClear: true
					});

					
				}		
			}
			function activa()
			{		
				$(".select20_single").select2({
					placeholder: "Selecciona Color",
					allowClear: true
				});
				$(".select16_single").select2({
					placeholder: "Selecciona Tipo Vehículo",
					allowClear: true
				});
				$(".select17_single").select2({
					placeholder: "Selecciona Tipo Vehículo",
					allowClear: true
				});
				
				$(".select18_single").select2({
					placeholder: "Selecciona Marca del Vehículo",
					allowClear: true
				});
				$(".select19_single").select2({
					placeholder: "Selecciona Marca del Vehículo",
					allowClear: true
				});
				$(".select13_single").select2({
					placeholder: "Selecciona Parentesco",
					allowClear: true
				});
				$(".select14_single").select2({
					placeholder: "Selecciona Organización",
					allowClear: true
				});
				$(".select12_single").select2({
					placeholder: "Selecciona Nacionalidad",
					allowClear: true
				});
				$(".select11_single").select2({
					placeholder: "Selecciona profesión",
					allowClear: true
				});
				$(".select10_single").select2({
					placeholder: "Selecciona Escolaridad",
					allowClear: true
				});				
			}
			function victimaform() {
				$("#botonaccion").html('Guardar');
				document.getElementsByName("band")[0].value="";
				document.getElementById("victimaform").reset();
				document.getElementById('escolaridad').selectedIndex='0';						
				document.getElementById('profesion').selectedIndex='0';						
				document.getElementById('nacionalidad').selectedIndex='0';
				document.getElementById('delito').selectedIndex='0';	
				$(".select12_single").select2({
					placeholder: "Selecciona Nacionalidad",
					allowClear: true
				});
				$(".select11_single").select2({
					placeholder: "Selecciona profesión",
					allowClear: true
				});
				$(".select10_single").select2({
					placeholder: "Selecciona Escolaridad",
					allowClear: true
				});
				document.getElementById("nombre").disabled = true;
				document.getElementById("calidad").disabled = true;
				document.getElementById("paterno").disabled = true;
				document.getElementById("materno").disabled = true;
				document.getElementById("sexo").disabled = true;
				document.getElementById("edad").disabled = true;
				document.getElementById("profesion").disabled = true;
				document.getElementById("nacionalidad").disabled=true;
				document.getElementById("escolaridad").disabled = true;	
				document.getElementById("delito").disabled = true;					
			}		
			
		</script>
		
		<style>
			input:focus {
			background-color: #F2F5A9;
			}
			
			
			
		</style>
		
	</head>	
	<body class="nav-md"  onload="bloquea()">		
		<?php  		
			
			include("../menu2.php");
			include("../funciones.php");
			include ("../Conexiones/Conexion_SICAP.php");
			include("../header.php");
			$fiscaliaid=$_SESSION['fiscaliauser'];
			$fiscanombre=$_SESSION['nomfiscalia']; 
			$fiscalia=$_SESSION['fiscaliauser'];			
			if($_SESSION['permisos']!=2){
				$unidades=get_uie($conn,$_SESSION['fiscaliauser']);
			}
			else{
				$unidades=get_uie($conn,"1,2,3,4,5,6,7,8,9,10");	
			}		
			$nuc= base64_decode ($_GET["lol"]);	
		//	$nuc=1003201814655;
			$municipios=get_municipios($conn,0);
			$modalidades=get_modalidades ($conn);
			$lugares=get_lugares ($conn);
			$armas=get_armas ($conn);	
			$escolaridad=get_escolaridad($conn);
			$profesiones=get_profesiones($conn);
			$nacionalidad=get_nacionalidad($conn);
			$parentesco=get_parentesco($conn);
			$victimas=get_victimas($conn,$nuc);
			$organizaciones=get_organizacion($conn);
			$tipov=get_tipov($conn); 
			$marcav=get_marca($conn);			
			$arreglo=get_datos_modificar($conn,$nuc);			
			$arreglo[3]=str_ireplace(' ','T',$arreglo[3]);			
			$colores=get_colores($conn);
			$elementos=get_elementos_nuc($conn,$nuc);
			$elementos_catalogo=get_elementos_catalogo($conn);


				//////// metodos agregados para drogas, madera, armas 13/07/2021  /////////////

	$tipodrogas = getTipoDroga($conn);
	$unidMedidaDrog = getUnidadMedida($conn, 2);

	$marcaArma = getMarcaArma($conn);
	$tarma = getTipoArma($conn);
	$calibres = getCalibreArma($conn);

	$tipomaderas = getTipoMadera($conn);
	$unidMedidaMad = getUnidadMedida($conn, 1);

	//////// metodos agregados para drogas, madera, armas 13/07/2021  /////////////

			
			$_SESSION['victims'] = $victimas;
			
			$delitos=get_delitos($conn,$arreglo[23]);
			
			$sql="select * from delito where CarpetaID=".$arreglo[23]." and Principal=1"; 
			$bandera_dprincipal=0;
			$stmt = sqlsrv_query( $conn, $sql);
			while(	$row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC )){
				$bandera_dprincipal=1;
				break;
				
			}
			
			//$datos_prinicipal=delito_principal($conn,$arreglo[23]);
		?>
		<!-- page content -->

		
		<div class="right_col" role="main" style ="height: auto;">			
			<div class="title_left">
				
				
				<h3>Actualizacion Datos Carpeta  <?php echo $nuc?> </h3>
				<div class="col-md-12 col-sm-12 col-xs-12 form-group">
					<div class="buttons">					
						<button type="submit" class="btn btn-success" style="height:38px; width: 200px;"  onclick = "location='../captura/buscar_nuc.php'">Capturar Nuevo</button>			
					</div>
				</div>
				
			</div>
			<div class="col-md-12 col-sm-12 col-xs-12 form-group">
				<ul class="tab">
					<li><a href="javascript:void(0)" class="tablinks" onclick="openCity(event, 'carpeta')">Carpeta</a></li>
					<li><a href="javascript:void(0)" class="tablinks" onclick="openCity(event, 'victima')">Víctima(s)</a></li>
					<li><a href="javascript:void(0)" class="tablinks" onclick="openCity(event, 'imputado')">Imputado(s)</a></li>	
					<li><a href="javascript:void(0)" class="tablinks" onclick="openCity(event, 'vehiculo')">Vehículo(s)</a></li>	
					<li><a href="javascript:void(0)" class="tablinks" onclick="openCity(event, 'droga')">Droga(s)</a></li>
				<li><a href="javascript:void(0)" class="tablinks" onclick="openCity(event, 'arma')">Arma(s)</a></li>
				<li><a href="javascript:void(0)" class="tablinks" onclick="openCity(event, 'madera')">Madera(s)</a></li>
					
				</ul>			
			</div>
			<!--------------------------INICIA DIV DE  vehiculos------------------------------------------------------   -->  
			
			<div id="vehiculo" class="tabcontent"  style="  display: none;"   >				
				<div class="x_panel">
					<div class="x_panel">
						<div class="row">
							<div class="title_left">								
								<div class="col-md-12 col-sm-12 col-xs-12 form-group">
									<div class="buttons">		
										<form id="vehiculosv" action="#">
											
											<button type="button" class="btn btn-dark" style="height:38px; width: 100px;"  onclick="limpia_vehiculo()">Nuevo</button>	
											<button type="button" id="botonaccionv" class="btn btn-success" style="height:38px; width: 100px;"  onclick="return valida_vehiculos(this.form);">Guardar</button>	
										</div>
									</div>
								</div>
							</div>
						</div>						
						<div class="row">						
							<div class="x_panel">							
								
								
								<input type="hidden"  name="bandvehiculo" value="" />		
								<input type="hidden" name="carpetavehiculo" value="" />		
								<div class="col-md-12 col-sm-12 col-xs-12 form-group">
									<div class="col-md-3 col-sm-12 col-xs-12 form-group">
										<label style="font-weight:bold">Tipo: *</label>	
										<select id="tipov" name="tipov" style="height: 40px" class="select16_single form-control"  required="true"  onchange='javascript:cargasubtipo()'  />
										<option></option>	
										
										<?php for($i=0; $i<sizeof($tipov); $i++){									
											echo 	"<option value=".$tipov[$i][0]." >".$tipov[$i][1]."</option>";							
										}
										?>
									</select>			
								</div>
								<div id="subtipov">
									<div class="col-md-3 col-sm-12 col-xs-12 form-group">
										<label style="font-weight:bold">Subtipo: *</label>	
										<select id="subtipoveh" name="subtipoveh"  tabindex="1"  class="select16_single form-control" tabindex="-1"  required="true"   >
											<option></option>	
											
										</select>						
									</div>
								</div>
								<div class="col-md-3 col-sm-12 col-xs-12 form-group">
									<label style="font-weight:bold">Marca: *</label>	
									<select id="marcav" name="marcav" tabindex="4"  class="select18_single form-control" tabindex="-1"  required="true"  onchange='javascript:cargasubmarca()'/>
									<option></option>							
									
									<?php for($i=0; $i<sizeof($marcav); $i++){									
										echo 	"<option value=".$marcav[$i][0]." >".$marcav[$i][1]."</option>";							
									}
									?>
								</select>							
							</div>
							<div id="submarcave">
								<div class="col-md-3 col-sm-12 col-xs-12 form-group">
									<label style="font-weight:bold">Submarca: *</label>	
									<select id="submarcav" tabindex="4"  name="submarcav" class="select19_single form-control" tabindex="-1"  required="true" />
									<option></option>							
									
								</select>							
							</div>	
						</div>
						
					</div>		
					<div class="col-md-12 col-sm-12 col-xs-12 form-group">
						<div class="col-md-3 col-sm-12 col-xs-12 form-group">
							<label style="font-weight:bold">Serie: *</label>
							<input id="seriev"  type=""   name="seriev" value=""  tabindex="0"  placeholder="Ingresa Número de Serie" style="height:38px;"  class="fechas form-control" />						
						</div>
						<div class="col-md-3 col-sm-12 col-xs-12 form-group">
							<label style="font-weight:bold">Motor: *</label>
							<input id="motorv"  type=""   name="motorv" value=""  tabindex="0"  placeholder="Ingresa Número de Motor" style="height:38px;"  class="fechas form-control" />						
						</div>
						<div class="col-md-3 col-sm-12 col-xs-12 form-group">
							<label style="font-weight:bold">Placas: *</label>
							<input id="placasv"  type=""   name="placasv" value=""  tabindex="0" placeholder="Ingresa Número de Placas" style="height:38px;"  class="fechas form-control" />						
						</div>
						<div class="col-md-3 col-sm-12 col-xs-12 form-group">
							<label style="font-weight:bold">Modelo: *</label>
							<input id="modelov"  type="number"   name="modelov" tabindex="0"  value="" placeholder="Ingresa Modelo" style="height:38px;"  class="fechas form-control" />						
							
						</div>
					</div>
					<div class="col-md-12 col-sm-12 col-xs-12 form-group">
						<div class="col-md-2 col-sm-12 col-xs-12 form-group">
							<label style="font-weight:bold">Color: *</label>	
							<select id="colorv" name="colorv" class="select20_single form-control" tabindex="6"  required="true"  />
							<option></option>							
							
							<?php for($i=0; $i<sizeof($colores); $i++){									
								echo 	"<option value=".$colores[$i][0]." >".$colores[$i][1]."</option>";							
							}
							?>
						</select>		
					</div>
					
					<div class="col-md-2 col-sm-12 col-xs-12 form-group">
						<label style="font-weight:bold">Color Adicional:</label>
						<input id="coloradici"  type=""   name="coloradici" value=""  tabindex="0" placeholder="Ingresa Color  Adicional" style="height:38px;"  class="fechas form-control" />						
					</div>
					<div class="col-md-2 col-sm-12 col-xs-12 form-group">
						<label style="font-weight:bold">Reporte Robo: *</label>	
						<select id="reportev" name="reportev" style="height: 40px" class="form-control"  required="true" onchange='javascript:desbloqueaCampos()'>
							<option value ="">Selecciona </option>										
							<option value ="1">Si</option>
							<option value ="2">No</option>										
						</select>
					</div>
					<div class="col-md-2 col-sm-12 col-xs-12 form-group">
						<label style="font-weight:bold">Recuperado: *</label>	
						<select id="recuperadov" name="recuperadov" style="height: 40px" class="form-control"  required="true" onchange='javascript:desbloqueaCampos()'>
							<option value ="">Selecciona </option>										
							<option value ="1">Si</option>
							<option value ="2">No</option>										
						</select>
					</div>
					<div class="col-md-2 col-sm-12 col-xs-12 form-group">
						<label style="font-weight:bold">Modus Operandi: *</label>	
						<select id="modus" name="modus" style="height: 40px" class="form-control"  required="true" onchange='javascript:desbloqueaCampos()'>
							<option value ="">Selecciona </option>										
							<option value ="1">Estacionado</option>
							<option value ="2">Con Arma Blanca</option>
							<option value ="3">Arma de Fuego</option>
							<option value ="4">Amenazas</option>
							<option value ="5">Circulando</option>
							<option value ="6">Otro</option>
						</select>
					</div>
					<div class="col-md-2 col-sm-12 col-xs-12 form-group">
						<label style="font-weight:bold">Monto del Robo:  <font color="red">*</font></label>
						<input id="monto"  type="number"   name="monto" value="" min="0" tabindex="0"  placeholder="Ingresa Monto" style="height:38px;"  class="fechas form-control" />						
					</div>
					
				</div>
			</form>	
		</div>	
	</div>		
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Vehículo(s):</h2>								
				<div class="clearfix"></div>
			</div>							
			<div class="x_content" >								
				<div id="vehiculosdiv">
					<div class="table-responsive">
						<table class="table table-striped jambo_table bulk_action">
							<thead>
								<tr class="headings">												
									<th class="column-title" style=' text-align: center;'>Tipo </th>
									<th class="column-title" style=' text-align: center;'>Subtipo</th>	
									<th class="column-title" style=' text-align: center;'>Marca</th>													
									<th class="column-title" style=' text-align: center;'>Submarca</th>
									<th class="column-title" style=' text-align: center;'>Serie</th>
									<th class="column-title" style=' text-align: center;'>Motor</th>
									<th class="column-title" style=' text-align: center;'>Placas</th>
									<th class="column-title" style=' text-align: center;'>Modelo</th>
									<th class="column-title" style=' text-align: center;'>Color</th>
									<th class="column-title" style=' text-align: center;'>Color Adicional</th>	
									<th class="column-title" style=' text-align: center;'>Reporte Robo</th>	
									<th class="column-title" style=' text-align: center;'>Recuperado</th>
									<th class="column-title" style=' text-align: center;'>Modus Operandi</th>	
									<th class="column-title" style=' text-align: center;'>Monto Robo</th>	
									<th class="column-title" style=' text-align: center;'>Acciones</th>	
								</th>
								<th class="bulk-actions" colspan="7">
									<a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
								</th>
							</tr>
						</thead>											
						<tbody>											
							<?php		
								$vehiculastable=get_vehiculos_table($nuc,$conn);
								if(!$vehiculastable){
									echo "	<tr class='even pointer'>";
									
									echo"<td style='text-align: center;'>"."Sin Vehículo(s)"."</td> </tr>";
								}
								else {	
									$vehiculosdatos=get_vehicle_data($nuc,$conn);
									
									for($i=0; $i<sizeof($vehiculastable); $i++){
										
										echo "	<tr class='even pointer'>";	
										echo"<td  style=' text-align: center;'>".$vehiculastable[$i][1]."</td>";
										echo"<td  style=' text-align: center;'>".$vehiculastable[$i][2]."</td>";
										echo"<td  style=' text-align: center;'>".$vehiculastable[$i][3]."</td>";
										echo"<td  style=' text-align: center;'>".$vehiculastable[$i][4]."</td>";
										echo"<td  style=' text-align: center;'>".$vehiculastable[$i][5]."</td>";
										echo"<td  style=' text-align: center;'>".$vehiculastable[$i][6]."</td>";
										echo"<td  style=' text-align: center;'>".$vehiculastable[$i][7]."</td>";
										echo"<td  style=' text-align: center;'>".$vehiculastable[$i][8]."</td>";
										echo"<td  style=' text-align: center;'>".$vehiculastable[$i][9]."</td>";
										echo"<td  style=' text-align: center;'>".$vehiculastable[$i][10]."</td>";
										echo"<td  style=' text-align: center;'>".$vehiculastable[$i][11]."</td>";
										echo"<td  style=' text-align: center;'>".$vehiculastable[$i][12]."</td>";
										echo"<td  style=' text-align: center;'>".$vehiculastable[$i][13]."</td>";
										echo"<td  style=' text-align: center;'>$".$vehiculastable[$i][14]."</td>";
										/* 	
											$vehiculosdatos[$i][5]=str_ireplace(' ','_',$vehiculosdatos[$i][5]);
											$vehiculosdatos[$i][6]=str_ireplace(' ','_',$vehiculosdatos[$i][6]);
											$vehiculosdatos[$i][7]=str_ireplace(' ','_',$vehiculosdatos[$i][7]);
											$vehiculosdatos[$i][10]=str_ireplace(' ','_',$vehiculosdatos[$i][10]);
											$vehiculosdatos[$i][16]=str_ireplace(' ','_',$vehiculosdatos[$i][16]);
										$vehiculosdatos[$i][17]=str_ireplace(' ','_',$vehiculosdatos[$i][17]); */
										
										////////////////////////////////////	
										$vehiculosdatos[$i][5]= str_replace(" ","%20",$vehiculosdatos[$i][5]);
										$vehiculosdatos[$i][6]= str_replace(" ","%20",$vehiculosdatos[$i][6]);
										$vehiculosdatos[$i][7]= str_replace(" ","%20",$vehiculosdatos[$i][7]);
										$vehiculosdatos[$i][10]= str_replace(" ","%20",$vehiculosdatos[$i][10]);
										$vehiculosdatos[$i][16]= str_replace(" ","%20",$vehiculosdatos[$i][16]);
										$vehiculosdatos[$i][17]= str_replace(" ","%20",$vehiculosdatos[$i][17]);
										
										$vehiculosdatos[$i][5]=trim ( $vehiculosdatos[$i][5] );
										$vehiculosdatos[$i][6]=trim ( $vehiculosdatos[$i][6] );
										$vehiculosdatos[$i][7]=trim ( $vehiculosdatos[$i][7] );
										$vehiculosdatos[$i][10]=trim ( $vehiculosdatos[$i][10] );
										$vehiculosdatos[$i][16]=trim ( $vehiculosdatos[$i][16] );
										$vehiculosdatos[$i][17]=trim ( $vehiculosdatos[$i][17] );
										
										
										echo  '<td  style=" text-align: center;" > <span   onclick=update_vehicle("'.$vehiculosdatos[$i][0].'","'.$vehiculosdatos[$i][1].'","'.$vehiculosdatos[$i][2].'","'.$vehiculosdatos[$i][3].'","'.$vehiculosdatos[$i][4].'","'.$vehiculosdatos[$i][5].'","'.$vehiculosdatos[$i][6].'","'.$vehiculosdatos[$i][7].'","'.$vehiculosdatos[$i][8].'","'.$vehiculosdatos[$i][9]
										.'","'.$vehiculosdatos[$i][10].'","'.$vehiculosdatos[$i][11].'","'.$vehiculosdatos[$i][12].'","'.$vehiculosdatos[$i][13].'","'.$vehiculosdatos[$i][14].'","'.$vehiculosdatos[$i][15].'","'.$vehiculosdatos[$i][16].'","'.$vehiculosdatos[$i][17].'")  ';
										
										echo "data-toggle='tooltip' data-placement='top'
										style='cursor:pointer;   display: inline;'   title='Editar' class='fa fa-pencil-square-o'  fa-lg aria-hidden='true'' > </span>
										&nbsp <span onclick='eliminavehiculo(".$vehiculosdatos[$i][15].")' style='cursor:pointer;   display: inline;'  data-toggle='tooltip' data-placement='top' title='Eliminar' class='fa fa-trash-o  fa-lg aria-hidden='true'> </span> </td>";	
										echo "</tr>";
										
									}
									
								}
								
							?>
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>
<!--------------------------INICIA DIV DE  VICTIMA ------------------------------------------------------   -->    
<div id="victima" class="tabcontent"  style="  display: none;"   >				
	<div class="x_panel" style="display: inline-block; width: 100%;">

		<div id="victim-side-panel" style="width: 15%; float: left;">

			<div class="victim-selected-sidenav" id="principal-side-div" onclick="changeVictimPanel(1)">
				Datos principales
			</div>
			<div class="victim-sidenav" id="general-side-div" onclick="changeVictimPanel(2)">
				Datos generales y de nacimiento
			</div>
			<div class="victim-sidenav" id="address-side-div" onclick="changeVictimPanel(3)">
				Residencia y datos de contacto
			</div>
			<div class="victim-sidenav" id="conditions-side-div" onclick="changeVictimPanel(4)">
				Condiciones
			</div>
			<div class="victim-sidenav" id="legal-support-side-div" onclick="changeVictimPanel(5)">
				Apoyo legal y jurídico, relación con el imputado
			</div>
		
		
		</div>

		<div id="victim-panel" style="width: 84%; float: right;"></div>

		<div id="principal-victim-panel" style="width: 84%; float: right;">

			<div class="x_panel">

				<form id="victimaform" action="#">

					<div class="row">

						<div class="title_left">	

							<div class="col-md-12 col-sm-12 col-xs-12 form-group">

								<div class="buttons">		
									
										<button type="button" class="btn btn-dark" style="height:38px; width: 100px;"  onclick="victimaform(), resetSelectedVictim()">Nuevo</button>	
										<button type="button" id="botonaccion" class="btn btn-success" style="height:38px; width: 100px;"  onclick="return validaV(this.form);">Guardar</button>

								</div>

							</div>

						</div>

					</div>	
					
					
					<div class="row">	

						<div class="x_panel">	

							<div class="form-row">

								<div class="col-md-4 col-sm-12 col-xs-12 form-group">

									<label style="font-weight:bold">Tipo Persona *</label>

									<select id="tipo" name="tipo" style="height: 40px" class="form-control"  required="true" onchange='javascript:desbloqueaCampos()'>
										<option value ="">Selecciona </option>										
										<option value ="1">Fisica</option>
										<option value ="0">Moral</option>										
										<option value ="2">Desconocido</option>	
										<option value ="3">Sociedad</option>	
										<option value ="4">Estado</option>		
									</select>		

								</div>

								<div class="col-md-4 col-sm-12 col-xs-12 form-group">

									<label style="font-weight:bold">Calidad: *</label>

									<select id="calidad" name="calidad" style="height: 40px" class="form-control"  required="true" onchange='valida_lesiones()'  disabled>
										<option value ="">Selecciona </option>								
										<option value ="1">Denunciante</option>
										<option value ="2">Víctima/Denunciante</option>		
										<option value ="3">Lesionado</option>
										<option value ="4">Anonimo</option>										
									</select>

								</div>
								
								<?php

									$crimes_by_nuc = get_crimes_by_nuc($conn,$nuc);

									$crimes_by_nuc_control = '';

									foreach( $crimes_by_nuc as $crime_by_nuc ){
										$crimes_by_nuc_control.='<option value="'.$crime_by_nuc[0].'">'.$crime_by_nuc[1].'</option>';
									}


									$crimes_by_nuc_control = '
									
										<div class="col-md-4 col-sm-12 col-xs-12 form-group">
											<label style="font-weight:bold">Delito: *</label>
											<select id="delito" name="delito" style="height: 40px" class="form-control"  required="true" onchange="valida_lesiones()"  disabled/>
												'.$crimes_by_nuc_control.'
											</select>							
										</div>
									
									';

									echo $crimes_by_nuc_control;


									
								?>
							

							</div>

							<div class="form-row">

								<div class="col-md-4 col-sm-12 col-xs-12 form-group">
									<label style="font-weight:bold">Nombre: *</label>
									<input id="nombre"  type=""   name="nombre" value="" placeholder="Ingresa Nombre" style="height:38px;"  class="fechas form-control" disabled/>						
								</div>

								<div class="col-md-4 col-sm-12 col-xs-12 form-group">
									<label style="font-weight:bold">Paterno: *</label>
									<input id="paterno"  type=""   name="paterno" value="" style="height:38px;"  placeholder="Ingresa Apellido Paterno" class="fechas form-control" disabled/ >						
								</div>

								<div class="col-md-4 col-sm-12 col-xs-12 form-group">
									<label style="font-weight:bold">Materno: *</label>
									<input id="materno"  type=""   name="materno" value="" style="height:38px;" placeholder="Ingresa Apellido Materno"  class="fechas form-control"  disabled/>						
								</div>

							</div>

							<div class="form-row">

								<div class="col-md-4 col-sm-12 col-xs-12 form-group">

									<label style="font-weight:bold">Sexo: *</label>

									<select id="sexo" name="sexo" style="height: 40px" class="form-control"  required="true" disabled/>
										<option value ="">Selecciona </option>								
										<option value ="1">Masculino</option>
										<option value ="2">Femenino</option>
										<option value ="3">Desconocido</option>									
									</select>

								</div>

								<input type="hidden" name="band" value="" />

								<input type="hidden" name="carpeta" value="" />	

								<div class="col-md-4 col-sm-12 col-xs-12 form-group">

									<label style="font-weight:bold">Edad: *</label>	

									<select id="edad" name="edad" style="height: 40px" class="form-control"  required="true"  disabled/>
										<option value="">Selecciona Edad</option>	
										<option value="0">Desconocida</option>		
										<?php 
											$aux=11;
											$cad1="Meses";
											$cad2="Años";
											$valor=-1;
											for ($i=1; $i<12; $i++)
											{	
												echo 	"<option value=".($valor)." >".$i." ".$cad1."</option>";
												$valor--;
											}
											for ($i=1; $i<=120; $i++)
											{	
												echo 	"<option value=".$i." >".$i." ".$cad2."</option>";
												
											}
											
										?>
									</select>	

								</div>

								<div class="col-md-4 col-sm-12 col-xs-12 form-group">

									<label style="font-weight:bold">Escolariad: *</label>	

									<select id="escolaridad" name="escolaridad" class="select10_single form-control" tabindex="-1"  required="true"   disabled >
										<option></option>	
										
										<?php for($i=0; $i<sizeof($escolaridad); $i++){									
											echo 	"<option value=".$escolaridad[$i][0]." >".$escolaridad[$i][1]."</option>";							
										}
										?>
									</select>

								</div>

							</div>

							<div class="form-row">

								<div class="col-md-4 col-sm-12 col-xs-12 form-group">

									<label style="font-weight:bold">Profesión: *</label>

									<select id="profesion" name="profesion" class="select11_single form-control" tabindex="-1"  required="true" disabled  >
										<option></option>							
										<?php for($i=0; $i<sizeof($profesiones); $i++){									
											echo 	"<option value=".$profesiones[$i][0]." >".$profesiones[$i][1]."</option>";							
										}
										?>
									</select>	

								</div>

								<div class="col-md-4 col-sm-12 col-xs-12 form-group">
									
									<label style="font-weight:bold">Nacionalidad: *</label>	

									<select id="nacionalidad" name="nacionalidad" class="select12_single form-control" tabindex="-1"  required="true" disabled>
										<option></option>							
										<?php for($i=0; $i<sizeof($nacionalidad); $i++){									
											echo 	"<option value=".$nacionalidad[$i][0]." >".$nacionalidad[$i][1]."</option>";							
										}
										?>
									</select>
																
								</div>	
							
							</div>

						</div>	

					</div>	

				</form>

			</div>
		
		</div>


			

		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>Involucrado(s):</h2>								
					<div class="clearfix"></div>
				</div>							
				<div class="x_content" >								
					<div id="victimas">
						<div class="table-responsive">
							<table class="table table-striped jambo_table bulk_action">
								<thead>
									<tr class="headings" id="imputed-table-header">												
										<th class="column-title" style='width: 27.27%; text-align: center;'>Nombre </th>
										<th class="column-title" style=' text-align: center;'>Tipo Persona</th>	
										<th class="column-title" style=' text-align: center;'>Calidad</th>													
										<th class="column-title" style=' text-align: center;'>Sexo </th>
										<th class="column-title" style=' text-align: center;'>Edad</th>
										<th class="column-title" style=' text-align: center;'>Escolaridad</th>
										<th class="column-title" style=' text-align: center;'>Profesión</th>
										<th class="column-title" style=' text-align: center;'>Nacionalidad</th>
										<th class="column-title" style=' text-align: center;'>Delito</th>
										<th class="column-title" style=' text-align: center;'>Estatus Captura</th>
										<th class="column-title" style=' text-align: center;'>Acciones</th>												
									</th>
									<th class="bulk-actions" colspan="7">
										<a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
									</th>
								</tr>
							</thead>											
							<tbody>											
								<?php		
									$victima=	get_victima_id($conn,$nuc);
									if(!$victimas){
										echo "	<tr class='even pointer'>";
										
										echo"<td style='text-align: center;'>"."SIN INVOLUCRADOS"."</td> </tr>";
									}
									else {	
										for($i=0; $i<sizeof($victimas); $i++){
											
											echo "	<tr class='even pointer victim-table-row' id='captured-victim-table-row-".$victimas[$i][0]."'>";	
											echo"<td  style='width: 27.27%; text-align: center;'>".$victimas[$i][1]." ".$victimas[$i][2]." ".$victimas[$i][3]."</td>";
											echo"<td  style=' text-align: center;'>".$victimas[$i][4]."</td>";
											echo"<td  style=' text-align: center;'>".$victimas[$i][5]."</td>";
											if($victimas[$i][4]=="Moral"){
											echo"<td  style=' text-align: center;'>N/A</td>";}
											else{
											echo"<td  style=' text-align: center;'>".$victimas[$i][6]."</td>";}
											if($victimas[$i][4]=="Moral"){
											echo"<td  style=' text-align: center;'>N/A</td>";}
											else{
											echo"<td  style=' text-align: center;'>".$victimas[$i][7]."</td>";}
											if($victimas[$i][4]=="Moral"){
											echo"<td  style=' text-align: center;'>N/A</td>";	}
											else {  
												echo"<td  style=' text-align: center;'>".$victimas[$i][10]."</td>";
											}
											if($victimas[$i][4]=="Moral"){
											echo"<td  style=' text-align: center;'>N/A</td>";}
											else{ 
												echo"<td  style=' text-align: center;'>".$victimas[$i][8]."</td>";
											}
											if($victimas[$i][4]=="Moral"){
											echo"<td  style=' text-align: center;'>N/A</td>";	}
											else
											{
												echo"<td  style=' text-align: center;'>".$victimas[$i][9]."</td>";
											}
											/* $victima[$i][1]=str_replace(" ", "-",$victima[$i][1]);
												$victima[$i][2]=str_replace(" ", "-",$victima[$i][2]);
											$victima[$i][3]=str_replace(" ", "-",$victima[$i][3]); */
											/* 	$victima[$i][1]=str_ireplace(' ','_',$victima[$i][1]);
												$victima[$i][2]=str_ireplace(' ','_',$victima[$i][2]);
											$victima[$i][3]=str_ireplace(' ','_',$victima[$i][3]); */
											$victima[$i][1] = str_replace(" ","%20",$victima[$i][1]);
											$victima[$i][2] = str_replace(" ","%20",$victima[$i][2]);
											$victima[$i][3] = str_replace(" ","%20",$victima[$i][3]);
											$victima[$i][1]=trim ( $victima[$i][1] );
											$victima[$i][2]=trim ( $victima[$i][2] );
											$victima[$i][3]=trim ( $victima[$i][3] );

											echo"<td  style=' text-align: center;'>".$victimas[$i][13]."</td>";

											echo"<td id='captured-victim-status-".$victimas[$i][0]."' style=' text-align: center;'></td>";
											
											
											echo  '<td  style=" text-align: center;" > ';


/*

											echo '<span   onclick=editav("'.$victima[$i][0].'","'.$victima[$i][1].'","'.$victima[$i][2].'","'.$victima[$i][3].'","'.$victima[$i][4].'","'.$victima[$i][5].'","'.$victima[$i][6].'","'.$victima[$i][7].'","'.$victima[$i][8].'","'.$victima[$i][9].'","'.$victima[$i][10].'","'.$victima[$i][11].'")  ';
											
											echo "data-toggle='tooltip' data-placement='top'
											style='cursor:pointer;   display: inline;'   title='Agregar delito' class='fa fa-plus-square-o' aria-hidden='true' </span>";



*/


											
											
											echo "<span   onclick='";
											echo 'editav("'.$victima[$i][0].'","'.$victima[$i][1].'","'.$victima[$i][2].'","'.$victima[$i][3].'","'.$victima[$i][4].'","'.$victima[$i][5].'","'.$victima[$i][6].'","'.$victima[$i][7].'","'.$victima[$i][8].'","'.$victima[$i][9].'","'.$victima[$i][10].'","'.$victima[$i][11].'","'.$victima[$i][12].'"),  activeSenapSection("'.$victimas[$i][0].'", "'.$victimas[$i][14].'")';
											echo "'";
											
											echo "data-toggle='tooltip' data-placement='top'
											style='cursor:pointer;   display: inline;'   title='Editar' class='fa fa-pencil' aria-hidden='true' </span>";












											echo "&nbsp <span onclick='eliminav(".$victimas[$i][0].",".$victimas[$i][11].",".$victimas[$i][12].")' style='cursor:pointer;   display: inline;'  data-toggle='tooltip' data-placement='top' title='Eliminar' class='fa fa-trash-o  fa-lg aria-hidden='true'> </span> </td>";	
											echo "</tr>";
											
										}
										
									}
									
								?>
								
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		




	</div>

</div>
</div>


<!--------------------------TErmina div de las victimas      -------------------------------------------------------   -->    
<div id="imputado" class="tabcontent" style="  display: none;"  >

	<div class="x_panel" style="display: inline-block; width: 100%;">

		<div id="imputed-side-panel" style="width: 15%; float: left;">

			<div class="imputed-selected-sidenav" id="principal-imputed-side-div" onclick="changeImputedPanel(1)">
				Datos principales
			</div>
			<div class="imputed-sidenav" id="general-imputed-side-div" onclick="changeImputedPanel(2)">
				Datos generales y de nacimiento
			</div>
			<div class="imputed-sidenav" id="address-imputed-side-div" onclick="changeImputedPanel(3)">
				Residencia y datos de contacto
			</div>
			<div class="imputed-sidenav" id="conditions-imputed-side-div" onclick="changeImputedPanel(4)">
				Condiciones
			</div>
			<div class="imputed-sidenav" id="record-imputed-side-div" onclick="changeImputedPanel(5)">
				Antecedentes y defensa legal
			</div>
			<div class="imputed-sidenav" id="detention-imputed-side-div" onclick="changeImputedPanel(6)">
				Determinación y mandamientos judiciales
			</div>
			<div class="imputed-sidenav" id="crimes-imputed-side-div" onclick="changeImputedPanel(7)">
				Delitos
			</div>
		
		
		</div>

		<div id="imputed-panel" style="width: 84%; float: right;"></div>

		<div id="principal-imputed-panel" style="width: 84%; float: right;">

			<div class="x_panel">

				<form id="imputadoform" action="#">	

					<div class="row">
						<div class="title_left">								
							<div class="col-md-12 col-sm-12 col-xs-12 form-group">
								<div class="buttons">		
																		
										<button type="button" class="btn btn-dark" style="height:38px; width: 100px;"  onclick="limpiaimputado(), resetSelectedImputed()">Nuevo</button>	
										<button type="button" id="botonaccionI" class="btn btn-success" style="height:38px; width: 100px;"  onclick="return validaImputado(this.form);">Guardar</button>
								</div>
							</div>
						</div>
					</div>	

					<div class="row">		

						<div class="x_panel">

                            <div class="form-row">
								<div class="col-md-3 col-sm-12 col-xs-12 form-group">
									<label style="font-weight:bold">Imputado *</label>
									<select id="tipo" name="tipoi" style="height: 40px" class="form-control"  required="true"  onchange="javascript:llenaimputado()"  >
										<option value ="">Selecciona </option>
										<option value ="2">Desconocido</option>		
									</select>							
								</div>	
								
								<div class="col-md-3 col-sm-12 col-xs-12 form-group">
									<label style="font-weight:bold">Nombre: *</label>
									<input id="nombrei"  type=""   name="nombrei" value="" placeholder="Ingresa Nombre" style="height:38px;"  class="fechas form-control" />						
								</div>

								<div class="col-md-2 col-sm-12 col-xs-12 form-group">
									<label style="font-weight:bold">Paterno: </label>
									<input id="paternoi"  type=""   name="paternoi" value="" style="height:38px;"  placeholder="Ingresa Apellido Paterno" class="fechas form-control" / >						
								</div>	

								<div class="col-md-2 col-sm-12 col-xs-12 form-group">
									<label style="font-weight:bold">Materno: </label>
									<input id="maternoi"  type=""   name="maternoi" value="" style="height:38px;" placeholder="Ingresa Apellido Materno"  class="fechas form-control"  />						
								</div>

								<div class="col-md-2 col-sm-12 col-xs-12 form-group">
									<label style="font-weight:bold">Alias: </label>
									<input id="alias"  type=""   name="alias" value="" style="height:38px;"  placeholder="Ingresa Alias" class="fechas form-control" / >						
								</div>

							</div>

							<div class="form-row">

								<div class="col-md-2 col-sm-12 col-xs-12 form-group">
									<label style="font-weight:bold">Sexo: *</label>
                                        <select id="sexoi" name="sexoi" style="height: 40px" class="form-control"  required="true"/>
                                        <option value ="">Selecciona </option>								
                                        <option value ="1">Masculino</option>
                                        <option value ="2">Femenino</option>
                                        <option value ="3">Desconocido</option>									
                                    </select>	
                                </div>
                                

                                <input type="hidden" name="band" value="" />		
                                <input type="hidden" name="carpeta" value="" />		

                                <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                                    <label style="font-weight:bold">Edad: *</label>	
                                    <select id="edadi" name="edadi" style="height: 40px" class="form-control"  required="true" />
                                        <option value="">Selecciona Edad</option>	
                                        <option value="0">Desconocida</option>		
                                        <?php 										
                                            $cad1="Meses";
                                            $cad2="Años";										
                                            for ($i=10; $i<=120; $i++)
                                            {	
                                                echo 	"<option value=".$i." >".$i." ".$cad2."</option>";												
                                            }											
                                        ?>
                                    </select>							
                                </div>

                                <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                                    <label style="font-weight:bold">Escolariad: *</label>	
                                    <select id="escolaridadi" name="escolaridadi" class="select10_single form-control" tabindex="-1"  required="true"    >
                                        <option></option>								
                                        <?php for($i=0; $i<sizeof($escolaridad); $i++){									
                                            echo 	"<option value=".$escolaridad[$i][0]." >".$escolaridad[$i][1]."</option>";							
                                        }
                                        ?>
                                    </select>						
                                </div>

                                <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                                    <label style="font-weight:bold">Profesión: *</label>	
                                    <select id="profesioni" name="profesioni" class="select11_single form-control" tabindex="-1"  required="true"  >
                                        <option></option>							
                                        <?php for($i=0; $i<sizeof($profesiones); $i++){									
                                            echo 	"<option value=".$profesiones[$i][0]." >".$profesiones[$i][1]."</option>";							
                                        }
                                        ?>
                                    </select>							
                                </div>

                                <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                                    <label style="font-weight:bold">Nacionalidad: *</label>	
                                    <select id="nacionalidadi" name="nacionalidadi" class="select12_single form-control" tabindex="-1"  required="true" >
                                        <option></option>							
                                        <?php for($i=0; $i<sizeof($nacionalidad); $i++){									
                                            echo 	"<option value=".$nacionalidad[$i][0]." >".$nacionalidad[$i][1]."</option>";							
                                        }
                                        ?>
                                    </select>							
                                </div>	

                            </div>

							<div class="form-row">
								
								<div class="col-md-4 col-sm-12 col-xs-12 form-group">
									<label style="font-weight:bold">Parentesco Víctima: *</label>	
									<select id="parentesco" name="parentesco" class="select13_single form-control" tabindex="-1"  required="true" >
										<option></option>							
										<?php for($i=0; $i<sizeof($parentesco); $i++){									
											echo 	"<option value=".$parentesco[$i][0]." >".$parentesco[$i][1]."</option>";							
										}
										?>
									</select>							
								</div>

								<div class="col-md-4 col-sm-12 col-xs-12 form-group">
									<label style="font-weight:bold">Organización Delictiva: *</label>	
									<select id="organ" name="organ" class="select14_single form-control" tabindex="-1"  required="true" >
										<option></option>							
										<?php for($i=0; $i<sizeof($organizaciones); $i++){									
											echo 	"<option value=".$organizaciones[$i][0]." >".$organizaciones[$i][1]."</option>";							
										}
										?>
									</select>							
								</div>

								<div class="col-md-4 col-sm-12 col-xs-12 form-group">
									<label style="font-weight:bold">Detenido: *</label>
									<select id="detenido" name="detenido" style="height: 40px" class="form-control"  required="true"/>
										<option value ="">Selecciona </option>								
										<option value ="1">Si</option>
										<option value ="0">No</option>															
									</select>							
								</div>

							</div>

							<div class="form-row">

								<div class="col-md-3 col-sm-12 col-xs-12 form-group">
									<label style="font-weight:bold">Servidor Público: *</label>
									<select id="servidor" name="servidor" style="height: 40px" class="form-control"  required="true" onchange='javascript:bloqueaservidor(this.value)'/>
                                        <option value ="">Selecciona </option>								
                                        <option value ="1">Si</option>
                                        <option value ="2">No</option>															
                                    </select>		
                                </div>	
                                
				
                                <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                                    <label style="font-weight:bold">Cargo: *</label>
                                    <input id="cargo"  type=""   name="cargo" value="" placeholder="Ingresa Cargo" style="height:38px;"  class="fechas form-control"  disabled/>						
                                </div>

                                <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                                    <label style="font-weight:bold">Dependencia: *</label>
                                    <input id="dependencia"  type=""   name="dependencia" value="" placeholder="Ingresa Dependencia" style="height:38px;"  class="fechas form-control" disabled />						
                                </div>

                                <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                                    <label style="font-weight:bold">Área: *</label>
                                    <input id="area"  type=""   name="area" value="" placeholder="Ingresa Area" style="height:38px;"  class="fechas form-control"  disabled/>						
                                </div>

                            </div>
						
						</div>

					</div>

				</form>	

			</div>

		</div>	

		<div class="col-md-12 col-sm-12 col-xs-12">

			<div class="x_panel">

				<div class="x_title">
					<h2>Imputado (s):</h2>
					
					<div class="clearfix"></div>
				</div>

				<div class="x_content" >	
					
					<div id="imputados">

						<div class="table-responsive">

							<table class="table table-striped jambo_table bulk_action">

								<thead>

									<tr class="headings" id="imputed-table-header">
																						
										<th class="column-title" style=' text-align: center;' >Nombre </th>
										<th class="column-title" style=' text-align: center;'>Paterno</th>
										<th class="column-title" style=' text-align: center;'>Materno</th>
										<th class="column-title" style=' text-align: center;'>Sexo</th>
										<th class="column-title" style=' text-align: center;'>Edad</th>												
										<th class="column-title" style=' text-align: center;' >Organización </th>
										<th class="column-title" style=' text-align: center;'>Parentesco</th>
										<th class="column-title" style=' text-align: center;'>Profesión</th>								
										<th class="column-title" style=' text-align: center;'>Detenido</th>
										<th class="column-title" style=' text-align: center;'>Estatus Captura</th>						
										<th class="column-title" style=' text-align: center;'>Acciones</th>
										

                                        <th class="bulk-actions" colspan="7">
                                            <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                        </th>

								    </tr>

							    </thead>

                                <tbody>		
                                    <input type="hidden" name="band_imputado" value="" />		
                                    <input type="hidden" name="carpeta_imputado" value="" />		
                                    <?php		
                                        
                                        
                                        $imputado_tabla= get_imputado_tabla ($conn,$nuc);
                                        
                                        $imputado_valores=get_imputado_valores($conn,$nuc);
                                        
                                        
                                        if(!$imputado_tabla){
                                            echo "	<tr class='even pointer'>";
                                            
                                            echo"<td style='text-align: center;'>"."SIN IMPUTADO (s)"."</td> </tr>";
                                        }
                                        else {	
                                            
                                            for($i=0; $i<sizeof($imputado_tabla); $i++){										
												echo "	<tr class='even pointer imputed-table-row' id='captured-imputed-table-row-".$imputado_tabla[$i][1]."'>";	
												
                                                echo"<td  style='text-align: center;'>".$imputado_tabla[$i][2]."</td>";
                                                echo"<td  style=' text-align: center;'>".$imputado_tabla[$i][3]."</td>";
                                                echo"<td  style=' text-align: center;'>".$imputado_tabla[$i][4]."</td>";
                                                echo"<td  style=' text-align: center;'>".$imputado_tabla[$i][5]."</td>";
                                                echo"<td  style=' text-align: center;'>".$imputado_tabla[$i][6]."</td>";
                                                echo"<td  style=' text-align: center;'>".$imputado_tabla[$i][10]."</td>";
                                                echo"<td  style=' text-align: center;'>".$imputado_tabla[$i][11]."</td>";
                                                echo"<td  style=' text-align: center;'>".$imputado_tabla[$i][12]."</td>";
                                                echo"<td  style=' text-align: center;'>".$imputado_tabla[$i][13]."</td>";
												echo"<td id='captured-imputed-status-".$imputado_tabla[$i][1]."' style=' text-align: center;'></td>";
												$servidor=get_servidorPublico($conn,$imputado_valores[$i][1]);	

												if($servidor!=false){
										
													$servidor[1]= str_replace(" ","%20",	$servidor[1]);
													$servidor[2]= str_replace(" ","%20",	$servidor[2]);
													$servidor[3]= str_replace(" ","%20",	$servidor[3]);
												}
												else
												{
													$servidor[0]=0;
													$servidor[1]="";
													$servidor[2]="";
													$servidor[3]="";		
													
												}
												
                                                $imputado_valores[$i][7]= str_replace('"',"",	$imputado_valores[$i][7]);
                                                $imputado_valores[$i][3]= str_replace('"',"",	$imputado_valores[$i][3]);
                                                $imputado_valores[$i][2]= str_replace('"',"",	$imputado_valores[$i][2]);
                                                $imputado_valores[$i][4]= str_replace('"',"",	$imputado_valores[$i][4]);									
                                                $imputado_valores[$i][3]= str_replace(" ","%20",	$imputado_valores[$i][3]);
                                                $imputado_valores[$i][2]= str_replace(" ","%20",	$imputado_valores[$i][2]);
                                                $imputado_valores[$i][4]= str_replace(" ","%20",	$imputado_valores[$i][4]);
												$imputado_valores[$i][7]= str_replace(" ","%20",	$imputado_valores[$i][7]);
                                                
                                                $imputado_valores[$i][3]=trim ( $imputado_valores[$i][3] );
                                                $imputado_valores[$i][2]=trim ( $imputado_valores[$i][2] );
                                                $imputado_valores[$i][4]=trim ( $imputado_valores[$i][4] );
                                                $imputado_valores[$i][7]=trim ( $imputado_valores[$i][7] );								
                                                
                                                //var_dump ($imputado_valores[$i][7]);
                                                
                                                echo  '<td  style=" text-align: center;" > <span   onclick=cargaImputado("'.$imputado_valores[$i][0].'","'.$imputado_valores[$i][1].'","'.$imputado_valores[$i][2].'","'.$imputado_valores[$i][3].'","'.$imputado_valores[$i][4].'","'.$imputado_valores[$i][5].'","'.$imputado_valores[$i][6].'","'.$imputado_valores[$i][7].'","'.$imputado_valores[$i][8].'","'.$imputado_valores[$i][9].'","'.$imputado_valores[$i][10].'","'.$imputado_valores[$i][11].'","'.$imputado_valores[$i][12]
                                                .'","'.$imputado_valores[$i][13].'","'.$servidor[0].'","'.$servidor[1].'","'.$servidor[2].'","'.$servidor[3].'"),activeImputedSenapSection("'.$imputado_valores[$i][1].'","'.$imputado_valores[$i][14].'") ';
                                                
                                                echo "data-toggle='tooltip' data-placement='top'
                                                style='cursor:pointer;   display: inline;'   title='Editar' class='fa fa-pencil-square-o'  fa-lg aria-hidden='true'' > </span>
                                                &nbsp <span onclick='eliminai(".$imputado_tabla[$i][0].",".$imputado_tabla[$i][1].",".$nuc.")' style='cursor:pointer;   display: inline;'  data-toggle='tooltip' data-placement='top' title='Eliminar' class='fa fa-trash-o  fa-lg aria-hidden='true'> </span> </td>";	
                                                echo "</tr>";
                                                
                                            }
                                            
                                            
                                        }
                                        
                                    ?>
                                    
                                </tbody>

                            </table>

                        </div>

					</div>

				</div>

			</div>

		</div>

    </div>

</div>


<!--------------------------INICIA DIV DE DROGAS------------------------------------------------------   -->

		<div id="droga" class="tabcontent" style="display: none;">
			<div class="x_panel">
				<div class="row">
					<div class="title_left">
						<div class="col-md-12 col-sm-12 col-xs-12 form-group">
							<div class="buttons">
								<form id="drogasv" action="#">

									<button type="button" class="btn btn-dark" style="height:38px; width: 100px;" onclick="limpia_droga()">Nuevo</button>
									<button type="button" id="botonaccionv" class="btn btn-success" style="height:38px; width: 100px;" onclick="guardarDrogaCarpeta(<? echo $arreglo[23]; ?>)">Guardar</button>
							</div>
						</div>

						<div class="row" style="margin:0 auto !important;">
							<div class="x_panel" style="width:100% !important; margin:0 auto !important;">


								<div class="col-md-12 col-sm-12 col-xs-12 form-group" style="margin:0 auto !important;">
									<div class="col-md-3 col-sm-12 col-xs-12 form-group">
										<label style="font-weight:bold">Carpeta: *</label>
										<input id="seriev" type="" name="carpeid" value="<? echo $nuc; ?>" disabled tabindex="0" placeholder="" style="height:38px;" class="fechas form-control" />

									</div>
									<div id="">
										<div class="col-md-3 col-sm-12 col-xs-12 form-group">
											<label style="font-weight:bold">Cantidad: *</label>
											<input id="cantDrog" type="number" name="cantDrog" value="" tabindex="0" placeholder="" style="height:38px;" class="fechas form-control" />
										</div>
									</div>
									<div class="col-md-3 col-sm-12 col-xs-12 form-group">
										<label style="font-weight:bold">Tipo de Droga: *</label>
										<select id="tDrog" name="tDrog" tabindex="4" class="form-control" tabindex="-1" required="true" />
										<option value="0"></option>

										<?php for ($i = 0; $i < sizeof($tipodrogas); $i++) {
											echo 	"<option value=" . $tipodrogas[$i][0] . " >" . $tipodrogas[$i][1] . "</option>";
										}
										?>
										</select>
									</div>
									<div id="">
										<div class="col-md-3 col-sm-12 col-xs-12 form-group">
											<label style="font-weight:bold">Unidad de Medida: *</label>
											<select id="uMedida" tabindex="4" name="uMedida" class="form-control" tabindex="-1" required="true" />
											<option value="0"></option>
											<?php for ($i = 0; $i < sizeof($unidMedidaDrog); $i++) {
												echo 	"<option value=" . $unidMedidaDrog[$i][0] . " >" . $unidMedidaDrog[$i][1] . "</option>";
											}
											?>
											</select>
										</div>
									</div>

								</div>

							</div>
						</div>

						</form>

					</div>
				</div>

				<div class="row">

					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="x_panel">
							<div class="x_title">
								<h2>Droga(s) Asegurada:</h2>
								<div class="clearfix"></div>
							</div>
							<div class="x_content">
								<div id="drogasdiv">

									<div class="table-responsive">
										<table class="table table-striped jambo_table bulk_action">
											<thead>
												<tr class="headings">
													<th class="column-title" style=' text-align: center;'>Tipo </th>
													<th class="column-title" style=' text-align: center;'>Cantidad</th>
													<th class="column-title" style=' text-align: center;'>Unidad de Medida</th>
													<th class="column-title" style=' text-align: center;'>Acciones</th>
													</th>
													<th class="bulk-actions" colspan="7">
														<a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
													</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$dataDrogs = getDataDrogasCarpeta($conn, $arreglo[23]);


												for ($i = 0; $i < sizeof($dataDrogs); $i++) {
												?>
													<tr>
														<?php
														echo "<td  style=' text-align: center;'>" . $dataDrogs[$i][1] . "</td>";
														echo "<td  style=' text-align: center;'>" . $dataDrogs[$i][2] . "</td>";
														echo "<td  style=' text-align: center;'>" . $dataDrogs[$i][3] . "</td>";
														?>
														<td style="text-align: center; cursor:pointer;">
															<span onclick="eliminarDroga(<? echo $dataDrogs[$i][0]; ?>, <? echo $arreglo[23]; ?>)" style="font-size:20px;" class="glyphicon glyphicon-trash" data-toggle="tooltip" data-placement="right" title="Eliminar"></span>
														</td>
													</tr>
												<?php
												}


												?>

											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>


			</div>
		</div>


		<!--------------------------INICIA DIV DE DROGAS------------------------------------------------------   -->


		<!--------------------------INICIA DIV DE ARMAS------------------------------------------------------   -->

		<div id="arma" class="tabcontent" style="display: none;">
			<div class="x_panel">
				<div class="row">
					<div class="title_left">
						<div class="col-md-12 col-sm-12 col-xs-12 form-group">
							<div class="buttons">
								<form id="drogasv" action="#">

									<button type="button" class="btn btn-dark" style="height:38px; width: 100px;" onclick="limpia_arma()">Nuevo</button>
									<button type="button" id="botonaccionv" class="btn btn-success" style="height:38px; width: 100px;" onclick="guardarArmaCarpeta(<? echo $arreglo[23]; ?>)">Guardar</button>
							</div>
						</div>

						<div class="row" style="margin:0 auto !important;">
							<div class="x_panel" style="width:100% !important; margin:0 auto !important;">


								<div class="col-md-12 col-sm-12 col-xs-12 form-group" style="margin:0 auto !important;">
									<div class="col-md-3 col-sm-12 col-xs-12 form-group">
										<label style="font-weight:bold">Carpeta: *</label>
										<input id="seriev" type="" name="carpeid" value="<? echo $nuc; ?>" disabled tabindex="0" placeholder="" style="height:38px;" class="fechas form-control" />

									</div>
									<div class="col-md-3 col-sm-12 col-xs-12 form-group">
										<label style="font-weight:bold">Tipo de Arma: *</label>
										<select id="tarma" name="tarma" tabindex="4" class="form-control" tabindex="-1" required="true" />


										<?php for ($i = 0; $i < sizeof($tarma); $i++) {
											echo 	"<option value=" . $tarma[$i][0] . " >" . $tarma[$i][1] . "</option>";
										}
										?>
										</select>
									</div>
									<div class="col-md-3 col-sm-12 col-xs-12 form-group">
										<label style="font-weight:bold">Marca: *</label>
										<select id="marca" name="marca" tabindex="4" class="form-control" tabindex="-1" required="true" />


										<?php for ($i = 0; $i < sizeof($marcaArma); $i++) {
											echo 	"<option value=" . $marcaArma[$i][0] . " >" . $marcaArma[$i][1] . "</option>";
										}
										?>
										</select>
									</div>

									<div class="col-md-3 col-sm-12 col-xs-12 form-group">
										<label style="font-weight:bold">Calibre: *</label>
										<select id="calibre" name="calibre" tabindex="4" class="form-control" tabindex="-1" required="true" />


										<?php for ($i = 0; $i < sizeof($calibres); $i++) {
											echo 	"<option value=" . $calibres[$i][0] . " >" . $calibres[$i][1] . "</option>";
										}
										?>
										</select>
									</div>

								</div>

								<div class="col-md-12 col-sm-12 col-xs-12 form-group" style="margin:0 auto !important;">


									<div class="col-md-12 col-sm-12 col-xs-12 form-group">
										<label style="font-weight:bold">Matricula: </label>
										<input id="matri" type="text" name="matri" value="" tabindex="0" placeholder="" style="height:38px;" class="fechas form-control" />

									</div>
							

								</div>

							</div>
						</div>

						</form>

					</div>
				</div>

				<div class="row">

					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="x_panel">
							<div class="x_title">
								<h2>Arma(s) Asegurada:</h2>
								<div class="clearfix"></div>
							</div>
							<div class="x_content">
								<div id="armasdiv">

									<div class="table-responsive">
										<table class="table table-striped jambo_table bulk_action">
											<thead>
												<tr class="headings">
													<th class="column-title" style=' text-align: center;'>Tipo </th>
													<th class="column-title" style=' text-align: center;'>Marca</th>
													<th class="column-title" style=' text-align: center;'>Calibre</th>
													<th class="column-title" style=' text-align: center;'>Matricula</th>
													<th class="column-title" style=' text-align: center;'>Acciones</th>
													</th>
													<th class="bulk-actions" colspan="7">
														<a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
													</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$dataArmas = getDataArmasCarpeta($conn, $arreglo[23]);

												for ($i = 0; $i < sizeof($dataArmas); $i++) {
												?>
													<tr>
														<?php
														echo "<td  style=' text-align: center;'>" . $dataArmas[$i][1] . "</td>";
														echo "<td  style=' text-align: center;'>" . $dataArmas[$i][2] . "</td>";
														echo "<td  style=' text-align: center;'>" . $dataArmas[$i][3] . "</td>";
														echo "<td  style=' text-align: center;'>" . $dataArmas[$i][4] . "</td>";
														?>
														<td style="text-align: center; cursor:pointer;">
															<span onclick="eliminarArma(<? echo $dataArmas[$i][0]; ?>, <? echo $arreglo[23]; ?>)" style="font-size:20px;" class="glyphicon glyphicon-trash" data-toggle="tooltip" data-placement="right" title="Eliminar"></span>
														</td>
													</tr>
												<?php
												}


												?>

											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>


			</div>
		</div>


		<!--------------------------INICIA DIV DE ARMAS------------------------------------------------------   -->


		<!--------------------------INICIA DIV DE Maderas------------------------------------------------------   -->

		<div id="madera" class="tabcontent" style="display: none;">
			<div class="x_panel">
				<div class="row">
					<div class="title_left">
						<div class="col-md-12 col-sm-12 col-xs-12 form-group">
							<div class="buttons">
								<form id="drogasv" action="#">

									<button type="button" class="btn btn-dark" style="height:38px; width: 100px;" onclick="limpia_madera()">Nuevo</button>
									<button type="button" id="botonaccionv" class="btn btn-success" style="height:38px; width: 100px;" onclick="guardarMaderaCarpeta(<? echo $arreglo[23]; ?>)">Guardar</button>
							</div>
						</div>

						<div class="row" style="margin:0 auto !important;">
							<div class="x_panel" style="width:100% !important; margin:0 auto !important;">


								<div class="col-md-12 col-sm-12 col-xs-12 form-group" style="margin:0 auto !important;">
									<div class="col-md-3 col-sm-12 col-xs-12 form-group">
										<label style="font-weight:bold">Carpeta: *</label>
										<input id="seriev" type="" name="carpeid" value="<? echo $nuc; ?>" disabled tabindex="0" placeholder="" style="height:38px;" class="fechas form-control" />

									</div>
									<div id="">
										<div class="col-md-3 col-sm-12 col-xs-12 form-group">
											<label style="font-weight:bold">Cantidad: *</label>
											<input id="cantMad" type="number" name="cantMad" value="" tabindex="0" placeholder="" style="height:38px;" class="fechas form-control" />
										</div>
									</div>
									<div class="col-md-3 col-sm-12 col-xs-12 form-group">
										<label style="font-weight:bold">Tipo de Madera: *</label>
										<select id="tMad" name="tMad" tabindex="4" class="form-control" tabindex="-1" required="true" />
										<option value="0"></option>

										<?php for ($i = 0; $i < sizeof($tipomaderas); $i++) {
											echo 	"<option value=" . $tipomaderas[$i][0] . " >" . $tipomaderas[$i][1] . "</option>";
										}
										?>
										</select>
									</div>
									<div id="">
										<div class="col-md-3 col-sm-12 col-xs-12 form-group">
											<label style="font-weight:bold">Unidad de Medida: *</label>
											<select id="uMedidaMad" tabindex="4" name="uMedidaMad" class="form-control" tabindex="-1" required="true" />
											<option value="0"></option>
											<?php for ($i = 0; $i < sizeof($unidMedidaMad); $i++) {
												echo 	"<option value=" . $unidMedidaMad[$i][0] . " >" . $unidMedidaMad[$i][1] . "</option>";
											}
											?>
											</select>
										</div>
									</div>

								</div>

							</div>
						</div>

						</form>

					</div>
				</div>

				<div class="row">

					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="x_panel">
							<div class="x_title">
								<h2>Madera(s) Asegurada:</h2>
								<div class="clearfix"></div>
							</div>
							<div class="x_content">
								<div id="maderasdiv">

									<div class="table-responsive">
										<table class="table table-striped jambo_table bulk_action">
											<thead>
												<tr class="headings">
													<th class="column-title" style=' text-align: center;'>Tipo </th>
													<th class="column-title" style=' text-align: center;'>Cantidad</th>
													<th class="column-title" style=' text-align: center;'>Unidad de Medida</th>
													<th class="column-title" style=' text-align: center;'>Acciones</th>
													</th>
													<th class="bulk-actions" colspan="7">
														<a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
													</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$dataMaderas = getDataMaderaCarpeta($conn, $arreglo[23]);

												for ($i = 0; $i < sizeof($dataMaderas); $i++) {
												?>
													<tr>
														<?php
														echo "<td  style=' text-align: center;'>" . $dataMaderas[$i][1] . "</td>";
														echo "<td  style=' text-align: center;'>" . $dataMaderas[$i][2] . "</td>";
														echo "<td  style=' text-align: center;'>" . $dataMaderas[$i][3] . "</td>";
														?>
														<td style="text-align: center; cursor:pointer;">
															<span onclick="eliminarMadera(<? echo $dataMaderas[$i][0]; ?>, <? echo $arreglo[23]; ?>)" style="font-size:20px;" class="glyphicon glyphicon-trash" data-toggle="tooltip" data-placement="right" title="Eliminar"></span>
														</td>
													</tr>
												<?php
												}


												?>

											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>


			</div>
		</div>


		<!--------------------------INICIA DIV DE MADERAS------------------------------------------------------   -->


<!----------------------------------------------------------------------------- Standard button -->    
<div id="carpeta" class="tabcontent" >			
<form name="captura" action="procesa_captura.php" method="post">
		<input type="hidden" name="nuc" value="<?php echo $nuc ?>" />		
		<input type="hidden" name="carpetaid" value="<?php echo $arreglo[23] ?>" />		
		<input type="hidden" name="expediente" value="<?php echo $arreglo[0]  ?>" />		
		<input type="hidden" name="fechaini" value="<?php echo $arreglo[3]  ?>" />		
		<div class="row">					
			<div class="x_panel">
				<div class="col-md-12 col-sm-12 col-xs-12 form-group">
					<div class="col-md-2 col-sm-12 col-xs-12 form-group">
						<label style="font-weight:bold">Número Expediente:</label>
						<input id="expediente"  type=""   name="expediente" value="<?php echo $arreglo[0] ?>" style="height:38px;"  class="fechas form-control" disabled/>						
					</div>
					<div class="col-md-4 col-sm-12 col-xs-12 form-group">
						<label style="font-weight:bold">Unidad de Investigación *</label>
						
						<select id="unidades" name="unidades" class="select1_single form-control" tabindex="-1"  required="true" />
						<option></option>							
						<?php for($i=0; $i<sizeof($unidades); $i++){		
							if($unidades[$i][0]==$arreglo[2]){
								echo 	"<option value=".$unidades[$i][0]." selected>".$unidades[$i][1]."</option>";			
							}
							else{
								echo 	"<option value=".$unidades[$i][0]." >".$unidades[$i][1]."</option>";			
							}
						}	
						?>
					</select>							
				</div>
				<div class="col-md-2 col-sm-12 col-xs-12 form-group">
					<label style="font-weight:bold">Fecha Inicio: *</label>						
					<input id="fechainicio" type="datetime-local" name="fechainicio" value="<?php echo 	$arreglo[3]?>" style="height:38px;"  class="fechas form-control"  disabled/>								
				</div>
				<div class="col-md-2 col-sm-12 col-xs-12 form-group">
					<label style="font-weight:bold">Fecha Evento: *</label>								
					<input id="fechaevento" type="datetime-local" name="fechaevento" value="<?php echo 	$arreglo[4]=str_ireplace(' ','T',$arreglo[4]);?>" style="height:38px;"  class="fechas form-control"  onblur="validafecha()"/>														
				</div>

					

				<div class="col-md-2 col-sm-12 col-xs-12 form-group">

					<label style="font-weight:bold">Tipo de denuncia: *</label>	

					<div style="display: inline-flex; margin-top: 8px;">
  
						<div>
							<input type="radio" id="presencial" name="tipo-denuncia" value="0" checked>
							<label for="presencial">Presencial</label>
						</div>
						
						
						<div style="margin-left: 10px;">
							<input type="radio" id="digital" name="tipo-denuncia" value="1">
							<label for="digital">Digital</label><br>
						</div>

					</div>
				
				</div>	

				<script>
				var radiopres = document.getElementById("presencial");

				var radiodig = document.getElementById("digital");

				var mod1 = <?php echo $arreglo[25]; ?>;
				if(mod1 == "0" ){
					radiopres.checked = true;
					radiodig.checked = false;
				}
				else{
					radiodig.checked = true;
					radiopres.checked = false;
				}
				</script>

			</div>			
			<div class="col-md-12 col-sm-12 col-xs-12 form-group">
				<div class="col-md-3 col-sm-12 col-xs-12 form-group">
					<label style="font-weight:bold">Municipio  Denuncia *</label>
					<select id="municipio" name="municipio" class="select2_single form-control" tabindex="-1" required="true"  >
						<option></option>								
						<?php for($i=0; $i<sizeof($municipios); $i++){		
							if($municipios[$i][0]==$arreglo[1]){
								echo 	"<option value=".$municipios[$i][0]." selected>".$municipios[$i][1]."</option>";	
							}
							else{
								echo 	"<option value=".$municipios[$i][0]." >".$municipios[$i][1]."</option>";		
							}
						}
						?>
					</select>							
				</div>
				<div class="col-md-3 col-sm-12 col-xs-12 form-group">
					<label style="font-weight:bold">Municipio evento *</label>
					<select id="munevento" name="munevento" class="select2_single form-control" tabindex="-1"   onchange="javascript:cargalocalidad(this)"  required="true">
						<option></option>								
						<?php for($i=0; $i<sizeof($municipios); $i++){	
							if($municipios[$i][0]==$arreglo[7])
							{
								echo 	"<option value=".$municipios[$i][0]." selected>".$municipios[$i][1]."</option>";			
							}
							else {
								echo 	"<option value=".$municipios[$i][0]." >".$municipios[$i][1]."</option>";		
							}
						}
						?>
					</select>							
				</div>
				<div class="col-md-3 col-sm-12 col-xs-12 form-group" >
					<div id="localidad">
						<label style="font-weight:bold">Localidad *</label>
						<?php 
							if($arreglo[8]!=null){
								$consulta="select Nombre from CatLocalidades where LocalidadID=".$arreglo[8];										
								$stmt = sqlsrv_query( $conn, $consulta);
								$row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC );
							}
							
							//	var_dump ($row);
						?>
						<select  name="localidad" id="locali" class="select4_single form-control" tabindex="-1"  required="true" >
							<div id="localidad">									
								<option></option>											
								<?php	
									
									echo 	"<option value=".$arreglo[8]." selected>".$row['Nombre']."</option>";
								?>
							</div>
						</select>		
					</div>
				</div>
				
				<div class="col-md-3 col-sm-12 col-xs-12 form-group">
					<div id="colonias">
						<label style="font-weight:bold">Colonia *</label>
						<?php 
							$consulta="select Nombre from CatColonias where CatColoniasID=".$arreglo[9];										
							$stmt = sqlsrv_query( $conn, $consulta);
							$row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC );
						?>
						<select id="coloni" name="colonia" class="select6_single form-control" tabindex="-1" required="true"  >
							<option></option>		
							<?php	echo 	"<option value=".$arreglo[9]." selected>".$row['Nombre']."</option>";?>
						</select>							
					</div>
				</div>
			</div>
			<div class="col-md-12 col-sm-12 col-xs-12 form-group">
				<div class="col-md-5 col-sm-12 col-xs-12 form-group">
					<label style="font-weight:bold">Calle y Número: </label>						
					<input id="calle" type="" name="calle" value="<?php echo $arreglo[11] ?>" style="height:38px;" placeholder="Ingresa la Calle y Número"  class="fechas form-control" required="true" />								
				</div>						
				
				<div class="col-md-3 col-sm-12 col-xs-12 form-group">
					<label style="font-weight:bold">Lugar *</label>
					<select id="lugar" name="lugar" class="select5_single form-control" tabindex="-1" required="true" >
						<option></option>									
						<?php 
							for($i=0; $i<sizeof($lugares); $i++){	
								if($lugares[$i][0] != 207){
									if($arreglo[10]==$lugares[$i][0]){
										echo 	"<option value=".$lugares[$i][0]." selected>".$lugares[$i][1]."</option>";			
									}
									else{
										echo 	"<option value=".$lugares[$i][0]." >".$lugares[$i][1]."</option>";							
									}
								}
							}
						?>
					</select>							
				</div>
				<div class="col-md-4 col-sm-12 col-xs-12 form-group">
					<label style="font-weight:bold">Tramo Carretero * </label>						
					<input id="tramoc" type="" name="tramoc" value="<?php if($arreglo[12]=="") echo "N/E"; else echo $arreglo[12];?>" style="height:38px;" placeholder="Ingresa el Tramo Carretero"  class="fechas form-control" required="true" />								
				</div>
			</div>

			<div class="row">						
				<div class="x_panel">
					<h2> Georeferenciación del Delito</h2>
					<div class="x_title">					
						<ul class="nav navbar-right panel_toolbox">
							<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
							</li>												
						</ul>
					</div>
				</form>
				<div class="x_content" >	
					<div class="row">
						<div class="col-md-5 col-sm-12 col-xs-12 form-group">
							<label style="font-weight:bold">Dirección:</label>
							<form method="post" id="geocoding_form">		
								<input type="text" id="address" value="" name="caso" id="caso" class="form-control col-md-7 col-xs-12"  style="height:38px;"   placeholder="Ingresa Dirección" />				
							</div>									
							<div class="col-md-1 col-sm-12 col-xs-12 form-group">
								<div class="buttons">
									<!-- Standard button -->                   
									<label style="font-weight:bold">&nbsp &nbsp &nbsp &nbsp </label><br>
									<button type="sumbit" class="btn btn-success" style="height:38px;" >Buscar</button>														
								</form>
							</div>
						</div>												
						<div class="col-md-3 col-sm-12 col-xs-12">
							<label style="font-weight:bold">Latitud </label>
							<input id="latitud"  type=""   name="latitud"  style="height:38px;"  class="fechas form-control" disabled />
							<input type="hidden"  id="lat1" name="lat1" value="" />		
							<input type="hidden" id="lon1" name="lon1" value="" />		
						</div>
						<div class="col-md-3 col-sm-12 col-xs-12">
							<label style="font-weight:bold">Longitud</label>
							<input id="longitud"  type=""   name="longitud"  style="height:38px;"  class="fechas form-control"  disabled />									
						</div>
					</div>
					<br>
					<?php  include ("mapas/examples/markers.php")?>											
				</div>
			</div>
		</div>
	</div>			
	<div class="x_content" >
		
		<div class="row">
			<div class="col-md-4 col-sm-12 col-xs-12 form-group">
					<label style="font-weight:bold">Delito Expediente *</label>							
					<select id="modalidad" name="modalidad" class="select7_single form-control" tabindex="-1"   onchange='valida_ejecución(), valida_relacion_arma_modalidad(), valida_relacion_consumacion_modalidad(), valida_relacion_comision_modalidad(), valida_relacion_violencia_modalidad(), valida_relacion_contexto()'>
						<option></option>
						
						<?php for($i=0; $i<sizeof($modalidades); $i++){		
							
							echo 	"<option value=".$modalidades[$i][0]." >".$modalidades[$i][1]."</option>";		
							
						}
						?>
					</select>							
				</div>
				<div class="col-md-2 col-sm-12 col-xs-12 form-group">				
					<label style="font-weight:bold">¿Ejecución? *</label>
					
					<?php 
						
						echo"	<select id='ejecucion' name='ejecucion' style='height: 40px' class='select7_single form-control'  disabled >
						
						<option></option>
						
						<option value ='1'>Si</option>
						<option value ='0'>No</option>";				
					?>							
					</select>							
				</div>
				<div class="col-md-2 col-sm-12 col-xs-12 form-group">
					<label style="font-weight:bold">Tipo de arma o medio de comisión del delito*</label>
					<select id="tipoarma" name="tipoarma" class="select7_single form-control" tabindex="-1" onchange='valida_relacion_arma_modalidad()'    disabled>
						
						<option></option>
						<?php for($i=0; $i<sizeof($armas); $i++){	
							if($arreglo[6]==$armas[$i][0]){
								echo 	"<option value=".$armas[$i][0]." selected>".$armas[$i][1]."</option>";
							}
							else{
								echo 	"<option value=".$armas[$i][0]." >".$armas[$i][1]."</option>";			
							}
						}
						?>
					</select>							
				</div>
				<div class="col-md-2 col-sm-12 col-xs-12 form-group">				
					<label style="font-weight:bold">Calif. del Delito *</label>
					<select id="calificacion" name="calificacion" style="height: 40px" class="form-control"  >
						<?php						
							
							echo "
							<option value =''>Selecciona </option>								
							<option value ='1'>Grave</option>
							<option value ='0'>No Grave</option>";				
							
						?>							
					</select>							
				</div>
				<div class="col-md-2 col-sm-12 col-xs-12 form-group">
					<label style="font-weight:bold">Orden al Resultado *</label>
					<select id="caliresultado" name="caliresultado" style="height: 40px" class="form-control"  >
						<?php 
							
							echo"<option value =''>Selecciona </option>								
							<option value ='0'>Instantaneo</option>
							<option value ='1'>Permanente</option>
							<option value ='2'>Continuado</option>";
							
						?>								
					</select>							
				</div>
		</div>
		
		

		<div class="row">
				<div class="col-md-3 col-sm-12 col-xs-12 form-group">
					<label style="font-weight:bold">Modalidad del Delito *</label>
					<?php  $modadel=["Simple","Atenuado","Agravado","Calificado","Agravado/Calificado"]; ?>
					<select id="modadelito" name="modadelito" style="height: 40px" class="form-control"  >
						<?php 
							/* 	$bandcosa=false;
								for($i=0; $i<sizeof($modadel); $i++)
								{
								$bandcosa=true;;
								if($arreglo[19]==$i)
								echo "<option value ='".$i."' selected>".$modadel[$i]."</option>";
								else
								echo "<option value ='".$i."' >".$modadel[$i]."</option>";
								}
								
							if(	$bandcosa=false) */
							{
								echo "
								<option value =''>Selecciona </option>								
								<option value ='0'>Simple</option>
								<option value ='1'>Atenuado</option>
								<option value ='2'>Agravado</option>
								<option value ='3'>Calificado</option>
								<option value ='4'>Agravado/Calificado</option>	";										
							}
						?>							
					</select>							
				</div>
				<div class="col-md-3 col-sm-12 col-xs-12 form-group">						
					<label style="font-weight:bold">Consumación *</label>		
					<?php //var_dump($arreglo[16]);?>
					<select id="consumacion" name="consumacion" style="height: 40px" class="form-control"  >								
						<?php 
							/* 
								if($arreglo[16]==1){
								echo "<option value ='1' selected>Consumado</option>";
								echo "<option value ='0'>Tentativa</option>";
								}
								else if($arreglo[16]==0){
								echo "<option value ='0' selected>Tentativa</option>";
								echo "<option value ='1'>Consumado</option>";
								}
								
							else */
							{
								echo "
								<option value =''>Selecciona</option>
								<option value ='1'>Consumado</option>
								<option value ='0'>Tentativa</option>";										
							}
						?>							
					</select>								
				</div>
				<div class="col-md-2 col-sm-12 col-xs-12 form-group">
					<label style="font-weight:bold">Concurso *</label>
					<select id="concurso" name="concurso" style="height: 40px" class="form-control"  >
						<?php 
							/* 
								
								if($arreglo[21]==0){
								echo "<option value ='0' Selected>Ideal</option>";
								echo "<option value ='1' >Real</option>";
								echo "<option value ='2'>No hay Concurso</option>";
								echo "<option value ='3'>No se Sabe</option>";
								}
								else if ($arreglo[21]==1){
								echo "<option value ='0' >Ideal</option>";
								echo "<option value ='1' selected>Real</option>";
								echo "<option value ='2'>No hay Concurso</option>";
								echo "<option value ='3'>No se Sabe</option>";
								}
								else if ($arreglo[21]==2){
								echo "<option value ='0' >Ideal</option>";
								echo "<option value ='1' >Real</option>";
								echo "<option value ='2' selected>No hay Concurso</option>";	
								echo "<option value ='3' >No se Sabe</option>";
								}
								
								else if ($arreglo[21]==3){
								echo "<option value ='0' >Ideal</option>";
								echo "<option value ='1' >Real</option>";
								echo "<option value ='2' >No hay Concurso</option>";	
								echo "<option value ='3' selected>No se Sabe</option>";
								}
								else */ {
								echo "<option value =''>Selecciona </option>								
								<option value ='0'>Ideal</option>
								<option value ='1'>Real</option>
								<option value ='2'>No Hay Concurso</option>";		
								echo "<option value ='3' >No se Sabe</option>";
							}
						?>							
						
					</select>							
				</div>				
				<div class="col-md-2 col-sm-12 col-xs-12 form-group">
					<label style="font-weight:bold">Violencia *</label>
					
					<select id="violencia" name="violencia" class="select7_single form-control" tabindex="-1"  disabled >
						<option></option>
						<?php 
							if($arreglo[5]==1){
								echo "<option value ='1' selected>Violento</option>";
								echo "<option value ='0'>No Violento</option>";
							}
							else 	{
								echo "<option value ='0' selected>No Violento</option>";
								echo "<option value ='1'>Violento</option>";
							}
						?>				
					</select>							
				</div>
				<div class="col-md-2 col-sm-12 col-xs-12 form-group">
					<label style="font-weight:bold">Comisión *</label>
					<select id="comision" name="comision" style="height: 40px" class="form-control"  >
						<?php 
							
							/* if($arreglo[17]==1){
								echo "<option value ='1' selected>Doloso</option>";
								echo "<option value ='0'>Culposo</option>";
								}
								else if ($arreglo[17]==0){
								echo "<option value ='0' selected>Culposo</option>";
								echo "<option value ='1'>Doloso</option>";
								}
								
								else */{
								echo "<option value =''>Selecciona</option>
								<option value ='1'>Doloso</option>
								<option value ='0'>Culposo</option>";
								
							}
						?>							
					</select>									
				</div>
		</div>
		
		
		
		<div class="row">

				<?php

					$s_context = get_situational_context($conn,$nuc);

					$s_context_control = '';

					foreach( $s_context as $sc_element ){
						$s_context_control.='<option value="'.$sc_element[0].'">'.$sc_element[1].'</option>';
					}


					$s_context_control = '
					
						<div class="col-md-3 col-sm-12 col-xs-12 form-group" id="situational-context-section">
							<label style="font-weight:bold">Contexto situacional: * (Para Homicidio doloso y Lesiones dolosas)</label>
							<select id="situational-context" name="situational-context" style="height: 40px" class="form-control"/>
								<option value="">Selecciona</option>
								'.$s_context_control.'
							</select>							
						</div>
					
					';

					echo $s_context_control;


					
				?>
			
			<div id="boton_agregar">
				<div id="botondescargaact" class="btn pull-right">
					<div id="boton_update_delito">
					<button type="button" class="btn btn-dark" style="height:38px;  align:right; "  onclick = "limpia_formulario(<? echo $arreglo[23] ?>,0,1)">Nuevo Registro</button>
					
					<button type="button" class="btn btn-success" style="height:38px;  align:right; "  onclick = "agregar_delito_concurso(<? echo $arreglo[23] ?>,0,1)">Agregar Delito</button>
				</div>
				
				<div lass="btn btn-success"  id="descarga_excel"></div>
			</div>
		</div>
		
		
		
		<div class="row">		
			


	<div class="x_panel">
		<h2> Delito principal y complementarios en la carpeta de Investigación</h2>
		<div class="x_title">
			<ul class="nav navbar-right panel_toolbox">
				<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
				</li>
			</ul>
		</div>	
		<div class="x_content" >	
			<div class="row">
				<div id="formulario_delitos">
					<table id="datatable" class="table table-striped table-bordered">
						<thead>
							<tr style="background: #5A738E;  color: white;">			
								<th class="column-title" style=' text-align: center;'>#</th>
							<th class="column-title" style=' text-align: center;'>Delito</th>												
							<th class="column-title" style=' text-align: center;'>Consumación</th>									
							<th class="column-title" style=' text-align: center;'>¿Principal?</th>
							
							<th class="column-title" style=' text-align: center;'>Acciones</th>
							
							</tr>
						</thead>
						
						<?php	
							
							if($delitos!=false){
								for( $i=0; $i<sizeof($delitos); $i++)
								{	
									$datos_actualizar=get_datos_actalizar($conn,$delitos[$i][0],$arreglo[23]);
									
									$bandera_principal=0;
									if($delitos[$i][3]=="Sí")
									$bandera_principal=1;
									echo "<tr>";		
									echo "<td style='text-align: center; vertical-align: middle;' >".($i+1)."</td>";
									echo "<td style=' center; vertical-align: middle;'>".$delitos[$i][1]."</td>";
									echo "<td style='text-align: center; vertical-align: middle;'> ".$delitos[$i][2]."</td>";
									echo "<td style='text-align: center; vertical-align: middle;'> ".$delitos[$i][3]."</td>";														
									
									echo '<td style=" text-align: center; vertical-align: middle;" >';
									
									echo '  <span onclick=carga_delito("'.$nuc.'","'.$datos_actualizar[0][0].'","'.$datos_actualizar[0][1].'","'.$datos_actualizar[0][2]
									.'","'.$datos_actualizar[0][3].'","'.$datos_actualizar[0][4].'","'.$datos_actualizar[0][5].'","'.$datos_actualizar[0][6].'","'.$datos_actualizar[0][7]
									.'","'.$datos_actualizar[0][8].'","'.$datos_actualizar[0][9].'","'.$datos_actualizar[0][10].'","'.$datos_actualizar[0][11].'")'." 
									style='cursor:pointer;   display: inline;'  data-toggle='tooltip' data-placement='top'
									title='Editar Delito' class='fa fa-pencil  fa-lg aria-hidden='true'> </span>";
									
									if($delitos[$i][3]!="Sí")
									echo '  <span onclick=eliminar_delito("'.$delitos[$i][0].'","'.$arreglo[23].'")'." 
									style='cursor:pointer;   display: inline;'  data-toggle='tooltip' data-placement='top'
									title='Eleminar Elemento' class='fa fa-trash-o  fa-lg aria-hidden='true'> </span>";
									
									if($delitos[$i][3]!="Sí")
									echo ' <span onclick=cambiar_principal("'.$delitos[$i][0].'","'.$arreglo[23].'")'." 
									style='cursor:pointer;   display: inline;'  data-toggle='tooltip' data-placement='top'
									title='Cambiar a delito principal' class='fa fa-refresh  fa-lg aria-hidden='true'> </span>
									
									
									
									</td>";
									echo "</tr>";
								}
							}else
							{
								echo "<tr>";		
								echo "<td style='text-align: center; vertical-align: middle;' >Sin Elementos</td>";
								echo "</tr>";		
							} 
							
						?>
					</table>
					
					</div>
					
					
					
					
				</div>
				
			</div>
		</div>
		<div class="x_panel">
			<div class="row">
				<div class="x_panel">
					<h2> Tipo y Monto del Robo<small>   Ingresa los articulos robados y el monto aproximado (Robo a Transportista)</small></h2>
					<div class="x_title">
						<ul class="nav navbar-right panel_toolbox">
							<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
							</li>
						</ul>
					</div>
					
					<div class="x_content" >	
						<div class="row">
							
							<div class="col-md-8 col-sm-12 col-xs-12 form-group">
								<label style="font-weight:bold">Tipo de Elemento *</label>
								<select id="elemento" name="elemento" class="select22_single form-control" tabindex="-1"   >
									<option></option>
									<?php	for( $i=0; $i<sizeof($elementos_catalogo); $i++)
										echo "	<option value =".$elementos_catalogo[$i][0].">".$elementos_catalogo[$i][1]."</option>";
										
									?>
									
								</select>									
							</div>	
							<div class="col-md-4 col-sm-12 col-xs-12 form-group">
								<label style="font-weight:bold">Monto Aproximado del Robo *</label>
								<input id="monto_apr"  type="number"   name="monto_apr"  value="" style="height:38px;"  class="fechas form-control" />										
							</div>
							<div id="botondescargaact" class="btn pull-right">
								
								<button type="button" class="btn btn-primary" style="height:38px;  align:right; "  onclick = "guarda_elementos_robados(<? echo $nuc ?>,0,<?php echo $arreglo[23] ?>)">Agregar</button>
								
								<div lass="btn btn-success"  id="descarga_excel"></div>
							</div>
							<div id="elementos">
								<table id="datatable" class="table table-striped table-bordered">
									<thead>
										<tr style="background: #5A738E;  color: white;">			
											<th class="column-title" style=' text-align: center;'>#</th>
											<th class="column-title" style=' text-align: center;'>Elemento  Robado</th>
											<th class="column-title" style=' text-align: center;'>Monto </th>
											<th class="column-title" style=' text-align: center;'>Acciones</th>
											
										</tr>
									</thead>
									<?php 
										$cantidad_elementos=0;
										if($elementos!=false){
											for( $i=0; $i<sizeof($elementos); $i++)
											{
												$cantidad_elementos++;
												echo "<tr>";		
												echo "<td style='text-align: center; vertical-align: middle;' >".($i+1)."</td>";
												echo "<td style=' center; vertical-align: middle;'>".$elementos[$i][1]."</td>";
												echo "<td style='text-align: center; vertical-align: middle;'>$ ".number_format ($elementos[$i][2])."</td>";
												echo '<td style=" text-align: center; vertical-align: middle;" >';		
												
												echo '  <span onclick=guarda_elementos_robados("'.$nuc.'","'.$elementos[$i][0].'")'." 
												style='cursor:pointer;   display: inline;'  data-toggle='tooltip' data-placement='top'
												title='Eliminar Elemento' class='fa fa-trash-o  fa-lg aria-hidden='true'> </span> </td>";
												echo "</tr>";
											}
										}else
										{
											echo "<tr>";		
											echo "<td style='text-align: center; vertical-align: middle;' >Sin Elementos</td>";
											echo "</tr>";		
										} ?>
								</table>
								<input type="hidden" name="elementos_trans" value="<?php echo $cantidad_elementos ?>" />	
							</div>
						</div>
						
						
					</div>
				</div>
			</div>
		</div>
		
		
		<div class="col-md-12 col-sm-12 col-xs-12 form-group">
			<label  for="message">Descripción de los Hechos:</label>						
			<textarea rows="7" name="hechos" id="message"   class="form-control" name="message" placeholder="Ingresa Hechos....." ><?php echo  $arreglo[22] ?></textarea>							
		</div>	
	</form>
	<div class="col-md-12 col-sm-12 col-xs-14 form-group">							
		<button   type="submit" class="btn btn-primary btn-lg btn-block" onclick="return valida_carpeta(this.form),valida_coordenadas(),valida_robo_transportista()">Actualizar</button>
	</form>
</div>			
</div>		
</div>	
</div>
</div>
<br>				

</div>


<!-- /page content -->

<!-- footer content -->

<!-- /footer content -->

<script src="../dist/sweetalert.min.js"></script> 
<!-- jQuery -->
<script src="../vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="../vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="../vendors/nprogress/nprogress.js"></script>

<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js"></script>

<script src="../vendors/moment/min/moment.min.js"></script>
<script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap-wysiwyg -->
<script src="../vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>

<!--<script src="../vendors/google-code-prettify/src/prettify.js"></script>-->

<!-- Select2 -->
<script src="../vendors/select2/dist/js/select2.full.min.js"></script>

<?php

			$victims_array = [];

			//echo json_encode($victima, JSON_FORCE_OBJECT);

			//echo count($victima);

			if($victima){
				foreach($victima as $victim_element ) {

					array_push($victims_array, array(
						'id' => $victim_element[0],
						'name' => $victim_element[1],
						'paternal_surname' => $victim_element[2],
						'maternal_surname' => $victim_element[3],
						'type' => $victim_element[4],
						'status' => $victim_element[5],
						'gener' => $victim_element[6],
						'age' => $victim_element[7],
						'profession' => $victim_element[8],
						'nationality' => $victim_element[9],
						'scholarship' => $victim_element[10],
						'folder_id' => $victim_element[11],
						'crime' => $victim_element[12]
					));
		
				}
			}

			
		?>

<script>
	$(document).ready(function(){
		//$('[data-toggle="tooltip"]').tooltip();   


		

		console.log('a ver?');

		loadVictimsData(<? echo json_encode($victims_array).', "'.$nuc.'", "'.$arreglo[23].'", '.json_encode($crimes_by_nuc); ?>);
		loadImputedsData(<? echo json_encode(array()).', "'.$nuc.'", "'.$arreglo[23].'"'; ?>);

	});
</script>
<script>	
	
	$(document).ready(function() {		
		
		$(".select1_single").select2({
			placeholder: "Selecciona UIE",
			allowClear: true
		});		
	});
</script>
<script>	
	function editav(involucrado,nombre,paterno,materno,sexo,edad,calidad,tipo,profesion,nacionalidad,escolaridad,carpeta,delito)
	{
		//alert (involucrado+"-"+nombre+"-"+paterno+"-"+materno+"-"+sexo+"-"+edad+"-"+calidad+"-"+tipo+"-"+profesion+"-"+nacionalidad+"-"+escolaridad+"-"+carpeta);
		//console.log("delito", delito);
		
		$("#botonaccion").html('Actualizar');
		
		document.getElementsByName("band")[0].value=involucrado;
		document.getElementsByName("carpeta")[0].value=carpeta;
		edad=parseInt(edad);
		for(i=0; i<nombre.length; i++){		
			nombre=nombre.replace('%20',' ');		
		}
		for(i=0; i<paterno.length; i++){		
			paterno = paterno.replace('%20',' ');
		}
		for(i=0; i<materno.length; i++){		
			materno = materno.replace('%20','  ');	
		}
		
		if(tipo==1 || tipo==2)
		{
			document.getElementById("nombre").disabled = false;
			document.getElementById("calidad").disabled = false;
			document.getElementById("paterno").disabled = false;
			document.getElementById("materno").disabled = false;
			document.getElementById("sexo").disabled = false;
			document.getElementById("edad").disabled = false;
			document.getElementById("profesion").disabled = false;
			document.getElementById("nacionalidad").disabled = false;
			document.getElementById("escolaridad").disabled = false;		
			document.getElementById("delito").disabled = false;		
		}
		else if(tipo==0 || tipo==3 ||tipo==4)
		{			
			document.getElementById("nombre").disabled = false;
			document.getElementById("calidad").disabled = false;
			document.getElementById("paterno").disabled = true;
			document.getElementById("materno").disabled = true;
			document.getElementById("sexo").disabled = true;
			document.getElementById("edad").disabled = true;
			document.getElementById("profesion").disabled = true;
			document.getElementById("nacionalidad").disabled=true;
			document.getElementById("escolaridad").disabled = true;		
			document.getElementById("delito").disabled = false;	
		}
		
		if(edad<0){
		edad=Math.abs(edad);}

		switch(tipo){
			case '0':
				document.getElementById('tipo').selectedIndex=2;
			break;

			case '1':
				document.getElementById('tipo').selectedIndex=1;
			break;

			case '2':
				document.getElementById('tipo').selectedIndex=3;
			break;

			case '3':
				document.getElementById('tipo').selectedIndex=4;
			break;

			case '4':
				document.getElementById('tipo').selectedIndex=5;
			break;
		}
		
		if(edad==0){
		document.getElementById('edad').selectedIndex=1;}
		else if(edad<13){			
		document.getElementById('edad').selectedIndex=edad+1;}
		else{
		document.getElementById('edad').selectedIndex=edad+12;}		
		
		document.getElementById('sexo').selectedIndex=sexo;
		
		document.getElementById('escolaridad').selectedIndex=escolaridad;
		$(".select10_single").select2({
			placeholder: "Selecciona Escolaridad",
			allowClear: true
		});
		document.getElementById('profesion').selectedIndex=profesion;
		$(".select11_single").select2({
			placeholder: "Selecciona profesión",
			allowClear: true
		});
		document.getElementById('nacionalidad').selectedIndex=nacionalidad;
		$(".select12_single").select2({
			placeholder: "Selecciona Nacionalidad",
			allowClear: true
		});
		document.getElementById('calidad').selectedIndex=calidad;
		document.getElementById('nombre').value=nombre;
		document.getElementById('paterno').value=paterno;
		document.getElementById('materno').value=materno;

		if(delito != ""){
			document.getElementById('delito').value=delito;	
		}
		else{
			document.getElementById('delito').selectedIndex=0;
		}
			
	}
	
</script>
<script>
	$(document).ready(function() {		
		$(".select5_single").select2({
			placeholder: "Selecciona Lugar",
			allowClear: true
		});		
	});
</script>
<script>
	$(document).ready(function() {		
		$(".select6_single").select2({
			placeholder: "Selecciona Colonia",
			allowClear: true
		});			
	});
</script>
<script>
	$(document).ready(function() {
		
		
		$(".select7_single").select2({
			placeholder: "Selecciona ",
			allowClear: true
		});	
	});
</script>
<script>
	$(document).ready(function() {		
		$(".select3_single").select2({
			placeholder: "Selecciona UIE",
			allowClear: true
		});
		$(".select13_single").select2({
			placeholder: "Selecciona Parentesco",
			allowClear: true
		});
		$(".select14_single").select2({
			placeholder: "Selecciona Organización",
			allowClear: true
		});
		
	});
	
	function guarda_elementos_robados(nuc,id,carpeta_id)
	
	
	{
		
		
		
		monto = document.getElementById('monto_apr').value;
		elemento = document.getElementById('elemento').value;
		if(monto=="" && id==0){
			sweetAlert("Ups!..", "Debes ingresar un monto aproximando", "error");
			return false;
		}
		if(elemento=="" && id==0){
			sweetAlert("Ups!..", "Debes seleccionar un elemento del robo", "error");
			return false;
		}
		if(monto<0 && id==0){
			sweetAlert("Ups!..", "El monto no puede ser negativo", "error");
			return false;
		}
		if(monto==0 && id==0){
			sweetAlert("Ups!..", "El monto no puede ser cero", "error");
			return false;
		}
		///////////////////////////////////////////
		
		
		cont = document.getElementById('elementos');
		ajax = objetoAjax();
		
		ajax.open("POST", "guarda_elementos.php");
		ajax.onreadystatechange = function() {
			
			if (ajax.readyState == 4 && ajax.status == 200) {
				cont.innerHTML = ajax.responseText;
				/* $('#datatable').dataTable();
					$('#datatable-keytable').DataTable({
					keys: true
				}); */
				
				document.getElementById('elemento').selectedIndex='0';
				monto = document.getElementById('monto_apr').value="";
				$(".select22_single").select2({
					placeholder: "Selecciona Elemento",
					allowClear: true
				}); 
				
			}
		}
		//como hacemos uso del metodo POST		
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		//enviando el codigo del empleado
		ajax.send("&elemento=" + elemento + "&monto=" + monto + "&nuc=" + nuc +  "&id=" + id+"&carpeta_id=" + carpeta_id);
		
		
		//////////////////////////////////////////
	}
</script>

<script>
	$(document).ready(function() {		
		$(".select4_single").select2({
			placeholder: "Selecciona Localidad",
			allowClear: true
		});
		$(".select22_single").select2({
			placeholder: "Selecciona Elemento",
			allowClear: true
		});
		
	});
</script>
<script>
	$(document).ready(function() {
		
		$(".select2_single").select2({
			placeholder: "Selecciona Municipio",
			allowClear: true
		});
		
	});
	function valida_robo_transportista(){
		
		bandera=1;
		cantidad=document.getElementsByName("elementos_trans")[0].value;
		if(document.getElementById('modalidad').value==82 )
		
		//	&& document.getElementsByName("elementos_trans")[0].value==0)
		{
			if(cantidad==0)
			bandera=0;
			
		}
		
		if(bandera==0){
			sweetAlert("Ups!..", "En el robo a transportista, debes seleccionar un elemento robado y el monto aproximado", "error");
			return false;
			
		}
		
		
	}
	function valida_coordenadas()
	{
		
		latitud = document.getElementById('latitud').value;
		longitud = document.getElementById('longitud').value;		
		if (!/^([0-9])*$/.test(latitud) ||  latitud==0  ){
			if(latitud<17.8000 || latitud>20.4000)
			{			
				sweetAlert("Ups!..", "La Georeferenciación es incorrecta o se encuentra fuera de MICHOACÁN", "error");
				//	latitud = document.getElementById('latitud').value="";
				latitud = document.getElementById('latitud').value="";
				Longitud = document.getElementById('longitud').value="";
				
				return false
			}
		}
		if (!/^([0-9])*$/.test(longitud) ||  longitud==0 ){	
			if(longitud>-100.0600|| longitud<-104.0000){
				sweetAlert("Ups!..", "La Georeferenciación es incorrecta o se encuentra fuera de MICHOACÁN", "error");
				
				latitud = document.getElementById('latitud').value="";
				longitud = document.getElementById('longitud').value="";
				return false
			}
		}
	}
</script>

</body>
</html>
