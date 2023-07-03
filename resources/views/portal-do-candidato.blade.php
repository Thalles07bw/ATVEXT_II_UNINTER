<html>
@include('partials.header-candidato')
<style>
	.dataTables_wrapper {
      float: left;
    }
</style>
<body>
  <!-- Begin Page Content -->
	<div class="container-fluid">
		<!-- Page Heading -->
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
				<h1 class="h3 mb-0 text-gray-800 ">Portal do Candidato</h1>
		</div>
		<!-- Conteudo do site -->
		<div class="row">
			@if($dados_candidato)
			<div class="col-md-4" style="padding-bottom: 10px;">
					<div class="card border-left-danger shadow h-100 py-2">
						<div class="card-body" style="text-align: center;">
								<img  id="foto-click" src="{{$dados_candidato->foto_candidato}}" 
								alt="User profile picture" width="128px" height="128px" style="border-radius: 50%; 
								cursor: pointer" 
								onmouseover="this.src='/storage/images/users/change.png'; this.style.opacity=0.5"
								onmouseout="this.src='{{$dados_candidato->foto_candidato}}'; this.style.opacity=1">
								<form id="troca-foto">
										@csrf
										<input type="file" id="FileInput" style="cursor: pointer;  display: none"/>
										<input type="submit" id="Up" style="display: none;" />
								</form>
								<h5 class="profile-username text-center" style="padding: 10px;">{{$nome}}</h5>
								<div class="author-info">
										<p style="font-size: 14px;">
												<span class="address">
														<i class="fas fa-map-marker-alt" style="margin-right: 5px;"></i>
														{{$cidade}}
												</span>
										</p>
										<p>
												<span>
														<i class="fa fa-fw fa-phone"></i>
														{{$dados_candidato->numero_telefone}}
												</span>
										</p>
								</div>
						</div>
				</div>
			</div>
			@endif
			<div class="col-md-8" style="padding-bottom: 10px;">
				<div class="card border-left-danger shadow h-100 py-2">
					<div class="card-header">
						<h5>Vagas para você</h5>
					</div>
					<div class="card-body">
						<div class="col-md-12" style="font-size: 18px;">		
						<table id='tabela-vagas-candidato'>
							<thead>
								<tr>
									<th>ID Vaga</th>
									<th>Título Vaga</th>
									<th>Empresa</th>
									<th>Encerra em</th>
									<th>Piso Salarial</th>
									<th>Ações</th>
								</tr>
							</thead>
							<tbody>
							@foreach($vagas as $vaga)
							<tr>
								<td>{{$vaga->id_vaga}}</td>
								<td>{{$vaga->titulo_vaga}}</td>
								<td>{{$vaga->razao_social_empresa_contratante}}</td>
								<td>{{date('d/m/Y', strtotime($vaga->prazo_processo_seletivo))}}</td>
								<td>{{$vaga->piso_salarial_cargo}}</td>
								<td><a href="/mural-vagas/{{$vaga->id_empresa}}" class="btn btn-primary">Ir para mural</a></td>
							</tr>
							@endforeach
							</tbody>
							<tfoot>

							</tfoot>
						</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
<br>
@include('partials.footer-candidato')
<script type="text/javascript">

	$('#tabela-vagas-candidato').dataTable({
		"lengthChange": false,
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
			},
	
		} 
	});

	  $("#foto-click").on('click', function() {
      $("#FileInput" ).click();
    });

		$( "#FileInput" ).change(function() {
      $("#Up").click();
    });

		$("#troca-foto").on('submit', function(e){
			e.preventDefault();
                  
    var photo = $('#FileInput').prop('files')[0];    //Arquivo
  
 
    var form_data = new FormData(); 

    form_data.append("photo", photo);
		
			$.ajax({
				url:'/atualiza-foto',
				method: 'post',
				dataType: 'script',
      	cache: false,
      	contentType: false,
      	processData: false,
      	data: form_data
			}).done(function(data){
				document.location.reload(true);
			})
		})
</script>

</html>