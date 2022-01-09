<?php
$server = "localhost:3306";//especificar o nº da porta para não dar erro
$username = "root";
$password = "";
$database = "lab";

$nome = $_POST['nome'];
$cnpj = $_POST['cnpj'];
$razaosocial = $_POST['razaosocial'];
$email = $_POST['email'];
$telefone = $_POST['fone'];
$endereco = $_POST['endereco'];
$bairro = $_POST['bairro'];
$cidade = $_POST['cidade'];
$cep = $_POST['cep'];
$estado = $_POST['estado'];

$con = mysqli_connect($server,$username,$password,$database);

mysqli_query($con, "INSERT INTO fornecedor (nome,cnpj,razao_social,email,telefone,endereco,bairro,cidade,cep,uf) VALUES ('".$nome."', '".$cnpj."', '".$razaosocial."', '".$email."', '".$telefone."', '".$endereco."', '".$bairro."', '".$cidade."', '".$cep."', '".$estado."')");

header('Location: telacadastrodefornecedor.html');
 ?>
