<?php
session_start(); 
?>
<?php
require_once 'conexaoBanco.php';

?>

<!DOCTYPE html>
<head>
<meta charset="">
</head> 
  <style>
 
  body {background: #00bfff; font-family: arial; }
   #menu{position: absolute; left: 120px; top: 80px; grid-template-columns: 150px 150px 150px 150px 150px 150px; display: grid; column-gap: 50px;  }
   
   #containerHeader {float:right;display:block;}
   #Sair, #voltaMenu {border-radius: 100%; width: 60px; border: none; background-color: orange; color: white;}
   
   a{width:150px; height: 150px; background: white; color: black; border-radius:10px; }
   
   #b1 {background-image:url('https://www.ibid.com.br/blog/wp-content/uploads/2017/03/gestao-de-estoques-just-in-time-x-just-in-case2-700x680.png'); background-size: cover; marging: 5px; cursor: pointer; text-decoration: none; text-align: center; }
   
   #b2 {background-image:url(' https://ialui.com.br/wp-content/uploads/2020/11/posvenda2-770x491.jpeg'); background-size: cover; marging: 5px; z-index:2; cursor: pointer; text-decoration: none; text-align: center; }
   
   #b3 {background-image:url('https://www.grupoescolar.com/fotos/relatorio-A6.jpg'); background-size: cover; cursor: pointer; text-decoration: none; text-align: center; }
   
   #b4 {background-image:url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQc898HJJqgfOekE8QUv672dfStUjgdZcz-HXzy9Ug09tFo64wEQSzi004hE2-3FnVVRhY&usqp=CAU'); background-size: cover;cursor: pointer; text-decoration: none; text-align: center; }
   
   #b5 {background-image:url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRXWBNlc1xZxID_uKaFZsDPRwB1NTr0-SrhpA&usqp=CAU'); background-size: cover; cursor: pointer; text-decoration: none; text-align: center; }
   
   #b6 {background-image:url('https://blog.pluga.co/uploads/2021/05/cadastro_clientes_header.png'); background-size: cover; cursor: pointer; text-decoration: none; text-align: center; }
   
   label{margin-left: 30px; color: white; font-size: 22px;}
  </style>
  
  
  
  <label>Olá,<?php echo $_SESSION['nome_func'] ; ?> <div id="usuario_global"><div><label>
  
  <div id="containerHeader">
  <a href="sair.php" ><button id="Sair" >Sair</button></a>
  <a href="telaMenu.html" target="_blank"><button id="voltaMenu" >Menu</button></a>
  </div>
 <br>
 
  <?php $nivelAcesso = $_SESSION['funcao_func']; 
  
  if($nivelAcesso === 'vendedor'){
    ?>
  <div id="menu" >
  <a id="b1"  href="estoque.php"  title="ESTOQUE">Estoque</a>
   <a id="b2" href="selectProd.php"  title="VENDAS">Venda</a>
   <a id="b6" href="cadastrarCliente.php" title="CADASTRO CLIENTES">Cadastro Clientes</a>
  </div>

   <?php	
   
  } else {
	  ?>

  <div id="menu" >
  <a id="b1"  href="estoque.php"  title="ESTOQUE">Estoque</a>
   <a id="b2" href="selectProd.php"  title="VENDAS">Venda</a>
   <a id="b3" href="relatorioVendas.php" title="RELATORIOS">Relatorios </a>
   <a id="b4" title="USUÁRIOS">Usuarios</a>
    <a id="b5" href="cadastroProduto.php" title="CADASTRO PRODUTOS">Cadastro Produto</a>
   <a id="b6" href="cadastrarCliente.php" title="CADASTRO CLIENTES">Cadastro Clientes</a>
  </div>
  
   <?php }?>
