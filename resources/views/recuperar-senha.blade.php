<html>
  <head>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Basis | Recuperação de Senha</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="resources/css/fontawesome-free/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="resources/css/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="resources/css/adminlte.min.css">
    <!-- css adicional -->
    <link rel="stylesheet" href="resources/css/app.css">
  </head>
  </head>
  <body>
    <div class= "row-paginas-senha">
    <!--Alertas-->
      @include('alerts.alert-error')
      @include('alerts.alert-success')
      <!--Fim Aletras-->
      <div class="card card-outline card-orange card-max-wdt mx-auto">
        <div class="card-header" style="text-align: center">
          <a href="https://basis.com.br" class="h1"><b>Basis &nbsp;</b></a>
        </div>
        <div class="card-body">
          <form id="form-recupera-senha" method="post">
            @csrf
              <label style="text-align: center">Digite o e-mail cadastrado para receber o link <br> para cadastrar uma nova senha</label>
              <div class="input-group mb-3">        
                <input type="email" name="email" class="form-control" placeholder="E-mail" required>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <button type="submit" class="btn btn-primary btn-block">Enviar</button>
                </div>
              </div>
              <!--Carregando envio-->
              <div class="row" id="row-carregando" style="display: none;">
                <div class="col-12">
                 <center><img src="https://img.ibxk.com.br/2014/3/materias/4805475817181134.gif" width="200px"></center>
                </div>
              </div>
                
          </form>
          <div class="row">
            <div class="col-12" style="text-align: right; padding-top: 15px">             
                <a href="/teste/login">Retornar a página de Login</a>              
            </div>
          </div>
        </div>
      </div>
    
    </div>
  </body>
  <footer>
    <script src="resources/js/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="resources/js/validation/valida-recupera-senha.js"></script>
  </footer>
</html>