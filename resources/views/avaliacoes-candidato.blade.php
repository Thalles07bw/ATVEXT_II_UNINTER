@include('partials.header-candidato')
  <!--Alerts-->
  @include('alerts.alert-modal-cancel')
  @include('alerts.alert-success')
  @include('alerts.alert-modal-error')

<body>
  <div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 ">Candidaturas</h1>
    </div>
    <div class="row">
      <div class="card shadow col-md-12">
        <div class="card-header py-3">
          <h4>Minhas Candidaturas</h4>
        </div>
        <div class="card-body">
        <div class="table-responsive">
          <table id="tabela-avaliacoes" class="display" style="width:100%">
            <thead>
                <tr style="text-align: center;">
                    <th>Prova</th>
                    <th>Vaga</th>
                    <th>Empresa</th>
                    <th>Data da Limite</th>
                    <th>Percentual de Acerto</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tabela as $linha)
                  <tr style="text-align: center;">
                    <td>{{$linha->nome_prova}}</td>
                    <td>{{$linha->titulo_vaga}}</td>
                    <td>{{$linha->razao_social_empresa_contratante}}</td>
                    <td>{{$linha->data_limite}}</td>
                    @if($linha->percentual_acerto == NULL)
                    <td>-</td>
                    @else
                    <td>{{$linha->percentual_acerto}}%</td>
                    @endif
                    @if($linha->prova_feita == 0 && $linha->data_limite >= date('Y-m-d'))
                    <td style="width: 20%;">
                      <a href="/prova/{{$linha->id_prova}}?token={{$linha->token}}" class="btn btn-success" style="margin-left: 2px; margin-bottom: 2px;">Fazer Avaliação</a>
                    </td>
                    @else
                    <td style="width: 20%;">
                      <span>Avaliação Concluída</span>
                    </td>
                    @endif
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
@include('partials.footer-candidato')
<script type="text/javascript">
    //Exclusão
    $('#confirmar-cancelamento').on('click', function(e){
    e.preventDefault();
    var id = $('#id-cancel').val();
    $.ajax({
      url: '/candidaturas/cancelar/' + id,
      method: 'POST',
      data: {'id': id},
      success: function(data){
        data = JSON.parse(data);
        alert(data);
        window.location.reload();
      }
    });
  });

  $("#tabela-avaliacoes").dataTable({
    "drawCallback":function(){
    //ao clicar no botão cancelar
    $('a[id^="botao-cancelar-"]').on('click', function(e){
      e.preventDefault();
      $('#alert-modal-cancel').show();
      let id = this.id;
      id = id.slice(15);
      $('#id-cancel').val(id);
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