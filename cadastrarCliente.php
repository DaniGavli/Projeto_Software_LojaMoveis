<?php
require_once 'conexaoBanco.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $codCliente = filter_input(INPUT_POST, 'codCliente');
    $nome_cliente = filter_input(INPUT_POST, 'nome_cliente');
    $cpf_cliente = filter_input(INPUT_POST, 'cpf_cliente');
    $email_cliente = filter_input(INPUT_POST, 'email_cliente');
    $telefone_cliente = filter_input(INPUT_POST, 'telefone_cliente');
    $dataNasc_cliente = filter_input(INPUT_POST, 'dataNasc_cliente');
    $endereco_cliente = filter_input(INPUT_POST, 'endereco_cliente');
    $cidade_cliente = filter_input(INPUT_POST, 'cidade_cliente');
    $cep_cliente = filter_input(INPUT_POST, 'cep_cliente');
    $estado_cliente = filter_input(INPUT_POST, 'estado_cliente');
	/*
    
*/

} else if (!isset($codCliente)) {
    $codCliente = (isset($_GET["codCliente"]) && $_GET["codCliente"] != null) ? $_GET["codCliente"] : "";
}



if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $nome_cliente != "") {
    try {
        if ($codCliente != "") {
            $stmt = $conexao->prepare("UPDATE cliente SET nome_cliente=?, cpf_cliente=?,email_cliente=?, telefone_cliente=?, dataNasc_cliente=?, endereco_cliente=?, cidade_cliente=?, cep_cliente=?, estado_cliente=? WHERE codCliente = ?");
            $stmt->bindParam(10, $codCliente);
        } else {
            $stmt = $conexao->prepare("INSERT INTO cliente (nome_cliente, cpf_cliente, email_cliente, telefone_cliente, dataNasc_cliente, endereco_cliente, cidade_cliente, cep_cliente, estado_cliente) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        }
        $stmt->bindParam(1, $nome_cliente);
        $stmt->bindParam(2, $cpf_cliente);
        $stmt->bindParam(3, $email_cliente);
        $stmt->bindParam(4, $telefone_cliente);
        $stmt->bindParam(5, $dataNasc_cliente);
        $stmt->bindParam(6, $endereco_cliente);
        $stmt->bindParam(7, $cidade_cliente);
        $stmt->bindParam(8, $cep_cliente);
        $stmt->bindParam(9, $estado_cliente);

        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                echo "<p class=\"bg-success\">Dados cadastrados com sucesso!</p>";
                $codCliente = null;
                $nome_cliente = null;
                $cpf_cliente = null;
                $email_cliente = null;
                $telefone_cliente = null;
                $dataNasc_cliente = null;
                $endereco_cliente = null;
                $cidade_cliente = null;
                $cep_cliente = null;
                $estado_cliente = null;
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


if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $codCliente != "") {
    try {
        $stmt = $conexao->prepare("SELECT * FROM cliente WHERE codCliente = ?");
        $stmt->bindParam(1, $codCliente, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $rs = $stmt->fetch(PDO::FETCH_OBJ);
            $codCliente = $rs->codCliente;
            $nome_cliente = $rs->nome_cliente;
            $cpf_cliente = $rs->cpf_cliente;
            $email_cliente = $rs->email_cliente;
            $telefone_cliente = $rs->telefone_cliente;
            $dataNasc_cliente = $rs->dataNasc_cliente;
            $endereco_cliente = $rs->endereco_cliente;
            $cidade_cliente = $rs->cidade_cliente;
            $cep_cliente = $rs->cep_cliente;
            $estado_cliente = $rs->estado_cliente;
			
			
        } else {
            echo "<p class=\"bg-danger\">Erro: Não foi possível executar a declaração sql</p>";
        }
    } catch (PDOException $erro) {
        echo "<p class=\"bg-danger\">Erro: " . $erro->getMessage() . "</p>";
    }
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $codCliente != "") {
    try {
        $stmt = $conexao->prepare("DELETE FROM cliente WHERE codCliente = ?");
        $stmt->bindParam(1, $codCliente, PDO::PARAM_INT);
        if ($stmt->execute()) {
            echo "<p class=\"bg-success\">Registo foi excluído com êxito</p>";
            $codCliente = null;
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
        <title>Clientes</title>
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
	 <h2> Cadastrar Clientes </h2>
  <a href="sair.php" ><button  class="btn btn-info" id="Sair5" >Sair</button></a>
  <a href="telaMenu.php" ><button class="btn btn-info" id="voltaMenut" >Menu</button></a>
    <a href="cadastrarCliente.php" ><button class="btn btn-warning" id="voltaMenut" >Limpar Tela</button></a>
	


	<form class="form-inline" id="pesq" action="cadastrarCliente.php" method="GET">
	<div class="form-group mx-sm-3 mb-2">
	<label  class="sr-only"></label>
	 <input  type="text" class="form-control" name="pesqCli" />
	  </div>
	 <button type="submit" name="pesqCli2" class="btn btn-primary mb-2" />Pesquisar </button>
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

                                <input type="hidden" name="codCliente" value="<?php
                               
                                echo (isset($codCliente) && ($codCliente != null || $codCliente != "")) ? $codCliente : ''; ?>" />
								
                                <div class="form-group">
                                    <label for="nome_cliente" class="col-md-1 control-label">Nome:</label>
                                    <div class="col-md-5">
                                        <input type="text" name="nome_cliente" class="form-control input-md" value="<?php
                                        echo (isset($nome_cliente) && ($nome_cliente != null || $nome_cliente != "")) ? $nome_cliente : '';
                                        ?>" />
										
                                    </div>
                                    <label for="cpf_cliente" class="col-md-2 control-label" >CPF:</label>
                                    <div  class="col-md-3">
                                        <input type="text" name="cpf_cliente" class="form-control input-md" value="<?php
                                        echo (isset($cpf_cliente) && ($cpf_cliente != null || $cpf_cliente != "")) ? $cpf_cliente : '';
                                        ?>"  />
										
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="endereco_cliente" class="col-md-1 control-label">Endereço:</label>
                                    <div class="col-md-5">
                                        <input type="text" name="endereco_cliente" class="form-control input-md" value="<?php
                                        echo (isset($endereco_cliente) && ($endereco_cliente != null || $endereco_cliente != "")) ? $endereco_cliente : '';
                                        ?>"  />
										
                                    </div>
                                    <label for="cidade_cliente" class="col-md-2 control-label">Cidade:</label>
                                    <div class="col-md-3">
                                        <input type="text" name="cidade_cliente" class="form-control input-md" value="<?php
                                        echo (isset($cidade_cliente) && ($cidade_cliente != null || $cidade_cliente != "")) ? $cidade_cliente : '';
                                        ?>"  />
										
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="cep_cliente" class="col-md-1 control-label">Cep:</label>
                                    <div class="col-md-2">
                                        <input type="text" name="cep_cliente" class="form-control input-md" value="<?php
                                        echo (isset($cep_cliente) && ($cep_cliente != null || $cep_cliente != "")) ? $cep_cliente : '';
                                        ?>"  />
										
                                    </div>
                                    <label for="estado_cliente" class="col-md-1 control-label" >Estado:</label>
                                    <div class="col-md-2">
                                        <input type="text" name="estado_cliente" class="form-control input-md" value="<?php
                                        echo (isset($estado_cliente) && ($estado_cliente != null || $estado_cliente != "")) ? $estado_cliente : '';
										?>" />
										
                                    </div>
                                    <label for="dataNasc_cliente" class="col-md-1 control-label">Data Nascimento:</label>
                                    <div class="col-md-4">
                                        <input type="date" name="dataNasc_cliente" class="form-control input-md" value="<?php
                                        echo (isset($dataNasc_cliente) && ($dataNasc_cliente != null || $dataNasc_cliente != "")) ? $dataNasc_cliente : '';
                                        ?>" />
										
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email_cliente" class="col-md-1 control-label">Email:</label>
                                    <div class="col-md-5">
                                        <input type="text" name="email_cliente" class="form-control input-md" value="<?php
                                        echo (isset($email_cliente) && ($email_cliente != null || $email_cliente != "")) ? $email_cliente : '';
                                    ?>"  /> 
									
                                    </div>
                                    <label for="telefone_cliente" class="col-md-1 control-label">Telefone:</label>
                                    <div class="col-md-5">
                                        <input type="text" name="telefone_cliente" class="form-control input-md" value="<?php 
                                        echo (isset($telefone_cliente) && ($telefone_cliente != null || $telefone_cliente != "")) ? $telefone_cliente : '';
                                        ?>" />
										
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
                                    <th>Nome</th>
                                    <th>CPF</th>
									 <th>Endereço</th>
                                    <th>Cidade</th>
                                    <th>Cep</th>
									 <th>Dt Nascimento</th>
                                    <th>Email</th>
                                    <th>Telefone</th>
                                   
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <?php
								 try {
								 if(!isset($_GET['pesqCli'])){
									
									 exit;
								 }
								 
								 $pesqCli = "%".trim($_GET['pesqCli'])."%";
							
								 $smtp = $conexao->prepare("SELECT * FROM `cliente` where `cpf_cliente` like :pesqCli");
                                 $smtp->bindValue(':pesqCli', $pesqCli, PDO::PARAM_STR);
								 $smtp->execute();
								 $rs= $smtp->fetchAll(PDO::FETCH_ASSOC);
									?>	
					
									<?php

					if(count($rs)){
						foreach($rs as $rs){
							
                                            ?><tr>
											    
                                                <td><?php echo $rs['nome_cliente']; ?></td>
                                                <td><?php echo $rs['cpf_cliente']; ?></td>
                                                <td><?php echo $rs['endereco_cliente']; ?></td>
                                                <td><?php echo $rs['cidade_cliente']; ?></td>
                                                <td><?php echo $rs['cep_cliente']; ?></td>
                                                <td><?php echo $rs['dataNasc_cliente']; ?></td>
												 <td><?php echo $rs['email_cliente']; ?></td>
                                                <td><?php echo $rs['telefone_cliente']; ?></td>
                                                <td><center>
                                            <a href="?act=upd&codCliente=<?php echo $rs['codCliente']; ?> " class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil"></span> Editar</a>
                                            <a href="?act=del&codCliente=<?php echo $rs['codCliente']; ?>" class="btn btn-danger btn-xs" ><span class="glyphicon glyphicon-remove"></span> Excluir</a>
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
