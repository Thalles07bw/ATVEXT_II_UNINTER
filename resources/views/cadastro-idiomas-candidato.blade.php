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
          <h4>Idiomas</h4>
        </div>
        <div class="card-body">
          <form id="cadastro-idioma" method="POST">
            @csrf  
            <div class="row">
              <div class="col-md-4">
                <label>Idioma</label>
                <select id="idioma" name="idioma" class="form-control">
                  <option value="0">Selecione o Idioma</option>
                  @foreach($idiomas_cadastrados as $each)
                  <option value="{{$each->id_idioma}}">{{$each->idioma}}</option>
                  @endforeach
                </select>
              </div>             
            </div>
            <br>
            <div class="row" id="selecao-nivel" style="display: none;">
              <div class="col-md-4">
                <label>Defina o nível</label>
                <div style="padding-top: 7px">
                <input id="nivel" name="nivel" style="width: 210px; height: 10px"  list="tickmarks" type="range" min="1" max="6" step="1" value="1">
                <datalist id="tickmarks">
                  <option value="1">
                  <option value="2">
                  <option value="3">
                  <option value="4">
                  <option value="5">
                  <option value="6">
                </datalist>
              </div>
              </div>
            </div>
        </div>
        <div class="card-footer">
          <input class="btn btn-primary" type="submit" value="Adicionar">
        </form>
        </div>
      </div>
    </div>
    <br>
    <div class="row">
      <div class="card shadow col-md-12">
        <div class="card-header py-3">
            <h4>Idiomas Cadastrados</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table id="tabela-idiomas" class="display" style="width:100%">
              <thead>
                  <tr style="text-align: center;">
                    <th>Idioma</th>
                    <th>Nível</th>
                    <th>Ações</th>
                  </tr>
              </thead>
              <tbody>
                @foreach($idiomas_candidato as $each) 
                  <tr style="text-align: center;">
                    <td>{{$each->idioma}}</td>
                    <td><input id="nivel-tabela-{{$each->id_idioma_candidato}}" name="nivel" style="width: 210px; height: 10px"  
                    list="tickmarks" type="range" min="1" max="6" step="1" value="{{$each->nivel_idioma_candidato}}">
                      <datalist id="tickmarks">
                        <option value="1">
                        <option value="2">
                        <option value="3">
                        <option value="4">
                        <option value="5">
                        <option value="6">
                      </datalist></td>
                    <td style="width: 25%;">
                        <a id="botao-salvar-{{$each->id_idioma_candidato}}"  class="btn btn-success" style="margin-left: 2px; margin-bottom: 2px; display: none">Salvar</a>
                        <a id="botao-excluir-{{$each->id_idioma_candidato}}" href="/idiomas/deletar/" class="btn btn-danger" style="margin-left: 2px; margin-bottom: 2px;">Excluir</a>
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
@include('partials.footer-candidato')

<script type="text/javascript">

$(document).ready(function() {
  //Mostra campo de alterar nivel ao selecionar idioma
  $("#idioma").on('change', function(){
    if($("#idioma").val() == 0){
      $('#selecao-nivel').hide();
    }
    else{
      $('#selecao-nivel').show();
    }
  });
  $('input[id^="nivel-tabela-"]').on('change', function(){
      let id = this.id;
      id = id.slice(13);
      let botao = "#botao-salvar-"+id;
      $(botao).show();
  })
  //Cadastro
  $('#cadastro-idioma').on('submit', function(e){  
    e.preventDefault();
    var data = $('#cadastro-idioma').serialize();

    if($('#idioma').val() == 0 ) {

      if($('#idioma').val() == 0){
        $('#idioma').css('border-color', 'red');
      }else{
        $('#idioma').css('border-color', '#ced4da');
      }

      $('.error-alert-text').html('');
      $('.error-alert-text').html('Preencha os campos marcados em vermelho corretamente para continuar');
      $('#alert-modal-error').show();

    }else{
      $.ajax({
        url: '/idiomas',
        type: 'POST',
        data: data
      }).done(function(data){
        data = JSON.parse(data);

        if(data['flag'] == true){
          $('.success-alert-text').html('');
          $('.success-alert-text').html(data['mensagem']);
          $("#redirect-alert").attr("href", "/idiomas");
          $('#alert-ok').show();
        }else{
          $('.error-alert-text').html('');
          console.log(data['mensagem'])
          $('.error-alert-text').html(data['mensagem']);
          $('#alert-modal-error').show();
        }

      });
    }
  });
  //Exclusão
  $('#confirmar-exclusao').on('click', function(e){
  e.preventDefault();
  var id = $('#id-delete').val();
  $.ajax({
    url: '/idiomas/deletar/' + id,
    method: 'POST',
    data: {'id': id},
    success: function(data){
        data = JSON.parse(data);
        alert(data);
        window.location.reload();
      }
    });
  });
  $('#tabela-idiomas').DataTable({
    "drawCallback": function(){
      $('a[id^="botao-excluir-"]').on('click', function(e){
        e.preventDefault();
        $('#alert-modal-delete').show();
        let id = this.id;
        id = id.slice(14);
        $('#id-delete').val(id);
      });
     //Ao clicar no botão salvar
     $('a[id^="botao-salvar-"]').on('click', function(e){
      e.preventDefault();
        let id = this.id;
        id = id.slice(13);
        let nivel = $("#nivel-tabela-"+id).val();
        let botao = "#botao-salvar-"+id;
        $(botao).hide();
  
        $.ajax({
          url:"/salvar-alteracoes-idioma",
          method: "post",
          data: {'id_idioma_candidato': id, 'nivel_idioma_candidato': nivel}
        }).done(function(data){
          var data = JSON.parse(data);

          if(data['flag'] == true){
          $('.success-alert-text').html('');
          $('.success-alert-text').html(data['mensagem']);
          $("#redirect-alert").attr("onclick", "$('#alert-ok').hide()");
          $('#alert-ok').show();
          }else{
            $('.error-alert-text').html('');
            console.log(data['mensagem'])
            $('.error-alert-text').html(data['mensagem']);
            $('#alert-modal-error').show();
          }
        });
     })
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
})

</script>

