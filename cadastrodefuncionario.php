<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Other/html.html to edit this template
-->
<html>
    <head>
        <title>Cadastro de Funcionário</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
      <style>

  body {background: #8470FF; }
  form {text-align:left; position:absolute; left: 40%; top: 12%;color: white; z-index:2}
  label {color: 00BFFF; font-size:15px; marging-right: 8px;}
  input{ width:180px; height: 20px; marging-top: 3px; marging-left: 20px;}
  #btn {width:150px; height: 35px; marging-top: 6px; marging-left: 20%; background-color: #FFFFFF; color: #00BFFF; border: none;}
  #btnCadCli {width:160px; height: 50px; background-color: #FFFFFF; color: #000000; border: none;}
  diva { position:absolute; left: 30%; top: 10%; width:600px; height: 600px;}

  </style>
    <body>
         <div>
 <form id="cadForm">
 <label><h1>Cadastro de Funcionário</h1></label>
 <label>Nome: <input type="text" name="nome" required></label><br><br>
 <label>CPF: <input type="text" name="cpf" required></label><br><br>
 <label>Email: <input type="email" name="email" value="eu@meuEmail.com" required></label><br><br>
 <label>Telefone: <input type="text" name="fone" required></label><br><br>
 <label>Data de Nascimento: <input type="date" name="datanasc" size="10" max="2005-01-01" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}"></label><br><br>
  <label>Endereço: <input type="text" name="endereco" value=""></label><br><br>
  <label>Bairro: <input type="text" name="bairro" value=""></label><br><br>
  <label>Cidade: <input type="text" name="cidade" value=""></label><br><br>
  <label>CEP: <input type="text" name="cep" value=""></label><br><br>
 <label>UF: <select name="estado"><br>
   <option value="PR">PR</option>
   <option value="RS" selected="selected">RS</option>
   <option value="SC">SC</option>
   <br><br>
 </select></label><br><br>
 <input id="btnCadCli" type="submit" value="Cadastrar" name="cadastrarCli"><br><br>
  </form>
  
   </div>
    </body>
</html>