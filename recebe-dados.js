/**
 * Arquivo: recebe-dados.js
<<<<<<< HEAD
 */

=======
 * Descrição: Implementa a função de usuário que cria o objeto AJAX, 
 * define a URL do servidor e processa o retorno para montar a tabela.
 */

// Função para criar o objeto XMLHttpRequest
>>>>>>> 543322a5015bc6109ca823fa88bb5884e3fcdbb6
function criarObjetoAjax() {
    let ajax;
    try {
        ajax = new XMLHttpRequest();
    } catch (e) {
        try {
            ajax = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            try {
                ajax = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e) {
                console.error("Erro: Seu navegador não suporta AJAX.");
                return null;
            }
        }
    }
    return ajax;
}

<<<<<<< HEAD
=======
/**
 * Função principal para carregar o relatório de veículos usando AJAX.
 * * Define qual arquivo PHP será executado no servidor: listar_veiculos.php
 */
>>>>>>> 543322a5015bc6109ca823fa88bb5884e3fcdbb6
function carregarRelatorioVeiculos() {
    const ajax = criarObjetoAjax();
    if (!ajax) return; 

<<<<<<< HEAD
    const urlBase = 'listar_veiculos.php'; 
    
    // Adiciona Cache-Buster
    const timestamp = new Date().getTime();
    const urlServidor = `${urlBase}?_=${timestamp}`;
    
=======
    // Define o arquivo PHP a ser executado no servidor
    const urlServidor = 'listar_veiculos.php'; 
    
    // Referências aos elementos DOM
>>>>>>> 543322a5015bc6109ca823fa88bb5884e3fcdbb6
    const bodyTabela = document.getElementById('tabela-veiculos-body');
    const tabela = document.getElementById('tabela-veiculos');
    const statusDiv = document.getElementById('status-message');

<<<<<<< HEAD
    ajax.onreadystatechange = function() {
        if (ajax.readyState === 4) { 
            
            if (ajax.status >= 200 && ajax.status < 300) { 
                try {
                    const dadosVeiculos = JSON.parse(ajax.responseText);
                    
                    if (Array.isArray(dadosVeiculos) && dadosVeiculos.length > 0) {
                        bodyTabela.innerHTML = ''; 

                        dadosVeiculos.forEach(veiculo => {
                            const linha = bodyTabela.insertRow();
                            linha.className = 'bg-white border-b hover:bg-gray-50'; 
                            
                            // Cria as células APENAS para as 4 colunas existentes
=======
    // 1. Implementa a função de callback (o que acontece quando o estado muda)
    ajax.onreadystatechange = function() {
        if (ajax.readyState === 4) { // Requisição concluída
            
            if (ajax.status === 200) { // Status HTTP OK
                try {
                    // Tenta converter a resposta JSON em objeto JavaScript
                    const dadosVeiculos = JSON.parse(ajax.responseText);
                    
                    // Verifica se há dados para exibir
                    if (Array.isArray(dadosVeiculos) && dadosVeiculos.length > 0) {
                        bodyTabela.innerHTML = ''; 

                        // 2. Exibir os resultados em uma tabela
                        dadosVeiculos.forEach(veiculo => {
                            const linha = bodyTabela.insertRow();
                            
                            // Cria as células (td) para cada campo do veículo
>>>>>>> 543322a5015bc6109ca823fa88bb5884e3fcdbb6
                            linha.insertCell().textContent = veiculo.id;
                            linha.insertCell().textContent = veiculo.placa;
                            linha.insertCell().textContent = veiculo.marca;
                            linha.insertCell().textContent = veiculo.modelo;
<<<<<<< HEAD
                            // Nenhuma outra célula deve ser adicionada aqui
                        });

=======
                            linha.insertCell().textContent = veiculo.ano;
                            linha.insertCell().textContent = veiculo.cor;
                            linha.insertCell().textContent = veiculo.id_cliente;
                        });

                        // Exibe a tabela formatada
>>>>>>> 543322a5015bc6109ca823fa88bb5884e3fcdbb6
                        tabela.classList.remove('hidden');
                        statusDiv.classList.add('hidden');
                        
                    } else {
                        statusDiv.textContent = 'Nenhum veículo cadastrado encontrado.';
                        statusDiv.classList.remove('hidden');
<<<<<<< HEAD
                        tabela.classList.add('hidden');
                    }

                } catch (e) {
                    console.error("Erro ao processar JSON no Status 200:", e);
                    statusDiv.textContent = 'Erro de comunicação: O servidor retornou formato inesperado.';
                    statusDiv.classList.remove('hidden');
                    tabela.classList.add('hidden');
                }
            
            } else {
                // Tratamento de erro Status 4xx ou 5xx
                try {
                    const erroServidor = JSON.parse(ajax.responseText);
                    
                    if (erroServidor && erroServidor.message) {
                        statusDiv.textContent = `⚠️ Erro Servidor ${ajax.status}: ${erroServidor.message}`;
                    } else {
                        throw new Error("Resposta de erro não é JSON formatado.");
                    }
                    
                } catch (e) {
                    statusDiv.textContent = `⚠️ Erro ${ajax.status}: Falha ao carregar dados. (Erro desconhecido do servidor)`;
                    console.error(`Erro na requisição AJAX: Status ${ajax.status}. Resposta:`, ajax.responseText, e);
                }
                statusDiv.classList.remove('hidden');
                tabela.classList.add('hidden');
            }
        }
        
        if (ajax.readyState < 4) {
            statusDiv.textContent = 'Aguardando resposta do servidor...';
            statusDiv.classList.remove('hidden');
        }
    };

    ajax.open('GET', urlServidor, true); 
    ajax.send();
}

=======
                    }

                } catch (e) {
                    console.error("Erro ao processar JSON:", e);
                    statusDiv.textContent = 'Erro de comunicação: O servidor retornou um formato de dados inválido.';
                    statusDiv.classList.remove('hidden');
                }
            
            } else {
                // Erro no servidor
                statusDiv.textContent = `Erro ${ajax.status}: Falha ao carregar dados.`;
                console.error(`Erro na requisição AJAX: Status ${ajax.status}`);
                statusDiv.classList.remove('hidden');
            }
        }
    };

    // 3. Abrir e Enviar a Requisição
    ajax.open('GET', urlServidor, true);
    ajax.send();

    // Atualiza o status enquanto aguarda a resposta
    statusDiv.textContent = 'Aguardando resposta do servidor...';
}

// Inicia o carregamento dos dados assim que o DOM estiver pronto
>>>>>>> 543322a5015bc6109ca823fa88bb5884e3fcdbb6
document.addEventListener('DOMContentLoaded', carregarRelatorioVeiculos);