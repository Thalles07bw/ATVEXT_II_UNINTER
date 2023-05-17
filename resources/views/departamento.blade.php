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
        <h1 class="h3 mb-0 text-gray-800 ">Departamentos</h1>
    </div>
    <div class="row">
      <div class="card shadow col-md-12">
        <div class="card-header py-3">
          <h4>Cadastro de departamentos</h4>
        </div>
        <div class="card-body">
          <form id="cadastro-depto" method="POST">
            @csrf  
            <div class="row form-row-spacing">
              <div class="col-md-4">
                <label>Nome do departamento:</label>
                <input class="form-control" type="text" name="nome-depto" id="nome-depto">
              </div>  
              <div class="col-md-4">
                <label>Código Interno:</label>
                <input class="form-control" type="text" name="codigo-depto" id="codigo-depto">
              </div>
              <div class="col-md-4">
                <label>Ramal:</label>
                <input class="form-control" type="text" name="ramal-depto" id="ramal-depto">
              </div>  
            </div>
            <div class="row form-row-spacing">
              <div class="col-md-6">
                <label>Orçamento Mensal:</label>
                <input class="form-control" type="text" name="orcamento-depto" id="orcamento-depto">
              </div>  
              <div class="col-md-6">
                <label>E-mail:</label>
                <input class="form-control" type="text" name="email-depto" id="email-depto">
              </div>  
            </div>
            <div class="row form-row-spacing">
              <div class="col-md-12">
                <label>Descrição do departamento:</label>
                <textarea class="form-control" type="text" name="desc-depto" id="desc-depto"></textarea>
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
            <h4>Departamentos Cadastrados</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
          <table id="tabela-departamentos" class="display" style="width:100%">
            <thead>
                <tr style="text-align: center;">
                    <th>Nome</th>
                    <th>Orçamento</th>
                    <th>E-mail</th>
                    <th>Ramal</th>
                    <th>Data de criação</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tabela as $each)
                <tr style="text-align: center;">
                    <td>{{$each->nome_departamento}}</td>
                    <td>{{$each->orcamento_mensal}}</td>
                    <td>{{$each->email_departamento}}</td>
                    <td>{{$each->ramal_departamento}}</td>
                    <td>{{date('d/m/Y', strtotime($each->data_criacao))}}</td>
                    <td style="width: 25%;">
                        <a id="botao-ver-{{$each->id_departamento}}" href="/departamentos/visualizar/" class="btn btn-primary" style="margin-bottom: 2px;"> Ver</a>
                        <a id="botao-editar-{{$each->id_departamento}}" href="/departamentos/editar/" class="btn btn-success" style="margin-left: 2px; margin-bottom: 2px;">Editar</a>
                        <a id="botao-excluir-{{$each->id_departamento}}" href="/departamentos/deletar/" class="btn btn-danger" style="margin-left: 2px; margin-bottom: 2px;">Excluir</a>
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
        <h5 class="modal-title" id="exampleModalLabel">Visualizar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row form-row-spacing">
          <div class="col-md-4">
            <label>Nome do departamento:</label>
            <input class="form-control" type="text" name="nome-depto" id="nome-depto-ver" disabled>
          </div>  
          <div class="col-md-4">
              <label>Código Interno:</label>
              <input class="form-control" type="text" name="codigo-depto" id="codigo-depto-ver" disabled>
          </div>
          <div class="col-md-4">
              <label>Ramal:</label>
              <input class="form-control" type="text" name="ramal-depto" id="ramal-depto-ver" disabled>
          </div>  
        </div>
        <br>
        <div class="row form-row-spacing">
          <div class="col-md-6">
            <label>Orçamento Mensal:</label>
            <input class="form-control" type="text" name="orcamento-depto" id="orcamento-depto-ver" disabled>
          </div>  
          <div class="col-md-6">
            <label>E-mail:</label>
            <input class="form-control" type="text" name="email-depto" id="email-depto-ver" disabled>
          </div>  
        </div>
        <br>
        <div class="row form-row-spacing">
          <div class="col-md-12">
            <label>Descrição do departamento:</label>
            <textarea class="form-control" type="text" name="desc-depto" id="desc-depto-ver" disabled></textarea>
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
        <h5 class="modal-title" id="exampleModalLabel">Visualizar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" id="form-editar-departamentos">
        @csrf
        <div class="row form-row-spacing">
          <div class="col-md-4">
            <label>Nome do departamento:</label>
            <input class="form-control" type="text" name="nome-depto" id="nome-depto-editar" >
          </div>  
          <div class="col-md-4">
              <label>Código Interno:</label>
              <input class="form-control" type="text" name="codigo-depto" id="codigo-depto-editar" >
          </div>
          <div class="col-md-4">
              <label>Ramal:</label>
              <input class="form-control" type="text" name="ramal-depto" id="ramal-depto-editar" >
          </div>  
        </div>
        <div class="row form-row-spacing">
          <div class="col-md-6">
            <label>Orçamento Mensal:</label>
            <input class="form-control" type="text" name="orcamento-depto" id="orcamento-depto-editar" >
          </div>  
          <div class="col-md-6">
            <label>E-mail:</label>
            <input class="form-control" type="text" name="email-depto" id="email-depto-editar" >
          </div>  
        </div>
        <div class="row form-row-spacing">
          <div class="col-md-12">
            <label>Descrição do departamento:</label>
            <textarea class="form-control" type="text" name="desc-depto" id="desc-depto-editar" ></textarea>
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
        url: '/departamentos/visualizar/' + id,
        method: 'POST',
        data: {'id': id}
      }).done(function(data){
        data = JSON.parse(data);
        console.log(data[0])

        $('#nome-depto-ver').val(data[0].nome_departamento);
        $('#desc-depto-ver').val(data[0].descricao_departamento);
        $('#orcamento-depto-ver').val(data[0].orcamento_mensal);
        $('#email-depto-ver').val(data[0].email_departamento);
        $('#codigo-depto-ver').val(data[0].cod_interno);
        $('#ramal-depto-ver').val(data[0].ramal_departamento);
        $('#id-editar').val();

        $('#visualizar').modal('show');
      })
    });

    //Edição


    $('#form-editar-departamentos').on('submit', function(e){  
      e.preventDefault();
      var data = $('#form-editar-departamentos').serialize();
      console.log(data);
      if($('#nome-depto-editar').val() == '' || $('#codigo-depto-editar').val() == '' || 
      $('#ramal-depto-editar').val() == '' || 
      $('#email-depto-editar').val() == '' ){
        if($('#nome-depto-editar').val() == ''){
          $('#nome-depto-editar').css('border-color', 'red');
        }else{
          $('#nome-depto-editar').css('border-color', '#ced4da');
        }

        if($('#codigo-depto-editar').val() == 0){
          $('#codigo-depto-editar').css('border-color', 'red');
        }else{
          $('#codigo-depto-editar').css('border-color', '#ced4da');
        }

        if($('#ramal-depto-editar').val() == ''){
          $('#ramal-depto-editar').css('border-color', 'red');
        }else{
          $('#ramal-depto-editar').css('border-color', '#ced4da');
        }


        if($('#email-depto-editar').val() == ''){
          $('#email-depto-editar').css('border-color', 'red');
        }else{
          $('#email-depto-editar').css('border-color', '#ced4da');
        }


        $('.error-alert-text').html('');
        $('.error-alert-text').html('Preencha os campos marcados em vermelho para continuar');
        $('#alert-modal-error').show();

      }else{
        $.ajax({
          url: '/departamentos/editar',
          type: 'POST',
          data: data
        }).done(function(data){
          data = JSON.parse(data);
          $('.success-alert-text').html('');
          $('.success-alert-text').html(data['mensagem']);
          $("#redirect-alert").attr("href", "/departamentos");
          $('#alert-ok').show();

        });
      }
    });


    //Exclusão

   
    $('#confirmar-exclusao').on('click', function(e){
      e.preventDefault();
      var id = $('#id-delete').val();
      $.ajax({
        url: '/departamentos/deletar/' + id,
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
    $('#cadastro-depto').on('submit', function(e){  
      e.preventDefault();
      var data = $('#cadastro-depto').serialize();

      if($('#nome-depto').val() == '' || $('#codigo-depto').val() == '' || 
      $('#ramal-depto').val() == '' ||
      $('#email-depto').val() == ''){
        if($('#nome-depto').val() == ''){
          $('#nome-depto').css('border-color', 'red');
        }else{
          $('#nome-depto').css('border-color', '#ced4da');
        }

        if($('#codigo-depto').val() == 0){
          $('#codigo-depto').css('border-color', 'red');
        }else{
          $('#codigo-depto').css('border-color', '#ced4da');
        }

        if($('#ramal-depto').val() == ''){
          $('#ramal-depto').css('border-color', 'red');
        }else{
          $('#ramal-depto').css('border-color', '#ced4da');
        }

        if($('#email-depto').val() == ''){
          $('#email-depto').css('border-color', 'red');
        }else{
          $('#email-depto').css('border-color', '#ced4da');
        }

        $('.error-alert-text').html('');
        $('.error-alert-text').html('Preencha os campos marcados em vermelho para continuar');
        $('#alert-modal-error').show();

      }else{
        $.ajax({
          url: '/departamentos',
          type: 'POST',
          data: data
        }).done(function(data){
          data = JSON.parse(data);
          $('.success-alert-text').html('');
          $('.success-alert-text').html(data['mensagem']);
          $("#redirect-alert").attr("href", "/departamentos");
          $('#alert-ok').show();

        });
      }
    });
    
    //Tabela de controle de benefícios
    $('#tabela-departamentos').DataTable({
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
            url: '/departamentos/visualizar/' + id,
            method: 'POST',
            data: {'id': id}
          }).done(function(data){
            data = JSON.parse(data);
            console.log(data[0])
            $('#nome-depto-editar').val(data[0].nome_departamento);
            $('#desc-depto-editar').val(data[0].descricao_departamento);
            $('#orcamento-depto-editar').val(data[0].orcamento_mensal);
            $('#email-depto-editar').val(data[0].email_departamento);
            $('#codigo-depto-editar').val(data[0].cod_interno);
            $('#ramal-depto-editar').val(data[0].ramal_departamento);
            $('#id-editar').val();
            $('#editar').modal('show');
          });
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