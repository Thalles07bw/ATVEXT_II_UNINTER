@include('partials.header')
  <!--Alerts-->
  @include('alerts.alert-modal-cancel')
  @include('alerts.alert-success')
  @include('alerts.alert-modal-error')
<body>
  <!-- Begin Page Content -->
  <div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 ">Demissões</h1>
    </div>
    <div class="row">
      <div class="card shadow col-md-12">
        <div class="card-header py-3">
          <h4>Cadastro de motivo de demissão</h4>
        </div>
        <div class="card-body">
          <form id="form-demissao" method="POST">
            @csrf  
            <div class="row">
            <div class="col-md-6">
                <label>Colaborador:</label>
                <select class="form-control" type="text" name="colaborador" id="colaborador">
                  <option value="0">Selecione o Colaborador</option>
                  @foreach($colaboradores as $colaborador)
                  <option value="{{$colaborador->id_colaborador}}">{{$colaborador->cpf_colaborador}} - {{$colaborador->nome_colaborador}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-4">
                <label>Motivo da demissão:</label>
                <select class="form-control" type="text" name="motivo-demissao" id="motivo-demissao">
                  <option value="0">Selecione o motivo da demissão</option>
                  @foreach($motivos as $motivo)
                  <option value="{{$motivo->id_motivo_demissao}}">{{$motivo->motivo_demissao}}</option>
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
            <h4>Colaboradores Demitidos</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
          <table id="tabela-motivo-demissao" class="display" style="width:100%">
            <thead>
                <tr style="text-align: center;">
                    <th>Foto</th>
                    <th>Nome</th>
                    <th>Motivo da demissão</th>
                    <th>Data de demissão</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
               @foreach($tabela as $each)
                <tr style="text-align: center;">
                  <td style="width: 10%;"><img id="foto-click-{{$each->id_colaborador}}" 
                  src="/teste/storage/app/images/employees/{{$each->foto_colaborador}}" 
                  width="70px" height="70px" style="border-radius: 50%;"
                  >
                  <td>{{$each->nome_colaborador}}</td>
                  <td>{{$each->motivo_demissao}}</td>
                  <td>{{date('d/m/Y', strtotime($each->data_demissao))}}</td>
                  <td style="width: 30%;">
                      <a id="botao-editar-{{$each->id_colaborador}}"  class="btn btn-success" style="margin-left: 2px; margin-bottom: 2px;">Editar</a>
                      <a id="botao-cancelar-{{$each->id_colaborador}}" class="btn btn-danger"  style="margin-left: 2px; margin-bottom: 2px;">Cancelar</a>
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
        <form method="post" id="form-editar-demissao">
        @csrf
        <div class="row form-row-spacing">
          <div class="col-md-12">
            <label>Motivo da demissão:</label>
            <select class="form-control" type="text" name="motivo-demissao" id="motivo-demissao-editar">
              <option value="0">Selecione o motivo da demissão</option>
              @foreach($motivos as $motivo)
              <option value="{{$motivo->id_motivo_demissao}}">{{$motivo->motivo_demissao}}</option>
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
<script>
  $(document).ready(function(){
    $('#colaborador').selectize({ 
    placeholder: 'Selecione o colaborador'
  });

    //Cadastro
    $("#form-demissao").on('submit', function(e){
      e.preventDefault();
      var data = $("#form-demissao").serialize();

      if($("#motivo-demissao").val() == 0 || $("#colaborador").val() == '0'){
        if($("#motivo-demissao").val() == 0){
          $("#motivo-demissao").css('border-color','red');
        }else{
          $("#motivo-demissao").css('border-color','#ced4da');
        }

        if($("#colaborador").val() == 0){
          $(".selectize-input").css('border-color','red');
        }else{
          $(".selectize-input").css('border-color','#ced4da');
        }

        $('.error-alert-text').html('');
        $('.error-alert-text').html('Preencha os campos marcados em vermelho para continuar');
        $('#alert-modal-error').show();
      }
      else{
        $.ajax({
          url: "/teste/demissoes",
          type: 'post',
          data: data
          
        }).done(function(data){
          data = JSON.parse(data);
          console.log(data);
          $('.success-alert-text').html('');
          $('.success-alert-text').html(data['mensagem']);
          $("#redirect-alert").attr("href", "/teste/demissoes");
          $('#alert-ok').show();
        })
    }
  })
  //Cancelar
  
  $('#confirmar-cancelamento').on('click', function(e){
    e.preventDefault();
    var id = $('#id-cancel').val();
    $.ajax({
      url: '/teste/demissoes/cancelar/' + id,
      method: 'POST',
      data: {'id': id},
      success: function(data){
        data = JSON.parse(data);
        alert(data);
        window.location.reload();
      }
    });
  });


$("#form-editar-demissao").on('submit', function(e){
      e.preventDefault();
      var data = $("#form-editar-demissao").serialize();

      if($("#motivo-demissao-editar").val() == ''){
        $("#motivo-demissao-editar").css('border-color','red');
        $('.error-alert-text').html('');
        $('.error-alert-text').html('Preencha os campos marcados em vermelho para continuar');
        $('#alert-modal-error').show();
      }
      else{
        $.ajax({
          url: "/teste/demissoes/editar",
          type: 'post',
          data: data
          
        }).done(function(data){
          data = JSON.parse(data);
          $('.success-alert-text').html('');
          $('.success-alert-text').html(data['mensagem']);
          $("#redirect-alert").attr("href", "/teste/demissoes");
          $('#alert-ok').show();
        })
    }
  })
})
</script>
<script type="text/javascript">
    $('#tabela-motivo-demissao').DataTable({
      "drawCallback": function(){
          //ao clicar no botão excluir
          $('a[id^="botao-cancelar-"]').on('click', function(e){
            e.preventDefault();
            $('#alert-modal-cancel').show();
            $('#texto-cancelar').html('Tem certeza que deseja cancelar a demissão?');
            let id = this.id;
            id = id.slice(15);
            $('#id-cancel').val(id);
          });
          //ao clicar no botão editar
          $('a[id^="botao-editar-"]').on('click', function(e){
            e.preventDefault();
            let id = this.id;
            id = id.slice(13);
            $('#id-editar').val(id);
            $.ajax({
              url: '/teste/motivo-demissao/visualizar/' + id,
              method: 'POST',
              data: {'id': id}
            }).done(function(data){
              data = JSON.parse(data);
              console.log(data[0])
              $('#nome-motivo-demissao-editar').val(data[0].motivo_demissao);
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