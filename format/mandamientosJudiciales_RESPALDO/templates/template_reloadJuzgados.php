<?
include ("../../../Conexiones/conexionSIMAJ.php");
include("../../../funcionesMandamientos.php");	

if (isset($_POST["ID_ESTADO_JUZGADO"])){ $ID_ESTADO_JUZGADO = $_POST["ID_ESTADO_JUZGADO"]; }
?>
<option class="fontBold" value="">Seleccione la entidad del juzgado</option>
<? $juzgado  = getJuzgado($connSIMAJ, $ID_ESTADO_JUZGADO);
   if(sizeof($juzgado ) > 0 ){
   	for ($i=0; $i < sizeof($juzgado); $i++) { 
   		$cv_juzgado = $juzgado[$i][1];	$descrip_juzgado = $juzgado [$i][2]; ?>
   		<option class="fontBold" value="<? echo $cv_juzgado; ?>" ><? echo $descrip_juzgado; ?></option>
 <? } 
  }else{ ?>
   	<option class="fontBold" value="0" >NO ESPECIFICADO</option>
<?} ?>