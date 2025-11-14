function validaForm()
{
    
let nome = objNome.value;

nome = nome.trim()

let objBotao = document.getElementById("cadastrarCliente");

let objLabelErro = document.getElementById("mensagem");

if(nome.length == 0)
{
    

    objLabelErro.innerHTML = "ATENÇÃO: O campo Nome do Cliente não pode estar vazio !!";

    objBotao.disabled = true;

    objLabelErro.style.color = "red";


}

else
{
    objLabelErro.innerHTML = nome + "!!!  Seja bem vindo ao nosso sistema de Cadastro  ";
    objBotao.disabled = false;
    objLabelErro.style.color = "green";
    objLabelErro.style.backgroundColor = "yellow"
}


}





let objNome =  document.getElementById("nomeCliente");
objNome.addEventListener("blur", validaForm);