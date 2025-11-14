<?php
// Credenciais exatas do seu arquivo dados-conexao.inc.php
$servidor = "localhost";
$usuario  = "root";
$senha    = "";
$nomeDoBanco = "LAVACAO";

// Tenta a conexão
$conexao = new mysqli($servidor, $usuario, $senha);

if ($conexao->connect_error) {
    // FALHA NA CONEXÃO COM O SERVIDOR (Usuário/Senha/Host ERRADOS)
    die("Falha na CONEXÃO MySQL: Código " . $conexao->connect_errno . " - " . $conexao->connect_error);
}

// Tenta selecionar o banco
if (!$conexao->select_db($nomeDoBanco)) {
    // FALHA AO ABRIR O BANCO (Nome do Banco ERRADO)
    die("Falha ao selecionar o Banco '$nomeDoBanco': " . $conexao->error);
}

// SUCESSO
echo "SUCESSO! Conexão estabelecida e Banco de Dados '$nomeDoBanco' selecionado. Seu projeto deve funcionar.";

$conexao->close(); 
?>