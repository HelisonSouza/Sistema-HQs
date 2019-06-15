<?php

	//criar conexao com banco com PDO
	//$servidor = "127.16.1.215"; //Alfa
	$servidor = "localhost"; //local
	//em 99% dos casos é localhost

	//usuario de acesso ao banco
	//Servidor Alfa
	//$usuario = "9245";
	//$senha = "9245";

	//Servidor local
	$usuario = "root";
	$senha = "";

	//nome do banco de dados
	$banco = "9245_hqs";

	try {
		//criar uma conexao com PDO
		$pdo = new PDO("mysql:host=$servidor;
			dbname=$banco;
			charset=utf8",
			$usuario,
			$senha);

	} catch (PDOException $erro) {

		//mensagem de erro
		$msg = $erro->getMessage();

		echo "<p>Erro ao conectar no banco de dados: $msg </p>";

	}