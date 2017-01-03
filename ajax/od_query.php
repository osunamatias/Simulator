<?php

require("../connection_db.php");

$valor = $_POST['outer_value'];
$weight = $_POST['outer_weight'];
$wall = null;


$my_query1 = "SELECT DISTINCT WALL FROM CASING WHERE OD < " . $valor . " ORDER BY OD";
$my_query2 = "SELECT DISTINCT WALL FROM CASING WHERE OD < " . $valor . " AND WEIGHT = " . $weight . " ORDER BY OD";

$consulta = null;

if ($weight == 0 || $weight == null){
    $consulta = mysqli_query($dbh, $my_query1);
}
else{
    $consulta = mysqli_query($dbh, $my_query2);
}

if (mysqli_num_rows($consulta) > 0){
    $row = mysqli_fetch_assoc($consulta);
    $wall = $row["WALL"];
}

$my_query3 = "SELECT DISTINCT OD, OD_TEXT FROM CASING WHERE OD < " . ($valor- 2*$wall) . " ORDER BY OD";
$consulta = mysqli_query($dbh, $my_query3);

while($registro = mysqli_fetch_assoc($consulta)) {
    echo "<option value='" . $registro["OD"] . "'>" . $registro["OD_TEXT"] . "</option>";
}

$dbh = null;

?>
