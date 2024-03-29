<?php
    //iniciar a sessão
    session_start();

	//verificar se o arquivo existe
	if ( file_exists ( "verificalogin.php" ) )
		include "verificalogin.php";
	else
        include "../verificalogin.php";
        
    $id = "";
    if (   isset  (  $_GET["id"]    )   )
        $id  =   trim( $_GET["id"] );

    if  ( isset   (   $_POST["id"]    )   )
        $id =   trim(   $_POST["id"]    );

    //echo $id;
    //verificar se o id está em branco
    if( empty   (   $id )   )   {
        echo "<script>alert('Erro ao gravar a informação');</script>";
    }
    //incluir a conexão com o banco
    include "../config/conexao.php"; 
    include "../config/funcoes.php"; 
    
    //verificar se foi enviado algo por post
    //salver o registro no banco de dados
    if  ( $_POST ){
        $personagem_id = trim ( $_POST["personagem_id"] );

        //verificar se existe este personagem no quadrinho
        $sql = "select * from quadrinho_personagem where quadrinho_id = :quadrinho and personagem_id = :personagem limit 1";
        $consulta = $pdo->prepare($sql); 
        $consulta->bindValue(":quadrinho", $id);
        $consulta->bindValue(":personagem", $personagem_id);
        $consulta->execute();

        //pegar os dados
        $dados = $consulta->fetch(PDO::FETCH_OBJ);

        //verificar se trouxe algum dado
        if  (   !empty($dados->personagem_id    )   )   {
            mensagem("Já existe um personagem cadastrado neste quadrinho");
        }else{
            //gravar o personagem e o quadrinho no banco
            $sql = "insert into quadrinho_personagem (quadrinho_id, personagem_id) values (:quadrinho, :personagem)";
            $consulta = $pdo->prepare($sql); 
            $consulta->bindValue(":quadrinho", $id);
            $consulta->bindValue(":personagem", $personagem_id);

            if (    $consulta->execute())   {

                $link = "salvarpersonagem.php?id=$id";
                
                sucesso("Personagem salvo",$link);

            }else{

                //$erro = $consulta->erroInfo();
                //print_r($erro);
                
                $link = "salvarpersonagem.php?id=$id";
            
                sucesso("Erro ao inserir personagem",$link);

            }
        }
    }

    //selecionar todos os personagens deste quadrinho]
    $sql = "select p.nome, qp.quadrinho_id, qp.personagem_id from quadrinho_personagem qp
         inner join personagem p on ( p.id = qp.personagem_id )
         where qp.quadrinho_id = :quadrinho
         order by p.nome";
    $consulta = $pdo->prepare($sql);
    $consulta->bindValue(":quadrinho",$id,PDO::PARAM_INT);
    $consulta->execute();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Adicionar Personagens</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/all.min.css">
    </head>
    <body>
        <table class="table table-bordered table-striped table-hover"> 
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Nome do Personagem</td>
                    <td>Excluir</td>
                </tr> 
            </thead>
            <?php
                //mostrar os resultados
                while ( $dados = $consulta->fetch(PDO::FETCH_OBJ)){
                    $nome           =$dados->nome;
                    $quadrinho_id   =$dados->quadrinho_id;
                    $personagem_id  =$dados->personagem_id;
                    echo "<tr>
                            <td>$personagem_id</td>
                            <td>$nome</td>
                            <td>
                                <a href='javascript:excluir($quadrinho_id, $personagem_id)' class='btn btn-danger'>
                                    <i class='fas fa-trash'></i>
                                </a>    
                            </td>
                        </tr>";
                }
            ?>
        </table>
        <script type="text/javascript">
            //funcão para excluir
            function excluir(quadrinho_id, personagem_id){
                if( confirm ( "Deseja mesmo excluir?")){
                    //enviar para uma página para excluir
                    location.href='../excluir/quadrinho-personagem/'+quadrinho_id+'/'+personagem_id;
                }
            }
        </script>
    </body>
</html>

