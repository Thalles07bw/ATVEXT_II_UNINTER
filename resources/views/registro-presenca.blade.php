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
    border-top: none;
}

td {
    border-left: 1px solid #000;
}

td + td {
    border-left: none;
}
</style>
<body>
  <!-- Begin Page Content -->
  <div class="container-fluid">
    <div class="row">
      <div class="card shadow col-md-12">
        <div class="card-header py-3">
            <h4>Lista de Chamada</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
          <table id="tabela-parentescos" class="display" style="width:100%">
            <thead>
                <tr style="text-align: center;">
                    <th>Nome</th>
                    <th>Status</th>
                    <th>Marcação</th>
                </tr>
            </thead>
            <tbody>
              @foreach($alunos as $aluno)
              <tr style="text-align: center;">
                <td>{{$aluno->nome_colaborador}}</td>
                @if($aluno->status_aluno === NULL)
                <td id="status-{{$aluno->id_colaborador}}">-</td>
                @elseif($aluno->status_aluno === 1)
                <td id="status-{{$aluno->id_colaborador}}">Presente</td>
                @elseif($aluno->status_aluno === 0)
                <td id="status-{{$aluno->id_colaborador}}">Falta</td>
                @endif
                <td style="width: 40%;">
                    @if($aluno->status_aluno === NULL)
                    <a id="falta-{{$aluno->id_colaborador}}"  class="btn btn-danger" style="margin-left: 2px; margin-bottom: 2px;"><i class="fas fa-times-circle"></i></a>
                    <a id="presente-{{$aluno->id_colaborador}}" class="btn btn-success" style="margin-left: 2px; margin-bottom: 2px;"><i class="fas fa-check-circle"></i></a>
                    <button  class="btn btn-primary" id="editar-{{$aluno->id_colaborador}}" style="display: none;">Editar</button>
                    @else
                    <a id="falta-{{$aluno->id_colaborador}}"  class="btn btn-danger" style="margin-left: 2px; margin-bottom: 2px; display: none"><i class="fas fa-times-circle"></i></a>
                    <a id="presente-{{$aluno->id_colaborador}}" class="btn btn-success" style="margin-left: 2px; margin-bottom: 2px; display: none"><i class="fas fa-check-circle"></i></a>
                    <button  class="btn btn-primary" id="editar-{{$aluno->id_colaborador}}">Editar</button>
                    @endif
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
@include('partials.footer-second-layer')
<script type="text/javascript">
$(document).ready(function(){

  //Edição
  $("#form-editar-").on('submit', function(e){
    e.preventDefault();
    
  });
  

  //ao clicar em presente
  $('a[id^="falta-"]').on('click', function(e){
    e.preventDefault();
    let id_aluno = this.id;
    id_aluno = id_aluno.slice(6);
    let baseUrl = (window.location).href; // You can also use document.URL
    let id_aula = baseUrl.substring(baseUrl.lastIndexOf('/') + 1);
    let status = 0;

    $.ajax({
      url: '/registro-presenca/'+id_aula,
      method: 'POST',
      data: {'id_aluno': id_aluno, 'id_aula': id_aula, 'status': status}
    }).done(function(data){
      data = JSON.parse(data);
      $('#status-'+id_aluno).html('')
      $('#status-'+id_aluno).html(data);
      $('#presente-'+id_aluno).hide();
      $('#falta-'+id_aluno).hide();
      $('#editar-'+id_aluno).show();      
    })
  })

  //ao clicar em presente
  $('a[id^="presente-"]').on('click', function(e){
    e.preventDefault();
    let id_aluno = this.id;
    id_aluno = id_aluno.slice(9);
    let baseUrl = (window.location).href; // You can also use document.URL
    let id_aula = baseUrl.substring(baseUrl.lastIndexOf('/') + 1);
    let status = 1;
    $.ajax({
      url: '/registro-presenca/'+id_aula,
      method: 'POST',
      data: {'id_aluno': id_aluno, 'id_aula': id_aula, 'status': status}
    }).done(function(data){
      data = JSON.parse(data);
      $('#status-'+id_aluno).html('')
      $('#status-'+id_aluno).html(data);
      $('#presente-'+id_aluno).hide();
      $('#falta-'+id_aluno).hide();
      $('#editar-'+id_aluno).show();
      
    })
  })
  //ao clicar em presente
  $('button[id^="editar-"]').on('click', function(e){
    e.preventDefault();
    let id_aluno = this.id;
    id_aluno = id_aluno.slice(7);
    $("#presente-"+id_aluno).show();
    $("#falta-"+id_aluno).show();
    $("#editar-"+id_aluno).hide();
  
  })
})
</script>
