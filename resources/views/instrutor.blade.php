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
        <h1 class="h3 mb-0 text-gray-800 ">Instrutor</h1>
    </div>
    <div class="row">
      <div class="card shadow col-md-12">
        <div class="card-header py-3">
          <h4>Cadastro de novo instrutor</h4>
        </div>
        <div class="card-body">
          <form id="cadastro-instrutor" method="POST">
            @csrf  
            <div class="row form-row-spacing">
              <div class="col-md-4">
                <label>Nome do instrutor</label>
                <input class="form-control" type="text" name="nome-instrutor" id="nome-instrutor">
              </div>
              <div class="col-md-4">
                <label>Data de Nascimento</label>
                <input class="form-control" type="date" name="data-nasc" id="data-nasc">
              </div>           
              <div class="col-md-4">
                <label>E-mail</label>
                <input class="form-control" type="email" name="email-instrutor" id="email-instrutor">
              </div> 
            </div>
            <div class="row form-row-spacing">
              <div class="col-md-3">
                <label>Telefone</label>
                <input class="form-control" type="text" name="telefone" id="telefone">
              </div> 
              <div class="col-md-3">
                <label>Gênero</label>
                <select class="form-control" name="genero" id="genero">
                  <option value="0">Selecione o genêro</option>
                  @foreach($generos as $genero)
                  <option value="{{$genero->id_genero}}">{{$genero->nome_genero}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-3">
                <label>Saudação</label>
                <select class="form-control"  name="saudacao" id="saudacao">
                  <option value="0">Selecione a Saudação</option>
                  @foreach($saudacoes as $saudacao)
                  <option value="{{$saudacao->id_saudacao}}">{{$saudacao->nome_saudacao}}</option>
                  @endforeach
                </select>
              </div>  
              <div class="col-md-3">
              <label>Estado Civil</label>
                <select class="form-control" name="estado-civil" id="estado-civil">
                  <option value="0">Selecione o estado civil</option>
                  @foreach($estados_civis as $estado_civil)
                  <option value="{{$estado_civil->id_estado_civil}}">{{$estado_civil->nome_estado_civil}}</option>
                  @endforeach
                </select>
              </div> 
            </div>
            <div class="row form-row-spacing">
              <div class="col-md-2">
                <label>CPF</label>
                <input class="form-control" type="text" name="cpf" id="cpf">
              </div>
              <div class="col-md-3">
                <label>CNPJ</label>
                <input class="form-control" type="text" name="cnpj" id="cnpj">
              </div>
              <div class="col-md-4">
                <label>Grau de escolaridade</label>
                <select class="form-control" type="text" name="escolaridade" id="escolaridade">
                  <option value="0">Escolha o grau de escolaridade</option>
                  @foreach($escolaridades as $escolaridade)
                  <option value="{{$escolaridade->id_escolaridade}}">{{$escolaridade->nome_escolaridade}}</option>
                  @endforeach
                </select>
              </div> 
              <div class="col-md-3">
                <label>Tipo do contrato</label>
                <select class="form-control" type="text" name="tipo-contrato" id="tipo-contrato">
                  <option value="0">Escolha o tipo de contrato</option>
                  @foreach($tipos_contrato as $contrato)
                  <option value="{{$contrato->id_tipo_contrato}}">{{$contrato->nome_tipo_contrato}}</option>
                  @endforeach
                </select>
              </div>  
            </div>     
            <div class="row form-row-spacing">
              <div class="col-md-4">
                <label>Usuário:</label>
                <select class="form-control" id="usuario-instrutor" name="usuario-instrutor">
                  <option value="0">Selecione o email de acesso</option>
                  @foreach($usuarios_ativos as $each)
                  <option value="{{$each->id_usuario}}">{{$each->email_usuario}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-4">
                <label>Especialidade</label>
                <input class="form-control" id="especialidade" name="especialidade">
              </div>
              <div class="col-md-2">
                <label>Necessidade Especial </label>
                <select class="form-control" id="necessidade-especial" name="necessidade-especial">
                  <option value="0">Não</option>
                  <option value="1">Sim</option>                  
                </select>               
              </div>
            </div>   
            <div class="row form-row-spacing" id="input-desc-necessidade" style="display: none;" >
              <div class="col-md-12" >
                <label>Descreva sua necessidade especial: </label>
                <textarea class="form-control" id="desc-necessidade" name="desc-necessidade"></textarea>
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
            <h4>Instrutores cadastrados</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
          <table id="tabela-parentescos" class="display" style="width:100%">
            <thead>
                <tr style="text-align: center;">
                    <th>Foto</th>
                    <th>Nome</th>
                    <th>Especialidade</th>
                    <th>e-mail de acesso</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
              @foreach($tabela as $linha)
              <tr style="text-align: center;">
                <td style="width: 10%;"><img id="foto-click-{{$linha->id_instrutor}}" 
                src="/storage/app/images/teachers/{{$linha->foto_instrutor}}" 
                width="70px" height="70px" style="border-radius: 50%; cursor: pointer"
                onmouseover="this.src='/storage/app/images/teachers/change.png'; this.style.opacity=0.5"
								onmouseout="this.src='/storage/app/images/teachers/{{$linha->foto_instrutor}}'; this.style.opacity=1"
                >
                <form id="troca-foto-{{$linha->id_instrutor}}">
										@csrf
										<input type="file" id="FileInput{{$linha->id_instrutor}}" style="display: none"/>
										<input type="submit" id="Up{{$linha->id_instrutor}}" style="display: none;" />
								</form>   
                </td>
                <td style="width: 20%;">{{$linha->nome_instrutor}}</td>
                <td style="width: 20%;">{{$linha->area_especialidade_instrutor}}</td>
                <td>{{$linha->email_usuario}}</td>
                <td style="width: 30%;">
                  <a id="botao-editar-{{$linha->id_instrutor}}" class="btn btn-success" style="margin-left: 2px; margin-bottom: 2px;">Editar</a>
                  <a id="botao-desativar-{{$linha->id_instrutor}}" class="btn btn-danger" style="margin-left: 2px; margin-bottom: 2px;">Desativar</a>
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
<!--Modal-editar-instrutor-->
<div class="modal fade" id="editar" tabindex="-1" role="dialog" aria-labelledby="visualizarModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Principais</h5>
        <button type="button" class="close" onclick="formControlReset()" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" id="form-editar">
        @csrf  
          <div class="row form-row-spacing">
            <div class="col-md-4">
              <label>Nome do instrutor</label>
              <input class="form-control" type="text" name="nome-instrutor" id="nome-instrutor-editar">
            </div>
            <div class="col-md-4">
              <label>Data de Nascimento</label>
              <input class="form-control" type="date" name="data-nasc" id="data-nasc-editar">
            </div>           
            <div class="col-md-4">
              <label>E-mail</label>
              <input class="form-control" type="email" name="email-instrutor" id="email-instrutor-editar">
            </div> 
          </div>
          <div class="row form-row-spacing">
            <div class="col-md-3">
              <label>Telefone</label>
              <input class="form-control" type="text" name="telefone" id="telefone-editar">
            </div> 
            <div class="col-md-3">
              <label>Gênero</label>
              <select class="form-control" name="genero" id="genero-editar">
                <option value="0">Selecione o genêro</option>
                @foreach($generos as $genero)
                <option value="{{$genero->id_genero}}">{{$genero->nome_genero}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-3">
              <label>Saudação</label>
              <select class="form-control"  name="saudacao" id="saudacao-editar">
                <option value="0">Selecione a Saudação</option>
                @foreach($saudacoes as $saudacao)
                <option value="{{$saudacao->id_saudacao}}">{{$saudacao->nome_saudacao}}</option>
                @endforeach
              </select>
            </div>  
            <div class="col-md-3">
            <label>Estado Civil</label>
              <select class="form-control" name="estado-civil" id="estado-civil-editar">
                <option value="0">Selecione o estado civil</option>
                @foreach($estados_civis as $estado_civil)
                <option value="{{$estado_civil->id_estado_civil}}">{{$estado_civil->nome_estado_civil}}</option>
                @endforeach
              </select>
            </div> 
          </div>
          <div class="row form-row-spacing">
            <div class="col-md-2">
              <label>CPF</label>
              <input class="form-control" type="text" name="cpf" id="cpf-editar">
            </div>
            <div class="col-md-3">
              <label>CNPJ</label>
              <input class="form-control" type="text" name="cnpj" id="cnpj-editar">
            </div>
            <div class="col-md-4">
              <label>Grau de escolaridade</label>
              <select class="form-control" type="text" name="escolaridade" id="escolaridade-editar">
                <option value="0">Escolha o grau de escolaridade</option>
                @foreach($escolaridades as $escolaridade)
                <option value="{{$escolaridade->id_escolaridade}}">{{$escolaridade->nome_escolaridade}}</option>
                @endforeach
              </select>
            </div> 
            <div class="col-md-3">
              <label>Tipo do contrato</label>
              <select class="form-control" type="text" name="tipo-contrato" id="tipo-contrato-editar">
                <option value="0">Escolha o tipo de contrato</option>
                @foreach($tipos_contrato as $contrato)
                <option value="{{$contrato->id_tipo_contrato}}">{{$contrato->nome_tipo_contrato}}</option>
                @endforeach
              </select>
            </div>  
          </div>     

          <div class="row form-row-spacing">
            <div class="col-md-4">
              <label>Usuário:</label>
              <select class="form-control" id="usuario-instrutor-editar" name="usuario-instrutor">
                <option value="0">Selecione o email de acesso</option>
                @foreach($usuarios_ativos as $each)
                <option value="{{$each->id_usuario}}">{{$each->email_usuario}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-4">
              <label>Especialidade</label>
              <input class="form-control" id="especialidade-editar" name="especialidade">
            </div>
            <div class="col-md-2">
              <label>Necessidade Especial </label>
              <select class="form-control" id="necessidade-especial-editar" name="necessidade-especial">
                <option value="0">Não</option>
                <option value="1">Sim</option>                  
              </select>               
            </div>
          </div>   
          <div class="row form-row-spacing" id="input-desc-necessidade-editar" >
            <div class="col-md-12" >
              <label>Descreva sua necessidade especial: </label>
              <textarea class="form-control" id="desc-necessidade-editar" name="desc-necessidade"></textarea>
            </div>        
          </div>    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="formControlReset()" data-dismiss="modal">Fechar</button>
        <input name="id" id="id-editar" hidden>
        <input type="submit" class="btn btn-primary" onclick="formControlReset()" value="Salvar Alterações">
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
  $("#cpf").mask("000.000.000-00");
  $("#cnpj").mask("00.000.000/0000-00");
  $("#cpf-editar").mask("000.000.000-00");
  $('#rg').mask('SS-00.000.000');
  $("#pis").mask('000.00000.00-00')

  $('#usuario-instrutor').selectize({ 
    placeholder: 'Selecione o e-mail de acesso'
  });
  $('#depto').selectize({ 
    placeholder: 'Selecione o departamento'
  });
  $('#cargo').selectize({ 
    placeholder: 'Selecione o cargo'
  });




  $("#necessidade-especial").on('change', function(){
    if($("#necessidade-especial").val() == 1){
      $("#input-desc-necessidade").show();
    }else{
      $("#desc-necessidade").val('');
      $("#input-desc-necessidade").hide();
    }
  })

  $("#necessidade-especial-editar").on('change', function(){
    if($("#necessidade-especial-editar").val() == 1){
      $("#input-desc-necessidade-editar").show();
    }else{
      $("#desc-necessidade-editar").val('');
      $("#input-desc-necessidade-editar").hide();
    }
  })

  //Cadastro
  $("#cadastro-instrutor").on('submit', function(e){
      e.preventDefault();
      let data = $("#cadastro-instrutor").serialize();

      if($("#nome-instrutor").val() == "" || 
         $("#data-nasc").val() == "" ||
         $("#email").val() == "" ||
         $("#telefone").val() == "" ||
         $("#genero").val() == 0 ||
         $("#saudacao").val() == 0 ||
         $("#estado-civil").val() == 0 ||
         $("#cpf").val() == "" ||
         $("#escolaridade").val() == 0 ||
         $("#tipo-contrato").val() == 0 ||
        ($("#necessidade-especial").val() == 1 && $("#desc-necessidade").val() == "" )   
        ){

        if($('#nome-instrutor').val() == ""){
          $("#nome-instrutor").css('border-color','red');
        }else{
          $('#nome-instrutor').css('border-color', '#ced4da');
        }

        if($('#data-nasc').val() == ""){
          $("#data-nasc").css('border-color','red');
        }else{
          $('#data-nasc').css('border-color', '#ced4da');
        }

        if($('#email-instrutor').val() == ""){
          $("#email-instrutor").css('border-color','red');
        }else{
          $('#email-instrutor').css('border-color', '#ced4da');
        }

        if($('#telefone').val() == ""){
          $("#telefone").css('border-color','red');
        }else{
          $('#telefone').css('border-color', '#ced4da');
        }

        if($('#telefone').val() == ""){
          $("#telefone").css('border-color','red');
        }else{
          $('#telefone').css('border-color', '#ced4da');
        }

        if($('#genero').val() == 0){
          $("#genero").css('border-color','red');
        }else{
          $('#genero').css('border-color', '#ced4da');
        }
        
        if($('#saudacao').val() == 0){
          $("#saudacao").css('border-color','red');
        }else{
          $('#saudacao').css('border-color', '#ced4da');
        }

        if($('#estado-civil').val() == 0){
          $("#estado-civil").css('border-color','red');
        }else{
          $('#estado-civil').css('border-color', '#ced4da');
        }

        if($('#cpf').val() == ""){
          $("#cpf").css('border-color','red');
        }else{
          $('#cpf').css('border-color', '#ced4da');
        }

        if($("#escolaridade").val() == 0){
          $("#escolaridade").css('border-color','red');
        }else{
          $("#escolaridade").css('border-color', '#ced4da');
        }

        if($("#tipo-contrato").val() == 0){
          $("#tipo-contrato").css('border-color','red');
        }else{
          $("#tipo-contrato").css('border-color', '#ced4da');
        }

        if(($("#necessidade-especial").val() == 1 && $("#desc-necessidade").val() == "")){
          $("#desc-necessidade").css('border-color','red');
        }else{
          $('#desc-necessidade').css('border-color', '#ced4da');
        }


        $('.error-alert-text').html('');
        $('.error-alert-text').html('Preencha os campos marcados em vermelho para continuar');
        $('#alert-modal-error').show();

      }
      else{
        $.ajax({
          url: "/instrutores",
          type: 'post',
          data: data
          
        }).done(function(data){
          data = JSON.parse(data);
          console.log(data);
          if(data["flag"] == true){
            $('.success-alert-text').html('');
            $('.success-alert-text').html(data['mensagem']);
            $("#redirect-alert").attr("href", "/instrutores");
            $('#alert-ok').show();
          }else{
            $('.error-alert-text').html('');
            $('.error-alert-text').html(data['mensagem']);
            $('#alert-modal-error').show();
          }
        })
      }
  });

  //Edição Principais
  $("#form-editar").on('submit', function(e){
    e.preventDefault();
    var data = $("#form-editar").serialize();

    if($("#nome-instrutor-editar").val() == "" || 
       $("#data-nasc-editar").val() == "" ||
       $("#email-instrutor-editar").val() == "" ||
       $("#telefone-editar").val() == "" ||
       $("#genero-editar").val() == 0 ||
       $("#saudacao-editar").val() == 0 ||
       $("#estado-civil-editar").val() == 0 ||
       $("#cpf-editar").val() == "" ||
       $("#escolaridade-editar").val() == 0 ||
       $("#tipo-contrato-editar").val() == 0 ||
      ($("#necessidade-especial-editar").val() == 1 && $("#desc-necessidade-editar").val() == "")
  
    ){
        if($('#nome-instrutor-editar').val() == ""){
          $("#nome-instrutor-editar").css('border-color','red');
        }else{
          $('#nome-instrutor-editar').css('border-color', '#ced4da');
        }

        if($('#data-nasc-editar').val() == ""){
          $("#data-nasc-editar").css('border-color','red');
        }else{
          $('#data-nasc-editar').css('border-color', '#ced4da');
        }

        if($('#email-instrutor-editar').val() == ""){
          $("#email-instrutor-editar").css('border-color','red');
        }else{
          $('#email-instrutor-editar').css('border-color', '#ced4da');
        }

        if($('#telefone-editar').val() == ""){
          $("#telefone-editar").css('border-color','red');
        }else{
          $('#telefone-editar').css('border-color', '#ced4da');
        }

        if($('#telefone-editar').val() == ""){
          $("#telefone-editar").css('border-color','red');
        }else{
          $('#telefone-editar').css('border-color', '#ced4da');
        }

        if($('#genero-editar').val() == 0){
          $("#genero-editar").css('border-color','red');
        }else{
          $('#genero-editar').css('border-color', '#ced4da');
        }
        
        if($('#saudacao-editar').val() == 0){
          $("#saudacao-editar").css('border-color','red');
        }else{
          $('#saudacao-editar').css('border-color', '#ced4da');
        }

        if($('#estado-civil-editar').val() == 0){
          $("#estado-civil-editar").css('border-color','red');
        }else{
          $('#estado-civil-editar').css('border-color', '#ced4da');
        }

        if($('#cpf-editar').val() == ""){
          $("#cpf-editar").css('border-color','red');
        }else{
          $('#cpf-editar').css('border-color', '#ced4da');
        }

        if($("#escolaridade-editar").val() == 0){
          $("#escolaridade-editar").css('border-color','red');
        }else{
          $("#escolaridade-editar").css('border-color', '#ced4da');
        }

        if($("#tipo-contrato-editar").val() == 0){
          $("#tipo-contrato-editar").css('border-color','red');
        }else{
          $("#tipo-contrato-editar").css('border-color', '#ced4da');
        }

        if(($("#necessidade-especial-editar").val() == 1 && $("#desc-necessidade-editar").val() == "")){
          $("#desc-necessidade-editar").css('border-color','red');
        }else{
          $('#desc-necessidade-editar').css('border-color', '#ced4da');
        }

        $('.error-alert-text').html('');
        $('.error-alert-text').html('Preencha os campos marcados em vermelho para continuar');
        $('#alert-modal-error').show();
    }
    else{
      $.ajax({
        url: "/instrutores/editar",
        type: 'post',
        data: data
        
      }).done(function(data){
        data = JSON.parse(data);
        console.log(data);
        $('.success-alert-text').html('');
        $('.success-alert-text').html(data['mensagem']);
        $("#redirect-alert").attr("onclick", "$('#alert-ok').hide()");
        $('#alert-ok').show();
      })
    }
  }); 

  
  //Exclusão
  $('#confirmar-desativacao').on('click', function(e){
    e.preventDefault();
    var id = $('#id-desativar').val();
    $.ajax({
      url: '/instrutores/desativar/' + id,
      method: 'POST',
      data: {'id': id},
      success: function(data){
        data = JSON.parse(data);
        alert(data['mensagem']);
        window.location.reload();
      }
    });
  });
  
  //Fazendo upload da foto
  $('input[id^="FileInput"]').change(function() {
      let id = this.id;
      id = id = id.slice(9);
    
      $("#Up"+id).click();
  });

  $('form[id^="troca-foto-"]').on('submit', function(e){
		e.preventDefault();
    let id = this.id;  
    id = id.slice(11);
    var photo = $('#FileInput'+id).prop('files')[0];    //Arquivo
  
    var form_data = new FormData(); 
    form_data.append("id", id);
    form_data.append("photo", photo);
		
			$.ajax({
				url:'/atualiza-foto-instrutor',
				method: 'post',
				dataType: 'script',
      	cache: false,
      	contentType: false,
      	processData: false,
      	data: form_data
			}).done(function(data){
				window.location.reload();
			})
		})

})

//funções

function formControlReset(){
  $(".form-control").css("border-color", "#ced4da");
}
</script>

<script type="text/javascript">
    $('#tabela-parentescos').DataTable({
      "drawCallback":function(){

      //ao clicar para alterar a foto  
      $('img[id^="foto-click-"]').on('click', function() {
          let id = this.id;
          id = id.slice(11);  
          $("#FileInput"+id ).click();
      });

      //ao clicar em desativar
      $('a[id^="botao-desativar-"]').on('click', function(e){
        e.preventDefault();
        $('#alert-modal-desativar').show();
        $('#disable-text').html('');
        $('#disable-text').html('Tem certeza que deseja desativar este instrutor?');
        let id = this.id;
        id = id.slice(16);
        $('#id-desativar').val(id);
      });

      //ao clicar em editar principais
      $('a[id^="botao-editar-"]').on('click', function(e){
        e.preventDefault();
        let id = this.id;
        id = id.slice(13);
        console.log(id);
        $('#id-editar').val(id);
        $('#editar').modal('show');
        $.ajax({
          url: '/instrutores/visualizar/' + id,
          method: 'POST',
          data: {'id': id}
        }).done(function(data){
          data = JSON.parse(data);

          console.log(data);
          $("#nome-instrutor-editar").val(data.nome_instrutor);
          $("#data-nasc-editar").val(data.dn_instrutor);
          $("#email-instrutor-editar").val(data.email_instrutor);
          $("#telefone-editar").val(data.numero_telefone);
          $("#genero-editar").val(data.id_genero);
          $("#saudacao-editar").val(data.id_saudacao);
          $("#estado-civil-editar").val(data.id_estado_civil);
          $("#cpf-editar").val(data.cpf_instrutor);
          $("#cnpj-editar").val(data.cnpj_instrutor);
          $("#escolaridade-editar").val(data.id_escolaridade);
          $("#tipo-contrato-editar").val(data.id_tipo_contrato);
          $("#necessidade-especial-editar").val(data.possui_deficiencia);
          if(data.possui_deficiencia == 1){
            $("#input-desc-necessidade-editar").show();
            $("#desc-necessidade-editar").val(data.tipo_necessidade_especial);
          }
          $select = $("#usuario-instrutor-editar").selectize();
          $select[0].selectize.setValue(data.id_usuario);
          $('#especialidade-editar').val(data.area_especialidade_instrutor);
          $("#id-editar").val(data.id_instrutor);
          
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