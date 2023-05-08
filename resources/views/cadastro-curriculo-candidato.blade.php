@include('partials.header-candidato')
  <!--Alerts-->
  @include('alerts.alert-modal-delete')
  @include('alerts.alert-success')
  @include('alerts.alert-modal-error')
<body>
  <!-- Begin Page Content -->
  <div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 ">Meu Currículo</h1>
    </div>
    <div class="row">
      <div class="card shadow col-md-12">
        <div class="card-header py-3">
          <h4>Dados Principais</h4>
        </div>
        <div class="card-body">
          <form id="cadastro-curriculo" method="POST">
            @csrf  
            <div class="row">
              <div class="col-md-6">
                <label>Nome Completo: </label>
                <input class="form-control" type="text" name="nome-candidato" id="nome-candidato" value="{{$nome}}">
              </div>
              <div class="col-md-6">
                <label>E-mail: </label>
                <input class="form-control" type="email" name="email-candidato" id="email-candidato" value="{{$email}}">
              </div>               
            </div>
            <br>
            <div class="row">
              <div class="col-md-4">
                <label>Telefone: </label>
                <input class="form-control" type="tel" maxlength="15" name="telefone-candidato" id="telefone-candidato">
              </div>
              <div class="col-md-4" style="padding-top: 40px;">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" id="whatsapp-check" name="whatsapp-check" checked>
                  <label for="whatsapp-check">
                    Este número tem whatsapp?
                  </label>
                </div>
              </div>
              <div class="col-md-4" id="whatsapp-input" style="display: none;">
                <label>Whatsapp: </label>
                <input class="form-control" maxlength="15" type="tel" name="whatsapp-candidato" id="whatsapp-candidato">
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-md-4">
                <label>CPF: </label>
                <input class="form-control" type="cpf" maxlength="14" name="cpf-candidato" id="cpf-candidato" value="{{$cpf}}">
                <span id="erro-cpf" class="error invalid-feedback" style="display: none; color: red; font-size: 14px">CPF inválido</span>
              </div> 
              <div class="col-md-4">
                <label>Data de Nascimento: </label>
                <input class="form-control" type="date" name="dn-candidato" id="dn-candidato">
              </div>
              <div class="col-md-4">
                <label>Gênero: </label>
                <select class="form-control" id="genero" name="genero">
                  <option value="0">Selecione seu Gênero</option>
                  @foreach($generos as $each)
                  <option value="{{$each->id_genero}}">{{$each->nome_genero}}</option>
                  @endforeach
                </select>               
              </div>  
            </div>
            <br>
            <div class="row">
              <div class="col-md-4">
                <label>Estado Civil: </label>
                <select class="form-control" id="estado-civil" name="estado-civil">
                  <option value="0">Selecione seu Estado Civil</option>
                  @foreach($estado_civil as $each)
                  <option value="{{$each->id_estado_civil}}">{{$each->nome_estado_civil}}</option>
                  @endforeach
                </select>               
              </div> 
              <div class="col-md-4">
                <label>Tenho interesse em vagas do tipo: </label>
                <select class="form-control" id="senioridade" name="senioridade">
                  <option value="0">Selecione o nível</option>
                  @foreach($senioridades as $each)
                  <option value="{{$each->id_senioridade}}">{{$each->nome_senioridade}}</option>
                  @endforeach
                </select>               
              </div> 
              <div class="col-md-4">
                <label>Possui Necessidade Especial: </label>
                <select class="form-control" id="necessidade-especial" name="necessidade-especial">
                  <option value="0">Não</option>
                  <option value="1">Sim</option>                  
                </select>               
              </div>     
            </div>
            <br>
            <div class="row" id="input-desc-necessidade" style="display: none;">
              <div class="col-md-12" >
                <label>Descreva sua necessidade especial</label>
                <textarea class="form-control" id="desc-necessidade" name="desc-necessidade"></textarea>
              </div>        
            </div>
            <br>
            <div class="row">                      
              <div class="col-md-5">
                <label>Digite seu CEP para busca automática do endereço</label>
                <input class="form-control" id="num-cep" name="num-cep" maxlength="9">
                <input id="cep-erro" value="1" hidden>   
                <span><a href="https://buscacepinter.correios.com.br/app/endereco/index.php"> Não sei meu CEP</a></span> 
              </div>
              <div class="col-md-6">
                <label>Rua</label>
                <input class="form-control" id="logradouro"  name="logradouro" readonly="true">    
              </div>
              <div class="col-md-1">
                <label>Número</label>
                <input class="form-control" id="numero-endereco" name="numero-endereco">    
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-md-4">
                <label>Bairro</label>
                <input class="form-control" id="bairro" name="bairro" readonly="true">    
              </div>
              <div class="col-md-5">
                <label>Cidade</label>
                <input class="form-control" id="cidade" name="cidade" readonly="true">    
              </div>
              <div class="col-md-1">
                <label>Estado</label>
                <input class="form-control" id="estado" name="estado" readonly="true">    
              </div>
            </div>
          </div>   
        <div class="card-footer">
          <input class="btn btn-primary" type="submit" value="Salvar">
        </form>
        </div>
      </div>
    </div>
  </div>
</body>
@include('partials.footer-candidato')

  


<script type="text/javascript">
$(document).ready(function() {
  $("#telefone-candidato").mask("(00) 00000-0000");
  $("#whatsapp-candidato").mask("(00) 00000-0000");
  $("#num-cep").mask("00000-000");
  $("#cpf-candidato").mask("000.000.000-00");

  function validaCpf(cpf){

    num1 = cpf.slice(0,1);
    num2 = cpf.slice(1,2);
    num3 = cpf.slice(2,3);
    num4 = cpf.slice(4,5);
    num5 = cpf.slice(5,6);
    num6 = cpf.slice(6,7);
    num7 = cpf.slice(8,9);
    num8 = cpf.slice(9,10);
    num9 = cpf.slice(10,11);
    num10 = cpf.slice(12,13);
    num11 = cpf.slice(13,14);
  

    if((num1 == num2) && (num2 == num3) && (num3 == num4) && (num4 == num5) && 
    (num5 == num6) && (num6 == num7) && (num7 == num8) && (num8 == num9) && (num10 == num11)){
      return false
    }else{
      let soma1 = num1 * 10 + num2 * 9 + num3 * 8 + num4 * 7 + num5 * 6 + num6 * 5 + num7 * 4 + num8 * 3 + num9 * 2;
      let verificador1 = soma1*10%11;
      if(verificador1 == num10 || (num10 == 0 && verificador1 == 10)){
        let soma2 = num1 * 11 + num2 * 10 + num3 * 9 + num4 * 8 + num5 * 7 + num6 * 6 + num7 * 5 + num8 * 4 + num9 * 3 + num10 * 2;
        let verificador2 = soma2*10%11;
        if(verificador2 == num11 || (num11 == 0 && verificador2 == 10)){
          return true;
        }else{
          return false;
        }
      }else{
        return false
      }
    }
  }

  
  //Testa se o CPF informado é válido
  $("#cpf-candidato").on("keyup",function() {
    var maxLength = $(this).attr("maxlength");
    if(maxLength == $(this).val().length) {
      if(validaCpf($("#cpf-candidato").val()) == false){
        $("#cpf-candidato").css('border-color', 'red');
        $("#erro-cpf").show();
      }else{
        $("#cpf-candidato").css('border-color', '#ced4da');
        $("#erro-cpf").hide();
      }
    }
  })
  //Copiar o valor do campo para o campo whatsapp caso estiver checado
  $("#telefone-candidato").on("keyup",function() {
    var maxLength = $(this).attr("maxlength");
    if(maxLength == $(this).val().length && $("#whatsapp-check").is(":checked")){
      $("#whatsapp-candidato").val($("#telefone-candidato").val());
    }else{
      $("#whatsapp-candidato").val('');
    }
  })
  //Mostrar campo caso o número informado pelo candidato não possua whatsapp
  $("#whatsapp-check").on('change', function(){
    
    if($("#whatsapp-check").is(":checked") == false){
      $("#whatsapp-candidato").val('');
      $("#whatsapp-input").show();

    }else{
      $("#whatsapp-candidato").val('');
      $("#whatsapp-input").hide();
    }
    if ($("#telefone-candidato").val().length == 15 && $("#whatsapp-check").is(":checked") == true){

      $("#whatsapp-candidato").val($("#telefone-candidato").val());

    }
  })
  //Mostrar campo de descrição da necessidade especial
  $("#necessidade-especial").on('change', function(){
    if($("#necessidade-especial").val() == 1){
      $("#input-desc-necessidade").show();
    }else{
      $("#desc-necessidade").val('');
      $("#input-desc-necessidade").hide();
    }
  })
  //Preenche campos de acordo com a busca na API de CEP
  $("#num-cep").on('keyup', function(){
      var maxLength = $(this).attr("maxlength");
      if(maxLength == $(this).val().length){
      var cep = $("#num-cep").val();
      var url = 'https://viacep.com.br/ws/'+cep+'/json/';
      $.ajax({
        url: url,
        dataType: 'json',
        type: 'get'
      }).done(function(data){
        console.log(data);
        if(data.erro){
          $("#cep-erro").val(1);
        }else{
          $("#cep-erro").val(0);
          $("#cidade").val(data.localidade);
          $("#estado").val(data.uf);
          $("#bairro").val(data.bairro);
          $("#logradouro").val(data.logradouro);
        }
      });
    }else{
      $("#cep-erro").val(1);
      $("#cidade").val('');
      $("#estado").val('');
      $("#bairro").val('');
      $("#logradouro").val('');
    }
  });

  //Cadastro
  $('#cadastro-curriculo').on('submit', function(e){  
    e.preventDefault();
    var data = $('#cadastro-curriculo').serialize();

    if($('#nome-candidato').val() == '' ||
       $('#email-candidato').val() == '' || 
       $('#telefone-candidato').val().length < 15 ||
       $('#whatsapp-candidato').val().length < 15 || 
       (validaCpf($("#cpf-candidato").val()) == false) ||
       $('#dn-candidato').val() == '' ||
       $('#genero').val() == 0 ||
       $('#estado-civil').val() == 0 ||
       $('#senioridade').val() == 0 ||
       ($('#necessidade-especial').val() == 1 && $('#desc-necessidade').val() == '') ||
       $('#cep-erro').val() == 1 ||
       $('#numero-endereco').val() == '') {

      if($('#nome-candidato').val() == ''){
        $('#nome-candidato').css('border-color', 'red');
      }else{
        $('#nome-candidato').css('border-color', '#ced4da');
      }

      if($('#email-candidato').val() == ''){
        $('#email-candidato').css('border-color', 'red');
      }else{
        $('#email-candidato').css('border-color', '#ced4da');
      }

      if($('#telefone-candidato').val().length < 15){
        $('#telefone-candidato').css('border-color', 'red');
      }else{
        $('#telefone-candidato').css('border-color', '#ced4da');
      }

      if($('#whatsapp-candidato').val().length < 15 ){
        $('#whatsapp-candidato').css('border-color', 'red');
      }else{
        $('#whatsapp-candidato').css('border-color', '#ced4da');
      }

      if((validaCpf($("#cpf-candidato").val()) == false)){
        $("#cpf-candidato").css('border-color', 'red');
        $("#erro-cpf").show();
      }else{
        $("#cpf-candidato").css('border-color', '#ced4da');
        $("#erro-cpf").hide();
      }

      if($("#dn-candidato").val() == ''){
        $('#dn-candidato').css('border-color', 'red');
      }else{
        $('#dn-candidato').css('border-color', '#ced4da');
      }

      if($("#genero").val() == 0){
        $('#genero').css('border-color', 'red');
      }else{
        $('#genero').css('border-color', '#ced4da');
      }

      if($("#estado-civil").val() == 0){
        $('#estado-civil').css('border-color', 'red');
      }else{
        $('#estado-civil').css('border-color', '#ced4da');
      }

      if($("#senioridade").val() == 0){
        $('#senioridade').css('border-color', 'red');
      }else{
        $('#senioridade').css('border-color', '#ced4da');
      }

      if($('#necessidade-especial').val() == 1 && $('#desc-necessidade').val() == ''){
        $('#desc-necessidade').css('border-color', 'red');
      }else{
        $('#desc-necessidade').css('border-color', '#ced4da');
      }

      if($('#cep-erro').val() == 1){
        $('#num-cep').css('border-color', 'red');
      }else{
        $('#num-cep').css('border-color', '#ced4da');
      }

      if($('#numero-endereco').val() == ''){
        $('#numero-endereco').css('border-color', 'red');
      }else{
        $('#numero-endereco').css('border-color', '#ced4da');
      }
      

      $('.error-alert-text').html('');
      $('.error-alert-text').html('Preencha os campos marcados em vermelho corretamente para continuar');
      $('#alert-modal-error').show();

    }else{
      $.ajax({
        url: '/teste/curriculo',
        type: 'POST',
        data: data
      }).done(function(data){
        data = JSON.parse(data);
        console.log(data);
        $(".form-control").css('border-color', '#ced4da') //Ao salvar eliminar bordas vermelhas dos campos que estavam errados no formulário
        $('.success-alert-text').html('');
        if(data['primeiro_cadastro'] == false){
          $("#redirect-alert").attr("onclick", "$('#alert-ok').hide()");
        }else{
          $("#redirect-alert").attr("href", "/teste/portal-do-candidato");
        }
        $('.success-alert-text').html(data['mensagem']);

        $('#alert-ok').show();
      });
    }
  });
})
</script>
@if(isset($dados_candidato))
<script type="text/javascript">
  function buscaCep(){
    var cep = $("#num-cep").val();
    var url = 'https://viacep.com.br/ws/'+cep+'/json/';
    $.ajax({
      url: url,
      dataType: 'json',
      type: 'get'
    }).done(function(data){
      console.log(data);
      if(data.erro){
        $("#cep-erro").val(1);
      }else{
        $("#cep-erro").val(0);
        $("#cidade").val(data.localidade);
        $("#estado").val(data.uf);
        $("#bairro").val(data.bairro);
        $("#logradouro").val(data.logradouro);
      }
    });
  }

  $("#telefone-candidato").val('{{$dados_candidato->numero_telefone}}');
  $("#whatsapp-candidato").val('{{$dados_candidato->numero_whatsapp}}');
  if('{{$dados_candidato->numero_telefone}}' != '{{$dados_candidato->numero_whatsapp}}'){
    $("#whatsapp-check").prop( "checked", false);
    $("#whatsapp-candidato").val('{{$dados_candidato->numero_whatsapp}}');
    $("#whatsapp-input").show();

  }
  $("#dn-candidato").val('{{$dados_candidato->dn_candidato}}');
  $("#genero").val('{{$dados_candidato->id_genero}}');
  $("#estado-civil").val('{{$dados_candidato->id_estado_civil}}');
  $("#senioridade").val('{{$dados_candidato->id_senioridade}}');
  $("#necessidade-especial").val('{{$dados_candidato->possui_deficiencia}}');
  if("{{$dados_candidato->possui_deficiencia}}" == 1){
    $("#input-desc-necessidade").show();
    $("#desc-necessidade").val("{{$dados_candidato->tipo_necessidade_especial}}");
  }
  $("#num-cep").val("{{$dados_candidato->cep_candidato}}");
  buscaCep();
  $("#cep-erro").val(0);
  $("#numero-endereco").val('{{$dados_candidato->numero_endereco_candidato}}');

</script>
@endif