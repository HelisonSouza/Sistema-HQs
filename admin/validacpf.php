<?php
//recebe cpf carrega valida e depois restorna
    //incluir o arquivo da função
    include "config/funcoes.php";

    $cpf  = "";
    if ( isset ( $_GET["cpf"] ) )
        $cpf = trim ( $_GET["cpf"] );

    //verifica se o cpf esta em branco
    if ( empty ( $cpf ) ) {
        echo "Forneça um CPF";
        exit; 
    } else if ( $cpf == "12345678909") {
        echo "CPF inválido";
        exit; 
    }

    //executar a funcao
    echo validaCPF($cpf);

