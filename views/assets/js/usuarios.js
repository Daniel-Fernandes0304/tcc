const usuarioInput = document.querySelector("#nomeUsuario");
const usuarioIdInput = document.querySelector("#id");
const senhaInput = document.querySelector("#senhaUser");
const senhaInput2 = document.querySelector("#csenha");

// Validate NOME Input
usuarioInput.addEventListener("keypress", (e) => {
    const onlyLetters = /^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/;
    const key = String.fromCharCode(e.keyCode);

    if (!onlyLetters.test(key)) {
        e.preventDefault();
        return;
    }
});


usuarioInput.addEventListener("keyup", (e) => {
    const inputValue = e.target.value;

    if (inputValue.length === 3 || inputValue.length > 3) {
        getDados(inputValue);
    }
    if (inputValue.length === 0) {
        document.getElementById('resultado-pesquisa').innerHTML = "";
    }
});


senhaInput2.addEventListener("focusout", (e) => {
    const inputValue = e.target.value;
    if(senhaInput2.value != senhaInput.value){
        document.getElementById('csenha').value = "";
        alert("Senha e confirmação de senha não conferem!");
    }
});


const getDados = async (nome) => {


    const response = await fetch('http://www.localhost/tcc2/busca-usuarios/'+nome);
   
    const usuario = await response.json();

    var conteudoHTML = "<ul class='list-group position-fixed'>";

    if(usuario['status']){
        for(i = 0; i < usuario['dados'].length; i++){

            conteudoHTML += "<li class='list-group-item list-group-itemaction' style='cursor: pointer; right: 115px; bottom: -50px' onclick='setUsuario("+usuario['dados'][i].id+","+JSON.stringify(usuario['dados'][i].nome)+","+usuario['dados'][i].senha+")' >"+usuario['dados'][i].nome+"</li>"
        }
    }
    else{
        conteudoHTML += "<li class='list-group-item disable'>"+usuario['msg']+"</li>";
    }

    conteudoHTML += "</ul>";

    document.getElementById('resultado-pesquisa').innerHTML = conteudoHTML;

};

function setUsuario(id, nome, senha){
    usuarioInput.value = nome;
    usuarioIdInput.value = id;
    senhaInput.value = senha;

    document.getElementById('resultado-pesquisa').innerHTML = "";
}

