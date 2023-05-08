@include('partials.header-second-layer')
  <!--Alerts-->
  @include('alerts.alert-modal-delete')
  @include('alerts.alert-success')
  @include('alerts.alert-modal-error')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb" style="float: right; background-color: #f9f9f9;">
    <li class="breadcrumb-item"><a href="/teste/cadastro-vagas">Vagas</a></li>
    <li class="breadcrumb-item active" aria-current="page">Etapas do Processo Seletivo</li>
  </ol>
</nav>
<body>
  <!--Id da vaga da página-->
  <input id="id-vaga" hidden value="{{$id_vaga}}">
  <!-- Begin Page Content -->
  <div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 ">Modificar Etapas do Processo Seletivo</h1>
    </div>
    <div class="row">
      <div class="card shadow col-md-12">
        <div class="card-header py-3">
          <h4>Quadros e Ordem</h4>
        </div>
        <div class="card-body">      
          <div class="row">
            <div class="col-md-3" style="padding-top:10px;">
              <input type="checkbox" value="1"  id="etapa-1" disabled checked>
              <label class="form-check-label">Candidatos</label>
            </div>
            <div class="col-md-2" style="padding-top:5px;">
              <select class="form-control" disabled>
                <option value="1">Início</option>
              </select>
            </div>
          </div> 
 
          <div class="row">
            <div class="col-md-3" style="padding-top:10px;">
              <input type="checkbox" value="2"  id="etapa-2">
              <label class="form-check-label">Análise de Curriculo</label>
            </div>
            <div class="col-md-2" style="padding-top:5px">
              <select class="form-control" id="etapa-2-posicao" style="display: none;">         
                <option value="2" selected>2º Quadro</option>
                <option value="3">3º Quadro</option>
                <option value="4">4º Quadro</option>
                <option value="5">5º Quadro</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3" style="padding-top:10px;">
              <input type="checkbox" value="3" id="etapa-3">
              <label class="form-check-label">Prova</label>
            </div>
            <div class="col-md-2" style="padding-top:5px;">
              <select class="form-control" id="etapa-3-posicao" style="display: none;">
                <option value="2">2º Quadro</option>
                <option value="3" selected>3º Quadro</option>
                <option value="4">4º Quadro</option>
                <option value="5">5º Quadro</option>
              </select>
            </div>
            <div class="col-md-5" id="select-prova" style="display: none; padding-top: 10px;">
              <select class="form-control" name="prova" id="prova">
                <option value="0">Selecione a Prova a ser aplicada</option>
                @foreach($provas as $prova)
                <option value="{{$prova->id_prova}}">{{$prova->nome_prova}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-3" id="data-limite-prova" style="display: none; padding-top: 10px;">
              <label>Data limite da prova:</label>
              <input class="form-control" type="date" id="data-limite" name="data-limite">
            </div>
          </div>
          <div class="row">
            <div class="col-md-3" style="padding-top:10px;">
              <input type="checkbox" value="4" id="etapa-4">
              <label class="form-check-label">Entrevista</label>
            </div>
            <div class="col-md-2" style="padding-top:5px;">
              <select class="form-control" id="etapa-4-posicao" style="display: none;">
                <option value="2">2º Quadro</option>
                <option value="3">3º Quadro</option>
                <option value="4" selected>4º Quadro</option>
                <option value="5">5º Quadro</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3" style="padding-top:10px;">
              <input type="checkbox" value="5" id="etapa-5">
              <label class="form-check-label">Etapa Personalizada</label>
            </div>
            <div class="col-md-2" style="padding-top:5px;">
              <select class="form-control" id="etapa-5-posicao" style="display: none;">
                <option value="2">2º Quadro</option>
                <option value="3">3º Quadro</option>
                <option value="4">4º Quadro</option>
                <option value="5" selected>5º Quadro</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3" style="padding-top:10px;">
              <input type="checkbox" value="6" id="etapa-6" disabled checked>
              <label class="form-check-label">Aprovados para a vaga</label>
            </div>
            <div class="col-md-2" style="padding-top:5px;">
              <select class="form-control" disabled>
                <option value="6">Final</option>
              </select>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <button class="btn btn-primary" id="salvar">Salvar</button>      
        </div>
      </div>
    </div>
  </div>
@include('partials.footer-second-layer')
<script type="text/javascript">
  $("#prova").select2();
</script>
@if($prova_vaga)
<script type="text/javascript">
  $('#prova').select2('val','{{$prova_vaga->id_prova}}');
  $('#select-prova').show();
  $('#data-limite').val('{{$prova_vaga->data_limite}}');
  $('#data-limite-prova').show();
</script>
@endif
<script type="text/javascript">
  $('#etapa-2').on('change', function(){
    if($('#etapa-2').is(":checked") == true){
      $('#etapa-2-posicao').show();
    }else{
      $('#etapa-2-posicao').hide();
    }  
  })
  $('#etapa-3').on('change', function(){
    if($('#etapa-3').is(":checked") == true){
      $('#etapa-3-posicao').show();
      $('#select-prova').show();
      $('#data-limite-prova').show();
    }else{
      $('#etapa-3-posicao').hide();
      $('#select-prova').hide();
      $('#data-limite-prova').hide();
    }  
  })
  $('#etapa-4').on('change', function(){
    if($('#etapa-4').is(":checked") == true){
      $('#etapa-4-posicao').show();
    }else{
      $('#etapa-4-posicao').hide();
    }  
  })
  $('#etapa-5').on('change', function(){
    if($('#etapa-5').is(":checked") == true){
      $('#etapa-5-posicao').show();
    }else{
      $('#etapa-5-posicao').hide();
    }  
  })

  $("#salvar").on('click', function(){
    //constante que irá avaliar se existe conflito de posição entre as etapas
    let conflict = false;
    if((($('#etapa-2-posicao').val() ==  $('#etapa-3-posicao').val()) &&
     ($('#etapa-3').is(":checked") == true && $('#etapa-2').is(":checked") == true))||
     (($('#etapa-2-posicao').val() == $('#etapa-4-posicao').val()) &&
     ($('#etapa-4').is(":checked") == true && $('#etapa-2').is(":checked") == true)) ||
     (($('#etapa-2-posicao').val() == $('#etapa-5-posicao').val()) && 
     ($('#etapa-5').is(":checked") == true && $('#etapa-2').is(":checked") == true))){
      $('#etapa-2-posicao').css('border-color', 'red');
      conflict = true;
    }else{
      $('#etapa-2-posicao').css('border-color', '#ced4da');
    }
    if((($('#etapa-2-posicao').val() ==  $('#etapa-3-posicao').val()) && 
    ($('#etapa-2').is(":checked") == true && $('#etapa-3').is(":checked") == true))||
    (($('#etapa-3-posicao').val() == $('#etapa-4-posicao').val()) && 
    ($('#etapa-4').is(":checked") == true && $('#etapa-3').is(":checked") == true))||
    (($('#etapa-3-posicao').val() == $('#etapa-5-posicao').val()) && 
    ($('#etapa-5').is(":checked") == true && $('#etapa-3').is(":checked") == true))){
      $('#etapa-3-posicao').css('border-color', 'red');
      conflict = true;
    }else{
      $('#etapa-3-posicao').css('border-color', '#ced4da');
    }
    if((($('#etapa-4-posicao').val() ==  $('#etapa-3-posicao').val()) && 
    ($('#etapa-3').is(":checked") == true) && $('#etapa-4').is(":checked") == true)||
    (($('#etapa-2-posicao').val() == $('#etapa-4-posicao').val()) &&
    ($('#etapa-2').is(":checked") == true && $('#etapa-4').is(":checked") == true))||
    (($('#etapa-4-posicao').val() == $('#etapa-5-posicao').val()) &&
     ($('#etapa-5').is(":checked") == true && $('#etapa-4').is(":checked") == true))){
      $('#etapa-4-posicao').css('border-color', 'red');
      conflict = true;
    }else{
      $('#etapa-4-posicao').css('border-color', '#ced4da');
    }
    if((($('#etapa-5-posicao').val() ==  $('#etapa-3-posicao').val()) &&
     ($('#etapa-3').is(":checked") == true && $('#etapa-5').is(":checked") == true))||
     (($('#etapa-5-posicao').val() == $('#etapa-4-posicao').val()) &&
     ($('#etapa-4').is(":checked") == true && $('#etapa-5').is(":checked") == true))||
     (($('#etapa-2-posicao').val() == $('#etapa-5-posicao').val()) &&
     ($('#etapa-2').is(":checked") == true && $('#etapa-2').is(":checked") == true))){
      $('#etapa-5-posicao').css('border-color', 'red');
      conflict = true;
    }else{
      $('#etapa-5-posicao').css('border-color', '#ced4da');
    }
    if($('#etapa-3').is(":checked") == true && $("#prova").val() == 0){
      $("#prova").css('border-color', 'red')
      conflict = true;
      
    }else{
      $("#prova").css('border-color', '#ced4da')
    }
    if(conflict == true){
      $('.error-alert-text').html('');
      if($('#etapa-3').is(":checked") == true && $("#prova").val() == 0){
        $('.error-alert-text').html('Você deve escolher uma prova.');
      }else{
        $('.error-alert-text').html('Os quadros marcados em vermelho estão em conflito de posição.');
      }
      $('#alert-modal-error').show();
    }
    else{
      if($('#etapa-2').is(":checked") == true){        
        $.ajax({
          url: '/teste/modificar-etapas',
          type: 'POST',
          data: {'vaga': $('#id-vaga').val(), 'ordem': $('#etapa-2-posicao').val(),
          'etapa' : $('#etapa-2').val()}
        }).done(function(data){
          data = JSON.parse(data);
        });
      }else{
        $.ajax({
          url: '/teste/modificar-etapas/deletar',
          type: 'POST',
          data: {'vaga': $('#id-vaga').val(), 'etapa' : $('#etapa-2').val()}
        }).done(function(data){
          data = JSON.parse(data);
 
        });
      }
      if($('#etapa-3').is(":checked") == true){
        $.ajax({
          url: '/teste/modificar-etapas',
          type: 'POST',
          data: {'vaga': $('#id-vaga').val(), 'ordem': $('#etapa-3-posicao').val(),
          'etapa' : $('#etapa-3').val(), 'prova': $('#prova').val(), 'data-limite' : $("#data-limite").val()}
        }).done(function(data){
          data = JSON.parse(data);

        });
      }else{
        $.ajax({
          url: '/teste/modificar-etapas/deletar',
          type: 'POST',
          data: {'vaga': $('#id-vaga').val(), 'etapa' : $('#etapa-3').val(), 'prova': $('#prova').val()}
        }).done(function(data){
          data = JSON.parse(data);
          if(data.flag == false){
            $('.error-alert-text').html('');
            $('.error-alert-text').html(data.mensagem);
            $('#alert-modal-error').show();
          }
        });
      }
      if($('#etapa-4').is(":checked") == true){
        $.ajax({
          url: '/teste/modificar-etapas',
          type: 'POST',
          data: {'vaga': $('#id-vaga').val(), 'ordem': $('#etapa-4-posicao').val(),
          'etapa' : $('#etapa-4').val()}
        }).done(function(data){
          data = JSON.parse(data);
       
        });
      }else{
        $.ajax({
          url: '/teste/modificar-etapas/deletar',
          type: 'POST',
          data: {'vaga': $('#id-vaga').val(), 'etapa' : $('#etapa-4').val()}
        }).done(function(data){
          data = JSON.parse(data);
   
        });
      }
      if($('#etapa-5').is(":checked") == true){
        $.ajax({
          url: '/teste/modificar-etapas',
          type: 'POST',
          data: {'vaga': $('#id-vaga').val(), 'ordem': $('#etapa-5-posicao').val(),
          'etapa' : $('#etapa-5').val()}
        }).done(function(data){
          data = JSON.parse(data);
         
        });
      }else{
        $.ajax({
          url: '/teste/modificar-etapas/deletar',
          type: 'POST',
          data: {'vaga': $('#id-vaga').val(), 'etapa' : $('#etapa-5').val()}
        }).done(function(data){
          data = JSON.parse(data);
        });
      }
      $('.success-alert-text').html('');
      $('.success-alert-text').html("Alterações salvas com sucesso");
      $("#redirect-alert").attr("onclick", "$('#alert-ok').hide()");
      $('#alert-ok').show();
    }
  })
</script>

@foreach($quadros as $each)
@if($each->id_etapa == 1)
<script type="text/javascript">
  $('#etapa-1').prop("checked", "true");
  $('#etapa-1-posicao').show();
  $('#etapa-1-posicao').val('{{$each->ordem}}');
</script>
@endif
@if($each->id_etapa == 2)
<script type="text/javascript">
  $('#etapa-2').prop("checked", "true");
  $('#etapa-2-posicao').show();
  $('#etapa-2-posicao').val('{{$each->ordem}}');
</script>
@endif
@if($each->id_etapa == 3)
<script type="text/javascript">
  $('#etapa-3').prop("checked", "true");
  $('#etapa-3-posicao').show();
  $('#etapa-3-posicao').val('{{$each->ordem}}');

</script>
@endif
@if($each->id_etapa == 4)
<script type="text/javascript">
  $('#etapa-4').prop("checked", "true");
  $('#etapa-4-posicao').show();
  $('#etapa-4-posicao').val('{{$each->ordem}}');
</script>
@endif
@if($each->id_etapa == 5)
<script type="text/javascript">
  $('#etapa-5').prop("checked", "true");
  $('#etapa-5-posicao').show();
  $('#etapa-5-posicao').val('{{$each->ordem}}');
</script>
@endif
@if($each->id_etapa == 6)
<script type="text/javascript">
  $('#etapa-6').prop("checked", "true");
  $('#etapa-6-posicao').show();
  $('#etapa-6-posicao').val('{{$each->ordem}}');
</script>
@endif
@endforeach