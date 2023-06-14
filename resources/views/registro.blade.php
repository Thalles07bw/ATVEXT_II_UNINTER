<html>
  <head>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quero Trampar | Registro de usuários</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/css/fontawesome-free/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="/css/icheck-bootstrap.min.css">
    <!--select2-->
    <link rel="stylesheet" href="vendor/select2/select2/dist/css/select2.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/css/adminlte.min.css">
    <!-- css adicional -->
    <link rel="stylesheet" href="/css/app.css">
  </head>
  </head>
  <body>
    <div class="row-paginas-cadastro">
      <!--Alertas-->
      @include('alerts.alert-modal-error')
      @include('alerts.alert-success')
      <!--Fim Alertas-->
      <div class="register-box register-box-cadastro" >
        <div class="card card-outline card-orange card-max-wdt mx-auto">
          <div class="card-header text-center">
            <a href="../../index2.html" class="h1"><b>Basis</b></a>
          </div>
          <div class="card-body">
            <p class="login-box-msg">Faça o registro para receber o e-mail para cadastrar a senha</p>

            <form method="post" id="form-cadastro">
            @csrf
              <label>Dados Pessoais</label>
              <div class="input-group mb-3">
                <input type="text" class="form-control" name="nome-cliente" id="nome-cliente" 
                placeholder="Nome Completo">
                <div class="input-group-append">
                  <div class="input-group-text" style="padding: 10px; width: 40px;">
                    <span class="fas fa-user"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <input type="email" class="form-control" name="email-cliente" id="email-cliente"
                 placeholder="E-mail">
                <div class="input-group-append">
                  <div class="input-group-text" style="padding: 10px; width: 40px;">
                    <span class="fas fa-envelope"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <input type="tel" id="telefone-cliente" class="form-control" name="telefone-cliente"
                 id="telefone-cliente" placeholder="Telefone">
                <div class="input-group-append">
                  <div class="input-group-text" style="width: 40px">
                    <span class="fas fa-mobile-alt"></span>
                  </div>
                </div>
              </div>
              <label>Detalhes da Sua Empresa</label>
              <div class="input-group mb-3">
                <select class="form-control" id="tipo-cliente" name="tipo-cliente" id="tipo-cliente">
                  <option value="0">Selecione o tipo da empresa</option>
                  @foreach ($arrayTipos as $tipos)              
                  <option value="{{$tipos->id_tipo_cliente}}">{{$tipos->tipo_cliente}}</option>  
                  @endforeach
                </select>
                <div class="input-group-append">
                  <div class="input-group-text" style="width: 40px">
                    <span class="fas fa-building"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <select class="form-control" id="id-tamanho-empresa" name="id-tamanho-empresa">
                  <option value="0">Selecione o tamanho da empresa</option>
                  @foreach ($arrayTamanhoEmpresas as $tamanhoEmpresas)              
                  <option value="{{$tamanhoEmpresas->id_tamanho_empresa}}">
                    {{$tamanhoEmpresas->tamanho_empresa}}</option>  
                  @endforeach
                </select>
                <div class="input-group-append">
                  <div class="input-group-text" style="width: 40px">
                    <span class="fas fa-building"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <input type="text" id="nome-empresa" name="nome-empresa" class="form-control" placeholder="Razão Social">
                <div class="input-group-append">
                  <div class="input-group-text" style="width: 40px">
                    <span class="fas fa-building"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <input type="text" id="telefone-empresa" name="telefone-empresa" class="form-control" placeholder="Telefone da Empresa">
                <div class="input-group-append">
                  <div class="input-group-text" style="width: 40px">
                    <span class="fas fa-phone"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3" id="selecao-pais">
              <select class="form-control" id="pais" name="pais">
                  <option value="0">Selecione o país</option>
                  @foreach ($arrayPaises as $paises)              
                  <option value="{{$paises->id_pais}}">{{$paises->nome_pais}}</option>  
                  @endforeach
                </select>
                <div class="input-group-append">
                  <div class="input-group-text" style="width: 40px">
                    <span class="fas fa-globe-americas"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3" id="cep">
              <input class="form-control" id="num-cep" placeholder="CEP" type="text">
              <button id="busca-cep" class="btn btn-primary">Buscar CEP</button>
              </div>
              <div class="input-group mb-3" id="selecao-estado">
                <select class="form-control" id="estado" name="estado" readonly>
                    <option value="0">Selecione o estado</option>
                    @foreach ($arrayEstados as $estados)              
                    <option value="{{$estados->id_estado}}">{{$estados->nome_estado}}</option>  
                    @endforeach
                  </select>
                <div class="input-group-append">
                  <div class="input-group-text" style="width: 40px">
                    <span class="fas fa-map-marked-alt"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3" id="selecao-cidade">
                 <select class="form-control" id="cidade" name="cidade" readonly>
                    <option value="0">Selecione a cidade</option>
                    @foreach ($arrayCidades as $cidades)              
                    <option value="{{$cidades->id_cidade}}">{{$cidades->nome_cidade}}</option>  
                    @endforeach
                  </select>
                <div class="input-group-append">
                  <div class="input-group-text" style="width: 40px">
                    <span class="fas fa-city"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-8">
                  <div class="icheck-primary">
                    <input type="checkbox" id="termos" name="termos" value="agree">
                    <label for="termos">
                    Estou de acordo com os <a href="#">termos</a>
                    </label>
                  </div>
                  <span id="erro-termos" class="error invalid-feedback" style="display: none;">É necessário aceitar os termos</span>
                </div>          
                <!-- /.col -->
                <div class="col-4">
                  <button type="submit" class="btn btn-primary btn-block">Registrar</button>
                </div>
                <!-- /.col -->
              </div>
            </form>

            <a href="/login" class="text-center">Eu já tenho um registro</a>
          </div>
          <!-- /.form-box -->
        </div><!-- /.card -->
      </div>
    </div>
  </body>
  <footer>
    <script src="/js/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="vendor/select2/select2/dist/js/select2.min.js"></script>
    <!--Mascaras-->
    <script src="vendor/igorescobar/jquery-mask-plugin/dist/jquery.mask.min.js"></script>
    <script src="/js/validation/valida-registro.js"></script>
    <script type="text/javascript">
    $("#busca-cep").on('click', function(e){
      e.preventDefault();
      var cep = $("#num-cep").val();
      var url = 'https://viacep.com.br/ws/'+cep+'/json/';
      $.ajax({
        url: url,
        dataType: 'json',
        type: 'get'
      }).done(function(data){
        console.log(data);
        var cidade = data.localidade;
        var estado = data.uf;
        
        $('#selecao-cidade option').filter(function () {
          $('#selecao-cidade option:selected').attr('selected', null)
          return $(this).html() == cidade;
        }).attr('selected', 'selected')

        $('#selecao-estado option').filter(function () {
          $('#selecao-estado option:selected').attr('selected', null)
          return $(this).html() == estado;
        }).attr('selected','selected')

      })
     })
    </script>
  </footer>
</html>