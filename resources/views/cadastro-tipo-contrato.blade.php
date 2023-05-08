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
        <h1 class="h3 mb-0 text-gray-800 ">Contratos</h1>
    </div>
    <div class="row">
      <div class="card shadow col-md-12">
        <div class="card-header py-3">
          <h4>Cadastro de tipo de contrato</h4>
        </div>
        <div class="card-body">
          <form id="cadastro-tipo-contrato" method="POST">
            @csrf  
            <div class="row">
              <div class="col-md-4">
                <label>Nome do tipo de contrato:</label>
                <input class="form-control" type="text" name="nome-tipo-contrato" id="nome-tipo-contrato">
              </div>          
            </div>
          </div>
          <div class="card-footer">
            <input class="btn btn-primary" type="submit">
          </div>
        </form>
      </div>
    </div>
    <br>
    <div class="row">
      <div class="card shadow col-md-12">
        <div class="card-header py-3">
            <h4>Tipos de contrato cadastrados</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
          <table id="tabela-tipo-contrato" class="display" style="width:100%">
            <thead>
                <tr style="text-align: center;">
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
            @foreach($tabela as $each)
                <tr style="text-align: center;">
                    <td>{{$each->nome_tipo_contrato}}</td>
                    <td style="width: 40%;">
                        <a id="botao-editar-{{$each->id_tipo_contrato}}" href="/teste/tipo-contrato/editar/{{$each->id_tipo_contrato}}" class="btn btn-success" style="margin-left: 2px; margin-bottom: 2px;">Editar</a>
                        <a id="botao-excluir-{{$each->id_tipo_contrato}}" href="/teste/tipo-contrato/deletar/{{$each->id_tipo_contrato}}" class="btn btn-danger" style="margin-left: 2px; margin-bottom: 2px;">Excluir</a>
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
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" id="form-editar-tipo-contrato">
        @csrf
        <div class="row">
          <div class="col-md-12">
            <label>Nome do tipo de contrato:</label>
            <input class="form-control" type="text" name="nome-tipo-contrato" id="nome-tipo-contrato-editar">
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
    //Cadastro
    $("#cadastro-tipo-contrato").on('submit', function(e){
      e.preventDefault();
      var data = $("#cadastro-tipo-contrato").serialize();

      if($("#nome-tipo-contrato").val() == ''){
        $("#nome-tipo-contrato").css('border-color','red');
        $('.error-alert-text').html('');
        $('.error-alert-text').html('Preencha os campos marcados em vermelho para continuar');
        $('#alert-modal-error').show();
      }
      else{
        $.ajax({
          url: "/teste/tipo-contrato",
          type: 'post',
          data: data
          
        }).done(function(data){
          data = JSON.parse(data);
          $('.success-alert-text').html('');
          $('.success-alert-text').html(data['mensagem']);
          $("#redirect-alert").attr("href", "/teste/tipo-contrato");
          $('#alert-ok').show();
        })
    }
  })
  //Exclusão

  $('#confirmar-exclusao').on('click', function(e){
    e.preventDefault();
    var id = $('#id-delete').val();
    $.ajax({
      url: '/teste/tipo-contrato/deletar/' + id,
      method: 'POST',
      data: {'id': id},
      success: function(data){
        data = JSON.parse(data);
        alert(data);
        window.location.reload();
      }
    });
  });

  //Edição

$("#form-editar-tipo-contrato").on('submit', function(e){
      e.preventDefault();
      var data = $("#form-editar-tipo-contrato").serialize();

      if($("#nome-tipo-contrato-editar").val() == ''){
        $("#nome-tipo-contrato-editar").css('border-color','red');
        $('.error-alert-text').html('');
        $('.error-alert-text').html('Preencha os campos marcados em vermelho para continuar');
        $('#alert-modal-error').show();
      }
      else{
        $.ajax({
          url: "/teste/tipo-contrato/editar",
          type: 'post',
          data: data
          
        }).done(function(data){
          data = JSON.parse(data);
          $('.success-alert-text').html('');
          $('.success-alert-text').html(data['mensagem']);
          $("#redirect-alert").attr("href", "/teste/tipo-contrato");
          $('#alert-ok').show();
        })
    }
  });
});
</script>
<script type="text/javascript">
$('#tabela-tipo-contrato').DataTable({
  
  "drawCallback": function(){
    //ao clicar no botão excluir
    $('a[id^="botao-excluir-"]').on('click', function(e){
      e.preventDefault();
      $('#alert-modal-delete').show();
      let id = this.id;
      id = id.slice(14);
      $('#id-delete').val(id);
    });
    //ao clicar no botão editar
    $('a[id^="botao-editar-"]').on('click', function(e){
      e.preventDefault();
      let id = this.id;
      id = id.slice(13);
      $('#id-editar').val(id);
      $.ajax({
        url: '/teste/tipo-contrato/visualizar/' + id,
        method: 'POST',
        data: {'id': id}
      }).done(function(data){
        data = JSON.parse(data);
        console.log(data[0])
        $('#nome-tipo-contrato-editar').val(data[0].nome_tipo_contrato);
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