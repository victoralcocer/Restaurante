<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
</head>
<body>
 
    <h3>Tu carrito</h3>

<?php
    //conectamos ala base de datos
    $base = 'domicilio';
    $tabla = 'platos';
    $conexion = "mysql:dbname=$base;host=localhost";
    $usuario = 'root';
    $password = '';
    $bd = new PDO($conexion, $usuario, $password); 
    $total = 0; 

    session_start();
    //Iniciamos session y con if si el carrito esta vacio mostramos un mensaje
        if (empty($_SESSION['carrito'])) { 
            echo '<p>Tu carrito está vacío.</p>';
            echo '<form method="post">';
            echo '<input type="submit" name="atras" value="Volver"></form>';

            if (isset($_REQUEST["atras"])) {
                header("location:restaurante.php");
                die;
            }



        } else {
            //Si han pedido algo iremos incrementando los productos
            echo '<h3>Pedido: </h3>';

            $platos = ""; 
            $contador = 1; 

            $clv = array_keys($_SESSION['carrito']);
            $val = array_values($_SESSION['carrito']);
            //Vamos recorriendo los platos con arryas
            for ($i = 0; $i < count($_SESSION['carrito']); $i++) {

                $plato = $clv[$i];
                $cantidad = $val[$i];
                echo $cantidad.". ".$plato." Precio->";

                $sql = 'SELECT precio FROM platos WHERE Nombre=?';
                $preparada = $bd->prepare($sql);
                $preparada->execute(array($plato));
                $fila = $preparada->fetch();
                $precio = $fila["precio"];          
                //Si ya esta el pedido y queemos mas solo incrementamos
                if ($cantidad > 1) {
                    $precio *= $cantidad; 
                    echo $precio . "€<br>";
                    $total += $precio; 

                    $platos .= $cantidad.". ".$plato ." ".$precio ."€\n"; 
                } else {
                //En caso que el plato todavia no haya sido pedido lo añadimos
                    echo $precio . "€<br>";
                    $total += $precio;
                    $platos .= $cantidad.". ".$plato ." ".$precio ."€\n";
                }
            }
            echo "<br>Precio total: $total" . "€<br><br>";
            //Formulario para realizar pago o eliminar pedido 
            echo '<form method="post">';
            if (!isset($_REQUEST["pagar"])) { 
            echo '<input type="submit" name="pagar" value="Pagar">';
            }
            echo '<input type="submit" name="eliminar" value="Eliminar pedido">';
            echo '<input type="submit" name="atras" value="Volver">';
            //Para pagar generamos el documento y contamos todos los pedido y los llevamos a la base de datos
            if (isset($_REQUEST["pagar"])) {

                $sql = 'SELECT * FROM pedidos';
                $preparada = $bd->prepare($sql);
                $preparada->execute();

                if ($preparada->rowCount() > 0) { 

                    foreach ($preparada as $fila) {
            //Recorremos y comprobamos si es el mismo usuario en caso que si solo incrementamos contador
                        if ($fila['usuario'] == $_SESSION["nombre"]) { 
                            $contador++; 
                        } else {

                            $documento = $_SESSION['nombre']." ".$contador; 
                        }

                        $documento = $_SESSION['nombre']." ".$contador;  
                    }

                } else { 
                    $documento = $_SESSION['nombre']." ".$contador;
                }
                //fopen para general archivo text
                $archivo = fopen("$documento" . ".txt", 'a');
                fputs($archivo, "Su pedido: "."\n"."\n");
                fputs($archivo, $platos);
                fputs($archivo, "---------------"."\n");
                fputs($archivo, "Total: ".$total);
                fclose($archivo); 

             

                $fecha = date("Y-m-d");

                $sql = "INSERT INTO pedidos(usuario,fecha,platos) 
                        VALUES(?,?,?)";

                
                //Insert para añadir a base de datos y en sitio que van los platos añadimos nuestro documento generado
                $preparada = $bd->prepare($sql);
                $preparada->execute(array($_SESSION["nombre"], $fecha, $documento . ".txt"));

                echo "<p>Pedido correcto.</p>";

                unset($_SESSION['carrito']);                
            }
            //Borrar el carrito y nos envia a carrito pero esta vez vacio
            if (isset($_REQUEST["eliminar"])) {
                unset($_SESSION['carrito']); 
                header("location:carrito.php"); 
                die;
            }

            if (isset($_REQUEST["atras"])) {
                header("location:restaurante.php");
                die;
            }
        }
    



?>

</body>
</html>