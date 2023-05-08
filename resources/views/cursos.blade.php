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
        <h1 class="h3 mb-0 text-gray-800 ">Cursos</h1>
    </div>
    <div class="row">
      <div class="card shadow col-md-12">
        <div class="card-header py-3">
          <h4>Cadastro de Cursos</h4>
        </div>
        <div class="card-body"> 
          <form id="cadastro-cursos" method="POST"> 
          @csrf 
          <div class="row" style="padding-bottom: 10px;">
            <div class="col-md-6">
              <label>Nome do Curso</label>
              <input class="form-control" type="text" name="nome-curso" id="nome-curso">
            </div>
            <div class="col-md-2">
              <label>Carga horária prática</label>
              <input class="form-control" type="text" name="carga-pratica" id="carga-pratica">
            </div>
            <div class="col-md-2">
              <label>Carga horária teórica</label>
              <input class="form-control" type="text" name="carga-teorica" id="carga-teorica">
            </div>
          </div>
          <div class="row" style="padding-bottom: 10px;">
            <div class="col-md-12">
              <label>Descrição</label>
              <textarea class="form-control" name="descricao" id="descricao"></textarea>
            </div>
          </div>
          <div class="row" style="padding-bottom: 10px;">
            <div class="col-md-6">
              <label>Descrição do conteúdo prático</label>
              <textarea class="form-control" name="descricao-pratica" id="descricao-pratica"></textarea>
            </div>
            <div class="col-md-6">
              <label>Descrição do conteúdo teórico</label>
              <textarea class="form-control" name="descricao-teoria" id="descricao-teoria"></textarea>
            </div>
          </div>
          <div class="row" style="padding-bottom: 10px;">
            <div class="col-md-2">
              <label>Validade</label>
              <input class="form-control" name="validade" id="validade">
            </div>
            <div class="col-md-4">
              <label>Unidade de tempo da validade</label>
              <select class="form-control" name="unidade" id="unidade">
                <option value="0">Selecione a unidade</option>
                @foreach ($validades as $validade)
                <option value="{{$validade->id_unidade_validade}}">{{$validade->unidade_validade}}</option>
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
            <h4>Itens cadastrados</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
          <table id="tabela-cursos" class="display" style="width:100%">
            <thead>
                <tr style="text-align: center;">
                    <th>Nome do curso</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
              @foreach($tabela as $linha)
              <tr style="text-align: center;">
                  <td>{{$linha->nome_curso}}</td>
                  <td style="width: 40%;">
                      <a id="botao-editar-{{$linha->id_curso}}"  class="btn btn-success" style="margin-left: 2px; margin-bottom: 2px;">Editar</a>
                      <a id="botao-excluir-{{$linha->id_curso}}" class="btn btn-danger" style="margin-left: 2px; margin-bottom: 2px;">Excluir</a>
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
        <form method="post" id="form-editar">
        @csrf
        <div class="row" style="padding-bottom: 10px;">
          <div class="col-md-6">
            <label>Nome do Curso</label>
            <input class="form-control" type="text" name="nome-curso" id="nome-curso-editar">
          </div>
          <div class="col-md-2">
            <label>Carga horária prática</label>
            <input class="form-control" type="text" name="carga-pratica" id="carga-pratica-editar">
          </div>
          <div class="col-md-2">
            <label>Carga horária teórica</label>
            <input class="form-control" type="text" name="carga-teorica" id="carga-teorica-editar">
          </div>
        </div>
        <div class="row" style="padding-bottom: 10px;">
          <div class="col-md-12">
            <label>Descrição</label>
            <textarea class="form-control" name="descricao" id="descricao-editar"></textarea>
          </div>
        </div>
        <div class="row" style="padding-bottom: 10px;">
          <div class="col-md-6">
            <label>Descrição do conteúdo prático</label>
            <textarea class="form-control" name="descricao-pratica" id="descricao-pratica-editar"></textarea>
          </div>
          <div class="col-md-6">
            <label>Descrição do conteúdo teórico</label>
            <textarea class="form-control" name="descricao-teoria" id="descricao-teoria-editar"></textarea>
          </div>
        </div>
        <div class="row" style="padding-bottom: 10px;">
          <div class="col-md-2">
            <label>Validade</label>
            <input class="form-control" name="validade" id="validade-editar">
          </div>
          <div class="col-md-4">
            <label>Unidade de tempo da validade</label>
            <select class="form-control" name="unidade" id="unidade-editar">
              <option value="0">Selecione a unidade</option>
              @foreach ($validades as $validade)
              <option value="{{$validade->id_unidade_validade}}">{{$validade->unidade_validade}}</option>
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
<script type="text/javascript">
$(document).ready(function(){

  $("#carga-teorica").mask('00:00:00',{
    placeholder: '00:00:00'
  });

  $("#carga-pratica").mask('00:00:00',{
    placeholder: '00:00:00'
  });
  //Cadastro
  $("#cadastro-cursos").on('submit', function(e){
      e.preventDefault();
      if($("#nome-curso").val == '' || 
      $("#carga-pratica").val() == '' || 
      $("#carga-teorica").val() == ''){

        if($("#nome-curso").val() == ""){
          $("#nome-curso").css('border-color','red');
        }else{
          $("#nome-curso").css('border-color', '#ced4da');
        }

        if($("#carga-pratica").val() == ""){
          $("#carga-pratica").css('border-color','red');
        }else{
          $("#carga-pratica").css('border-color', '#ced4da');
        }

        if($("#carga-teorica").val() == ""){
          $("#carga-teorica").css('border-color','red');
        }else{
          $("#carga-teorica").css('border-color', '#ced4da');
        }

        $('.error-alert-text').html('');
        $('.error-alert-text').html('Preencha os campos marcados em vermelho para continuar');
        $('#alert-modal-error').show();

      }else{
        let data = $("#cadastro-cursos").serialize();
        $.ajax({
          url:'/teste/cadastrar-cursos',
          method: 'post',
          data: data
        }).done(function(data){
          data = JSON.parse(data);
          console.log(data);
          if(data["flag"] == true){
            $('.success-alert-text').html('');
            $('.success-alert-text').html(data['mensagem']);
            $("#redirect-alert").attr("href", "/teste/cadastrar-cursos");
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
  $("#form-editar").on('submit', function(e){
    e.preventDefault();
    if($("#nome-curso-editar").val() == '' || 
      $("#carga-pratica-editar").val() == '' || 
      $("#carga-teorica-editar").val() == ''){

        if($("#nome-curso-editar").val() == ""){
          $("#nome-curso-editar").css('border-color','red');
        }else{
          $("#nome-curso-editar").css('border-color', '#ced4da');
        }

        if($("#carga-pratica-editar").val() == ""){
          $("#carga-pratica-editar").css('border-color','red');
        }else{
          $("#carga-pratica-editar").css('border-color', '#ced4da');
        }

        if($("#carga-teorica-editar").val() == ""){
          $("#carga-teorica-editar").css('border-color','red');
        }else{
          $("#carga-teorica-editar").css('border-color', '#ced4da');
        }

        $('.error-alert-text').html('');
        $('.error-alert-text').html('Preencha os campos marcados em vermelho para continuar');
        $('#alert-modal-error').show();

      }else{
        let data = $("#form-editar").serialize();
        $.ajax({
          url:'/teste/cadastrar-cursos/editar',
          method: 'post',
          data: data
        }).done(function(data){
          data = JSON.parse(data);
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
      url: '/teste/cadastrar-cursos/deletar/' + id,
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
    $('#tabela-cursos').DataTable({
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
          url: '/teste/cadastrar-cursos/visualizar/' + id,
          method: 'POST',
          data: {'id': id}
        }).done(function(data){
          data = JSON.parse(data);
          console.log(data[0])
          $('#nome-curso-editar').val(data[0].nome_curso);
          $('#carga-pratica-editar').val(data[0].carga_horaria_pratica);
          $('#carga-teorica-editar').val(data[0].carga_horaria_teorica);
          $('#descricao-editar').val(data[0].descricao_curso);
          $('#descricao-pratica-editar').val(data[0].conteudo_pratico);
          $('#descricao-teoria-editar').val(data[0].conteudo_teorico);
          $('#validade-editar').val(data[0].prazo_validade);
          $('#unidade-editar').val(data[0].unidade_prazo_validade);
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