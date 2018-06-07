<?php
include 'cabecera.php';
?>

<?php
if($_POST){
    $nombre=$_POST["nombre"];
    $password=$_POST["password"];
    $consulta="insert into usuario (nombre,password) values ('$nombre','$password')";

    $result=$mysqli->query($consulta);
    if($result){
        header('Location: /tresenraya');
    }else{
        $error="Error al crear el usuario";
    }
}
?>
    
<h1>Registro de usuario</h1>

<form action="" method="post">
    <label for="nombre">Nombre: </label>
    <input type="text" name="nombre" id="" required>
    <label for="password">Contraseña</label>
    <input type="text" name="password" id="password" required placeholder="Contraseña">
    <label for="repassword">Contraseña</label>
    <input type="text" name="repassword" id="repassword" required placeholder="Introduce de nuevo la contraseña">
    <input type="submit" value="Guardar">
</form>
<div>
<?php
if(isset($error)){
    echo $error;
}
?>
</div>
</body>
</html>