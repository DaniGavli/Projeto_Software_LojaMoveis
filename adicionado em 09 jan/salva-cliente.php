<?php
require_once 'repository/clienterepository.class.php';

if (!isset($_POST['nome']) || !isset($_POST['cpf']) || !isset($_POST['email']) || !isset($_POST['fone']) || !isset($_POST['datanasc']) || !isset($_POST['endereco']) || !isset($_POST['bairro']) || !isset($_POST['cidade']) || !isset($_POST['cep']) || !isset($_POST['estado'])) {
    header('location:telacadastrodecliente.php?erro=form');
    return;
}

$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$email = $_POST['email'];
$fone = $_POST['fone'];
$datanasc = $_POST['datanasc'];
$endereco = $_POST['endereco'];
$bairro = $_POST['bairro'];
$cidade = $_POST['cidade'];
$cep = $_POST['cep'];
$estado = $_POST['estado'];

if (strlen($nome) > 50) {
    header('location:telacadastrodecliente.php?erro=nome');
    return;
} else if (strlen($cpf) != 11) {
    header('location:telacadastrodecliente.php?erro=cpf');
    return;
} else if (strlen($email) > 50 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('location:telacadastrodecliente.php?erro=email');
    return;
} else if (strlen($fone) < 10 || strlen($fone) > 11) {
    header('location:telacadastrodecliente.php?erro=fone');
    return;
} else if (DateTime::createFromFormat('Y-m-d', $datanasc) == null) {
    header('location:telacadastrodecliente.php?erro=datanasc');
    return;
} else if (strlen($endereco) > 100) {
    header('location:telacadastrodecliente.php?erro=endereco');
    return;
} else if (strlen($bairro) > 50) {
    header('location:telacadastrodecliente.php?erro=bairro');
    return;
} else if (strlen($cidade) > 50) {
    header('location:telacadastrodecliente.php?erro=cidade');
    return;
} else if (strlen($cep) != 8) {
    header('location:telacadastrodecliente.php?erro=cep');
    return;
} else if (strlen($estado) != 2) {
    header('location:telacadastrodecliente.php?erro=estado');
    return;
}

$cliente = new Cliente();
$cliente->nome = $nome;
$cliente->cpf = $cpf;
$cliente->email = $email;
$cliente->fone = $fone;
$cliente->datanasc = $datanasc;
$cliente->endereco = $endereco;
$cliente->bairro = $bairro;
$cliente->cidade = $cidade;
$cliente->cep = $cep;
$cliente->estado = $estado;

$con = new ConnPDO();
$db = $con->getConnection();

$repository = new ClienteRepository($db);
$repository->create($cliente);

header('location:telaclientes.php');