<?php

$idUsuario = $_SESSION['useridPoa'];
$tipoUser  = $_SESSION['permisosPoa'];
$usarioAreas = getAreasUsu($conn, $idUsuario);
$anioGlobal = 2018;

if($idUsuario == 1 || $idUsuario == 2){

}else{

	if($tipoUser == 1 || $tipoUser == 2){

		$usarioAreas = getAreasUsu($conn, $idUsuario);
		$idAreaUno = $usarioAreas[0][0];

		//echo "entro aqui y el usuarios es id: ".$idAreaUno;

		$nombreur = getUrNombre($conn, $idAreaUno);
		$nombreurfinal = $nombreur[0][0];

		echo "---------------------------------------------".$nombreurfinal."<br>";

		$ficalias = getFiscalia_de_area($conn, $idAreaUno);
		$fiscalianombre = $ficalias[0][0];

		$urDeArea=getUrdeArea($conn, $idAreaUno, $anioGlobal);
		$idUrArea = $urDeArea[0][0];

		echo "---------------------------------------------".$idUrArea;

	}else{

		if($tipoUser == 3){


		}
	}
}
?>
<div class="container body" >
	<div class="main_container" >
		<div class="col-md-3 left_col">
			<div class="left_col scroll-view">

				<div class="clearfix"></div>

				<br/>

				<!-- sidebar menu -->

				<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
					<div class="menu_section">
						<div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-line-chart"></i> <span>SIPOA</span></a>
            </div><br><br>
						<ul class="nav side-menu">

							<?php

							if($tipoUser == 1 || $tipoUser == 2){
								if($idUsuario == 1 || $idUsuario == 2){
								}else{
									if($idUrArea == 2){
										?>
										<li><a><i class="fa fa-edit"></i>Seguimiento de <?php echo $nombreurfinal."-".$fiscalianombre; ?> <span class="fa fa-chevron-down"></span></a>
											<?php





										}
										else{
											?>
											<li><a><i class="fa fa-edit"></i>Seguimiento de <?php echo $nombreurfinal; ?> <span class="fa fa-chevron-down"></span></a>
												<?php
											}

										}



										?>
										<ul class="nav child_menu" style="display: block;">

											<?

											//// Comprobar si el area tiene mas de dos proyectos

											if( $tipoUser == 1 ){

												$numProjects = getTotalProyectosXarea($conn, $idAreaUno, $anioGlobal);
												$numero =		$numProjects[0][0];

												$nombreArea = $usarioAreas[0][1];
												if($numero > 1){

													//echo "Entro aqui en numero mayor que 1";

													$proyectosArea = getProyectXarea($conn, $idAreaUno, $anioGlobal);
													?><a3 style="color:white; font-weight:bold;">Proyectos :</a3> <a4 style="color:white; font-weight:bold;"><? echo $nombreArea; ?></a4>
													<?php

													for ($e=0; $e < sizeof($proyectosArea) ; $e++) {

														$idProye = $proyectosArea[$e][0];
														$nombreProyecto = $proyectosArea[$e][1];
														$anio = $proyectosArea[$e][2];
														$obj = $proyectosArea[$e][3];
														$idUr = $proyectosArea[$e][4];
														$idAreaPro = $proyectosArea[$e][5];

														?>
														<li><a onclick="agregacontenidoXproyecto( <?php echo $idAreaPro; ?>, <?php echo $idUsuario; ?>, <?php echo $idProye; ?>,'<?php echo $nombreProyecto; ?>' )" href="#"> <?php echo $nombreProyecto; ?> </a></li>
														<?

													}

												}else{

													//echo "Entro aqui en numero menor que 1";

													for( $i=0; $i<sizeof($usarioAreas); $i++)
													{

														$idArea = $usarioAreas[$i][0];
														$nombreArea = $usarioAreas[$i][1];
														$idFiscalia = $usarioAreas[$i][2];
														$idUsu = $usarioAreas[$i][3];


														$idProyecto = getIdProyectoArea($conn, $idArea, $anioGlobal);
														$idp =		$idProyecto[0][0];



														?>
														<li><a onclick="agregacontenido( <?php echo $idArea; ?>,  <?php echo $idp; ?> )" href="#"> <?php echo $nombreArea; ?> </a></li>
														<?
													}
												}
											}


											?>

										</ul>


									</li>

									<?php    if( $tipoUser == 2 )  {    ?>

										<!--
										<li><a><i class="fa fa-home"></i> Actividad <span class="fa fa-chevron-down"></span></a>
										<ul class="nav child_menu">
										<li><a href="#">Nueva Actividad</a></li>
									</ul>
								</li>-->
									<br><br>
								<li><a><i class="fa fa-object-group"></i> Agrupaciónes <span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu" style="display: ;">
										<li ><a onclick="cargarPagina('newActivity.php')" href="#">Acividades</a></li>
									</ul>
								</li>
								<li><a><i class="fa fa-folder-open"></i> Proyectos <span class="fa fa-chevron-down"></span></a>

									<ul class="nav child_menu" style="display: ;">
										<li><a onclick="agregacontenidoUr()" href="#">Actualización Datos</a></li>
										<li><a onclick="cargaContenidoFinalAgrupadas()" href="#">Agrupadas Finales</a></li>
									</ul>

								</li>
								<li><a><i class="fa fa-cubes"></i> Consultas <span class="fa fa-chevron-down"></span></a>

									<ul class="nav child_menu" style="display: ;">
										<li><a onclick="cargaContenidoAreaAnual()" href="#">Reporte Anual</a></li>
										<li><a onclick="cargaContenidoAreasMes()" href="#">Reporte Mensual</a></li>
										<li><a onclick="" href="#">Captura Faltante</a></li>
									</ul>

								</li>
								<!--<li><a><i class="fa fa-table"></i> Catalogos<span class="fa fa-chevron-down"></span></a>
								<ul class="nav child_menu">
								<li><a href="consulta/ver.php">UR`S</a></li>
								<li><a onclick="cargarPagina('proyecto.php')" href="#">Proyecto</a></li>
								<li><a>Area</a></li>
								<li><a>Actividad</a></li>
								<li><a>Beneficiario</a></li>
								<li><a>Medida</a></li>

							</ul>
						</li>-->
						<!--
						<li><a><i class="fa fa-cog"></i> Configuracíon<span class="fa fa-chevron-down"></span></a>
						<ul class="nav child_menu">
						<li><a onclick="cargarPagina('configFechas.php')">Fecha de Captura</a></li>
						<li><a>Fiscalia</a></li>
						<li><a>Usuario</a></li>
					</ul>
				</li>-->

				<!--<li><a><i class="fa fa-download"></i>Reportes<span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu">
				<li><a href="reportes/reportes.php">Generar Reporte</a></li>
			</ul>
		</li>-->

	<?php  }


}else{


	if($tipoUser == 3){


		$urDeUsuario = getUrdeUsuario($conn, $idUsuario);
		$idUr = $urDeUsuario[0][0];


		/// OBTENER PROYECTOS DE UR

		$proyectosUr = getProyectosDur($conn, $idUr);

		?>

		<li><a><i class="fa fa-home"></i> Seguimiento de Proyectos por UR <span class="fa fa-chevron-down"></span></a>
			<ul class="nav child_menu" style="display: block;">


				<?php

				for( $i=0; $i<sizeof($proyectosUr); $i++){

					$idProyecto = $proyectosUr[$i][0];
					$nombreProyecto = $proyectosUr[$i][1];
					?>
					<li><a onclick="agregacontenidoUr( <?php echo $idProyecto.",'".$nombreProyecto."'"?>, <?php echo $idUr; ?>)" href="#"> <?php echo $nombreProyecto; ?> </a></li>
					<?
				}


				?>
			</ul>
		</li>


		<li><a><i class="fa fa-home"></i> Consulta Seguimiento <span class="fa fa-chevron-down"></span></a>
			<ul class="nav child_menu" style="display: block;">

				<li><a onclick="cargaContenidoAreasPorUr(<?php echo $idUr; ?>)" href="#">Reporte por Area </a></li>
			</ul>
		</li>

		<?php


	}

}

?>



</ul>
</div>
</div>
</div>
</div>
