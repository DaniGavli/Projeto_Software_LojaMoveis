<?php
require_once 'repository/clienterepository.class.php';

$con = new ConnPDO();
$db = $con->getConnection();
$repository = new ClienteRepository($db);

$clientes = $repository->fetchAll();

foreach ($clientes as $cliente) {
    echo $cliente->id;
    echo '<br>';
    echo $cliente->nome;
    echo '<br>';
    echo $cliente->cpf;
    echo '<br>';
    echo $cliente->email;
    echo '<br>';
    echo $cliente->fone;
    echo '<br>';
    echo $cliente->datanasc;
    echo '<br>';
    echo $cliente->endereco;
    echo '<br>';
    echo $cliente->bairro;
    echo '<br>';
    echo $cliente->cidade;
    echo '<br>';
    echo $cliente->cep;
    echo '<br>';
    echo $cliente->estado;
    echo '<br>##########<br><br>';
}