<?php
/**
 * Created by PhpStorm.
 * User: Matt
 * Date: 02/01/2017
 * Time: 12:36
 */

require("../connection_db.php");

$company = $_POST["company"];
$type = $_POST["type"];
$smaller_od = $_POST["od"];

$myQuery = "SELECT DISTINCT GOD, GVALOR FROM GUNS WHERE GCOMPANYS = '$company' AND CTYPE = '$type' AND GVALOR < $smaller_od ORDER BY GVALOR";

if ($result = mysqli_query($dbh,$myQuery) or die(mysqli_error($dbh))){
    while ($row = mysqli_fetch_row($result)){
    $valor = $row[0];
    $txt = $row[1];
    echo "<option value='$valor'>$txt</option>";
    }
}



