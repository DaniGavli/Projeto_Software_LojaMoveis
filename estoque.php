<?php
session_start(); 
?>
<?php
require_once 'conexaoBanco.php';

?>
 
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge" >
        <title>Estoque</title>
		 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    </head>
	
	<style>
	body {margin-left: 100px; margin-top: 40px; margin-right: 100px;}
    #some{display: none;}
	#pesq {margin-left: 380px; margin-top: -35px;}
	
	
	</style>
    <body>
	
     <div id="containerHeader" class="container">
	 <h2> Estoque: </h2>
  <a href="sair.php" ><button  class="btn btn-info" id="Sair5" >Sair</button></a>
  <a href="telaMenu.php" ><button class="btn btn-info" id="voltaMenut" >Menu</button></a>
    <a href="estoque.php" ><button class="btn btn-warning" id="voltaMenut" >Limpar Tela</button></a>
	<button type="submit" name="exibe" onclick="Mudarestado('some')" class="btn btn-success" id="btnEstoque"> Estoque Geral</button>
	
	<form class="form-inline" id="pesq" action="estoque.php" method="GET">
	<div class="form-group mx-sm-3 mb-2">
	<label class="sr-only"></label>
	 <input  name="pesqNomeProd" type="text" class="form-control" name="pesqProd" />
	  </div>
	 <button type="submit" name="pesqNomeProd2" class="btn btn-primary mb-2" />Pesquisar </button>
						</form>
	
	</div>
	<hr><br>
	
	
	
	
	
	
	
	
	
	
				
			  <script>

function Mudarestado(el) {
  var display = document.getElementById(el).style.display;
    document.getElementById(el).style.display = 'block';

}



</script>	



                                <?php
								
                        
                                   $stmt = $conexao->prepare("SELECT c.nome_fornecedor, p.nome_produto, p.valor_produto, p.quantidade_disponivel FROM fornecedor c, produto p WHERE c.codFornecedor = p.codFornecedor and  p.quantidade_disponivel >='5'"); 
                                                                   if( $stmt->execute()){
                                       while($rs = $stmt->fetch(PDO::FETCH_ASSOC)){
// print_r($rs['nome_fornecedor']);
                                            ?>
											<tr>
											    <td><?php $rs['nome_produto']; ?></td>
                                                <td><?php $rs['nome_fornecedor']; ?></td>
                                                <td><?php $rs['valor_produto']; ?></td>
                                                <td><?php $rs['quantidade_disponivel']; ?></td>
                                               
                                        <?php $mensagem = '<br> <strong>Solicitar Reposição:</strong> <br>Produto: '.$rs['nome_produto']. '<br> Fornecedor: '.$rs['nome_fornecedor'].'<br>Valor: '.$rs['valor_produto'].'<br> Estoque: '. $rs['quantidade_disponivel'].'<br>'; 
                 //print_r($mensagem);
										?>
										
                                        </tr>
										<?php
									   }               
                                } 

                            ?>
                           
					 <?php
													//mail('dngg55@gmail.com','ESTOQUE BAIXO','Mensagem enviada pela aula de PHP'); //Envia mensagem sem remetente
													//mail('dngg55@gmail.com','ESTOQUE BAIXO','$mensagem','From: Aluno <dngg55@gmail.com>');
                                             ?>
                                               		
	
	
	<div  id="some">
	<table class="table table-striped">
                            <thead>
                                <tr> 
                                    <th>Nome Produto</th>
									<th>Nome Fornecedor</th>
									<th>Descrição Produto</th>
                                    <th>Valor</th>
                                    <th>Quantidade Disp</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
	<?php 
	try {
	
	 $stmt = $conexao->prepare("SELECT c.nome_fornecedor, p.nome_produto, p.descricao_produto, p.valor_produto, p.quantidade_disponivel FROM fornecedor c, produto p WHERE c.codFornecedor = p.codFornecedor");
                               if( $stmt->execute()){
                                       while($rs = $stmt->fetch(PDO::FETCH_ASSOC)){
// print_r($rs['nome_fornecedor']);
                                            ?>
											<tr>
											    <td><?php echo $rs['nome_produto']; ?></td>
                                                <td><?php echo $rs['nome_fornecedor']; ?></td>
												<td><?php echo $rs['descricao_produto']; ?></td>
                                                <td><?php echo $rs['valor_produto']; ?></td>
                                                <td><?php echo $rs['quantidade_disponivel']; ?></td>
                                               
                                                
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
               if(isset($_GET['pesqNomeProd2'])){
               
			    ?>
                <div class="row">
                    <div class="panel panel-default">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nome Fornecedor</th>
                                    <th>Nome Produto</th>
									<th>DescriçãoProduto</th>
                                    <th>Valor</th>
                                    <th>Quantidade Disponivel</th>
                                    <th></th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <?php
								 try {
								 if(!isset($_GET['pesqNomeProd']) || ($_GET['pesqNomeProd']== "")){
									 
									 echo  "<script>alert('informe um valor para pesquisar!');</script>"; 
									 exit;
								 }
								 
								 $pesqNomeProd = "%".trim($_GET['pesqNomeProd'])."%";
								 $smtp = $conexao->prepare("SELECT c.nome_fornecedor, p.nome_produto, p.descricao_produto, p.imagem_produto, p.valor_produto, p.quantidade_disponivel FROM fornecedor c, produto p WHERE c.codFornecedor = p.codFornecedor and p.nome_produto LIKE '$pesqNomeProd' ");	
								  $smtp->execute();
								     $rs= $smtp->fetchAll(PDO::FETCH_ASSOC);
									 if(count($rs)){
										
								 }else{
									$smtp = $conexao->prepare("SELECT c.nome_fornecedor, p.nome_produto, p.descricao_produto, p.imagem_produto, p.valor_produto, p.quantidade_disponivel FROM fornecedor c, produto p WHERE c.codFornecedor = p.codFornecedor and c.nome_fornecedor LIKE '$pesqNomeProd' "); 
								 
								 $smtp->execute();
								 $rs= $smtp->fetchAll(PDO::FETCH_ASSOC);
								 if(count($rs)){
									 
								 }else{ 
								 echo  "<script>alert('Produto nao localizado no estoque!');</script>";
								 }
								 }
								 ?>	
								 
							
									<?php
					    if(count($rs)){
						foreach($rs as $rs){
                                            ?><tr>
                                                <td><?php echo $rs['nome_fornecedor']; ?></td>
                                                <td><?php echo $rs['nome_produto']; ?></td>
												 <td><?php echo $rs['descricao_produto']; ?></td>
                                                <td><?php echo $rs['valor_produto']; ?></td>
                                                <td><?php echo $rs['quantidade_disponivel']; ?></td>
                                                <td><center>
                                           
											
                                        </center>
										<?php	echo '<img height="230" width="230" src="'.$rs['imagem_produto'].'">';?>
									
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
			

			<br>
			
			 
	
		
			
    </body>
</html>

