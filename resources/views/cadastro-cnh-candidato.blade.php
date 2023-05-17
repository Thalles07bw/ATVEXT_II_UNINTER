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
          <h4>Carteira Nacional de Habilitação</h4>
        </div>
        <div class="card-body">
          <form id="cadastro-cnh" method="POST">
            @csrf  
            <div class="row">
              <div class="col-md-4">
                <label>Categoria: </label>
                <select class="form-control" type="text" name="categoria" id="categoria">
                  <option value="0">Selecione a categoria da sua CNH</option>
                  @foreach($categorias_cnh as $categoria)
                  <option value="{{$categoria->id_categoria_cnh}}">{{$categoria->categoria_cnh}}</option>
                  @endforeach
                  </select>
              </div>
              <div class="col-md-4">
                <label>Número do registro: </label>
                <input class="form-control" type="number" name="numero-cnh" id="numero-cnh">
              </div>   
              <div class="col-md-4">
                <label>Data da primeira Habilitação: </label>
                <input class="form-control" type="date" name="data-cnh" id="data-cnh">
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
//Cadastro
  $('#cadastro-cnh').on('submit', function(e){  
    e.preventDefault();
    var data = $('#cadastro-cnh').serialize();

    if($('#categoria').val() == 0 ||
       $('#data-cnh').val() == '' || 
       $('#numero-cnh').val().length != 11) {

      if($('#categoria').val() == 0){
        $('#categoria').css('border-color', 'red');
      }else{
        $('#categoria').css('border-color', '#ced4da');
      }

      if($('#data-cnh').val() == ''){
        $('#data-cnh').css('border-color', 'red');
      }else{
        $('#data-cnh').css('border-color', '#ced4da');
      }

      if($('#numero-cnh').val().length != 11){
        $('#numero-cnh').css('border-color', 'red');
      }else{
        $('#numero-cnh').css('border-color', '#ced4da');
      }
      

      $('.error-alert-text').html('');
      $('.error-alert-text').html('Preencha os campos marcados em vermelho corretamente para continuar');
      $('#alert-modal-error').show();

    }else{
      $.ajax({
        url: '/habilitacao',
        type: 'POST',
        data: data
      }).done(function(data){
        data = JSON.parse(data);
   
        $(".form-control").css('border-color', '#ced4da') //Ao salvar eliminar bordas vermelhas dos campos que estavam errados no formulário
        $('.success-alert-text').html('');    
        $("#redirect-alert").attr("onclick", "$('#alert-ok').hide()");  
        $('.success-alert-text').html(data['mensagem']);

        $('#alert-ok').show();
      });
    }
  });
</script>
@if(isset($dados_cnh))
<script type="text/javascript">
  $("#categoria").val('{{$dados_cnh->id_categoria_cnh}}');
  $("#numero-cnh").val('{{$dados_cnh->num_registro}}');
  $("#data-cnh").val('{{$dados_cnh->data_primeira_habilitacao}}');
</script>
@endif