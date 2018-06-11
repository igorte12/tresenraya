<?php
include 'cabecera.php';


if ($_POST) {
    $nombre = $_POST["nombre"];
    $password = $_POST["password"];
    $consulta = "select * from usuario where nombre='$nombre' and password='$password'";
    $result = $mysqli->query($consulta);
    
    if($result->num_rows==0){
        $error="Error en el usuario o contraseña";
    }else{
        $resultado = $result->fetch_array();
        $_SESSION['iduser']=$resultado['id'];
        $_SESSION["nombre"]=$resultado["nombre"];
      
      
        header('Location: juegos.php');
    }  
}
?>

<h1>Login de usuario</h1>

<form action="" method="post">
    <label for="nombre">Nombre: </label>
    <input type="text" name="nombre" id="" required>
    <label for="password">Contraseña</label>
    <input type="text" name="password" id="password" required placeholder="Contraseña">
    <input type="submit" value="Login">
</form>
<a href="registro.php">Crear usuario</a>
<div>
<?php
if(isset($error)){echo $error;}
?>
</div>
</body>
</html>
