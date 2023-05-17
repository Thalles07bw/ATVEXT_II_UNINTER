
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
          <h4>Andamento dos treinamentos</h4>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <!-- The time line -->
              <div class="timeline">
                <div class="row timeline-row-spacing">
                  <div class="col-md-6 timeline-date-input-spacing">
                    <form method="get" id="busca-resultado">
                    <label>Treinamento</label>
                    <select class="form-control"  id="treinamento" name="treinamento">
                      @foreach($treinamentos as $treinamento)
                      <option value="{{$treinamento->id_treinamento}}">{{$treinamento->descricao_treinamento}}</option>
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
                @if(!$percentual_treinamento)
                <p style="text-align: center;">Não há dados sobre o treinamento</p>
                @else
          
                <hr style="background-color: black;">
                  <div class="row timeline-row-spacing" style="padding-top: 20px">
                    <div class="table-responsive">
                      <table id="tabela-parentescos" class="display" style="width:100%">
                        <tbody>                    
                          <tr style="text-align: center;">                      
                            <td><h6>{{$percentual_treinamento[0]->descricao_treinamento}}</h6></td>
                            <td>
                              <span style="color: green">
                                <h6>Concluído: {{number_format($percentual_treinamento[0]->percentual,1)}}%</h6>          
                              </span>
                            </td>
                          </tr>
                       </tfoot>
                      </table>                        
                    </div>
                  </div>                  
                  <hr style="background-color: black;">   
                  @endif
                <!--Fim timeline item -->
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.timeline -->
    </div>
    @if($percentual_treinamento)
    <br>
    <div class="row">
      <div class="card shadow col-md-12">
        <div class="card-header py-3">
            <h4>Situação dos participantes</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
          <table id="tabela-participantes" class="display" style="width:100%">
            <thead>
                <tr style="text-align: center;">
                    <th>Nome</th>
                    <th>Presenças/Total</th>
                    <th>Certificação</th>
                </tr>
            </thead>
            <tbody>
              @foreach($participantes as $participante)
              <tr style="text-align: center;">
                  <td>{{$participante->nome_colaborador}}</td>
                  <td>{{$participante->qtd_presencas}}/{{$participante->qtd_aulas}}</td>
                  @if($participante->caminho_arquivo != NULL)
                  <td style="width: 20%;">
                      <a href="/storage/app/{{$participante->caminho_arquivo}}"  class="btn btn-primary" style="margin-left: 2px; margin-bottom: 2px;">Ver Certificado</a>
                  </td>
                  @else
                  <td style="width: 20%;">
                      -
                  </td>
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
  <!-- /.content-wrapper -->
  @include('partials.footer')
  <script src="http://anthonyterrien.com/demo/knob/jquery.knob.min.js"></script>
  <script type="text/javascript">
    
    $("#treinamento").selectize({
      placehoder: "Selecione o treinamento"
    });

    let $select1 = $("#treinamento").selectize();
    $select1[0].selectize.setValue("{{$id_treinamento}}");

    $('.knob').knob()
    $('#tabela-participantes').dataTable({
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
    })

  </script>
