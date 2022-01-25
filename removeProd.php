<?php
   session_start();
   
 if(isset($_GET['removeProd']) && $_GET['removeProd'] == "carrinho"){
	   $codProduto = $_GET['codProduto'];
		  $quantProd= $_SESSION['itens'][$codProduto];
		  if( $quantProd >= 1){
		    $_SESSION['itens'][$codProduto] -= 1;
			  header("Location: carrinho.php"); 
		  }
		   if( $quantProd < 2){
			 unset($_SESSION['itens'][$codProduto]);
		    header("Location: carrinho.php"); 
		   }
   }
   
    if(isset($_GET['addProd']) && $_GET['addProd'] == "carrinho"){
	   $id = $_GET['codProduto'];
	   if(!isset($_SESSION['itens'][$id])){
	   $_SESSION['itens'][$id] = 1;
	   }else{
	   $_SESSION['itens'][$id] += 1;
	   header("Location: carrinho.php"); 
		}
   }
   
