<?php
//En caso de cualquier tipo de cambio nos envia a esta pagina
if (empty($_REQUEST)) { 
    header("location:carrito.php");
    die;
}
//Matenemos session abierta
session_start(); 

$clv = array_keys($_REQUEST); 
$val = array_values($_REQUEST);
//Si no esta creado el carrito lo cremoa y lo añadimos a session
if(!isset($_SESSION['carrito'])){ 

    $carrito = array(); 
    $_SESSION['carrito'] = $carrito;            

}
//Recorremos las claves
for ($i = 0; $i < count($clv); $i++) { 

    if (!empty($val[$i])) { 
        $clave = $clv[$i]; 
        $clave = str_replace("_", " ", $clave);
        //En caso que el plato ya este guradado lo sumamos
        if (isset($_SESSION['carrito'][$clave])) { 
            $_SESSION['carrito'][$clave] += $val[$i];  
        } 
        else {    
            //Si no esta gurdado lo añadimos al array
            $carrito[$clave] = $val[$i]; 
            $_SESSION['carrito'][$clave] = $carrito[$clave]; 
        }
    }
}

header("location:restaurante.php");
die;
?>
