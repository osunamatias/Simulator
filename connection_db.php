<?php
/**
 * Created by PhpStorm.
 * User: Matt
 * Date: 29/12/2016
 * Time: 9:12
 */

$pass = "";
$usr = "root";
$lhost = "localhost";
$database = "etasa";

$dbh = mysqli_connect($lhost, $usr, $pass,$database);

// Check connection
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

?>