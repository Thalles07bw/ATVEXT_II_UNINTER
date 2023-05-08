@include('partials.header')
<!--Alerts-->
@include('alerts.alert-desativar')
@include('alerts.alert-success')
@include('alerts.alert-modal-error')
<body>
  <!-- Begin Page Content -->
  <div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 ">Criação de Avaliações</h1>
    </div>
    <div class="row">
      <div class="card shadow col-md-12">
        <div class="card-header py-3">
          <h4>Cadastro de nova avaliação</h4>
        </div>
        <div class="card-body">
          <form id="cadastro-avaliacao" method="POST">
            @csrf
            <div class="row">
              <div class="col-md-6">
                <input class="form-control" type="text" id="nome-prova" name="nome-prova" placeholder="Nome da Avaliação">
              </div>
              <div class="col-md-6">
                <select class="form-control" id="nivel-prova" name="nivel-prova">
                  <option value="0">Selecione o nível da avaliação</option>
                  @foreach($niveis_avaliacao as $each)
                    <option value="{{$each->id_nivel_prova}}">{{$each->nivel_prova}}</option>
                  @endforeach
                </select> 
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-md-6">
                <select class="form-control" id="categoria-prova" name="categoria-prova">
                  <option value="0">Selecione a categoria da avaliação</option>
                  @foreach($categorias_avaliacao as $each)
                    <option value="{{$each->id_categoria_prova}}">{{$each->categoria_prova}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-6">
                <select class="form-control" id="tempo-prova" name="tempo-prova">
                  <option value="0">Selecione o tipo de tempo da avaliação</option>
                  @foreach($tipo_tempo as $each)
                    <option value="{{$each->id_tipo_tempo_prova}}">{{$each->tipo_tempo_prova}}</option>
                  @endforeach
                </select>
              </div> 
            </div>
            <br>
            <div class="row">
              <div class="col-md-4">
                <input style="display: none;" min="0" id="duracao" name="duracao" class="form-control" step="0.5" type="number" placeholder="Tempo de duração (Em minutos)">
              </div> 
            </div>
        </div>
        <div class="card-footer">
            <input class="btn btn-primary" type="submit" value="Cadastrar">
          </div>
        </form>
      </div>
    </div>
    <br>
    <div class="row">
      <div class="card shadow col-md-12">
        <div class="card-header py-3">
            <h4>Avaliações Cadastradas</h4>
            <a class="btn btn-primary" href="/teste/cadastrar-avaliacao/desativadas" style="float:right;">Ver inativas</a>
        </div>
        <div class="card-body">
          <div class="table-responsive">
          <table id="tabela-avaliacoes" class="display" style="width:100%">
              <thead>
                <tr style="text-align: center;">
                    <th>Nome</th>
                    <th>Nível</th>
                    <th>Data de criação</th>
                    <th>Contagem de tempo</th>
                    <th>Ações</th>
                </tr>
              </thead>
              <tbody>
                @foreach($tabela as $each)
                <tr style="text-align: center;">
                    <td> {{$each->nome_prova}} </td>
                    <td> {{$each->nivel_prova}} </td>
                    <td> {{$each->data_criacao}} </td>
                    <td>{{$each->tipo_tempo_prova}}</td>
                    <td style="width: 50%;">
                        <a id="botao-copia-{{$each->id_prova}}" href="/teste/cadastrar-avaliacao/criar-copia/" class="btn btn-primary" style="margin-bottom: 2px;"> Cria Cópia</a>
                        <a id="botao-editar-{{$each->id_prova}}" href="/teste/cadastrar-avaliacao/editar/" class="btn btn-dark" style="margin-left: 2px; margin-bottom: 2px;">Editar</a>
                        <a id="botao-questoes-{{$each->id_prova}}" href="/teste/cadastrar-questoes/{{$each->id_prova}}" class="btn btn-success" style="margin-left: 2px; margin-bottom: 2px;">Cadastrar Questões</a>  
                        <a id="botao-desativar-{{$each->id_prova}}" href="/teste/cadastrar-avaliacao/desativar/{{$each->id_prova}}" class="btn btn-danger" style="margin-left: 2px; margin-bottom: 2px;">Desativar</a>                    
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
        <form id="atualizar-prova" method="post">
          @csrf
          <input name="id-editar" id="id-editar" hidden>
          <div class="row">
            <div class="col-md-9" style="padding-bottom: 10px;">
              <input class="form-control" id="renomear" name="renomear" placeholder="Nome da avaliação">
            </div>
          <div class="col-md-3">
            <select class="form-control" id="nivel-prova-editar" name="nivel-prova-editar">
              <option value="0">Selecione o nível da avaliação</option>
              @foreach($niveis_avaliacao as $each)
                <option value="{{$each->id_nivel_prova}}">{{$each->nivel_prova}}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-primary" value="Salvar">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </form>
      </div>
    </div>
  </div>
</div>
@include('partials.footer')
<script type="text/javascript" charset="UTF-8">
  $('#tempo-prova').on('change', function(){
    if($('#tempo-prova').val() == 1){
      $('#duracao').show();
    }else{
      $('#duracao').hide();
    }
  })
  //Inserção
  $('#cadastro-avaliacao').on('submit', function(e){
    e.preventDefault();
    var data = $('#cadastro-avaliacao').serialize();
    if($('#nome-prova').val() == '' || $('#nivel-prova').val() == 0 || 
      $('#categoria-prova').val() == 0 || $('#tempo-prova').val() == 0 ||
      ($('#tempo-prova').val() == 1 && $('#duracao').val() == '')){
        if($('#nome-prova').val() == ''){
          $('#nome-prova').css('border-color', 'red');
        }else{
          $('#nome-prova').css('border-color', '#ced4da');
        }

        if($('#nivel-prova').val() == 0){
          $('#nivel-prova').css('border-color', 'red');
        }else{
          $('#nivel-prova').css('border-color', '#ced4da');
        }

        if($('#categoria-prova').val() == 0){
          $('#categoria-prova').css('border-color', 'red');
        }else{
          $('#categoria-prova').css('border-color', '#ced4da');
        }

        if($('#tempo-prova').val() == 0){
          $('#tempo-prova').css('border-color', 'red');
        }else{
          $('#tempo-prova').css('border-color', '#ced4da');
        }

        if($('#tempo-prova').val() == 1 && $('#duracao').val() == ''){
          $('#duracao').css('border-color', 'red');
        }else{
          $('#duracao').css('border-color', '#ced4da');
        }

        $('.error-alert-text').html('');
        $('.error-alert-text').html('Preencha os campos marcados em vermelho para continuar');
        $('#alert-modal-error').show();

    }else{
      $.ajax({
        url: '/teste/cadastrar-avaliacao',
        type: 'POST',
        data: data
      }).done(function (data){
       data = JSON.parse(data);
       console.log(data);
       $('.success-alert-text').html('');
          $('.success-alert-text').html(data['mensagem']);
          $("#redirect-alert").attr("href", "/teste/cadastrar-avaliacao");
          $('#alert-ok').show();
      });
    }
  });
  //Cópia
  $('a[id^="botao-copia-"]').on('click', function(e){
    e.preventDefault();
    let id = this.id;
    id = id.slice(12);
    $.ajax({
      url: '/teste/cadastrar-avaliacao/copia/' + id,
      type: 'POST',
      data: {'id': id}
    }).done(function (data){
    data = JSON.parse(data);
    console.log(data);
    $('.success-alert-text').html('');
      $('.success-alert-text').html(data);
      $("#redirect-alert").attr("href", "/teste/cadastrar-avaliacao");
      $('#alert-ok').show();
    });
  });

  //Desativação
  $("#confirmar-desativacao").on('click', function(e){
    e.preventDefault();
    var id = $("#id-desativar").val();
    console.log(id);
    $.ajax({
      url: '/teste/cadastrar-avaliacao/desativar/' + id,
      type: 'POST',
      data: {'id': id}
    }).done(function (data){
        data = JSON.parse(data);
        alert(data.mensagem);
        window.location.reload();
    });
  });
  //Editar
  $("#atualizar-prova").on('submit', function(e){

    e.preventDefault();
    if($('#renomear').val() == '' || $('#nivel-prova-editar').val() == 0) {
      if($('#renomear').val() == ''){
        $('#renomear').css('border-color', 'red');
      }else{
        $('#nome-prova').css('border-color', '#ced4da');
      }

      if($('#nivel-prova-editar').val() == 0){
        $('#nivel-prova-editar').css('border-color', 'red');
      }else{
        $('#nivel-prova-editar').css('border-color', '#ced4da');
      }
    }else{
      var data = $('#atualizar-prova').serialize();
      console.log(data);
      $.ajax({
        url:"/teste/cadastrar-avaliacao/editar",
        type: 'POST',
        data: data
      }).done(function(data){
        data = JSON.parse(data);
        console.log(data);
        $('.success-alert-text').html('');
        $('.success-alert-text').html(data.mensagem);
        $("#redirect-alert").attr("href", "/teste/cadastrar-avaliacao");
        $('#alert-ok').show();
      })
    }
  });

</script>
<script type="text/javascript">
    //Tabela de controle de provas
    $('#tabela-avaliacoes').DataTable({
      "drawCallback": function(){
        //Ao clicar no botão desativar
        $('a[id^="botao-desativar-"]').on('click', function(e){
          e.preventDefault();
          $('#alert-modal-desativar').show();
          let id = this.id;
          id = id.slice(16);
          $('#id-desativar').val(id);
        });
        //Ao clicar no botão editar
        $('a[id^="botao-editar-"]').on('click', function(e){
            e.preventDefault();
            let id = this.id;
            id = id.slice(13);
            $('#id-editar').val(id);
            $.ajax({
              url: '/teste/cadastrar-avaliacao/visualizar/' + id,
              method: 'POST',
              data: {'id': id}
            }).done(function(data){
              data = JSON.parse(data);
              console.log(data[0])
              $('#renomear').val(data[0].nome_prova);
              $('#nivel-prova-editar').val(data[0].id_nivel_prova);
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