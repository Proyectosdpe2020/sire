<? 
 session_start();
	if (isset($_POST["idArchivo"])){ $idArchivo = $_POST["idArchivo"]; }
		if (isset($_POST["ubicacion"])){ $ubicacion = $_POST["ubicacion"]; }


	$ruta = "repositorio/".$ubicacion;


	
?>
   												
  
   	<div class="col-md-12 col-sm-12 col-xs-12 form-group">				

					<embed id="frameVerArchivo" src="<? echo $ruta; ?>" type="application/pdf" width="100%" height="900"></embed>

				</div>

