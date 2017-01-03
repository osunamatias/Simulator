<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 03/01/2017
 * Time: 9:31
 */

require("../connection_db.php");

$gun_od = $_POST['g_od'];
$company = $_POST['company'];
$ctype = $_POST['ctype'];

$myQuery = "SELECT DISTINCT GSPF FROM GUNS WHERE GOD = '$gun_od' AND CTYPE = '$ctype' AND GCOMPANYS = '$company' ORDER BY GSPF";

if ($result = mysqli_query($dbh,$myQuery) or die(mysqli_error($dbh))){
    while ($row = mysqli_fetch_row($result)){
        $valor = $row[0];
        echo "<option value='$valor'>$valor</option>";
    }
}