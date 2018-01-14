<?php

include("config.php");

$codigo = $_GET['codigo'];


$sql =  "DELETE FROM TASKS WHERE CODIGO=" . $codigo;
$result = mysqli_query($dbcon, $sql);

header("Location:logged.php");

?>

