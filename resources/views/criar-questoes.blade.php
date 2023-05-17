@include('partials.header-second-layer')
<!--Alerts-->
@include('alerts.alert-anula')
@include('alerts.alert-success')
@include('alerts.alert-modal-error')
<body>
  <!-- Begin Page Content -->
  <div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 ">{{$nome_prova}}</h1>
        
    </div>
    <div class="row">
      <div class="card shadow col-md-12">
        <div class="card-header py-3">
          <h4>Cadastro de perguntas</h4>
        </div>
        <div class="card-body">
          <form id="cadastro-perguntas" method="POST">
            @csrf
            <input type="text" hidden value="{{$id_prova}}" id="id-prova">
            @if($tipo_tempo_prova == 2)
            <div class="row">
              <div class="col-md-4">
                <input min="0" id="duracao" name="duracao" class="form-control" step="0.5" type="number" placeholder="Tempo de duração (Em minutos)">
              </div> 
            </div>
            <br>
            @endif
            <div class="row">
              <div class="col-md-12">
                <label>Enunciado da questão:</label>
                <textarea cols='2' class="form-control textarea" type="text" id="enunciado-questao" name="enunciado-questao" placeholder="Enunciado da Questão"></textarea>
              </div>
          </div>
          <br>
          <div class="row">
              <div class="col-md-10">
                <label>Alternativa 1:</label>
                <input class="form-control" type="text" id="alternativa-1" name="alternativa-1">
              </div>
              <div class="col-md-1">
                <label>Correta?</label>
                <select class="form-control" id="correta-1"  name="correta-1">
                  <option value="0">Não</option>
                  <option value="1">Sim</option>
                </select>
              </div>
          </div>
          <br>
          <div class="row">
            <div class="col-md-10">
              <label>Alternativa 2:</label>
              <input class="form-control" type="text" id="alternativa-2" name="alternativa-2">
            </div>
            <div class="col-md-1">
              <label>Correta?</label>
              <select class="form-control" id="correta-2" name="correta-2">
                <option value="0">Não</option>
                <option value="1">Sim</option>
              </select>
            </div>
          </div>
          <br>
          <div class="row">
            <button class="btn btn-primary" id="adicionar-3">+</button>
          </div>
          <div class="row linha-alt-3" style="display: none;">
            <div class="col-md-10">
              <label>Alternativa 3:</label>
              <input class="form-control" type="text" id="alternativa-3" name="alternativa-3">
            </div>
            <div class="col-md-1">
              <label>Correta?</label>
              <select class="form-control" id="correta-3" name="correta-3">
                <option value="0">Não</option>
                <option value="1">Sim</option>
              </select>
            </div>
          </div>
          <br class="linha-alt-3" style="display: none;">
          <div class="row linha-alt-3"  style="display: none;">
            <button class="btn btn-primary" id="adicionar-4" style="margin-right: 5px;">+</button>
            <button class="btn btn-danger" id="remover-3">-</button>
          </div>
        
          <div class="row linha-alt-4"  style="display: none;">
            <div class="col-md-10">
              <label>Alternativa 4:</label>
              <input class="form-control" type="text" id="alternativa-4" name="alternativa-4">
            </div>
            <div class="col-md-1">
              <label>Correta?</label>
              <select class="form-control" id="correta-4" name="correta-4">
                <option value="0">Não</option>
                <option value="1">Sim</option>
              </select>
            </div>
          </div>
          <br class="linha-alt-4" style="display: none;">
          <div class="row linha-alt-4" style="display: none;">
            <button class="btn btn-primary" id ="adicionar-5" style="margin-right: 5px;">+</button>
            <button class="btn btn-danger" id="remover-4">-</button>
          </div>
          <div class="row linha-alt-5" style="display: none;">
            <div class="col-md-10">
              <label>Alternativa 5:</label>
              <input class="form-control" type="text" id="alternativa-5" name="alternativa-5">
            </div>
            <div class="col-md-1">
              <label>Correta?</label>
              <select class="form-control" id="correta-5" name="correta-5">
                <option value="0">Não</option>
                <option value="1">Sim</option>
              </select>
            </div>
          </div>
          <br class="linha-alt-5" style="display: none;">
          <div class="row linha-alt-5"  style="display: none;">
            <button class="btn btn-danger" id="remover-5">-</button>
          </div>
          <br class="linha-alt-5" style="display: none;">
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
            <h4>Questões Cadastradas</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
          <table id="tabela-questoes" class="display stripe" style="width:100%">
              <thead>
                <tr style="text-align: center;">
                    <th>Pergunta</th>
                    <th>Ações</th>
                </tr>
              </thead>
              <tbody>
              @foreach($tabela as $each)
                <tr >
                    <td style="text-align: left;">  {!!$each->pergunta_prova !!} </td>
                    <td style="width: 38%; text-align: center;"> 
                      <a id="botao-ver-{{$each->id_pergunta_prova}}" href="/cadastrar-questao/ver-alternativas/" class="btn btn-primary" style="margin-left: 2px; margin-bottom: 2px;">Ver alternativas</a>        
                      <a id="botao-anular-{{$each->id_pergunta_prova}}" href="/cadastrar-questao/anular/" class="btn btn-danger" style="margin-left: 2px; margin-bottom: 2px;">Anular</a>
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
      <table id="tb-alternativas" class="table table-striped">
      <thead>
        <tr style="text-align: center;">
            <th>Alternativa</th>
            <th>É a correta?</th>
        </tr>
      </thead>
      <tbody>

      </tbody>
      </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>
@include('partials.footer-second-layer')
<script type="text/javascript">
  $('#correta-1').on('change', function(){
    if($('#correta-1').val() === '1'){
      $('#correta-2').val(0)
      $('#correta-3').val(0)
      $('#correta-4').val(0)
      $('#correta-5').val(0)
    }
  });
  $('#correta-2').on('change', function(){
    if($('#correta-2').val() === '1'){
      $('#correta-1').val(0)
      $('#correta-3').val(0)
      $('#correta-4').val(0)
      $('#correta-5').val(0)
    }
  });
  $('#correta-3').on('change', function(){
    if($('#correta-3').val() === '1'){
      $('#correta-2').val(0)
      $('#correta-1').val(0)
      $('#correta-4').val(0)
      $('#correta-5').val(0)
    }
  });
  $('#correta-4').on('change', function(){
    if($('#correta-4').val() === '1'){
      $('#correta-2').val(0)
      $('#correta-3').val(0)
      $('#correta-1').val(0)
      $('#correta-5').val(0)
    }
  });
  $('#correta-5').on('change', function(){
    if($('#correta-5').val() === '1'){
      $('#correta-2').val(0)
      $('#correta-3').val(0)
      $('#correta-4').val(0)
      $('#correta-1').val(0)
    }
  });
</script>
<script type="text/javascript">
  /*Cadastro das perguntas*/
  $('#cadastro-perguntas').on('submit', function(e){
    e.preventDefault();
    var data = $('#cadastro-perguntas').serialize();
    if($('#duracao').val() === '' || $('#enuciado-questao').val() == '' || 
      $('#alternativa-1').val() == '' || $('#alternativa-2').val() == '' ||
      ($('#correta-1').val() == 0 && $('#correta-2').val() == 0 && $('#correta-3').val() == 0
      && $('#correta-4').val() == 0 && $('#correta-5').val() == 0)){

        if($('#duracao').val() == ''){
          $('#duracao').css('border-color', 'red');
        }else{
          $('#duracao').css('border-color', '#ced4da');
        }

        if($('#enunciado-questao').val() == ''){
          $('#enunciado-questao').css('border-color', 'red');
        }else{
          $('#enunciado-questao').css('border-color', '#ced4da');
        }

        if($('#alternativa-1').val() == ''){
          $('#alternativa-1').css('border-color', 'red');
        }else{
          $('#alternativa-1').css('border-color', '#ced4da');
        }

        if($('#alternativa-2').val() == ''){
          $('#alternativa-2').css('border-color', 'red');
        }else{
          $('#alternativa-2').css('border-color', '#ced4da');
        }

        if($("#alternativa-3").is(":visible") && $("#alternativa-3").val() == ''){
          $('#alternativa-3').css('border-color','red')
        }else{
          $('#alternativa-3').css('border-color', '#ced4da');
        }

        if($("#alternativa-4").is(":visible") && $("#alternativa-4").val() == ''){
          $('#alternativa-4').css('border-color','red')
        }else{
          $('#alternativa-4').css('border-color', '#ced4da');
        }

        if($("#alternativa-5").is(":visible") && $("#alternativa-5").val() == ''){
          $('#alternativa-5').css('border-color','red')
        }else{
          $('#alternativa-5').css('border-color', '#ced4da');
        }
        if($('#correta-1').val() == 0 && $('#correta-2').val() == 0 && $('#correta-3').val() == 0
        && $('#correta-4').val() == 0 && $('#correta-5').val() == 0){
          $('select[id^="correta-"]').css('border-color', 'red');
        }else{
          $('select[id^="correta-"]').css('border-color', '#ced4da');
        }
        
        $('.error-alert-text').html('');
        $('.error-alert-text').html('Preencha ou altere os campos marcados em vermelho para continuar...' );
        $('#alert-modal-error').show();

    }else{
      var id = $('#id-prova').val();
      var data = $('#cadastro-perguntas').serialize();
      console.log(data);
      $.ajax({
        url: '/cadastrar-questoes/'+ id,
        type: 'post',
        data: data
      }).done(function (data){
       data = JSON.parse(data);
       console.log(data);
        $('.success-alert-text').html('');
          $('.success-alert-text').html(data['mensagem']);
          $("#redirect-alert").attr("href", "/cadastrar-questoes/" + id);
          $('#alert-ok').show();
      });
    }
  })

  /*Anulação das perguntas */
  $('#confirmar-anulacao').on('click', function(e){
      e.preventDefault();
      var id = $('#id-anular').val();
      $.ajax({
        url: '/cadastrar-questoes/anular/' + id,
        method: 'POST',
        data: {'id': id},
        success: function(data){
          data = JSON.parse(data);
          alert(data);
          window.location.reload();
        }
      });
    });

      //Visualização de alternativas
      $('a[id^="botao-ver-"]').on('click', function(e){
      e.preventDefault();
      let id = this.id;
      id = id.slice(10);
   
      $.ajax({
        url: '/cadastrar-questoes/ver-alternativas/' + id,
        method: 'POST',
        data: {'id': id}
      }).done(function(data){
        data = JSON.parse(data);
        console.log(data)
        $('#tb-alternativas tbody').empty();
        data.forEach(function(currentValue){
          if(currentValue.resposta_correta == 1){
            var resp = 'Sim';
          }else{
            var resp = 'Não';
          }
          
          let row = '<tr><td>'+ currentValue.resposta_prova +'</td><td style="text-align: center;">'+ resp + '</td></tr>';
          $('#tb-alternativas tbody').append(row);
        })

        $('#visualizar').modal('show');
      })
    });

</script>
<script type="text/javascript">
    //Tabela de controle de provas
    $('#tabela-questoes').DataTable({
      "drawCallback": function(){
        //Ao clicar no botão excluir
        $('a[id^="botao-anular-"]').on('click', function(e){
          e.preventDefault();
          $('#alert-modal-anula').show();
          let id = this.id;
          id = id.slice(13);
          $('#id-anular').val(id);
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
<script type="text/javascript">
  $("#adicionar-3").on('click', function(e){
    e.preventDefault();
    $("#adicionar-3").hide();
    $(".linha-alt-3").show();
  })
  $("#adicionar-4").on('click', function(e){
    e.preventDefault();
    $("#adicionar-4").hide();
    $("#remover-3").hide();
    $(".linha-alt-4").show();
  })
  $("#adicionar-5").on('click', function(e){
    e.preventDefault();
    $("#adicionar-5").hide();
    $("#remover-4").hide();
    $(".linha-alt-5").show();
  })
  $('#remover-5').on('click', function(e){
    e.preventDefault();
    $(".linha-alt-5").hide();
    $("#adicionar-5").show();
    $("#remover-4").show();
    $("#alternativa-5").val("");
  })
  $('#remover-4').on('click', function(e){
    e.preventDefault();
    $(".linha-alt-4").hide();
    $("#adicionar-4").show();
    $("#remover-3").show();
    $("#alternativa-4").val("");
  })
  $('#remover-3').on('click', function(e){
    e.preventDefault();
    $(".linha-alt-3").hide();
    $("#adicionar-3").show();
    $("#alternativa-3").val("");
  })

</script>