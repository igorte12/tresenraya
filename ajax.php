<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "tresenraya");

if (isset($_GET["id"])) {
    
    $idpartida = $_GET["id"];
    $consulta = "select nombre from partidas inner join usuario on iduser2=usuario.id where partidas.id=$idpartida";
    $result = $mysqli->query($consulta);
    if ($result->num_rows == 0) {
        echo "Esperando...";
    } else {
        $resultado = $result->fetch_assoc();
        echo $resultado["nombre"];
    }
}

if (isset($_GET["idcelda"]) && isset($_GET["idpartida"])) {
    $idcelda = $_GET["idcelda"];
    $idpartida = $_GET["idpartida"];
    $turno;
    $consulta = "select turno from partidas where id=$idpartida";

    $result = $mysqli->query($consulta);
    // $iduser = $_SESSION["iduser"];
    // $consulta = "UPDATE `partidas` SET $idcelda = $iduser WHERE `partidas`.`id` = $idpartida";
    if ($result->num_rows > 0) {
        $r = $result->fetch_assoc();

        if ($r["turno"] == 1) {
            $turno = 2;
        } else {
            $turno = 1;
        }
     
    }
    $iduser = $_SESSION["iduser"];
    $consulta = "UPDATE partidas SET $idcelda = $iduser, turno=$turno WHERE id = $idpartida";
    $result = $mysqli->query($consulta);
    if ($result) {
        echo "ok";
    } else {
        echo "no ok";
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
        $response = "["
            . $r["c0"]
            . "," . $r["c1"]
            . "," . $r["c2"]
            . "," . $r["c3"]
            . "," . $r["c4"]
            . "," . $r["c5"]
            . "," . $r["c6"]
            . "," . $r["c7"]
            . "," . $r["c8"]
            . "]";

        // echo $response;
        $iduser1 = $r["iduser1"];
        $iduser2 = $r["iduser2"];
        $obj = [
            'jugador1' => $iduser1,
            'jugador2' => $iduser2,
            'celdas' => $response,
            'turno' => $r['turno'], //[BBDD]
            'usr' => $_SESSION["iduser"],
        ];
        echo json_encode($obj);
    }
}
