<?
//Funcion que obtiene el expediente del nuc para la variable ID_Seguimiento del casos
function getNucExpedienteSicap($conSics, $nuc){
	$query = "SELECT Expediente  From Carpeta WHERE NUC = $nuc"; 
	$indice = 0;
	$stmt = sqlsrv_query($conSics, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['Expediente'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	
}	

//Funcion que obtiene el catalogo de Etapa Procesal para la variable con ID: 6.1.2
function getEtapaProcesal($conn){
	$query = "SELECT * FROM senap.catEtapaProcesal WHERE estatus = 'VI' "; 
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idCatEtapaProcesal'];
		$arreglo[$indice][1]=$row['nombre'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	
}	

?>