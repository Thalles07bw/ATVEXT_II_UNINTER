@include('partials.header-second-layer')
<!--Alerts-->
@include('alerts.alert-reativar')
@include('alerts.alert-success')
@include('alerts.alert-modal-error')
<body>
  <!-- Begin Page Content -->
  <div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 ">Recuperação de Avaliações</h1>
    </div>
    <div class="row">
      <div class="card shadow col-md-12">
        <div class="card-header py-3">
            <h4>Avaliações Desativadas</h4>
            <a class="btn btn-primary" href="/cadastrar-avaliacao" style="float:right;">Voltar para ativas</a>
        </div>
        <div class="card-body">
          <div class="table-responsive">
          <table id="tabela-avaliacoes" class="display" style="width:100%">
              <thead>
                <tr style="text-align: center;">
                    <th>Nome</th>
                    <th>Nível</th>
                    <th>Data de criação</th>
                    <th>Contagem de tempo</th>
                    <th>Ações</th>
                </tr>
              </thead>
              <tbody>
                @foreach($tabela as $each)
                <tr style="text-align: center;">
                    <td> {{$each->nome_prova}} </td>
                    <td> {{$each->nivel_prova}} </td>
                    <td> {{$each->data_criacao}} </td>
                    <td>{{$each->tipo_tempo_prova}}</td>
                    <td style="width: 50%;">
                        <a id="botao-questoes-{{$each->id_prova}}" href="/cadastrar-questoes/{{$each->id_prova}}" class="btn btn-success" style="margin-left: 2px; margin-bottom: 2px;">Ver Questões</a>  
                        <a id="botao-reativar-{{$each->id_prova}}" href="/cadastrar-avaliacao/reativar/{{$each->id_prova}}" class="btn btn-primary" style="margin-left: 2px; margin-bottom: 2px;">Reativar</a>                    
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
<!--Modal-visualizar-->
<div class="modal fade" id="editar" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Visualizar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="atualizar-prova" method="post">
          @csrf
          <input name="id-editar" id="id-editar" hidden>
          <div class="row">
            <div class="col-md-9" style="padding-bottom: 10px;">
              <input class="form-control" id="renomear" name="renomear" placeholder="Nome da avaliação">
            </div>
          <div class="col-md-3">
            <select class="form-control" id="nivel-prova-editar" name="nivel-prova-editar">
              <option value="0">Selecione o nível da avaliação</option>
              @foreach($niveis_avaliacao as $each)
                <option value="{{$each->id_nivel_prova}}">{{$each->nivel_prova}}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-primary" value="Salvar">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </form>
      </div>
    </div>
  </div>
</div>
@include('partials.footer-second-layer')
<script type="text/javascript" charset="UTF-8">

  //Desativação
  $("#confirmar-reativacao").on('click', function(e){
    e.preventDefault();
    var id = $("#id-reativar").val();
    console.log(id);
    $.ajax({
      url: '/cadastrar-avaliacao/reativar/' + id,
      type: 'POST',
      data: {'id': id}
    }).done(function (data){
        data = JSON.parse(data);
        alert(data.mensagem);
        window.location.reload();
    });
  });
</script>
<script type="text/javascript">
    //Tabela de controle de provas
    $('#tabela-avaliacoes').DataTable({
      "drawCallback": function(){
        //Ao clicar no botão desativar
        $('a[id^="botao-reativar-"]').on('click', function(e){
          e.preventDefault();
          $('#alert-modal-reativar').show();
          let id = this.id;
          id = id.slice(15);
          $('#id-reativar').val(id);
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