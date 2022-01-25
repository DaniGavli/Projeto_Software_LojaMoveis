<?php
$senha= '(W0&L!^V[s%fj~5g';
try {

     $conexao = new PDO("mysql:host=localhost;dbname=id18069925_lojasmoveis", "id18069925_usulojasmoveis", "$senha");
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexao->exec("set names utf8");
} catch (PDOException $erro) {
    echo "<p class=\"bg-danger\">Erro na conexão:" . $erro->getMessage() . "</p>";
	
}

