$(document).ready(function(){

  $("#telefone-cliente").mask("(00) 00000-0000");

  $("#telefone-empresa").mask("(00) 00000-0000");

  $("#cpf").mask("000.000.000-00")


  /*Ajax*/

  $("#form-cadastro").on('submit', function(e){
    e.preventDefault();
    var data = $("#form-cadastro").serialize();
    console.log(data);

    if($('#cidade').val() == 0 || $('#estado').val() == 0 || $('#pais').val() == 0 ||
    $('#termos').is(":checked") == false || $('#telefone-empresa').val() == '' ||
    $('#nome-empresa').val() == '' || $('#id-tamanho-empresa').val == 0 || 
    $('#tipo-cliente').val() == 0 || $('#telefone-cliente').val() == '' ||
    $('#email-cliente').val() ==  '' || $('#nome-cliente').val() == ''){
      
      if ($('#nome-empresa').val() == ''){
        $('#nome-empresa').css('border-color', 'red');
      }else{
        $('#nome-empresa').css('border-color', '#ced4da');
      }

      if ($('#telefone-empresa').val() == ''){
        $('#telefone-empresa').css('border-color', 'red');
      }else{
        $('#telefone-empresa').css('border-color', '#ced4da');
      }

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

      if ($('#cidade').val() == 0){
        $('#selecao-cidade').find('.select2-selection').css('border-color', 'red');
      }else{
        $('#selecao-cidade').find('.select2-selection').css('border-color', '#ced4da');
      }

      if($('#estado').val() == 0){
        $('#selecao-estado').find('.select2-selection').css('border-color', 'red');
      }else{
        $('#selecao-estado').find('.select2-selection').css('border-color', '#ced4da');
      }

      if($('#pais').val() == 0){
        $('#selecao-pais').find('.select2-selection').css('border-color', 'red');
      }else{
        $('#selecao-pais').find('.select2-selection').css('border-color', '#ced4da');
      }

      if($('#id-tamanho-empresa').val() == 0){
        $('#id-tamanho-empresa').css('border-color', 'red');
      }else{
        $('#id-tamanho-empresa').css('border-color', '#ced4da');
      }

      if($('#tipo-cliente').val() == 0){
        $('#tipo-cliente').css('border-color', 'red');
      }else{
        $('#tipo-cliente').css('border-color', '#ced4da');
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
        url: '/teste/registrar',
        data: data
        
      }).done(function(data){
        data = JSON.parse(data);
        console.log(data);
        if(data.flag == true){
          $('.success-alert-text').html('');
          $('.success-alert-text').html(data.mensagem);
          $("#redirect-alert").attr("href", "/teste/registrar");
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