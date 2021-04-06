<?  

include ("../Conexiones/Conexion.php");
include("../funciones.php");	

if (isset($_POST["idUsuario"])){ $idUsuario = $_POST["idUsuario"]; }
if (isset($_POST["idUnidad"])){ $idUnidad = $_POST["idUnidad"]; }



$fecha_actual_system=date("d/m/Y");

$anioactualdate = date("Y");


$anioCaptura = 2021;


$enlace = getIdEnlaceUsuario($conn, $idUsuario);
$idEnlace = $enlace[0][0];

if($idEnlace != 0){

	$mescap = getMesCapEnlaceArchivo($conn, $idEnlace, 1);	
	$mescapen = $mescap[0][0];
	$mesCapturar = $mescapen;

	$mesNom = Mes_Nombre($mesCapturar);
}else{


	$mesCapturar = 1;

}


?>

<html>
<body>
	<head>
	</head>
	<div id="contenido">
		<div class="right_col" role="main" style ="height: auto;">

			<div style="" class="x_panel principalPanel">

				<div class="x_panel panelCabezera">

					<table border="0" class="alwidth">						
						<tr>								
							<td id="nomostrar" class="imgSelloCabezera" width="5%" height="125"></td>								
							<td width="50%">
								<div class="tituloCentralSegu">
									<div class="titulosCabe1">
										<label class="titulo1">Repositorio de Formatos Estadísticos DPE</label>
										<h4> <label class="titulo2">Fiscalía General del Estado de Michoácan</label></h4>
									</div>
								</div>
							</td>
							<td id="nomostrar" class="imgdgtipeCabezera" width="10%" height="125"></td>
						</tr>
					</table>

				</div>

				<div class="row">

					<div class="col-xs-12 col-sm-2  col-md-2">
						<label for="heard">Año:</label><br>
						<select id="anioArchSelectedAdmin" name="selMes" tabindex="6" onchange="updTableArchAdmin(<? echo $idEnlace; ?>);"  class="form-control redondear selectTranparent" required>
							<option value="2019" >2019</option>
							<option value="2020" >2020</option>
							<option value="2021" selected>2021</option>
						</select>
					</div>

					<div class="col-xs-12 col-sm-2  col-md-2">
						<label for="heard">Mes:</label><br>
						<select id="mesAdminarch" name="selMes" tabindex="6" class="form-control redondear selectTranparent" onchange="updTableArchAdmin(<? echo $idEnlace; ?>);" required>

							<?

							$arrayMes = array('Enero','Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');

							for ($i=1; $i <= 12; $i++) { 

								if( $i == $mesCapturar ){ 

									?>
									<option value="<? echo $i; ?>" selected><? echo $arrayMes[$i-1]; ?></option>
									<?}else{?>
										<option value="<? echo $i; ?>"><? echo $arrayMes[$i-1]; ?></option>
										<?
									}	

								} 


								?>


							</select>
						</div>

						<div class="col-xs-12 col-sm-10  col-md-6">
							<label for="heard">Enlace:</label>
							<div id="contenidoEnlacesSelect">							
								<select id="enlaceid" class="form-control redondear selectTranparent" onchange="updTableArchAdmin2();" required>								



									<option value="0" selected="">Todos</option>

									<? 

									$enlances = getAllEnlacesInfoUNidad($conn, 1);

									for ($i=0; $i < sizeof($enlances); $i++) { 


										$idEnl = $enlances[$i][0];
										$nomEnl = $enlances[$i][1];
										$nUn = $enlances[$i][2];
										$pater = $enlances[$i][3];
										$matern = $enlances[$i][4];

										?>
										<option value="<? echo $idEnl; ?>"><? echo $nomEnl." ".$pater." ".$matern."  -  ".$nUn ?></option>
										<?

									}

									?>


								</select>

							</div>
						</div>

						<div class="col-xs-12 col-sm-10  col-md-2">
							<label for="heard">Tipo Archivo:</label>
							<div id="contenidoProyectosListAgru">							
								<select id="tipoarchReposi" class="form-control redondear selectTranparent" onchange="cargarEnlacesSelecTipoArch();" required>							



									<option value="1" selected="">Carpetas de Investigacíon</option>
									<option value="4"="">Litigación</option>

									<? 

									?>


								</select>

							</div>
						</div>
						<br>
					</div>
					<!-- Aqui comienza la tabla para el repositorio de archivos -->

					<div id="contenidoTablaRepositorioAdmin">


						<BR>
						<table class="table table-striped tblTransparente "  style="padding: 50px !important;">
							<thead>
								<tr class="cabezeraTabla ">
									<th class="col-xs-12 col-sm-12 col-md-1 textCent">No</th>
									<th class="col-xs-12 col-sm-12 col-md-3 textCent">Nombre Archivo</th>
									<th class="col-xs-12 col-sm-12 col-md-2 textCent">Enlace</th>
									<th class="col-xs-12 col-sm-12 col-md-1 textCent">Fecha Subida</th>
									<th class="col-xs-12 col-sm-12 col-md-1 textCent">Mes</th>
									<th class=" textCent">Estado</th>
									<th class="col-xs-12 col-sm-12 col-md-3 textCent">Observaciones Envio</th>
									<th class="col-xs-12 col-sm-12 col-md-1 textCent">Fecha Revisíon</th>
									<th class="textCent">Accion</th>
									<th class="textCent">Accion</th>
									<th class="textCent">Accion</th>
								</tr>
							</thead>

							<tbody>
								<? 

								$archivosTodos = getArchivosEnlaceFilterAdmin($conn, $idEnlace, $anioCaptura, $mesCapturar, 1);	

								$turila = "http://201.116.252.158:8080/sire/repositorio/";
								for( $i=0; $i<sizeof($archivosTodos); $i++){


									$idarchivo = $archivosTodos[$i][0];
									$idEnlace = $archivosTodos[$i][1];
									$nombreArchivo = $archivosTodos[$i][2];
									$observacionesUser = $archivosTodos[$i][3];
									$tamanio = $archivosTodos[$i][4];
									$fechaSubida = $archivosTodos[$i][5];
									$ubicacion = $archivosTodos[$i][6];
									$mes = $archivosTodos[$i][7];
									$anio = $archivosTodos[$i][8];
									$estatusarch = $archivosTodos[$i][9];
									$observacionesRevision = $archivosTodos[$i][10];
									$fechaConclu = $archivosTodos[$i][11];
									$enlacename = $archivosTodos[$i][12];
									$nunidad = $archivosTodos[$i][13];


									if($idEnlace == 34){ $nunidad = "Delitos Vinculados a Violencia de Genero"; }



									$mesNombre = Mes_Nombre($mes);
									$newfechaSubida = $fechaSubida->format('d/m/y H:i:s');																															


									if( $fechaConclu != null ){$fechaConclu2 = $fechaConclu->format('d/m/y H:i:s');}else { $fechaConclu = "---"; $fechaConclu2 = "---";}

									if($estatusarch == "env"){ $bloquear = 0; $estatusarc = "Enviado";}
									if($estatusarch == "rev"){ $bloquear = 0; $estatusarc = "Revisando";}
									if($estatusarch == "rec"){ $bloquear = 1; $estatusarc = "Recibido";}
									if($estatusarch == "rac"){ $bloquear = 2; $estatusarc = "Rechazado";}
									if($estatusarch == "ree"){ $bloquear = 3; $estatusarc = "Reenviado";}

									$color = getCOlorStatusArchivo($conn, $estatusarc);
									$rutota = $turila.$ubicacion;
									?>

									<tr >
										<td class="tdRowMain"><center><label><? echo ($i+1); ?></label></center></td>
										<td class="tdRowMain" style="padding: 23px !important;"><? echo $nombreArchivo; ?></td>
										<td class="tdRowMain"><? echo $enlacename." - ".$nunidad; ?></td>
										<td class="tdRowMain"><center><? echo $newfechaSubida; ?></center></td>
										<td class="tdRowMain"><center><? echo $mesNombre; ?></center></td>
										<td style="background-color: <? echo $color; ?> !important; padding: 10px; color: white !important; vertical-align: middle !important;"><center><? echo $estatusarc; ?></center></td>
										<td class="tdRowMain"><center><? echo $observacionesUser; ?></center></td>
										<td class="tdRowMain"><center><? if($fechaConclu2 != null){ echo $fechaConclu2; } ?></center></td>

										<td class="tdRowMain"><center><button type="button" data-toggle="modal" href="#myModaRevisarArchivo"  onclick="revisarArchivoMOdal(<? echo $idarchivo; ?>, '<? echo $ubicacion; ?>', '<? echo $nunidad; ?>', <? echo $idEnlace; ?>)" class="btn btn-warning btn-sm redondear btnCapturarTbl"><span class="glyphicon glyphicon-eye-open"></span> Revisar </button></center></td>

										<td class="tdRowMain"><center><button type="button" data-toggle="modal" href="#myModalVerFormato"  onclick="verFormato(<? echo $idarchivo ?>, '<?  echo $ubicacion; ?>')" class="btn btn-info btn-sm redondear btnCapturarTbl"><span class="glyphicon glyphicon-search"></span> Ver Archivo </button></center></td>

										<td class="tdRowMain"><center><button type="button" data-toggle="modal" href=""  onclick="descargarArchivo('<? echo $nombreArchivo; ?>');" class="btn btn-primary btn-sm redondear btnCapturarTbl"><span class="glyphicon glyphicon-cloud-download"></span> Descargar </button></center></td>
									</tr>
								<?	} ?> 



							</tbody>

						</table>


					</div>


				</div>			

			</div>


		</div>









