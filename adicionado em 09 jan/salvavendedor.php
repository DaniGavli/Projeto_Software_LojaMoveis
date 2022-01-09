<?php
$server = "localhost:3306";//especificar o nº da porta para não dar erro
$username = "root";
$password = "";
$database = "lab";

$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$email = $_POST['email'];
$telefone = $_POST['fone'];
$data_nascimento = $_POST['datanasc'];
$endereco = $_POST['endereco'];
$bairro = $_POST['bairro'];
$cidade = $_POST['cidade'];
$cep = $_POST['cep'];
$estado = $_POST['estado'];
$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

$con = mysqli_connect($server,$username,$password,$database);

mysqli_query($con, "INSERT INTO vendedor (nome,cpf,email,telefone,data_nascimento,endereco,bairro,cidade,cep,uf,usuario,senha) VALUES ('".$nome."', '".$cpf."', '".$email."', '".$telefone."', '".$data_nascimento."', '".$endereco."', '".$bairro."',
  '".$cidade."','".$cep."', '".$estado."', '".$usuario."', '".$senha."')");

header('Location: telacadastrodevendedor.html');
 ?>
