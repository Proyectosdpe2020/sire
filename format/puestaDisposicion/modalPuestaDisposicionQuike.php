
	<?php

	?>



			<div style="" class="x_panel principalPanel">

				<div class="row pad20" style="">	


					<datalist id="newBrwosers">
				    <option value="CHRISTIAN DONALDO CORTES BARCENAS" data-value="1" data-id="1"></option>
				    <option value="weewe" data-value="2" data-id="2"></option>
				    <option value="ghfh data-value="3" data-id="3"></option>
				    <option value="hfbcb" data-value="4" data-id="4"></option>
				    <option value="cbcb" data-value="5" data-id="5"></option>
				    <option value="CHRISTIAN DONALDO CORTES BARCENAS" data-value="6" data-id="6"></option>
				    <option value="CHRISTIAN DONALDO CORTES BARCENAS" data-value="7" data-id="7"></option>
				</datalist>

				<label for="heard">Selecciona Mando:</label><br>			
				<input class="form-control" onchange="getData()" list="newBrwosers" id="newBrwoser" name="newBrwoser" type="text"><br>


					<label for="state">State:</label>
<input type="text" name="state" id="state" list="state_list">
<datalist id="state_list">
  <option value="AL">Alabama</option>
  <option value="AK">Alaska</option>
  <option value="AZ">Arizona</option>
  <option value="AR">Arkansas</option>
  <!-- etc -->
</datalist>



							<div class="col-xs-6 col-sm-4  col-md-1">
						<label for="heard">Año:</label><br>
						<select id="anioCmasc" name="selMes" tabindex="6" class="form-control redondear selectTranparent" required>
							<option value="2018" selected>2019</option>
						</select>
					</div>

					<div class="col-xs-6 col-sm-4  col-md-1">
						<label for="heard">Mes:</label><br>
						<select id="mesCmasc" name="selMes" tabindex="6"class="form-control redondear selectTranparent" required>
							<option value="<? echo $mesCapturar; ?>" selected>Septiembre</option>
						</select>
					</div>

					<div class="col-xs-6 col-sm-4  col-md-1">
						<label for="heard">Día:</label><br>
						<select id="mesCmasc" name="selMes" tabindex="6"class="form-control redondear selectTranparent" required>
							<option value="<? echo $mesCapturar; ?>" selected> Miercoles-9</option>
						</select>
					</div>

					<div class="col-xs-6 col-sm-4  col-md-6">
						<label for="heard">Mando:</label><br>
						<select id="mesCmasc" name="selMes" tabindex="6"class="form-control redondear selectTranparent" required>
							<option value="<? echo $mesCapturar; ?>" >  Todos </option>
							<option value="<? echo $mesCapturar; ?>" selected>  CHRISTIAN DONALDO CORTES BARCENAS </option>
						</select>
					</div>

					<div class="col-xs-6 col-sm-4  col-md-1">
								<label class="transparente">.</label>		
								<center><button type="button"  onclick="" class="btn btn-warning btn-sm redondear btnCapturarTbl"><span class="glyphicon glyphicon-cloud-download"></span> Descargar </button></center>

					</div>
					<div class="col-xs-6 col-sm-4  col-md-2">
								<label class="transparente">.</label>		
								<center><button type="button" data-toggle="modal" href="#puestdispos" style="white-space: normal;"  onclick="showmodalPueDispo();" class="btn btn-success btn-sm redondear btnCapturarTbl"><span class="glyphicon glyphicon-plus-sign"></span> Nueva Puesta Disposición </button></center>

					</div>
									

				</div>
			</div>






