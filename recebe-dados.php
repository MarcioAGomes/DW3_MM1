<!DOCTYPE html>
<html lang="pt-BR">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title> Fundamentos da linguagem PHP </title>
</head>
<body>
 <h1> Introdução à linguagem PHP, com programação no lado do servidor </h1>

 <?php
  //chama as includes
  require_once "dados-conexao.inc.php";
  require_once "conectar.inc.php";
  require_once "criar-banco.inc.php";
  require_once "abrir-banco.inc.php";
  require_once "definir-utf8.inc.php";
  require_once "criar-tabelacliente.inc.php";
  require_once "criar-tabelaveiculo.inc.php";

  //testa se o botão cadastrar foi acionado e executa a operação de cadastro
  if(isset($_POST['cadastrarCliente']))
   {
   require_once "cadastrar-dados-cliente.inc.php";
   }

  //testa se o botão de cadastrar veiculo foi acionado e executa a operação na include criada
  if(isset($_POST['cadastrarVeiculo']))
   {
   require_once "cadastrar-dados-veiculo.inc.php";
   }


  require_once "desconectar.inc.php";
 ?>

</body>
</html>