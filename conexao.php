<?php
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $banco = "sae";
    $conn = mysqli_connect($servidor, $usuario, $senha, $banco);


    if (!$conn){
        die("erro na conexão!");
    }
?>
