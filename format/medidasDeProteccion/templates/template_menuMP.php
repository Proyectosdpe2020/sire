<div class="col-xs-12 col-sm-12 col-md-3">
				<button type="button" class="btn btn-default btn-lg btn-block" id="mod1" onclick="mostrarCampos(event, 'datosGenerales')"<?if($rolUser != 4 && ($checkExistDataGeneral == '' && $fraccion == 0)){ ?> disabled <? } ?> >Datos generales</button>
				<button type="button" class="btn btn-default btn-lg btn-block" id="mod2" onclick="mostrarCampos(event, 'resolucion')"  <?if($checkInfoPrevia == 0){ ?> disabled <? } ?> >Resolución</button>
				<button type="button" class="btn btn-default btn-lg btn-block" id="mod3" onclick="mostrarCampos(event, 'victima')" >Victima</button>
				<button type="button" class="btn btn-default btn-lg btn-block" id="mod4" onclick="mostrarCampos(event, 'imputados')"  <?if($checkInfoPrevia == 0){ ?> disabled <? } ?> >Imputados</button>
				<button type="button" class="btn btn-default btn-lg btn-block" id="mod5" onclick="mostrarCampos(event, 'constanciaLlamadas')"  <?if($checkInfoPrevia == 0){ ?> disabled <? } ?> >Constancia de llamadas</button>
				<button type="button" class="btn btn-default btn-lg btn-block" id="mod6" onclick="mostrarCampos(event, 'fracciones')"  <?if($checkInfoPrevia == 0){ ?> disabled <? } ?> >Fracciones</button>
				<br>
		</div>