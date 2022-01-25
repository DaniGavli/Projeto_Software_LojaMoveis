<?php

require_once 'conexaoBanco.php';
session_start(); 

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge" >
        <title>Clientes</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
      
    </head>
	
	<style>
	body {margin-left: 100px; margin-top: 40px; margin-right: 100px;}
        #some{display: none;}
	
	
	
	</style>
    <body>
	
     <div id="containerHeader">
	 <h2> Relatorio Vendas: </h2>
  <a href="sair.php" ><button  class="btn btn-info" id="Sair5" >Sair</button></a>
  <a href="telaMenu.php"><button class="btn btn-info" id="voltaMenut" >Menu</button></a>
  <a href="relatorioVendas.php" ><button class="btn btn-warning" id="voltaMenut" >Limpar Tela</button></a>
  <button type="submit" name="exibe" onclick="Mudarestado('some')" class="btn btn-success" id="btnEstoque"> Vendas Geral</button>
  <a href="RelGeralVendasPDF.php"><button class="btn btn-inverse" id="voltaMenut" >Imprimir Relatorio</button></a>
	</div>
	<hr><br>
	<form action="relatorioVendas.php" method="GET">
                        <label> Consulta por Vendedor <input type="text" name="pesqVenda" /></label> 
			<label> Data Inicial <input type="date" name="dtInicial" size="10" ></label>
                         <label> Data Final <input type="date" name="dtFinal" size="10"  ></label>
			<button type="submit" name="pesqVenda2" class="btn btn-primary" />Pesquisar </button>
			<br>
			</form>	 <br><hr><br><br>
				
				
				
			  <script>
function Mudarestado(el) {
  var display = document.getElementById(el).style.display;
    document.getElementById(el).style.display = 'block';

}
</script>	

         		            <article>
            
				<br>
				<?php
				$date = date('Y/m/d');
                 ?>
		
	
	
	<div  id="some">
	<table class="table table-striped">
                            <thead>
                                <tr> 
				<th> ID Vendedor</th>
                                <th>Nome Vendedor</th>
				<th>Cod Pedido</th>
				<th>Nome Produto</th>
                                 <th>Data Venda</th>
                                  <th>Valor Unitario</th>
				<th>Quantidade</th>
				<th>Valor total</th>   
                                </tr>
                            </thead>
                            <tbody>
							
							
							

	<?php 
	
	try {
	
	 $stmt = $conexao->prepare("SELECT v.id_tblVendas, v.idVenda, l.id_func, l.nome_func, pd.codPedido, pr.nome_produto, v.valor, v.quant_item, c.nome_cliente, c.cpf_cliente, pd.data_Pedido, v.Total_venda 
               FROM venda v 
              INNER JOIN pedidos pd ON (v.idVenda = pd.idVenda) 
			  INNER JOIN produto pr ON (pr.codProduto = v.codProduto) 
			  INNER JOIN loginusu l ON (pd.id_func = l.id_func) 
			  INNER JOIN cliente c ON (c.codCliente = pd.codCliente)");
                               if( $stmt->execute()){
                                       while($rs = $stmt->fetch(PDO::FETCH_ASSOC)){

                                         ?>
											<tr>
											    <td><?php  echo $rs['id_func'];?></td>
                                                <td><?php  echo $rs['nome_func']; ?></td>
												<td><?php  echo $rs['codPedido'];?></td>
												<td><?php  echo $rs['nome_produto']; ?></td>
												<td><?php  echo $rs['data_Pedido']; ?></td>
                                                <td><?php  echo $rs['valor'];?></td>
                                                <td><?php  echo $rs['quant_item']; ?></td>
                                                <td><?php  echo $rs['Total_venda']; ?></td>
                                                
                                        </tr>
										
										<?php
									   }               
                                } else {
                                    echo "Erro: Não foi possível recuperar os dados do banco de dados";
                                }
                            } catch (PDOException $erro) {
                                echo "Erro: " . $erro->getMessage();
                            }

                            ?>
                            </tbody>
                        </table>
						</div>
	
	<br>
	


	
      
            <article>
            
				<br>
				<?php
               if(isset($_GET['pesqVenda2'])){
               
			    ?>
                <div class="row">
                    <div class="panel panel-default">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                   <<th> ID Vendedor</th>
                                    <th>Nome Vendedor</th>
				<th>Cod Pedido</th>
				<th>Nome Produto</th>
                                    <th>Data Venda</th>
                                    <th>Valor Unitario</th>
				<th>Quantidade</th>
				<th>Valor total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
								 try {
									 
					$dataInicio = $_GET['dtInicial'];
				         $dataFim = $_GET['dtFinal'];
				
					if(!isset($_GET['pesqVenda']) || ($_GET['pesqVenda']== "")){}
								 
					$pesqVenda = "%".trim($_GET['pesqVenda'])."%";
							
			$smtp = $conexao->prepare("SELECT v.id_tblVendas, v.idVenda, l.id_func, l.nome_func, pd.codPedido, pr.nome_produto, v.valor, v.quant_item, c.nome_cliente, c.cpf_cliente, pd.data_Pedido, v.Total_venda 
                              FROM venda v 
                              INNER JOIN pedidos pd ON (v.idVenda = pd.idVenda) 
			       INNER JOIN produto pr ON (pr.codProduto = v.codProduto) 
			       INNER JOIN loginusu l ON (pd.id_func = l.id_func) 
			       INNER JOIN cliente c ON (c.codCliente = pd.codCliente)
							  WHERE pd.data_Pedido BETWEEN '$dataInicio' AND '$dataFim'");	
							  
								 $smtp->execute();
								     $rs= $smtp->fetchAll(PDO::FETCH_ASSOC);
									 if(count($rs)){
										
								 }else{
							  $smtp = $conexao->prepare("SELECT v.id_tblVendas, v.idVenda, l.id_func, l.nome_func, pd.codPedido, pr.nome_produto, v.valor, v.quant_item, c.nome_cliente, c.cpf_cliente, pd.data_Pedido, v.Total_venda 
                              FROM venda v 
                              INNER JOIN pedidos pd ON (v.idVenda = pd.idVenda) 
			                  INNER JOIN produto pr ON (pr.codProduto = v.codProduto) 
			                  INNER JOIN loginusu l ON (pd.id_func = l.id_func) 
			                  INNER JOIN cliente c ON (c.codCliente = pd.codCliente)
								WHERE l.nome_func LIKE '$pesqVenda'"); 
								 
								 $smtp->execute();
								 $rs= $smtp->fetchAll(PDO::FETCH_ASSOC);
								 if(count($rs)){
									 
								 }else{ 
								 echo  "<script>alert('Sua busca não retornou resultados!');</script>";
								 }
								 }
								 ?>	
								 
							
									<?php
					    if(count($rs)){
						foreach($rs as $rs){
                                            ?><tr>
                                               <td><?php  echo $rs['id_func'];?></td>
                                                <td><?php  echo $rs['nome_func']; ?></td>
						<td><?php  echo $rs['codPedido'];?></td>
						<td><?php  echo $rs['nome_produto']; ?></td>
						<td><?php  echo $rs['data_Pedido']; ?></td>
                                                <td><?php  echo $rs['valor'];?></td>
                                                <td><?php  echo $rs['quant_item']; ?></td>
                                                <td><?php  echo $rs['Total_venda']; ?></td>
                                                <td><center>
                                            <a href="" class="btn btn-dark btn-xs" ><span class="glyphicon glyphicon-remove"></span> Ajustar</a>
											
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
			<?php } ?>	
		
			
    </body>
</html>

