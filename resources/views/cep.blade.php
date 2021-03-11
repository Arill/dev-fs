<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <link rel="stylesheet" href="/css/app.css">
    <script src="/js/app.js"></script>
    <script src="/js/checkout.js"></script>

    <title>Formulário de Pedido</title>    
  </head>

  <body>
  <body class="bg-light">

<div class="container">
  <div class="py-5 text-center">
    <img class="d-block mx-auto mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
    <h2>Formulário de Pedido</h2>
    <p class="lead">Preencha as suas informações pessoais para prosseguir com o pedido.</p>
  </div>

  <div class="row">
    <div class="col-md-12 order-md-1">
      <h4 class="mb-6">Informações pessoais</h4>
      <form action="/submitPedido" class="needs-validation" method="POST" novalidate>
        @csrf
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
            <div class="invalid-feedback">
              Preencha o seu nome.
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="sobrenome">Sobrenome</label>
            <input type="text" class="form-control" id="sobrenome" name="sobrenome" required>
            <div class="invalid-feedback">
              Preencha o seu sobrenome.
            </div>
          </div>
        </div>
        <div class="mb-3">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="nome@email.com" required>
          <div class="invalid-feedback">
            Preencha um endereço de email válido.
          </div>
        </div>

        <h4 class="mb-6">Endereço</h4>
        <div class="row">
            <div class="col-md-5 mb-3">
                <label class="form-label" for="cep">CEP</label>
                <div class="input-group">
                    <input type="text" class="form-control" style="-webkit-appearance: none;" id="cep" name="cep" maxlength="8" required>
                    <div class="input-group-append">
                        <button class="btn btn-primary" id="procurarCEP" type="button">Procurar CEP</button>
                    </div>
                    <div class="invalid-feedback" id="cep_validation" style="width: 100%;">
                        Digite um CEP válido.
                    </div>
                </div>
            </div>

            <div class="col-md-5 mb-3">
                <label for="logra">Logradouro <span class="text-muted">(Rua, Avenida, Travessa, etc.)</span></label>
                    <input type="text" class="form-control" id="logra"  name="logra" required>
                    <div class="invalid-feedback" style="width: 100%;">
                        Logradouro inválido.
                    </div>
            </div>
            <div class="col-md-2 mb-3">
                <label for="logra">Nº</label>
                <input type="input-group-text" class="form-control" id="numero" name="numero" required>
                    <div class="invalid-feedback" style="width: 100%;">
                        Número inválido.
                    </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 mb-3">
            <label for="complemento">Complemento</label>
            <input type="text" class="form-control" id="complemento" name="complemento" placeholder="Apartamento, bloco, etc.">
            </div>
          <div class="col-md-4 mb-3">
            <label for="bairro">Bairro</label>
            <input type="text" class="form-control" id="bairro" name="bairro" required>
            <div class="invalid-feedback">
                Bairro inválido.
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <label for="uf">Cidade</label>
            <input type="text" class="form-control" id="cidade" name="cidade" required>
            <div class="invalid-feedback">
                Cidade inválida.
            </div>
          </div>
          <div class="col-md-2 mb-3">
            <label for="zip">UF</label>
            <input type="text" class="form-control" id="uf" name="uf" required>
            <div class="invalid-feedback">
                UF inválido.
            </div>
          </div>
        </div>
        <hr class="mb-4">
        <button class="btn btn-primary btn-lg btn-block" type="submit">Finalizar Pedido!</button>
      </form>
    </div>
  </div>
  <footer><br/></footer>
</div>
  </body>
</html>