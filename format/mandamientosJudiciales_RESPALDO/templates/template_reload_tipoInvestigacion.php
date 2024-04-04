<?
include ("../../../Conexiones/conexionSIMAJ.php");
include("../../../funcionesMandamientos.php");	

if (isset($_POST["TIPO_INVESTIGACION"])){ $TIPO_INVESTIGACION = $_POST["TIPO_INVESTIGACION"]; }
?>

<?php
if($TIPO_INVESTIGACION == 1){
?>
 <label for="NO_AVERIGUACION"><span class="glyphicon glyphicon-certificate"></span> No. de averiguación :</label><br>
 <input type="number" id="NO_AVERIGUACION" class="form-control" placeholder="ESPECIFICA EL NO. DE AVERIGUACIÓN PREVIA*" aria-describedby="sizing-addon1" maxlength="13" oninput="validateNucs(this)"  type="number">
<? }else{ ?>
 <label for="nuc"><span class="glyphicon glyphicon-certificate"></span> NUC :</label><br>
 <div class="preloaderSelect_NUC" hidden >Validando NUC, espere un momento...<img width="50px"  src="img/loaderData.gif"></div>
 <input type="number" id="nuc" class="form-control" placeholder="ESPECIFICA EL NUC*" aria-describedby="sizing-addon1" maxlength="13" oninput="validateNucs(this)"  type="number">
<? } ?>

<!--ELIMINAR-->