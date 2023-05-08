
@include('partials.header')
  <!-- Begin Page Content -->
  <div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 ">Vagas</h1>
    </div>
    <div class="row">
      <div class="card shadow col-md-12">
        <div class="card-header py-3">
          <h4>Resultados de Avaliações</h4>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <!-- The time line -->
              <div class="timeline">
                <div class="row timeline-row-spacing">
                  <div class="col-md-6 timeline-date-input-spacing">
                    <form method="get" id="busca-resultado">
                    <label>Vaga</label>
                    <select class="form-control"  id="vaga" name="vaga">
                      @foreach($vagas as $vaga)
                      <option value="{{$vaga->id_vaga}}">{{$vaga->titulo_vaga}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-6 timeline-date-input-spacing">               
                    <label>Candidato</label>
                    <select class="form-control" id="candidato" name="candidato">
                      @foreach($candidatos as $candidato)
                      <option value="{{$candidato->id_candidato}}">{{$candidato->candidato}}</option>
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
                @if(!$resultado_avaliacao)
                <p style="text-align: center;">Não foram encontradas avaliações nessas condições</p>
                @else
                @foreach($resultado_avaliacao as $resultado)
                <hr style="background-color: black;">
                <div class="row timeline-row-spacing" style="padding-top: 20px">
                  
                    <div class="table-responsive">
                      <table id="tabela-parentescos" class="display" style="width:100%">
                        <tbody>                    
                          <tr style="text-align: center;">
                            <td style="width: 10%;"><img
                            src="/teste/{{$resultado->foto_candidato}}" 
                            style="border-radius: 50%; max-width: 90px; max-height: 90px"
                            >
                            </td>
                            <td ><h5>{{$resultado->nome_usuario_candidato}}</h5></td>
                            <td >
                            <h5>Resultado: {{$resultado->percentual_acerto}}%</h5>
                            </td>
                          </tr>
                       </tfoot>
                      </table>                        
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

    let $select1 = $("#vaga").selectize();
    $select1[0].selectize.setValue("{{$id_vaga}}");

    let $select2 = $("#candidato").selectize();
    $select2[0].selectize.setValue("{{$id_candidato}}");

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