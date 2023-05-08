
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
          <h4>Aulas Agendados</h4>
        </div>
        <div class="card-body">
        <!-- Timelime example  -->
          <div class="row">
            <div class="col-md-12">
              <!-- The time line -->
              <div class="timeline">
                <!-- timeline time label -->
                <div class="row timeline-row-spacing">
                  <div class="col-md-3 timeline-date-input-spacing">
                    <form method="get" id="busca-data">
                 
                    <input class="form-control" type="date" id="data" name="data" value="{{$data}}">
                  </div>
                  <div class="col-md-3">
                    <button class="btn btn-primary" type="submit" id="buscar">Buscar</button>
                    </form>
                    <button class="btn btn-primary" onclick="backDate()"><i class="fas fa-arrow-left"></i></button>
                    <button class="btn btn-primary" onclick="fowardDate()"><i class="fas fa-arrow-right"></i></button>
                  </div>
                </div>
                <!-- /.timeline-label -->
                @if(!$aulas)
                <p style="text-align: center;">Você não possui aulas para lecionar hoje</p>
                @else
                @foreach($aulas as $aula)
                <div class="row timeline-row-spacing">
                  <div class="timeline-item">              
                    <p class="time"><i class="fas fa-clock"></i> {{date('H:i', strtotime($aula->dia_hora_inicio))}} - {{date('H:i', strtotime($aula->dia_hora_fim))}} </p>
                    <p class="time"><i class="fas fa-map-pin"></i> {{$aula->nome_local}} - {{$aula->nome_sala}}</p>
                    <p class="time"><i class="fas fa-book"></i> {{$aula->descricao_treinamento}}</p>
                    <h4 class="timeline-header">{{$aula->nome_aula}}</h4>
                    <div class="timeline-body">
                    {{$aula->descricao_aula}}
                    </div>
                    <div class="timeline-footer">
                      <a class="btn btn-success" href="tabela-participantes/{{$aula->id_treinamento}}">Gerar Lista</a>
                      <a class="btn btn-success" href="registro-presenca/{{$aula->id_aula}}">Fazer Chamada</a>
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