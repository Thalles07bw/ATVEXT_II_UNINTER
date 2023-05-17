@include('partials.header')
  <!--Alerts-->
  @include('alerts.alert-reativar')
  @include('alerts.alert-success')
  @include('alerts.alert-modal-error')
  <nav aria-label="breadcrumb">
  <ol class="breadcrumb" style="float: right; background-color: #f9f9f9;">
    <li class="breadcrumb-item"><a href="/usuarios">Usuários</a></li>
    <li class="breadcrumb-item active" aria-current="page">Usuários Inativos</li>
  </ol>
</nav>
<body>
  <!-- Begin Page Content -->
  <div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 ">Usuários inativos</h1>
    </div>
    <div class="row">
      <div class="card shadow col-md-12">
        <div class="card-header py-3">
            <h4>Lista de Inativos</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
          <table id="tabela-usuarios-inativos" class="display" style="width:100%">
            <thead>
                <tr style="text-align: center;">
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
              @foreach($tabela as $each)
              <tr style="text-align: center;">
                  <td>{{$each->nome_usuario}}</td>
                  <td>{{$each->email_usuario}}</td>
                  <td style="width: 40%;">
                      <a id="botao-reativar-{{$each->id_usuario}}"  class="btn btn-success" style="margin-left: 2px; margin-bottom: 2px;">Reativar</a>
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
        <form method="post" id="form-editar-">
        @csrf
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
  $("#cadastro-").on('submit', function(e){
      e.preventDefault();
  });

  //Edição
  $("#form-editar-").on('submit', function(e){
    e.preventDefault();
    
  });
  
  //Exclusão
  $('#confirmar-reativacao').on('click', function(e){
    e.preventDefault();
    var id = $('#id-reativar').val();
    $.ajax({
      url: '/usuarios/ativar/' + id,
      method: 'POST',
      data: {'id': id},
      success: function(data){
        data = JSON.parse(data);
        alert(data);
        window.location.reload();
      }
    });
  });
})
</script>

<script type="text/javascript">
    $('#tabela-usuarios-inativos').DataTable({
      "drawCallback":function(){

      //ao clicar em excluir
      $('a[id^="botao-reativar-"]').on('click', function(e){
        e.preventDefault();
        $('#enable-text').html('');
        $('#enable-text').html('Ativando novamente o usuário consgeguirá acessar o sistema novamente. Deseja confirmar a ativação?');
        $('#alert-modal-reativar').show();
        let id = this.id;
        id = id.slice(15);
        $('#id-reativar').val(id);
      });

      //ao clicar em editar
      $('a[id^="botao-editar-"]').on('click', function(e){
        e.preventDefault();
        let id = this.id;
        id = id.slice(13);
        $('#id-editar').val(id);
        $.ajax({
          url: '/cadastro-/visualizar/' + id,
          method: 'POST',
          data: {'id': id}
        }).done(function(data){
          data = JSON.parse(data);
          console.log(data[0])
          $('#nome-parentesco-editar').val(data[0].nome_parentesco);
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