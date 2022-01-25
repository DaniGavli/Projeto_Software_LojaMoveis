<?php
session_start();
?>
<?php
require_once 'conexaoBanco.php';

 $select = $conexao->prepare("SELECT * FROM produto");
 $select->execute();
 $fetch = $select->fetchAll();
 
 ?>
 <!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="">
	<title>Carrinho de Compras</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" />

</head>
<style>
 body {margin-left: 100px; margin-top: 40px; margin-right: 100px;}
 #inp {width: 300px;}
 #pesq {margin-left: 350px; margin-top: -38px;
     
 }
</style>
<body>

  <div id="containerHeader">
	 <h2> Busca Produtos </h2>
  <a href="sair.php" ><button  class="btn btn-info" id="Sair5" >Sair</button></a>
  <a href="telaMenu.php" ><button class="btn btn-info" id="voltaMenut" >Menu</button></a>
  <a href="selectProd.php" ><button class="btn btn-warning" id="voltaMenut" >Limpar Tela</button></a>
  <a href="carrinho.php" > <button type="button" class="btn btn-primary"> Carrinho <span class="badge badge-light"></span></button></a>
	 
	 	<form class="form-inline" id="pesq" action="" method="GET">
	<div class="form-group mx-sm-3 mb-2">
	<label  class="sr-only"></label>
	 <input  type="text" class="form-control" id="inp" name="pesqProduto" placeholder="Informe o nome do produto" />
	</div>
	<button type="submit" name="pesquisa" class="btn btn-primary mb-1" />Pesquisar Produtos </button>
		</form>
	
	</div>
	<hr><br>
	

						
                <div class="row">
                    <div class="panel panel-default">
                        <table class="table table-striped">
 
                        <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Tipo</th>
				    <th>Descricao</th>
                                    <th>Fornercedor</th>
                                    <th>Estoque</th>
				  <th>Valor</th>
                                   
                                   
                                </tr>
                            </thead>
				<tbody>
				<?php
                              if(!isset($_GET['pesqProduto'])){
				exit;
				 }else{				
			      $pesqProduto = "%".trim($_GET['pesqProduto'])."%";
			      $smtp = $conexao->prepare("SELECT * FROM `produto` where `nome_produto` like :pesqProduto");
                               $smtp->bindValue(':pesqProduto', $pesqProduto, PDO::PARAM_STR);
			       $smtp->execute();
			    $rs= $smtp->fetchAll(PDO::FETCH_ASSOC);
							
				?><?php

	               if(count($rs)){
		      foreach($rs as $rs){
                       ?><tr>
											    
                        <td><?php echo $rs['nome_produto']; ?></td>
                        <td><?php echo $rs['tipo_produto']; ?></td>
			<td><?php echo $rs['descricao_produto']; ?></td>
                        <td><?php echo $rs['codFornecedor']; ?></td>
                        <td><?php echo $rs['quantidade_disponivel']; ?></td>
                        <td><?php echo 'R$ ' .number_format($rs['valor_produto'],2,",","."); ?></td> 
                        <td><center>
                        
			<a href="carrinho.php?add=carrinho&codProduto=<?php echo $rs['codProduto']?>" class="btn btn-primary btn-xs"> Adicionar Produto</a>
						 
						
                                            
                                        </center>
                                        </td>
                                        </tr>
                <?php
				} }}?>
			</tbody>
                      </table>
                <?php
										
 
  
  
               

 ?></div>
   </div>
        <br><br>
               </body>
		</html>
