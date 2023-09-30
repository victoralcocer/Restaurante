<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cuenta</title>
</head>
<body>
    
<h3>Restaurante Victor</h3>
<p>Crea tu cuenta para realizar pedidos</p>

   <form method=post>
   Nombre: <input type="text" name="n" required><br>
   Correo: <input type="email" name="e" required><br>
   Contraseña: <input type="text" name="c" required><br>
   Repetir contraseña: <input type="text" name="rc" required><br><br>
   <input type="submit" name = "registrarse" value= "Registrarse"> 
   </form><br>
    <form method="post">
    <input type="submit" name = "iniciar" value= "Iniciar sesion">
    <input type="submit" name="atras" value="Volver">
    </form>

<?php
//Hacemos un formulario a continuacion hacemos comprobaciones para la contraseña
$correcto = true;
if(isset($_REQUEST['registrarse'])){

//Podemos poner la longuitud de contraseña que queramos
   if(strlen($_REQUEST['c'])<8){
       echo "<br>La contraseña debe tener mas de 8 caracteres";
       $correcto=false;
   }
   //Al menos una miniscula
   $minuscula="/[a-z]/";
   $nombrecontraseña = $_REQUEST['c'];
   if((preg_match($minuscula,$nombrecontraseña))==0){
       echo "<br>La contraseña debe tener al menos una minuscula";
       $correcto=false;
   }
   //Al menos una mayuscula
   $mayuscula="/[A-Z]/";
   $nombrecontraseña = $_REQUEST['c'];
   if((preg_match($mayuscula,$nombrecontraseña))==0){
       echo "<br>La contraseña debe tener al menos una mayuscula";
       $correcto=false;
   }
   //Para meter caracteres especiales
   $especial="/[-@$*^;ç:+<>¨~#,_?|&%()={}]/";
   $nombrecontraseña = $_REQUEST['c'];
   if((preg_match($especial,$nombrecontraseña))==0){
       echo "<br>La contraseña debe tener al menos un caracter especial";
       $correcto=false;
   }
   //Algun numero
   $numeros="/[0-9]/";
   $nombrecontraseña = $_REQUEST['c'];
   if((preg_match($numeros,$nombrecontraseña))==0){
       echo "<br>La contraseña debe tener al menos un numero";
       $correcto=false;
   }
   //Aqui comprobamos que ambas contraseñas sean iguales
   if($_REQUEST['c']!==$_REQUEST['rc']){
       echo "<br>La contraseña es incorrecta";
       $correcto=false;
   }


   //Si todo esta correcto conectamos con la base de datos y agregamos usuario

   if($correcto){

       $conexion = mysqli_connect('localhost', 'root', '', 'domicilio')
       or die ("Problemas de la conexion");

       $select=mysqli_query($conexion, "SELECT * FROM usuarios WHERE email='$_REQUEST[e]'")
       or die('Problemas al seleccionar: '.mysqli_error($conexion));

       $contador = 0;
    //Vamos insertando usuarios solo si son nuevos
       while($fila=mysqli_fetch_array($select)){
           $contador++;
       }
       //Contado para verificar que el usuario es nuevo
       if ($contador == 0) {

           mysqli_query($conexion, "INSERT INTO usuarios (nombre, email, contraseña)
       
       VALUES ('$_REQUEST[n]','$_REQUEST[e]','$_REQUEST[c]')")

               or die("Problemas al insertar: " . mysqli_error($conexion));

           echo "<br>Registrado con exito!<br><br>";
       }else{

           echo "<br>El correo introducido ya existe, pruebe otro.";
       }

       mysqli_close($conexion);

   
  
   }
}
//Boton iniciar si el usuario esta creado le damos para iniciar sesion
if(isset($_REQUEST['iniciar'])){
    header("location:iniciar.php");
    die;
}
if (isset($_REQUEST["atras"])) {
    header("location:restaurante.php");
    die;
}


?>

    
</body>
</html>