<?php



function getDataDireFiscaPuesta($conn, $idPuestaDisposicion){

	$query = "  SELECT idFiscalia, idMunicipio, idColonia FROM pueDisposi.puestaDisposicion WHERE idPuestaDisposicion = $idPuestaDisposicion";

							 $indice = 0;

								$stmt = sqlsrv_query($conn, $query);
								while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
								{
							
									$arreglo[$indice][0]=$row['idFiscalia'];							
									$arreglo[$indice][1]=$row['idMunicipio'];	
									$arreglo[$indice][2]=$row['idColonia'];	
									$indice++;
								}
								if(isset($arreglo)){return $arreglo;}	
}


function getDataPuestaID($conn, $idPuesta){

	$query = " SELECT idPuestaDisposicion, fechaInforme, m.nombre+' '+m.paterno+' '+m.materno as mando, cf.nFiscalia FROM pueDisposi.puestaDisposicion 
  INNER JOIN pueDisposi.mando m ON m.idMando = pueDisposi.puestaDisposicion.idMando
  INNER JOIN CatFiscalia cf On cf.idFiscalia = pueDisposi.puestaDisposicion.idFiscalia
  WHERE idPuestaDisposicion = $idPuesta";


							 $indice = 0;

								$stmt = sqlsrv_query($conn, $query);
								while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
								{
							
									$arreglo[$indice][0]=$row['idPuestaDisposicion'];
									$arreglo[$indice][1]=$row['fechaInforme'];	
									$arreglo[$indice][2]=$row['mando'];	
									$arreglo[$indice][3]=$row['nFiscalia'];								
									$indice++;
								}
								if(isset($arreglo)){return $arreglo;}	
}


function get_type_archive($conn, $idEnlace){

	$query = "SELECT idTipoArchivo FROM usuario WHERE idEnlace = $idEnlace;";

							 $indice = 0;

								$stmt = sqlsrv_query($conn, $query);
								while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
								{
							
									$arreglo[$indice][0]=$row['idTipoArchivo'];							
									$indice++;
								}
								if(isset($arreglo)){return $arreglo;}	
}



function getDiaMesnombre($fecha){



	$fechats = strtotime($fecha); 

	switch (date('w', $fechats)){

    case 0: return "Domingo"; break;
    case 1: return "Lunes"; break;
    case 2: return "Martes"; break;
    case 3: return "Miercoles"; break;
    case 4: return "Jueves"; break;
    case 5: return "Viernes"; break;
    case 6: return "Sabado"; break;
} 


}

function getDataMarcaArma($conn){
	$query = "SELECT * FROM pueDisposi.CatMarcaArma";

							 $indice = 0;
								$stmt = sqlsrv_query($conn, $query);
								while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
								{
							
									$arreglo[$indice][0]=$row['CatMarcaArmaID'];
									$arreglo[$indice][1]=$row['nombre'];
							
									$indice++;
								}
								if(isset($arreglo)){return $arreglo;}	
}

function getDataAccesorioArma($conn){
	$query = "SELECT * FROM pueDisposi.CatAccesorioArma";

							 $indice = 0;
								$stmt = sqlsrv_query($conn, $query);
								while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
								{
							
									$arreglo[$indice][0]=$row['CatAccesorioArmaID'];
									$arreglo[$indice][1]=$row['nombre'];
							
									$indice++;
								}
								if(isset($arreglo)){return $arreglo;}	
}

function getDataMarcaCartuchos($conn){
	$query = "SELECT * FROM pueDisposi.CatMarcaCartuchos";

							 $indice = 0;
								$stmt = sqlsrv_query($conn, $query);
								while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
								{
							
									$arreglo[$indice][0]=$row['CatMarcaCartuchosID'];
									$arreglo[$indice][1]=$row['nombre'];
							
									$indice++;
								}
								if(isset($arreglo)){return $arreglo;}	
}


function getDataCatCalibre($conn){
	$query = "SELECT * FROM pueDisposi.CatCalibre";

							 $indice = 0;
								$stmt = sqlsrv_query($conn, $query);
								while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
								{
							
									$arreglo[$indice][0]=$row['CatCalibreID'];
									$arreglo[$indice][1]=$row['nombre'];
							
									$indice++;
								}
								if(isset($arreglo)){return $arreglo;}	
}

function getDataTipoArma($conn){
	$query = "SELECT * FROM pueDisposi.CatTipoArma";

							 $indice = 0;
								$stmt = sqlsrv_query($conn, $query);
								while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
								{
							
									$arreglo[$indice][0]=$row['CatTipoArmaID'];
									$arreglo[$indice][1]=$row['nombre'];
							
									$indice++;
								}
								if(isset($arreglo)){return $arreglo;}	
}

function getDataCausaMuerte($conn){
	$query = "SELECT * FROM pueDisposi.CatCausaMuertes";

							 $indice = 0;
								$stmt = sqlsrv_query($conn, $query);
								while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
								{
							
									$arreglo[$indice][0]=$row['CatCausaMuerteId'];
									$arreglo[$indice][1]=$row['nombre'];
							
									$indice++;
								}
								if(isset($arreglo)){return $arreglo;}	
}


function get_data_puesta_dia($conn, $numeroDia, $diames, $anio, $fiscalia, $idenlace, $mes){

$valores ="";
$arrFiscEnlace = getFiscaliasEnlace($conn, $idenlace);
for ($i=0; $i < sizeof($arrFiscEnlace) ; $i++) { 
	
	$fisval = $arrFiscEnlace[$i][0];
	$valores = $valores."".$fisval.","; 
}
$valores = substr($valores, 0, -1);

$enlaceCaptura = 0; //Bandera para saber si se esta entrando como usuario regional de consulta
			
if($fiscalia == 0){

						$query = " SELECT pd.idPuestaDisposicion, m.nombre+' '+m.paterno+' '+m.materno as nombreMando, pd.nuc, pd.fechaEvento, pd.fechaInforme, f.Nombre as fiscalia, 
mu.Nombre as municipio, col.Nombre as colonia, pd.calle, pd.numero, pd.codigoPostal
FROM pueDisposi.puestaDisposicion pd 
INNER JOIN pueDisposi.mando m ON m.idMando = pd.idMando
INNER JOIN pueDisposi.Fiscalias f ON f.CatFiscaliasID = pd.idFiscalia
INNER JOIN pueDisposi.CatMunicipios mu ON mu.CatMunicipiosID = pd.idMunicipio
INNER JOIN pueDisposi.CatColonias col ON col.CatColoniasID = pd.idColonia
WHERE pd.diaSemana = $numeroDia AND pd.anio = $anio AND pd.diaMes = $diames AND pd.mes = $mes ORDER BY f.Nombre ";


}else{
  
 //Consulta para usuarios regionales 
	if($idenlace == 192 || $idenlace == 193 || $idenlace == 197 || $idenlace == 198 || $idenlace == 199 || $idenlace == 200 || $idenlace == 201 	|| $idenlace == 202 || $idenlace == 203){
   
			$valoresEnlaceConsulta ="";
			$arrFiscEnlaceConsulta = getFiscaliasEnlaceConsulta($conn, $idenlace); 
			for ($i=0; $i < sizeof($arrFiscEnlaceConsulta) ; $i++) { 
				
				$enlaceConsultaVal = $arrFiscEnlaceConsulta[$i][1];
				$valoresEnlaceConsulta = $valoresEnlaceConsulta."".$enlaceConsultaVal.","; 
			}
			$valoresEnlaceConsulta = substr($valoresEnlaceConsulta, 0, -1);
		
		$enlaceCaptura = 1;
		$query = " SELECT pd.idPuestaDisposicion, m.nombre+' '+m.paterno+' '+m.materno as nombreMando, pd.nuc, pd.fechaEvento, pd.fechaInforme, f.Nombre as fiscalia, 
		mu.Nombre as municipio, col.Nombre as colonia, pd.calle, pd.numero, pd.codigoPostal,e.nombre+' '+e.apellidoPaterno+' '+e.apellidoMarterno as nombreEnlace
		FROM pueDisposi.puestaDisposicion pd 
		INNER JOIN pueDisposi.mando m ON m.idMando = pd.idMando
		INNER JOIN pueDisposi.Fiscalias f ON f.CatFiscaliasID = pd.idFiscalia
		INNER JOIN pueDisposi.CatMunicipios mu ON mu.CatMunicipiosID = pd.idMunicipio
		INNER JOIN pueDisposi.CatColonias col ON col.CatColoniasID = pd.idColonia
		INNER JOIN dbo.enlace e ON e.idEnlace = pd.idEnlace
		WHERE pd.diaSemana = $numeroDia AND pd.anio = $anio AND pd.diaMes = $diames AND pd.mes = $mes AND pd.idEnlace IN($valoresEnlaceConsulta) ORDER BY f.Nombre ";
	}else{

		if($idenlace == 59 || $idenlace == 60 || $idenlace == 84 || $idenlace == 85 || $idenlace == 91 || $idenlace == 86 || $idenlace == 87|| $idenlace == 89 || $idenlace == 90){ //// THEY ARE ALL THE USERS CAN SEE EVERTHING

			$query = " SELECT pd.idPuestaDisposicion, m.nombre+' '+m.paterno+' '+m.materno as nombreMando, pd.nuc, pd.fechaEvento, pd.fechaInforme, f.Nombre as fiscalia, 
			mu.Nombre as municipio, col.Nombre as colonia, pd.calle, pd.numero, pd.codigoPostal
			FROM pueDisposi.puestaDisposicion pd 
			INNER JOIN pueDisposi.mando m ON m.idMando = pd.idMando
			INNER JOIN pueDisposi.Fiscalias f ON f.CatFiscaliasID = pd.idFiscalia
			INNER JOIN pueDisposi.CatMunicipios mu ON mu.CatMunicipiosID = pd.idMunicipio
			INNER JOIN pueDisposi.CatColonias col ON col.CatColoniasID = pd.idColonia
			WHERE pd.diaSemana = $numeroDia AND pd.anio = $anio AND pd.diaMes = $diames AND pd.mes = $mes AND pd.idFiscalia IN($valores) ORDER BY f.Nombre ";

		}else{
   if($diames != "todo"){
   		$query = " SELECT pd.idPuestaDisposicion, m.nombre+' '+m.paterno+' '+m.materno as nombreMando, pd.nuc, pd.fechaEvento, pd.fechaInforme, f.Nombre as fiscalia, 
			mu.Nombre as municipio, col.Nombre as colonia, pd.calle, pd.numero, pd.codigoPostal
			FROM pueDisposi.puestaDisposicion pd 
			INNER JOIN pueDisposi.mando m ON m.idMando = pd.idMando
			INNER JOIN pueDisposi.Fiscalias f ON f.CatFiscaliasID = pd.idFiscalia
			INNER JOIN pueDisposi.CatMunicipios mu ON mu.CatMunicipiosID = pd.idMunicipio
			INNER JOIN pueDisposi.CatColonias col ON col.CatColoniasID = pd.idColonia
			WHERE pd.diaSemana = $numeroDia AND pd.anio = $anio AND pd.diaMes = $diames AND pd.mes = $mes AND pd.idFiscalia IN($valores) AND idEnlace = $idenlace ORDER BY f.Nombre ";
   }else{
   		$query = " SELECT pd.idPuestaDisposicion, m.nombre+' '+m.paterno+' '+m.materno as nombreMando, pd.nuc, pd.fechaEvento, pd.fechaInforme, f.Nombre as fiscalia, 
			mu.Nombre as municipio, col.Nombre as colonia, pd.calle, pd.numero, pd.codigoPostal
			FROM pueDisposi.puestaDisposicion pd 
			INNER JOIN pueDisposi.mando m ON m.idMando = pd.idMando
			INNER JOIN pueDisposi.Fiscalias f ON f.CatFiscaliasID = pd.idFiscalia
			INNER JOIN pueDisposi.CatMunicipios mu ON mu.CatMunicipiosID = pd.idMunicipio
			INNER JOIN pueDisposi.CatColonias col ON col.CatColoniasID = pd.idColonia
			WHERE pd.anio = $anio AND pd.mes = $mes AND pd.idFiscalia IN($valores) AND idEnlace = $idenlace ORDER BY f.Nombre ";
   }
		}
	}

}


 $indice = 0;
	
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idPuestaDisposicion'];
		$arreglo[$indice][1]=$row['nombreMando'];
		$arreglo[$indice][2]=$row['nuc'];
		$arreglo[$indice][3]=$row['fechaEvento'];
		$arreglo[$indice][4]=$row['fechaInforme'];
		$arreglo[$indice][5]=$row['fiscalia'];		
		$arreglo[$indice][6]=$row['municipio'];		
		$arreglo[$indice][7]=$row['colonia'];
		$arreglo[$indice][8]=$row['calle'];
		$arreglo[$indice][9]=$row['numero'];
		$arreglo[$indice][10]=$row['codigoPostal'];
		if(	$enlaceCaptura == 1){ $arreglo[$indice][11]=$row['nombreEnlace']; }
		$indice++;
	}

		if(isset($arreglo)){return $arreglo;}	

}



function get_data_vehi_puesta($conn, $idPuestaDisposicion, $idVeicle){
if($idVeicle == 0){
			$query = " SELECT v.idVehiculo, cv.nombre as clasificacion, av.nombre as aseguramiento, dv.nombre as delito, tdv.nombre as tipoDelito, dis.nombre as dispocicion, mv.CatMarcasVehiculosID as marcaVehiculoID,
  mv.Nombre as marca, vl.Nombre as linea, tv.Nombre as tipo, v.color, v.modelo, v.placa, v.serie, v.motor, v.serieAlterada, 
  v.motorAlterado, v.requeridoOtrasCorpor, v.oficio, v.observaciones, v.requeridoPor, v.avppcarpeta 
  FROM pueDisposi.vehiculo v 
  INNER JOIN pueDisposi.clasificacionVehi cv ON cv.idClasificacionVehi = v.idClasificacion 
  INNER JOIN pueDisposi.aseguramietoVehi av ON av.idAseguramientoVehi = v.idFormaAseguramiento
  INNER JOIN pueDisposi.delitoVehi dv ON dv.idDelitoVehi = v.idDelito
  INNER JOIN pueDisposi.tipoenDelitoVehi tdv ON tdv.idTipoEnDelito = v.idTipoenDelito
  INNER JOIN pueDisposi.CatMarcasVehiculos mv ON mv.CatMarcasVehiculosID = v.idMarca
  INNER JOIN pueDisposi.CatMarcasVehiculosSub vl ON vl.CatMarcasVehiculosSubID = v.idLinea
  INNER JOIN pueDisposi.CatTiposVehiculosSub tv ON tv.CatTiposVehiculosSubID = v.idTipo
  INNER JOIN pueDisposi.disposicion dis ON dis.idDisposicion = v.idDisposicion

  WHERE idPuestaDisposicion = $idPuestaDisposicion ";
 }else{
 		$query = " SELECT v.idVehiculo, cv.nombre as clasificacion, av.nombre as aseguramiento, dv.nombre as delito, tdv.nombre as tipoDelito, dis.nombre as dispocicion, mv.CatMarcasVehiculosID as marcaVehiculoID,
  mv.Nombre as marca, vl.Nombre as linea, tv.Nombre as tipo, v.color, v.modelo, v.placa, v.serie, v.motor, v.serieAlterada, 
  v.motorAlterado, v.requeridoOtrasCorpor, v.oficio, v.observaciones, v.requeridoPor, v.avppcarpeta 
  FROM pueDisposi.vehiculo v 
  INNER JOIN pueDisposi.clasificacionVehi cv ON cv.idClasificacionVehi = v.idClasificacion 
  INNER JOIN pueDisposi.aseguramietoVehi av ON av.idAseguramientoVehi = v.idFormaAseguramiento
  INNER JOIN pueDisposi.delitoVehi dv ON dv.idDelitoVehi = v.idDelito
  INNER JOIN pueDisposi.tipoenDelitoVehi tdv ON tdv.idTipoEnDelito = v.idTipoenDelito
  INNER JOIN pueDisposi.CatMarcasVehiculos mv ON mv.CatMarcasVehiculosID = v.idMarca
  INNER JOIN pueDisposi.CatMarcasVehiculosSub vl ON vl.CatMarcasVehiculosSubID = v.idLinea
  INNER JOIN pueDisposi.CatTiposVehiculosSub tv ON tv.CatTiposVehiculosSubID = v.idTipo
  INNER JOIN pueDisposi.disposicion dis ON dis.idDisposicion = v.idDisposicion

  WHERE idVehiculo = $idVeicle ";
 }

 $indice = 0;
	
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idVehiculo'];
		$arreglo[$indice][1]=$row['clasificacion'];
		$arreglo[$indice][2]=$row['aseguramiento'];
		$arreglo[$indice][3]=$row['delito'];

		$arreglo[$indice][4]=$row['tipoDelito'];
		$arreglo[$indice][5]=$row['marca'];
		
		$arreglo[$indice][6]=$row['linea'];
		
		$arreglo[$indice][7]=$row['tipo'];
		$arreglo[$indice][8]=$row['color'];
		$arreglo[$indice][9]=$row['modelo'];
		$arreglo[$indice][10]=$row['placa'];
		$arreglo[$indice][11]=$row['serie'];
		$arreglo[$indice][12]=$row['motor'];
		$arreglo[$indice][13]=$row['serieAlterada'];
		$arreglo[$indice][14]=$row['motorAlterado'];
		$arreglo[$indice][15]=$row['requeridoOtrasCorpor'];
		$arreglo[$indice][16]=$row['oficio'];
		$arreglo[$indice][17]=$row['observaciones'];
		$arreglo[$indice][18]=$row['requeridoPor'];
		$arreglo[$indice][19]=$row['avppcarpeta'];
		$arreglo[$indice][20]=$row['dispocicion'];
		$arreglo[$indice][21]=$row['marcaVehiculoID'];

		$indice++;
	}

		if(isset($arreglo)){return $arreglo;}		

}


function get_data_foesta_puesta($conn, $idPuestaDisposicion, $idForestales){
if($idForestales == 0){
			$query = "   SELECT f.idForestales, cf.nombre, f.volumen, f.semoviente,f.observaciones FROm [pueDisposi].Forestales f
  INNER JOIN pueDisposi.CatForestales cf ON cf.CatForestalesId = f.idGenero WHERE f.idPueDisposicion = $idPuestaDisposicion ";
 }else{
 	$query = "   SELECT f.idForestales, cf.nombre, f.volumen, f.semoviente,f.observaciones FROm [pueDisposi].Forestales f
  INNER JOIN pueDisposi.CatForestales cf ON cf.CatForestalesId = f.idGenero WHERE f.idForestales = $idForestales ";
 }


 $indice = 0;
	
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idForestales'];
		$arreglo[$indice][1]=$row['nombre'];
		$arreglo[$indice][2]=$row['volumen'];
		$arreglo[$indice][3]=$row['semoviente'];

		$arreglo[$indice][4]=$row['observaciones'];
		$indice++;
	}

		if(isset($arreglo)){return $arreglo;}

}

function get_data_dinero_puesta($conn, $idPuestaDisposicion, $idDineroAsegurado){
if($idDineroAsegurado == 0){
			$query = "  SELECT idDineroAsegurado, m_nal, m_ext, divisa, observaciones FROM pueDisposi.DineroAsegurado WHERE idPueDisposicion =  $idPuestaDisposicion ";
		}else{
			$query = "  SELECT idDineroAsegurado, m_nal, m_ext, divisa, observaciones FROM pueDisposi.DineroAsegurado WHERE idDineroAsegurado =  $idDineroAsegurado ";
		}


 $indice = 0;
	
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idDineroAsegurado'];
		$arreglo[$indice][1]=$row['m_nal'];
		$arreglo[$indice][2]=$row['m_ext'];
		$arreglo[$indice][3]=$row['divisa'];

		$arreglo[$indice][4]=$row['observaciones'];
		$indice++;
	}

		if(isset($arreglo)){return $arreglo;}	

}

function get_data_objeto_puesta($conn, $idPuestaDisposicion, $idObjeto){
if($idObjeto == 0){
			$query = "    SELECT idObjetoAsegurado, nombreObjeto, cantidad, observaciones FROM pueDisposi.objetosAsegurados WHERE idPueDisposicion =  $idPuestaDisposicion ";
	 }else{
	 	$query = "    SELECT idObjetoAsegurado, nombreObjeto, cantidad, observaciones FROM pueDisposi.objetosAsegurados WHERE idObjetoAsegurado =  $idObjeto ";
	 }


 $indice = 0;
	
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idObjetoAsegurado'];
		$arreglo[$indice][1]=$row['nombreObjeto'];
		$arreglo[$indice][2]=$row['cantidad'];
		$arreglo[$indice][3]=$row['observaciones'];
		$indice++;
	}

		if(isset($arreglo)){return $arreglo;}	

}


function get_data_trabajoCampo_puesta($conn, $idPuestaDisposicion , $idTrabajoCampo){
	if($idTrabajoCampo == 0){
			$query = "   SELECT pueDisposi.TrabajoDeCampo.idTrabajoCampo,  pueDisposi.TrabajoDeCampo.entrevistas,  pueDisposi.TrabajoDeCampo.visitasDomiciliarias,  pueDisposi.TrabajoDeCampo.investigacionesCumplidas, pueDisposi.TrabajoDeCampo.investigacionesInformadas, pueDisposi.TrabajoDeCampo.individuaciones,  pueDisposi.TrabajoDeCampo.observaciones FROM pueDisposi.TrabajoDeCampo WHERE  pueDisposi.TrabajoDeCampo.idPueDisposicion = $idPuestaDisposicion ";
		}else{
			$query = "   SELECT pueDisposi.TrabajoDeCampo.idTrabajoCampo,  pueDisposi.TrabajoDeCampo.entrevistas,  pueDisposi.TrabajoDeCampo.visitasDomiciliarias,  pueDisposi.TrabajoDeCampo.investigacionesCumplidas, pueDisposi.TrabajoDeCampo.investigacionesInformadas, pueDisposi.TrabajoDeCampo.individuaciones,  pueDisposi.TrabajoDeCampo.observaciones FROM pueDisposi.TrabajoDeCampo WHERE  pueDisposi.TrabajoDeCampo.idTrabajoCampo = $idTrabajoCampo ";
		}


 $indice = 0;
	
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idTrabajoCampo'];
		$arreglo[$indice][1]=$row['entrevistas'];
		$arreglo[$indice][2]=$row['investigacionesCumplidas'];
		$arreglo[$indice][3]=$row['individuaciones'];
		$arreglo[$indice][4]=$row['observaciones'];
		$arreglo[$indice][5]=$row['visitasDomiciliarias'];
		$arreglo[$indice][6]=$row['investigacionesInformadas'];
		$indice++;
	}

		if(isset($arreglo)){return $arreglo;}	

}


function get_data_defunciones_puesta($conn, $idPuestaDisposicion, $idDefuncion){

	if($idDefuncion == 0){
	$query = "    SELECT d.IdDefuncion, d.nombre, d.ap_paterno, d.ap_materno, d.edad, CASE
    WHEN d.sexo = 'm' THEN 'Masculino'
    WHEN d.sexo = 'f' THEN 'Femenino'
    
    ELSE 'Desconocido' 
END as sexo, cm.nombre as causaMuerte, d.movilMuerte, d.observaciones  FROM pueDisposi.Defunciones d INNER JOIN pueDisposi.CatCausaMuertes cm ON cm.CatCausaMuerteId = d.idCausaMuerte WHERE d.idPueDisposicion = $idPuestaDisposicion  ";
}else{
		$query = "    SELECT d.IdDefuncion, d.nombre, d.ap_paterno, d.ap_materno, d.edad, CASE
	    WHEN d.sexo = 'm' THEN 'Masculino'
	    WHEN d.sexo = 'f' THEN 'Femenino'
	    
	    ELSE 'Desconocido' 
	END as sexo, cm.nombre as causaMuerte, d.movilMuerte, d.observaciones  FROM pueDisposi.Defunciones d INNER JOIN pueDisposi.CatCausaMuertes cm ON cm.CatCausaMuerteId = d.idCausaMuerte WHERE d.IdDefuncion = $idDefuncion  ";
}


 $indice = 0;
	
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['IdDefuncion'];
		$arreglo[$indice][1]=$row['nombre'];
		$arreglo[$indice][2]=$row['ap_paterno'];
		$arreglo[$indice][3]=$row['ap_materno'];
		$arreglo[$indice][4]=$row['edad'];
		$arreglo[$indice][5]=$row['sexo'];
		$arreglo[$indice][6]=$row['causaMuerte'];
		$arreglo[$indice][7]=$row['movilMuerte'];
		$arreglo[$indice][8]=$row['observaciones'];


		$indice++;
	}

		if(isset($arreglo)){return $arreglo;}		

}

function get_data_armas_puesta($conn, $idPuestaDisposicion, $idArma){
if($idArma == 0){
			$query = "  SELECT aa.idArmaAsegurada, ta.nombre as tipo, ma.nombre as marca, ca.nombre as calibre, ac.nombre as accesorio, mc.nombre as marcaCa, aa.observaciones FROM pueDisposi.aseguramientoArmas aa 
  INNER JOIN pueDisposi.CatTipoArma ta ON ta.CatTipoArmaID = aa.idTipoArma  
  INNER JOIN pueDisposi.CatMarcaArma ma ON ma.CatMarcaArmaID = aa.idMarcaArma
  INNER JOIN pueDisposi.CatCalibre ca ON ca.CatCalibreID = aa.idCalibre
  INNER JOIN pueDisposi.CatAccesorioArma ac ON ac.CatAccesorioArmaID = aa.idAccesorios 
  INNER JOIN pueDisposi.CatMarcaCartuchos mc ON mc.CatMarcaCartuchosID = aa.idMarcaCartuchos
  WHERE aa.idPueDisposicion = $idPuestaDisposicion ";
}else{
	$query = "  SELECT aa.idArmaAsegurada, ta.nombre as tipo, ma.nombre as marca, ca.nombre as calibre, ac.nombre as accesorio, mc.nombre as marcaCa, aa.observaciones FROM pueDisposi.aseguramientoArmas aa 
  INNER JOIN pueDisposi.CatTipoArma ta ON ta.CatTipoArmaID = aa.idTipoArma  
  INNER JOIN pueDisposi.CatMarcaArma ma ON ma.CatMarcaArmaID = aa.idMarcaArma
  INNER JOIN pueDisposi.CatCalibre ca ON ca.CatCalibreID = aa.idCalibre
  INNER JOIN pueDisposi.CatAccesorioArma ac ON ac.CatAccesorioArmaID = aa.idAccesorios 
  INNER JOIN pueDisposi.CatMarcaCartuchos mc ON mc.CatMarcaCartuchosID = aa.idMarcaCartuchos
  WHERE aa.idArmaAsegurada = $idArma ";
}
  
 $indice = 0;
	
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idArmaAsegurada'];
		$arreglo[$indice][1]=$row['tipo'];
		$arreglo[$indice][2]=$row['marca'];
		$arreglo[$indice][3]=$row['calibre'];
		$arreglo[$indice][4]=$row['accesorio'];
		$arreglo[$indice][5]=$row['marcaCa'];
		$arreglo[$indice][6]=$row['observaciones'];


		$indice++;
	}

		if(isset($arreglo)){return $arreglo;}	

}



function get_data_drog_puesta($conn, $idPuestaDisposicion, $idDroga){
if($idDroga == 0){
			$query = "   SELECT d.idDrogas, cd.nombre, d.kilogramos, d.observaciones, um.nombre as unidadMedida, pq.nombre as prodQuimico 
			FROM pueDisposi.Drogas d 
			INNER JOIN pueDisposi.CatDrogas cd ON cd.CatDrogasId = d.idCatDroga 
			LEFT JOIN pueDisposi.CatUnidadMedidaDroga um ON um.idUnidadMedidaDroga = d.idUnidadMedidaDroga
			LEFT JOIN pueDisposi.CatProdQuimicoDroga pq ON pq.idProductoQuimico = d.idProductoQuimico
			WHERE d.idPueDisposicion = $idPuestaDisposicion   ";
		}else{
			$query = "   SELECT d.idDrogas, cd.nombre, d.kilogramos, d.observaciones,  um.nombre as unidadMedida, pq.nombre as prodQuimico 
			FROM pueDisposi.Drogas d 
			INNER JOIN pueDisposi.CatDrogas cd ON cd.CatDrogasId = d.idCatDroga
			LEFT JOIN pueDisposi.CatUnidadMedidaDroga um ON um.idUnidadMedidaDroga = d.idUnidadMedidaDroga
			LEFT JOIN pueDisposi.CatProdQuimicoDroga pq ON pq.idProductoQuimico = d.idProductoQuimico
			WHERE d.idDrogas = $idDroga   ";
		}


 $indice = 0;
	
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idDrogas'];
		$arreglo[$indice][1]=$row['nombre'];
		$arreglo[$indice][2]=$row['kilogramos'];
		$arreglo[$indice][3]=$row['observaciones'];
		$arreglo[$indice][4]=$row['unidadMedida'];
		$arreglo[$indice][5]=$row['prodQuimico'];

		$indice++;
	}

		if(isset($arreglo)){return $arreglo;}	

}



function get_data_person_puesta($conn, $idPuestaDisposicion, $idPersona){

			if($idPersona == 0){
			$query = " SELECT p.idPersonaDetenida, p.nombre, p.ap_paterno, p.ap_materno, p.nombre+' '+p.ap_paterno+' '+p.ap_materno as nombreCompleto, p.alias, p.edad, d.delito as delitoPrincipal, p.bandas, p.agraviado, p.invFlag, p.bandaSolit, p.avPP, p.numdBas,
	 p.aDispoDe, p.reqOtrasCorpo, p.oficio, p.observaciones,
	CASE
    WHEN p.sexo = 'M' THEN 'Masculino'
    WHEN p.sexo = 'F' THEN 'Femenino'
    ELSE 'Desconocido'
END AS sexo, p.orgCriminalPertenece, CONCAT ( p.dia,'/',p.mes, '/', p.anio ) AS fechaDetencion
FROM pueDisposi.personasDetenidas p 
INNER JOIN pueDisposi.tipoDelitos d ON d.idTipoDelito = p.idTipoDelito 
 WHERE idPuestaDisposicion = $idPuestaDisposicion  ORDER BY p.idPersonaDetenida DESC  ";
}else{
	$query = " SELECT p.idPersonaDetenida, p.nombre, p.ap_paterno, p.ap_materno, p.nombre+' '+p.ap_paterno+' '+p.ap_materno as nombreCompleto, p.alias, p.edad, d.delito as delitoPrincipal, p.bandas, p.agraviado, p.invFlag, p.bandaSolit, p.avPP, p.numdBas,
	 p.aDispoDe, p.reqOtrasCorpo, p.oficio, p.observaciones,
	CASE
    WHEN p.sexo = 'M' THEN 'Masculino'
    WHEN p.sexo = 'F' THEN 'Femenino'
    ELSE 'Desconocido'
END AS sexo, p.orgCriminalPertenece, CONCAT ( p.dia,'/',p.mes, '/', p.anio ) AS fechaDetencion
FROM pueDisposi.personasDetenidas p 
INNER JOIN pueDisposi.tipoDelitos d ON d.idTipoDelito = p.idTipoDelito 
 WHERE idPersonaDetenida = $idPersona   ";
}


 $indice = 0;
	
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idPersonaDetenida'];
		$arreglo[$indice][1]=$row['nombreCompleto'];
		$arreglo[$indice][2]=$row['alias'];
		$arreglo[$indice][3]=$row['edad'];

		$arreglo[$indice][4]=$row['sexo'];
		$arreglo[$indice][5]=$row['orgCriminalPertenece'];
		$arreglo[$indice][6]=$row['nombre'];
		$arreglo[$indice][7]=$row['ap_paterno'];
		$arreglo[$indice][8]=$row['ap_materno'];
		$arreglo[$indice][9]=$row['delitoPrincipal'];

		$arreglo[$indice][10]=$row['bandas'];
		$arreglo[$indice][11]=$row['fechaDetencion'];
		$arreglo[$indice][12]=$row['agraviado'];
		$arreglo[$indice][13]=$row['invFlag'];
		$arreglo[$indice][14]=$row['bandaSolit'];
		$arreglo[$indice][15]=$row['avPP'];
		$arreglo[$indice][16]=$row['numdBas'];
		$arreglo[$indice][17]=$row['aDispoDe'];
  $arreglo[$indice][18]=$row['reqOtrasCorpo'];
  $arreglo[$indice][19]=$row['oficio'];
  $arreglo[$indice][20]=$row['observaciones'];

		$indice++;
	}

		if(isset($arreglo)){return $arreglo;}	

}

function get_data_persona_puesta($conn, $idPuestaDisposicion, $idPersonaDetenida){

			$query = "   SELECT p.idPersonaDetenida, p.nombre+' '+p.ap_paterno+' '+p.ap_materno as nombreCompleto, p.alias, p.edad, 
	CASE
    WHEN p.sexo = 'M' THEN 'Masculino'
    WHEN p.sexo = 'F' THEN 'Femenino'
    ELSE 'Desconocido'
END AS sexo, p.orgCriminalPertenece, CONCAT ( p.dia,'/',p.mes, '/', p.anio ) AS fechaDetencion
FROM pueDisposi.personasDetenidas p 
 WHERE idPuestaDisposicion = $idPuestaDisposicion AND p.idPersonaDetenida = $idPersonaDetenida  ORDER BY p.idPersonaDetenida DESC ";


 $indice = 0;
	
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['idPersonaDetenida'];
		$arreglo[$indice][1]=$row['nombreCompleto'];
		$arreglo[$indice][2]=$row['alias'];
		$arreglo[$indice][3]=$row['edad'];

		$arreglo[$indice][4]=$row['sexo'];
		$arreglo[$indice][5]=$row['orgCriminalPertenece'];
		
		$arreglo[$indice][11]=$row['fechaDetencion'];
		$indice++;
	}

		if(isset($arreglo)){return $arreglo;}	

}




/****** Script para el comando SelectTopNRows de SSMS  ******/
function get_data_puesta($conn, $idPuestaDisposicion){

			$query = "  SELECT m.nombre+' '+m.paterno+' '+m.materno as nombreCompleto,c.nombre as cargo, f.nombre as funcion, aa.nombre as areaAdscripcion , pd.nuc, pd.fechaEvento, pd.fechaInforme, pd.calle, 
  pd.numero, pd.codigoPostal, fi.Nombre as fiscaliam, mu.Nombre as municipio, co.Nombre as colonia, pd.rel, pd.norel, pd.cate, pd.oper, pd.reco, pd.narracion
  FROM pueDisposi.puestaDisposicion pd 
  INNER JOIN pueDisposi.mando m ON m.idMando = pd.idMando 
  INNER JOIN pueDisposi.cargo c ON c.idCargo = m.idCargo
  INNER JOIN pueDisposi.funcion f ON f.idFuncion = m.idFuncion
  INNER JOIN pueDisposi.areaAdscripcion aa ON aa.idAreaAdscripcion = m.idAreaAdscripcion
  INNER JOIN pueDisposi.Fiscalias fi ON fi.CatFiscaliasID = pd.idFiscalia
  INNER JOIN pueDisposi.CatMunicipios mu ON mu.CatMunicipiosID = pd.idMunicipio
  INNER JOIN pueDisposi.CatColonias co ON co.CatColoniasID  = pd.idColonia
  WHERE pd.idPuestaDisposicion = $idPuestaDisposicion";


 $indice = 0;
	
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))
	{
		$arreglo[$indice][0]=$row['nombreCompleto'];
		$arreglo[$indice][1]=$row['cargo'];
		$arreglo[$indice][2]=$row['funcion'];
		$arreglo[$indice][3]=$row['areaAdscripcion'];

		$arreglo[$indice][4]=$row['nuc'];
		$arreglo[$indice][5]=$row['fechaEvento']->format('Y-m-d H:i');
		
		$arreglo[$indice][6]=$row['fechaInforme']->format('Y-m-d H:i');
		
		$arreglo[$indice][7]=$row['calle'];
		$arreglo[$indice][8]=$row['numero'];
		$arreglo[$indice][9]=$row['codigoPostal'];
		$arreglo[$indice][10]=$row['fiscaliam'];
		$arreglo[$indice][11]=$row['municipio'];
		$arreglo[$indice][12]=$row['colonia'];
		$arreglo[$indice][13]=$row['rel'];
		$arreglo[$indice][14]=$row['norel'];
		$arreglo[$indice][15]=$row['cate'];
		$arreglo[$indice][16]=$row['oper'];
		$arreglo[$indice][17]=$row['reco'];
		$arreglo[$indice][18]=$row['narracion'];
		$indice++;
	}

		if(isset($arreglo)){return $arreglo;}	

}


function getTipoEnDelitoVehicle($conn){

							$query = " SELECT [idTipoEnDelito]
      ,[nombre]
  FROM [ESTADISTICAV2].[pueDisposi].[tipoenDelitoVehi] WHERE estatus = 'VI' ";
							$indice = 0;
								$stmt = sqlsrv_query($conn, $query);
								while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
								{
									$arreglo[$indice][0]=$row['idTipoEnDelito'];
									$arreglo[$indice][1]=$row['nombre'];
									$indice++;
								}
								if(isset($arreglo)){return $arreglo;}	

}



function getDelitoVehicle($conn){

							$query = " SELECT TOP 1000 [idDelitoVehi]
      ,[nombre]
  FROM [ESTADISTICAV2].[pueDisposi].[delitoVehi] WHERE estatus = 'VI' ";
							$indice = 0;
								$stmt = sqlsrv_query($conn, $query);
								while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
								{
									$arreglo[$indice][0]=$row['idDelitoVehi'];
									$arreglo[$indice][1]=$row['nombre'];
									$indice++;
								}
								if(isset($arreglo)){return $arreglo;}	

}

function getDisposicVehicle($conn){

							$query = " SELECT [idDisposicion] ,[nombre] FROM [ESTADISTICAV2].[pueDisposi].[disposicion] WHERE estatus = 'VI'";
							$indice = 0;
								$stmt = sqlsrv_query($conn, $query);
								while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
								{
									$arreglo[$indice][0]=$row['idDisposicion'];
									$arreglo[$indice][1]=$row['nombre'];
									$indice++;
								}
								if(isset($arreglo)){return $arreglo;}	

}


function getFormAsegurVehicle($conn){

							$query = " SELECT  [idAseguramientoVehi] ,[nombre]
  FROM [ESTADISTICAV2].[pueDisposi].[aseguramietoVehi] WHERE estatus = 'VI' ";
							$indice = 0;
								$stmt = sqlsrv_query($conn, $query);
								while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
								{
									$arreglo[$indice][0]=$row['idAseguramientoVehi'];
									$arreglo[$indice][1]=$row['nombre'];
									$indice++;
								}
								if(isset($arreglo)){return $arreglo;}	

}


function getClasificacionVehicle($conn){

							$query = " SELECT[idClasificacionVehi],[nombre] FROM [ESTADISTICAV2].[pueDisposi].[clasificacionVehi] WHERE estatus = 'VI' ";
							$indice = 0;
								$stmt = sqlsrv_query($conn, $query);
								while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
								{
									$arreglo[$indice][0]=$row['idClasificacionVehi'];
									$arreglo[$indice][1]=$row['nombre'];
									$indice++;
								}
								if(isset($arreglo)){return $arreglo;}	

}

function getDataForestales($conn){
	$query = "SELECT * FROM pueDisposi.CatForestales";

							 $indice = 0;
								$stmt = sqlsrv_query($conn, $query);
								while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
								{
							
									$arreglo[$indice][0]=$row['CatForestalesId'];
									$arreglo[$indice][1]=$row['nombre'];
							
									$indice++;
								}
								if(isset($arreglo)){return $arreglo;}	
}



function getDataTypeVehicle($conn){

							$query = "   SELECT pueDisposi.CatTiposVehiculosSub.CatTiposVehiculosSubID, pueDisposi.CatTiposVehiculosSub.Nombre FROM pueDisposi.CatTiposVehiculosSub";


							$indice = 0;
								$stmt = sqlsrv_query($conn, $query);
								while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
								{
									$arreglo[$indice][0]=$row['CatTiposVehiculosSubID'];
									$arreglo[$indice][1]=$row['Nombre'];
									$indice++;
								}
								if(isset($arreglo)){return $arreglo;}	

}



function getDataLineaVehicle($conn, $idMarca){

							$query = "   SELECT pueDisposi.CatMarcasVehiculosSub.CatMarcasVehiculosSubID, pueDisposi.CatMarcasVehiculosSub.Nombre FROM pueDisposi.CatMarcasVehiculosSub WHERE pueDisposi.CatMarcasVehiculosSub.CatMarcasVehiculosID = $idMarca ";


							$indice = 0;
								$stmt = sqlsrv_query($conn, $query);
								while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
								{
									$arreglo[$indice][0]=$row['CatMarcasVehiculosSubID'];
									$arreglo[$indice][1]=$row['Nombre'];
									$indice++;
								}
								if(isset($arreglo)){return $arreglo;}	

}

function getDataMarcaVehicle($conn){

							$query = " SELECT pueDisposi.CatMarcasVehiculos.CatMarcasVehiculosID, pueDisposi.CatMarcasVehiculos.Nombre FROM pueDisposi.CatMarcasVehiculos ";


							$indice = 0;
								$stmt = sqlsrv_query($conn, $query);
								while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
								{
									$arreglo[$indice][0]=$row['CatMarcasVehiculosID'];
									$arreglo[$indice][1]=$row['Nombre'];
									$indice++;
								}
								if(isset($arreglo)){return $arreglo;}	

}


			
function getDataMandos($conn){

							$query = " SELECT m.idMando, m.nombre, m.paterno, m.materno, pdc.nombre as cargo, f.nombre as funcion, ad.nombre as areaAdscripcion FROM pueDisposi.mando m 
  INNER JOIN pueDisposi.cargo pdc ON pdc.idCargo = m.idCargo 
  INNER JOIN pueDisposi.funcion f ON f.idFuncion = m.idFuncion
  INNER JOIN pueDisposi.areaAdscripcion ad ON ad.idAreaAdscripcion = m.idAreaAdscripcion ";


							$indice = 0;
								$stmt = sqlsrv_query($conn, $query);
								while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
								{
									$arreglo[$indice][0]=$row['nombre'];
									$arreglo[$indice][1]=$row['paterno'];
									$arreglo[$indice][2]=$row['materno'];
									$arreglo[$indice][3]=$row['cargo'];
									$arreglo[$indice][4]=$row['funcion'];
									$arreglo[$indice][5]=$row['areaAdscripcion'];
									$arreglo[$indice][6]=$row['idMando'];
									$indice++;
								}
								if(isset($arreglo)){return $arreglo;}	

}

function getDataMando($conn, $idMando){

							$query = " SELECT  pdc.nombre as cargo, f.nombre as funcion, ad.nombre as areaAdscripcion FROM pueDisposi.mando m 
  INNER JOIN pueDisposi.cargo pdc ON pdc.idCargo = m.idCargo 
  INNER JOIN pueDisposi.funcion f ON f.idFuncion = m.idFuncion
  INNER JOIN pueDisposi.areaAdscripcion ad ON ad.idAreaAdscripcion = m.idAreaAdscripcion WHERE m.idMando = $idMando ";


							$indice = 0;
								$stmt = sqlsrv_query($conn, $query);
								while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
								{
							
									$arreglo[$indice][0]=$row['cargo'];
									$arreglo[$indice][1]=$row['funcion'];
									$arreglo[$indice][2]=$row['areaAdscripcion'];
							
									$indice++;
								}
								if(isset($arreglo)){return $arreglo;}	

}


function getFiscalias($conn){

							$query = " SELECT CatFiscaliasID,Nombre FROM pueDisposi.Fiscalias ";


							$indice = 0;
								$stmt = sqlsrv_query($conn, $query);
								while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
								{
							
									$arreglo[$indice][0]=$row['CatFiscaliasID'];
									$arreglo[$indice][1]=$row['Nombre'];
							
									$indice++;
								}
								if(isset($arreglo)){return $arreglo;}	

}

function getFiscaliasEnlace($conn, $idEnlace){

							$query = " SELECT ef.idFiscalia, f.nFiscalia FROM pueDisposi.enlaceFiscalia ef INNER JOIN CatFiscalia f ON f.idFiscalia = ef.idFiscalia WHERE ef.idEnlace = $idEnlace ";


							$indice = 0;
								$stmt = sqlsrv_query($conn, $query);
								while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
								{
							
									$arreglo[$indice][0]=$row['idFiscalia'];
									$arreglo[$indice][1]=$row['nFiscalia'];
							
									$indice++;
								}
								if(isset($arreglo)){return $arreglo;}	

}

function getFiscaliasEnlaceConsulta($conn, $idEnlace){

							$query = " SELECT idFiscalia, idEnlaceConsulta FROM pueDisposi.enlaceFiscaliaConsulta WHERE idEnlace = $idEnlace";


							 $indice = 0;
								$stmt = sqlsrv_query($conn, $query);
								while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
								{
							
									$arreglo[$indice][0]=$row['idFiscalia'];
									$arreglo[$indice][1]=$row['idEnlaceConsulta'];
							
									$indice++;
								}
								if(isset($arreglo)){return $arreglo;}	

}

function getDataMunicipiosFiscalia($conn, $idfsicalia){

							$query = "  SELECT CatMunicipiosID, Nombre FROM pueDisposi.CatMunicipios WHERE pueDisposi.CatMunicipios.CatFiscaliasID = $idfsicalia ";


							$indice = 0;
								$stmt = sqlsrv_query($conn, $query);
								while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
								{
							
									$arreglo[$indice][0]=$row['CatMunicipiosID'];
									$arreglo[$indice][1]=$row['Nombre'];
							
									$indice++;
								}
								if(isset($arreglo)){return $arreglo;}	

}

function getDataColoniMunicipio($conn, $idMunicipio){

							$query = " SELECT pueDisposi.CatColonias.CatColoniasID ,pueDisposi.CatColonias.CodigoPostal, pueDisposi.CatColonias.Nombre FROM pueDisposi.CatColonias WHERE pueDisposi.CatColonias.CatMunicipiosID = $idMunicipio ";


							$indice = 0;
								$stmt = sqlsrv_query($conn, $query);
								while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
								{
							
									$arreglo[$indice][0]=$row['CatColoniasID'];
									$arreglo[$indice][1]=$row['CodigoPostal'];
									$arreglo[$indice][2]=$row['Nombre'];
							
									$indice++;
								}
								if(isset($arreglo)){return $arreglo;}	

}

function getDataCodePostal($conn, $idColoni){


					$query = " SELECT pueDisposi.CatColonias.CodigoPostal FROM pueDisposi.CatColonias WHERE pueDisposi.CatColonias.CatColoniasID = $idColoni ";


							$indice = 0;
								$stmt = sqlsrv_query($conn, $query);
								while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
								{
							
									$arreglo[$indice][0]=$row['CodigoPostal'];
							
									$indice++;
								}
								if(isset($arreglo)){return $arreglo;}	

}

function getDataDrogas($conn){
	$query = "SELECT * FROM pueDisposi.CatDrogas";

							 $indice = 0;
								$stmt = sqlsrv_query($conn, $query);
								while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
								{
							
									$arreglo[$indice][0]=$row['CatDrogasId'];
									$arreglo[$indice][1]=$row['nombre'];
							
									$indice++;
								}
								if(isset($arreglo)){return $arreglo;}	
}

function getDataDelitos($conn){
	$query = "SELECT * FROM pueDisposi.tipoDelitos";

							 $indice = 0;
								$stmt = sqlsrv_query($conn, $query);
								while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
								{
							
									$arreglo[$indice][0]=$row['idTipoDelito'];
									$arreglo[$indice][1]=$row['delito'];
							
									$indice++;
								}
								if(isset($arreglo)){return $arreglo;}	
}

function getDataDelitosPorPersona($conn , $idPersona){
	$query = "SELECT dp.id as idDelitoPersona, dp.idPersona, dp.idCatDelito , td.delito as nombreDelito 
	          FROM pueDisposi.DelitosPorPersona dp 
	          INNER JOIN pueDisposi.tipoDelitos td on td.idTipoDelito = dp.idCatDelito
	          WHERE idPersona = $idPersona";


							 $indice = 0;
								$stmt = sqlsrv_query($conn, $query);
								while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
								{
							
									$arreglo[$indice][0]=$row['idDelitoPersona'];
									$arreglo[$indice][1]=$row['idPersona'];
									$arreglo[$indice][2]=$row['idCatDelito'];
							  $arreglo[$indice][2]=$row['nombreDelito'];
									$indice++;
								}
								if(isset($arreglo)){return $arreglo;}	
}


function getDataUnidadMedida($conn){
	$query = "SELECT * FROM pueDisposi.CatUnidadMedidaDroga";

							 $indice = 0;
								$stmt = sqlsrv_query($conn, $query);
								while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
								{
							
									$arreglo[$indice][0]=$row['idUnidadMedidaDroga'];
									$arreglo[$indice][1]=$row['nombre'];
							
									$indice++;
								}
								if(isset($arreglo)){return $arreglo;}	
}

function getDataProductoQuimico($conn){
	$query = "SELECT * FROM pueDisposi.CatProdQuimicoDroga";

							 $indice = 0;
								$stmt = sqlsrv_query($conn, $query);
								while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC ))	
								{
							
									$arreglo[$indice][0]=$row['idProductoQuimico'];
									$arreglo[$indice][1]=$row['nombre'];
							
									$indice++;
								}
								if(isset($arreglo)){return $arreglo;}	
}


//**************MODULO ADMINISTRACION******************
function getareaAdscripcion($conn){
	$query = "SELECT * FROM pueDisposi.areaAdscripcion";
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC )){
		$arreglo[$indice][0]=$row['idAreaAdscripcion'];
		$arreglo[$indice][1]=$row['nombre'];
		$arreglo[$indice][2]=$row['estatus'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	
}

function getCargo($conn){
	$query = "SELECT * FROM pueDisposi.cargo";
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC )){
		$arreglo[$indice][0]=$row['idCargo'];
		$arreglo[$indice][1]=$row['nombre'];
		$arreglo[$indice][2]=$row['estatus'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	
}

function getFuncion($conn){
	$query = "SELECT * FROM pueDisposi.funcion";
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC )){
		$arreglo[$indice][0]=$row['idFuncion'];
		$arreglo[$indice][1]=$row['nombre'];
		$arreglo[$indice][2]=$row['estatus'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	
}


function getDataMandoTableAdm($conn, $idMando, $areaAdsc){
	if($idMando != 0){
		$query = " SELECT m.idMando, m.nombre+' '+m.paterno+' '+m.materno as nombreMando, m.nombre, m.paterno, m.materno, pdc.nombre as cargo, f.nombre as funcion, ad.nombre as areaAdscripcion, m.idCargo, m.idFuncion, m.idAreaAdscripcion, CASE WHEN m.estatus = 'VI' THEN 'Activo' ELSE 'Inactivo' END as estatus 
		FROM pueDisposi.mando m 
  INNER JOIN pueDisposi.cargo pdc ON pdc.idCargo = m.idCargo 
  INNER JOIN pueDisposi.funcion f ON f.idFuncion = m.idFuncion
  INNER JOIN pueDisposi.areaAdscripcion ad ON ad.idAreaAdscripcion = m.idAreaAdscripcion WHERE m.idMando = $idMando ";
	}elseif ($areaAdsc == 'todos'){
		$query = " SELECT m.idMando, m.nombre+' '+m.paterno+' '+m.materno as nombreMando, m.nombre, m.paterno, m.materno, pdc.nombre as cargo, f.nombre as funcion, ad.nombre as areaAdscripcion, m.idCargo, m.idFuncion, m.idAreaAdscripcion, CASE WHEN m.estatus = 'VI' THEN 'Activo' ELSE 'Inactivo' END as estatus 
		FROM pueDisposi.mando m 
  INNER JOIN pueDisposi.cargo pdc ON pdc.idCargo = m.idCargo 
  INNER JOIN pueDisposi.funcion f ON f.idFuncion = m.idFuncion
  INNER JOIN pueDisposi.areaAdscripcion ad ON ad.idAreaAdscripcion = m.idAreaAdscripcion
  ORDER BY m.idAreaAdscripcion ASC";
	}else{
			$query = " SELECT m.idMando, m.nombre+' '+m.paterno+' '+m.materno as nombreMando, m.nombre, m.paterno, m.materno, pdc.nombre as cargo, f.nombre as funcion, ad.nombre as areaAdscripcion, m.idCargo, m.idFuncion, m.idAreaAdscripcion, CASE WHEN m.estatus = 'VI' THEN 'Activo' ELSE 'Inactivo' END as estatus
		FROM pueDisposi.mando m 
  INNER JOIN pueDisposi.cargo pdc ON pdc.idCargo = m.idCargo 
  INNER JOIN pueDisposi.funcion f ON f.idFuncion = m.idFuncion
  INNER JOIN pueDisposi.areaAdscripcion ad ON ad.idAreaAdscripcion = m.idAreaAdscripcion WHERE m.idAreaAdscripcion = $areaAdsc"; 
	}
	
  $indice = 0;
  $stmt = sqlsrv_query($conn, $query);
		while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC )){
			$arreglo[$indice][0]=$row['idMando'];
			$arreglo[$indice][1]=$row['nombreMando'];
			$arreglo[$indice][2]=$row['nombre'];
			$arreglo[$indice][3]=$row['paterno'];
			$arreglo[$indice][4]=$row['materno'];
			$arreglo[$indice][5]=$row['cargo'];
			$arreglo[$indice][6]=$row['funcion'];
			$arreglo[$indice][7]=$row['areaAdscripcion'];
			$arreglo[$indice][8]=$row['idCargo'];
			$arreglo[$indice][9]=$row['idFuncion'];
			$arreglo[$indice][10]=$row['idAreaAdscripcion'];
			$arreglo[$indice][11]=$row['estatus'];
			$indice++;
		}
		if(isset($arreglo)){return $arreglo;}	

}

function getAnioPueDispo($conn){
	$query = "SELECT  DISTINCT anio FROM pueDisposi.puestaDisposicion WHERE anio >= 2020";
	$indice = 0;
	$stmt = sqlsrv_query($conn, $query);
	while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC )){
		$arreglo[$indice][0]=$row['anio'];
		$indice++;
	}
	if(isset($arreglo)){return $arreglo;}	
}

function getDataAnio(){
	$arreglo[0][0]=2020;
	$arreglo[1][0]=2021;
	return $arreglo;
}


?>


