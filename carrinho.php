<?php
session_start();
?>
<?php
error_reporting(0);
require_once 'conexaoBanco.php';


  if(!isset($_SESSION['itens'])){
	  $_SESSION['itens'] = array();
	  
  }
   if(isset($_GET['add']) && $_GET['add'] == "carrinho"){
	   $id = $_GET['codProduto'];
	   if(!isset($_SESSION['itens'][$id])){
		    $_SESSION['itens'][$id] = 1;
	   }else{
			$_SESSION['itens'][$id] += 1;
		}
   }
      
	?>  
	
	<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>Carrinho</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</head>



 <style>
 body {margin-left: 100px; margin-top: 40px; margin-right: 100px;}

	
 </style>
<body>

  <div id="containerHeader" class="container">
	 <h2> Produtos Selecionados: </h2>
  <a href="sair.php" ><button  class="btn btn-info" id="Sair5" >Sair</button></a>
  <a href="telaMenu.php" ><button class="btn btn-info" id="voltaMenut" >Menu</button></a>
    <a href="carrinho.php" ><button class="btn btn-warning" id="voltaMenut" >Limpar Tela</button></a>
	
	</div>
	<hr><br>




	<div class="container">
		<div class="">
			 <div class="card-body">
	    		<a href="selectProd.php">Lista de Produtos</a>
	    	</div>
		</div>

		<?php
		if(count($_SESSION['itens']) == 0 ){?>
	   <label>Carrinho Vazio -> <a href="selectProd.php"> Adicionar Itens</a></label><br>
	<?php	
	}else{ 
	
	  
		$_SESSION['dados'] = array();
		
		
	?>

			<table class="table table-strip">
				<thead>
					<tr>
						<th>Produto</th>
						<th>Descricao</th>
						<th>Quantidade</th>
						<th>Preço</th>
						<th>Subtotal</th>
						<th>Adicionar</th>
						<th>Remover</th>
 
					</tr>				
				</thead>
				<tbody>
				
				
				
       <?php
				  foreach($_SESSION['itens'] as $id => $quantidade){
		  $select = $conexao->prepare("SELECT * FROM produto where codProduto = $id");
          $select->execute();
          $produtos = $select->fetchAll();
		 $total = $quantidade * $produtos[0]['valor_produto']; //?? null;
		 $totalGeral = $totalGeral +  $total;
		 
		 
		     $produtos[0]['nome_produto'].'<br/>
			Tipo: '.$produtos[0]['tipo_produto'].'<br/>
			Descricao: '.$produtos[0]['descricao_produto'].'<br/>
			Fornecedor: '.$produtos[0]['codFornecedor'].'<br/>
			Estoque: '.$produtos[0]['quantidade_disponivel'].'<br/>
			  Preco Unitario: '.number_format($produtos[0]['valor_produto'],2,",","."). '<br/>
			  Quantidade: '.$quantidade. '<br/>
			  Preco Total: '.number_format($total,2,",","."). '<br/>
			  total Geral: '.number_format($totalGeral,2,",","."). '<br/>
			 
			  //<a href="removeProd.php?removeProd=carrinho&codProduto='.$id.'">Deleta</a>
			  
			  <hr/>
			  ';
			  $codCliente=0;
			  $id_func =100;
			 
			 
			  array_push(
			  $_SESSION['dados'], 
			  array(
			 
			 'quantidade_pedido' => $quantidade,
			   'valor_produto' => $produtos[0]['valor_produto'], 
			   'codProduto' => $id,
			    'codCliente' => $codCliente,
				'id_func' => $id_func,
				'val_pedido' => $total,
				'Estoque'=>$produtos[0]['quantidade_disponivel'],
		        'total_geral'=>$totalGeral
			
			  )
			  );
			  
	  
				  ?>
					<tr>
						
						<td><?php echo  $produtos[0]['nome_produto']?></td>
						<td><?php echo  $produtos[0]['descricao_produto']?></td>
						<td><?php echo $quantidade ?></td>
						<td>R$<?php echo number_format($produtos[0]['valor_produto'], 2, ',', '.')?></td>
						<td>R$<?php echo number_format($total, 2, ',', '.')?></td>
					    <td><a href="removeProd.php?addProd=carrinho&codProduto=<?php echo $produtos[0]['codProduto'] ?>" class="btn btn-success"> + </a></td>
						<td><a href="removeProd.php?removeProd=carrinho&codProduto=<?php echo $produtos[0]['codProduto'] ?>" class="btn btn-danger"> - </a></td>
						
					
					</tr>
				
				 <?php } 
				
		  
				 ?>
				 <tr>
				 	<td colspan="3" class="text-right"><b>Total: </b></td>
					<td>R$<?php echo number_format($totalGeral, 2, ',', '.')?></td>
				 	
				 	<td></td>
				 </tr>
				
				</tbody>
				
			</table>
	<?php } 

	
	?>
	        <br>
			<a class="btn btn-info" href="selectProd.php">Continuar Comprando</a>
			<a class="btn btn-primary" href="selCli.php">Finalizar Pedido</a>
           
			

		
	</div>
	
</body>
</html>
