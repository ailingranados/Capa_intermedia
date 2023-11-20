<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['usuario'];
    $busqueda = $_POST['busqueda'];

   
    header("Location: ../busqueda.php?usuario=$username&busqueda=$busqueda");
       
}


?>
