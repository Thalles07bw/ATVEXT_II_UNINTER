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
        <h1 class="h3 mb-0 text-gray-800 ">Treinamento</h1>
    </div>
    <div class="row">
      <div class="card shadow col-md-12">
        <div class="card-header py-3">
          <h4>Cadastro de Diretrizes</h4>
        </div>
        <div class="card-body">
          <form id="cadastro-diretriz" method="POST">
            @csrf
            <div class="row form-row-spacing">
              <div class="col-md-6">
                <label>Título</label>
                <input class="form-control" type="text" id="titulo" name="titulo">
              </div>
            </div>
            <div class="row form-row-spacing">
              <div class="col-md-12">
                <label>Descrição</label>
                <textarea class="form-control" id="descricao" name="descricao"></textarea>
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
            <h4>Itens cadastrados</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
          <table id="tabela-diretrizes" class="display" style="width:100%">
            <thead>
                <tr style="text-align: center;">
                    <th>Título</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
              @foreach($tabela as $linha)
              <tr style="text-align: center;">
                  <td>{{$linha->titulo_diretriz}}</td>
                  <td style="width: 40%;">
                      <a id="botao-editar-{{$linha->id_diretriz}}"  class="btn btn-success" style="margin-left: 2px; margin-bottom: 2px;">Editar</a>
                      <a id="botao-excluir-{{$linha->id_diretriz}}" class="btn btn-danger" style="margin-left: 2px; margin-bottom: 2px;">Excluir</a>
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
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" id="form-editar-diretriz">
        @csrf
        <div class="row form-row-spacing">     
          <div class="col-md-6">
            <label>Título</label>
            <input class="form-control" type="text" id="titulo-editar" name="titulo">
          </div>
        </div>
        <div class="row form-row-spacing">       
          <div class="col-md-12">
            <label>Descrição</label>
            <textarea class="form-control" id="descricao-editar" name="descricao"></textarea>
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
<script type="text/javascript">
$(document).ready(function(){

  //Cadastro
  $("#cadastro-diretriz").on('submit', function(e){
     
      e.preventDefault();
      
      if($("#titulo").val() == "" || $("#descricao").val() == ""){

        if($('#titulo').val() == ''){
          $('#titulo').css('border-color', 'red');
        }else{
          $('#titulo').css('border-color', '#ced4da');
        }

        if($('#descricao').val() == ''){
          $('#descricao').css('border-color', 'red');
        }else{
          $('#descricao').css('border-color', '#ced4da');
        }

        $('.error-alert-text').html('');
        $('.error-alert-text').html('Preencha os campos marcados em vermelho para continuar');
        $('#alert-modal-error').show();

      }else{
        let data = $("#cadastro-diretriz").serialize();
        $.ajax({
          url: "/diretrizes",
          type: "post",
          data: data
        }).done(function(data){
          data = JSON.parse(data);
          console.log(data);
          $('.success-alert-text').html('');
          $('.success-alert-text').html(data['mensagem']);
          $("#redirect-alert").attr("href", "/diretrizes");
          $('#alert-ok').show();
        })
      }
  });

  //Edição
  $("#form-editar-diretriz").on('submit', function(e){
    e.preventDefault();

    e.preventDefault();
      
      if($("#titulo-editar").val() == "" || $("#descricao-editar").val() == ""){

        if($('#titulo-editar').val() == ''){
          $('#titulo-editar').css('border-color', 'red');
        }else{
          $('#titulo-editar').css('border-color', '#ced4da');
        }

        if($('#descricao-editar').val() == ''){
          $('#descricao-editar').css('border-color', 'red');
        }else{
          $('#descricao-editar').css('border-color', '#ced4da');
        }

        $('.error-alert-text').html('');
        $('.error-alert-text').html('Preencha os campos marcados em vermelho para continuar');
        $('#alert-modal-error').show();

      }else{
        let data = $("#form-editar-diretriz").serialize();
        $.ajax({
          url: "/diretrizes/editar",
          type: "post",
          data: data
        }).done(function(data){
          data = JSON.parse(data);
          console.log(data);
          $('.success-alert-text').html('');
          $('.success-alert-text').html(data['mensagem']);
          $("#redirect-alert").attr("onclick", "window.location.reload()");
          $('#alert-ok').show();
        })
      }
    
  });
  
  //Exclusão
  $('#confirmar-exclusao').on('click', function(e){
    e.preventDefault();
    var id = $('#id-delete').val();
    $.ajax({
      url: '/diretrizes/deletar/' + id,
      method: 'POST',
      data: {'id': id},
      success: function(data){
        data = JSON.parse(data);
        alert(data.mensagem);
        window.location.reload();
      }
    });
  });
})
</script>

<script type="text/javascript">
    $('#tabela-diretrizes').DataTable({
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
          url: '/diretrizes/visualizar/' + id,
          method: 'POST',
          data: {'id': id}
        }).done(function(data){
          data = JSON.parse(data);
          console.log(data)
          $('#titulo-editar').val(data.titulo_diretriz);
          $('#descricao-editar').val(data.descricao_diretriz);
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