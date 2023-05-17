<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Basis | Login</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/css/fontawesome-free/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="/css/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/css/adminlte.min.css">
  </head>
  @if($message ?? '')
  <div class="alert alert-danger alert-dismissible fade show" role="alert" >
    <span>{{$message ?? ''}}</span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endif
  <body class="login-page" style="min-height: 466px;">
    <div class="login-box">
    <!-- /.login-logo -->
      <div class="card card-outline card-orange">
      <div class="card-header text-center">
        <a href="https://basis.com.br" class="h1">
        <img src="/img/logo.png" width="80px"></img>
        <img src="/img/logo_letras.png" width="80px"></img>
      </a>
      </div>

      <div class="card-body">
        <p class="login-box-msg">Faça Login para continuar</p>

        <form method="post">
          @csrf
          <div class="input-group mb-3">
            <input type="email" name="email" class="form-control" placeholder="Usuário" required> 
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" name="senha" class="form-control" placeholder="Senha" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Entrar</button>
          </div>
          <!-- /.col -->
        </div>
        <div class="row">
          <div class="col-12" style="text-align: right; padding-top: 15px">
             
              <a href="/recuperar-senha">Esqueci minha senha</a> 
             
          </div>
        </div>
      </form>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="/js/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/js/bootstrap/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/js/adminlte.min.js"></script>
</body>
</html>
