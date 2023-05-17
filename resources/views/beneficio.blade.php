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
        <h1 class="h3 mb-0 text-gray-800 ">Benefícios</h1>
    </div>
    <div class="row">
      <div class="card shadow col-md-12">
        <div class="card-header py-3">
          <h4>Cadastro de benefícios</h4>
        </div>
        <div class="card-body">
          <form id="cadastro-beneficio" method="POST">
            @csrf  
            <div class="row form-row-spacing">
              <div class="col-md-6">
                <label>Nome do benefício:</label>
                <input class="form-control" type="text" name="nome-beneficio" id="nome-beneficio">
              </div>  
              <div class="col-md-6">
                <label>Tipo do beneficio:</label>
                <select class="form-control" name="tipo-beneficio" id="tipo-beneficio">
                  <option value="0">Selecione o tipo do benefício</option>
                  @foreach($tipoBeneficio as $each)
                  <option value="{{$each->id_tipo_beneficio}}">{{$each->nome_tipo_beneficio}}</option>
                  @endforeach
                </select>
              </div>  
            </div>
            <br>
            <div class="row form-row-spacing">
              <div class="col-md-6">
                <label>Valor do benefício:</label>
                <input class="form-control" type="text" name="valor-beneficio" id="valor-beneficio">
              </div>  
              <div class="col-md-6">
                <label>Benefício aplicado como:</label>
                <select class="form-control" name="aplicacao-beneficio" id="aplicacao-beneficio">
                  <option value="0">Selecione como o benefício é aplicado</option>
                  @foreach($aplicacaoValor as $tipoAplicacaoValor)
                  <option value="{{$tipoAplicacaoValor->id_tipo_aplicacao_valor}}">{{$tipoAplicacaoValor->tipo_aplicacao_valor}}</option>
                  @endforeach
                </select>
              </div>  
            </div>
            <br>
            <div class="row form-row-spacing">
              <div class="col-md-4">
                <label>Valor descontado:</label>
                <input class="form-control" type="text" name="valor-descontado" id="valor-descontado">
              </div>  
              <div class="col-md-4">
                <label>Como o benefício é descontado:</label>
                <select class="form-control" name="forma-desconto" id="forma-desconto">
                  <option value="">Selecione a forma de desconto</option>
                  @foreach($aplicacaoValor as $tipoAplicacaoValor)
                  <option value="{{$tipoAplicacaoValor->id_tipo_aplicacao_valor}}">{{$tipoAplicacaoValor->tipo_aplicacao_valor}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-4">
                <label>Periodicidade:</label>
                <select class="form-control" name="periodicidade" id="periodicidade">
                  <option value="">Selecione o período</option>
                  @foreach($arrayPeriodicidade as $periodicidade)
                  <option value="{{$periodicidade->id_periodicidade}}">{{$periodicidade->periodicidade}}</option>
                  @endforeach
                </select>
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
            <h4>Benefícios Cadastrados</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
          <table id="tabela-beneficios" class="display" style="width:100%">
            <thead>
                <tr style="text-align: center;">
                    <th>Nome</th>
                    <th>Periodicidade do benefício</th>
                    <th>Valor do benefício</th>
                    <th>Valor descontado</th>
                    <th>Data de criação</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($arrayTabela as $tabela)
                  <tr style="text-align: center;">
                    <td>{{$tabela->nome_beneficio}}</td>
                    <td>{{$tabela->periodicidade}}</td>
                    <td>{{$tabela->valor_beneficio}}</td>
                    <td>{{$tabela->valor_descontado}}</td>
                    <td>{{$tabela->data}}</td>
                    <td style="width: 25%;">
                        <a id="botao-ver-{{$tabela->id_beneficio}}" href="/beneficios/visualizar/{{$tabela->id_beneficio}}" class="btn btn-primary" style="margin-bottom: 2px;"> Ver</a>
                        <a id="botao-editar-{{$tabela->id_beneficio}}" href="/beneficios/editar/{{$tabela->id_beneficio}}" class="btn btn-success" style="margin-left: 2px; margin-bottom: 2px;">Editar</a>
                        <a id="botao-excluir-{{$tabela->id_beneficio}}" href="/beneficios/deletar/{{$tabela->id_beneficio}}" class="btn btn-danger" style="margin-left: 2px; margin-bottom: 2px;">Excluir</a>
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


<!--Modals-->
<!--Modal-visualizar-->
<div class="modal fade" id="visualizar" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Visualizar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row form-row-spacing">
          <div class="col-md-6">
            <label>Nome do benefício:</label>
            <input class="form-control" type="text" id="nome-beneficio-ver" disabled>
          </div>  
          <div class="col-md-6">
            <label>Tipo do beneficio:</label>
            <select class="form-control" id="tipo-beneficio-ver" disabled>
              <option value="0">Selecione o tipo do benefício</option>
              @foreach($tipoBeneficio as $each)
              <option value="{{$each->id_tipo_beneficio}}">{{$each->nome_tipo_beneficio}}</option>
              @endforeach
            </select>
          </div>  
        </div>
        <br>
        <div class="row form-row-spacing">
          <div class="col-md-6">
            <label>Valor do benefício:</label>
            <input class="form-control" type="text"  id="valor-beneficio-ver" disabled>
          </div>  
          <div class="col-md-6">
            <label>Benefício aplicado como:</label>
            <select class="form-control" id="aplicacao-beneficio-ver" disabled>
              <option value="0">Selecione como o benefício é aplicado</option>
              @foreach($aplicacaoValor as $tipoAplicacaoValor)
              <option value="{{$tipoAplicacaoValor->id_tipo_aplicacao_valor}}">{{$tipoAplicacaoValor->tipo_aplicacao_valor}}</option>
              @endforeach
            </select>
          </div>  
        </div>
        <br>
        <div class="row form-row-spacing">
          <div class="col-md-4">
            <label>Valor descontado:</label>
            <input class="form-control" type="text" id="valor-descontado-ver" disabled>
          </div>  
          <div class="col-md-4">
            <label>Periodicidade:</label>
            <select class="form-control" id="periodicidade-ver" disabled>
              <option value="">Selecione o período</option>
              @foreach($arrayPeriodicidade as $periodicidade)
              <option value="{{$periodicidade->id_periodicidade}}">{{$periodicidade->periodicidade}}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-4">
            <label>Como o benefício é descontado:</label>
            <select class="form-control" id="forma-desconto-ver" disabled>
              <option value="">Selecione a forma de desconto</option>
              @foreach($aplicacaoValor as $tipoAplicacaoValor)
              <option value="{{$tipoAplicacaoValor->id_tipo_aplicacao_valor}}">{{$tipoAplicacaoValor->tipo_aplicacao_valor}}</option>
              @endforeach
            </select>
          </div>    
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

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
        <form method="post" id="form-editar-beneficio">
        @csrf
        <div class="row form-row-spacing">
          <div class="col-md-6">
            <label>Nome do benefício:</label>
            <input class="form-control" type="text" name="nome-beneficio" id="nome-beneficio-editar">
          </div>  
          <div class="col-md-6">
            <label>Tipo do beneficio:</label>
            <select class="form-control" name="tipo-beneficio" id="tipo-beneficio-editar" >
              <option value="0">Selecione o tipo do benefício</option>
              @foreach($tipoBeneficio as $each)
              <option value="{{$each->id_tipo_beneficio}}">{{$each->nome_tipo_beneficio}}</option>
              @endforeach
            </select>
          </div>  
        </div>
        <br>
        <div class="row form-row-spacing">
          <div class="col-md-6">
            <label>Valor do benefício:</label>
            <input class="form-control" type="text" name="valor-beneficio" id="valor-beneficio-editar">
          </div>  
          <div class="col-md-6">
            <label>Benefício aplicado como:</label>
            <select class="form-control" name="aplicacao-beneficio" id="aplicacao-beneficio-editar">
              <option value="0">Selecione como o benefício é aplicado</option>
              @foreach($aplicacaoValor as $tipoAplicacaoValor)
              <option value="{{$tipoAplicacaoValor->id_tipo_aplicacao_valor}}">{{$tipoAplicacaoValor->tipo_aplicacao_valor}}</option>
              @endforeach
            </select>
          </div>  
        </div>
        <br>
        <div class="row form-row-spacing">
          <div class="col-md-4">
            <label>Valor descontado:</label>
            <input class="form-control" type="text" name="valor-descontado" id="valor-descontado-editar">
          </div>  
          <div class="col-md-4">
            <label>Periodicidade:</label>
            <select class="form-control" name="periodicidade" id="periodicidade-editar" >
              <option value="">Selecione o período</option>
              @foreach($arrayPeriodicidade as $periodicidade)
              <option value="{{$periodicidade->id_periodicidade}}">{{$periodicidade->periodicidade}}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-4">
            <label>Como o benefício é descontado:</label>
            <select class="form-control" name="forma-desconto" id="forma-desconto-editar" >
              <option value="">Selecione a forma de desconto</option>
              @foreach($aplicacaoValor as $tipoAplicacaoValor)
              <option value="{{$tipoAplicacaoValor->id_tipo_aplicacao_valor}}">{{$tipoAplicacaoValor->tipo_aplicacao_valor}}</option>
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

$(document).ready(function() {

    //Visualização
    $('a[id^="botao-ver-"]').on('click', function(e){
      e.preventDefault();
      let id = this.id;
      id = id.slice(10);
   
      $.ajax({
        url: '/beneficios/visualizar/' + id,
        method: 'POST',
        data: {'id': id}
      }).done(function(data){
        data = JSON.parse(data);
        console.log(data[0])
        $('#nome-beneficio-ver').val(data[0].nome_beneficio);
        $('#tipo-beneficio-ver').val(data[0].id_tipo_beneficio);
        $('#valor-beneficio-ver').val(data[0].valor_beneficio);
        $('#aplicacao-beneficio-ver').val(data[0].beneficio_descontado_como);
        $('#valor-descontado-ver').val(data[0].valor_descontado);
        $('#periodicidade-ver').val(data[0].id_periodicidade);
        $('#forma-desconto-ver').val(data[0].beneficio_descontado_como);
        $('#id-editar').val();
        $('#visualizar').modal('show');
      })
    });

    //Edição


    $('#form-editar-beneficio').on('submit', function(e){  
      e.preventDefault();
      var data = $('#form-editar-beneficio').serialize();
      console.log(data);
      if($('#nome-beneficio-editar').val() == '' || $('#tipo-beneficio-editar').val() == 0 || 
      $('#valor-beneficio-editar').val() == '' ||$('#aplicacao-beneficio-editar').val() == 0 || 
      $('#valor-descontado-editar').val() == '' || $('#periodicidade-editar').val() == 0 || 
      $('#forma-desconto-editar').val() == 0){
        if($('#nome-beneficio-editar').val() == ''){
          $('#nome-beneficio-editar').css('border-color', 'red');
        }else{
          $('#nome-beneficio-editar').css('border-color', '#ced4da');
        }

        if($('#tipo-beneficio-editar').val() == 0){
          $('#tipo-beneficio-editar').css('border-color', 'red');
        }else{
          $('#tipo-beneficio-editar').css('border-color', '#ced4da');
        }

        if($('#valor-beneficio-editar').val() == ''){
          $('#valor-beneficio-editar').css('border-color', 'red');
        }else{
          $('#valor-beneficio-editar').css('border-color', '#ced4da');
        }

        if($('#aplicacao-beneficio-editar').val() == 0){
          $('#aplicacao-beneficio-editar').css('border-color', 'red');
        }else{
          $('#aplicacao-beneficio-editar').css('border-color', '#ced4da');
        }

        if($('#valor-descontado-editar').val() == ''){
          $('#valor-descontado-editar').css('border-color', 'red');
        }else{
          $('#valor-descontado-editar').css('border-color', '#ced4da');
        }

        if($('#periodicidade-editar').val() == ''){
          $('#periodicidade-editar').css('border-color', 'red');
        }else{
          $('#periodicidade-editar').css('border-color', '#ced4da');
        }

        if($('#forma-desconto-editar').val() == ''){
          $('#forma-desconto-editar').css('border-color', 'red');
        }else{
          $('#forma-desconto-editar').css('border-color', '#ced4da');
        }

        $('.error-alert-text').html('');
        $('.error-alert-text').html('Preencha os campos marcados em vermelho para continuar');
        $('#alert-modal-error').show();

      }else{
        $.ajax({
          url: '/beneficios/editar',
          type: 'POST',
          data: data
        }).done(function(data){
          data = JSON.parse(data);
          $('.success-alert-text').html('');
          $('.success-alert-text').html(data['mensagem']);
          $("#redirect-alert").attr("href", "/beneficios");
          $('#alert-ok').show();

        });
      }
    });


    //Exclusão
   
    $('#confirmar-exclusao').on('click', function(e){
      e.preventDefault();
      var id = $('#id-delete').val();
      $.ajax({
        url: '/beneficios/deletar/' + id,
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
    $('#cadastro-beneficio').on('submit', function(e){  
      e.preventDefault();
      var data = $('#cadastro-beneficio').serialize();

      if($('#nome-beneficio').val() == '' || $('#tipo-beneficio').val() == 0 || 
      $('#valor-beneficio').val() == '' ||$('#aplicacao-beneficio').val() == 0 || 
      $('#valor-descontado').val() == '' || $('#periodicidade').val() == 0 || 
      $('#forma-desconto').val() == 0){
        if($('#nome-beneficio').val() == ''){
          $('#nome-beneficio').css('border-color', 'red');
        }else{
          $('#nome-beneficio').css('border-color', '#ced4da');
        }

        if($('#tipo-beneficio').val() == 0){
          $('#tipo-beneficio').css('border-color', 'red');
        }else{
          $('#tipo-beneficio').css('border-color', '#ced4da');
        }

        if($('#valor-beneficio').val() == ''){
          $('#valor-beneficio').css('border-color', 'red');
        }else{
          $('#valor-beneficio').css('border-color', '#ced4da');
        }

        if($('#aplicacao-beneficio').val() == 0){
          $('#aplicacao-beneficio').css('border-color', 'red');
        }else{
          $('#aplicacao-beneficio').css('border-color', '#ced4da');
        }

        if($('#valor-descontado').val() == ''){
          $('#valor-descontado').css('border-color', 'red');
        }else{
          $('#valor-descontado').css('border-color', '#ced4da');
        }

        if($('#periodicidade').val() == ''){
          $('#periodicidade').css('border-color', 'red');
        }else{
          $('#periodicidade').css('border-color', '#ced4da');
        }

        if($('#forma-desconto').val() == ''){
          $('#forma-desconto').css('border-color', 'red');
        }else{
          $('#forma-desconto').css('border-color', '#ced4da');
        }

        $('.error-alert-text').html('');
        $('.error-alert-text').html('Preencha os campos marcados em vermelho para continuar');
        $('#alert-modal-error').show();

      }else{
        $.ajax({
          url: '/beneficios',
          type: 'POST',
          data: data
        }).done(function(data){
          data = JSON.parse(data);
          $('.success-alert-text').html('');
          $('.success-alert-text').html(data['mensagem']);
          $("#redirect-alert").attr("href", "/beneficios");
          $('#alert-ok').show();

        });
      }
    });

    //Tabela de controle de benefícios
    $('#tabela-beneficios').DataTable({
      "drawCallback": function(){
        //Ao clicar no botão excluir
        $('a[id^="botao-excluir-"]').on('click', function(e){
          e.preventDefault();
          $('#alert-modal-delete').show();
          let id = this.id;
          id = id.slice(14);
          $('#id-delete').val(id);
        });
        //Ao clicar no botão editar
        $('a[id^="botao-editar-"]').on('click', function(e){
            e.preventDefault();
            let id = this.id;
            id = id.slice(13);
            $('#id-editar').val(id);
            $.ajax({
              url: '/beneficios/visualizar/' + id,
              method: 'POST',
              data: {'id': id}
            }).done(function(data){
              data = JSON.parse(data);
              console.log(data[0])
              $('#nome-beneficio-editar').val(data[0].nome_beneficio);
              $('#tipo-beneficio-editar').val(data[0].id_tipo_beneficio);
              $('#valor-beneficio-editar').val(data[0].valor_beneficio);
              $('#aplicacao-beneficio-editar').val(data[0].beneficio_descontado_como);
              $('#valor-descontado-editar').val(data[0].valor_descontado);
              $('#periodicidade-editar').val(data[0].id_periodicidade);
              $('#forma-desconto-editar').val(data[0].beneficio_descontado_como);
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
});
</script>