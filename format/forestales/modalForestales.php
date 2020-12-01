<?php
				include("../../Conexiones/Conexion.php");
				include("../../funcionesForestales.php");
				if(isset($_GET["idForestales"])){ 
					$idForestales = $_GET["idForestales"];
					$flag = 1;
					$data = getInformeMensualByID($conn, $idForestales); 
					$mes = $data[0][3];                    $peritajesUnidadForestales = $data[0][14];
					$anio = $data[0][4];                   $peritajesUnidadesForaneas = $data[0][15];
					$madera = $data[0][5];                 $averiguacionesoCarpetas = $data[0][16];    
					$vehiculos = $data[0][6];              $localizacionesCumplidas = $data[0][17];     
					$gruasForestales = $data[0][7];        $investigacionesCumplidas = $data[0][18]; 
					$motosierras = $data[0][8];            $recorridosVigilancia = $data[0][19];       
					$radios = $data[0][9];                 $operativos = $data[0][20]; 
					$herramientas = $data[0][10];           
					$armasFuego = $data[0][11];
					$celulares = $data[0][12];
					$detenidos = $data[0][13];
				}	else{
					$flag = 0; /*0: Agregar 1: Ver*/	
					$idForestales = 00;
				} 

    if (isset($_GET['verOedita'])){ $verOedita = $_GET['verOedita']; } else { $verOedita = 0; }
				if (isset($_GET['anioCapturando'])){ $anioCapturando = $_GET['anioCapturando']; }
				if (isset($_GET['mesCapturando'])){ 
					$mesCapturando = $_GET['mesCapturando'];
					$dataMesText = getDataMesText($mesCapturando); 
				}
?>


 
	<div class="modal-header" style="background-color:#152F4A;">
		<center><label style=" color: white; font-weight: bold; font-size: 2rem;">INFORME MENSUAL<br> <?if($flag == 1){ echo $mes.' '.$anio; } else{ 
			echo $dataMesText.' '.$anioCapturando; } ?> </label></center>
	</div>
	<div class="col-md-12 col-sm-12 col-xs-12 form-group panelunoDisposicdo" >
		<div class="row"  style="padding: 1px;">
			<div class="row" style="padding: 20px;"><!-- ROOWWWWWW PRINCIPAL --> 
				<form onsubmit="return false" action="return false">
					<div class="panel panel-default">
						<div class="panel-body">
							<h5 class="text-on-pannel"><strong> Datos </strong></h5>
							
							<div class="row">
								<div class="col-xs-12">
										<label for="maderaVol">Madera volumen M3:</label>
											<input value="<?if($flag == 1){ echo $madera; } ?>" type="number" class="form-control" id="maderaVol" name="maderaVol" <?if($flag == 1 && 
												$verOedita != 1){ ?>disabled <? } ?> >
								</div>
							</div><br><br>

							<div class="row">
								<div class="col-xs-12">
									 <label for="vehiculos">Vehículos:</label>
											<input value="<?if($flag == 1){ echo $vehiculos; } ?>" type="number" class="form-control" id="vehiculos" name="vehiculos" <?if($flag == 1 && 
												$verOedita != 1){ ?>disabled <? } ?> > 
								</div>
							</div><br><br>

							<div class="row">
								<div class="col-xs-12">
										<label for="gruas">Gruas Forestales:</label>
											<input value="<?if($flag == 1){ echo $gruasForestales; } ?>" type="number" class="form-control" id="gruas" name="gruas" <?if($flag == 1 && 
												$verOedita != 1){ ?>disabled <? } ?> >
								</div>
							</div><br><br>

							<div class="row">
								<div class="col-xs-12">
									 <label for="motosierras">Motosierras:</label>
											<input value="<?if($flag == 1){ echo $motosierras; } ?>" type="number" class="form-control" id="motosierras" name="motosierras" <?if($flag == 1 && $verOedita != 1){ ?>disabled <? } ?> >
								</div>
							</div><br><br>

								<div class="row">
								<div class="col-xs-12">
									 <label for="radios">Radios:</label>
											<input value="<?if($flag == 1){ echo $radios; } ?>" type="number" class="form-control" id="radios" name="radios" <?if($flag == 1 && 
												$verOedita != 1){ ?>disabled <? } ?> >
								</div>
							</div><br><br>

							<div class="row">
								<div class="col-xs-12">
									 <label for="herramientas">Herramientas:</label>
											<input value="<?if($flag == 1){ echo $herramientas; } ?>" type="number" class="form-control" id="herramientas" name="herramientas" <?if($flag == 1 && $verOedita != 1){ ?>disabled <? } ?> >
								</div>
							</div><br><br>

							<div class="row">
								<div class="col-xs-12">
									 <label for="armas">Armas de fuego:</label>
											<input value="<?if($flag == 1){ echo $armasFuego; } ?>" type="number" class="form-control" id="armas" name="armas" <?if($flag == 1 && 
												$verOedita != 1){ ?>disabled <? } ?> >
								</div>
							</div><br><br>

							<div class="row">
								<div class="col-xs-12">
									 <label for="celulares">Celulares:</label>
											<input value="<?if($flag == 1){ echo $celulares; } ?>" type="number" class="form-control" id="celulares" name="celulares" <?if($flag == 1 && 
												$verOedita != 1){ ?>disabled <? } ?> >
								</div>
							</div><br><br>

							<div class="row">
								<div class="col-xs-12">
									 <label for="detenidos">Detenidos:</label>
											<input value="<?if($flag == 1){ echo $detenidos; } ?>" type="number" class="form-control" id="detenidos" name="detenidos" <?if($flag == 1 && 
												$verOedita != 1){ ?>disabled <? } ?> >
								</div>
							</div><br><br>

							<div class="row">
								<div class="col-xs-12">
									 <label for="perApoyFis">Peritajes en apoyo a la Fiscalía:</label>
											<input value="<?if($flag == 1){ echo $peritajesUnidadForestales; } ?>" type="number" class="form-control" id="perApoyFis" name="perApoyFis" <?if($flag == 1 &&	$verOedita != 1){ ?>disabled <? } ?> >
								</div>
							</div><br><br>

							<div class="row">
								<div class="col-xs-12">
									 <label for="perApoyAgFor">Peritajes en apoyo a Agencias Foraneas:</label>
											<input value="<?if($flag == 1){ echo $peritajesUnidadesForaneas; } ?>" type="number" class="form-control" id="perApoyAgFor" name="perApoyAgFor" <?if($flag == 1 && $verOedita != 1){ ?>disabled <? } ?> >
								</div>
							</div><br><br>

							<div class="row">
								<div class="col-xs-12">
									 <label for="averiOcarpe">Averiguaciones o Carpetas:</label>
											<input value="<?if($flag == 1){ echo $averiguacionesoCarpetas; } ?>" type="number" class="form-control" id="averiOcarpe" name="averiOcarpe" <?if($flag == 1 && $verOedita != 1){ ?>disabled <? } ?> >
								</div>
							</div><br><br>

							<div class="row">
								<div class="col-xs-12">
									 <label for="locaCumplidas">Ordenes de localización cumplidas:</label>
											<input value="<?if($flag == 1){ echo $localizacionesCumplidas; } ?>" type="number" class="form-control" id="locaCumplidas" name="locaCumplidas" <?if($flag == 1 && $verOedita != 1){ ?>disabled <? } ?> >
								</div>
							</div><br><br>

							<div class="row">
								<div class="col-xs-12">
									 <label for="invAtendidas">Ordenes de investigación atendidas:</label>
											<input value="<?if($flag == 1){ echo $investigacionesCumplidas; } ?>" type="number" class="form-control" id="invAtendidas" name="invAtendidas" <?if($flag == 1 && $verOedita != 1){ ?>disabled <? } ?> >
								</div>
							</div><br><br>

							<div class="row">
								<div class="col-xs-12">
									 <label for="recorridos">Recorridos de vigilancia:</label>
											<input value="<?if($flag == 1){ echo $recorridosVigilancia; } ?>" type="number" class="form-control" id="recorridos" name="recorridos" <?if($flag == 1 && $verOedita != 1){ ?>disabled <? } ?> >
								</div>
							</div><br><br>

							<div class="row">
								<div class="col-xs-12">
									 <label for="recorridos">Operativos:</label>
											<input value="<?if($flag == 1){ echo $operativos; } ?>" type="number" class="form-control" id="operativos" name="operativos" <?if($flag == 1 && $verOedita != 1){ ?>disabled <? } ?> >
								</div>
							</div><br><br>

						</div>
					</div>
					<div id="respuesta"></div>
				</div><!-- ROOWWWWWW PRINCIPAL --> 
			</form>
		</div>
	</div>
</div>
</div>
</div>

<div class="row">
	<div class="col-xs-12 col-sm-12 <?if($flag != 1 || $verOedita == 1){ echo 'col-md-6'; }else{ echo 'col-md-12'; } ?>"><center><button style="width: 88%;" 
		onclick="closeModalForestales()" type="button" class="btn btn-default redondear" data-dismiss="modal">Salir</button></center></div>
	<?if($flag != 1 || $verOedita == 1){ ?>
	<div class="col-xs-12 col-sm-12 col-md-6"><center><button style="width: 88%;" onclick="saveDbForestales(<?echo $anioCapturando; ?> , <?echo $mesCapturando; ?> , <?echo $verOedita; ?> , <?echo $idForestales; ?> )" type="button" class="btn btn-primary redondear" >Guardar </button></center></div>
 <? } ?>
</div>
<br>