
	<?php
	session_start();
	include ("../Conexiones/Conexion.php");
	include("../funciones.php");	

	if (isset($_POST["tipo"])){ $tipo = $_POST["tipo"]; }	


	switch ($tipo) {

		case 'iniciadas':

		if (isset($_POST["cdeten"])){ $cdeten = $_POST["cdeten"]; }
		if (isset($_POST["sdeten"])){ $sdeten = $_POST["sdeten"]; }

		$totalIniciadas = 0;
		$totalIniciadas = $cdeten + $sdeten;

		?>
			<input class="form-control input-md redondear fdesv colorBloqueado" value="<? echo $totalIniciadas; ?>" id="inpuTotIniciadas" type="number" disabled>
			<?
			break;

		case 'totalTrabajar':

		if (isset($_POST["tramite"])){ $tramite = $_POST["tramite"]; }
		if (isset($_POST["totIniciadas"])){ $totIniciadas = $_POST["totIniciadas"]; }
		if (isset($_POST["reciUnid"])){ $reciUnid = $_POST["reciUnid"]; }
		if (isset($_POST["reiniciadas"])){ $reiniciadas = $_POST["reiniciadas"]; }

		$totalTrabajar = 0;
		$totalTrabajar = $tramite + $totIniciadas +$reciUnid+$reiniciadas;

		?>
			<input class="form-control input-md redondear fdesv colorBloqueado" value="<? echo $totalTrabajar; ?>" id="inputTotalTrabajar" type="number" disabled>
			<?
			break;	

		case 'judicializadas':

		if (isset($_POST["cdeten"])){ $cdeten = $_POST["cdeten"]; }
		if (isset($_POST["sdeten"])){ $sdeten = $_POST["sdeten"]; }

		$totaljudicializadas = 0;
		$totaljudicializadas = $cdeten + $sdeten;

		?>
			<input class="form-control input-md redondear fdesv colorBloqueado" value="<? echo $totaljudicializadas; ?>" id="inputJudicializadas" type="number" disabled>
			<?
			break;		

		case 'resoluciones':

		if (isset($_POST["judicializadas"])){ $judicializadas = $_POST["judicializadas"]; }
		if (isset($_POST["acum"])){ $acum = $_POST["acum"]; }
		if (isset($_POST["incompe"])){ $incompe = $_POST["incompe"]; }
		if (isset($_POST["SCP"])){ $SCP = $_POST["SCP"]; }
		if (isset($_POST["CriteOpor"])){ $CriteOpor = $_POST["CriteOpor"]; }
		if (isset($_POST["Conciliacion"])){ $Conciliacion = $_POST["Conciliacion"]; }
		if (isset($_POST["mediacion"])){ $mediacion = $_POST["mediacion"]; }
		if (isset($_POST["neap"])){ $neap = $_POST["neap"]; }
		if (isset($_POST["ArcTem"])){ $ArcTem = $_POST["ArcTem"]; }
		if (isset($_POST["AbsInves"])){ $AbsInves = $_POST["AbsInves"]; }

		$totalresoluciones = 0;
		$totalresoluciones = $judicializadas + $acum + $incompe + $SCP + $CriteOpor + $Conciliacion + $mediacion + $neap + $ArcTem + $AbsInves;

		?>
			<input class="form-control input-md redondear fdesv colorBloqueado" value="<? echo $totalresoluciones; ?>" id="inputResoluciones" type="number" disabled>
			<?
			break;		

		case 'tramite':

		if (isset($_POST["resoluciones"])){ $resoluciones = $_POST["resoluciones"]; }
		if (isset($_POST["EnvUATP"])){ $EnvUATP = $_POST["EnvUATP"]; }
		if (isset($_POST["EnvUI"])){ $EnvUI = $_POST["EnvUI"]; }
		if (isset($_POST["TotalTrabajar"])){ $TotalTrabajar = $_POST["TotalTrabajar"]; }

		
		if (isset($_POST["inputEnvImpDesc"])){ $inputEnvImpDesc = $_POST["inputEnvImpDesc"]; }


		$totalTramite = 0;
		$totalTramite = $TotalTrabajar - ( $resoluciones + $EnvUATP + $EnvUI + $inputEnvImpDesc);

		?>
			<input class="form-control input-md redondear fdesv colorBloqueado" value="<? echo $totalTramite; ?>" id="inputTramiteFinal" type="number" disabled>
			<?
			break;		


		case 'tramiteA':

		if (isset($_POST["resoluciones"])){ $resoluciones = $_POST["resoluciones"]; }
		if (isset($_POST["EnvUATP"])){ $EnvUATP = $_POST["EnvUATP"]; }
		if (isset($_POST["EnvUI"])){ $EnvUI = $_POST["EnvUI"]; }
		if (isset($_POST["TotalTrabajar"])){ $TotalTrabajar = $_POST["TotalTrabajar"]; }

		
		if (isset($_POST["inputEnvImpDesc"])){ $inputEnvImpDesc = $_POST["inputEnvImpDesc"]; }


		$totalTramite = 0;
		$totalTramite = $TotalTrabajar - ( $resoluciones + $EnvUATP + $EnvUI + $inputEnvImpDesc);

		?>
			<input class="form-control input-md redondear fdesv colorBloqueado" value="<? echo $totalTramite; ?>" id="inputTramiteFinalA" type="number" disabled>
			<?
			break;	


		case 'resolucionesA':

		if (isset($_POST["judicializadas"])){ $judicializadas = $_POST["judicializadas"]; }
		if (isset($_POST["acum"])){ $acum = $_POST["acum"]; }
		if (isset($_POST["incompe"])){ $incompe = $_POST["incompe"]; }
		if (isset($_POST["SCP"])){ $SCP = $_POST["SCP"]; }
		if (isset($_POST["CriteOpor"])){ $CriteOpor = $_POST["CriteOpor"]; }
		if (isset($_POST["Conciliacion"])){ $Conciliacion = $_POST["Conciliacion"]; }
		if (isset($_POST["mediacion"])){ $mediacion = $_POST["mediacion"]; }
		if (isset($_POST["neap"])){ $neap = $_POST["neap"]; }
		if (isset($_POST["ArcTem"])){ $ArcTem = $_POST["ArcTem"]; }
		if (isset($_POST["AbsInves"])){ $AbsInves = $_POST["AbsInves"]; }

		$totalresoluciones = 0;
		$totalresoluciones = $judicializadas + $acum + $incompe + $SCP + $CriteOpor + $Conciliacion + $mediacion + $neap + $ArcTem + $AbsInves;

		?>
			<input class="form-control input-md redondear fdesv colorBloqueado" value="<? echo $totalresoluciones; ?>" id="inputResolucionesA" type="number" disabled>
			<?
			break;			
		
		case 'judicializadasA':

		if (isset($_POST["cdeten"])){ $cdeten = $_POST["cdeten"]; }
		if (isset($_POST["sdeten"])){ $sdeten = $_POST["sdeten"]; }

		$totaljudicializadas = 0;
		$totaljudicializadas = $cdeten + $sdeten;

		?>
			<input class="form-control input-md redondear fdesv colorBloqueado" value="<? echo $totaljudicializadas; ?>" id="inputJudicializadasA" type="number" disabled>
			<?
			break;			

		case 'totalTrabajarA':

		if (isset($_POST["tramite"])){ $tramite = $_POST["tramite"]; }
		if (isset($_POST["totIniciadas"])){ $totIniciadas = $_POST["totIniciadas"]; }
		if (isset($_POST["reciUnid"])){ $reciUnid = $_POST["reciUnid"]; }
		if (isset($_POST["reiniciadas"])){ $reiniciadas = $_POST["reiniciadas"]; }

		$totalTrabajar = 0;
		$totalTrabajar = $tramite + $totIniciadas +$reciUnid+$reiniciadas;

		?>
			<input class="form-control input-md redondear fdesv colorBloqueado" value="<? echo $totalTrabajar; ?>" id="inputTotalTrabajarA" type="number" disabled>
			<?
			break;			

		case 'iniciadasA':

		if (isset($_POST["cdeten"])){ $cdeten = $_POST["cdeten"]; }
		if (isset($_POST["sdeten"])){ $sdeten = $_POST["sdeten"]; }

		$totalIniciadas = 0;
		$totalIniciadas = $cdeten + $sdeten;

		?>
			<input class="form-control input-md redondear fdesv colorBloqueado" value="<? echo $totalIniciadas; ?>" id="inpuTotIniciadasA" type="number" disabled>
			<?
			break;		



		
		default:
			# code...
			break;
	}

	?>

