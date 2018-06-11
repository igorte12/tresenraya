<?php
include 'cabeceraPartida.php';

if (isset($_GET["id"])) {
    $idpartida = $_GET["id"];
    $iduser = $_SESSION["iduser"];
    $turno = rand(1, 2);
    $consulta = "UPDATE partidas SET iduser2 = $iduser, turno=$turno WHERE id = $idpartida";
    $result = $mysqli->query($consulta);

    if ($result) {
        $_SESSION["idpartida"] = $idpartida;
        header("Location: partida.php");
       } else {
        header("Location: juegos.php");
    }
}
if (isset($_GET["idenjuego"])) {
    $idpartida = $_GET["idenjuego"];
    $_SESSION["idpartida"] = $idpartida;
    header("Location: partida.php");
}
if ($_SESSION["idpartida"]) {
    $idpartida = $_SESSION["idpartida"];
}
$consulta = "select partidas.id,usr1.nombre as jugador1,usr2.nombre as jugador2,c0,c1,c2,c3,c4,c5,c6,c7 from partidas LEFT JOIN usuario usr1 on partidas.iduser1=usr1.id LEFT JOIN usuario usr2 on partidas.iduser2=usr2.id where partidas.id=$idpartida";
// $consulta = "select partidas.id,c0,c1,c2,c3,c4,c5,c6,c7,c8,usr1.nombre as jugador1,usr2.nombre as jugador2 from partidas,usuario as usr1, usuario as usr2 where partidas.id=$idpartida and usr1.id=iduser1 and usr2.id=iduser2";
$result = $mysqli->query($consulta);
if ($result->num_rows == 0) {
    header("Location: juegos.php");
    } else {
    $partida = $result->fetch_assoc();
    $jugador1 = $partida["jugador1"];

    if ($partida["jugador2"] == null) {
        $jugador2 = "Esperando...";
    } else {
        $jugador2 = $partida["jugador2"];
    }
   
}
?>
<header><span><?php //El span sirve para dar estilos a un solo elemento (no va de unlado al otro de la página como un div).
echo $_SESSION["nombre"];
?></span></header>
<hr>
<h3>Partida <span id="idpartida"><?php echo $idpartida; ?></span></h3>
<div class="container">
    <div id="jugador1"><?php echo $jugador1; ?></div>
    <div id="tablero">
        <div id="c0" class="celda"></div>
        <div id="c1" class="celda"></div>
        <div id="c2" class="celda"></div>
        <div id="c3" class="celda"></div>
        <div id="c4" class="celda"></div>
        <div id="c5" class="celda"></div>
        <div id="c6" class="celda"></div>
        <div id="c7" class="celda"></div>
        <div id="c8" class="celda"></div>
    </div>
    <div id="jugador2"><?php echo $jugador2; ?></div>
</div>
</body>
</html>
