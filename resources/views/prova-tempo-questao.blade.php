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
<body class="top-navigation layout-navbar-fixed sidebar-closed sidebar-collapse" style="height: auto;">
  <div class="wrapper">
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
      <div class="container ">
        <h2 class="titleSmall" style="text-align: center;">{{$titulo_prova}}</h2>
      </div>
      <div class="alert alert-primary" id="timer-color" style="width: 250px;"><b><span>Tempo Restante:&nbsp;&nbsp;
        <span id="timer"></span></span></b></div>
        <input id="tempo-questao" value="{{$tempo_questao}}" hidden> 
    </nav>

    <div class="content-wrapper">
      <div class="content">
        <div class="container">  
          <form method="POST" name="prova" id="prova">
          @csrf
          <input id="n-questao" name="n-questao" type="number" hidden value="{{$next_questao}}">
          <input id="token" name="token" type="text" hidden value="{{$token}}">
           <div class="row justify-content-center" style="padding-top:100px">
             <div class="card" style="width: 100%;">
               <div class="card-header">
                 <p class="pageText" style="text-align: left;">
                 <strong> {!! $questao_prova !!}</strong> 
                </p>
              </div>
              <div class="card-body">
                <table width="100%" cellspacing="1" cellpadding="1">
                  <tbody>
                    @foreach($alternativas as $each)
                    <tr>
                      <td valign="top" width="20">
                        <input  name="alternativa" value="{{$each->id_resposta_prova}}" type="radio">
                      </td>
                      <td>
                        <span>{{$each->resposta_prova}}</span>
                      </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
             </div>
             <div class="card-footer">
                <p style="text-align: left;">
                  <input class="btn btn-primary" id="submeter-questao" type="submit" value="Submeter">
                </p>
              </div>
            </div>
          </form>
          </div>
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
$(document).ready(function(){
  history.pushState(null, document.title, location.href);
  window.addEventListener('popstate', function (event)
  { 
    alert('Você não pode retornar a página anterior');
    history.pushState(null, document.title, location.href);
  });
});
</script>
<script>
function startTimer(duration, display) {
  var timer = duration, minutes, seconds;
  
  if(timer >= 0){
    setInterval(function () {
        
      minutes = parseInt(timer / 60, 10);
      seconds = parseInt(timer % 60, 10);
      minutes = minutes < 10 ? "0" + minutes : minutes;
      seconds = seconds < 10 ? "0" + seconds : seconds;
      display.textContent = minutes + ":" + seconds;
      if(minutes < '15'){
        $("#timer-color").removeClass('alert-primary')
        $("#timer-color").addClass('alert-warning')
      }
      if(minutes == '04'){
        $("#timer-color").removeClass('alert-warning')
        $("#timer-color").addClass('alert-danger')
      }
      if(minutes == '00' && seconds == '00'){
        alert("Seu tempo acabou, você irá avançar para a próxima questão, se alguma questão foi marcada ela será considerada");
        document.forms["prova"].submit();        
      }
      if (--timer < 0) {
        timer = duration;
      }
    }, 1000);
  }
}
window.onload = function () {
    var duration = 60 * $("#tempo-questao").val(); // Converter para segundos
      display = document.querySelector('#timer'); // selecionando o timer
    startTimer(duration, display); // iniciando o timer

};
</script>
