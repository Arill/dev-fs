'use strict';

var cepResp;

/*Teste de consistência do CEP:
    - Informações da busca não podem estar inconsistentes em relação ao CEP buscado.
    - Se um CEP válido nunca foi buscado, cepResp é indefinido e portanto o teste também falha
    */
function checkConsistency() {
    if (document.getElementById('logra').value != cepResp.logradouro ||
        document.getElementById('bairro').value != cepResp.bairro ||
        document.getElementById('cidade').value != cepResp.localidade ||
        document.getElementById('uf').value != cepResp.uf) {
        alert("Dados de CEP e Endereço inconsistentes, por favor, verifique os dados e tente novamente.");
        console.log(cepResp);
        return false;
    }
    else
        //Dados do CEP buscados e nos fields conferem
        return true;
}

window.addEventListener('load', function() {
    var procurarCEP = document.getElementById('procurarCEP');
    procurarCEP.addEventListener('click', function() {
        //Recupera informações do CEP da API
        $.get('/retrieveCEP/' + document.getElementById('cep').value)
        .done(function(dados){
            try {
                //Converte a string para um objeto JSON
                cepResp = JSON.parse(dados);
            } catch (exception) {
                //Erro: API não retornou um resultado - CEP incompleto
                alert("Digite um CEP completo.");
                document.getElementById('cep').value = "";
                return;
            }
            //Erro: API retornou um objeto com propriedade "erro" => "true"
            if (dados.erro) {
                alert("CEP Inválido. Por favor, digite um CEP válido");
                document.getElementById('cep').value = "";
                return;
            }
            else {
                //Assigna o valor dos fields
                document.getElementById('logra').value = cepResp.logradouro;
                document.getElementById('bairro').value = cepResp.bairro;
                document.getElementById('cidade').value = cepResp.localidade;
                document.getElementById('uf').value = cepResp.uf;
            }
        },'json')
    }, false);

    // Validação de form - Bootstrap
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
    form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false || !checkConsistency()) {
            event.preventDefault();
            event.stopPropagation();
        }
        form.classList.add('was-validated');
    }, false);
    });
}, false);