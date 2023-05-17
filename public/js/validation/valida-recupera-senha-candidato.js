$(document).ready(function(){

  $("#form-recupera-senha").on('submit', function(e){
    e.preventDefault();
    let data = $("#form-recupera-senha").serialize()
    $.ajax({
      type: 'post',
      url: '/recuperar-senha-candidato',
      data: data,
      beforeSend: function(){
      $("#row-carregando").show();
      }
    }).done(function(data){
      $("#row-carregando").hide();
      var data = JSON.parse(data);
      console.log(data);
      if(data.flag == true){
        $("#alert-ok").show();
        $(".success-alert-text").html(data.mensagem);
        $("#redirect-alert").attr("href", "/login-candidato");

      }else{
        if(data.falha == 1){
          $("#alert-error").show();
          $(".error-alert-text").html('');
          $(".error-alert-text").html(data.mensagem);

        }else if(data.falha == 2){
          $("#alert-error").show();
          $(".error-alert-text").html('');
          $(".error-alert-text").html(data.mensagem);

        }else if(data.falha == 3){
          $("#alert-error").show();
          $(".error-alert-text").html('');
          $(".error-alert-text").html(data.mensagem);

        }else{
          $("#alert-error").show();
          $(".error-alert-text").html('');
          $(".error-alert-text").html(data.mensagem);
        }
      }
    })
  })
});