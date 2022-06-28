<?
include("../../../Conexiones/Conexion.php");
include("../../../funcioneTrimes.php");
include("../../../funciones.php");
include("../../../Conexiones/conexionSicap.php");
include("../../../funcioneSicap.php");

if (isset($_GET["quest"])) {
	$quest = $_GET["quest"];
}
if (isset($_GET["per"])) {
	$per = $_GET["per"];
}
if (isset($_GET["anio"])) {
	$anio = $_GET["anio"];
}
if (isset($_GET["anioActual"])) {
	$anioActual = $_GET["anioActual"];
}
if (isset($_GET["mes"])) {
	$mes = $_GET["mes"];
}
if (isset($_GET["idUnidad"])) {
	$idUnidad = $_GET["idUnidad"];
}
if (isset($_GET["idEnlace"])) {
	$idEnlace = $_GET["idEnlace"];
}

$aniosAnteriores = array();
$indc = 0;
/// CONSTRUIR ARRAY DE ANIOS
 for ($w=2017; $w < $anioActual ; $w++) { 
		$aniosAnteriores[$indc] = $w;
		$indc++;
	}



$nucsFile = $_FILES['fileContacts']; 
$nucsFile = file_get_contents($nucsFile['tmp_name']); 

$nucsFile = explode("\n", $nucsFile);
$nucsFile = array_filter($nucsFile); /// QUITA O LIMPIA EL ARRAY SI ES QUE UNO ESTA VACIO



// insertar NUCS
for ($i = 0; $i < sizeof($nucsFile); $i++) {

///// VALIDAMOS QUE EL NUC EXISTA EN SICAP ////// 
	if($aux=get_nuc_sicap ($nucsFile[$i],$conSic)){  

		$nuci = $nucsFile[$i];
		$nuci = trim(preg_replace('/\s+/', ' ', $nuci)); //// SE REMUEVE EL SALTO DE LINEA POR QUE SI NO LA TRANSACCION NO SE REALIZA

		$anioNuci = substr($nuci, 4, 4);
		
		

		//// VALIDAR QUE EL NUC CORRESPONDA A LOS AÑOS A INSERTAR //////
		if($anio == 0){ //// SIGNIFICA QUE VIENE DE AÑOS ANTERIORES 
			
			/////// SI EL AÑO DEL NUC SE ENCUENTRA DENTRO LOS AÑOS ANTERIORES
			if (in_array($anioNuci, $aniosAnteriores)) {
    print_r("AQUI SI1 \n");
								$queryTransaction = "  

								BEGIN 		
								BEGIN TRY 
										BEGIN TRANSACTION
														SET NOCOUNT ON
														INSERT INTO [trimestral].[nucsTrimestral]
														([idPregunta]
														,[idEnlace]
														,[idUnidad]
														,[mes]
														,[anio]
														,[periodo]
														,[NUC])
								VALUES
														($quest,$idEnlace,$idUnidad,$mes,$anio,$per,'$nuci')
														COMMIT
								END TRY
								BEGIN CATCH 
														ROLLBACK TRANSACTION
														RAISERROR('No se realizo la transaccion',16,1)
								END CATCH
								END
						";
						$result = sqlsrv_query($conn,$queryTransaction, array(), array( "Scrollable" => 'static' ));    
							if ($result) {						
							}else{						
							}

			}


		}else{


					if($anioNuci == $anio){ ///// 

						$queryTransaction = "  

								BEGIN 		
								BEGIN TRY 
										BEGIN TRANSACTION
														SET NOCOUNT ON
														INSERT INTO [trimestral].[nucsTrimestral]
														([idPregunta]
														,[idEnlace]
														,[idUnidad]
														,[mes]
														,[anio]
														,[periodo]
														,[NUC])
								VALUES
														($quest,$idEnlace,$idUnidad,$mes,$anio,$per,'$nuci')
														COMMIT
								END TRY
								BEGIN CATCH 
														ROLLBACK TRANSACTION
														RAISERROR('No se realizo la transaccion',16,1)
								END CATCH
								END
						";
						$result = sqlsrv_query($conn,$queryTransaction, array(), array( "Scrollable" => 'static' ));    
							if ($result) {						
							}else{						
							}

					}


		}


		////////// VALIDAR QUE CORRESPONDAN A AÑOS ANTERIORES O A ANIO ACTUAL //////////////////

				

	}else{

		print_r("No Existe NUC \n");

	}
	

}
