window.addEventListener('load', function() {
    //Carrega a lista de pedidos pela API
    $.get('/tabelaPedidos')
    .done(function(dados){
        document.getElementById('tabelaPedidos').innerHTML = dados;
    },'json')
}, false);