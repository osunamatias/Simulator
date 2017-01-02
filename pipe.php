<?php
/**
 * Created by PhpStorm.
 * User: Matt
 * Date: 02/01/2017
 * Time: 10:43
 */

require ("connection_db.php");

$od = $_POST['od'];
$weight = $_POST['weight'];

$query1 = "SELECT DISTINCT WALL, GRADE, YIELD FROM CASING WHERE OD = $od AND WEIGHT = $weight ORDER BY GRADE";

if (($result=mysqli_query($dbh, $query1)) or die(mysqli_error($dbh))) {
    // Fetch one and one row
    while ($row=mysqli_fetch_row($result)) {
        $wall = $row[0];
        $grade = $row[1];
        $yield = $row[2];

        echo "<option value='".$wall."'>".$grade." ".$yield."</option>";
    }
    // Free result set
    mysqli_free_result($result);
}


mysqli_close($dbh);
?>
