<?php
	//verificar se o arquivo existe
	if ( file_exists ( "verificalogin.php" ) )
		include "verificalogin.php";
	else
		include "../verificalogin.php";

	$id = $nome = $datanascimento = $email = $cpf = $cep = $endereco = $complemento = $bairro = $cidade_id = $foto = $telefone = $celular = "";
?>
<div class="container">
	<div class="coluna">
		<h1 class="float-left">Cadastro de Clientes</h1>

		<div class="float-right">
			<a href="cadastros/cliente" class="btn btn-success">
				<i class="fas fa-file"></i> Novo
			</a>

			<a href="listar/cliente" class="btn btn-info">
				<i class="fas fa-search"></i> Listar
			</a>
		</div>

		<div class="clearfix"></div>

		<form name="cadastro" method="post" action="salvar/cliente" data-parsley-validate>

			<label for="id">ID:</label>
			<input type="text" name="id" 
			class="form-control" readonly
			value="<?=$id;?>">

			<br>
			<label for="nome">Nome do Ciente:</label>
			<input type="text" name="nome" required
			class="form-control"
			data-parsley-required-message="Preencha este campo"
			value="<?=$nome;?>">

			<br>
			<label for="cpf">CPF:</label>
			<input type="text" name="cpf" id="cpf" required
			class="form-control" data-mask="999.999.999-99"
			data-parsley-required-message="Preencha este campo"
			value="<?=$cpf;?>"
			onblur="validaCpf(this.value)"> 

			<br>
			<label for="datanascimento">Data de Nascimento:</label>
			<input type="text" name="datanascimento" required
			class="form-control" data-mask="99/99/9999"
			data-parsley-required-message="Preencha este campo"
			value="<?=$datanascimento;?>">

			<br>
			<label for="telefone">Telefone:</label>
			<input type="text" name="telefone" required
			class="form-control" data-mask="(99) 99999-9999"
			data-parsley-required-message="Preencha este campo"
			value="<?=$telefone;?>">

			<br>
			<label for="celular">Celular:</label>
			<input type="text" name="celular" required
			class="form-control" data-mask="(99) 99999-9999"
			data-parsley-required-message="Preencha este campo"
			value="<?=$celular;?>">

			<br>
			<label for="email">E-mail:</label>
			<input type="email" name="email" required
			class="form-control"
			data-parsley-required-message="Preencha este campo"
			value="<?=$email;?>">

			<br>
			<label for="senha">Senha:</label>
			<input type="password" name="senha" id="senha" required
			class="form-control"
			data-parsley-required-message="Preencha este campo">

			<br>
			<label for="redigite">Redigite a Senha:</label>
			<input type="password" name="redigite" required
			class="form-control"
			data-parsley-required-message="Preencha este campo">

			<br>
			<label for="cep">CEP:</label>
			<input type="text" name="cep" required data-mask"99999-999"
			class="form-control"
			data-parsley-required-message="Preencha este campo"
			value="<?=$cep;?>">

			<br>
			<label for="endereco">Endereço:</label>
			<input type="text" name="endereco" id="endereco" required
			class="form-control"
			data-parsley-required-message="Preencha este campo"
			value="<?=$endereco;?>">

			<br>
			<label for="complemento">Complemento:</label>
			<input type="text" name="complemento" id="complemento"
			class="form-control"
			value="<?=$complemento;?>">

			<br>
			<label for="bairro">Bairro:</label>
			<input type="text" name="bairro" id="bairro" required
			class="form-control"
			data-parsley-required-message="Preencha este campo"
			value="<?=$bairro;?>">

			<div class="row">
				<div class="col-12 col-md-8">

				</div>
				<div class="col-12 col-md-4" id="cidades">

				</div>
			</div>

			<br>
			<label for="foto">Foto:</label>
			<input type="file" name="bairro" 
			class="form-control">


			<br>
			<button type="submit" class="btn btn-success">
				<i class="fas fa-check"></i> Gravar
			</button>

		</form>

	</div>
</div>

<script type="text/javascript">
	function validaCpf(cpf){
		$.get("validacpf.php",{cpf:cpf}, function(dados){
			if ( dados !=1 ){
				//mensagem de erro
				alert(dados);
				//apagar o cpf
				$("#cpf").val(""); 
			}
		})
	}
</script>
