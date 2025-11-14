<?php
<<<<<<< HEAD
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
=======
/**
 * Arquivo: listar_veiculos.php
 * Descrição: Executa a consulta no SGBD MySQL, retorna todos os veículos em JSON.
 */

// 1. Incluir arquivos necessários para conexão com o banco de dados
// Estas includes DEVERÃO definir a variável $db_conexao
include('dados-conexao.inc.php');
include('conectar.inc.php');
include('abrir-banco.inc.php'); // Assumindo que este abre a conexão
include('definir-utf8.inc.php'); // Define o charset

// Cabeçalho obrigatório para AJAX consumir JSON
header('Content-Type: application/json');

$veiculos = [];

// =========================================================================
// NOVO TRATAMENTO DE ERRO PARA CONEXÃO E CONSULTA
// =========================================================================

if (!isset($db_conexao) || $db_conexao->connect_error) {
    // Se a conexão falhou, retorna um erro explícito
    $response = [
        'status' => 'error',
        'message' => 'Falha na conexão com o banco de dados.'
    ];
    echo json_encode($response);
    // Tenta fechar a conexão se ela existir, mas falhou (não é estritamente necessário)
    if (isset($db_conexao) && !$db_conexao->connect_error) {
         include('desconectar.inc.php'); 
    }
    exit; // Termina o script PHP
}

// Se a conexão foi bem-sucedida, prossegue com a consulta
$sql = "SELECT id, placa, marca, modelo, ano, cor, id_cliente FROM veiculo ORDER BY id DESC";

if ($resultado = $db_conexao->query($sql)) {
    // 2. Extrai os dados do resultado
    while ($linha = $resultado->fetch_assoc()) {
        $veiculos[] = $linha;
    }
    // Libera o resultado
    $resultado->free();
    
    // 3. Converte o array de resultados para JSON e imprime
    echo json_encode($veiculos);

} else {
    // Se a consulta SQL falhou
    $response = [
        'status' => 'error',
        'message' => 'Erro na consulta SQL: ' . $db_conexao->error
    ];
    echo json_encode($response);
}

// 4. Fechar a conexão
include('desconectar.inc.php'); 
?>
>>>>>>> 543322a5015bc6109ca823fa88bb5884e3fcdbb6
