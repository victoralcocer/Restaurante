<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesion</title>
</head>
<body>
   
    <h3>Restaurante Victor</h3>
    
    <?php
    //Pasamos a la pagina donde vamos a iniciar session, si session esta abierta accedemos
    //En caso que sesion no este iniciada procedemos a iniciar sesion
    session_start();

    if(isset($_SESSION['nombre'])){
        echo '<form method="post">';
        echo '<input type="submit" name="cerrar" Value="Cerrar sesion"';
    }else{
        echo '<form method="post">';
		echo '<p>Bienvenid@, inicie sesion para realizar pedido.</p>';
		echo 'Nombre: <input type="text" name="nombre" ><br>';
		echo 'Contraseña: <input type="text" name="contraseña" ><br><br>';
		echo '<input type="submit" name="iniciar2" value="Iniciar">';
        echo '<input type="submit" name="atras" value="Volver"></form><br>';


        
        //Le damos al boton iniciar y nos conectamos con la base de datos
        if(isset($_REQUEST['iniciar2'])){


            $conexion=mysqli_connect('localhost','root','','domicilio')
                or die('Problemas con la conexión');
            //Esto nos llevara donde el usuario tiene sus datos 
            $datos=mysqli_query($conexion,"SELECT * FROM usuarios WHERE nombre='$_REQUEST[nombre]'")
                or die('Problemas al seleccionar: '.mysqli_error($conexion));
        
            $contador = 0;
            
            while($fila=mysqli_fetch_array($datos)){
                $contador++;
            }
        
            $select=mysqli_query($conexion,"SELECT * FROM usuarios WHERE nombre='$_REQUEST[nombre]'")
                or die('Problemas al seleccionar: '.mysqli_error($conexion));
        //Comprobacion para que el nombre sea unico y la contraseña sea la misma
            if($contador>0){
                $fila2=mysqli_fetch_array($select);
                $contraseña = $fila2['contraseña'];
                if($_REQUEST['contraseña']==$contraseña){
                    session_start();
                    $_SESSION['nombre'] = $_REQUEST['nombre'];
                    header("location: kebab.php");
        
                } else {
                    echo "<br>Email o contraseña incorrecto.";
                }
            }
        
            if($contador==0){
                echo "<br>No coinciden las credenciales.";
            }
        
            mysqli_close($conexion);}

            if (isset($_REQUEST["atras"])) {
                header("location:restaurante.php");
                die;
            }


    }



    ?>

</body>
</html>