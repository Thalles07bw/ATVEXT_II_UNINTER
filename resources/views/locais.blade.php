@include('partials.header')
  <!--Alerts-->
  @include('alerts.alert-modal-delete')
  @include('alerts.alert-success')
  @include('alerts.alert-modal-error')
<body>
  <!-- Begin Page Content -->
  <div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 ">Salas de Aula</h1>
    </div>
    <div class="row">
      <div class="card shadow col-md-12">
        <div class="card-header py-3">
          <h4>Cadastro de Locais de Aula</h4>
        </div>
        <div class="card-body"> 
          <form id="cadastrar-sala-aula">
          @csrf
          <div class="row form-row-spacing">
            <div class="col-md-5">
              <label>Nome do Local</label>
              <input class="form-control" id="nome-local" name="nome-local">
            </div>
            <div class="col-md-5">
              <label>Nome da Sala</label>
              <input class="form-control" id="nome-sala" name="nome-sala">
            </div>
          </div>
          <div class="row form-row-spacing">                            
            <div class="col-md-5">
              <label>Digite seu CEP para busca automática do endereço</label>
              <input class="form-control" id="num-cep" name="num-cep" maxlength="9">
              <input id="cep-erro" value="1" hidden>   
              <span><a href="https://buscacepinter.correios.com.br/app/endereco/index.php"> Não sei meu CEP</a></span> 
            </div>
            <div class="col-md-6">
              <label>Rua:</label>
              <input class="form-control" id="logradouro"  name="logradouro" readonly="true">    
            </div>
            <div class="col-md-1">
              <label>Número:</label>
              <input class="form-control" id="numero-endereco" name="numero-endereco">    
            </div>
          </div>
          
          <div class="row form-row-spacing">
            <div class="col-md-4">
              <label>Bairro:</label>
              <input class="form-control" id="bairro" name="bairro" readonly="true">    
            </div>
            <div class="col-md-5">
              <label>Cidade:</label>
              <input class="form-control" id="cidade" name="cidade" readonly="true">    
            </div>
            <div class="col-md-1">
              <label>Estado:</label>
              <input class="form-control" id="estado" name="estado" readonly="true">    
            </div>
            <div class="col-md-2">
              <label>País:</label>
              <select class="form-control" name="pais" id="pais" readonly="true">
                @foreach($paises as $pais)
                <option value="{{$pais->id_pais}}">{{$pais->nome_pais}}</option>
                @endforeach
              </select>
            </div>
          </div>            
        </div>                
        <div class="card-footer">
          <input class="btn btn-primary" type="submit">
          </form>
        </div>  
      </div>
    </div>
    <br>
    <div class="row">
      <div class="card shadow col-md-12">
        <div class="card-header py-3">
            <h4>Locais cadastrados</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
          <table id="tabela-locais" class="display" style="width:100%">
            <thead>
                <tr style="text-align: center;">
                  <th>Nome do Local</th>
                  <th>Rua, Número</th>
                  <th>Bairro</th>
                  <th>Cidade</th>
                  <th>Ações</th>
                </tr>
            </thead>
            <tbody>
              @foreach($tabela as $linha)
              <tr style="text-align: center;">
                  <td>{{$linha->nome_local}}</td>
                  <td>{{$linha->rua_local}},&nbsp;{{$linha->numero_local}}</td>
                  <td>{{$linha->bairro_local}}</td>
                  <td>{{$linha->nome_cidade}}/{{$linha->nome_estado}}</td>
                  <td style="width: 30%;">
                      <a id="botao-editar-{{$linha->id_local}}"  class="btn btn-success" style="margin-left: 2px; margin-bottom: 2px;">Editar</a>
                      <a id="botao-excluir-{{$linha->id_local}}" class="btn btn-danger" style="margin-left: 2px; margin-bottom: 2px;">Excluir</a>
                  </td>
                </tr>
                @endforeach
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
<!--Modal-editar-->
<div class="modal fade" id="editar" tabindex="-1" role="dialog" aria-labelledby="visualizarModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" id="form-editar-local">
        @csrf
        <form id="cadastrar-sala-aula">
          @csrf
          <div class="row form-row-spacing">
            <div class="col-md-5">
              <label>Nome do Local</label>
              <input class="form-control" id="nome-local-editar" name="nome-local">
            </div>
            <div class="col-md-5">
              <label>Nome da Sala</label>
              <input class="form-control" id="nome-sala-editar" name="nome-sala">
            </div>
          </div>
          <div class="row form-row-spacing">                            
            <div class="col-md-5">
              <label>Digite seu CEP para busca automática do endereço</label>
              <input class="form-control" id="num-cep-editar" name="num-cep" maxlength="9">
              <input id="cep-erro-editar" value="1" hidden>   
              <span><a href="https://buscacepinter.correios.com.br/app/endereco/index.php"> Não sei meu CEP</a></span> 
            </div>
            <div class="col-md-6">
              <label>Rua:</label>
              <input class="form-control" id="logradouro-editar"  name="logradouro" readonly="true">    
            </div>
            <div class="col-md-1">
              <label>Número:</label>
              <input class="form-control" id="numero-endereco-editar" name="numero-endereco">    
            </div>
          </div>
          
          <div class="row form-row-spacing">
            <div class="col-md-4">
              <label>Bairro:</label>
              <input class="form-control" id="bairro-editar" name="bairro" readonly="true">    
            </div>
            <div class="col-md-5">
              <label>Cidade:</label>
              <input class="form-control" id="cidade-editar" name="cidade" readonly="true">    
            </div>
            <div class="col-md-1">
              <label>Estado:</label>
              <input class="form-control" id="estado-editar" name="estado" readonly="true">    
            </div>
            <div class="col-md-2">
              <label>País:</label>
              <select class="form-control" name="pais" id="pais-editar" readonly="true">
                @foreach($paises as $pais)
                <option value="{{$pais->id_pais}}">{{$pais->nome_pais}}</option>
                @endforeach
              </select>
            </div>
          </div>            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <input name="id-editar" id="id-editar" hidden>
        <input type="submit" class="btn btn-primary" value="Salvar Alterações">
      </div>
      </form>
    </div>
  </div>
</div>
@include('partials.footer')
<script>
$(document).ready(function(){

   //CEP
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

  //Editar CEP
  $("#num-cep-editar").on('keyup', function(){
    var maxLength = $(this).attr("maxlength");
    if(maxLength == $(this).val().length){
      var cep = $("#num-cep-editar").val();
      var url = 'https://viacep.com.br/ws/'+cep+'/json/';
      $.ajax({
        url: url,
        dataType: 'json',
        type: 'get'
      }).done(function(data){
        if(data.erro){
          $("#cep-erro-editar").val(1);
        }else{
          $("#cep-erro-editar").val(0);
          $("#cidade-editar").val(data.localidade);
          $("#estado-editar").val(data.uf);
          $("#bairro-editar").val(data.bairro);
          $("#logradouro-editar").val(data.logradouro);
        }
      });
    }else{
      $("#cep-erro-editar").val(1);
      $("#cidade-editar").val('');
      $("#estado-editar").val('');
      $("#bairro-editar").val('');
      $("#logradouro-editar").val('');
    }
  }); 

  //Cadastro
  $("#cadastrar-sala-aula").on('submit', function(e){
    e.preventDefault();
    if($("#cep-erro").val() == 1 ||
    $("#nome-local").val() == "" ||
    $("#nome-sala").val() == ""){
  
      if($("#cep-erro").val() == 1){
        $("#num-cep").css('border-color', 'red');
      }else{
        $("#num-cep").css('border-color', '#ced4da');
      }

      if($("#nome-local").val() == ""){
        $("#nome-local").css('border-color', 'red');
      }else{
        $("#nome-local").css('border-color', '#ced4da');
      }

      if($("#nome-sala").val() == ""){
        $("#nome-sala").css('border-color', 'red');
      }else{
        $("#nome-sala").css('border-color', '#ced4da');
      }


      $('.error-alert-text').html('');
      $('.error-alert-text').html('Preencha os campos marcados em vermelho para continuar');
      $('#alert-modal-error').show();

    }else{
      let data = $("#cadastrar-sala-aula").serialize();

      $.ajax({
        url: '/teste/salas-de-aula',
        method: 'POST',
        data: data
      }).done(function(data){

        data = JSON.parse(data);

        if(data["flag"] == true){
            $('.success-alert-text').html('');
            $('.success-alert-text').html(data['mensagem']);
            $("#redirect-alert").attr("href", "/teste/salas-de-aula");
            $('#alert-ok').show();
        }else{
          $('.error-alert-text').html('');
          $('.error-alert-text').html(data['mensagem']);
          $('#alert-modal-error').show();
        }
      })
    }
  });

  //Edição
  $("#form-editar-local").on('submit', function(e){
    e.preventDefault();

    if($("#cep-erro-editar").val() == 1 ||
    $("#nome-local-editar").val() == "" ||
    $("#nome-sala-editar").val() == ""){
  
      if($("#cep-erro-editar").val() == 1){
        $("#num-cep-editar").css('border-color', 'red');
      }else{
        $("#num-cep-editar").css('border-color', '#ced4da');
      }

      if($("#nome-local-editar").val() == ""){
        $("#nome-local-editar").css('border-color', 'red');
      }else{
        $("#nome-local-editar").css('border-color', '#ced4da');
      }

      if($("#nome-sala-editar").val() == ""){
        $("#nome-sala-editar").css('border-color', 'red');
      }else{
        $("#nome-sala-editar").css('border-color', '#ced4da');
      }


      $('.error-alert-text').html('');
      $('.error-alert-text').html('Preencha os campos marcados em vermelho para continuar');
      $('#alert-modal-error').show();
    }else{
      let data = $("#form-editar-local").serialize();

      $.ajax({
        url: '/teste/salas-de-aula/editar',
        method: 'POST',
        data: data
      }).done(function(data){

        data = JSON.parse(data);
        console.log(data);
        if(data["flag"] == true){
            $('.success-alert-text').html('');
            $('.success-alert-text').html(data['mensagem']);
            $("#redirect-alert").attr("onclick", "$('#alert-ok').hide()");
            $('#alert-ok').show();
        }else{
          $('.error-alert-text').html('');
          $('.error-alert-text').html(data['mensagem']);
          $('#alert-modal-error').show();
        }
      })  
    }
  });
  
  //Exclusão
  $('#confirmar-exclusao').on('click', function(e){
    e.preventDefault();
    var id = $('#id-delete').val();
    $.ajax({
      url: '/teste/salas-de-aula/deletar/' + id,
      method: 'POST',
      data: {'id': id},
      success: function(data){
        data = JSON.parse(data);
        alert(data['mensagem']);
        window.location.reload();
      }
    });
  });
})
</script>

<script type="text/javascript">
    $('#tabela-locais').DataTable({
      "drawCallback":function(){

      //ao clicar em excluir
      $('a[id^="botao-excluir-"]').on('click', function(e){
        e.preventDefault();
        $('#alert-modal-delete').show();
        let id = this.id;
        id = id.slice(14);
        $('#id-delete').val(id);
      });

      //ao clicar em editar
      $('a[id^="botao-editar-"]').on('click', function(e){
        e.preventDefault();
        let id = this.id;
        id = id.slice(13);
        $('#id-editar').val(id);
        $.ajax({
          url: '/teste/salas-de-aula/visualizar/' + id,
          method: 'POST',
          data: {'id': id}
        }).done(function(data){
          data = JSON.parse(data);
          console.log(data);
          $("#nome-local-editar").val(data[0].nome_local);
          $("#nome-sala-editar").val(data[0].nome_sala);
          $("#cep-erro-editar").val(0);
          $("#num-cep-editar").val(data[0].cep_local);
          $("#cidade-editar").val(data[0].nome_cidade);
          $("#estado-editar").val(data[0].nome_estado);
          $("#bairro-editar").val(data[0].bairro_local);
          $("#logradouro-editar").val(data[0].rua_local);
          $("#numero-endereco-editar").val(data[0].numero_local);
          $('#editar').modal('show');
        })
      });

      },
      "language": {
            "lengthMenu": "Mostrando _MENU_ resultado por página",
            "zeroRecords": "Nenhum registro encontrado",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "Não há registros nessas condições",
            "infoFiltered": "(Filtrando de  _MAX_ registros)",
            "search":         "Busca:",
            "paginate": {
              "first":      "Primeira página",
              "last":       "Última página",
              "next":       "Próxima",
              "previous":   "Anterior"
          }
        }
      });
</script>