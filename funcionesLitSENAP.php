<?
//Funcion que obtiene el expediente del nuc para la variable ID_Seguimiento del casoss
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

?>