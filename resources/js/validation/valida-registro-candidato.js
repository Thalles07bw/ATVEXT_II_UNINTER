$(document).ready(function(){

  $("#telefone-cliente").mask("(00) 00000-0000");

  $("#telefone-empresa").mask("(00) 00000-0000");

  $("#cpf").mask("000.000.000-00");


  /*Ajax*/

  $("#form-cadastro").on('submit', function(e){
    e.preventDefault();
    var data = $("#form-cadastro").serialize();

    if(
    $('#termos').is(":checked") == false || $('#cpf').val() == '' ||
    $('#email-cliente').val() ==  '' || $('#nome-cliente').val() == ''){
          

      if ($('#nome-cliente').val() == ''){
        $('#nome-cliente').css('border-color', 'red');
      }else{
        $('#nome-cliente').css('border-color', '#ced4da');
      }

      if ($('#telefone-cliente').val() == ''){
        $('#telefone-cliente').css('border-color', 'red');
      }else{
        $('#telefone-cliente').css('border-color', '#ced4da');
      }

      if ($('#email-cliente').val() == ''){
        $('#email-cliente').css('border-color', 'red');
      }else{
        $('#email-cliente').css('border-color', '#ced4da');
      }

      if ($('#cpf').val() == ''){
        $('#cpf').css('border-color', 'red');
      }else{
        $('#cpf').css('border-color', '#ced4da');
      }

    
      if($('#termos').is(":checked") == false){
        $('#erro-termos').css('display', 'inline');
      }else{
        $('#erro-termos').hide();
      }
      $('.error-alert-text').html('');
      $('.error-alert-text').html('Preencha os campos marcados em vermelho para continuar');
      $('#alert-modal-error').show();

    }
    else{
      $.ajax({
        type: 'post',
        url: '/teste/registro-candidato',
        data: data
        
      }).done(function(data){
        data = JSON.parse(data);
        console.log(data);
        if(data.flag == true){
          $('.success-alert-text').html('');
          $('.success-alert-text').html(data.mensagem);
          $("#redirect-alert").attr("href", "/teste/registro-candidato");
          $('#alert-ok').show();
        }else{
          $('.error-alert-text').html('');
          $('.error-alert-text').html(data.mensagem);
          $('#alert-modal-error').show();
        }
      })
    }
  })
})