@include('partials.header')
  <!--Alerts-->
  @include('alerts.alert-modal-delete')
  @include('alerts.alert-success')
  @include('alerts.alert-modal-error')
  @include('alerts.alert-modal-gerenciar')
<body>
  <!-- Begin Page Content -->
  <div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 ">Empresas</h1>
    </div>
    <div class="row">
      <div class="card shadow col-md-12">
        <div class="card-header py-3">
          <h4>Cadastro de nova empresa</h4>
        </div>
        <div class="card-body">
          <form id="cadastro-empresa">  
          @csrf
          <div class="row form-row-spacing">
            <div class="col-md-4">
              <label>Nome Fantasia</label>
              <input class="form-control" id="fantasia" name="fantasia">
            </div>
            <div class="col-md-4">
              <label>CNPJ</label>
              <input class="form-control" id="cnpj" name="cnpj">
            </div>
            <div class="col-md-4">
              <label>Razão Social</label>
              <input class="form-control" id="razao-social" name="razao-social">
            </div>
          </div> 
          <div class="row form-row-spacing">
            <div class="col-md-4">
                <label>Telefone</label>
                <input class="form-control" id="telefone" name="telefone">
            </div>
            <div class="col-md-4">
              <label>Tamanho da Empresa</label>
              <select class="form-control" id="tamanho" name="tamanho">
                <option value="0">Selecione o tamanho da empresa</option>
                @foreach($tamanho_empresa as $each)
                <option value="{{$each->id_tamanho_empresa}}">{{$each->tamanho_empresa}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row form-row-spacing"> 
            <div class="col-md-5">
                <label>Digite seu CEP para busca automática do endereço</label>
                <input class="form-control" id="num-cep" name="num-cep" maxlength="9">
                <input id="cep-erro" value="1" hidden>   
                <span><a href="https://buscacepinter.correios.com.br/app/endereco/index.php"> Não sei meu CEP</a></span> 
            </div>                     
            <div class="col-md-6">
              <label>Rua:</label>
              <input class="form-control" id="logradouro"  name="logradouro" readonly="true">    
            </div>
            <div class="col-md-1">
              <label>Número:</label>
              <input class="form-control" id="numero-endereco" name="numero-endereco">    
            </div>
          </div>
          <div class="row form-row-spacing">
            <div class="col-md-4">
              <label>Bairro:</label>
              <input class="form-control" id="bairro" name="bairro" readonly="true">    
            </div>
            <div class="col-md-5">
              <label>Cidade:</label>
              <input class="form-control" id="cidade" name="cidade" readonly="true">    
            </div>
            <div class="col-md-1">
              <label>Estado:</label>
              <input class="form-control" id="estado" name="estado" readonly="true">    
            </div>
            <div class="col-md-2">
              <label>País:</label>
              <select class="form-control" name="pais" id="pais" readonly="true">
                <option value="1">Brasil</option>
              </select>
            </div>
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
            <h4>Empresas cadastradas</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
          <table id="tabela-empresas" class="display" style="width:100%">
            <thead>
                <tr style="text-align: center;">
                    <th>Nome Fantasia</th>
                    <th>Gerenciada desde</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
              @foreach($empresas_gerenciadas as $empresa)
              <tr style="text-align: center;">
                <td>{{$empresa->razao_social_empresa_contratante}}</td>
                <td>{{date("d/m/Y",strtotime($empresa->data_criacao))}}</td>
                <td style="width: 40%;">
                  @if($empresa->id_empresa_contratante == $_SESSION['empresa_usuario'])
                  <a id="botao-gerenciar-{{$empresa->id_empresa_contratante}}" class="btn btn-primary" style="margin-left: 2px; margin-bottom: 2px; display: none">Gerenciar</a>
                  @else
                  <a id="botao-gerenciar-{{$empresa->id_empresa_contratante}}" class="btn btn-primary" style="margin-left: 2px; margin-bottom: 2px;">Gerenciar</a>
                  @endif
                  <a id="botao-editar-{{$empresa->id_empresa_contratante}}"  class="btn btn-success" style="margin-left: 2px; margin-bottom: 2px;">Editar</a>
                  <a id="botao-excluir-{{$empresa->id_empresa_contratante}}" class="btn btn-danger" style="margin-left: 2px; margin-bottom: 2px;">Encerrar Gerenciamento</a>
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
        <form method="post" id="form-editar-empresa">
        @csrf
        <div class="row form-row-spacing">
          <div class="col-md-4">
            <label>Nome Fantasia</label>
            <input class="form-control" id="fantasia-editar" name="fantasia">
          </div>
          <div class="col-md-4">
            <label>CNPJ</label>
            <input class="form-control" id="cnpj-editar" name="cnpj">
          </div>
          <div class="col-md-4">
            <label>Razão Social</label>
            <input class="form-control" id="razao-social-editar" name="razao-social">
          </div>
        </div> 
        <div class="row form-row-spacing" style="padding-bottom: 10px">
          <div class="col-md-4">
              <label>Telefone</label>
              <input class="form-control" id="telefone-editar" name="telefone">
          </div>
          <div class="col-md-4">
            <label>Tamanho da Empresa</label>
            <select class="form-control" id="tamanho-editar" name="tamanho">
              <option value="0">Selecione o tamanho da empresa</option>
              @foreach($tamanho_empresa as $each)
              <option value="{{$each->id_tamanho_empresa}}">{{$each->tamanho_empresa}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="row form-row-spacing"> 
          <div class="col-md-5">
              <label>Digite seu CEP para busca automática do endereço</label>
              <input class="form-control" id="num-cep-editar" name="num-cep" maxlength="9">
              <input id="cep-erro-editar" value="1" hidden>   
              <span><a href="https://buscacepinter.correios.com.br/app/endereco/index.php"> Não sei meu CEP</a></span> 
          </div>                     
          <div class="col-md-6">
            <label>Rua:</label>
            <input class="form-control" id="logradouro-editar"  name="logradouro" readonly="true">    
          </div>
          <div class="col-md-1">
            <label>Número:</label>
            <input class="form-control" id="numero-endereco-editar" name="numero-endereco">    
          </div>
        </div>
        <br>
        <div class="row form-row-spacing" style="padding-bottom: 10px;">
          <div class="col-md-4">
            <label>Bairro:</label>
            <input class="form-control" id="bairro-editar" name="bairro" readonly="true">    
          </div>
          <div class="col-md-5">
            <label>Cidade:</label>
            <input class="form-control" id="cidade-editar" name="cidade" readonly="true">    
          </div>
          <div class="col-md-1">
            <label>Estado:</label>
            <input class="form-control" id="estado-editar" name="estado" readonly="true">    
          </div>
          <div class="col-md-2">
            <label>País:</label>
            <select class="form-control" name="pais" id="pais-editar" readonly="true">        
              <option value="1">Brasil</option>          
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
  //CEP
  $("#num-cep").on('keyup', function(){
      var maxLength = $(this).attr("maxlength");
      if(maxLength == $(this).val().length){
      var cep = $("#num-cep").val();
      var url = 'https://viacep.com.br/ws/'+cep+'/json/';
      $.ajax({
        url: url,
        dataType: 'json',
        type: 'get'
      }).done(function(data){
        if(data.erro){
          $("#cep-erro").val(1);
        }else{
          $("#cep-erro").val(0);
          $("#cidade").val(data.localidade);
          $("#estado").val(data.uf);
          $("#bairro").val(data.bairro);
          $("#logradouro").val(data.logradouro);
        }
      });
    }else{
      $("#cep-erro").val(1);
      $("#cidade").val('');
      $("#estado").val('');
      $("#bairro").val('');
      $("#logradouro").val('');
    }
  });
  //CEP editar
  $("#num-cep-editar").on('keyup', function(){
      var maxLength = $(this).attr("maxlength");
      if(maxLength == $(this).val().length){
      var cep = $("#num-cep-editar").val();
      var url = 'https://viacep.com.br/ws/'+cep+'/json/';
      $.ajax({
        url: url,
        dataType: 'json',
        type: 'get'
      }).done(function(data){
        if(data.erro){
          $("#cep-erro").val(1);
        }else{
          $("#cep-erro-editar").val(0);
          $("#cidade-editar").val(data.localidade);
          $("#estado-editar").val(data.uf);
          $("#bairro-editar").val(data.bairro);
          $("#logradouro-editar").val(data.logradouro);
        }
      });
    }else{
      $("#cep-erro-editar").val(1);
      $("#cidade-editar").val('');
      $("#estado-editar").val('');
      $("#bairro-editar").val('');
      $("#logradouro-editar").val('');
    }
  });
  //Cadastro
  $("#cadastro-empresa").on('submit', function(e){
    
    e.preventDefault();
    if($("#cnpj").val() == "" || $("#razao-social").val() == "" ||
    $("#num-cep").val() == "" || $("#telefone").val() == "" ||
    $("#numero-endereco").val() == "" || $("#tamanho").val() == 0
    ){

      if($("#cnpj").val() == ""){
        $("#cnpj").css('border-color', 'red');
      }else{
        $("#cnpj").css('border-color', '#ced4da')
      }

      if($("#razao-social").val() == ""){
        $("#razao-social").css('border-color', 'red');
      }else{
        $("#razao-social").css('border-color', '#ced4da')
      }

      if($("#num-cep").val() == ""){
        $("#num-cep").css('border-color', 'red');
      }else{
        $("#num-cep").css('border-color', '#ced4da')
      }

      if($("#telefone").val() == ""){
        $("#telefone").css('border-color', 'red');
      }else{
        $("#telefone").css('border-color', '#ced4da')
      }

      if($("#numero-endereco").val() == ""){
        $("#numero-endereco").css('border-color', 'red');
      }else{
        $("#numero-endereco").css('border-color', '#ced4da')
      }

      if($("#tamanho").val() == 0){
        $("#tamanho").css('border-color', 'red');
      }else{
        $("#tamanho").css('border-color', '#ced4da')
      }

      $('.error-alert-text').html('');
      $('.error-alert-text').html('Preencha os campos marcados em vermelho para continuar');
      $('#alert-modal-error').show();

    }else{
      let data = $("#cadastro-empresa").serialize();

      $.ajax({
        url: '/cadastrar-empresa',
        type: 'post',
        data: data
      }).done(function(data){
        data = JSON.parse(data)
        $('.success-alert-text').html('');
        $('.success-alert-text').html(data['mensagem']);
        $("#redirect-alert").attr("href", "/cadastrar-empresa");
        $('#alert-ok').show();
      })
    }
  });

  //Edição
  $("#form-editar-empresa").on('submit', function(e){
    e.preventDefault();

    if($("#cnpj-editar").val() == "" || $("#razao-social-editar").val() == "" ||
    $("#num-cep-editar").val() == "" || $("#telefone-editar").val() == "" ||
    $("#numero-endereco-editar").val() == "" || $("#tamanho-editar").val() == 0
    ){

      if($("#cnpj-editar").val() == ""){
        $("#cnpj-editar").css('border-color', 'red');
      }else{
        $("#cnpj-editar").css('border-color', '#ced4da')
      }

      if($("#razao-social-editar").val() == ""){
        $("#razao-social-editar").css('border-color', 'red');
      }else{
        $("#razao-social-editar").css('border-color', '#ced4da')
      }

      if($("#num-cep-editar").val() == ""){
        $("#num-cep-editar").css('border-color', 'red');
      }else{
        $("#num-cep-editar").css('border-color', '#ced4da')
      }

      if($("#telefone-editar").val() == ""){
        $("#telefone-editar").css('border-color', 'red');
      }else{
        $("#telefone").css('border-color', '#ced4da')
      }

      if($("#numero-endereco-editar").val() == ""){
        $("#numero-endereco-editar").css('border-color', 'red');
      }else{
        $("#numero-endereco-editar").css('border-color', '#ced4da')
      }

      if($("#tamanho-editar").val() == 0){
        $("#tamanho-editar").css('border-color', 'red');
      }else{
        $("#tamanho-editar").css('border-color', '#ced4da')
      }

      $('.error-alert-text').html('');
      $('.error-alert-text').html('Preencha os campos marcados em vermelho para continuar');
      $('#alert-modal-error').show();

    }else{
      let data = $("#form-editar-empresa").serialize();
      $.ajax({
        url: '/cadastrar-empresa/editar',
        type: 'post',
        data: data
      }).done(function(data){
        data = JSON.parse(data)
        console.log(data)
        $('.success-alert-text').html('');
        $('.success-alert-text').html(data['mensagem']);
        $("#redirect-alert").attr("href", "/cadastrar-empresa");
        $('#alert-ok').show();
      })
    }
  });
  
  //Exclusão
  $('#confirmar-exclusao').on('click', function(e){
    e.preventDefault();
    var id = $('#id-delete').val();
    $.ajax({
      url: '/cadastro-/deletar/' + id,
      method: 'POST',
      data: {'id': id},
      success: function(data){
        data = JSON.parse(data);
        alert(data);
        window.location.reload();
      }
    });
  });

  //Gerenciamento
  $('#confirmar-gerenciamento').on('click', function(e){
    e.preventDefault();
    var id = $('#id-gerenciamento').val();
    $.ajax({
      url: '/cadastrar-empresa/alterar/' + id,
      method: 'POST',
      data: {'id': id},
      success: function(data){
        data = JSON.parse(data);
        alert(data);
        window.location.href = "/principal";
      }
    });
  });
})
</script>

<script type="text/javascript">
    $('#tabela-empresas').DataTable({
      "drawCallback":function(){

      //ao clicar em excluir
      $('a[id^="botao-excluir-"]').on('click', function(e){
        e.preventDefault();
        $('#alert-modal-delete').show();
        let id = this.id;
        id = id.slice(14);
        $('#id-delete').val(id);
      });

      //ao clicar em editar
      $('a[id^="botao-editar-"]').on('click', function(e){
        e.preventDefault();
        let id = this.id;
        id = id.slice(13);
        $('#id-editar').val(id);
        $.ajax({
          url: '/cadastrar-empresa/visualizar/' + id,
          method: 'POST',
          data: {'id': id}
        }).done(function(data){
          data = JSON.parse(data);
          console.log(data);
          
          $("#fantasia-editar").val(data.nome_fantasia);
          $("#cnpj-editar").val(data.cnpj_empresa_contratante);
          $("#razao-social-editar").val(data.razao_social_empresa_contratante);
          $("#telefone-editar").val(data.numero_telefone);
          $("#tamanho-editar").val(data.id_tamanho_empresa);
          $("#num-cep-editar").val(data.cep_empresa_contratante);
          $("#logradouro-editar").val(data.logradouro_empresa_contratante);
          $("#bairro-editar").val(data.bairro_empresa_contratante);
          $("#cidade-editar").val(data.id_cidade);
          $("#estado-editar").val(data.id_estado);
          $("#numero-endereco-editar").val(data.numero_endereco_empresa_contratante);

          $('#editar').modal('show');
        })
      });

      //ao clicar em gerenciar
      $('a[id^="botao-gerenciar-"]').on('click', function(e){
        e.preventDefault();
        let id = this.id;
        id = id.slice(16);
        $("#id-gerenciamento").val(id);
        $("#alert-modal-gerenciar").show();
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