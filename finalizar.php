<?php
session_start();
 ?>
 <?php
 require_once 'conexaoBanco.php';
  //error_reporting(0);
 $codClienteAtual = $_SESSION['codClienteAtual'];
 $id_funcionario = $_SESSION['id_func'];
 
 ?>
  <!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="">
	<title>Pedidos</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/prototipo.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
         <script src="assets/js/bootstrap.js" type="text/javascript" ></script>

</head>
<style>
 body {margin-left: 100px; margin-top: 40px; margin-right: 100px;}
</style>
<body>

  <div id="containerHeader">
	 <h2> Pedidos </h2>
  <a href="sair.php" ><button  class="btn btn-info" id="Sair5" >Sair</button></a>
   <a href="selectProd.php" ><button class="btn btn-info" id="selectProd" >Seleção Produtos</button></a>
    <a href="fatura.php" target="_blank" ><button class="btn btn-warning" >Emitir Fatura </button></a>
	</div>
	<br><br>
	

<?php
$totProds=0;
 $totGeral =0;
	if(isset($_POST['finaliza'])){
	 
          
		  $select = $conexao->prepare("select codPedido FROM pedidos ORDER BY codPedido DESC LIMIT 1");
          $select->execute();
		  $ultimoPedido = $select->fetch();
		  $ultimoPedido =$ultimoPedido[0] +1;
		  $_SESSION['pedidoAtual'] = $ultimoPedido;
   
    foreach ($_SESSION['dados'] as $item) {
     $insert = $conexao->prepare ("INSERT INTO venda (idVenda, codProduto, valor, quant_item, Total_venda) VALUES (?,?,?,?,?)");
     
	 $insert->bindParam(1, $ultimoPedido);
     $insert->bindParam(2, $item['codProduto']);
	 $insert->bindParam(3, $item['valor_produto']);
	 $insert->bindParam(4, $item['quantidade_pedido']);
	 $totProds = $item['quantidade_pedido'] * $item['valor_produto'];
	 $insert->bindParam(5,  $totProds);
	 $totGeral = $totGeral + $totProds;
	  $totProds=0;
              $insert->execute();
}


 foreach($_SESSION['dados'] as $produtos){
	$estoqueAtual= $produtos['Estoque'];
	$quantPedido = $produtos['quantidade_pedido'];
	$atualiza = $estoqueAtual - $quantPedido;
	
     if($atualiza <=0){
         unset($produtos);
	echo  "<script>alert('Estoque Indisponivel');</script>";	
		  ?><div class="alert alert-warning" role="alert"> Estoque Indisponivel! </div> <?php
		 unset($produtos);
		   exit;
	   
	  }else if($atualiza > 0){
	$prodUpdate = $produtos['codProduto'];
	$stmt = $conexao->prepare("UPDATE produto SET quantidade_disponivel = $atualiza WHERE codProduto = $prodUpdate");
        $stmt->execute();
		   ?><div class="alert alert-success" role="alert"> Compra Realizada com Sucesso </div> <?php
	echo  "<script>alert('Compra realizada com sucesso!');</script>";
			
	  }
 }
 
 //unset($_SESSION['dados']);

 
	 $insert = $conexao->prepare("INSERT INTO pedidos (idVenda, codCliente, id_func, val_pedido) VALUES (?,?,?,?)");
	 $insert->bindParam(1,$ultimoPedido);
	 $insert->bindParam(2, $codClienteAtual);
	 $insert->bindParam(3, $id_funcionario);
	 $insert->bindParam(4, $totGeral);
	 $insert->execute();
	 unset($_SESSION['dados']);
	 unset($_SESSION['itens']);
	
			?>
			

	<div class="row">
                    <div class="panel panel-default">
                        <table class="table table-striped">
                            <thead>
							
							 <tr>
                                     
                                 <th>Id Vendedor</th>
				 <th>Pedido</th>
                                 <th>Produto</th>
                                 <th>Data Venda</th>
				 <th>Valor</th>
				<th>quantidade</th>
				<th>Cliente</th>
				<th>CPF Cliente</th>
				<th>Total</th>
                        
                                </tr>
                            </thead>
                            <tbody>		

                              <?php
                                
								 try {
	 
								
       $smtp = $conexao->prepare("SELECT v.id_tblVendas, pd.codPedido, v.idVenda, l.id_func, pd.codPedido, pr.nome_produto, v.valor, v.quant_item, c.nome_cliente, c.cpf_cliente, pd.data_Pedido, v.valor, v.Total_venda, pd.val_pedido 
              FROM venda v 
              INNER JOIN pedidos pd ON (v.idVenda = pd.idVenda) 
	      INNER JOIN produto pr ON (pr.codProduto = v.codProduto) 
	      INNER JOIN loginusu l ON (pd.id_func = l.id_func) 
	      INNER JOIN cliente c ON (c.codCliente = pd.codCliente)
             where v.idVenda = $ultimoPedido");

						$smtp->execute();
						$rs= $smtp->fetchAll(PDO::FETCH_ASSOC);?>	
						<?php if(count($rs)){
						 foreach($rs as $rs){
							
                                                        ?><tr>
							 <td><?php echo $rs['id_func']; ?></td>
							<td><?php echo $rs['codPedido']; ?></td>
							<td><?php echo $rs['nome_produto']; ?></td>
							<td><?php echo $rs['data_Pedido']; ?></td>
                            <td><?php echo number_format ($rs['valor'], 2, ',', '.'); ?></td>
                           <td><?php echo $rs['quant_item']; ?></td>
                             <td><?php echo $rs['nome_cliente']; ?></td>
                             <td><?php echo $rs['cpf_cliente']; ?></td>
			    <td>R$ <?php echo number_format ($rs['val_pedido'], 2, ',', '.'); ?></td>
				        
						
												
                                                <td><center>  
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
                        <br><td  colspan="4" class="text-right"><b>Total: </b></td>
					<td>R$  <?php echo number_format ($rs['val_pedido'], 2, ',', '.'); ?></td>
					
                    </div>
		    </div>
      
			<?php } ?>

	</body>
	</html>			
	
