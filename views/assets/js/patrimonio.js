const nomeInput = document.querySelector("#nomeEquipment");
const patrimonioIdInput = document.querySelector("#idPatr");

// Validate CEP Input
nomeInput.addEventListener("keypress", (e) => {
    const key = String.fromCharCode(e.keyCode);

    // allow only numbers
    if (!onlyLetters.test(key)) {
        e.preventDefault();
        return;
    }
});

nomeInput.addEventListener("keyup", (e) => {
    const inputValue = e.target.value;
   
    if (inputValue.length === 3 || inputValue.length > 3) {
        getDados(inputValue);
    }
    if (inputValue.length === 0) {
        document.getElementById('resultado-pesquisa2').innerHTML = "";
    }
});

const getDados = async (nome_equipamento) => {

    const response = await fetch('http://www.localhost/tcc2/busca-patrimonio/'+nome_equipamento);
   
    const patrimonio = await response.json();

    var conteudoHTML = "<ul class='list-group position-fixed'>";

    if(patrimonio['status']){
        for(i = 0; i < patrimonio['dados'].length; i++){

            conteudoHTML += "<li class='list-group-item list-group-itemaction' style='cursor: pointer; right: 10px; bottom: 40px' onclick='setPatrimonio("+patrimonio['dados'][i].id+","+JSON.stringify(patrimonio['dados'][i].num_invent)+")' >"+patrimonio['dados'][i].nome_equipamento+" | "+patrimonio['dados'][i].num_invent+"</li>"
        }
    }
    else{
        conteudoHTML += "<li class='list-group-item disable'>"+patrimonio['msg']+"</li>";
    }

    conteudoHTML += "</ul>";

    document.getElementById('resultado-pesquisa2').innerHTML = conteudoHTML;

};

function setPatrimonio(id, nome_equipamento){
    nomeInput.value = nome_equipamento;

    patrimonioIdInput.value = id;
    document.getElementById('resultado-pesquisa2').innerHTML = "";
}
