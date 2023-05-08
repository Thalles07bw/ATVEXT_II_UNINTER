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
        <h1 class="h3 mb-0 text-gray-800 ">Aulas</h1>
    </div>
    <div class="row">
      <div class="card shadow col-md-12">
        <div class="card-header py-3">
          <h4>Cadastro de Aulas</h4>
        </div>
        <div class="card-body">
          <form id="cadastro-aula">
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
              <label>Selecione o Local</label>
              <select class="form-control" id="local" name="local">
                <option value="0">Selecione o Local</option>
                @foreach($salas_aula as $sala_aula)
                  <option value="{{$sala_aula->id_local}}">{{$sala_aula->nome_local}} - {{$sala_aula->nome_sala}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row form-row-spacing">
            <div class="col-md-6">
              <label>Dia e hora de início</label>
              <input type="datetime-local" class="form-control" id="inicio" name="inicio">
            </div>
            <div class="col-md-6">
              <label>Dia e hora de fim</label>
              <input type="datetime-local" class="form-control" id="fim" name="fim">
            </div>
          </div>     
          <div class="row form-row-spacing">
            <div class="col-md-4">
              <label>Nome da Aula</label>
              <input class="form-control" id="nome" name="nome">
            </div>
            <div class="col-md-2">
              <label>É prova?</label>
              <select class="form-control" id="escolha-prova" name="escolha-prova">
                <option value="0">Não</option>
                <option value="1">Sim</option>
              </select>
            </div>
            <div class="col-md-6">
              <div id='show-prova' style="display: none">
              <label>Escolha a prova</label>
                <select class="form-control" id="prova" name="prova">
                  <option value="0">Prova Impressa</option>
                  @foreach($provas as $prova)
                  <!--<option value="{{$prova->id_prova}}">{{$prova->nome_prova}}</option>-->
                  @endforeach
                </select>
              </div>
            </div>
          </div> 
          <div class="row form-row-spacing">
            <div class="col-md-12">
              <label>Descrição</label>
              <textarea class="form-control textarea" id="descricao" name="descricao"></textarea>
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
          <table id="tabela-aulas" class="display" style="width:100%">
            <thead>
                <tr style="text-align: center;">
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Data</th>
                    <th>início</th>
                    <th>Fim</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
              @foreach($tabela as $linha)
              <tr style="text-align: center;">
                <td>{{$linha->nome_aula}}</td>
                <td>{!! $linha->descricao_aula !!}</td>
                <td>{{date('d/m/Y', strtotime($linha->dia_hora_inicio))}}</td>
                <td>{{date('H:i', strtotime($linha->dia_hora_inicio))}}</td>
                <td>{{date('H:i', strtotime($linha->dia_hora_fim))}}</td>
                <td style="width: 20%;">
                    <a id="botao-editar-{{$linha->id_aula}}"  class="btn btn-success" style="margin-left: 2px; margin-bottom: 2px;">Editar</a>
                    <a id="botao-excluir-{{$linha->id_aula}}" class="btn btn-danger" style="margin-left: 2px; margin-bottom: 2px;">Excluir</a>
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
        <form method="post" id="form-editar-aula">
        @csrf
        <div class="row form-row-spacing">
            <div class="col-md-6">
              <label>Selecione o Treinamento</label>
              <select class="form-control" id="treinamento-editar" name="treinamento">
                <option value="0">Selecione o Treinamento</option>
                @foreach($treinamentos as $treinamento)
                  <option value="{{$treinamento->id_treinamento}}">{{$treinamento->descricao_treinamento}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-6">
              <label>Selecione o Local</label>
              <select class="form-control" id="local-editar" name="local">
                <option value="0">Selecione o Local</option>
                @foreach($salas_aula as $sala_aula)
                  <option value="{{$sala_aula->id_local}}">{{$sala_aula->nome_local}} - {{$sala_aula->nome_sala}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row form-row-spacing">
            <div class="col-md-6">
              <label>Dia e hora de início</label>
              <input type="datetime-local" class="form-control" id="inicio-editar" name="inicio">
            </div>
            <div class="col-md-6">
              <label>Dia e hora de fim</label>
              <input type="datetime-local" class="form-control" id="fim-editar" name="fim">
            </div>
          </div>     
          <div class="row form-row-spacing">
            <div class="col-md-4">
              <label>Nome da Aula</label>
              <input class="form-control" id="nome-editar" name="nome">
            </div>
          </div> 
          <div class="row form-row-spacing">
            <div class="col-md-12">
              <label>Descrição</label>
              <textarea class="form-control textarea" id="descricao-editar" name="descricao"></textarea>
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
    $('.textarea').summernote({
        lang: 'pt-BR', 
        height: 250, //Definição da area de texto do editor
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['height', ['height']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']]
        
       ],
        fontSizes: [ '12', '16', '18', '24'],
        height: 150
    });
</script>
<script type="text/javascript">
$(document).ready(function(){
  //Definição da Prova
  $("#escolha-prova").on('change', function(){
    if($('#escolha-prova').val() == 0){
      $("#show-prova").hide()
    }else{
      $("#show-prova").show()
    }
  })
  let $select1 = $("#prova").selectize();
  //Cadastro
  $("#cadastro-aula").on('submit', function(e){
      e.preventDefault();

      if($("#treinamento").val() == 0 ||
      $("#local").val() == 0 ||
      $("#descricao").val() == "" ||
      $("#inicio").val() == "" ||
      $("#fim").val() == ""){

        if($("#treinamento").val() == 0){
          $("#treinamento").css('border-color','red');
        }else{
          $("#treinamento").css('border-color', '#ced4da');
        } 

        if($("#local").val() == 0){
          $("#local").css('border-color','red');
        }else{
          $("#local").css('border-color', '#ced4da');
        }
        
        if($("#descricao").val() == 0){
          $("#descricao").css('border-color','red');
        }else{
          $("#descricao").css('border-color', '#ced4da');
        }

        if($("#inicio").val() == 0){
          $("#inicio").css('border-color','red');
        }else{
          $("#inicio").css('border-color', '#ced4da');
        }

        if($("#fim").val() == 0){
          $("#fim").css('border-color','red');
        }else{
          $("#fim").css('border-color', '#ced4da');
        }
        
         $('.error-alert-text').html('');
         $('.error-alert-text').html('Preencha os campos marcados em vermelho para continuar');
         $('#alert-modal-error').show();

      }else{
        let data = $("#cadastro-aula").serialize();
       
        $.ajax({
          url: '/teste/cadastrar-aula',
          method: 'POST',
          data: data
        }).done(function(data){
          data = JSON.parse(data);
          console.log(data);
          if(data["flag"] == true){
            $('.success-alert-text').html('');
            $('.success-alert-text').html(data['mensagem']);
            $("#redirect-alert").attr("href", "/teste/cadastrar-aula");
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
  $("#form-editar-aula").on('submit', function(e){
    e.preventDefault();
    if($("#treinamento-editar").val() == 0 ||
      $("#local-editar").val() == 0 ||
      $("#descricao-editar").val() == "" ||
      $("#inicio-editar").val() == "" ||
      $("#fim-editar").val() == ""){

      if($("#treinamento-editar").val() == 0){
        $("#treinamento-editar").css('border-color','red');
      }else{
        $("#treinamento-editar").css('border-color', '#ced4da');
      } 

      if($("#local-editar").val() == 0){
        $("#local-editar").css('border-color','red');
      }else{
        $("#local-editar").css('border-color', '#ced4da');
      }
      
      if($("#descricao-editar").val() == 0){
        $("#descricao-editar").css('border-color','red');
      }else{
        $("#descricao-editar").css('border-color', '#ced4da');
      }

      if($("#inicio-editar").val() == 0){
        $("#inicio-editar").css('border-color','red');
      }else{
        $("#inicio-editar").css('border-color', '#ced4da');
      }

      if($("#fim-editar").val() == 0){
        $("#fim-editar").css('border-color','red');
      }else{
        $("#fim-editar").css('border-color', '#ced4da');
      }
      
        $('.error-alert-text').html('');
        $('.error-alert-text').html('Preencha os campos marcados em vermelho para continuar');
        $('#alert-modal-error').show();

    }else{
      let data = $("#form-editar-aula").serialize();
      
      $.ajax({
        url: '/teste/cadastrar-aula/editar',
        method: 'POST',
        data: data
      }).done(function(data){
        data = JSON.parse(data);
        console.log(data);
        if(data["flag"] == true){
          $('.success-alert-text').html('');
          $('.success-alert-text').html(data['mensagem']);
          $("#redirect-alert").attr("href", "/teste/cadastrar-aula#tabela-aulas");
          $("#redirect-alert").attr("onclick", "location.reload()");
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
      url: '/teste/cadastrar-aula/deletar/' + id,
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
    $('#tabela-aulas').DataTable({
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
          url: '/teste/cadastrar-aula/visualizar/' + id,
          method: 'POST',
          data: {'id': id}
        }).done(function(data){
          data = JSON.parse(data);
          console.log(data[0])
          let horario_inico = data[0].dia_hora_inicio.replace(" ","T");
          horario_inico = horario_inico.substring(0,16);
          
          let horario_fim = data[0].dia_hora_fim.replace(" ","T");
          horario_fim = horario_fim.substring(0,16);
          
          $('#treinamento-editar').val(data[0].id_treinamento);
          $('#local-editar').val(data[0].id_local);
          $('#inicio-editar').val(horario_inico);
          $('#fim-editar').val(horario_fim);
          $('#nome-editar').val(data[0].nome_aula);
          $('#descricao-editar').summernote('code', data[0].descricao_aula);
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