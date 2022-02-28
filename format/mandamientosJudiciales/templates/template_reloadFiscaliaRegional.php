<?
include ("../../../Conexiones/conexionSIMAJ.php");
include("../../../funcionesMandamientos.php");	

if (isset($_POST["ID_MUNICIPIO"])){ $cv_municipio = $_POST["ID_MUNICIPIO"]; }
?>

<option class="fontBold" value="">Seleccione la fiscalía regional</option>
<? $fiscaliaRegional = getFiscaliaRegional($connSIMAJ, $cv_municipio);
   if(sizeof($fiscaliaRegional) > 0 ){
   	for ($i=0; $i < sizeof($fiscaliaRegional); $i++) { 
   		$id = $fiscaliaRegional[$i][0];	$nom_fis = $fiscaliaRegional[$i][1]; ?>
   		<option class="fontBold" value="<? echo $id; ?>" ><? echo $nom_fis; ?></option>
 <? } 
  }else{ ?>
   	<option class="fontBold" value="0" >NO ESPECIFICADO</option>
<?} ?>