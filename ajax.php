<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "tresenraya");

if (isset($GET["id"])) {
    $idpartida = $_GET["id"];
    $consulta = "select nombre from partidas inner join usuario on iduser2=usuario.id where partidas.id=$idpartida";
    $result = $mysqli->query($consulta);
    if ($result->num_rows == 0) {
        echo "Esperando...";
    } else {
        $resultado = $result->fetch_asoc();
        echo $resultado["nombre"];
    }
}

if (isset($_GET["idcelda"]) && isset($_GET["idpartida"])) {
    $idcelda = $_GET["idcelda"];
    $idpartida = $_GET["idpartida"];
    $iduser = $_SESSION["iduser"];
    $consulta = "UPDATE `partidas` SET $idcelda = $iduser WHERE `partidas`.`id` = $idpartida";
    $result = $mysqli->query($consulta);
    if ($result) {
        echo "ok";
    } else {
        echo "noOk";
    }
}

if (isset($_GET["idpart"])) {

    $idpartida = $_GET["idpart"];
  
    $consulta = "select * from partidas WHERE id = $idpartida";
    $result = $mysqli->query($consulta);
    
    if ($result->num_rows == 0) {
        echo "error";
    } else {
        $r = $result->fetch_assoc();
        $response = "[" . $r["c0"] . "," . $r["c1"] . "," . $r["c2"] . "," . $r["c3"] . "," . $r["c4"] . "," . $r["c5"] . "," . $r["c6"] . "," . $r["c7"] . "," . $r["c8"] . "]";
        echo $response;
    }
}
