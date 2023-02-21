<?php
include ("../../Conexiones/Conexion.php");
include("../../funcionesEstadoDeFuerza.php");

if (isset($_POST['idMando'])){ $idMando = $_POST['idMando']; }
if (isset($_POST['idArma'])){ $idArma = $_POST['idArma']; }
if (isset($_POST["jObjectDataGeneralMando"])){ $data = json_decode($_POST['jObjectDataGeneralMando'], true); }

//Flag 1: Editar y Flag 0 : Agregar nuevo mano . Si recibimos el idMando es un editar del registro
if($idArma != 0){
 $flag = 1; 
 $getDataArmas = getDataArmas($conn, $idMando, $idArma);  
 $idArma = $getDataArmas[0][0];
 $catArma = $getDataArmas[0][2];
 $marca = $getDataArmas[0][3];
 $modelo = $getDataArmas[0][4];
 $matricula = $getDataArmas[0][5];
 $calibre = $getDataArmas[0][6];
 $folio = $getDataArmas[0][7];
}else{
	$flag = 0;
}

?>

<div class="modal-header" style="background-color:#152F4A;">
	<center><h4  style="font-weight: bold; color: white;" class="modal-title"><? if($flag == 0){ echo 'REGISTRO DE ARMA'; }else{ echo 'ACTUALIZACIÓN DE ARMA'; } ?></h4></center>
</div>

<div class="modal-body">
	<!--****************** DATOS GENERALES ***************-->
	<input type="hidden" id="nombre" value="<?php echo $data[0]; ?>" >	          
	<input type="hidden" id="ap_paterno" value="<?php echo $data[1]; ?>" >		
	<input type="hidden" id="ap_materno" value="<?php echo $data[2]; ?>" >		
	<input type="hidden" id="sexo" value="<?php echo $data[3]; ?>" >	      
	<input type="hidden" id="cargo" value="<?php echo $data[4]; ?>" >	     
	<input type="hidden" id="funcion" value="<?php echo $data[5]; ?>" >	 
	<input type="hidden" id="fisUnid" value="<?php echo $data[6]; ?>" >
	<input type="hidden" id="areaAdscripcion" value="<?php echo $data[7]; ?>" >
	<input type="hidden" id="seccion" value="<?php echo $data[8]; ?>" >	
	<input type="hidden" id="comisionado" value="<?php echo $data[9]; ?>" >
	<input type="hidden" id="fechaAlta" value="<?php echo $data[10]; ?>" >
	<input type="hidden" id="fechaActualAdsc" value="<?php echo $data[11]; ?>" >				
    <input type="hidden" id="observacionesMando" value="<?php echo $data[12]; ?>" >	

	<!--******************* ARMA LARGA Y ARMA CORTA**********************!-->
				<div class="panel panel-default">
					<div class="panel-body">
						<h5 class="text-on-pannel"><strong> ARMAS </strong></h5>

						<div class="row">
							<div class="col-xs-12 col-sm-4 col-md-4">
								<label for="cateArma">Categoria de arma:<span class="aste">(*)</span></label>
								<select id="cateArma" name="cateArma" tabindex="6" class="form-control redondear selectTranparent" required>
									<option value="0">Selecciona</option>
									<option style="color: black; font-weight: bold;" value="1" <?if($flag == 1 && $catArma == 1){ ?> selected <? } ?> >ARMA LARGA</option>
									<option style="color: black; font-weight: bold;" value="2" <?if($flag == 1 && $catArma == 2){ ?> selected <? } ?> >ARMA CORTA</option>
								</select>
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4">
								<label for="marcaArma">Marca:<span class="aste">(*)</span></label>
								<input value="<?if($flag == 1){ echo $marca; } ?>" type="text" style="text-transform:uppercase;" class="form-control" id="marcaArma" name="marcaArma" onkeyup="javascript:this.value=this.value.toUpperCase();">
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4">
								<label for="modeloArma">Modelo:<span class="aste">(*)</span></label>
								<input value="<?if($flag == 1){ echo $modelo; } ?>" type="text" style="text-transform:uppercase;" class="form-control" id="modeloArma" name="modeloArma" onkeyup="javascript:this.value=this.value.toUpperCase();">
							</div>
						</div><br><br>

						<div class="row">	
							<div class="col-xs-12 col-sm-4 col-md-4">
								<label for="matriculaArma">Matricula:<span class="aste">(*)</span></label>
								<input value="<?if($flag == 1){ echo $matricula; } ?>" type="text" style="text-transform:uppercase;" class="form-control" id="matriculaArma" name="matriculaArma" onkeyup="javascript:this.value=this.value.toUpperCase();">
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4">
								<label for="calibreArma">Calibre:<span class="aste">(*)</span></label>
								<input value="<?if($flag == 1){ echo $calibre; } ?>" type="text" style="text-transform:uppercase;" class="form-control" id="calibreArma" name="calibreArma" onkeyup="javascript:this.value=this.value.toUpperCase();">
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4">
								<label for="folioArma">Folio:<span class="aste">(*)</span></label>
								<input value="<?if($flag == 1){ echo $folio; } ?>" type="text" style="text-transform:uppercase;" class="form-control" id="folioArma" name="folioArma" onkeyup="javascript:this.value=this.value.toUpperCase();">
							</div>					
						</div>

					</div>
				</div><br>

</div><br><br>

<div class="modal-footer">
	<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-6"><center><button style="width: 88%;" onclick="closeModalArmas()" type="button" class="btn btn-default redondear" data-dismiss="modal">Salir</button></center></div>
			<div class="col-xs-12 col-sm-12 col-md-6"><center><button style="width: 88%;" onclick="saveDbArma(<? echo $idMando; ?> , <? echo $flag; ?> , <? echo $idArma; ?>)" type="button" class="btn btn-primary redondear" >Guardar</button></center></div>
	</div>
</div>


