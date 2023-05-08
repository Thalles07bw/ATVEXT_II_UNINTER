<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Basis | {{$nome_pagina}}</title>

    <!--Favicon-->
    <link
      rel="shortcut icon"
      href=""
      type="image/x-icon"
    />
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../resources/css/fontawesome-free/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="../resources/css/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../resources/css/adminlte.min.css">

</head>
  @include('alerts.alert-modal-delete')
  @include('alerts.alert-success')
  @include('alerts.alert-modal-error')
<body class="top-navigation layout-navbar-fixed sidebar-closed sidebar-collapse" style="height: auto;">
  <div class="wrapper">
    @if($visual != NULL)
      @if($visual[0]->cor)
      <nav class="main-header navbar navbar-expand navbar-light navbar-white" 
      style="background-color: {{$visual[0]->cor}}">
      @else
      <nav class="main-header navbar navbar-expand navbar-light navbar-white";>
      @endif
    @else
    <nav class="main-header navbar navbar-expand navbar-light navbar-white";>
    @endif
      <ul class="navbar-nav" style="margin-left: 50px">
        <li class="nav-item">
        @if($visual != NULL)
          @if($visual[0]->logo)
          <img width="75px" src="/teste/storage/app/{{$visual[0]->logo}}">
          @else
          <h2 class="titleSmall vaga">Vagas</h2>
          @endif
        @else
        <h2 class="titleSmall vaga">Vagas</h2>
        @endif       
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
      <!-- Redes Sociais -->
      @if($visual != NULL)
        @if($visual[0]->linkedin)
        <li class="nav-item">
          <a class="nav-link" target="_blank" rel="noopener noreferrer" href="{{$visual[0]->linkedin}}">
            <i class="fab fa-linkedin"></i>
          </a>
        </li>
        @endif
        @if($visual[0]->facebook)
        <li class="nav-item">
          <a class="nav-link" target="_blank" rel="noopener noreferrer" href="{{$visual[0]->facebook}}">
            <i class="fab fa-facebook"></i>
          </a>
        </li>
        @endif
        @if($visual[0]->twitter)
        <li class="nav-item">
          <a class="nav-link" target="_blank" rel="noopener noreferrer" href="{{$visual[0]->twitter}}">
            <i class="fab fa-twitter"></i>
          </a>
        </li>
        @endif
        @if($visual[0]->instagram)
        <li class="nav-item">
          <a class="nav-link" target="_blank" rel="noopener noreferrer"  href="{{$visual[0]->instagram}}">
            <i class="fab fa-instagram"></i>
          </a>
        </li>
        @endif
        @if($visual[0]->youtube)
        <li class="nav-item">
          <a class="nav-link" target="_blank" rel="noopener noreferrer" href="{{$visual[0]->youtube}}">
            <i class="fab fa-youtube"></i>
          </a>
        </li>
        @endif
      @endif     
    </ul>    
    </nav>
    <div class="content-wrapper">
      <div class="content">
        <div class="container"> 
          @foreach($vagas as $each)
          @if(strtotime($each->prazo_processo_seletivo) >= strtotime(date('Y-m-d')))                      
           <div class="row justify-content-center" style="padding-top:50px">
             <div class="card" style="width: 100%;">
               <div class="card-header">
                 <p class="pageText" style="text-align: left;">
                 <strong><h4>{{$each->titulo_vaga}} - {{$each->nome_senioridade}}</h4></strong> 
                </p>
              </div>
              <div class="card-body">
                <span><h6>
                  Inscrições até: {{date('d/m/Y', strtotime($each->prazo_processo_seletivo))}}</h6>
                  <br>
                  <h6>Vagas Ofertadas: {{$each->qtd_posicao}}</h5>
                </span>
                <span id="desc-cargo-{{$each->id_vaga}}" style="display: none;"><br><br>{!! $each->descricao_vaga !!}</span>
             </div>
             <div class="card-footer">
               <button style="float:right; margin-left: 5px" id="candidatar-se-{{$each->id_vaga}}" class="btn btn-success">Canditatar-se</button>
               <a id="show-desc-cargo-{{$each->id_vaga}}" style="float:right" class="btn btn-primary">Mais Detalhes</a>
               <a id="hide-desc-cargo-{{$each->id_vaga}}" style="float:right; display: none" class="btn btn-danger">Menos Detalhes</a>
             </div>
            </div>
          </div>
          @endif
          @endforeach
        </div>
      </div>
    </div>
  </div>
</body>
<!--JQuery-->
<script src="../resources/js/jquery/jquery.min.js"></script>
<!--Bootstrap 4.3.1-->
<script src="../resources/js/bootstrap/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
  $('a[id^="show-desc-cargo-"]').on('click', function(){
    let id = this.id;
    id = id.slice(16);
    $('#desc-cargo-'+id).show();
    $('#show-desc-cargo-'+id).hide();
    $('#hide-desc-cargo-'+id).show();
  })
  $('a[id^="hide-desc-cargo-"]').on('click', function(){
    let id = this.id;
    id = id.slice(16);
    $('#desc-cargo-'+id).hide();
    $('#show-desc-cargo-'+id).show();
    $('#hide-desc-cargo-'+id).hide();
  })
  $('button[id^="candidatar-se-"]').on('click', function(){
    let id = this.id;
    id = id.slice(14);

    $.ajax({
      url: "/teste/candidatar-se",
      data:{'id_vaga': id, 'id_candidato': '{{$id_usuario_candidato}}'},
      type: 'post'
    }).done(function(data){
      var data = JSON.parse(data);
      console.log(data);
      if(data.autenticacao == false){
        window.location.assign(data.redirect);
      }else{
        if(data.resposta == true){
        $('.success-alert-text').html('');
          $('.success-alert-text').html(data['mensagem']);
          $("#redirect-alert").attr("href", "/teste/portal-do-candidato");
          $('#alert-ok').show();
        }else{
          $('.error-alert-text').html('');
          $('.error-alert-text').html(data['mensagem']);
          $('#alert-modal-error').show();
        }
      }
    })
  })
</script>
@if($visual != NULL)
  @if($visual[0]->cor_icone)
  <script type="text/javascript">
    $(".fab").css('color', '{{$visual[0]->cor_icone}}') 
    $(".vaga").css('color', '{{$visual[0]->cor_icone}}');
  </script>
  @endif
@endif