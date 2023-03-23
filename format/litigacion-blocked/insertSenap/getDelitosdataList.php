<?
		include ("../../../Conexiones/Conexion.php");
		include ("../../../Conexiones/conexionSicap.php");
				include("../../../funcionesLitSENAP.php");	

				$delitos = getDataDelitosSica($conSic);
				for ($h=0; $h < sizeof($delitos); $h++) {
					 $idDelito = $delitos[$h][0];	
						$nom = $delitos[$h][1];	
					?>
				 <option style="color: black; font-weight: bold;" value="<? echo $nom; ?>" data-value="<? echo $idDelito; ?>" data-id="<? echo $idDelito; ?>"></option>
			<?}?>