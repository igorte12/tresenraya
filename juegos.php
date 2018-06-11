<?php
include 'cabecera.php';


if ($_GET) {
    if (isset($_GET["act"])) {
        $accion = $_GET["act"];
        switch ($accion) {
            case 'crearpartida':
                $consulta = "insert into partidas (iduser1) values ($iduser)";
                $result = $mysqli->query($consulta);
                if (!$result) {
                    $error = "Error al crear la partida";
                }
                $_SESSION["idpartida"] = $mysqli->insert_id;
                header("Location: partida.php");
                break;

            default:
                # code...
                break;
        }
    }
}
//Partidas en espera
$consulta = "select nombre,partidas.id from partidas,usuario where resultado=0 and partidas.iduser1=usuario.id and iduser2 is null";
$result = $mysqli->query($consulta);

$tabla = "";
if ($result->num_rows > 0) {
    while ($partidas = $result->fetch_assoc()) {
        $id = $partidas["id"];
        $user = $partidas["nombre"];
        $jugar = "<a href='partida.php?id=$id'>jugar</a>";
        $tabla = $tabla . "<tr><td>$id</td><td>$user</td><td>$jugar</td></tr>";

        // foreach ($partidas as $key => $value) {

        //     echo "clave: $key , valor: $value";
        // }
        // echo "<hr>";
    }

} else {
    $error = "Aún no hay partidas creadas, crea una";
}

// Partidas en juego

$consulta = "SELECT partidas.id,usr1.nombre as jugador1,usr2.nombre as jugador2 FROM `partidas` LEFT JOIN usuario as usr1 on iduser1=usr1.id LEFT JOIN usuario usr2 on iduser2=usr2.id where (iduser1=$iduser or iduser2=$iduser) and resultado=0 and iduser2 is not null";
$result = $mysqli->query($consulta);

$tablaEnJuego = "";
if ($result->num_rows > 0) {
    while ($partidas = $result->fetch_assoc()) {
        $id = $partidas["id"];
        $jugador1 = $partidas["jugador1"];
        $jugador2 = $partidas["jugador2"];
        $jugar = "<a href='partida.php?idenjuego=$id'>Seguir jugando</a>";
        $tablaEnJuego = $tablaEnJuego . "<tr><td>$id</td><td>$jugador1</td><td>$jugador2</td><td>$jugar</td></tr>";
    }

} else {
    $error = "Aún no hay partidas en juego";
}
?>





<header>
<span><?php
echo $_SESSION["nombre"];
?></span>
</header>
<hr>

<h1>Lista de partidas </h1>
<section class="listados">
    <div>
        <h3>Partidas en espera</h3>
        <div>
            <table>
                <thead>
                    <th>Partida</th>
                    <th>Jugador1</th>
                    <th>Jugar</th>
                </thead>
                <tbody>
                    <?php
            if (isset($tabla)) {
                echo $tabla;
            } else {
                echo "Aún no hay partidas creadas";
            }
            ?>
                </tbody>
            </table>
        </div>
        <a href="juegos.php?act=crearpartida">
            <button>Crear partida</button>
        </a>
    </div>
    <div>
        <h3>Partidas en juego</h3>
        <div>
            <table>
                <thead>
                    <th>Partida</th>
                    <th>Jugador1</th>
                    <th>Jugador2</th>
                    <th>Operación</th>
                </thead>
                <tbody>
                    <?php
                        if (isset($tablaEnJuego)) {
                            echo $tablaEnJuego;
                        } else {
                            echo "Aún no hay partidas en juego";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>


</section>

</body>
</html>