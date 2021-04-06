<?
	if (isset($_POST["idEstatusNucs"])){ $idEstatusNucs = $_POST["idEstatusNucs"]; }
	if (isset($_POST["estatus"])){ $estatResolucion = $_POST["estatus"]; }
	if (isset($_POST["nuc"])){ $nuc = $_POST["nuc"]; }
	if (isset($_POST["opcInsert"])){ $opcInsert = $_POST["opcInsert"]; } // Recibe 1, indicando que se puede editar información
?>

<td class="tdRowMain"><center><button type="button" onclick="showModalNucLitInfo(<? echo $idEstatusNucs; ?>, <? echo $estatResolucion; ?>, <? echo $nuc; ?>, <? echo $opcInsert; ?>)" class="btn btn-success btn-sm redondear btnCapturarTbl"><span style="color: white !important;" class="glyphicon glyphicon-pencil"></span> Editar k </button></center></td>
