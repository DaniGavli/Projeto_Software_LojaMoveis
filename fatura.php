<?php
session_start();
 ?>
 <?php
 require_once 'conexaoBanco.php';
 $pedAtual = $_SESSION['pedidoAtual'];
 ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>Nota Fiscal</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/prototipo.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
     <script src="assets/js/bootstrap.js" type="text/javascript" ></script>
</head>
<style>

 </style>
<body>

 

			<?php
			
            $smtp = $conexao->prepare("SELECT  l.id_func, pd.codPedido, c.*, pd.data_Pedido
               FROM pedidos pd 
			  INNER JOIN loginusu l ON (pd.id_func = l.id_func) 
			  INNER JOIN cliente c ON (c.codCliente = pd.codCliente)
			  where pd.codPedido = $pedAtual");
								 $smtp->execute();
								 $rs= $smtp->fetchAll(PDO::FETCH_ASSOC);
								   if(count($rs)){	
								  foreach($rs as $rs){
								 ?>	
								 
							 

<div class="card">
  <div class="card-body">
   <hr>
    <div class="col-xl-3 float-end">
          <a href="envioFatura.php" class="btn btn-light text-capitalize" data-mdb-ripple-color="dark"><i class="far fa-file-pdf text-danger"></i> Email</a>
        </div>
    <div class="container mb-5 mt-3">
	<p style="color: #7e8d9f;font-size: 35px;"> <strong> Loja Super Móveis - Canoas</strong></p>
	<p style="color: #7e8d9f;font-size: 15px;">  Telefone: (51) 3477-9999 - Email: lojaSuperMoveis@LojaSuperMoveis.com.br  - Endereço : Rua Das Flores 25 CEP: 92410-000 Canoas/RS<strong></strong></p>
	 <hr>
      <div class="row d-flex align-items-baseline" >
        <div class="col-xl-9">
          <p style="color: #7e8d9f;font-size: 20px;">Pedido >> ID: <strong> <?php echo $rs['codPedido']; ?></strong></p>
        </div>
       
        <hr>
      </div>

      <div class="container">
        <div class="col-md-12">
          <div  class="text-center">
            <i class="fab fa-mdb fa-4x ms-0" style="color:#5d9fc5 ;"></i> <p class="pt-0"></p>
          </div>

        </div>


        <div class="row">
          <div class="col-xl-8">
            <ul class="list-unstyled">
              <li class="text-muted">Cliente: <span style="color:#5d9fc5 ;"><?php echo $rs['nome_cliente']; ?></span></li>
              <li class="text-muted">CPF: <?php echo $rs['cpf_cliente']; ?> </li>
              <li class="text-muted">Endereço : <?php echo $rs['endereco_cliente']; ?></li>
			  <li class="text-muted">Email : <?php echo $rs['email_cliente']; ?></li>
              <li class="text-muted"><i class="fas fa-phone"></i> Telefone: <?php echo $rs['telefone_cliente']; ?></li>
            </ul>
          </div>
          <div class="col-xl-4">
            <p class="text-muted"> </p>
            <ul class="list-unstyled">
              <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span class="fw-bold">Pedido:</span><?php echo $rs['codPedido']; ?></li>
              <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span class="fw-bold">Data </span><?php echo $rs['data_Pedido']; ?></li>
              <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span class="me-1 fw-bold">Status:</span><span class="badge bg-warning text-black fw-bold"> Pago</span></li>
            </ul>
          </div>
        </div>


								   <?php } }  ?>
        <div class="row my-2 mx-1 justify-content-center">
          <table class="table table-striped table-borderless">
            <thead style="background-color:#84B0CA ;" class="text-white">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Produto</th>
                <th scope="col">Quantidade</th>
                <th scope="col">Preço Unitario</th>
                <th scope="col">Total</th>
              </tr>
            </thead>
            <tbody>
	
			 <?php
		
            $smtp = $conexao->prepare("SELECT v.id_tblVendas, v.idVenda, l.id_func, pd.codPedido, pr.nome_produto, v.valor, v.quant_item, c.nome_cliente, c.cpf_cliente, pd.data_Pedido, v.Total_venda 
               FROM venda v 
              INNER JOIN pedidos pd ON (v.idVenda = pd.idVenda) 
			  INNER JOIN produto pr ON (pr.codProduto = v.codProduto) 
			  INNER JOIN loginusu l ON (pd.id_func = l.id_func) 
			  INNER JOIN cliente c ON (c.codCliente = pd.codCliente)
			  where v.idVenda = $pedAtual");
			  
								 $smtp->execute();
								 $rs= $smtp->fetchAll(PDO::FETCH_ASSOC);
								  if(count($rs)){	
								  foreach($rs as $rs){
	
							
                                            ?><tr>
											 <td><?php echo $rs['id_func']; ?></td>
											   <td><?php echo $rs['nome_produto']; ?></td>
											    <td><?php echo $rs['quant_item']; ?></td>
                                                <td><?php echo $rs['valor']; ?></td>
												
												<?php 
												$td= $rs['quant_item'] * $rs['valor'];
												?>
												
                                              <?php  
							// $totFinal = $totFinal + $td;
							 
							 ?>	
							 <td><?php echo $td; ?></td>
                                                <td><center>  
                                        </center>
                                        </td>
                                        </tr>
							 <?php  
							
							 } }?>	 
			 
            </tbody>

          </table>
		  <?php
            $smtp = $conexao->prepare("SELECT codPedido, val_pedido from pedidos WHERE codPedido = $pedAtual");
								 $smtp->execute();
								 $rs= $smtp->fetchAll(PDO::FETCH_ASSOC);
								  if(count($rs)){	
								  foreach($rs as $rs){
									  
		 ?>
        </div>
        <div class="row">
          <div class="col-xl-8">
            <p class="ms-3"></p>

          </div>
          <div class="col-xl-3">
            <ul class="list-unstyled">
              <li class="text-muted ms-3"><span class="text-black me-4">Total :  R$ </span><?php echo number_format ($rs['val_pedido'], 2, ',', '.'); ?></li>
              <li class="text-muted ms-3 mt-2"><span class="text-black me-4">Desconto: R$</span>0</li>
              </ul>
              <p class="text-black float-start"><span class="text-black me-3"> Total Pago: R$ </span><span style="font-size: 25px;"> <?php echo number_format ($rs['val_pedido'], 2, ',', '.'); ?></span></p>
          </div>
        </div>
		
		 <?php  } }?>
        <hr>
        <div class="row">
          <div class="col-xl-10">
            <p>Obrigado, Volte Sempre</p>
          </div>
         
        </div>

      </div>
    </div>
  </div>
</div>	

</body>
</html>



