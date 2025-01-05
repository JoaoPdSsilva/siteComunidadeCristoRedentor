<?php

//Exige 4 parametros para conetar com o banco

    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $banco = "historias_santos";

//Função para conectar no banco de dados
    $conexao = mysqli_connect($servidor, $usuario, $senha, $banco) or die;
    mysqli_set_charset($conexao, 'utf8');


?>