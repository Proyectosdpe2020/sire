<?
include ("../../../Conexiones/Conexion.php");
include ("../../../Conexiones/conexionSicap.php");
include("../../../funcioneTrimes.php");
include("../../../funciones.php");

if (isset($_GET["per"])){ $per = $_GET["per"]; }
if (isset($_GET["anio"])){ $anio = $_GET["anio"]; }
if (isset($_GET["idUnidad"])){ $idUnidad = $_GET["idUnidad"]; }
if (isset($_GET["idEnlace"])){ $idEnlace = $_GET["idEnlace"]; }


if ($per == 1) {
    $m1 = "Enero";
    $mes1 = 1;
    $m2 = "Febrero";
    $mes2 = 2;
    $m3 = "Marzo";
    $mes3 = 3;
    $nme = "Enero - Marzo";
    $arr = array(1,2,3); $per1 = "IN(1,2,3)";
}
if ($per == 2) {
    $mes1 = 4;
    $m1 = "Abril";
    $mes2 = 5;
    $m2 = "Mayo";
    $mes3 = 6;
    $m3 = "Junio";
    $nme = "Abril - Junio";
    $arr = array(4,5,6); $per1 = "IN(4,5,6)";
}
if ($per == 3) {
    $mes1 = 7;
    $m1 = "Julio";
    $mes2 = 8;
    $m2 = "Agosto";
    $mes3 = 9;
    $m3 = "Septiembre";
    $nme = "Julio - Septiembre";
    $arr = array(7,8,9); $per1 = "IN(7,8,9)";
}
if ($per == 4) {
    $mes1 = 10;
    $m1 = "Octubre";
    $mes2 = 11;
    $m2 = "Noviembre";
    $mes3 = 12;
    $m3 = "Diciembre";
    $nme = "Octubre - Diciembre";
    $arr = array(10,11,12); $per1 = "IN(10,11,12)";
}



$Cdata = getDAtaQuestion($conn, 34, $per, $anio, $idUnidad);
$Cdata2 = getDAtaQuestion($conn, 35, $per, $anio, $idUnidad);
$Cdata3 = getDAtaQuestion($conn, 36, $per, $anio, $idUnidad);
$Cdata4 = getDAtaQuestion($conn, 37, $per, $anio, $idUnidad);
$Cdata5 = getDAtaQuestion($conn, 38, $per, $anio, $idUnidad);
$Cdata6 = getDAtaQuestion($conn, 39, $per, $anio, $idUnidad);
$Cdata7 = getDAtaQuestion($conn, 40, $per, $anio, $idUnidad);
$Cdata8 = getDAtaQuestion($conn, 41, $per, $anio, $idUnidad);
$Cdata9 = getDAtaQuestion($conn, 42, $per, $anio, $idUnidad);
$Cdata10 = getDAtaQuestion($conn, 43, $per, $anio, $idUnidad);
$Cdata11 = getDAtaQuestion($conn, 44, $per, $anio, $idUnidad);
$Cdata12 = getDAtaQuestion($conn, 45, $per, $anio, $idUnidad);
$Cdata13 = getDAtaQuestion($conn, 46, $per, $anio, $idUnidad);
$Cdata14 = getDAtaQuestion($conn, 47, $per, $anio, $idUnidad);
$getEnv = getInfOCarpetasEnv($conn, $idEnlace, 11);
$envt = $getEnv[0][0];


$fisid = getIdFiscaliaEnlace($conn, $idEnlace);

if($fisid[0][0]  == 4){
    $idUn = "IN(".$idUnidad.")";
}else{
    if($fisid[0][0] == 5){
        if($idUnidad != 1031) {
            $idUn = "IN(159,150,151,53,54,55,56,57,58,59,60,61)";
        }else{
            $idUn = "IN(".$idUnidad.")";
        }
    }
    if($fisid[0][0] == 1){
        $idUn = "IN(158,100,101,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,92)";
    }
    if($fisid[0][0] == 2){
        $idUn = "IN(153,154,161,16,17,18,19,20,21,22,23,24,25,26)";
    }
    if($fisid[0][0] == 3){
        $idUn = "IN(157,93,102,103,27,28,29,30,31,32)";
    }
    if($fisid[0][0] == 6){
        if($idUnidad != 1052) {
            $idUn = "IN(152,164,1005,1006,62,63,64,65,66,67,68,69,70,1050,1054)";
        }else{
            $idUn = "IN(".$idUnidad.")";
        }
    }
    if($fisid[0][0] == 7){
        $idUn = "IN(94,95,96,97,98,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,91)";
    }
    if($fisid[0][0] == 8){
        $idUn = "IN(111,112,113,114,115,163,1008,1009,1010,108,109,110)";
    }
    if($fisid[0][0] == 9){
        $idUn = "IN(120,121,122,123,124,125,160)";
    }
    if($fisid[0][0] == 10){
        $idUn = "IN(116,117,118,119,162)";
    }
}
$dataEnlaces = getDataEnlacesByIdUnidad($conn, $idUn, $idEnlace);
?>

<h5 class="card-title tituloPregunta">Pregunta 8: Procedimientos y Estatus <?php echo "$anio";?></h5><br>
<div class="textoPregunta" >
    <ul>
        <li style="list-style-type: circle !important">
            <strong>¿Cuántos procedimientos</strong> se han generado de las vinculaciones a proceso derivadas de las carpetas de investigación iniciadas en el año <?php echo "$anio";?> y en qué estatus se encuentran dentro de los rubros señalados, conforme los registros de la Fiscalía General de la entidad federativa en los cortes referidos?
        </li>
    </ul>
</div><br><hr><br>
<div class="scroll-container">
<table class="tableTrimes">
    <thead>
    <tr>
        <th scope="col">No.</th>
        <th scope="col">Estatus de las Vinculaciones a Proceso derivadas de las CII en <?php echo "$anio";?></th>
        <th scope="col">2017</th>
        <th scope="col">2018</th>
        <th scope="col">2019</th>
        <th scope="col">2020</th>
        <th scope="col">2021</th>
        <th scope="col">2022</th>
        <th scope="col">2023</th>
        <th scope="col">2024</th>
        <th scope="col">Años Anteriores</th>
        <th scope="col"><? echo $m1; ?></th>
        <th scope="col"><? echo $m2; ?></th>
        <th scope="col"><? echo $m3; ?></th>
        <th scope="col" style="background-color: #C09F77;">Total</th>
    </tr>
    </thead>
    <tbody>
    <?

    $dataQuestAn34 = getDataAnteriores($conn, 34, $idEnlace, $idUnidad, $anio, $per);
    $dataQuestAn35 = getDataAnteriores($conn, 35, $idEnlace, $idUnidad, $anio, $per);
    $dataQuestAn36 = getDataAnteriores($conn, 36, $idEnlace, $idUnidad, $anio, $per);
    $dataQuestAn37 = getDataAnteriores($conn, 37, $idEnlace, $idUnidad, $anio, $per);
    $dataQuestAn38 = getDataAnteriores($conn, 38, $idEnlace, $idUnidad, $anio, $per);
    $dataQuestAn39 = getDataAnteriores($conn, 39, $idEnlace, $idUnidad, $anio, $per);
    $dataQuestAn40 = getDataAnteriores($conn, 40, $idEnlace, $idUnidad, $anio, $per);
    $dataQuestAn41 = getDataAnteriores($conn, 41, $idEnlace, $idUnidad, $anio, $per);
    $dataQuestAn42 = getDataAnteriores($conn, 42, $idEnlace, $idUnidad, $anio, $per);
    $dataQuestAn43 = getDataAnteriores($conn, 43, $idEnlace, $idUnidad, $anio, $per);
    $dataQuestAn44 = getDataAnteriores($conn, 44, $idEnlace, $idUnidad, $anio, $per);
    $dataQuestAn45 = getDataAnteriores($conn, 45, $idEnlace, $idUnidad, $anio, $per);
    $dataQuestAn46 = getDataAnteriores($conn, 46, $idEnlace, $idUnidad, $anio, $per);
    $dataQuestAn47 = getDataAnteriores($conn, 47, $idEnlace, $idUnidad, $anio, $per);

    $d10 = getArrayCounts($conn, 34, $idEnlace, $idUnidad, $per, 0);
    $d11 = getArrayCounts($conn, 36, $idEnlace, $idUnidad, $per, 0);
    $d12 = getArrayCounts($conn, 38, $idEnlace, $idUnidad, $per, 0);
    $d13 = getArrayCounts($conn, 39, $idEnlace, $idUnidad, $per, 0);
    $d14 = getArrayCounts($conn, 41, $idEnlace, $idUnidad, $per, 0);
    $d15 = getArrayCounts($conn, 42, $idEnlace, $idUnidad, $per, 0);

    $d101 = getCountNucsTrim($conn, $anio, 34, $idEnlace, $idUnidad, $per, $mes1);
    $d102 = getCountNucsTrim($conn, $anio, 34, $idEnlace, $idUnidad, $per, $mes2);
    $d103 = getCountNucsTrim($conn, $anio, 34, $idEnlace, $idUnidad, $per, $mes3);
    $totd10 = $d101[0][0] + $d102[0][0] + $d103[0][0];

    $d111 = getCountNucsTrim($conn, $anio, 36, $idEnlace, $idUnidad, $per, $mes1);
    $d112 = getCountNucsTrim($conn, $anio, 36, $idEnlace, $idUnidad, $per, $mes2);
    $d113 = getCountNucsTrim($conn, $anio, 36, $idEnlace, $idUnidad, $per, $mes3);
    $totd11 = $d111[0][0] + $d112[0][0] + $d113[0][0];

    $d121 = getCountNucsTrim($conn, $anio, 38, $idEnlace, $idUnidad, $per, $mes1);
    $d122 = getCountNucsTrim($conn, $anio, 38, $idEnlace, $idUnidad, $per, $mes2);
    $d123 = getCountNucsTrim($conn, $anio, 38, $idEnlace, $idUnidad, $per, $mes3);
    $totd20 = $d121[0][0] + $d122[0][0] + $d123[0][0];

    $d131 = getCountNucsTrim($conn, $anio, 39, $idEnlace, $idUnidad, $per, $mes1);
    $d132 = getCountNucsTrim($conn, $anio, 39, $idEnlace, $idUnidad, $per, $mes2);
    $d133 = getCountNucsTrim($conn, $anio, 39, $idEnlace, $idUnidad, $per, $mes3);
    $totd31 = $d131[0][0] + $d132[0][0] + $d133[0][0];

    $d141 = getCountNucsTrim($conn, $anio, 41, $idEnlace, $idUnidad, $per, $mes1);
    $d142 = getCountNucsTrim($conn, $anio, 41, $idEnlace, $idUnidad, $per, $mes2);
    $d143 = getCountNucsTrim($conn, $anio, 41, $idEnlace, $idUnidad, $per, $mes3);
    $totd40 = $d141[0][0] + $d142[0][0] + $d143[0][0];

    $d151 = getCountNucsTrim($conn, $anio, 42, $idEnlace, $idUnidad, $per, $mes1);
    $d152 = getCountNucsTrim($conn, $anio, 42, $idEnlace, $idUnidad, $per, $mes2);
    $d153 = getCountNucsTrim($conn, $anio, 42, $idEnlace, $idUnidad, $per, $mes3);
    $totd51 = $d151[0][0] + $d152[0][0] + $d153[0][0];



    ?>
    <tr>
        <th scope="row">8.1</th>
        <input style="display: none !important;" type="number" value="0" id="p34m1">
        <input style="display: none !important;" type="number" value="0" id="p34m2">
        <input style="display: none !important;" type="number" value="0" id="p34m3">
        <td style="text-align: left;">En tramite ante el Juez de Control (sin incluir los que se encuentran en trámite por suspensión condicional, por acuerdos reparatorios o por procedimiento abreviado)</td>
        <td class="cPo" onclick="loaNucTrimeShow(0,2017, <? echo $per; ?>, 34, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d10[0]; ?><input type="hidden" value="<? echo $d10[0]; ?>" id="1val2017"></td>
        <td class="cPo" onclick="loaNucTrimeShow(0,2018, <? echo $per; ?>, 34, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d10[1]; ?><input type="hidden" value="<? echo $d10[1]; ?>" id="1val2018"></td>
        <td class="cPo" onclick="loaNucTrimeShow(0,2019, <? echo $per; ?>, 34, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d10[2]; ?><input type="hidden" value="<? echo $d10[2]; ?>" id="1val2019"></td>
        <td class="cPo" onclick="loaNucTrimeShow(0,2020, <? echo $per; ?>, 34, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d10[3]; ?><input type="hidden" value="<? echo $d10[3]; ?>" id="1val2020"></td>
        <td class="cPo" onclick="loaNucTrimeShow(0,2021, <? echo $per; ?>, 34, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d10[4]; ?><input type="hidden" value="<? echo $d10[4]; ?>" id="1val2021"></td>
        <td class="cPo" onclick="loaNucTrimeShow(0,2022, <? echo $per; ?>, 34, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d10[5]; ?><input type="hidden" value="<? echo $d10[5]; ?>" id="1val2022"></td>
        <td class="cPo" onclick="loaNucTrimeShow(0,2023, <? echo $per; ?>, 34, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d10[6]; ?><input type="hidden" value="<? echo $d10[6]; ?>" id="1val2023"></td>
        <td class="cPo" onclick="loaNucTrimeShow(0,2024, <? echo $per; ?>, 34, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d10[7]; ?><input type="hidden" value="<? echo $d10[7]; ?>" id="1val2024"></td>
        <td class="cPo" onclick="loaNucTrimes(0,0, <? echo $per; ?>, 34, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)">Capturar</td>

        <td class="cPo" onclick="loaNucTrimes(<? echo $mes1; ?>,<? echo $anio; ?>, <? echo $per; ?>, 34, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d101[0][0]; ?></td>
        <td class="cPo" onclick="loaNucTrimes(<? echo $mes2; ?>,<? echo $anio; ?>, <? echo $per; ?>, 34, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d102[0][0]; ?></td>
        <td class="cPo" onclick="loaNucTrimes(<? echo $mes3; ?>,<? echo $anio; ?>, <? echo $per; ?>, 34, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d103[0][0]; ?></td>
        <td class="blockInp"><input type="number" value="<? echo $totd10; ?>" id="p10tot" readonly></td>
    </tr>
    <tr>
        <th scope="row">8.2</th>
        <td style="text-align: left;">Determinado por criterio de oportunidad</td>
        <?
        $has_litigation = false;
        $has_captured = false;
        $validaEnlace = $idEnlace;
        $data_sended = false;
        $quest_class = "";
        $quest_value = "";
        $quest_readonly = "";

        if( $dataEnlaces[0][1] != 0){  //check if it has litigation
            $validaEnlace = $dataEnlaces[0][1];
            $has_litigation = true;
            if($idUn == 'IN(34)'){ $idUn = 'IN(167)'; }
            $idUn = 'IN('.$dataEnlaces[0][2].')'; //Para obtener unidad correcta de litigacion NUEVO***
        }
        else{
            $validaEnlace = $dataEnlaces[0][0];
            $has_litigation = false;
        }

        if($has_litigation && $idUnidad != 1001){ //write exclusions
            $quest_class =  "blockInp";
            $quest_readonly = "readonly";
        }
        else if($idUnidad == 1001){
            $quest_readonly = "";
        }
        ?>

        <?
        if($has_litigation){
            $data = getDAtaSIREQuestionEstatusLitiHistorico($conn , $anio, $idUn, 91, $per1, 2017);
            $quest_value = $data[0][0];
        }else{ $quest_value = $dataQuestAn35[0][0]; } ?>
        <td class="<?php echo $quest_class; ?>" >
            <input type="number" value="<? echo $quest_value; ?>" id="2val2017" <? echo $quest_readonly; ?> >
        </td>
        <?if($has_litigation){
            $data = getDAtaSIREQuestionEstatusLitiHistorico($conn , $anio, $idUn, 91, $per1, 2018);
            $quest_value = $data[0][0];
        }else{ $quest_value = $dataQuestAn35[0][1]; } ?>
        <td class="<?php echo $quest_class; ?>" >
            <input type="number" value="<? echo $quest_value; ?>" id="2val2018" <? echo $quest_readonly; ?> >
        </td>
        <?if($has_litigation){
            $data = getDAtaSIREQuestionEstatusLitiHistorico($conn , $anio, $idUn, 91, $per1, 2019);
            $quest_value = $data[0][0];
        }else{ $quest_value = $dataQuestAn35[0][2]; } ?>
        <td class="<?php echo $quest_class; ?>" >
            <input type="number" value="<? echo $quest_value; ?>" id="2val2019" <? echo $quest_readonly; ?> >
        </td>
        <?if($has_litigation){
            $data = getDAtaSIREQuestionEstatusLitiHistorico($conn , $anio, $idUn, 91, $per1, 2020);
            $quest_value = $data[0][0];
        }else{ $quest_value =  $dataQuestAn35[0][3]; } ?>
        <td class="<?php echo $quest_class; ?>" >
            <input type="number" value="<? echo $quest_value; ?>" id="2val2020" <? echo $quest_readonly; ?> >
        </td>
        <?	if($has_litigation){
            $data = getDAtaSIREQuestionEstatusLitiHistorico($conn , $anio, $idUn, 91, $per1, 2021);
            $quest_value = $data[0][0];
        }else{ 	$quest_value = $dataQuestAn35[0][4]; } ?>
        <td class="<?php echo $quest_class; ?>" >
            <input type="number" value="<? echo $quest_value; ?>" id="2val2021" <? echo $quest_readonly; ?> >
        </td>
        <?	if($has_litigation){
            $data = getDAtaSIREQuestionEstatusLitiHistorico($conn , $anio, $idUn, 91, $per1, 2022);
            $quest_value = $data[0][0];
        }else{ 	$quest_value = $dataQuestAn35[0][5]; } ?>
        <td class="<?php echo $quest_class; ?>" >
            <input type="number" value="<? echo $quest_value; ?>" id="2val2022" <? echo $quest_readonly; ?> >
        </td>
        <?	if($has_litigation){
            $data = getDAtaSIREQuestionEstatusLitiHistorico($conn , $anio, $idUn, 91, $per1, 2023);
            $quest_value = $data[0][0];
        }else{ 	$quest_value = $dataQuestAn35[0][6]; } ?>
        <td class="<?php echo $quest_class; ?>" >
            <input type="number" value="<? echo $quest_value; ?>" id="2val2023" <? echo $quest_readonly; ?> >
        </td>
        <?	if($has_litigation){
            $data = getDAtaSIREQuestionEstatusLitiHistorico($conn , $anio, $idUn, 91, $per1, 2024);
            $quest_value = $data[0][0];
        }else{ 	$quest_value = $dataQuestAn35[0][7]; } ?>
        <td class="<?php echo $quest_class; ?>" >
            <input type="number" value="<? echo $quest_value; ?>" id="2val2024" <? echo $quest_readonly; ?> >
        </td>
        <td class="blockInp">Capturar</td>
        <?
        $tota = 0; $tota1 = 0;

        $has_litigation = false;
        $has_captured = false;
        $validaEnlace = $idEnlace;
        $data_sended = false;

        if(!is_null($Cdata2)){ //check if the question has something
            $data = $Cdata2;
            $has_captured = true;
        }

        if( $dataEnlaces[0][1] != 0){  //check if it has litigation
            $validaEnlace = $dataEnlaces[0][1];
            $has_litigation = true;
        }
        else{
            $validaEnlace = $dataEnlaces[0][0];
            $has_litigation = false;
        }

        if(getDataEnlaceMesValidaEnviado($conn, $arr[2], $anio, $validaEnlace, 4) != 0){ //check if last month has sended
            $data_sended = true;
        }

        $quest_class = "";
        $quest_value = "";
        $quest_readonly = "";
        $tota = 0;

        if($has_litigation && $idUnidad != 1001){ //write exclusions
            $quest_class =  "blockInp";
            $quest_readonly = "readonly";
        }

        for ($o=0; $o < sizeof($arr) ; $o++) {

            if($has_captured){ //set value if has captured or not
                $quest_value =  $data[0][$o];
                $tota += $data[0][$o];
            }
            else{
                if($has_litigation){

                    $data = getDAtaSIREQuestionEstatusLiti($conn , $arr[$o] , $anio, $idUn, 91, $per1);

                    if($data_sended){ //all trimester sended
                        $quest_value = $data[0][0];
                        $tota += $data[0][0];
                    }
                    else if($o != 2){ //last month not sended
                        $quest_value = $data[0][0];
                        $tota += $data[0][0];
                    }
                    else{ //put blak if its the last month and has no data sended
                        $quest_value = "";
                    }

                }
            }

            $t1 = $tota;

            ?>
            <td class="<?php echo $quest_class; ?>">
                <input type="number" value="<?php echo $quest_value; ?>" id="p35m<? echo $o+1; ?>" <? echo $quest_readonly; ?> >
            </td>
            <?
        }
        ?>
        <td class="blockInp"><input type="number" value="<? echo $tota;  ?>" id="p35tot" readonly></td>
    </tr>
    <tr>
        <th scope="row">8.3</th>
        <input style="display: none !important;" type="number" value="0" id="p36m1">
        <input style="display: none !important;" type="number" value="0" id="p36m2">
        <input style="display: none !important;" type="number" value="0" id="p36m3">
        <td style="text-align: left;">En trámite por suspensión condicional del proceso aprobada por el Juez de Control (en proceso de cumplimiento)</td>
        <td class="cPo" onclick="loaNucTrimeShow(0,2017, <? echo $per; ?>, 36, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d11[0]; ?><input type="hidden" value="<? echo $d11[0]; ?>" id="3val2017"></td>
        <td class="cPo" onclick="loaNucTrimeShow(0,2018, <? echo $per; ?>, 36, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d11[1]; ?><input type="hidden" value="<? echo $d11[1]; ?>" id="3val2018"></td>
        <td class="cPo" onclick="loaNucTrimeShow(0,2019, <? echo $per; ?>, 36, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d11[2]; ?><input type="hidden" value="<? echo $d11[2]; ?>" id="3val2019"></td>
        <td class="cPo" onclick="loaNucTrimeShow(0,2020, <? echo $per; ?>, 36, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d11[3]; ?><input type="hidden" value="<? echo $d11[3]; ?>" id="3val2020"></td>
        <td class="cPo" onclick="loaNucTrimeShow(0,2021, <? echo $per; ?>, 36, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d11[4]; ?><input type="hidden" value="<? echo $d11[4]; ?>" id="3val2021"></td>
        <td class="cPo" onclick="loaNucTrimeShow(0,2022, <? echo $per; ?>, 36, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d11[5]; ?><input type="hidden" value="<? echo $d11[5]; ?>" id="3val2022"></td>
        <td class="cPo" onclick="loaNucTrimeShow(0,2023, <? echo $per; ?>, 36, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d11[6]; ?><input type="hidden" value="<? echo $d11[6]; ?>" id="3val2023"></td>
        <td class="cPo" onclick="loaNucTrimeShow(0,2024, <? echo $per; ?>, 36, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d11[7]; ?><input type="hidden" value="<? echo $d11[7]; ?>" id="3val2024"></td>

        <td class="cPo" onclick="loaNucTrimes(0,0, <? echo $per; ?>, 36, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)">Capturar</td>

        <td class="cPo" onclick="loaNucTrimes(<? echo $mes1; ?>,<? echo $anio; ?>, <? echo $per; ?>, 36, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d111[0][0]; ?></td>
        <td class="cPo" onclick="loaNucTrimes(<? echo $mes2; ?>,<? echo $anio; ?>, <? echo $per; ?>, 36, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d112[0][0]; ?></td>
        <td class="cPo" onclick="loaNucTrimes(<? echo $mes3; ?>,<? echo $anio; ?>, <? echo $per; ?>, 36, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d113[0][0]; ?></td>
        <td class="blockInp"><input type="number" value="<? echo $totd11; ?>" id="p10tot" readonly></td>
    </tr>
    <tr>
        <th scope="row">8.4</th>
        <td style="text-align: left;">Cumplida la suspensión condicional del proceso</td>
        <?
        $has_litigation = false;
        $has_captured = false;
        $validaEnlace = $idEnlace;
        $data_sended = false;
        $quest_class = "";
        $quest_value = "";
        $quest_readonly = "";

        if( $dataEnlaces[0][1] != 0){  //check if it has litigation
            $validaEnlace = $dataEnlaces[0][1];
            $has_litigation = true;
            if($idUn == 'IN(34)'){ $idUn = 'IN(167)'; }
            $idUn = 'IN('.$dataEnlaces[0][2].')'; //Para obtener unidad correcta de litigacion NUEVO***
        }
        else{
            $validaEnlace = $dataEnlaces[0][0];
            $has_litigation = false;
        }

        if($has_litigation && $idUnidad != 1001){ //write exclusions
            $quest_class =  "blockInp";
            $quest_readonly = "readonly";
        }
        else if($idUnidad == 1001){
            $quest_readonly = "";
        }
        ?>

        <?
        if($has_litigation){
            $data = getDAtaSIREQuestionEstatusHitorico($conn , $anio, $idUn, 15, $per1, 2017);
            $quest_value = $data[0][0];
        }else{ $quest_value = $dataQuestAn37[0][0]; } ?>
        <td class="<?php echo $quest_class; ?>" >
            <input type="number" value="<? echo $quest_value; ?>" id="4val2017" <? echo $quest_readonly; ?> >
        </td>
        <?
        if($has_litigation){
            $data = getDAtaSIREQuestionEstatusHitorico($conn , $anio, $idUn, 15, $per1, 2018);
            $quest_value = $data[0][0];
        }else{ $quest_value = $dataQuestAn37[0][1]; }
        ?>
        <td class="<?php echo $quest_class; ?>" >
            <input type="number" value="<? echo $quest_value; ?>" id="4val2018" <? echo $quest_readonly; ?> >
        </td>
        <?if($has_litigation){
            $data = getDAtaSIREQuestionEstatusHitorico($conn , $anio, $idUn, 15, $per1, 2019);
            $quest_value = $data[0][0];
        }else{ $quest_value = $dataQuestAn37[0][2]; } ?>
        <td class="<?php echo $quest_class; ?>" >
            <input type="number" value="<? echo $quest_value; ?>" id="4val2019" <? echo $quest_readonly; ?> >
        </td>
        <?
        if($has_litigation){
            $data = getDAtaSIREQuestionEstatusHitorico($conn , $anio, $idUn, 15, $per1, 2020);
            $quest_value = $data[0][0];
        }else{ $quest_value = $dataQuestAn37[0][3]; }	?>
        <td class="<?php echo $quest_class; ?>" >
            <input type="number" value="<? echo $quest_value; ?>" id="4val2020" <? echo $quest_readonly; ?> >
        </td>
        <?if($has_litigation){
            $data = getDAtaSIREQuestionEstatusHitorico($conn , $anio, $idUn, 15, $per1, 2021);
            $quest_value = $data[0][0];
        }else{ $quest_value = $dataQuestAn37[0][4]; } ?>
        <td class="<?php echo $quest_class; ?>" >
            <input type="number" value="<? echo $quest_value; ?>" id="4val2021" <? echo $quest_readonly; ?> >
        </td>
        <?if($has_litigation){
            $data = getDAtaSIREQuestionEstatusHitorico($conn , $anio, $idUn, 15, $per1, 2022);
            $quest_value = $data[0][0];
        }else{ $quest_value = $dataQuestAn37[0][5]; } ?>
        <td class="<?php echo $quest_class; ?>" >
            <input type="number" value="<? echo $quest_value; ?>" id="4val2022" <? echo $quest_readonly; ?> >
        </td>
        <?if($has_litigation){
            $data = getDAtaSIREQuestionEstatusHitorico($conn , $anio, $idUn, 15, $per1, 2023);
            $quest_value = $data[0][0];
        }else{ $quest_value = $dataQuestAn37[0][6]; } ?>
        <td class="<?php echo $quest_class; ?>" >
            <input type="number" value="<? echo $quest_value; ?>" id="4val2023" <? echo $quest_readonly; ?> >
        </td>
        <?if($has_litigation){
            $data = getDAtaSIREQuestionEstatusHitorico($conn , $anio, $idUn, 15, $per1, 2024);
            $quest_value = $data[0][0];
        }else{ $quest_value = $dataQuestAn37[0][7]; } ?>
        <td class="<?php echo $quest_class; ?>" >
            <input type="number" value="<? echo $quest_value; ?>" id="4val2024" <? echo $quest_readonly; ?> >
        </td>
        <td class="blockInp">Capturar</td>
        <?
        $tota = 0; $tota1 = 0;

        $has_litigation = false;
        $has_captured = false;
        $validaEnlace = $idEnlace;
        $data_sended = false;

        if(!is_null($Cdata4)){ //check if the question has something
            $data = $Cdata4;
            $has_captured = true;
        }

        if( $dataEnlaces[0][1] != 0){  //check if it has litigation
            $validaEnlace = $dataEnlaces[0][1];
            $has_litigation = true;
        }
        else{
            $validaEnlace = $dataEnlaces[0][0];
            $has_litigation = false;
        }

        if(getDataEnlaceMesValidaEnviado($conn, $arr[2], $anio, $validaEnlace, 4) != 0){ //check if last month has sended
            $data_sended = true;
        }

        $quest_class = "";
        $quest_value = "";
        $quest_readonly = "";
        $tota = 0;

        if($has_litigation && $idUnidad != 1001){ //write exclusions
            $quest_class =  "blockInp";
            $quest_readonly = "readonly";
        }

        for ($o=0; $o < sizeof($arr) ; $o++) {

            if($has_captured){ //set value if has captured or not
                $quest_value =  $data[0][$o];
                $tota += $data[0][$o];
            }
            else{
                if($has_litigation){

                    $data = getDAtaSIREQuestionEstatus($conn , $arr[$o] , $anio, $idUn, 15, $per1);

                    if($data_sended){ //all trimester sended
                        $quest_value = $data[0][0];
                        $tota += $data[0][0];
                    }
                    else if($o != 2){ //last month not sended
                        $quest_value = $data[0][0];
                        $tota += $data[0][0];
                    }
                    else{ //put blak if its the last month and has no data sended
                        $quest_value = "";
                    }

                }
            }


            $t2 = $tota;

            ?>
            <td class="<?php echo $quest_class; ?>">
                <input type="number" value="<?php echo $quest_value; ?>" id="p37m<? echo $o+1; ?>" <? echo $quest_readonly; ?> >
            </td>
            <?
        }
        ?>
        <td class="blockInp"><input type="number" value="<? echo $tota;  ?>" id="p37tot" readonly></td>
    </tr>
    <tr>
        <th scope="row">8.5</th>
        <input style="display: none !important;" type="number" value="0" id="p38m1">
        <input style="display: none !important;" type="number" value="0" id="p38m2">
        <input style="display: none !important;" type="number" value="0" id="p38m3">
        <td style="text-align: left;">Resueltos por otras causas de sobreseimiento (sin incluir criterio de oportunidad ni los cumplidos por suspension condicional o por acuerdo reparatorio)</td>
        <td class="cPo" onclick="loaNucTrimeShow(0,2017, <? echo $per; ?>, 38, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d12[0]; ?><input type="hidden" value="<? echo $d12[0]; ?>" id="5val2017"></td>
        <td class="cPo" onclick="loaNucTrimeShow(0,2018, <? echo $per; ?>, 38, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d12[1]; ?><input type="hidden" value="<? echo $d12[1]; ?>" id="5val2018"></td>
        <td class="cPo" onclick="loaNucTrimeShow(0,2019, <? echo $per; ?>, 38, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d12[2]; ?><input type="hidden" value="<? echo $d12[2]; ?>" id="5val2019"></td>
        <td class="cPo" onclick="loaNucTrimeShow(0,2020, <? echo $per; ?>, 38, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d12[3]; ?><input type="hidden" value="<? echo $d12[3]; ?>" id="5val2020"></td>
        <td class="cPo" onclick="loaNucTrimeShow(0,2021, <? echo $per; ?>, 38, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d12[4]; ?><input type="hidden" value="<? echo $d12[4]; ?>" id="5val2021"></td>
        <td class="cPo" onclick="loaNucTrimeShow(0,2022, <? echo $per; ?>, 38, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d12[5]; ?><input type="hidden" value="<? echo $d12[5]; ?>" id="5val2022"></td>
        <td class="cPo" onclick="loaNucTrimeShow(0,2023, <? echo $per; ?>, 38, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d12[6]; ?><input type="hidden" value="<? echo $d12[6]; ?>" id="5val2023"></td>
        <td class="cPo" onclick="loaNucTrimeShow(0,2024, <? echo $per; ?>, 38, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d12[7]; ?><input type="hidden" value="<? echo $d12[7]; ?>" id="5val2024"></td>

        <td class="cPo" onclick="loaNucTrimes(0,0, <? echo $per; ?>, 38, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)">Capturar</td>

        <td class="cPo" onclick="loaNucTrimes(<? echo $mes1; ?>,<? echo $anio; ?>, <? echo $per; ?>, 38, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d121[0][0]; ?></td>
        <td class="cPo" onclick="loaNucTrimes(<? echo $mes2; ?>,<? echo $anio; ?>, <? echo $per; ?>, 38, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d122[0][0]; ?></td>
        <td class="cPo" onclick="loaNucTrimes(<? echo $mes3; ?>,<? echo $anio; ?>, <? echo $per; ?>, 38, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d123[0][0]; ?></td>
        <td class="blockInp"><input type="number" value="<? echo $totd20; ?>" id="p10tot" readonly></td>
    </tr>
    <tr>
        <th scope="row">8.6</th>
        <input style="display: none !important;" type="number" value="0" id="p39m1">
        <input style="display: none !important;" type="number" value="0" id="p39m2">
        <input style="display: none !important;" type="number" value="0" id="p39m3">
        <td style="text-align: left;">En tramite de procedimiento abreviado</td>
        <td class="cPo" onclick="loaNucTrimeShow(0,2017, <? echo $per; ?>, 39, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d13[0]; ?><input type="hidden" value="<? echo $d13[0]; ?>" id="6val2017"></td>
        <td class="cPo" onclick="loaNucTrimeShow(0,2018, <? echo $per; ?>, 39, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d13[1]; ?><input type="hidden" value="<? echo $d13[1]; ?>" id="6val2018"></td>
        <td class="cPo" onclick="loaNucTrimeShow(0,2019, <? echo $per; ?>, 39, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d13[2]; ?><input type="hidden" value="<? echo $d13[2]; ?>" id="6val2019"></td>
        <td class="cPo" onclick="loaNucTrimeShow(0,2020, <? echo $per; ?>, 39, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d13[3]; ?><input type="hidden" value="<? echo $d13[3]; ?>" id="6val2020"></td>
        <td class="cPo" onclick="loaNucTrimeShow(0,2021, <? echo $per; ?>, 39, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d13[4]; ?><input type="hidden" value="<? echo $d13[4]; ?>" id="6val2021"></td>
        <td class="cPo" onclick="loaNucTrimeShow(0,2022, <? echo $per; ?>, 39, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d13[5]; ?><input type="hidden" value="<? echo $d13[5]; ?>" id="6val2022"></td>
        <td class="cPo" onclick="loaNucTrimeShow(0,2023, <? echo $per; ?>, 39, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d13[6]; ?><input type="hidden" value="<? echo $d13[6]; ?>" id="6val2023"></td>
        <td class="cPo" onclick="loaNucTrimeShow(0,2024, <? echo $per; ?>, 39, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d13[7]; ?><input type="hidden" value="<? echo $d13[7]; ?>" id="6val2024"></td>


        <td class="cPo" onclick="loaNucTrimes(0,0, <? echo $per; ?>, 39, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)">Capturar</td>

        <td class="cPo" onclick="loaNucTrimes(<? echo $mes1; ?>,<? echo $anio; ?>, <? echo $per; ?>, 39, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d131[0][0]; ?></td>
        <td class="cPo" onclick="loaNucTrimes(<? echo $mes2; ?>,<? echo $anio; ?>, <? echo $per; ?>, 39, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d132[0][0]; ?></td>
        <td class="cPo" onclick="loaNucTrimes(<? echo $mes3; ?>,<? echo $anio; ?>, <? echo $per; ?>, 39, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d133[0][0]; ?></td>
        <td class="blockInp"><input type="number" value="<? echo $totd31; ?>" id="p10tot" readonly></td>
    </tr>
    <tr>
        <th scope="row">8.7</th>
        <td style="text-align: left;">Resueltos por procedimiento abreviado</td>
        <?
        $has_litigation = false;
        $has_captured = false;
        $validaEnlace = $idEnlace;
        $data_sended = false;
        $quest_class = "";
        $quest_value = "";
        $quest_readonly = "";

        if( $dataEnlaces[0][1] != 0){  //check if it has litigation
            $validaEnlace = $dataEnlaces[0][1];
            $has_litigation = true;
            if($idUn == 'IN(34)'){ $idUn = 'IN(167)'; }
            $idUn = 'IN('.$dataEnlaces[0][2].')'; //Para obtener unidad correcta de litigacion NUEVO***
        }
        else{
            $validaEnlace = $dataEnlaces[0][0];
            $has_litigation = false;
        }

        if($has_litigation && $idUnidad != 1001){ //write exclusions
            $quest_class =  "blockInp";
            $quest_readonly = "readonly";
        }
        else if($idUnidad == 1001){
            $quest_readonly = "";
        }
        ?>

        <?
        if($has_litigation){
            $data = getDAtaSIREQuestionEstatusLitiHistorico($conn , $anio, $idUn, 153, $per1, 2017);
            $quest_value = $data[0][0];
        }else{ 	$quest_value = $dataQuestAn40[0][0]; }
        ?>
        <td class="<?php echo $quest_class; ?>" >
            <input type="number" value="<? echo $quest_value ?>" id="7val2017" <? echo $quest_readonly; ?> >
        </td>
        <?
        if($has_litigation){
            $data = getDAtaSIREQuestionEstatusLitiHistorico($conn , $anio, $idUn, 153, $per1, 2018);
            $quest_value = $data[0][0];
        }else{ 	$quest_value = $dataQuestAn40[0][1]; } ?>
        <td class="<?php echo $quest_class; ?>" >
            <input type="number" value="<? echo $quest_value; ?>" id="7val2018" <? echo $quest_readonly; ?> >
        </td>
        <?if($has_litigation){
            $data = getDAtaSIREQuestionEstatusLitiHistorico($conn , $anio, $idUn, 153, $per1, 2019);
            $quest_value = $data[0][0];
        }else{ 	$quest_value = $dataQuestAn40[0][2]; } ?>
        <td class="<?php echo $quest_class; ?>" >
            <input type="number" value="<? echo $quest_value; ?>" id="7val2019" <? echo $quest_readonly; ?> >
        </td>
        <?if($has_litigation){
            $data = getDAtaSIREQuestionEstatusLitiHistorico($conn , $anio, $idUn, 153, $per1, 2020);
            $quest_value = $data[0][0];
        }else{ 	$quest_value = $dataQuestAn40[0][3]; } ?>
        <td class="<?php echo $quest_class; ?>" >
            <input type="number" value="<? echo $quest_value ?>" id="7val2020" <? echo $quest_readonly; ?> >
        </td>
        <?if($has_litigation){
            $data = getDAtaSIREQuestionEstatusLitiHistorico($conn , $anio, $idUn, 153, $per1, 2021);
            $quest_value = $data[0][0];
        }else{ 	$quest_value = $dataQuestAn40[0][4]; } ?>
        <td class="<?php echo $quest_class; ?>" >
            <input type="number" value="<? echo $quest_value; ?>" id="7val2021" <? echo $quest_readonly; ?> >
        </td>
        <?if($has_litigation){
            $data = getDAtaSIREQuestionEstatusLitiHistorico($conn , $anio, $idUn, 153, $per1, 2022);
            $quest_value = $data[0][0];
        }else{ 	$quest_value = $dataQuestAn40[0][5]; } ?>
        <td class="<?php echo $quest_class; ?>" >
            <input type="number" value="<? echo $quest_value; ?>" id="7val2022" <? echo $quest_readonly; ?> >
        </td>
        <?if($has_litigation){
            $data = getDAtaSIREQuestionEstatusLitiHistorico($conn , $anio, $idUn, 153, $per1, 2023);
            $quest_value = $data[0][0];
        }else{ 	$quest_value = $dataQuestAn40[0][6]; } ?>
        <td class="<?php echo $quest_class; ?>" >
            <input type="number" value="<? echo $quest_value; ?>" id="7val2023" <? echo $quest_readonly; ?> >
        </td>
        <?if($has_litigation){
            $data = getDAtaSIREQuestionEstatusLitiHistorico($conn , $anio, $idUn, 153, $per1, 2024);
            $quest_value = $data[0][0];
        }else{ 	$quest_value = $dataQuestAn40[0][7]; } ?>
        <td class="<?php echo $quest_class; ?>" >
            <input type="number" value="<? echo $quest_value; ?>" id="7val2024" <? echo $quest_readonly; ?> >
        </td>
        <td class="blockInp">Capturar</td>
        <?
        $tota = 0; $tota1 = 0;

        $has_litigation = false;
        $has_captured = false;
        $validaEnlace = $idEnlace;
        $data_sended = false;

        if(!is_null($Cdata7)){ //check if the question has something
            $data = $Cdata7;
            $has_captured = true;
        }

        if( $dataEnlaces[0][1] != 0){  //check if it has litigation
            $validaEnlace = $dataEnlaces[0][1];
            $has_litigation = true;
        }
        else{
            $validaEnlace = $dataEnlaces[0][0];
            $has_litigation = false;
        }

        if(getDataEnlaceMesValidaEnviado($conn, $arr[2], $anio, $validaEnlace, 4) != 0){ //check if last month has sended
            $data_sended = true;
        }

        $quest_class = "";
        $quest_value = "";
        $quest_readonly = "";
        $tota = 0;

        if($has_litigation && $idUnidad != 1001){ //write exclusions
            $quest_class =  "blockInp";
            $quest_readonly = "readonly";
        }

        for ($o=0; $o < sizeof($arr) ; $o++) {

            if($has_captured){ //set value if has captured or not
                $quest_value =  $data[0][$o];
                $tota += $data[0][$o];
            }
            else{
                if($has_litigation){

                    $data = getDAtaSIREQuestionEstatusLiti($conn , $arr[$o] , $anio, $idUn, 153, $per1);

                    if($data_sended){ //all trimester sended
                        $quest_value = $data[0][0];
                        $tota += $data[0][0];
                    }
                    else if($o != 2){ //last month not sended
                        $quest_value = $data[0][0];
                        $tota += $data[0][0];
                    }
                    else{ //put blak if its the last month and has no data sended
                        $quest_value = "";
                    }

                }
            }

            $t3 = $tota;

            $sumTotal = $Cdata[0][3] + $Cdata2[0][3] + $Cdata3[0][3] + $Cdata4[0][3] + $Cdata5[0][3] + $Cdata6[0][3] + $Cdata7[0][3] + $Cdata8[0][3] + $Cdata9[0][3] +
                $Cdata10[0][3] + $Cdata11[0][3] + $Cdata12[0][3] + $Cdata13[0][3] + $Cdata14[0][3] + $totd10+ $totd11+ $totd20+ $totd31+ $totd40+ $totd51;

            ?>
            <td class="<?php echo $quest_class; ?>">
                <input type="number" value="<?php echo $quest_value; ?>" id="p40m<? echo $o+1; ?>" <? echo $quest_readonly; ?> >
            </td>
            <?
        }
        ?>
        <td class="blockInp"><input type="number" value="<? echo $tota;  ?>" id="p40tot" readonly></td>
    </tr>
    <tr>
        <th scope="row">8.8</th>
        <input style="display: none !important;" type="number" value="0" id="p41m1">
        <input style="display: none !important;" type="number" value="0" id="p41m2">
        <input style="display: none !important;" type="number" value="0" id="p41m3">
        <td style="text-align: left;">En trámite ante el Tribunal de Enjuiciamiento (en juicio)</td>
        <td class="cPo" onclick="loaNucTrimeShow(0,2017, <? echo $per; ?>, 41, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d14[0]; ?><input type="hidden" value="<? echo $d14[0]; ?>" id="8val2017"></td>
        <td class="cPo" onclick="loaNucTrimeShow(0,2018, <? echo $per; ?>, 41, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d14[1]; ?><input type="hidden" value="<? echo $d14[1]; ?>" id="8val2018"></td>
        <td class="cPo" onclick="loaNucTrimeShow(0,2019, <? echo $per; ?>, 41, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d14[2]; ?><input type="hidden" value="<? echo $d14[2]; ?>" id="8val2019"></td>
        <td class="cPo" onclick="loaNucTrimeShow(0,2020, <? echo $per; ?>, 41, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d14[3]; ?><input type="hidden" value="<? echo $d14[3]; ?>" id="8val2020"></td>
        <td class="cPo" onclick="loaNucTrimeShow(0,2021, <? echo $per; ?>, 41, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d14[4]; ?><input type="hidden" value="<? echo $d14[4]; ?>" id="8val2021"></td>
        <td class="cPo" onclick="loaNucTrimeShow(0,2022, <? echo $per; ?>, 41, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d14[5]; ?><input type="hidden" value="<? echo $d14[5]; ?>" id="8val2022"></td>
        <td class="cPo" onclick="loaNucTrimeShow(0,2023, <? echo $per; ?>, 41, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d14[6]; ?><input type="hidden" value="<? echo $d14[6]; ?>" id="8val2023"></td>
        <td class="cPo" onclick="loaNucTrimeShow(0,2024, <? echo $per; ?>, 41, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d14[7]; ?><input type="hidden" value="<? echo $d14[7]; ?>" id="8val2024"></td>

        <td class="cPo" onclick="loaNucTrimes(0,0, <? echo $per; ?>, 41, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)">Capturar</td>

        <td class="cPo" onclick="loaNucTrimes(<? echo $mes1; ?>,<? echo $anio; ?>, <? echo $per; ?>, 41, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d141[0][0]; ?></td>
        <td class="cPo" onclick="loaNucTrimes(<? echo $mes2; ?>,<? echo $anio; ?>, <? echo $per; ?>, 41, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d142[0][0]; ?></td>
        <td class="cPo" onclick="loaNucTrimes(<? echo $mes3; ?>,<? echo $anio; ?>, <? echo $per; ?>, 41, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d143[0][0]; ?></td>
        <td class="blockInp"><input type="number" value="<? echo $totd40; ?>" id="p10tot" readonly></td>
    </tr>
    <tr>
        <th scope="row">8.9</th>
        <input style="display: none !important;" type="number" value="0" id="p42m1">
        <input style="display: none !important;" type="number" value="0" id="p42m2">
        <input style="display: none !important;" type="number" value="0" id="p42m3">
        <td style="text-align: left;">Resueltos por juicio oral</td>
        <td class="cPo" onclick="loaNucTrimeShow(0,2017, <? echo $per; ?>, 42, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d15[0]; ?><input type="hidden" value="<? echo $d15[0]; ?>" id="9val2017"></td>
        <td class="cPo" onclick="loaNucTrimeShow(0,2018, <? echo $per; ?>, 42, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d15[1]; ?><input type="hidden" value="<? echo $d15[1]; ?>" id="9val2018"></td>
        <td class="cPo" onclick="loaNucTrimeShow(0,2019, <? echo $per; ?>, 42, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d15[2]; ?><input type="hidden" value="<? echo $d15[2]; ?>" id="9val2019"></td>
        <td class="cPo" onclick="loaNucTrimeShow(0,2020, <? echo $per; ?>, 42, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d15[3]; ?><input type="hidden" value="<? echo $d15[3]; ?>" id="9val2020"></td>
        <td class="cPo" onclick="loaNucTrimeShow(0,2021, <? echo $per; ?>, 42, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d15[4]; ?><input type="hidden" value="<? echo $d15[4]; ?>" id="9val2021"></td>
        <td class="cPo" onclick="loaNucTrimeShow(0,2022, <? echo $per; ?>, 42, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d15[5]; ?><input type="hidden" value="<? echo $d15[5]; ?>" id="9val2022"></td>
        <td class="cPo" onclick="loaNucTrimeShow(0,2023, <? echo $per; ?>, 42, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d15[6]; ?><input type="hidden" value="<? echo $d15[6]; ?>" id="9val2023"></td>
        <td class="cPo" onclick="loaNucTrimeShow(0,2024, <? echo $per; ?>, 42, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d15[7]; ?><input type="hidden" value="<? echo $d15[7]; ?>" id="9val2024"></td>

        <td class="cPo" onclick="loaNucTrimes(0,0, <? echo $per; ?>, 42, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)">Capturar</td>

        <td class="cPo" onclick="loaNucTrimes(<? echo $mes1; ?>,<? echo $anio; ?>, <? echo $per; ?>, 42, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d151[0][0]; ?></td>
        <td class="cPo" onclick="loaNucTrimes(<? echo $mes2; ?>,<? echo $anio; ?>, <? echo $per; ?>, 42, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d152[0][0]; ?></td>
        <td class="cPo" onclick="loaNucTrimes(<? echo $mes3; ?>,<? echo $anio; ?>, <? echo $per; ?>, 42, <? echo $idEnlace; ?>, <? echo $idUnidad ?>, <? echo $anio; ?>)"><? echo $d153[0][0]; ?></td>
        <td class="blockInp"><input type="number" value="<? echo $totd51; ?>" id="p10tot" readonly></td>
    </tr>
    <tr>
        <td colspan="14" style="background-color: #7C8B9E; font-size: 20px;"><strong>DERIVADOS A MECANISMOS ALTERNATIVOS (DESPUES DE LA VINCULACIÓN A PROCESO)</strong></td>
    </tr>
    <tr>
        <th scope="row">8.10</th>
        <td style="text-align: left;">En trámite en el OEMASC sin acuerdo reparatorio</td>
        <td><input type="number" value="<? echo $dataQuestAn43[0][0]; ?>" id="10val2017"></td>
        <td><input type="number" value="<? echo $dataQuestAn43[0][1]; ?>" id="10val2018"></td>
        <td><input type="number" value="<? echo $dataQuestAn43[0][2]; ?>" id="10val2019"></td>
        <td><input type="number" value="<? echo $dataQuestAn43[0][3]; ?>" id="10val2020"></td>
        <td><input type="number" value="<? echo $dataQuestAn43[0][4]; ?>" id="10val2021"></td>
        <td><input type="number" value="<? echo $dataQuestAn43[0][5]; ?>" id="10val2022"></td>
        <td><input type="number" value="<? echo $dataQuestAn43[0][6]; ?>" id="10val2023"></td>
        <td><input type="number" value="<? echo $dataQuestAn43[0][7]; ?>" id="10val2024"></td>
        <td class="blockInp">Capturar</td>
        <td><input type="number" value="<? echo $Cdata10[0][0]; ?>" id="p43m1" <? if($envt == 1){ echo "readonly"; } ?>></td>
        <td><input type="number" value="<? echo $Cdata10[0][1]; ?>" id="p43m2" <? if($envt == 1){ echo "readonly"; } ?>></td>
        <td><input type="number" value="<? echo $Cdata10[0][2]; ?>" id="p43m3" <? if($envt == 1){ echo "readonly"; } ?>></td>
        <td class="blockInp"><input type="number" value="<? echo $Cdata10[0][3]; ?>" id="p43tot" readonly></td>
    </tr>
    <tr>
        <th scope="row">8.11</th>
        <td style="text-align: left;">En trámite en el OEMASC con acuerdo reparatorio firmado (en proceso de cumplimiento)</td>
        <td><input type="number" value="<? echo $dataQuestAn44[0][0]; ?>" id="11val2017"></td>
        <td><input type="number" value="<? echo $dataQuestAn44[0][1]; ?>" id="11val2018"></td>
        <td><input type="number" value="<? echo $dataQuestAn44[0][2]; ?>" id="11val2019"></td>
        <td><input type="number" value="<? echo $dataQuestAn44[0][3]; ?>" id="11val2020"></td>
        <td><input type="number" value="<? echo $dataQuestAn44[0][4]; ?>" id="11val2021"></td>
        <td><input type="number" value="<? echo $dataQuestAn44[0][5]; ?>" id="11val2022"></td>
        <td><input type="number" value="<? echo $dataQuestAn44[0][6]; ?>" id="11val2023"></td>
        <td><input type="number" value="<? echo $dataQuestAn44[0][7]; ?>" id="11val2024"></td>
        <td class="blockInp">Capturar</td>
        <td><input type="number" value="<? echo $Cdata11[0][0]; ?>" id="p44m1" <? if($envt == 1){ echo "readonly"; } ?>></td>
        <td><input type="number" value="<? echo $Cdata11[0][1]; ?>" id="p44m2" <? if($envt == 1){ echo "readonly"; } ?>></td>
        <td><input type="number" value="<? echo $Cdata11[0][2]; ?>" id="p44m3" <? if($envt == 1){ echo "readonly"; } ?>></td>
        <td class="blockInp"><input type="number" value="<? echo $Cdata11[0][3]; ?>" id="p44tot" readonly></td>
    </tr>
    <tr>
        <th scope="row">8.12</th>
        <td style="text-align: left;">Resueltos (cumplidos) en OEMASC por mediación</td>
        <td><input type="number" value="<? echo $dataQuestAn45[0][0]; ?>" id="12val2017"></td>
        <td><input type="number" value="<? echo $dataQuestAn45[0][1]; ?>" id="12val2018"></td>
        <td><input type="number" value="<? echo $dataQuestAn45[0][2]; ?>" id="12val2019"></td>
        <td><input type="number" value="<? echo $dataQuestAn45[0][3]; ?>" id="12val2020"></td>
        <td><input type="number" value="<? echo $dataQuestAn45[0][4]; ?>" id="12val2021"></td>
        <td><input type="number" value="<? echo $dataQuestAn45[0][5]; ?>" id="12val2022"></td>
        <td><input type="number" value="<? echo $dataQuestAn45[0][6]; ?>" id="12val2023"></td>
        <td><input type="number" value="<? echo $dataQuestAn45[0][7]; ?>" id="12val2024"></td>
        <td class="blockInp">Capturar</td>
        <td><input type="number" value="<? echo $Cdata12[0][0]; ?>" id="p45m1" <? if($envt == 1){ echo "readonly"; } ?>></td>
        <td><input type="number" value="<? echo $Cdata12[0][1]; ?>" id="p45m2" <? if($envt == 1){ echo "readonly"; } ?>></td>
        <td><input type="number" value="<? echo $Cdata12[0][2]; ?>" id="p45m3" <? if($envt == 1){ echo "readonly"; } ?>></td>
        <td class="blockInp"><input type="number" value="<? echo $Cdata12[0][3]; ?>" id="p45tot" readonly></td>
    </tr>
    <tr>
        <th scope="row">8.13</th>
        <td style="text-align: left;">Resueltos (cumplidos) en OEMASC por conciliación</td>
        <td><input type="number" value="<? echo $dataQuestAn46[0][0]; ?>" id="13val2017"></td>
        <td><input type="number" value="<? echo $dataQuestAn46[0][1]; ?>" id="13val2018"></td>
        <td><input type="number" value="<? echo $dataQuestAn46[0][2]; ?>" id="13val2019"></td>
        <td><input type="number" value="<? echo $dataQuestAn46[0][3]; ?>" id="13val2020"></td>
        <td><input type="number" value="<? echo $dataQuestAn46[0][4]; ?>" id="13val2021"></td>
        <td><input type="number" value="<? echo $dataQuestAn46[0][5]; ?>" id="13val2022"></td>
        <td><input type="number" value="<? echo $dataQuestAn46[0][6]; ?>" id="13val2023"></td>
        <td><input type="number" value="<? echo $dataQuestAn46[0][7]; ?>" id="13val2024"></td>
        <td class="blockInp">Capturar</td>
        <td><input type="number" value="<? echo $Cdata13[0][0]; ?>" id="p46m1" <? if($envt == 1){ echo "readonly"; } ?>></td>
        <td><input type="number" value="<? echo $Cdata13[0][1]; ?>" id="p46m2" <? if($envt == 1){ echo "readonly"; } ?>></td>
        <td><input type="number" value="<? echo $Cdata13[0][2]; ?>" id="p46m3" <? if($envt == 1){ echo "readonly"; } ?>></td>
        <td class="blockInp"><input type="number" value="<? echo $Cdata13[0][3]; ?>" id="p46tot" readonly></td>
    </tr>
    <tr>
        <th scope="row">8.14</th>
        <td style="text-align: left;">Resueltos (cumplidos) en el OEMASC por acuerdo reparatorio por junta restaurativa</td>
        <td><input type="number" value="<? echo $dataQuestAn47[0][0]; ?>" id="14val2017"></td>
        <td><input type="number" value="<? echo $dataQuestAn47[0][1]; ?>" id="14val2018"></td>
        <td><input type="number" value="<? echo $dataQuestAn47[0][2]; ?>" id="14val2019"></td>
        <td><input type="number" value="<? echo $dataQuestAn47[0][3]; ?>" id="14val2020"></td>
        <td><input type="number" value="<? echo $dataQuestAn47[0][4]; ?>" id="14val2021"></td>
        <td><input type="number" value="<? echo $dataQuestAn47[0][5]; ?>" id="14val2022"></td>
        <td><input type="number" value="<? echo $dataQuestAn47[0][6]; ?>" id="14val2023"></td>
        <td><input type="number" value="<? echo $dataQuestAn47[0][7]; ?>" id="14val2024"></td>
        <td class="blockInp">Capturar</td>
        <td><input type="number" value="<? echo $Cdata14[0][0]; ?>" id="p47m1" <? if($envt == 1){ echo "readonly"; } ?>></td>
        <td><input type="number" value="<? echo $Cdata14[0][1]; ?>" id="p47m2" <? if($envt == 1){ echo "readonly"; } ?>></td>
        <td><input type="number" value="<? echo $Cdata14[0][2]; ?>" id="p47m3" <? if($envt == 1){ echo "readonly"; } ?>></td>
        <td class="blockInp"><input type="number" value="<? echo $Cdata14[0][3]; ?>" id="p47tot" readonly></td>
    </tr>
    <th style=" border: inset 0pt" scope="row"></th>
    <td style=" border: inset 0pt"></td>
    <td style=" border: inset 0pt"></td>
    <td style=" border: inset 0pt"></td>
    <td style=" border: inset 0pt"></td>
    <td style=" border: inset 0pt"></td>
    <td style=" border: inset 0pt"></td>
    <td style=" border: inset 0pt"></td>
    <td style=" border: inset 0pt"></td>
    <td style=" border: inset 0pt"></td>
    <td style=" border: inset 0pt"></td>
    <td style=" border: inset 0pt"></td>
    <td style=" border: inset 0pt"></td>
    <td style=" border: inset 0pt"><strong>TOTAL:</strong></td>
    <td class="blockInp"><strong><?php if($sumTotal != null){ echo $sumTotal; } ?></strong></td>
    </tbody>
</table><br><br>
</div><br><br>
<div class="textoNotaSire" >
    <ul>
        <li style="list-style-type: circle !important" >
            Los reactivos 8.2, 8.4 y 8.7 fueron precargados automáticamente correspondiente con la información que fue proporcionada por su unidad en el Sistema Integral de Registro Estadístico (SIRE)<br><br>
        </li>
    </ul>
</div><br><br>
<div class="textoNota" >
    <ul>
        <li style="list-style-type: circle !important" >
            <div class="imagenWarning">
                <img src="images/warning.png"  class="imgWarning" alt="">
                Nota.- La suma de los datos proporcionados en esta pregunta (reactivos 8.1 al 8.14) deberá ser igual o mayor al dato proporcionado en el reactivo 7.11 (procedimientos vinculados a proceso).
            </div>
        </li>
    </ul>
</div><br><br>
<div class="textoNota" >
    <ul>
        <li style="list-style-type: circle !important" >
            <div class="imagenWarning">
                En caso de que se realicen acuerdos reparatorios a través del OEMASC dependiente de la Fiscalía por que no se cuenta con OEMASC dependiente del Poder Judicial, deberá registrarse en este apartado.
            </div>
        </li>
    </ul>
</div><br><br>
<div class="textoNota" >
    <ul>
        <li style="list-style-type: circle !important" >
            <div class="imagenWarning">
                Si a la fecha de corte de una carpeta de investigación tiene más de un procedimiento en el Órgano Jurisdiccional después de la vinculación a proceso, se deberá registrar casa uno de éstos aun cuando se trate de la misma carpeta de investigación.
            </div>
        </li>
    </ul>
</div><br><br>
<div class="botonGuardar">
    <? if($envt == 0){ ?>
        <button type="button" class="btn btn-success" id="guardarPregunta" onclick="saveQuest8(8, <? echo $per; ?>, <? echo $anio; ?>, <? echo $idUnidad; ?>, <? echo $idEnlace; ?>)">GUARDAR</button> <? } ?>
</div>
<script>
    const scrollContainer = document.querySelector('.scroll-container');

    let isDown = false;
    let startX;
    let scrollLeft;

    scrollContainer.addEventListener('mousedown', (e) => {
        isDown = true;
        scrollContainer.style.cursor = "grabbing";
        startX = e.pageX - scrollContainer.offsetLeft;
        scrollLeft = scrollContainer.scrollLeft;
    });

    scrollContainer.addEventListener('mouseleave', () => {
        isDown = false;
        scrollContainer.style.cursor = "grab";
    });

    scrollContainer.addEventListener('mouseup', () => {
        isDown = false;
        scrollContainer.style.cursor = "grab";
    });

    scrollContainer.addEventListener('mousemove', (e) => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.pageX - scrollContainer.offsetLeft;
        const walk = (x - startX) * 2; // Controla la velocidad del desplazamiento
        scrollContainer.scrollLeft = scrollLeft - walk;
    });
</script>