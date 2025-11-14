<?php
// Desativa a exibição de erros (Warnings/Notices) para não corromper o JSON
error_reporting(0); 
ini_set('display_errors', 0);

// Define os cabeçalhos para JSON e controle de cache
header('Content-Type: application/json');
header('Cache-Control: no-cache, no-store, must-revalidate'); 
header('Pragma: no-cache');
header('Expires: 0');

$veiculos = [];

// *** CÓDIGO DE CONEXÃO DIRETA (Use suas includes originais se preferir) ***
$host = "localhost";
$user = "root";
$pass = "";
$banco = "LAVACAO";

$db_conexao = new mysqli($host, $user, $pass, $banco);

if ($db_conexao->connect_error) {
    http_response_code(500);
    $response = ['status' => 'error', 'message' => 'Falha na conexão com o MySQL.'];
    echo json_encode($response);
    exit;
}
// *** FIM DO BLOCO DE CONEXÃO ***

// SE A CONEXÃO FUNCIONAR, EXECUTA A CONSULTA:
// CORREÇÃO FINAL: Selecionando apenas as 4 colunas existentes na tabela 'veiculo'.
$sql = "SELECT id, placa, marca, modelo FROM veiculo ORDER BY id DESC";

if ($resultado = $db_conexao->query($sql)) {
    while ($linha = $resultado->fetch_assoc()) {
        $veiculos[] = $linha;
    }
    $resultado->free();
    echo json_encode($veiculos);
} else {
    http_response_code(500);
    $response = ['status' => 'error', 'message' => 'Erro na consulta SQL: ' . $db_conexao->error];
    echo json_encode($response);
}

$db_conexao->close();