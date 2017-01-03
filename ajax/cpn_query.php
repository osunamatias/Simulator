<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 03/01/2017
 * Time: 11:15
 */

require("../connection_db.php");

$gun_od = $_POST['g_od'];
$company = $_POST['company'];
$ctype = $_POST['ctype'];
$s_density = $_POST['s_dens'];
$gun_phase = $_POST['g_phase'];
$charge_gram = $_POST['c_gram'];

$myQuery = "SELECT DISTINCT CPN FROM GUNS 
WHERE GOD = $gun_od AND CTYPE = '$ctype' AND GSPF = $s_density AND GCOMPANYS = '$company' AND GPHASE = '$gun_phase' AND CGMWT = $charge_gram  
ORDER BY CPN";

if ($result = mysqli_query($dbh,$myQuery) or die(mysqli_error($dbh))) {
    while ($row = mysqli_fetch_row($result)) {
        $valor = $row[0];
        echo "<option value='$valor'>$valor</option>";
    }
}