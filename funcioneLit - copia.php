<?


////// OBTIENE DATOS EXTRAS SI SE QUIERE 
function getLastDeterminacionCarpetaLitigacion($conn, $nuc, $estatResolucion){

	$query = " SELECT idEstatusNucs, nuc, idUnidad, fecha, idmp FROM estatusNucs 
	WHERE idEstatusNucs IN( SELECT MAX(idEstatusNucs) FROM estatusNucs WHERE nuc = $nuc ) AND idEstatus = $estatResolucion ";


	$indice = 0;

		$stmt = sqlsrv_query($conn, $query);
		while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
		{
			$arreglo[$indice][0]=$row['idEstatusNucs'];
			$arreglo[$indice][1]=$row['nuc'];
			$arreglo[$indice][2]=$row['idUnidad'];
			$arreglo[$indice][3]=$row['idmp'];
			$indice++;
		}
		if(isset($arreglo)){return $arreglo;}

}

////// OBTIENE LA ULTIMA DETERMINACION DE UNA CARPETA PARA SABER DONDE FUE DONDE SE DETERMINO POR ULTIMA VEZ

function getLastDeterminacionCarpetaLitig($conn, $nuc){

	$query = " SELECT idEstatusNucs, nuc, idUnidad, fecha, idEstatus, idCarpeta FROM estatusNucs 
	WHERE idEstatusNucs IN( SELECT MAX(idEstatusNucs) FROM estatusNucs WHERE nuc = '$nuc' ) ";



	$indice = 0;

		$stmt = sqlsrv_query($conn, $query);
		while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
		{
			$arreglo[$indice][0]=$row['idEstatusNucs'];
			$arreglo[$indice][1]=$row['nuc'];
			$arreglo[$indice][2]=$row['idUnidad'];
			$arreglo[$indice][3]=$row['idEstatus'];
			$arreglo[$indice][4]=$row['idCarpeta'];
			$indice++;
		}
		if(isset($arreglo)){return $arreglo;}

}

function getDistincCarpetasAgenteLitigacion($conn, $idMp, $estatus, $mes, $anio, $idUnidad){


		if($estatus == 60 || $estatus == 61 || $estatus == 63 ){

			$query = " SELECT nuc FROM estatusNucs WHERE idMp = $idMp AND idEstatus = $estatus AND mes = $mes AND anio = $anio AND idUnidad = $idUnidad";

		}else{
		$query = " SELECT DISTINCT nuc FROM estatusNucs WHERE idMp = $idMp AND idEstatus = $estatus AND mes = $mes AND anio = $anio AND idUnidad = $idUnidad Group BY nuc ";
		}
		//echo $query."<br>";

   		$indice = 0;

		$stmt = sqlsrv_query($conn, $query);

		while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
		{
			$arreglo[$indice][0]=$row['nuc'];
			$indice++;
		}
		if(isset($arreglo)){return $arreglo;}

}


function get_datos_carpeta_capturadoLiti($conn,$nuc)
		{
			$indice=0;
			$consulta="SELECT CarpetaID, NUC, Expediente, fechaCaptura, FechaInicio, FechaComision, Contar from Carpeta where NUC=".$nuc;

			$stmt = sqlsrv_query( $conn, $consulta);
			while(	$row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC )){
				
				$arreglo[$indice][0]=$row['CarpetaID'];	
				$arreglo[$indice][1]=$row['NUC'];	
				$arreglo[$indice][2]=$row['Expediente'];	
				$arreglo[$indice][3]=$row['fechaCaptura'];	
				$arreglo[$indice][4]=$row['FechaInicio'];	
				$arreglo[$indice][5]=$row['FechaComision'];	
				$arreglo[$indice][6]=$row['Contar'];	

				$indice++;				
			}			
			if(isset($arreglo)){return $arreglo;}
		}



function get_existeCarpetaNucsLiti($conn, $nuc, $anio, $mes, $idMp, $idUnidad, $idEstatus)
		{
			$indice=0;
			$consulta="SELECT DISTINCT idCarpeta from estatusNucs where nuc = $nuc AND anio = $anio AND mes = $mes AND idMp = $idMp AND idUnidad = $idUnidad AND idEstatus = $idEstatus";


			$stmt = sqlsrv_query( $conn, $consulta);
			while(	$row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC )){
				
				$arreglo[$indice][0]=$row['idCarpeta'];	

				$indice++;				
			}			
			if(isset($arreglo)){return $arreglo;}
		}




function getLastDeterminacionCarpetalit($conn, $idCarp){

	$query = " SELECT ResolucionID, CarpetaID, idUnidad, Fechaingreso, EstatusID FROM Resoluciones 
	WHERE ResolucionID IN( SELECT MAX(ResolucionID) FROM Resoluciones WHERE CarpetaID = $idCarp ) ";

	$indice = 0;

		$stmt = sqlsrv_query($conn, $query);
		while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
		{
			$arreglo[$indice][0]=$row['ResolucionID'];
			$arreglo[$indice][1]=$row['CarpetaID'];
			$arreglo[$indice][2]=$row['idUnidad'];
			$arreglo[$indice][3]=$row['EstatusID'];
			$indice++;
		}
		if(isset($arreglo)){return $arreglo;}

}

/////////////////////////////////////////////////////////



//////////////////////////////////////////////////////////

function getDistincCarpetasAgenteDetemrn20Lit($conn, $idMp, $mes, $anio,  $deten ,  $estatus, $idUnidad){
		

		if($estatus == 60 || $estatus == 61 || $estatus == 63 ){


				$query = "  SELECT nuc FROM estatusNucs 
			  WHERE idMp = $idMp AND mes = $mes AND anio = $anio AND  idEstatus = $estatus AND idUnidad = $idUnidad";


		}else{

					$query = "  SELECT DISTINCT nuc FROM estatusNucs 
			  WHERE idMp = $idMp AND mes = $mes AND anio = $anio AND  idEstatus = $estatus AND idUnidad = $idUnidad  Group BY nuc, idEstatus";

		}
			   $indice = 0;

					$stmt = sqlsrv_query($conn, $query);
					while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
					{
						$arreglo[$indice][0]=$row['nuc'];
						//$arreglo[$indice][1]=$row['EstatusID'];
						//$arreglo[$indice][2]=$row['deten'];
						$indice++;
					}
					if(isset($arreglo)){return $arreglo;}		

}

//////////////////////////// para saber donde se encuentra determninado con el ulitmo estatus del nuc

function getLAstResolucionesFromAdetermLit($conn, $idMp, $estatResolucion, $mes, $anio, $deten, $idUnidad){

	include ("Conexiones/conexionSicap.php");
 include ("Conexiones/Conexion.php");


 				$carpeAgente =  getDistincCarpetasAgenteDetemrn20Lit($conn, $idMp, $mes, $anio, 0, $estatResolucion, $idUnidad);

					$numResol = 0;

				          for ($i=0; $i < sizeof($carpeAgente); $i++) { 				      
				                          $numResol++; 
				                               }

				          	if($numResol > 0){
																return $numResol;
															}
															else{return 0;}
	

} 


///////////////////////////////////////////////////////////////


function validarCarpetaCapturadaLiti($conn, $anioCaptura, $mesCapturar, $idMp){

	$query = "  SELECT idLitigacion FROM Litigacion WHERE idMes = $mesCapturar AND idAnio = $anioCaptura AND idMp = $idMp";

	//echo $query;
	$stmt = sqlsrv_query(  $conn, $query,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
	$row_count = sqlsrv_num_rows( $stmt );


	if($row_count > 0){
		return 2;
	}
	else{return 1;}
}


function validarCarpetaCapturadaLitiUnidad($conn, $anioCaptura, $mesCapturar, $idMp, $idUnidad){

	$query = "  SELECT idLitigacion FROM Litigacion WHERE idMes = $mesCapturar AND idAnio = $anioCaptura AND idMp = $idMp AND idUnidad = $idUnidad";

	//echo $query;
	$stmt = sqlsrv_query(  $conn, $query,array(), array("Scrollable" => SQLSRV_CURSOR_STATIC));
	$row_count = sqlsrv_num_rows( $stmt );


	if($row_count > 0){
		return 2;
	}
	else{return 1;}
}











?>