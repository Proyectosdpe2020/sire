<?php
session_start();
include("../../Conexiones/Conexion.php");
include("../../Conexiones/conexionSIMAJ.php");
include("../../funcionesMandamientos.php");

if (isset($_POST["ID_MANDAMIENTO_INTERNO"])){ $ID_MANDAMIENTO_INTERNO = $_POST["ID_MANDAMIENTO_INTERNO"]; }
$getFile = getFileFromMAndamiento($conn, $ID_MANDAMIENTO_INTERNO);
$ruta = "format/mandamientosJudiciales/documentos/".$getFile[0][0];
?>

<div id="modalFiles" class="modalFiles">	
	<embed style="width: 100% !important;" src="<? echo $ruta."#zoom=FitH"; ?>" type="application/pdf" width="100%" height="800"></embed>		
</div> 


</div>
<div class="mod-foot">
	<div class="btns-flex">			
		<button style="width: 100% !important; background-color: #46bf58 !important;" type="button" class="btn-modal  warning" data-dismiss="modal" onclick="closeModaFIle()">Salir</button>
	</div>	
</div>