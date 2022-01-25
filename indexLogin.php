<?php
session_start();
?>
<?php
require_once 'conexaoBanco.php';


    if(!isset($_POST['usuario']) || ($_POST['usuario']== "") || ($_POST['senha']) || ($_POST['senha']== "")){
								
		$usuario = $_POST['usuario'];
		$senha = $_POST['senha'];
								 

    $validarlogin = $conexao->query("SELECT * FROM loginusu WHERE id_func = $usuario and senha = $senha ");
    $validarlogin = $conexao->prepare("SELECT * FROM loginusu WHERE id_func = $usuario and senha = $senha ");
    $validarlogin->execute();

    if($validarlogin->rowCount() == 1) {
        while($ln = $validarlogin->fetch(PDO::FETCH_ASSOC)){
			
            $_SESSION['id_func'] = $ln['id_func'];
            $_SESSION['senha_func'] = $ln['senha'];
            $_SESSION['nome_func'] = $ln['nome_func'];
            $_SESSION['funcao_func'] = $ln['funcao_func'];
		
     
			echo  "<script>alert('Logado Com Sucesso!');</script>"; 
                echo "<script>location.href='telaMenu.php'</script>";
               
        }
      } else {
        
		echo  "<script>alert('Usuarios Ou Senha Incorretos!');</script>"; 
		echo "<script>location.href='index.php'</script>";
		
			
      }    
    }


