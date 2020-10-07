<?php
    $url = 'http://201.116.252.158:8080/sire/repositorio/'.$_GET['ubication'];
?>
												
                            
<div class="modal-header" style="background-color: #3f5265; text-align: center; color: #FFFFFF;">

    Revisión PDF

</div>

<div id="review_modal_content">

    <embed src="<?php echo $url; ?>" type="application/pdf" width="100%" height="800"></embed>

</div>

<div id="review_modal_buttons" style="display: inline-block; padding: 10px; width: 100%;">

    <button type="button" class="btn btn-success" style="padding: 10px; width: 33%; float: left;" onclick="reviewReport(<?php echo $_GET['period'].', '.$_GET['year'].', '.$_GET['file'].', '.$_GET['link'];; ?>, 'rev')">Aceptar <i class="fa fa-check" aria-hidden="true"></i></button>
    <button type="button" class="btn btn-danger" style="padding: 10px; width: 33%; float: left;" onclick="reviewReport(<?php echo $_GET['period'].', '.$_GET['year'].', '.$_GET['file'].', '.$_GET['link'];; ?>, 'rec')">Rechazar <i class="fa fa-times" aria-hidden="true"></i></button>
    <button type="button" class="btn btn-light" style="padding: 10px; width: 33%; margin: 0 auto;" onclick="closeReviewReport()">Cancelar</button>

</div>
