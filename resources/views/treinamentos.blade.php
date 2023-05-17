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
        <h1 class="h3 mb-0 text-gray-800 ">Treinamentos</h1>
    </div>
    <div class="row">
      <div class="card shadow col-md-12">
        <div class="card-header py-3">
          <h4>Cadastro de Treinamentos</h4>
        </div>
        <div class="card-body">
          <form id="cadastro-treinamento" method="POST">  
          @csrf 
          <div class="row form-row-spacing">
            <div class="col-md-6">
              <label>Curso</label>
              <select class="form-control" name="curso" id="curso">
                @foreach($cursos as $curso)
                <option value="{{$curso->id_curso}}">{{$curso->nome_curso}}</option>
                @endforeach
              </select>
            </div>  
            <div class="col-md-3">
              <label>Data de Início</label>
              <input class="form-control" type="date" name="data-inicio" id="data-inicio">
            </div>
            <div class="col-md-3">
              <label>Data de Fim</label>
              <input class="form-control" type="date" name="data-fim" id="data-fim">
            </div>
          </div>
          <div class="row form-row-spacing">
            <div class="col-md-2">
              <label>Quantidade de Vagas</label>
              <input class="form-control" type="number" name="qtd-vagas" id="qtd-vagas">
            </div>
            <div class="col-md-3">
              <label>Selecione o diretor</label>
              <select class="form-control" name="diretor" id="diretor">
                <option value="0">Selecione o diretor</option>
                @foreach($colaboradores as $diretor)
                <option value="{{$diretor->id_colaborador}}">{{$diretor->nome_colaborador}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-3">
              <label>Selecione o status</label>
              <select class="form-control" name="status" id="status">
                <option value="0">Selecione o staus</option>
                @foreach($status as $status)
                <option value="{{$status->id_status_treinamento}}">{{$status->status_treinamento}}</option>
                @endforeach 
              </select>
            </div>
          </div>
          <div class="row form-row-spacing">
            <div class="col-md-12">
            <label>Descrição</label>
              <textarea class="form-control" name="descricao" id="descricao"></textarea>
            </div>
          </div>
          <div class="row form-row-spacing">
            <div class="col-md-12">
            <label>Instrutores</label>
              <select class="form-control" name="instrutores[]" id="instrutores" multiple="multiple">
                @foreach($instrutores as $instrutor)
                <option value="{{$instrutor->id_instrutor}}">{{$instrutor->nome_instrutor}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row form-row-spacing" >
            <div class="col-md-12">
            <label>Participantes</label>
              <select class="form-control" name="participantes[]" id="participantes" multiple="multiple">
                @foreach($colaboradores as $participantes)
                <option value="{{$participantes->id_colaborador}}">{{$participantes->nome_colaborador}}</option>
                @endforeach
              </select>
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
            <h4>Itens cadastrados</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
          <table id="tabela-cursos" class="display" style="width:100%">
            <thead>
                <tr style="text-align: center;">
                    <th>Nome do treinamento</th>
                    <th>Data Início</th>
                    <th>Data Fim</th>
                    <th>Diretor</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
              @foreach($tabela as $linha)
              <tr style="text-align: center;">
                  <td width="20%">{{$linha->nome_curso}}</td>
                  <td width="10%">{{date('d/m/Y', strtotime($linha->data_inicio))}}</td>
                  <td width="10%">{{date('d/m/Y', strtotime($linha->data_fim))}}</td>
                  <td>{{$linha->diretor}}</td>
                  <td style="width: 30%;">
                    <a id="botao-turma-{{$linha->id_treinamento}}" class="btn btn-primary">Turma</a>
                    <a id="botao-editar-{{$linha->id_treinamento}}"  class="btn btn-success" style="margin-left: 2px; margin-bottom: 2px;">Editar</a>
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
        <form method="post" id="form-editar-treinamento">
        @csrf
        <div class="row form-row-spacing">
            <div class="col-md-6">
              <label>Curso</label>
              <select class="form-control" name="curso" id="curso-editar">
                @foreach($cursos as $curso)
                <option value="{{$curso->id_curso}}">{{$curso->nome_curso}}</option>
                @endforeach
              </select>
            </div>  
            <div class="col-md-3">
              <label>Data de Início</label>
              <input class="form-control" type="date" name="data-inicio" id="data-inicio-editar">
            </div>
            <div class="col-md-3">
              <label>Data de Fim</label>
              <input class="form-control" type="date" name="data-fim" id="data-fim-editar">
            </div>
          </div>
          <div class="row form-row-spacing">
            <div class="col-md-2">
              <label>Quantidade de Vagas</label>
              <input class="form-control" type="number" name="qtd-vagas" id="qtd-vagas-editar">
            </div>
            <div class="col-md-3">
              <label>Selecione o diretor</label>
              <select class="form-control" name="diretor" id="diretor-editar">
                <option value="0">Selecione o diretor</option>
                @foreach($colaboradores as $diretor)
                <option value="{{$diretor->id_colaborador}}">{{$diretor->nome_colaborador}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-3">
              <label>Selecione o status</label>
              <select class="form-control" name="status" id="status-editar">
                <option value="0">Selecione o status</option>
                @foreach($status_edit as $status)
                <option value="{{$status->id_status_treinamento}}">{{$status->status_treinamento}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row form-row-spacing">
            <div class="col-md-12">
            <label>Descrição</label>
              <textarea class="form-control" name="descricao" id="descricao-editar">      
              </textarea>
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

<!--Modal-turma-->
<div class="modal fade" id="turma" tabindex="-1" role="dialog" aria-labelledby="visualizarModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" id="form-editar-turma">
        @csrf
        <div class="row form-row-spacing" >
          <div class="col-md-12">
            <label>Instrutores</label>
              <select class="form-control" name="instrutores-editar[]" id="instrutores-editar" multiple="multiple">
                @foreach($instrutores as $instrutor)
                <option value="{{$instrutor->id_instrutor}}">{{$instrutor->nome_instrutor}}</option>
                @endforeach
              </select>
          </div>
        </div>
        <div class="row form-row-spacing">
          <div class="col-md-12">
            <label>Participantes</label>
            <select class="form-control" name="participantes-editar[]" id="participantes-editar" multiple="multiple">
              @foreach($colaboradores as $participantes)
              <option value="{{$participantes->id_colaborador}}">{{$participantes->nome_colaborador}}</option>
              @endforeach
            </select>
            </select>
          </div>
        </div>       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <input name="id-editar-turma" id="id-editar-turma" hidden>
        <input type="submit" class="btn btn-primary" value="Salvar Alterações">
      </div>
      </form>
    </div>
  </div>
</div>
@include('partials.footer')
<script>
$(document).ready(function(){

  $('#participantes').selectize();
  $('#instrutores').selectize();
  $('#participantes-editar').selectize();
  $('#instrutores-editar').selectize();
  $('#diretor').selectize({
    placeholder: 'Digite o nome do diretor'
  });
  $('#curso').selectize({
    placeholder: 'Digite o nome do curso'
  });
  $('#diretor-editar').selectize({
    placeholder: 'Digite o nome do diretor'
  });
  $('#curso-editar').selectize({
    placeholder: 'Digite o nome do curso'
  });

  //Cadastro
  $("#cadastro-treinamento").on('submit', function(e){
    e.preventDefault();
    if($("#curso").val() == 0 ||
    $("#status").val() == 0 || 
    $("#data-inicio").val() == '' || 
    $('#data-fim').val() == '' ||
    $('#qtd-vagas').val() == '' ||
    $('#diretor').val() == 0){

      if($("#status").val() == 0){
        $("#status").css('border-color','red');
      }else{
        $("#status").css('border-color', '#ced4da');
      }

      if($("#data-inicio").val() == ""){
        $("#data-inicio").css('border-color','red');
      }else{
        $("#data-inicio").css('border-color', '#ced4da');
      }

      if($("#data-fim").val() == ""){
        $("#data-fim").css('border-color','red');
      }else{
        $("#data-fim").css('border-color', '#ced4da');
      }
      if($("#qtd-vagas").val() == ""){
        $("#qtd-vagas").css('border-color','red');
      }else{
        $("#qtd-vagas").css('border-color', '#ced4da');
      }

      $('.error-alert-text').html('');
      $('.error-alert-text').html('Preencha os campos marcados em vermelho para continuar');
      $('#alert-modal-error').show();

    }else{
      let data = $("#cadastro-treinamento").serialize();
      $.ajax({
        url: '/cadastrar-treinamento',
        method: 'POST',
        data: data
      }).done(function(data){
        data = JSON.parse(data);
        if(data["flag"] == true){
            $('.success-alert-text').html('');
            $('.success-alert-text').html(data['mensagem']);
            $("#redirect-alert").attr("href", "/cadastrar-treinamento");
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
  $("#form-editar-treinamento").on('submit', function(e){
    e.preventDefault();
    if($("#curso-editar").val() == 0 ||
    $("#status-editar").val() == 0 || 
    $("#data-inicio-editar").val() == '' || 
    $('#data-fim-editar').val() == '' ||
    $('#qtd-vagas-editar').val() == '' ||
    $('#diretor-editar').val() == 0){

      if($("#status-editar").val() == 0){
        $("#status-editar").css('border-color','red');
      }else{
        $("#status-editar").css('border-color', '#ced4da');
      }

      if($("#data-inicio-editar").val() == ""){
        $("#data-inicio-editar").css('border-color','red');
      }else{
        $("#data-inicio-editar").css('border-color', '#ced4da');
      }

      if($("#data-fim-editar").val() == ""){
        $("#data-fim-editar").css('border-color','red');
      }else{
        $("#data-fim-editar").css('border-color', '#ced4da');
      }
      if($("#qtd-vagas-editar").val() == ""){
        $("#qtd-vagas-editar").css('border-color','red');
      }else{
        $("#qtd-vagas-editar").css('border-color', '#ced4da');
      }

      $('.error-alert-text').html('');
      $('.error-alert-text').html('Preencha os campos marcados em vermelho para continuar');
      $('#alert-modal-error').show();

    }else{
      let data = $("#form-editar-treinamento").serialize();
      console.log(data);
      $.ajax({
        url: '/cadastrar-treinamento/editar',
        method: 'POST',
        data: data
      }).done(function(data){
        data = JSON.parse(data)
        if(data["flag"] == true){
            $('.success-alert-text').html('');
            $('.success-alert-text').html(data['mensagem']);
            $("#redirect-alert").attr("href", "/cadastrar-treinamento");
            $('#alert-ok').show();
        }else{
          $('.error-alert-text').html('');
          $('.error-alert-text').html(data['mensagem']);
          $('#alert-modal-error').show();
        }
      })
    } 
  });
  //Cadastro
  $("#form-editar-turma").on('submit', function(e){
    e.preventDefault();
    let data = $("#form-editar-turma").serialize();
    $.ajax({
      url: "/cadastrar-treinamento/editar-turma",
      method: 'POST',
      data: data
    }).done(function(data){
      data = JSON.parse(data)
      if(data["flag"] == true){
        $('.success-alert-text').html('');
        $('.success-alert-text').html(data['mensagem']);
        $("#redirect-alert").attr("href", "/cadastrar-treinamento");
        $('#alert-ok').show();
      }else{
        $('.error-alert-text').html('');
        $('.error-alert-text').html(data['mensagem']);
        $('#alert-modal-error').show();
      }
    });
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
})
</script>

<script type="text/javascript">
    $('#tabela-cursos').DataTable({
      "drawCallback":function(){

      //ao clicar em turma
      $('a[id^="botao-turma-"]').on('click', function(e){
        e.preventDefault();
        let id = this.id;
        id = id.slice(12);
        $('#id-editar-turma').val(id);
        $.ajax({
          url: '/cadastrar-treinamento/turma/' + id,
          method: 'POST',
          data: {'id': id}
        }).done(function(data){
          data = JSON.parse(data);
          console.log(data)
          let $select = $("#participantes-editar").selectize();
          $select[0].selectize.setValue(data.alunos);
          $select = $("#instrutores-editar").selectize();
          $select[0].selectize.setValue(data.instrutores);
          $('#turma').modal('show');
        })
      });

      //ao clicar em editar
      $('a[id^="botao-editar-"]').on('click', function(e){
        e.preventDefault();
        let id = this.id;
        id = id.slice(13);
        $('#id-editar').val(id);
        $.ajax({
          url: '/cadastrar-treinamento/visualizar/' + id,
          method: 'POST',
          data: {'id': id}
        }).done(function(data){
          data = JSON.parse(data);
          console.log(data);
          let $select3 = $("#curso-editar").selectize();
          $select3[0].selectize.setValue(data.id_curso);
          $("#data-inicio-editar").val(data.data_inicio);
          $("#data-fim-editar").val(data.data_fim);
          $("#qtd-vagas-editar").val(data.vagas_treinamento);
          let $select = $("#diretor-editar").selectize();
          $select[0].selectize.setValue(data.diretor_treinamento);
          $("#status-editar").val(data.status_treinamento);
          $("#descricao-editar").val(data.descricao_treinamento);
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