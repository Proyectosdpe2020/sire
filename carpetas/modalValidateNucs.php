
<?php
session_start();
include ("../Conexiones/Conexion.php");
include("../funciones.php");	
include ("../Conexiones/conexionSicap.php");
include("../funcioneSicap.php");
include("../funcionesCarpetasV2.php");

$idUsuario = $_SESSION['useridIE'];
if (isset($_POST["validado"])){ $validado = $_POST["validado"]; }
if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }
if (isset($_POST["mesCapturar"])){ $mesCapturar = $_POST["mesCapturar"]; }
if (isset($_POST["anioCaptura"])){ $anioCaptura = $_POST["anioCaptura"]; }



$enlace = getInfoEnlaceUsuario($conn, $idUsuario);
$idEnlace = $enlace[0][0];
$idfisca = $enlace[0][1];


		//if($idfisca == 4){ $mpsList = getMpsEnlace($conn, $idEnlace); }else{ $mpsList = getMpsEnlaceUnidad($conn, $idEnlace, 1); }

$mpsList = getMpsEnlaceUnidadFormato($conn, $idEnlace, 1);

$idUnidad = 0;
$nomUnidad = "TODAS";




$mescap = getMesCapEnlaceArchivo($conn, $idEnlace, 1);	
$mescapen = $mescap[0][0];

$mesCapturar = $mescapen;
	//$anioCaptura = 2020;	



$mesNom = Mes_Nombre($mesCapturar);


$enviado = getEnviadoEnlace($conn, $idEnlace);
$env = $enviado[0][0];
$envArch = $enviado[0][1];

?>

<div id="">



	<div class="row pad20" style="height: 80vh !important; margin-top: 1% !important;  overflow-y: scroll !important; background-color: white !important; border-radius: 10px 10px 0px 0px !important; box-shadow: 5px !important; ">	<br>						

		<label style="text-align: justify !important;">Nota: Si algún NUC aparece en el siguiente listado es porque su ultimo estatus ingresado en sistema es un estatus de Reiniciado/Abierto, si se encuentra alguno con este estatus es porque se decidió volver a usar el NUC para una posible determinación, favor de revisar.</label><br><br>

		<table class="table table-striped tblTransparente">
			<thead>
				<tr class="cabezeraTabla">

					<th class=" textCent">No</th>													
					<th class=" ">NUC</th>
					<th class=" textCent">Fecha Ingreso</th>													

					<th class=" textCent">Estatus Carpeta </th>
					<th class=" textCent">Ministerio Público </th>												

				</tr>
			</thead>
			<tbody>
				<? 							

				$unidss = getUnidadEnlaceFormat($conn, $idEnlace, 1);


				$idUnidad = "IN(".$unidss[0][0].")";
				$nucses = getAlldiferentsCarpetsMesAnioUnid($conn, $anioCaptura, $mesCapturar, $idUnidad);

				$countReiniciados=0;

				for ($i=0; $i < sizeof($nucses) ; $i++) { 


											///// VALIDAR SI EL ULTIMO ESTATUS DE CADA CARPETA ES UN REINICIADO SE MUESTRA
					$dataLasResolucion = getLastResolucionCarpetaV2($conn, $nucses[$i][0]);

					if($dataLasResolucion[0][0] == 1){

							$countReiniciados++;

						?>


						<tr>


							<td class="tdRowMain negr"><? echo ($i+1); ?></td>
							<td class="tdRowMain2"><? echo $dataLasResolucion[0][7] ?></td>
							<td class="tdRowMain"><? echo $dataLasResolucion[0][8]->format('Y-m-d H:i:s'); ?></td>
							<td class="tdRowMain"><? echo $dataLasResolucion[0][1] ?></td>
							<td class="tdRowMain"><? echo $dataLasResolucion[0][6] ?></td>


						</tr>		

						<?
					}

				}

				?>

				<?




				?>
			</tbody>
		</table>




	</div>

	<div class="row" style="background-color: white !important; border-radius: 0px 0px 10px 10px !important; box-shadow: 5px !important;">

		<div class="col-xs-6 col-sm-6 col-md-6"><center><button style="width: 95%;" type="button" class="btn btn-default redondear" onclick="cancelarBotonValidate()">Salir</button></center><br></div>

		<div class="col-xs-6 col-sm-6 col-md-6"><center><button style="width: 95%;"  type="button" class="btn btn-info redondear"  onclick="enviarDPEvalidatesV2(<? echo $anioCaptura; ?>, <? echo $mesCapturar ?> ,  <? echo $countReiniciados; ?>,<? echo $idEnlace; ?>, 1);">Enviar Información</button></center></div>
	</div> 

</div>