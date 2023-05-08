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
        <h1 class="h3 mb-0 text-gray-800 ">Cargos</h1>
    </div>
    <div class="row">
      <div class="card shadow col-md-12">
        <div class="card-header py-3">
          <h4>Cadastro de Cargos</h4>
        </div>
        <div class="card-body">
          <form id="cadastro-cargo" method="POST">
            @csrf  
            <div class="row form-row-spacing">
              <div class="col-md-4">
                <label>Nome do cargo:</label>
                <input class="form-control" type="text" name="nome-cargo" id="nome-cargo">
              </div>  
              <div class="col-md-4">
                <label>CBO:</label>
                <select class="form-control" name="cbo" id="cbo">
                <option value="0">Selecione o CBO</option>
                @foreach($cbos as $each)
                <option value="{{$each->id_cbo}}"> {{$each->nome_cbo}}</option>
                @endforeach
                </select>
              </div>
              <div class="col-md-4">
                <label>Piso Salarial:</label>
                <input class="form-control" type="text" name="piso-salarial" id="piso-salarial">
              </div>  
            </div>
            <br>
            <div class="row form-row-spacing">
              <div class="col-md-12">
                <label>Atividades do Cargo:</label>
                <input class="form-control" type="text" name="atividades-cargo" id="atividades-cargo">
              </div>  
            </div>
            <br>
            <div class="row form-row-spacing">
              <div class="col-md-4">
                <label>Senioridade:</label>
                <select class="form-control" name="senioridade" id="senioridade">
                <option value="0">Selecione a Senioridade</option>
                @foreach($senioridades as $each)
                <option value="{{$each->id_senioridade}}"> {{$each->nome_senioridade}}</option>
                @endforeach
                </select>
              </div>  
              <div class="col-md-4">
                <label>Escolaridade Mínima:</label>
                <select class="form-control" name="escolaridade-min" id="escolaridade-min">
                  <option value="0">Selecione a Escolaridade Mínima</option>
                  @foreach($escolaridades as $each)
                  <option value="{{$each->id_escolaridade}}"> {{$each->nome_escolaridade}}</option>
                  @endforeach
                </select>
              </div>  
              <div class="col-md-4">
                <label>Escolaridade Máxima:</label>
                <select class="form-control" name="escolaridade-max" id="escolaridade-max">
                  <option value="0">Selecione a Escolaridade Máxima</option>
                  @foreach($escolaridades as $each)
                  <option value="{{$each->id_escolaridade}}"> {{$each->nome_escolaridade}}</option>
                  @endforeach
                </select>
              </div>  
            </div>      
            <br>
            <div class="row form-row-spacing">
              <div class="col-md-12">
                <label>Descrição do cargo:</label>
                <textarea class="form-control" type="text" name="desc-cargo" id="desc-cargo"></textarea>
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
            <h4>Cargos Cadastrados</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
          <table id="tabela-cargos" class="display" style="width:100%">
            <thead>
                <tr style="text-align: center;">
                    <th>Nome</th>
                    <th>Piso Salarial</th>
                    <th>Senioridade</th>
                    <th>Data de criação</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tabela as $each)
                <tr style="text-align: center;">
                    <td>{{$each->nome_cargo}}</td>
                    <td>{{$each->piso_salarial_cargo}}</td>
                    <td>{{$each->nome_senioridade}}</td>
              
                    <td>{{date('d/m/Y',strtotime($each->data))}}</td>
                    <td style="width: 25%;">
                        <a id="botao-ver-{{$each->id_cargo}}" href="#" class="btn btn-primary" style="margin-bottom: 2px;"> Ver</a>
                        <a id="botao-editar-{{$each->id_cargo}}" href="#" class="btn btn-success" style="margin-left: 2px; margin-bottom: 2px;">Editar</a>
                        <a id="botao-excluir-{{$each->id_cargo}}" href="#" class="btn btn-danger" style="margin-left: 2px; margin-bottom: 2px;">Excluir</a>
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
            <label>Nome do cargo:</label>
            <input class="form-control" type="text" name="nome-cargo-ver" id="nome-cargo-ver" disabled>
          </div>  
          <div class="col-md-4">
            <label>CBO:</label>
            <select class="form-control" name="cbo-ver" id="cbo-ver" disabled>
            <option value="0">Selecione o CBO</option>
            @foreach($cbos as $each)
            <option value="{{$each->id_cbo}}"> {{$each->nome_cbo}}</option>
            @endforeach
            </select>
          </div>
          <div class="col-md-4">
            <label>Piso Salarial:</label>
            <input class="form-control" type="text" name="piso-salarial-ver" id="piso-salarial-ver" disabled>
          </div>  
        </div>
        <br>
        <div class="row form-row-spacing">
          <div class="col-md-12">
            <label>Atividades do Cargo:</label>
            <input class="form-control" type="text" name="atividades-cargo-ver" id="atividades-cargo-ver" disabled>
          </div> 
        </div> 
        <br>
        <div class="row form-row-spacing">
          <div class="col-md-3">
            <label>Senioridade:</label>
            <select class="form-control" name="senioridade-ver" id="senioridade-ver" disabled>
            <option value="0">Selecione a Senioridade</option>
            @foreach($senioridades as $each)
            <option value="{{$each->id_senioridade}}"> {{$each->nome_senioridade}}</option>
            @endforeach
            </select>
          </div>
          <div class="col-md-3">
            <label>Escolaridade Mínima:</label>
            <select class="form-control" name="escolaridade-min-ver" id="escolaridade-min-ver" disabled>
              <option value="0">Selecione a Escolaridade Mínima</option>
              @foreach($escolaridades as $each)
              <option value="{{$each->id_escolaridade}}"> {{$each->nome_escolaridade}}</option>
              @endforeach
            </select>
          </div>  
          <div class="col-md-3">
            <label>Escolaridade Máxima:</label>
            <select class="form-control" name="escolaridade-max-ver" id="escolaridade-max-ver" disabled>
              <option value="0">Selecione a Escolaridade Máxima</option>
              @foreach($escolaridades as $each)
              <option value="{{$each->id_escolaridade}}"> {{$each->nome_escolaridade}}</option>
              @endforeach
            </select>
          </div>    
        </div>
        <br>
        <div class="row form-row-spacing">
          <div class="col-md-12">
            <label>Descrição do cargo:</label>
            <textarea class="form-control" type="text" name="desc-cargo-ver" id="desc-cargo-ver" disabled></textarea>
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
        <form method="POST" id="form-editar-cargos">
        @csrf
        <div class="row form-row-spacing">
          <div class="col-md-4">
            <label>Nome do cargo:</label>
              <input class="form-control" type="text" name="nome-cargo" id="nome-cargo-edit">
          </div>  
          <div class="col-md-4">
            <label>CBO:</label>
            <select class="form-control" name="cbo" id="cbo-edit">
              <option value="0">Selecione o CBO</option>
              @foreach($cbos as $each)
              <option value="{{$each->id_cbo}}">{{$each->nome_cbo}}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-4">
              <label>Piso Salarial:</label>
              <input class="form-control" type="text" name="piso-salarial" id="piso-salarial-edit">
          </div>  
        </div>
        <br>
        <div class="row form-row-spacing">
          <div class="col-md-3">
            <label>Atividades do Cargo:</label>
            <input class="form-control" type="text" name="atividades-cargo" id="atividades-cargo-edit">
          </div>  
          <div class="col-md-3">
            <label>Senioridade:</label>
            <select class="form-control" name="senioridade" id="senioridade-edit">
              <option value="0">Selecione a Senioridade</option>
              @foreach($senioridades as $each)
              <option value="{{$each->id_senioridade}}"> {{$each->nome_senioridade}}</option>
            @endforeach
            </select>
          </div>
          <div class="col-md-3">
            <label>Escolaridade Mínima:</label>
            <select class="form-control" name="escolaridade-min" id="escolaridade-min-edit">
              <option value="0">Selecione a Escolaridade Mínima</option>
              @foreach($escolaridades as $each)
              <option value="{{$each->id_escolaridade}}"> {{$each->nome_escolaridade}}</option>
              @endforeach
            </select>
          </div>  
          <div class="col-md-3">
            <label>Escolaridade Máxima:</label>
            <select class="form-control" name="escolaridade-max" id="escolaridade-max-edit">
              <option value="0">Selecione a Escolaridade Máxima</option>
              @foreach($escolaridades as $each)
              <option value="{{$each->id_escolaridade}}"> {{$each->nome_escolaridade}}</option>
              @endforeach
            </select>
          </div>    
        </div>
        <br>
        <div class="row form-row-spacing">
          <div class="col-md-12">
            <label>Descrição do cargo:</label>
            <textarea class="form-control" type="text" name="desc-cargo" id="desc-cargo-edit"></textarea>
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
    $('#form-editar-cargos').on('submit', function(e){  
      e.preventDefault();
      var data = $('#form-editar-cargos').serialize();
      console.log(data);
      if($('#nome-cargo-edit').val() == '' || $('#cbo-edit').val() == 0 || 
      $('#piso-salarial-edit').val() == '' ||$('#atividades-cargo-edit').val() == '' || 
      $('#senioridade-edit').val() == 0  || 
      $('#escolaridade-min-edit').val() == 0 || $('#escolaridade-max-edit').val() == 0
      ){
        
        if($('#nome-cargo-edit').val() == ''){
          $('#nome-cargo-edit').css('border-color', 'red');
        }else{
          $('#nome-cargo-edit').css('border-color', '#ced4da');
        }

        if($('#cbo-edit').val() == 0){
          $('#cbo-edit').css('border-color', 'red');
        }else{
          $('#cbo-edit').css('border-color', '#ced4da');
        }

        if($('#piso-salarial-edit').val() == ''){
          $('#piso-salarial-edit').css('border-color', 'red');
        }else{
          $('#piso-salarial-edit').css('border-color', '#ced4da');
        }

        if($('#atividades-cargo-edit').val() == 0){
          $('#atividades-cargo-edit').css('border-color', 'red');
        }else{
          $('#atividades-cargo-edit').css('border-color', '#ced4da');
        }

        if($('#senioridade-edit').val() == 0){
          $('#senioridade-edit').css('border-color', 'red');
        }else{
          $('#senioridade-edit').css('border-color', '#ced4da');
        }

        if($('#escolaridade-min-edit').val() == 0){
          $('#escolaridade-min-edit').css('border-color', 'red');
        }else{
          $('#escolaridade-min-edit').css('border-color', '#ced4da');
        }

        if($('#escolaridade-max-edit').val() == 0){
          $('#escolaridade-max-edit').css('border-color', 'red');
        }else{
          $('#escolaridade-max-edit').css('border-color', '#ced4da');
        }


        $('.error-alert-text').html('');
        $('.error-alert-text').html('Preencha os campos marcados em vermelho para continuar');
        $('#alert-modal-error').show();

      }else{
        $.ajax({
          url: '/teste/cadastro-cargos/editar',
          type: 'POST',
          data: data
        }).done(function(data){
          data = JSON.parse(data);
          $('.success-alert-text').html('');
          $('.success-alert-text').html(data['mensagem']);
          $("#redirect-alert").attr("href", "/teste/cadastro-cargos");
          $('#alert-ok').show();

        });
      }
    });
    //Exclusão
    $('#confirmar-exclusao').on('click', function(e){
      e.preventDefault();
      var id = $('#id-delete').val();
      $.ajax({
        url: '/teste/cadastro-cargos/deletar/' + id,
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
    $('#cadastro-cargo').on('submit', function(e){  
      e.preventDefault();
      var data = $('#cadastro-cargo').serialize();
  

      if($('#nome-cargo').val() == '' || $('#cbo').val() == 0 || 
      $('#piso-salarial').val() == '' ||$('#atividades-cargo').val() == '' || 
      $('#senioridade').val() == 0 || 
      $('#escolaridade-min').val() == 0 || $('#escolaridade-max').val() == 0){
        
        if($('#nome-cargo').val() == ''){
          $('#nome-cargo').css('border-color', 'red');
        }else{
          $('#nome-cargo').css('border-color', '#ced4da');
        }

        if($('#cbo').val() == 0){
          $('#cbo').css('border-color', 'red');
        }else{
          $('#cbo').css('border-color', '#ced4da');
        }

        if($('#piso-salarial').val() == ''){
          $('#piso-salarial').css('border-color', 'red');
        }else{
          $('#piso-salarial').css('border-color', '#ced4da');
        }

        if($('#atividades-cargo').val() == 0){
          $('#atividades-cargo').css('border-color', 'red');
        }else{
          $('#atividades-cargo').css('border-color', '#ced4da');
        }

        if($('#senioridade').val() == 0){
          $('#senioridade').css('border-color', 'red');
        }else{
          $('#senioridade').css('border-color', '#ced4da');
        }

        if($('#escolaridade-min').val() == 0){
          $('#escolaridade-min').css('border-color', 'red');
        }else{
          $('#escolaridade-min').css('border-color', '#ced4da');
        }

        if($('#escolaridade-max').val() == 0){
          $('#escolaridade-max').css('border-color', 'red');
        }else{
          $('#escolaridade-max').css('border-color', '#ced4da');
        }

        $('.error-alert-text').html('');
        $('.error-alert-text').html('Preencha os campos marcados em vermelho para continuar');
        $('#alert-modal-error').show();

      }else{
        $.ajax({
          url: '/teste/cadastro-cargos',
          type: 'POST',
          data: data
        }).done(function(data){
          data = JSON.parse(data);
          console.log(data);
          $('.success-alert-text').html('');
          $('.success-alert-text').html(data['mensagem']);
          $("#redirect-alert").attr("href", "/teste/cadastro-cargos");
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
            url: '/teste/cadastro-cargos/visualizar/' + id,
            method: 'POST',
            data: {'id': id}
          }).done(function(data){
            data = JSON.parse(data);
            console.log(data[0])
            $('#nome-cargo-edit').val(data[0].nome_cargo);
            $('#cbo-edit').val(data[0].id_cbo);
            $('#piso-salarial-edit').val(data[0].piso_salarial_cargo);
            $('#atividades-cargo-edit').val(data[0].atividades_cargo);
            $('#senioridade-edit').val(data[0].id_senioridade);
            $('#desc-cargo-edit').val(data[0].descricao_sumaria_cargo);
            $('#escolaridade-min-edit').val(data[0].id_escolaridade_min);
            $('#escolaridade-max-edit').val(data[0].id_escolaridade_max);
            $('#id-editar').val(data[0].id_cargo);
            $('#editar').modal('show');
          });
        });
        //ao clicar no botão visualizar
        $('a[id^="botao-ver-"]').on('click', function(e){
          e.preventDefault();
          let id = this.id;
          id = id.slice(10);
      
          $.ajax({
            url: '/teste/cadastro-cargos/visualizar/' + id,
            method: 'POST',
            data: {'id': id}
          }).done(function(data){
            data = JSON.parse(data);
            console.log(data[0])

            $('#nome-cargo-ver').val(data[0].nome_cargo);
            $('#cbo-ver').val(data[0].id_cbo);
            $('#piso-salarial-ver').val(data[0].piso_salarial_cargo);
            $('#atividades-cargo-ver').val(data[0].atividades_cargo);
            $('#senioridade-ver').val(data[0].id_senioridade);
            $('#escolaridade-min-ver').val(data[0].id_escolaridade_min);
            $('#escolaridade-max-ver').val(data[0].id_escolaridade_max);
            $('#desc-cargo-ver').val(data[0].descricao_sumaria_cargo);
            $('#id-editar').val();

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