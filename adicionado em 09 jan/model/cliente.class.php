<?php

class Cliente {

    private $id;
    private $nome;
    private $cpf;
    private $email;
    private $fone;
    private $datanasc;
    private $endereco;
    private $bairro;
    private $cidade;
    private $cep;
    private $estado;

    public function __get($name) {
        return $this->$name;
    }

    public function __set($name, $value) {
        $this->$name = $value;
    }
}