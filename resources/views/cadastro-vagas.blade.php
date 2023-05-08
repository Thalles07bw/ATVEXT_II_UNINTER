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
        <h1 class="h3 mb-0 text-gray-800 ">Vagas</h1>
    </div>
    <div class="row">
      <div class="card shadow col-md-12">
        <div class="card-header py-3">
          <h4>Cadastro de Vagas</h4>
        </div>
        <div class="card-body">
          <form id="cadastro-vaga" method="POST">
            @csrf  
            <div class="row form-row-spacing">
              <div class="col-md-4">
                <label>Nome da vaga:</label>
                <input class="form-control" type="text" name="titulo-vaga" id="titulo-vaga">
              </div>  
              <div class="col-md-4">
                <label>Cargo:</label>
                <select class="form-control" name="id-cargo" id="id-cargo">
                <option value="0">Selecione o Cargo</option>
                @foreach ($cargos as $each)
                  <option value="{{$each->id_cargo}}">{{$each->cargo}}</option>
                @endforeach
                </select>
              </div>
              <div class="col-md-4">
                <label>Quantidade de Vagas:</label>
                <input class="form-control" type="text" name="qtde-vagas" id="qtde-vagas">
              </div>  
            </div>
            <br>
            <div class="row form-row-spacing">
              <div class="col-md-6">
                <label>Video da vaga:</label>
                <input class="form-control" type="text" name="link-video-vaga" id="link-video-vaga">
              </div>  
              <div class="col-md-3">
                <label>Limite das inscrições:</label>
                <input class="form-control" type="date" name="data-limite-inscricao" id="data-limite-inscricao">
              </div>
              <div class="col-md-3">
                <label>Status do Processo seletivo:</label>
                <select class="form-control" name="status" id="status">
                  <option value="0">Selecione o status atual do processo</option>
                  @foreach ($status as $each)
                  <option value="{{$each->id_status_vaga}}">{{$each->status_vaga}}</option> 
                  @endforeach
                </select>
              </div>             
            </div>  
            <br>
            <div class="row form-row-spacing">
              <div class="col-md-12">
                <label>Descrição da vaga:</label>
                <textarea class="form-control textarea" type="text" name="desc-vaga" id="desc-vaga"></textarea>
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
            <h4>Vagas Cadastradas</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
          <table id="tabela-cargos" class="display" style="width:100%">
            <thead>
                <tr style="text-align: center;">
                    <th>Título</th>
                    <th>Senioridade</th>
                    <th>Quantidade de Vagas</th>
                    <th>Data limite de inscrição</th>              
                    <th>Status da Vaga</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tabela as $each)
                <tr style="text-align: center;">
                    <td>{{$each->titulo_vaga}}</td>
                    <td>{{$each->nome_senioridade}}</td>
                    <td>{{$each->qtd_posicao}}</td>
                    <td>{{date('d/m/Y', strtotime($each->prazo_processo_seletivo))}}</td>
                    <td>{{$each->status_vaga}}</td>
                    <td style="width: 40%;">
                        @if($each->id_status_vaga == 1)
                        <a href="/teste/quadro-processo-seletivo/{{$each->id_vaga}}" class="btn btn-info" style="margin-bottom: 2px;"> Candidatos</a>
                        @elseif($each->id_status_vaga == 4)
                        <a href="/teste/modificar-etapas/{{$each->id_vaga}}" class="btn btn-info" style="margin-bottom: 2px;"> Modificar Etapas</a>
                        @endif
                        <a id="botao-ver-{{$each->id_vaga}}" href="#" class="btn btn-primary" style="margin-left: 2px; margin-bottom: 2px;"> Ver</a>
                        <a id="botao-editar-{{$each->id_vaga}}" href="#" class="btn btn-success" style="margin-left: 2px; margin-bottom: 2px;">Editar</a>
                        <a id="botao-excluir-{{$each->id_vaga}}" href="#" class="btn btn-danger" style="margin-left: 2px; margin-bottom: 2px;">Excluir</a>
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
      <div class="row form-row-spacing">
        <div class="col-md-4">
          <label>Nome da vaga:</label>
          <input class="form-control" type="text"  id="titulo-vaga-ver" disabled>
        </div>  
        <div class="col-md-4">
          <label>Cargo:</label>
          <select class="form-control"  id="id-cargo-ver" disabled>
          <option value="0">Selecione o Cargo</option>
          @foreach ($cargos as $each)
            <option value="{{$each->id_cargo}}">{{$each->cargo}}</option>
          @endforeach
          </select>
        </div>
        <div class="col-md-4">
          <label>Quantidade de Vagas:</label>
          <input class="form-control" type="text"  id="qtde-vagas-ver" disabled>
        </div>  
      </div>
    
      <div class="row form-row-spacing">
        <div class="col-md-6">
          <label>Video da vaga:</label>
          <input class="form-control" type="text"  id="link-video-vaga-ver" disabled>
        </div>  
        <div class="col-md-3">
          <label>Limite das inscrições:</label>
          <input class="form-control" type="date"  id="data-limite-inscricao-ver" disabled>
        </div>
        <div class="col-md-3">
          <label>Status do Processo seletivo:</label>
          <select class="form-control" name="status" id="status" disabled>
            <option value="0">Selecione o status atual do processo</option>
            @foreach ($status as $each)
            <option value="{{$each->id_status_vaga}}">{{$each->status_vaga}}</option> 
            @endforeach
          </select>
          </div>             
        </div>  
        <br>
        <div class="row form-row-spacing">
          <div class="col-md-12">
            <label>Descrição da vaga:</label>
            <textarea class="form-control" type="text"  id="desc-vaga-ver" disabled></textarea>
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
        <form method="POST" id="form-editar-vagas">
        @csrf
        <div class="row form-row-spacing">
          <div class="col-md-4">
            <label>Nome da vaga:</label>
            <input class="form-control" type="text" name="titulo-vaga" id="titulo-vaga-edit">
          </div>  
          <div class="col-md-4">
            <label>Cargo:</label>
            <select class="form-control" name="id-cargo" id="id-cargo-edit">
            <option value="0">Selecione o Cargo</option>
            @foreach ($cargos as $each)
              <option value="{{$each->id_cargo}}">{{$each->cargo}}</option>
            @endforeach
            </select>
          </div>
          <div class="col-md-4">
            <label>Quantidade de Vagas:</label>
            <input class="form-control" type="text" name="qtde-vagas" id="qtde-vagas-edit">
          </div>  
        </div>
        <br>
        <div class="row form-row-spacing">
          <div class="col-md-6">
            <label>Video da vaga:</label>
            <input class="form-control" type="text" name="link-video-vaga" id="link-video-vaga-edit">
          </div>  
          <div class="col-md-3">
            <label>Limite das inscrições:</label>
            <input class="form-control" type="date" name="data-limite-inscricao" id="data-limite-inscricao-edit">
          </div>
          <div class="col-md-3">
            <label>Status do Processo seletivo:</label>
            <select class="form-control" name="status" id="status-edit">
              <option value="0">Selecione o status atual do processo</option>
              @foreach ($status as $each)
              <option value="{{$each->id_status_vaga}}">{{$each->status_vaga}}</option> 
              @endforeach
            </select>
          </div>             
        </div>  

        <div class="row form-row-spacing">
          <div class="col-md-12">
            <label>Descrição da vaga:</label>
            <textarea class="form-control textarea" type="text" name="desc-vaga" id="desc-vaga-edit"></textarea>
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

$(document).ready(function() {

  
    //Edição
    $('#form-editar-vagas').on('submit', function(e){  
      e.preventDefault();
      var data = $('#form-editar-vagas').serialize();
      console.log(data);
      if($('#titulo-vaga-edit').val() == '' || $('#id-cargo-edit').val() == 0 || 
      $('#qtde-vagas-edit').val() == '' ||$('#link-video-vaga-edit').val() == '' || 
      $('#data-limite-inscricao-edit').val() == '' || $('#desc-vaga-edit').val() == '' || 
      $('#status-edit').val() == 0 ){
        
        if($('#titulo-vaga-edit').val() == ''){
          $('#titulo-vaga-edit').css('border-color', 'red');
        }else{
          $('#titulo-vaga-edit').css('border-color', '#ced4da');
        }

        if($('#id-cargo-edit').val() == 0){
          $('#id-cargo-edit').css('border-color', 'red');
        }else{
          $('#id-cargo-edit').css('border-color', '#ced4da');
        }

        if($('#qtde-vagas-edit').val() == ''){
          $('#qtde-vagas-edit').css('border-color', 'red');
        }else{
          $('#qtde-vagas-edit').css('border-color', '#ced4da');
        }

        if($('#link-video-vaga-edit').val() == ''){
          $('#link-video-vaga-edit').css('border-color', 'red');
        }else{
          $('#link-video-vaga-edit').css('border-color', '#ced4da');
        }

        if($('#data-limite-inscricao-edit').val() == 0){
          $('#sdata-limite-inscricao-edit').css('border-color', 'red');
        }else{
          $('#data-limite-inscricao-edit').css('border-color', '#ced4da');
        }

        if($('#desc-vaga-edit').val() == ''){
          $('#desc-vaga-edit').css('border-color', 'red');
        }else{
          $('#desc-vaga-edit').css('border-color', '#ced4da');
        }

        if($('#status-edit').val() == 0){
          $('#status-edit').css('border-color', 'red');
        }else{
          $('#status-edit').css('border-color', '#ced4da');
        }


        $('.error-alert-text').html('');
        $('.error-alert-text').html('Preencha os campos marcados em vermelho para continuar');
        $('#alert-modal-error').show();

      }else{
        $.ajax({
          url: '/teste/cadastro-vagas/editar',
          type: 'POST',
          data: data
        }).done(function(data){
          data = JSON.parse(data);
          $('.success-alert-text').html('');
          $('.success-alert-text').html(data['mensagem']);
          $("#redirect-alert").attr("href", "/teste/cadastro-vagas");
          $('#alert-ok').show();

        });
      }
    });
    //Exclusão
    $('#confirmar-exclusao').on('click', function(e){
      e.preventDefault();
      var id = $('#id-delete').val();
      $.ajax({
        url: '/teste/cadastro-vagas/deletar/' + id,
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
    $('#cadastro-vaga').on('submit', function(e){  
      e.preventDefault();
      var data = $('#cadastro-vaga').serialize();
      console.log(data);

      if($('#titulo-vaga').val() == '' || $('#id-cargo').val() == 0 || 
      $('#qtde-vagas').val() == '' ||$('#link-video-vaga').val() == '' || 
      $('#data-limite-inscricao').val() == '' || $('#desc-vaga').val() == '' || 
      $('#status').val() == 0 ){
        
        if($('#titulo-vaga').val() == ''){
          $('#titulo-vaga').css('border-color', 'red');
        }else{
          $('#titulo-vaga').css('border-color', '#ced4da');
        }

        if($('#id-cargo').val() == 0){
          $('#id-cargo').css('border-color', 'red');
        }else{
          $('#id-cargo').css('border-color', '#ced4da');
        }

        if($('#qtde-vagas').val() == ''){
          $('#qtde-vagas').css('border-color', 'red');
        }else{
          $('#qtde-vagas').css('border-color', '#ced4da');
        }

        if($('#link-video-vaga').val() == ''){
          $('#link-video-vaga').css('border-color', 'red');
        }else{
          $('#link-video-vaga').css('border-color', '#ced4da');
        }

        if($('#data-limite-inscricao').val() == 0){
          $('#sdata-limite-inscricao').css('border-color', 'red');
        }else{
          $('#data-limite-inscricao').css('border-color', '#ced4da');
        }

        if($('#desc-vaga').val() == ''){
          $('#desc-vaga').css('border-color', 'red');
        }else{
          $('#desc-vaga').css('border-color', '#ced4da');
        }

        if($('#status').val() == 0){
          $('#status').css('border-color', 'red');
        }else{
          $('#status').css('border-color', '#ced4da');
        }

        $('.error-alert-text').html('');
        $('.error-alert-text').html('Preencha os campos marcados em vermelho para continuar');
        $('#alert-modal-error').show();

      }else{
        $.ajax({
          url: '/teste/cadastro-vagas',
          type: 'POST',
          data: data
        }).done(function(data){
          data = JSON.parse(data);
          $('.success-alert-text').html('');
          $('.success-alert-text').html(data['mensagem']);
          $("#redirect-alert").attr("href", "/teste/cadastro-vagas");
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
            url: '/teste/cadastro-vagas/visualizar/' + id,
            method: 'POST',
            data: {'id': id}
          }).done(function(data){
            data = JSON.parse(data);
            console.log(data[0])
            $('#titulo-vaga-edit').val(data[0].titulo_vaga);
            $('#id-cargo-edit').val(data[0].id_cargo);
            $('#qtde-vagas-edit').val(data[0].qtd_posicao);
            $('#link-video-vaga-edit').val(data[0].video_vaga);
            $('#data-limite-inscricao-edit').val(data[0].prazo_processo_seletivo);
            $('#desc-vaga-edit').summernote('code',data[0].descricao_vaga);
            $('#status-edit').val(data[0].id_status_vaga);
            $('#id-editar').val(data[0].id_vaga);
            $('#editar').modal('show');
          });
        });
        //ao clicar no botão visualizar
        $('a[id^="botao-ver-"]').on('click', function(e){
          e.preventDefault();
          let id = this.id;
          id = id.slice(10);
      
          $.ajax({
            url: '/teste/cadastro-vagas/visualizar/' + id,
            method: 'POST',
            data: {'id': id}
          }).done(function(data){
            data = JSON.parse(data);
            console.log(data[0])

            $('#titulo-vaga-ver').val(data[0].titulo_vaga);
            $('#id-cargo-ver').val(data[0].id_cargo);
            $('#qtde-vagas-ver').val(data[0].qtd_posicao);
            $('#link-video-vaga-ver').val(data[0].video_vaga);
            $('#data-limite-inscricao-ver').val(data[0].prazo_processo_seletivo);
            $('#desc-vaga-ver').val(data[0].descricao_vaga);
            $('#status-ver').val(data[0].id_status_vaga);


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