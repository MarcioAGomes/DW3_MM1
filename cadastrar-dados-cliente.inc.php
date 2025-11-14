<?php
 //receber os dados do formulário
 $nome  = $_POST["nomeCliente"];
 $endereco = $_POST["endereco"];
 $numero = $_POST["numero"];
 $email = $_POST["email"];
 $telefone = $_POST["telefone"];
 $user = $_POST["user"];
 $pass = $_POST["pass"];


 //consulta para o cadastro dos dados do funcionário no banco de dados
 $sql = "INSERT $nomeDaTabelaCliente VALUES (null, '$nome', '$endereco' , $numero, '$email', '$telefone', '$user', '$pass')";

 $conexao->query($sql);

 echo "<p> Dados do cliente cadastrados com sucesso. </p>";