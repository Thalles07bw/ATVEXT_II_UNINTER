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
        <h1 class="h3 mb-0 text-gray-800 ">Treinamentos<h1>
    </div>
    <div class="row">
      <div class="card shadow col-md-12">
        <div class="card-header py-3">
          <h4>Cadastro de Arquivos</h4>
        </div>
        <div class="card-body">
          <form method="post" id="inserir-arquivos" enctype="multipart/form-data">  
            @csrf
            <div class="row form-row-spacing">
              <div class="col-md-6">
                <label>Selecione o Treinamento</label>
                <select class="form-control" id="treinamento" name="treinamento">
                  <option value="0">Selecione o Treinamento</option>
                  @foreach($treinamentos as $treinamento)
                  <option value="{{$treinamento->id_treinamento}}">{{$treinamento->descricao_treinamento}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-6">
                <label>Selecione o Participante</label>
                <select class="form-control" id="participante" name="participante">
                  <option value="0">Selecione o Participante</option>
                </select>
              </div>
            </div>
            <div class="row form-row-spacing">
              <div class="col-md-6">
                <label>Selecione o Tipo de Arquivo</label>
                <select class="form-control" id="tipo-arquivo" name="tipo-arquivo">
                  <option value="0">Selecione o Tipo de Arquivo</option>
                  @foreach($tipos as $tipo)
                  <option value="{{$tipo->id_tipo_arquivo}}">{{$tipo->nome_tipo_arquivo}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-6">
                <label>Selecione o Arquivo</label>
                <input type="file" id="arquivo" nome="arquivo"> 
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
            <h4>Arquivos cadastrados</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
          <table id="tabela-arquivos" class="display" style="width:100%">
            <thead>
                <tr style="text-align: center;">
                    <th>Nome</th>
                    <th>Treinamento</th>
                    <th>Tipo de Arquivo</th>
                    <th>Arquivo</th>
                </tr>
            </thead>
            <tbody>
              @foreach($tabela as $linha)
              <tr style="text-align: center;">
                  <td>{{$linha->nome_colaborador}}</td>
                  <td>{{$linha->descricao_treinamento}}</td>
                  <td>{{$linha->nome_tipo_arquivo}}
                  <td style="width: 40%;">
                      <a  href="/storage/app/{{$linha->caminho_arquivo}}"class="btn btn-success" style="margin-left: 2px; margin-bottom: 2px;">Ver</a>
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
<script type="text/javascript">
$(document).ready(function(){

  //Selectize
  var $treinamento = $("#treinamento").selectize();
  


  //Cadastro
  $("#inserir-arquivos").on('submit', function(e){
      e.preventDefault();
      if($('#treinamento').val() == 0 || $('#participante').val() == 0 ||
         $('#tipo-arquivo').val() == 0 || $('#arquivo').val() == ''
      ){
        if($('#arquivo').val() == ''){
          $('.error-alert-text').html('');
          $('.error-alert-text').html('Você precisa selecionar um arquivo');
          $('#alert-modal-error').show();
        }else{
          $('.error-alert-text').html('');
          $('.error-alert-text').html('Faltam campos para selecionar');
          $('#alert-modal-error').show();
        }
      }
      let treinamento = $('#treinamento').val();
      let participante = $('#participante').val();
      let tipo_arquivo = $('#tipo-arquivo').val();
      let arquivo = $('#arquivo').prop('files')[0];

      var form_data = new FormData(); 
      form_data.append("treinamento",treinamento);
      form_data.append("participante",participante);
      form_data.append("tipo_arquivo",tipo_arquivo);
      form_data.append("arquivo",arquivo);

      $.ajax({
      url:'/inserir-arquivos-treinamento',
      method: 'POST',
      dataType: 'script',
      cache: false,
      contentType: false,
      processData: false,
      data: form_data
    }).done(function(data){
      data = JSON.parse(data);
      console.log(data);
      $('.success-alert-text').html(data['mensagem']);
      $("#redirect-alert").attr("href", "/inserir-arquivos-treinamento");
      $('#alert-ok').show();
    });
  });

  //Edição
  $("#form-editar-").on('submit', function(e){
    e.preventDefault();
    
  });
  
  //Exclusão
  $('#confirmar-exclusao').on('click', function(e){
    e.preventDefault();
    var id = $('#id-delete').val();
    $.ajax({
      url: '/cadastro-/deletar/' + id,
      method: 'POST',
      data: {'id': id},
      success: function(data){
        data = JSON.parse(data);
        alert(data);
        window.location.reload();
      }
    });
  });
  //Ao mudar o treinamento
  $("#treinamento").on('change', function(e){
    e.preventDefault();
    
    var treinamento = $("#treinamento").val();
    var $select = $('#participante').selectize();
    var selector = $select[0].selectize;

    $.ajax({

      url:'/filtrar-participantes-treinamento',
      method: 'post',
      data: {'treinamento' : treinamento},
      success: function(data){
        
        data = JSON.parse(data);
        console.log(data);

        data.forEach(function (element, index){

          selector.addOption({value: element.id_aluno, text: element.nome_aluno});
          selector.refreshOptions();
          selector.addItem(element.id_aluno);
          $treinamento[0].selectize.disable() 
        })
      }
    });
  });
})
</script>

<script type="text/javascript">
    $('#tabela-arquivos').DataTable({
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