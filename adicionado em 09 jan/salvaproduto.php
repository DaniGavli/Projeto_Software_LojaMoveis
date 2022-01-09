<?php
$server = "localhost:3306";//especificar o nº da porta para não dar erro
$username = "root";
$password = "";
$database = "lab";

$nome = $_POST['nome'];
$descricao = $_POST['descricao'];
$fichatecnica = $_POST['fichatecnica'];
$fornecedor = $_POST['fornecedor'];

$con = mysqli_connect($server,$username,$password,$database);

mysqli_query($con, "INSERT INTO produto (nome,descricao,fichatecnica,fornecedor) VALUES ('".$nome."', '".$descricao."', '".$fichatecnica."', '".$fornecedor."')");

header('Location: telacadastrodeproduto.html');
 ?>
