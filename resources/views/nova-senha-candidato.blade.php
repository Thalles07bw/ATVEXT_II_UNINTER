<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Basis | Criação de Senha</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/css/fontawesome-free/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="/css/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/css/adminlte.min.css">
    <!-- css adicional -->
    <link rel="stylesheet" href="/css/app.css">
  </head>

  <body style="min-height: 466px; background-color:#007bff">

    <div class= "row-paginas-senha">
      
      <!--Alertas
      <div id="alert-senha-diferente" class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none"> 
        <span>As senhas não são iguais! Por favor repita o procedimento.</span>
        <button type="button" class="close" onclick="$('#alert-senha-diferente').hide()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div id="alert-token-invalido" class="alert alert-danger" role="alert" style="display: none"> 
        <span style="margin-right:10px;">O código de verificação não é valido.</span>
        <button type="button" class="close" onclick="$('#alert-token-invalido').hide()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div id="alert-senha-anterior" class="alert alert-danger" role="alert" style="display: none"> 
        <span style="margin-right:10px;">A nova senha não pode ser igual a antiga.</span>
        <button type="button" class="close" onclick="$('#alert-senha-anterior').hide()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal fade show" id="alert-ok" style="display: none; padding-right: 15px;" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-sm">
          <div class="modal-content bg-success">
            <div class="modal-header">
              <h4 class="modal-title">Tudo Certo!</h4>
            </div>
            <div class="modal-body">
              Sua senha foi Alterada com Sucesso. Clique em <strong>OK     
              </strong> para ir a página de Login.
            </div>
            <div class="modal-footer justify-content-between">
              <a href="/login" class="btn btn-outline-light">OK</a>
            </div>
          </div>
        </div>
      </div>
      Fim Alertas-->
      @include('alerts.alert-error')
      @include('alerts.alert-success')
      <div class="card card-outline card-orange card-max-wdt mx-auto">
        <div class="card-header" style="text-align: center">
          <a href="https://basis.com.br" class="h1"><b>Basis &nbsp;</b></a>
        </div>
        <div class="card-body">
          <form id="form-cadastra-senha" method="post">
            @csrf
              <label style="text-align: center">Digite a nova senha</label>
              <div class="input-group mb-3">        
                <input type="password" id="senha" name="senha" class="form-control" placeholder="Senha" required>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>
              <label style="text-align: center">Repita a nova senha</label>
              <div class="input-group mb-3">        
                <input type="password" id="senha-repeticao" name="senha-repeticao" class="form-control" placeholder="Repita a senha" required>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <button type="submit" class="btn btn-primary btn-block">Definir</button>
                </div>
              </div>
          </form>
        </div>
      </div>
    </div>
  </body>
  <footer>
    <script src="/js/jquery/jquery.min.js"></script>
    <script src="/js/bootstrap/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
      $("#form-cadastra-senha").on('submit', function(e){
        e.preventDefault();
        let data = $("#form-cadastra-senha").serialize();
        var url_string = window.location.href
        var url = new URL(url_string);
        var token = url.searchParams.get("token");
        data = data + '&token=' + token;

        if($("#senha").val() === $("#senha-repeticao").val()){
          $.ajax({
            type: 'post',
            url: '/nova-senha-candidato?q='+ token,
            data: data
            
          }).done(function(data){
            data = JSON.parse(data);
            console.log(data);
            if(data.flag == true){
              $(".success-alert-text").html(data.mensagem); 
              $("#alert-ok").show(); 
              $("#redirect-alert").attr("href", "/login-candidato");
          
            }else if(data.falha == 1){
             
              $(".error-alert-text").html('');
              $(".error-alert-text").html(data.mensagem);
              $("#alert-error").show();
            }else if(data.falha == 2){
              
              $(".error-alert-text").html('');
              $(".error-alert-text").html(data.mensagem);
              $("#alert-error").show();
            }
          })
        }else{
         
          $(".error-alert-text").html('');
          $(".error-alert-text").html('As senhas digitadas são diferentes');
          $("#alert-error").show();
        }
      })      
    </script>
  </footer>
</html>