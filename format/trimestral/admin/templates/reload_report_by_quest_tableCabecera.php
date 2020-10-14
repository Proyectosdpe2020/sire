<?
if (isset($_GET["anioTrimes"])){ $anioTrimes = $_GET["anioTrimes"]; }
if (isset($_GET["periodoTrimes"])){ $periodoTrimes = $_GET["periodoTrimes"]; }
?>

<? if($periodoTrimes == 1){ ?>Primer Trimestre<br>Enero - Marzo <? echo $anioTrimes; ?><? } ?>
<? if($periodoTrimes == 2){ ?>Segundo Trimestre<br>Abril - Junio <? echo $anioTrimes; ?><? } ?>
<? if($periodoTrimes == 3){ ?>Tercer Trimestre<br>Julio - Septiembre <? echo $anioTrimes; ?><? } ?>
<? if($periodoTrimes == 4){ ?>Cuarto Trimestre<br>Octubre - Diciembre <? echo $anioTrimes; ?><? } ?>