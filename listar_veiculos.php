<?php
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