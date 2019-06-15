<?php

	$id = "";
	//verificar se existe o parametro para id
	if ( isset ( $p[1] ) ) {
		//p -> array explode que esta no index.php
		$id = trim ( $p[1] );
	}

	//selecionar a editora
	$sql = "select nome from editora 
		where id = ".(int)$id." limit 1";
	//executar o sql
	$resultado = mysqli_query($conexao, $sql);
	//a linha de resultado
	$linha = mysqli_fetch_array($resultado);
	//separar os campos de resultado
	$nome = $linha["nome"];

	//mostrar o nome da editora na tela
	echo "<h1>$nome</h1>";
?>
<div class="row">
	<?php
		//selecionar os quadrinhos da editora
		$sql = "select id, titulo, numero, 
			valor, capa, date_format(data,'%d/%m/%Y') data
			from quadrinho
			where editora_id = ".(int)$id." 
			order by data desc";
		//executar o sql
		$resultado = mysqli_query($conexao,$sql);

		while ( $linha = mysqli_fetch_array($resultado)) {

			//separar os campos
			$id 	= $linha["id"];
			$titulo = $linha["titulo"];
			$numero = $linha["numero"];
			$valor	= $linha["valor"];
			$capa	= $linha["capa"]."m.jpg";
			$data	= $linha["data"];

			$valor = number_format($valor,2,",",".");

			echo "<div class='col-4 mt-3 text-center'>
					<img src='fotos/$capa' class='w-100 '>
					<p>$titulo</p>
					<p>$data</p>
					<p class='valor'>R$ $valor</p>
					<a href='quadrinho/$id' class='btn btn-danger'>Detalhes</a>
				</div>";
		}

	?>
</div>
