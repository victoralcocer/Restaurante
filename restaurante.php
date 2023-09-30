<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurante</title>
</head>
<body>

    <h3>Bienvenido al Restaurante Victor!</h3>

    <table>

        <tr colspan="4" style="background-color: rgb(102, 255, 153)">
            <?php
//conectamos a la base de datos, en este caso usare PDO
$base = 'domicilio';
$tabla = 'platos';
$conexion = "mysql:dbname=$base;host=localhost";
$usuario = 'root';
$password = '';
$bd = new PDO($conexion, $usuario, $password); 


$bd = new PDO("mysql:dbname=$base;host=localhost", 'root', '');
$preparada = $bd->prepare("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS
            WHERE TABLE_SCHEMA=N'$base' AND TABLE_NAME = N'$tabla'"); 
$preparada->execute();

$column = array();
//vamos recorriendo el array e imprimiendo nombres
foreach ($preparada as $fila) {
    echo "<th name=" . $fila['COLUMN_NAME'] . ">$fila[COLUMN_NAME]</th>"; 
    $column[] = $fila['COLUMN_NAME']; 
}
echo "</tr><tr>";
//seleccionamos todos los datos de la tabla platos
$sql = 'SELECT * FROM platos';
$prepare = $bd->prepare($sql);
$prepare->execute();
//con un for vamos recorriendo las filas y las imprmimos 
foreach ($prepare as $fila) {
    for ($i = 0; $i < count($column); $i++) {
        echo "<td>" . $fila[$column[$i]] . "</td>";
    }
    echo "<tr>"; 
}

 
        
    ?>

</table>

<?php

session_start();
//Si la sesion esta iniciada daremos la bienvenida y otras opciones
//para que el usuario pueda hacer su pedido
if (isset($_SESSION['nombre'])) {

echo "<h3>Bienvenid@, $_SESSION[nombre].</h3>"; 
echo '<form method="post">';

if(isset($_SESSION['carrito'])){ 
    echo '<input type="submit" name="pedido" value="Continuar pedido">';
}else{
    echo '<input type="submit" name="pedido" value="Domicilio">';           
}
echo '<input type="submit" name="carrito" value="Ver carrito">';       
echo '<input type="submit" name="cerrar" value="Cerrar sesión"></form><br>';

if (isset($_REQUEST["cerrar"])) { 
    session_destroy();
    header("location:iniciar.php");
    die;
}
if (isset($_REQUEST["carrito"])) {          
    header("location:carrito.php");
    die;
}
//Con la sesion uniciada mostraremos un select que mostrara los platos de la base de datos
if (isset($_REQUEST["pedido"])) {            
    echo '<form method="post">';
    echo "Categoría: <select name='categoria' required>";

    $sql = 'SELECT DISTINCT categoria FROM platos'; 

    $preparada = $bd->prepare($sql);
    $preparada->execute();

    foreach ($preparada as $fila) {
        echo "<option value='$fila[0]'>$fila[0]</option>"; 
    }
    echo "</select>";
    echo '<input type="submit" name="ver" value="Ver platos"></form>';
}
//Cuando le demos a ver platos apareceran los platos de la categoria que hemos elegido
if (isset($_REQUEST["ver"])) {

    echo '<form method="post">';
    echo "Categoría: <select name='categoria' required>";

    $sql = 'SELECT DISTINCT categoria FROM platos'; 

    $preparada = $bd->prepare($sql);
    $preparada->execute();
//Con foreach recorremos las filas y las iremos mostrando en el select
    foreach ($preparada as $fila) {
        echo "<option value='$fila[0]'>$fila[0]</option>"; 
    }
    echo "</select>";
    echo '<input type="submit" name="ver" value="Ver platos"></form>';

    echo '<form method="post" action="actualizar.php">'; 

    $sql = 'SELECT nombre FROM platos WHERE categoria =?';
    $preparada = $bd->prepare($sql);
    $preparada->execute(array($_REQUEST["categoria"]));
//Este if devuelve las filas 
    if ($preparada->rowCount() > 0) { 

        echo "<h3>$_REQUEST[categoria]</h3>"; 
        foreach ($preparada as $fila) {
            echo $fila[0] . ": <input type='number' name='$fila[0]' min='0'><br><br>";              
        }
    }
    echo '<br><input type="submit" value="Añadir al carrito"></form>';

}

echo '</form>';           

} else {
//En caso que no haya inicio de sesion seguiremos con el formulario del principio
echo '<form method="post">'; 
echo '<br><input type="submit" name="pedido" value="Domicilio">'; 
echo '<input type="submit" name="iniciar" value="Iniciar sesion">';
echo '<input type="submit" name="crearcuenta" value="Crear cuenta">';
echo '<input type="submit" name="atras" value="Volver"></form><br>';



if (isset($_REQUEST["iniciar"])) {
    header("location:iniciar.php");
    die;
}

if (isset($_REQUEST["crearcuenta"])) {
    header("location:Login.php");
    die;
}
if (isset($_REQUEST["pedido"])) {
    echo "Debes iniciar sesión.";
}
if (isset($_REQUEST["atras"])) {
    header("location:./");
    die;
}

}
?>




</body>
</html>