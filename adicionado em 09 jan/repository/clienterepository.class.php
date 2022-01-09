<?php
require_once 'conexao/connpdo.class.php';
require_once 'model/cliente.class.php';

class ClienteRepository {

    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function create($cliente) {
        $operation = $this->db->prepare('INSERT INTO cliente(nome, cpf, email, fone, datanasc, endereco, bairro, cidade, cep, uf) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $operation->execute(array($cliente->nome, $cliente->cpf, $cliente->email, $cliente->fone, $cliente->datanasc, $cliente->endereco, $cliente->bairro, $cliente->cidade, $cliente->cep, $cliente->estado));
    }

    public function fetchAll() {
        $query = $this->db->prepare('SELECT * FROM cliente');
        $query->execute();

        return $query->fetchAll(PDO::FETCH_CLASS, 'Cliente');
    }
}