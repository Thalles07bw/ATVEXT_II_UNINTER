@include('partials.header-candidato')
  <!--Alerts-->
  @include('alerts.alert-modal-delete')
  @include('alerts.alert-success')
  @include('alerts.alert-modal-error')
<body>

  <!-- Begin Page Content -->
  <div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 ">Meu Currículo</h1>
    </div>
    <div class="row">
      <div class="card shadow col-md-12">
        <div class="card-header py-3">
          <h4>Cadastro de dados Acadêmicos</h4>
        </div>
        <div class="card-body">
          <form id="cadastro-formacao" method="POST">
            @csrf  
            <div class="row">
              <div class="col-md-4">
                <label>Nome do curso:</label>
                <input class="form-control" type="text" name="nome-curso" id="nome-curso">
              </div>  
              <div class="col-md-4">
                <label>Instituição:</label>
                <input class="form-control" type="text" name="nome-instituicao" id="nome-instituicao">
              </div>
              <div class="col-md-4">
                <label>Nivel do curso:</label>
                <select class="form-control" type="text" name="nivel-curso" id="nivel-curso">
                  <option value="0">Selecione o Nível do curso</option>
                  @foreach($niveis_formacao as $each)
                  <option value="{{$each->id_escolaridade}}">{{$each->nome_escolaridade}}</option>
                  @endforeach
                </select>
              </div>  
            </div>
            <br>
            <div class="row">
              <div class="col-md-6">
                <label>Data de início:</label>
                <input class="form-control" type="date" name="data-inicio" id="data-inicio">
              </div>  
              <div class="col-md-6">
                <label>Data de conclusão:</label>
                <input class="form-control" type="date" name="data-conclusao" id="data-conclusao">
              </div>  
            </div>
            <br>
            <div class="row">
              <div class="col-md-12">
                <label>Descrição do curso:</label>
                <textarea class="form-control" type="text" name="desc-curso" id="desc-curso"></textarea>
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
            <h4>Cursos Cadastrados</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
          <table id="tabela-cargos" class="display" style="width:100%">
            <thead>
                <tr style="text-align: center;">
                    <th>Curso</th>
                    <th>Nível</th>
                    <th>Data de conclusão</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
               @foreach($formacoes_candidato as $each)
                <tr style="text-align: center;">
                    <td>{{$each->curso_formacao_candidato}}</td>
                    <td>{{$each->nome_escolaridade}}</td>
                    <td>
                      @if($each->data_fim_formacao == null)
                      Em Andamento
                      @else
                      {{$each->data_fim_formacao}}
                      @endif
                    </td>
                    <td style="width: 25%;">
                        <a id="botao-ver-{{$each->id_formacao_candidato}}" href="#" class="btn btn-primary" style="margin-bottom: 2px;"> Ver</a>
                        <a id="botao-editar-{{$each->id_formacao_candidato}}" href="#" class="btn btn-success" style="margin-left: 2px; margin-bottom: 2px;">Editar</a>
                        <a id="botao-excluir-{{$each->id_formacao_candidato}}" href="#" class="btn btn-danger" style="margin-left: 2px; margin-bottom: 2px;">Excluir</a>
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
<!--Modal Visualizar -->
<div class="modal fade" id="visualizar" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Visualizar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-4">
            <label>Nome do curso:</label>
            <input class="form-control" type="text"  id="nome-curso-ver" disabled>
          </div>  
          <div class="col-md-4">
            <label>Instituição:</label>
            <input class="form-control" type="text" id="nome-instituicao-ver" disabled>
          </div>
          <div class="col-md-4">
            <label>Nivel do curso:</label>
            <select class="form-control" type="text" id="nivel-curso-ver" disabled>
              <option value="0">Selecione o Nível do curso</option>
              @foreach($niveis_formacao as $each)
              <option value="{{$each->id_escolaridade}}">{{$each->nome_escolaridade}}</option>
              @endforeach
            </select>
          </div>  
        </div>
        <br>
        <div class="row">
          <div class="col-md-6">
            <label>Data de início:</label>
            <input class="form-control" type="date"  id="data-inicio-ver" disabled>
          </div>  
          <div class="col-md-6">
            <label>Data de conclusão:</label>
            <input class="form-control" type="date"  id="data-conclusao-ver" disabled>
          </div>  
        </div>
        <br>
        <div class="row">
          <div class="col-md-12">
            <label>Descrição do curso:</label>
            <textarea class="form-control" type="text" id="desc-curso-ver" disabled></textarea>
          </div>   
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

<!--Modal Editar-->
<div class="modal fade" id="editar" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Editar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" id="form-editar-formacao">
        @csrf
        <div class="row">
          <div class="col-md-4">
            <label>Nome do curso:</label>
            <input class="form-control" type="text" name="nome-curso-edit" id="nome-curso-edit">
          </div>  
          <div class="col-md-4">
            <label>Instituição:</label>
            <input class="form-control" type="text" name="nome-instituicao-edit" id="nome-instituicao-edit">
          </div>
          <div class="col-md-4">
            <label>Nivel do curso:</label>
            <select class="form-control" type="text" name="nivel-curso-edit" id="nivel-curso-edit">
              <option value="0">Selecione o Nível do curso</option>
              @foreach($niveis_formacao as $each)
              <option value="{{$each->id_escolaridade}}">{{$each->nome_escolaridade}}</option>
              @endforeach
            </select>
          </div> 
        </div>
        <br>
        <div class="row">
          <div class="col-md-6">
            <label>Data de início:</label>
            <input class="form-control" type="date" name="data-inicio-edit" id="data-inicio-edit">
          </div>  
          <div class="col-md-6">
            <label>Data de conclusão:</label>
            <input class="form-control" type="date" name="data-conclusao-edit" id="data-conclusao-edit">
          </div> 
        </div>
        <br>
        <div class="row">
          <div class="col-md-12">
            <label>Descrição do curso:</label>
            <textarea class="form-control" type="text" name="desc-curso-edit" id="desc-curso-edit"></textarea>
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

@include('partials.footer-candidato')
<script type="text/javascript">

$(document).ready(function() {

  
    //Edição
    $('#form-editar-formacao').on('submit', function(e){  
      e.preventDefault();
      var data = $('#form-editar-formacao').serialize();
    
      if($('#nome-curso-edit').val() == '' || $('#nome-instituicao-edit').val() == '' || 
      $('#nivel-curso-edit').val() == 0 ||$('#data-inicio-edit').val() == '' || 
      $('#data-conclusao-edit').val() == '' || $('#desc-curso-edit').val() == '' ){
        
        if($('#nome-curso-edit').val() == ''){
          $('#nome-curso-edit').css('border-color', 'red');
        }else{
          $('#nome-curso-edit').css('border-color', '#ced4da');
        }

        if($('#nome-instituicao-edit').val() == ''){
          $('#nome-instituicao-edit').css('border-color', 'red');
        }else{
          $('#nome-instituicao-edit').css('border-color', '#ced4da');
        }

        if($('#nivel-curso-edit').val() == 0){
          $('#nivel-curso-edit').css('border-color', 'red');
        }else{
          $('#nivel-curso-edit').css('border-color', '#ced4da');
        }

        if($('#data-inicio-edit').val() == ''){
          $('#data-inicio-edit').css('border-color', 'red');
        }else{
          $('#data-inicio-edit').css('border-color', '#ced4da');
        }

        if($('#data-conclusao-edit').val() == ''){
          $('#data-conclusao-edit').css('border-color', 'red');
        }else{
          $('#data-conclusao-edit').css('border-color', '#ced4da');
        }

        if($('#desc-curso-edit').val() == ''){
          $('#desc-curso-edit').css('border-color', 'red');
        }else{
          $('#desc-curso-edit').css('border-color', '#ced4da');
        }


        $('.error-alert-text').html('');
        $('.error-alert-text').html('Preencha os campos marcados em vermelho para continuar');
        $('#alert-modal-error').show();

      }else{
        $.ajax({
          url: '/formacao/editar',
          type: 'POST',
          data: data
        }).done(function(data){
          data = JSON.parse(data);
          $('.success-alert-text').html('');
          $('.success-alert-text').html(data['mensagem']);
          $("#redirect-alert").attr("href", "/formacao");
          $('#alert-ok').show();
        });
      }
    });
    //Exclusão
    $('#confirmar-exclusao').on('click', function(e){
      e.preventDefault();
      var id = $('#id-delete').val();
      $.ajax({
        url: '/formacao/deletar/' + id,
        method: 'POST',
        data: {'id': id},
        success: function(data){
          data = JSON.parse(data);
          alert(data);
          window.location.reload();
        }
      });
    });
    //Cadastro
    $('#cadastro-formacao').on('submit', function(e){  
      e.preventDefault();
      var data = $('#cadastro-formacao').serialize();
 

      if($('#nome-curso').val() == '' || $('#nome-instituicao').val() == '' || 
      $('#nivel-curso').val() == 0 ||$('#data-inicio').val() == '' || 
      $('#data-conclusao').val() == '' || $('#desc-curso').val() == '' ){
        
        if($('#nome-curso').val() == ''){
          $('#nome-curso').css('border-color', 'red');
        }else{
          $('#nome-curso').css('border-color', '#ced4da');
        }

        if($('#nome-instituicao').val() == ''){
          $('#nome-instituicao').css('border-color', 'red');
        }else{
          $('#nome-instituicao').css('border-color', '#ced4da');
        }

        if($('#nivel-curso').val() == 0){
          $('#nivel-curso').css('border-color', 'red');
        }else{
          $('#nivel-curso').css('border-color', '#ced4da');
        }

        if($('#data-inicio').val() == ''){
          $('#data-inicio').css('border-color', 'red');
        }else{
          $('#data-inicio').css('border-color', '#ced4da');
        }

        if($('#data-conclusao').val() == ''){
          $('#data-conclusao').css('border-color', 'red');
        }else{
          $('#data-conclusao').css('border-color', '#ced4da');
        }

        if($('#desc-curso').val() == ''){
          $('#desc-curso').css('border-color', 'red');
        }else{
          $('#desc-curso').css('border-color', '#ced4da');
        }


        $('.error-alert-text').html('');
        $('.error-alert-text').html('Preencha os campos marcados em vermelho para continuar');
        $('#alert-modal-error').show();

      }else{
        $.ajax({
          url: '/formacao',
          type: 'POST',
          data: data
        }).done(function(data){
          data = JSON.parse(data);
          $('.success-alert-text').html('');
          $('.success-alert-text').html(data['mensagem']);
          $("#redirect-alert").attr("href", "/formacao");
          $('#alert-ok').show();

        });
      }
    });
    
    //Tabela de controle de benefícios
    $('#tabela-cargos').DataTable({
      "drawCallback":function(){
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
            url: '/formacao/visualizar/' + id,
            method: 'POST',
            data: {'id': id}
          }).done(function(data){
            data = JSON.parse(data);
            console.log(data[0])
            $('#nome-curso-edit').val(data[0].curso_formacao_candidato);
            $('#nome-instituicao-edit').val(data[0].instituicao_formacao_candidato);
            $('#nivel-curso-edit').val(data[0].id_escolaridade);
            $('#data-inicio-edit').val(data[0].data_inicio_formacao);
            $('#data-conclusao-edit').val(data[0].data_fim_formacao);
            $('#desc-curso-edit').val(data[0].descricao_formacao_candidato);
            $('#id-editar').val(data[0].id_formacao_candidato);
            $('#editar').modal('show');
          });
        });
        //ao clicar no botão visualizar
        $('a[id^="botao-ver-"]').on('click', function(e){
          e.preventDefault();
          let id = this.id;
          id = id.slice(10);
      
          $.ajax({
            url: '/formacao/visualizar/' + id,
            method: 'POST',
            data: {'id': id}
          }).done(function(data){
            data = JSON.parse(data);
            console.log(data[0])

            $('#nome-curso-ver').val(data[0].curso_formacao_candidato);
            $('#nome-instituicao-ver').val(data[0].instituicao_formacao_candidato);
            $('#nivel-curso-ver').val(data[0].id_escolaridade);
            $('#data-inicio-ver').val(data[0].data_inicio_formacao);
            $('#data-conclusao-ver').val(data[0].data_fim_formacao);
            $('#desc-curso-ver').val(data[0].descricao_formacao_candidato);
            

            $('#visualizar').modal('show');
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
} );
</script>