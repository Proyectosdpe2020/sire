<? 

function getInfoEnlacesCarpetas($conn, $formato){

		$query = "SELECT   idEnlace,nombre, apellidoPaterno, apellidoMarterno, correo, estatus, telefono, idFormato, e.idUnidad as idunidad, cu.nUnidad as nomunidad, cf.nFiscalia2 as nomFis
FROM   enlace e INNER JOIN CatUnidad cu ON cu.idUnidad = e.idUnidad 
INNER JOIN CatFiscalia cf ON cf.idFiscalia = cu.idFiscalia
AND e.idFormato = $formato";

		$indice = 0;

		$stmt = sqlsrv_query($conn, $query);
		while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
		{

			$arreglo[$indice][0]=$row['idEnlace'];
			$arreglo[$indice][1]=$row['nombre'];
			$arreglo[$indice][2]=$row['apellidoPaterno'];
			$arreglo[$indice][3]=$row['apellidoMarterno'];
			$arreglo[$indice][4]=$row['correo'];
			$arreglo[$indice][5]=$row['estatus'];
			$arreglo[$indice][6]=$row['telefono'];
			$arreglo[$indice][7]=$row['idFormato'];
			$arreglo[$indice][8]=$row['idunidad'];
			$arreglo[$indice][9]=$row['nomunidad'];
			$arreglo[$indice][10]=$row['nomFis'];
			$indice++;
		}
		if(isset($arreglo)){return $arreglo;}

}

?>