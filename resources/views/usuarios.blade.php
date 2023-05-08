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
        <h1 class="h3 mb-0 text-gray-800 ">Usuários</h1>
    </div>
    <div class="row">
      <div class="card shadow col-md-12">
        <div class="card-header py-3">
          <h4>Cadastro de Usuários</h4>
        </div>
        <div class="card-body">  
          <form method="post" id="cadastro-usuario">
          @csrf
          <div class="row form-row-spacing">
            <div class="col-md-3">
              <label>Nome</label>
              <input type="text" class="form-control" name="nome" id="nome">
            </div>
            <div class="col-md-3">
              <label>E-mail de acesso</label>
              <input type="email" class="form-control" name="email" id="email">
            </div>
            <div class="col-md-3">
              <label>Telefone</label>
              <input type="tel" class="form-control" name="telefone" id="telefone">
            </div>
            <div class="col-md-3">
              <label>Nível de acesso</label>
              <select class="form-control" name="nivel-acesso" id="nivel-acesso">
                <option value="0">Escolha o nível de acesso</option>
                @foreach($perfis as $perfil)
                <option value="{{$perfil->id_perfil_usuario}}">{{$perfil->perfil_usuario}}</option>
                @endforeach
              </select>
            </div>
          </div>          
        </div>
        <div class="row">
          <div class="col-md-12" style="text-align: center; display: none" id="carregando-email">
            <img src="storage/app/images/loading/carregando-1.gif" width="170px">
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
            <span><h4>Usuários cadastrados</h4><a class="btn btn-primary" style="float: right;"
            href="/teste/usuarios-inativos">Ver usuários inativos</a></span>

        </div>
        <div class="card-body">
          <div class="table-responsive">
          <table id="tabela-" class="display" style="width:100%">
            <thead>
                <tr style="text-align: center;">
                    <th>Nome</th>
                    <th>E-mail de entrada</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
              @foreach($tabela as $each)
              <tr style="text-align: center;">
                  <td>{{$each->nome_usuario}}</td>
                  <td>{{$each->email_usuario}}</td>
                  <td style="width: 25%;">
                      <a id="botao-editar-{{$each->id_usuario}}"  class="btn btn-success" style="margin-left: 2px; margin-bottom: 2px;">Editar</a>
                      <a id="botao-desativar-{{$each->id_usuario}}" class="btn btn-danger" style="margin-left: 2px; margin-bottom: 2px;">Desativar</a>
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
        <form method="post" id="form-editar-usuario">
        @csrf
        <div class="row" style="padding-bottom: 10px;">
            <div class="col-md-3">
              <label>Nome</label>
              <input type="text" class="form-control" name="nome" id="nome-editar">
            </div>
            <div class="col-md-3">
              <label>E-mail de acesso</label>
              <input type="email" class="form-control" name="email" id="email-editar">
            </div>
            <div class="col-md-3">
              <label>Telefone</label>
              <input type="tel" class="form-control" name="telefone" id="telefone-editar">
            </div>
            <div class="col-md-3">
              <label>Nível de acesso</label>
              <select class="form-control" name="nivel-acesso" id="nivel-acesso-editar">
                <option value="0">Escolha o nível de acesso</option>
                @foreach($perfis as $perfil)
                <option value="{{$perfil->id_perfil_usuario}}">{{$perfil->perfil_usuario}}</option>
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
  $("#telefone").mask("(00) 00000-0000");
  $("#telefone-editar").mask("(00) 00000-0000");
  //Cadastro
  $("#cadastro-usuario").on('submit', function(e){
      e.preventDefault();

      if($('#nome').val() == '' || 
         $('#email').val() == '' ||
        ($('#telefone').val().length < 14 || $('#telefone').val().length > 15) ||
         $('nivel-acesso').val() == 0){
        
        if($('#nome').val() == ""){
          $('#nome').css('border-color', 'red');
        }else{
          $('#nome').css('border-color', '#ced4da');
        }

        if($('#email').val() == ""){
          $('#email').css('border-color', 'red');
        }else{
          $('#email').css('border-color', '#ced4da');
        }

        if($('#telefone').val().length < 14 || $('#telefone').val().length > 15){
          $('#telefone').css('border-color', 'red');
        }else{
          $('#telefone').css('border-color', '#ced4da');
        }

        if($('#nivel-acesso').val() == 0){
          $('#nivel-acesso').css('border-color', 'red');
        }else{
          $('#nivel-acesso').css('border-color', '#ced4da');
        }

        $('.error-alert-text').html('');
        $('.error-alert-text').html('Preencha os campos marcados em vermelho corretamente para continuar');
        $('#alert-modal-error').show();

      }else{
        $('#carregando-email').show();

        let data = $('#cadastro-usuario').serialize();

        $.ajax({
          url: '/teste/usuarios',
          method: 'post',
          data: data
        }).done(function(data){
          data = JSON.parse(data);
          console.log(data);
          $('#carregando-email').hide();
          if(data['flag'] == true){
            $('.success-alert-text').html('');
            $('.success-alert-text').html(data['mensagem']);
            $("#redirect-alert").attr("href", "/teste/usuarios");
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
  $("#form-editar-usuario").on('submit', function(e){
    e.preventDefault();
  

    if($('#nome-editar').val() == '' || 
       $('#email-editar').val() == '' ||
      ($('#telefone-editar').val().length < 14 || $('#telefone-editar').val().length > 15) ||
       $('nivel-acesso-editar').val() == 0){
      
      if($('#nome-editar').val() == ""){
        $('#nome-editar').css('border-color', 'red');
      }else{
        $('#nome-editar').css('border-color', '#ced4da');
      }

      if($('#email-editar').val() == ""){
        $('#email-editar').css('border-color', 'red');
      }else{
        $('#email-editar').css('border-color', '#ced4da');
      }

      if($('#telefone-editar').val().length < 14 || $('#telefone').val().length > 15){
        $('#telefone-editar').css('border-color', 'red');
      }else{
        $('#telefone-editar').css('border-color', '#ced4da');
      }

      if($('#nivel-acesso-editar').val() == 0){
        $('#nivel-acesso-editar').css('border-color', 'red');
      }else{
        $('#nivel-acesso-editar').css('border-color', '#ced4da');
      }

      $('.error-alert-text').html('');
      $('.error-alert-text').html('Preencha os campos marcados em vermelho corretamente para continuar');
      $('#alert-modal-error').show();

    }else{
      let data =  $("#form-editar-usuario").serialize();
      
      console.log(data);
      $.ajax({
        url: '/teste/usuarios/editar',
        method: 'post',
        data: data
      }).done(function(data){
        data = JSON.parse(data);
        console.log(data);
        $('.success-alert-text').html('');
        $('.success-alert-text').html(data['mensagem']);
        $("#redirect-alert").attr("href", "/teste/usuarios");
        $('#alert-ok').show();
      })
    }
    
  });
  
  //Exclusão
  $('#confirmar-desativacao').on('click', function(e){
    e.preventDefault();
    var id = $('#id-desativar').val();
    $.ajax({
      url: '/teste/usuarios/desativar/' + id,
      method: 'POST',
      data: {'id': id},
      success: function(data){
        data = JSON.parse(data);
        alert(data);
        window.location.reload();
      }
    });
  });
})
</script>

<script type="text/javascript">
    $('#tabela-').DataTable({
      "drawCallback":function(){

      //ao clicar em excluir
      $('a[id^="botao-desativar-"]').on('click', function(e){
        e.preventDefault();
        $('#disable-text').html('');
        $('#disable-text').html('Ao desativar o usuário ficará impossibilitado de acessar o sistema. Deseja confirmar a desativação?');

        $('#alert-modal-desativar').show();
        let id = this.id;
        id = id.slice(16);
        $('#id-desativar').val(id);
      });

      //ao clicar em editar
      $('a[id^="botao-editar-"]').on('click', function(e){
        e.preventDefault();
        let id = this.id;
        id = id.slice(13);
        $('#id-editar').val(id);
        $.ajax({
          url: '/teste/usuarios/visualizar/' + id,
          method: 'POST',
          data: {'id': id}
        }).done(function(data){
          data = JSON.parse(data);
          console.log(data[0])
          $('#nome-editar').val(data[0].nome_usuario);
          $('#email-editar').val(data[0].email_usuario);
          $('#telefone-editar').val(data[0].numero_tel_usuario);
          $('#nivel-acesso-editar').val(data[0].id_perfil_usuario);
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