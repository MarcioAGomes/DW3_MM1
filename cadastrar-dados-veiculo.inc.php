<?php
 //receber os dados do formulário
 $marca  = $_POST["marca"];
 $modelo = $_POST["modelo"];
 $placa = $_POST["placa"];
 
 //consulta para o cadastro dos dados do funcionário no banco de dados
 $sql = "INSERT $nomeDaTabelaVeiculo VALUES (null, '$marca', '$modelo' , '$placa')";

 $conexao->query($sql);

 echo "<p> Dados do veiculo cadastrado com sucesso. </p>";