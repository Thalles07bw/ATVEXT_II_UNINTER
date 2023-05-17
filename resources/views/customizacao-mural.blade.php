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
        <h1 class="h3 mb-0 text-gray-800">Customização do Mural</h1>
    </div>
    @if(!$tabela)
    <div class="row ">
      <div class="card shadow col-md-12">
        <div class="card-header py-3">
          <h4>Definição de Logo e Cor</h4>
        </div>
        <div class="card-body">
          <form id="cadastro-personalizacao" method="POST" enctype="multipart/form-data">
            @csrf  
            <div class="row form-row-spacing">
              <div class="col-md-6">
                <label>Logo:</label>
                <input class="form-control-file" type="file" name="logo" id="logo">
              </div>  
              <div class="col-md-4">
                <label>Selecione a Cor:</label><br>
                <input class="form-control" type="color" value="#ffffff" id="cor" name="cor" style="width: 200px;">
              </div>
            </div>
            <br>
            <div class="row form-row-spacing">
              <div class="col-md-6">
                <label>Linkedin:</label><br>
                <input class="form-control" type="text" id="linkedin" name="linkedin">
              </div>
              <div class="col-md-6">
                <label>Facebook:</label><br>
                <input class="form-control" type="text" id="facebook" name="facebook">
              </div>
            </div>
            <br>
            <div class="row form-row-spacing">
              <div class="col-md-6">
                <label>Twitter:</label><br>
                <input class="form-control" type="text" id="twitter" name="twitter">
              </div>
              <div class="col-md-6">
                <label>Instagram:</label><br>
                <input class="form-control" type="text" id="instagram" name="instagram">
              </div>
            </div>
            <br>
            <div class="row form-row-spacing">
              <div class="col-md-6">
                <label>YouTube:</label><br>
                <input class="form-control" type="text" id="youtube" name="youtube">
              </div>
              <div class="col-md-4">
              <label>Selecione a cor dos icones:</label><br>
              <input class="form-control" type="color" id="cor-icone" name="cor-icone" style="width: 200px;" >
            </div>
            </div>
          </div>
          <br>
          <div class="card-footer">
            <input class="btn btn-primary" type="submit" value="Avançar para tabela">
          </div>
          </form>
        </div>
      </div>
      <br>
      @else
      <div class="row">
        <div class="card shadow col-md-12">
          <div class="card-header py-3">
              <h4>Personalização Atual</h4>
              <a class="btn btn-primary" data-toggle="modal" data-target="#editar" style="float:right;">Editar</a>
          </div>
          <div class="card-body">
            <div class="table-responsive">
            <table  class="display" style="width:100%">
              <thead>
                  <tr style="text-align: center;">
                      <th>Logo</th>
                      <th>Cor do cabeçalho</th>
                      <th>Cor dos icones</th>
                      <th>Linkedin</th>
                      <th>Facebook</th>              
                      <th>Twitter</th>
                      <th>Instagram</th>
                      <th>YouTube</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach($tabela as $each)
                  <tr style="text-align: center;">
                      @if($each->logo == '')
                      <td>Não Cadastrado</td>
                      @else
                      <td><a href="/storage/app/{{$each->logo}}">Clique para visualizar</a></td>
                      @endif
                      <td><input style="width: 25px; height: 25px;
                       border-radius: 50%; border-color: black ;background-color: {{$each->cor}}" disabled>
                      </td>
                      <td><input style="width: 25px; height: 25px;
                       border-radius: 50%; border-color: black ;background-color: {{$each->cor_icone}}" disabled>
                      </td>
                      @if($each->linkedin == '')
                      <td>Não Cadastrado</td>
                      @else
                      <td><a href="{{$each->linkedin}}">Link</a></td>
                      @endif
                      @if($each->facebook == '')
                      <td>Não Cadastrado</td>
                      @else
                      <td><a href="{{$each->facebook}}">Link</a></td>
                      @endif
                      @if($each->twitter == '')
                      <td>Não Cadastrado</td>
                      @else
                      <td><a href="{{$each->twitter}}">Link</a></td>
                      @endif
                      @if($each->instagram == '')
                      <td>Não Cadastrado</td>
                      @else
                      <td><a href="{{$each->instagram}}">Link</a></td>
                      @endif
                      @if($each->youtube == '')
                      <td>Não Cadastrado</td>
                      @else
                      <td><a href="{{$each->youtube}}">Link</a></td>
                      @endif                
                    </tr>
                  @endforeach
                  </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
      @endif
    </div>
  </div>
</body>
@if($tabela)
<!--modal editar-->
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
        <form id="cadastro-personalizacao-editar" method="POST" enctype="multipart/form-data">
          @csrf  
          <div class="row form-row-spacing">
            <div class="col-md-6">
              <label>Logo:</label>
              <input class="form-control-file" type="file" name="logo" id="logo-edit">
            </div>       
            <div class="col-md-4">
              <label>Selecione a cor do cabeçalho:</label><br>
              <input class="form-control" type="color" id="cor-edit" name="cor" style="width: 200px;" value="{{$tabela[0]->cor}}">
            </div>
          </div>
          <br>
          <div class="row form-row-spacing">
            <div class="col-md-6">
              <label>Linkedin:</label><br>
              <input class="form-control" type="text" id="linkedin-edit" name="linkedin" value="{{$tabela[0]->linkedin}}">
            </div>
            <div class="col-md-6">
              <label>Facebook:</label><br>
              <input class="form-control" type="text" id="facebook-edit" name="facebook" value="{{$tabela[0]->facebook}}">
            </div>
          </div>
          <br>
          <div class="row form-row-spacing" >
            <div class="col-md-6">
              <label>Twitter:</label><br>
              <input class="form-control" type="text" id="twitter-edit" name="twitter" value="{{$tabela[0]->twitter}}">
            </div>
            <div class="col-md-6">
              <label>Instagram:</label><br>
              <input class="form-control" type="text" id="instagram-edit" name="instagram" value="{{$tabela[0]->instagram}}">
            </div>
          </div>
          <br>
          <div class="row form-row-spacing">
            <div class="col-md-6">
              <label>YouTube:</label><br>
              <input class="form-control" type="text" id="youtube-edit" name="youtube" value="{{$tabela[0]->youtube}}">
            </div>
            <div class="col-md-4">
              <label>Selecione a cor dos icones:</label><br>
              <input class="form-control" type="color" id="cor-icone-edit" name="cor-icone" style="width: 200px;" value="{{$tabela[0]->cor_icone}}">
            </div>
          </div>
        </div>
        <br>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <input type="submit" class="btn btn-primary" value="Salvar Alterações">
        </div>
        </form>
    </div>
  </div>
</div>
@endif
@include('partials.footer')
<script type="text/javascript">
 
  $("#cadastro-personalizacao").on('submit', function(e){
    e.preventDefault();
    var cor = $('#cor').val();
    var linkedin = $('#linkedin').val();
    var facebook = $('#facebook').val();
    var twitter = $('#twitter').val();
    var instagram = $('#instagram').val();
    var youtube = $('#youtube').val();                   
    var logo = $('#logo').prop('files')[0];    //Arquivo
    var cor_icone = $("#cor-icone").val();
 
    var form_data = new FormData(); 
    form_data.append("cor",cor);
    form_data.append("logo",logo);
    form_data.append("linkedin",linkedin);
    form_data.append("facebook",facebook);
    form_data.append("twitter",twitter);
    form_data.append("instagram",instagram);
    form_data.append("youtube",youtube);
    form_data.append("cor-icone", cor_icone);
    
    $.ajax({
      url:'/personalizar-mural',
      method: 'POST',
      dataType: 'script',
      cache: false,
      contentType: false,
      processData: false,
      data: form_data
    }).done(function(data){
      data = JSON.parse(data);
          $('.success-alert-text').html('');
          $('.success-alert-text').html(data['mensagem']);
          $("#redirect-alert").attr("href", "/personalizar-mural");
          $('#alert-ok').show();
    });
  });
  $("#cadastro-personalizacao-editar").on('submit', function(e){
    e.preventDefault();
    var cor_edit = $('#cor-edit').val();
    var linkedin_edit = $('#linkedin-edit').val();
    var facebook_edit = $('#facebook-edit').val();
    var twitter_edit = $('#twitter-edit').val();
    var instagram_edit = $('#instagram-edit').val();
    var youtube_edit = $('#youtube-edit').val();                   
    var logo_edit = $('#logo-edit').prop('files')[0];    //Arquivo
    var cor_icone_edit = $("#cor-icone-edit").val();
 
    var form_data = new FormData(); 
    form_data.append("cor-edit",cor_edit);
    form_data.append("logo-edit",logo_edit);
    form_data.append("linkedin-edit",linkedin_edit);
    form_data.append("facebook-edit",facebook_edit);
    form_data.append("twitter-edit",twitter_edit);
    form_data.append("instagram-edit",instagram_edit);
    form_data.append("youtube-edit",youtube_edit);
    form_data.append("cor-icone-edit",cor_icone_edit);
    
    $.ajax({
      url:'/personalizar-mural/editar',
      method: 'POST',
      dataType: 'script',
      cache: false,
      contentType: false,
      processData: false,
      data: form_data
    }).done(function(data){
      data = JSON.parse(data);
      $('.success-alert-text').html(data['mensagem']);
      $("#redirect-alert").attr("href", "/personalizar-mural");
      $('#alert-ok').show();
    });
  });
</script>