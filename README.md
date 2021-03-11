
# Petiko - Processo seletivo - Projeto Técnico.

Este projeto foi desenvolvido para o processo seletivo Petiko.

# Dependências necessárias:

* **Docker** 3.2.1 (61626)
* **Laravel** 8
* **Linux** ou uma instalação devidamente configurada do **WLS2** (ativar suporte ao WLS2 no Docker, se for o caso).

# Utilização:

No terminal, navegar até a pasta `/vendor/bin/`

Executar o comando `./sail up`

Este comando irá construir o container para a aplicação (se o mesmo não existir), e iniciará o host da aplicação.

Para utilizar o app, digite na barra de endereços do navegador

`localhost/cep`

Clicar em finalizar pedido irá criar uma entrada no banco de pedidos. Pedidos previamente registrados podem ser visualizados em:

`localhost/pedidos`