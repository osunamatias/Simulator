<?php

require("../connection_db.php");

$valor = $_POST['outer_value'];
$weight = $_POST['outer_weight'];
$wall = null;


$my_query1 = "SELECT DISTINCT WALL FROM CASING WHERE OD <= " . $valor . " ORDER BY OD";
$my_query2 = "SELECT DISTINCT WALL FROM CASING WHERE OD < " . $valor . " AND WEIGHT = " . $weight . " ORDER BY OD";

$consulta = null;

if ($weight == 0 || $weight == null){
    $wall = 0;
}
else{
    $resWall = mysqli_query($dbh,$my_query2) or die(mysqli_error($dbh));
    $row = mysqli_fetch_row($resWall);
    $wall = $row[0];
}

$my_query3 = "SELECT DISTINCT OD, OD_TEXT FROM CASING WHERE OD < " . ($valor- (2*$wall)) . " ORDER BY OD";
echo "wall:".(2*$wall);
echo $my_query3;

if ($result = mysqli_query($dbh,$my_query3) or die(mysqli_error($dbh))){
    while ($row = mysqli_fetch_row($result)){
        $od = $row[0];
        $od_text = $row[1];
        echo "<option value='$od'>$od_text</option>";
    }
}

?>
