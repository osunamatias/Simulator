<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 03/01/2017
 * Time: 10:22
 */

require("../connection_db.php");

$gun_od = $_POST['g_od'];
$company = $_POST['company'];
$ctype = $_POST['ctype'];
$s_density = $_POST['s_dens'];
$gun_phase = $_POST['g_phase'];

$myQuery = "SELECT DISTINCT CGMWT FROM GUNS 
WHERE GOD = $gun_od AND CTYPE = '$ctype' AND GSPF = $s_density AND GCOMPANYS = '$company' AND GPHASE = '$gun_phase'  
ORDER BY CGMWT";

echo $myQuery;

if ($result = mysqli_query($dbh,$myQuery) or die(mysqli_error($dbh))){
    while ($row = mysqli_fetch_row($result)){
        $valor = $row[0];
        echo "<option value='$valor'>$valor</option>";
    }
}