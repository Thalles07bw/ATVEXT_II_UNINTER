
@include('partials.header-second-layer')

<!--Alerts-->
@include('alerts.alert-modal-delete')
@include('alerts.alert-success')
@include('alerts.alert-modal-error')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb" style="float: right; background-color: #f9f9f9;">
    <li class="breadcrumb-item"><a href="/cadastro-vagas">Vagas</a></li>
    <li class="breadcrumb-item active" aria-current="page">Processos Seletivos</li>
  </ol>
</nav>
<body>
  <!-- Begin Page Content -->
  <!--id da vaga -->
  <input id="id-vaga" value="{{$id_vaga}}" hidden>
  <div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 ">Processos Seletivos</h1>
    </div>

    <div class="row ">
      <div class="card shadow col-md-12">
        <div class="card-header py-3">
          <h4>Andamento do Processo Seletivo</h4>
        </div>
        <div class="card-body">
          <div class="list-group list-group-horizontal text-nowrap overflow-auto">
            <!-- Quadro de um processo seletivo-->
            @foreach($quadros as $quadro)
            <div class="col-md-5 responsive-column"> 
              <div class="card">
                <div class="card-header" style="background-color: #444444; color: white">
                  {{$quadro->etapa}}
                </div>
                <div class="card-body dropZone" id="quadro-{{$quadro->id_etapa}}">
                <!-- Cartões de Candidatos -->
                @foreach($candidatos as $candidato)
                  @if($candidato->posicao_candidato == $quadro->id_etapa)
                  <div id="{{$candidato->id_candidato}}" class="card drag-card" draggable="true" style="margin: 5px 5px 5px 5px;">
                    <div  class="status quadro-1">
                      <div class="card-header content" style="background-color: #2C5EFF; color: white"> 
                        {{$candidato->nome_usuario_candidato}}
                      </div>
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-6">
                            <img class="profile-user-img" src="..{{$candidato->foto_candidato}}" alt="User profile picture" width="80px" height="80px" style="border-radius: 50%;">
                          </div>
                          <div class="col-md-6">
                            <div class="row" style="margin-left: 1px;">
                              <a href="/ver-curriculo/{{$candidato->id_candidato}}" class="btn btn-primary btn-sm"  style="margin: 5px 5px 5px 5px;">Ver Curriculo</a>
                              <a class="btn btn-danger btn-sm" style="margin: 5px 5px 5px 5px;">Eliminar</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div> 
                  </div>
                  @endif
                  @endforeach                            
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
<!--Modal-Visibilidade-->
<div class="modal fade" id="visibilidade" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Visualizar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row" style="margin-left: 3px; margin-bottom: 5px">
          <div class="col-md-8" style="margin-top: 5px">
            <input type="checkbox" checked disabled>&nbsp;<span>Mostrar candidatos</span>
          </div>
          <div class="col-md-4">
            <select class="form-control" disabled>
              <option value="1">Posição 1</option>
            </select>
          </div>
        </div>
        
        <div class="row" style="margin-left: 3px; margin-bottom: 5px">
          <div class="col-md-8" style="margin-top: 5px">
            <input type="checkbox" checked>&nbsp;<span>Mostrar etapa de análise de currículo</span>
          </div>
          <div class="col-md-4">
            <select class="form-control">
              <option value="2">Posição 2</option>
              <option value="3">Posição 3</option>
              <option value="4">Posição 4</option>
              <option value="5">Posição 5</option>
            </select>
          </div>
        </div>
        <div class="row" style="margin-left: 3px; margin-bottom: 5px">
          <div class="col-md-8" style="margin-top: 5px">
            <input type="checkbox" checked>&nbsp;<span>Mostrar etapa de avaliação</span>
          </div>
          <div class="col-md-4">
            <select class="form-control">
              <option value="2">Posição 2</option>
              <option value="3">Posição 3</option>
              <option value="4">Posição 4</option>
              <option value="5">Posição 5</option>
            </select>
          </div>
        </div>
        <div class="row" style="margin-left: 3px; margin-bottom: 5px">
          <div class="col-md-8" style="margin-top: 5px">
            <input type="checkbox" checked>&nbsp;<span>Mostrar etapa de entrevista</span>
          </div>
          <div class="col-md-4">
            <select class="form-control">
              <option value="2">Posição 2</option>
              <option value="3">Posição 3</option>
              <option value="4">Posição 4</option>
              <option value="5">Posição 5</option>
            </select>
          </div>
        </div>
        <div class="row" style="margin-left: 3px; margin-bottom: 5px">
          <div class="col-md-8" style="margin-top: 5px">
            <input type="checkbox" id="etapa-personalizada">&nbsp;<span>Mostrar etapa personalizada</span>   
            <div class="col-md-10" id="nome-personalizada" style="margin-top: 10px;margin-bottom: 10px; display: none">
             <input class="form-control" type="text" id="nome-personalizada" placeholder="Nome da Etapa">
            </div>
          </div>
          <div class="col-md-4">
            <select class="form-control">
              <option value="2">Posição 2</option>
              <option value="3">Posição 3</option>
              <option value="4">Posição 4</option>
              <option value="5">Posição 5</option>
            </select>
          </div>
        </div>
        <div class="row" style="margin-left: 3px; margin-bottom: 5px">
          <div class="col-md-8"  style="margin-top: 5px">
            <input type="checkbox" checked disabled>&nbsp;<span>Mostrar etapa de aprovados</span>
          </div>
          <div class="col-md-4">
            <select class="form-control" disabled>
              <option value="6">Posição 6</option>
            </select>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" type="submit">Salvar Alterações</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>
@include('partials.footer-second-layer')
<script type="text/javascript" src="../resources/js/drag-and-drop/dnd.js"></script>
<script type="text/javascript">
  $('#etapa-personalizada').on('click', function(){
    if($('#etapa-personalizada').prop('checked') == true){
      $('#nome-personalizada').show();
    }else{
      $('#nome-personalizada').hide();
    }
  })
</script>