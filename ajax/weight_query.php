<?php
require("../connection_db.php");

$valor = $_POST["diameter"];

$my_query1 = "SELECT DISTINCT WEIGHT FROM casing WHERE OD = " . $valor . " ORDER BY WEIGHT";

if ($result=mysqli_query($dbh, $my_query1))
{
    // Fetch one and one row
    while ($row=mysqli_fetch_row($result))
    {
        echo "<option value='". $row[0] . "'>".$row[0]."</option>";
    }
    // Free result set
    mysqli_free_result($result);
}

mysqli_close($dbh);
?>