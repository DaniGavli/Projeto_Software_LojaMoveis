<?php
 require_once 'conexaoBanco.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $codProduto = filter_input(INPUT_POST, 'codProduto');
    $nome_produto = filter_input(INPUT_POST, 'nome_produto');
    $tipo_produto = filter_input(INPUT_POST, 'tipo_produto');
    $descricao_produto = filter_input(INPUT_POST, 'descricao_produto');
    $imagem_produto = filter_input(INPUT_POST, 'imagem_produto');
    $codFornecedor = filter_input(INPUT_POST, 'codFornecedor');
    $quantidade_disponivel = filter_input(INPUT_POST, 'quantidade_disponivel');
    $valor_produto = filter_input(INPUT_POST, 'valor_produto');
    $dataEntrada_produto = filter_input(INPUT_POST, 'dataEntrada_produto');
 
	/*
    
*/

} else if (!isset($codProduto)) {
    $codProduto = (isset($_GET["codProduto"]) && $_GET["codProduto"] != null) ? $_GET["codProduto"] : "";
}



if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $nome_produto != "") {
    try {
        if ($codProduto != "") {
            $stmt = $conexao->prepare("UPDATE produto SET nome_produto=?, tipo_produto=?,descricao_produto=?, imagem_produto=?, codFornecedor=?, quantidade_disponivel=?, valor_produto=?, dataEntrada_produto=? WHERE codProduto = ?");
            $stmt->bindParam(9, $codProduto);
        } else {
            $stmt = $conexao->prepare("INSERT INTO produto (nome_produto, tipo_produto, descricao_produto, imagem_produto, codFornecedor, quantidade_disponivel, valor_produto, dataEntrada_produto) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?)");
        }
       $stmt->bindParam(1, $nome_produto);
        $stmt->bindParam(2, $tipo_produto);
        $stmt->bindParam(3, $descricao_produto);
        $stmt->bindParam(4, $imagem_produto);
        $stmt->bindParam(5, $codFornecedor);
        $stmt->bindParam(6, $quantidade_disponivel);
        $stmt->bindParam(7, $valor_produto);
        $stmt->bindParam(8, $dataEntrada_produto);
       

        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                echo "<p class=\"bg-success\">Dados cadastrados com sucesso!</p>";
                $codProduto = null;
                $nome_produto = null;
                $tipo_produto = null;
                $descricao_produto = null;
                $imagem_produto = null;
                $codFornecedor = null;
                $quantidade_disponivel = null;
                $valor_produto = null;
                $dataEntrada_produto = null;
    
                
            } else {
                echo "<p class=\"bg-danger\">Erro ao tentar efetivar cadastro</p>";
            }
        } else {
            echo "<p class=\"bg-danger\">Erro: Não foi possível executar a declaração sql</p>";
        }
    } catch (PDOException $erro) {
        echo "<p class=\"bg-danger\">Erro: " . $erro->getMessage() . "</p>";
    }
}


if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $codProduto != "") {
    try {
        $stmt = $conexao->prepare("SELECT * FROM produto WHERE codProduto = ?");
        $stmt->bindParam(1, $codProduto, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            $rs = $stmt->fetch(PDO::FETCH_OBJ);
            $codProduto = $rs->codProduto;
            $nome_produto = $rs->nome_produto;
            $tipo_produto = $rs->tipo_produto;
            $descricao_produto = $rs->descricao_produto;
            $imagem_produto = $rs->imagem_produto;
            $codFornecedor = $rs->codFornecedor;
            $quantidade_disponivel = $rs->quantidade_disponivel;
            $valor_produto = $rs->valor_produto;
            $dataEntrada_produto = $rs->dataEntrada_produto;
			
			
        } else {
            echo "<p class=\"bg-danger\">Erro: Não foi possível executar a declaração sql</p>";
        }
    } catch (PDOException $erro) {
        echo "<p class=\"bg-danger\">Erro: " . $erro->getMessage() . "</p>";
    }
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $codProduto != "") {
    try {
        $stmt = $conexao->prepare("DELETE FROM produto WHERE codProduto = ?");
        $stmt->bindParam(1, $codProduto, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            echo "<p class=\"bg-success\">Registo foi excluído com êxito</p>";
            $codProduto = null;
        } else {
            echo "<p class=\"bg-danger\">Erro: Não foi possível executar a declaração sql</p>";
        }
    } catch (PDOException $erro) {
        echo "<p class=\"bg-danger\">Erro: " . $erro->getMessage() . "</a>";
    }
}



?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge" >
        <title>Cadastro Produtos</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    </head>
	
	<style>
	 body {margin-left: 100px; margin-top: 40px; margin-right: 100px;}
	#pesq {margin-left: 280px; margin-top: -38px;}
	</style>
    <body>
	
	<div id="containerHeader" class="container">
	 <h2> Cadastrar Produtos </h2>
  <a href="sair.php" ><button  class="btn btn-info" id="Sair5" >Sair</button></a>
  <a href="telaMenu.php" ><button class="btn btn-info" id="voltaMenut" >Menu</button></a>
    <a href="cadastroProduto.php" ><button class="btn btn-warning" id="voltaMenut" >Limpar Tela</button></a>
	


	<form class="form-inline" id="pesq" action="cadastroProduto.php" method="GET">
	<div class="form-group mx-sm-3 mb-2">
	<label  class="sr-only"></label>
	 <input  type="text" class="form-control" name="pesqProd" />
	  </div>
	 <button type="submit" name="pesqCli2" class="btn btn-primary mb-2" />Pesquisar Produto </button>
						</form>
<hr>
</div><br>
	
        <div class="container">
            <header class="row">
                <br />
            </header>
            <article>
                <div class="row align-items-start">
                    <form action="?act=save" method="POST" name="form1" class="form-horizontal" >
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <span class="panel-title"></span><br>
                            </div>
                            <div class="panel-body">

                                <input type="hidden" name="codProduto" value="<?php
                               
                                echo (isset($codProduto) && ($codProduto != null || $codProduto != "")) ? $codProduto : ''; ?>" />
								
                                <div class="form-group">
                                    <label for="nome_produto" class="col-md-1 control-label">Produto:</label>
                                    <div class="col-md-5">
                                        <input type="text" name="nome_produto" class="form-control input-md" value="<?php
                                        echo (isset($nome_produto) && ($nome_produto != null || $nome_produto != "")) ? $nome_produto : '';
                                        ?>" />
										
                                    </div>
                                    <label for="tipo_produto" class="col-md-2 control-label" >Categoria:</label>
                                    <div  class="col-md-3">
                                        <input type="text" name="tipo_produto" class="form-control input-md" value="<?php
                                        echo (isset($tipo_produto) && ($tipo_produto != null || $tipo_produto != "")) ? $tipo_produto : '';
                                        ?>"  />
										
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="descricao_produto" class="col-md-1 control-label">Descrição:</label>
                                    <div class="col-md-10">
                                        <input type="text" name="descricao_produto" class="form-control input-md" value="<?php
                                        echo (isset($descricao_produto) && ($descricao_produto != null || $descricao_produto != "")) ? $descricao_produto : '';
                                        ?>"  />
										
                                    </div>
                                   

                                </div>
                                <div class="form-group">
                                    <label for="imagem_produto" class="col-md-1 control-label">URL Imagem:</label>
                                    <div class="col-md-3">
                                        <input type="text" name="imagem_produto" class="form-control input-md" value="<?php
                                        echo (isset($imagem_produto) && ($imagem_produto != null || $imagem_produto != "")) ? $imagem_produto : '';
                                        ?>"  />
										
                                    </div>
                                    <label for="codFornecedor" class="col-md-1 control-label" >Cod Fornecedor:</label>
                                    <div class="col-md-1">
                                        <input type="text" name="codFornecedor" class="form-control input-md" value="<?php
                                        echo (isset($codFornecedor) && ($codFornecedor != null || $codFornecedor != "")) ? $codFornecedor : '';
										?>" />
										
                                    </div>
                                    <label for="quantidade_disponivel" class="col-md-1 control-label">Quantidade:</label>
                                    <div class="col-md-2">
                                        <input type="text" name="quantidade_disponivel" class="form-control input-md" value="<?php
                                        echo (isset($quantidade_disponivel) && ($quantidade_disponivel != null || $quantidade_disponivel != "")) ? $quantidade_disponivel : '';
                                        ?>" />
										
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="valor_produto" class="col-md-1 control-label">Preço :</label>
                                    <div class="col-md-2">
                                        <input type="text" name="valor_produto" class="form-control input-md" value="<?php
                                        echo (isset($valor_produto) && ($valor_produto != null || $valor_produto != "")) ? $valor_produto : '';
                                    ?>"  /> 
									
                                    </div>
									<label for="dataEntrada_produto" class="col-md-2 control-label">Data Entrada:</label>
                                    <div class="col-md-3">
                                        <input type="date" name="dataEntrada_produto" class="form-control input-md" value="<?php
                                        echo (isset($dataEntrada_produto) && ($dataEntrada_produto != null || $dataEntrada_produto != "")) ? $dataEntrada_produto : '';
                                        ?>"  />
										
                                    </div>
                                
                                </div>
                            </div>
							

                            <div class="panel-footer">
                                <div class="clearfix">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary" /><span class="glyphicon glyphicon-ok"></span> salvar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
				<br><hr>
				
				<div class="panel-body">
			
                <div class="row">
                    <div class="panel panel-default">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Produto</th>
                                    <th>Categoria</th>
									 <th>Descrição</th>
                                   <th>imagem</th>
									 <th>Fornecedor</th>
                                    <th>Quantidade</th>
                                    <th>Valor</th>
									 <th>Data Entrada</th>
                                   
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <?php
								 try {
								 if(!isset($_GET['pesqProd'])){
									
									 exit;
								 }
								 
								 $pesqProd = "%".trim($_GET['pesqProd'])."%";
							
								 $smtp = $conexao->prepare("SELECT v.*, f.nome_fornecedor
								  FROM produto v 
								  INNER JOIN fornecedor f ON (v.codFornecedor = f.codFornecedor) 
								   where v.nome_produto like :pesqProd");
								 
                                 $smtp->bindValue(':pesqProd', $pesqProd, PDO::PARAM_STR);
								 $smtp->execute();
								 $rs= $smtp->fetchAll(PDO::FETCH_ASSOC);
									?>	
					
									<?php

					if(count($rs)){
						foreach($rs as $rs){
							
                                            ?><tr>
											    
                                                <td><?php echo $rs['nome_produto']; ?></td>
                                                <td><?php echo $rs['tipo_produto']; ?></td>
                                                <td><?php echo $rs['descricao_produto']; ?></td>
                                                <td><?php echo '<img height="230" width="230" src="'.$rs['imagem_produto'].'">';?> </td>
                                                <td><?php echo $rs['nome_fornecedor']; ?></td>
												 <td><?php echo $rs['quantidade_disponivel']; ?></td>
                                                <td><?php echo $rs['valor_produto']; ?></td>
												 <td><?php echo $rs['dataEntrada_produto']; ?></td>
                                                <td><center>
                                            <a href="?act=upd&codProduto=<?php echo $rs['codProduto']; ?> " class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil"></span> Editar</a>
                                            <a href="?act=del&codProduto=<?php echo $rs['codProduto']; ?>" class="btn btn-danger btn-xs" ><span class="glyphicon glyphicon-remove"></span> Excluir</a>
                                        </center>
                                        </td>
                                        </tr>
										
					
                                        <?php
					}}
                                
                            } catch (PDOException $erro) {
                                echo "Erro: " . $erro->getMessage();
                            }

                            ?>
							
							
			
							
                            </tbody>
                        </table>
                    </div>
                </div>
            </article>
        </div>
    </body>
</html>

