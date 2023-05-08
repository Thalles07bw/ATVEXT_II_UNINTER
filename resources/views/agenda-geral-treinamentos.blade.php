
@include('partials.header')
  <!-- Begin Page Content -->
  <div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 ">Treinamentos</h1>
    </div>
    <div class="row">
      <div class="card shadow col-md-12">
        <div class="card-header py-3">
          <h4>Aulas Agendadas</h4>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <!-- The time line -->
              <div class="timeline">
                <div class="row timeline-row-spacing">
                  <div class="col-md-3 timeline-date-input-spacing">
                    <form method="get" id="busca-data">
                    <label>Início do intervalo</label>
                    <input class="form-control" type="date" id="data-inicio" name="data-inicio" value="{{$data_inicio}}">
                  </div>
                  <div class="col-md-3 timeline-date-input-spacing">               
                    <label>Fim do intervalo</label>
                    <input class="form-control" type="date" id="data-fim" name="data-fim" value="{{$data_fim}}">
                  </div>
                  <div class="col-md-3 timeline-date-input-spacing">               
                    <label>Instrutor</label>
                    <select class="form-control"  id="instrutor" name="instrutor">
                      <option value="">--Qualquer--</option>
                      @foreach($instrutores as $instrutor)
                      <option value="{{$instrutor->nome_instrutor}}">{{$instrutor->nome_instrutor}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-3 timeline-date-input-spacing">               
                    <label>Cursos</label>
                    <select class="form-control"  id="curso" name="curso">                
                      <option value="">--Qualquer--</option>
                      @foreach($cursos as $curso)
                      <option value="{{$curso->nome_curso}}">{{$curso->nome_curso}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="row timeline-row-spacing">
                  <div class="col-md-3">
                    <button class="btn btn-primary" type="submit" id="buscar">Buscar</button>
                    </form>
                  </div>
                </div>
                @if(!$aulas)
                <p style="text-align: center;">Não foram encontradas aulas cadastradas nesta data</p>
                @else
                @foreach($aulas as $aula)
                <div class="row timeline-row-spacing">
                  <div class="timeline-item">              
                    <p class="time"><i class="fas fa-clock"></i> {{date('H:i', strtotime($aula->dia_hora_inicio))}} - {{date('H:i', strtotime($aula->dia_hora_fim))}} - {{date('d/m/Y', strtotime($aula->dia_hora_inicio))}}</p>
                    <p class="time"><i class="fas fa-map-pin"></i> {{$aula->nome_local}} - {{$aula->nome_sala}}</p>
                    <p class="time"><i class="fas fa-user"></i> {{$aula->nome_instrutor}}</p>
                    <p class="time"><i class="fas fa-book"></i> {{$aula->descricao_treinamento}}</p>
                    <h4 class="timeline-header">{{$aula->nome_aula}}</h4>
                    <div class="timeline-body">
                    {{$aula->descricao_aula}}
                    </div>
                    <div class="timeline-footer">
                      <a class="btn btn-success" href="tabela-participantes/{{$aula->id_treinamento}}">Ver Inscritos</a>
                    </div>
                  </div>
                </div>
                <hr style="background-color: black;">
                @endforeach
                @endif
                <!--Fim timeline item -->
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.timeline -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @include('partials.footer')
  <script type="text/javascript">
    
    $("#instrutor").selectize({
      placehoder: "Selecione o Instrutor"
    });

    $("#curso").selectize({
      placehoder: "Selecione o Curso"
    });

    let $select1 = $("#instrutor").selectize();
    $select1[0].selectize.setValue("{{$nome_instrutor}}");

    let $select2 = $("#curso").selectize();
    $select2[0].selectize.setValue("{{$nome_curso}}");

    function backDate(){

      let dateString = $("#data").val();
      let myDate = new Date(dateString);

      //add a day to the date
      myDate.setTime(myDate.getTime() - 1000 * 60 * 60 * 21);
     
      myDate = myDate.toISOString().substring(0, 10); 
      $("#data").val(myDate);
      $("#buscar").click();
    }
    function fowardDate(){
        let dateString = $("#data").val();
        let myDate = new Date(dateString);

        //add a day to the date
        myDate.setTime(myDate.getTime() + 1000 * 60 * 60 * 27);

        myDate = myDate.toISOString().substring(0, 10); 
        $("#data").val(myDate);
        $("#buscar").click();
      }
  </script>