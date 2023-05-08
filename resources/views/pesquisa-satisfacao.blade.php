@include('partials.header-second-layer')
  <!--Alerts-->
  @include('alerts.alert-modal-delete')
  @include('alerts.alert-success')
  @include('alerts.alert-modal-error')
  <style>
  tr:nth-child(even) {
  background-color: #e5e5e5;
  }
  table {
    border: 1px solid #000;
  }

  tr {
    border-top: 1px solid #000;
  }


  tr + tr {
    border-top: 1px solid #000;
  }

  td + td {
    border-left: 1px solid #000;
  }
</style>
<body>
  <div class="container-fluid">
    <div class="row">
      <div class="card shadow col-md-12">
        <div class="card-header py-3">
            <h4>Pesquisa de Satisfação</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
          <table id="tabela-pesquisa-professor" class="display" style="width:100%">
            <thead>
                <tr style="text-align: center;">
                    <th>Pergunta</th>
                    <th>Nota</th>
                </tr>
            </thead>
            <tbody> 
                @foreach($questoes as $key => $questao)    
                <tr style="text-align: center;">
                  <td>{{$questao->pergunta}}</td>
                  <td style="width: 40%;">
                      <a id="botao-editar-{{$key+1}}" class="btn btn-primary" style="display: none">Editar</a>
                      <a id="botao-P{{$key+1}}-1"  class="btn btn-success" style="margin-left: 2px; margin-bottom: 2px;">1</a>
                      <a id="botao-P{{$key+1}}-2" class="btn btn-success" style="margin-left: 2px; margin-bottom: 2px;">2</a>
                      <a id="botao-P{{$key+1}}-3"  class="btn btn-success" style="margin-left: 2px; margin-bottom: 2px;">3</a>
                      <a id="botao-P{{$key+1}}-4" class="btn btn-success" style="margin-left: 2px; margin-bottom: 2px;">4</a>
                      <a id="botao-P{{$key+1}}-5"  class="btn btn-success" style="margin-left: 2px; margin-bottom: 2px;">5</a>
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
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" id="form-editar-">
        @csrf
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
@include('partials.footer-second-layer')
<script>
$(document).ready(function(){

  //Cadastro
  $("#cadastro-").on('submit', function(e){
      e.preventDefault();
  });

  //Edição
  $("#form-editar-").on('submit', function(e){
    e.preventDefault();
    
  });
  
  //Exclusão
  $('#confirmar-exclusao').on('click', function(e){
    e.preventDefault();
    var id = $('#id-delete').val();
    $.ajax({
      url: '/teste/cadastro-/deletar/' + id,
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
    $('#tabela-pesquisa-professor').DataTable({
      
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
            url: '/teste/cadastro-/visualizar/' + id,
            method: 'POST',
            data: {'id': id}
          }).done(function(data){
            data = JSON.parse(data);
            console.log(data[0])
            $('#nome-parentesco-editar').val(data[0].nome_parentesco);
            $('#editar').modal('show');
          })
        });

        $('a[id^="botao-P1-"]').on('click', function(e){
          $('a[id^="botao-P1-"]').hide();
          let id = this.id;
          id = id.slice(9);
          $("#botao-editar-1").html(id);
          $("#botao-editar-1").show();
        })
        
        $('a[id^="botao-P2-"]').on('click', function(e){
          $('a[id^="botao-P2-"]').hide();
          let id = this.id;
          id = id.slice(9);
          $("#botao-editar-2").html(id);
          $("#botao-editar-2").show();
        })
        $('a[id^="botao-P3-"]').on('click', function(e){
          $('a[id^="botao-P3-"]').hide();
          let id = this.id;
          id = id.slice(9);
          $("#botao-editar-3").html(id);
          $("#botao-editar-3").show();
        })
        $('a[id^="botao-P4-"]').on('click', function(e){
          $('a[id^="botao-P4-"]').hide();
          let id = this.id;
          id = id.slice(9);
          $("#botao-editar-4").html(id);
          $("#botao-editar-4").show();
        })

        $('a[id^="botao-P5-"]').on('click', function(e){
          $('a[id^="botao-P5-"]').hide();
          let id = this.id;
          id = id.slice(9);
          $("#botao-editar-5").html(id);
          $("#botao-editar-5").show();
        })
        $('a[id^="botao-P6-"]').on('click', function(e){
          $('a[id^="botao-P6-"]').hide();
          let id = this.id;
          id = id.slice(9);
          $("#botao-editar-6").html(id);
          $("#botao-editar-6").show();
        })
        $('a[id^="botao-P7-"]').on('click', function(e){
          $('a[id^="botao-P7-"]').hide();
          let id = this.id;
          id = id.slice(9);
          $("#botao-editar-7").html(id);
          $("#botao-editar-7").show();
        })

        $('a[id^="botao-P8-"]').on('click', function(e){
          $('a[id^="botao-P8-"]').hide();
          let id = this.id;
          id = id.slice(9);
          $("#botao-editar-8").html(id);
          $("#botao-editar-8").show();
        })
        $('a[id^="botao-P9-"]').on('click', function(e){
          $('a[id^="botao-P9-"]').hide();
          let id = this.id;
          id = id.slice(9);
          $("#botao-editar-9").html(id);
          $("#botao-editar-9").show();
        })

        $('a[id^="botao-P10-"]').on('click', function(e){
          $('a[id^="botao-P10-"]').hide();
          let id = this.id;
          id = id.slice(10);
          $("#botao-editar-10").html(id);
          $("#botao-editar-10").show();
        })
        $('a[id^="botao-P11-"]').on('click', function(e){
          $('a[id^="botao-P11-"]').hide();
          let id = this.id;
          id = id.slice(10);
          $("#botao-editar-11").html(id);
          $("#botao-editar-11").show();
        })
        $('a[id^="botao-P12-"]').on('click', function(e){
          $('a[id^="botao-P12-"]').hide();
          let id = this.id;
          id = id.slice(10);
          $("#botao-editar-12").html(id);
          $("#botao-editar-12").show();
        })
        $('a[id^="botao-P13-"]').on('click', function(e){
          $('a[id^="botao-P13-"]').hide();
          let id = this.id;
          id = id.slice(10);
          $("#botao-editar-13").html(id);
          $("#botao-editar-13").show();

        })
      },

      searching: false,
      ordering:  false,
      paging: false,
      info: false,
      "lengthChange": false,
      "pageLength": 13,

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