<?php
include ("../../../Conexiones/Conexion.php");
include("../../../funcionesForestales.php");	

if (isset($_GET["mesCapturando"])){ $mesCapturando = $_GET["mesCapturando"]; }
$dataMesText = getDataMesText($mesCapturando);	
?>

<label class="transparente">.</label>
<center><button type="button" data-toggle="modal" href="#puestdispos" style="white-space: normal;"  class="btn btn-success btn-sm redondear btnCapturarTbl"><span class="glyphicon glyphicon-ok"></span> INFORME MENSUAL <?echo $dataMesText;  ?> ENVIADO </button></center>