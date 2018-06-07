<?php

session_start();
$mysqli = new mysqli("localhost", "root", "", "tresenraya");

if(isset($_SESSION["iduser"])){
    $iduser=$_SESSION["iduser"];
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
  <!-- <meta http-equiv="refreh" content="10">       refrescar pagina cada 10 segundos -->
    <title>Juego del Tres en raya</title>
    <script src="js.js"></script>
</head>
<body>