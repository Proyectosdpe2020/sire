<?php
session_start();
include ("../../Conexiones/Conexion.php");
include("../../funciones.php");	
include("../../funCmasc.php");
 
$idUsuario = $_SESSION['useridIE'];

if (isset($_POST["idEnlace"])){ $idEnlace = $_POST["idEnlace"]; }
if (isset($_POST["anio"])){ $anio = $_POST["anio"]; }
if (isset($_POST["mes"])){ $mes = $_POST["mes"]; }

$a = sumEstatus($conn, $mes, $anio, $idEnlace, 1, 3);
$b = sumEstatus($conn, $mes, $anio, $idEnlace, 2, 3);
$c = sumEstatus($conn, $mes, $anio, $idEnlace, 3, 3);
$d = sumEstatus($conn, $mes, $anio, $idEnlace, 8, 3);
$e = sumEstatus($conn, $mes, $anio, $idEnlace, 9, 3);
$f = sumEstatus($conn, $mes, $anio, $idEnlace, 4, 3);
$g = sumEstatus($conn, $mes, $anio, $idEnlace, 10, 3);
$h = sumEstatus($conn, $mes, $anio, $idEnlace, 5, 3);
$i = sumEstatus($conn, $mes, $anio, $idEnlace, 11, 3);
$j = sumEstatus($conn, $mes, $anio, $idEnlace, 6, 3);
$k = sumEstatus($conn, $mes, $anio, $idEnlace, 12, 3);
$l = sumEstatus($conn, $mes, $anio, $idEnlace, 7, 3);
$m = sumEstatus($conn, $mes, $anio, $idEnlace, 13, 3);
$n = sumEstatus($conn, $mes, $anio, $idEnlace, 14, 3);
$o = sumEstatus($conn, $mes, $anio, $idEnlace, 15, 3);

?>
<div class="tab" style="width:100% !important; margin: 0 auto !important; margin-top:0px !important;">

</div>
<div id="contentTabs" style="width:100% !important; margin: 0 auto !important; margin-top:0px !important;" class="">


 <!-- AQUI INICIA EL CODIGO PARA AGREGAR LA PRIMER ESTAÑA ( RECIBIDAS POR OTRA UNIDAD ) -->
 <div class="row">



  <div class="col-xs-12 col-sm-12  col-md-12" style="zoom:130% !important;">
   <div class="">

    <div class="mediacion">
     <center>
      <h3 class="tittleAcuerd">Junta Restaurativa
      </center>
     </h3>
    </center>
   </div>



   <div class="panel panel-default fd1" style="">
    <div class="panel-body">
     <h5 class="text-on-pannel"><strong>Mediante Acuerdo </strong></h5>


     <div class="row">

      <div class="col-xs-6">
       <label class="colorLetras" for="inputlg">Inmediato :</label>
       <div class="iconiput">
        <input type="number" onclick="sendModalCmasc(1,3,<? echo $idEnlace ?>, <? echo $mes; ?>, <? echo $anio; ?>)" placeholder="Hacer clic para agregar información" style="cursor: pointer; text-align: center; font-size: 1.5rem;" class="first"
        id="m-aordi" value="<? if($a[0][0] > 0 ){ echo $a[0][0]; } ?>" readonly/>
        <span   onclick="sendModalCmasc(1,3,<? echo $idEnlace ?>, <? echo $mes; ?>, <? echo $anio; ?>)">
         <div id="checkSdetenju"><i class="fa fa-file-text fa-lg fa-fw"
          aria-hidden="true"></i></div>
         </span>
        </div>
       </div>
       <div class="col-xs-6">
        <label class="colorLetras" for="inputlg">Diferido :</label>
        <div class="iconiput">
         <input type="number" onclick="sendModalCmasc(2,3,<? echo $idEnlace ?>, <? echo $mes; ?>, <? echo $anio; ?>)" placeholder="Hacer clic para agregar información" style="cursor: pointer; text-align: center; font-size: 1.5rem;" class="first" id="" value="<? if($b[0][0] > 0 ){ echo $b[0][0]; }  ?>" readonly/>
         <span  onclick="sendModalCmasc(2,3,<? echo $idEnlace ?>, <? echo $mes; ?>, <? echo $anio; ?>)">
          <div id=""><i class="fa fa-file-text fa-lg fa-fw"
           aria-hidden="true"></i></div>
          </span>
         </div>
        </div>
       </div>
       <div class="row">

        <div class="col-xs-6">
         <label class="colorLetras" for="inputlg">Reconocimiento de responsabilidad y disculpaa victima u ofendido :</label>
         <div class="iconiput">
          <input type="number" onclick="sendModalCmasc(14,3,<? echo $idEnlace ?>, <? echo $mes; ?>, <? echo $anio; ?>)" placeholder="Hacer clic para agregar información" style="cursor: pointer; text-align: center; font-size: 1.5rem;" class="first" id="" value="<? if($n[0][0] > 0 ){ echo $n[0][0]; } ?>" />
          <span onclick="sendModalCmasc(14,3,<? echo $idEnlace ?>, <? echo $mes; ?>, <? echo $anio; ?>)"> <div id=""><i class="fa fa-file-text fa-lg fa-fw"
           aria-hidden="true"></i></div>
          </span>
         </div>
        </div>
        <div class="col-xs-6">
         <label class="colorLetras" for="inputlg">Compromiso de no repetición de la conducta y sometimiento a programas :</label>
         <div class="iconiput">
          <input type="number" onclick="sendModalCmasc(15,3,<? echo $idEnlace ?>, <? echo $mes; ?>, <? echo $anio; ?>)" placeholder="Hacer clic para agregar información" style="cursor: pointer; text-align: center; font-size: 1.5rem;" class="first" id="" value="<? if($o[0][0] > 0 ){ echo $o[0][0]; } ?>" />
          <span onclick="sendModalCmasc(15,3,<? echo $idEnlace ?>, <? echo $mes; ?>, <? echo $anio; ?>)">
          <div id=""><i class="fa fa-file-text fa-lg fa-fw"
           aria-hidden="true"></i></div>
          </span>
         </div>
        </div>
       </div>

      </div>
     </div>

     <div class="panel panel-default fd1" style="">
      <div class="panel-body">
       <h4 class="text-on-pannel"><strong> Terminación anticipada </strong></h4>

       <div class="row">
        <div class="col-xs-6">
         <div class="panel panel-default fd1" style="">
          <div class="panel-body">
           <h5 class="text-on-pannel"><strong> Por voluntad de alguno de los intervinientes
           </strong></h5>
           <div class="iconiput">
            <input type="number" onclick="sendModalCmasc(3,3,<? echo $idEnlace ?>, <? echo $mes; ?>, <? echo $anio; ?>)" placeholder="Hacer clic para agregar información" style="cursor: pointer; text-align: center; font-size: 1.5rem;" class="first" id="" value="<? if($c[0][0] > 0 ){ echo $c[0][0]; }  ?>" readonly/>
            <span onclick="sendModalCmasc(3,3,<? echo $idEnlace ?>, <? echo $mes; ?>, <? echo $anio; ?>)">
             <div id=""><i class="fa fa-file-text fa-lg fa-fw"
              aria-hidden="true"></i></div>
             </span>
            </div>
           </div>
          </div>
         </div>

         <div class="col-xs-6">
          <div class="panel panel-default fd1" style="">
           <div class="panel-body">
            <h5 class="text-on-pannel"><strong> Por inasistencia injustificada </strong>
            </h5>
            <div class="row">

             <div class="col-xs-6">
              <label class="colorLetras" for="inputlg">Victima / Ofendido :</label>
              <div class="iconiput">
               <input type="number" onclick="sendModalCmasc(8,3,<? echo $idEnlace ?>, <? echo $mes; ?>, <? echo $anio; ?>)" placeholder="Hacer clic para agregar información" style="cursor: pointer; text-align: center; font-size: 1.5rem;" class="first" id=""   value="<? if($d[0][0] > 0 ){ echo $d[0][0]; }  ?>" readonly/>
               <span
               onclick="sendModalCmasc(8,3,<? echo $idEnlace ?>, <? echo $mes; ?>, <? echo $anio; ?>)">
               <div id=""><i class="fa fa-file-text fa-lg fa-fw"
                aria-hidden="true"></i></div>
               </span>
              </div>
             </div>
             <div class="col-xs-6">
              <label class="colorLetras" for="inputlg">Imputado :</label>
              <div class="iconiput">
               <input type="number" onclick="sendModalCmasc(9,3,<? echo $idEnlace ?>, <? echo $mes; ?>, <? echo $anio; ?>)" placeholder="Hacer clic para agregar información" style="cursor: pointer; text-align: center; font-size: 1.5rem;" class="first"
               onblur="sumTotRecibidas()" id="atOrdi"
               value="<? if($e[0][0] > 0 ){ echo $e[0][0]; }  ?>" readonly/>
               <span  onclick="sendModalCmasc(9,3,<? echo $idEnlace ?>, <? echo $mes; ?>, <? echo $anio; ?>)">
                <div id=""><i class="fa fa-file-text fa-lg fa-fw"
                 aria-hidden="true"></i></div>
                </span>
               </div>
              </div>

             </div>
            </div>
           </div>
          </div>




         </div>
         <div class="row">

          <div class="col-xs-6">
           <div class="panel panel-default fd1" style="">
            <div class="panel-body">
             <h5 class="text-on-pannel"><strong> Cuando el Facilitador identifica la no
             solución </strong></h5>
             <div class="iconiput">
              <input type="number" onclick="sendModalCmasc(4,3,<? echo $idEnlace ?>, <? echo $mes; ?>, <? echo $anio; ?>)" placeholder="Hacer clic para agregar información" style="cursor: pointer; text-align: center; font-size: 1.5rem;" class="first" id=""  value="<? if($f[0][0] > 0 ){ echo $f[0][0]; }  ?>" />
              <span onclick="sendModalCmasc(4,3,<? echo $idEnlace ?>, <? echo $mes; ?>, <? echo $anio; ?>)">
               <div id=""><i class="fa fa-file-text fa-lg fa-fw"
                aria-hidden="true"></i></div>
               </span>
              </div>
             </div>
            </div>
           </div>

           <div class="col-xs-6">
            <div class="panel panel-default fd1" style="">
             <div class="panel-body">
              <h5 class="text-on-pannel"><strong> Comportamiento irrespetuoso de los
              intervenientes </strong></h5>
              <div class="iconiput">
               <input type="number" onclick="sendModalCmasc(10,3,<? echo $idEnlace ?>, <? echo $mes; ?>, <? echo $anio; ?>)" placeholder="Hacer clic para agregar información" style="cursor: pointer; text-align: center; font-size: 1.5rem;" class="first" id="" value="<? if($g[0][0] > 0 ){ echo $g[0][0]; }  ?>" />
               <span onclick="sendModalCmasc(10,3,<? echo $idEnlace ?>, <? echo $mes; ?>, <? echo $anio; ?>)">
                <div id=""><i class="fa fa-file-text fa-lg fa-fw"
                 aria-hidden="true"></i></div>
                </span>
               </div>
              </div>
             </div>
            </div>

           </div>

           <div class="row">

            <div class="col-xs-6">
             <div class="panel panel-default fd1" style="">
              <div class="panel-body">
               <h5 class="text-on-pannel"><strong> Por incumplimiento del Acuerdo entre
               intervinientes </strong></h5>
               <div class="iconiput">
                <input type="number" onclick="sendModalCmasc(5,3,<? echo $idEnlace ?>, <? echo $mes; ?>, <? echo $anio; ?>)" placeholder="Hacer clic para agregar información" style="cursor: pointer; text-align: center; font-size: 1.5rem;" class="first" id=""   value="<? if($h[0][0] > 0 ){ echo $h[0][0]; }  ?>" readonly/>
                <span onclick="sendModalCmasc(5,3,<? echo $idEnlace ?>, <? echo $mes; ?>, <? echo $anio; ?>)">
                 <div id=""><i class="fa fa-file-text fa-lg fa-fw"
                  aria-hidden="true"></i></div>
                 </span>
                </div>
               </div>
              </div>
             </div>

             <div class="col-xs-6">
              <div class="panel panel-default fd1" style="">
               <div class="panel-body">
                <h5 class="text-on-pannel"><strong> Por decisión de las partes </strong></h5>
                <div class="iconiput">
                 <input type="number" onclick="sendModalCmasc(11,3,<? echo $idEnlace ?>, <? echo $mes; ?>, <? echo $anio; ?>)" placeholder="Hacer clic para agregar información"  style="cursor: pointer; text-align: center; font-size: 1.5rem;" class="first" id="atOrdi" value="<? if($i[0][0] > 0 ){ echo $i[0][0]; }  ?>" readonly/>
                 <span onclick="sendModalCmasc(11,3,<? echo $idEnlace ?>, <? echo $mes; ?>, <? echo $anio; ?>)">
                  <div id=""><i class="fa fa-file-text fa-lg fa-fw"
                   aria-hidden="true"></i></div>
                  </span>
                 </div>
                </div>
               </div>
              </div>



             </div>

             <div class="row">

              <div class="col-xs-12">
               <div class="panel panel-default fd1" style="">
                <div class="panel-body">
                 <h5 class="text-on-pannel"><strong> No aceptación del convenio </strong></h5>
                 <div class="row">

                  <div class="col-xs-6">
                   <label class="colorLetras" for="inputlg">Victima / Ofendido :</label>
                   <div class="iconiput">
                    <input type="number" onclick="sendModalCmasc(6,3,<? echo $idEnlace ?>, <? echo $mes; ?>, <? echo $anio; ?>)" placeholder="Hacer clic para agregar información" style="cursor: pointer; text-align: center; font-size: 1.5rem;" class="first" id="atOrdi" value="<? if($j[0][0] > 0 ){ echo $j[0][0]; }  ?>" readonly/>
                    <span onclick="sendModalCmasc(6,3,<? echo $idEnlace ?>, <? echo $mes; ?>, <? echo $anio; ?>)">
                     <div id=""><i class="fa fa-file-text fa-lg fa-fw"
                      aria-hidden="true"></i></div>
                     </span>
                    </div>
                   </div>
                   <div class="col-xs-6">
                    <label class="colorLetras" for="inputlg">Imputado :</label>
                    <div class="iconiput">
                     <input type="number" onclick="sendModalCmasc(12,3,<? echo $idEnlace ?>, <? echo $mes; ?>, <? echo $anio; ?>)" placeholder="Hacer clic para agregar información" style="cursor: pointer; text-align: center; font-size: 1.5rem;"  class="first" id="" value="<? if($k[0][0] > 0 ){ echo $k[0][0]; }  ?>" readonly/>
                     <span onclick="sendModalCmasc(12,3,<? echo $idEnlace ?>, <? echo $mes; ?>, <? echo $anio; ?>)">
                      <div id=""><i class="fa fa-file-text fa-lg fa-fw"
                       aria-hidden="true"></i></div>
                      </span>
                     </div>
                    </div>
                   </div>
                  </div>
                 </div>
                </div>

               </div>

               <div class="row">

                <div class="col-xs-12">
                 <div class="panel panel-default fd1" style="">
                  <div class="panel-body">
                   <h5 class="text-on-pannel"><strong> Por negativa de las partes a acordar </strong></h5>
                   <div class="row">

                    <div class="col-xs-6">
                     <label class="colorLetras" for="inputlg">Victima / Ofendido :</label>
                     <div class="iconiput">
                      <input type="number" onclick="sendModalCmasc(7,3,<? echo $idEnlace ?>, <? echo $mes; ?>, <? echo $anio; ?>)" placeholder="Hacer clic para agregar información" style="cursor: pointer; text-align: center; font-size: 1.5rem;" class="first" id="" value="<? if($l[0][0] > 0 ){ echo $l[0][0]; }  ?>" readonly/>
                      <span onclick="sendModalCmasc(7,3,<? echo $idEnlace ?>, <? echo $mes; ?>, <? echo $anio; ?>)">
                       <div id=""><i class="fa fa-file-text fa-lg fa-fw"
                        aria-hidden="true"></i></div>
                       </span>
                      </div>
                     </div>
                     <div class="col-xs-6">
                      <label class="colorLetras" for="inputlg">Imputado :</label>
                      <div class="iconiput">
                       <input type="number" onclick="sendModalCmasc(13,3,<? echo $idEnlace ?>, <? echo $mes; ?>, <? echo $anio; ?>)" placeholder="Hacer clic para agregar información" style="cursor: pointer; text-align: center; font-size: 1.5rem;" class="first" id="" value="<? if($m[0][0] > 0 ){ echo $m[0][0]; }  ?>" readonly/>
                       <span onclick="sendModalCmasc(13,3,<? echo $idEnlace ?>, <? echo $mes; ?>, <? echo $anio; ?>)">
                        <div id=""><i class="fa fa-file-text fa-lg fa-fw"
                         aria-hidden="true"></i></div>
                        </span>
                       </div>
                      </div>
                     </div>
                    </div>
                   </div>
                  </div>

               </div>


              </div>
             </div>
            </div>

           </div>

            <!-- AQUI  ETERMINAL CODIGO PARA AGREGAR LA PRIMER ESTAÑA ( RECI BIDAS POR OTRA UNIDAD ) -->

           </div>