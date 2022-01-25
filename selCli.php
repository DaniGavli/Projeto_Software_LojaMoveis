<?php
 session_start();
 ?>
 <?php
 require_once 'conexaoBanco.php';
 ?>
 
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>Pedidos</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" />

</head>
<style>
 body {margin-left: 100px; margin-top: 40px; margin-right: 100px;}
 #final { margin-top: -148px; margin-left: 440px;}
  input {width: 400px;}
</style>
<body>

  <div id="containerHeader">
	 <h2> Dados Cliente </h2>
  <a href="sair.php" ><button  class="btn btn-info" id="Sair5" >Sair</button></a>
   <a href="selectProd.php" ><button class="btn btn-info" >Seleção Produtos</button></a>
   <a href="cadastrarCliente.php" target="_blank" ><button class="btn btn-success" >Novo Cliente</button></a>
    <a href="selCli.php" ><button class="btn btn-warning" id="voltaMenut" >Limpar Tela</button></a>

	
				
	
            
	</div>
	<br><br>

	                    <form action="" method="post">
                                <input type="text" name="pesqCli" placeholder="Informe o CPF do cliente" />
				<button type="submit" name="pesqCli2" class="btn btn-primary" />Pesquisar Cliente </button>
				 </form><br>	
							  
							  
			    <form action="finalizar.php" method="post" id="final">
	                      <button type="submit" name="finaliza" class="btn btn-primary" />Finalizar Pedido </button>
	                      </form><br><br><br><br><br>
							  
				          <?php
                             
								
						if(!isset($_POST['pesqCli'])){
							exit;
							}else{
						 ?>
						 <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>CPF</th>
                                    <th>Email</th>   
                                </tr>
                            </thead>
                            <tbody>
							
				 <?php
				
				$pesqCli = "%".trim($_POST['pesqCli'])."%";
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
					    <td><?php echo $rs['email_cliente']; ?></td>
                                            <td><center>

					<a href="selCli.php?add=selCli&codCliente=<?php echo $rs['codCliente']?>" class="btn btn-primary btn-xs" > Selecionar Cliente</a>
																		
                                        </center>
                                        </td>
                                        </tr>
                                        <?php
					$_SESSION['codClienteAtual'] = $rs['codCliente'];
	
										
										
					}
					}else{
			?><div class="alert alert-warning" role="alert"> Cliente não Localizado! </div> <?php
					
					} }   ?>
                            </tbody>
                        </table>
						
						

<?php

if(isset($_POST['add']) && $_POST['add'] == "selCli"){
	   $cli = $_POST['codCliente'];
	   if(!isset($_SESSION['codClienteAtual'][$cli])){
		  ?><div class="alert alert-warning" role="alert"> Cliente Selecionado! </div> <?php
		   echo"<script> location.replace('cadastroCliente.php'); </script>";
		  

	   }else{
			echo 'nao selecionei'; 
		unset($_SESSION['codClienteAtual']);
		}
   }
