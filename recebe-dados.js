/**
 * Arquivo: recebe-dados.js
 */

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

function carregarRelatorioVeiculos() {
    const ajax = criarObjetoAjax();
    if (!ajax) return; 

    const urlBase = 'listar_veiculos.php'; 
    
    // Adiciona Cache-Buster
    const timestamp = new Date().getTime();
    const urlServidor = `${urlBase}?_=${timestamp}`;
    
    const bodyTabela = document.getElementById('tabela-veiculos-body');
    const tabela = document.getElementById('tabela-veiculos');
    const statusDiv = document.getElementById('status-message');

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
                            linha.insertCell().textContent = veiculo.id;
                            linha.insertCell().textContent = veiculo.placa;
                            linha.insertCell().textContent = veiculo.marca;
                            linha.insertCell().textContent = veiculo.modelo;
                            // Nenhuma outra célula deve ser adicionada aqui
                        });

                        tabela.classList.remove('hidden');
                        statusDiv.classList.add('hidden');
                        
                    } else {
                        statusDiv.textContent = 'Nenhum veículo cadastrado encontrado.';
                        statusDiv.classList.remove('hidden');
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

document.addEventListener('DOMContentLoaded', carregarRelatorioVeiculos);