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
                $_SESSION["idpartida"]=$mysqli->insert_id;
                header("Location: partida.php");
                break;

            default:
                # code...
                break;
        }
    }
}

$consulta = "select nombre,partidas.id from partidas,usuario where resultado=0 and partidas.iduser1=usuario.id and iduser2=0";
$result = $mysqli->query($consulta);

$tabla="";
if ($result->num_rows > 0) {
    while ($partidas = $result->fetch_assoc()) {
        $id=$partidas["id"];
        $user=$partidas["nombre"];
        $jugar="<a href='partida.php?id=$id'>jugar</a>";
        $tabla=$tabla."<tr><td>$id</td><td>$user</td><td>$jugar</td></tr>";

        // foreach ($partidas as $key => $value) {
            
        //     echo "clave: $key , valor: $value";
        // }
        // echo "<hr>";
    }
    
} else {
    $error = "Aún no hay partidas creadas, crea una";
}
?>



<header>
<span><?php
echo $_SESSION["nombre"];
?></span>
</header>
<hr>

<h1>Lista de partidas </h1>

<div>
<table>
    <thead>
        <th>Partida</th>
        <th>Jugador1</th>
        <th>Jugar</th>
    </thead>
    <tbody>
        <?php
        if(isset($tabla)){
            echo $tabla;
        }else{
            echo "Aún no hay partidas creadas";
        }
        ?>
    </tbody>
</table>
</div>


<a href="juegos.php?act=crearpartida">
<button>Crear partida</button>
</a>


<div>
<?php

if (isset($error)) {
    echo $error;
}
?>
</div>


</body>
</html>